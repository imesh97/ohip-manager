<!--
ASSIGNMENT 3
Connect DB Component
Student Number: _14
-->
<?php
$host = "localhost"; // db connection info
$user = "root";
$pass = "cs3319";
$db = "assign2db";

$connection = mysqli_connect($host, $user, $pass, $db); // connect to db
if (mysqli_connect_errno()) { // error
    die("Failed to connect to database:" . mysqli_connect_error() . " (" . mysqli_connect_errno() . ")");
}
?>