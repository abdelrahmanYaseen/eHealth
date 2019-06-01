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


$DoctorQuery = 'SELECT * FROM doctor WHERE UserID='.$_SESSION["UserID"];
                $DoctorQueryResult = mysqli_query($DBConnection, $DoctorQuery);
                $Doctorrow = mysqli_fetch_assoc($DoctorQueryResult);
                    
                
                $counter=0;
                $DoctorPatientQuery = 'SELECT * FROM doctorpatient WHERE DoctorID='.$Doctorrow['DoctorID'];
                $DoctorPatientQueryResult = mysqli_query($DBConnection, $DoctorPatientQuery);

            
            $counter1=0;
            $counter2=0;
                    
                    $EmergencyCaseQuery = 'SELECT * FROM doctorpatient AS d,emergencycase As e WHERE d.patientID=e.patientID AND d.DoctorID='.$Doctorrow['DoctorID'];
                    $EmergencyCaseQueryResult = mysqli_query($DBConnection, $EmergencyCaseQuery);
                   
                    while($EmergencyCaserow = mysqli_fetch_assoc($EmergencyCaseQueryResult)) {
                        if(($EmergencyCaserow["Flag"]==1)||($EmergencyCaserow["Flag"]==2))
                        {
                            $counter2=$counter2+1;
                        }
                        if($EmergencyCaserow["Flag"]==1)
                        {
                            $counter1=$counter1+1;
                            $Query = 'UPDATE emergencycase SET Flag=2 WHERE EmergencyCaseID="'.$EmergencyCaserow["EmergencyCaseID"].'"';
                            $QueryResult = mysqli_query($DBConnection, $Query);
                        }                        
                    }                 
                              

if($counter1!=0)
{
    $ResultJSON = $ResultJSON = '{"flag" : "1" , "data" : "' . $counter2 .'"}';
    echo "data: $ResultJSON\n\n";
    ob_flush();
    flush();    
}
?>                