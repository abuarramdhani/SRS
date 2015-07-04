/*
SQLyog Community v12.03 (64 bit)
MySQL - 5.6.21 : Database - db_minimarket
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`db_minimarket` /*!40100 DEFAULT CHARACTER SET latin1 */;

USE `db_minimarket`;

/*Table structure for table `keluar_barang` */

DROP TABLE IF EXISTS `keluar_barang`;

CREATE TABLE `keluar_barang` (
  `id_keluar` int(10) NOT NULL AUTO_INCREMENT,
  `kode_keluar` varchar(100) DEFAULT NULL,
  `tgl_keluar` date DEFAULT NULL,
  `tipe_keluar` varchar(20) DEFAULT 'penjualan langsung',
  `pembayaran` int(30) DEFAULT NULL,
  `kembalian` int(30) DEFAULT NULL,
  PRIMARY KEY (`id_keluar`)
) ENGINE=InnoDB AUTO_INCREMENT=135 DEFAULT CHARSET=latin1;

/*Data for the table `keluar_barang` */

insert  into `keluar_barang`(`id_keluar`,`kode_keluar`,`tgl_keluar`,`tipe_keluar`,`pembayaran`,`kembalian`) values (129,'20150527001','2015-05-27','penjualan langsung',50,0),(130,'20150527002','2015-05-27','penjualan langsung',800000,0),(131,'20150527003','2015-05-27','penjualan langsung',500000,50000),(132,'20150527004','2015-05-27','penjualan langsung',500000,50000),(133,'20150527005','2015-05-27','penjualan langsung',500000,50000),(134,'20150528001','2015-05-28','penjualan langsung',500000,50000);

/*Table structure for table `rinci_keluar` */

DROP TABLE IF EXISTS `rinci_keluar`;

CREATE TABLE `rinci_keluar` (
  `id_keluar` int(10) NOT NULL AUTO_INCREMENT,
  `kode_keluar` varchar(100) DEFAULT NULL,
  `kd_barang` varchar(15) DEFAULT NULL,
  `nm_barang` varchar(30) NOT NULL,
  `satuan` varchar(30) NOT NULL,
  `kategori` varchar(30) NOT NULL,
  `deskripsi` text,
  `tgl_keluar` date DEFAULT NULL,
  `ukuran` varchar(10) DEFAULT NULL,
  `merk` varchar(29) DEFAULT NULL,
  `jumlah` int(20) DEFAULT NULL,
  `total` int(20) DEFAULT NULL,
  `harga` int(20) DEFAULT NULL,
  `pembayaran` int(30) DEFAULT NULL,
  `kembalian` int(30) DEFAULT NULL,
  PRIMARY KEY (`id_keluar`)
) ENGINE=InnoDB AUTO_INCREMENT=100 DEFAULT CHARSET=latin1;

/*Data for the table `rinci_keluar` */

insert  into `rinci_keluar`(`id_keluar`,`kode_keluar`,`kd_barang`,`nm_barang`,`satuan`,`kategori`,`deskripsi`,`tgl_keluar`,`ukuran`,`merk`,`jumlah`,`total`,`harga`,`pembayaran`,`kembalian`) values (94,'20150527001','009','Birning','','',NULL,NULL,NULL,NULL,1,450000,450000,NULL,NULL),(95,'20150527002','008','Daun toska','','',NULL,NULL,NULL,NULL,1,800000,800000,NULL,NULL),(96,'20150527003','009','Birning','','',NULL,NULL,NULL,NULL,1,450000,450000,NULL,NULL),(97,'20150527004','009','Birning','','',NULL,NULL,NULL,NULL,1,450000,450000,NULL,NULL),(98,'20150527005','009','Birning','','',NULL,NULL,NULL,NULL,1,450000,450000,NULL,NULL),(99,'20150528001','001','Toskaning','','',NULL,NULL,NULL,NULL,1,450000,450000,NULL,NULL);

/*Table structure for table `rinci_surat_jalan` */

DROP TABLE IF EXISTS `rinci_surat_jalan`;

