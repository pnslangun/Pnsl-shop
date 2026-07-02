<?php
include "../config/db.php";

$id = $_GET['id'];

// ดึงชื่อรูปก่อนลบ
$sql = "SELECT image FROM products WHERE id=$id";
$result = $conn->query($sql);
$row = $result->fetch_assoc();

if($row['image']){
    unlink("../uploads/".$row['image']);
}

// ลบข้อมูล
$sql = "DELETE FROM products WHERE id=$id";

if($conn->query($sql)){
    echo "<script>alert('ลบสินค้าแล้ว'); window.location='index.php';</script>";
} else {
    echo "ผิดพลาด: " . $conn->error;
}
?>
