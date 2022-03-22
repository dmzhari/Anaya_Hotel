<?php
session_start();
include "../../includes/koneksi.php";

if (!isset($_SESSION['username']) && !isset($_SESSION['level']) == 'admin') {
    header('Location: ../../index.php');
    exit();
}

$nama      = htmlspecialchars($conn->real_escape_string($_POST['nama']));
$pass      = htmlspecialchars($conn->real_escape_string($_POST['pass']));
$tipe      = htmlspecialchars($conn->real_escape_string($_POST['tipe']));

$sql = "INSERT INTO tb_user VALUES ('', '$nama','$pass', '$tipe')";
if ($conn->query($sql) == 1) {
    $data = "OK";
    echo $data;
} else {
    $data = "ERROR";
    echo $data;
}
