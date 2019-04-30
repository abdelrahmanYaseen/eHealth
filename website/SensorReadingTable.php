<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <title>Sensor Reading Table</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
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
        if ((isset($_SESSION['Authorized']))&& ($_SESSION["UserType"] == "Patient"))
        {
?>
<header id="header">
   <ul id="header">
  <li><a href="http://localhost/ehealth/PatientHome.php">Home</a></li>
  <li><a class="active" href="http://localhost/ehealth/SensorReadingTable.php">Sensor Reading</a></li>
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
                                                <span class="caption-subject font-red sbold uppercase"><center><h1 style="font-family: Times;font-size: 50px;"><br>Sensor Reading Table</h1></center></span>
                                            </div>
                                            
                                        </div>
                                        <div class="portlet-body">
                                            <div class="table-toolbar">
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="btn-group">
                                                            <button id="sample_editable_1_new" onclick="window.location.href = 'http://localhost/ehealth/LineChart.php';" class="btn green" style="background-color:gray;color: white;"> View Line Chart
                                                                <i class="fa fa-plus"></i>
                                                            </button>
                                                        </div>
                                                    </div>
                                                    
                                                </div>
                                            </div>
                                            <br>
                                            <div style="overflow-x:auto;">
                                            <table class="table table-striped table-hover table-bordered" id="sample_editable_1">
                                                <thead>
                                                    <tr>
                                                        <th> SensorReadingID</th>
                                                        <th> HeartRate  </th>
                                                        <th> Temperature </th>
                                                        <th> SPO2 </th>
                                                        <th> ReadingTime </th>
                                                    </tr>
                                                </thead>
                                                <tbody id="readingRow">
                                                    
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
          
        var parsedUrl = new URL(window.location.href);
            
        
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
                            DivContent = DivContent + '<td> ' + JSONResponse["Result"][jidx]["SensorReadingID"] + '</td>';
                            DivContent = DivContent + '<td> ' + JSONResponse["Result"][jidx]["HeartRate"] + '</td>';
                            DivContent = DivContent + '<td> ' + JSONResponse["Result"][jidx]["Temperature"] + '</td>';
                            DivContent = DivContent + '<td> ' + JSONResponse["Result"][jidx]["SPO2"] + '</td>';
                            DivContent = DivContent + '<td> ' + JSONResponse["Result"][jidx]["ReadingTime"] + '</td>';
                            DivContent = DivContent + '</tr>';
                              
                             
                        }
                        
                        
                         $('#readingRow').empty();
                        $('#readingRow').append(DivContent);
                    }
                };
                
                xmlhttp.open("POST", url, true);
                xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
                var params = 'Operation=ListAllSensorReadings';
                xmlhttp.send(params);
    };
        
        
    </script>
    <?php
    } else {
            header("Location: http://localhost/ehealth/index.php");
        } ?>
    </body>
</html>
