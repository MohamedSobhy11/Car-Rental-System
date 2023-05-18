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
<?php
require_once 'connection.php';
$query_string = $_SERVER['QUERY_STRING'];
$data = explode('=', $query_string);
$query = "SELECT * FROM car where plate_number = '$data[1]'";
$sql = $con->prepare($query);
$sql->execute();
$car = $sql->fetch(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="en">
   <head>
   <link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Chivo+Mono:ital,wght@1,200&display=swap" rel="stylesheet">
<link rel="preconnect" href="https://fonts.googleapis.com"><link rel="preconnect" href="https://fonts.gstatic.com" crossorigin><link href="https://fonts.googleapis.com/css2?family=Libre+Baskerville&display=swap" rel="stylesheet">
      <title>Update Car</title>
 

      <style>
      
      body{

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
        width: 50%;
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
        <strong> <p >Update New Car    </p></strong>
         </div>
         <div class ="FORM">
         <form  action="update_car.php" method="post" enctype="multipart/form-data">
             
            <p>
               <!-- <label style="margin-right:5px; " for="plate_number">Plate_number:</label> -->
               <input type="hidden" name="plate_number" id="plate_number" value="<?php echo $car['plate_number'];?>">
            </p>
 
             
            <p>
               <label style="margin-right:55px; " for="brand">brand:</label>
               <input type="text" name="brand" id="brand" value="<?php echo $car['brand'];?>">
            </p>
 
             
            <p>
               <label style="margin-right:50px; " for="Model">Model:</label>
               <input type="text" name="model" id="model" value="<?php echo $car['model'];?>">
            </p>
 
             
            <p>
               <label style="margin-right:10px; " for="release_year">release_year:</label>
               <input type="test" name="release_year" id="release_year" value="<?php echo $car['release_year'];?>">
            </p>
 
             
            <p>
               <label style="margin-right:57px; " for="color">color:</label>
               <input type="text" name="color" id="color" value="<?php echo $car['color'];?>">
            </p>
                         
            <p>
               <label style="margin-right:57px; " for="price">price:</label>
               <input type="number" name="price" id="price" value="<?php echo $car['price'];?>">
            </p>
                         
            <p>
               <label style="margin-right:57px; " for="seats">seats:</label>
               <input type="number" name="seats" id="seats" value="<?php echo $car['seats'];?>">
            </p>
                         
            <p>
               <label style="margin-right:30px; " for="office_id">office_id:</label>
               <input type="number" name="office_id" id="office_id" value="<?php echo $car['office_id'];?>">
            </p>
            <p>
            <label style="margin-right:46px; " for="image">Image:</label>    
            <input type="file" name="image" id="image">
            
           
            </p>
            <p>
               <label style="margin-right:57px; " for="state">state:</label>
               <input type="text" name="state" id="state" value="<?php echo $car['plate_number'];?>">
            </p>
          <div  class="button" >
            <input   type="submit" value="ADD" name="upload">
            </div>
         </form>
         </div>
   </body>
</html>