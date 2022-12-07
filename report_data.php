<?php
  session_start();

  // cek apakah yang mengakses halaman ini sudah login
  if($_SESSION['username']==""){
    echo "<div class='alert'>Username dan Password tidak sesuai !</div>";
  }

  $session_username   = $_SESSION['username'];
  $session_nama       = $_SESSION['nama'];
  $session_jabatan    = $_SESSION['jabatan'];
  $session_level      = $_SESSION['level'];

  $query_tgl_min  = $mysqli->query("select min(date(created_dt)) as minCreatedDt FROM trx_qrcode");
  $data_tgl_min   = mysqli_fetch_array($query_tgl_min);
  $tgl_min        = $data_tgl_min['minCreatedDt'];

  $query_tgl_max  = $mysqli->query("select max(date(created_dt)) as maxCreatedDt FROM trx_qrcode");
  $data_tgl_max   = mysqli_fetch_array($query_tgl_max);
  $tgl_max        = $data_tgl_max['maxCreatedDt'];
?>

<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>PT. Trafoindo | QR PLN</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="assets/link/fonts.googleapis.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="assets/plugins/fontawesome-free/css/all.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="assets/link/css/ionicframework.css">
  <!-- Tempusdominus Bootstrap 4 -->
  <link rel="stylesheet" href="assets/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="assets/dist/css/adminlte.min.css">
  <!-- DataTables -->
  <link rel="stylesheet" href="assets/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
  <link rel="stylesheet" href="assets/plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
  <link rel="stylesheet" href="assets/plugins/datatables-buttons/css/buttons.bootstrap4.min.css">
   <!-- Select2 -->
  <link rel="stylesheet" href="assets/plugins/select2/css/select2.min.css">
  <link rel="stylesheet" href="assets/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css">
  <!-- Other Link References -->
  <script src="assets/link/kit.fontawesome.js"></script>
  <script src="assets/link/ajax.googleapis.js"></script>
  <script src="assets/link/bootstrap3-typeahead-4.0.2.min.js"></script>
  <script src="assets/link/bootstrap.min-3.3.5.js"></script>
