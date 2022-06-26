<?php
include "../config.php";
session_start();
error_reporting(0);

$bookisbn = $_GET["updateid"];

$sql = "Select *from `books` where book_isbn = $bookisbn";

$result = mysqli_query($connection, $sql);
$row = mysqli_fetch_assoc($result);
$bookid = $row["book_isbn"];
$bookname = $row["book_name"];
$quantity = $row["quantity"];
$bookpublisher = $row["book_publisher"];
$price = $row["book_price"];
$bookauthor = $row["book_author"];
$bookpages = $row["book_pages"];
$bookedition = $row["book_edition"];
$bookdesc = $row["book_desc"];
$bookcategory = $row["book_category"];
//$old_img = $row['image'];


if (isset($_POST["submit"])) {
    $bookid = $_POST["bookid"];
    $bookname = $_POST["bookname"];
    $quantity = $_POST["quantity"];
    $bookpublisher = $_POST["bookpublisher"];
    $price = $_POST["price"];
    $bookauthor = $_POST["bookauthor"];
    $bookpages = $_POST["bookpages"];
    $bookedition = $_POST["bookedition"];
    $bookdesc = $_POST["bookdesc"];
    $bookcategory = $_POST["bookcategory"];

    

    /*$new_img = $_FILES['img_upload']['name'];
    
    $img_name = $_FILES['img_upload']['name'];
    $old_img = $_POST['img_upload_old'];
    if ($img_name!='') {
        $tmp_name = $_FILES['img_upload']['tmp_name'];
        $new_img_name = uniqid("IMG-", true).'.'.$img_ex_lc;
        $img_upload_path = 'uploads/' . $img_name;
        move_uploaded_file($tmp_name, $img_upload_path);
    }else{
        $img_upload_path = $old_img;
    }*/

    //, image='$img_upload_path' 

    $sql = "UPDATE `books` SET  book_name='$bookname', quantity=$quantity, book_price=$price, book_author='$bookauthor', book_pages=$bookpages ,book_edition=$bookedition, book_desc='$bookdesc' , book_category='$bookcategory' ,book_publisher='$bookpublisher' where book_isbn=$bookid";
    $result = mysqli_query($connection, $sql);
    if ($result) {
        echo "<script>confirm('Product updated successfully')</script>";
        header("location:book_display.php");
    } else {
        echo "<script>alert('Error! Please try again')</script>";
        //die(mysqli_error($con));
    }
}

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

    <script>
        function validate() {

            var md = new Date(document.forms['myform']['date1'].value);
            var ed = new Date(document.forms['myform']['date2'].value);
            var img = document.forms['myform']['img_upload'];
            let current = new Date();
            var validExt=["jpeg","png","jpg","JPEG","PNG","JPG"];


            

            

            //validating image 

            if (img.value!='') {

                var img_ext=img.value.substring(img.value.lastIndexOf('.')+1);

                var result=validExt.includes(img_ext);
                if (result==false) {
                    document.getElementById('img_upload').innerHTML = "*Invalid file extension";
                    return false;
                } else {
                    if (img.files[0].size>1048576) {
                        document.getElementById('img_upload').innerHTML = "*File should be less than 1MB";
                        return false;
                    }
                }
            }



            return true;
        }
    </script>

    <title>Update Product</title>
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
                                <hr class="dropdown-divider">
                            </li>
                            <li>
                                <a class="dropdown-item" href="book_display.php">
                                    DISPLAY BOOK
                                </a>
                            </li>
                            <li>
                                <hr class="dropdown-divider">
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
                                   
                                    Customer Details
                                </a>
                            </li>
                            <li>
                                <hr class="dropdown-divider">
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



    <!-- Update BOOK-->

    <div class="container">

    <div>
            <br>
            <h1 class="text-center" style="color: black;">UPDATE BOOKS</h1><br>
        </div>
        <div class="col-lg-3 m-auto d-block">
            <form method="post" name="myform" onsubmit="return validate()" enctype="multipart/form-data"
                class="bookadd">
                <div class="form-group">
                    <label style="font-weight: bold;">BOOK ID(ISBN):</label>
                    <br>
                    <input type="number" min="0" placeholder="BOOK Id" name="bookid" autocomplete="off" required class="form-control" value=<?php echo $bookid ?>>
                </div>
                <div class="form-group">
                    <label style="font-weight: bold;">BOOK NAME:</label>
                    <br>
                    <!-- <input type="text" placeholder="BOOK Name" name="" autocomplete="off" required> -->
                    <input type="text" placeholder="BOOK Name" name="bookname" autocomplete="off" required
                        class="form-control"
                        onkeypress="return (event.charCode > 64 && event.charCode < 91) || (event.charCode > 96 && event.charCode < 123) || (event.charCode==32)"  value=<?php echo $bookname ?>>
                </div>
                <div class="form-group">
                    <label style="font-weight: bold;">QUANTITY:</label>
                    <br>
                    <input type="number" min="1" placeholder="Quantity" name="quantity" autocomplete="off" required
                        class="form-control" value=<?php echo $quantity ?>>
                </div>
                <div class="form-group">
                    <label style="font-weight: bold;">BOOK Description:</label>
                    <br>
                    <input type="text" placeholder="Quantity" name="bookdesc" autocomplete="off" required
                        class="form-control" value=<?php echo $bookdesc ?>>
                    <!-- <textarea name="bookdesc"  cols="40" rows="5" value=<//?php echo $bookdesc ?>></textarea> -->
                </div>
                <div class="form-group">
                    <label style="font-weight: bold;">Category:</label>
                    <br>
                    <input type="text" name="bookcategory" class="form-control" value=<?php echo $bookcategory ?>> 
                </div>
                <div class="form-group">
                    <label style="font-weight: bold;">PAGES:</label>
                    <br>
                    <input type="number" name="bookpages" class="form-control" value=<?php echo $bookpages ?>>
                </div>
                <div class="form-group">
                    <label style="font-weight: bold;">AUTHOR:</label>
                    <br>
                    <input type="text" name="bookauthor" class="form-control" placeholder="author name" value=<?php echo $bookauthor ?>>
                </div>
                <div class="form-group">
                    <label style="font-weight: bold;">PRICE:</label>
                    <br>
                    <input type="number" step="0.01" min="0" max="100" placeholder="Price" name="price"
                        autocomplete="off" required class="form-control" value=<?php echo $price ?>>
                </div>
                <div class="form-group">
                    <label style="font-weight: bold;">PUBLISHER:</label>
                    <br>
                    <input type="text" placeholder="Publisher" name="bookpublisher" class="form-control" value=<?php echo $bookpublisher ?>>
                </div>
                <div class="form-group">
                    <label style="font-weight: bold;">EDITION</label>
                    <br>
                    <input type="number" placeholder="Edition number" name="bookedition" class="form-control" value=<?php echo $bookedition ?>>
                </div>
                <!-- <div>
                    <label style="font-weight: bold;">BOOK IMAGE:</label>
                    <br>
                    <input type="file" name="img_upload" class="form-control" required ><br>
                    <span id="img_upload"></span><br>
                </div> -->
                
                <!-- <div>
                    <label style="font-weight: bold;">PRODUCT IMAGE:</label>
                    <br>
                    <input type="file" name="img_upload" class="form-control">
                    <input type="hidden" name="img_upload_old" class="form-control" value="<//?php echo $old_img ?>">
                    <br>
                    <span id="img_upload"></span><br>
                </div> -->
                <br>
                <div class="m-auto">
                <button type="reset" name="Reset" value="Reset" class="btn btn-primary float-start" style="background-color:grey; border:brown"><a href="book_display.php">Cancel</a></button>
                <button type="submit" name="submit" value="Submit" class="btn btn-primary float-end" style="background-color:grey;">Submit</button>
                </div>
                
            </form>
        </div>
    </div>

    <!-- End of Update -->


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