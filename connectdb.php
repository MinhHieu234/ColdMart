<?php
$host = "localhost";
$user = "root";
$password = "";
$dbname = "coldmart";

$conn = new mysqli($host, $user, $password, $dbname);

// Kiểm tra kết nối
if ($conn->connect_error) {
    die("Kết nối thất bại: " . $conn->connect_error);
}

?>