<?php
include "../config.php";
session_start();
error_reporting(0);
if (isset($_SESSION['AID'])) {
    $aid = $_SESSION['AID'];
    $sql = "SELECT * FROM admin_data WHERE AID = $aid";

    $result = mysqli_query($connection, $sql);
    if ($result) {
        $row = mysqli_fetch_assoc($result);
        $afname = $row['AFNAME'];
        $alname = $row['ALNAME'];
        $_SESSION['STATE'] = $row['ASTATE'];
        $aemail = $row['AEMAIL'];
    }
} else {

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

    <link rel="stylesheet" href="astyle.css">

    <title>Admin</title>
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
                    <!-- Personal Info -->
                    <li class="nav-item">
                        <a class="nav-link active" style="margin-right: 20px;" aria-current="page"
                            href="apersonal.php">Personal Info</a>
                    </li>

                    <!-- Ration Info -->
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" style="margin-right: 10px;" href="#" id="navbarDropdown"
                            role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Books
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <li>
                                <a class="dropdown-item" href="book_add.php">
                                    ADD BOOK
                                </a>
                            </li>
                           
                            <li>
                                <a class="dropdown-item" href="book_display.php">
                                    DISPLAY BOOK
                                </a>
                            </li>
                            
                           
                        </ul>
                    </li>

                    <!-- Sales Info -->
                    <li class="nav-item">
                        <a class="nav-link" style="margin-right: 20px;" aria-current="page"
                            href="order_display.php">Ordered Books</a>
                    </li>

                    <!-- User & Courier Details-->
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" style="margin-right: 10px;" href="#" id="navbarDropdown"
                            role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Details
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <li>
                                <a class="dropdown-item" href="aUserDetails.php">

                                    User Details
                                </a>
                            </li>
                            
                            <li>
                                <a class="dropdown-item" href="aCourierDetails.php">
                                    Courier Details
                                </a>
                            </li>
                        </ul>
                    </li>

                    <!-- Requests -->
                    <li class="nav-item">
                    <a class="nav-link" style="margin-right: 10px;" href="seerequests.php">Requests</a>
</li>
                        


                    <!-- LogOut -->
                    <li class="nav-item">
                        <a class="nav-link" style="margin-right: 10px;" href="alogout.php">Log-Out</a>
                    </li>

                </ul>
            </div>
        </div>
    </nav>


    <?php
    if (isset($_SESSION['AID'])) {
        
        echo "
     <div class='container personalContainer' style='background-color:grey;height:auto; width:100%; opacity:80%'>
     <div class='row justify-content-center align-items-center'>
         <div class='col-md-5 text-start personaldivinfo'>
             <h4>Name : {$afname} {$alname}</h4>
             <h4>State : {$_SESSION['STATE']}</h4>
             <h4>Email : {$aemail}</h4>
         </div>
     </div>
    </div>
     ";
    } else {
        echo " <div>
            <img src='../Images/PageNotFound.svg' class='img-fluid mx-auto d-block' alt='' style='max-width:40%; margin: 80px 0px 80px 0px'>
        </div>
        ";
    }
    ?>
    <!-- End of Personal Info -->

    

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