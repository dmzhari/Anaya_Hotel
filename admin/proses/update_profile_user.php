<?php
session_start();
include "../../includes/koneksi.php";

if (!isset($_SESSION['username']) && !isset($_SESSION['level']) == 'admin') {
    header('Location: ../../index.php');
    exit();
}

$idk       = htmlspecialchars($conn->real_escape_string($_POST['idk']));
$nama      = htmlspecialchars($conn->real_escape_string($_POST['username']));
$tipe      = htmlspecialchars($conn->real_escape_string($_POST['tipe']));
$password  = htmlspecialchars($conn->real_escape_string($_POST['password']));

$sql   = "UPDATE tb_user SET username ='$nama', password = '$password', tipe='$tipe' WHERE (id = '$idk')";

if ($conn->query($sql) == 1) {
    $_SESSION['username'] = $nama;

    $data = "OK";
    echo $data;
} else {
    $data = "ERROR";
    echo $data;
}