</head>
<body class="hold-transition sidebar-mini layout-fixed">
<!-- Site wrapper -->
<div class="wrapper">
  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
      </li>
    </ul>
  </nav>

  <aside class="main-sidebar main-sidebar-custom sidebar-dark-primary elevation-4">
    <a href="index.php?page=dashboard" class="brand-link">
      <img src="assets/img/logo-tpp.jpg" alt="Logo Trafoindo" class="brand-image img-circle">
      <span class="brand-text font-weight-light"><font size="5"><b>QR PLN</b></font></span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="assets/img/user-image.png" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
          <a href="index.php?page=dashboard" class="d-block"><?php echo $_SESSION['nama']; ?></a>
        </div>
      </div>



      <!-- Sidebar Menu -->
     <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon fa-solid fa-database"></i>
              <p>
                Master Data
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <?php if ($session_level == 0) { ?>
              <li class="nav-item">
                <a href="index.php?page=add_user" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>User</p>
                </a>
              </li>

              <li class="nav-item">
                <a href="index.php?page=add_jabatan_level" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Jabatan & Level</p>
                </a>
              </li>
              <?php } else {} ?>

              <li class="nav-item">
                <a href="index.php?page=add_kategori_kode_pabrik" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Kategori & Kode Pabrik</p>
                </a>
              </li>

              <li class="nav-item">
                <a href="index.php?page=add_katalog" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Katalog Material</p>
                </a>
              </li>
            </ul>
          </li>

          <li class="nav-item">
            <a href="index.php?page=add_trx" class="nav-link">
              <i class="nav-icon fa-solid fa-square-plus"></i>
              <p>Create QR & Barcode</p>
            </a>
          </li>

          <li class="nav-item">
            <a href="index.php?page=list_qrcode" class="nav-link">
              <i class="nav-icon fa-solid fa-list"></i>
              <p>List QR Code</p>
            </a>
          </li>

          <li class="nav-item">
            <a href="index.php?page=print_filter" class="nav-link">
              <i class="nav-icon fa-solid fa-print"></i>
              <p>Print Filter</p>
            </a>
          </li>
          
          <?php if ($session_level == 0) { ?>
          <li class="nav-item menu-open">
            <a href="#" class="nav-link active">
              <i class="nav-icon fa-solid fa-triangle-exclamation"></i>
              <p>Mode Testing
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="index.php?page=filter_delete_image" class="nav-link active">
                  <i class="nav-icon fa-solid fa-trash"></i>
                  <p>DELETE GAMBAR FILTER</p>
                </a>
              </li>

              <li class="nav-item">
                <a href="index.php?page=filter_delete_data" class="nav-link">
                  <i class="nav-icon fa-solid fa-file-circle-xmark"></i>
                  <p>DELETE DATA FILTER</p>
                </a>
              </li>

              <li class="nav-item">
                <a href="index.php?page=filter_create_image" class="nav-link">
                  <i class="nav-icon fa-solid fa-image"></i>
                  <p>GENERATE IMAGE FILTER</p>
                </a>
              </li>

              <li class="nav-item">
                <a href="index.php?page=mode_testing" onclick="return confirm('Dabatase akan di kosongkan dan gambar akan di hapus. Yakin ingin reset ?')" class="nav-link">
                  <i class="nav-icon fa-solid fa-ban"></i>
                  <p>RESET !!!</p>
                </a>
              </li>
            </ul>
          </li>
          <?php } else {} ?>
        </ul>
      </nav>
    </div>
    <div class="sidebar-custom">
      <a href="logout.php"><button type="button" class="btn btn-block bg-gradient-danger">LOGOUT</button></a>
    </div>
  </aside>

  <div class="content-wrapper">
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>DELETE GAMBAR QR & BARCODE MASSAL</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="index.php?page=dashboard">Home</a></li>
              <li class="breadcrumb-item active">Form Delete Gambar QR & Barcode Berdsarkan Filter</li>
            </ol>
          </div>
        </div>
      </div>
    </section>

    <section class="content">
      <div class="card">
        <div class="card-body">
          <font size="4" color="red"><b>Pilih Salah Satu Filter Jika Ingin Delete Gambar Banyak</b></font>

          <div class="form-group">
            <div class="custom-control custom-checkbox">
              <input class="custom-control-input" type="checkbox" id="checkbox_kode_material">
              <label for="checkbox_kode_material" class="custom-control-label">Kode Material</label>
            </div>

            <div class="custom-control custom-checkbox">
              <input class="custom-control-input" type="checkbox" id="checkbox_batch_produksi">
              <label for="checkbox_batch_produksi" class="custom-control-label">Batch Produksi</label>
            </div>

            <div class="custom-control custom-checkbox">
              <input class="custom-control-input" type="checkbox" id="checkbox_sn_material">
              <label for="checkbox_sn_material" class="custom-control-label">S/N Material</label>
            </div>

            <div class="custom-control custom-checkbox">
              <input class="custom-control-input" type="checkbox" id="checkbox_sn_mc_pln">
              <label for="checkbox_sn_mc_pln" class="custom-control-label">SN MC PLN (Kode Katalog)</label>
            </div>

            <div class="custom-control custom-checkbox">
              <input class="custom-control-input" type="checkbox" id="checkbox_kode_serial_material">
              <label for="checkbox_kode_serial_material" class="custom-control-label">Kode Serial Material PLN (Full Code)</label>
            </div>
          </div>

          <hr>

          <form class="form-horizontal" name="form_delete_gambar_massal" action="index.php?page=delete_gambar_massal" method="post">
            <div class="row">
              <div class="col-sm-3" id="kode_serial_material_from">
                <div class="form-group">
                  <label>Kode Serial Material PLN (From)</label>
                  <select class="form-control select2bs4" style="width:100%; height: 100%;" name="kode_serial_material_from">
                    <option selected="selected" value="">- Pilih -</option>
                    <?php
                    include "koneksi.php";
                    $sql=mysqli_query($mysqli,"select kode_serial_material from trx_qrcode where status_qr = '1' and status_barcode = '1' order by kode_serial_material asc");
                    while ($data = mysqli_fetch_array($sql)){
                      echo '<option name="kode_serial_material_from" value="'.$data['kode_serial_material'].'">'.$data['kode_serial_material'].'</option>';
                    }?>
                  </select>
                </div>
              </div>

              <div class="col-sm-3" id="kode_serial_material_to">
                <div class="form-group">
                  <label>Kode Serial Material PLN (To)</label>
                  <select class="form-control select2bs4" style="width:100%; height: 100%;" name="kode_serial_material_to">
                    <option selected="selected" value="">- Pilih -</option>
                    <?php
                    include "koneksi.php";
                    $sql=mysqli_query($mysqli,"select distinct kode_serial_material from trx_qrcode where status_qr = '1' and status_barcode = '1' order by kode_serial_material asc");
                    while ($data = mysqli_fetch_array($sql)){
                      echo '<option name="kode_serial_material_to" value="'.$data['kode_serial_material'].'">'.$data['kode_serial_material'].'</option>';
                    }?>
                  </select>
                </div>
              </div>

              <div class="col-sm-3" id="kode_material_from">
                <div class="form-group">
                  <label>Kode Material (From)</label>
                  <select class="form-control select2bs4" style="width:100%; height: 100%;" name="kode_material_from">
                    <option selected="selected" value="">- Pilih -</option>
                    <?php
                    include "koneksi.php";
                    $sql=mysqli_query($mysqli,"select distinct kode_material from trx_qrcode where status_qr = '1' and status_barcode = '1' order by kode_material asc");
                    while ($data = mysqli_fetch_array($sql)){
                      echo '<option name="kode_material_from" value="'.$data['kode_material'].'">'.$data['kode_material'].'</option>';
                    }?>
                  </select>
                </div>
              </div>

              <div class="col-sm-3" id="kode_material_to">
                <div class="form-group">
                  <label>Kode Material (To)</label>
                  <select class="form-control select2bs4" style="width:100%; height: 100%;" name="kode_material_to">
                    <option selected="selected" value="">- Pilih -</option>
                    <?php
                    include "koneksi.php";
                    $sql=mysqli_query($mysqli,"select distinct kode_material from trx_qrcode where status_qr = '1' and status_barcode = '1' order by kode_material asc");
                    while ($data = mysqli_fetch_array($sql)){
                      echo '<option name="kode_material_to" value="'.$data['kode_material'].'">'.$data['kode_material'].'</option>';
                    }?>
                  </select>
                </div>
              </div>

              <div class="col-sm-3" id="sn_mc_pln_from">
                <div class="form-group">
                  <label>SN MC PLN (From)</label>
                  <select class="form-control select2bs4" style="width:100%; height: 100%;" name="sn_mc_pln_from">
                    <option selected="selected" value="">- Pilih -</option>
                    <?php
                    include "koneksi.php";
                    $sql=mysqli_query($mysqli,"select distinct sn_mc_pln from trx_qrcode where status_qr = '1' and status_barcode = '1' order by sn_mc_pln asc");
                    while ($data = mysqli_fetch_array($sql)){
                      echo '<option name="sn_mc_pln_from" value="'.$data['sn_mc_pln'].'">'.$data['sn_mc_pln'].'</option>';
                    }?>
                  </select>
                </div>
              </div>

              <div class="col-sm-3" id="sn_mc_pln_to">
                <div class="form-group">
                  <label>SN MC PLN (To)</label>
                  <select class="form-control select2bs4" style="width:100%; height: 100%;" name="sn_mc_pln_to">
                    <option selected="selected" value="">- Pilih -</option>
                    <?php
                    include "koneksi.php";
                    $sql=mysqli_query($mysqli,"select distinct sn_mc_pln from trx_qrcode where status_qr = '1' and status_barcode = '1' order by sn_mc_pln asc");
                    while ($data = mysqli_fetch_array($sql)){
                      echo '<option name="sn_mc_pln_to" value="'.$data['sn_mc_pln'].'">'.$data['sn_mc_pln'].'</option>';
                    }?>
                  </select>
                </div>
              </div>

              <div class="col-sm-3" id="batch_produksi_from">
                <div class="form-group">
                  <label>Batch Produksi (From)</label>
                  <select class="form-control select2bs4" style="width:100%; height: 100%;" name="batch_produksi_from">
                    <option selected="selected" value="">- Pilih -</option>
                    <?php
                    include "koneksi.php";
                    $sql=mysqli_query($mysqli,"select distinct batch_produksi from trx_qrcode where status_qr = '1' and status_barcode = '1' order by batch_produksi asc");
                    while ($data = mysqli_fetch_array($sql)){
                      echo '<option name="batch_produksi_from" value="'.$data['batch_produksi'].'">'.$data['batch_produksi'].'</option>';
                    }?>
                  </select>
                </div>
              </div>

              <div class="col-sm-3" id="batch_produksi_to">
                <div class="form-group">
                  <label>Batch Produksi (To)</label>
                  <select class="form-control select2bs4" style="width:100%; height: 100%;" name="batch_produksi_to">
                    <option selected="selected" value="">- Pilih -</option>
                    <?php
                    include "koneksi.php";
                    $sql=mysqli_query($mysqli,"select distinct batch_produksi from trx_qrcode where status_qr = '1' and status_barcode = '1' order by batch_produksi asc");
                    while ($data = mysqli_fetch_array($sql)){
                      echo '<option name="batch_produksi_to" value="'.$data['batch_produksi'].'">'.$data['batch_produksi'].'</option>';
                    }?>
                  </select>
                </div>
              </div>

              <div class="col-sm-3" id="sn_material_from">
                <div class="form-group">
                  <label>S/N Material (From)</label>
                  <select class="form-control select2bs4" style="width:100%; height: 100%;" name="sn_material_from">
                    <option selected="selected" value="">- Pilih -</option>
                    <?php
                    include "koneksi.php";
                    $sql=mysqli_query($mysqli,"select distinct sn_material from trx_qrcode where status_qr = '1' and status_barcode = '1' order by sn_material asc");
                    while ($data = mysqli_fetch_array($sql)){
                      echo '<option name="sn_material_from" value="'.$data['sn_material'].'">'.$data['sn_material'].'</option>';
                    }?>
                  </select>
                </div>
              </div>

              <div class="col-sm-3" id="sn_material_to">
                <div class="form-group">
                  <label>S/N Material (To)</label>
                  <select class="form-control select2bs4" style="width:100%; height: 100%;" name="sn_material_to">
                    <option selected="selected" value="">- Pilih -</option>
                    <?php
                    include "koneksi.php";
                    $sql=mysqli_query($mysqli,"select distinct sn_material from trx_qrcode where status_qr = '1' and status_barcode = '1' order by sn_material asc");
                    while ($data = mysqli_fetch_array($sql)){
                      echo '<option name="sn_material_to" value="'.$data['sn_material'].'">'.$data['sn_material'].'</option>';
                    }?>
                  </select>
                </div>
              </div>

              <div class="col-sm-2">
                <div class="form-group">
                  <label>Tgl Pembuatan (From)</label>
                  <input class="form-control" type="date" name="tgl_pembuatan_from">
                </div>
              </div>

              <div class="col-sm-2">
                <div class="form-group">
                  <label>Tgl Pembuatan (To)</label>
                  <input class="form-control" type="date" name="tgl_pembuatan_to">
                </div>
              </div>

              <div class="col-sm-2">
                <div class="form-group">
                  <label>Order By</label>
                  <select class="form-control" style="width:100%; height: 100%;" name="order_by">
                    <option selected="selected" value="">- Pilih -</option>
                    <option value="kode_material">Kode Material</option>
                    <option value="sn_mc_pln">SN MC PLN</option>
                    <option value="batch_produksi">Batch Produksi</option>
                    <option value="sn_material">S/N Material</option>
                    <option value="kode_serial_material">Kode Serial Material</option>
                  </select>
                </div>
              </div>
            </div>
              

            <div class="card-footer">
              <button type="submit" name="submit_delete" class="btn btn-danger">DELETE</button>
            </div>
          </form>         
        </div>
      </div>
    </section>

  </div>

