<?php
$host = "localhost";
$username = "root";
$password = "root";
$dbname = "sipinrang_stis";

$conn = mysqli_connect($host, $username, $password, $dbname) or die("Connection failed: " . mysqli_connect_error());
