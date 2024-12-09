<?php
$host = 'localhost'; 
$username = 'jassimtrinidad'; // username mo sa xamp
$password = 'jassimtrinidad'; // password mo sa xamp
$database = 'members_trinidad'; // name nung data base mo


$dbcon = mysqli_connect($host, $username, $password, $database);


if (!$dbcon) {
    die("Connection failed: " . mysqli_connect_error());
}
?>
