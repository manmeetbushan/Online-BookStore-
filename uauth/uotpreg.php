<?php
require("../mail_sender.php");
include "../config.php";
error_reporting(0);
session_start();

$uemail = $_SESSION['uemail'];
$ufname = $_SESSION['ufname'];
$ulname = $_SESSION['ulname'];
$ugender = $_SESSION['ugender'];
$upassword = $_SESSION['upassword'];
$uaddress1 = $_SESSION['uaddress1'];
$uphone = $_SESSION['uphone'];
$uaddress2 = $_SESSION['uaddress2'];
$upincode=$_SESSION['upincode'];
$ustate=$_SESSION['ustate'];
$otp = $_SESSION['otp'];

// INSERTING DATA
$uotp = mysqli_escape_string($connection, $_POST['UOTP']);
if (isset($_POST['ureg_otp'])) {
    if ($otp == $uotp) {
        $sql = "INSERT INTO user_data VALUES ('$uemail','$ufname','$ulname','$ugender','$upassword','$uaddress1','$uaddress2',$uphone,$upincode,'$ustate')";
      
       $result =mysqli_query($connection,$sql);
       if ($result) {
        header("refresh:5;url=ulogin.php");
        echo "<div class='alert alert-success alert-dismissible fade show' role='alert'
        style='max-width: 70%; position: absolute; top: 10%;' >
        Congrats You have Successfully Registered.
        <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
        </div>";
    } else {
        header("refresh:5;url=aregister.php");
        echo "<div class='alert alert-danger alert-dismissible fade show' role='alert'
        style='max-width: 70%; position: absolute; top: 10%;' >
        Admin Id already exists.
        <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
        </div>";
    }
 }
     else {
        //header("refresh:5;url=aotpreg.php");
        echo "<div class='alert alert-danger alert-dismissible fade show' role='alert'
            style='max-width: 70%; position: absolute; top: 10%;' >
            Please enter a Correct OTP.
            <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
            </div>";
    }
}


// END OF INSERTING DATA
//$sql = "INSERT INTO generated_otp(OTP,ISSUETIME) VALUES ($otp,ADDTIME(CURRENT_STAMP(),001500))";
//$result = mysqli_query($connection, $sql);
//if ($result) {
//}

?>

<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

    <link rel="stylesheet" href="ustyle.css">

    <title>Register</title>
</head>

<body>
    <!-- Navbar -->
     
    <img src="../bg.jpg" alt="bg" class="bg" style="
      width: 100%; 
      position:absolute; 
      z-index:-1;
      ">
    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

    <!-- Option 2: Separate Popper and Bootstrap JS -->
    <!--
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>
    -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
  <div class="container-fluid">
    <a class="navbar-brand" href="#">کتُب خانہ</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="../home.php">Home</a>
        </li>
       
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
           Login
          </a>
          <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
            <li><a class="dropdown-item" href="../alogin.php">Admin Login</a></li>
            <li><a class="dropdown-item" href="ulogin.php">User Login</a></li>

          </ul>
        </li>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            Register
          </a>
          <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
            <li><a class="dropdown-item" href="ureg.php">User Register</a></li>
            <li><a class="dropdown-item" href="areg.php">Admin Register</a></li>
          </ul>
        </li>
        <li class="nav-item">
          <a class="nav-link disabled">Disabled</a>
        </li>
      </ul>
      
    </div>
  </div>
</nav>
    
    <!-- Registration Form -->
    <div class="container-fluid" >
        <div class="row justify-content-center align-items-center">
            <form name="myform" action="" method="POST" class="col-md-4 myform" style="margin: 30px 0px 0px 0px;">
                <div class="form-group row">
                    <div class="input-group inputs" style="width: auto;">
                        <span class="input-group-text" style="width: 160px;">One Time Password</span>
                        <input type="number" class="form-control" name="UOTP" required>
                    </div>
                </div>
                <div class="d-grid gap-2 inputs">
                    <input class="btn " type="submit" name="ureg_otp" value="Register"
                        style="background-color:gray;">
                </div>
            </form>
        </div>
    </div> 
    <!-- End of Registration Form -->



    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous">
    </script>

    <!-- Option 2: Separate Popper and Bootstrap JS -->
    <!--
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>
    -->
</body>

</html>