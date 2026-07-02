<?php
$host = "localhost";
$user = "root";
$pass = "";
$dbname = "shop_db";

$conn = new mysqli($host, $user, $pass, $dbname);

if ($conn->connect_error) {
    die("เชื่อมต่อฐานข้อมูลไม่ได้: " . $conn->connect_error);
}

$conn->set_charset("utf8");
?>