<footer class="main-footer">
  <div class="float-right d-none d-sm-block">
    <b>Version</b> 1.0
  </div>
  <strong>Copyright &copy; 2022 PT.Trafoindo Prima Perkasa.</strong> All rights reserved.
</footer>
</div>

<!-- jQuery -->
<script src="assets/link/jquery.min-1.12.4.js"></script>
<script src="assets/link/cloudflare.js"></script>


<script src="assets/dist/js/jquery.maskedinput.js" type="text/javascript"></script>
<!-- Bootstrap 4 -->
<script src="assets/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- Select2 -->
<script src="assets/plugins/select2/js/select2.full.min.js"></script>
<!-- Tempusdominus Bootstrap 4 -->
<script src="assets/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>
<!-- AdminLTE App -->
<script src="assets/dist/js/adminlte.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="assets/dist/js/demo.js"></script>

<script>
  function hanyaAngka(evt) {
    var charCode = (evt.which) ? evt.which : event.keyCode
     if (charCode > 30 && (charCode < 48 || charCode > 57))

      return false;
    return true;
  }
</script>

<script>
$(document).ready(function(){
    $("#kode_serial_material_from").hide();
    $("#kode_serial_material_to").hide();
    $("#kode_material_from").hide();
    $("#kode_material_to").hide();
    $("#sn_mc_pln_from").hide();
    $("#sn_mc_pln_to").hide();
    $("#batch_produksi_from").hide();
    $("#batch_produksi_to").hide();
    $("#sn_material_from").hide();
    $("#sn_material_to").hide();

     $('#checkbox_kode_serial_material').on('change', function(){
      if(this.checked) {
        $("#kode_serial_material_from").show();
        $("#kode_serial_material_to").show();
        $("#checkbox_kode_material").attr('disabled','disabled');
        $("#checkbox_sn_mc_pln").attr('disabled','disabled');
        $("#checkbox_batch_produksi").attr('disabled','disabled');
        $("#checkbox_sn_material").attr('disabled','disabled');
      }else{
        $("#checkbox_kode_material").removeAttr('disabled');
        $("#checkbox_sn_mc_pln").removeAttr('disabled');
        $("#checkbox_batch_produksi").removeAttr('disabled');
        $("#checkbox_sn_material").removeAttr('disabled');
        $("#kode_serial_material_from").hide();
        $("#kode_serial_material_to").hide();
      }
    });

    $('#checkbox_kode_material').on('change', function(){
      if(this.checked) {
        $("#kode_material_from").show();
        $("#kode_material_to").show();
        $("#checkbox_kode_serial_material").attr('disabled','disabled');
        $("#checkbox_sn_mc_pln").attr('disabled','disabled');
        $("#checkbox_batch_produksi").attr('disabled','disabled');
        $("#checkbox_sn_material").attr('disabled','disabled');
      }else{
        $("#checkbox_kode_serial_material").removeAttr('disabled');
        $("#checkbox_sn_mc_pln").removeAttr('disabled');
        $("#checkbox_batch_produksi").removeAttr('disabled');
        $("#checkbox_sn_material").removeAttr('disabled');
        $("#kode_material_from").hide();
        $("#kode_material_to").hide();
      }
    });

    $('#checkbox_sn_mc_pln').on('change', function(){
      if(this.checked) {
        $("#sn_mc_pln_from").show();
        $("#sn_mc_pln_to").show();
        $("#checkbox_kode_serial_material").attr('disabled','disabled');
        $("#checkbox_kode_material").attr('disabled','disabled');
        $("#checkbox_batch_produksi").attr('disabled','disabled');
        $("#checkbox_sn_material").attr('disabled','disabled');
      }else{
        $("#checkbox_kode_serial_material").removeAttr('disabled');
        $("#checkbox_kode_material").removeAttr('disabled');
        $("#checkbox_batch_produksi").removeAttr('disabled');
        $("#checkbox_sn_material").removeAttr('disabled');
        $("#sn_mc_pln_from").hide();
        $("#sn_mc_pln_to").hide();
      }
    });

    $('#checkbox_batch_produksi').on('change', function(){
      if(this.checked) {
        $("#batch_produksi_from").show();
        $("#batch_produksi_to").show();
        $("#checkbox_kode_serial_material").attr('disabled','disabled');
        $("#checkbox_kode_material").attr('disabled','disabled');
        $("#checkbox_sn_mc_pln").attr('disabled','disabled');
        $("#checkbox_sn_material").attr('disabled','disabled');
      }else{
        $("#checkbox_kode_serial_material").removeAttr('disabled');
        $("#checkbox_kode_material").removeAttr('disabled');
        $("#checkbox_sn_mc_pln").removeAttr('disabled');
        $("#checkbox_sn_material").removeAttr('disabled');
        $("#batch_produksi_from").hide();
        $("#batch_produksi_to").hide();
      }
    });

    $('#checkbox_sn_material').on('change', function(){
      if(this.checked) {
        $("#sn_material_from").show();
        $("#sn_material_to").show();
        $("#checkbox_kode_serial_material").attr('disabled','disabled');
        $("#checkbox_kode_material").attr('disabled','disabled');
        $("#checkbox_sn_mc_pln").attr('disabled','disabled');
        $("#checkbox_batch_produksi").attr('disabled','disabled');
      }else{
        $("#checkbox_kode_serial_material").removeAttr('disabled');
        $("#checkbox_kode_material").removeAttr('disabled');
        $("#checkbox_sn_mc_pln").removeAttr('disabled');
        $("#checkbox_batch_produksi").removeAttr('disabled');
        $("#sn_material_from").hide();
        $("#sn_material_to").hide();
      }
    });
});
</script>

<script>
  $(function () {
    //Initialize Select2 Elements
    $('.select2').select2()

    //Initialize Select2 Elements
    $('.select2bs4').select2({
      theme: 'bootstrap4'
    })
});

</script>


</body>
</html>
