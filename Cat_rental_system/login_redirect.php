<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <script src="index.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css" integrity="sha512-xh6O/CkQoPOWDdYTDqeRdPCVd1SpvCA9XXcUnZS2FmJNp1coAFzvtCN9BmamE+4aHK8yyUHUSCcJHgXloTyT2A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="style2.css">
    <title>Login</title>
</head>

<body>
    <div class="d-flex align-items-center justify-content-center login">
        <form action="" onsubmit="empty()" method="POST" class="border border-dark py-3 rounded border-2 w-25 shadow-sm p-3 mb-5 bg-body rounded form2">
            <div class="d-flex align-items-center justify-content-center flex-column">
                <h2 class="text-primary">Welcome</h2>
                <i class="fa-solid fa-user fa-2x text-primary"></i>
            </div>
            <div class="mb-3 mx-3 mt-4">
                <label for="email" class="form-label fw-bold text-primary"><i class="fa-solid fa-envelope"></i> Email Address</label>
                <input type="email" class="form-control shadow-sm p-3 bg-body rounded" name="email" placeholder="Please Enter Your Email" id="email">
            </div>
            <div class="mb-3 mx-3 pt-4">
                <label for="password" class="form-label fw-bold text-primary"><i class="fa-solid fa-lock"></i> Password</label>
                <input type="password" class="form-control shadow-sm p-3 mb-4 bg-body rounded" name="password" placeholder="Please Enter Your Password" id="password">
                <a href="signup.html" class="text-decoration-none fw-bold"><i class="fa-sharp fa-solid fa-user-plus"></i> Sign Up</a>
            </div>
            <button type="submit" name="submit" class="btn btn-primary mx-3 mb-1 px-3">Log In</button>
        </form>
    </div>
    <?php
        session_start();
        if(isset($_POST['submit']))
        {
        require_once('connection.php');
         $email=$_POST['email'];
         $password=$_POST['password'];
         if($email!="" && $password!=""){
            $query = "SELECT * FROM customer where email = '$email'";
            $sql = $con->prepare($query);
            $sql->execute();
            $user = $sql->fetch(PDO::FETCH_ASSOC);
            if($user==null){
                echo "<div class='text-center'><h1>Wrong Email</h1></div>";
            }
            if($user!=null){
                 if($user['password']!= $password){
                    echo "<div class='text-center'><h1>Wrong Password</h1></div>";
                    }
                 else
                {
                    // $GLOBALS['temp2']=1;
                    $_SESSION['email']=$email;
                    header('Location:cart.php');
                 }
            }
         }
        }
        ?>
</body>
<script>
    function empty(){
        var email= document.getElementById("email").value;
        var password= document.getElementById("password").value;
        if(email == ""){
            alert("email is empty");
            return false;
        }
        if(password == ""){
            alert("password is empty");
            return false;
        }
}
</script>
</html>