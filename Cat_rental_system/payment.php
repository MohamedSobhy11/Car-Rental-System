<?php
session_start();
$hostname = "localhost";
$username = "root";
$password = "";
$databaseName = "car_rental_system";
$connect = mysqli_connect($hostname, $username, $password, $databaseName);

if (isset($_SESSION['email'])){
    $email=$_SESSION['email'];
    $query = "SELECT * FROM `customer`where email='$email'";
    $sql =  mysqli_query($connect,$query);
    $customer = mysqli_fetch_array($sql);
    $id=$customer['customer_id'];
}
else{
         echo "<script>
 alert('Please Login First');
 window.location.href='login_redirect.php';
 </script>";
}

#Get All data from Cart Table to Show them in cart 
$total_price=0;
$query3 = "SELECT plate_number,price,no_of_days,start_date,end_date FROM cart where customer_id='$id'";
$result3 = mysqli_query($connect, $query3);
while($row = mysqli_fetch_array($result3))
{

$price=(int)$row['price'] * $row['no_of_days'];
$plate_number=$row['plate_number'];
$start_date=$row['start_date'];
$end_date=$row['end_date'];
$today_date=date('Y-m-d');

   
    $reserved="INSERT INTO reservation (customer_id,reserve_date,start_date, end_date , plate_number, total_cost) VALUES ('$id','$today_date','$start_date','$end_date','$plate_number','$price')";
    $result2 = mysqli_query($connect, $reserved);



}

#$plates=trim($plates, ",");


if(isset($_POST['Checkout']))
{      

    
    
    #Reserve Order in reservation table
    

    
  

    #Delete All elements in cart
    $delete="DELETE FROM cart WHERE customer_id=$id";
    $resul3 = mysqli_query($connect, $delete);



    echo "<script>
alert('Operation Done Successfully');
window.location.href='search.php';
</script>";

}






?>

