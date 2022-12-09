<?php
  session_start();

  date_default_timezone_set('Asia/Jakarta');

  if($_SESSION['username']==""){
    echo "<div class='alert'>Username dan Password tidak sesuai !</div>";
  }

  $session_username   = $_SESSION['username'];
  $session_nama       = $_SESSION['nama'];
  $session_level      = $_SESSION['level'];

  //GENERATE KODE TIKET (Cth : PC001)
  $kode_trx     = 'PC';

  $query_trx      = $mysqli->query("select * FROM trx_parking WHERE substring(kode_tiket,1,2) = '$kode_trx'");
  $data_trx       = mysqli_fetch_array($query_trx);
  $jmlh_data_trx  = mysqli_num_rows($query_trx);

  $current_time   = date('Y-m-d H:i:s');

  if ($jmlh_data_trx > 0) {
    $query_nomor_tiket  = $mysqli->query("select max(kode_tiket) as maxTiket FROM trx_parking WHERE substring(kode_tiket,1,2) = '$kode_trx'");
    $data_nomor_tiket   = mysqli_fetch_array($query_nomor_tiket);
    $max_trans    = $data_nomor_tiket['maxTiket'];
    $cari_angka   = substr($max_trans,2,3);
    $angka        = intval($cari_angka);
    $noUrutTrans  = $angka + 1;
    $no_trans     = sprintf("%03s", $noUrutTrans);
    $kode_tiket   = $kode_trx.$no_trans;  
  } else {
    $noUrutTrans  = $jmlh_data_trx + 1;
    $no_trans     = sprintf("%03s", $noUrutTrans);
    $kode_tiket   = $kode_trx.$no_trans;
  }

  //FUNGSI UNTUK MERUBAH ANGKA MENJADI FORMAT RUPIAH
  function rupiah($angka){
  
    $hasil_rupiah = "Rp " . number_format($angka,2,',','.');
    return $hasil_rupiah;
   
  }

  function tgl_indo($tanggal){
    $bulan = array (
      1 =>   'Januari',
      'Februari',
      'Maret',
      'April',
      'Mei',
      'Juni',
      'Juli',
      'Agustus',
      'September',
      'Oktober',
      'November',
      'Desember'
    );
    $pecahkan = explode('-', $tanggal);
   
    return $pecahkan[2] . ' ' . $bulan[ (int)$pecahkan[1] ] . ' ' . $pecahkan[0];
  }

  function hari_ini(){
  $hari = date ("D");
 
  switch($hari){
    case 'Sun':
      $hari_ini = "Minggu";
    break;
 
    case 'Mon':     
      $hari_ini = "Senin";
    break;
 
    case 'Tue':
      $hari_ini = "Selasa";
    break;
 
    case 'Wed':
      $hari_ini = "Rabu";
    break;
 
    case 'Thu':
      $hari_ini = "Kamis";
    break;
 
    case 'Fri':
      $hari_ini = "Jumat";
    break;
 
    case 'Sat':
      $hari_ini = "Sabtu";
    break;
    
    default:
      $hari_ini = "Tidak di ketahui";   
    break;
  }
  return "<b>" . $hari_ini . "</b>";
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>My Parking System</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="assets/link/fonts.googleapis.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="assets/plugins/fontawesome-free/css/all.min.css">
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
  <!-- SweetaAlert -->
  <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

  <style type="text/css">
    .dropdown-menu {
      position: absolute; 
      transform: translate3d(-200px, 38px, 0px); 
      top: -100px; left: 0px; 
      will-change: transform;
    }
  </style>
</head>
<body class="hold-transition sidebar-mini layout-fixed">
<?php if(isset($_SESSION['pesan']) && $_SESSION['pesan'] != '') { ?>
  <script>
    swal({
      title: "<?php echo $_SESSION['pesan']; ?>",
      icon: "<?php echo $_SESSION['kode_pesan']; ?>",
    });
  </script>
<?php 
  unset($_SESSION['pesan']);
} ?>
<div class="wrapper">
  <nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
      </li>
    </ul>
  </nav>

  <aside class="main-sidebar main-sidebar-custom sidebar-dark-primary elevation-4">
    <a href="index.php?page=add_tiket" class="brand-link">
      <img src="assets/img/parking-logo.png" alt="Logo My Parking System" class="brand-image img-circle">
      <span class="brand-text font-weight-light"><font size="4"><b>MY PARKING SYSTEM</b></font></span>
    </a>

    <div class="sidebar">
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="assets/img/user-image.png" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
          <a href="index.php?page=add_tiket" class="d-block"><?php echo $_SESSION['nama']; ?></a>
        </div>
      </div>

      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <?php if ($session_level == 0) { ?>
          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon fa-solid fa-database"></i>
              <p>
                Master Data
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">              
              <li class="nav-item">
                <a href="index.php?page=add_user" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>User</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="index.php?page=add_tarif_kendaraan" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Tarif Parkir Kendaraan</p>
                </a>
              </li>
            </ul>
          </li>
          <?php } else {} ?>

          <li class="nav-item">
            <a href="index.php?page=add_tiket" class="nav-link active">
              <i class="nav-icon fa-solid fa-square-plus"></i>
              <p>Form Tiketing</p>
            </a>
          </li>

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
          <div class="col-sm-12">
            <center><font size="7" color="black"><b>APLIKASI MY PARKING SYSTEM</b></font></center>
            <center><font size="6" color="red"><b><?php echo hari_ini(); ?>, <?php echo tgl_indo(date('Y-m-d')); ?> <span id="jam"></span></b></font></center>
          </div>
      </div>
    </section>

    <section class="content">
      <div class="row">
        <div class="col-md-6">
          <div class="card card-primary">
            <div class="card-header">
              <h3 class="card-title"><b>FORM TIKETING MASUK</b></h3>
            </div>
            <form class="form-horizontal" name="form_tiket_masuk" action="index.php?page=create_tiket_masuk" method="post" enctype="multipart/form-data">
              <div class="card-body">
                <div class="form-group row">
                  <label for="kode_tiket" class="col-sm-5 col-form-label">Kode Tiket</label>
                  <div class="col-sm-7">
                    <input class="form-control" type="text" name="kode_tiket" id="kode_tiket" placeholder="Kode Tiket" value="<?php echo $kode_tiket; ?>" readonly>
                  </div>
                </div>
                <div class="form-group row">
                  <label class="col-sm-5 col-form-label">Jenis Kendaraan</label>
                  <div class="col-sm-7">
                    <select class="form-control select2bs4" name="jenis_kendaraan" id="jenis_kendaraan_masuk" required>
                      <option selected = "selected" value="">- Pilih Jenis Kendaraan -</option>
                      <?php
                      include "koneksi.php";

                      $query_jenis_kendaraan  = $mysqli->query("select * FROM ms_tarif_kendaraan order by id_tarif_kendaraan asc");

                      while ($data_jenis_kendaraan = mysqli_fetch_array($query_jenis_kendaraan)){
                        echo '<option name="jenis_kendaraan" value="'.$data_jenis_kendaraan['jenis_kendaraan'].'">'.$data_jenis_kendaraan['jenis_kendaraan'].'</option>';
                      }?>
                    </select>
                  </div>
                </div>
                <div class="form-group row">
                  <label class="col-sm-5 col-form-label">Plat Nomor</label>
                  <div class="col-sm-2">
                    <input class="form-control" type="text" style="text-transform: uppercase; text-align: center;" name="kode_huruf_awal" id="kode_huruf_awal" onkeypress="return hanyaHuruf(event)" maxlength="1" required>
                  </div>
                  <div class="col-sm-3">
                    <input class="form-control" type="text" style="text-align: center;" name="kode_nomor" id="kode_nomor" onkeypress="return hanyaAngka(event)" maxlength="4" required>
                  </div>
                  <div class="col-sm-2">
                    <input class="form-control" type="text" style="text-transform: uppercase; text-align: center;" name="kode_huruf_akhir" id="kode_huruf_akhir" onkeypress="return hanyaHuruf(event)" minlength="1" maxlength="3" required>
                  </div>
                </div>
              </div>
              <div class="card-footer">
                <button type="submit" name="submit_tiket_masuk" class="btn btn-info">Save</button>
                <button type="button" class="btn btn-default float-right" id="reset_tiket_masuk">Cancel</button>
              </div>  
            </form>       
          </div>
          <div class="card card-outline card-danger">
            <div class="card-header">
              <h3 class="card-title"> <font color="red"><b>KETERANGAN :</b></font></h3>
            </div>
            <div class="card-body">
               <font size="3" color="black"><b>- Saat kendaraan sudah keluar parkir data tiket</b></font><font size="3" color="red"><b> TIDAK DAPAT DI EDIT</b></font><br> 
               <font size="3" color="black"><b>- Tombol "Cancel" berfungsi untuk me reset form</b><br></font>
               <font size="3" color="black"><b>- Jam Masuk otomatis akan mengikuti jam di sistem</b><br></font>
               <font size="3" color="black"><b>- Tombol "Update" dan "Delete" (dropdown menu) ada di kolom action</b><br></font>
            </div>
          </div>
        </div>

        <div class="col-md-6">
          <div class="card card-warning">
            <div class="card-header">
              <h3 class="card-title"><b>FORM TIKETING KELUAR</b></h3>
            </div>
            <form class="form-horizontal" name="form_tiket_keluar" action="index.php?page=update_tiket_keluar" method="post" enctype="multipart/form-data">
              <div class="card-body">
                <div class="form-group row">
                  <label class="col-sm-4 col-form-label">Plat Nomor</label>
                  <div class="col-sm-8">
                    <select class="form-control select2bs4" id="plat_nomor_keluar" onchange="autofill(this.value)" required>
                      <option selected="selected" value="">- Pilih Plat Nomor -</option>
                      <?php
                      include "koneksi.php";

                      $query_tiket      = $mysqli->query("select * FROM trx_parking WHERE status = 1");
                      $jmlh_data_tiket  = mysqli_num_rows($query_tiket);

                      while ($data_tiket = mysqli_fetch_array($query_tiket)){
                        echo '<option name="plat_nomor" value="'.$data_tiket['plat_nomor'].'">'.$data_tiket['kode_huruf_awal'].' '.$data_tiket['kode_nomor'].' '.$data_tiket['kode_huruf_akhir'].'</option>';
                      }?>
                    </select>
                  </div>
                </div>

                <div class="form-group row">
                  <label for="kode_tiket_keluar" class="col-sm-4 col-form-label">Kode Tiket</label>
                  <div class="col-sm-8">
                    <input class="form-control" type="text" name="kode_tiket" id="kode_tiket_keluar" placeholder="Kode Tiket" readonly>
                  </div>
                </div>
                
                <div class="form-group row">
                  <label for="jenis" class="col-sm-4 col-form-label">Jenis Kendaraan</label>
                  <div class="col-sm-8">
                    <input class="form-control" type="text" id="jenis_kendaraan_keluar" placeholder="Jenis Kendaraan" readonly>
                  </div>
                </div>
                
                <div class="form-group row">
                  <label for="jam_masuk_kendaraan" class="col-sm-4 col-form-label">Jam Masuk</label>
                  <div class="col-sm-8">
                    <input class="form-control" type="datetime-local" name="jam_masuk" id="jam_masuk_kendaraan" step="1" placeholder="dd/mm/yyyy hh:mm:ss" readonly>
                  </div>
                </div>

                <div class="form-group row">
                  <label for="jam_keluar_kendaraan" class="col-sm-4 col-form-label">Jam Keluar</label>
                  <div class="col-sm-8">
                    <input class="form-control" type="datetime-local" name="jam_keluar" id="jam_keluar_kendaraan" step="1" required>
                  </div>
                </div>

                <div class="form-group row">
                  <label for="durasi" class="col-sm-4 col-form-label">Durasi</label>
                  <div class="col-sm-8">
                    <input class="form-control" type="text" name="durasi" id="durasi" step="1" readonly>
                  </div>
                </div>

                <div class="form-group row">
                  <label for="tarif_parkir" class="col-sm-4 col-form-label">Tarif Parkir</label>
                  <div class="col-sm-8">
                    <input class="form-control" type="number" name="tarif_parkir" id="tarif_parkir" readonly>
                  </div>
                </div>
              </div>
              <div class="card-footer">
                <button type="submit" name="simpan_tiket_keluar" class="btn btn-warning">Save</button>
                <button type="button" id="reset_tiket_keluar" class="btn btn-default float-right">Cancel</button>
              </div>  
            </form>       
          </div>
        </div>
      </div>
    </section>

    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">
            <div class="card">
              <div class="card-body">
                <div class="row">
                  <div class="col-sm-12">
                    <center><font size="5" color="blue"><b>LIST DATA TIKET PARKIR</b></font></center>
                  </div>
                </div>
                <hr>
                <div class="row">
                  <div class="col-12">

                    <a href="index.php?page=export_data" rel="noopener" target="_blank" class="btn btn-default"><i class="fas fa-print"></i> Print</a><br>
                    <font><b>Record Count : <?php echo $jmlh_data_trx ?></b></font>

                    <table id="table_list_tiket" class="table table-bordered table-hover">
                      <thead>
                        <tr>
                          <th style="text-align: center; vertical-align: middle;">Kode Tiket</th>
                          <th style="text-align: center; vertical-align: middle;">Jenis Kendaraan</th>
                          <th style="text-align: center; vertical-align: middle;">Plat Nomor</th>
                          <th style="text-align: center; vertical-align: middle;">Jam Masuk</th>
                          <th style="text-align: center; vertical-align: middle;">Jam Keluar</th>
                          <th style="text-align: center; vertical-align: middle;">Durasi</th>
                          <th style="text-align: center; vertical-align: middle;">Tarif Parkir</th>
                          <th class="no-sort" style="text-align: center; vertical-align: middle;">Action</th>
                        </tr>
                      </thead>

                      <tbody>
                      <?php
                        include ("koneksi.php");

                        $query_list = mysqli_query($mysqli,"select * from trx_parking");


                        if(mysqli_num_rows($query_list) == 0){
                          echo '<tr><td colspan="8" style="text-align: center">Tidak Ada Data.</td></tr>';
                        }else{
                          while($data_list = mysqli_fetch_assoc($query_list)){
                      ?>
                      <tr>
                        <td style="text-align: center; vertical-align: middle;"><?php echo strtoupper($data_list['kode_tiket']) ?></td>
                        <td style="text-align: center; vertical-align: middle;"><?php echo strtoupper($data_list['jenis_kendaraan']) ?></td>
                        <td style="text-align: center; vertical-align: middle;"><?php echo strtoupper($data_list['kode_huruf_awal']." ".$data_list['kode_nomor']." ".$data_list['kode_huruf_akhir']) ?></td>
                        <td style="text-align: center; vertical-align: middle;"><?php if ($data_list['jam_masuk'] == '0000-00-00 00:00:00') {echo "-";} else {echo $data_list['jam_masuk']; } ?></td>
                        <td style="text-align: center; vertical-align: middle;"><?php if ($data_list['jam_keluar'] == '0000-00-00 00:00:00') {echo "-";} else {echo $data_list['jam_keluar']; } ?></td>
                        <td style="text-align: center; vertical-align: middle;"><?php if ($data_list['durasi'] == '') {echo "-";} else {echo $data_list['durasi']; } ?></td>
                        <td style="text-align: center; vertical-align: middle;"><?php if ($data_list['tarif_parkir'] == 0) {echo "-";} else {echo rupiah($data_list['tarif_parkir']); } ?></td>
                        <td style="text-align: center; vertical-align: middle;">
                          <div class="btn-group">
                            <button type="button" class="btn btn-default dropdown-toggle dropdown-icon" data-toggle="dropdown">
                            </button>
                            <div class="dropdown-menu">

                              <button type="button" class="btn dropdown-item" title="Detail Tiket" data-toggle="modal" data-target="#modal-lg-detail-<?php echo $data_list['kode_tiket'] ?>">Detail
                              </button>

                              <?php if ($data_list['status'] == 0) { ?>
                                <a href='index.php?page=delete_tiket&kode_tiket=<?php echo $data_list['kode_tiket'] ?>'><button type="button" class="btn dropdown-item" title="Delete Tiket" onclick="return confirm('Anda Yakin Ingin Hapus Data Tiket Ini ?')">Delete
                                </button></a>
                              <?php } else { ?> 
                                <button type="button" class="btn dropdown-item" title="Update Tiket" data-toggle="modal" data-target="#modal-edit-<?php echo $data_list['kode_tiket'] ?>">Update
                                </button>
                                <a href='index.php?page=delete_tiket&kode_tiket=<?php echo $data_list['kode_tiket'] ?>'><button type="button" class="btn dropdown-item" title="Delete Tiket" onclick="return confirm('Anda Yakin Ingin Hapus Data Tiket Ini ?')">Delete
                                </button></a>
                              <?php } ?>                          
                            </div>
                          </div>
                        </td>
                      </tr>

                      <div class="modal fade" id="modal-lg-detail-<?php echo $data_list['kode_tiket'] ?>">
                        <div class="modal-dialog modal-lg">
                          <div class="modal-content">
                            <div class="modal-header">
                              <h4 class="modal-title">DETAIL TIKET</h4>
                              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                              </button>
                            </div>
                            <div class="modal-body">
                              <div class="card-body">

                                <div class="row">
                                  <div class="col-md-3">
                                   <font size="4"><b>KODE TIKET</b></font> 
                                  </div>
                                  <div class="col-md-9">
                                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:&nbsp;&nbsp;<font size="3"><b><?php echo $data_list['kode_tiket']; ?></b></font> 
                                  </div>
                                </div>
                                <div class="row">
                                  <div class="col-md-3">
                                   <font size="4"><b>STATUS</b></font> 
                                  </div>
                                  <div class="col-md-9">
                                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:&nbsp;&nbsp;<font size="3"><b><?php if ($data_list['status'] != 0) {
                                          echo '<font size="3">Kendaraan Masih Di Dalam Parkiran</font>';
                                        } else {
                                          echo '<font size="3">Kendaraan Sudah Keluar Parkiran</font>';
                                        }?></b></font> 
                                  </div>
                                </div>

                                <ul>
                                  <li>
                                    <div class="row">
                                      <div class="col-md-3">
                                        <font size="3"><b>Plat Nomor</b></font>
                                      </div>
                                      <div class="col-md-9">
                                        :&nbsp;&nbsp;
                                        <?php if ($data_list['plat_nomor'] != '') {
                                          echo '<font size="3">'.$data_list['kode_huruf_awal'].' '.$data_list['kode_nomor'].' '.$data_list['kode_huruf_akhir'].'</font>';
                                        } else {
                                          echo '<font size="3"> - </font>';
                                        }?>
                                      </div>
                                    </div>
                                  </li>

                                  <li>
                                    <div class="row">
                                      <div class="col-md-3">
                                        <font size="4"><b>Jenis Kendaraan</b></font>
                                      </div>
                                      <div class="col-md-9">
                                        :&nbsp;&nbsp;
                                        <?php if ($data_list['jenis_kendaraan'] != '') {
                                          echo '<font size="3">'.$data_list['jenis_kendaraan'].'</font>';
                                        } else {
                                          echo '<font size="3"> - </font>';
                                        }?>
                                      </div>
                                    </div>
                                  </li>

                                  <li>
                                    <div class="row">
                                      <div class="col-md-3">
                                        <font size="4"><b>Jam Masuk</b></font>
                                      </div>
                                      <div class="col-md-9">
                                        :&nbsp;&nbsp;
                                        <?php if ($data_list['jam_masuk'] != '0000-00-00 00:00:00') {
                                          echo '<font size="3">'.$data_list['jam_masuk'].'</font>';
                                        } else {
                                          echo '<font size="3"> - </font>';
                                        }?>
                                      </div>
                                    </div>
                                  </li>

                                  <li>
                                    <div class="row">
                                      <div class="col-md-3">
                                        <font size="4"><b>Jam Keluar</b></font>
                                      </div>
                                      <div class="col-md-9">
                                        :&nbsp;&nbsp;
                                        <?php if ($data_list['jam_keluar'] != '0000-00-00 00:00:00') {
                                          echo '<font size="3">'.$data_list['jam_keluar'].'</font>';
                                        } else {
                                          echo '<font size="3"> - </font>';
                                        }?>
                                      </div>
                                    </div>
                                  </li>

                                   <li>
                                    <div class="row">
                                      <div class="col-md-3">
                                        <font size="4"><b>Durasi</b></font>
                                      </div>
                                      <div class="col-md-9">
                                        :&nbsp;&nbsp;
                                        <?php if ($data_list['durasi'] != '') {
                                          echo '<font size="3">'.$data_list['durasi'].'</font>';
                                        } else {
                                          echo '<font size="3"> - </font>';
                                        }?>
                                      </div>
                                    </div>
                                  </li>

                                  <li>
                                    <div class="row">
                                      <div class="col-md-3">
                                        <font size="4"><b>Tarif Parkir</b></font>
                                      </div>
                                      <div class="col-md-9">
                                        :&nbsp;&nbsp;
                                        <?php if ($data_list['tarif_parkir'] != 0) {
                                          echo '<font size="3">'.rupiah($data_list['tarif_parkir']).'</font>';
                                        } else {
                                          echo '<font size="3"> - </font>';
                                        }?>
                                      </div>
                                    </div>
                                  </li>

                                </ul>

                                <div class="row">
                                  <div class="col-md-12">
                                   <font size="4"><b>LOG HISTORY</b></font> 
                                  </div>
                                </div>

                                <ul>
                                  <li>
                                    <div class="row">
                                      <div class="col-md-3">
                                        <font size="3"><b>Created Date</b></font>
                                      </div>
                                      <div class="col-md-9">
                                        :&nbsp;&nbsp;<font size="3"><?php if ($data_list['created_dt'] == '0000-00-00 00:00:00') {echo "-";} else {echo $data_list['created_dt']." - ( ".$data_list['created_by']." ) "; } ?></font> 
                                      </div>
                                    </div>
                                  </li>

                                  <li>
                                    <div class="row">
                                      <div class="col-md-3">
                                        <font size="4"><b>Update Date</b></font>
                                      </div>
                                      <div class="col-md-9">
                                        :&nbsp;&nbsp;<font size="3"><?php if ($data_list['update_dt'] == '0000-00-00 00:00:00') {echo "-";} else {echo $data_list['update_dt']." - ( ".$data_list['update_by']." ) "; } ?></font> 
                                      </div>
                                    </div>
                                  </li>
                                </ul>                            
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>

                      <div class="modal fade" id="modal-edit-<?php echo $data_list['kode_tiket'] ?>">
                        <div class="modal-dialog modal-md">
                          <div class="modal-content">
                            <div class="modal-header">
                             <h4 class="modal-title">EDIT TIKET</h4>
                            </div>
                            <div class="modal-body">
                              <form class="form-horizontal" name="form_edit_tiket" action="index.php?page=edit_tiket" method="post" enctype="multipart/form-data">
                                <div class="card-body">
                                  <div class="form-group row">
                                    <label for="kode_tiket" class="col-sm-4 col-form-label">Kode Tiket</label>
                                    <div class="col-sm-8">
                                      <input class="form-control" type="text" name="kode_tiket" id="kode_tiket" placeholder="Kode Tiket" value="<?php echo $data_list['kode_tiket'] ?>" readonly>
                                    </div>
                                  </div>

                                  <div class="form-group row">
                                    <label class="col-sm-4 col-form-label">Plat Nomor</label>
                                    <div class="col-sm-2">
                                      <input class="form-control" type="text" name="kode_huruf_awal" id="kode_huruf_awal" maxlength="1" value="<?php echo $data_list['kode_huruf_awal'] ?>" required>
                                    </div>
                                    <div class="col-sm-4">
                                      <input class="form-control" type="text" name="kode_nomor" id="kode_nomor" onkeypress="return hanyaAngka(event)" maxlength="4" value="<?php echo $data_list['kode_nomor'] ?>" required>
                                    </div>
                                    <div class="col-sm-2">
                                      <input class="form-control" type="text" name="kode_huruf_akhir" id="kode_huruf_akhir" onkeypress="return hanyaHuruf(event)" minlength="1" maxlength="3" value="<?php echo $data_list['kode_huruf_akhir'] ?>" required>
                                    </div>
                                  </div>                                  
                                  <div class="form-group row">
                                    <label for="jenis_kendaraan" class="col-sm-4 col-form-label">Jenis Kendaraan</label>
                                    <div class="col-sm-8">
                                      <select class="form-control select2bs4" style="width:100%; height: 100%;"  name="jenis_kendaraan" required>
                                        <?php if ($data_list['jenis_kendaraan'] == 'Motor') { ?>
                                          <option selected = "selected" value="Motor">- Motor -</option>
                                          <option value="Mobil">Mobil</option>
                                        <?php } else { ?>
                                          <option selected = "selected" value="Mobil">- Mobil -</option>
                                          <option value="Motor">Motor</option>
                                        <?php } ?>
                                      </select>
                                    </div>
                                  </div>
                                  
                                  <div class="form-group row">
                                    <label for="kode_tiket" class="col-sm-4 col-form-label">Jam Masuk</label>
                                    <div class="col-sm-8">
                                      <input class="form-control" type="text" name="jam_masuk" id="jam_masuk" value="<?php echo $data_list['jam_masuk']; ?>" readonly>
                                    </div>
                                  </div>

                                </div>
                                <div class="card-footer">
                                  <button type="submit" name="simpan_update_tiket" class="btn btn-primary">Save</button>
                                </div>  
                              </form>  
                            </div>
                          </div>
                        </div>
                      </div>

                      <?php    
                        }
                      }
                      ?>
                      </tbody>
                    </table>
                  </div><!-- COL 12 TABLE -->
                </div><!-- ROW TABLE -->

              </div><!-- CARD BODY -->
            </div><!-- CARD -->
          </div><!-- COL CARD BODY -->
        </div><!-- ROW CARD BODY -->
      </div><!-- CONTAIN FLUID -->
    </section>

  </div>

<footer class="main-footer">
    <div class="float-right d-none d-sm-block">
      <b>Version</b> 1.0
    </div>
    <strong>Copyright &copy; <?php echo date('Y'); ?> Christian Natanael Olesa, S.Kom, S.Si.</strong> All rights reserved.
  </footer>
</div>

<!-- jQuery -->
<script src="assets/link/jquery.min-1.12.4.js"></script>
<script src="assets/link/cloudflare.js"></script>
<!-- DataTables  & Plugins -->
<script src="assets/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="assets/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="assets/plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
<script src="assets/plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
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

<script type="text/javascript">
  window.onload = function() { jam(); }
 
  function jam() {
      var e = document.getElementById('jam'),
      d = new Date(), h, m, s;
      h = d.getHours();
      m = set(d.getMinutes());
      s = set(d.getSeconds());
 
      e.innerHTML = h +':'+ m +':'+ s;
 
      setTimeout('jam()', 1000);
  }
 
  function set(e) {
      e = e < 10 ? '0'+ e : e;
      return e;
  }
</script>

<script>
  function hanyaAngka(evt) {
    var charCode = (evt.which) ? evt.which : event.keyCode
     if (charCode > 30 && (charCode < 48 || charCode > 57))

      return false;
    return true;
  }
</script>

<script>
  function hanyaHuruf(evt) {
    var charCode = (evt.which) ? evt.which : event.keyCode
     if ((charCode > 64 && charCode < 91) || (charCode > 96 && charCode < 123))

      return true;
    return false;
  }
</script>

<script>
  $(function () {
    $('#table_list_tiket').DataTable({
      "paging": true,
      "lengthChange": false,
      "searching": true,
      columnDefs: [{
          searchable: false,
          targets: [2,3,7]
        }],
      "order": [[0, "desc"]],
        columnDefs: [{
          orderable: false,
          targets: "no-sort"
        }],
      "info": true,
      "autoWidth": false,
      "responsive": true,
    });
  });
</script>

<script>
  $(function () {
    $('.select2').select2()

    $('.select2bs4').select2({
      theme: 'bootstrap4'
    })
});

</script>

<script type="text/javascript">
function autofill(){
  var plat_nomor = $("#plat_nomor_keluar").val();
  $.ajax({
    url : 'autofill.php', // file proses penginputan
    data : "plat_nomor="+plat_nomor,
  }).success(function (data){
      var json = data,
      obj = JSON.parse(json);
    $('#kode_tiket_keluar').val(obj.kode_tiket);
    $('#jenis_kendaraan_keluar').val(obj.jenis_kendaraan);
    $('#jam_masuk_kendaraan').val(obj.jam_masuk);
    $('#tarif_parkir').val(obj.tarif_parkir);
  })
}
</script>

<script type="text/javascript">


  $("#jam_keluar_kendaraan").on("change",function(){
    var jenis_kendaraan   = $('#jenis_kendaraan_keluar').val();
    var jam_keluar        = new Date($(this).val());
    var jam_masuk         = new Date($('#jam_masuk_kendaraan').val());

    var mdiff = (jam_keluar - jam_masuk);
    let seconds  = Math.floor(mdiff / 1000);
    let minutes  = Math.floor(seconds / 60);
    let hours    = Math.floor(minutes / 60);

    detik = seconds % 60;
    menit = minutes % 60;
    jam   = hours % 24;

    var durasi = hours + ":" + menit + ":" + detik;

    document.getElementById('durasi').value = durasi;

    if (jenis_kendaraan == 'Motor' && hours == 0) {
        var tarif_parkir = 2000;
    } else if (jenis_kendaraan == 'Motor' && hours != 0) {
        var tarif_parkir = hours * 2000;
    } else if (jenis_kendaraan == 'Mobil' && hours == 0) {
        var tarif_parkir = 3000;
    } else {
      var tarif_parkir = hours * 3000;
    }
    
    document.getElementById('tarif_parkir').value = tarif_parkir;
  });
</script>

<script>
$(document).ready(function(){
    $("#jam_keluar_kendaraan").attr('disabled', 'disabled');

    $('#plat_nomor_keluar').on('change', function(){
      var platNo = $(this).val(); 
      if (platNo == ''){
        document.getElementById('kode_tiket_keluar').value= "";
        document.getElementById('jenis_kendaraan_keluar').value = "";
        document.getElementById('jam_masuk_kendaraan').value = "";
        document.getElementById('jam_keluar_kendaraan').value = "";
        document.getElementById('durasi').value = "";
        document.getElementById('tarif_parkir').value = "";
        $("#jam_keluar_kendaraan").attr("disabled","disabled");
      } else if (platNo != '') {
        document.getElementById('jam_keluar_kendaraan').value = "";
        document.getElementById('durasi').value = "";
        document.getElementById('tarif_parkir').value = "";
        $("#jam_keluar_kendaraan").removeAttr('disabled');
      }
    });    
});
</script>

<script type="text/javascript">
  $(document).ready(function(){
    $('#reset_tiket_masuk').on('click', function(){
      $("#jenis_kendaraan_masuk").select().val([""]).trigger("change");
      document.getElementById('kode_huruf_awal').value = "";
      document.getElementById('kode_nomor').value = "";
      document.getElementById('kode_huruf_akhir').value = "";
    });
    $('#reset_tiket_keluar').on('click', function(){
        $("#plat_nomor_keluar").select().val([""]).trigger("change");
        document.getElementById('kode_tiket_keluar').value= "";
        document.getElementById('jenis_kendaraan_keluar').value = "";
        document.getElementById('jam_masuk_kendaraan').value = "";
        document.getElementById('jam_keluar_kendaraan').value = "";
        document.getElementById('durasi').value = "";
        document.getElementById('tarif_parkir').value = "";
        $("#jam_keluar_kendaraan").attr("disabled","disabled");
    });

  });
</script>

</body>
</html>
