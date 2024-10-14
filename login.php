<?php
session_start();
ob_start();
include "connectdb.php";
include "user.php";

if (isset($_POST['dangnhap']) && $_POST['dangnhap']) {
    $user = $_POST['user'];
    $pass = $_POST['pass'];

    $role = checkuser($conn, $user, $pass);
    $_SESSION['role'] = $role;


    if ($role == 1) {
        header('location:index.php');
    } else {
        header('location:login.php');
    }


}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login-Admin</title>
    <link rel="stylesheet" href="login.css">
</head>

<body>
    <div class="main">
        <h2>Login</h2>
        <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
            <input type="text" name="user" placeholder="User" required>
            <input type="password" name="pass" placeholder="Password" required>
            <input type="submit" name="dangnhap" value="Đăng nhập">
        </form>
    </div>
</body>

</html>