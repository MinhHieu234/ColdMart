<?php
function checkuser($conn, $user, $pass)
{

    $stmt = $conn->prepare("SELECT * FROM tbl_user WHERE user = ? AND pass = ?");
    $stmt->bind_param("ss", $user, $pass);


    $stmt->execute();


    $result = $stmt->get_result();


    if ($result->num_rows > 0) {
        $kq = $result->fetch_assoc();
        return $kq['role'];
    } else {
        return null;
    }
}
?>