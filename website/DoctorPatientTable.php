<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <title>Patient Table</title>
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
        if ((isset($_SESSION['Authorized']))&& ($_SESSION["UserType"] == "Doctor"))
        {
?>
<header>
    <ul id="header" >
  <li><a href="http://localhost/ehealth/DoctorHome.php">Home</a></li>
  <li><a class="active" href="http://localhost/ehealth/DoctorPatientTable.php">Patients Table</a></li>
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
                                                <span class="caption-subject font-red sbold uppercase"><center><h1 style="font-family: Times;font-size: 50px;"><br>Patient Table</h1></center></span>
                                            </div>
                                            
                                        </div>
                                        <div class="portlet-body">
                                            
                                            <br>
                                            <div style="overflow-x:auto;">
                                            <table class="table table-striped table-hover table-bordered" id="sample_editable_1">
                                                
                                                <thead>
                                                    <tr>
                                                        <th> PatientID  </th>
                                                        <th> Name  </th>
                                                        <th> Surname </th>   
                                                        <th> Age </th>
                                                        <th> View Sensor Reading </th>
                                                        <th> View Standard Rates </th>
                                                    </tr>
                                                </thead>
                                                <tbody id="patientRow">
                                                    
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
                            
                            var str = JSONResponse["Result"][jidx]["BirthDate"];
                            var date = new Date(str);
                            var day = date.getDate(); 
                            var month = date.getMonth(); 
                            var year = date.getFullYear();
                            
                            var str2 = JSONResponse["Result"][jidx]["CurrentDate"];
                            var date2 = new Date(str2);
                            var day2 = date2.getDate(); 
                            var month2 = date2.getMonth(); 
                            var year2 = date2.getFullYear();
                            
                            var calculateYear = date2.getFullYear();
                            var calculateMonth = date2.getMonth();
                            var calculateDay =date2.getDate();

                            var birthYear = date.getFullYear();
                            var birthMonth = date.getMonth(); 
                            var birthDay = date.getDate(); 

                            var age = calculateYear - birthYear;
                            var ageMonth = calculateMonth - birthMonth;
                            var ageDay = calculateDay - birthDay;

                            if (ageMonth < 0 || (ageMonth == 0 && ageDay < 0)) {
                                age = parseInt(age) - 1;
                            }
                            
                            DivContent = DivContent + '<tr>';
                            DivContent = DivContent + '<td> ' + JSONResponse["Result"][jidx]["PatientID"] + '</td>';
                            DivContent = DivContent + '<td> ' + JSONResponse["Result"][jidx]["Name"] + '</td>';
                            DivContent = DivContent + '<td> ' + JSONResponse["Result"][jidx]["Surname"] + '</td>';
                            DivContent = DivContent + '<td> ' + age + '</td>';
                            DivContent = DivContent + '<td>';
                            DivContent = DivContent + '<a href="http://localhost/ehealth/DPSensorReadingTable.php?PatientID=' + JSONResponse["Result"][jidx]["PatientID"] +'">View Sensor Reading</a>';
                            DivContent = DivContent + '</td>';
                            DivContent = DivContent + '<td>';
                            DivContent = DivContent + '<a href="http://localhost/ehealth/StandardRates.php?PatientID=' + JSONResponse["Result"][jidx]["PatientID"] +'">View Standard Rates</a>';
                            DivContent = DivContent + '</td>';
                            DivContent = DivContent + '</tr>';
                              
                             
                        }
                        
                        
                         $('#patientRow').empty();
                        $('#patientRow').append(DivContent);
                    }
                };
                
                xmlhttp.open("POST", url, true);
                xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
                var params = 'Operation=ListAllDoctorPatients';
                xmlhttp.send(params);
    };
        
            function calculate_age(dob) { 
                var diff_ms = Date.now() - dob.getTime();
                var age_dt = new Date(diff_ms); 
  
                return Math.abs(age_dt.getUTCFullYear() - 1970);
            }
    </script>
     <?php
    } else {
            header("Location: http://localhost/ehealth/index.php");
        } ?>
    </body>
</html>
