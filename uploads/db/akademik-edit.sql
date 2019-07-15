/*
SQLyog Community v12.2.6 (32 bit)
MySQL - 10.1.16-MariaDB : Database - akademik
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`akademik` /*!40100 DEFAULT CHARACTER SET latin1 */;

USE `akademik`;

/*Table structure for table `tabel_menu` */

DROP TABLE IF EXISTS `tabel_menu`;

CREATE TABLE `tabel_menu` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nama_menu` varchar(50) NOT NULL,
  `link` varchar(50) NOT NULL,
  `icon` varchar(30) NOT NULL,
  `is_main_menu` int(11) NOT NULL,
  `status_delete` int(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=29 DEFAULT CHARSET=latin1;

/*Data for the table `tabel_menu` */

insert  into `tabel_menu`(`id`,`nama_menu`,`link`,`icon`,`is_main_menu`,`status_delete`) values 
(1,'Database Siswa','siswa','fa fa-users',0,0),
(2,'Database Guru','guru','fa fa-graduation-cap',0,0),
(8,'Data Sekolah','sekolah','fa fa-building',0,0),
(9,'Data master','#','fa fa-bars',0,0),
(10,'Mata Pelajaran','mapel','fa fa-book',9,0),
(11,'Ruangan Kelas','ruangan','fa fa-building',9,0),
(12,'Jurusan','jurusan','fa fa-th-large',9,0),
(13,'Tahun Akademik','tahun_akademik','fa fa-calendar-o',9,0),
(14,'Jadwal pelajaran','jadwal','fa fa-calendar',0,0),
(15,'Rombongan Belajar','rombel','fa fa-users',9,0),
(16,'laporan nilai','nilai','fa fa-file-excel-o',0,0),
(17,'Users','users','fa fa-cubes',0,0),
(19,'Kurikulum','kurikulum','fa fa-bars',9,0),
(20,'Wali Kelas','walikelas','fa fa-users',0,0),
(21,'form pembayaran','keuangan/form','fa fa-shopping-cart',0,0),
(22,'Peserta Didik','siswa/siswa_aktif','fa fa-graduation-cap',0,0),
(23,'jenis pembayaran','jenis_pembayaran','fa fa-credit-card',0,0),
(24,'setup biaya','keuangan/setup','fa fa-graduation-cap',0,0),
(25,'Raport Online','raport','fa fa-graduation-cap',0,0),
(26,'SMS GATEWAY','#','fa fa-envelope-o',0,0),
(27,'phonebook','sms_group','fa fa-book',26,0),
(28,'form sms','sms','fa fa-keyboard-o',26,0);

/*Table structure for table `tbl_agama` */

DROP TABLE IF EXISTS `tbl_agama`;

CREATE TABLE `tbl_agama` (
  `kd_agama` varchar(2) NOT NULL,
  `nama_agama` varchar(30) NOT NULL,
  `status_delete` int(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`kd_agama`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `tbl_agama` */

insert  into `tbl_agama`(`kd_agama`,`nama_agama`,`status_delete`) values 
('01','ISLAM',0),
('02','KRISTEN/ PROTESTAN',0),
('03','KATHOLIK',0),
('04','HINDU',0),
('05','BUDHA',0),
('06','KHONG HU CHU',0),
('99','LAIN LAIN',0);

/*Table structure for table `tbl_biaya_sekolah` */

DROP TABLE IF EXISTS `tbl_biaya_sekolah`;

CREATE TABLE `tbl_biaya_sekolah` (
  `id_biaya` int(11) NOT NULL AUTO_INCREMENT,
  `id_jenis_pembayaran` int(11) NOT NULL,
  `id_tahun_akademik` int(11) NOT NULL,
  `jumlah_biaya` int(11) NOT NULL,
  `status_delete` int(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id_biaya`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

/*Data for the table `tbl_biaya_sekolah` */

insert  into `tbl_biaya_sekolah`(`id_biaya`,`id_jenis_pembayaran`,`id_tahun_akademik`,`jumlah_biaya`,`status_delete`) values 
(3,1,1,600000,0),
(4,2,1,900000,0);

/*Table structure for table `tbl_guru` */

DROP TABLE IF EXISTS `tbl_guru`;

