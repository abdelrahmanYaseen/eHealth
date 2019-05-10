<?php

session_start();

header('Access-Control-Allow-Origin: *');
/*
error_reporting(E_ALL);
ini_set('display_errors', 1);
*/
require_once('config.php');


$DBConnection = mysqli_connect($DBSERVER, $DBUSER, $DBPASSWORD, $DBNAME);
mysqli_select_db($DBConnection, $DBNAME);
mysqli_query($DBConnection, "SET NAMES utf8");


 $Query = 'UPDATE login_details SET last_activity= "'.date("Y-m-d H:i:s").'" WHERE user_id="'.$_SESSION['UserID'].'"';
$QueryResult = mysqli_query($DBConnection, $Query);


?>