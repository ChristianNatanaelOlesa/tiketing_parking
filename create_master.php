<?php 
include ("koneksi.php");

session_start();

date_default_timezone_set('Asia/Jakarta');

if(isset($_POST['submit_user'])){
	
	$username			= $_POST['username'];
	$password 			= md5($_POST['password']);
	$password2 			= $_POST['password'];

	$nama				= ucfirst($_POST['nama']);
	$level				= $_POST['level'];
	$status				= 1;
    $created_dt			= date('Y-m-d H:i:s');

	$query_user 	= $mysqli->query("SELECT * FROM login WHERE username = '$username'");
	$data_user 		= mysqli_fetch_array($query_user);
	$jmlh_data_user	= mysqli_num_rows($query_user);

	if ($jmlh_data_user > 0){
		$_SESSION['pesan'] = "Username sudah ada";
		$_SESSION['kode_pesan'] = "warning";
		header("location:index.php?page=add_user");
	} else {
		$sql = "INSERT INTO login (username, password, password2, nama, level, status) VALUES ('$username', '$password', '$password2', '$nama', '$level', '$status')";
		$query = mysqli_query($mysqli, $sql);
	}

    if( $query ) {
        $_SESSION['pesan'] = "User Berhasil Di Tambahkan";
		$_SESSION['kode_pesan'] = "success";
		header("location:index.php?page=add_user");
    } else {
        $_SESSION['pesan'] = "Gagal Menambahkan User";
		$_SESSION['kode_pesan'] = "warning";
		header("location:index.php?page=add_user");
    } 


} else if(isset($_POST['submit_tarif_kendaraan'])){

    $jenis_kendaraan	= ucfirst($_POST['jenis_kendaraan']);
    $tarif_kendaraan	= $_POST['tarif_kendaraan'];
    
    $query_tarif_kendaraan		= $mysqli->query("SELECT * FROM ms_tarif_kendaraan WHERE jenis_kendaraan = '$jenis_kendaraan' ");
    $data_tarif_kendaraan		= mysqli_fetch_array($query_tarif_kendaraan);
    $jmlh_data_tarif_kendaraan	= mysqli_num_rows($query_tarif_kendaraan);

    if ($jmlh_data_tarif_kendaraan > 0){
    	$_SESSION['pesan'] = "Tarif Parkir Untuk Jenis Kendaraan ".$jenis_kendaraan." Sudah Ada";
		$_SESSION['kode_pesan'] = "warning";
		header("location:index.php?page=add_tarif_kendaraan");
    } else {
        $sql = "INSERT INTO ms_tarif_kendaraan (jenis_kendaraan, tarif_kendaraan) VALUES ('$jenis_kendaraan', '$tarif_kendaraan')";
        $query = mysqli_query($mysqli, $sql);

        if( $query ) {
	        $_SESSION['pesan'] = "Tarif Parkir Berhasil Di Tambahkan";
			$_SESSION['kode_pesan'] = "success";
			header("location:index.php?page=add_tarif_kendaraan");
	    } else {
	        $_SESSION['pesan'] = "Gagal Menambahkan Tarif Parkir";
			$_SESSION['kode_pesan'] = "warning";
			header("location:index.php?page=add_tarif_kendaraan");
	    }  
    }

} else if(isset($_POST['submit_tiket_masuk'])){
		
	$kode_tiket = $_POST['kode_tiket'];
    $jenis_kendaraan	= ucfirst($_POST['jenis_kendaraan']);

    $kode_huruf_awal 	= strtoupper($_POST['kode_huruf_awal']);
    $kode_nomor			= $_POST['kode_nomor'];
    $kode_huruf_akhir 	= strtoupper($_POST['kode_huruf_akhir']);
    $plat_nomor			= $kode_huruf_awal.$kode_nomor.$kode_huruf_akhir;

    $jam_masuk			= date('Y-m-d H:i:s');
    $status 			= 1;
    $created_by 		= $_SESSION['username'];
    $created_dt 		= date('Y-m-d H:i:s');

    $cek_tiket			= $mysqli->query("select * FROM trx_parking WHERE plat_nomor = '$plat_nomor' and status = 1 ");
	$data_tiket 		= mysqli_fetch_array($cek_tiket);
	$jmlh_data_tiket	= mysqli_num_rows($cek_tiket);



    if ($jmlh_data_tiket > 0){
    	$_SESSION['pesan'] = "Kendaraan Plat Nomor ".$kode_huruf_awal." ".$kode_nomor." ".$kode_huruf_akhir." Belum Keluar";
		$_SESSION['kode_pesan'] = "warning";
		header("location:index.php?page=add_tiket");
    } else {
        $sql_tiket_masuk = "INSERT INTO trx_parking (kode_tiket, jenis_kendaraan, kode_huruf_awal, kode_nomor, kode_huruf_akhir, plat_nomor, jam_masuk, status, created_by, created_dt) VALUES ('$kode_tiket', '$jenis_kendaraan', '$kode_huruf_awal', '$kode_nomor', '$kode_huruf_akhir', '$plat_nomor', '$jam_masuk', '$status', '$created_by', '$created_dt')";
        $insert_tiket_masuk = mysqli_query($mysqli, $sql_tiket_masuk);

        if( $insert_tiket_masuk ) {
	        $_SESSION['pesan'] = "Berhasil Buat Tiket";
			$_SESSION['kode_pesan'] = "success";
			header("location:index.php?page=add_tiket");
	    } else {
	        $_SESSION['pesan'] = "Gagal Membuat Tiket";
			$_SESSION['kode_pesan'] = "warning";
			header("location:index.php?page=add_tiket");
	    }  
    }

} else {
	$_SESSION['pesan'] = "Akses Dilarang";
	$_SESSION['kode_pesan'] = "warning";
	header("location:index.php?page=add_tarif_parkir");
}
    

?>