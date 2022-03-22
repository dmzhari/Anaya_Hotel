<?php
session_start();
include "../../includes/koneksi.php";

if (!isset($_SESSION['username']) && !isset($_SESSION['level']) == 'admin') {
    header('Location: ../../index.php');
    exit();
}
?>
<div class="container mt-2" id="data_user">
    <h2 class="text-center">DATA USER</h2>
    <h5 class="text-center">Hotel Anaya</h5>

    <!-- Desain Pencarian Tanggal dan Nama -->
    <div class="d-flex justify-content-between d-flex flex-row-reverse">
        <div class="form-floating mb-2 mt-3">
            <input type="text" class="form-control" id="cariuser">
            <label for="nama">Cari Nama User</label>
        </div>
        <div class="form-floating mb-2 mt-3">
            <button type="button" onclick="add_modal_user()" class="btn btn-outline-primary">Tambah Data</button>
        </div>
    </div>

    <!-- Desain Box Tabel Kamar-->
    <div class="d-flex justify-content-center">
        <div class="card mt-2 mb-4" style="width:2000px">
            <div class="card-body">
                <div id="cari_user" style="overflow-x:auto;">
                    <div id="cari_user" style="overflow-x:auto;">
                        <table id="tb_user" class="table table-striped" style="width:100%">
                            <thead>
                                <tr>
                                    <th>Nama User</th>
                                    <th class="text-center">Level</th>
                                    <th class="text-center">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $sql = "SELECT * FROM tb_user ORDER BY id ASC LIMIT 10";
                                $result = $conn->query($sql);
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
                                }
                                ?>
                            </tbody>
                        </table>

                    </div>
                </div>
            </div>
        </div>
    </div>

</div>

<!------------------------------ Script Awal Modal Tambah Kamar ------------------------------->
<div class="modal fade" id="modal_tambah_user">
    <div class="modal-dialog ">
        <div class="modal-content">

            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title">Tambah Data User</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>

            <!-- Modal body -->
            <div class="modal-body">
                <form id="form_k">
                    <div class="mb-3 mt-3 form-floating">
                        <input type="text" class="form-control" id="nama_user">
                        <label for="nama_user">Nama User</label>
                    </div>
                    <div class="mb-3 mt-3 form-floating">
                        <input type="text" class="form-control" id="pass">
                        <label for="pass">Password</label>
                    </div>
                    <div class="mb-3 mt-3 form-floating">
                        <select class="form-select" id="tipe">
                            <option value="admin">Admin</option>
                            <option value="resepsionis">Resepsionis</option>
                            <option value="tamu">Tamu</option>
                        </select>
                        <label for="tipe">Tipe</label>
                    </div>
                </form>

            </div>
            <!-- Modal footer -->
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" id="add_user">Simpan</button>
                <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
            </div>

        </div>
    </div>
</div>
<!------------------------------ Script Akhir Modal Tambah Kamar ------------------------------ -->

<!----------------------------- Script Awal Modal Lihat Data Kamar -------------------------------- -->
<div class="modal fade" id="lihat_data_user">
    <div class="modal-dialog">
        <div class="modal-content">

            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title">Deskripsi User</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>

            <!-- Modal body -->
            <div id="tampil_user" class="modal-body">

            </div>
            <!-- Modal footer -->
            <div class="modal-footer">
                <p class="text-center">@Desain by UKK RPL 2022</p>
            </div>

        </div>
    </div>
</div>
<!----------------------------- Script Akhir Modal Lihat Data Kamar -------------------------------- -->

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
    function add_modal_user() {
        $("#modal_tambah_user").modal('toggle');
    }

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

    function delete_modal_user(id) {
        $.ajax({
            url: "proses/delete_user.php",
            method: "POST",
            data: {
                idp: id
            },
            success: function(data) {
                if (data == "OK") {
                    alert("Data Berhasil dihapus!");
                    window.location.href = "index.php?id=user";
                }
                if (data == "ERROR") {
                    alert("Data Gagal dihapus!");
                }
            }
        });
    }

    $(function() {
        $("#add_user").on('click', function() {
            var nama = $("#nama_user").val();
            var password = $('#pass').val();
            var tipe = $("#tipe").val();

            if ((nama == "") || (password == "")) {
                alert("Terjadi kesalahan. Ada data yang kosong!");
                return;
            }

            $.ajax({
                url: "proses/tambah_user.php",
                method: "POST",
                data: {
                    nama: nama,
                    tipe: tipe,
                    pass: password
                },
                success: function(data) {
                    if (data == "OK") {
                        alert("Data Tersimpan!");
                        window.location.href = "index.php?id=user";
                    }
                    if (data == "ERROR") {
                        alert("Data TIDAK tersimpan!");
                    }
                    document.getElementById("form_k").reset();
                }

            });
        });

    });

    $(function() {
        $("#update_user").on('click', function() {
            var idk = $("#idk").val();
            var nama_user = $("#username").val();
            var tp_user = $('#tp_user').val();

            if (nama_user == "") {
                alert("Terjadi kesalahan. Ada data yang kosong!");
                return;
            }

            $.ajax({
                url: "proses/update_user.php",
                method: "POST",
                data: {
                    idk: idk,
                    username: nama_user,
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

    $('#cariuser').keyup(function() {
        var kata = $("#cariuser").val();
        //alert(kata);
        $.ajax({
            url: "proses/cari_user.php",
            method: "POST",
            data: {
                kata: kata
            },
            success: function(data) {
                //alert(data);return;
                $("#cari_user").html(data).refresh;
            }
        });
    });
</script>