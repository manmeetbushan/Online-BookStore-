<?php
include "../config.php";
session_start();
error_reporting(0);
?>

<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- font awesome -->
    <script src="https://kit.fontawesome.com/5019775b3a.js" crossorigin="anonymous"></script>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

    <link rel="stylesheet" href="astyle.css">

    <title>Display books</title>
</head>

<body>
    <!-- Navbar -->
    <img src="../bg.jpg" alt="bg" class="bg" style="
      width: 100%; 
      height: auto;
      position:absolute; 
      z-index:-1;
      background-attachment:fixed;
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

                    <!-- Book Info -->
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" style="margin-left: 10px;" href="#" id="navbarDropdown"
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
    <!-- End of Navbar -->

    <!-- Display books -->
    <div class="container">

        <div>
            <h1 class="text-center" style="color: black;">BOOKS</h1>
        </div>

        <br>
        <div class="table-responsive">
            <table class="table table-bordered   text-center">

                <thead class="bg-dark text-white">
                    <tr>
                        <th scope="col">BookId</th>
                        <th scope="col">BookIsbn</th>
                        <th scope="col">BookName</th>
                        <th scope="col">Ouantity</th>
                        <th scope="col">BookPrice</th>
                        <th scope="col">BookDescription</th>
                        <th scope="col">Publisher</th>
                        <th scope="col">Author</th>
                        <th scope="col">Pages</th>
                        <th scope="col">Category</th>
                        <th scope="col">Edition</th>
                        <th scope="col">Bookimage</th>
                        <th colspan="3">Operations</th>
                    </tr>
                </thead>

                <tbody class="bg-dark text-white">
                    <?php
                    $sql = "SELECT *from `books` ";
                    $result = mysqli_query($connection, $sql);
                    if ($result) {
                        while ($row = mysqli_fetch_assoc($result)) {

                                $id = $row["id"];
                                $bookisbn = $row["book_isbn"];
                                $bookname = $row["book_name"];
                                $quantity = $row["quantity"];
                                $bookpublisher = $row["book_publisher"];
                                $price = $row["book_price"];
                                $bookauthor = $row["book_author"];
                                $bookpages = $row["book_pages"];
                                $bookedition = $row["book_edition"];
                                $bookdesc = $row["book_desc"];
                                $bookcategory = $row["book_category"];
                                $image = $row['book_image'];

                            echo '<tr>
                                    <th scope="row" >' . $id . '</th>
                                    <td>' . $bookisbn . '</td>
                                    <td>' . $bookname . '</td>
                                    <td>' . $quantity . '</td>
                                    <td>' . $price . '</td>
                                    <td>' . $bookdesc . '</td>
                                    <td>' . $bookpublisher . '</td>
                                    <td>' . $bookauthor . '</td>
                                    <td>' . $bookpages . '</td>
                                    <td>' . $bookcategory . '</td>
                                    <td>' . $bookedition . '</td>
                                    <<td><img src='.$image.' height="100px" width="100px"></a></td>
                                    <td><a href="book_update.php?updateid=' . $bookisbn . '" data-toggle="tooltip" data-placement="bottom" title="UPDATE"> <i class="fa fa-edit" aria-hidden="true"></i></a></td>
                                    <td><a href="book_del.php?deleteid=' . $bookisbn . '" data-toggle="tooltip" data-placement="bottom" title="DELETE"> <i class="fa fa-trash" aria-hidden="true"></i></a></td>
                                    </td>
                                 </tr>';
                        }
                    }


                    ?>

                </tbody>

                

            </table>
        </div>

    </div>

    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous">
    </script>

    <!-- Option 2: Separate Popper and Bootstrap JS -->
    <!--
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>
    -->
</body>

</html>