<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <title>Line Chart</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    
    
<script src='https://cdn.rawgit.com/admsev/jquery-play-sound/master/jquery.playSound.js'></script>
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
   
      
      .chart-container {
        width: 640px;
        height: auto;
      }
   
      
</style>
</head>
<body>
<?php
        if ((isset($_SESSION['Authorized']))&& ($_SESSION["UserType"] == "Patient"))
        {
?>
<header>
    <ul id="header">
  <li><a href="http://localhost/ehealth/PatientHome.php">Home</a></li>
  <li><a href="http://localhost/ehealth/SensorReadingTable.php">Sensor Reading</a></li>
<li><a href="http://localhost/ehealth/contacts.php">Chat<span id="serverData" class="badge" style="background: red;"></span></a></li> 
   <li><a href="http://localhost/ehealth/logout.php" style="position: absolute;right: 0px;">logout</a></li>
</ul>
    
    
    </header>
    <div class="container">
    <br>
    <br>
    <br>
    <br>

        <div class="row">
            <div class="col-md-8 col-md-offset-2 col-xs-12">

                <div style="overflow-x:auto;">
                <div class="chart-container">
                    <canvas id="mycanvas"></canvas>
                </div>
                </div>
    
                <div class="row" id="mean">
                </div>
    
                
            </div></div>
    </div>
   <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.5.0/Chart.min.js"></script>
    <script>

    
    $(document).ready(function(){
  $.ajax({
    url : "http://localhost/ehealth/TablesManagement.php?Operation=ListAllSensorReadings2",
    type : "GET",
    success : function(data){
      console.log(data);
JSONResponse = JSON.parse(data);
      var measurementdate = [];
      var rates = [];
        var counter=0;
        
        if(JSONResponse["Result"].length>=50) {
          for(jidx=(JSONResponse["Result"].length-50);jidx<(JSONResponse["Result"].length);jidx++) {
              var str = JSONResponse["Result"][jidx]["ReadingTime"];
                                var date = new Date(str);
                                var hour = date.getHours(); 
                                var minutes = date.getMinutes(); 
                                var seconds = date.getSeconds();


            measurementdate.push(hour+":"+minutes+":"+seconds);
            rates.push(JSONResponse["Result"][jidx]["HeartRate"]);

              counter=counter+1;
              if(counter==50)
                  {
                      break;
                  }

          }
        }
        else{
            for(jidx=0;jidx<(JSONResponse["Result"].length);jidx++){
     //   measurementdate.push(JSONResponse["Result"][jidx]["ReadingTime"]);
          var str = JSONResponse["Result"][jidx]["ReadingTime"];
                            var date = new Date(str);
                            var hour = date.getHours(); 
                            var minutes = date.getMinutes(); 
                            var seconds = date.getSeconds();
        	
        measurementdate.push(hour+":"+minutes+":"+seconds);
        rates.push(JSONResponse["Result"][jidx]["HeartRate"]);
          counter=counter+1;
          if(counter==50)
              {
                  break;
              }
      }
        }
        
        console.log(measurementdate);
        console.log(rates);
      var chartdata = {
        labels: measurementdate,
        datasets: [
          {
            label: "ECG",
            fill: false,
            lineTension: 0.1,
            backgroundColor: "rgba(211, 72, 54, 0.75)",
            borderColor: "rgba(211, 72, 54, 1)",
            pointHoverBackgroundColor: "rgba(211, 72, 54, 1)",
            pointHoverBorderColor: "rgba(211, 72, 54, 1)",
            data: rates
          }
        ]
      };
      var ctx = $("#mycanvas");
      var LineGraph = new Chart(ctx, {
        type: 'line',
        data: chartdata
      });
    },
    error : function(data) {

    }
  });
});
        
        window.onload = function () {
          
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
                        var mean=0.0;
                        var standardDeviation=0.0;
                        
                        for(jidx=0;jidx<JSONResponse["Result"].length;jidx++){
                            mean=mean+parseFloat(JSONResponse["Result"][jidx]["HeartRate"]);
                        }
                        mean=mean/JSONResponse["Result"].length;
                        for(jidx=0;jidx<JSONResponse["Result"].length;jidx++){
                            standardDeviation=standardDeviation+Math.pow(parseFloat(JSONResponse["Result"][jidx]["HeartRate"])-mean,2);
                        }
                        standardDeviation=standardDeviation/(JSONResponse["Result"].length-1);
                        standardDeviation=Math.sqrt(standardDeviation);
                        
                        DivContent=DivContent+"<br><p style='margin-left:2.5em'> </p>";
                        //DivContent=DivContent+"<br><p style='margin-left:2.5em'>Mean: "+mean.toFixed(2);
                        //DivContent=DivContent+"<br>     Standard deviation: "+standardDeviation.toFixed(2)+"</p>";
                         $('#mean').empty();
                        $('#mean').append(DivContent);
                    }
                };
                
                xmlhttp.open("POST", url, true);
                xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
                var params = 'Operation=ListAllSensorReadings';
                xmlhttp.send(params);
    };
        
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
    
    var eSource = new EventSource("send_sse_patient.php");
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
