<?php
include "../config.php";
include "../mail_sender.php";
session_start();
error_reporting(0);
if (isset($_SESSION['UEMAIL'])) {
    $sql = "SELECT * FROM `user_data` WHERE UEMAIL = '{$_SESSION['UEMAIL']}' ";
    $result = mysqli_query($connection, $sql);
    $row = mysqli_fetch_assoc($result);
    $fname = $row['UFNAME'];
    $lname = $row['ULNAME'];
    $address1 = $row['UADDRESS1'];
    $address2 = $row['UADDRESS2'];
    $state = $row['USTATE'];
    $email = $row['UEMAIL'];
    $phone = $row['UPHONE'];
    $pincode = $row['UPINCODE'];
    $gender = $row['UGENDER'];

    if ($_POST['cancelbtn']) {
        $sql4 = "SELECT STATUS FROM payment_data WHERE REFERENCEID = {$_POST['cancelbtn']}";
        $result4 = mysqli_query($connection, $sql4);
        $row = mysqli_fetch_assoc($result4);
        $sql2 = "DELETE FROM order_data WHERE REFERENCEID = {$_POST['cancelbtn']}";
        $result2 = mysqli_query($connection, $sql2);
        if ($result2) {
            $sql3 = "DELETE FROM payment_data WHERE REFERENCEID = {$_POST['cancelbtn']}";
            $result3 = mysqli_query($connection, $sql3);
            if (!$result3) {
                echo "<script>alert('Cant Cancel this Order')</script>";
            }
        } else {
            echo "<script>alert('Cant Cancel this Order')</script>";
        }
        header('location:upersonal.php');
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
    <title>Personal Details</title>
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
                            href="upersonal.php">Personal Info</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" style="margin-right: 20px;" aria-current="page" href="ubookpage.php">Buy
                            Books</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" style="margin-right: 20px;" aria-current="page" href="ucart.php">My Cart</a>
                    </li>

                    <!-- Request Us -->
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

    <!-- Personal Data -->
    <?php
    if (isset($_SESSION['UEMAIL'])) {
        echo "
     <div class='container personalContainer' style='background-color:grey;height:auto; margin: top 30px; opacity: 80%'>
     <div class='row justify-content-center align-items-center'>
         <div class='col-md-5text-start personaldivinfo'>
             <h4>Name : {$fname} {$lname}</h4>
             <h4>Email : {$email}</h4>
             <h4>Address1 : {$address1}</h4>
             <h4>Address2 : {$address2}</h4>
             <h4>Pincode : {$pincode}</h4>
             <h4>State : {$state}</h4>
             <h4>Gender : {$gender}</h4>
             <h4>Phone Number : {$phone}</h4>
         </div>
     </div>
    </div>
     ";
    } else {
        echo "
        <div>
            <img src='../Images/PageNotFound.svg' class='img-fluid mx-auto d-block' alt='' style='max-width:40%; margin: 80px 0px 80px 0px'>
        </div>
        ";
    }
    ?>
    <!-- End of Personal Data -->

    <!-- BOOk Details -->
    <?php
    if (isset($_SESSION['UEMAIL'])) {
        $email = $_SESSION['UEMAIL'];
        $sql0 = "SELECT * FROM payment_data WHERE UEMAIL = $email ORDER BY PAYMENTDATE";
        $result0 = mysqli_query($connection, $sql0);
        while ($row0 = mysqli_fetch_assoc($result0)) {
            $orderdate = $row0['PAYMENTDATE'];
            $referenceid = $row0['REFERENCEID'];
            echo "
            <p>
            <div class='d-grid gap-2 col-6 mx-auto float-center'>
                <button class='btn personalDateButton shadow-none dropdown-toggle' type='button' data-bs-toggle='collapse'
                    data-bs-target='#collapseExample' aria-expanded='false' aria-controls='collapseExample'>
                    Order Date : $orderdate
                </button>
            </div>
            </p>

            <div class='collapse' id='collapseExample'>
            <div class='container myBookList' style='background-color:grey;height:auto; opacity:80%'>
                <div class='row'>
                    <div class='col-md-4 text-center'>
                        <h5>Date : $orderdate</h5>
                    </div>";

            if ($row0['STATUS'] == 'Placed') {
                echo "<div class='col-md-4 text-center'>
                    <span class='badge rounded-pill bg-success'>Order has been Placed</span>
                </div>";
            } else if ($row0['STATUS'] == 'Shipped') {
                echo "<div class='col-md-4 text-center'>
                    <span class='badge rounded-pill bg-success'>Order has been Shipped</span>
                </div>";
            } else if ($row0['STATUS'] == 'Delivered') {
                echo "<div class='col-md-4 text-center'>
                    <span class='badge rounded-pill bg-success'>Sucessfully Delivered</span>
                </div>";
            }

            echo "
                    <div class='col-md-4 text-center'>
                        <h5>Reference Id : $referenceid</h5>
                    </div>
                    <hr>
                </div>
                <div class='row justify-content-center align-content-center'>
                    <table class='table table-hover'>
                        <thead class='table-dark'>
                            <tr>
                                <th scope='col'>Book ISBN</th>
                                <th scope='col'>Book Name</th>
                                <th scope='col'>Quantity</th>
                                <th scope='col'>Price</th>
                            </tr>
                        </thead>
        ";

            $sql1 = "SELECT * FROM order_data INNER JOIN books ON order_data.BOOK_ISBN = books.book_isbn WHERE REFERENCEID = $referenceid";
            $result1 = mysqli_query($connection, $sql1);
            while ($row1 = mysqli_fetch_assoc($result1)) {
                echo "
                    <tbody>
                        <tr>
                            <th scope='row'>{$row1['BOOK_ISBN']}</th>
                            <td>{$row1['book_name']}</td>
                            <td>{$row1['BOOK_QUANTITY']}</td>
                            <td>₹ {$row1['book_price']}</td>
                        </tr>
                ";
            }

            echo "
                        <tr class='table-success'>
                        <th colspan='3'>Grand Total Ammount</th>
                        <td>₹ {$row0['TOTALPRICE']}</td>
                        </tr>
                        </tbody>
                        </table> ";

            if ($row0['STATUS'] != 'Delivered')
                echo "
                <form method='POST'>
                    <div class='d-grid gap-2'>
                        <button class='btn shadow-none' type='submit' name='cancelbtn' value='$referenceid' 
                        style='background-color:#adb5bd; border:#adb5bd'>
                        Cancel Order
                        </button>
                    </div>
                </form>
            ";

            echo "
                    </div>
                </div>
            </div>
            ";
        }
    }
    ?>
    <!-- End of Ration Details -->

    <!-- Request Us -->
    <div class="modal fade" id="exampleModal" tabindex="3" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Contact Us</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form>
                        <div class="mb-3">
                            <label for="message-text" class="col-form-label">Message:</label>
                            <textarea class="form-control" id="message-text" name="msgbody"></textarea>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" name="send_msg">Send message</button>
                </div>
            </div>
        </div>
    </div>
    <!-- End of contact us -->


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