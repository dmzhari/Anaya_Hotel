<?php
session_start();
include '../includes/koneksi.php';

if (!isset($_SESSION['username']) && !isset($_SESSION['level']) == 'admin') {
  header('Location: ../index.php');
  exit;
}

$username = $_SESSION['username'];
$sql      = "SELECT id FROM tb_user WHERE username = '$username'";
$query    = $conn->query($sql);
$fetch    = $query->fetch_assoc();

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <title>Admin - Hotel Booking</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="shortcut icon" type="image/x-icon" href="../hotel.png" />
  <link rel="stylesheet" href="../css/bootstrap5.0.1.min.css">
  <link rel="stylesheet" href="../css/style.css">
</head>

<body>

  <div class="p-2 begin-header text-center fw-bold">
    <h1>HOTEL ANAYA</h1>
    <p>Selamat datang di Hotel Anaya Labuan Bajo Indonesia!</p>
  </div>

  <nav class="navbar navbar-expand-sm navbar-dark">
    <div class="container-fluid">
      <h4><a class="nav-link text-white">ADMIN</a></h4>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#mynavbar">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="mynavbar">
        <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
          <li class="nav-item">
            <h5><a class="nav-link" href="#" id="tombol_kamar">Kamar</a></h5>
          </li>
          <li class="nav-item">
            <h5><a class="nav-link" href="#" id="tombol_reservasi">Data Reservasi</a></h5>
          </li>
          <li class="nav-item dropdown">
            <h5 data-bs-toggle="dropdown">
              <a href="#" class="nav-link dropdown-toggle">Fasilitas</a>
            </h5>
            <div class="dropdown-menu">
              <a class="nav-link" href="#" id="tombol_fasilitas">Fasilitas Kamar</a>
              <a class="nav-link" href="#" id="tombol_fasilitas_umum">Fasilitas Umum</a>
            </div>
          </li>
          <li class="nav-item dropdown">
            <h5 data-bs-toggle="dropdown">
              <a href="#" class="nav-link dropdown-toggle">User</a>
            </h5>
            <div class="dropdown-menu">
              <a href="#" class="dropdown-item" id="user">Data User</a>
              <a href="#" class="dropdown-item" id="profile">Profile</a>
            </div>
            <!-- <ul class=""></ul>
            <h5><a href="#" class="nav-link" id="user">User</a></h5> -->
          </li>
          <li class="nav-item">
            <h5><a class="nav-link text-danger" href="logout.php" id="logout.php">Logout</a></h5>
          </li>
        </ul>

      </div>
    </div>
  </nav>

  <!-------- PANGGIL DATA KAMAR, FASILITAS DAN FASILITAS UMUM ------>
  <div id="data">

  </div>

  <div class="modal fade" id="modal_lihat_reservasi">
    <div class="modal-dialog">
      <div class="modal-content">
        <input type="text" id="idpelanggan" value="3" hidden>
        <!-- Modal Header -->
        <div class="modal-header">
          <h4 class="modal-title text-center">Data Tamu</h4>
          <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
        </div>

        <!-- Modal body -->
        <div id="pelanngan" class="modal-body">

        </div>

        <!-- Modal footer -->
        <div class="modal-footer">
          <p class="text-center">@Desain by UKK RPL 2022</p>
        </div>

      </div>
    </div>
  </div>

  <!----------------------------- Script Awal Modal Check Reservasi -------------------------------- -->
  <div class="modal fade" id="modal_check_reservasi">
    <div class="modal-dialog">
      <div class="modal-content">

        <!-- Modal Header -->
        <div class="modal-header">
          <h4 class="modal-title">Reservasi</h4>
          <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
        </div>

        <!-- Modal body -->
        <div class="modal-body">
          <div class="form-floating mt-2 mb-2">
            <select class="form-select mt-3" id="proses" name="proses">
              <option value="1"> Selesai Checkin </option>
              <option value="0"> Dalam Proses </option>
              <option value="3"> Batal </option>
            </select>
            <label for="idkamar">Proses</label>
          </div>
        </div>

        <!-- Modal footer -->
        <div class="modal-footer">
          <button type="button" class="btn btn-primary" id="id_proses">Proses</button>
          <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
        </div>

      </div>
    </div>
  </div>
  <!----------------------------- Script Akhir Modal Check Reservasi -------------------------------- -->

  <!-- SCRIPT FOOTER -->
  <div class="mt-5 p-2 bg-dark text-white text-center">
    <p>@Desain by UKK RPL 2022</p>
  </div>

  <!-- SCRIPT JAVASCRIPT -->
  <script src="../js/jquery.min.js"></script>
  <script src="../js/bootstrap5.0.1.bundle.min.js"></script>
  <script src="crud_js/pesan.js"></script>

  <script type="text/javascript">
    $(document).ready(function() {

      if (window.location.href.indexOf('index.php?id=fasilitas_kamar') > -1) {
        load_fasilitas_kamar();
      } else
      if (window.location.href.indexOf('index.php?id=fasilitas_umum') > -1) {
        load_fasilitas_umum();
      } else
      if ((window.location.href.indexOf('index.php?id=kamar') > -1) ||
        (window.location.href.indexOf('/') > -1)) {
        load_kamar();
      }

      /*tombol tambah(+) fasilitas*/
      $("#add_fasilitas").click(function() {
        $("#modal_tambah_fasilitas").modal('show');
      });

      /*tombol tambah(+) fasilitas umum*/
      $("#add_fasilitas_umum").click(function() {
        $("#modal_tambah_fasilitas_umum").modal('show');
      });

      /* Tombol Menu Reservasi */
      $("#tombol_reservasi").click(function() {
        load_reservasi();
      });

      /* Tombol Profile User */
      $('#profile').click(function() {
        load_profile_user();
      })

      /* Tombol Menu User */
      $('#user').click(function() {
        load_user();
      });

      /*Saat klik tombol Menu Kamar*/
      $("#tombol_kamar").click(function() {
        load_kamar();
      });

      /*Saat klik tombol Menu Fasilitas kamar*/
      $("#tombol_fasilitas").click(function() {
        load_fasilitas_kamar();
      });

      /*Saat klik tombol Menu Fasilitas Umum*/
      $("#tombol_fasilitas_umum").click(function() {
        load_fasilitas_umum();
      });

      $("#show_kamar").click(function() {
        $("#lihat_data_kamar").modal("show");
      });

      $("#show_fasilitas").click(function() {
        $("#lihat_data_fasilitas").modal("show");
      });

      $("#show_fasilitas_umum").click(function() {
        $("#lihat_data_fasilitas_umum").modal("show");
      });

      function load_reservasi() {
        var id = 0;
        $.ajax({
          url: "proses/load_table_reservasi.php",
          method: "POST",
          data: {
            ids: id
          },
          success: function(data) {
            //alert(data);return;
            $("#data").html(data).refresh;
          }
        });
      }


      function load_profile_user() {
        $.ajax({
          url: 'proses/load_profile_user.php',
          method: 'POST',
          data: {
            id: <?= $fetch['id'] ?>
          },
          success: function(data) {
            $('#data').html(data).refresh;
          }
        });
      }

      function load_user() {
        $.ajax({
          url: "proses/load_user.php",
          success: function(data) {
            $("#data").html(data).refresh;
          }
        });
      }


      function load_kamar() {
        var id = 0;
        $.ajax({
          url: "proses/load_kamar.php",
          method: "POST",
          data: {
            ids: id
          },
          success: function(data) {
            //alert(data);return;
            $("#data").html(data).refresh;
          }
        });
      }

      function load_fasilitas_kamar() {
        var id = 0;
        $.ajax({
          url: "proses/load_fasilitas.php",
          method: "POST",
          data: {
            ids: id
          },
          success: function(data) {
            //alert(data);return;
            $("#data").html(data).refresh;
          }
        });
      }

      function load_fasilitas_umum() {
        var id = 0;
        $.ajax({
          url: "proses/load_fasilitas_umum.php",
          method: "POST",
          data: {
            ids: id
          },
          success: function(data) {
            //alert(data);return;
            $("#data").html(data).refresh;
          }
        });
      }

    });
  </script>

  <!-- END BODY -->
</body>

</html>