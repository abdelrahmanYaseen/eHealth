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

if($_SESSION["UserType"] == "Doctor")
{
              
    $DoctorQuery = 'SELECT * FROM doctor WHERE UserID='.$_SESSION["UserID"];
                $DoctorQueryResult = mysqli_query($DBConnection, $DoctorQuery);
                $Doctorrow = mysqli_fetch_assoc($DoctorQueryResult);
                
                
                
                $counter=0;
                $DoctorPatientQuery = 'SELECT * FROM doctorpatient WHERE DoctorID='.$Doctorrow['DoctorID'];
                $DoctorPatientQueryResult = mysqli_query($DBConnection, $DoctorPatientQuery);


            
            $counter=0;
            $ResultJSON = '{"Result" :[';    
            while($DoctorPatientrow = mysqli_fetch_assoc($DoctorPatientQueryResult)) {
                    if($counter!=0)
                    {
                        $ResultJSON= $ResultJSON . ",";
                    }    
                    
                    $PatientQuery = 'SELECT * FROM patient WHERE PatientID='.$DoctorPatientrow['PatientID'];
                    $PatientQueryResult = mysqli_query($DBConnection, $PatientQuery);
                    $Patientrow = mysqli_fetch_assoc($PatientQueryResult);
                    
                    $status = '';
                    $current_timestamp = strtotime(date("Y-m-d H:i:s") . '- 3 second');
                    $current_timestamp = date('Y-m-d H:i:s', $current_timestamp);
                    
                    
                    $lastActivityQuery = 'SELECT * FROM login_details WHERE user_id='.$Patientrow['UserID'];
                    $lastActivityQueryResult = mysqli_query($DBConnection, $lastActivityQuery);
                    $row = mysqli_fetch_array($lastActivityQueryResult);
                    
                    $user_last_activity = $row['last_activity'];

                    
                     if($user_last_activity > $current_timestamp)
                     {
                         $status= "Online";
                    //  $status = '<span class="label label-success">Online</span>';
                     }
                     else
                     {
                         $status= "Offline";
                    //  $status = '<span class="label label-danger">Offline</span>';
                     }
                    
                    $counter=$counter+1;
                    $contact = '{"Name" : "' . $Patientrow['Name'] . '" , "Surname" : "' . $Patientrow['Surname'] . '" , "UserID" : "' . $Patientrow['UserID'].'" , "Status" : "' . $status .'"';

                
                 $query = '
                 SELECT * FROM chat_message 
                 WHERE from_user_id = '.$Patientrow['UserID'].' 
                 AND to_user_id = '.$_SESSION["UserID"].' 
                 AND status = "1"
                 ';
                
                $counter1=0;
                $queryResult = mysqli_query($DBConnection, $query);
                while($queryrow = mysqli_fetch_assoc($queryResult)) {
                    $counter1=$counter1+1;
                }
                 
                     $contact = $contact.' , "Count" : "' . $counter1 .'"';
                 // $output = '<span class="label label-success">'.$counter1.'</span>';
                
                

                   $contact= $contact.'}';
                   $ResultJSON= $ResultJSON . $contact;
                
    /* 
                    $output .= '
 <tr>
  <td>'.$Patientrow['Name'].' '.$Patientrow['Surname'].'</td>
  <td>'.$status.'</td>
  <td><button type="button" class="btn btn-info btn-xs start_chat" data-touserid="'.$Patientrow['UserID'].'" data-tousername="'.$Patientrow['Name'].' '.$Patientrow['Surname'].'">Start Chat</button></td>
 </tr>
 ';*/
}}
else if($_SESSION["UserType"] == "Patient")
{
              
    $PatientQuery = 'SELECT * FROM patient WHERE UserID='.$_SESSION["UserID"];
                $PatientQueryResult = mysqli_query($DBConnection, $PatientQuery);
                $Patientrow = mysqli_fetch_assoc($PatientQueryResult);
                
                $counter=0;
                $DoctorPatientQuery = 'SELECT * FROM doctorpatient WHERE PatientID='.$Patientrow['PatientID'];
                $DoctorPatientQueryResult = mysqli_query($DBConnection, $DoctorPatientQuery);


                $ResultJSON = '{"Result" :['; 
                while($DoctorPatientrow = mysqli_fetch_assoc($DoctorPatientQueryResult)) {
                    if($counter!=0)
                    {
                        $ResultJSON= $ResultJSON . ",";
                    }
                    $DoctorQuery = 'SELECT * FROM doctor WHERE DoctorID='.$DoctorPatientrow['DoctorID'];
                    $DoctorQueryResult = mysqli_query($DBConnection, $DoctorQuery);
                    $Doctorrow = mysqli_fetch_assoc($DoctorQueryResult);
                    
                    
                    $status = '';
                    $current_timestamp = strtotime(date("Y-m-d H:i:s") . '- 10 second');
                    $current_timestamp = date('Y-m-d H:i:s', $current_timestamp);
                    
                    
                    $lastActivityQuery = 'SELECT * FROM login_details WHERE user_id='.$Doctorrow['UserID'];
                    $lastActivityQueryResult = mysqli_query($DBConnection, $lastActivityQuery);
                    
                    $row = mysqli_fetch_array($lastActivityQueryResult);
                    
                    $user_last_activity = $row['last_activity'];

                    
                     if($user_last_activity > $current_timestamp)
                     {
                         $status= "Online";
                    //  $status = '<span class="label label-success">Online</span>';
                     }
                     else
                     {
                         $status= "Offline";
                    //  $status = '<span class="label label-danger">Offline</span>';
                     }
                    
                    
                    $counter=$counter+1;
                    $contact = '{"Name" : "' . $Doctorrow['Name'] . '" , "Surname" : "' . $Doctorrow['Surname'] . '" , "UserID" : "' . $Doctorrow['UserID'].'" , "Status" : "' . $status .'"';

                    
                    $query = '
                 SELECT * FROM chat_message 
                 WHERE from_user_id = '.$Doctorrow['UserID'].' 
                 AND to_user_id = '.$_SESSION["UserID"].' 
                 AND status = "1"
                 ';
                
                $counter1=0;
                $queryResult = mysqli_query($DBConnection, $query);
                while($queryrow = mysqli_fetch_assoc($queryResult)) {
                    $counter1=$counter1+1;
                }
                 
                     $contact = $contact.' , "Count" : "' . $counter1 .'"';
                 // $output = '<span class="label label-success">'.$counter1.'</span>';
                
                
                    

                   $contact= $contact.'}';
                   $ResultJSON= $ResultJSON . $contact;
                    /*
                    $output .= '
 <tr>
  <td>'.$Doctorrow['Name'].' '.$Doctorrow['Surname'].'</td>
  <td>'.$status.'</td>
  <td><button type="button" class="btn btn-info btn-xs start_chat" data-touserid="'.$Doctorrow['UserID'].'" data-tousername="'.$Doctorrow['Name'].' '.$Doctorrow['Surname'].'">Start Chat</button></td>
 </tr>
 ';*/
        }
                

}


$ResultJSON= $ResultJSON . ']}';
echo $ResultJSON;

?>
