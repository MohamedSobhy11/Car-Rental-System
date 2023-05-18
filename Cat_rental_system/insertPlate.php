<!DOCTYPE html>
<html>
 
<head>
    <title>Insert Plate </title>
</head>
 
<body>
    <center>
        <?php
        session_start();
        $conn = mysqli_connect("localhost", "root", "", "car_rental_system");
        if($conn === false){
            die("ERROR: Could not connect. "
                . mysqli_connect_error());
        }
    
        $plate_number =  $_REQUEST['plate_number'];
        $starting_plate = $_REQUEST['starting_plate'];
        $expiring_plate =  $_REQUEST['expiring_plate'];
       
       
  
        $sql = "INSERT INTO plate VALUES ('$plate_number',
            '$starting_plate','$expiring_plate')";
        
        if(mysqli_affected_rows($conn)==0){
            header("Location:addPlate.php");
           
        } 

        if(mysqli_query($conn, $sql)){
          header("Location:Cars.php");
        } 
       

       
        ?>
    </center>
</body>

