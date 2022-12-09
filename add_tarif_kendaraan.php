<?php 
  session_start();
 
  // cek apakah yang mengakses halaman ini sudah login
  if($_SESSION['username']==""){
    echo "<div class='alert'>Username dan Password tidak sesuai !</div>";
  }

  $session_username   = $_SESSION['username'];
  $session_nama       = $_SESSION['nama'];
  $session_level      = $_SESSION['level'];

  function rupiah($angka){
  
    $hasil_rupiah = "Rp " . number_format($angka,2,',','.');
    return $hasil_rupiah;
   
  }
?>

<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Parking System</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="assets/link/fonts.googleapis.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="assets/plugins/fontawesome-free/css/all.min.css">
  <!-- DataTables -->
  <link rel="stylesheet" href="assets/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
  <link rel="stylesheet" href="assets/plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
  <link rel="stylesheet" href="assets/plugins/datatables-buttons/css/buttons.bootstrap4.min.css">
   <!-- Select2 -->
  <link rel="stylesheet" href="assets/plugins/select2/css/select2.min.css">
  <link rel="stylesheet" href="assets/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="assets/dist/css/adminlte.min.css">
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

  <script src="assets/link/kit.fontawesome.js"></script>
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
          <li class="nav-item menu-open">
            <a href="#" class="nav-link active">
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
                <a href="index.php?page=add_tarif_kendaraan" class="nav-link active">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Tarif Parkir Kendaraan</p>
                </a>
              </li>
            </ul>
          </li>
          <?php } else {} ?>

          <li class="nav-item">
            <a href="index.php?page=add_tiket" class="nav-link">
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
          </div>
      </div>
    </section>

    <section class="content">
    	<div class="container-fluid">

        <div class="row">
        	<div class="col-md-6">
            <div class="card card-primary">
            	<div class="card-header">
              	<h3 class="card-title"><b>Form Tambah Tarif Kendaraan & Jenis Kendaraan</b></h3>
            	</div>

            	<form class="form-horizontal" name="form_add_tarif_kendaraan" action="index.php?page=create_tarif_kendaraan" method="post" enctype="multipart/form-data">
                <div class="card-body">
                  <div class="row">
                    <div class="col-md-6">
                      <div class="form-group">
                        <label>Jenis Kendaraan</label>
                        <input type="text" class="form-control" style="text-transform:capitalize;" name="jenis_kendaraan" placeholder="Jenis Kendaraan" required>
                      </div>
                    </div>

                    <div class="col-md-6">
                      <div class="form-group">
                        <label>Tarif Parkir Per Jam</label>
                        <input type="number" class="form-control" min="1000" name="tarif_kendaraan" placeholder="Tarif Parkir Per Jam" required>
                      </div>
                    </div>
                    
                  </div>
                </div>

                <div class="card-footer">
                  <button type="submit" name="submit_tarif_kendaraan" class="btn btn-primary">Submit</button>
                </div>
              </form>
            </div>
        	</div>

          <div class="col-md-6">
            <div class="card">
              <div class="card-body">
                <table id="tbl_tarif_kendaraan" class="table table-bordered table-striped">

                <thead>
                  <tr>
                    <th style="text-align: center;">No. </th>
                    <th style="text-align: center;">Jenis Kendaraan</th>
                    <th style="text-align: center;">Tarif Kendaraan</th>
                    <th style="text-align: center;">Action</th>
                  </tr>
                </thead>

                <tbody>
                <?php
                  include ("koneksi.php");

                  $sql=mysqli_query($mysqli,"select * FROM ms_tarif_kendaraan order by id_tarif_kendaraan asc");

                  if(mysqli_num_rows($sql) == 0){
                    echo '<tr><td colspan="4" style="text-align: center">Tidak Ada Data.</td></tr>';
                  }else{
                    $no = 1;
                    while($row = mysqli_fetch_assoc($sql)){
                ?>

                <tr>
                  <td style="text-align: center;"><?php echo $no; ?></td>
                  <td style="text-align: center;"><?php echo $row['jenis_kendaraan'] ?></td>
                  <td style="text-align: center;"><?php echo rupiah($row['tarif_kendaraan']) ?></td>
                  <td style="text-align:center;">

                    <div class="btn-group">
                        <button type="button" class="btn btn-default dropdown-toggle dropdown-icon" data-toggle="dropdown">
                        </button>
                        <div class="dropdown-menu">

                          <button type="button" class="btn dropdown-item" data-toggle="modal" data-target="#modal-lg-edit-<?php echo $row['id_tarif_kendaraan'] ?>">
                          Edit
                          </button>

                          <a href="index.php?page=delete_tarif_kendaraan&id_tarif_kendaraan=<?php echo $row['id_tarif_kendaraan'] ?>" title="Hapus Tarif Kendaraan" onclick="return confirm('Anda Yakin Ingin Delete Data Ini ?')">
                            <button type="button" class="btn dropdown-item">Delete</button>
                          </a>   
                        </div>
                      </div>

                  </td>
                </tr>

                <div class="modal fade" id="modal-lg-edit-<?php echo $row['id_tarif_kendaraan'] ?>">
                  <div class="modal-dialog modal-md">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h4 class="modal-title">Edit Tarif Parkir Kendaraan</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                        </button>
                      </div>
                      <div class="modal-body">
                        <form class="form-horizontal" name="form_edit_tarif_kendaraan" action="index.php?page=edit_tarif_kendaraan" method="post" enctype="multipart/form-data">
                          <div class="card-body">
                            <div class="row" hidden>
                              <div class="col-md-4">
                                <div class="form-group">
                                  <label>ID TARIF PARKIR KENDARAAN</label>
                                  <input type="text" class="form-control" name="id_tarif_kendaraan" placeholder="ID TARIF PARKIR KENDARAAN" value="<?php echo $row['id_tarif_kendaraan'] ?>" readonly>
                                </div>
                              </div>
                            </div>

                            <div class="row">
                              <div class="col-md-6">
                                <div class="form-group">
                                  <label>Jenis Kendaraan</label>
                                  <input type="text" class="form-control" name="jenis_kendaraan" placeholder="Jenis Kendaraan" value="<?php echo $row['jenis_kendaraan'] ?>" required>
                                </div>
                              </div>

                              <div class="col-md-6">
                                <div class="form-group">
                                  <label>Tarif Parkir Per Jam</label>
                                  <input type="number" class="form-control" name="tarif_kendaraan" min="1000" value="<?php echo $row['tarif_kendaraan'] ?>" placeholder="Tarif Parkir Per Jam" required>
                                </div>
                              </div>
                            </div>
                          </div>

                          <div class="card-footer">
                            <button type="submit" name="simpan_tarif_kendaraan" class="btn btn-primary">Update</button>
                          </div>
                        </form>
                      </div>
                    </div>
                  </div>
                </div>

                
                <?php
                  $no++;
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
    </section>
  </div>

  <footer class="main-footer">
    <div class="float-right d-none d-sm-block">
      <b>Version</b> 1.0
    </div>
    <strong>Copyright &copy; <?php echo date('Y'); ?> Christian Natanael Olesa, S.Kom, S.Si.</strong> All rights reserved.
  </footer>

  <aside class="control-sidebar control-sidebar-dark">
  </aside>
</div>

<!-- jQuery -->
<script src="assets/plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="assets/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- DataTables  & Plugins -->
<script src="assets/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="assets/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="assets/plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
<script src="assets/plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
<script src="assets/plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
<script src="assets/plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
<!-- Tempusdominus Bootstrap 4 -->
<script src="assets/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>
<!-- AdminLTE App -->
<script src="assets/dist/js/adminlte.min.js"></script>

<!-- Select2 -->
<script src="assets/plugins/select2/js/select2.full.min.js"></script>

<script>
  function hanyaAngka(evt) {
    var charCode = (evt.which) ? evt.which : event.keyCode
     if (charCode > 30 && (charCode < 48 || charCode > 57))

      return false;
    return true;
  }
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

<script>
  $(function () {
    $('#tbl_tarif_kendaraan').DataTable({
      "paging": true,
      "lengthChange": false,
      "searching": true,
      "ordering": false,
      "info": true,
      "autoWidth": false,
      "responsive": true,
    });
  });
</script>

</body>
</html>
