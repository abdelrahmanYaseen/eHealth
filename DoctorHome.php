<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <title>Doctor Home Page</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    
    <script src='https://code.jquery.com/jquery-2.2.0.min.js'></script>
<script src='https://cdn.rawgit.com/admsev/jquery-play-sound/master/jquery.playSound.js'></script>
    
  <style>
      
    body#Home{ background-image:url("http://localhost/ehealth/computer-1149148_1920.jpg"); background-repeat:no-repeat; background-position:center; background-size:cover;background-attachment: fixed;}  
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
<body id="Home">
<?php
        if ((isset($_SESSION['Authorized']))&& ($_SESSION["UserType"] == "Doctor"))
        {
?>
<header>
    <ul id="header">
  <li><a class="active" href="http://localhost/ehealth/DoctorHome.php">Home</a></li>
  <li><a href="http://localhost/ehealth/DoctorPatientTable.php">Patients Table</a></li>
        <li><a href="http://localhost/ehealth/DoctorContacts.php">Chat<span id="serverData" class="badge" style="background: red;"></span></a></li>
        <li><a href="http://localhost/ehealth/EmergencyCasesTable.php">Emergency Case<span id="EmergencyCase" class="badge" style="background: red;"></span></a></li>
    <li><a href="http://localhost/ehealth/logout.php" style="position: absolute;right: 0px;">logout</a></li>
</ul>
    
    
    </header>
    <div class="container">
    <br>
    <br>

<div class="main-div">
   
   <h2 style="font-family: Times;"></h2>

   <ul style="font-size: 18px;background-color: white;border-radius: 8px;width: 250px; padding: 25px 25px 25px 25px;opacity:0.9;">
       <li><a  href="http://localhost/ehealth/DoctorPatientTable.php">Patients Table</a></li>
       <li><a href="http://localhost/ehealth/DoctorContacts.php">Chat with Patients</a></li>
       <li><a href="http://localhost/ehealth/EmergencyCasesTable.php">Emergency Cases</a></li>
    </ul>

    </div>

      
    
    </div>
    <script type="text/javascript">
        
        window.onload = function () {     
            
            var xmlhttp6 = new XMLHttpRequest();
                var url6 = "http://localhost/ehealth/TablesManagement.php";
                xmlhttp6.onreadystatechange = function () {
                    if (xmlhttp6.readyState == 4 && xmlhttp6.status == 200) {
                        response6 = xmlhttp6.responseText;
                        JSONResponse6 = JSON.parse(response6);
                        
                        console.log(JSONResponse6);          
                        
                        if(parseInt(JSONResponse6["NumberOfEmergencyCases"])!=0)
                        {
                            document.getElementById("EmergencyCase").innerHTML = JSONResponse6["NumberOfEmergencyCases"];
                        }
                        
                    }
                };
            
                xmlhttp6.open("POST", url6, true);
                xmlhttp6.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
                var params = 'Operation=ListNumberOfEmergencyCases';
                xmlhttp6.send(params);
            
    
            
            var xmlhttp5 = new XMLHttpRequest();
                var url5 = "http://localhost/ehealth/TablesManagement.php";
                xmlhttp5.onreadystatechange = function () {
                    if (xmlhttp5.readyState == 4 && xmlhttp5.status == 200) {
                        response5 = xmlhttp5.responseText;
                
                        JSONResponse5 = JSON.parse(response5);
                        
                        console.log(JSONResponse5);          
                        
                        if(parseInt(JSONResponse5["NumberOfMessages"])!=0)
                        {
                            document.getElementById("serverData").innerHTML = JSONResponse5["NumberOfMessages"];
                        }
                        
                    }
                };
            
                xmlhttp5.open("POST", url5, true);
                xmlhttp5.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
                var params = 'Operation=ListNumberOfMessages';
                xmlhttp5.send(params);
                    
            
           
        
        
    }; 
        
        
        function notifyMe1() {
              if (!("Notification" in window)) {
                alert("This browser does not support desktop notification");
              }
              else if (Notification.permission === "granted") {
                    var vibrate = Notification.vibrate;
                            var options = {
                                    body: "you have emergency case",
                        icon: "icon.png",
                        dir : "ltr",
                        requireInteraction:true
                                 };
                              var notification = new Notification("Emergency case",options);
              }
              else if (Notification.permission !== 'denied') {
                Notification.requestPermission(function (permission) {
                  if (!('permission' in Notification)) {
                    Notification.permission = permission;
                  }

                  if (permission === "granted") {
                    var options = {
                          body: "you have emergency case",
                        icon: "icon.png",
                        dir : "ltr",
                        requireInteraction:true
                      };
                    var notification = new Notification("Emergency case",options);
                  }
                });
              }
}
        function notifyMe() {
              if (!("Notification" in window)) {
                alert("This browser does not support desktop notification");
              }
              else if (Notification.permission === "granted") {
                    var vibrate = Notification.vibrate;
                            var options = {
                                    body: "you have new messages to read",
                                    icon: "messageIcon.png",
                                    dir : "ltr",
                                    requireInteraction:true
                                 };
                              var notification = new Notification("New Messages",options);
              }
              else if (Notification.permission !== 'denied') {
                Notification.requestPermission(function (permission) {
                  if (!('permission' in Notification)) {
                    Notification.permission = permission;
                  }

                  if (permission === "granted") {
                    var options = {
                          body: "you have new messages to read",
                          icon: "messageIcon.png",
                          dir : "ltr",
                          requireInteraction:true
                      };
                    var notification = new Notification("New Messages",options);
                  }
                });
              }
}
    
        if(typeof(EventSource)!=="undefined") {
	//create an object, passing it the name and location of the server side script
	

            
            
    var eSource2 = new EventSource("sendEmergencyCase.php");
	//detect message receipt

	eSource2.onmessage = function(event2) {
		//write the received data to the page
        console.log(event2.data);
        JSONResponse2 = JSON.parse(event2.data);
        console.log(parseInt(JSONResponse2["flag"]));
        
        if(parseInt(JSONResponse2["flag"])==1)
            {
                notifyMe1();
                $.playSound("tone.mp3")
            }
        
		document.getElementById("EmergencyCase").innerHTML = JSONResponse2["data"];
                
	};  
    
    var eSource = new EventSource("send_sse.php");
	//detect message receipt
    eSource.onmessage = function(event) {
		//write the received data to the page
        console.log(event.data);
        JSONResponse = JSON.parse(event.data);
        console.log(parseInt(JSONResponse["flag"]));
        
        if(parseInt(JSONResponse["flag"])==1)
            {
               notifyMe();
                $.playSound("definite.mp3")
            }
        
		document.getElementById("serverData").innerHTML = JSONResponse["data"];
        
        
	};
}

        
    </script>
    
    <?php
    } else {
            header("Location: http://localhost/ehealth/index.php");
        } ?>
    </body>
</html>
