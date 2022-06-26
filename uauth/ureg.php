<?php
include "../config.php";
require "../mail_sender.php";
error_reporting(0);
session_start();

if (isset($_POST['ureg_submit'])) {
    $upassword = mysqli_escape_string($connection, md5($_POST['UPASSWORD']));
    $uconfirm_password = mysqli_escape_string($connection, md5($_POST['UCPASSWORD']));
    $uemail = mysqli_escape_string($connection, $_POST['UEMAIL']);
    $uphone = mysqli_escape_string($connection, $_POST['UPHONE']);

    if ($upassword === $uconfirm_password) {
        $sql = "SELECT * FROM user_data WHERE UEMAIL = '{$uemail}' OR UPHONE = {$uphone}";
        $result = mysqli_query($connection, $sql);
        if (!mysqli_num_rows($result) > 0) {
            $_SESSION['uemail'] = $uemail;
            $_SESSION['uphone'] = $uphone;
            $_SESSION['ustate'] = mysqli_escape_string($connection, $_POST['USTATE']);
            $_SESSION['ufname'] = mysqli_escape_string($connection, $_POST['UFNAME']);
            $_SESSION['ulname'] = mysqli_escape_string($connection, $_POST['ULNAME']);
            $_SESSION['ugender'] = mysqli_escape_string($connection, $_POST['UGENDER']);
            $_SESSION['upincode']=mysqli_escape_string($connection,$_POST['UPINCODE']);
            $_SESSION['upassword'] = $upassword;
            $_SESSION['uaddress1'] = mysqli_escape_string($connection, $_POST['UADDRESS1']);
            $_SESSION['uaddress2'] = mysqli_escape_string($connection, $_POST['UADDRESS2']);
            $_SESSION['otp'] = rand(10000, 99999);
            $reason = 'register';
            $answer = sendUserOtp( $_SESSION['uemail'], $_SESSION['otp'], $_SESSION['ufname'], $_SESSION['ulname'], $reason);
            if ($answer) {
                header('location:uotpreg.php');
            } else {
                echo "<div class='alert alert-danger alert-dismissible fade show' role='alert'
                style='max-width: 70%; position: absolute; top: 10%;' >
                Mail Not Sent. Try Again.
                <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
                </div>";
            }
        } else {
            echo "<div class='alert alert-danger alert-dismissible fade show' role='alert'
            style='max-width: 70%; position: absolute; top: 10%;' >
            Email Id/Phone Number Already Exists.
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

    <link rel="stylesheet" href="ustyle.css">

    <script>
    function validate() {
        var phone = document.forms['myform']['UPHONE'].value;
        var lenphone = phone.length;
        var lpincode = pincode.length;
        if (lenphone != 10) {
            alert("Phone Number must be a 10 Digit Number");
            return false;
        }
        if (lpincode !=6 || pincode<0) {
            alert("Enter a valid 6 digit pincode");
            return false;
        }

    }
    </script>

    <title>Register</title>
    <style>
        .myfooter{
            height: 20px;

        }
        label{
            margin-right: 10px;
            margin-top: 10px;
        }
        .input{
            width: 20px;
        }
    </style>
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
    <a class="navbar-brand" href="#">BOOKSTORE</a>
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
            <li><a class="dropdown-item" href="../adminauth/alogin.php">Admin Login</a></li>
            <li><a class="dropdown-item" href="ulogin.php">User Login</a></li>

          </ul>
        </li>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            Register
          </a>
          <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
            <li><a class="dropdown-item" href="ureg.php">User Register</a></li>
            <li><a class="dropdown-item" href="../adminauth/aregister.php">Admin Register</a></li>
          </ul>
        </li>
      
      </ul>
      
    </div>
  </div>
</nav>
    <!-- End of Navbar -->

    <!-- Registration Form -->
    
        <div class="row justify-content-center align-items-center">
           
            <form name="myform" action="" method="POST" class="col-md-4 myform" style="margin: 30px 0px 0px 0px;"
                onsubmit="return validate()">
                <h4 class="text-center">User Registration</h4>
                <hr>
                <div class="form-group row">
                    <div class="input-group inputs" style="width: auto;">
                       <label for="ufname">First name</label>
                        <input type="text" class="form-control" name="UFNAME" required
                            value="<?php if (isset($_SESSION['ufname'])) $_SESSION['ufname'] ?>">
                    </div>
                    <div class="form-group row">
                    <div class="input-group inputs" style="width: auto;">
                        <label for="ulname">Last name</label>
                        <input type="text" class="form-control" name="ULNAME" required>
                    </div>
    </div>
                </div>
                <div class="form-group row">
                    
                    <div class="input-group inputs" style="width: auto;">
                    <label for="State">State</label>
                        <select class="form-select" id="inputGroupSelect01" style="width: 206px;" name="USTATE" >
                            <option value="J&K" name="USTATE">Jammu And Kashmir</option>
                            <option value="Goa" name="USTATE">Goa</option>
                            <option value="Punjab" name="USTATE">Punjab</option>
                            <option value="uttarakhand" name="USTATE">Uttarakhand</option>
                            <option value="Uttar Pradesh" name="USTATE">Uttar Pradesh</option>
                            <option value="Himachal Pradesh" name="USTATE">Himachal Pradesh</option>
                            <option value="Rajasthan" name="USTATE">Rajasthan</option>
                            <option value="Madhyapradesh" name="USTATE">Madhya pradesh</option>
                            <option value="Gujarat" name="USTATE">Gujarat</option>
                            <option value="Jharkhand" name="USTATE">Jharkhand</option>
                            <option value="Chattisgarh" name="USTATE">Chattisgarh</option>
                            <option value="Chandigarh" name="USTATE">Chandigarh</option>
                            <option value="Daman and Diu and Dadra Haveli" name="USTATE">Daman and diu and dadra and nagar heveli</option>
                            <option value="Arunachal Pradesh" name="USTATE">Arunachal Pradesh</option>
                            <option value="Sikkim" name="USTATE">Sikkim</option>
                            <option value="WestBengal" name="USTATE">West Bengal</option>
                            <option value="Bihar" name="USTATE">Bihar</option>
                            <option value="Nagaland" name="USTATE">Nagaland</option>
                            <option value="AndhraPradesh" name="USTATE">Andhra Pradesh</option>
                            <option value="Karnataka" name="USTATE">Karnataka</option>
                            <option value="TamilNadu" name="USTATE">Tamil Nadu</option>
                        </select>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="input-group inputs" style="width: auto;">
                    
                    <label for="uphone"> Phone no</label>
                        <input type="number" class="form-control" name="UPHONE" required>
                    </div>
                    <div class="input-group inputs" style="width: auto;">
                    <label for="uemail"> Email-ID</label>
                        <input type="email" class="form-control" name="UEMAIL" required>
                    </div>
                </div>
                <div class="form-group row">
                    <div class=" input-group inputs" style="width: auto;">
                    <label for="ugender"> Gender </label>
                        <select class="form-select" id="inputGroupSelect01" style="width: 206px;" name="UGENDER">
                            <option value="Male" name="UGENDER">Male</option>
                            <option value="Female" name="UGENDER">Female</option>
                            <option value="Others" name="UGENDER">Others</option>
                        </select>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="input-group inputs" style="width: auto;">
                    <label for="upassword"> Password</label>
                        <input type="password" class="form-control" name="UPASSWORD" required>
                    </div>
                    <div class="form-group row d-grid gap-2 ">
                    <div class="input-group inputs" style="width: auto;">
                        <label for="ucpassword"> Confirm Password</label>
                        <input type="password" class="form-control" name="UCPASSWORD" required>
                    </div>
    </div>
                </div>
                <div class="form-group row d-grid gap-2 ">
                    <div class="input-group inputs" style="width: auto;">
                        <label for="pincode">Pin Code</label>
                        <input type="number" class="form-control" name="UPINCODE" required>
                    </div>
                </div>
                <div class="form-group row d-grid gap-2 ">
                    <div class="input-group inputs" style="width: auto;">
                    <label for="address2"> Address 1</label>
                        <input type="text" class="form-control" name="UADDRESS1" required>
                    </div>
                </div>
                <div class="form-group row d-grid gap-2 ">
                <div class="input-group inputs" style="width: auto;">
                        <label for="address2"> Address 2</label>
                        <input type="text" class="form-control" name="UADDRESS2" required>
                    </div>
    </div>
                <div class="d-grid gap-2 inputs">
                    <input class="btn " type="submit" name="ureg_submit" value="Get OTP" style="background-color: #adb5bd";>
                </div>
                <h6 class="text-center inputs">or</h6>
                <h6 class="text-center inputs"><a href="ulogin.php" style="color: black; text-decoration: none;">Already
                        Registered? Log-In</a>
                </h6>
            </form>
        </div>
        
    </div>
    <!-- End of Registration Form -->

    <!-- Footer -->
    <!DOCTYPE html>
<!-- Created By CodingLab - www.codinglabweb.com -->
<html lang="en" dir="ltr">
  <head>
    <meta charset="UTF-8">
    <!--<title> Responsive Footer | CodingLab</title>--->
    <link rel="stylesheet" href="style.css">
     <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.min.css"/>
   </head>
<body>
 <footer class="myfooter">
   <div class="content" >
         <div class="media-icons">
           <a href="#"><i class="fab fa-facebook-f"></i></a>
           <a href="#"><i class="fab fa-instagram"></i></a>
           <a href="#"><i class="fab fa-twitter"></i></a>
           <a href="#"><i class="fab fa-youtube"></i></a>
           <a href="#"><i class="fab fa-linkedin-in"></i></a>
</div>
     </div>
   </div>
   <div class="bottom">
     <p>Copyright © 2021 <span > Qudrat Bookstore </span></> All rights reserved</p>
   </div>
 </footer>

</body>
</html>


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