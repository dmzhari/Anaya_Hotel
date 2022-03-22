<?php
session_start();
include "../../includes/koneksi.php";

if (!isset($_SESSION['username']) && !isset($_SESSION['level']) == 'admin') {
    header('Location: ../../index.php');
    exit();
}

$id  = isset($_GET['idp']) ? htmlspecialchars($conn->real_escape_string($_GET['idp'])) : NULL;
$sql = "SELECT * FROM tb_user WHERE id = $id";
$result = $conn->query($sql);
$row = $result->fetch_assoc();
$nama_user   = $row["username"];
$level       = $row["tipe"];

?>
<form id="form_ke">
    <input type="text" id="idk" value="<?php echo $id; ?>" hidden>
    <input value="<?php echo $nama_user; ?>" type="text" id="username" hidden>
    <div class="mb-3 mt-3 form-floating">
        <select class="form-select" id="tp_user">
            <option value="admin">Admin</option>
            <option value="resepsionis">Resepsionis</option>
            <option value="tamu">Tamu</option>
        </select>
        <label for="tp_user">Tipe</label>
    </div>

</form>