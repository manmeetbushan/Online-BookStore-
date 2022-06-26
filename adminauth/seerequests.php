<?php
include "../config.php";
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

            


                    <!-- LogOut -->
                    <li class="nav-item">
                        <a class="nav-link" style="margin-right: 10px;" href="alogout.php">Log-Out</a>
                    </li>

                </ul>
            </div>
        </div>
    </nav>

    <div class="container">

        <div>
            <h1 class="text-center" style="color: black;">REQUEST BY USERS</h1>
        </div>

        <br>
        <div class="table-responsive">
            <table class="table table-bordered   text-center">

                <thead class="bg-dark text-white">
                    <tr>
                        <th scope="col">UEMAIL</th>
                        <th scope="col">REQUEST MESSAGE</th>

                    </tr>
                </thead>

                <tbody class="bg-dark text-white">
                    <?php
                    $sql = "SELECT * from `request_data`";
                    $result = mysqli_query($connection, $sql);

                    if ($result) {
                        while ($row = mysqli_fetch_assoc($result)) {
                            
                            $uemail = $row["UEMAIL"];
                            $requestmsg=$row["requestmsg"];
                            echo '<tr>
                                    <td>' . $uemail . '</td>
                                    <td>' . $requestmsg . '</td>
                                 </tr>';
                        }
                    }


                    ?>

                </tbody>



            </table>
        </div>

    </div>

