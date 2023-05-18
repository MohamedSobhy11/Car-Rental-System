<?php
session_start();
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
        require('connection.php');
        $query = "SELECT * FROM `car`";
        $sql =  $con->prepare($query);
        $result = $sql->execute();
        $cars = $sql->fetchAll(PDO::FETCH_ASSOC);
    }
} else
    header("location:notfound.html");
?>
<?php
$hostname = "localhost";
$username = "root";
$password = "";
$databaseName = "car_rental_system";

$connect = mysqli_connect($hostname, $username, $password, $databaseName);

$query1 = "SELECT DISTINCT brand FROM car ORDER BY brand";
$result1 = mysqli_query($connect, $query1);
$options1 = "";
while($row1 = mysqli_fetch_array($result1))
{
    $options1 = $options1."<option>$row1[0]</option>";
}


$query2 = "SELECT DISTINCT model FROM car ";
$result2 = mysqli_query($connect, $query2);
$options2 = "";

while($row2 = mysqli_fetch_row($result2))
{   
    $options2 = $options2."<option>$row2[0] </option>";
}



$query3 = "SELECT DISTINCT color FROM car ORDER BY color";
$result3 = mysqli_query($connect, $query3);
$options3 = "";
while($row3 = mysqli_fetch_array($result3))
{
    $options3 = $options3."<option>$row3[0]</option>";
}



$query4 = "SELECT DISTINCT release_year FROM car ORDER BY release_year";
$result4 = mysqli_query($connect, $query4);
$options4 = "";
while($row4 = mysqli_fetch_array($result4))
{
    $options4 = $options4."<option>$row4[0]</option>";
}


$query6 = "SELECT DISTINCT seats FROM car ORDER BY seats";
$result6 = mysqli_query($connect, $query6);
$options6 = "";
while($row6 = mysqli_fetch_array($result6))
{
    $options6 = $options6."<option>$row6[0]</option>";
}



$query7 = "SELECT DISTINCT location FROM office ORDER BY location";
$result7 = mysqli_query($connect, $query7);
$options7 = "";
while($row7 = mysqli_fetch_array($result7))
{
    $options7 = $options7."<option>$row7[0]</option>";
}


$query8 = "SELECT DISTINCT city FROM office ORDER BY city";
$result8 = mysqli_query($connect, $query8);
$options8 = "";
while($row8 = mysqli_fetch_array($result8))
{
    $options8 = $options8."<option>$row8[0]</option>";
}

?>






<?php
require('connection.php');
$query_string = $_SERVER['QUERY_STRING'];
$data = explode('=',$query_string);
if($data[0] == 'delete'){
    $query = "DELETE FROM car WHERE plate_number = '$data[1]'";
    $sql = $con->prepare($query);    
    $sql->execute();
}
?>









<?php
require('connection.php');


$sobhy ="";
$i=0;
$j=0;
$k=0;

