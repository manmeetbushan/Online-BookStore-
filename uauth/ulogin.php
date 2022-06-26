<?php
include "../config.php";
session_start();
error_reporting(0);
if (isset($_POST['ulogin_submit'])) {
    $email = $_POST['UEMAIL'];
    $upassword = md5($_POST['UPASSWORD']);
    $sql = "SELECT * FROM `user_data` WHERE UEMAIL = '$email' AND UPASSWORD = '$upassword' ";
    $result = mysqli_query($connection, $sql);
  
    
    if (mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        $_SESSION['fname'] = $row['UFNAME'];
        $_SESSION['lname'] = $row['ULNAME'];
        $_SESSION['UEMAIL'] = $row['UEMAIL'];
        header("refresh:5;url=upersonal.php");
        echo "<div class='alert alert-success alert-dismissible fade show' role='alert'
            style='max-width: 70%; position: absolute; top: 10%;' >
            Logged In Successfully.
            <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
            </div>";
    } else {
        echo "<div class='alert alert-danger alert-dismissible fade show' role='alert'
            style='max-width: 70%; position: absolute; top: 10%;' >
            EMAIL/Password may be Incorrect! Try Again.
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

    <title>Login</title>
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
            <li><a class="dropdown-item" href="../alogin.php">Admin Login</a></li>
            <li><a class="dropdown-item" href="ulogin.php">User Login</a></li>
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
            <li><a class="dropdown-item" href="../CourierAuth/cregister.php">Admin Register</a></li>
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
                >
                <h4 class="text-center">User Log-In</h4>
                <hr>
                <div class="form-group row">
                    <div class="input-group inputs" style="width: auto;">
                        <span class="input-group-text" style="width: 160px;">Email-ID</span>
                        <input type="text" class="form-control" name="UEMAIL" autofocus required>
                    </div>
                    <div class="input-group inputs" style="width: auto;">
                        <span class="input-group-text" style="width: 160px;">Password</span>
                        <input type="password" class="form-control" name="UPASSWORD" required>
                    </div>
                </div>
                <div class="d-grid gap-2 inputs">
                    <input class="btn " type="submit" name="ulogin_submit" value="Log-In" style="background-color:#adb5bd;">
                </div>
                <h6 class="text-center inputs">or</h6>
                <h6 class="text-center inputs">
                    <a href="uregister.php" style="color: black; text-decoration: none;">Not a User? Register Now </a>
                    <a href="uforgotpassword.php" style="color: black; text-decoration: none;">| Forgot Password</a>
                </h6>
            </form>
  
        </div>
    </div>

    <!-- End of Log-In Form -->




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