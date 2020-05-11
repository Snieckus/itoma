<?php
$servername = "localhost";
$username = "root";
$password = "";
$database = "itoma";
// Create connection
$dbc = mysqli_connect($servername, $username, $password, $database);
mysqli_set_charset($dbc, "utf8");
if (!$dbc) {
    die("Negaliu prisijungti prie MySQL:" . mysqli_error($dbc));
}
?>