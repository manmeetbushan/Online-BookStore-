<?php
$server = "localhost";
$username = "root";
$password = "";
$database = "book_store";

$conn = mysqli_connect($server, $username, $password, $database);

if (!$conn) {
    die("<script>alert('Connection Not Established.')</script>");
}