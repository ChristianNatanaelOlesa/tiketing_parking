<?php
  	session_start();
	error_reporting( error_reporting() & ~E_NOTICE );
	include "koneksi.php";

	//HALAMAN MASTER DATA - USER
    if ($_GET['page']=="add_user") {
		include "add_user.php";
	}

	else if ($_GET['page']=="create_user") {
		include "create_master.php";
	}

	else if ($_GET['page']=="edit_user") {
		include "update_master.php";
	}

	else if ($_GET['page']=="delete_user") {
		include "delete_master.php";
	}

	//REPORT DATA
	else if ($_GET['page'] == "report_data") { //VIEW
		include "report_data.php";
	}

	else if ($_GET['page']=="print_report") {
		include "print_report.php";
	}

	//HALAMAN MASTER DATA - TARIF PARKIR
	else if ($_GET['page']=="add_tarif_kendaraan") {
		include "add_tarif_kendaraan.php";
	}

	else if ($_GET['page']=="create_tarif_kendaraan") {
		include "create_master.php";
	}

	else if ($_GET['page']=="edit_tarif_kendaraan") {
		include "update_master.php";
	}

	else if ($_GET['page']=="delete_tarif_kendaraan") {
		include "delete_master.php";
	}
	
	//HALAMAN NEW TIKET

	else if ($_GET['page']=="add_tiket") {
		include "add_tiket.php";
	}

	else if ($_GET['page']=="create_tiket_masuk") {
		include "create_master.php";
	}

	else if ($_GET['page']=="update_tiket_keluar") {
		include "update_master.php";
	}

	else if ($_GET['page']=="edit_tiket") {
		include "update_master.php";
	}

	else if ($_GET['page']=="delete_tiket") {
		include "delete_master.php";
	}

	else{
		include "login.php";
	}
?>