<?php
include "../config.php";
session_start();
error_reporting(0);
if (isset($_POST['alogin_submit'])) {
    $aid = $_POST['AID'];
    $apassword = md5($_POST['APASSWORD']);
    $sql = "SELECT * FROM admin_data WHERE AID = $aid AND APASSWORD = '$apassword'";
    $result = mysqli_query($connection, $sql);
    if (mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        $_SESSION['AID'] =$row['AID'];
       

        
      
        header("location:apersonal.php");
    } else {
        echo "<script>alert('Admin Id or Password may be Incorrect.')</script>";
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

    <style>
    .inputs {
        margin-top: 10px;
    }

    .myform {
        border: 0px solid;
        width: auto;
        padding: 30px;
        border-radius: 8px;
        
    }
    label{
      margin-right: 10px;
      margin-top: 10px;
    }
    </style>

    <script>
    function validate() {
        var aid = document.forms["myform"]["AID"].value;
        var lenaid = aid.length;
        if (lenaid != 6) {
            alert("Admin Id must be a 6 Digit Number");
            return false;
        }
    }
    </script>

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

    <!-- Log-In Form -->
    <div class="container-fluid" style="max-width: 100%; height:auto;">
        <div class="row justify-content-center align-items-center">
            <form action="" name="myform" method="POST" class="col-md-4 myform" style="margin: 50px 0px 0px 0px;"
                onsubmit="return validate()">
                <h4 class="text-center">Admin Log-In</h4>
                <hr>
                <div class="form-group row">
                    <div class="input-group inputs" style="width: auto;" >
                        <label for="ADMINID">ADMIN ID</label>
                        <input type="text" class="form-control" name="AID" autofocus required>
                    </div>
                    <div class="input-group inputs" style="width: auto;">
                    <label for="ADMINID">PASSWORD</label>
                        <input type="password" class="form-control" name="APASSWORD" required>
                    </div>
                </div>
                <div class="d-grid gap-2 inputs">
                    <input class="btn " type="submit" name="alogin_submit" value="Log-In" style="background-color: #adb5bd;;">
                </div>
                <h6 class="text-center inputs">or</h6>
                <h6 class="text-center inputs">
                    <a href="aregister.php" style="color: black; text-decoration: none;">Not a User? Register Now </a>
                    <a href="aforgotpassword.php" style="color: black; text-decoration: none;">| Forgot Password</a>
                </h6>
            </form>
          
        </div>
       
    </div>
    <!-- End of Log-In Form -->

    <!-- Footer -->
   
    <!-- End of Footer -->



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