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
      <title>ADD PLATE</title>
 

      <style>
      
      body{
        background-color: red;
        background-image: url('images/car-background.jpg');
        background-size:center;
        background-position:center center;
        
      }
     .title{
        color: red;
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
        <strong> <p >ADD NEW PLATE    </p></strong>
         </div>
         <div class ="FORM">
         <form  action="insertPlate.php" method="post" enctype="multipart/form-data">
             
            <p>
               <label style="margin-right:5px; " for="plate_number">Plate_numbar:</label>
               <input type="text" name="plate_number" id="plate_number">
            </p>
 
             
            <p>
               <label style="margin-right:7px; " for="starting_plate">starting_plate:</label>
               <input type="text" name="starting_plate" id="starting_plate">
            </p>
 
             
            <p>
               <label style="margin-right:3px; " for="expiring_plate">expiring_plate:</label>
               <input type="text" name="expiring_plate" id="expiring_plate">
            </p>
 
         
          <div  class="button" >
            <input   type="submit" value="ADD" name="upload">
            </div>
         </form>
         </div>
   </body>
</html>