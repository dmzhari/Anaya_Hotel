<?php
session_start();
include '../includes/koneksi.php';

if (isset($_POST['username'])) {
    $username = htmlspecialchars($conn->real_escape_string($_POST['username']));
    $password = htmlspecialchars($conn->real_escape_string($_POST['password']));
    $sql      = "SELECT * FROM tb_user WHERE username = '$username' && password = '$password'";
    $act      = $conn->query($sql);

    if ($act->num_rows > 0) {
        $get_res = $act->fetch_assoc();

        $_SESSION['username'] = $username;
        $_SESSION['level']    = $get_res['tipe'];

        echo "success/" . $get_res['tipe'];
    } else {
        echo 'wrong';
    }
}
