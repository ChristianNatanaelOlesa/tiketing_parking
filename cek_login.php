<?php 
// mengaktifkan session pada php
session_start();

// menghubungkan php dengan koneksi database
include 'koneksi.php';

// menangkap data yang dikirim dari form login
$username = $_POST['username'];
$password = md5($_POST['password']);


// menyeleksi data user dengan ID USER dan password yang sesuai
$login = mysqli_query($mysqli,"select * from login where username='$username' and password='$password' ");
// menghitung jumlah data yang ditemukan
$data = mysqli_fetch_assoc($login);
$cek = mysqli_num_rows($login);

$query_username = mysqli_query($mysqli,"select * from login where username='$username'");
$data_username 	= mysqli_fetch_assoc($query_username);
$cek_username 	= mysqli_num_rows($query_username);

if ($cek_username > 0) {
	if($cek > 0){
		if ($data['status'] != 0) {
			$_SESSION['username'] 			= $username;
			$_SESSION['nama'] 				= $data['nama'];
			$_SESSION['level']				= $data['level'];

	        header("location:index.php?page=add_tiket");

		} else {
			$_SESSION['pesan'] = "User Tidak Aktif Silahkan Hubungi Admin";
	        $_SESSION['kode_pesan'] = "warning";
			header("location:login.php");
		}
			
	} else{
		$_SESSION['pesan'] = "Password Salah";
	    $_SESSION['kode_pesan'] = "warning";
		header("location:login.php");
	}

} else {
	$_SESSION['pesan'] = "Username Tidak Terdaftar";
    $_SESSION['kode_pesan'] = "warning";
	header("location:login.php");
}



?>