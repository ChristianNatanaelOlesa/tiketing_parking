<?php
include 'koneksi.php';

date_default_timezone_set('Asia/Jakarta');

$plat_nomor = $_GET['plat_nomor'];

$jam_keluar = date('Y-m-d H:i:s');

$query_durasi   = $mysqli->query("SELECT TIMEDIFF('$jam_keluar', jam_masuk) as durasi, TIMESTAMPDIFF(HOUR, jam_masuk, '$jam_keluar') as jam from trx_parking where plat_nomor = '$plat_nomor' and status = 1");
$data_durasi    = mysqli_fetch_array($query_durasi);
$durasi         = $data_durasi['jam'];

$query_tiketing = $mysqli->query("SELECT * from trx_parking where plat_nomor = '$plat_nomor' and status = 1");
$data_tiketing  = mysqli_fetch_array($query_tiketing);

if ($data_tiketing['jenis_kendaraan'] == 'Motor') {
        $tarif_parkir   = $durasi * 2000;
} else {
        $tarif_parkir   = $durasi * 3000;
}

$data = array(
        'kode_tiket' => $data_tiketing['kode_tiket'],
        'jenis_kendaraan' => $data_tiketing['jenis_kendaraan'],
        'jam_masuk' => $data_tiketing['jam_masuk'],
        'jam_keluar' => $jam_keluar,
        'durasi' => $data_durasi['durasi'],
        'tarif_parkir' => $tarif_parkir
    );
echo json_encode($data);
?>