<?php
session_start();
?>
<html>  
    <head>  
        <title>Chat Application</title>  
  <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
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
    <header>
    <ul id="header">
  <li><a  href="http://localhost/ehealth/PatientHome.php">Home</a></li>
  <li><a href="http://localhost/ehealth/SensorReadingTable.php">Sensor Reading</a></li>
        <li><a class="active" href="http://localhost/ehealth/contacts.php">Chat</a></li>
   <li><a href="http://localhost/ehealth/logout.php" style="position: absolute;right: 0px;">logout</a></li>
</ul>
    
    
    </header>
    <body>
        <?php
        if ((isset($_SESSION['Authorized']))&& ($_SESSION["UserType"] == "Patient"))
        {
?>
        <div class="container">
   <br />
   <br />
   <br />     
   <h1 style="font-family: Times;font-size: 40px;" align="center">Chat Application</h1><br />
   
   <br />
   <br />
   
   <div class="table-responsive">
    <div id="user_details"></div>
    <div id="user_model_details"></div>
   </div>
  </div>
        <?php
    } else {
            header("Location: http://localhost/ehealth/index.php");
        } ?>
    </body>  
</html>  




<script>  
$(document).ready(function(){

 fetch_user();

 setInterval(function(){
  update_last_activity();
  fetch_user();
  update_chat_history_data();
 }, 1000);

 function fetch_user()
 {
     var xmlhttp = new XMLHttpRequest();
                var url = "fetch_user.php";
                xmlhttp.onreadystatechange = function () {
                    if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
                        response = xmlhttp.responseText;
                        console.log(response); 
                        JSONResponse = JSON.parse(response);

                        console.log(response);
                        DivContent = '<table class="table table-bordered table-striped"><tr><td>Username</td><td>Status</td><td>Action</td></tr>' ;
                        for(jidx=0;jidx<JSONResponse["Result"].length;jidx++){
                            DivContent = DivContent + '<tr>';
                            DivContent = DivContent + '<td> ' + JSONResponse["Result"][jidx]["Name"]+' '+JSONResponse["Result"][jidx]["Surname"]+' ';
                            if(JSONResponse["Result"][jidx]["Count"]>0)
                                {
                            DivContent = DivContent + '<span class="label label-success">'+JSONResponse["Result"][jidx]["Count"]+'</span>';
                                }
                            DivContent = DivContent  + '</td>';
                            var str1 = "Online";
                            var n = str1.localeCompare(JSONResponse["Result"][jidx]["Status"] );
                            if(n==0)
                                {
                                    DivContent = DivContent + '<td> <span class="label label-success">Online</span></td>';
                                }
                            else{
                                DivContent = DivContent + '<td> <span class="label label-danger">Offline</span></td>';
                            }
                       DivContent = DivContent +  '<td><button type="button" class="btn btn-info btn-xs start_chat" data-touserid="'+JSONResponse["Result"][jidx]['UserID']+'" data-tousername="'+JSONResponse["Result"][jidx]['Name']+' '+JSONResponse["Result"][jidx]['Surname']+'" value="'+JSONResponse["Result"][jidx]['Name']+' '+JSONResponse["Result"][jidx]['Surname']+'">Start Chat</button></td>';                        
                   //         DivContent = DivContent + '<td><button onclick="myFunction()" >Start Chat</button></td>';
                            DivContent = DivContent + '</tr>';
                              
                             
                        }
                        DivContent = DivContent +'</table>';
                        
                         $('#user_details').empty();
                        $('#user_details').append(DivContent);
                    }
                };
                
                xmlhttp.open("POST", url, true);
                xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
                xmlhttp.send();
     
 }

 function update_last_activity()
 {
  $.ajax({
   url:"update_last_activity.php",
   success:function()
   {

   }
  })
 }

function fetch_user_chat_history(to_user_id,to_user_name)
 {
  $.ajax({
   url:"fetch_user_chat_history.php",
   method:"POST",
   data:{to_user_id:to_user_id,to_user_name:to_user_name},
   success:function(data){
    $('#chat_history_'+to_user_id).html(data);
   }
  })
 }

 function update_chat_history_data()
 {
  $('.chat_history').each(function(){
   var to_user_id = $(this).data('touserid'); 
   var to_user_name = $(this).data('tousername');      
   fetch_user_chat_history(to_user_id,to_user_name);
  });
 }

 $(document).on('click', '.ui-button-icon', function(){
  $('.user_dialog').dialog('destroy').remove();
 });    
/*
 function make_chat_dialog_box(to_user_id, to_user_name)
 {
  var modal_content = '<div id="user_dialog_'+to_user_id+'" class="user_dialog" title="You have chat with '+to_user_name+'">';
  modal_content += '<div style="height:400px; border:1px solid #ccc; overflow-y: scroll; margin-bottom:24px; padding:16px;" class="chat_history" data-touserid="'+to_user_id+'" id="chat_history_'+to_user_id+'">';
  modal_content += '</div>';
  modal_content += '<div class="form-group">';
  modal_content += '<textarea name="chat_message_'+to_user_id+'" id="chat_message_'+to_user_id+'" class="form-control"></textarea>';
  modal_content += '</div><div class="form-group" align="right">';
  modal_content+= '<button type="button" name="send_chat" id="'+to_user_id+'" class="btn btn-info send_chat">Send</button></div></div>';
  $('#user_model_details').html(modal_content);
 }
    

    
 $(document).on('click', '.start_chat', function(){
  var to_user_id = $(this).data('touserid');
  var to_user_name = $(this).data('tousername');
  make_chat_dialog_box(to_user_id, to_user_name);
  $("#user_dialog_"+to_user_id).dialog({
   autoOpen:false,
   width:400
  });
  $('#user_dialog_'+to_user_id).dialog('open');
 });
 */
 
});

    function make_chat_dialog_box(to_user_id, to_user_name)
 {
  var modal_content = '<div id="user_dialog_'+to_user_id+'" class="user_dialog" title="You have chat with '+to_user_name+'">';
  modal_content += '<div style="height:400px; border:1px solid #ccc; overflow-y: scroll; margin-bottom:24px; padding:16px;" class="chat_history" data-touserid="'+to_user_id+'" data-tousername="'+to_user_name+'" id="chat_history_'+to_user_id+'">';
  modal_content += '</div>';
  modal_content += '<div class="form-group">';
  modal_content += '<textarea name="chat_message_'+to_user_id+'" id="chat_message_'+to_user_id+'" class="form-control"></textarea>';
  modal_content += '</div><div class="form-group" align="right">';
     modal_content += '<input type="hidden" id="to_user" value="'+to_user_name+'">';
  modal_content+= '<button type="button" name="send_chat" id="'+to_user_id+'" class="btn btn-info send_chat">Send</button></div></div>';
  $('#user_model_details').html(modal_content);
 }
    
    $(document).on('click', '.start_chat', function(){
  var to_user_id = $(this).data('touserid');
  var to_user_name = $(this).attr('value');
  make_chat_dialog_box(to_user_id, to_user_name);
  $("#user_dialog_"+to_user_id).dialog({
   autoOpen:false,
   width:400
  });
  $('#user_dialog_'+to_user_id).dialog('open');
 });
    
    $(document).on('click', '.send_chat', function(){
  var to_user_id = $(this).attr('id');
  var to_user_name = $('#to_user').attr('value');        
  var chat_message = $('#chat_message_'+to_user_id).val();
  $.ajax({
   url:"insert_chat.php",
   method:"POST",
   data:{to_user_id:to_user_id, chat_message:chat_message, to_user_name:to_user_name},
   success:function(data)
   {
    $('#chat_message_'+to_user_id).val('');
    $('#chat_history_'+to_user_id).html(data);
   }
  })
 });
    
    
    $(document).on('click', '.remove_chat', function(){
  var chat_message_id = $(this).attr('id');
  if(confirm("Are you sure you want to remove this chat?"))
  {
   $.ajax({
    success:function()
    {
        var xmlhttp2 = new XMLHttpRequest();
                var url2 = "http://localhost/ehealth/deleteMessage.php";
                xmlhttp2.onreadystatechange = function () {
                    if (xmlhttp2.readyState == 4 && xmlhttp2.status == 200) {
                        response = xmlhttp2.responseText;
                        console.log(response); 
                        JSONResponse2 = JSON.parse(response);

                        console.log(response);
                        
                        
                    }
                };
        
        xmlhttp2.open("POST", url2, true);
                xmlhttp2.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
                var params = 'chat_message_id='+ chat_message_id;
            console.log(params);
                xmlhttp2.send(params);
        
    }
   })
  }
 });
    
  /*  function myFunction() {
  var to_user_id ="1";
  var to_user_name = "batoul";
  make_chat_dialog_box(to_user_id, to_user_name);
  $("#user_dialog_"+to_user_id).dialog({
   autoOpen:false,
   width:400
  });
  $('#user_dialog_'+to_user_id).dialog('open');
}*/
</script>
