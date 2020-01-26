-- phpMyAdmin SQL Dump
-- version 3.5.2
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Jun 21, 2018 at 10:51 AM
-- Server version: 5.5.25a
-- PHP Version: 5.4.4

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `biglaundry`
--

-- --------------------------------------------------------

--
-- Table structure for table `dtcustomer`
--

CREATE TABLE IF NOT EXISTS `dtcustomer` (
  `customerid` int(11) NOT NULL AUTO_INCREMENT,
  `outletid` int(11) NOT NULL,
  `customer` varchar(25) NOT NULL,
  `alamat` varchar(100) NOT NULL,
  `handphone` varchar(25) NOT NULL,
  `createdate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`customerid`),
  UNIQUE KEY `customer` (`customer`,`alamat`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=16 ;

--
-- Dumping data for table `dtcustomer`
--

INSERT INTO `dtcustomer` (`customerid`, `outletid`, `customer`, `alamat`, `handphone`, `createdate`) VALUES
(1, 1, 'Budianto', 'Jl. Setiabudi No.22', '08124849999', '2018-04-09 06:16:09'),
(3, 1, 'Budiawan', 'Jl. Setiabudi No.22', '08124849993', '2018-04-09 07:37:34'),
(4, 1, 'Distri', 'Tangerang', '08124849997', '2018-04-12 10:34:48'),
(9, 1, 'Jhon Due', 'BSD Tangsel', '081193889000', '2018-04-12 10:41:36'),
(10, 2, 'Norman', 'Jl. Pondok Gede II No.33', '08773890019990', '2018-04-18 05:01:29'),
(11, 2, 'Salsa', 'Jl.Pondok Pinang 2 No.11', '0877864889100', '2018-04-19 03:28:48'),
(12, 1, 'Maulana', 'Pondok Kopi', '0876541888299', '2018-04-27 09:13:49'),
(13, 1, 'adul', 'pondok kpoi', '081293030003', '2018-05-21 08:06:09'),
(14, 1, 'kiwil', 'tapos', '08124849991', '2018-05-21 10:21:10'),
(15, 1, 'botak', 'Pondok Kopi', '098857885757', '2018-05-21 10:23:41');

-- --------------------------------------------------------

--
-- Table structure for table `dtlcashier`
--

CREATE TABLE IF NOT EXISTS `dtlcashier` (
  `dtlcashid` int(11) NOT NULL AUTO_INCREMENT,
  `noresi` varchar(15) NOT NULL,
  `tariffid` int(11) NOT NULL,
  `harga` double NOT NULL,
  `jumlah` int(11) NOT NULL,
  `diskon` float NOT NULL,
  `subtotal` double NOT NULL,
  `keterangan` text,
  `tglterima` date NOT NULL,
  `tglselesai` date DEFAULT NULL,
  `tglproduksi` date DEFAULT NULL,
  `tglkirim` date DEFAULT NULL,
  PRIMARY KEY (`dtlcashid`),
  UNIQUE KEY `data` (`noresi`,`tariffid`,`harga`,`jumlah`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `dtlcashier`
--

INSERT INTO `dtlcashier` (`dtlcashid`, `noresi`, `tariffid`, `harga`, `jumlah`, `diskon`, `subtotal`, `keterangan`, `tglterima`, `tglselesai`, `tglproduksi`, `tglkirim`) VALUES
(1, '2018052800001', 3, 7000, 2, 0, 14000, NULL, '2018-05-28', '2018-05-28', '2018-05-28', NULL),
(2, '2018052800002', 1, 6000, 3, 0, 18000, NULL, '2018-05-28', '2018-06-12', '2018-06-12', NULL),
(3, '2018061200003', 4, 8000, 8, 0, 64000, '', '2018-06-12', '2018-06-12', '2018-06-12', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `dttariff`
--

CREATE TABLE IF NOT EXISTS `dttariff` (
  `tariffid` int(11) NOT NULL AUTO_INCREMENT,
  `outletid` int(11) DEFAULT NULL,
  `tariff` varchar(50) NOT NULL,
  `harga` double NOT NULL,
  `diskon` float DEFAULT NULL,
  `diskondate` date DEFAULT NULL,
  `satuan` enum('-','Satuan','Kiloan','Paket') NOT NULL,
  `tipe` enum('-','Reguler','Express') DEFAULT NULL,
  `jenis` enum('-','Cuci Kering Lipat Setrika','Cuci Kering Lipat') DEFAULT NULL,
  `perkg` int(11) DEFAULT NULL,
  `foto` varchar(25) DEFAULT NULL,
  `username` varchar(25) NOT NULL,
  `createdate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`tariffid`),
  UNIQUE KEY `tariff` (`tariff`,`satuan`,`tipe`,`jenis`,`outletid`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=10 ;

--
-- Dumping data for table `dttariff`
--

INSERT INTO `dttariff` (`tariffid`, `outletid`, `tariff`, `harga`, `diskon`, `diskondate`, `satuan`, `tipe`, `jenis`, `perkg`, `foto`, `username`, `createdate`) VALUES
(1, NULL, 'Blouse', 6000, 0, '0000-00-00', 'Satuan', '-', '-', NULL, NULL, '', '2018-04-26 03:04:52'),
(2, NULL, 'Kemeja', 7000, 0, '0000-00-00', 'Satuan', '-', '-', NULL, NULL, '', '2018-04-26 03:05:15'),
(3, NULL, 'Celana Panjang', 7000, 0, '0000-00-00', 'Satuan', '-', '-', NULL, NULL, '', '2018-04-26 03:07:26'),
(4, 2, 'Reguler', 8000, 0, '0000-00-00', 'Kiloan', 'Reguler', 'Cuci Kering Lipat Setrika', 3, NULL, '', '2018-04-26 03:15:21'),
(5, 2, 'Reguler', 7000, 0, '0000-00-00', 'Kiloan', 'Reguler', 'Cuci Kering Lipat', 3, NULL, '', '2018-04-26 03:21:59'),
(6, 2, 'Express', 10000, 0, '0000-00-00', 'Kiloan', 'Express', 'Cuci Kering Lipat Setrika', 3, NULL, '', '2018-04-26 03:26:10'),
(7, 2, 'Express', 9500, 0, '0000-00-00', 'Kiloan', 'Express', 'Cuci Kering Lipat', 3, NULL, '', '2018-04-26 03:26:45'),
(8, 2, 'Paket Ramadhan', 100000, 0, '0000-00-00', 'Paket', '-', '-', 10, NULL, '', '2018-04-27 06:12:37'),
(9, 2, 'Paket Syahban', 90000, 0, '0000-00-00', 'Paket', '-', '-', 10, NULL, '', '2018-04-27 06:13:18');

-- --------------------------------------------------------

--
-- Table structure for table `hdrcashier`
--

CREATE TABLE IF NOT EXISTS `hdrcashier` (
  `hdrcashid` int(11) NOT NULL AUTO_INCREMENT,
  `customerid` int(11) NOT NULL,
  `outletid` int(11) NOT NULL,
  `noresi` varchar(15) NOT NULL,
  `userid` int(11) NOT NULL,
  `pembayaran` enum('','Cash','Credit Card','Debit Card') NOT NULL,
  `kartu` varchar(25) DEFAULT NULL,
  `bayar` double NOT NULL,
  `sisa` double NOT NULL DEFAULT '0',
  `total` double NOT NULL,
  `status` enum('','Process','Finish') DEFAULT NULL,
  `username` varchar(25) NOT NULL,
  `createdate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `tglkirimcash` datetime DEFAULT NULL,
  `tglterimacash` datetime DEFAULT NULL,
  `tglkirimprod` datetime DEFAULT NULL,
  `tglterimaprod` datetime DEFAULT NULL,
  PRIMARY KEY (`hdrcashid`),
  UNIQUE KEY `noresi` (`outletid`,`noresi`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `hdrcashier`
--

INSERT INTO `hdrcashier` (`hdrcashid`, `customerid`, `outletid`, `noresi`, `userid`, `pembayaran`, `kartu`, `bayar`, `sisa`, `total`, `status`, `username`, `createdate`, `tglkirimcash`, `tglterimacash`, `tglkirimprod`, `tglterimaprod`) VALUES
(1, 3, 1, '2018052800001', 3, 'Cash', '', 28000, 0, 28000, 'Finish', 'cashier@cucibersih.com', '2018-05-27 17:00:00', '2018-05-28 13:36:00', '2018-05-28 14:03:00', '2018-05-28 14:01:00', '2018-05-28 14:01:00'),
(2, 12, 1, '2018052800002', 3, 'Cash', '', 20000, -18000, 20000, 'Finish', 'cashier@cucibersih.com', '2018-06-11 17:00:00', '2018-05-28 13:39:00', NULL, '2018-06-12 02:32:00', '2018-06-12 02:31:00'),
(3, 3, 1, '2018061200003', 0, 'Cash', '', 50000, -14000, -14000, 'Process', 'super@user.com', '2018-06-11 17:00:00', '2018-06-12 06:16:00', '2018-06-12 06:17:00', '2018-06-12 06:17:00', '2018-06-12 06:17:00');

-- --------------------------------------------------------

--
-- Table structure for table `menulogin`
--

CREATE TABLE IF NOT EXISTS `menulogin` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `levelid` int(11) NOT NULL,
  `menuid` int(11) NOT NULL,
  `urlmenu` varchar(50) NOT NULL,
  `add` tinyint(1) NOT NULL,
  `edit` tinyint(1) NOT NULL,
  `delete` tinyint(1) NOT NULL,
  `approve` tinyint(1) NOT NULL,
  `print` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `menuid` (`levelid`,`menuid`,`add`,`edit`,`delete`,`approve`,`print`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=16 ;

--
-- Dumping data for table `menulogin`
--

INSERT INTO `menulogin` (`id`, `levelid`, `menuid`, `urlmenu`, `add`, `edit`, `delete`, `approve`, `print`) VALUES
(1, 1, 2, 'Masters/daftarmenu', 1, 1, 0, 0, 0),
(2, 1, 3, 'Masters/menulogin', 1, 1, 0, 0, 0),
(3, 1, 5, 'Masters/store', 1, 1, 0, 0, 0),
(4, 1, 7, 'Masters/userlevel', 1, 1, 0, 0, 0),
(5, 1, 8, 'Masters/employee', 1, 1, 0, 0, 0),
(6, 1, 9, 'Masters/userlogin', 1, 1, 0, 0, 0),
(7, 1, 11, 'Datas/harga', 1, 1, 0, 0, 0),
(8, 1, 12, 'Datas/customer', 1, 1, 0, 0, 0),
(9, 1, 14, 'Activities/cashier', 1, 1, 0, 1, 1),
(10, 1, 15, 'Activities/production', 1, 1, 0, 0, 0),
(11, 3, 15, 'Activities/production', 0, 1, 0, 0, 0),
(12, 5, 14, 'Activities/cashier', 1, 1, 0, 0, 1),
(13, 6, 14, 'Activities/cashier', 1, 1, 0, 1, 1),
(14, 1, 17, 'Tools/printer', 1, 1, 0, 0, 0),
(15, 4, 15, 'Activities/production', 1, 1, 0, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `mstlevel`
--

CREATE TABLE IF NOT EXISTS `mstlevel` (
  `levelid` int(11) NOT NULL AUTO_INCREMENT,
  `level` varchar(25) NOT NULL,
  PRIMARY KEY (`levelid`),
  UNIQUE KEY `level` (`level`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

--
-- Dumping data for table `mstlevel`
--

INSERT INTO `mstlevel` (`levelid`, `level`) VALUES
(2, 'Administrator'),
(6, 'Cashier'),
(4, 'Production'),
(1, 'Superuser'),
(5, 'Supervisor Cashier'),
(3, 'Supervisor Production');

-- --------------------------------------------------------

--
-- Table structure for table `mstlogin`
--

CREATE TABLE IF NOT EXISTS `mstlogin` (
  `loginid` int(11) NOT NULL AUTO_INCREMENT,
  `levelid` int(11) NOT NULL,
  `outletid` varchar(11) NOT NULL,
  `userid` int(11) NOT NULL,
  `username` varchar(25) NOT NULL,
  `password` varchar(32) NOT NULL,
  `foto` varchar(20) DEFAULT NULL,
  `status` tinyint(1) NOT NULL,
  `createdate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `lastlogin` date DEFAULT NULL,
  `ipaddress` varchar(20) DEFAULT NULL,
  `lokasi` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`loginid`),
  UNIQUE KEY `username` (`username`,`userid`),
  KEY `levelid` (`levelid`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

--
-- Dumping data for table `mstlogin`
--

INSERT INTO `mstlogin` (`loginid`, `levelid`, `outletid`, `userid`, `username`, `password`, `foto`, `status`, `createdate`, `lastlogin`, `ipaddress`, `lokasi`) VALUES
(1, 1, '1', 0, 'super@user.com', '0baea2f0ae20150db78f58cddac442a9', NULL, 1, '2018-04-02 06:57:45', '2018-06-12', '::1', '-6.12:106.87'),
(2, 3, '1', 1, 'arman@cucibersih.com', '81a1af2c19d7e84ad9ef22563d5c4b25', 'avatar52.png', 1, '2018-04-05 10:14:16', '2018-04-24', '::1', '-6.21:106.84'),
(3, 5, '1', 2, 'spvcashier@cucibersih.com', 'ef33e82146e415835f7d98aa9466257c', NULL, 1, '2018-04-18 04:23:54', '2018-04-18', '::1', '-6.21:106.84'),
(4, 6, '2', 3, 'cashier@cucibersih.com', '6ac2470ed8ccf204fd5ff89b32a355cf', NULL, 1, '2018-04-18 04:26:58', '2018-05-28', '::1', '-6.21:106.85'),
(5, 5, '2', 4, 'javaspv@javalaundry.com', 'c7668eeeec1588fe0adecda9d950865b', NULL, 1, '2018-04-18 04:31:23', '2018-04-24', '::1', '-6.21:106.84'),
(6, 4, '1', 6, 'production@cucibersih.com', 'fd89784e59c72499525556f80289b2c7', NULL, 1, '2018-05-28 06:41:59', '2018-05-28', '::1', '-6.21:106.85');

-- --------------------------------------------------------

--
-- Table structure for table `mstmenu`
--

CREATE TABLE IF NOT EXISTS `mstmenu` (
  `menuid` int(11) NOT NULL AUTO_INCREMENT,
  `parent` tinyint(1) NOT NULL,
  `header` varchar(10) NOT NULL,
  `submenu` varchar(25) NOT NULL,
  `class_icon` varchar(100) NOT NULL,
  `status` tinyint(1) NOT NULL,
  `createdate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`menuid`),
  UNIQUE KEY `submenu` (`submenu`,`header`,`status`),
  KEY `header` (`header`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=18 ;

--
-- Dumping data for table `mstmenu`
--

INSERT INTO `mstmenu` (`menuid`, `parent`, `header`, `submenu`, `class_icon`, `status`, `createdate`) VALUES
(1, 0, 'Master', '-', 'fa fa-laptop', 1, '2018-04-03 04:14:07'),
(2, 1, 'Master', 'List Menu', 'fa fa-list', 1, '2018-04-03 09:06:20'),
(3, 1, 'Master', 'Access Menu', 'fa fa-edit', 1, '2018-04-03 09:09:16'),
(4, 1, 'Master', 'Access Level', 'fa fa-circle', 1, '2018-04-03 12:33:18'),
(5, 1, 'Master', 'Store Menu', 'fa fa-calculator', 1, '2018-04-03 12:33:59'),
(7, 1, 'Master', 'User Level', 'fa fa-child', 1, '2018-04-04 09:50:47'),
(8, 1, 'Master', 'Employee', 'fa fa-user-plus', 1, '2018-04-06 10:50:44'),
(9, 1, 'Master', 'User Login', 'fa fa-key', 1, '2018-04-06 10:51:29'),
(10, 0, 'Data', '-', 'fa fa-cubes text-red', 1, '2018-04-05 09:30:51'),
(11, 1, 'Data', 'Daftar Harga', 'fa fa-money', 1, '2018-04-05 09:33:26'),
(12, 1, 'Data', 'Data Customer', 'fa fa-group', 1, '2018-04-06 10:46:35'),
(13, 0, 'Activities', '-', 'fa fa-bar-chart', 1, '2018-04-09 07:50:48'),
(14, 1, 'Activities', 'Cashier', 'fa fa-shopping-cart', 1, '2018-04-09 07:53:42'),
(15, 1, 'Activities', 'Production', 'fa fa-chrome', 1, '2018-04-16 07:51:12'),
(16, 0, 'Tools', '-', 'fa fa-gear', 1, '2018-05-17 10:18:35'),
(17, 1, 'Tools', 'Setting Printer', 'fa fa-print', 1, '2018-05-17 10:19:14');

-- --------------------------------------------------------

--
-- Table structure for table `mstoutlet`
--

CREATE TABLE IF NOT EXISTS `mstoutlet` (
  `outletid` int(11) NOT NULL AUTO_INCREMENT,
  `outlet` varchar(50) NOT NULL,
  `alamat` varchar(50) NOT NULL,
  `kota` varchar(25) NOT NULL,
  `telephone` varchar(25) NOT NULL,
  `picname` varchar(50) NOT NULL,
  `lat` varchar(15) DEFAULT NULL,
  `lng` varchar(15) DEFAULT NULL,
  `kontrakdate` date NOT NULL,
  `createdate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `username` varchar(25) NOT NULL,
  PRIMARY KEY (`outletid`),
  UNIQUE KEY `outlet` (`outlet`,`alamat`,`kota`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `mstoutlet`
--

INSERT INTO `mstoutlet` (`outletid`, `outlet`, `alamat`, `kota`, `telephone`, `picname`, `lat`, `lng`, `kontrakdate`, `createdate`, `username`) VALUES
(1, 'Cuci Bersih', 'Jl. Kali Malang Raya No. 3', 'Jakarta Timur', '08148100300', 'Anwar', '-6.21', '106.85', '2019-04-04', '2018-04-04 09:37:33', 'super@user.com'),
(2, 'Java Laundry', 'Jl.Pengambiran No.13 Rawamangun', 'DKI Jakarta', '+62 21 4714979', 'Wawan Irawan', '-6.21', '106.84', '2018-06-04', '2018-04-18 03:19:25', 'super@user.com');

-- --------------------------------------------------------

--
-- Table structure for table `mstuser`
--

CREATE TABLE IF NOT EXISTS `mstuser` (
  `userid` int(11) NOT NULL AUTO_INCREMENT,
  `levelid` int(11) NOT NULL,
  `leader` int(11) DEFAULT NULL,
  `name` varchar(100) NOT NULL,
  `address` varchar(100) NOT NULL,
  `phone` varchar(25) DEFAULT NULL,
  `hp` varchar(25) NOT NULL,
  `ktp` varchar(20) NOT NULL,
  `rmcode` varchar(10) DEFAULT NULL,
  `email` varchar(25) DEFAULT NULL,
  `foto` varchar(30) NOT NULL,
  `ktpjpeg` varchar(30) NOT NULL,
  `npwpjpeg` varchar(30) DEFAULT NULL,
  `kkjpeg` varchar(100) NOT NULL,
  `jkelamin` varchar(1) DEFAULT NULL,
  `birthdate` date DEFAULT NULL,
  `emergency` varchar(25) DEFAULT NULL,
  `activedate` date DEFAULT NULL,
  `resigndate` date DEFAULT NULL,
  `createdate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `status` tinyint(1) DEFAULT NULL,
  `username` varchar(30) DEFAULT NULL,
  PRIMARY KEY (`userid`),
  UNIQUE KEY `name` (`name`,`birthdate`) USING BTREE
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

--
-- Dumping data for table `mstuser`
--

INSERT INTO `mstuser` (`userid`, `levelid`, `leader`, `name`, `address`, `phone`, `hp`, `ktp`, `rmcode`, `email`, `foto`, `ktpjpeg`, `npwpjpeg`, `kkjpeg`, `jkelamin`, `birthdate`, `emergency`, `activedate`, `resigndate`, `createdate`, `status`, `username`) VALUES
(1, 3, 0, 'Arman', 'Jl. H Nawi II Gg. 12 No.8', '021', '082239177889', '321034923400001', 'AR101', 'arman123@yahoo.com', 'avatar5.png', 'american-express.png', 'paypal2.png', 'mestro.png', 'L', '1999-03-03', '082294884999', '2018-05-04', NULL, '2018-04-05 04:51:29', 1, NULL),
(2, 5, 0, 'Cashier SPV', '-', '081', '0832', '321034923400001', 'SPVCS01', 'spvcashier@cucibersih.com', '', '', NULL, '', 'L', '2018-04-06', '021', '2018-04-18', NULL, '2018-04-18 03:40:15', 1, NULL),
(3, 6, 2, 'Cashier', '-', '0811', '0877', '3172020512710008', 'CSH01', 'cashier@cucibersih.com', '', '', NULL, '', 'L', '2018-06-04', '021', '2018-04-18', NULL, '2018-04-18 03:41:55', 1, NULL),
(4, 5, 0, 'Java Spv Cashier', 'java', '021', '0817', '3217', 'JVSPC01', 'javaspv@javalaundry.com', '', '', NULL, '', 'L', '1990-06-04', '021', '2018-06-04', NULL, '2018-04-18 04:29:14', 1, NULL),
(5, 6, 4, 'Java Cashier', 'java', '021', '0877', '3129', 'JVCS01', 'javacashier@javalaundry.c', '', '', NULL, '', 'P', '1998-06-04', '021', '2018-06-04', NULL, '2018-04-18 04:30:35', 1, NULL),
(6, 4, 1, 'production', '-', '-', '-', '-', '-', 'abc@yahoo.com', '', '', NULL, '', 'L', '1970-01-01', '-', '1970-01-01', NULL, '2018-05-28 06:41:18', 1, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `temptable`
--

CREATE TABLE IF NOT EXISTS `temptable` (
  `dtlcashid` int(11) NOT NULL DEFAULT '0',
  `noresi` varchar(15) NOT NULL,
  `tariffid` int(11) NOT NULL,
  `customerid` int(11) NOT NULL,
  `harga` double NOT NULL,
  `jumlah` int(11) NOT NULL,
  `subtotal` double NOT NULL,
  `tglterima` date NOT NULL,
  `tglselesai` date DEFAULT NULL,
  `tglproduksi` date DEFAULT NULL,
  `tglkirim` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tlsprinter`
--

CREATE TABLE IF NOT EXISTS `tlsprinter` (
  `printerid` int(11) NOT NULL AUTO_INCREMENT,
  `outletid` int(11) NOT NULL,
  `printer` varchar(100) NOT NULL,
  `port` int(11) NOT NULL,
  `createdate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`printerid`),
  UNIQUE KEY `outletid` (`outletid`,`printer`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `tlsprinter`
--

INSERT INTO `tlsprinter` (`printerid`, `outletid`, `printer`, `port`, `createdate`) VALUES
(1, 2, 'MPT-II', 9100, '2018-05-18 04:33:21');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
