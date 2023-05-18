<!DOCTYPE html>
<html>
 
<head>
    <title>Insert Car</title>
    
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
        
        $sql = "INSERT INTO car  VALUES ('$plate_number',
            '$brand','$model','$release_year','$color','$price',' $seats','$office_id','$image','$state')";
         
         require_once('connection.php');
         $query = "select plate_number FROM car ";
         $sql1 = $con->prepare($query);
         $sql1->execute();
         $cars = $sql1->fetchAll(PDO::FETCH_ASSOC); 
        // var_dump($cars);
      
        function function_alert($msg) {
            echo "<script type='text/javascript'>alert('$msg');
            window.location ='addCar.php';
        </script>";
         }
         $temp=0;
         foreach ($cars as $car){
            
            if($car['plate_number']==$plate_number)
            {
                $temp=1;
                function_alert("SORRY!!!, THIS CAR ALREADY EXISTED");

                break;
            }

         }

        if(mysqli_query($conn, $sql)){
          header('Location:cars.php');
        } 
       

       
        ?>
    </center>
</body>

