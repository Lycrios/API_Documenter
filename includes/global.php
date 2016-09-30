<?php
/*
* Developer: Matthew Donald Auld (Lycrios)
* File started: 9/6/2016 11:23:57 PM
* File: global.php
*/

define("version",1.02);
define("URL",$url,true);
$page = "home";
$parameters = array();

if(isset($_GET["page"])){
	$page = strtolower($_GET["page"]);
}

if(isset($_GET["function"])){
	$parameters["function"] = $_GET["function"];
}

include("classes/documenter.class.php");

function parseTypes($type){
	if(strtolower($type) == "bool"){
		$type = "Boolean";
	}
	if(strtolower($type) == "int"){
		$type = "Integer";
	}
	return $type;
}

function getTypes($type){
	if(is_bool($type)){
		return "Boolean";
	}elseif(is_int($type)){
		return "Integer";
	}elseif(is_float($type)){
		return "Float";
	}elseif(is_double($type)){
		return "Double";
	}
	return "String";
}
?>