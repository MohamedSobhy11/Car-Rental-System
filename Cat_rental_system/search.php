<?php

$hostname = "localhost";
$username = "root";
$password = "";
$databaseName = "car_rental_system";


$connect = mysqli_connect($hostname, $username, $password, $databaseName);

$query1 = "SELECT DISTINCT brand FROM car ORDER BY brand";
$result1 = mysqli_query($connect, $query1);
$options1 = "";
while ($row1 = mysqli_fetch_array($result1)) {
    $options1 = $options1 . "<option>$row1[0]</option>";
}





// $query2 = "SELECT DISTINCT model,brand FROM car ";
// $result2 = mysqli_query($connect, $query2);
// $options2 = "";
// $options5 = "";


// while($row2 = mysqli_fetch_row($result2))
// {   
//     $options2 = $options2."<option>$row2[0]</option>";
//     $options5= $row2[1];
// }


$query2 = "SELECT DISTINCT model FROM car ";
$result2 = mysqli_query($connect, $query2);
$options2 = "";

while ($row2 = mysqli_fetch_row($result2)) {
    $options2 = $options2 . "<option>$row2[0] </option>";
}



$query3 = "SELECT DISTINCT color FROM car ORDER BY color";
$result3 = mysqli_query($connect, $query3);
$options3 = "";
while ($row3 = mysqli_fetch_array($result3)) {
    $options3 = $options3 . "<option>$row3[0]</option>";
}



$query4 = "SELECT DISTINCT release_year FROM car ORDER BY release_year";
$result4 = mysqli_query($connect, $query4);
$options4 = "";
while ($row4 = mysqli_fetch_array($result4)) {
    $options4 = $options4 . "<option>$row4[0]</option>";
}


$query6 = "SELECT DISTINCT seats FROM car ORDER BY seats";
$result6 = mysqli_query($connect, $query6);
$options6 = "";
while ($row6 = mysqli_fetch_array($result6)) {
    $options6 = $options6 . "<option>$row6[0]</option>";
}



$query7 = "SELECT DISTINCT location FROM office ORDER BY location";
$result7 = mysqli_query($connect, $query7);
$options7 = "";
while ($row7 = mysqli_fetch_array($result7)) {
    $options7 = $options7 . "<option>$row7[0]</option>";
}


$query8 = "SELECT DISTINCT city FROM office ORDER BY city";
$result8 = mysqli_query($connect, $query8);
$options8 = "";
while ($row8 = mysqli_fetch_array($result8)) {
    $options8 = $options8 . "<option>$row8[0]</option>";
}




?>



<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-wEmeIV1mKuiNpC+IOBjI7aAzPcEZeedi5yW5f2yOq55WWLwNGmvvx4Um1vskeMj0" crossorigin="anonymous">
    <link rel="stylesheet" href="search.css">
    <title>Car Specifications</title>

    <style>
        select {
            width: 10%;
        }
    </style>
</head>


<body>


    <div class="container">
        <form method="post" action="view.php" id="forms">
            <h1>Car Specifications</h1>
            <br>

            <div class="row">
                <div class="col ">


                    <label>Brand</label>
                    <select class="w-25" name="brand[]" id="brand[]" multiple multiselect-search="true" multiselect-select-all="true"
                        onchange="console.log(this.selectedOptions)">
                        <?php echo $options1; ?>
                    </select>

                    

                    <label>Country</label>
                    <select  class="w-25" name="country[]" id="country[]" multiple multiselect-search="true"
                        multiselect-select-all="true" onchange="console.log(this.selectedOptions)">
                        <?php echo $options7; ?>
                    </select>


                    <label>City</label>
                    <select  class="w-25" name="city[]" id="city[]" multiple multiselect-search="true" multiselect-select-all="true"
                        onchange="console.log(this.selectedOptions)">
                        <?php echo $options8; ?>
                    </select>







                    <label>Model</label>
                    <select  class="w-25" name="model[]" id="model[]" multiple multiselect-search="true" multiselect-select-all="true"
                        onchange="console.log(this.selectedOptions)">
                        <?php echo $options2; ?>
                    </select>

                    <br>    
                    <br>

                    <label>Color</label>
                    <select  class="w-25" name="color[]" id="color[]" multiple multiselect-search="true" multiselect-select-all="true"
                        onchange="console.log(this.selectedOptions)">
                        <?php echo $options3; ?>
                    </select>
                    <br>
                    <br>
                    <label>Release Year</label>
                    <select  class="w-25" name="release_year[]" id="release_year[]" multiple multiselect-search="true"
                        multiselect-select-all="true" onchange="console.log(this.selectedOptions)">
                        <?php echo $options4; ?>

                    </select>
                    <br>
                    <br>

                    <label>Number of Seats</label>
                    <select  class="w-25" name="seats[]" id="seats[]" multiple multiselect-search="true" multiselect-select-all="true"
                        onchange="console.log(this.selectedOptions)">
                        <?php echo $options6; ?>


                    </select>
                    <br>
                    <br>




                    <div class="wrapper">
                        <label> Price</label>
                        <div class="separator">----</div>
                        <div class="price-input">
                            <div class="field">
                             
                                <label style="margin-right:5px;" for="Min">Min</label>
                                <input type="number" class="input-min" value="1000" name="minimum" id="minimum">
                                <label for="max">Max</label>
                                <input type="number" class="input-max" value="100000" name="maximum" id="maximum">
                            
                            </div>
                            
                           
                             
                        </div>
         
                        <div class="range-input">
                            <input style="margin-left: 30px;" type="range" class="range-min" min="0" max="100000" value="1000" step="500">
                            <input style="margin-left: 120px;" type="range" class="range-max" min="0" max="100000" value="100000" step="500">
                        </div>
                    </div>

                    <br>

                    <label>StartDate</label>
                    <input style="margin-right: 10px; width: 20%;" name="start_date" id="start_date" type="date" value="2022-12-27">


                    <label>EndDate</label>
                    <input name="end_date" id="end_date" type="date" value="2022-12-27">

                    <br>
                    <br>
                    <br>




                    <input type="submit" name="Search" value="Search" style="margin-left:100px; padding: 10px; font-weight: 700; background-color: transparent;" >


        </form>
        <a href="main.php" class="btn"style="margin-left:100px; padding: 10px; font-weight: 700; background-color: transparent; border:2px solid black">Return To Home</a>

    </div>








    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-p34f1UUtsS3wqzfto5wAAmdvj+osOnFyQFpp4Ua3gs/ZVWx6oOypYoCJhGGScy+8"
        crossorigin="anonymous"></script>
    <script src="multiselect-dropdown.js"></script>
    <script src="carsZ.js"  ></script>
     <script src="cars1Z.js"  ></script>

     <script>
    //today.setHours(0,0,0,0);
var today=new Date();
var dd=String(today.getDate()).padStart(2,'0');
var mm=String(today.getMonth()+1).padStart(2,'0');
var yyyy=String(today.getFullYear());

today=yyyy+'-'+mm+'-'+dd;
document.getElementById("start_date").addEventListener('change', () => {
start_date=document.getElementById("start_date").value;
// var start=new Date(start_date);
if(start_date<today)
{

    alert("Enter Start Date After Today's Date");
    // return false;
}
  } );
document.getElementById("end_date").addEventListener('change', () => {
end_date=document.getElementById("end_date").value;
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
