<?php
session_start();
include "../../includes/koneksi.php";

if (!isset($_SESSION['username']) && !isset($_SESSION['level']) == 'admin') {
    header('Location: ../../index.php');
    exit();
}
$id     = htmlspecialchars($conn->real_escape_string($_POST['id']));
$sql    = "SELECT * FROM tb_user WHERE id = '$id'";
$query  = $conn->query($sql);
$fetch  = $query->fetch_assoc();

?>
<div class="container mt-2" id="data_user">
    <h2 class="text-center">DATA PROFILE USER</h2>
    <h5 class="text-center">Hotel Anaya</h5>

    <!-- Desain Box Tabel Profile User-->
    <div class="row col-md-6 offset-md-3">
        <div class="card mt-2 mb-4" style="width:2000px">
            <div class="card-body">
                <table id="tb_user" class="table table-striped table-bordered" style="width:100%; border: 2px solid;">
                    <thead>
                        <tr>
                            <th>Nama</th>
                            <th class="text-center">Level</th>
                            <th class="text-center">Password</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td><?= $fetch['username'] ?></td>
                            <td class="text-center"><?= $fetch['tipe'] ?></td>
                            <th class="text-center"><?= $fetch['password'] ?></th>
                        </tr>
                    </tbody>
                </table>
                <button class="btn btn-primary form-control" onclick="show_edit_user()">Edit</button>
            </div>
        </div>
    </div>

</div>

<!------------------------------ Script Awal Modal EDIT Kamar ------------------------------->
<div class="modal fade" id="modal_edit_user">
    <div class="modal-dialog ">
        <div class="modal-content">

            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title">Edit Data User</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>

            <!-- Modal body -->
            <div id="tedit_user" class="modal-body">
                <form id="form_ke">
                    <input type="text" id="idk" value="<?php echo $id; ?>" hidden>
                    <div class="mb-3 mt-3 form-floating">
                        <input value="<?= $fetch['username'] ?>" type="text" class="form-control" id="nama_user">
                        <label for="nama_user">Username</label>
                    </div>
                    <div class="mb-3 mt-3 form-floating">
                        <input value="<?= $fetch['password'] ?>" type="text" class="form-control" id="pass">
                        <label for="pass">Password</label>
                    </div>
                    <div class="mb-3 mt-3 form-floating">
                        <select class="form-select" id="tp_user">
                            <option value="admin">Admin</option>
                            <option value="resepsionis">Resepsionis</option>
                            <option value="tamu">Tamu</option>
                        </select>
                        <label for="tp_user">Tipe</label>
                    </div>

                </form>
            </div>
            <!-- Modal footer -->
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" id="update_user">Simpan</button>
                <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
            </div>

        </div>
    </div>
</div>
<!------------------------------ Script Akhir Modal EDIT Kamar ------------------------------ -->

<script type="text/javascript">
    function show_edit_user() {
        $("#modal_edit_user").modal('toggle');
    }

    $(function() {
        $("#update_user").on('click', function() {
            var idk = $("#idk").val();
            var nama_user = $("#nama_user").val();
            var tp_user = $("#tp_user").val();
            var pass = $('#pass').val();

            if ((nama_user == "") || (tp_user == "")) {
                alert("Terjadi kesalahan. Ada data yang kosong!");
                return;
            }

            $.ajax({
                url: "proses/update_profile_user.php",
                method: "POST",
                data: {
                    idk: idk,
                    username: nama_user,
                    password: pass,
                    tipe: tp_user
                },
                success: function(data) {
                    if (data == "OK") {
                        alert("Data Terupdate!");
                        window.location.href = "index.php?id=user";
                    }
                    if (data == "ERROR") {
                        alert("Data TIDAK terupdate!");
                    }
                    document.getElementById("form_ke").reset();
                }

            });
        });

    });
</script>