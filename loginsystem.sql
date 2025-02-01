-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 23, 2025 at 06:02 AM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 7.4.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `loginsystem`
--

-- --------------------------------------------------------

--
-- Table structure for table `account`
--

CREATE TABLE `account` (
  `aid` int(11) NOT NULL,
  `cid` int(11) NOT NULL,
  `acc_type` int(11) NOT NULL,
  `opening_bal` double NOT NULL,
  `created` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `account`
--

INSERT INTO `account` (`aid`, `cid`, `acc_type`, `opening_bal`, `created`) VALUES
(1, 1, 1, 201723, '2022-08-11'),
(2, 661, 2, 0, '2023-08-28'),
(3, 18, 1, 118622, '2024-04-03'),
(4, 19, 1, 553740, '2024-04-03'),
(5, 814, 2, 0, '2024-04-04'),
(6, 7, 1, 0, '2024-04-12'),
(7, 8, 1, 0, '2024-04-12'),
(8, 821, 2, 0, '2024-04-12'),
(9, 702, 2, 0, '2024-04-12'),
(10, 549, 2, 0, '2024-04-12'),
(12, 812, 2, 0, '2024-04-12'),
(13, 940, 2, 0, '2024-09-08');

-- --------------------------------------------------------

--
-- Table structure for table `acc_type`
--

CREATE TABLE `acc_type` (
  `id` int(11) NOT NULL,
  `type` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `acc_type`
--

INSERT INTO `acc_type` (`id`, `type`) VALUES
(1, 'Supplier'),
(2, 'Customer');

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `name` varchar(200) NOT NULL,
  `email` varchar(200) NOT NULL,
  `qualification` varchar(200) NOT NULL,
  `location` varchar(200) NOT NULL,
  `skills` varchar(300) NOT NULL,
  `c_name` varchar(300) NOT NULL,
  `c_add` varchar(300) NOT NULL,
  `profession` varchar(300) NOT NULL,
  `mob` varchar(50) NOT NULL,
  `gst` varchar(20) NOT NULL,
  `pan` varchar(10) NOT NULL,
  `picture` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `picturelogo` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `username`, `password`, `name`, `email`, `qualification`, `location`, `skills`, `c_name`, `c_add`, `profession`, `mob`, `gst`, `pan`, `picture`, `picturelogo`) VALUES
(1, 'admin@gmail.com', 'admin@123', 'Tejas Chavda', 'codetech@xxxxxxxxxxxx', 'B.E in Computer Engineering from Gandhinagar Institute of Technology ', 'Ahmedabad, Gujarat', '[\"test ,from\"]', 'CodeTech Engineers', 'Maninagar, Ahmedabad- 380008', 'Web Developer', '+91-97XXXXXXXXX', '2XXXXXXXXX', 'AXXXXXXXXX', '1645328816_1638437931_TQ7CaP.jpeg', '1621344279_codetech engineers.PNG');

-- --------------------------------------------------------

--
-- Table structure for table `bankdetails`
--

CREATE TABLE `bankdetails` (
  `bid` int(50) NOT NULL,
  `bname` varchar(300) NOT NULL,
  `ac` varchar(300) NOT NULL,
  `ifsc` varchar(300) NOT NULL,
  `branch` varchar(300) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `bankdetails`
--

INSERT INTO `bankdetails` (`bid`, `bname`, `ac`, `ifsc`, `branch`) VALUES
(1, 'ICICI Bank', '62440XXXXXXXX', 'ICIC0XXXXXXXXXX', 'AHMEDABAD BRANCH');

-- --------------------------------------------------------

--
-- Table structure for table `client`
--

CREATE TABLE `client` (
  `cid` int(10) NOT NULL,
  `c_name` varchar(80) NOT NULL,
  `c_add` varchar(200) NOT NULL,
  `mob` varchar(50) NOT NULL,
  `country` varchar(100) NOT NULL,
  `gst` varchar(20) NOT NULL,
  `c_type` varchar(4) NOT NULL,
  `created` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `client`
--

INSERT INTO `client` (`cid`, `c_name`, `c_add`, `mob`, `country`, `gst`, `c_type`, `created`) VALUES
(1, 'JAY ENTERPRISE', 'ANY ENTERPRISE NR SHELL PETROL PUMP, MUMBAI - 450008  ', '8735003590', 'India', '01478523690', 'Loc', '2024-11-06'),
(2, 'Marshell Roze', 'Delta office, nr artical circle, mumbai - 478050', '+918735003590', 'India', '7410258963', 'IGST', '2025-01-19');

-- --------------------------------------------------------

--
-- Table structure for table `clienttype`
--

CREATE TABLE `clienttype` (
  `id` int(30) NOT NULL,
  `type` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `clienttype`
--

INSERT INTO `clienttype` (`id`, `type`) VALUES
(1, 'IGST'),
(2, 'Loc');

-- --------------------------------------------------------

--
-- Table structure for table `delivery_addresses`
--

CREATE TABLE `delivery_addresses` (
  `delid` int(11) NOT NULL,
  `invid` varchar(50) NOT NULL,
  `name` varchar(80) NOT NULL,
  `address` varchar(200) NOT NULL,
  `mob` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `delivery_addresses`
--


-- --------------------------------------------------------

--
-- Table structure for table `fd`
--

CREATE TABLE `fd` (
  `id` int(10) NOT NULL,
  `fdissueddate` date DEFAULT NULL,
  `fdholder` varchar(50) NOT NULL,
  `fdofbank` varchar(100) NOT NULL,
  `principleamt` int(20) NOT NULL,
  `nodays` varchar(20) NOT NULL,
  `intrate` varchar(10) NOT NULL,
  `intamt` int(10) NOT NULL,
  `finalamt` int(20) NOT NULL,
  `maturitydate` date NOT NULL,
  `fdentrydate` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `fd`
--

INSERT INTO `fd` (`id`, `fdissueddate`, `fdholder`, `fdofbank`, `principleamt`, `nodays`, `intrate`, `intamt`, `finalamt`, `maturitydate`, `fdentrydate`) VALUES
(1, '2024-03-02', 'Tejas', 'Saraswat Bank', 51418, '0.5', '5.75', 1458, 52876, '2024-08-29', '2024-03-21 20:38:50');

-- --------------------------------------------------------

--
-- Table structure for table `fest`
--

CREATE TABLE `fest` (
  `id` int(10) NOT NULL,
  `date` varchar(50) NOT NULL,
  `fest_name` varchar(250) NOT NULL,
  `gifs` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `fest`
--

INSERT INTO `fest` (`id`, `date`, `fest_name`, `gifs`) VALUES
(1, '18-Feb', 'Maha Shivaratri', 'best mahashivratri.gif'),
(2, '09-Jul', 'Holi', 'happy-holi.gif\r\n\n\n\n\n\n\n');

-- --------------------------------------------------------

--
-- Table structure for table `invtest`
--

CREATE TABLE `invtest` (
  `orderno` int(100) NOT NULL,
  `orderid` varchar(300) NOT NULL,
  `item_name` varchar(300) NOT NULL,
  `item_desc` varchar(300) NOT NULL,
  `hsn` int(10) NOT NULL,
  `quantity` int(10) NOT NULL,
  `price` int(10) NOT NULL,
  `total` int(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `invtest2`
--

CREATE TABLE `invtest2` (
  `invid` varchar(100) NOT NULL,
  `cid` int(10) NOT NULL,
  `orderid` varchar(300) NOT NULL,
  `totalitems` int(10) NOT NULL,
  `subtotal` int(100) NOT NULL,
  `taxrate` int(10) NOT NULL,
  `taxamount` int(100) NOT NULL,
  `totalamount` int(100) NOT NULL,
  `created` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `paidhistory`
--

CREATE TABLE `paidhistory` (
  `pay_id` int(50) NOT NULL,
  `p_m` varchar(100) NOT NULL,
  `amount` int(100) NOT NULL,
  `mode` varchar(50) NOT NULL,
  `dateofpayment` date NOT NULL,
  `purpose` varchar(100) NOT NULL,
  `type_cs` int(11) NOT NULL,
  `created` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `paidhistory`
--

INSERT INTO `paidhistory` (`pay_id`, `p_m`, `amount`, `mode`, `dateofpayment`, `purpose`, `type_cs`, `created`) VALUES
(3, '1', 50000, 'NEFT from Yesbank', '2024-03-22', 'testng demo', 1, '2024-03-22 04:27:53'),
(4, '661', 293242, 'NEFT from Yesbank', '2024-03-03', 'old cleared', 2, '2024-03-03 10:22:54'),
(5, '814', 293242, 'NEFT from Yesbank', '2024-03-04', 'hjdshsdjks', 2, '2024-03-04 04:39:50'),
(6, '814', 47200, 'NEFT from Yesbank', '2024-04-12', 'paid on 12/4 ref id: N103242986092538', 2, '2024-04-12 04:14:10'),
(7, '702', 13452, 'NEFT from Yesbank', '2024-04-12', 'paid on 12/4. ref id: N10324295720997', 2, '2024-04-12 05:43:42'),
(8, '7', 17677, 'NEFT from Yesbank', '2024-04-10', 'PAID TO ON 10/4 REF ID: 0950543420442113072', 1, '2024-04-12 05:46:18'),
(9, '8', 5900, 'NEFT from Yesbank', '2024-04-05', '6391960916288036304', 1, '2024-04-12 06:04:08'),
(10, '812', 15222, 'NEFT from Yesbank', '2024-04-12', 'paid on 12/4 ref id.: N103242986958142', 2, '2024-04-12 06:41:29'),
(11, '18', 50000, 'NEFT from Yesbank', '2024-04-15', 'N106242989961112', 1, '2024-04-15 06:03:30'),
(12, '515', 13452, 'NEFT from Yesbank', '2024-04-15', 'N106242989961112', 2, '2024-04-15 06:18:02'),
(13, '19', 50000, 'NEFT from Yesbank', '2024-04-09', 'ref id: 410011023297', 1, '2024-04-15 06:23:17'),
(14, '19', 50000, 'NEFT from Yesbank', '2024-04-04', 'ref id: 409510022538', 1, '2024-04-15 06:24:05'),
(15, '19', 50000, 'NEFT from Yesbank', '2024-04-02', 'Ref id: 409312050998', 1, '2024-04-15 06:24:55'),
(16, '18', 50000, 'NEFT from Yesbank', '2024-04-17', 'Ref id: 410809031914', 1, '2024-04-17 06:31:25'),
(17, '701', 13452, 'NEFT from Yesbank', '2024-04-20', 'Ref id:N111242997533077', 2, '2024-04-22 09:53:50'),
(18, '18', 50000, 'NEFT from Yesbank', '2024-04-22', 'Ref id: 411312041691', 1, '2024-04-22 12:19:02'),
(19, '20', 5989, 'NEFT from Yesbank', '2024-04-16', 'Ref id: 410713048992', 1, '2024-04-22 12:39:43'),
(20, '814', 2360, 'NEFT from Yesbank', '2024-05-02', 'Ref id:N123243015635591', 2, '2024-05-04 11:11:46'),
(21, '926', 27730, 'NEFT from Yesbank', '2024-05-02', 'Ref id:AXIOIC12387257631', 2, '2024-05-04 11:13:03'),
(22, '19', 50000, 'NEFT from Yesbank', '2024-05-01', 'Ref id:2892883795699221992', 1, '2024-05-04 11:13:58'),
(23, '649', 31860, 'NEFT from Yesbank', '2024-05-01', 'Ref id: N122243012829465', 2, '2024-05-04 11:15:36'),
(24, '640', 15966, 'NEFT from Yesbank', '2024-04-30', 'ref id: CMS1212417762876', 2, '2024-05-04 11:17:53'),
(25, '910', 7080, 'NEFT from Yesbank', '2024-04-29', 'Ref id: N120 243008444095', 2, '2024-05-04 11:19:52'),
(26, '702', 885, 'NEFT from Yesbank', '2024-04-24', 'Ref id: N115243002385888', 2, '2024-05-04 11:20:44'),
(27, '650', 14290, 'NEFT from Yesbank', '2024-04-24', 'Ref id: N115243001698797', 2, '2024-05-04 11:22:24'),
(28, '821', 14042, 'NEFT from Yesbank', '2024-04-22', 'Ref id: N113242998827506', 2, '2024-05-04 11:24:05'),
(31, '18', 50000, 'NEFT from Yesbank', '2024-05-08', 'ref id: 412910040734', 1, '2024-05-08 04:09:51'),
(32, '19', 50000, 'NEFT from Yesbank', '2024-05-10', 'Ref id: 413109022235', 1, '2024-05-10 09:41:18'),
(33, '19', 50000, 'NEFT from Yesbank', '2024-05-10', 'Ref id: 413109022235', 1, '2024-05-10 09:41:18'),
(35, '812', 15222, 'NEFT from Yesbank', '2024-05-09', 'ref id: 130243031967208', 2, '2024-05-10 05:13:59'),
(43, '805', 59944, 'NEFT from Yesbank', '2024-05-10', 'Ref id: N131243033675656', 2, '2024-05-12 01:52:26'),
(44, '19', 50000, 'NEFT from Yesbank', '2024-05-16', 'REF ID:413710044428', 1, '2024-05-16 12:13:29'),
(45, '19', 50000, 'NEFT from Yesbank', '2024-05-14', 'REF ID: 413512044704', 1, '2024-05-16 12:17:06'),
(46, '19', 50000, 'NEFT from Yesbank', '2024-05-13', 'REF ID: 413409017402', 1, '2024-05-16 12:17:48'),
(47, '19', 50000, 'NEFT from Yesbank', '2024-05-30', 'Ref id: 415113040778', 1, '2024-05-31 10:45:02'),
(48, '19', 50000, 'NEFT from Yesbank', '2024-05-27', 'Ref id: 414809020503', 1, '2024-05-31 10:45:41'),
(49, '19', 50000, 'NEFT from Yesbank', '2024-05-24', 'ref id: 414509029521', 1, '2024-05-31 10:46:36'),
(50, '19', 50000, 'NEFT from Yesbank', '2024-05-22', 'ref id:414310028175', 1, '2024-05-31 10:47:39'),
(51, '19', 50000, 'NEFT from Yesbank', '2024-05-20', 'ref id: 414109017665', 1, '2024-05-31 10:48:28'),
(52, '812', 15222, 'NEFT from Yesbank', '2024-05-22', 'Ref id: N143243050169442', 2, '2024-06-04 11:37:57'),
(53, '702', 13452, 'NEFT from Yesbank', '2024-05-23', 'N144243052420073', 2, '2024-06-04 11:42:06'),
(54, '821', 13452, 'NEFT from Yesbank', '2024-05-22', 'REF ID:N143243051379941', 2, '2024-06-04 11:43:49'),
(55, '706', 4307, 'NEFT from Yesbank', '2024-05-18', 'REF ID: 36337707841DC', 2, '2024-06-04 11:47:10'),
(56, '19', 50000, 'NEFT from Yesbank', '2024-06-04', 'ref id: 415611028004', 1, '2024-06-04 03:02:13'),
(57, '1', 100000, 'NEFT from Yesbank', '2024-06-05', 'ref id: 50200059139778', 1, '2024-06-05 09:49:57'),
(58, '1', 100000, 'NEFT from Yesbank', '2024-06-05', 'ref id: 50200059139778', 1, '2024-06-05 09:49:57'),
(59, '19', 50000, 'NEFT from Yesbank', '2024-06-07', 'REF ID: 415910022979', 1, '2024-06-24 05:28:13'),
(60, '19', 50000, 'NEFT from Yesbank', '2024-06-07', 'REF ID: 415910022979', 1, '2024-06-24 05:28:13'),
(61, '19', 50000, 'NEFT from Yesbank', '2024-06-10', 'REF ID: 416210035384', 1, '2024-06-24 05:28:56'),
(62, '19', 50000, 'NEFT from Yesbank', '2024-07-04', 'ref id: 11260342359549876908', 1, '2024-07-06 06:50:51'),
(63, '19', 50000, 'NEFT from Yesbank', '2024-07-01', 'ref id: 9897302638239543626', 1, '2024-07-06 06:54:44'),
(64, '19', 50000, 'NEFT from Yesbank', '2024-06-27', 'ref id:78162626704237556255', 1, '2024-07-06 06:55:48'),
(65, '1', 20000, 'NEFT from Yesbank', '2024-07-15', 'ref id:936969009485449647', 1, '2024-07-15 11:45:26'),
(66, '19', 50000, 'NEFT from Yesbank', '2024-07-08', 'REF ID: 419011026969', 1, '2024-07-29 05:48:28'),
(67, '19', 50000, 'NEFT from Yesbank', '2024-07-09', 'REF ID:419111031315', 1, '2024-07-29 05:51:00'),
(68, '19', 50000, 'NEFT from Yesbank', '2024-07-11', 'REF ID:419310030072', 1, '2024-07-29 05:51:50'),
(69, '19', 50000, 'NEFT from Yesbank', '2024-07-15', 'REF ID: 419711022772', 1, '2024-07-29 05:52:27'),
(70, '19', 50000, 'NEFT from Yesbank', '2024-07-18', 'REF ID: 420011036739', 1, '2024-07-29 05:56:44'),
(71, '19', 50000, 'NEFT from Yesbank', '2024-07-22', 'REF ID: 420410033423', 1, '2024-07-29 05:57:30'),
(72, '19', 50000, 'NEFT from Yesbank', '2024-07-29', 'REF ID: 421111065199', 1, '2024-07-29 06:05:49'),
(73, '19', 50000, 'NEFT from Yesbank', '2024-08-01', 'Ref id: 421412078896', 1, '2024-08-01 12:18:54'),
(74, '19', 50000, 'NEFT from Yesbank', '2024-08-06', 'Ref id: 421911077197', 1, '2024-08-08 10:06:48'),
(75, '19', 50000, 'NEFT from Yesbank', '2024-08-08', 'ref id: 422109042873', 1, '2024-08-08 10:14:47'),
(76, '1', 20000, 'NEFT from Yesbank', '2024-08-01', 'ref id: 421411064124', 1, '2024-08-08 10:31:38'),
(77, '18', 50000, 'NEFT from Yesbank', '2024-08-10', 'ref id: 422310023389', 1, '2024-08-10 10:53:42'),
(78, '1', 100000, 'NEFT from Yesbank', '2024-08-17', 'REF ID: 423012062888', 1, '2024-08-17 07:41:18'),
(79, '19', 50000, 'NEFT from Yesbank', '2024-08-16', 'REF ID:422909024458', 1, '2024-08-17 07:43:59'),
(80, '19', 50000, 'NEFT from Yesbank', '2024-08-14', 'REF ID: 422709045613', 1, '2024-08-17 07:48:05'),
(81, '18', 50000, 'NEFT from Yesbank', '2024-08-12', 'REF ID: 422511065223', 1, '2024-08-17 07:49:07'),
(82, '1', 100000, 'NEFT from Yesbank', '2024-08-19', 'ref id: 423210049776', 1, '2024-08-19 10:27:03'),
(83, '19', 50000, 'NEFT from Yesbank', '2024-08-19', 'ref id:423210048703', 1, '2024-08-19 10:28:15'),
(84, '19', 50000, 'NEFT from Yesbank', '2024-08-23', 'ref id: 423613082737', 1, '2024-08-24 05:23:21'),
(85, '19', 50000, 'NEFT from Yesbank', '2024-08-27', 'ref id: 424010060299', 1, '2024-08-27 10:52:14'),
(86, '19', 50000, 'NEFT from Yesbank', '2024-08-29', 'ref id: 424211069222', 1, '2024-08-31 03:32:50'),
(87, '18', 50000, 'NEFT from Yesbank', '2024-09-02', 'ref id:424613108069', 1, '2024-09-02 02:14:13'),
(88, '18', 50000, 'NEFT from Yesbank', '2024-09-06', 'REF ID: 425013108776', 1, '2024-09-07 01:28:06'),
(89, '18', 50000, 'NEFT from Yesbank', '2024-09-05', 'REF ID: 424910066741', 1, '2024-09-07 01:28:36'),
(90, '8', 6608, 'NEFT from Yesbank', '2024-09-05', 'ref id: 424911077004', 1, '2024-09-08 10:45:53'),
(91, '8', 702, 'NEFT from Yesbank', '2024-07-25', 'ref id: 420716286978', 1, '2024-09-08 10:46:38'),
(92, '8', 6608, 'NEFT from Yesbank', '2024-07-23', 'ref iD: YESIB42051608031 P', 1, '2024-09-08 10:47:35'),
(93, '8', 885, 'NEFT from Yesbank', '2024-06-03', 'ref id: 415513059905', 1, '2024-09-08 10:48:11'),
(94, '8', 761, 'NEFT from Yesbank', '2024-06-03', 'ref id: 415513057265', 1, '2024-09-08 10:49:44'),
(95, '20', 1505, 'NEFT from Yesbank', '2024-08-13', 'ref id: 422613084457', 1, '2024-09-08 10:53:18'),
(96, '20', 12508, 'NEFT from Yesbank', '2024-07-30', 're id: 421214105123', 1, '2024-09-08 10:54:07'),
(97, '20', 11939, 'NEFT from Yesbank', '2024-07-05', 'ref id: 418715065123', 1, '2024-09-08 10:55:03'),
(98, '20', 5000, 'NEFT from Yesbank', '2024-07-05', 'ref id: 418714053477', 1, '2024-09-08 10:55:45'),
(99, '20', 661, 'NEFT from Yesbank', '2024-05-24', 'RRN:414512053831', 1, '2024-09-08 10:56:25'),
(100, '20', 22007, 'NEFT from Yesbank', '2024-05-20', 'RRN:414115055626', 1, '2024-09-08 10:57:00'),
(101, '661', 1510, 'NEFT from Yesbank', '2024-08-28', 'Cr-BARB0DOHADX', 2, '2024-09-08 10:58:54'),
(102, '661', 5948, 'NEFT from Yesbank', '2024-07-02', 'Cr-BARB0DOHADX', 2, '2024-09-08 10:59:35'),
(103, '814', 47200, 'NEFT from Yesbank', '2024-08-28', 'Cr-HDFC0000240', 2, '2024-09-08 11:00:50'),
(104, '814', 47200, 'NEFT from Yesbank', '2024-08-28', 'Cr-HDFC0000240', 2, '2024-09-08 11:00:50'),
(105, '814', 47200, 'NEFT from Yesbank', '2024-06-15', ' Cr-HDFC0000240', 2, '2024-09-08 11:01:33'),
(106, '821', 13452, 'NEFT from Yesbank', '2024-09-04', 'Cr-HDFC0000240', 2, '2024-09-08 11:02:49'),
(107, '821', 14042, 'NEFT from Yesbank', '2024-08-21', 'Cr-HDFC0000240', 2, '2024-09-08 11:03:40'),
(108, '821', 13452, 'NEFT from Yesbank', '2024-07-15', ' Cr-HDFC0000240', 2, '2024-09-08 11:04:33'),
(109, '702', 13452, 'NEFT from Yesbank', '2024-08-09', ' Cr-HDFC0000240', 2, '2024-09-08 11:13:01'),
(110, '702', 14042, 'NEFT from Yesbank', '2024-07-29', ' Cr-HDFC0000240', 2, '2024-09-08 11:13:44'),
(111, '702', 13747, 'NEFT from Yesbank', '2024-06-28', 'Cr-HDFC0000240', 2, '2024-09-08 11:14:23'),
(112, '940', 60652, 'NEFT from Yesbank', '2024-09-05', ' Cr-HDFC0004340', 2, '2024-09-08 11:18:17'),
(113, '940', 30326, 'NEFT from Yesbank', '2024-07-14', 'RRN:419610709080', 2, '2024-09-08 11:19:12'),
(114, '940', 30326, 'NEFT from Yesbank', '2024-06-28', 'Cr-ICIC0SF0002', 2, '2024-09-08 11:19:50'),
(115, '812', 15104, 'NEFT from Yesbank', '2024-09-04', 'Cr-HDFC0000240', 2, '2024-09-08 11:51:15'),
(116, '812', 30444, 'NEFT from Yesbank', '2024-08-20', 'Cr-HDFC0000240', 2, '2024-09-08 11:51:48'),
(117, '812', 15222, 'NEFT from Yesbank', '2024-07-29', 'Cr-HDFC0000240', 2, '2024-09-08 11:52:16'),
(118, '812', 18762, 'NEFT from Yesbank', '2024-07-08', ' Cr-HDFC0000240', 2, '2024-09-08 11:53:11'),
(119, '812', 15222, 'NEFT from Yesbank', '2024-06-20', 'Cr-HDFC0000240', 2, '2024-09-08 11:53:35'),
(120, '812', 15222, 'NEFT from Yesbank', '2024-06-10', 'Cr-HDFC0000240', 2, '2024-09-08 11:54:15'),
(121, '515', 13452, 'NEFT from Yesbank', '2024-07-15', 'Cr-HDFC0000240', 2, '2024-09-08 11:57:14'),
(122, '701', 13452, 'NEFT from Yesbank', '2024-07-23', ' Cr-HDFC0000240', 2, '2024-09-08 11:58:22'),
(123, '706', 4307, 'NEFT from Yesbank', '2024-08-12', 'Cr-ICIC0SF0002', 2, '2024-09-08 12:09:15'),
(124, '706', 19116, 'NEFT from Yesbank', '2024-07-29', 'Cr-ICIC0000103', 2, '2024-09-08 12:09:45'),
(125, '706', 4307, 'NEFT from Yesbank', '2024-06-25', 'Cr-ICIC0SF0002', 2, '2024-09-08 01:01:29'),
(126, '706', 4307, 'NEFT from Yesbank', '2024-04-16', 'Cr-ICIC0SF0002', 2, '2024-09-08 01:02:31'),
(127, '805', 33040, 'NEFT from Yesbank', '2024-09-04', ' Cr-HDFC0000240', 2, '2024-09-08 01:04:44'),
(128, '489', 19942, 'NEFT from Yesbank', '2024-08-26', 'Cr-HDFC0000240', 2, '2024-09-08 01:05:23'),
(129, '805', 17842, 'NEFT from Yesbank', '2024-08-24', 'Cr-HDFC0000240', 2, '2024-09-08 01:06:08'),
(130, '805', 76464, 'NEFT from Yesbank', '2024-08-14', 'Cr-HDFC0000240', 2, '2024-09-08 01:07:12'),
(131, '489', 34928, 'NEFT from Yesbank', '2024-07-06', 'Cr-HDFC0000240', 2, '2024-09-08 01:08:08'),
(132, '489', 29972, 'NEFT from Yesbank', '2024-05-17', ' Cr-HDFC0000240', 2, '2024-09-08 01:08:55'),
(133, '489', 14868, 'NEFT from Yesbank', '2024-05-15', 'Cr-HDFC0000240', 2, '2024-09-08 01:09:37'),
(134, '18', 50000, 'NEFT from Yesbank', '2024-09-09', 'ref id: 425309042264', 1, '2024-09-09 06:19:38'),
(135, '18', 50000, 'NEFT from Yesbank', '2024-09-10', 'ref id: 425413135755', 1, '2024-09-10 01:50:49'),
(136, '18', 50000, 'NEFT from Yesbank', '2024-09-13', 'ref id: 425711084728', 1, '2024-09-13 11:32:07'),
(137, '18', 50000, 'NEFT from Yesbank', '2024-09-16', 'ref id: 426011050940', 1, '2024-09-16 11:23:59'),
(138, '18', 50000, 'NEFT from Yesbank', '2024-09-25', 'ref id: 426909063978', 1, '2024-09-25 02:52:41'),
(139, '18', 50000, 'NEFT from Yesbank', '2024-09-23', 'ref  id: 426713115538', 1, '2024-09-25 02:53:20'),
(140, '18', 50000, 'NEFT from Yesbank', '2024-09-21', 'ref id:426515120121', 1, '2024-09-25 02:54:06'),
(141, '19', 50000, 'NEFT from Yesbank', '2024-09-28', 'ref id: 427212082791', 1, '2024-09-28 12:32:30'),
(142, '1', 100000, 'NEFT from Yesbank', '2024-10-02', 'ref id: 427610299466', 1, '2024-10-02 10:19:24'),
(143, '19', 50000, 'NEFT from Yesbank', '2024-10-01', 'ref id: 427509085185', 1, '2024-10-07 11:15:14'),
(144, '19', 50000, 'NEFT from Yesbank', '2024-10-04', 'ref id: YESOB42782534082', 1, '2024-10-07 11:15:59'),
(145, '18', 50000, 'NEFT from Yesbank', '2024-10-05', 'ref id: 427911198953', 1, '2024-10-07 11:17:09'),
(146, '19', 50000, 'NEFT from Yesbank', '2024-10-07', 'ref id: 428111092660', 1, '2024-10-07 11:19:51'),
(147, '19', 50000, 'NEFT from Yesbank', '2024-10-09', 'ref id: 428312138522', 1, '2024-10-23 01:45:29'),
(148, '19', 49500, 'neft from icici bank', '2024-10-23', 'icic REF ID: 1741702366', 1, '2024-10-23 02:01:55'),
(149, '19', 500, 'NEFT from Yesbank', '2024-10-23', 'ICIC REF ID: 1741687405', 1, '2024-10-23 02:02:40'),
(150, '19', 50000, 'NEFT from Yesbank', '2024-10-25', 'icici ref id: 1743852169', 1, '2024-11-05 11:42:44'),
(151, '19', 50000, 'NEFT from Yesbank', '2024-10-25', 'icici ref id: 1743852169', 1, '2024-11-05 11:42:44'),
(152, '19', 50000, 'NEFT from Yesbank', '2024-11-05', 'ICICI REF ID: 1756187782', 1, '2024-11-05 11:46:51'),
(153, '19', 50000, 'NEFT from Yesbank', '2024-11-05', 'ICICI REF ID: 1756187782', 1, '2024-11-05 11:46:51');

-- --------------------------------------------------------

--
-- Table structure for table `paymode`
--

CREATE TABLE `paymode` (
  `mid` int(30) NOT NULL,
  `mode` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `paymode`
--

INSERT INTO `paymode` (`mid`, `mode`) VALUES
(1, 'NEFT from Yesbank'),
(2, 'Google pay'),
(3, 'neft from icici bank');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `p_id` int(5) NOT NULL,
  `name` varchar(100) NOT NULL,
  `hsn` int(10) NOT NULL,
  `description` varchar(30) NOT NULL,
  `p_type` varchar(50) NOT NULL,
  `created` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`p_id`, `name`, `hsn`, `description`, `p_type`, `created`) VALUES
(1, 'CT- 01 HandHeld Manual Coder', 8443, 'Font Kit 2.5 mm', 'Machine', '2020-07-02'),
(2, 'CT- 02 Handy Marker for Currogated Cartons', 8443, 'Font kit 10 mm', 'Machine', '2022-02-26'),
(3, 'CT-03 Handy Marker for HDPE Bags', 8443, 'Font kit 12mm', 'Machine', '2022-02-26'),
(4, 'CT-05 Table Top Coder ', 8443, 'Complete set', 'Machine', '2020-12-16'),
(5, 'CT-07 Standard Multipurpose Coder', 8443, 'Wooden Packing', 'Machine', '2020-12-21'),
(6, 'CT-07 Ice Cream Multipurpose Coder', 8443, 'Includes Wooden Packing', 'Machine', '2020-12-21'),
(7, '2in1 coder', 8443, 'includes wooden packing', 'Machine', '2020-05-05'),
(8, 'Standard Carton Coder', 8443, 'With Counting Sensor and Delta', 'Machine', '2020-05-14'),
(14, 'Inkpad', 8443, 'white font pad', 'Consumables', '2020-06-04'),
(15, 'Inkpad Holder', 8443, 'Black plastic form pad holder', 'Consumables', '2020-06-04'),
(17, 'High Speed Carton Stracker', 8443, 'Standard', 'Machine', '2020-06-07'),
(18, 'SpgInk', 8443, 'Antifreeze', 'Consumables', '2020-06-08'),
(19, 'C - Feeding Rubber', 8443, 'Carton Feeding Rubber ', 'Consumables', '2020-06-08'),
(20, 'L - Feeding Rubber', 8443, 'Label Feeding Rubber', 'Consumables', '2020-06-08'),
(21, 'Paste Ink', 8443, 'Paste Ink', 'Consumables', '2020-06-08'),
(25, 'Black Rubber strip Plain', 8443, 'Rubber strip', 'Consumables', '2020-06-10'),
(26, 'Anti-Freeze Fast Dry Ink', 8443, 'antifreeze', 'Consumables', '2020-06-19'),
(27, 'Font Kit 3 mm', 8443, 'Normal by sunita', 'Consumables', '2020-06-26'),
(28, 'Font Kit 4 mm', 8443, 'font kit orange ', 'Consumables', '2020-06-26'),
(29, 'Groove Sheet', 8443, 'Black ', 'Consumables', '2020-06-26'),
(31, 'Courier', 8443, 'trackon, mahaveer', 'Freight', '2020-07-05'),
(32, 'Wooden Packing', 8443, 'wooden', 'Freight', '2020-07-05'),
(33, 'Freight Charges', 8443, 'freight', 'Freight', '2020-09-07'),
(34, 'Mini High Speed Inkjet Stacker ', 8443, 'ade', 'Machine', '2023-07-25'),
(36, 'Font Kit 2mm', 8443, 'sd', 'Consumables', '2020-06-11'),
(37, 'Ink Roll', 8443, 'hjk', 'Consumables', '2020-07-21'),
(38, 'Porous Ink Roll', 8443, '645654', 'Consumables', '2020-07-20'),
(39, 'Spring', 8443, '5654', 'Consumables', '2020-07-20'),
(40, 'TUFT Pink Belt For High Speed Stracker', 8443, 'dfgdrh', 'Consumables', '2020-07-22'),
(41, 'Grooved Logo Sheet', 8443, 'ytrhrth', 'Consumables', '2020-07-28'),
(42, 'Ink-Aid', 8443, 'INK AID', 'Consumables', '2020-08-24'),
(43, 'Standard Label Coder', 8443, 'Label Coder', 'Machine', '2020-09-03'),
(44, 'High Speed Pouch Inkjet Stracker ', 8443, 'adsjdsahsdkjh', 'Machine', '2020-09-07'),
(45, 'Font Kit 12 mm', 8443, 'kjdfhkjshkl', 'Consumables', '2020-09-14'),
(46, 'Logo Sheet', 8443, 'jsdhkjsah', 'Consumables', '2020-09-14'),
(47, 'CT - 14 High Speed Inkjet Stracker', 8443, 'sjhsak', 'Machine', '2020-10-05'),
(48, 'Font Kit 25mm', 8443, 'therhgrth', 'Consumables', '2020-10-20'),
(49, 'Code Equipment', 8443, 'ddfus', 'Consumables', '2020-10-23'),
(50, 'Font kit 10 mm', 8443, 'jdsnkjd', 'Consumables', '2020-10-24'),
(51, 'Font kit 6mm', 8443, 'defewf', 'Consumables', '2020-10-29'),
(52, 'Font kit 14 mm', 8443, 'kljlkj', 'Consumables', '2020-12-14'),
(53, 'Handy Marker for Jute Bags', 8443, '8232', 'Machine', '2020-12-14'),
(54, 'Ice Cream 2in1 Coder', 8443, 'hgsdajhg', 'Machine', '2021-01-11'),
(55, 'Packing and forwarding', 8443, 'ewe', 'Freight', '2021-02-06'),
(56, 'Stereo Sheet 2mm', 8443, 'thtrfh', 'Consumables', '2021-03-06'),
(57, 'Stereo Sheet 3mm', 8443, 'fdgdtrh', 'Consumables', '2021-03-06'),
(58, '2in Gear 7.5 inch dia', 8443, 'l[ihwieoiqh', 'Consumables', '2021-03-12'),
(59, 'Feeding Rubber', 8443, 'hdjkshk', 'Consumables', '2021-03-15'),
(61, 'HDPE Bag Ink', 8443, 'fdkljhf', 'Consumables', '2020-05-28'),
(62, 'Plain Pad', 8443, 'dsjsk', 'Consumables', '2021-04-06'),
(63, '2 Sided Tape ', 8443, 'dsidsji', 'Consumables', '2021-04-06'),
(64, 'Box Ink', 8443, 'jytj', 'Consumables', '2021-04-07'),
(65, 'Font kit 8 mm', 8443, '21445', 'Consumables', '2021-04-10'),
(66, 'Delta VFD Drive + Multispan Counter', 8443, 'dslihwejkh', 'Consumables', '2021-04-13'),
(67, 'Hand Printer', 84229090, 'jkbiuljk', 'Machine', '2021-05-28'),
(68, 'High Speed Multipurpose Inkjet Stracker', 8443, 'dsljgfdjgb', 'Machine', '2021-06-04'),
(69, 'Pusher Assembly', 8443, 'edwejklujtgewuyy', 'Consumables', '2021-06-04'),
(70, 'NP Ink Roll', 8443, 'uktu', 'Consumables', '2021-06-09'),
(71, 'Handy Coder for Plywood', 8443, 'dsf.,khsdk', 'Machine', '2021-06-10'),
(72, 'Handy Marker for HDPE Bags', 8443, 'trete', 'Machine', '2021-06-14'),
(73, 'Font kit 20 mm', 8443, 'efe', 'Consumables', '2021-06-15'),
(74, 'Font kit 25 mm', 8443, 'ettewe', 'Consumables', '2021-06-25'),
(75, 'H.P Cartridge', 8443, '4564534', 'Consumables', '2021-06-26'),
(76, 'Handheld Inkjet Printer JD-007', 8443, 'kuhdfwkjjhk', 'Machine', '2021-09-30'),
(77, 'Wiper', 8443, 'adsskihdwoih', 'Consumables', '2021-07-12'),
(78, 'Thermal Inkjet Printer  -  T180', 8443, 'dfgdfsd', 'Machine', '2021-07-30'),
(79, 'High Speed Medical Cassete Feeder ', 8443, 'chsdkjdh', 'Machine', '2021-08-23'),
(80, 'Black Plain PVC Belt', 8443, '44444', 'Consumables', '2021-08-31'),
(81, 'Electromechanical Coder', 8443, 'dfuugsidugg', 'Consumables', '2021-09-22'),
(82, 'Metal Sensor for inkjet', 8443, 'jjdsggjuhjsdg', 'Consumables', '2021-09-24'),
(83, 'Gearbox Varam wheel with shaft', 8443, 'jsdajhkjsaha', 'Consumables', '2021-09-28'),
(84, 'Shaft Roller for Feeding Conevyor', 8443, 'kdsjgsdjg', 'Consumables', '2021-09-30'),
(85, 'High Speed Label Inkjet Feeder', 8443, 'jsdgjug', 'Machine', '2021-10-09'),
(86, 'Blue cartridge', 8443, 'gdsajhg', 'Consumables', '2021-10-13'),
(87, 'Handheld Inkjet Printer JJ-007', 8443, 'jsdguy', 'Machine', '2021-10-16'),
(88, 'H.P Solvent Cartridge', 8443, 'hgk', 'Consumables', '2021-10-21'),
(89, 'HP Water Based Cartridge', 8443, 'hgfh', 'Consumables', '2021-10-21'),
(91, 'Battery', 8443, 'gnny', 'Consumables', '2021-10-23'),
(92, 'Handy Coder for Metallic Surface', 8443, 'kjhsdiks', 'Machine', '2021-10-25'),
(93, 'Handy coder', 8443, 'kjjhdfkjh', 'Machine', '2021-11-10'),
(94, 'Handheld Inkjet printer - KGP 001', 8443, 'dhwjshvjhv', 'Machine', '2021-11-22'),
(95, 'Semi-Automatic Sticker Labeling', 8422, 'jhdsafuyf', 'Machine', '2021-11-26'),
(96, 'Extra Modification', 8422, 'isdjikk', 'Consumables', '2021-11-26'),
(97, 'Handheld Inkjet Printer - KG 001', 8443, 'jhjfdsiug', 'Machine', '2021-11-26'),
(98, 'Double bond cartridge', 8443, 'dfksuhukj', 'Consumables', '2021-12-01'),
(99, 'Motor Belt', 8443, 'kugsdfiu', 'Consumables', '2021-12-25'),
(100, 'Simple Conveyor', 8443, '767665', 'Machine', '2021-12-27'),
(101, 'Feeding Belt', 8443, 'dshkj', 'Consumables', '2021-12-31'),
(102, 'White roller with Oring', 8443, 'hdsjkgh', 'Consumables', '2021-12-31'),
(103, 'Center Roller ', 8443, 'jdfsikj', 'Consumables', '2021-12-31'),
(104, 'Encoder Wheel + Bracket', 8443, 'dsihjikjh', 'Consumables', '2021-12-31'),
(105, 'T-180 Inkjet Printer', 8443, 'dsihjikjh', 'Machine', '2022-01-03'),
(106, 'White Cartridge', 8443, 'jkbjhv', 'Consumables', '2022-01-06'),
(107, 'Handy Stand Assembly', 8443, 'bdfjeh', 'Consumables', '2022-01-10'),
(109, 'codpad printer', 8443, 'kdushkfjd', 'Machine', '2022-01-14'),
(111, 'Empty Bottle', 8443, 'kusdfgiuds', 'Consumables', '2022-01-17'),
(112, 'Encoder ', 8443, 'yryuy', 'Consumables', '2022-01-20'),
(114, 'Long Rubber -CL', 8443, 'geskj', 'Consumables', '2022-02-01'),
(115, 'Motor with Gearbox ', 8443, 'ytyt', 'Consumables', '2022-02-05'),
(116, 'Gearbox ', 8443, 'isoi', 'Consumables', '2022-02-05'),
(117, 'Duplex Gear', 8443, 'kd', 'Consumables', '2019-12-19'),
(118, 'Bronze Bush', 8443, 'jgsd', 'Consumables', '2019-12-19'),
(119, 'Reling Rubber', 8443, 'jsjhgj', 'Consumables', '2019-12-19'),
(120, 'Bosh Gear', 8443, 'kkshiu', 'Consumables', '2019-12-19'),
(121, 'Nut Bolt', 8443, 'jgsj', 'Consumables', '2020-02-24'),
(122, 'object Sensor for Inkjet', 8443, '4555', 'Consumables', '2022-03-21'),
(123, 'Solvent Ink Cartridge', 8443, 'jyj', 'Consumables', '2022-03-21'),
(124, 'Thermal  Inkjet Printer - M302 ', 8443, 'fdghrdh', 'Machine', '2022-04-11'),
(125, 'Repairing', 8443, 'yfyujyuj', 'Consumables', '2022-04-30'),
(126, 'Delta VFD Drive', 8443, 'sjdlkj', 'Consumables', '2022-05-25'),
(127, 'Green Cartridge', 8443, 'jbnj', 'Consumables', '2022-06-04'),
(128, 'Green Carton Special Belt', 8443, 'jhsdkjhsdkj', 'Consumables', '2022-09-11'),
(129, 'Ct-03 Touch Screen Coder', 8443, 'rgdfg', 'Machine', '2022-11-07'),
(130, 'Touch Screen Coder', 8443, 'ihuhiu', 'Machine', '2022-11-12'),
(131, 'Mini Printer', 8443, 'esfew', 'Machine', '2022-11-15'),
(132, 'Porous Spgink', 8443, 'hsg', 'Consumables', '2022-12-02'),
(133, 'Water Based Black Porous Ink', 8443, 'sdjgjh', 'Consumables', '2022-12-02'),
(134, 'Screw', 8443, 'lidf', 'Consumables', '2022-12-27'),
(135, 'Auto-Collector Conveyor', 8443, 'sdfdsdd', 'Machine', '2023-01-31'),
(136, 'CT - 13 Thermal Inkjet Printer ', 8443, 'kreuuijk', 'Machine', '2023-03-02'),
(137, 'Manual Induction', 8443, 'fdsfd', 'Machine', '2023-03-18'),
(138, 'Stand Bracket with sensor', 8443, 'iuoio', 'Consumables', '2023-03-27'),
(139, 'Bandsealer', 8443, 'hfhg', 'Machine', '2023-04-21'),
(140, 'weigh filler', 8443, 'uyuy', 'Machine', '2023-04-21'),
(141, 'Printer Cartridge', 8443, 'jhhk', 'Consumables', '2023-05-15'),
(142, 'Charger', 8443, 'hsdkh', 'Consumables', '2023-06-30'),
(143, 'Stereo', 8443, 'ghhfdd', 'Consumables', '2023-07-11'),
(145, 'stamp handle', 8443, 'dsfrdsfe', 'Consumables', '2023-09-29'),
(146, 'Yellow Cartridge', 8443, 'jhkj', 'Consumables', '2023-10-11'),
(147, 'Display', 8443, 'Display', 'Machine', '2023-10-16'),
(148, 'Pressure Roller for stracker', 8443, 'dfedfer', 'Consumables', '2023-11-30'),
(149, 'Print Driver Board', 8443, 'sdfhfsdkjhfi', 'Consumables', '2023-12-07'),
(150, 'Cable Strip', 8443, ',dsjhfdkjsh', 'Consumables', '2023-12-06'),
(151, 'Orings ', 8443, 'jkhsdkjhdskj', 'Consumables', '2023-12-07'),
(152, 'touch pen', 8443, 'klsdfjflkdsj', 'Consumables', '2023-12-07'),
(154, 'cartridge inserting plastic block', 8443, 'jksdhdjskh', 'Consumables', '2024-01-11'),
(155, 'Locking Stip Latch', 8443, 'dkjhkjh', 'Consumables', '2024-04-10'),
(156, 'Stand Assembly', 8443, 'wsjkeykj', 'Consumables', '2024-04-17'),
(157, 'Q Shape Plastic', 8443, '56u', 'Consumables', '2024-05-18'),
(158, 'CMos Battery Cell', 8443, 'jhgejeg', 'Consumables', '2024-05-23'),
(159, 'Touch Screen', 8443, 'dtgertr', 'Consumables', '2024-06-14'),
(160, ' Assembly for Auto-collector', 84443, 'fdkfjgkuew', 'Consumables', '2024-09-20'),
(161, 'Porter Delivery', 8443, 'sutgduig ', 'Freight', '2024-09-21'),
(162, 'Pressure Strip', 8443, 'jkdsdji', 'Consumables', '2024-10-05'),
(163, 'Metallic  Block Roller', 8443, 'shsu sai', 'Consumables', '2024-11-12');

-- --------------------------------------------------------

--
-- Table structure for table `protest`
--

CREATE TABLE `protest` (
  `orderno` int(100) NOT NULL,
  `orderid` varchar(300) NOT NULL,
  `item_name` varchar(300) NOT NULL,
  `item_desc` varchar(300) NOT NULL,
  `hsn` int(10) NOT NULL,
  `quantity` int(10) NOT NULL,
  `price` float NOT NULL,
  `total` int(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `protest2`
--

CREATE TABLE `protest2` (
  `invid` varchar(100) NOT NULL,
  `cid` int(10) NOT NULL,
  `orderid` varchar(300) NOT NULL,
  `totalitems` int(10) NOT NULL,
  `subtotal` int(100) NOT NULL,
  `taxrate` int(10) NOT NULL,
  `taxamount` int(100) NOT NULL,
  `totalamount` int(100) NOT NULL,
  `created` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `purchasecom`
--

CREATE TABLE `purchasecom` (
  `pcid` int(50) NOT NULL,
  `pcname` varchar(100) NOT NULL,
  `pcadd` varchar(100) NOT NULL,
  `pcmob` bigint(10) NOT NULL,
  `email` varchar(100) NOT NULL,
  `gst` varchar(30) NOT NULL,
  `pcomtype` varchar(10) NOT NULL,
  `country` varchar(100) NOT NULL,
  `created` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `purchasecom`
--

INSERT INTO `purchasecom` (`pcid`, `pcname`, `pcadd`, `pcmob`, `email`, `gst`, `pcomtype`, `country`, `created`) VALUES
(1, 'Vijay enterprises', 'Retro cinema near vikroli circle, mumbai', 8735003590, 'vi@gmail.com', '24AVVPC8158M1ZV', 'Loc', 'India', '2025-01-08');

-- --------------------------------------------------------

--
-- Table structure for table `purchaseinv`
--

CREATE TABLE `purchaseinv` (
  `orderno` int(100) NOT NULL,
  `orderid` varchar(300) NOT NULL,
  `item_name` varchar(300) NOT NULL,
  `item_desc` varchar(300) NOT NULL,
  `hsn` int(10) NOT NULL,
  `quantity` int(10) NOT NULL,
  `price` int(10) NOT NULL,
  `total` int(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `purchaseinv`
--

INSERT INTO `purchaseinv` (`orderno`, `orderid`, `item_name`, `item_desc`, `hsn`, `quantity`, `price`, `total`) VALUES
(4, '660d04a34f5be', 'Double bond cartridge', 'IQ 800+', 8443, 2, 3600, 7200),
(5, '660e89b310b64', 'Battery', '', 8443, 5, 1500, 7500),
(6, '660e89b310b64', 'Charger', '', 8443, 5, 500, 2500),
(8, '6610e6cb417ab', 'Stand Bracket with sensor', 'wihout sensor', 8443, 1, 4500, 4500),
(11, '6618f43869d9b', 'SpgInk', '', 8443, 10, 370, 3700),
(12, '6618f43869d9b', 'Ink-Aid', '', 8443, 10, 130, 1300),
(13, '6618f4c7bb627', 'CT- 01 HandHeld Manual Coder', 'only machine', 8443, 15, 900, 13500),
(14, '6618f4c7bb627', 'Inkpad', '', 8443, 74, 20, 1480),
(15, '661cca990db8a', 'H.P Cartridge', '', 8443, 48, 3050, 146400),
(17, '661fc871caa6a', 'Printer Cartridge', '25 mm', 8443, 6, 4300, 25800),
(18, '6623c62cb61f7', 'White Cartridge', 'IQ314S', 8443, 2, 6400, 12800),
(19, '6623ca3c75693', 'SpgInk', 'NP', 8443, 10, 390, 3900),
(20, '6623ca3c75693', 'Font Kit 12 mm', '', 8443, 2, 325, 650),
(21, '6623ca3c75693', 'Font kit 6mm', 'only number', 8443, 1, 275, 275),
(22, '6623ca3c75693', 'Packing and forwarding', '', 8443, 1, 250, 250),
(23, '6631ea92a6110', 'Printer Cartridge', 'rynan 25 mm', 8443, 5, 4300, 21500),
(24, '6631ead8b5d33', 'Locking Stip Latch', 'docod one ', 8443, 1, 1000, 1000),
(25, '6631ebbacbacd', 'Blue cartridge', '', 8443, 2, 5500, 11000),
(26, '6631ebbacbacd', 'Yellow Cartridge', '', 8443, 2, 6400, 12800),
(27, '6631ebbacbacd', 'White Cartridge', '', 8443, 1, 6400, 6400),
(28, '6631ebbacbacd', 'Printer Cartridge', 'lock - NBT30RMS - NEUROBOT', 8443, 5, 4300, 21500),
(29, '66343fdf0ca8b', 'Courier', '', 8443, 1, 7515, 7515),
(30, '663d9f1555a5e', 'Double bond cartridge', 'iq800+', 8443, 2, 3600, 7200),
(31, '663d9f1555a5e', 'Printer Cartridge', 'rynan original', 8443, 10, 4300, 43000),
(32, '663d9f1555a5e', 'Orings ', '', 8443, 5, 50, 250),
(33, '663d9f812aa7e', 'Thermal  Inkjet Printer - M302 ', 'DOUBLE HEAD', 8443, 1, 54000, 54000),
(34, '663d9f812aa7e', 'Hand Printer', '25 MM LUEB', 8443, 3, 12500, 37500),
(35, '663dc43daf0c5', 'Encoder Wheel + Bracket', 'docod', 8443, 1, 5800, 5800),
(36, '663dc43daf0c5', 'Simple Conveyor', '12 inch', 8443, 1, 18000, 18000),
(37, '6645a548d2cb2', 'Mini Printer', '', 8443, 2, 4500, 9000),
(38, '6645a5ad0e734', 'White Cartridge', 'IQ314SN', 8443, 1, 6400, 6400),
(39, '6645a5ad0e734', 'H.P Cartridge', '', 8443, 48, 3100, 148800),
(40, '6645a5dfa02dc', 'Encoder Wheel + Bracket', '', 8443, 1, 5800, 5800),
(41, '665959715fddc', 'Handheld Inkjet Printer - KG 001', 'red model', 8443, 2, 5500, 11000),
(42, '665959715fddc', 'Orings ', '', 8443, 10, 50, 500),
(43, '665959715fddc', 'Courier', '', 8443, 1, 169, 169),
(44, '66595a8fcd24a', 'CT- 02 Handy Marker for Currogated Cartons', '4x14 inch', 8443, 5, 1100, 5500),
(45, '66595a8fcd24a', 'CT- 02 Handy Marker for Currogated Cartons', '3x12 inch', 8443, 5, 950, 4750),
(46, '66595a8fcd24a', 'SpgInk', '', 8443, 10, 390, 3900),
(47, '66595a8fcd24a', 'Font kit 10 mm', '', 8443, 2, 325, 650),
(48, '66595a8fcd24a', 'Font Kit 12 mm', '', 8443, 2, 325, 650),
(49, '66595a8fcd24a', 'Ink Roll', 'NP', 8443, 5, 450, 2250),
(50, '66595a8fcd24a', 'Freight Charges', '', 8443, 1, 298, 298),
(51, '66595a8fcd24a', 'Font kit 14 mm', '', 8443, 2, 325, 650),
(52, '66595ad86b4b2', 'Ink-Aid', '', 8443, 3, 120, 360),
(53, '66595ad86b4b2', 'Spring', '', 8443, 20, 10, 200),
(54, '66595b1a135bb', 'Thermal  Inkjet Printer - M302 ', 'T220E', 8443, 1, 29500, 29500),
(55, '66595b1a135bb', 'Encoder Wheel + Bracket', '', 8443, 1, 5500, 5500),
(56, '665960616f04c', 'TUFT Pink Belt For High Speed Stracker', '', 8443, 2, 1300, 2600),
(57, '665d64bc71217', 'Printer Cartridge', '25 MM', 8443, 20, 4300, 86000),
(58, '665eb89c2c031', 'Mini High Speed Inkjet Stacker ', 'ONLY CONVEYOR OR RUCHI ', 8443, 1, 50000, 50000),
(59, '665eb89c2c031', 'Wooden Packing', '', 8443, 1, 2800, 2800),
(60, '665ee514b64ad', 'Courier', '', 8443, 1, 7005, 7005),
(61, '66795d63072e2', 'H.P Cartridge', '', 8443, 48, 3050, 146400),
(62, '66795dbb1fae9', 'Stand Bracket with sensor', '', 8443, 2, 4200, 8400),
(63, '66795e322815e', 'SpgInk', 'BLUE NWCC', 8443, 1, 565, 565),
(64, '66795e322815e', 'Font Kit 25mm', '', 8443, 1, 750, 750),
(65, '66795e322815e', 'Courier', '', 8443, 1, 80, 80),
(66, '66795e9403675', 'Blue cartridge', '', 8443, 1, 5500, 5500),
(67, '66795ed162fd3', 'White Cartridge', '', 8443, 2, 6400, 12800),
(68, '667bb5120c85f', 'Handheld Inkjet Printer JD-007', '', 8443, 20, 7500, 150000),
(69, '66893c215b9f0', 'CT - 13 Thermal Inkjet Printer ', '', 8443, 2, 23000, 46000),
(70, '66893c215b9f0', 'Locking Stip Latch', '', 8443, 5, 200, 1000),
(71, '66893c94418e3', 'Courier', '', 8443, 1, 4850, 4850),
(72, '66893fde77890', 'Simple Conveyor', '', 8443, 1, 15000, 15000),
(73, '668940266404e', 'Printer Cartridge', '25 MM', 8443, 10, 4300, 43000),
(74, '6689406c5a85a', 'Handheld Inkjet Printer JJ-007', '25 MM', 8443, 3, 11500, 34500),
(75, '66a77d6d0fd94', 'Font Kit 25mm', '', 8443, 3, 425, 1275),
(76, '66a77d6d0fd94', 'Font kit 14 mm', '', 8443, 2, 325, 650),
(77, '66a77d6d0fd94', 'Font Kit 12 mm', '', 8443, 3, 325, 975),
(78, '66a77d6d0fd94', 'Font kit 10 mm', '', 8443, 3, 325, 975),
(79, '66a77d6d0fd94', 'Font kit 8 mm', '', 8443, 2, 275, 550),
(80, '66a77d6d0fd94', 'Font kit 6mm', '', 8443, 2, 275, 550),
(81, '66a77d6d0fd94', 'SpgInk', '', 8443, 10, 390, 3900),
(82, '66a77d6d0fd94', 'SpgInk', 'green ', 8443, 1, 430, 430),
(83, '66a77d6d0fd94', 'CT- 02 Handy Marker for Currogated Cartons', '', 8443, 5, 950, 4750),
(84, '66a77d6d0fd94', 'Freight Charges', '', 8443, 1, 300, 300),
(85, '66a77dc10149b', 'Logo Sheet', 'veg symbol', 8443, 3, 190, 570),
(86, '66a77dc10149b', 'Courier', '', 8443, 1, 90, 90),
(87, '66a77dfe4a540', 'Printer Cartridge', 'rynan', 8443, 20, 4300, 86000),
(88, '66a77e4d448ef', 'Handheld Inkjet Printer JJ-007', '', 8443, 1, 11000, 11000),
(89, '66a77e86157fd', 'Handheld Inkjet Printer JJ-007', '25 mm', 8443, 1, 11000, 11000),
(90, '66a77ec13c178', 'White Cartridge', '', 8443, 2, 6400, 12800),
(91, '66a77ef9173b4', 'Mini Printer', '', 8443, 5, 4000, 20000),
(94, '66a77f3517bdd', 'H.P Cartridge', '', 8443, 48, 3050, 146400),
(95, '66a77f3517bdd', 'White Cartridge', '', 8443, 1, 6400, 6400),
(96, '66a77fae1f0ca', 'Yellow Cartridge', '', 8443, 2, 6400, 12800),
(97, '66a780104343f', 'SpgInk', '', 8443, 10, 365, 3650),
(98, '66a780104343f', 'Ink-Aid', '', 8443, 15, 130, 1950),
(99, '66a780583f455', 'SpgInk', 'WHITE', 8443, 1, 515, 515),
(100, '66a780583f455', 'Courier', '', 8443, 1, 80, 80),
(101, '66a7809541eac', 'White Cartridge', '', 8443, 2, 6400, 12800),
(102, '66aca274c0457', 'SpgInk', 'NP', 8443, 15, 390, 5850),
(103, '66aca274c0457', 'CT-03 Handy Marker for HDPE Bags', '4x14 inch', 8443, 2, 1100, 2200),
(104, '66aca274c0457', 'Ink Roll', '4x14 inch', 8443, 5, 450, 2250),
(105, '66aca274c0457', 'Freight Charges', '', 8443, 1, 300, 300),
(106, '66add078217de', 'Courier', '', 8443, 1, 6595, 6595),
(107, '66b44f30a00f1', 'Blue cartridge', '', 8443, 2, 5500, 11000),
(108, '66c0a844f335f', 'H.P Cartridge', '', 8443, 38, 3050, 115900),
(109, '66c0a844f335f', 'White Cartridge', '', 8443, 5, 6400, 32000),
(110, '66c0a8861a30f', 'Font Kit 25mm', '', 8443, 3, 425, 1275),
(111, '66c0aa0b82771', 'Logo Sheet', 'RUBBER TECH LOGO', 8443, 3, 550, 1650),
(112, '66c0aa0b82771', 'Courier', '', 8443, 1, 139, 139),
(113, '66c0aa5e066b5', 'High Speed Multipurpose Inkjet Stracker', 'ROTOMOTIVE ', 8443, 1, 75000, 75000),
(114, '66c0aa5e066b5', 'Wooden Packing', '', 8443, 1, 3500, 3500),
(115, '66c0aaadb31a9', 'High Speed Multipurpose Inkjet Stracker', 'ROTOMOTIVE', 8443, 1, 75000, 75000),
(116, '66c0aaadb31a9', 'Wooden Packing', '', 8443, 1, 3500, 3500),
(117, '66c0aade9d8e1', 'High Speed Multipurpose Inkjet Stracker', '', 8443, 1, 73000, 73000),
(118, '66c0ab61e0daf', 'High Speed Multipurpose Inkjet Stracker', '', 8443, 1, 73000, 73000),
(119, '66c9c8c4bc391', 'Printer Cartridge', '25 mm', 8443, 14, 4200, 58800),
(120, '66c9c8c4bc391', 'Locking Stip Latch', '', 8443, 4, 330, 1320),
(121, '66d579ff907c9', 'Printer Cartridge', '', 8443, 5, 4300, 21500),
(122, '66dc0491dfe52', 'TUFT Pink Belt For High Speed Stracker', '980X45', 8443, 6, 1500, 9000),
(123, '66dc0491dfe52', 'Pressure Roller for stracker', '', 8443, 10, 400, 4000),
(124, '66dc04e796b74', 'H.P Cartridge', '', 8443, 48, 3050, 146400),
(125, '66dc053a20121', 'Printer Cartridge', '', 8443, 40, 4300, 172000),
(126, '66dc06bdb1e97', 'Touch Screen Coder', 'ONLINE SILVER DISPLAY 1 YEAR WARRANTY', 8443, 1, 11500, 11500),
(127, '66dd2c63bb740', 'Courier', '', 8443, 1, 7520, 7520),
(129, '66e3ec845536a', 'Mini Printer', '', 8443, 3, 3500, 10500),
(130, '66e7c65631abb', 'Handheld Inkjet Printer JJ-007', '25 mm', 8443, 1, 11000, 11000),
(131, '66e7c65631abb', 'White Cartridge', '', 8443, 2, 6400, 12800),
(132, '66e7c6c4d5455', 'SpgInk', '', 8443, 10, 365, 3650),
(133, '66e7c6c4d5455', 'Ink-Aid', '', 8443, 15, 130, 1950),
(134, '66f3cc7e68491', 'Thermal  Inkjet Printer - M302 ', '', 8443, 1, 27800, 27800),
(135, '66f3cd6add3a4', 'Screw', 'Wallpaper sheet', 8443, 110, 12, 1320),
(136, '66f3cdf691cd7', 'SpgInk', '', 8443, 15, 390, 5850),
(137, '66f3cdf691cd7', 'Ink Roll', '3x12 inch ', 8443, 10, 350, 3500),
(138, '66f3cdf691cd7', 'Freight Charges', '', 8443, 1, 250, 250),
(139, '66f3cf43cf202', 'Double bond cartridge', '', 8443, 1, 3600, 3600),
(140, '66f3cfa7a2940', 'Handheld Inkjet Printer JJ-007', '25 mm', 8443, 2, 11000, 22000),
(141, '66f3d12a2a07e', 'Double bond cartridge', '', 8443, 2, 3600, 7200),
(142, '66f7a49086373', 'Thermal  Inkjet Printer - M302 ', '', 8443, 2, 27500, 55000),
(144, '670368ab01dab', 'High Speed Pouch Inkjet Stracker ', '', 8443, 1, 73000, 73000),
(145, '670368ab01dab', 'Wooden Packing', '', 8443, 1, 3500, 3500),
(146, '6703690427c37', 'Handheld Inkjet Printer JJ-007', '', 8443, 4, 7500, 30000),
(147, '670369cc63eff', 'Courier', '', 996812, 1, 6315, 6315),
(148, '67062975793ff', 'Stand Bracket with sensor', 'only stand', 8443, 2, 4500, 9000),
(149, '67062975793ff', 'Locking Stip Latch', 'docod', 8443, 2, 700, 1400),
(150, '670629b96fd9e', 'Double bond cartridge', '', 8443, 2, 3600, 7200),
(151, '67062a56a7861', 'H.P Cartridge', '', 8443, 48, 3050, 146400),
(152, '6718b3944e59b', 'Printer Cartridge', '25 MM', 8443, 10, 4300, 43000),
(153, '6729b7ff1e03a', 'Handheld Inkjet Printer JJ-007', 'HALF INCH', 8443, 12, 7500, 90000),
(154, '6729b7ff1e03a', 'Handheld Inkjet Printer JJ-007', '1 INCH ', 8443, 2, 11000, 22000),
(155, '6729b7ff1e03a', 'Orings ', 'WITH LATCH', 8443, 5, 300, 1500),
(157, '6731ba4d5bd3f', 'Courier', '', 8443, 1, 3675, 3675),
(158, '6731bac4bb05a', 'Encoder Wheel + Bracket', 'docod', 8443, 1, 5500, 5500),
(159, '6731bb9ee2e14', 'Font kit 8 mm', 'only no.', 8443, 2, 275, 550),
(160, '6731bb9ee2e14', 'Font kit 8 mm', 'alphanumeric', 8443, 2, 275, 550),
(161, '6731bb9ee2e14', 'Font Kit 12 mm', '', 8443, 3, 325, 975),
(162, '6731bb9ee2e14', 'Font kit 6mm', '', 8443, 1, 275, 275),
(163, '6731bb9ee2e14', 'Courier', '', 8443, 1, 200, 200),
(164, '6731bbf5cebe4', 'Charger', 'sata casing ', 8443, 1, 720, 720);

-- --------------------------------------------------------

--
-- Table structure for table `purchaseinv2`
--

CREATE TABLE `purchaseinv2` (
  `nid` int(100) NOT NULL,
  `invid` varchar(100) NOT NULL,
  `cid` int(10) NOT NULL,
  `invdate` date NOT NULL,
  `orderid` varchar(300) NOT NULL,
  `totalitems` int(10) NOT NULL,
  `subtotal` int(100) NOT NULL,
  `taxrate` int(10) NOT NULL,
  `taxamount` int(100) NOT NULL,
  `totalamount` int(100) NOT NULL,
  `created` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `purchaseinv2`
--



-- --------------------------------------------------------

--
-- Table structure for table `quickquote`
--

CREATE TABLE `quickquote` (
  `q_id` varchar(100) NOT NULL,
  `p_id` int(50) NOT NULL,
  `mob` varchar(50) NOT NULL,
  `quantity` varchar(50) NOT NULL,
  `price` varchar(50) NOT NULL,
  `subtotal` int(50) NOT NULL,
  `gst` int(50) NOT NULL,
  `total` int(50) NOT NULL,
  `created` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `quickquote`
--

INSERT INTO `quickquote` (`q_id`, `p_id`, `mob`, `quantity`, `price`, `subtotal`, `gst`, `total`, `created`) VALUES
('QUICKT/24-25/0001', 1, '+9197376933302', '1', '3000', 3000, 18, 3540, '2024-04-19 17:23:21'),
('QUICKT/24-25/0002', 2, '7600158240', '2', '3000', 6000, 1080, 7080, '2024-04-20 04:19:48'),
('QUICKT/24-25/0003', 78, '93310 78188', '1', '120000', 120000, 21600, 141600, '2024-04-23 03:27:55'),
('QUICKT/24-25/0004', 76, '9823558536', '1', '18500', 18500, 3330, 21830, '2024-05-15 03:12:32'),
('QUICKT/24-25/0005', 1, '8735003590', '1', '3000', 3000, 540, 3540, '2024-06-11 07:24:33'),
('QUICKT/24-25/0006', 1, '8735003590', '1', '3000', 3000, 540, 3540, '2024-06-23 11:30:40'),
('QUICKT/24-25/0007', 1, '8735003590', '1', '500', 500, 90, 590, '2024-12-08 07:17:48');

-- --------------------------------------------------------

--
-- Table structure for table `quote`
--

CREATE TABLE `quote` (
  `orderno` int(100) NOT NULL,
  `orderid` varchar(300) NOT NULL,
  `item_name` varchar(300) NOT NULL,
  `quantity` int(10) NOT NULL,
  `price` int(10) NOT NULL,
  `total` int(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `quote2`
--

CREATE TABLE `quote2` (
  `invid` varchar(100) NOT NULL,
  `cid` int(10) NOT NULL,
  `orderid` varchar(300) NOT NULL,
  `totalitems` int(10) NOT NULL,
  `subtotal` int(100) NOT NULL,
  `taxrate` int(10) NOT NULL,
  `taxamount` int(100) NOT NULL,
  `totalamount` int(100) NOT NULL,
  `created` date NOT NULL,
  `note` varchar(300) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `techsps`
--

CREATE TABLE `techsps` (
  `tid` int(5) NOT NULL,
  `p_id` int(5) NOT NULL,
  `img_loc` varchar(300) DEFAULT NULL,
  `techs` varchar(800) NOT NULL,
  `subcat` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `techsps`
--

INSERT INTO `techsps` (`tid`, `p_id`, `img_loc`, `techs`, `subcat`) VALUES
(1, 1, 'undefined', 'Printing Area : 35 x 60 mm (LxB); Prints using Grooves Rubber based stereo (3; MM); Ink- Fast dry & Water Resistant; Weight 0.5 kgs; Comes with 500ml ink, 500ml Cleaner, Groove fonts & Inkpad (2pcs)', 'Manual Batch Coding Machine'),
(2, 2, 'handy box.jpg', 'Printing Area : 3x12 inch (LxB);Prints using Grooves Rubber based stereo (12  MM); Ink Roller – Rechargeable high capacity porous ink;Impression -  1,000 per charge of 20ml / 40ml. /10 ml(depending upon no. of lines printed);Weight - 3kgs;Comes with 1 liter porus ink.', 'Manual Batch Coding Machine'),
(3, 3, 'handy bag.jpg', 'Printing Area : 3x12 inch (LxB);Prints using Grooves Rubber based stereo (12  MM);Ink Roller – Rechargeable high capacity non porous ink;Impression -  1,000 per charge of 20ml / 40ml. /10 ml. (depending upon no. of lines printed);Weight - 3kgs;Comes with 1 liter HDPE ink, 1 Liter ink-aid & Tools.', 'Manual Batch Coding Machine'),
(4, 4, 'table top.jpg', 'Printing Area – 35 x 35 mm (LxB);Operating Method – Foot Switch & Continuous Both.;Power – 230 V AC 50 Hz;Print material: rubber stereo 3 mm sheet.;Comes with -  PLC motor, Liquid Fast dry Ink(500 ml),ink Roll, Form Pad, Tools, Circuit Board controller, Cleaner(500 ml).; Printing Speed (Max) - 60 Nos/Min.;Comes with Complete protective box', 'Semi Automatic Batch Coding Machine'),
(5, 87, 'handheld inkjet.jpg', 'Max.Print Height : 12.7 mm;Max. Speed : 30-40 per/min.;LCD Display with print head;Comes along pen drive, ink cartridge, charger, SS Frame & Battery;1 year warranty;NO Courier Charges', 'Handy Inkjet Printer'),
(6, 5, '2in1.jpg', 'Overall Dimensions: 1070 x 680 x 450;Speed: 150 cartons/min.  250 labels/min.;Pouch/Carton Size: 80mm x 40mm to 305mm x 200mm;Power : 0.5HP  3 phase;Weight: Approx. 100 Kgs;Prints using Rubber Stereo.;Materials along with m/c: 500ml paste Ink, tape roll,Tools.', 'Automatic Batch Coding Machine'),
(7, 76, 'Handheld inkjet printer.jpg', 'Max.Print Height : 12. 7 mm;Max. Speed : 30-40 per/min.;LCD Display with print head;Comes along pen drive, ink cartridge, charger, SS Frame & Battery;1 year warranty;NO Courier Charges', 'Handy Inkjet Printer'),
(8, 7, '2in1.jpg', 'Overall Dimensions: 1070 x 680 x 450;Speed: 150 cartons/min.  250 labels/min.;Pouch/Carton Size: 80mm x 40mm to 305mm x 200mm;Power : 0.5HP  3 phase;Weight: Approx. 100 Kgs;Prints using Rubber Stereo.;Materials along with m/c: 500ml paste Ink, tape roll,Tools.', 'Automatic Batch Coding Machines'),
(9, 6, '2in1.jpg', 'Overall Dimensions: 1070 x 680 x 450;Speed: 150 cartons/min.  250 labels/min.;Pouch/Carton Size: 80mm x 40mm to 305mm x 200mm;Power : 0.5HP  3 phase;Weight: Approx. 100 Kgs;Prints using Rubber Stereo.;Materials along with m/c: 500ml paste Ink, tape roll,Tools.', 'Automatic Batch Coding Machines'),
(10, 81, 'table top.jpg', 'Printing Area – 35 x 35 mm (LxB);Operating Method – Foot Switch & Continuous Both.;Power – 230 V AC 50 Hz;Print material: rubber stereo 3 mm sheet.;Comes with -  PLC motor, Liquid Fast dry Ink(500 ml),ink Roll, Form Pad, Tools, Circuit Board controller, Cleaner(500 ml).; Printing Speed (Max) - 60 Nos/Min.;Comes with Complete protective box', 'Semi Automatic Batch Coding Machine'),
(11, 8, 'standard carton.jpg', 'Overall Dimensions: 1010 x 690 x 590;Speed:   250 cartons/min.;Carton Size: 80mm x 25mm to 305mm x 200mm;Power : 0.5HP  3 phase;Weight: Approx. 102 Kgs;Prints using Rubber Stereo.;Materials along m/c:  500ml paste Ink, tape roll,Liquid block, Tools & Liquid ink.', 'Automatic Batch coding Machine'),
(12, 43, 'standard label.jpg', 'Overall Dimensions: 880 x 530 x 460;Speed:  250 labels/min.;Label Size: 20mm x 40mm to 150mm x 200mm;Power: 0.5HP  3 phase;Weight: Approx. 80 Kgs;Prints using Rubber Stereo.;Materials along with machine: Paste ink, 2 sided tape,Tools & Feeding Rubber ', 'Automatic Batch coding Machine'),
(13, 131, 'mini printer.jpg', 'Max.Print Height : 12.7 mm;Max. Speed : 30-40 per/min.;LCD  Display;Comes along pen drive , HP original Seal Pack Black ink Cartridge , charger;NO Courier Charges', 'Handy Inkjet Printer'),
(14, 75, 'hp cartridge.jpg', '47 ml Ink Cartridge;No chip Cartridge;HP Original Seal Pack Cartridge;Print Head 12.7mm;Solvent Ink;Fast Dry & Permanent \r\n\n\n', 'Handy Inkjet Printer'),
(15, 88, 'hp cartridge.jpg', '47 ml Ink Cartridge;No chip Cartridge;HP Original Seal Pack Cartridge;Print Head 12.7mm;Solvent Ink;Fast Dry & Permanent \r\n\n\n', 'Handy Inkjet Printer'),
(16, 98, 'double bond.jpg', 'Japanese Cartridge;High cohesion on Glossy Surface;Permanent impression Guaranteed;Print material: Glossy surface, Glass bottles etc', 'Handy Inkjet Printer'),
(17, 100, 'simple conveyor.jpeg', 'Machine Length - 1500 mm; Machine Width -  350 mm;Conveyor Belt Width – 300 mm;Fully SS Make;0.25 HP Motor with Speed Controller;Completely Foldable type   \r\n\n\n', 'conveyor'),
(18, 113, 'simple conveyor.jpeg', 'Machine Length - 1500 mm; Machine Width -  350 mm;Conveyor Belt Width – 300 mm;Fully SS Make;0.25 HP Motor with Speed Controller;Completely Foldable type   \r\n\n\n', 'conveyor'),
(19, 78, 'm 302.jpg', 'Max.Print Height : 12.7 mm;Max. Speed : 80-200 per/min. (depends upon the size of samples);LCD  Display with print head;Comes along pen drive,Solvent Ink (Black) cartridge & charger.;Comes with Additional Stand assembly for attachment in conveyor & Metal sensor; Unlock Machine;1 year warranty', 'Online Printers'),
(20, 124, 'm 302.jpg', 'Max.Print Height : 12.7 mm;Max. Speed : 80-200 per/min. (depends upon the size of samples);LCD  Display with print head;Comes along pen drive,Solvent Ink (Black) cartridge & charger.;Comes with Additional Stand assembly for attachment in conveyor & Metal sensor; Unlock Machine;1 year warranty\r\n\n\n', 'Online Printers'),
(21, 105, 'm 302.jpg', 'Max.Print Height : 12.7 mm;Max. Speed : 80-200 per/min. (depends upon the size of samples);LCD  Display with print head;Comes along pen drive,Solvent Ink (Black) cartridge & charger.;Comes with Additional Stand assembly for attachment in conveyor & Metal sensor; Unlock Machine;1 year warranty\r\n\n\n', 'Online Printers'),
(22, 109, 'm 302.jpg', 'Max.Print Height : 12.7 mm;Max. Speed : 80-200 per/min. (depends upon the size of samples);LCD  Display with print head;Comes along pen drive,Solvent Ink (Black) cartridge & charger.;Comes with Additional Stand assembly for attachment in conveyor & Metal sensor; Unlock Machine;1 year warranty\r\n\n\n', 'Online Printers'),
(23, 136, 'CT 13.jpeg', 'Max.Print Height : 50 mm [Each head 25 mm];Max. Speed : 120-300 per/min. (depends upon the size of samples);LCD  Display with print head;Comes along pen drive, Solvent Ink (Black) cartridge & Power charger.;Comes with Additional Stand assembly for attachment in conveyor & Metal sensor;1 year warranty\r\n\n\n', 'Online Printers'),
(24, 160, 'undefined', '', ''),
(25, 161, 'undefined', '', ''),
(26, 162, 'undefined', '', ''),
(27, 163, 'undefined', '', '');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `account`
--
ALTER TABLE `account`
  ADD PRIMARY KEY (`aid`);

--
-- Indexes for table `acc_type`
--
ALTER TABLE `acc_type`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `bankdetails`
--
ALTER TABLE `bankdetails`
  ADD PRIMARY KEY (`bid`);

--
-- Indexes for table `client`
--
ALTER TABLE `client`
  ADD PRIMARY KEY (`cid`);

--
-- Indexes for table `clienttype`
--
ALTER TABLE `clienttype`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `delivery_addresses`
--
ALTER TABLE `delivery_addresses`
  ADD PRIMARY KEY (`delid`);

--
-- Indexes for table `fd`
--
ALTER TABLE `fd`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `fest`
--
ALTER TABLE `fest`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `invtest`
--
ALTER TABLE `invtest`
  ADD PRIMARY KEY (`orderno`);

--
-- Indexes for table `invtest2`
--
ALTER TABLE `invtest2`
  ADD PRIMARY KEY (`invid`);

--
-- Indexes for table `paidhistory`
--
ALTER TABLE `paidhistory`
  ADD PRIMARY KEY (`pay_id`);

--
-- Indexes for table `paymode`
--
ALTER TABLE `paymode`
  ADD PRIMARY KEY (`mid`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`p_id`);

--
-- Indexes for table `protest`
--
ALTER TABLE `protest`
  ADD PRIMARY KEY (`orderno`);

--
-- Indexes for table `protest2`
--
ALTER TABLE `protest2`
  ADD PRIMARY KEY (`invid`);

--
-- Indexes for table `purchasecom`
--
ALTER TABLE `purchasecom`
  ADD PRIMARY KEY (`pcid`);

--
-- Indexes for table `purchaseinv`
--
ALTER TABLE `purchaseinv`
  ADD PRIMARY KEY (`orderno`);

--
-- Indexes for table `purchaseinv2`
--
ALTER TABLE `purchaseinv2`
  ADD PRIMARY KEY (`nid`);

--
-- Indexes for table `quickquote`
--
ALTER TABLE `quickquote`
  ADD PRIMARY KEY (`q_id`);

--
-- Indexes for table `quote`
--
ALTER TABLE `quote`
  ADD PRIMARY KEY (`orderno`);

--
-- Indexes for table `quote2`
--
ALTER TABLE `quote2`
  ADD PRIMARY KEY (`invid`);

--
-- Indexes for table `techsps`
--
ALTER TABLE `techsps`
  ADD PRIMARY KEY (`tid`),
  ADD KEY `fk` (`p_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `account`
--
ALTER TABLE `account`
  MODIFY `aid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT for table `acc_type`
--
ALTER TABLE `acc_type`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `delivery_addresses`
--
ALTER TABLE `delivery_addresses`
  MODIFY `delid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `fd`
--
ALTER TABLE `fd`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `fest`
--
ALTER TABLE `fest`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `invtest`
--
ALTER TABLE `invtest`
  MODIFY `orderno` int(100) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `paidhistory`
--
ALTER TABLE `paidhistory`
  MODIFY `pay_id` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=154;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `p_id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=164;

--
-- AUTO_INCREMENT for table `protest`
--
ALTER TABLE `protest`
  MODIFY `orderno` int(100) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `purchaseinv`
--
ALTER TABLE `purchaseinv`
  MODIFY `orderno` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=165;

--
-- AUTO_INCREMENT for table `purchaseinv2`
--
ALTER TABLE `purchaseinv2`
  MODIFY `nid` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=92;

--
-- AUTO_INCREMENT for table `quote`
--
ALTER TABLE `quote`
  MODIFY `orderno` int(100) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `techsps`
--
ALTER TABLE `techsps`
  MODIFY `tid` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
