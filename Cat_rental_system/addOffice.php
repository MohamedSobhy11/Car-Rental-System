<?php
session_start();
require('connection.php');
if(isset($_SESSION['email'])){
    $email=$_SESSION['email'];
    $query = "SELECT * FROM customer where email = '$email'";
    $sql = $con->prepare($query);
    $sql->execute();
    $admin = $sql->fetch(PDO::FETCH_ASSOC);
    if($admin['type']!='admin'){
        header("location:notfound.html");
    }
    elseif($admin['type']=='admin'){
        
    }
}
else
header("location:notfound.html");
?>
<!DOCTYPE html>
<html lang="en">
   <head>
   <link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Chivo+Mono:ital,wght@1,200&display=swap" rel="stylesheet">
<link rel="preconnect" href="https://fonts.googleapis.com"><link rel="preconnect" href="https://fonts.gstatic.com" crossorigin><link href="https://fonts.googleapis.com/css2?family=Libre+Baskerville&display=swap" rel="stylesheet">
      <title>ADD OFFICE</title>
 

      <style>
      
      body{
        margin-top: 100px;
        background-image: url('images/car-background.jpg');
        background-size:center;
        background-position:center center;
        
      }
     .title{
        
        margin:auto;
        text-align: center;
        width: 30%;
        font-size:40px;
        font-family: 'Libre Baskerville', serif;
         text-shadow: 1px 1px;
      }   

      
     .FORM{
        color:white;
        display: flex;
        justify-content: center;
        width: 25%;
        background-color:rgba(0,0,10,0.4);
        margin:auto;
        border:4px solid;
        
     }
     .button{
     display: flex;
     justify-content: center;
     
     }
      </style>



   </head>
   <body>
       
         <div class="title">   
        <strong> <p >ADD NEW OFFICE    </p></strong>
         </div>
         <div class ="FORM">
         <form  action="insertOffice.php" method="post" enctype="multipart/form-data">
             
             
            <p>
               <label style="margin-right:31px; " for="city">city:</label>
               <input type="text" name="city" id="city">
            </p>
 
             
            <p>
               <label style="margin-right:3px; " for="location">location:</label>
               <input type="text" name="location" id="location">
            </p>
 
         
          <div  class="button" >
            <input   type="submit" value="ADD" name="upload">
            </div>
         </form>
         </div>
   </body>
</html>