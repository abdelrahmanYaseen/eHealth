<?php
session_start();
?>
<!DOCTYPE html>



<html lang="en">
  <head>
    <title>e-Health System</title>
  
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
      <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
<!------ Include the above in your HEAD tag ---------->
      <style>
          body#LoginForm{ background-image:url("http://localhost/ehealth/computer-1149148_1920.jpg"); background-repeat:no-repeat; background-position:center; background-size:cover;background-attachment: fixed;}

.form-heading { color:white; font-size:50px;font-family: "Times New Roman";}
.panel h2{ color:#444444; font-size:18px; margin:0 0 8px 0;}
.panel p { color:#777777; font-size:14px; margin-bottom:30px; line-height:24px;}
.login-form .form-control {
  background: #f7f7f7 none repeat scroll 0 0;
  border: 1px solid #d4d4d4;
  border-radius: 4px;
  font-size: 14px;
  height: 50px;
  line-height: 50px;
}
.main-div {
  background: #ffffff none repeat scroll 0 0;
  border-radius: 8px;
  margin: 10px auto 30px;
  width: 420px;
  
  padding: 50px 70px 70px 71px;
}

.login-form .form-group {
  margin-bottom:10px;
}
.login-form{ text-align:center;}
.forgot a {
  color: #777777;
  font-size: 14px;
  text-decoration: underline;
}
.login-form  .btn.btn-primary {
  background: #898281 none repeat scroll 0 0;
  border-color: #898281;
  color: #ffffff;
  font-size: 14px;
  width: 100%;
  height: 50px;
  line-height: 50px;
  padding: 0;
}
.forgot {
  text-align: left; margin-bottom:30px;
}
.botto-text {
  color: #ffffff;
  font-size: 14px;
  margin: auto;
}
.login-form .btn.btn-primary.reset {
  background: #898281 none repeat scroll 0 0;
}
.back { text-align: left; margin-top:10px;}
.back a {color: #444444; font-size: 13px;text-decoration: none;}

          </style>
  </head>
<body id="LoginForm">
    
    
    <?php
        if(isset($_SESSION['Authorized']) && !empty($_SESSION['Authorized'])) {
            
            if($_SESSION["UserType"] == "Admin")
        {
            header("Location: http://localhost/ehealth/AdminHome.php");
        }
        else if($_SESSION["UserType"] == "Doctor")
        {
            header("Location: http://localhost/ehealth/DoctorHome.php");
        }
        else if($_SESSION["UserType"] == "Patient")
        {
            header("Location: http://localhost/ehealth/PatientHome.php");
        }
        }
        else if (isset($_POST["username"]) && isset($_POST["password"])) {
            $url = "http://localhost/ehealth/authenticate.php";
        $post = curl_init();
        $fields = "Operation=Login&Username={$_POST["username"]}&Password={$_POST["password"]}";
        curl_setopt($post, CURLOPT_URL, $url);
        curl_setopt($post, CURLOPT_POST, "4");
        curl_setopt($post, CURLOPT_POSTFIELDS, $fields);
        curl_setopt($post, CURLOPT_RETURNTRANSFER, 1);
        $result = curl_exec($post);
        curl_close($post);
        $UserCredentials = json_decode($result, true);

        $_SESSION["Username"] = $_POST["username"];


    if ($UserCredentials["Result"] == 1) {
            $_SESSION["UserID"] = $UserCredentials["UserID"];
            $_SESSION["Username"] = $UserCredentials["Username"];
            $_SESSION["Authorized"] = True;
            $_SESSION["UserType"] = $UserCredentials["UserType"];
        
            /*
                CHANGE URL
            */
        //    header("Location: /test.php");
        if($_SESSION["UserType"] == "Admin")
        {
            header("Location: http://localhost/ehealth/AdminHome.php");
        }
        else if($_SESSION["UserType"] == "Doctor")
        {
            header("Location: http://localhost/ehealth/DoctorHome.php");
        }
        else if($_SESSION["UserType"] == "Patient")
        {
            header("Location: http://localhost/ehealth/PatientHome.php");
        }
                exit;
            } else {?>
            
            <div class="container">
<h1 class="form-heading"><center><br></center></h1>
    <br>
<div class="login-form">
<div class="main-div">
    <div class="panel">
   <h2>Login Form</h2>
   <p>Please enter your username and password</p>
   </div>
    <form id="Login" class="login-form" action="index.php" method="post">

        <div class="form-group">

            <input class="form-control placeholder-no-fix" type="text" autocomplete="off" placeholder="Username" name="username" />

        </div>

        <div class="form-group">
            <input class="form-control placeholder-no-fix" type="password" autocomplete="off" placeholder="Password" name="password" /> 

        </div>
        <button type="submit" class="btn btn-primary">Login</button>
        <p style="color:red;font-size: 14px;">Please enter correct Username and Password</p>
    </form>
    </div>

</div>
    </div>

      <?php  }
    } else {
        ?>
    
    
<div class="container">
<h1 class="form-heading"><center><br></center></h1>
    <br>
<div class="login-form">
<div class="main-div">
    <div class="panel">
   <h2>Login Form</h2>
   <p>Please enter your username and password</p>
   </div>
    <form id="Login" class="login-form" action="index.php" method="post">

        <div class="form-group">

            <input class="form-control placeholder-no-fix" type="text" autocomplete="off" placeholder="Username" name="username" />

        </div>

        <div class="form-group">
            <input class="form-control placeholder-no-fix" type="password" autocomplete="off" placeholder="Password" name="password" /> 

        </div>
        <button type="submit" class="btn btn-primary">Login</button>

    </form>
    </div>

</div>
    </div>
    <?php
        }
        ?>
    


</body>
</html>
