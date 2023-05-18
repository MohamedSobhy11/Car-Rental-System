<!DOCTYPE html>
<html>
 
<head>
    <title>Insert Page page</title>
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
    
        $plate_number =  $_REQUEST['plate_number'];
        $brand = $_REQUEST['brand'];
        $model =  $_REQUEST['model'];
        $release_year = $_REQUEST['release_year'];
        $color = $_REQUEST['color'];
        $price = $_REQUEST['price'];
        $seats = $_REQUEST['seats'];
        $office_id = $_REQUEST['office_id'];
        $image =$_FILES['image']['name'];
        $state = $_REQUEST['state'];
  
        $sql = "UPDATE car SET plate_number='$plate_number',brand='$brand',model='$model',release_year='$release_year',color='$color',price='$price',seats = '$seats',office_id='$office_id',image='$image',state='$state' WHERE plate_number='$plate_number'";
        
        if(mysqli_affected_rows($conn)==0){
            header('Location:update_car_form.php');
           
        } 

        if(mysqli_query($conn, $sql)){
          header('Location:Cars.php');
        } 
       

       
        ?>
    </center>
</body>

