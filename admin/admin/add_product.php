<?php
include "../config/db.php";

if(isset($_POST['submit'])){

    $name = $_POST['name'];
    $price = $_POST['price'];

    // อัปโหลดรูป
    $image = $_FILES['image']['name'];
    $tmp = $_FILES['image']['tmp_name'];

    if($image != ""){
        move_uploaded_file($tmp, "../uploads/".$image);
    }

    $sql = "INSERT INTO products (name, price, image)
            VALUES ('$name', '$price', '$image')";

    if($conn->query($sql)){
        echo "<script>alert('เพิ่มสินค้าแล้ว'); window.location='index.php';</script>";
    } else {
        echo "ผิดพลาด: " . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>เพิ่มสินค้า</title>
</head>
<body>

<h2>➕ เพิ่มสินค้า</h2>

<form method="post" enctype="multipart/form-data">

    ชื่อสินค้า:<br>
    <input type="text" name="name" required><br><br>

    ราคา:<br>
    <input type="number" name="price" required><br><br>

    รูปสินค้า:<br>
    <input type="file" name="image"><br><br>

    <button type="submit" name="submit">บันทึก</button>

</form>

<br>
<a href="index.php">⬅ กลับ</a>

</body>
</html>
