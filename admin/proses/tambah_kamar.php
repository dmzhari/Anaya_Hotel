<?php
//print_r($_POST);
include "../../includes/koneksi.php";
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
