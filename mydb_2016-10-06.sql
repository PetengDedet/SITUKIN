# ************************************************************
# Sequel Pro SQL dump
# Version 4529
#
# http://www.sequelpro.com/
# https://github.com/sequelpro/sequelpro
#
# Host: 127.0.0.1 (MySQL 5.5.5-10.1.17-MariaDB)
# Database: mydb
# Generation Time: 2016-10-06 14:46:54 +0000
# ************************************************************


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


# Dump of table activations
# ------------------------------------------------------------

DROP TABLE IF EXISTS `activations`;

CREATE TABLE `activations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(10) unsigned NOT NULL,
  `code` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `completed` tinyint(1) NOT NULL DEFAULT '0',
  `completed_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;



# Dump of table grade
# ------------------------------------------------------------

DROP TABLE IF EXISTS `grade`;

CREATE TABLE `grade` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `grade` int(11) NOT NULL,
  `tunjangan_kinerja` int(11) NOT NULL,
  `dasar_hukum` varchar(255) DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `kelas_jabatan_UNIQUE` (`grade`),
  KEY `kelas` (`grade`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

LOCK TABLES `grade` WRITE;
/*!40000 ALTER TABLE `grade` DISABLE KEYS */;

INSERT INTO `grade` (`id`, `grade`, `tunjangan_kinerja`, `dasar_hukum`, `updated_at`, `created_at`)
VALUES
	(1,1,1931250,'Perpres 102 Tahun 2014','2016-10-06 09:33:08',NULL),
	(2,2,2066250,'Perpres 102 Tahun 2014','2016-10-06 09:58:15',NULL),
	(3,3,2211000,'Perpres 102 Tahun 2014','2016-10-06 09:58:40',NULL),
	(4,4,2365500,'Perpres 102 Tahun 2014','2016-10-06 09:58:54',NULL),
	(5,5,2531250,'Perpres 102 Tahun 2014','2016-10-06 09:59:04',NULL),
	(6,6,2850000,'Perpres 102 Tahun 2014','2016-10-06 09:59:14',NULL),
	(7,7,3277500,'Perpres 102 Tahun 2014','2016-10-06 09:59:24',NULL),
	(8,8,3930000,'Perpres 102 Tahun 2014','2016-10-06 09:59:37',NULL),
	(9,9,4522500,'Perpres 102 Tahun 2014','2016-10-06 09:59:49',NULL),
	(10,10,5197500,'Perpres 102 Tahun 2014','2016-10-06 10:00:00',NULL),
	(11,11,7020000,'Perpres 102 Tahun 2014','2016-10-06 10:00:11',NULL),
	(12,12,234234,'Perpres 102 Tahun 2014','2016-10-06 09:32:15',NULL),
	(13,13,9277500,'Perpres 102 Tahun 2014','2016-10-06 10:00:35',NULL),
	(14,14,14160000,'Perpres 102 Tahun 2014','2016-10-06 10:00:46',NULL),
	(15,15,15997500,'Perpres 102 Tahun 2014','2016-10-06 10:00:58',NULL),
	(16,16,24405000,'Perpres 102 Tahun 2014','2016-10-06 10:01:09',NULL),
	(17,17,27577500,'Perpres 102 Tahun 2014','2016-10-06 10:01:18',NULL);

/*!40000 ALTER TABLE `grade` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table jabatan
# ------------------------------------------------------------

DROP TABLE IF EXISTS `jabatan`;

CREATE TABLE `jabatan` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nama_jabatan` varchar(255) DEFAULT NULL,
  `kelas_jabatan` int(11) NOT NULL,
  `keterangan` varchar(255) DEFAULT NULL,
  `unit_id` int(11) NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

LOCK TABLES `jabatan` WRITE;
/*!40000 ALTER TABLE `jabatan` DISABLE KEYS */;

INSERT INTO `jabatan` (`id`, `nama_jabatan`, `kelas_jabatan`, `keterangan`, `unit_id`, `created_at`, `updated_at`)
VALUES
	(1,'q',17,NULL,8,'2016-10-06 10:13:37','2016-10-06 14:36:41'),
	(2,'ee',1,NULL,6,'2016-10-06 14:19:07','2016-10-06 14:19:07'),
	(3,'uiu',1,NULL,6,'2016-10-06 14:19:32','2016-10-06 14:19:32'),
	(4,'eyyyy',4,NULL,6,'2016-10-06 14:20:11','2016-10-06 14:36:57'),
	(5,'dqwesdsad',5,NULL,10,'2016-10-06 14:22:31','2016-10-06 14:22:31');

/*!40000 ALTER TABLE `jabatan` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table kinerja_bulanan
# ------------------------------------------------------------

DROP TABLE IF EXISTS `kinerja_bulanan`;

CREATE TABLE `kinerja_bulanan` (
  `id` int(11) NOT NULL,
  `pegawai_id` int(11) DEFAULT NULL,
  `bulan` date DEFAULT NULL,
  `persentase` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;



# Dump of table migrations
# ------------------------------------------------------------

DROP TABLE IF EXISTS `migrations`;

CREATE TABLE `migrations` (
  `migration` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

LOCK TABLES `migrations` WRITE;
/*!40000 ALTER TABLE `migrations` DISABLE KEYS */;

INSERT INTO `migrations` (`migration`, `batch`)
VALUES
	('2014_07_02_230147_migration_cartalyst_sentinel',1);

/*!40000 ALTER TABLE `migrations` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table persistences
# ------------------------------------------------------------

DROP TABLE IF EXISTS `persistences`;

CREATE TABLE `persistences` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(10) unsigned NOT NULL,
  `code` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `persistences_code_unique` (`code`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;



# Dump of table potongan_absensi
# ------------------------------------------------------------

DROP TABLE IF EXISTS `potongan_absensi`;

CREATE TABLE `potongan_absensi` (
  `id` int(11) NOT NULL,
  `pegawai_id` int(11) DEFAULT NULL,
  `bulan` date DEFAULT NULL,
  `tl1` int(11) DEFAULT '0',
  `tl2` int(11) DEFAULT '0',
  `tl3` int(11) DEFAULT '0',
  `tl4` int(11) DEFAULT '0',
  `psw1` int(11) DEFAULT '0',
  `psw2` int(11) DEFAULT '0',
  `psw3` int(11) DEFAULT '0',
  `psw4` int(11) DEFAULT '0',
  `cuti_tahunan` int(11) DEFAULT '0',
  `cuti_alasan_penting` int(11) DEFAULT '0',
  `cuti_sakit_tidak_rawat_inap` int(11) DEFAULT '0',
  `cuti_sakit_rawat_inap` int(11) DEFAULT '0',
  `cuti_sakit_rawat_jalan` int(11) DEFAULT '0',
  `cuti_gugur_kandungan` int(11) DEFAULT '0',
  `cuti_bersalin` int(11) DEFAULT '0',
  `cuti_besar` int(11) DEFAULT '0',
  `cuti_luar_tanggungan_negara` int(11) DEFAULT '0',
  `cuti_alpha` int(11) DEFAULT '0',
  `cuti_ijin` int(11) DEFAULT '0',
  `cuti_dinas_luar` int(11) DEFAULT '0',
  `cuti_tugas_belajar` int(11) DEFAULT '0',
  `bebas_tugas` int(11) DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;



# Dump of table potongan_disiplin
# ------------------------------------------------------------

DROP TABLE IF EXISTS `potongan_disiplin`;

CREATE TABLE `potongan_disiplin` (
  `id` int(11) NOT NULL,
  `pegawai_id` int(11) DEFAULT NULL,
  `tahun` varchar(45) DEFAULT NULL,
  `bulan` varchar(45) DEFAULT NULL,
  `persentase` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;



# Dump of table reminders
# ------------------------------------------------------------

DROP TABLE IF EXISTS `reminders`;

CREATE TABLE `reminders` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(10) unsigned NOT NULL,
  `code` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `completed` tinyint(1) NOT NULL DEFAULT '0',
  `completed_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;



# Dump of table role_users
# ------------------------------------------------------------

DROP TABLE IF EXISTS `role_users`;

CREATE TABLE `role_users` (
  `user_id` int(10) unsigned NOT NULL,
  `role_id` int(10) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`user_id`,`role_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;



# Dump of table roles
# ------------------------------------------------------------

DROP TABLE IF EXISTS `roles`;

CREATE TABLE `roles` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `slug` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `permissions` text COLLATE utf8_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `roles_slug_unique` (`slug`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;



# Dump of table status_pegawai
# ------------------------------------------------------------

DROP TABLE IF EXISTS `status_pegawai`;

CREATE TABLE `status_pegawai` (
  `id` int(11) NOT NULL,
  `nama` varchar(255) DEFAULT NULL,
  `persentase` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;



# Dump of table throttle
# ------------------------------------------------------------

DROP TABLE IF EXISTS `throttle`;

CREATE TABLE `throttle` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(10) unsigned DEFAULT NULL,
  `type` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `ip` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `throttle_user_id_index` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;



# Dump of table tukin
# ------------------------------------------------------------

DROP TABLE IF EXISTS `tukin`;

CREATE TABLE `tukin` (
  `id` int(11) NOT NULL,
  `user_id` varchar(45) DEFAULT NULL,
  `jabatan_id` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;



# Dump of table unit
# ------------------------------------------------------------

DROP TABLE IF EXISTS `unit`;

CREATE TABLE `unit` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nama_unit` varchar(255) DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

LOCK TABLES `unit` WRITE;
/*!40000 ALTER TABLE `unit` DISABLE KEYS */;

INSERT INTO `unit` (`id`, `nama_unit`, `updated_at`, `created_at`)
VALUES
	(6,'Sekretariat','2016-10-06 06:42:48','2016-10-06 06:42:48'),
	(7,'Deputi Bidang Koordinasi Ekonomi Makro dan Keuangan','2016-10-06 06:43:22','2016-10-06 06:43:22'),
	(8,'Deputi Bidang Koordinasi Pangan dan Pertanian','2016-10-06 06:43:32','2016-10-06 06:43:32'),
	(9,'Deputi Bidang Koordinasi Pengelolaan Energi, Sumber Daya Alam dan Lingkungan Hidup','2016-10-06 07:42:17','2016-10-06 06:43:40'),
	(10,'Deputi Bidang Koordinasi Ekonomi Kreatif, Kewirausahaan dan Daya Saing Koperasi dan Usaha Kecil dan Menengah','2016-10-06 06:43:46','2016-10-06 06:43:46'),
	(11,'Deputi Bidang Koordinasi Perniagaan dan Industri','2016-10-06 06:43:54','2016-10-06 06:43:54'),
	(12,'Deputi Bidang Koordinasi Infrastruktur dan Pengembangan Wilayah','2016-10-06 06:44:00','2016-10-06 06:44:00'),
	(13,'Deputi Bidang Koordinasi Kerja Sama Ekonomi Internasional','2016-10-06 06:44:08','2016-10-06 06:44:08'),
	(14,'Staf Ahli','2016-10-06 06:44:14','2016-10-06 06:44:14'),
	(15,'Staf Khusus','2016-10-06 06:44:23','2016-10-06 06:44:23'),
	(16,'Inspektorat','2016-10-06 06:44:33','2016-10-06 06:44:33'),
	(17,'Sekretariat Dewan Nasional Kawasan Ekonomi Khusus','2016-10-06 06:44:41','2016-10-06 06:44:41'),
	(18,'Jabatan Fungsional Auditor','2016-10-06 06:45:08','2016-10-06 06:45:08'),
	(19,'Jabatan Fungsional Analis Kebijakan','2016-10-06 06:45:46','2016-10-06 06:45:46'),
	(20,'Jabatan Fungsional Tertentu','2016-10-06 06:50:26','2016-10-06 06:50:26'),
	(21,'Jabatan Fungsional Umum','2016-10-06 06:50:42','2016-10-06 06:50:42');

/*!40000 ALTER TABLE `unit` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table users
# ------------------------------------------------------------

DROP TABLE IF EXISTS `users`;

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `permissions` text,
  `last_login` datetime DEFAULT NULL,
  `first_name` varchar(255) DEFAULT NULL,
  `last_name` varchar(255) DEFAULT NULL,
  `nip` varchar(100) DEFAULT NULL,
  `gaji_pokok` int(11) DEFAULT NULL,
  `unit_id` int(11) DEFAULT NULL,
  `jabatan_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;




/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
