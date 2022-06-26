<?php
include "../config.php";
echo "<script>alert('Click OK to delete')</script>";

if (isset($_GET["deleteid"])) {
    $bookid=$_GET["deleteid"];

 
    $sql="delete from `books` where book_isbn=$bookid";

    $result1=mysqli_query($connection,$sql);
   
        if ($result1) {
            echo "<script>alert('Deleted Successfully')</script>";
            header("location:book_display.php");
        
    }else {
        echo "<script>alert('Error Please Try Again')</script>";
        header("location:book_display.php");
       // die(mysqli_error($con));
    }
}
?>