$flag=False;


 if(isset($_POST['Search']))
 {
    $min=$_POST['minimum'];
    $max=$_POST['maximum'];

 //Check if User Enter Specific Brand
 if (isset($_POST['brand']))
 {
    //Check if User Enter Multiple Brands Using Checkbox
    $i = 0;
    $selectedOptionCount = count($_POST['brand']);
    $selectedOption = "";
    while ($i < $selectedOptionCount) {
        $selectedOption = $selectedOption . "'" . $_POST['brand'][$i] . "'";
        if ($i < $selectedOptionCount - 1) {
            $selectedOption = $selectedOption . ", ";
        }
        
        $i ++;
    }
    $query="select * FROM car as c join office as o on o.office_id=c.office_id   where c.brand in (" . $selectedOption . ") AND c.price BETWEEN '$min' AND '$max'  ";

    $flag=True;
 }



 

 //Check if User Enter Specific Model
 if (isset($_POST['model']))
 {
    //Check if User Enter Multiple Model Using Checkbox

    $i = 0;
    $selectedOptionCount = count($_POST['model']);
    $selectedOption = "";
    while ($i < $selectedOptionCount) {
        $selectedOption = $selectedOption . "'" . $_POST['model'][$i] . "'";
        if ($i < $selectedOptionCount - 1) {
            $selectedOption = $selectedOption . ", ";
        }
        
        $i ++;
    }
    #Flag=True --> means that user  entered specific brand concatenate to string "query"
    if($flag==True)
    {
   
    $query =$query." AND c.model in (" . $selectedOption . ")" ;
    }
    #Flag=False --> means that user didn't enter specific brand so write query from begining
    else
    {
        
        $query="select * FROM car as c join office as o on o.office_id=c.office_id   where c.model in (" . $selectedOption . ")   AND c.price BETWEEN '$min' AND '$max'";
        $flag=True;

    }
 }




 //Check if User Enter Specific Color

 if (isset($_POST['color']))
 {
    //Check if User Enter Multiple Colors Using Checkbox

    $i = 0;
    $selectedOptionCount = count($_POST['color']);
    $selectedOption = "";
    while ($i < $selectedOptionCount) {
        $selectedOption = $selectedOption . "'" . $_POST['color'][$i] . "'";
        if ($i < $selectedOptionCount - 1) {
            $selectedOption = $selectedOption . ", ";
        }
        
        $i ++;
    }
    #Flag=True --> means that user  entered specific brand or model so concatenate to string "query"

    if($flag==True)
    {
    $query =$query." AND c.color in (" . $selectedOption . ")"  ;
    }
    #Flag=False --> means that user didn't enter specific brand or model  so write query from begining

    else
    {
        $query="select * FROM car as c join office as o on o.office_id=c.office_id   where c.color in (" . $selectedOption . ")  AND (c.price BETWEEN '$min' AND '$max')";
        $flag=True;

    }
 }


 //Check if User Enter Specific release_year

 if (isset($_POST['release_year']))
 {
    //Check if User Enter Multiple release_years Using Checkbox
    $i = 0;
    $selectedOptionCount = count($_POST['release_year']);
    $selectedOption = "";
    while ($i < $selectedOptionCount) {
        $selectedOption = $selectedOption . "'" . $_POST['release_year'][$i] . "'";
        if ($i < $selectedOptionCount - 1) {
            $selectedOption = $selectedOption . ", ";
        }
        
        $i ++;
    }
    #Flag=True --> means that user  entered specific brand or model or color so concatenate to string "query"
    if($flag==True)
    {
    $query =$query." AND c.release_year in (" . $selectedOption . ")" ;
    }
    #Flag=False --> means that user didn't enter specific brand or model or color  so write query from begining

    else
    {
        
    $query="select * FROM car as c join office as o on o.office_id=c.office_id   where c.release_year in (" . $selectedOption . ")   AND (c.price BETWEEN '$min' AND '$max')";            }
    $flag=True;

}

 //Check if User Enter Specific Number of Seats
 if (isset($_POST['seats']))
 {
    //Check if User Enter Multiple Number of Seats Using Checkbox
    $i = 0;
    $selectedOptionCount = count($_POST['seats']);
    $selectedOption = "";
    while ($i < $selectedOptionCount) {
        $selectedOption = $selectedOption . "'" . $_POST['seats'][$i] . "'";
        if ($i < $selectedOptionCount - 1) {
            $selectedOption = $selectedOption . ", ";
        }
        
        $i ++;
    }
    #Flag=True --> means that user  entered specific brand or model or color or release year so concatenate to string "query"

    if($flag==True)
    {
    $query =$query." AND c.seats in (" . $selectedOption . ")" ;
    }
    #Flag=False --> means that user didn't enter specific brand or model or color pr release year so write query from begining
    else
    {
        $query="select * FROM car as c join office as o on o.office_id=c.office_id   where c.seats in (" . $selectedOption . ")  AND c.price BETWEEN '$min' AND '$max'";            }
        $flag=True;

        }




 if (isset($_POST['country']))
 {
    //Check if User Enter Multiple Number of Seats Using Checkbox
    $i = 0;
    $selectedOptionCount = count($_POST['country']);
    $selectedOption = "";
    while ($i < $selectedOptionCount) {
        $selectedOption = $selectedOption . "'" . $_POST['country'][$i] . "'";
        if ($i < $selectedOptionCount - 1) {
            $selectedOption = $selectedOption . ", ";
        }
        
        $i ++;
    }
    #Flag=True --> means that user  entered specific brand or model or color or release year so concatenate to string "query"

    if($flag==True)
    {
    $query =$query." AND o.location in (" . $selectedOption . ")" ;
    }
    #Flag=False --> means that user didn't enter specific brand or model or color pr release year so write query from begining
    else
    {
        
            $query="select * FROM car as c join office as o on o.office_id=c.office_id   where o.location in (" . $selectedOption . ") AND c.price BETWEEN '$min' AND '$max' ";}
            $flag=True;

    }


 if (isset($_POST['city']))
 {
    //Check if User Enter Multiple Number of Seats Using Checkbox
    $i = 0;
    $selectedOptionCount = count($_POST['city']);
    $selectedOption = "";
    while ($i < $selectedOptionCount) {
        $selectedOption = $selectedOption . "'" . $_POST['city'][$i] . "'";
        if ($i < $selectedOptionCount - 1) {
            $selectedOption = $selectedOption . ", ";
        }
        
        $i ++;
    }
    #Flag=True --> means that user  entered specific brand or model or color or release year so concatenate to string "query"

    if($flag==True)
    {
    $query =$query." AND o.city in (" . $selectedOption . ")" ;
    }
    #Flag=False --> means that user didn't enter specific brand or model or color pr release year so write query from begining
    else
    {
        $query="select * FROM car as c join office as o on o.office_id=c.office_id   where o.city in (" . $selectedOption . ")  AND c.price BETWEEN '$min' AND '$max'";            }
        $flag=True;

    }
  



    if ($flag==False)
    {
        $query = "select * FROM car where  price BETWEEN '$min' AND '$max'";

    }





     
  }
