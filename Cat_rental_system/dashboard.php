<?php
$hostname = "localhost";
$username = "root";
$password = "";
$databaseName = "car_rental_system";

$connect = mysqli_connect($hostname, $username, $password, $databaseName);

$query1 = "SELECT DISTINCT fname FROM customer ORDER BY fname";
$result1 = mysqli_query($connect, $query1);
$options1 = "";
while ($row1 = mysqli_fetch_array($result1)) {
    $options1 = $options1 . "<option>$row1[0]</option>";
}


$query2 = "SELECT DISTINCT lname FROM customer ORDER BY lname ";
$result2 = mysqli_query($connect, $query2);
$options2 = "";

while ($row2 = mysqli_fetch_row($result2)) {
    $options2 = $options2 . "<option>$row2[0] </option>";
}



$query3 = "SELECT  phone_number FROM customer ORDER BY phone_number";
$result3 = mysqli_query($connect, $query3);
$options3 = "";
while ($row3 = mysqli_fetch_array($result3)) {
    $options3 = $options3 . "<option>$row3[0]</option>";
}



$query4 = "SELECT  email FROM customer ORDER BY email";
$result4 = mysqli_query($connect, $query4);
$options4 = "";
while ($row4 = mysqli_fetch_array($result4)) {
    $options4 = $options4 . "<option>$row4[0]</option>";
}


$query6 = "SELECT DISTINCT gender FROM customer ORDER BY gender";
$result6 = mysqli_query($connect, $query6);
$options6 = "";
while ($row6 = mysqli_fetch_array($result6)) {
    $options6 = $options6 . "<option>$row6[0]</option>";
}






?>



<?php
require('connection.php');
$query_string = $_SERVER['QUERY_STRING'];
$data = explode('=', $query_string);
if ($data[0] == 'delete') {
    $query = "DELETE FROM customer WHERE customer_id = $data[1]";
    $sql = $con->prepare($query);
    $sql->execute();
}
?>





<?php
session_start();
require_once 'connection.php';
$query_string = $_SERVER['QUERY_STRING'];
$data = explode('=', $query_string);
if (isset($_SESSION['email'])) {
    $email = $_SESSION['email'];
    $query = "SELECT * FROM customer where email = '$email'";
    $sql = $con->prepare($query);
    $sql->execute();
    $admin = $sql->fetch(PDO::FETCH_ASSOC);
    if ($admin['type'] != 'admin') {
        header("location:notfound.html");
    }
}
?>
<?php
require('connection.php');
if (isset($_SESSION['email'])) {
    $email = $_SESSION['email'];
    $query = "SELECT * FROM customer where email = '$email'";
    $sql = $con->prepare($query);
    $sql->execute();
    $admin = $sql->fetch(PDO::FETCH_ASSOC);
    if ($admin['type'] != 'admin') {
        header("location:notfound.html");
    } elseif ($admin['type'] == 'admin') {
        if (isset($_POST['Search'])) {
            $flag = False;

            if (!empty($_POST['exampleDataList'])) {
                $fname = $_POST['exampleDataList'];
                $query = "SELECT * FROM customer WHERE fname='$fname'";

                $flag = True;
            }


            if (!empty($_POST['exampleDataList1'])) {
                $lname = $_POST['exampleDataList1'];
                if ($flag == True) {

                    $query = $query . " AND lname ='$lname'";
                }
                #Flag=False --> means that user didn't enter specific brand so write query from begining
                else {

                    $query = "SELECT * FROM customer WHERE lname='$lname'";
                    $flag = True;

                }

            }

            if (!empty($_POST['exampleDataList2'])) {
                $phone_number = $_POST['exampleDataList2'];

                if ($flag == True) {

                    $query = $query . " AND phone_number ='$phone_number'";
                }
                #Flag=False --> means that user didn't enter specific brand so write query from begining
                else {

                    $query = "SELECT * FROM customer WHERE phone_number='$phone_number'";
                    $flag = True;

                }
            }


            if (!empty($_POST['exampleDataList3'])) {
                $email = $_POST['exampleDataList3'];

                if ($flag == True) {

                    $query = $query . " AND email ='$email'";
                } else {

                    $query = "SELECT * FROM customer WHERE email='$email'";
                    $flag = True;

                }
            }

            if (!empty($_POST['gender']))
                $gender = $_POST['gender']; {
                if ($gender == "All") {

                } else if ($flag == True) {

                    $query = $query . " AND gender ='$gender'";
                } else {

                    $query = "SELECT * FROM customer WHERE gender='$gender'";
                    $flag = True;

                }
            }

            if ($flag == false) {
                $query = "SELECT * FROM customer";


            }
        } else {
            $query = "SELECT * FROM `customer`";
        }

        // echo $query;

        $sql = $con->prepare($query);
        $result = $sql->execute();
        $customers = $sql->fetchAll(PDO::FETCH_ASSOC);
    }
} else
    header("location:notfound.html");
