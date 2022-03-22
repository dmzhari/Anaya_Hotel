<?php
session_start();
include "../../includes/koneksi.php";

if (!isset($_SESSION['username']) && !isset($_SESSION['level']) == 'admin') {
	header('Location: ../../index.php');
	exit();
}

$nama      = htmlspecialchars($conn->real_escape_string($_POST['nama']));
$jkamar    = htmlspecialchars($conn->real_escape_string($_POST['jkamar']));

$sql = "INSERT INTO tb_kamar (nama_kamar, total_kamar) VALUES ('$nama','$jkamar')";
if ($conn->query($sql) == 1) {
	$data = "OK";
	echo $data;
} else {
	$data = "ERROR";
	echo $data;
}
