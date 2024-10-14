<?php
session_start();
ob_start();

if (isset($_SESSION['role']) && ($_SESSION['role'] == 1)) {
    include "header.php";


    if (isset($_GET['act'])) {
        $action = $_GET['act'];

        switch ($action) {
            case 'sanpham':
                include "sanpham.php";
                break;
            case 'nhanvien':
                include "nhanvien.php";
                break;
            case 'doanhthu':
                include "doanhthu.php";
                break;
            case 'khohang':
                include "khohang.php";
                break;
            case 'taikhoan':
                include "taikhoan.php";
                break;
            case 'thoat':
                unset($_SESSION['role']);
                header('Location: login.php');
                exit();
            default:
                include "home.php";
                break;
        }
    } else {

        include "home.php";
    }

    include "footer.php";
} else {

    header('Location: login.php');
    exit();
}
?>