else 
{

    $query = "select * FROM car ";
}

// echo $query;

$sql =  $con->prepare($query);
$result = $sql->execute();
$cars = $sql->fetchAll(PDO::FETCH_ASSOC);
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
    
    <title>view cars NEW</title>
    <style>
        *{
            margin:0;
            padding:0;
            box-sizing: border-box;
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
        img {
            height: 100px; 
            width :150px;
           
        }
        .tr_first {
  
        background-color:rgba(0,0,10,0.7);
   
        }
.wrapper {
    width: auto;
    height:100vh;
    overflow: auto;
}
.menu{
    background-color:rgba(0,0,10,0.75);
    height: 100vh;
    position:relative; left:0px; top:0px;
   
    overflow: auto;
}
.title{
    width: 100% ;
    height: 40px;
    text-align: center;
    color: white;
    text-shadow: 2px;
    margin-bottom: 30px;
    padding-top: 20px;
}
        
.search{
  
    /* background-color: red; */
    margin-top: 0px;
    overflow: auto;
    border: 3px solid red;
    display: block;
    padding: 10px;
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
        
                <a href="addCar.php">
            <button  class=" btn btn-danger" style="width: 100%; color: white; border:3px solid black;  ">
             <h6><strong>ADD CAR</strong> </h5>
                </button>
                </a>
          
                <a href="addOffice.php">
            <button  class=" btn btn-danger" style="width: 100%; color: white; border:3px solid black;  ">
             <h6><strong>ADD Office</strong> </h5>
                </button>   
                </a>

                <a href="outOfServiceView.php">
            <button  class=" btn btn-danger" style="width: 100%; color: white; border:3px solid black;  ">
             <h6><strong>Out Of Service Cars</strong> </h5>
                </button>
                </a>

 

                <br>
                <br>    
               
               
          
                
                <div class="search w-100 h-60 " id="search">
                <button  class=" btn btn-danger" style="width: 100%; color: white;   " id="toggle">
               <h6><strong>Search</strong> </h5>
                </button> -->
    
                  <form method="post" action="cars.php">
                  <label style ="color:white; margin-left: 10px;">Brand </label>
                    <select style='width: 25%; ' name="brand[]" id="brand[]" multiple multiselect-search="true"
                        multiselect-select-all="true" onchange="console.log(this.selectedOptions)">
                        <?php echo $options1;?>
                    </select>

                    <label style ="color:white;  margin-right:35px;">Country</label>
                    <select style='width: 25%' name="country[]" id="country[]" multiple multiselect-search="true"
                        multiselect-select-all="true" onchange="console.log(this.selectedOptions)">
                        <?php echo $options7;?>
                    </select>
                    <br>
                    <br>
                    <label style ="color:white; margin-right:15px; margin-left: 10px;">City</label>
                    <select style='width: 25%' name="city[]" id="city[]" multiple multiselect-search="true"
                        multiselect-select-all="true" onchange="console.log(this.selectedOptions)">
                        <?php echo $options8;?>
                    </select>

                    <label style ="color:white; margin-right:45px;">Model</label>
                    <select  style='width: 25%' name="model[]" id="model[]" multiple multiselect-search="true" multiselect-select-all="true"
                        onchange="console.log(this.selectedOptions)">
                        <?php echo $options2;?>
                    </select>
                   <br>
                   <br>
                    <label  style ="color:white; margin-right:3px;margin-left: 10px;">Color</label>
                    <select  style='width: 25%' name="color[]" id="color[]" multiple multiselect-search="true" multiselect-select-all="true"
                        onchange="console.log(this.selectedOptions)">
                        <?php echo $options3;?>
                    </select>

                    <label  style ="color:white; margin-right:3px; ">Release Year</label>
                    <select style='width: 25%' name="release_year[]" id="release_year[]" multiple multiselect-search="true"
                        multiselect-select-all="true" onchange="console.log(this.selectedOptions)">
                        <?php echo $options4;?>

                    </select>
                    <br>
                    <br>
                    <label  style ="color:white; margin-right:3px; margin-left: 10px;">Seats</label>
                    <select style='width: 25%' name="seats[]" id="seats[]" multiple multiselect-search="true" multiselect-select-all="true"
                        onchange="console.log(this.selectedOptions)">
                        <?php echo $options6;?>
                    </select>
                    <br>
                    <br>

                    <label style ="color:white; margin-right:3px; margin-left: 10px;"> Price</label>
                    <br>
                    <span style ="color:white; margin-right:3px; margin-left: 10px;">Min</span>
                                <input type="number" class="input-min" value="1000" name="minimum" id="minimum">
                    <br>
                    <br>
                    <span style ="color:white; margin-right:0px; margin-left: 10px;">Max</span>
                                <input type="number" class="input-max" value="100000" name="maximum" id="maximum">
                                



                    <br>
                    <br>
                    <input type="submit" name="Search" value="Search" style="margin-left:40%; margin-bottom: 10px;">

                    






                    
    




                  </form>
                </div>
                <a href="main.php">
                <button class=" btn btn-danger" style="width: 100%; color: white; border:3px solid black;  ">
                    <h6><strong>Return To Main Page</strong> </h5>
                </button>
            </a>
           

</div>

    <div class="wrapper w-75">
    <table class="table w-100  ">
    <thead>
            <tr class="tr_first">
                <th scope="col">plate_number</th>
                <th scope="col">brand</th>
                <th scope="col">model</th>
                <th scope="col">release_year</th>
                <th scope="col">color</th>
                <th scope="col">price</th>
                <th scope="col">seats</th>
                <th scope="col">office_id</th>
                <th scope="col">state</th>
                <th  scope="col">image</th>
                <th  scope="col">Actions</th>
               
                
                
                
            </tr>
        </thead>
        <tbody>
        <?php foreach($cars as $car): ?>
                <tr>
                    
                    <td><?php echo $car['plate_number'];?></td>
                    <td><?php echo $car['brand'];?></td>
                    <td><?php echo $car['model'];?></td>
                    <td><?php echo $car['release_year'];?></td>
                    <td><?php echo $car['color'];?></td>
                    <td><?php echo $car['price'];?></td>
                    <td><?php echo $car['seats'];?></td>
                    <td><?php echo $car['office_id'];?></td>
                    <td><?php echo $car['state'];?></td> 
        
                    <td><?php
                    $url ="images/".$car['image'];
                    echo "<img src='$url'>"
                    
                    ?></td>     
                    <td>
                     <a href="<?php echo $_SERVER['PHP_SELF'] .'?delete='.$car['plate_number']?>"><i class="fa-solid fa-trash-can"></i></a>
                     <a href="./update_car_form.php?plate_number=<?php echo $car['plate_number']?>"><i class="fa-solid fa-pen-to-square"></i></a>

                    </td>
                </tr>

    
            <?php endforeach; ?>
           
           
            
        </tbody>
    </table>
    </div>
    </div>
   
    <script src="carsZ.js"  ></script>
     <script src="cars1Z.js"  ></script>

     

    
 
           
</body>
</html>