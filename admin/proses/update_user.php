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

$sql   = "UPDATE tb_user SET username ='$nama', tipe='$tipe' WHERE (id = '$idk')";

if ($conn->query($sql) == 1) {
    $data = "OK";
    echo $data;
} else {
    $data = "ERROR";
    echo $data;
}
