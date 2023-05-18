<?php
session_start();
require('connection.php');
if (isset($_SESSION['email'])){
    $email=$_SESSION['email'];
    $query = "SELECT * FROM `customer`where email='$email'";
    $sql =  $con->prepare($query);
    $result = $sql->execute();
    $customer = $sql->fetch(PDO::FETCH_ASSOC);
    $id=$customer['customer_id'];
    $start_date=$_SESSION['start_date'];
    $end_date=$_SESSION['end_date'];
$date1=new DateTime($start_date);
$date2=new DateTime($end_date);
$diff=$date1->diff($date2);
$no_of_days=$diff->format('%d');
$no_of_days=(int)$no_of_days;
}
else{
         echo "<script>
 alert('Please Login First');
 window.location.href='login_redirect.php';
 </script>";
}
?>



<?php
##########Get Selected Data of Car##############
$hostname = "localhost";
$username = "root";
$password = "";
$databaseName = "car_rental_system";
$connect = mysqli_connect($hostname, $username, $password, $databaseName);




#Get Data of selected car 
$query_string = $_SERVER['QUERY_STRING'];
$data = explode('=',$query_string);

if($data[0] == 'customer_id'){
// $query = "SELECT * FROM car where plate_number = '$data[1]'";
// $result = mysqli_query($connect, $query);
// $row = mysqli_fetch_array($result);

$check_query="SELECT * from cart WHERE customer_id='$id'";
$check_result=mysqli_query($connect,$check_query);
}

#Remove Car from cart 
else if ($data[0] == 'delete'){
    $query_new = "DELETE FROM cart WHERE plate_number='$data[1]'";
    $result_new=mysqli_query($connect, $query_new);
}



#Get All data from Cart Table to Show them in cart 
$cart_cars = array();
$total_price=0;
$query3 = "SELECT * FROM `cart` WHERE customer_id = $id ";
$result3 = mysqli_query($connect, $query3);
while($row = mysqli_fetch_array($result3))
{
    $total_price=$total_price+$row['price'];
    $cart_cars[] = $row;

}


?>





<link href="//netdna.bootstrapcdn.com/bootstrap/3.0.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//netdna.bootstrapcdn.com/bootstrap/3.0.0/js/bootstrap.min.js"></script>
<script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css" integrity="sha512-xh6O/CkQoPOWDdYTDqeRdPCVd1SpvCA9XXcUnZS2FmJNp1coAFzvtCN9BmamE+4aHK8yyUHUSCcJHgXloTyT2A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
   


<div class="container">
    <div class="row">
        <div class="col-sm-12 col-md-8 col-md-offset-1">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>Brand</th>
                        <th>Model</th>
                        <th>Color</th>
                        <th>Release Year</th>

                        <th>Price</th>
                        <th></th>
                    </tr>
                    <td></td>


                </thead>
                
                <tbody>
                    <?php foreach($cart_cars as $cart_car): ?> <tr>
                        <td class="col-sm-8 col-md-6">
                            <div class="media">
                                <a class="thumbnail pull-left" href="#"> <img class="media-object"
                                        src="http://icons.iconarchive.com/icons/custom-icon-design/flatastic-2/72/product-icon.png"
                                        style="width: 72px; height: 72px;"> </a>
                                <div class="media-body">
                                    <h4 class="media-heading"><a href="#"><?php echo $cart_car['brand'];?></a></h4>
                                </div>
                            </div>
                        </td>
                        <td class="col-sm-1 col-md-1 text-left"><strong><?php echo $cart_car['model'];?></strong></td>
                        <td class="col-sm-1 col-md-1 text-left"><strong><?php echo $cart_car['color'];?></strong></td>
                        <td class="col-sm-1 col-md-1 text-left"><strong><?php echo $cart_car['release_year'];?></strong>
                        </td>
                        <td class="col-sm-1 col-md-1 text-left"><strong>$<?php echo $cart_car['price'];?></strong></td>
                        <td>
                            <a href="<?php echo $_SERVER['PHP_SELF'] .'?delete='.$cart_car['plate_number']?>"><i
                                    class="fa-solid fa-trash-can"></i></a>
                        </td>
                        <td class="col-sm-1 col-md-1">

                    </tr>
                    <?php endforeach; ?>
                </tbody>


                <tr>
                    <td> </td>
                    <td> </td>
                    <td> </td>
                    <td> </td>

                    <td>
                        <h3>Total</h3>
                    </td>
                    <td class="text-right">
                        <h3><strong><?php echo "$".$total_price;?></strong></h3>
                    </td>
                </tr>


                <tr>
                    <td> </td>
                    <td> </td>
                    <td> </td>
                    <td> </td>
                    <td>

                        <button type="button" class="btn btn-default"
                            onclick="location.href = 'search.php';">
                            <span class="glyphicon glyphicon-shopping-cart"></span> Continue Shopping
                        </button>
                    </td>

                    <td>
                        <button type="button" class="btn btn-success"  onclick="location.href = 'Checkout.php';">

                            
                            Checkout <span class="glyphicon glyphicon-play"></span>
                        </button>
                    </td>
                </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>