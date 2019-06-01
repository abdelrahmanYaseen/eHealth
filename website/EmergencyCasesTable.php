<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <title>Emergency Case Table</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    
    <script src='https://cdn.rawgit.com/admsev/jquery-play-sound/master/jquery.playSound.js'></script>
  <style>
ul {
    list-style-type: none;
    margin: 0;
    padding: 0;
    overflow: hidden;
    background-color: #333;
}

li {
    float: left;
}

li a {
    display: block;
    color: white;
    text-align: center;
    padding: 8px 16px;
    text-decoration: none;
}

li a:hover:not(.active) {
    background-color: #111;
}

.active {
    background-color: #808080;
}
</style>
</head>
<body>
<?php
        if ((isset($_SESSION['Authorized']))&& ($_SESSION["UserType"] == "Doctor"))
        {
?>
<header id="header">
   <ul id="header">
  <li><a  href="http://localhost/ehealth/DoctorHome.php">Home</a></li>
  <li><a href="http://localhost/ehealth/DoctorPatientTable.php">Patients Table</a></li>
        <li><a href="http://localhost/ehealth/DoctorContacts.php">Chat<span id="serverData" class="badge" style="background: red;"></span></a></li>
        <li><a class="active" href="http://localhost/ehealth/EmergencyCasesTable.php">Emergency Case<span id="EmergencyCase" class="badge" style="background: red;"></span></a></li>
    <li><a href="http://localhost/ehealth/logout.php" style="position: absolute;right: 0px;">logout</a></li>
</ul>
    
    </header>
    
    <div class="page-container">
                <!-- BEGIN CONTENT -->
                <div class="page-content-wrapper">
                    <!-- BEGIN CONTENT BODY -->
                    <!-- BEGIN PAGE HEAD-->
                    <div class="page-head">
                        <div class="container">
                            <!-- BEGIN PAGE TITLE -->
                            
                            <div class="page-content-inner">
                            <div class="row">
                                <div class="col-md-12">
                                    <!-- BEGIN EXAMPLE TABLE PORTLET-->
                                    <div class="portlet light portlet-fit ">
                                        <div class="portlet-title">
                                            <div class="caption">
                                                <i class="icon-settings font-red"></i>
                                                <span class="caption-subject font-red sbold uppercase"><center><h1 style="font-family: Times;font-size: 40px;"><br>Emergency Case Table</h1></center></span>
                                            </div>
                                            
                                        </div>
                                        <div class="portlet-body">
                                            <div class="table-toolbar">
                                                
                                            </div>
                                            <br>
                                            
                                            <div id="message"></div>
                                            
                                            <div style="overflow-x:auto;">
                                            <table class="table table-striped table-hover table-bordered" id="sample_editable_1">
                                                <thead>
                                                    <tr>
                                                        <th> PatientID</th>
                                                        <th> Name  </th>
                                                        <th> Surname </th>
                                                        <th> Description </th>
                                                        <th> Time of Occurrence </th>
                                                        <th> Patient's Location </th>
                                                        <th> Confirm </th>
                                                        
                                                    </tr>
                                                </thead>
                                                <tbody id="EmergencyCaseRow">
                                                    
                                                </tbody>
                                            </table>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- END EXAMPLE TABLE PORTLET-->
                                </div>
                            </div>
                        </div>
                            
                            
                            
                            
                            <!-- END PAGE TITLE -->
                        </div>
                    </div>
                   
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
                            DivContent = DivContent + '<tr>';
                            DivContent = DivContent + '<td> ' + JSONResponse["Result"][jidx]["PatientID"] + '</td>';
                            DivContent = DivContent + '<td> ' + JSONResponse["Result"][jidx]["Name"] + '</td>';
                            DivContent = DivContent + '<td> ' + JSONResponse["Result"][jidx]["Surname"] + '</td>';
                            DivContent = DivContent + '<td> ' + JSONResponse["Result"][jidx]["Description"] + '</td>';
                            DivContent = DivContent + '<td> ' + JSONResponse["Result"][jidx]["TimeOfOccurrence"] + '</td>';
                            DivContent = DivContent + '<td>';
                            DivContent = DivContent + '<a href="http://localhost/ehealth/Map.php?Latitude=' + JSONResponse["Result"][jidx]["Latitude"] + '&Longitude='+JSONResponse["Result"][jidx]["Longitude"] +'">Location</a>';
                            DivContent = DivContent + '</td>';
                            
                            if(parseInt(JSONResponse["Result"][jidx]["Flag"])==0)
                            {
                                DivContent = DivContent + '<td> Confirmed</td>';
                            }
                            else
                            {
                                DivContent = DivContent + '<td>';
                                DivContent = DivContent + '<button type="button" onclick="myFunction(\''+JSONResponse["Result"][jidx]["EmergencyCaseID"]+'\')" id="">Confirm</button>';
                                DivContent = DivContent + '</td>';
                            }
                            
                            DivContent = DivContent + '</tr>';
                              
                             
                        }
                        
                        
                         $('#EmergencyCaseRow').empty();
                        $('#EmergencyCaseRow').append(DivContent);
                    }
                };
                
                xmlhttp.open("POST", url, true);
                xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
                var params = 'Operation=ListAllEmergencyCases';
                xmlhttp.send(params);
    };
      
      function myFunction(RecordID) {
        
            
            var xmlhttp2 = new XMLHttpRequest();
                var url2 = "http://localhost/ehealth/TablesManagement.php";
                xmlhttp2.onreadystatechange = function () {
                    if (xmlhttp2.readyState == 4 && xmlhttp2.status == 200) {
                        response = xmlhttp2.responseText;
                        console.log(response); 
                        JSONResponse2 = JSON.parse(response);

                        console.log(response);
                        
                        
                        if(JSONResponse2["Result"]!="1")
                            {
                                DivContent='<p style="font-family: Times;color:red;font-size: 18px;">Confirmation failed</p>'
                                $('#message').empty();
                                $('#message').append(DivContent);           
                            }
                        
                    }
                };
        
        xmlhttp2.open("POST", url2, true);
                xmlhttp2.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
                var params = 'Operation=ConfirmEmergencyCase&EmergencyCaseID='+ RecordID;
            console.log(params);
                xmlhttp2.send(params);
                
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
                            DivContent = DivContent + '<tr>';
                            DivContent = DivContent + '<td> ' + JSONResponse["Result"][jidx]["PatientID"] + '</td>';
                            DivContent = DivContent + '<td> ' + JSONResponse["Result"][jidx]["Name"] + '</td>';
                            DivContent = DivContent + '<td> ' + JSONResponse["Result"][jidx]["Surname"] + '</td>';
                            DivContent = DivContent + '<td> ' + JSONResponse["Result"][jidx]["Description"] + '</td>';
                            DivContent = DivContent + '<td> ' + JSONResponse["Result"][jidx]["TimeOfOccurrence"] + '</td>';
                            DivContent = DivContent + '<td>';
                            DivContent = DivContent + '<a href="http://localhost/ehealth/Map.php?Latitude=' + JSONResponse["Result"][jidx]["Latitude"] + '&Longitude='+JSONResponse["Result"][jidx]["Longitude"] +'">Location</a>';
                            DivContent = DivContent + '</td>';
                            
                            if(parseInt(JSONResponse["Result"][jidx]["Flag"])==0)
                            {
                                DivContent = DivContent + '<td> Confirmed</td>';
                            }
                            else
                            {
                                DivContent = DivContent + '<td>';
                                DivContent = DivContent + '<button type="button" onclick="myFunction(\''+JSONResponse["Result"][jidx]["EmergencyCaseID"]+'\')" id="">Confirm</button>';
                                DivContent = DivContent + '</td>';
                            }
                            
                            DivContent = DivContent + '</tr>';
                              
                             
                        }
                        
                        
                         $('#EmergencyCaseRow').empty();
                        $('#EmergencyCaseRow').append(DivContent);
                    }
                };
                
                xmlhttp.open("POST", url, true);
                xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
                var params = 'Operation=ListAllEmergencyCases';
                xmlhttp.send(params);
        
          
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
    } 
    
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
                updateTable();
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
            
            function updateTable(){
          
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
                            DivContent = DivContent + '<tr>';
                            DivContent = DivContent + '<td> ' + JSONResponse["Result"][jidx]["PatientID"] + '</td>';
                            DivContent = DivContent + '<td> ' + JSONResponse["Result"][jidx]["Name"] + '</td>';
                            DivContent = DivContent + '<td> ' + JSONResponse["Result"][jidx]["Surname"] + '</td>';
                            DivContent = DivContent + '<td> ' + JSONResponse["Result"][jidx]["Description"] + '</td>';
                            DivContent = DivContent + '<td> ' + JSONResponse["Result"][jidx]["TimeOfOccurrence"] + '</td>';
                            DivContent = DivContent + '<td>';
                            DivContent = DivContent + '<a href="http://localhost/ehealth/Map.php?Latitude=' + JSONResponse["Result"][jidx]["Latitude"] + '&Longitude='+JSONResponse["Result"][jidx]["Longitude"] +'">Location</a>';
                            DivContent = DivContent + '</td>';
                            
                            if(parseInt(JSONResponse["Result"][jidx]["Flag"])==0)
                            {
                                DivContent = DivContent + '<td> Confirmed</td>';
                            }
                            else
                            {
                                DivContent = DivContent + '<td>';
                                DivContent = DivContent + '<button type="button" onclick="myFunction(\''+JSONResponse["Result"][jidx]["EmergencyCaseID"]+'\')" id="">Confirm</button>';
                                DivContent = DivContent + '</td>';
                            }
                            
                            DivContent = DivContent + '</tr>';
                              
                             
                        }
                        
                        
                         $('#EmergencyCaseRow').empty();
                        $('#EmergencyCaseRow').append(DivContent);
                    }
                };
                
                xmlhttp.open("POST", url, true);
                xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
                var params = 'Operation=ListAllEmergencyCases';
                xmlhttp.send(params);
      }
            
    </script>
    <?php
    } else {
            header("Location: http://localhost/ehealth/index.php");
        } ?>
    </body>
</html>
