<?php
include "../config.php";
session_start();
error_reporting(0);
if (isset($_SESSION['UEMAIL'])) {
    if (isset($_POST['uremovebook'])) {
        $book_isbn = $_POST['uremovebook'];
        $uemail = $_SESSION['UEMAIL'];
        $sql = "DELETE FROM cart_data WHERE book_isbn = $book_isbn  AND UEMAIL = '$uemail'";
        $result = mysqli_query($connection, $sql);
        if ($result) {
            header('location:ucart.php');
            return;
        } else {
        }
    }
    if (isset($_POST['buybook'])) {
        header('location:upay.php');
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
    @import url('https://fonts.googleapis.com/css2?family=Cabin&display=swap');
    </style>
    <title>Cart</title>
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
            <a class="navbar-brand" href="../index.php">
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
                        <a class="nav-link active" style="margin-right: 20px;" aria-current="page" href="ucart.php">My
                            Cart</a>
                    </li>

                    <!-- Contact Us -->
                    <li class="nav-item">
                        <a class="nav-link" style="margin-right: 10px;" href="urequestus.php">Request</a>
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

    <!-- Products which are added in Cart -->
    <?php
    if (isset($_SESSION['UEMAIL'])) {
        $uemail = $_SESSION['UEMAIL'];
        $sql1 = "SELECT books.book_isbn,book_name,quantity,book_price,CART_QUANTITY FROM books INNER JOIN cart_data ON books.book_isbn = cart_data.book_isbn WHERE UEMAIL = '$uemail'";
        $result1 = mysqli_query($connection, $sql1);
        if (mysqli_num_rows($result1) > 0) {
            echo "<div class='row d-flex justify-content-center outerproductcard'>";
            while ($row = mysqli_fetch_assoc($result1)) {
                echo "
                    <div class='col-md-6'>
                        <div class='card mb-3 mt-auto cartcard'>
                            <div class='row g-0'>
                            <!-- <div class='col-md-4'>
                                <img src='../Images/book1.jpg' class='img-fluid rounded-start' alt='...'>
                            </div> -->
                            <!-- <div class='col-md-8'> -->
                            <div class='card-body'>
                                <h2 class='text-center'>{$row['book_name']}({$row['CART_QUANTITY']} )</h2>
                                <hr>
                                <table class='table table-borderless'>
                                    <tbody>
                                        <tr>
                                            <th class='text-start'>Book ISBN</th>
                                            <th class='text-end'>{$row['book_isbn']}</th>
                                        </tr>
                                        
                                        <tr>
                                            <th class='text-start'>Price</th>
                                            <th class='text-end'>₹ {$row['book_price']}</th>
                                        </tr>
                                    </tbody>
                                </table>
                                <form method='POST'>
                                <div class='d-grid gap-2'>
                                    <button class='btn btn-success shadow-none' type='submit' name='uremovebook' value={$row['book_isbn']}
                                        style='background-color: #adb5bd; border:#adb5bd;'>Remove from Cart</button>
                                </div>
                                </form>
                            </div>
                            <!-- </div> -->
                        </div>
                        </div>
                    </div>
                    ";
            }
            echo "</div>";
        } else {
            echo "
                <div>
                    <img src='../Images/error.gif' class='img-fluid mx-auto d-block' alt='' style='max-width:100%; max-height:100%; '>
                </div>
            ";
        }
    } else {
        echo "
        <div>
            <img src='../Images/PageNotFound.svg' class='img-fluid mx-auto d-block' alt='' style='max-width:40%; margin: 80px 0px 80px 0px'>
        </div>
        ";
    }

    $sql1 = "SELECT * FROM cart_data WHERE UEMAIL = '{$_SESSION['UEMAIL']}'";
    $result1 = mysqli_query($connection, $sql1);
    
    if (mysqli_num_rows($result1) > 0) {
        
        echo "<form method='POST'>
                <div class='d-grid gap-2 mx-auto ' style='width: 90%;'>
                    <button class='btn shadow-none ' type='submit' name='buybook'  style='background-color: #adb5bd; border:#adb5bd;'>Buy my Books</button>
                </div>
            </form>";
    }
    ?>
    <!-- End of Books which are added in cart -->

    

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