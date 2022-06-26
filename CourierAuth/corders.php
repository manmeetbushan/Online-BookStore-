<?php
include "../config.php";
session_start();
error_reporting(0);
if (isset($_SESSION['cid'])) {
    if (isset($_POST['match_btn'])) {
        echo "<script>alert({$_POST['match_btn']})</script>";
        $email = $_POST['match_btn'];
        $_SESSION['MatchUserId'] = $email;
        header('location:couriermatch.php');
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

    <link rel="stylesheet" href="cstyle.css">
    <title>Courier</title>
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
                        <a class="nav-link active" style="margin-right: 20px;" aria-current="page"
                            href="cpersonal.php">Personal Info</a>
                    </li>

                    <!-- Orders -->
                    <li class="nav-item">
                        <a class="nav-link" style="margin-right: 20px;" aria-current="page"
                            href="corders.php">Orders</a>
                    </li>
                    
                  
                 
                    <!-- LogOut -->
                    <li class="nav-item">
                        <a class="nav-link" style="margin-right: 10px;" href="clogout.php">Log-Out</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Order Info -->
    <?php
    if (isset($_SESSION['cid'])) {
        $sql1 = "SELECT * FROM courier_data WHERE CID = {$_SESSION['cid']}";
        $result1 = mysqli_query($connection, $sql1);
        $row1 = mysqli_fetch_assoc($result1);
        $state = $row1['CSTATE'];
        $sql2 = "SELECT * FROM user_data INNER JOIN payment_data ON user_data.UEMAIL = payment_data.UEMAIL WHERE USTATE = '$state'";
        $result2 = mysqli_query($connection, $sql2);
        if (mysqli_num_rows($result2) > 0) {
            echo "<br><div class='row details d-flex justify-content-center'>";
            while ($row2 = mysqli_fetch_assoc($result2)) {
                echo "
      <div class='col-md-6 details text-center'>
      <div class='card border-info mb-4' style='max-width: 100%;'>
          <div class='card-body courier-details-gradient' >
              <h5 class='card-title'>Order Detail</h5>
              <h6 class='card-text'>Name : {$row2['UFNAME']} {$row2['ULNAME']}</h6>
              <h6 class='card-text'> State : {$row2['USTATE']}</h6>
              <h6 class='card-text'> Address1 : {$row2['UADDRESS1']}</h6>
              <h6 class='card-text'> Address2 : {$row2['UADDRESS2']}</h6>
              <h6 class='card-text'> Phone : {$row2['UPHONE']}</h6>
              <h6 class='card-text'> Total Ammount : {$row2['TOTALPRICE']}</h6>
              <form method='post'>
              <div class='d-grid gap-2 col-6 mx-auto'>
                <button class='btn btn-primary' type='submit' name='match_btn' value={$row2['UEMAIL']}
                style='border-radius: #adb5bd;background-color: #adb5bd;'>Match 
                User</button>
                </div>
            </form>
          </div>
      </div>
     </div>
      ";
            }
            echo "</div>";
        }
    } else {
        echo " <div>
            <img src='../Images/PageNotFound.svg' class='img-fluid mx-auto d-block' alt='' style='max-width:40%; margin: 80px 0px 80px 0px'>
        </div>
        ";
    }
    ?>

    <!-- End of Order Info -->

    
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