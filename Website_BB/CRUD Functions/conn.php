<?php
$server   = "localhost";
$username = "root";
$password = "";
$dbname   = "backstreetboys_db";
$tablelog = "["about", "admin", "albums", "history", "members", "songs"]";
$tablelogin = ["about", "admin", "albums", "history", "members", "songs"];

$conn = mysqli_connect($server, $username, $password, $dbname);

if (mysqli_connect_error()) {
    die("Failed to connect to MySQL: " . mysqli_connect_error());
}
?>