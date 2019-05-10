
<?php

session_start();

header('Access-Control-Allow-Origin: *');
/*
error_reporting(E_ALL);
ini_set('display_errors', 1);
*/
require_once('config.php');

$ResultJSON = '{"Operation" : "Delete", "Result" : "0"}';
            $DBConnection = mysqli_connect($DBSERVER, $DBUSER, $DBPASSWORD, $DBNAME);
            mysqli_select_db($DBConnection, $DBNAME);
            mysqli_query($DBConnection, "SET NAMES utf8");


            $Query = 'DELETE FROM chat_message WHERE chat_message_id="'.$_REQUEST['chat_message_id'].'"';
            $QueryResult = mysqli_query($DBConnection, $Query);
            if($QueryResult==True)
            {
                $ResultJSON = '{"Operation" : "Delete", "Result" : "1"}';
            }
    echo $ResultJSON;
?>