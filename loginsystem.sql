-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 19, 2025 at 06:11 PM
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
(14, 913, 2, 0, '2024-04-13'),
(15, 515, 2, 0, '2024-04-15'),
(16, 701, 2, 0, '2024-04-22'),
(17, 706, 2, 0, '2024-04-22'),
(18, 644, 2, 0, '2024-04-22'),
(19, 610, 2, 0, '2024-04-22'),
(20, 20, 1, 0, '2024-04-22'),
(21, 640, 2, 0, '2024-04-26'),
(22, 489, 2, 0, '2024-04-26'),
(23, 649, 2, 0, '2024-04-26'),
(24, 805, 2, 0, '2024-04-26'),
(25, 926, 2, 0, '2024-05-04'),
(26, 910, 2, 0, '2024-05-04'),
(27, 650, 2, 0, '2024-05-04'),
(28, 749, 2, 0, '2024-05-20'),
(29, 940, 2, 0, '2024-09-08');

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
(1, 1, 'hand stamp.jpg', 'Printing Area : 35 x 60 mm (LxB);Prints using Grooves Rubber based stereo (3  MM); Ink- Fast dry & Water Resistant; Weight 0.5 kgs; Comes with 500ml ink, 500ml Cleaner, Groove fonts & Inkpad (2pcs)', 'Manual Batch Coding Machine'),
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