CREATE TABLE `tbl_guru` (
  `id_guru` int(11) NOT NULL AUTO_INCREMENT,
  `nuptk` varchar(20) NOT NULL,
  `nama_guru` varchar(100) NOT NULL,
  `gender` enum('L','P') NOT NULL,
  `username` varchar(40) NOT NULL,
  `password` varchar(200) NOT NULL,
  `status_delete` int(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id_guru`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;

/*Data for the table `tbl_guru` */

insert  into `tbl_guru`(`id_guru`,`nuptk`,`nama_guru`,`gender`,`username`,`password`,`status_delete`) values 
(1,'8728372382738273','DRS DIAWAN SST','L','','',0),
(2,'46676768686','NURIS AKBAR SST','L','','',0),
(3,'4343434434343434','IRMA MAULIANA SST MPD','P','','',0),
(4,'3434343232323','SYAMSUDIN','L','','',0),
(5,'1231345464646456','BUDI','L','','',0),
(6,'1203981230123','SAMSUL','L','','',0),
(7,'7237123571','UMI','P','','',0);

/*Table structure for table `tbl_history_kelas` */

DROP TABLE IF EXISTS `tbl_history_kelas`;

CREATE TABLE `tbl_history_kelas` (
  `id_history` int(11) NOT NULL AUTO_INCREMENT,
  `id_rombel` int(11) NOT NULL,
  `nis` varchar(11) NOT NULL,
  `id_tahun_akademik` int(11) NOT NULL,
  `status_delete` int(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id_history`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=latin1;

/*Data for the table `tbl_history_kelas` */

insert  into `tbl_history_kelas`(`id_history`,`id_rombel`,`nis`,`id_tahun_akademik`,`status_delete`) values 
(1,1,'TI3003239',1,0),
(2,1,'RM00502',1,0),
(3,1,'TI102132',1,0),
(4,1,'TI102133',1,0),
(5,1,'TIM102134',1,0),
(6,1,'TIM102135',1,0),
(7,1,'TI1021395',1,0),
(8,5,'RM00503',1,0),
(9,3,'RM00504',1,0),
(10,4,'RM00505',1,0),
(11,1,'RM00506',1,0),
(12,2,'rm00507',1,0),
(13,6,'11210012',1,0);

/*Table structure for table `tbl_jadwal` */

DROP TABLE IF EXISTS `tbl_jadwal`;

CREATE TABLE `tbl_jadwal` (
  `id_jadwal` int(11) NOT NULL AUTO_INCREMENT,
  `id_tahun_akademik` int(11) NOT NULL,
  `kd_jurusan` varchar(6) NOT NULL,
  `kelas` int(11) NOT NULL,
  `kd_mapel` varchar(4) NOT NULL,
  `id_guru` int(11) NOT NULL,
  `jam` varchar(14) NOT NULL,
  `kd_ruangan` varchar(4) NOT NULL,
  `semester` int(11) NOT NULL,
  `hari` varchar(10) NOT NULL,
  `id_rombel` int(11) NOT NULL,
  PRIMARY KEY (`id_jadwal`)
) ENGINE=InnoDB AUTO_INCREMENT=54 DEFAULT CHARSET=latin1;

/*Data for the table `tbl_jadwal` */

insert  into `tbl_jadwal`(`id_jadwal`,`id_tahun_akademik`,`kd_jurusan`,`kelas`,`kd_mapel`,`id_guru`,`jam`,`kd_ruangan`,`semester`,`hari`,`id_rombel`) values 
(13,1,'RPL',1,'MTK',4,'08.00 - 08.45','01A',1,'SELASA',1),
(14,1,'RPL',1,'MTK',4,'07.15 - 08.00','01B',1,'RABU',2),
(15,1,'RPL',1,'BID',3,'10.00 - 10.45','01A',1,'SENIN',1),
(16,1,'RPL',1,'BID',2,'','01A',1,'SELASA',2),
(17,1,'RPL',1,'IPA',5,'10.00 - 10.45','01B',1,'KAMIS',1),
(18,1,'RPL',1,'IPA',2,'08.00 - 08.45','01C',1,'SELASA',2),
(19,1,'RPL',1,'MTK',2,'','011',1,'',1),
(20,1,'RPL',1,'MTK',2,'','011',1,'',2),
(21,1,'RPL',1,'BID',2,'','011',1,'',1),
(22,1,'RPL',1,'BID',2,'','011',1,'',2),
(23,1,'RPL',1,'IPA',2,'','011',1,'',1),
(24,1,'RPL',1,'IPA',2,'','011',1,'',2),
(25,1,'RPL',1,'AGI',2,'','011',1,'',1),
(26,1,'RPL',1,'AGI',2,'','011',1,'',2),
(27,1,'RPL',2,'AGI',2,'','011',1,'',3),
(28,1,'RPL',2,'AGI',2,'','011',1,'',4),
(29,1,'RPL',3,'AGI',2,'','011',1,'',6),
(30,1,'RPL',1,'MTK',2,'','011',1,'',1),
(31,1,'RPL',1,'MTK',2,'','011',1,'',2),
(32,1,'RPL',1,'BID',2,'','011',1,'',1),
(33,1,'RPL',1,'BID',2,'','011',1,'',2),
(34,1,'RPL',1,'IPA',2,'','011',1,'',1),
(35,1,'RPL',1,'IPA',2,'','011',1,'',2),
(36,1,'RPL',1,'AGI',2,'','011',1,'',1),
(37,1,'RPL',1,'AGI',2,'','011',1,'',2),
(38,1,'RPL',2,'AGI',2,'','011',1,'',3),
(39,1,'RPL',2,'AGI',2,'','011',1,'',4),
(40,1,'RPL',3,'AGI',2,'','011',1,'',6),
(41,1,'RPL',1,'MTK',2,'','011',1,'',1),
(42,1,'RPL',1,'MTK',2,'','011',1,'',2),
(43,1,'RPL',1,'BID',2,'','011',1,'',1),
(44,1,'RPL',1,'BID',2,'','011',1,'',2),
(45,1,'RPL',1,'IPA',2,'','011',1,'',1),
(46,1,'RPL',1,'IPA',2,'','011',1,'',2),
(47,1,'RPL',1,'AGI',2,'','011',1,'',1),
(48,1,'RPL',1,'AGI',2,'','011',1,'',2),
(49,1,'AKA',2,'AGI',2,'','011',1,'',8),
(50,1,'RPL',2,'AGI',2,'','011',1,'',3),
(51,1,'RPL',2,'AGI',2,'','011',1,'',4),
(52,1,'RPL',3,'AGI',2,'','011',1,'',6),
(53,1,'AKA',1,'AGI',2,'','011',1,'',7);

/*Table structure for table `tbl_jenis_pembayaran` */

DROP TABLE IF EXISTS `tbl_jenis_pembayaran`;

CREATE TABLE `tbl_jenis_pembayaran` (
  `id_jenis_pembayaran` int(11) NOT NULL AUTO_INCREMENT,
  `nama_jenis_pembayaran` varchar(50) NOT NULL,
  `keterangan` varchar(50) NOT NULL,
  `status_delete` int(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id_jenis_pembayaran`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

/*Data for the table `tbl_jenis_pembayaran` */

insert  into `tbl_jenis_pembayaran`(`id_jenis_pembayaran`,`nama_jenis_pembayaran`,`keterangan`,`status_delete`) values 
(1,'SSP','SINGKATAN SSP',0),
(2,'DSP','SINGKATAN DSP',0);

/*Table structure for table `tbl_jenjang_sekolah` */

DROP TABLE IF EXISTS `tbl_jenjang_sekolah`;

CREATE TABLE `tbl_jenjang_sekolah` (
  `id_jenjang` int(11) NOT NULL AUTO_INCREMENT,
  `nama_jenjang` varchar(10) NOT NULL,
  `jumlah_kelas` int(11) NOT NULL,
  `status_delete` int(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id_jenjang`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

/*Data for the table `tbl_jenjang_sekolah` */

insert  into `tbl_jenjang_sekolah`(`id_jenjang`,`nama_jenjang`,`jumlah_kelas`,`status_delete`) values 
(1,'SD/ MI',6,0),
(2,'SMP/ MTS',3,0),
(3,'SMA/ SMK',3,0);

/*Table structure for table `tbl_jurusan` */

DROP TABLE IF EXISTS `tbl_jurusan`;

CREATE TABLE `tbl_jurusan` (
  `kd_jurusan` varchar(5) NOT NULL,
  `nama_jurusan` varchar(100) NOT NULL,
  `status_delete` int(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`kd_jurusan`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `tbl_jurusan` */

insert  into `tbl_jurusan`(`kd_jurusan`,`nama_jurusan`,`status_delete`) values 
('AKA','AKUNTANSI',0),
('APK','ADMINISTRASI PERKANTORAN',0),
('MSN','TEKNIK MESIN INDUSTRI',0),
('OTO','TEKNIK MEKANIK OTOMOTIF',0),
('RPL','REKAYASA PERANGKAT LUNAK',0),
('TKJ','TEKNIK KOMPUTER JARINGAN',0);

/*Table structure for table `tbl_kurikulum` */

DROP TABLE IF EXISTS `tbl_kurikulum`;

CREATE TABLE `tbl_kurikulum` (
  `id_kurikulum` int(11) NOT NULL AUTO_INCREMENT,
  `nama_kurikulum` varchar(30) NOT NULL,
  `is_aktif` enum('Y','N') NOT NULL,
  `status_delete` int(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id_kurikulum`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

/*Data for the table `tbl_kurikulum` */

insert  into `tbl_kurikulum`(`id_kurikulum`,`nama_kurikulum`,`is_aktif`,`status_delete`) values 
(1,'KURIKULUM 2016','Y',0),
(2,'KURIKULUM 2013','N',0);

/*Table structure for table `tbl_kurikulum_detail` */

DROP TABLE IF EXISTS `tbl_kurikulum_detail`;

CREATE TABLE `tbl_kurikulum_detail` (
  `id_kurikulum_detail` int(11) NOT NULL AUTO_INCREMENT,
  `id_kurikulum` int(11) NOT NULL,
  `kd_mapel` varchar(11) NOT NULL,
  `kd_jurusan` varchar(4) NOT NULL,
  `kelas` int(11) NOT NULL,
  `status_delete` int(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id_kurikulum_detail`)
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=latin1;

/*Data for the table `tbl_kurikulum_detail` */

insert  into `tbl_kurikulum_detail`(`id_kurikulum_detail`,`id_kurikulum`,`kd_mapel`,`kd_jurusan`,`kelas`,`status_delete`) values 
(9,1,'MTK','RPL',1,0),
(10,1,'BID','RPL',1,0),
(12,1,'IPA','RPL',1,0),
(13,1,'AGI','RPL',1,0),
(14,1,'AGI','AKA',2,0),
(15,1,'AGI','RPL',2,0),
(16,1,'AGI','RPL',3,0),
(17,1,'AGI','AKA',1,0),
(18,1,'AGI','AKA',3,0);

/*Table structure for table `tbl_level_user` */

DROP TABLE IF EXISTS `tbl_level_user`;

CREATE TABLE `tbl_level_user` (
  `id_level_user` int(11) NOT NULL AUTO_INCREMENT,
  `nama_level` varchar(30) NOT NULL,
  `status_delete` int(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id_level_user`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

/*Data for the table `tbl_level_user` */

insert  into `tbl_level_user`(`id_level_user`,`nama_level`,`status_delete`) values 
(1,'ADMIN',0),
(2,'WALIKELAS',0),
(3,'GURU',0),
(5,'KEUANGAN',0);

/*Table structure for table `tbl_mapel` */

DROP TABLE IF EXISTS `tbl_mapel`;

CREATE TABLE `tbl_mapel` (
  `kd_mapel` varchar(5) NOT NULL,
  `nama_mapel` varchar(100) NOT NULL,
  `status_delete` int(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`kd_mapel`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `tbl_mapel` */

insert  into `tbl_mapel`(`kd_mapel`,`nama_mapel`,`status_delete`) values 
('AGI','PENDIDIKAN AGAMA ISLAM',0),
('BID','BAHASA INDONESIA',0),
('BNG','BAHASA INGGRIS',0),
('FSK','FISIKA',0),
('IPA','ILMU PENGETAHUAN ALAM',0),
('IPS','ILMU PENGETAHUAN SOSIAL',0),
('MTK','MATEMATIKA',0),
('PKN','PENDIDIKAN PANCASILA DAN KEWARGANEGARAAN',0),
('SBD','SENI DAN BUDAYA',0),
('TIK','TEKNOLOGI INFORMASI KOMPUTER',0);

/*Table structure for table `tbl_nilai` */

DROP TABLE IF EXISTS `tbl_nilai`;

CREATE TABLE `tbl_nilai` (
  `id_nilai` int(11) NOT NULL AUTO_INCREMENT,
  `id_jadwal` int(11) NOT NULL,
  `nis` varchar(15) NOT NULL,
  `nilai` int(11) NOT NULL,
  PRIMARY KEY (`id_nilai`)
) ENGINE=InnoDB AUTO_INCREMENT=25 DEFAULT CHARSET=latin1;

/*Data for the table `tbl_nilai` */

insert  into `tbl_nilai`(`id_nilai`,`id_jadwal`,`nis`,`nilai`) values 
(1,13,'TI3003239',100),
(2,13,'RM00502',89),
(3,13,'TI102132',89),
(4,13,'TI102133',78),
(5,13,'TIM102134',67),
(6,13,'TIM102135',98),
(7,13,'TI1021395',60),
(8,17,'TI3003239',90),
(9,17,'RM00502',87),
(10,17,'TI102132',89),
(11,17,'TI102133',99),
(12,17,'TIM102134',90),
(13,17,'TIM102135',86),
(14,17,'TI1021395',89),
(15,15,'RM00502',50),
(16,15,'TI102132',90),
(17,15,'RM00506',50),
(18,17,'RM00506',70),
(19,14,'RM00507',85),
(20,15,'TI3003239',70),
(21,15,'TI102133',80),
(22,15,'TIM102134',70),
(23,16,'RM00507',90),
(24,18,'RM00507',80);

/*Table structure for table `tbl_pembayaran` */

DROP TABLE IF EXISTS `tbl_pembayaran`;

CREATE TABLE `tbl_pembayaran` (
  `id_pembayaran` int(11) NOT NULL AUTO_INCREMENT,
  `tanggal` date NOT NULL,
  `nis` varchar(11) NOT NULL,
  `id_jenis_pembayaran` int(11) NOT NULL,
  `jumlah` int(11) NOT NULL,
  `keterangan` text NOT NULL,
  `status_delete` int(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id_pembayaran`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;

/*Data for the table `tbl_pembayaran` */

insert  into `tbl_pembayaran`(`id_pembayaran`,`tanggal`,`nis`,`id_jenis_pembayaran`,`jumlah`,`keterangan`,`status_delete`) values 
(1,'2017-11-13','rm00502',1,500000,'ssp ke1',0),
(2,'2017-11-13','rm00503',1,400000,'ssp ke1',0),
(3,'2017-11-13','rm00504',1,600000,'ssp ke1',0),
(4,'2017-11-12','rm00505',1,300000,'ssp ke1',0),
(5,'2017-11-12','rm00506',1,500000,'ssp ke1',0),
(6,'2017-11-12','rm00503',2,3000000,'dsp ke1',0),
(7,'2017-11-13','tim102135',1,400000,'ssp ke1',0);

/*Table structure for table `tbl_phonebook` */

DROP TABLE IF EXISTS `tbl_phonebook`;

CREATE TABLE `tbl_phonebook` (
  `id_phonebook` int(11) NOT NULL AUTO_INCREMENT,
  `id_group` int(11) NOT NULL,
  `no_hp` varchar(13) NOT NULL,
  `status_delete` int(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id_phonebook`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

/*Data for the table `tbl_phonebook` */

insert  into `tbl_phonebook`(`id_phonebook`,`id_group`,`no_hp`,`status_delete`) values 
(1,7,'089699935552',0),
(2,7,'085310204081',0);

/*Table structure for table `tbl_rombel` */

DROP TABLE IF EXISTS `tbl_rombel`;

CREATE TABLE `tbl_rombel` (
  `id_rombel` int(11) NOT NULL AUTO_INCREMENT,
  `nama_rombel` varchar(30) NOT NULL,
  `kelas` int(11) NOT NULL,
  `kd_jurusan` varchar(4) NOT NULL,
  `status_delete` int(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id_rombel`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;

/*Data for the table `tbl_rombel` */

insert  into `tbl_rombel`(`id_rombel`,`nama_rombel`,`kelas`,`kd_jurusan`,`status_delete`) values 
(1,'RPL1A',1,'RPL',0),
(2,'RPL1B',1,'RPL',0),
(3,'RPL2A',2,'RPL',0),
(4,'RPL2B',2,'RPL',0),
(5,'TKJ1A',1,'TKJ',0),
(6,'RPL3A',3,'RPL',0),
(7,'AKA1A',1,'AKA',0),
(8,'AKA2A',2,'AKA',0);

/*Table structure for table `tbl_ruangan` */

DROP TABLE IF EXISTS `tbl_ruangan`;

CREATE TABLE `tbl_ruangan` (
  `kd_ruangan` varchar(5) NOT NULL,
  `nama_ruangan` varchar(100) NOT NULL,
  `status_delete` int(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`kd_ruangan`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `tbl_ruangan` */

insert  into `tbl_ruangan`(`kd_ruangan`,`nama_ruangan`,`status_delete`) values 
('011','DEFAULT',0),
('01A','RUANGAN KELAS 1A',0),
('01B','RUANGAN KELAS 1B',0),
('01C','RUANGAN KELAS 1C',0);

/*Table structure for table `tbl_sekolah_info` */

DROP TABLE IF EXISTS `tbl_sekolah_info`;

CREATE TABLE `tbl_sekolah_info` (
  `id_sekolah` int(11) NOT NULL,
  `nama_sekolah` varchar(50) NOT NULL,
  `id_jenjang_sekolah` int(11) NOT NULL,
  `alamat_sekolah` text NOT NULL,
  `email` varchar(30) NOT NULL,
  `telpon` varchar(30) NOT NULL,
  PRIMARY KEY (`id_sekolah`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `tbl_sekolah_info` */

insert  into `tbl_sekolah_info`(`id_sekolah`,`nama_sekolah`,`id_jenjang_sekolah`,`alamat_sekolah`,`email`,`telpon`) values 
(1,'SMK N 1 KRAGILAN',3,'JL AHMAD YANI NO 2 - SERANG','smkn1kragilan@sch.id','02134235');

/*Table structure for table `tbl_siswa` */

DROP TABLE IF EXISTS `tbl_siswa`;

CREATE TABLE `tbl_siswa` (
  `nis` varchar(11) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `gender` enum('L','P') NOT NULL,
  `tanggal_lahir` date NOT NULL,
  `tempat_lahir` varchar(100) NOT NULL,
  `kd_agama` varchar(2) NOT NULL,
  `foto` text NOT NULL,
  `id_rombel` int(11) NOT NULL,
  `status_delete` int(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`nis`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `tbl_siswa` */

insert  into `tbl_siswa`(`nis`,`nama`,`gender`,`tanggal_lahir`,`tempat_lahir`,`kd_agama`,`foto`,`id_rombel`,`status_delete`) values 
('11210012','DION','L','2017-11-09','JAKARTA','01','rompi002-700x700.png',6,0),
('RM00502','SAFIKAH KAMAL','P','2017-01-23','BANDA ACEH','02','img_prod_strut.jpg',1,0),
('RM00503','OJAN','L','2010-04-13','JAKARTA','01','img_prod_Waterpump.jpg',5,0),
('RM00504','BUDI','L','2017-11-12','JAKARTA','01','Mando-.png',3,0),
('RM00505','JOKO','L','2017-11-14','JAKARTA','01','chinese-Semi-metallic-D924-auto-spare-parts-.jpg',4,0),
('RM00506','DODO','L','2017-11-02','JAKARTA','01','img_prod_Electronic.jpg',1,0),
('RM00507','KOKO','L','2017-11-07','JAKARTA','01','',2,0),
('TI102132','NURIS AKBAR','P','2017-01-22','LANGSA','01','img_prod_strut1.jpg',1,0),
('TI102133','M HAFIDZ MUZAKI','P','2017-01-16','LANGSA','01','img_prod_Electronic1.jpg',1,0),
('TI1021395','BALQIS HUMAIRA','L','2017-01-11','KUALA SIMPANG','01','',1,0),
('TI3003239','JONO','L','2017-02-18','BANDUNG','01','Yaya_yah10.png',1,0),
('TIM102134','DESI HANDAYANI','L','2017-01-22','RANGKASBITUNG','01','',1,0),
('TIM102135','IRMA MULIANA','L','2017-01-25','LANGSA','01','',1,0);

/*Table structure for table `tbl_sms_group` */

DROP TABLE IF EXISTS `tbl_sms_group`;

CREATE TABLE `tbl_sms_group` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nama_group` varchar(30) NOT NULL,
  `status_delete` int(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;

/*Data for the table `tbl_sms_group` */

insert  into `tbl_sms_group`(`id`,`nama_group`,`status_delete`) values 
(1,'GROUP 1',0),
(2,'GROUP 2',0),
(4,'ASASAS',0),
(5,'TESTING',0),
(7,'WALIMURID',0);

/*Table structure for table `tbl_tahun_akademik` */

DROP TABLE IF EXISTS `tbl_tahun_akademik`;

CREATE TABLE `tbl_tahun_akademik` (
  `id_tahun_akademik` int(4) NOT NULL AUTO_INCREMENT,
  `tahun_akademik` varchar(10) NOT NULL,
  `is_aktif` enum('Y','N') NOT NULL,
  `semester_aktif` int(11) NOT NULL,
  `status_delete` int(1) NOT NULL,
  PRIMARY KEY (`id_tahun_akademik`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

/*Data for the table `tbl_tahun_akademik` */

insert  into `tbl_tahun_akademik`(`id_tahun_akademik`,`tahun_akademik`,`is_aktif`,`semester_aktif`,`status_delete`) values 
(1,'2016/2017','Y',1,0),
(2,'2015/2016','N',0,0),
(6,'2017/2018','N',0,0);

/*Table structure for table `tbl_user` */

DROP TABLE IF EXISTS `tbl_user`;

CREATE TABLE `tbl_user` (
  `id_user` int(11) NOT NULL AUTO_INCREMENT,
  `nama_lengkap` varchar(100) NOT NULL,
  `username` varchar(40) NOT NULL,
  `password` varchar(200) NOT NULL,
  `id_level_user` int(11) NOT NULL,
  `foto` text NOT NULL,
  `id_guru` int(11) NOT NULL,
  `status_delete` int(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id_user`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=latin1;

/*Data for the table `tbl_user` */

insert  into `tbl_user`(`id_user`,`nama_lengkap`,`username`,`password`,`id_level_user`,`foto`,`id_guru`,`status_delete`) values 
(1,'ADMINISTRATOR','admin','0192023a7bbd73250516f069df18b500',1,'dsdsdsds',0,0),
(2,'DRS DIAWAN SST','diawan','6701843480f9039f28a80dd4a4a1ba96',2,'Angin.jpeg',1,0),
(5,'FANG SUI','fang','85a3281bee28b39d2c0cb14ff86a55cd',1,'Gopal_Render.png',0,1),
(7,'DESI HANDAYANI','desi','85a3281bee28b39d2c0cb14ff86a55cd',5,'Yaya_yah1.png',0,0),
(8,'BUDI','budi','9c5fa085ce256c7c598f6710584ab25d',2,'',5,0),
(9,'SYAMSUDIN','syamsudin','697d0f4d891393c4e16798fc5396c617',2,'',4,0),
(10,'IRMA MAULIANA SST MPD','irma','7c9eb82d818251456962e698fcb338ba',3,'',3,0),
(11,'NURIS AKBAR SST','nuris','85a3281bee28b39d2c0cb14ff86a55cd',2,'',2,0),
(12,'UMI','umi','f148f5700aeb092133703b3c46d54a57',3,'',7,0);

/*Table structure for table `tbl_user_rule` */

DROP TABLE IF EXISTS `tbl_user_rule`;

CREATE TABLE `tbl_user_rule` (
  `id_rule` int(11) NOT NULL AUTO_INCREMENT,
  `id_menu` int(11) NOT NULL,
  `id_level_user` int(11) NOT NULL,
  PRIMARY KEY (`id_rule`)
) ENGINE=InnoDB AUTO_INCREMENT=50 DEFAULT CHARSET=latin1;

/*Data for the table `tbl_user_rule` */

insert  into `tbl_user_rule`(`id_rule`,`id_menu`,`id_level_user`) values 
(8,16,3),
(10,21,5),
(11,9,1),
(12,10,1),
(13,11,1),
(14,12,1),
(15,13,1),
(16,14,1),
(17,17,1),
(18,19,1),
(19,20,1),
(20,14,3),
(25,22,1),
(26,23,5),
(27,24,5),
(29,26,1),
(30,26,5),
(32,1,1),
(33,2,1),
(34,8,1),
(36,25,2),
(41,16,2),
(42,14,2),
(45,27,1),
(46,28,1),
(47,24,1),
(48,23,1),
(49,15,1);

/*Table structure for table `tbl_walikelas` */

DROP TABLE IF EXISTS `tbl_walikelas`;

CREATE TABLE `tbl_walikelas` (
  `id_walikelas` int(11) NOT NULL AUTO_INCREMENT,
  `id_guru` int(11) NOT NULL,
  `id_tahun_akademik` int(11) NOT NULL,
  `id_rombel` int(11) NOT NULL,
  PRIMARY KEY (`id_walikelas`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=latin1;

/*Data for the table `tbl_walikelas` */

insert  into `tbl_walikelas`(`id_walikelas`,`id_guru`,`id_tahun_akademik`,`id_rombel`) values 
(7,2,1,1),
(8,4,1,2),
(9,1,1,3),
(10,5,1,4);

/*Table structure for table `v_master_rombel` */

DROP TABLE IF EXISTS `v_master_rombel`;

/*!50001 DROP VIEW IF EXISTS `v_master_rombel` */;
/*!50001 DROP TABLE IF EXISTS `v_master_rombel` */;

/*!50001 CREATE TABLE  `v_master_rombel`(
 `id_rombel` int(11) ,
 `nama_rombel` varchar(30) ,
 `kelas` int(11) ,
 `kd_jurusan` varchar(4) ,
 `nama_jurusan` varchar(100) 
)*/;

/*Table structure for table `v_tbl_user` */

DROP TABLE IF EXISTS `v_tbl_user`;

/*!50001 DROP VIEW IF EXISTS `v_tbl_user` */;
/*!50001 DROP TABLE IF EXISTS `v_tbl_user` */;

/*!50001 CREATE TABLE  `v_tbl_user`(
 `id_user` int(11) ,
 `nama_lengkap` varchar(100) ,
 `username` varchar(40) ,
 `password` varchar(200) ,
 `id_level_user` int(11) ,
 `foto` text ,
 `nama_level` varchar(30) 
)*/;

/*Table structure for table `v_walikelas` */

DROP TABLE IF EXISTS `v_walikelas`;

/*!50001 DROP VIEW IF EXISTS `v_walikelas` */;
/*!50001 DROP TABLE IF EXISTS `v_walikelas` */;

/*!50001 CREATE TABLE  `v_walikelas`(
 `nama_guru` varchar(100) ,
 `nama_rombel` varchar(30) ,
 `id_walikelas` int(11) ,
 `id_tahun_akademik` int(11) ,
 `nama_jurusan` varchar(100) ,
 `kelas` int(11) ,
 `tahun_akademik` varchar(10) 
)*/;

/*View structure for view v_master_rombel */

/*!50001 DROP TABLE IF EXISTS `v_master_rombel` */;
/*!50001 DROP VIEW IF EXISTS `v_master_rombel` */;

/*!50001 CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `v_master_rombel` AS select `tr`.`id_rombel` AS `id_rombel`,`tr`.`nama_rombel` AS `nama_rombel`,`tr`.`kelas` AS `kelas`,`tr`.`kd_jurusan` AS `kd_jurusan`,`tj`.`nama_jurusan` AS `nama_jurusan` from (`tbl_rombel` `tr` join `tbl_jurusan` `tj`) where (`tj`.`kd_jurusan` = `tr`.`kd_jurusan`) */;

/*View structure for view v_tbl_user */

/*!50001 DROP TABLE IF EXISTS `v_tbl_user` */;
/*!50001 DROP VIEW IF EXISTS `v_tbl_user` */;

/*!50001 CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `v_tbl_user` AS select `tu`.`id_user` AS `id_user`,`tu`.`nama_lengkap` AS `nama_lengkap`,`tu`.`username` AS `username`,`tu`.`password` AS `password`,`tu`.`id_level_user` AS `id_level_user`,`tu`.`foto` AS `foto`,`tlu`.`nama_level` AS `nama_level` from (`tbl_user` `tu` join `tbl_level_user` `tlu`) where (`tu`.`id_level_user` = `tlu`.`id_level_user`) */;

/*View structure for view v_walikelas */

/*!50001 DROP TABLE IF EXISTS `v_walikelas` */;
/*!50001 DROP VIEW IF EXISTS `v_walikelas` */;

/*!50001 CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `v_walikelas` AS select `g`.`nama_guru` AS `nama_guru`,`r`.`nama_rombel` AS `nama_rombel`,`w`.`id_walikelas` AS `id_walikelas`,`w`.`id_tahun_akademik` AS `id_tahun_akademik`,`j`.`nama_jurusan` AS `nama_jurusan`,`r`.`kelas` AS `kelas`,`ta`.`tahun_akademik` AS `tahun_akademik` from ((((`tbl_walikelas` `w` join `tbl_rombel` `r`) join `tbl_guru` `g`) join `tbl_jurusan` `j`) join `tbl_tahun_akademik` `ta`) where ((`w`.`id_guru` = `g`.`id_guru`) and (`w`.`id_rombel` = `r`.`id_rombel`) and (`j`.`kd_jurusan` = `r`.`kd_jurusan`) and (`ta`.`id_tahun_akademik` = `w`.`id_tahun_akademik`)) */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
