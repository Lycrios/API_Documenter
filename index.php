<?php
/*
* Developer: Matthew Donald Auld (Lycrios)
* File started: 9/6/2016 11:15:38 PM
* File: index.php
*/

$git = exec("git log --format=\"%H\" -n 1");
define("GIT",$git,true);

include("config.php");
include("includes/global.php");

if(file_exists($file_name)){
	if(extension_loaded("yaml")){
		$document = new Document($file_name);
	}else{
		echo "YAML NOT INSTALLED.";
		phpinfo();
		exit;
	}
}else{
	include("error/403.php");
	exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
	<title><?=$document->title." V".$document->version?> ~ JBS Documenter V<?=version?></title>
	<link rel="stylesheet" type="text/css" href="<?=URL?>css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="<?=URL?>css/bootstrap-theme.min.css">
	<link rel="stylesheet" type="text/css" href="<?=URL?>css/documenter.css">
	<link rel="stylesheet" type="text/css" href="<?=URL?>css/style.css?v=<?=GIT?>">
	<link href="https://fonts.googleapis.com/css?family=Merriweather:900|Open+Sans" rel="stylesheet">
	<script type="text/javascript" src="<?=URL?>js/jquery.min.js"></script>
	<script type="text/javascript" src="<?=URL?>js/bootstrap.min.js"></script>
</head>
<body>
<nav class="navbar navbar-default navbar-fixed-top">
	<div class="container-fluid">
		<div class="navbar-header">
			<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
				<span class="sr-only">Toggle navigation</span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
			</button>
			<a class="navbar-brand" href="<?=URL?>"><?=$document->title." V".$document->version?></a>
		</div>
		<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
			<ul class="nav navbar-nav">
				<li><a href="<?=URL?>">Home</a></li>
				<? if(count($document->functions) > 0){?>
				<li class="dropdown">
					<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Functions <span class="caret"></span></a>
					<ul class="dropdown-menu">
						<?
						foreach ($document->functions as $key => $value) {
						?>
						<li><a href="<?=URL."v".$document->version."/"."$value[name]"?>"><?=ucwords(preg_replace("/_/"," ",$value["name"]))?></a></li>
						<?	
						}
						?>
					</ul>
				</li>
				<? } ?>
			</ul>
			<form class="navbar-form navbar-left">
				<div class="form-group">
					<input type="text" class="form-control" placeholder="Search">
				</div>
				<button type="submit" class="btn btn-default">Submit</button>
			</form>
		</div>
	</div>
</nav>
<div class="container page">
	<?$document->renderPage($page,$parameters)?>
</div>
</body>
</html>