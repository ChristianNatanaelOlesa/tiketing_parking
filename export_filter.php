<?php 
    include("koneksi.php");

    $query_tiketing = $mysqli->query("select * FROM trx_parking");
    $data_tiketing	= mysqli_fetch_array($query_tiketing);

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
  <title>My Parking System</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="assets/link/fonts.googleapis.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="assets/plugins/fontawesome-free/css/all.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="assets/dist/css/adminlte.min.css">
</head>

<style>
    @media print {

   table.tabel_print {
    border: 2px solid black;
   }

   tr.tabel_print {
    border:solid black !important;
    border-width:2px 2px 2px 2px !important;
   }

   th.tabel_print {
    border:solid black !important;
    border-width:2px 2px 2px 2px !important;
   }

   td.tabel_print {
    border:solid black !important;
    border-width:2px 2px 2px 2px !important;
   }
   
} 
    </style>
<body>
<div class="wrapper">
  <!-- Main content -->
  <section class="invoice">
  	<div class="row">
      <div class="col-sm-12">
      	<center><font size="5" color="red"><b>MY PARKING SYSTEM</b></font></center>
      </div>
    </div>
    <br>
    <div class="row">
      <div class="col-sm-12">
        <table class="table table-bordered tabel_print" >
          <thead>
            <tr class="tabel_print">
              <th class="tabel_print" style="text-align: center; vertical-align: middle;">Kode Tiket</th>
              <th class="tabel_print" style="text-align: center; vertical-align: middle;">Jenis Kendaraan</th>
              <th class="tabel_print" style="text-align: center; vertical-align: middle;">Plat Nomor</th>
              <th class="tabel_print" style="text-align: center; vertical-align: middle;">Jam Masuk</th>
              <th class="tabel_print" style="text-align: center; vertical-align: middle;">Jam Keluar</th>
              <th class="tabel_print" style="text-align: center; vertical-align: middle;">Durasi</th>
              <th class="tabel_print" style="text-align: center; vertical-align: middle;">Tarif Parkir</th>
            </tr>
          </thead>

          <tbody>
	          <?php
              $tgl_pembuatan_from = $_POST['tgl_pembuatan_from'];
              $tgl_pembuatan_to   = $_POST['tgl_pembuatan_to'];

              $tgl_masuk_from     = $_POST['tgl_masuk_from'];
              $tgl_masuk_to       = $_POST['tgl_masuk_to'];

              $tgl_keluar_from    = $_POST['tgl_keluar_from'];
              $tgl_keluar_to      = $_POST['tgl_keluar_to'];

              $jenis_kendaraan    = $_POST['jenis_kendaraan'];

              $plat_nomor         = $_POST['plat_nomor'];

              $min_date = $mysqli->query("select date(min(created_dt)) as minTanggal from trx_parking");
              $date_min = mysqli_fetch_array($min_date);
              $minTanggal = $date_min['minTanggal'];
              $tanggal_sekarang = date('Y-m-d');

              $search_1 = " ";
              if ($tgl_pembuatan_from  != '' AND $tgl_pembuatan_to != '') {
                $search_1 .= " date(created_dt) between '".$tgl_pembuatan_from."' and '".$tgl_pembuatan_to."'";
              } else if ($tgl_pembuatan_from  == '' AND $tgl_pembuatan_to == '') {
                $search_1 .= " date(created_dt) between '".$minTanggal."' and '".$tanggal_sekarang."'";
              } else if ($tgl_pembuatan_from  != '' AND $tgl_pembuatan_to == '') {
                $search_1 .= " date(created_dt) between '".$tgl_pembuatan_from."' and '".$tanggal_sekarang."'";
              } else if ($tgl_pembuatan_from  == '' AND $tgl_pembuatan_to != '') {
                $search_1 .= " date(created_dt) between '".$minTanggal."' and '".$tgl_pembuatan_to."'";
              } 

              $search_2 = " ";
              if ($tgl_masuk_from  != '' AND $tgl_masuk_to != '') {
                $search_2 .= " and date(jam_masuk) between '".$tgl_masuk_from."' and '".$tgl_masuk_to."'";
              } else if ($tgl_masuk_from  == '' AND $tgl_masuk_to == '') {
                $search_2 .= " and date(jam_masuk) between '".$minTanggal."' and '".$tanggal_sekarang."'";
              } else if ($tgl_masuk_from  != '' AND $tgl_masuk_to == '') {
                $search_2 .= " and date(jam_masuk) between '".$tgl_masuk_from."' and '".$tanggal_sekarang."'";
              } else if ($tgl_masuk_from  == '' AND $tgl_masuk_to != '') {
                $search_2 .= " and date(jam_masuk) between '".$minTanggal."' and '".$tgl_masuk_to."'";
              } 

              $search_3 = " ";
              if ($tgl_keluar_from  != '' AND $tgl_keluar_to != '') {
                $search_3 .= " and date(jam_keluar) between '".$tgl_keluar_from."' and '".$tgl_keluar_to."'";
              } else if ($tgl_keluar_from  == '' AND $tgl_keluar_to == '') {
                $search_3 .= " and date(jam_keluar) between '".$minTanggal."' and '".$tanggal_sekarang."'";
              } else if ($tgl_keluar_from  != '' AND $tgl_keluar_to == '') {
                $search_3 .= " and date(jam_keluar) between '".$tgl_keluar_from."' and '".$tanggal_sekarang."'";
              } else if ($tgl_keluar_from  == '' AND $tgl_keluar_to != '') {
                $search_3 .= " and date(jam_keluar) between '".$minTanggal."' and '".$tgl_keluar_to."'";
              } 

              $search_4 = " ";
              if ($jenis_kendaraan != '') {
                $search_4 .= " and (jenis_kendaraan = '".$jenis_kendaraan."') ";
              }  

              $search_5 = " ";
              if ($plat_nomor != '') {
                $search_5 .= " and (plat_nomor = '".$plat_nomor."') ";
              }

              $search_6 = " ";
              if ($kode_tiket_from != '' AND $kode_tiket_to != '') {
                $search_6 .= " and (kode_tiket between '".$kode_tiket_from."' and '".$kode_tiket_to."' ) ";
              } 

              $query_export = mysqli_query($mysqli,"select * from trx_parking where ".$search_1." ".$search_2." ".$search_3." ".$search_4." ".$search_5." ".$search_6);
              while($data_list = mysqli_fetch_array($query_export)){ 
	          ?>
	          <tr class="tabel_print">
	            <td class="tabel_print" style="text-align: center; vertical-align: middle;"><?php echo strtoupper($data_list['kode_tiket']) ?></td>
	            <td class="tabel_print" style="text-align: center; vertical-align: middle;"><?php echo strtoupper($data_list['jenis_kendaraan']) ?></td>
	            <td class="tabel_print" style="text-align: center; vertical-align: middle;"><?php echo strtoupper($data_list['kode_huruf_awal']." ".$data_list['kode_nomor']." ".$data_list['kode_huruf_akhir']) ?></td>
	            <td class="tabel_print" style="text-align: center; vertical-align: middle;"><?php if ($data_list['jam_masuk'] == '0000-00-00 00:00:00') {echo "-";} else {echo $data_list['jam_masuk']; } ?></td>
	            <td class="tabel_print" style="text-align: center; vertical-align: middle;"><?php if ($data_list['jam_keluar'] == '0000-00-00 00:00:00') {echo "-";} else {echo $data_list['jam_keluar']; } ?></td>
	            <td class="tabel_print" style="text-align: center; vertical-align: middle;"><?php if ($data_list['durasi'] == '') {echo "-";} else {echo $data_list['durasi']; } ?></td>
	            <td class="tabel_print" style="text-align: center; vertical-align: middle;"><?php if ($data_list['tarif_parkir'] == 0) {echo "-";} else {echo rupiah($data_list['tarif_parkir']); } ?></td>
	          </tr>
	          <?php   
            }
          ?>
	        </tbody>
        </table>
      </div>
    </div>
    <br>


    <!-- /.row -->
  </section>
  <!-- /.content -->
</div>
<!-- ./wrapper -->
<!-- Page specific script -->
<script>
  window.addEventListener("load", window.print());
</script>
</body>
</html>
