<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <title>Standard Rates</title>
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
        if ((isset($_SESSION['Authorized']))&& ($_SESSION["UserType"] == "Doctor"))
        {
?>
<header>
    <ul id="header">
  <li><a href="http://localhost/ehealth/DoctorHome.php">Home</a></li>
  <li><a href="http://localhost/ehealth/DoctorPatientTable.php">Patients Table</a></li>
    <li><a href="http://localhost/ehealth/logout.php" style="position: absolute;right: 0px;">logout</a></li>
</ul>
    
    
    </header>
    <div class="container">
    <br>
    <br>

<div class="main-div">
   
   <h2 style="font-family: Times;">Standard Rates</h2>
   <div id="Row">
   </div>
    </div>


    </div>
 <script type="text/javascript">
                            

    window.onload = function () {
          var parsedUrl = new URL(window.location.href);
            PatientID=parsedUrl.searchParams.get("PatientID");
           
        var xmlhttp = new XMLHttpRequest();
                var url = "http://localhost/ehealth/TablesManagement.php";
                xmlhttp.onreadystatechange = function () {
                    if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
                        response = xmlhttp.responseText;
                        console.log(response); 
                        JSONResponse = JSON.parse(response);

                        console.log(response);
                        DivContent = "" ;
                        for(jidx=0;jidx<JSONResponse["Result"].length;jidx++){
                            
                           DivContent = DivContent + '<ul>';
                           DivContent = DivContent + '<li>Low Heart Rate: ' + JSONResponse["Result"][jidx]["LowHeartRate"] +'</li>';
                           DivContent = DivContent + '<li>High Heart Rate: ' + JSONResponse["Result"][jidx]["HighHeartRate"] +'</li>';
                           DivContent = DivContent + '<li>Low Temperature Rate: ' + JSONResponse["Result"][jidx]["LowTemperature"] + '</li>';
                           DivContent = DivContent + '<li>High Temperature Rate: ' + JSONResponse["Result"][jidx]["HighTemperature"] + '</li>';
                           DivContent = DivContent + '<li>Low SPO2 Rate: ' + JSONResponse["Result"][jidx]["LowSPO2"] + '</li>';
                           DivContent = DivContent + '<li>High SPO2 Rate: ' + JSONResponse["Result"][jidx]["HighSPO2"] + '</li>';
                           DivContent = DivContent + '</ul>';
                           
                             
                        }
                        DivContent = DivContent +'<br><button onclick="visitPage('+PatientID+')";>Set Rates</button>';

                        
                         $('#Row').empty();
                        $('#Row').append(DivContent);
                    }
                };
                
                xmlhttp.open("POST", url, true);
                xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
                var params = 'Operation=ListAllStandardRates&PatientID='+PatientID;
                xmlhttp.send(params);
    };
     function visitPage(ID){
        window.location='http://localhost/ehealth/EditStandardRates.php?PatientID='+ID;
    }
    </script>  
     <?php
    } else {
            header("Location: http://localhost/ehealth/index.php");
        } ?>
    </body>
    
</html>
