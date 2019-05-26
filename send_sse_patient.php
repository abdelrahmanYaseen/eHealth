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

header('Content-Type: text/event-stream');
header('Cache-Control: no-cache');

$Query = 'SELECT * FROM chatnotification WHERE UserID='.$_SESSION["UserID"];
$QueryResult = mysqli_query($DBConnection, $Query);
$Notificationrow = mysqli_fetch_assoc($QueryResult);

$PatientQuery = 'SELECT * FROM patient WHERE UserID='.$_SESSION["UserID"];
                $PatientQueryResult = mysqli_query($DBConnection, $PatientQuery);
                $Patientrow = mysqli_fetch_assoc($PatientQueryResult);
                
            
                $DoctorPatientQuery = 'SELECT * FROM doctorpatient WHERE PatientID='.$Patientrow['PatientID'];
                $DoctorPatientQueryResult = mysqli_query($DBConnection, $DoctorPatientQuery);


            
            $counter1=0;
            while($DoctorPatientrow = mysqli_fetch_assoc($DoctorPatientQueryResult)) { 
                    
                    $DoctorQuery = 'SELECT * FROM doctor WHERE DoctorID='.$DoctorPatientrow['DoctorID'];
                    $DoctorQueryResult = mysqli_query($DBConnection, $DoctorQuery);
                    $Doctorrow = mysqli_fetch_assoc($DoctorQueryResult);
                    
                    
                
                 $query = '
                 SELECT * FROM chat_message 
                 WHERE from_user_id = '.$Doctorrow['UserID'].' 
                 AND to_user_id = '.$_SESSION["UserID"].' 
                 AND status = "1"
                 ';
                
                
                $queryResult = mysqli_query($DBConnection, $query);
                while($queryrow = mysqli_fetch_assoc($queryResult)) {
                    $counter1=$counter1+1;
                }
                 
                     
            }
//check $counter1=0 don't send
//in chat page make flag equal to 1
if($counter1!=$Notificationrow['NumberOfMessages'])
{
    if($Notificationrow['NumberOfMessages']==0)
    {
       $flag=1; 
    }
    else{
        $flag=0; 
    }
    $Query = 'UPDATE chatnotification SET NumberOfMessages='.$counter1.' WHERE UserID="'.$_SESSION['UserID'].'"';
    $QueryResult = mysqli_query($DBConnection, $Query);
    $ResultJSON = $ResultJSON = '{"flag" : "' . $flag .'" , "data" : "' . $counter1 .'"}';
    echo "data: $ResultJSON\n\n";
    ob_flush();
    flush();    
}
?>                