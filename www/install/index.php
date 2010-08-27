<?php
@session_start();
require_once('../lib/install.php');
$page_title = "Welcome";

$cfg = new Install();
if ($cfg->isLocked()) {
	$cfg->error = true;
}

$cfg->cacheCheck = is_writable($cfg->SMARTY_DIR.'/templates_c');
if ($cfg->cacheCheck === false) { $cfg->error = true; }

if (!$cfg->error) {
	$cfg->setSession();
}

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd"> 
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv="content-type" content="text/html; charset=utf-8" />
	<title><?php echo $page_title; ?></title>
	<link href="install.css" rel="stylesheet" type="text/css" media="screen" />
</head>
<body>
	<h1 id="logo"><img alt="Newznab" src="../images/banner.jpg" /></h1>
	<div class="content">	
		<h2>Newznab Install</h2>

	
		<p>Welcome to Newznab. Before getting started, you need to make sure that the server meet's 
			the minimum requirements for running Newznab. Also prepare the following information:</p>
		<ol>
			<li>Your database credentials</li>
			<li>Your news server credentials</li>
			<li>SSH & root ability on your server (incase you need to install missing packages)</li>
		</ol>
		<p>
			<strong>
				<div style="color: red">WARNING: </div> 
				This software is not practical for 
				use on shared hosting. You should only use this on a server where YOU have the required 
				privileges and knowledge to solve any challenges that might appear.
			</strong>
		</p>
		<div align="center">
		<?php if (!$cfg->error) { ?>
			<form action="step1.php"><input type="submit" value="Go to step one: Pre flight check" /></form>              
		<?php } else { 
			if (!$cfg->cacheCheck) { ?>
				<div class="error">The template cache folder must be writable. A quick solution is to run:<br />chmod 777 <?php echo $cfg->SMARTY_DIR; ?>/templates_c</div>
			<?php } else { ?>
				<div class="error">Installation Locked!</div> 
			<?php }
			} ?>
		</div>

	
		<div class="footer">
			<p><br /><a href="http://www.newznab.com/">Newznab</a> is released under GPL. All rights reserved <?php echo date("Y"); ?>.</p>
		</div>
	</div>
</body>
</html>