<!DOCTYPE html>
<html>
 
<head>
    <title>Insert Office </title>
</head>
 
<body>
    <center>
        <?php
        @session_start();
        $conn = mysqli_connect("localhost", "root", "", "car_rental_system");
        if($conn === false){
            die("ERROR: Could not connect. "
                . mysqli_connect_error());
        }
        else{
            echo "in";
        }
    
        $city =  $_REQUEST['city'];
        $location = $_REQUEST['location'];
    
       
       
  
        $sql = "INSERT INTO office (city,location) VALUES ('$city',
            '$location')";
        
        if(mysqli_affected_rows($conn)==0){
           header('Location:addOffice.php');
           
        } 

        if(mysqli_query($conn, $sql)){
          header('Location:Cars.php');
        } 
       

       
        ?>
    </center>
</body>

