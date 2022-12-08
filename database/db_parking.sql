-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               10.4.22-MariaDB - mariadb.org binary distribution
-- Server OS:                    Win64
-- HeidiSQL Version:             12.2.0.6576
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


-- Dumping database structure for db_parking
CREATE DATABASE IF NOT EXISTS `db_parking` /*!40100 DEFAULT CHARACTER SET utf8mb4 */;
USE `db_parking`;

-- Dumping structure for table db_parking.login
CREATE TABLE IF NOT EXISTS `login` (
  `id_user` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(50) NOT NULL,
  `password` varchar(100) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `level` int(1) NOT NULL,
  `status` int(1) NOT NULL,
  `created_dt` datetime NOT NULL,
  PRIMARY KEY (`id_user`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4;

-- Data exporting was unselected.

-- Dumping structure for table db_parking.ms_tarif_kendaraan
CREATE TABLE IF NOT EXISTS `ms_tarif_kendaraan` (
  `id_tarif_kendaraan` int(11) NOT NULL AUTO_INCREMENT,
  `jenis_kendaraan` varchar(50) NOT NULL,
  `tarif_kendaraan` int(11) NOT NULL,
  PRIMARY KEY (`id_tarif_kendaraan`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4;

-- Data exporting was unselected.

-- Dumping structure for table db_parking.trx_parking
CREATE TABLE IF NOT EXISTS `trx_parking` (
  `kode_tiket` varchar(50) NOT NULL,
  `jenis_kendaraan` varchar(50) NOT NULL,
  `kode_huruf_awal` char(1) NOT NULL,
  `kode_nomor` char(4) NOT NULL,
  `kode_huruf_akhir` char(3) NOT NULL,
  `plat_nomor` char(8) NOT NULL,
  `jam_masuk` datetime NOT NULL,
  `jam_keluar` datetime NOT NULL,
  `durasi` varchar(50) NOT NULL,
  `tarif_parkir` int(11) NOT NULL,
  `status` int(1) NOT NULL,
  `created_by` varchar(50) NOT NULL,
  `created_dt` datetime NOT NULL,
  `update_by` varchar(50) NOT NULL,
  `update_dt` datetime NOT NULL,
  PRIMARY KEY (`kode_tiket`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Data exporting was unselected.

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
