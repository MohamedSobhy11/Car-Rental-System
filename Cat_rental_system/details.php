<?php
session_start();
require('connection.php');
if (isset($_SESSION['email'])){
    $email=$_SESSION['email'];
    $query1 = "SELECT * FROM `customer`where email='$email'";
    $sql1 =  $con->prepare($query1);
    $result = $sql1->execute();
    $customer = $sql1->fetch(PDO::FETCH_ASSOC);
}
else{
         echo "<script>
 alert('Please Login First');
 window.location.href='login.php';
 </script>";
}
?>
<?php
require_once 'connection.php';
$query_string = $_SERVER['QUERY_STRING'];
$data = explode('=',$query_string);
$query = "SELECT * FROM customer where customer_id = '$data[1]'";
$sql = $con->prepare($query);
$sql->execute();
$customer = $sql->fetch(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css" integrity="sha512-xh6O/CkQoPOWDdYTDqeRdPCVd1SpvCA9XXcUnZS2FmJNp1coAFzvtCN9BmamE+4aHK8yyUHUSCcJHgXloTyT2A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <title>Document</title>
<style>


       *{
            margin:0;
            padding:0;
            box-sizing: border-box;
        }
        body{
            
        background-image: url('images/car-background.jpg');
        background-size:center;
        background-position:center 30%;

        }
        
        table{
            background-color:rgba(0,0,10,0.6);
            position:relative;
            
           
        }
        
        table, th, td {
             border: 2px solid;
             color: white;
        }

          .tr_first {
  
        background-color:rgba(0,0,10,0.7);
   
        }

</style>




</head>
<body>
<!-- <nav class="navbar navbar-expand-lg navbar-light bg-light">
  <a class="navbar-brand" href="#">Menu</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto  " >
      <li class="nav-item active">
        <a class="nav-link" href="dashboard.php">Dashboard <span class="sr-only">(current)</span></a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="Cars.php">Cars</a>
      </li>
      <li class="nav-item dropdown " >
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          REPORTS
        </a>
        
        <div class="dropdown-menu" aria-labelledby="navbarDropdown">

          <a class="dropdown-item" href="report1.php">All reservations</a>
          <a class="dropdown-item" href="report2.php">All reservations for specific car</a>
          <a class="dropdown-item" href="report3.php">Status of all car</a>
          <a class="dropdown-item" href="report4.php">All reservations for specific customer</a>
          <a class="dropdown-item" href="report5.php">Daily payments</a>
       
         
      </li>
    
    </ul>
   
  </div>
</nav>
 -->
 <?php if($customer['type']=='admin'):?>
 <nav class="navbar navbar-expand-lg navbar-light bg-light">
  <div class="container-fluid">
    <a class="navbar-brand" href="#">Menu</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="Cars.php">Cars</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="dashboard.php">Dashboard</a>
        </li>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
           Reports
          </a>
          <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
          <a class="dropdown-item" href="report1.php">All reservations</a>
          <a class="dropdown-item" href="report2.php">All reservations for specific car</a>
          <a class="dropdown-item" href="report3.php">Status of all car</a>
          <a class="dropdown-item" href="report4.php">All reservations for specific customer</a>
          <a class="dropdown-item" href="report5.php">Daily payments</a>
          </ul>
        </li>
     
      </ul>
      <form class="d-flex">
        <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
        <button class="btn btn-outline-success" type="submit">Search</button>
      </form>
    </div>
  </div>
</nav>
<?php endif;?>

<table class="table">
    <thead>
            <tr class="tr_first">
                <th scope="col">Customer Id</th>
                <th scope="col">First name</th>
                <th scope="col">Last name</th>
                <th scope="col">Email</th>
                <th scope="col">Gender</th>
                <th scope="col">Phone Number</th>
                <th scope="col">Type</th>
            </tr>
        </thead>
        <tbody>
                <tr>
                    <td><?php echo $customer['customer_id'];?></td>
                    <td><?php echo $customer['fname'];?></td>
                    <td><?php echo $customer['lname'];?></td>
                    <td><?php echo $customer['email'];?></td>
                    <td><?php echo $customer['gender'];?></td>
                    <td><?php echo $customer['phone_number'];?></td>
                    <td><?php echo $customer['type'];?></td>
                </tr>
        </tbody>
    </table>
    <a href="main.php?=customer_id=<?php echo $customer['customer_id'];?>" class="btn btn-danger">Return To Main Page</a>
    <a href="main.php?signout=99" class="btn btn-danger">Sign Out</a>

</body>
</html>