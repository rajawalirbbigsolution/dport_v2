/*
 Navicat Premium Data Transfer

 Source Server         : localhost
 Source Server Type    : MySQL
 Source Server Version : 100414
 Source Host           : localhost:3306
 Source Schema         : db_pcr

 Target Server Type    : MySQL
 Target Server Version : 100414
 File Encoding         : 65001

 Date: 02/12/2020 14:38:03
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for ms_initial_event
-- ----------------------------
DROP TABLE IF EXISTS `ms_initial_event`;
CREATE TABLE `ms_initial_event` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `type_id` int(11) DEFAULT NULL,
  `kode_event` varchar(100) DEFAULT NULL,
  `tanggal_mulai` datetime DEFAULT NULL,
  `tanggal_selesai` datetime DEFAULT NULL,
  `jumlah_sample` int(11) DEFAULT NULL,
  `lokasi` varchar(45) DEFAULT NULL,
  `alamat` longtext DEFAULT NULL,
  `create_date` datetime DEFAULT NULL,
  `create_user` int(11) DEFAULT NULL,
  `update_date` datetime DEFAULT NULL,
  `update_user` int(11) DEFAULT NULL,
  `status` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  KEY `typecategory_id` (`type_id`) USING BTREE,
  CONSTRAINT `typecategory_id` FOREIGN KEY (`type_id`) REFERENCES `ms_type_category` (`id`) ON DELETE SET NULL ON UPDATE SET NULL
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of ms_initial_event
-- ----------------------------
BEGIN;
INSERT INTO `ms_initial_event` VALUES (1, 2, 'JAK1', '2020-11-10 13:30:00', '2020-11-21 23:00:00', 100, 'LOGIA', 'ZOMBIE', '2020-11-10 13:11:32', 2, NULL, NULL, 1);
INSERT INTO `ms_initial_event` VALUES (2, 1, '10000JAK', '2021-01-01 14:05:00', '2021-01-31 23:59:00', 1000, 'SAD', 'BOY', '2020-11-10 14:05:59', 2, '2020-11-23 15:05:08', 2, 1);
INSERT INTO `ms_initial_event` VALUES (3, 2, 'DNR2002', '2020-11-10 17:40:41', '2020-11-10 23:59:59', 1000, 'OLKS', 'OLKS', '2020-11-10 17:41:02', 2, NULL, NULL, 1);
INSERT INTO `ms_initial_event` VALUES (4, 1, 'GULLA', '2021-02-01 11:30:00', '2021-02-28 23:00:00', 1000, 'XI1', 'LOC', '2020-11-22 11:21:51', 2, '2020-11-23 15:05:15', 2, 1);
COMMIT;

-- ----------------------------
-- Table structure for ms_initial_printer
-- ----------------------------
DROP TABLE IF EXISTS `ms_initial_printer`;
CREATE TABLE `ms_initial_printer` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `initialevent_id` int(11) DEFAULT NULL,
  `printer_id` int(11) DEFAULT NULL,
  `koordinat_longitude` varchar(45) DEFAULT NULL,
  `koordinat_latitude` varchar(45) DEFAULT NULL,
  `create_date` datetime DEFAULT NULL,
  `create_user` int(11) DEFAULT NULL,
  `update_date` datetime DEFAULT NULL,
  `update_user` int(11) DEFAULT NULL,
  `status` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  KEY `initialevent_id2` (`initialevent_id`) USING BTREE,
  KEY `printer_id2` (`printer_id`) USING BTREE,
  CONSTRAINT `initialevent_id2` FOREIGN KEY (`initialevent_id`) REFERENCES `ms_initial_event` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `printer_id2` FOREIGN KEY (`printer_id`) REFERENCES `ms_printer` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of ms_initial_printer
-- ----------------------------
BEGIN;
INSERT INTO `ms_initial_printer` VALUES (3, 1, 1, '123223', '123333', '2020-11-10 13:24:30', 2, NULL, NULL, 1);
INSERT INTO `ms_initial_printer` VALUES (4, 1, 2, '123', '123', '2020-11-10 13:24:37', 2, NULL, NULL, 1);
INSERT INTO `ms_initial_printer` VALUES (5, 1, 1, '123', '123', '2020-11-10 14:02:34', 2, NULL, NULL, 0);
INSERT INTO `ms_initial_printer` VALUES (6, 1, 2, '213', '123', '2020-11-10 14:05:09', 2, NULL, NULL, 0);
INSERT INTO `ms_initial_printer` VALUES (7, 2, 1, '21', '12', '2020-11-10 17:19:07', 2, NULL, NULL, 1);
INSERT INTO `ms_initial_printer` VALUES (8, 2, 2, '12', '12', '2020-11-23 14:07:44', 2, NULL, NULL, 1);
INSERT INTO `ms_initial_printer` VALUES (9, 2, 3, '123', '123', '2020-11-23 14:08:41', 2, NULL, NULL, 1);
COMMIT;

-- ----------------------------
-- Table structure for ms_initial_user
-- ----------------------------
DROP TABLE IF EXISTS `ms_initial_user`;
CREATE TABLE `ms_initial_user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `initialevent_id` int(11) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `create_date` datetime DEFAULT NULL,
  `create_user` int(11) DEFAULT NULL,
  `update_date` datetime DEFAULT NULL,
  `update_user` int(11) DEFAULT NULL,
  `status` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  KEY `user_id3` (`user_id`) USING BTREE,
  KEY `initialevent_id3` (`initialevent_id`) USING BTREE,
  CONSTRAINT `initialevent_id3` FOREIGN KEY (`initialevent_id`) REFERENCES `ms_initial_event` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `user_id3` FOREIGN KEY (`user_id`) REFERENCES `ms_user` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of ms_initial_user
-- ----------------------------
BEGIN;
INSERT INTO `ms_initial_user` VALUES (1, 2, 2, '2020-11-10 17:31:47', 2, NULL, NULL, 0);
INSERT INTO `ms_initial_user` VALUES (2, 2, 7, '2020-11-10 17:33:12', 2, NULL, NULL, 0);
INSERT INTO `ms_initial_user` VALUES (3, 3, 2, '2020-11-10 17:41:07', 2, NULL, NULL, 0);
INSERT INTO `ms_initial_user` VALUES (4, 3, 2, '2020-11-10 17:42:25', 2, NULL, NULL, 0);
INSERT INTO `ms_initial_user` VALUES (5, 2, 2, '2020-11-11 13:28:00', 2, NULL, NULL, 1);
INSERT INTO `ms_initial_user` VALUES (6, 3, 2, '2020-11-11 13:28:18', 2, NULL, NULL, 0);
INSERT INTO `ms_initial_user` VALUES (7, 3, 2, '2020-11-21 16:52:34', 2, NULL, NULL, 1);
INSERT INTO `ms_initial_user` VALUES (8, 1, 8, '2020-11-27 22:58:19', 2, NULL, NULL, 1);
COMMIT;

-- ----------------------------
-- Table structure for ms_invoice
-- ----------------------------
DROP TABLE IF EXISTS `ms_invoice`;
CREATE TABLE `ms_invoice` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `untuk_pembayaran` varchar(45) DEFAULT NULL,
  `nama_lengkap_signature` varchar(45) DEFAULT NULL,
  `filename_signature` varchar(45) DEFAULT NULL,
  `catatan` longtext DEFAULT NULL,
  `create_date` datetime DEFAULT NULL,
  `create_user` int(11) DEFAULT NULL,
  `update_date` datetime DEFAULT NULL,
  `update_user` int(11) DEFAULT NULL,
  `status` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of ms_invoice
-- ----------------------------
BEGIN;
INSERT INTO `ms_invoice` VALUES (1, 'LANGSUNG', 'QOLBY', '', '123', '2020-11-10 18:20:27', 2, '2020-11-25 14:54:13', 2, 1);
INSERT INTO `ms_invoice` VALUES (2, 'LANGSUNG', 'ZOROZ', '', 'ZX', '2020-11-25 14:47:44', 2, '2020-11-25 14:54:00', 2, 1);
COMMIT;

-- ----------------------------
-- Table structure for ms_kategori
-- ----------------------------
DROP TABLE IF EXISTS `ms_kategori`;
CREATE TABLE `ms_kategori` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nama_kategori` varchar(45) DEFAULT '',
  `deskripsi` varchar(45) DEFAULT NULL,
  `create_date` datetime DEFAULT NULL,
  `create_user` int(11) DEFAULT NULL,
  `update_date` datetime DEFAULT NULL,
  `update_user` int(11) DEFAULT NULL,
  `status` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of ms_kategori
-- ----------------------------
BEGIN;
INSERT INTO `ms_kategori` VALUES (1, 'GRUP / INSTANSI', 'GRUP', '2020-11-10 13:09:31', 2, '2020-11-21 14:32:47', 2, 1);
INSERT INTO `ms_kategori` VALUES (2, 'PERORANG', 'PERORANG', '2020-11-10 13:09:39', 2, '2020-11-21 14:33:02', 2, 1);
INSERT INTO `ms_kategori` VALUES (3, 'HOME SERVICE', 'HOME SERVICE', '2020-11-21 14:33:18', 2, NULL, NULL, 1);
COMMIT;

-- ----------------------------
-- Table structure for ms_module
-- ----------------------------
DROP TABLE IF EXISTS `ms_module`;
CREATE TABLE `ms_module` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `create_user` int(11) NOT NULL,
  `created_date` timestamp NOT NULL DEFAULT current_timestamp(),
  `update_user` int(11) DEFAULT NULL,
  `updated_date` timestamp NULL DEFAULT NULL,
  `module_name` varchar(100) NOT NULL,
  `module_url` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of ms_module
-- ----------------------------
BEGIN;
INSERT INTO `ms_module` VALUES (1, 2, '2020-10-19 19:50:19', 2, '2020-11-09 13:31:25', ' INITIAL EVENT PCR', 'EventPcr');
INSERT INTO `ms_module` VALUES (2, 2, '2020-10-19 19:51:15', NULL, NULL, 'MASTER PCR PRINTER', 'Pcrprinter');
INSERT INTO `ms_module` VALUES (3, 2, '2020-10-19 19:51:30', NULL, NULL, 'MASTER USER', 'Users');
INSERT INTO `ms_module` VALUES (4, 2, '2020-10-19 19:51:42', NULL, NULL, 'MASTER ROLE', 'Role');
INSERT INTO `ms_module` VALUES (5, 2, '2020-10-20 10:50:11', NULL, NULL, 'MASTER MODULE', 'Module');
INSERT INTO `ms_module` VALUES (6, 2, '2020-10-20 10:52:30', NULL, NULL, 'MASTER', NULL);
INSERT INTO `ms_module` VALUES (7, 2, '2020-10-20 11:01:49', 2, '2020-10-21 10:15:27', 'MASTER PCR PRINTER', 'IdPrinter');
INSERT INTO `ms_module` VALUES (8, 2, '2020-10-20 22:27:31', 2, '2020-10-27 09:35:51', 'MASTER MODULE LINK', 'ModuleLink');
INSERT INTO `ms_module` VALUES (9, 2, '2020-10-21 15:00:49', NULL, NULL, 'MASTER INVOICE', 'Invoice');
INSERT INTO `ms_module` VALUES (10, 2, '2020-10-27 09:35:18', NULL, NULL, 'MASTER KATEGORI EVENT', 'KategoriEvent');
INSERT INTO `ms_module` VALUES (11, 2, '2020-10-27 09:35:34', NULL, NULL, 'MASTER KATEGORI TEST', 'KategoriTest');
INSERT INTO `ms_module` VALUES (12, 2, '2020-11-11 13:32:03', NULL, NULL, 'PAYMENT MODULE', NULL);
INSERT INTO `ms_module` VALUES (13, 2, '2020-11-11 13:43:22', NULL, NULL, 'BUKTI PEMBAYARAN', 'BuktiPembayaran');
INSERT INTO `ms_module` VALUES (14, 2, '2020-11-12 15:55:32', NULL, NULL, 'REGISTRASI MOBILE', 'RegistrationMobile');
INSERT INTO `ms_module` VALUES (15, 2, '2020-11-12 15:55:51', NULL, NULL, 'REGISTRASI WEBSITE', 'RegistrationWeb');
INSERT INTO `ms_module` VALUES (16, 2, '2020-11-22 14:01:20', NULL, NULL, 'Report', 'Report');
INSERT INTO `ms_module` VALUES (17, 2, '2020-11-22 20:33:37', NULL, NULL, 'Upload Hasil PCR', 'UploadHasilPCR');
INSERT INTO `ms_module` VALUES (19, 2, '2020-11-27 21:20:57', NULL, NULL, 'SAMPEL DATA', 'Sample');
INSERT INTO `ms_module` VALUES (20, 2, '2020-12-01 11:42:24', NULL, NULL, 'MASTER PRINTER', 'Printer');
COMMIT;

-- ----------------------------
-- Table structure for ms_module_link
-- ----------------------------
DROP TABLE IF EXISTS `ms_module_link`;
CREATE TABLE `ms_module_link` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `create_user` int(11) NOT NULL,
  `created_date` timestamp NOT NULL DEFAULT current_timestamp(),
  `update_user` int(11) DEFAULT NULL,
  `updated_date` timestamp NULL DEFAULT NULL,
  `role_id` int(11) NOT NULL,
  `module_id` int(11) NOT NULL,
  `order` int(11) NOT NULL,
  `is_parent` int(11) NOT NULL,
  `status` int(11) NOT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  KEY `ms_module_link_FK` (`role_id`) USING BTREE,
  KEY `ms_module_link_FK_1` (`module_id`) USING BTREE,
  CONSTRAINT `ms_module_link_ibfk_1` FOREIGN KEY (`role_id`) REFERENCES `ms_role` (`id`),
  CONSTRAINT `ms_module_link_ibfk_2` FOREIGN KEY (`module_id`) REFERENCES `ms_module` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of ms_module_link
-- ----------------------------
BEGIN;
INSERT INTO `ms_module_link` VALUES (1, 2, '2020-10-20 10:53:32', 2, '2020-12-01 11:43:46', 1, 1, 10, 1, 1);
INSERT INTO `ms_module_link` VALUES (2, 2, '2020-10-20 10:53:32', 2, '2020-12-01 11:43:46', 1, 6, 20, 1, 1);
INSERT INTO `ms_module_link` VALUES (3, 2, '2020-10-20 10:53:32', 2, '2020-10-21 10:15:13', 1, 2, 30, 0, 0);
INSERT INTO `ms_module_link` VALUES (4, 2, '2020-10-20 10:53:32', 2, '2020-12-01 11:43:47', 1, 5, 70, 0, 1);
INSERT INTO `ms_module_link` VALUES (5, 2, '2020-10-20 10:53:32', 2, '2020-12-01 11:43:46', 1, 4, 50, 0, 1);
INSERT INTO `ms_module_link` VALUES (6, 2, '2020-10-20 10:53:32', 2, '2020-12-01 11:43:46', 1, 3, 60, 0, 1);
INSERT INTO `ms_module_link` VALUES (7, 2, '2020-10-20 11:02:10', 2, '2020-10-20 11:02:15', 1, 7, 70, 0, 0);
INSERT INTO `ms_module_link` VALUES (8, 2, '2020-10-20 11:03:00', 2, '2020-11-30 10:21:06', 1, 7, 40, 0, 0);
INSERT INTO `ms_module_link` VALUES (9, 2, '2020-10-20 22:28:19', 2, '2020-12-01 11:43:47', 1, 8, 80, 0, 1);
INSERT INTO `ms_module_link` VALUES (10, 2, '2020-10-21 15:01:07', 2, '2020-12-01 11:43:47', 1, 9, 90, 0, 1);
INSERT INTO `ms_module_link` VALUES (11, 2, '2020-10-27 09:37:43', 2, '2020-12-01 11:43:46', 1, 10, 41, 0, 1);
INSERT INTO `ms_module_link` VALUES (12, 2, '2020-10-27 09:37:43', 2, '2020-12-01 11:43:46', 1, 11, 42, 0, 1);
INSERT INTO `ms_module_link` VALUES (13, 2, '2020-11-11 13:32:27', 2, '2020-12-01 11:43:47', 1, 12, 100, 1, 1);
INSERT INTO `ms_module_link` VALUES (14, 2, '2020-11-11 13:44:07', 2, '2020-12-01 11:43:47', 1, 13, 110, 0, 1);
INSERT INTO `ms_module_link` VALUES (15, 2, '2020-11-12 15:56:17', 2, '2020-12-01 11:43:47', 1, 14, 120, 1, 1);
INSERT INTO `ms_module_link` VALUES (16, 2, '2020-11-12 15:56:33', 2, '2020-12-01 11:43:47', 1, 15, 130, 1, 1);
INSERT INTO `ms_module_link` VALUES (17, 2, '2020-11-22 14:01:32', 2, '2020-12-01 11:43:47', 1, 16, 140, 1, 1);
INSERT INTO `ms_module_link` VALUES (18, 2, '2020-11-22 20:33:56', 2, '2020-12-01 11:43:47', 1, 17, 150, 1, 1);
INSERT INTO `ms_module_link` VALUES (19, 2, '2020-11-27 21:21:40', 2, '2020-12-01 11:43:47', 1, 19, 160, 1, 1);
INSERT INTO `ms_module_link` VALUES (20, 2, '2020-12-01 11:43:00', 2, '2020-12-01 11:43:47', 1, 20, 81, 0, 1);
COMMIT;

-- ----------------------------
-- Table structure for ms_pasien
-- ----------------------------
DROP TABLE IF EXISTS `ms_pasien`;
CREATE TABLE `ms_pasien` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nama_lengkap` varchar(45) DEFAULT NULL,
  `no_ktp` varchar(20) DEFAULT NULL,
  `tanggal_lahir` date DEFAULT NULL,
  `jenis_kelamin` varchar(10) DEFAULT NULL,
  `filename_ktp` varchar(45) DEFAULT NULL,
  `no_passport` varchar(20) DEFAULT NULL,
  `no_handphone` varchar(15) DEFAULT NULL,
  `email` varchar(45) DEFAULT NULL,
  `alamat` longtext DEFAULT NULL,
  `create_date` datetime DEFAULT NULL,
  `create_user` int(11) DEFAULT NULL,
  `update_date` datetime DEFAULT NULL,
  `update_user` int(11) DEFAULT NULL,
  `status` int(11) DEFAULT NULL,
  `password` varchar(200) DEFAULT NULL,
  `token` varchar(200) DEFAULT NULL,
  `image_user` varchar(200) DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=83 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of ms_pasien
-- ----------------------------
BEGIN;
INSERT INTO `ms_pasien` VALUES (20, 'Sad ', '124555555', '1994-02-19', 'Laki-Laki', 'user28.jpg', 'qw123', '082390259183', 'email@mail.com', 'jalan satriao', NULL, NULL, '2020-11-27 21:04:08', 2, 1, 'e10adc3949ba59abbe56e057f20f883e', 'wXdoTLImIaXUrja2', NULL);
INSERT INTO `ms_pasien` VALUES (21, 'rojak saputra', '124555555', '1994-02-19', 'LAKI-LAKI', 'user30.jpg', 'qw123', '0878455', 'email@mail.com', 'jalan satriao', NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL);
INSERT INTO `ms_pasien` VALUES (22, 'Qolby Yostra Evant Adha', '1704031404970004', '1997-11-14', 'Laki-Laki', NULL, NULL, '082282123540', 'skripsisandra.unib@gmail.com', '123', '2020-11-24 11:53:27', 2, NULL, NULL, 1, NULL, NULL, NULL);
INSERT INTO `ms_pasien` VALUES (23, 'rojak saputra111', '124555555232', '1994-02-19', 'LAKI-LAKI', 'user31.jpg', 'qw123', '087845511', 'email@mail.com', 'jalan satriao', NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL);
INSERT INTO `ms_pasien` VALUES (24, '123a', '12312381238', '2020-11-06', 'Laki-Laki', NULL, NULL, '1231200123', '123@gmail.com', 'zzzz', '2020-11-24 12:00:43', 2, NULL, NULL, 1, NULL, NULL, NULL);
INSERT INTO `ms_pasien` VALUES (25, 'rojak saputra222', '124555555232', '1994-02-19', 'LAKI-LAKI', 'user32.jpg', 'qw123', '087845511', 'email@mail.com', 'jalan satriao', NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL);
INSERT INTO `ms_pasien` VALUES (26, 'rojak saputra222', '124555555232', '1997-02-19', 'LAKI-LAKI', 'user33.jpg', 'qw123', '087845511', 'email@mail.com', 'jalan satriao', NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL);
INSERT INTO `ms_pasien` VALUES (27, 'rojak saputra222', '124555555232', '1997-02-19', 'LAKI-LAKI', 'user34.jpg', 'qw123', '087845511', 'email@mail.com', 'jalan satriao', NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL);
INSERT INTO `ms_pasien` VALUES (28, 'dicdoank', '123644789', '1904-04-01', 'Laki-laki', '6d5060861b03f1d7dd6cdce45f9138c9.jpg', '3434afafa', NULL, 'sidik@mail.com', 'kedoya', NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL);
INSERT INTO `ms_pasien` VALUES (29, 'nama', 'ktp', '2020-11-11', 'Laki-laki', NULL, 'passport', 'handphone', 'email', 'alamat', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `ms_pasien` VALUES (30, 'aefeafwef', '4343243', '2020-11-25', 'Laki-laki', NULL, 'sdfsdfsdff', '434234', 'ewefef', 'dsfdsfdsfdsfsdf', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `ms_pasien` VALUES (31, 'Not To Be Okay', '12312381238123111', '1997-11-25', 'Laki-Laki', NULL, NULL, '08228212340', 'asd@gmail.xom', '-', '2020-11-25 15:24:21', 2, NULL, NULL, 1, NULL, NULL, NULL);
INSERT INTO `ms_pasien` VALUES (32, 'shidik', '0931234141', '2020-11-25', 'Laki-laki', NULL, '0e9r8qrq', '0215555', 'sy@mail.com', 'kedoya selatan', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `ms_pasien` VALUES (33, 'sidik', '324124', '2020-11-25', 'Laki-laki', NULL, 'e32141', '021555', 'dsd', 'kedoya', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `ms_pasien` VALUES (34, 'gfgg', '444', '2020-11-25', 'Laki-laki', NULL, 'hrthrt', 'gge54', 'hgh', 'rtyrtyrt', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `ms_pasien` VALUES (35, 'afa', 'dsad3432', '2020-11-25', 'Laki-laki', NULL, '43423', '432423', 'vdvsdv', 'vzdvsdvs', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `ms_pasien` VALUES (36, 'sss', '0099343', '2020-11-25', 'Laki-laki', NULL, '545435', '092821', 'mu@mail.com', 'vxcvxvxcvx', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `ms_pasien` VALUES (37, 'Baby', '0000028282', '1997-10-31', 'Perempuan', NULL, NULL, '08123', 'asd@gmail.xom', '12', '2020-11-25 16:07:12', 2, NULL, NULL, 1, NULL, NULL, NULL);
INSERT INTO `ms_pasien` VALUES (38, 'muhama', '43525', '2020-11-25', 'Laki-laki', NULL, '423432', '43123', 'm@mail.com', 'fdfdsafsdf', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `ms_pasien` VALUES (39, 'dasfafa', 'fafas', '2020-11-25', 'Laki-laki', NULL, 'fafaf', 'fafaf', 'dasfasf', 'fafafasfafaf', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `ms_pasien` VALUES (40, 'ssss', '25588', '2020-11-25', 'Laki-laki', NULL, 'hhhh', '2555', 'fdfdfd', 'dsdsd', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `ms_pasien` VALUES (41, 'erwerewrewrew', '4324234234', '2020-11-25', 'Laki-laki', NULL, 'fsdfsdfsd', '66666', 'ffsdfdsfsdf', 'fsfsdfsdfsdfsdf', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `ms_pasien` VALUES (42, 'Hard', '44444', '1997-11-06', 'Laki-Laki', NULL, NULL, '1231200123', 'asd@gmail.xom', '21', '2020-11-25 18:30:15', 2, NULL, NULL, 1, NULL, NULL, NULL);
INSERT INTO `ms_pasien` VALUES (43, 'Qolby Adha', '123123812380000', '1998-11-05', 'Laki-Laki', NULL, NULL, '0822821235401', 'asd@gmail.xom', '123', '2020-11-25 20:41:40', 2, NULL, NULL, 1, NULL, NULL, NULL);
INSERT INTO `ms_pasien` VALUES (44, 'QOLBY YOSTRA EVANT ADHA', '170403140497000412', '1997-11-21', 'Perempuan', NULL, '123', '02155886633', 'asd@gmail.xom', '123', '2020-11-25 20:47:03', 2, NULL, NULL, 1, NULL, NULL, NULL);
INSERT INTO `ms_pasien` VALUES (45, '123', '12312381238123111123', '2020-11-26', 'Laki-Laki', NULL, '123', '08228212340', 'asd@gmail.xom', '123', '2020-11-25 20:57:38', 2, NULL, NULL, 1, NULL, NULL, NULL);
INSERT INTO `ms_pasien` VALUES (46, '123', '12312381238123111123', '2020-11-26', 'Laki-Laki', '3VLoZZgo_400x400.jpg', '123', '08228212340', 'asd@gmail.xom', '123', '2020-11-25 20:58:30', 2, NULL, NULL, 1, NULL, NULL, NULL);
INSERT INTO `ms_pasien` VALUES (47, 'vitamin', '444444', '1999-02-19', 'LAKI-LAKI', NULL, '44444433', '088888888', 'email1@mail.com', 'jalan satriao', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `ms_pasien` VALUES (48, 'zoro', '2800012', '0000-00-00', '-', NULL, NULL, '82238', '91231@gmail.com', 'Laki-Laki', '2020-11-26 14:41:48', 2, NULL, NULL, 1, NULL, NULL, NULL);
INSERT INTO `ms_pasien` VALUES (49, 'vitamin11', '444444111', '1998-02-19', 'LAKI-LAKI', NULL, '4444443311', '08888888811', 'email111@mail.com', 'jalan satriao', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `ms_pasien` VALUES (50, 'vitamin11', '444444111', '1998-02-19', 'LAKI-LAKI', NULL, '4444443311', '08888888811', 'email111@mail.com', 'jalan satriao', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `ms_pasien` VALUES (51, 'vitamin11', '444444111', '1998-02-19', 'LAKI-LAKI', NULL, '4444443311', '08888888811', 'email111@mail.com', 'jalan satriao', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `ms_pasien` VALUES (52, 'nama', '123123', '2020-11-11', 'Laki-laki', NULL, '12312312', '123123', 'email@email.com', 'alamat', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `ms_pasien` VALUES (53, 'nama', '5464434', '1995-01-31', 'Laki-laki', NULL, 'passport', '0845734915', 'email', 'alamat', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `ms_pasien` VALUES (54, 'nama', '5464434', '1995-01-31', 'Laki-laki', NULL, 'passport', '0845734915', 'email', 'alamat', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `ms_pasien` VALUES (55, 'hrhnfr', '211655', '2020-11-05', 'Laki-laki', NULL, 'passrjjg', '8555896', 'enfrivd', 'alanshhvty', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `ms_pasien` VALUES (56, 'acyhri', '123', '2020-11-11', 'Laki-laki', NULL, 'ibryjcd', '085252', 'rhndjj', 'fgmfigdf', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `ms_pasien` VALUES (57, 'acyhri', '123', '2020-11-11', 'Laki-laki', NULL, 'ibryjcd', '085252', 'rhndjj', 'fgmfigdf', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `ms_pasien` VALUES (58, 'yghhhhhu', '666666', '2020-11-05', 'Perempuan', NULL, 'jurktgy', '695874588', 'tgfgjuh', 'yhbrgkhgr', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `ms_pasien` VALUES (59, 'uhjrtjgf', '588425555', '2020-11-05', 'Perempuan', NULL, 'hhffkgrjrf', '66228052', 'hyygdfjff', 'hhdfncdjjgd', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `ms_pasien` VALUES (60, 'gcf', '336665', '2020-11-26', 'Laki-laki', NULL, 'ghnkk', '35526', 'fgbh', 'gccb', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `ms_pasien` VALUES (61, 'shahaah', '494949', '2020-11-26', 'Laki-laki', NULL, 'sjsshs', '494949', 'sbsbsbs', 'shshshshs', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `ms_pasien` VALUES (68, 'ahahas', '1651', '2020-11-26', 'Laki-laki', NULL, 'zjzzjz', '76767', 'zhZhz', 'zyzzyzus', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `ms_pasien` VALUES (69, 'BabHshs', '446464', '2020-11-26', 'Laki-laki', NULL, 'zhHz', '76767', 'zbzhzz', 'BBHH', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `ms_pasien` VALUES (70, 'sbsshs', '45454', '2020-11-26', 'Laki-laki', NULL, 'zhzshs', '494464', 'zhzzhss', 'zhsshshs', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `ms_pasien` VALUES (71, 'zoro21', '123098', '2000-01-01', 'Laki-Laki', NULL, '-', '82238', '91231@gmail.com', 'asdasd', '2020-11-26 18:31:37', 2, NULL, NULL, 1, NULL, NULL, NULL);
INSERT INTO `ms_pasien` VALUES (72, 'zoro23', '12340988', '1997-01-02', 'Laki-Laki', NULL, '-', '82238', '91231@gmail.com', 'asdasd', '2020-11-26 18:31:37', 2, NULL, NULL, 1, NULL, NULL, NULL);
INSERT INTO `ms_pasien` VALUES (73, '123123zoro34', '1239767123123123123', '2000-01-03', 'Perempuan', 'IMG201808120617052.jpg', '-', '82238123123', '91231123@gmail.com', 'asdasd123', '2020-11-26 18:31:37', 2, '2020-11-27 13:56:29', 2, 1, NULL, NULL, NULL);
INSERT INTO `ms_pasien` VALUES (74, 'Run', '1100001010101', '1994-11-03', 'Laki-Laki', 'IMG20180812061705.jpg', '123', '1231200123', 'asd@gmail.xom', '123', '2020-11-26 18:33:55', 2, NULL, NULL, 1, NULL, NULL, NULL);
INSERT INTO `ms_pasien` VALUES (75, 'vitamin11', '444444111', '1998-02-19', 'LAKI-LAKI', NULL, '4444443311', '08888888811', 'email111@mail.com', 'jalan satriao', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `ms_pasien` VALUES (76, 'ababa', '4946', '2020-11-26', 'Laki-laki', NULL, 'sjhs', '46464', 'Bzjsjz', 'shzshsjs', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `ms_pasien` VALUES (77, 'Monsters and Man', '9000123', '1997-11-07', 'Laki-Laki', 'IMG201808120617051.jpg', '-', '0822821235401', 'asd@gmail.xom', '12', '2020-11-27 10:01:44', 2, NULL, NULL, 1, NULL, NULL, NULL);
INSERT INTO `ms_pasien` VALUES (78, 'if world was ending', '002123', '1997-11-21', 'Laki-Laki', 'IMG20180812062755.jpg', '-', '123', 'asd@gmail.xom', 'North Blue', '2020-11-27 10:06:29', 2, NULL, NULL, 1, NULL, NULL, NULL);
INSERT INTO `ms_pasien` VALUES (79, 'zoro34', '1239767', '2000-01-03', 'Laki-Laki', NULL, '-', '82238', '91231@gmail.com', 'asdasd', '2020-11-27 13:58:27', 2, NULL, NULL, 1, NULL, NULL, NULL);
INSERT INTO `ms_pasien` VALUES (80, 'Little Talkx', '12312381238123123', '2020-12-01', 'Perempuan', '24daj542403x0hi1.jpg', NULL, '082282123540', 'asd@gmail.xom', '123', '2020-12-01 11:45:15', 2, NULL, NULL, 9, NULL, NULL, NULL);
INSERT INTO `ms_pasien` VALUES (81, 'Shadow', '12312381238111112331', '1998-02-03', 'Laki-Laki', 'IMG_20160103_182231.jpg', '123', '0000000', '123', '123', '2020-12-01 11:48:01', 2, NULL, NULL, 9, NULL, NULL, NULL);
INSERT INTO `ms_pasien` VALUES (82, '1123', '25', '2020-12-01', 'Laki-Laki', '24daj542403x0hi2.jpg', '123', '123', '123@gmail.com', '123', '2020-12-01 11:59:35', 2, NULL, NULL, 9, NULL, NULL, NULL);
COMMIT;

-- ----------------------------
-- Table structure for ms_printer
-- ----------------------------
DROP TABLE IF EXISTS `ms_printer`;
CREATE TABLE `ms_printer` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `printer_code` varchar(45) DEFAULT '',
  `deskripsi` varchar(45) DEFAULT NULL,
  `create_date` datetime DEFAULT NULL,
  `create_user` int(11) DEFAULT NULL,
  `update_date` datetime DEFAULT NULL,
  `update_user` int(11) DEFAULT NULL,
  `status` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of ms_printer
-- ----------------------------
BEGIN;
INSERT INTO `ms_printer` VALUES (1, 'Printer-1', 'Printer-1', '2020-11-10 13:08:48', 2, NULL, NULL, 1);
INSERT INTO `ms_printer` VALUES (2, 'Printer-2', 'Printer-2', '2020-11-10 13:08:57', 2, NULL, NULL, 1);
INSERT INTO `ms_printer` VALUES (3, 'Printer-3 ', 'Printer-3', '2020-11-23 14:08:31', 2, NULL, NULL, 1);
INSERT INTO `ms_printer` VALUES (4, NULL, NULL, '2020-12-01 11:02:54', 2, NULL, NULL, 0);
INSERT INTO `ms_printer` VALUES (5, NULL, NULL, '2020-12-01 11:44:55', 2, NULL, NULL, 0);
INSERT INTO `ms_printer` VALUES (6, NULL, NULL, '2020-12-01 11:45:55', 2, NULL, NULL, 0);
INSERT INTO `ms_printer` VALUES (7, NULL, NULL, '2020-12-01 11:49:02', 2, NULL, NULL, 0);
INSERT INTO `ms_printer` VALUES (8, 'print', NULL, '2020-12-01 14:08:40', 2, NULL, NULL, 0);
INSERT INTO `ms_printer` VALUES (9, 'print', 'print2', '2020-12-01 14:11:26', 2, NULL, NULL, 1);
COMMIT;

-- ----------------------------
-- Table structure for ms_role
-- ----------------------------
DROP TABLE IF EXISTS `ms_role`;
CREATE TABLE `ms_role` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `role` varchar(45) DEFAULT NULL,
  `deskripsi` varchar(45) DEFAULT NULL,
  `create_date` datetime DEFAULT NULL,
  `create_user` int(11) DEFAULT NULL,
  `update_date` datetime DEFAULT NULL,
  `update_user` int(11) DEFAULT NULL,
  `status` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of ms_role
-- ----------------------------
BEGIN;
INSERT INTO `ms_role` VALUES (1, 'Admin', 'admin', '2020-11-10 13:08:07', 2, NULL, NULL, NULL);
INSERT INTO `ms_role` VALUES (2, 'Dokter', 'Dokter', NULL, NULL, NULL, NULL, NULL);
COMMIT;

-- ----------------------------
-- Table structure for ms_sph
-- ----------------------------
DROP TABLE IF EXISTS `ms_sph`;
CREATE TABLE `ms_sph` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `initialevent_id` int(11) DEFAULT NULL,
  `antrian_id` int(11) DEFAULT NULL,
  `nomor_sph` varchar(45) DEFAULT '',
  `nama_referensi` varchar(45) DEFAULT '',
  `harga_test` double(15,0) DEFAULT NULL,
  `tipe_member` int(11) DEFAULT NULL,
  `tgl_kontrak` date DEFAULT NULL,
  `tgl_berlaku_kontrak` date DEFAULT NULL,
  `create_date` datetime DEFAULT NULL,
  `create_user` int(11) DEFAULT NULL,
  `update_date` datetime DEFAULT NULL,
  `update_user` int(11) DEFAULT NULL,
  `status` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  KEY `tipe_member` (`tipe_member`) USING BTREE,
  CONSTRAINT `tipe_member` FOREIGN KEY (`tipe_member`) REFERENCES `ms_type_category` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Table structure for ms_type_category
-- ----------------------------
DROP TABLE IF EXISTS `ms_type_category`;
CREATE TABLE `ms_type_category` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `type_name` varchar(45) DEFAULT NULL,
  `category` varchar(45) DEFAULT NULL,
  `create_date` datetime DEFAULT NULL,
  `create_user` int(11) DEFAULT NULL,
  `update_date` datetime DEFAULT NULL,
  `update_user` int(11) DEFAULT NULL,
  `status` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of ms_type_category
-- ----------------------------
BEGIN;
INSERT INTO `ms_type_category` VALUES (1, 'Undangan', 'EVENT', '2020-11-10 13:09:13', 2, '2020-11-21 14:31:16', 2, 1);
INSERT INTO `ms_type_category` VALUES (2, 'Umum', 'EVENT', '2020-11-10 13:09:21', 2, '2020-11-21 14:31:32', 2, 1);
INSERT INTO `ms_type_category` VALUES (3, 'VIP', 'type_member', '2020-11-25 14:04:23', 2, NULL, NULL, 1);
INSERT INTO `ms_type_category` VALUES (4, 'Non-VIP', 'type_member', '2020-11-25 14:04:23', 2, NULL, NULL, 1);
INSERT INTO `ms_type_category` VALUES (5, 'Cash', 'type_pembayaran', '2020-11-25 14:04:23', 2, NULL, NULL, 1);
INSERT INTO `ms_type_category` VALUES (6, 'Transfer', 'type_pembayaran', '2020-11-25 14:04:23', 2, NULL, NULL, 1);
INSERT INTO `ms_type_category` VALUES (7, 'EDC', 'type_pembayaran', '2020-11-25 14:04:23', 2, NULL, NULL, 1);
COMMIT;

-- ----------------------------
-- Table structure for ms_user
-- ----------------------------
DROP TABLE IF EXISTS `ms_user`;
CREATE TABLE `ms_user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(45) DEFAULT NULL,
  `password` varchar(45) DEFAULT NULL,
  `nama_lengkap` varchar(45) DEFAULT NULL,
  `role_id` int(11) DEFAULT NULL,
  `task` varchar(45) DEFAULT NULL,
  `create_date` datetime DEFAULT NULL,
  `create_user` int(11) DEFAULT NULL,
  `update_date` datetime DEFAULT NULL,
  `update_user` int(11) DEFAULT NULL,
  `status` int(11) DEFAULT NULL,
  `token` varchar(100) DEFAULT NULL,
  `printer_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  KEY `role_id` (`role_id`) USING BTREE,
  CONSTRAINT `role_id` FOREIGN KEY (`role_id`) REFERENCES `ms_role` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of ms_user
-- ----------------------------
BEGIN;
INSERT INTO `ms_user` VALUES (2, 'admin', '5f4dcc3b5aa765d61d8327deb882cf99', 'admin', 1, NULL, NULL, 1, NULL, NULL, 1, 'PmuOtgJ72Qgqcwkt', 1);
INSERT INTO `ms_user` VALUES (7, 'admin-qolby', '5f4dcc3b5aa765d61d8327deb882cf99', 'Qolby Yostra Evant Adha', 1, NULL, NULL, NULL, NULL, NULL, 1, NULL, 1);
INSERT INTO `ms_user` VALUES (8, 'dokter-qolby', '6ff3270cdff47d6a1f54bdb3dfba09db', 'Qolby Y.E.A', 2, NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL);
COMMIT;

-- ----------------------------
-- Table structure for tc_antrian
-- ----------------------------
DROP TABLE IF EXISTS `tc_antrian`;
CREATE TABLE `tc_antrian` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nomor_antrian` varchar(45) DEFAULT NULL,
  `pasien_id` int(11) DEFAULT NULL,
  `initialevent_id` int(11) DEFAULT NULL,
  `tgl_checkin_pemeriksaan` datetime DEFAULT NULL,
  `nama_pemeriksa` varchar(45) DEFAULT NULL,
  `printer_id` int(11) DEFAULT NULL,
  `create_date` datetime DEFAULT NULL,
  `create_user` int(11) DEFAULT NULL,
  `update_date` datetime DEFAULT NULL,
  `update_user` int(11) DEFAULT NULL,
  `status` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  KEY `pasien_id` (`pasien_id`) USING BTREE,
  KEY `initialevent_id` (`initialevent_id`) USING BTREE,
  KEY `printer_id` (`printer_id`) USING BTREE,
  CONSTRAINT `initialevent_id` FOREIGN KEY (`initialevent_id`) REFERENCES `ms_initial_event` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `pasien_id` FOREIGN KEY (`pasien_id`) REFERENCES `ms_pasien` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `printer_id` FOREIGN KEY (`printer_id`) REFERENCES `ms_printer` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=93 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of tc_antrian
-- ----------------------------
BEGIN;
INSERT INTO `tc_antrian` VALUES (90, '123', 22, 4, '2020-12-01 14:43:19', 'DR.SHANK', 1, '2020-12-01 14:17:35', 2, '2020-12-01 14:52:21', 2, 3);
INSERT INTO `tc_antrian` VALUES (91, '124', 24, 4, '2020-12-01 14:43:23', 'DR.SHANK', 1, '2020-12-01 14:17:54', 2, '2020-12-01 14:59:06', 2, 3);
INSERT INTO `tc_antrian` VALUES (92, NULL, 22, 4, NULL, NULL, NULL, '2020-12-01 14:20:40', 2, '2020-12-01 14:40:56', 2, 0);
COMMIT;

-- ----------------------------
-- Table structure for tc_hasil_pcr
-- ----------------------------
DROP TABLE IF EXISTS `tc_hasil_pcr`;
CREATE TABLE `tc_hasil_pcr` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `tgl_keluar_hasil` datetime DEFAULT NULL,
  `initialevent_id` int(11) DEFAULT NULL,
  `filename1` varchar(45) DEFAULT NULL,
  `filename2` varchar(45) DEFAULT NULL,
  `create_date` datetime DEFAULT NULL,
  `create_user` int(11) DEFAULT NULL,
  `update_date` datetime DEFAULT NULL,
  `update_user` int(11) DEFAULT NULL,
  `status` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  KEY `initialevent_id4` (`initialevent_id`) USING BTREE,
  CONSTRAINT `initialevent_id4` FOREIGN KEY (`initialevent_id`) REFERENCES `ms_initial_event` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of tc_hasil_pcr
-- ----------------------------
BEGIN;
INSERT INTO `tc_hasil_pcr` VALUES (1, '2020-11-24 00:00:00', 4, 'IMG201808120627551.jpg', 'ms_type_category13.csv', '2020-11-24 10:41:00', 2, NULL, NULL, 1);
COMMIT;

-- ----------------------------
-- Table structure for tc_hasil_pcr_peserta
-- ----------------------------
DROP TABLE IF EXISTS `tc_hasil_pcr_peserta`;
CREATE TABLE `tc_hasil_pcr_peserta` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `hslpcr_id` int(11) DEFAULT NULL,
  `antrian_id` int(11) DEFAULT NULL,
  `create_date` datetime DEFAULT NULL,
  `create_user` int(11) DEFAULT NULL,
  `update_date` datetime DEFAULT NULL,
  `update_user` int(11) DEFAULT NULL,
  `status` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  KEY `hslpcr_id` (`hslpcr_id`) USING BTREE,
  KEY `antrian_id4` (`antrian_id`) USING BTREE,
  CONSTRAINT `antrian_id4` FOREIGN KEY (`antrian_id`) REFERENCES `tc_antrian` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `hslpcr_id` FOREIGN KEY (`hslpcr_id`) REFERENCES `tc_hasil_pcr` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of tc_hasil_pcr_peserta
-- ----------------------------
BEGIN;
INSERT INTO `tc_hasil_pcr_peserta` VALUES (3, 1, 90, '2020-12-01 14:52:21', 2, NULL, NULL, 1);
INSERT INTO `tc_hasil_pcr_peserta` VALUES (4, 1, 91, '2020-12-01 14:59:06', 2, NULL, NULL, 1);
COMMIT;

-- ----------------------------
-- Table structure for tc_pembayaran
-- ----------------------------
DROP TABLE IF EXISTS `tc_pembayaran`;
CREATE TABLE `tc_pembayaran` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `antrian_id` int(11) DEFAULT NULL,
  `buktitransfer_filename` varchar(45) DEFAULT NULL,
  `ref_no_transfer` varchar(45) DEFAULT NULL,
  `nominal_transfer` double DEFAULT NULL,
  `status_pembayaran` int(11) DEFAULT NULL,
  `tipe_pembayaran` varchar(10) DEFAULT NULL,
  `is_validated_finance` int(11) DEFAULT NULL,
  `create_date` datetime DEFAULT NULL,
  `create_user` int(11) DEFAULT NULL,
  `update_date` datetime DEFAULT NULL,
  `update_user` int(11) DEFAULT NULL,
  `status` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  KEY `antrian_id3` (`antrian_id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=72 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Table structure for tc_refrigerator
-- ----------------------------
DROP TABLE IF EXISTS `tc_refrigerator`;
CREATE TABLE `tc_refrigerator` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `initialevent_id` int(11) DEFAULT NULL,
  `antrian_id` int(11) DEFAULT NULL,
  `tgl_masuk` datetime DEFAULT NULL,
  `create_date` datetime DEFAULT NULL,
  `create_user` int(11) DEFAULT NULL,
  `update_date` datetime DEFAULT NULL,
  `update_user` int(11) DEFAULT NULL,
  `status` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  KEY `initialevent` (`initialevent_id`) USING BTREE,
  KEY `antrian` (`antrian_id`) USING BTREE,
  CONSTRAINT `antrian` FOREIGN KEY (`antrian_id`) REFERENCES `tc_antrian` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `initialevent` FOREIGN KEY (`initialevent_id`) REFERENCES `ms_initial_event` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Table structure for tc_registration
-- ----------------------------
DROP TABLE IF EXISTS `tc_registration`;
CREATE TABLE `tc_registration` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `kategori_id` int(11) DEFAULT NULL,
  `antrian_id` int(11) DEFAULT NULL,
  `nama_grup_instansi` varchar(45) DEFAULT NULL,
  `jumlah_anggota` int(11) DEFAULT NULL,
  `ref_no_transfer` varchar(45) DEFAULT NULL,
  `booking_jadwal_test` datetime DEFAULT NULL,
  `estimasi_jadwal_test` datetime DEFAULT NULL,
  `is_pic_grup` int(11) DEFAULT NULL,
  `alokasi_printer_id` int(11) DEFAULT NULL,
  `url_hasil` varchar(20) DEFAULT NULL,
  `registrasi_via` varchar(45) DEFAULT NULL,
  `status_release_hasil` varchar(45) DEFAULT NULL,
  `status_validasi_dokter` varchar(45) DEFAULT NULL,
  `status_gugus_covid` varchar(45) DEFAULT NULL,
  `nama_referensi` varchar(45) DEFAULT NULL,
  `create_date` datetime DEFAULT NULL,
  `create_user` int(11) DEFAULT NULL,
  `update_date` datetime DEFAULT NULL,
  `update_user` int(11) DEFAULT NULL,
  `status` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  KEY `kategori_id2` (`kategori_id`) USING BTREE,
  KEY `antrian_id2` (`antrian_id`) USING BTREE,
  KEY `alokasi_printer_id` (`alokasi_printer_id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of tc_registration
-- ----------------------------
BEGIN;
INSERT INTO `tc_registration` VALUES (1, 1, 90, 'Little Talks', NULL, NULL, '2020-12-01 14:16:00', '2020-12-01 14:33:00', 1, NULL, NULL, 'Website', NULL, 'Completed', NULL, NULL, '2020-12-01 14:17:35', 2, '2020-12-01 23:16:03', 2, 4);
INSERT INTO `tc_registration` VALUES (2, 1, 91, 'Little Talks', NULL, NULL, '2020-12-01 14:16:00', '2020-12-01 14:33:00', 2, NULL, NULL, 'Website', NULL, 'Completed', NULL, NULL, '2020-12-01 14:17:54', 2, '2020-12-02 14:05:33', 2, 4);
INSERT INTO `tc_registration` VALUES (3, 1, 92, 'Little Talks', NULL, NULL, '2020-12-01 14:16:00', '2020-12-01 14:33:00', 2, NULL, NULL, 'Website', NULL, NULL, NULL, NULL, '2020-12-01 14:20:40', 2, '2020-12-01 14:40:56', 2, 0);
COMMIT;

-- ----------------------------
-- Table structure for tc_validasi_dokter
-- ----------------------------
DROP TABLE IF EXISTS `tc_validasi_dokter`;
CREATE TABLE `tc_validasi_dokter` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `antrian_id` int(11) DEFAULT NULL,
  `hasil_analisa` longtext DEFAULT NULL,
  `periode_hasil_start` date DEFAULT NULL,
  `periode_hasil_end` date DEFAULT NULL,
  `kesimpulan` varchar(45) DEFAULT NULL,
  `is_completed` int(11) DEFAULT NULL,
  `create_date` datetime DEFAULT NULL,
  `create_user` int(11) DEFAULT NULL,
  `update_date` datetime DEFAULT NULL,
  `update_user` int(11) DEFAULT NULL,
  `status` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  KEY `antrian_id` (`antrian_id`) USING BTREE,
  CONSTRAINT `antrian_id` FOREIGN KEY (`antrian_id`) REFERENCES `tc_antrian` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of tc_validasi_dokter
-- ----------------------------
BEGIN;
INSERT INTO `tc_validasi_dokter` VALUES (7, 90, '12312', '2020-11-24', '2020-12-01', 'Negative', 1, '2020-12-01 23:14:59', 2, '2020-12-01 23:16:03', 2, 2);
INSERT INTO `tc_validasi_dokter` VALUES (8, 91, '213', '2020-11-24', '2020-12-01', 'Invalid', 1, '2020-12-01 23:16:21', 2, '2020-12-02 14:05:33', 2, 2);
COMMIT;

SET FOREIGN_KEY_CHECKS = 1;
