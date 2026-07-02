<?php
include "../config/db.php";

$id = $_GET['id'];

// ดึงข้อมูลสินค้าเดิม
$sql = "SELECT * FROM products WHERE id=$id";
$result = $conn->query($sql);
$row = $result->fetch_assoc();

if(isset($_POST['update'])){

    $name = $_POST['name'];
    $price = $_POST['price'];

    $image = $_FILES['image']['name'];
    $tmp = $_FILES['image']['tmp_name'];

    if($image != ""){
        // ลบรูปเก่า
        if($row['image']){
            unlink("../uploads/".$row['image']);
        }

        move_uploaded_file($tmp, "../uploads/".$image);

        $sql = "UPDATE products 
                SET name='$name', price='$price', image='$image'
                WHERE id=$id";
    } else {
        $sql = "UPDATE products 
                SET name='$name', price='$price'
                WHERE id=$id";
    }

    if($conn->query($sql)){
        echo "<script>alert('อัปเดตแล้ว'); window.location='index.php';</script>";
    } else {
        echo "ผิดพลาด: " . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>แก้ไขสินค้า</title>
</head>
<body>

<h2>✏️ แก้ไขสินค้า</h2>

<form method="post" enctype="multipart/form-data">

    ชื่อสินค้า:<br>
    <input type="text" name="name" value="<?php echo $row['name']; ?>"><br><br>

    ราคา:<br>
    <input type="number" name="price" value="<?php echo $row['price']; ?>"><br><br>

    รูปปัจจุบัน:<br>
    <?php if($row['image']) { ?>
        <img src="../uploads/<?php echo $row['image']; ?>" width="100"><br>
    <?php } ?><br>

    เปลี่ยนรูป:<br>
    <input type="file" name="image"><br><br>

    <button type="submit" name="update">อัปเดต</button>

</form>

<br>
<a href="index.php">⬅ กลับ</a>

</body>
</html>
