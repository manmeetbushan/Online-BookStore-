<?php
require("../mail_sender.php");
include "../config.php";
error_reporting(0);
session_start();

// Updating Password
if (isset($_POST['uforgot_otp'])) {
    $uemail  = $_SESSION['fuemail'];
    $newPassword = $_SESSION['fnewPassword'];
    $otp = $_SESSION['fotp'];

    $uotp = mysqli_escape_string($connection, $_POST['UOTP']);

    if ($uotp == $otp) {
        $sql = "UPDATE `user_data` SET UPASSWORD = '$newPassword' WHERE UEMAIL = '$uemail' ";
        $result = mysqli_query($connection, $sql);
        if ($result) {
            header("refresh:5;url=ulogin.php");
            echo "<div class='alert alert-success alert-dismissible fade show' role='alert'
            style='max-width: 70%; position: absolute; top: 10%;' >
            Password Changed Successfully.
            <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
            </div>";
        } else {
            header("refresh:5;url=uforgotpassword.php");
            echo "<div class='alert alert-danger alert-dismissible fade show' role='alert'
            style='max-width: 70%; position: absolute; top: 10%;' >
            Whoops Something Went Wrong.
            <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
            </div>";
        }
    } else {
        echo "<div class='alert alert-danger alert-dismissible fade show' role='alert'
            style='max-width: 70%; position: absolute; top: 10%;' >
            Please enter a correct OTP.
            <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
            </div>";
    }
}
// End of Updating Password

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


    <title>Register</title>
</head>

<body>
    <!-- Navbar -->
        
    <img src="../bg.jpg" alt="bg" class="bg" style="
      width: 100%; 
      position:absolute; 
      z-index:-1;
      ">

    <nav class="navbar navbar-expand-lg navbar-dark bg-dark sticky-top" style="padding: 10px 30px 10px 30px">
        <div class="container-fluid">
            <a class="navbar-brand" href="../home.php">
                <!-- <img src="images/AdminLogo.png" style="width: 40px;" alt="Admin">
                <img src="images/UserLogo.png" style="width: 40px;" alt="Admin">
                <img src="images/DeliveryLogo.png" style="width: 40px;" alt="Admin"> -->
                BOOKSTORE
            </a>

            <!-- Button which pops when window is minimized -->
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav" style="margin-left: auto;">
                    <!-- Home -->
                    <li class="nav-item">
                        <a class="nav-link" style="margin-right: 20px;" aria-current="page" href="../index.php">Home</a>
                    </li>

                    <!-- Log In -->
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" style="margin-right: 10px;" href="#" id="navbarDropdown"
                            role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Log-In
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <li>
                                <a class="dropdown-item" href="../AdminAuth/alogin.php">
                                    Admin login
                                </a>
                            </li>

                            <li>
                                <hr class="dropdown-divider">
                            </li>

                            <li>
                                <a class="dropdown-item" href="ulogin.php">
                                    user login
                                </a>
                            </li>

                            <li>
                                <hr class="dropdown-divider">
                            </li>

                            <li>
                                <a class="dropdown-item" href="../CourierAuth/clogin.php">
                                    Deliveryman login
                                </a>
                            </li>
                        </ul>
                    </li>

                    <!-- Register -->
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" style="margin-right: 10px;" href="#" id="navbarDropdown"
                            role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Register
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <li>
                                <a class="dropdown-item" href="../AdminAuth/aregister.php">
                                    Admin
                                </a>
                            </li>
                            <li>
                                <hr class="dropdown-divider">
                            </li>
                            <li>
                                <a class="dropdown-item" href="uregister.php">
                                    User register
                                </a>
                            </li>
                            <li>
                                <hr class="dropdown-divider">
                            </li>
                            <li>
                                <a class="dropdown-item" href="../CourierAuth/cregister.php">
                                    <img src="../Images/DeliveryLogo.png" style="width: 40px;" alt="Admin">
                                    Deliveryman
                                </a>
                            </li>
                        </ul>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" style="margin-right: 10px;" href="#">Contact Us</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <!-- End of Navbar -->

    <!-- Registration Form -->
    <div class="container-fluid">
        <div class="row justify-content-center align-items-center">
            <img src="../Images/UserOTP.svg" class="col-md-4 img-fluid" alt="" style="margin: 100px 0px 0px 0px;">
            <form name="myform" action="" method="POST" class="col-md-4 myform" style="margin: 30px 0px 0px 0px;">
                <div class="form-group row">
                    <div class="input-group inputs" style="width: auto;">
                        <span class="input-group-text" style="width: 160px;">One Time Password</span>
                        <input type="number" class="form-control" name="UOTP" required>
                    </div>
                </div>
                <div class="d-grid gap-2 inputs">
                    <input class="btn btn-success" type="submit" name="uforgot_otp" value="Change My Password"
                        style="background-color: black; border:#79FE0C">
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