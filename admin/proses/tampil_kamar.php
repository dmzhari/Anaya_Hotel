<?php
session_start();
include "../../includes/koneksi.php";

if (!isset($_SESSION['username']) && !isset($_SESSION['level']) == 'admin') {
  header('Location: ../../index.php');
  exit();
}

$id  = isset($_GET['idp']) ? htmlspecialchars($conn->real_escape_string($_GET['idp'])) : NULL;
$sql = "SELECT * FROM tb_kamar WHERE id_kamar= $id";
$result = $conn->query($sql);
$row = $result->fetch_assoc();
$total_kamar = $row["total_kamar"];
$namakamar = $row["nama_kamar"];

?>
<table class="table table-striped" style="width:100%">

  <tbody>
    <tr>
      <td>Nama Kamar </td>
      <td>: <?php echo $namakamar; ?> </td>
    </tr>
    <tr>
      <td>Total Kamar </td>
      <td>: <?php echo $total_kamar; ?> </td>
    </tr>
  </tbody>

</table>