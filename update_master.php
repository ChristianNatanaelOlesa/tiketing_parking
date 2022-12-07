<?php

include ("koneksi.php");
session_start();

date_default_timezone_set('Asia/Jakarta');

// cek apakah tombol simpan sudah diklik atau blum?
if(isset($_POST['simpan_user'])) {

    $id_user    = $_POST['id_user'];
    $password1  = md5($_POST['password1']);
    $password2  = md5($_POST['password2']);
    $username   = $_POST['username'];
    $nama       = $_POST['nama'];
    $level      = $_POST['level'];
    $status     = $_POST['status'];

    $old_user           = $mysqli->query("SELECT * FROM login WHERE id_user = '$_POST[id_user]' ");
    $data_old_user      = mysqli_fetch_array($old_user);
    $jmlh_data_old_user = mysqli_num_rows($old_user);

    $result_username    = $mysqli->query("SELECT * FROM login WHERE username = '$_POST[username]' ");
    $r_username         = mysqli_fetch_array($result_username);
    $jmlh_data_username = mysqli_num_rows($result_username);

    $result_nama    = $mysqli->query("SELECT * FROM login WHERE nama = '$_POST[nama]' ");
    $r_nama         = mysqli_fetch_array($result_nama);
    $jmlh_data_nama = mysqli_num_rows($result_nama);

    if ($_POST['username'] == $data_old_user['username'] && $_POST['nama'] == $data_old_user['nama'] && $_POST['level'] == $data_old_user['level'] && $_POST['status'] == $data_old_user['status'] ) {
        echo "<script>alert('Tidak ada data yang berubah');window.location.href='index.php?page=add_user'</script>";
    }  else {

        if($_POST['password1'] == ''){

            if ($_POST['nama'] != $data_old_user['nama']) {
                if ($jmlh_data_nama > 0) {
                    echo "<script>alert('Nama Sudah Ada');</script>";
                } else {
                    $sql_nama   = "UPDATE login SET nama='$nama' WHERE id_user = '$_POST[id_user]' ";
                    $query_nama = mysqli_query($mysqli, $sql_nama);
                }
            }

            if ($_POST['username'] != $data_old_user['username']) {
                if ($jmlh_data_username > 0) {
                    echo "<script>alert('Username Sudah Ada');</script>";
                } else {
                    $sql_username   = "UPDATE login SET username='$username' WHERE id_user = '$_POST[id_user]' ";
                    $query_username = mysqli_query($mysqli, $sql_username);
                }
            }

            if ($_POST['level'] != $data_old_user['level']) {
                $sql_level      = "UPDATE login SET level='$level' WHERE id_user = '$_POST[id_user]' ";
                $query_level    = mysqli_query($mysqli, $sql_level);
            }

            if ($_POST['status'] != $data_old_user['status']) {
                $sql_status     = "UPDATE login SET status='$status' WHERE id_user = '$_POST[id_user]' ";
                $query_status   = mysqli_query($mysqli, $sql_status);
            }

        } else {

            if ($_POST['nama'] != $data_old_user['nama']) {
                if ($jmlh_data_nama > 0) {
                    echo "<script>alert('Nama Sudah Ada');</script>";
                } else {
                    $sql_nama   = "UPDATE login SET nama='$nama' WHERE id_user = '$_POST[id_user]' ";
                    $query_nama = mysqli_query($mysqli, $sql_nama);
                }
            }

            if ($_POST['username'] != $data_old_user['username']) {
                if ($jmlh_data_username > 0) {
                    echo "<script>alert('Username Sudah Ada');</script>";
                } else {
                    $sql_username   = "UPDATE login SET username='$username' WHERE id_user = '$_POST[id_user]' ";
                    $query_username = mysqli_query($mysqli, $sql_username);
                }
            }

            if ($_POST['password1'] != $_POST['password2']) {
                echo "<script>alert('Password tidak sama');</script>";
            } else {
                $sql_password   = "UPDATE login SET password='$password1' WHERE id_user = '$_POST[id_user]' ";
                $query_password = mysqli_query($mysqli, $sql_password);
                echo "<script>alert('Password berhasil di rubah');</script>";
            }

            if ($_POST['level'] != $data_old_user['level']) {
                $sql_level      = "UPDATE login SET level='$level' WHERE id_user = '$_POST[id_user]' ";
                $query_level    = mysqli_query($mysqli, $sql_level);
            }

            if ($_POST['status'] != $data_old_user['status']) {
                $sql_status     = "UPDATE login SET status='$status' WHERE id_user = '$_POST[id_user]' ";
                $query_status   = mysqli_query($mysqli, $sql_status);
            }
        }

        if ($query_nama || $query_username || $query_level || $query_status) {
            $_SESSION['pesan'] = "Data User Berhasil Di Rubah";
            $_SESSION['kode_pesan'] = "success";
            header("location:index.php?page=add_user");
        } else {
            $_SESSION['pesan'] = "Gagal Merubah Data User";
            $_SESSION['kode_pesan'] = "warning";
            header("location:index.php?page=add_user");
        } 
    } 

} else if(isset($_POST['simpan_tarif_kendaraan'])){

    $id_tarif_kendaraan = $_POST['id_tarif_kendaraan'];
    $jenis_kendaraan    = $_POST['jenis_kendaraan'];
    $tarif_kendaraan    = $_POST['tarif_kendaraan'];

    $old_tarif           = $mysqli->query("SELECT * FROM ms_tarif_kendaraan WHERE id_tarif_kendaraan = '$id_tarif_kendaraan' ");
    $data_old_tarif      = mysqli_fetch_array($old_tarif);
    $jmlh_data_old_tarif = mysqli_num_rows($old_kategori);
    
    $result_tarif_kendaraan    = $mysqli->query("SELECT * FROM ms_tarif_kendaraan WHERE jenis_kendaraan = '$jenis_kendaraan' and tarif_kendaraan = '$tarif_kendaraan");
    $r_tarif_kendaraan         = mysqli_fetch_array($result_tarif_kendaraan);
    $jmlh_data_tarif_kendaraan = mysqli_num_rows($result_tarif_kendaraan);

    if ($_POST['jenis_kendaraan'] == $data_old_tarif['jenis_kendaraan'] && $_POST['tarif_kendaraan'] == $data_old_tarif['tarif_kendaraan']) {
        $_SESSION['pesan'] = "Tidak Ada Yang Berubah";
        $_SESSION['kode_pesan'] = "success";
        header("location:index.php?page=add_tarif_kendaraan");
    } else {
        if ($jmlh_data_tarif_kendaraan > 0) {
            $_SESSION['pesan'] = "Tarif Kendaraan ".$jenis_kendaraan." Sudah Ada";
            $_SESSION['kode_pesan'] = "warning";
            header("location:index.php?page=add_tarif_kendaraan");
        } else {
            $sql = "UPDATE ms_tarif_kendaraan SET jenis_kendaraan='$_POST[jenis_kendaraan]', tarif_kendaraan='$_POST[tarif_kendaraan]', WHERE id_tarif_kendaraan = '$id_tarif_kendaraan' ";
            $query = mysqli_query($mysqli, $sql);

            // apakah query simpan berhasil?
            if( $query ) {
                $_SESSION['pesan'] = "Tarif Kendaraan Berhasil Di Rubah";
                $_SESSION['kode_pesan'] = "warning";
                header("location:index.php?page=add_tarif_kendaraan");
            }
        }
    }

} else if(isset($_POST['simpan_tiket_keluar'])){

    $kode_tiket     = $_POST['kode_tiket'];
    $jam_keluar     = $_POST['jam_keluar'];
    $durasi         = $_POST['durasi'];
    $tarif_parkir   = $_POST['tarif_parkir'];
    $status         = 0;//STATUS SUDAH KELUAR PARKIRAN
    $update_by      = $_SESSION['username'];
    $update_dt      = date('Y-m-d H:i:s');

    $sql_tiket_keluar    = "UPDATE trx_parking SET tarif_parkir='$tarif_parkir', durasi='$durasi', jam_keluar='$jam_keluar', status='$status', update_by='$update_by', update_dt='$update_dt' WHERE kode_tiket = '$kode_tiket' ";
    $update_tiket_keluar  = mysqli_query($mysqli, $sql_tiket_keluar); 

    if( $update_tiket_keluar ) {
        $_SESSION['pesan'] = "Behrasil Memproses Tiket Keluar";
        $_SESSION['kode_pesan'] = "success";
        header("location:index.php?page=add_tiket");
    } else {
        $_SESSION['pesan'] = "Gagal Memproses Tiket Keluar ".$kode_tiket." ".$jam_keluar." ".$durasi." ".$tarif_parkir;
        $_SESSION['kode_pesan'] = "warning";
        header("location:index.php?page=add_tiket");
    }
    

} else if(isset($_POST['simpan_update_tiket'])){

    $kode_tiket         = $_POST['kode_tiket'];

    $kode_huruf_awal    = strtoupper($_POST['kode_huruf_awal']);
    $kode_nomor         = $_POST['kode_nomor'];
    $kode_huruf_akhir   = strtoupper($_POST['kode_huruf_akhir']);
    $plat_nomor         = $kode_huruf_awal.$kode_nomor.$kode_huruf_akhir;

    $jenis_kendaraan    = $_POST['jenis_kendaraan'];

    $update_by      = $_SESSION['username'];
    $update_dt      = date('Y-m-d H:i:s');

    $old_platno            = $mysqli->query("SELECT * FROM trx_parking WHERE plat_nomor = '$plat_nomor' and status = 1");
    $data_old_platno       = mysqli_fetch_array($old_platno);
    $jmlh_data_old_platno  = mysqli_num_rows($old_platno);

    if ($plat_nomor == $data_old_platno['plat_nomor'] && $_POST['jenis_kendaraan'] == $data_old_katalog['jenis_kendaraan']) { //0000

        $_SESSION['pesan'] = "Tidak Ada Data Yang Di Rubah";
        $_SESSION['kode_pesan'] = "success";
        header("location:index.php?page=add_tiket");

    } else {

        if ($plat_nomor != $data_old_platno['plat_nomor']) { 
            if ($jmlh_data_old_platno > 0) {
                $_SESSION['pesan'] = "Plat Nomor Sudah Ada";
                $_SESSION['kode_pesan'] = "warning";
                header("location:index.php?page=add_tiket");
            } else {
                $edit_plat_nomor    = "UPDATE trx_parking SET plat_nomor='$plat_nomor', kode_huruf_awal='$kode_huruf_awal', kode_nomor='$kode_nomor', kode_huruf_akhir='$kode_huruf_akhir', update_by='$update_by', update_dt='$update_dt' WHERE kode_tiket = '$_POST[kode_tiket]' ";
                $update_plat_nomor  = mysqli_query($mysqli, $edit_plat_nomor); 
            }
            
        }

        if ($jenis_kendaraan != $data_old_platno['jenis_kendaraan']) { 
            $edit_jenis_kendaraan    = "UPDATE trx_parking SET jenis_kendaraan='$jenis_kendaraan' WHERE kode_tiket = '$_POST[kode_tiket]' ";
            $update_jenis_kendaraan  = mysqli_query($mysqli, $edit_jenis_kendaraan); 

            
        }

        if( $update_plat_nomor ||  $update_jenis_kendaraan ) {
            $_SESSION['pesan'] = "Data Tiket Berhasil Di Rubah";
            $_SESSION['kode_pesan'] = "success";
            header("location:index.php?page=add_tiket");
        } 
    }

} else {
    $_SESSION['pesan'] = "Akses Dilarang";
    $_SESSION['kode_pesan'] = "warning";
    header("location:index.php?page=add_trx");
}

?>