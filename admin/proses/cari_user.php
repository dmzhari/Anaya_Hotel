<?php
session_start();
include "../../includes/koneksi.php";

if (!isset($_SESSION['username']) && !isset($_SESSION['level']) == 'admin') {
    header('Location: ../../index.php');
    exit();
}
?>
<table id="tb_kamar" class="table table-striped" style="width:100%">
    <thead>
        <tr>
            <th>Nama User</th>
            <th class="text-center">Nama User</th>
            <th class="text-center">Aksi</th>
        </tr>
    </thead>
    <tbody>
        <?php
        $s_kata = htmlspecialchars($conn->real_escape_string($_POST['kata']));
        $cari_kata = '%' . $s_kata . '%';
        $sql = "SELECT * FROM tb_user WHERE (username LIKE ?) ORDER BY id DESC LIMIT 20";
        $result_satu = $conn->prepare($sql);
        $result_satu->bind_param('s', $cari_kata);
        $result_satu->execute();
        $result = $result_satu->get_result();

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
        ?>
                <tr>
                    <td><?php echo $row["username"]; ?></td>
                    <td class="text-center"><?php echo $row["tipe"]; ?></td>
                    <td class="text-center">
                        <a href="#" data-id="" class="btn btn-success" onClick="show_modal_user(this.id)" id="<?php echo $row["id"]; ?>">Lihat</a>
                        <a href="#" data-id="" class="btn btn-primary" onClick="edit_modal_user(this.id)" id="<?php echo $row["id"]; ?>">Edit</a>
                        <a href="#" data-id="" class="btn btn-danger" onClick="delete_modal_user(this.id)" id="<?php echo $row["id"]; ?>">Delete</a>
                    </td>
                </tr>
        <?php
            }
        } else {
            echo "<tr>
                        <td colspan='7' class='text-center'><span class='badge bg-danger'> Tidak ada data ditemukan </span></td>
                </tr>";
        }
        ?>
    </tbody>
</table>

<script type="text/javascript">
    function show_modal_user(id) {
        $("#lihat_data_user").modal('toggle');
        $.ajax({
            url: "proses/tampil_user.php",
            method: "GET",
            data: {
                idp: id
            },
            success: function(data) {
                $("#tampil_user").html(data).refresh;
            }
        });
    }

    function edit_modal_user(id) {
        $("#modal_edit_user").modal('toggle');
        $.ajax({
            url: "proses/edit_user.php",
            method: "GET",
            data: {
                idp: id
            },
            success: function(data) {
                $("#tedit_user").html(data).refresh;
            }
        });
    }
</script>