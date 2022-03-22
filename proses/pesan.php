<?php
//print_r($_POST);
include "../includes/koneksi.php";
include '../includes/timezone.php';

if (isset($_POST['nama'])) {
	$nama      = htmlspecialchars($conn->real_escape_string($_POST['nama']));
	$email     = htmlspecialchars($conn->real_escape_string($_POST['email']));
	$hp        = htmlspecialchars($conn->real_escape_string($_POST['hp']));
	$tamu      = htmlspecialchars($conn->real_escape_string($_POST['tamu']));
	$checkin   = htmlspecialchars($conn->real_escape_string($_POST['checkin']));
	$checkout  = htmlspecialchars($conn->real_escape_string($_POST['checkout']));
	$jkamar    = htmlspecialchars($conn->real_escape_string($_POST['jkamar']));
	$idkamar   = htmlspecialchars($conn->real_escape_string($_POST['idkamar']));
	$today	   = date('Y-m-d h:i:sa');

	$sql = "INSERT INTO tb_pelanggan (nama_pemesan, email, hp, nama_tamu, tgl_pesan, checkin, checkout, jml_kamar, id_kamar) 
			VALUES ('$nama','$email', '$hp', '$tamu', '$today', '$checkin', '$checkout', '$jkamar', '$idkamar')";

	if ($conn->query($sql) == 1) {
		$data = "OK";
		echo $data;
	} else {
		$data = "ERROR";
		echo $data;
	}
}
