<?php
require_once 'connection.php';
$query_string = $_SERVER['QUERY_STRING'];
$data = explode('=',$query_string);
$query = "SELECT * FROM car where plate_number = '$data[1]'";
$sql = $con->prepare($query);
$sql->execute();
$car = $sql->fetch(PDO::FETCH_ASSOC);
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
        /* * {
            margin: 0;
            padding: 0;
        } */

        body {

            /* background-image: url('images/car-background.jpg');
            background-size: center;
            background-position: center center; */
            background-color: whitesmoke;


        } 

        /* table {
            background-color: rgba(0, 0, 10, 0.6);


        } */

        /* table,
        th,
        td {
            border: 2px solid;
            color: white;
        } */

        img {
            height: 100px;
            width: 150px;

        }
    </style>
</head>
<body>
<table class="table">
        <thead>
            <tr>
                <th scope="col">plate_number</th>
                <th scope="col">brand</th>
                <th scope="col">model</th>
                <th scope="col">release_year</th>
                <th scope="col">color</th>
                <th scope="col">price</th>
                <th scope="col">seats</th>
                <th scope="col">office_id</th>
                <th scope="col">state</th>
                <th scope="col">image</th>
            </tr>
        </thead>
        <tbody>
                <tr>

                    <td><?php echo $car['plate_number']; ?></td>
                    <td><?php echo $car['brand']; ?></td>
                    <td><?php echo $car['model']; ?></td>
                    <td><?php echo $car['release_year']; ?></td>
                    <td><?php echo $car['color']; ?></td>
                    <td><?php echo $car['price']; ?></td>
                    <td><?php echo $car['seats']; ?></td>
                    <td><?php echo $car['office_id']; ?></td>
                    <td><?php echo $car['state']; ?></td>

                   
                </tr>
                <td>
                        <?php
                        $url = "images/" . $car['image'];
                        echo " <img  src='$url' class='img-fluid'>"
                        ?>
                    </td>
        </tbody>
    </table>
    <div>
        <form id="forms" method="post" action="cart.php?plate_number=<?php echo $car['plate_number']; ?>">
            <input type="hidden" name="plate_number1" id="plate_number1" value="<?php echo $car['plate_number']; ?>">
        <label>StartDate</label>
        <input name="start_date1" id="start_date1" type="date" value="2023-01-01">


        <label>EndDate</label>
        <input name="end_date1" id="end_date1" type="date" value="2023-01-04">
        <br>
        <br>
        <br>
        <input class="btn btn-success w-25 mb-2" type="submit" name="proceed" value="Proceed" style="margin-right:300px;">
        
        
        </form>

    </div>
    <a href="main.php" class="btn btn-primary">Return To Home Page</a>

    <script>
    //today.setHours(0,0,0,0);
var today=new Date();
var dd=String(today.getDate()).padStart(2,'0');
var mm=String(today.getMonth()+1).padStart(2,'0');
var yyyy=String(today.getFullYear());

today=yyyy+'-'+mm+'-'+dd;
document.getElementById("start_date1").addEventListener('change', () => {
start_date=document.getElementById("start_date1").value;
// var start=new Date(start_date);
if(start_date<today)
{

    alert("Enter Start Date After Today's Date");
    // return false;
}
  } );
document.getElementById("end_date1").addEventListener('change', () => {
end_date=document.getElementById("end_date1").value;
if(end_date<today )
{

    alert("Enter End Date After Today's Date");
}
else if(end_date<=start_date){
    alert("Enter End Date After Today's Date");
}

  } );
</script>

    
</body>
</html>