CREATE TABLE `rinci_surat_jalan` (
  `id_rinci_surat_jalan` int(11) NOT NULL AUTO_INCREMENT,
  `no_surat_jalan` varchar(30) DEFAULT NULL,
  `kd_barang` varchar(30) DEFAULT NULL,
  `nm_barang` varchar(30) DEFAULT NULL,
  `jumlah` int(11) DEFAULT NULL,
  `harga` int(11) DEFAULT NULL,
  `sub_total_jual` int(11) DEFAULT NULL,
  `satuan` varchar(30) DEFAULT NULL,
  `kode_surat` varchar(30) DEFAULT NULL,
  `status_retur` int(3) DEFAULT '0',
  `ukuran` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id_rinci_surat_jalan`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

/*Data for the table `rinci_surat_jalan` */

insert  into `rinci_surat_jalan`(`id_rinci_surat_jalan`,`no_surat_jalan`,`kd_barang`,`nm_barang`,`jumlah`,`harga`,`sub_total_jual`,`satuan`,`kode_surat`,`status_retur`,`ukuran`) values (1,'SJ20150522001','','Toskaning',100,700000,70000000,'','aa/001',0,'K');

/*Table structure for table `rinci_surat_peminjaman` */

DROP TABLE IF EXISTS `rinci_surat_peminjaman`;

CREATE TABLE `rinci_surat_peminjaman` (
  `id_rinci_surat_peminjaman` int(11) NOT NULL AUTO_INCREMENT,
  `no_surat_peminjaman` varchar(30) DEFAULT NULL,
  `kd_barang` varchar(30) DEFAULT NULL,
  `nm_barang` varchar(30) DEFAULT NULL,
  `jumlah` int(11) DEFAULT NULL,
  `harga` int(11) DEFAULT NULL,
  `sub_total_jual` int(11) DEFAULT NULL,
  `satuan` varchar(30) DEFAULT NULL,
  `kode_surat` varchar(30) DEFAULT NULL,
  `status_retur` int(3) DEFAULT '0',
  `ukuran` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id_rinci_surat_peminjaman`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `rinci_surat_peminjaman` */

/*Table structure for table `rinci_surat_retur` */

DROP TABLE IF EXISTS `rinci_surat_retur`;

CREATE TABLE `rinci_surat_retur` (
  `id_rinci_surat_retur` int(11) NOT NULL AUTO_INCREMENT,
  `no_surat_peminjaman` varchar(30) DEFAULT NULL,
  `kd_barang` varchar(30) DEFAULT NULL,
  `nm_barang` varchar(30) DEFAULT NULL,
  `jumlah` int(11) DEFAULT NULL,
  `harga` int(11) DEFAULT NULL,
  `sub_total_jual` int(11) DEFAULT NULL,
  `satuan` varchar(30) DEFAULT NULL,
  `kode_surat` varchar(50) DEFAULT NULL,
  `ukuran` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id_rinci_surat_retur`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

/*Data for the table `rinci_surat_retur` */

insert  into `rinci_surat_retur`(`id_rinci_surat_retur`,`no_surat_peminjaman`,`kd_barang`,`nm_barang`,`jumlah`,`harga`,`sub_total_jual`,`satuan`,`kode_surat`,`ukuran`) values (1,'SJ20150523001','','Toskaning',10,NULL,NULL,'','001','Q');

/*Table structure for table `setting_toko` */

DROP TABLE IF EXISTS `setting_toko`;

CREATE TABLE `setting_toko` (
  `id_profile` int(11) NOT NULL AUTO_INCREMENT,
  `nama_toko` varchar(50) DEFAULT NULL,
  `alamat_toko` text,
  `logo_toko` varchar(100) DEFAULT NULL,
  `telepon` varchar(20) DEFAULT NULL,
  `fax` varchar(20) DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL,
  `kodepos` varchar(10) DEFAULT NULL,
  `hp` varchar(20) DEFAULT NULL,
  `kota` varchar(30) DEFAULT NULL,
  `website` varchar(30) DEFAULT NULL,
  PRIMARY KEY (`id_profile`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

/*Data for the table `setting_toko` */

insert  into `setting_toko`(`id_profile`,`nama_toko`,`alamat_toko`,`logo_toko`,`telepon`,`fax`,`email`,`kodepos`,`hp`,`kota`,`website`) values (1,'SURYA RAYA SENTOSA','Office Jl. Kelapa Gading Permai Blok A1/A2\nKelapa Gading Timur, Jakarta Utara','logo_aplikasi.png','02124520493','02124520493','admin@suryarayasentosa.com','-','-','Jakarta Utara','www.suryarayasentosa.com');

/*Table structure for table `surat_jalan` */

DROP TABLE IF EXISTS `surat_jalan`;

CREATE TABLE `surat_jalan` (
  `id_surat_jalan` int(11) NOT NULL AUTO_INCREMENT,
  `kode_surat_jalan` varchar(15) DEFAULT NULL,
  `id_user` varchar(20) DEFAULT NULL,
  `total_penjualan` int(11) DEFAULT NULL,
  `tgl_penjualan` date DEFAULT NULL,
  `kode_surat` varchar(100) DEFAULT NULL,
  `nama_pelanggan` varchar(100) DEFAULT NULL,
  `alamat` text,
  `telp` varchar(40) DEFAULT NULL,
  `ukuran` varchar(30) DEFAULT NULL,
  PRIMARY KEY (`id_surat_jalan`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

/*Data for the table `surat_jalan` */

insert  into `surat_jalan`(`id_surat_jalan`,`kode_surat_jalan`,`id_user`,`total_penjualan`,`tgl_penjualan`,`kode_surat`,`nama_pelanggan`,`alamat`,`telp`,`ukuran`) values (1,'SJ20150522001','admin',70000000,'2015-05-22','sra/001','','','',NULL);

/*Table structure for table `surat_peminjaman` */

DROP TABLE IF EXISTS `surat_peminjaman`;

CREATE TABLE `surat_peminjaman` (
  `id_surat_peminjaman` int(11) NOT NULL AUTO_INCREMENT,
  `kode_surat_peminjaman` varchar(15) DEFAULT NULL,
  `id_user` varchar(20) DEFAULT NULL,
  `total_peminjaman` int(11) DEFAULT NULL,
  `hapus` int(11) DEFAULT '0',
  `tgl_peminjaman` date DEFAULT NULL,
  `kode_surat` varchar(100) DEFAULT NULL,
  `nama_pelanggan` varchar(100) DEFAULT NULL,
  `alamat` text,
  `telp` varchar(40) DEFAULT NULL,
  `status_retur` int(3) DEFAULT '0',
  `ukuran` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id_surat_peminjaman`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

/*Data for the table `surat_peminjaman` */

insert  into `surat_peminjaman`(`id_surat_peminjaman`,`kode_surat_peminjaman`,`id_user`,`total_peminjaman`,`hapus`,`tgl_peminjaman`,`kode_surat`,`nama_pelanggan`,`alamat`,`telp`,`status_retur`,`ukuran`) values (2,'SJ20150523001','admin',100,0,'2015-05-23','001','DAVID','SALEMBA','02158278578',1,NULL);

/*Table structure for table `surat_retur` */

DROP TABLE IF EXISTS `surat_retur`;

CREATE TABLE `surat_retur` (
  `id_surat_retur` int(11) NOT NULL AUTO_INCREMENT,
  `no_surat_peminjaman` varchar(15) DEFAULT NULL,
  `id_user` varchar(20) DEFAULT NULL,
  `total_retur` int(11) DEFAULT NULL,
  `tgl_retur` date DEFAULT NULL,
  `kode_surat` varchar(100) DEFAULT NULL,
  `nama_pelanggan` varchar(100) DEFAULT NULL,
  `alamat` text,
  `telp` varchar(40) DEFAULT NULL,
  PRIMARY KEY (`id_surat_retur`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

/*Data for the table `surat_retur` */

insert  into `surat_retur`(`id_surat_retur`,`no_surat_peminjaman`,`id_user`,`total_retur`,`tgl_retur`,`kode_surat`,`nama_pelanggan`,`alamat`,`telp`) values (1,'SJ20150523001','admin',10,'2015-05-23','001','DAVID','SALEMBA','02158278578');

/*Table structure for table `tabel_barang` */

DROP TABLE IF EXISTS `tabel_barang`;

CREATE TABLE `tabel_barang` (
  `id_barang` int(11) NOT NULL AUTO_INCREMENT,
  `kd_barang` varchar(15) DEFAULT NULL,
  `nm_barang` varchar(30) NOT NULL,
  `kd_satuan` varchar(30) NOT NULL,
  `kd_kategori` varchar(30) NOT NULL,
  `hrg_jual` int(11) NOT NULL,
  `hrg_beli` int(11) NOT NULL,
  `deskripsi` text,
  `stok` int(11) DEFAULT '0',
  `diskon` varchar(20) DEFAULT '0',
  `tgl_masuk` date DEFAULT NULL,
  `dibeli` int(5) DEFAULT '0',
  `ukuran` varchar(10) DEFAULT NULL,
  `tipe` varchar(50) DEFAULT NULL,
  `merk` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`id_barang`),
  KEY `kd_satuan` (`kd_satuan`),
  KEY `kd_kategori` (`kd_kategori`),
  KEY `kd_satuan_2` (`kd_satuan`),
  KEY `kd_kategori_2` (`kd_kategori`),
  KEY `kd_kategori_3` (`kd_kategori`),
  FULLTEXT KEY `kd_kategori_4` (`kd_kategori`)
) ENGINE=InnoDB AUTO_INCREMENT=251 DEFAULT CHARSET=latin1;

/*Data for the table `tabel_barang` */

insert  into `tabel_barang`(`id_barang`,`kd_barang`,`nm_barang`,`kd_satuan`,`kd_kategori`,`hrg_jual`,`hrg_beli`,`deskripsi`,`stok`,`diskon`,`tgl_masuk`,`dibeli`,`ukuran`,`tipe`,`merk`) values (127,'001','Toskaning','','Bed Set',450000,0,'',3,'0','0000-00-00',0,'S',' Part II ',NULL),(128,'002','Toskaning','','Bed Set',700000,0,'',1,'0','0000-00-00',0,'Q',' Part II ',NULL),(129,'003','Toskaning','','Bed Set',700000,0,'',25,'0','0000-00-00',0,'K',' Part II ',NULL),(130,'004','Toskaning','','Bed Set',800000,0,'',5,'0','0000-00-00',0,'EK',' Part II ',NULL),(131,'005','Daun toska','','bed set',450000,0,NULL,3,'0',NULL,0,'S',' Part II ',NULL),(132,'006','Daun toska','','bed set',700000,0,NULL,15,'0',NULL,0,'Q',' Part II ',NULL),(133,'007','Daun toska','','bed set',700000,0,NULL,15,'0',NULL,0,'K',' Part II ',NULL),(134,'008','Daun toska','','bed set',800000,0,NULL,6,'0',NULL,0,'EK',' Part II ',NULL),(135,'009','Birning','','bed set',450000,0,NULL,5,'0',NULL,0,'S',' Part II ',NULL),(136,'010','Birning','','bed set',700000,0,NULL,8,'0',NULL,0,'Q',' Part II ',NULL),(137,'011','Birning','','bed set',700000,0,NULL,0,'0',NULL,0,'K',' Part II ',NULL),(138,'012','Birning','','bed set',800000,0,NULL,0,'0',NULL,0,'EK',' Part II ',NULL),(139,'013','Birpink','','bed set',450000,0,NULL,5,'0',NULL,0,'S',' Part II ',NULL),(140,'014','Birpink','','bed set',700000,0,NULL,4,'0',NULL,0,'Q',' Part II ',NULL),(141,'015','Birpink','','bed set',700000,0,NULL,26,'0',NULL,0,'K',' Part II ',NULL),(142,'016','Birpink','','bed set',800000,0,NULL,5,'0',NULL,0,'EK',' Part II ',NULL),(143,'017','Daun Pink','','bed set',450000,0,NULL,8,'0',NULL,0,'S',' Part II ',NULL),(144,'018','Daun Pink','','bed set',700000,0,NULL,16,'0',NULL,0,'Q',' Part II ',NULL),(145,'019','Daun Pink','','bed set',700000,0,NULL,11,'0',NULL,0,'K',' Part II ',NULL),(146,'020','Daun Pink','','bed set',800000,0,NULL,6,'0',NULL,0,'EK',' Part II ',NULL),(147,'021','Toskangu ','','bed set',450000,0,NULL,7,'0',NULL,0,'S',' Part II ',NULL),(148,'022','Toskangu ','','bed set',700000,0,NULL,15,'0',NULL,0,'Q',' Part II ',NULL),(149,'023','Toskangu ','','bed set',700000,0,NULL,15,'0',NULL,0,'K',' Part II ',NULL),(150,'024','Toskangu ','','bed set',800000,0,NULL,3,'0',NULL,0,'EK',' Part II ',NULL),(151,'025','Toskaning','','sprei',450000,0,NULL,10,'0',NULL,0,'S',' Part II ',NULL),(152,NULL,'Toskaning','','sprei',700000,0,NULL,16,'0',NULL,0,'Q',' Part II ',NULL),(153,NULL,'Toskaning','','sprei',700000,0,NULL,0,'0',NULL,0,'K',' Part II ',NULL),(154,NULL,'Toskaning','','sprei',800000,0,NULL,3,'0',NULL,0,'EK',' Part II ',NULL),(155,NULL,'Daun toska','','sprei',450000,0,NULL,15,'0',NULL,0,'S',' Part II ',NULL),(156,NULL,'Daun toska','','sprei',700000,0,NULL,2,'0',NULL,0,'Q',' Part II ',NULL),(157,NULL,'Daun toska','','sprei',700000,0,NULL,10,'0',NULL,0,'K',' Part II ',NULL),(158,NULL,'Daun toska','','sprei',800000,0,NULL,2,'0',NULL,0,'EK',' Part II ',NULL),(159,NULL,'Birning','','sprei',450000,0,NULL,7,'0',NULL,0,'S',' Part II ',NULL),(160,NULL,'Birning','','sprei',700000,0,NULL,9,'0',NULL,0,'Q',' Part II ',NULL),(161,NULL,'Birning','','sprei',700000,0,NULL,1,'0',NULL,0,'K',' Part II ',NULL),(162,NULL,'Birning','','sprei',800000,0,NULL,8,'0',NULL,0,'EK',' Part II ',NULL),(163,NULL,'Birpink','','sprei',450000,0,NULL,14,'0',NULL,0,'S',' Part II ',NULL),(164,NULL,'Birpink','','sprei',700000,0,NULL,11,'0',NULL,0,'Q',' Part II ',NULL),(165,NULL,'Birpink','','sprei',700000,0,NULL,1,'0',NULL,0,'K',' Part II ',NULL),(166,NULL,'Birpink','','sprei',800000,0,NULL,2,'0',NULL,0,'EK',' Part II ',NULL),(167,NULL,'Daunpink','','sprei',450000,0,NULL,9,'0',NULL,0,'S',' Part II ',NULL),(168,NULL,'Daunpink','','sprei',700000,0,NULL,0,'0',NULL,0,'Q',' Part II ',NULL),(169,NULL,'Daunpink','','sprei',700000,0,NULL,15,'0',NULL,0,'K',' Part II ',NULL),(170,NULL,'Daunpink','','sprei',800000,0,NULL,1,'0',NULL,0,'EK',' Part II ',NULL),(171,NULL,'Toskangu ','','sprei',450000,0,NULL,11,'0',NULL,0,'S',' Part II ',NULL),(172,NULL,'Toskangu ','','sprei',700000,0,NULL,1,'0',NULL,0,'Q',' Part II ',NULL),(173,NULL,'Toskangu ','','sprei',700000,0,NULL,10,'0',NULL,0,'K',' Part II ',NULL),(174,NULL,'Toskangu ','','sprei',800000,0,NULL,5,'0',NULL,0,'EK',' Part II ',NULL),(175,NULL,'Deraza','','bed set',450000,0,NULL,0,'0',NULL,0,'S',' Part II ',NULL),(176,NULL,'Deraza','','bed set',700000,0,NULL,35,'0',NULL,0,'Q',' Part II ',NULL),(177,NULL,'Deraza','','bed set',700000,0,NULL,25,'0',NULL,0,'K',' Part II ',NULL),(178,NULL,'Deraza','','bed set',800000,0,NULL,15,'0',NULL,0,'EK',' Part II ',NULL),(179,NULL,'Nitzania','','bed set',450000,0,NULL,0,'0',NULL,0,'S',' Part II ',NULL),(180,NULL,'Nitzania','','bed set',700000,0,NULL,30,'0',NULL,0,'Q',' Part II ',NULL),(181,NULL,'Nitzania','','bed set',700000,0,NULL,30,'0',NULL,0,'K',' Part II ',NULL),(182,NULL,'Nitzania','','bed set',800000,0,NULL,0,'0',NULL,0,'EK',' Part II ',NULL),(183,NULL,'Naira','','bed set',450000,0,NULL,0,'0',NULL,0,'S',' Part II ',NULL),(184,NULL,'Naira','','bed set',700000,0,NULL,30,'0',NULL,0,'Q',' Part II ',NULL),(185,NULL,'Naira','','bed set',700000,0,NULL,30,'0',NULL,0,'K',' Part II ',NULL),(186,NULL,'Naira','','bed set',0,0,NULL,0,'0',NULL,0,'EK',' Part II ',NULL),(187,NULL,'Naira','','sprei',175000,0,NULL,0,'0',NULL,0,'S',' Part II ',NULL),(188,NULL,'Naira','','sprei',225000,0,NULL,0,'0',NULL,0,'Q',' Part II ',NULL),(189,NULL,'Naira','','sprei',225000,0,NULL,75,'0',NULL,0,'K',' Part II ',NULL),(190,NULL,'Naira','','sprei',250000,0,NULL,21,'0',NULL,0,'EK',' Part II ',NULL),(191,NULL,'Deraza','','sprei',175000,0,NULL,0,'0',NULL,0,'S',' Part II ',NULL),(192,NULL,'Deraza','','sprei',225000,0,NULL,12,'0',NULL,0,'Q',' Part II ',NULL),(193,NULL,'Deraza','','sprei',225000,0,NULL,8,'0',NULL,0,'K',' Part II ',NULL),(194,NULL,'Deraza','','sprei',250000,0,NULL,41,'0',NULL,0,'EK',' Part II ',NULL),(195,NULL,'Nitzania','','sprei',175000,0,NULL,13,'0',NULL,0,'S',' Part II ',NULL),(196,NULL,'Nitzania','','sprei',225000,0,NULL,16,'0',NULL,0,'Q',' Part II ',NULL),(197,NULL,'Nitzania','','sprei',225000,0,NULL,6,'0',NULL,0,'K',' Part II ',NULL),(198,NULL,'Nitzania','','sprei',250000,0,NULL,0,'0',NULL,0,'EK',' Part II ',NULL),(199,NULL,'Nitkania','','sprei',175000,0,NULL,20,'0',NULL,0,'S',' Part II ',NULL),(200,NULL,'Nitkania','','sprei',225000,0,NULL,0,'0',NULL,0,'Q',' Part II ',NULL),(201,NULL,'Nitkania','','sprei',225000,0,NULL,0,'0',NULL,0,'K',' Part II ',NULL),(202,NULL,'Nitkania','','sprei',250000,0,NULL,0,'0',NULL,0,'EK',' Part II ',NULL),(203,'200043137664','Bantal','','',90000,0,'',100,'0','0000-00-00',0,'',' Part II ',NULL),(204,NULL,'Guling','','0',90000,0,NULL,100,'0',NULL,0,'',' Part II ',NULL),(205,NULL,'Mahyarenz ','','',700000,0,NULL,3,'0',NULL,0,'K','Part I',NULL),(206,NULL,'Mavina','','',700000,0,NULL,3,'0',NULL,0,'K','Part I',NULL),(207,NULL,'Mahyaredd','','',700000,0,NULL,1,'0',NULL,0,'Q','Part I',NULL),(208,NULL,'Dayana','','',700000,0,NULL,11,'0',NULL,0,'Q','Part I',NULL),(209,NULL,'Dayana','','',700000,0,NULL,16,'0',NULL,0,'K','Part I',NULL),(210,NULL,'Dayana','','',800000,0,NULL,9,'0',NULL,0,'EK','Part I',NULL),(211,NULL,'Desmond','','',450000,0,NULL,4,'0',NULL,0,'S','Part I',NULL),(212,NULL,'Desmond','','',700000,0,NULL,11,'0',NULL,0,'Q','Part I',NULL),(213,NULL,'Desmond','','',700000,0,NULL,22,'0',NULL,0,'K','Part I',NULL),(214,NULL,'Desmond','','',800000,0,NULL,8,'0',NULL,0,'EK','Part I',NULL),(215,NULL,'Monaco','','',450000,0,NULL,3,'0',NULL,0,'S','Part I',NULL),(216,NULL,'Maroko','','',450000,0,NULL,1,'0',NULL,0,'S','Part I',NULL),(217,NULL,'Maroko','','',700000,0,NULL,7,'0',NULL,0,'Q','Part I',NULL),(218,NULL,'Magenta','','',700000,0,NULL,2,'0',NULL,0,'K','Part I',NULL),(219,NULL,'Magenta','','',700000,0,NULL,4,'0',NULL,0,'Q','Part I',NULL),(220,NULL,'Daisy','','',700000,0,NULL,7,'0',NULL,0,'K','Part I',NULL),(221,NULL,'Dalila','','',700000,0,NULL,4,'0',NULL,0,'K','Part I',NULL),(222,NULL,'Minpink','','',700000,0,NULL,7,'0',NULL,0,'K','Part I',NULL),(223,NULL,'Magdalena','','',450000,0,NULL,0,'0',NULL,0,'S','Part I',NULL),(224,NULL,'Mahyacho','','',450000,0,NULL,0,'0',NULL,0,'S','Part I',NULL),(225,NULL,'Mahyacho','','',700000,0,NULL,24,'0',NULL,0,'Q','Part I',NULL),(226,NULL,'Mahyacho','','',700000,0,NULL,9,'0',NULL,0,'K','Part I',NULL),(227,NULL,'Kasur Lipat','','',700000,0,NULL,19,'0',NULL,0,'0','Part I',NULL),(228,NULL,'Selimut Anak','','',125000,0,NULL,72,'0',NULL,0,'0','Part I',NULL),(229,NULL,'Selimut Dewasa','','',150000,0,NULL,32,'0',NULL,0,'0','Part I',NULL),(230,NULL,'Sprei Aurora','','',500000,0,NULL,32,'0',NULL,0,'0','Part I',NULL),(231,NULL,'Sprei Anastasia','','',500000,0,NULL,33,'0',NULL,0,'0','Part I',NULL),(232,NULL,'Sprei Alenia','','',500000,0,NULL,29,'0',NULL,0,'0','Part I',NULL),(233,NULL,'Sprei Browner','','',150000,0,NULL,19,'0',NULL,0,'0','Part I',NULL),(234,'356474057200992','Bantal','','',90000,0,'',0,'0','0000-00-00',0,'49','Part I',NULL),(235,NULL,'Guling','','',90000,0,NULL,0,'0',NULL,0,'26','Part I',NULL),(236,NULL,'Bed Set Abigail','','',850000,0,NULL,7,'0',NULL,0,'0','Part I',NULL),(237,NULL,'Bed Set Anabele','','',850000,0,NULL,8,'0',NULL,0,'0','Part I',NULL),(238,NULL,'Bed Set Lixer','','',600000,0,NULL,10,'0',NULL,0,'0','Part I',NULL),(239,NULL,'Bed Set Linea','','',600000,0,NULL,9,'0',NULL,0,'0','Part I',NULL),(240,NULL,'Sprei Fania','','',200000,0,NULL,8,'0',NULL,0,'0','Part I',NULL),(241,NULL,'Sprei Lucy','','',200000,0,NULL,4,'0',NULL,0,'0','Part I',NULL),(242,NULL,'Freed Sprei','','',200000,0,NULL,1,'0',NULL,0,'0','Part I',NULL),(243,NULL,'Sprei Leona','','',200000,0,NULL,2,'0',NULL,0,'0','Part I',NULL),(244,NULL,'Sprei Felix','','',200000,0,NULL,9,'0',NULL,0,'0','Part I',NULL),(245,NULL,'Sprei Lufthansa','','',200000,0,NULL,4,'0',NULL,0,'0','Part I',NULL),(246,NULL,'Sprei fairus','','',200000,0,NULL,2,'0',NULL,0,'0','Part I',NULL),(247,NULL,'Sprei Fahira','','',200000,0,NULL,0,'0',NULL,0,'0','Part I',NULL),(248,NULL,'Bed Set Fidelia','','',600000,0,NULL,2,'0',NULL,0,'0','Part I',NULL),(249,NULL,'Kain Putih','','',0,0,NULL,1,'0',NULL,0,'0','Part I',NULL),(250,NULL,'Kain pink','','',0,0,NULL,1,'0',NULL,0,'0','Part I',NULL);

/*Table structure for table `tabel_kategori_barang` */

DROP TABLE IF EXISTS `tabel_kategori_barang`;

CREATE TABLE `tabel_kategori_barang` (
  `kd_kategori` int(11) NOT NULL AUTO_INCREMENT,
  `nm_kategori` varchar(25) NOT NULL,
  PRIMARY KEY (`kd_kategori`),
  KEY `kd_kategori` (`kd_kategori`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;

/*Data for the table `tabel_kategori_barang` */

insert  into `tabel_kategori_barang`(`kd_kategori`,`nm_kategori`) values (6,'Sprei'),(7,'Bed Set');

/*Table structure for table `tabel_pelanggan` */

DROP TABLE IF EXISTS `tabel_pelanggan`;

CREATE TABLE `tabel_pelanggan` (
  `id_pelanggan` int(11) NOT NULL AUTO_INCREMENT,
  `nama_pelanggan` varchar(100) DEFAULT NULL,
  `alamat` text,
  `telp` varchar(20) DEFAULT NULL,
  `hp` varchar(20) DEFAULT NULL,
  `email` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`id_pelanggan`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=latin1;

/*Data for the table `tabel_pelanggan` */

insert  into `tabel_pelanggan`(`id_pelanggan`,`nama_pelanggan`,`alamat`,`telp`,`hp`,`email`) values (1,'Arief Manggala Putra','BEkasi JAU AMAT','02188985958','',''),(2,'DAVID','SALEMBA','02158278578','-','-'),(8,'UNI','BEKASI','02188776','02199889','manggala.corp@gmail.'),(9,'arief','KEBUMEN','02324395939','787979','manggala.corp@gmail.'),(10,'DANI','WISMA ASRI','889029282','0299294','manggala.corp@gmail.');

/*Table structure for table `tabel_pembelian` */

DROP TABLE IF EXISTS `tabel_pembelian`;

CREATE TABLE `tabel_pembelian` (
  `id_pembelian` int(11) NOT NULL AUTO_INCREMENT,
  `no_faktur` varchar(50) NOT NULL,
  `kd_supplier` varchar(15) DEFAULT NULL,
  `tgl_pembelian` date NOT NULL,
  `id_user` varchar(10) NOT NULL,
  `total_pembelian` int(11) NOT NULL,
  `hapus` int(11) DEFAULT '0',
  PRIMARY KEY (`id_pembelian`),
  KEY `no_faktur` (`no_faktur`),
  KEY `no_faktur_2` (`no_faktur`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

/*Data for the table `tabel_pembelian` */

insert  into `tabel_pembelian`(`id_pembelian`,`no_faktur`,`kd_supplier`,`tgl_pembelian`,`id_user`,`total_pembelian`,`hapus`) values (1,'20150512001','SU0001','2015-05-12','admin',30000,1),(2,'20150512002','SU0001','2015-05-12','admin',4500000,0),(3,'20150512003','SU0001','2015-05-12','admin',30000,1),(4,'20150512004','SU0002','2015-05-12','admin',630000,1),(5,'PM20150514001','SU0001','2015-05-14','admin',30000,0);

/*Table structure for table `tabel_penjualan` */

DROP TABLE IF EXISTS `tabel_penjualan`;

CREATE TABLE `tabel_penjualan` (
  `id_penjualan` int(11) NOT NULL AUTO_INCREMENT,
  `no_faktur_penjualan` varchar(16) DEFAULT NULL,
  `tgl_penjualan` date NOT NULL,
  `id_user` varchar(10) NOT NULL,
  `total_penjualan` int(11) NOT NULL,
  `kode_surat` varchar(50) DEFAULT NULL,
  `nm_pelanggan` varchar(50) DEFAULT NULL,
  `alamat` text,
  `telp` int(11) DEFAULT NULL,
  `no_surat_peminjaman` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id_penjualan`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `tabel_penjualan` */

/*Table structure for table `tabel_rinci_pembelian` */

DROP TABLE IF EXISTS `tabel_rinci_pembelian`;

CREATE TABLE `tabel_rinci_pembelian` (
  `no_faktur_pembelian` varchar(16) NOT NULL,
  `kd_barang` varchar(15) NOT NULL,
  `nm_barang` varchar(30) NOT NULL,
  `satuan` varchar(25) NOT NULL,
  `jumlah` int(11) NOT NULL,
  `harga` int(11) NOT NULL,
  `sub_total_beli` int(11) NOT NULL,
  `hapus` int(11) DEFAULT '0',
  KEY `no_faktur_pembelian` (`no_faktur_pembelian`),
  KEY `no_faktur_pembelian_2` (`no_faktur_pembelian`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `tabel_rinci_pembelian` */

insert  into `tabel_rinci_pembelian`(`no_faktur_pembelian`,`kd_barang`,`nm_barang`,`satuan`,`jumlah`,`harga`,`sub_total_beli`,`hapus`) values ('PM20150514001','BR0001','TEH KOTAK','BOTOL',3,10000,30000,0);

/*Table structure for table `tabel_rinci_penjualan` */

DROP TABLE IF EXISTS `tabel_rinci_penjualan`;

CREATE TABLE `tabel_rinci_penjualan` (
  `id_faktur_penjualan` int(11) NOT NULL AUTO_INCREMENT,
  `no_faktur_penjualan` varchar(16) NOT NULL,
  `kd_barang` varchar(15) NOT NULL,
  `nm_barang` varchar(30) NOT NULL,
  `jumlah` int(11) NOT NULL,
  `harga` int(11) NOT NULL,
  `sub_total_jual` int(11) NOT NULL,
  `satuan` varchar(20) DEFAULT NULL,
  `kode_surat` varchar(30) DEFAULT NULL,
  `no_surat_peminjaman` varchar(30) DEFAULT NULL,
  `ukuran` varchar(30) DEFAULT NULL,
  PRIMARY KEY (`id_faktur_penjualan`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `tabel_rinci_penjualan` */

/*Table structure for table `tabel_satuan_barang` */

DROP TABLE IF EXISTS `tabel_satuan_barang`;

CREATE TABLE `tabel_satuan_barang` (
  `id_satuan` int(11) NOT NULL AUTO_INCREMENT,
  `nm_satuan` varchar(25) NOT NULL,
  PRIMARY KEY (`id_satuan`),
  KEY `id_satuan` (`id_satuan`),
  KEY `id_satuan_2` (`id_satuan`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

/*Data for the table `tabel_satuan_barang` */

insert  into `tabel_satuan_barang`(`id_satuan`,`nm_satuan`) values (6,'PCS');

/*Table structure for table `tabel_supplier` */

DROP TABLE IF EXISTS `tabel_supplier`;

CREATE TABLE `tabel_supplier` (
  `id_supplier` int(11) NOT NULL AUTO_INCREMENT,
  `kd_supplier` varchar(20) DEFAULT NULL,
  `nm_supplier` varchar(25) NOT NULL,
  `almt_supplier` varchar(150) NOT NULL,
  `tlp_supplier` varchar(15) NOT NULL,
  `fax_supplier` varchar(15) NOT NULL,
  `atas_nama` varchar(25) NOT NULL,
  PRIMARY KEY (`id_supplier`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

/*Data for the table `tabel_supplier` */

insert  into `tabel_supplier`(`id_supplier`,`kd_supplier`,`nm_supplier`,`almt_supplier`,`tlp_supplier`,`fax_supplier`,`atas_nama`) values (1,'SU0001','CV MANGGALA','Bekasi','0898989898','879897987','Arief Manggala'),(2,'SU0002','CV ANGIN PUTING BELIUNG','BEKASI','0898989898','009888','Arief Manggala');

/*Table structure for table `users` */

DROP TABLE IF EXISTS `users`;

CREATE TABLE `users` (
  `id_user` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `akses` varchar(50) DEFAULT NULL,
  `foto` varchar(200) DEFAULT NULL,
  PRIMARY KEY (`id_user`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=latin1;

/*Data for the table `users` */

insert  into `users`(`id_user`,`username`,`email`,`password`,`akses`,`foto`) values (16,'admin','manggala.corp@gmail.com','21232f297a57a5a743894a0e4a801fc3','admin','561114_143768209102549_218874235_n2.jpg');

/* Trigger structure for table `rinci_keluar` */

DELIMITER $$

/*!50003 DROP TRIGGER*//*!50032 IF EXISTS */ /*!50003 `stok_keluar_tambah` */$$

/*!50003 CREATE */ /*!50017 DEFINER = 'root'@'localhost' */ /*!50003 TRIGGER `stok_keluar_tambah` AFTER INSERT ON `rinci_keluar` FOR EACH ROW BEGIN
update tabel_barang set stok = stok-new.jumlah
where kd_barang = new.kd_barang;
    END */$$


DELIMITER ;

/* Trigger structure for table `rinci_keluar` */

DELIMITER $$

/*!50003 DROP TRIGGER*//*!50032 IF EXISTS */ /*!50003 `stok_keluar_delete` */$$

/*!50003 CREATE */ /*!50017 DEFINER = 'root'@'localhost' */ /*!50003 TRIGGER `stok_keluar_delete` AFTER DELETE ON `rinci_keluar` FOR EACH ROW BEGIN
update tabel_barang set stok = stok+old.jumlah
where kd_barang = old.kd_barang;
    END */$$


DELIMITER ;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
