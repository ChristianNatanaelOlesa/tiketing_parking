<?php 

   include ("koneksi.php");

   if( isset($_GET['kode_tiket']) ){

    // ambil id dari query string
    $kode_tiket = $_GET['kode_tiket'];

    // buat query hapus
    $sql = "DELETE FROM trx_parking WHERE kode_tiket ='$kode_tiket'";
    $query = mysqli_query($mysqli, $sql);

    // apakah query hapus berhasil?
    if( $query ){
        
        $_SESSION['pesan'] = "Data Berhasil Di Hapus";
        $_SESSION['kode_pesan'] = "success";
        header("location:index.php?page=add_tiket");

    } else {
        $_SESSION['pesan'] = "Gagal Menghapus Data";
        $_SESSION['kode_pesan'] = "warning";
        header("location:index.php?page=add_tiket");
    }

} else if( isset($_GET['id_tarif_kendaraan']) ){

    // ambil id dari query string
    $id_tarif_kendaraan = $_GET['id_tarif_kendaraan'];

    // buat query hapus
    $sql = "DELETE FROM ms_tarif_kendaraan WHERE id_tarif_kendaraan ='$id_tarif_kendaraan'";
    $query = mysqli_query($mysqli, $sql);

    // apakah query hapus berhasil?
    if( $query ){
        
        $_SESSION['pesan'] = "Data Berhasil Di Hapus";
        $_SESSION['kode_pesan'] = "success";
        header("location:index.php?page=add_tarif_kendaraan");

    } else {
        $_SESSION['pesan'] = "Gagal Menghapus Data";
        $_SESSION['kode_pesan'] = "warning";
        header("location:index.php?page=add_tarif_kendaraan");
    }

} else {
    $_SESSION['pesan'] = "Akses Dilarang";
    $_SESSION['kode_pesan'] = "warning";
    header("location:index.php?page=add_tiket");
}

?>