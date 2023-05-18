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
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css" integrity="sha512-xh6O/CkQoPOWDdYTDqeRdPCVd1SpvCA9XXcUnZS2FmJNp1coAFzvtCN9BmamE+4aHK8yyUHUSCcJHgXloTyT2A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
<link href="https://fonts.googleapis.com/css2?family=Chivo+Mono:ital,wght@1,200&display=swap" rel="stylesheet">
<link rel="preconnect" href="https://fonts.googleapis.com"><link rel="preconnect" href="https://fonts.gstatic.com" crossorigin><link href="https://fonts.googleapis.com/css2?family=Libre+Baskerville&display=swap" rel="stylesheet">
      <title>ADD CAR</title>
 

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
        padding: 20px;
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


     .back_button{
    
        position: absolute;
        top:5px;
        left:20px;  

 


     }
      </style>



   </head>
   <body>
   



         <div class="title">   
        <strong> <p >ADD NEW CAR   </p></strong>
         </div>
         <div class ="FORM">
         <form  action="insertCar.php" method="post" enctype="multipart/form-data">
             
            <p>
               <label style="margin-right:5px; " for="plate_number">Plate_numbar:</label>
               <input required type="text" name="plate_number" id="plate_number">
            </p>
 
             
            <p>
               <label style="margin-right:60px; " for="brand">brand:</label>
               <input required type="text" name="brand" id="brand">
            </p>
 
             
            <p>
               <label style="margin-right:55px; " for="model">Model:</label>
               <input required type="text" name="model" id="model">
            </p>
 
             
            <p>
               <label style="margin-right:15px; " for="release_year">release_year:</label>
               <input required type="text" name="release_year" id="release_year">
            </p>
 
             
            <p>
               <label style="margin-right:65px; " for="color">color:</label>
               <input required type="text" name="color" id="color">
            </p>
                         
            <p>
               <label style="margin-right:65px; " for="price">price:</label>
               <input required type="number" name="price" id="price">
            </p>
                         
            <p>
               <label style="margin-right:65px; " for="seats">seats:</label>
               <input type="number" name="seats" id="seats">
            </p>
                         
            <p>
               <label style="margin-right:40px; " for="office_id">office_id:</label>
               <input required type="number" name="office_id" id="office_id">
            </p>
            <p>
            <label style="margin-right:54px; " for="image">Image:</label>    
            <input type="file" name="image" id="image">
            
           
            </p>
            <p>
               <label style="margin-right:65px; " for="state">state:</label>
               <input value="Active" required  type="text" name="state" id="state">
            </p>
          <div  class="button" >
            <input   type="submit" value="ADD" name="upload">
            </div>
         </form>
         </div>

         <div class="back_button">
            <a href="Cars.php">
            <button  class=" btn btn-warning" style="width: 60px; color: white;  ">
             <h6><strong>Back</strong> </h5>
                </button>   
       </div> 

   </body>
</html>