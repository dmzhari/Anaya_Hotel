<?php
session_start();
include "../../includes/koneksi.php";

if (!isset($_SESSION['username']) && !isset($_SESSION['level']) == 'resespsionis') {
  header('Location: ../../index.php');
  exit();
}

$id        = htmlspecialchars($conn->real_escape_string($_POST['ids']));
$proses    = htmlspecialchars($conn->real_escape_string($_POST['proses']));

$sql = "UPDATE tb_pelanggan SET status ='$proses' WHERE (id= '$id')";

if (($conn->query($sql) == 1)) {
  $data = "OK";
  echo $data;
} else {
  $data = "ERROR";
  echo $data;
}
