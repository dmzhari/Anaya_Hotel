<?php
session_start();
include "../../includes/koneksi.php";

if (!isset($_SESSION['username']) && !isset($_SESSION['level']) == 'admin') {
	header('Location: ../../index.php');
	exit();
}

$idk       = htmlspecialchars($conn->real_escape_string($_POST['idk']));
$nama      = htmlspecialchars($conn->real_escape_string($_POST['nama']));
$jkamar    = htmlspecialchars($conn->real_escape_string($_POST['jkamar']));

$sql = "UPDATE tb_kamar SET nama_kamar ='$nama', total_kamar='$jkamar' WHERE (id_kamar = '$idk')";

if ($conn->query($sql) == 1) {
	$data = "OK";
	echo $data;
} else {
	$data = "ERROR";
	echo $data;
}
