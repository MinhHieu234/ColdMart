<?php
include "connectdb.php";


if (isset($_GET['id'])) {
    $id = $_GET['id'];


    $sql = "SELECT * FROM tbl_product WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();


    if ($result->num_rows > 0) {
        $product = $result->fetch_assoc();
    } else {
        echo "Sản phẩm không tồn tại!";
        exit();
    }
} else {
    echo "ID sản phẩm không hợp lệ!";
    exit();
}


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $price = $_POST['price'];


    if (isset($_FILES['image']) && $_FILES['image']['error'] == 0) {
        $image_tmp = $_FILES['image']['tmp_name'];
        $image_data = file_get_contents($image_tmp);


        $sql = "UPDATE tbl_product SET name=?, price=?, image=? WHERE id=?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("sdsi", $name, $price, $image_data, $id);
    } else {

        $sql = "UPDATE tbl_product SET name=?, price=? WHERE id=?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("sdi", $name, $price, $id);
    }

    if ($stmt->execute()) {
        echo "Cập nhật sản phẩm thành công!";
        header("Location: index.php");
        exit();
    } else {
        echo "Lỗi: " . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chỉnh sửa sản phẩm</title>
</head>

<body>
    <h2>Chỉnh sửa sản phẩm</h2>
    <form method="POST" action="" enctype="multipart/form-data">
        <label for="name">Tên sản phẩm:</label>
        <input type="text" name="name" value="<?php echo $product['name']; ?>" required><br>

        <label for="price">Giá:</label>
        <input type="number" name="price" step="0.01" value="<?php echo $product['price']; ?>" required><br>

        <label for="image">Chọn hình ảnh mới (nếu có):</label>
        <input type="file" name="image"><br>

        <input type="submit" value="Cập nhật">
    </form>

    <a href="index.php">Quay lại danh sách sản phẩm</a>
</body>

</html>