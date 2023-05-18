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
<h1>Enter specified day:</h1>
<form action="" method="post">
<fieldset>
<p><input type="text" name="rdate" required value="yy-mm-dd" onBlur="if(this.value=='')this.value='yy-mm-dd'" onFocus="if(this.value=='yy-mm-dd')this.value='' "></p>
<p><input name="submit" type="submit" value="Report"></p>
<a href="main.php" ><i class="fa-solid fa-house"></i></a>
</fieldset>

</form>

</div> 



<?php
$sobhy ="";
$i=0;
$j=0;
$k=0;

require('connection.php');
if(isset($_POST['submit']))
{
  $rdate=$_POST['rdate'];  
  
  $query = "SELECT * FROM reservation WHERE reservation.start_date <= '$rdate' AND end_date >= '$rdate'";
  $sql =  $con->prepare($query); 
  $result = $sql->execute();
  $rented_cars = $sql->fetchAll(PDO::FETCH_ASSOC);

  $query2 = "SELECT * FROM car ";
  $sql2 =  $con->prepare($query2); 
  $result2 = $sql2->execute();
  $cars = $sql2->fetchAll(PDO::FETCH_ASSOC);

  
  
  foreach($cars as $car)
  {
      $sobhy[$k]="1";
      foreach($rented_cars as $rented_car)
      {
          if($car['plate_number']==$rented_car['plate_number'] and $rented_car['start_date'] <= $rdate and $rented_car['end_date'] >= $rdate)
          {
              $sobhy[$k]="0";
              //$car['state'] = "rented";      
              break;
            }
                }
                $k=$k+1;
            }
            
            ?>

<table class="table">
    <thead>
        <tr>
                <th scope="col">Plate number</th>
                <th scope="col">Car brand</th>
                <th scope="col">Car model</th>
                <th scope="col">release year</th>

                <th scope="col">Car state</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach($cars as $car): ?>
                <tr>
                    <td><?php echo $car['plate_number'];?></td>
                    <td><?php echo $car['brand'];?></td>
                    <td><?php echo $car['model'];?></td>
                    <td><?php echo $car['release_year'];?></td>
                    <?php if ($sobhy[$j]=='1'): ?>
                        <td><?php echo $car['state'];?></td>
                    <?php else : ?>
                        <td><?php echo "rented";?></td>      
                </tr>
                <?php endif; ?>
                <?php $j=$j+1; ?>
                <?php endforeach; ?>
            </tbod>
        <?php }?>
        </body>
        </html>