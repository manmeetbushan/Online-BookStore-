<?php
include "../config.php";
require "../mail_sender.php";
error_reporting(0);
session_start();
if (isset($_SESSION['UEMAIL'])){
if (isset($_POST['submit']))
     {
        $requestmsg=$_POST['requestmsg'];
        $UEMAIL=$_SESSION['UEMAIL'];
        echo "<script>alert('Request sent')</script>";
        

    $query="INSERT INTO request_data(requestmsg, UEMAIL)";
    $query.= "VALUES ('$requestmsg' , '$UEMAIL') ";

    $result=mysqli_query($connection,$query);
    if (!$result) {
        die("error". mysqli_error($connection));
    }
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

    

    <title>Request</title>
</head>

<body>
<img src="../bg.jpg" alt="bg" class="bg" style="
      width: 100%; 
      position:absolute; 
      z-index:-1;
      ">
    <!-- Navbar -->

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
                    <!-- Personal Info -->
                    <li class="nav-item">
                        <a class="nav-link" style="margin-right: 20px;" aria-current="page"
                            href="upersonal.php">Personal Info</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" style="margin-right: 20px;" aria-current="page" href="ubookpage.php">Buy
                            Books</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" style="margin-right: 20px;" aria-current="page" href="ucart.php">My Cart</a>
                    </li>

                    <!-- request Us -->
                    <li class="nav-item">
                        <a class="nav-link active" style="margin-right: 10px;" href="urequestus.php">Request</a>
                    </li>

                    <!-- LogOut -->
                    <li class="nav-item">
                        <a class="nav-link" style="margin-right: 10px;" href="ulogout.php">Log-Out</a>
                    </li>

                </ul>
            </div>
        </div>
    </nav>
    <!-- End of Navbar -->
    <!-- Registration Form -->
    <form action="" method="POST">
    <div class="container-fluid" style="max-width: 100%; height:auto;">
        <div class="row justify-content-center align-items-center " style="margin: 20px 0px 20px 0px;">
            <div class="col-md-6 feedbackphoto">
                <h2 style="margin: 20px 0px 0px 40px;color:black ;text-align:center "> <strong>Put request for your desired book</strong> </h2>

                    <div class="form-floating" style="margin: 40px 0px 40px 0px;">
                        <textarea class="form-control feedbackmsg" placeholder="Leave a comment here"
                            id="floatingTextarea2" style="height: 100px" name="requestmsg" required></textarea>
                        <label for="floatingTextarea2" >Please enter book name , author name and publication name here .</label>
                    </div>

                    <div class="d-grid gap-2 col-6 mx-auto">
                        <button class="btn btn-success" type="submit" name="submit" value="submit"
                            style="border-radius: black;background-color: black;">Send Request</button>
                    </div>

                </form>

            </div>
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