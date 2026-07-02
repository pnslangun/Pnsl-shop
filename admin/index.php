<?php
include "../config/db.php";
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Admin - สินค้า</title>
</head>
<body>

<h2>📦 จัดการสินค้า</h2>

<a href="add_product.php">➕ เพิ่มสินค้า</a>

<table border="1" cellpadding="10" cellspacing="0">
    <tr>
        <th>ID</th>
        <th>รูป</th>
        <th>ชื่อสินค้า</th>
        <th>ราคา</th>
        <th>จัดการ</th>
    </tr>

<?php
$sql = "SELECT * FROM products ORDER BY id DESC";
$result = $conn->query($sql);

while($row = $result->fetch_assoc()){
?>

    <tr>
        <td><?php echo $row['id']; ?></td>

        <td>
            <?php if($row['image']) { ?>
                <img src="../uploads/<?php echo $row['image']; ?>" width="80">
            <?php } ?>
        </td>

        <td><?php echo $row['name']; ?></td>
        <td><?php echo $row['price']; ?> บาท</td>

        <td>
            <a href="edit_product.php?id=<?php echo $row['id']; ?>">แก้ไข</a> |
            <a href="delete_product.php?id=<?php echo $row['id']; ?>" 
               onclick="return confirm('ลบสินค้านี้?')">
               ลบ
            </a>
        </td>
    </tr>

<?php } ?>

</table>

</body>
</html>
