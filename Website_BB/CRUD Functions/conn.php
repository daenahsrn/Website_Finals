<?php
$server   = "localhost";
$username = "root";
$password = "";
$dbname   = "backstreetboys_db";
$tablelogin = "users";

$conn = mysqli_connect($server, $username, $password, $dbname);

if (!$conn) {
    die("Failed to connect to MySQL: " . mysqli_connect_error());
}
?>
