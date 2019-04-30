<?php

header('Access-Control-Allow-Origin: *');
require_once('config.php');

$DBConnection = mysqli_connect($DBSERVER, $DBUSER, $DBPASSWORD, $DBNAME);
mysqli_select_db($DBConnection, $DBNAME);
mysqli_query($DBConnection, "SET NAMES utf8");


$ResultJSON = '{"Operation" : "NoOP", "Result" : "-100" }';
switch ($_REQUEST["Operation"]) {
    case "Login":

        $ControlUserSQL = "Select * from user where Username='" . $_REQUEST["Username"] . "' and Password='" . $_REQUEST["Password"] . "'";
        $ControlUser = mysqli_query($DBConnection, $ControlUserSQL);
        
        if (mysqli_affected_rows($DBConnection) > 0) {
            
                $UserID = mysqli_fetch_array($ControlUser);
                
                $ResultJSON = '{"Operation" : "Login", "Result" : "1" , "UserID" : "' . $UserID["UserID"] .'" , "Username" : "' . $UserID["Username"] .'" , "UserType" : "' . $UserID["UserType"] .'" }';
            
            
        } else {
            $ResultJSON = '{"Operation" : "Login", "Result" : "-1" }';
        }
// Check result         	  		     
        break;
}

echo $ResultJSON;
?>