?>
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-wEmeIV1mKuiNpC+IOBjI7aAzPcEZeedi5yW5f2yOq55WWLwNGmvvx4Um1vskeMj0" crossorigin="anonymous">




    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css"
        integrity="sha512-xh6O/CkQoPOWDdYTDqeRdPCVd1SpvCA9XXcUnZS2FmJNp1coAFzvtCN9BmamE+4aHK8yyUHUSCcJHgXloTyT2A=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
        </script>
    <title>dashboard</title>
    <style>
        * {
            margin: 0;
            padding: 0;
        }

        body {

            background-image: url('images/car-background.jpg');
            background-size: center;
            background-position: center center;

        }

        table {
            background-color: rgba(0, 0, 10, 0.6);


        }



        table,
        th,
        td {
            border: 2px solid;
            color: white;
        }

        .tr_first {

            background-color: rgba(0, 0, 10, 0.7);

        }

        .menu {
            background-color: rgba(0, 0, 10, 0.75);
            height: 100vh;
            position: relative;
            left: 0px;
            top: 0px;
            
            
        }

        .search {

            /* background-color: red; */
            margin-top: 0px;
            overflow: auto;
            border: 3px solid red;
            display: block;
            padding: 10px;
            padding-top: 20px;


        }

        .title {
            width: 100%;
            height: 40px;
            text-align: center;
            color: white;
            text-shadow: 2px;
            margin-bottom: 30px;
            padding-top: 20px;
        }
    </style>











</head>

<body>
    <div class=" d-flex justify-content-end w-100 ">


        <div class="menu w-25 ">

            <div class="title">
                <h2>--- ADMIN ---</h2>
            </div>


            <a href="customer_form.php">
                <button class=" btn btn-danger" style="width: 100%; color: white; border:3px solid black;  ">
                    <h6><strong>Add Customer</strong> </h5>
                </button>
            </a>
           

            <br>
            

            <div class="search w-100 h-60 " id="search">
                <button class=" btn btn-danger" style="width: 100%; color: white;   " id="toggle">
                    <h6><strong>Search</strong> </h5>
                </button> -->

                <form method="post" action="dashboard.php">

                    <label style ="color:white; margin-left: 10px;" for="exampleDataList" class="form-label">First Name</label>
                    <input class="form-control" list="datalistOptions" id="exampleDataList" name="exampleDataList"
                        placeholder="Type to search...">

                    <label style ="color:white; margin-left: 10px;"  for="exampleDataList1" class="form-label">Last Name</label>
                    <input  class="form-control" list="datalistOptions1" id="exampleDataList1" name="exampleDataList1"
                        placeholder="Type to search...">

                        
                    <label style ="color:white; margin-left: 10px;"  for="exampleDataList2" class="form-label">Phone Number</label>
                    <input class="form-control" list="datalistOptions2" id="exampleDataList2" name="exampleDataList2"
                        placeholder="Type to search...">

                        <label style ="color:white; margin-left: 10px;"  for="exampleDataList3" class="form-label">Email</label>
                    <input class="form-control" list="datalistOptions3" id="exampleDataList3" name="exampleDataList3"
                        placeholder="Type to search...">
                     <br>
                 

                        <label style ="color:white; margin-left: 10px;"  for="gender">Gender:</label>
                        <br>
                    <select style="margin-left:10px; " name="gender" id="gender">
                        <option value="All">All</option>
                        <option value="Male">Male</option>
                        <option value="Female">Female</option>

                    </select>
                    <br>
                    <br>


                    <input type="submit" name="Search" value="Search"style="margin-left:40%; ">

                    
                    
    


                   



















                </form>
            </div>
            
            
 

            <a href="main.php">
                <button class=" btn btn-danger" style="width: 100%; color: white; border:3px solid black;  ">
                    <h6><strong>Return To Main Page</strong> </h5>
                </button>
            </a>








        </div>


        <div class="wrapper w-75">
            <table class="table W-100">
                <thead>
                    <tr class="tr_first">
                        <th scope="col">Customer Id</th>
                        <th scope="col">First name</th>
                        <th scope="col">Last name</th>
                        <th scope="col">Email</th>
                        <th scope="col">Password</th>
                        <th scope="col">Gender</th>
                        <th scope="col">Phone Number</th>
                        <th scope="col">Type</th>
                        <th scope="col">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($customers as $customer): ?>
                        <tr>
                            <td><?php echo $customer['customer_id']; ?></td>
                            <td>
                                <?php echo $customer['fname']; ?>
                            </td>
                            <td><?php echo $customer['lname']; ?></td>
                            <td>
                                <?php echo $customer['email']; ?>
                            </td>
                            <td><?php echo $customer['password']; ?></td>
                            <td>
                                <?php echo $customer['gender']; ?>
                            </td>
                            <td><?php echo $customer['phone_number']; ?></td>
                            <td>
                                <?php echo $customer['type']; ?>
                            </td>
                            <td>
                                <a href="<?php echo $_SERVER['PHP_SELF'] . '?delete=' . $customer['customer_id'] ?>"><i
                                        class="fa-solid fa-trash-can"></i></a>
                                <a href="./update_user_form.php?customer_id=<?php echo $customer['customer_id'] ?>"><i
                                        class="fa-solid fa-pen-to-square"></i></a>
                            </td>
                        </tr>
                        <?php endforeach; ?>

                </tbody>
            </table>
        </div>
    </div>










</body>

</html>