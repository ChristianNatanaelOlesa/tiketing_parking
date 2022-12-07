<?php
include 'koneksi.php';

date_default_timezone_set('Asia/Jakarta');

$plat_nomor = $_GET['plat_nomor'];

$query_tiketing = $mysqli->query("SELECT * from trx_parking where plat_nomor = '$plat_nomor' and status = 1");
$data_tiketing  = mysqli_fetch_array($query_tiketing);


$data = array(
        'kode_tiket' => $data_tiketing['kode_tiket'],
        'jenis_kendaraan' => $data_tiketing['jenis_kendaraan'],
        'jam_masuk' => $data_tiketing['jam_masuk']
    );
echo json_encode($data);
?>