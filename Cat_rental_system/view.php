<?php
        session_start();
        require_once('connection.php');

        $rented="select start_date,end_date,plate_number from reservation";        
        $sql = $con->prepare($rented);
        $sql->execute();
        $rented_cars = $sql->fetchAll(PDO::FETCH_ASSOC);
       

        $sobhy ="";
        $i=0;
        $j=0;
        $k=0;
        
        $flag=False;

        
         if(isset($_POST['Search']))
         {
         require_once('connection.php');


         $min=$_POST['minimum'];
         $max=$_POST['maximum'];
         $start_date=$_POST['start_date'];
         $end_date=$_POST['end_date'];
         $_SESSION['start_date']=$start_date;
         $_SESSION['end_date']=$end_date;
        
         

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
            $query="select * FROM car as c join office as o on o.office_id=c.office_id   where c.brand in (" . $selectedOption . ") AND c.state='active'  AND c.price BETWEEN '$min' AND '$max'";

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
                
                $query="select * FROM car as c join office as o on o.office_id=c.office_id   where c.model in (" . $selectedOption . ") AND c.state='active'  AND c.price BETWEEN '$min' AND '$max'";
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
                $query="select * FROM car as c join office as o on o.office_id=c.office_id   where c.color in (" . $selectedOption . ") AND c.state='active'  AND c.price BETWEEN '$min' AND '$max'";
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
                
            $query="select * FROM car as c join office as o on o.office_id=c.office_id   where c.release_year in (" . $selectedOption . ") AND c.state='active'  AND c.price BETWEEN '$min' AND '$max'";            }
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
                $query="select * FROM car as c join office as o on o.office_id=c.office_id   where c.seats in (" . $selectedOption . ") AND c.state='active'  AND c.price BETWEEN '$min' AND '$max'";            }
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
                
                    $query="select * FROM car as c join office as o on o.office_id=c.office_id   where o.location in (" . $selectedOption . ") AND c.state='active'  AND c.price BETWEEN '$min' AND '$max'";            }
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
                $query="select * FROM car as c join office as o on o.office_id=c.office_id   where o.city in (" . $selectedOption . ") AND c.state='active'  AND c.price BETWEEN '$min' AND '$max'";            }
                $flag=True;

            }



         
         if ($flag==False)
        {
            $query = "select * FROM car where  state='active'  AND price BETWEEN '$min' AND '$max'";

        }



        #Concatatenate ; to the end of the query and then execute it 
             $query=$query.";";          

             $sql = $con->prepare($query);
             $sql->execute();
             $cars = $sql->fetchAll(PDO::FETCH_ASSOC);

               
          }
        ?>

<!DOCTYPE html>
<html lang="en">

<head>
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
    <title>result</title>

    <style>
  body{
            
            background-image: url('images/car-background.jpg');
            background-size:center;
            background-position:center 40%;
    
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

    </style>
</head>

<body>
    <table class="table" id="table">
        <thead>
            <tr class="tr_first">
                <th scope="col">Plate Number</th>
                <th scope="col">Brand</th>
                <th scope="col">Model</th>
                <th scope="col">Release Year</th>
                <th scope="col">Color</th>
                <th scope="col">Price</th>
                <th scope="col">Seats</th>
                <th scope="col">Office Id</th>
                <th  scope="col">image</th>
                <th scope="col">Actions</th>

            </tr>
        </thead>
        <tbody>



            <?php foreach($cars as $car)
                {
                foreach($rented_cars as $rented_car)
                {
                    if($car['plate_number']==$rented_car['plate_number'] and $rented_car['start_date']>=$start_date and $rented_car['end_date']<=$end_date)
                        {
                         
                            $sobhy[$k]='0';      
                            break;

                        }


                        else if($car['plate_number']==$rented_car['plate_number'] and $start_date <=$rented_car['start_date']and ($rented_car['start_date']<=$end_date and $end_date<=$rented_car['end_date']))
                        {
                            $sobhy[$k]='0';                           
                             break;

                        }

                        else if($car['plate_number']==$rented_car['plate_number'] and ($start_date >=$rented_car['start_date'] and $start_date<=$rented_car['end_date'])and ($rented_car['start_date']<$end_date and $end_date>$rented_car['end_date']))
                        {
                            $sobhy[$k]='0';
                            break;

                        }

                        else if($car['plate_number']==$rented_car['plate_number'] and $rented_car['start_date']<=$start_date and $rented_car['end_date']>=$end_date)
                        {
                            $sobhy[$k]='0';
                            break;

                        }

          


                
                     else
                        {   
                        $sobhy[$k]='1';
                         }


                }
                $k=$k+1;


                }

            ?>



            <?php  foreach($cars as $car):?>
            <tr>
                <?php if ($sobhy[$j]=='1'): ?>
                <td><?php echo $car['plate_number'];?></td>
                <td><?php echo $car['brand'];?></td>
                <td><?php echo $car['model'];?></td>
                <td><?php echo $car['release_year'];?></td>
                <td><?php echo $car['color'];?></td>
                <td><?php echo $car['price'];?></td>
                <td><?php echo $car['seats'];?></td>
                <td><?php echo $car['office_id'];?></td>
                
                <td><?php
                    $url ="images/".$car['image'];
                    echo "<img src='$url'>"
                    
                    ?></td>    
                <td>
                    <a href="cart.php?car_id=<?php echo $car['plate_number'];?> "><i class="fa-solid fa-car"></i></a>
                </td>

                <?php else : ?>
                    <? echo "Error Case "; ?>



            </tr>
            <?php endif;?>
            <?php $j=$j+1; ?>
            <?php endforeach; ?>


        </tbody>
    </table>

</body>

</html>



<script>
$("#table tr").click(function() {
    $(this).addClass('selected').siblings().removeClass('selected');
    var value = $(this).find('td:first').html();
    alert(value);
});

$('.ok').on('click', function(e) {
    alert($("#table tr.selected td:first").html());
});
</script>