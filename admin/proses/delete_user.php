<?php
session_start();
include "../../includes/koneksi.php";

if (!isset($_SESSION['username']) && !isset($_SESSION['level']) == 'admin') {
    header('Location: ../../index.php');
    exit();
}

$id     = htmlspecialchars($conn->real_escape_string($_POST['idp']));
$sql    = "DELETE FROM tb_user WHERE id = '$id'";

if (($conn->query($sql) == 1)) {
    $data = "OK";
    echo $data;
} else {
    $data = "ERROR";
    echo $data;
}
