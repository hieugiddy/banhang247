<?php
$servername = "207.148.118.207";
$database = "dienthoai";
$username = "hoanglong";
$password = "Longbro@123";
$conn = mysqli_connect($servername, $username, $password, $database);
mysqli_select_db($conn, $database);
?>
