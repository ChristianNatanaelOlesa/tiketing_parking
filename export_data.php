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
	            include ("koneksi.php");

	            $query_list = mysqli_query($mysqli,"select * from trx_parking order by kode_tiket desc");


	            if(mysqli_num_rows($query_list) == 0){
	              echo '<tr><td colspan="8" style="text-align: center">Tidak Ada Data.</td></tr>';
	            }else{
	              while($data_list = mysqli_fetch_assoc($query_list)){
	          ?>
	          <tr class="tabel_print">
	            <td class="tabel_print" style="text-align: center; vertical-align: middle;"><?php echo strtoupper($data_list['kode_tiket']) ?></td>
	            <td class="tabel_print" style="text-align: center; vertical-align: middle;"><?php echo strtoupper($data_list['jenis_kendaraan']) ?></td>
	            <td class="tabel_print" style="text-align: center; vertical-align: middle;"><?php echo strtoupper($data_list['kode_huruf_awal']." ".$data_list['kode_nomor']." ".$data_list['kode_huruf_akhir']) ?></td>
	            <td class="tabel_print" style="text-align: center; vertical-align: middle;"><?php if ($data_list['jam_masuk'] == '0000-00-00 00:00:00') {echo "-";} else {echo $data_list['jam_masuk']; } ?></td>
	            <td class="tabel_print" style="text-align: center; vertical-align: middle;"><?php if ($data_list['jam_keluar'] == '0000-00-00 00:00:00') {echo "-";} else {echo $data_list['jam_keluar']; } ?></td>
	            <td class="tabel_print" style="text-align: center; vertical-align: middle;"><?php if ($data_list['durasi'] == '00:00:00') {echo "-";} else {echo $data_list['durasi']; } ?></td>
	            <td class="tabel_print" style="text-align: center; vertical-align: middle;"><?php if ($data_list['tarif_parkir'] == 0) {echo "-";} else {echo rupiah($data_list['tarif_parkir']); } ?></td>
	          </tr>
	          <?php   
            }
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
