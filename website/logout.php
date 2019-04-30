<?php
session_start();

session_unset($_SESSION["UserID"]); 
session_unset($_SESSION["Username"]);
session_unset($_SESSION["Authorized"]);
session_unset($_SESSION["UserType"]);
$_SESSION = array();
session_destroy();

header("Location: http://localhost/ehealth/index.php");
exit;
?>