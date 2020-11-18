<?
ini_set('max_execution_time', 10); 
ini_set('max_input_time', 10); 
include_once "config.php";
include_once "./module/system.php";
include_once "./module/auth_class.php";
include "./module/session.php";
include "./module/request.php";
include "./module/gd.php";
include_once("module/pb_script.php");
include_once("module/html.php");
include_once("module/common.lib.php");
if($_GET[dbg] !=1){
//error_reporting(0);

}
include_once "html_src/_common.php";

//define("DEBUG", 1);
/******* variable / DB************/
include "__var.php";


/******** Session Login/ ***********/
$sess = new esess($appName);
$user = $sess->getlogin();

$c = $_GET[c];


if(!$c) $c = "home";
$incfile = $htmlpath . "/".$template.$c.".$ftype";
$incsfile = $htmlpath . "/".$template.$c.".$fstype";
$deffile = $htmlpath . "/".$template."home.php";

if(file_exists($incfile)){
	include $incfile;
}else if(file_exists($incsfile)){
	include $incsfile;
}else{
	include $deffile;
}


?>




