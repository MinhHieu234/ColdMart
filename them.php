<?php
include "connectdb.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $name = $_POST['name'];
    $price = $_POST['price'];


    if (isset($_FILES['image']) && $_FILES['image']['error'] == 0) {

        $image_tmp = $_FILES['image']['tmp_name'];


        $image_data = file_get_contents($image_tmp);


        $sql = "INSERT INTO tbl_product (name, price, image) VALUES (?, ?, ?)";

        $stmt = $conn->prepare($sql);
        $stmt->bind_param("sds", $name, $price, $image_data);

        if ($stmt->execute()) {
            echo "Thêm sản phẩm thành công!";

            $sql_reset_auto_increment = "ALTER TABLE tbl_product AUTO_INCREMENT = 1";
            $conn->query($sql_reset_auto_increment);

            header("Location: index.php");
            exit();
        } else {
            echo "Lỗi: " . $conn->error;
        }

        $stmt->close();
    } else {
        echo "Có lỗi khi tải lên hình ảnh.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thêm Sản Phẩm</title>
    <link rel="stylesheet" href="them,sua.css">

</head>

<body>

    <h2>Thêm Sản Phẩm Mới</h2>
    <form method="POST" action="" enctype="multipart/form-data">
        <label for="name">Tên sản phẩm:</label>
        <input type="text" name="name" required><br>

        <label for="price">Giá:</label>
        <input type="number" name="price" step="0.01" required><br>

        <label for="image">Chọn hình ảnh:</label>
        <input type="file" name="image" accept="image/*" required><br>

        <input type="submit" value="Thêm sản phẩm">
    </form>

    <a href="index.php?act=sanpham">Quay lại danh sách sản phẩm</a>
</body>

</html>