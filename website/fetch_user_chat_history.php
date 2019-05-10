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


            $query = "
             SELECT * FROM chat_message 
             WHERE (from_user_id = '".$_SESSION['UserID']."' 
             AND to_user_id = '".$_POST['to_user_id']."') 
             OR (from_user_id = '".$_POST['to_user_id']."' 
             AND to_user_id = '".$_SESSION['UserID']."') 
             ORDER BY timestamp DESC
             ";
            $QueryResult = mysqli_query($DBConnection, $query);
            $counter=0;
          //  $ResultJSON = '{"Result" :[';
            $output = '<ul class="list-unstyled">';
            while($row = mysqli_fetch_assoc($QueryResult)) {
               
                $user_name = '';
                  if($row["from_user_id"] == $_SESSION['UserID'])
                  {
                      $user_name = '<button type="button" class="btn btn-danger btn-xs remove_chat" id="'.$row['chat_message_id'].'">x</button>&nbsp;<b class="text-success">You</b>';
 
                 //  $user_name = '<b class="text-success">You</b>';
                  }
                  else
                  {
                    
                   $user_name = '<b class="text-danger">'.$_POST['to_user_name'].'</b>';
                  }
      
                
                  $output .= '
                  <li style="border-bottom:1px dotted #ccc">
                   <p>'.$user_name.' - '.$row["chat_message"].'
                    <div align="right">
                     - <small><em>'.$row['timestamp'].'</em></small>
                    </div>
                   </p>
                  </li>
                  ';
            }
            $output .= '</ul>';
            

            $query = "
             UPDATE chat_message 
             SET status = '0' 
             WHERE from_user_id = '".$_POST['to_user_id']."' 
             AND to_user_id = '".$_SESSION['UserID']."' 
             AND status = '1'
             ";
            $QueryResult = mysqli_query($DBConnection, $query);
        
             
            echo $output;

?>