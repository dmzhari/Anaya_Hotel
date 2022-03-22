<?php
session_start();
include "../../includes/koneksi.php";

if (!isset($_SESSION['username']) && !isset($_SESSION['level']) == 'admin') {
    header('Location: ../../index.php');
    exit();
}

$id          = isset($_GET['idp']) ? htmlspecialchars($conn->real_escape_string($_GET['idp'])) : NULL;
$sql         = "SELECT * FROM tb_user WHERE id = $id";
$result      = $conn->query($sql);
$row         = $result->fetch_assoc();
$nama_user   = $row["username"];
$level       = $row["tipe"];
$password    = $row['password'];

?>
<table class="table table-striped" style="width:100%">

    <tbody>
        <tr>
            <td>Nama User </td>
            <td>: <?php echo $nama_user; ?> </td>
        </tr>
        <tr>
            <td>Level </td>
            <td>: <?php echo $level; ?> </td>
        </tr>
    </tbody>

</table>