<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <title>Standard Rates Form</title>
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
   <ul id="header">
  <li><a href="http://localhost/ehealth/DoctorHome.php">Home</a></li>
  <li><a class="active" href="http://localhost/ehealth/DoctorPatientTable.php">Patients Table</a></li>
    <li><a href="http://localhost/ehealth/logout.php" style="position: absolute;right: 0px;">logout</a></li>
</ul>
    
    
    </header>
    
    
                <div class="container">
            <h1 class="form-heading col-xs-offset-1 " style="font-family: Times;font-size: 50px;">Standard Rates Form</h1>
                    <br>
                    <div class="row">
                        <div class="col-md-4 col-xs-offset-1 col-xs-9">
                <div class="form-group row">
                  <label for="example-number-input" class="col-2 col-form-label">LowHeartRate</label>
                  <div class="col-10">
                    <input class="form-control" type="number" id="LowHeartRate">
                  </div>
                </div>
                
                <div class="form-group row">
                  <label for="example-number-input" class="col-2 col-form-label">HighHeartRate</label>
                  <div class="col-10">
                    <input class="form-control" type="number" id="HighHeartRate">
                  </div>
                </div>
            
            <div class="form-group row">
              <label for="example-number-input" class="col-2 col-form-label">LowTemperature</label>
              <div class="col-10">
                <input class="form-control" type="number" id="LowTemperature">
              </div>
            </div>
                            
            <div class="form-group row">
                  <label for="example-number-input" class="col-2 col-form-label">HighTemperature</label>
                  <div class="col-10">
                    <input class="form-control" type="number" id="HighTemperature">
                  </div>
                </div>
            
            <div class="form-group row">
                  <label for="example-number-input" class="col-2 col-form-label">LowSPO2</label>
                  <div class="col-10">
                    <input class="form-control" type="number" id="LowSPO2">
                  </div>
                </div>
                
            <div class="form-group row">
                  <label for="example-number-input" class="col-2 col-form-label">HighSPO2</label>
                  <div class="col-10">
                    <input class="form-control" type="number" id="HighSPO2">
                  </div>
                </div>
                                         
                            
            <div class="form-actions">
                  <div class="row">
                      <div class="col-md-9">
                          <br>
                         <button type="button" id="button1">Submit</button>
                      </div>
                  </div>
            </div>
                            <br>
            </div>
        </div>
    </div>
    
    
        <script type="text/javascript">
            
        window.onload = function () {
        
        var parsedUrl = new URL(window.location.href);
            Operation = parsedUrl.searchParams.get("Operation");
            PatientID=parsedUrl.searchParams.get("PatientID");
        
    
         
            
            var xmlhttp4 = new XMLHttpRequest();
                var url4 = "http://localhost/ehealth/TablesManagement.php";
                xmlhttp4.onreadystatechange = function () {
                    if (xmlhttp4.readyState == 4 && xmlhttp4.status == 200) {
                        response = xmlhttp4.responseText;
                        console.log(response); 
                        JSONResponse4 = JSON.parse(response);
                        
                        console.log(Operation);
                      
                       
                        
                        $('#LowHeartRate').val(JSONResponse4["Result"][0]["LowHeartRate"]); 
                        $('#HighHeartRate').val(JSONResponse4["Result"][0]["HighHeartRate"]);
                        $('#LowTemperature').val(JSONResponse4["Result"][0]["LowTemperature"]);
                        $('#HighTemperature').val(JSONResponse4["Result"][0]["HighTemperature"]);
                        $('#LowSPO2').val(JSONResponse4["Result"][0]["LowSPO2"]);
                        $('#HighSPO2').val(JSONResponse4["Result"][0]["HighSPO2"]);
                    }
                };
            
                xmlhttp4.open("POST", url4, true);
                xmlhttp4.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
                var params = 'Operation=ListAllStandardRates&PatientID='+PatientID;
                xmlhttp4.send(params);
                    
            
           
        
        
    };                 
            
    
    $('#button1').click(function(){
        var parsedUrl = new URL(window.location.href);
            Operation = parsedUrl.searchParams.get("Operation");
            PatientID=parsedUrl.searchParams.get("PatientID");
      
         var xmlhttp3 = new XMLHttpRequest();
                var url3 = "http://localhost/ehealth/TablesManagement.php";
                xmlhttp3.onreadystatechange = function () {
                    if (xmlhttp3.readyState == 4 && xmlhttp3.status == 200) {
                        response = xmlhttp3.responseText;
                        console.log(response); 
                        JSONResponse3 = JSON.parse(response);

                        console.log(response);
                        DivContent3 = "" ;
                        
                        if(JSONResponse3["Result"]=="1")
                            {
                               alert("Successful"); 
                            }
                        else{
                            alert("Failed");
                        }
                        
                       
                    }
                };
        
        
            
                xmlhttp3.open("POST", url3, true);
                xmlhttp3.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
                var params = 'Operation=EditStandardRates&PatientID='+PatientID+'&LowHeartRate='+$('#LowHeartRate').val()+'&HighHeartRate='+$('#HighHeartRate').val()+'&LowTemperature='+$('#LowTemperature').val()+ '&HighTemperature='+$('#HighTemperature').val()+ '&LowSPO2='+$('#LowSPO2').val()+ '&HighSPO2='+$('#HighSPO2').val();
                xmlhttp3.send(params);
            
        
    });
    </script>
     <?php
    } else {
            header("Location: http://localhost/ehealth/index.php");
        } ?>
    </body>
</html>
