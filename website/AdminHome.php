<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <title>Admin Home Page</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  <style>
header ul {
    list-style-type: none;
    margin: 0;
    padding: 0;
    overflow: hidden;
    background-color: #333;
}

header li {
    float: left;
}

header li a {
    display: block;
    color: white;
    text-align: center;
    padding: 8px 16px;
    text-decoration: none;
}

header li a:hover:not(.active) {
    background-color: #111;
}

header .active {
    background-color: #808080;
}
      
      li a {
    display: block;
    color: black;
    text-align: left;
}
      
      
</style>
</head>
<body>
<?php
        if ((isset($_SESSION['Authorized']))&& ($_SESSION["UserType"] == "Admin"))
        {
?>
<header>
    <ul id="header">
  <li><a class="active" href="http://localhost/ehealth/AdminHome.php">Home</a></li>
  <li><a href="http://localhost/ehealth/DoctorTable.php">Doctor Table</a></li>
  <li><a href="http://localhost/ehealth/PatientTable.php">Patient Table</a></li>
        <li><a href="http://localhost/ehealth/logout.php" style="position: absolute;right: 0px;">logout</a></li>
</ul>
    
    
    </header>
    <div class="container">
    <br>
    <br>

<div class="main-div">
   
   <h2 style="font-family: Times;">Tables Management</h2>
   <ul>
       <li><a  href="http://localhost/ehealth/AddDoctor.php">Add Doctor</a></li>
       <li><a href="http://localhost/ehealth/DoctorTable.php">Doctor Table</a></li>
        <li><a href="http://localhost/ehealth/AddPatient.php">Add Patient</a></li>
        <li><a href="http://localhost/ehealth/PatientTable.php">Patient Table</a></li>
    </ul>

    </div>


    </div>
    
   <?php
    } else {
            header("Location: http://localhost/ehealth/index.php");
        } ?>
    </body>
</html>
