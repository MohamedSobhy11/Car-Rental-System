
<html>
<head>
<meta charset="utf-8">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM"
        crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css"
        integrity="sha512-xh6O/CkQoPOWDdYTDqeRdPCVd1SpvCA9XXcUnZS2FmJNp1coAFzvtCN9BmamE+4aHK8yyUHUSCcJHgXloTyT2A=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
        <style type="text/css">

a { text-decoration: none; }
h1 { font-size: 1em; }
h1, p {
margin-bottom: 10px;
}
strong {
font-weight: bold;
}
.uppercase { text-transform: uppercase; }

#report {
margin: 50px auto;
width: 300px;
}

form fieldset input[type="text"]{
background-color: #e5e5e5;
border: none;
border-radius: 3px;
-moz-border-radius: 3px;
-webkit-border-radius: 3px;
color: #5a5656;
font-family: 'Open Sans', Arial, Helvetica, sans-serif;
font-size: 14px;
height: 50px;
outline: none;
padding: 0px 10px;
width: 280px;
-webkit-appearance:none;
}

form fieldset input[type="submit"] {
background-color: #008dde;
border: none;
border-radius: 3px;
-moz-border-radius: 3px;
-webkit-border-radius: 3px;
color: #f4f4f4;
cursor: pointer;
font-family: 'Open Sans', Arial, Helvetica, sans-serif;
height: 50px;
text-transform: uppercase;
width: 200px;
-webkit-appearance:none;
}
body{
            
            background-image: url('images/car-background.jpg');
            background-size:center;
            background-position:center center;
    
            }
            
            table{
                background-color:rgba(0,0,10,0.6);
                position:relative;
                
               
            }
            
            table, th, td {
                 border: 2px solid;
                 color: white;
            }
</style>
</head>
<body>
<div id="report">
<h1>Enter customer id</h1>
<form action="" method="post">
<fieldset>
<p><input type="text" name="customer_id" required value="Customer_id" onBlur="if(this.value=='')this.value='Customer_id'" onFocus="if(this.value=='Customer_id')this.value='' "></p>
<p><input type="submit" name="submit" value="Report"></p>
<a href="main.php" ><i class="fa-solid fa-house"></i></a>

</fieldset>
</form>
</div>
<?php
require('connection.php');
  if(isset($_POST['submit']))
  {
  $customer_id=$_POST['customer_id'];
  $query = "SELECT *FROM reservation AS r JOIN car as c ON r.plate_number = c.plate_number JOIN customer AS s ON r.customer_id = s.customer_id WHERE r.customer_id ='$customer_id'";
  $sql =  $con->prepare($query); 
  $result = $sql->execute();
  $reservations = $sql->fetchAll(PDO::FETCH_ASSOC);
// echo $reservations[0]['plate_number'];
// echo  $sdate;
// var_dump($reservations);
?>
    <table class="table">
    <thead>
            <tr>
                <?php if (empty($reservations)): ?>
                <?php echo "No reservation found for this user";?>
                <?php else : ?>
                <th scope="col">Reservation Id</th>
                <th scope="col">Start date</th>
                <th scope="col">End date</th>
                <th scope="col">Total cost</th>
                <th scope="col">Customer Id</th>
                <th scope="col">First name</th>
                <th scope="col">Last name</th>
                <th scope="col">Phone number</th>
                <th scope="col">Email</th>
                <th scope="col">Plate number</th>
                <th scope="col">Car brand</th>
                <th scope="col">Car model</th>
            </tr>
            <?php endif;?>
        </thead>
        <tbody>
        <?php foreach($reservations as $reservation): ?>
                <tr>
                    <td><?php echo $reservation['reservation_id'];?></td>
                    <td><?php echo $reservation['start_date'];?></td>
                    <td><?php echo $reservation['end_date'];?></td>
                    <td><?php echo $reservation['total_cost'];?></td>
                    <td><?php echo $reservation['customer_id'];?></td>
                    <td><?php echo $reservation['fname'];?></td>
                    <td><?php echo $reservation['lname'];?></td>
                    <td><?php echo $reservation['phone_number'];?></td>
                    <td><?php echo $reservation['email'];?></td>
                    <td><?php echo $reservation['plate_number'];?></td>
                    <td><?php echo $reservation['brand'];?></td>
                    <td><?php echo $reservation['model'];?></td>
                </tr>
            <?php endforeach; ?>
        </tbod>
<?php }?>        
</body>
</html>