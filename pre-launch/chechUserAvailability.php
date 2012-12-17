<?php
require_once('config.php');
if(isset($_GET['username'])&&$_GET['username']!=""){
	$con = mysql_connect($dbHost,$dbUsername,$dbPassword) or die("db connect error");;
	mysql_select_db($dbName, $con) or die("db select error");
$result = mysql_query("SELECT * FROM user_reserve where username='".$_GET['username']."'",$con) or die("db query error");
if(mysql_num_rows($result)==0){
$message='Username available';$availability=TRUE;
}else{
$message='Username not available';$availability=FALSE;
}
$outarr=array('message'=>$message,'availability'=>$availability);
header('Content-type: application/json');
echo "{\"response\":".json_encode($outarr)."}";
}
	?>