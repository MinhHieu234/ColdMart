<?php
include "connectdb.php";
$sql = "SELECT * FROM tbl_product";
$result = $conn->query($sql);

if (!$result) {
    die("Lỗi truy vấn: " . $conn->error);
}
?>

<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Danh sách sản phẩm</title>
    <link rel="stylesheet" href="sanpham.css">
</head>

<body>
    <h2>Danh sách sản phẩm</h2>
    <div class="table">
        <table>
            <tr>
                <th>Mã Sản Phẩm</th>
                <th>Ảnh</th>
                <th>Tên sản phẩm</th>
                <th>Giá</th>
                <th>Sửa</th>
                <th>Xoá</th>
            </tr>
            <?php while ($row = $result->fetch_assoc()) { ?>
                <tr>
                    <td><?php echo $row['id']; ?></td>
                    <td>

                        <?php

                        echo '<img src="data:image/jpeg;base64,' . base64_encode($row['image']) . '" alt="Hình ảnh sản phẩm"  height="100px">';
                        ?>
                    </td>
                    <td><?php echo $row['name']; ?></td>
                    <td><?php echo $row['price']; ?></td>
                    <td><a href="sua.php?id=<?php echo $row['id']; ?>">Sửa</a></td>
                    <td><a href="xoa.php?id=<?php echo $row['id']; ?>">Xoá</a></td>
                </tr>
            <?php } ?>
            <button><a href="them.php">Thêm mới</a></button>
        </table>



    </div>
</body>

</html>