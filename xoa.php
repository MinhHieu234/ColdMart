<?php
include "connectdb.php";


if (isset($_GET['id'])) {
    $id = $_GET['id'];


    $sql = "DELETE FROM tbl_product WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);

    if ($stmt->execute()) {
        echo "Xóa sản phẩm thành công!";


        $sql_reset_auto_increment = "ALTER TABLE tbl_product AUTO_INCREMENT = 1";
        $conn->query($sql_reset_auto_increment);


        header("Location: index.php");
        exit();
    } else {
        echo "Lỗi: " . $conn->error;
    }
} else {
    echo "ID sản phẩm không hợp lệ!";
    exit();
}
?>