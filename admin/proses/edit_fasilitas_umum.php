<?php
session_start();
include "../../includes/koneksi.php";
include "../../includes/timezone.php";

if (!isset($_SESSION['username']) && !isset($_SESSION['level']) == 'admin') {
	header('Location: ../../index.php');
	exit();
}


$id				= htmlspecialchars($conn->real_escape_string($_POST['idfu']));
$namafu        	= htmlspecialchars($conn->real_escape_string($_POST['enamafu']));
$ketfu 			= htmlspecialchars($conn->real_escape_string($_POST['eketfu']));
$today			= date("Y-m-d h:i:sa");
$jgambar		= $namafu . "_" . $today;
$gambar			= htmlspecialchars($conn->real_escape_string($_POST['egambarfu']));

if ($gambar != "") {
	if ($_FILES["eupload_fasilitas"]["name"] != '') {
		$name       	 = $_FILES['eupload_fasilitas']['name'];
		$temp_name  	 = $_FILES['eupload_fasilitas']['tmp_name'];
		$targetPath1 	 = "image/";
		$targetPath 	 = "../../image/";
		$extension		 = explode(".", $name);
		$file_extension = end($extension);

		$sql = "select * from tb_fasilitas_umum where id='$id'";
		$query = $conn->query($sql);
		$row = $query->fetch_assoc();

		$url = preg_replace("![^a-z0-9]+!i", "", $jgambar);
		//echo $url;

		//target file hapus
		$targetFile1 = $targetPath . basename($row['gambar']);

		$targetFile = $targetPath . basename($url . "." . $file_extension);
		$file_load  = $targetPath1 . $url . "." . $file_extension;

		if (file_exists($targetFile1)) {
			unlink('../../' . $row['gambar']);
		}
		move_uploaded_file($temp_name, $targetFile);
		//echo $file_load;

		$sql = "UPDATE tb_fasilitas_umum SET nama_fasilitas ='$namafu',
					keterangan ='$ketfu',  
					gambar='$file_load' WHERE (id= '$id')";

		if ($conn->query($sql) == 1) {
			$data = "OK";
			echo $data;
		} else {
			$data = "ERROR";
			echo $data;
		}
	}
} else {
	$sql = "UPDATE tb_fasilitas_umum
		SET nama_fasilitas ='$namafu', keterangan ='$ketfu'
		WHERE (id= '$id')";
	if ($conn->query($sql) == 1) {
		$data = "OK";
		echo $data;
	} else {
		$data = "ERROR";
		echo $data;
	}
}
