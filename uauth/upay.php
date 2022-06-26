<?php
include "../config.php";
session_start();
error_reporting(0);
if (isset($_SESSION['UEMAIL'])) {
    $totalPrice = 0;
    $uemail = $_SESSION['UEMAIL'];
    $sql4 = "SELECT books.book_name,books.book_price,cart_data.CART_QUANTITY 
            FROM books
            INNER JOIN cart_data
            ON books.book_isbn = cart_data.book_isbn
            WHERE cart_data.UEMAIL = '$uemail'";
    $result4 = mysqli_query($connection, $sql4);
    while ($row = mysqli_fetch_assoc($result4)) {
        $totalPrice += $row['CART_QUANTITY'] * $row['book_price'];
    }
    

    if (isset($_POST['paybtn'])) {
        $found = true;
        do {
            $referenceid = rand(10000, 99999);
            $sql0 = "SELECT * FROM payment_data WHERE REFERENCEID = $referenceid";
            $result0 = mysqli_query($connection, $sql0);
            if (!mysqli_num_rows($result0) > 0) {
                $found = false;
            }
        } while ($found);
        

        if ($_POST['payment'] == "cashOnDelivery") {
    
            $sql1 = "SELECT * FROM `cart_data` WHERE UEMAIL = '$uemail' ";
            
            $result1 = mysqli_query($connection, $sql1);
            $row = mysqli_fetch_assoc($result1);
    
            while ($row = mysqli_fetch_assoc($result1)) {
                $sql2 = " INSERT INTO `order_data` (REFERENCEID,BOOK_ISBN,UEMAIL,BOOK_QUANTITY,STATUS,PAYMENT) VALUES ($referenceid, {$row['book_isbn']},'{$row['UEMAIL']}',{$row['CART_QUANTITY']},'Placed','UnPaid') ";
                $result2 = mysqli_query($connection, $sql2);
                
                $row = mysqli_fetch_assoc($result2);
                
                if ($result2) {
                    $sql3 = "DELETE FROM cart_data WHERE COID = {$row['COID']}";
                    $result3 = mysqli_query($connection, $sql3);
                }
            }
            if ($totalPrice > 0) {
                $sql7 = "SELECT ORDERDATE,STATUS FROM order_data WHERE REFERENCEID = $referenceid";
                $result7 = mysqli_query($connection, $sql7);
                $row7 = mysqli_fetch_assoc($result7);
                $sql5 = "INSERT INTO payment_data(REFERENCEID,TOTALPRICE,PAYMENTDATE,STATUS,UEMAIL) VALUES($referenceid,$totalPrice,'{$row7['ORDERDATE']}','{$row7['STATUS']}','$uemail')";
                $result5 = mysqli_query($connection, $sql5);
            }
            header('location:upersonal.php');
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
    
    <style>
    @import url('https://fonts.googleapis.com/css2?family=Cabin&display=swap');
    </style>
    <title>Payment</title>
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
                        <a class="nav-link" style="margin-right: 20px;" aria-current="page" href="uproductpage.php">Buy
                            Books</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" style="margin-right: 20px;" aria-current="page" href="ucart.php">My
                            Cart</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" style="margin-right: 20px;" aria-current="page"
                            href="uorderstatus.php">Order Status</a>
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

    <!-- Payment -->
    <div class="container-fluid">
        <h1 class="text-center" style="color: grey;">Your Final Amount <?php echo "₹{$totalPrice}"; ?>/-</h1>
        <form action="" method="POST">
            <div class="mx-auto paycontainer">
                <br>
                <div>
                    <input class="form-check-input" type="radio" name="payment" value="cashOnDelivery" checked>
                    <label class="form-check-label" for="cashOnDelivery">
                        Cash On Delivery
                    </label>
                </div>
                <br>
                <div>
                    <input class="form-check-input" type="radio" name="payment" value="creditDebit" disabled>
                    <label class="form-check-label" for="creditDebit">
                        Credit/Debit Card
                    </label>
                </div>
                <br>
            
            </div>
            <div class="d-grid gap-2 col-6 mx-auto">
                <button class="btn shadow-none" type="submit" name="paybtn"
                    style="background-color:#adb5bd; border:#adb5bd">Buy
                    Now</button>
            </div>
        </form>
    </div>
    <!-- End of payment -->



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