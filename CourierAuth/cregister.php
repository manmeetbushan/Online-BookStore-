<?php
include "../config.php";
require "../mail_sender.php";
error_reporting(0);
session_start();

if (isset($_POST['creg_submit'])) {
    $cpassword = mysqli_escape_string($connection, md5($_POST['CPASSWORD']));
    $cconfirm_password = mysqli_escape_string($connection, md5($_POST['CCPASSWORD']));
    $cemail = mysqli_escape_string($connection, $_POST['CEMAIL']);

    if ($cpassword === $cconfirm_password) {
        $sql = "SELECT * FROM courier_data WHERE CEMAIL = '$cemail'";
        $result = mysqli_query($connection, $sql);
        if (!mysqli_num_rows($result) > 0) {
            $_SESSION['cid'] = mysqli_escape_string($connection, $_POST['CID']);
            $_SESSION['cfname'] = mysqli_escape_string($connection, $_POST['CFNAME']);
            $_SESSION['clname'] = mysqli_escape_string($connection, $_POST['CLNAME']);
            $_SESSION['cemail'] = $cemail;
            $_SESSION['cpassword'] = $cpassword;
            $_SESSION['cstate'] = mysqli_escape_string($connection, $_POST['CSTATE']);
            $_SESSION['otp'] = rand(10000, 99999);
            $reason = 'register';
            sendUserOtp($_SESSION['cemail'], $_SESSION['otp'], $_SESSION['cfname'], $_SESSION['clname'], $reason);
            header('location:cotpreg.php');
        } else {
            echo "<div class='alert alert-danger alert-dismissible fade show' role='alert'
            style='max-width: 70%; position: absolute; top: 10%;' >
            Email Id Already Exists.
            <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
            </div>";
        }
    } else {
        echo "<div class='alert alert-danger alert-dismissible fade show' role='alert'
        style='max-width: 70%; position: absolute; top: 10%;' >
        Password not Matched. Please Enter Same Passwords.
        <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
        </div>";
    }
}
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



    <script>
    function validate() {
        var cid = document.forms['myform']['CID'].value;
        var lencid = cid.length;
        if (lencid != 6) {
            alert("Courier ID must be a 6 Digit Number.");
            return false;
        }
    }
    </script>

    <title>Register</title>
</head>

<body>
    <!--nav bar -->
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
                        <a class="nav-link" style="margin-right: 20px;" aria-current="page" href="../home.php">Home</a>
                    </li>

                    <!-- Log In -->
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" style="margin-right: 10px;" href="#" id="navbarDropdown"
                            role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Log-In
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <li>
                                <a class="dropdown-item" href="alogin.php">
                        
                                    Admin login
                                </a>
                            </li>

                

                            <li>
                                <a class="dropdown-item" href="../uauth/ulogin.php">
                    
                                    User login
                                </a>
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
                        <a class="nav-link dropdown-toggle active" style="margin-right: 10px;" href="#"
                            id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Register
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <li>
                                <a class="dropdown-item" href="aregister.php">
                        
                                    Admin register
                                </a>
                            </li>
                            <li>
                                <a class="dropdown-item" href="../uauth/ureg.php">
                    
                                    User register
                                </a>
                            </li>
                            <li>
                                <a class="dropdown-item" href="../CourierAuth/cregister.php">
                                    
                                    Deliveryman register
                                </a>
                            </li>
                        </ul>
                    </li>

                
                </ul>
            </div>
        </div>
    </nav>

    <!-- End of Navbar -->

    <!-- Registration Form -->
    <div class="container-fluid">
        <div class="row justify-content-center align-items-center">
        
            <form name="myform" action="" method="POST" class="col-md-4 myform" style="margin: 30px 0px 0px 0px;"
                onsubmit="return validate()">
                <h4 class="text-center">Courier Registration</h4>
                <hr>
                <div class="form-group row">
                    <div class="input-group inputs" style="width: auto;">
                        <span class="input-group-text" style="width: 160px;">Courier ID</span>
                        <input type="number" class="form-control" name="CID" autofocus required>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="input-group inputs" style="width: auto;">
                        <span class="input-group-text" style="width: 160px;">First Name</span>
                        <input type="text" class="form-control" name="CFNAME" required>
                    </div>
                    <div class="input-group inputs" style="width: auto;">
                        <span class="input-group-text" style="width: 160px;">Last Name </span>
                        <input type="text" class="form-control" name="CLNAME" required>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="input-group inputs" style="width: auto;">
                        <span class="input-group-text" style="width: 160px;">Email-ID</span>
                        <input type="email" class="form-control" name="CEMAIL" required>
                    </div>
                    <div class="input-group inputs" style="width: auto;">
                        <span class="input-group-text" style="width: 160px;">State</span>
                        <select class="form-select" id="inputGroupSelect01" style="width: 242px;" name="CSTATE">
                        <option value="J&K" name="CSTATE">Jammu And Kashmir</option>
                            <option value="Goa" name="CSTATE">Goa</option>
                            <option value="Punjab" name="CSTATE">Punjab</option>
                            <option value="uttarakhand" name="CSTATE">Uttarakhand</option>
                            <option value="Uttar Pradesh" name="CSTATE">Uttar Prad"CSTATE">Himachal Pradesh</option>
                            <option value="Rajasthan" name="CSTATE">Rajasthan</option>
                            <option value="Madhyapradesh" name="CSTATE">Madhya pradesh</option>
                            <option value="Gujarat" name="CSTATE">Gujarat</option>
                            <option value="Jharkhand" name="CSTATE">Jharkhand</option>
                            <option value="Chattisgarh" name="CSTATE">Chattisgarh</option>
                            <option value="Chandigarh" name="CSTATE">Chandigarh</option>
                            <option value="Daman and Diu and Dadra Haveli" name="CSTATE">Daman and diu and dadra and nagar heveli</option>
                            <option value="Arunachal Pradesh" name="CSTATE">Arunachal Pradesh</option>
                            <option value="Sikkim" name="CSTATE">Sikkim</option>
                            <option value="WestBengal" name="CSTATE">West Bengal</option>
                            <option value="Bihar" name="CSTATE">Bihar</option>
                            <option value="Nagaland" name="CSTATE">Nagaland</option>
                            <option value="AndhraPradesh" name="CSTATE">Andhra Pradesh</option>
                            <option value="Karnataka" name="CSTATE">Karnataka</option>
                            <option value="TamilNadu" name="CSTATE">Tamil Nadu</option>
                        </select>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="input-group inputs" style="width: auto;">
                        <span class="input-group-text" style="width: 160px;">Password</span>
                        <input type="password" class="form-control" name="CPASSWORD" required>
                    </div>
                    <div class="input-group inputs" style="width: auto;">
                        <span class="input-group-text" style="width: 160px;">Confirm Password</span>
                        <input type="password" class="form-control" name="CCPASSWORD" required>
                    </div>
                </div>
                <div class="d-grid gap-2 inputs">
                    <input class="btn btn-success" type="submit" name="creg_submit" value="Get OTP"
                        style="background-color:#adb5bd ; border:#adb5bd">
                </div>
                <h6 class="text-center inputs">or</h6>
                <h6 class="text-center inputs"><a href="clogin.php" style="color: black; text-decoration: none;">Already
                        Registered? Log-In</a>
                </h6>
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