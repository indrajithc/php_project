-- phpMyAdmin SQL Dump
-- version 4.6.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 11, 2017 at 05:29 PM
-- Server version: 5.7.14
-- PHP Version: 7.0.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `rationshopmgt`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `username` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`username`, `password`) VALUES
('admin@Rationshopmgt.com', 'admin');

-- --------------------------------------------------------

--
-- Table structure for table `card`
--

CREATE TABLE `card` (
  `card_id` int(11) NOT NULL,
  `shop_id` int(11) NOT NULL,
  `card_type` varchar(222) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `card_no` varchar(150) COLLATE utf8mb4_unicode_ci NOT NULL,
  `ward_no` int(11) NOT NULL,
  `house_no` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `area` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `location` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `pin` int(11) NOT NULL,
  `members` int(11) NOT NULL,
  `monthly_income` float DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `userKey` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `login` int(11) NOT NULL DEFAULT '0',
  `delete_status` int(11) NOT NULL DEFAULT '0',
  `remarks` text COLLATE utf8mb4_unicode_ci,
  `date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `card`
--

INSERT INTO `card` (`card_id`, `shop_id`, `card_type`, `card_no`, `ward_no`, `house_no`, `name`, `area`, `location`, `pin`, `members`, `monthly_income`, `password`, `image`, `userKey`, `login`, `delete_status`, `remarks`, `date`) VALUES
(1, 129, 'APL', '129', 12, 22, 'qqqqqq', 'area', 'loc', 556677, 2, 463122, 'qqqqqq', 'resize_1504593011.jpg', '3239', 1, 0, NULL, '2017-09-04 15:47:00'),
(2, 129, NULL, '129-F2', 22, 6, 'dddd', 'fffff', 'dfsdfs', 112233, 3, NULL, 'qqqqqq', 'resize_1504602174.jpg', '6810', 0, 0, NULL, '2017-09-05 14:33:27'),
(3, 129, 'BPL', '129-F3', 45, 3, 'werwr', 'fffffffff', 'we rwerwe', 543344, 1, 123, 'qqqqqq', 'resize_1504602688.jpg', '3372', 1, 0, NULL, '2017-09-05 14:41:35'),
(4, 129, 'APL', '129-F4', 3, 33, 'ggg', 'aaaa', 'dddd', 444433, 2, 378, 'qqqqqq', 'resize_1505149999.png', '3383', 1, 0, 'all datas are correct ddd', '2017-09-11 10:13:35');

-- --------------------------------------------------------

--
-- Table structure for table `card_transaction`
--

CREATE TABLE `card_transaction` (
  `transaction_id` int(11) NOT NULL,
  `card_id` int(11) NOT NULL,
  `distribution` int(11) NOT NULL,
  `month` varchar(111) COLLATE utf8mb4_unicode_ci NOT NULL,
  `total` float NOT NULL,
  `userKey` int(11) NOT NULL,
  `remarks` text COLLATE utf8mb4_unicode_ci,
  `date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `card_transaction`
--

INSERT INTO `card_transaction` (`transaction_id`, `card_id`, `distribution`, `month`, `total`, `userKey`, `remarks`, `date`) VALUES
(4, 3, 14, '09-2017', 56, 1119, 'gdgd dfgd fgg', '2017-09-05 16:42:49'),
(5, 1, 14, '09-2017', 54, 3239, NULL, '2017-09-11 10:23:16');

-- --------------------------------------------------------

--
-- Table structure for table `complaint`
--

CREATE TABLE `complaint` (
  `complaint_id` int(11) NOT NULL,
  `cust_id` int(11) DEFAULT NULL,
  `shop_id` int(11) DEFAULT NULL,
  `type` varchar(200) NOT NULL,
  `complaint` text NOT NULL,
  `reply` text,
  `c_date` date NOT NULL,
  `r_date` date DEFAULT NULL,
  `date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `complaint`
--

INSERT INTO `complaint` (`complaint_id`, `cust_id`, `shop_id`, `type`, `complaint`, `reply`, `c_date`, `r_date`, `date`) VALUES
(1, 10, NULL, 'Product', 'xbbb', ' ', '2017-08-07', '2017-08-07', '2017-09-05 19:40:30'),
(2, NULL, 125, 'Product', 'hbhaxhaa', ' dgdf dfgdfg dfg', '2017-08-07', '2017-08-07', '2017-09-05 19:40:30'),
(3, 3, NULL, 'Service', '', 'fgd gdfgdgdfgdf dfg', '2017-09-05', NULL, '2017-09-05 19:41:55'),
(4, 3, NULL, 'Service', 'df sfsdgggsds', 'ddddddddddddd', '2017-09-05', NULL, '2017-09-05 19:50:54'),
(5, 3, NULL, 'Product', 'sfd sdfsdf sdfsdfsdf sfdsfdf sdfdsf sdf', NULL, '2017-09-05', NULL, '2017-09-05 19:51:12'),
(6, 3, NULL, 'Product', 'sfd sdfsdf sdfsdfsdf sfdsfdf sdfdsf sdf', ' dft dfgdfghdfgdfg', '2017-09-05', NULL, '2017-09-05 19:52:01'),
(7, 3, NULL, 'Service', 'sdf sdgdfgdfgdfg dfgfd 4353453 3453535', NULL, '2017-09-05', NULL, '2017-09-05 19:52:09'),
(8, 1, NULL, 'Product', 'sdsdfsdfsfsfddf', NULL, '2017-09-11', NULL, '2017-09-11 10:22:09');

-- --------------------------------------------------------

--
-- Table structure for table `distribution`
--

CREATE TABLE `distribution` (
  `distribution_id` int(11) NOT NULL,
  `product` int(11) NOT NULL,
  `ration_shop` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `QAPL` float NOT NULL,
  `QBPL` float NOT NULL,
  `QAAY` float NOT NULL,
  `QANP` float NOT NULL,
  `price` float NOT NULL,
  `APL` float NOT NULL,
  `BPL` float NOT NULL,
  `AAY` float NOT NULL,
  `ANP` float NOT NULL,
  `month` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `r_quantity` float NOT NULL,
  `delete_status` int(11) NOT NULL DEFAULT '0',
  `date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `distribution`
--

INSERT INTO `distribution` (`distribution_id`, `product`, `ration_shop`, `quantity`, `QAPL`, `QBPL`, `QAAY`, `QANP`, `price`, `APL`, `BPL`, `AAY`, `ANP`, `month`, `r_quantity`, `delete_status`, `date`) VALUES
(1, 52, 124, 1, 0, 0, 0, 0, 15, 2, 3, 4, 5, '09-2017', 0, 0, '2017-09-03 17:46:06'),
(2, 52, 124, 2, 0, 0, 0, 0, 15, 3, 4, 5, 6, '10-2017', 0, 0, '2017-09-03 17:48:08'),
(3, 52, 124, 3, 0, 0, 0, 0, 15, 22, 33, 44, 55, '09-2017', 0, 0, '2017-09-03 17:49:11'),
(4, 52, 129, 10, 0, 0, 0, 0, 15, 1, 2, 3, 4, '09-2017', 0, 0, '2017-09-03 18:20:45'),
(5, 52, 129, 1, 0, 0, 0, 0, 15, 3, 4, 5, 7, '09-2017', 0, 0, '2017-09-03 18:23:53'),
(6, 52, 130, 2, 0, 0, 0, 0, 15, 2, 4, 6, 7, '10-2017', 0, 0, '2017-09-03 18:25:02'),
(7, 52, 130, 2, 0, 0, 0, 0, 15, 2, 4, 6, 7, '10-2017', 0, 0, '2017-09-03 18:25:28'),
(8, 52, 130, 2, 0, 0, 0, 0, 15, 2, 4, 6, 7, '10-2017', 0, 0, '2017-09-03 18:25:44'),
(9, 52, 130, 2, 0, 0, 0, 0, 15, 2, 4, 6, 7, '10-2017', 0, 0, '2017-09-03 18:26:09'),
(10, 52, 130, 2, 0, 0, 0, 0, 15, 2, 4, 6, 7, '10-2017', 0, 0, '2017-09-03 18:26:48'),
(11, 52, 130, 2, 0, 0, 0, 0, 15, 2, 4, 6, 7, '10-2017', 0, 0, '2017-09-03 18:27:09'),
(12, 52, 130, 2, 0, 0, 0, 0, 15, 2, 4, 6, 7, '10-2017', 0, 0, '2017-09-03 18:27:33'),
(13, 52, 129, 50, 4, 3, 2, 1, 15, 1, 2, 3, 4, '09-2017', 0, 0, '2017-09-05 13:08:34'),
(14, 52, 129, 20, 6, 7, 8, 9, 15, 9, 8, 7, 6, '09-2017', 75, 0, '2017-09-05 15:36:14'),
(15, 52, 129, 5, 1, 2, 3, 4, 15, 4, 3, 2, 1, '10-2017', 5, 0, '2017-09-11 10:02:31');

-- --------------------------------------------------------

--
-- Table structure for table `district`
--

CREATE TABLE `district` (
  `dist_id` int(11) NOT NULL,
  `district_name` varchar(50) NOT NULL,
  `delete_status` int(11) NOT NULL DEFAULT '0',
  `date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `district`
--

INSERT INTO `district` (`dist_id`, `district_name`, `delete_status`, `date`) VALUES
(1, 'Thiruvananthapuram', 0, '2017-09-03 11:50:19'),
(2, 'Kollam', 0, '2017-09-03 11:50:19'),
(3, 'Pathanamthitta', 0, '2017-09-03 11:50:19'),
(4, 'Alappuzha', 0, '2017-09-03 11:50:19'),
(5, 'Kottayam', 0, '2017-09-03 11:50:19'),
(6, 'Idukki', 0, '2017-09-03 11:50:19'),
(7, 'Eranakulam', 0, '2017-09-03 11:50:19'),
(8, 'Thrissur', 0, '2017-09-03 11:50:19'),
(9, 'Palakkadu', 1, '2017-09-03 11:50:19'),
(10, 'Malappuram', 1, '2017-09-03 11:50:19'),
(11, 'Kozhikkod', 1, '2017-09-03 11:50:19'),
(12, 'Wayanad', 0, '2017-09-03 11:50:19'),
(13, 'Kannur', 0, '2017-09-03 11:50:19'),
(14, 'Kasargode', 0, '2017-09-03 11:50:19'),
(17, '7777', 1, '2017-09-11 09:49:59');

-- --------------------------------------------------------

--
-- Table structure for table `member`
--

CREATE TABLE `member` (
  `member_id` int(11) NOT NULL,
  `card_id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `dob` date NOT NULL,
  `gender` varchar(222) COLLATE utf8mb4_unicode_ci NOT NULL,
  `occupation` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `income` float NOT NULL,
  `NRK` int(11) NOT NULL DEFAULT '0',
  `type` int(11) NOT NULL DEFAULT '0',
  `relation` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `proof` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `proof_no` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `delete_status` int(11) NOT NULL DEFAULT '0',
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `member`
--

INSERT INTO `member` (`member_id`, `card_id`, `name`, `dob`, `gender`, `occupation`, `income`, `NRK`, `type`, `relation`, `proof`, `proof_no`, `delete_status`, `date`) VALUES
(1, 1, 'dddd', '2017-08-02', 'male', 'fg dfgdfg', 456456, 0, 0, 'son', 'Adhaar', '5345345345345345', 0, '2017-09-04 16:58:36'),
(11, 1, 'dddd', '2017-08-27', 'female', 'yyyyyyyyy', 6666, 1, 1, 'owner', 'Driving License', 'dsfsdfsdfsdf', 0, '2017-09-04 17:41:41'),
(12, 3, 'fgfg dfgdfg', '2017-08-29', 'male', 'erwer', 1232, 0, 1, 'owner', 'Adhaar', '2342342342324', 0, '2017-09-05 09:12:10'),
(13, 4, '111', '2017-08-31', 'male', 'sssff', 33, 1, 0, 'daughter', 'Income Tax PAN Card', '3534534534rer', 0, '2017-09-11 17:16:12'),
(14, 4, 'dsgdfdgf', '2017-09-06', 'male', 'dfgd', 345, 0, 1, 'owner', 'Election Commission ID Card', 'dfgdg dgdg d', 0, '2017-09-11 17:16:37');

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE `product` (
  `pr_id` int(11) NOT NULL,
  `pr_name` varchar(20) NOT NULL,
  `price` float NOT NULL,
  `total_price` float NOT NULL,
  `quantity` float NOT NULL,
  `description` varchar(200) NOT NULL,
  `delete_status` int(11) NOT NULL DEFAULT '0',
  `date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`pr_id`, `pr_name`, `price`, `total_price`, `quantity`, `description`, `delete_status`, `date`) VALUES
(23, 'Rice', 22, 5632, 256, 'gggggggggggggg', 0, '1997-02-04 00:00:00'),
(52, 'sugar', 15, 90, 6, 'hcjxhjhb ijxho', 0, '1997-02-04 00:00:00'),
(59, 'errrre1', 23, 253, 11, '11111111111', 1, '2017-09-11 09:53:38'),
(60, '55', 34, 7548, 222, 'srwerw er', 0, '2017-09-11 09:54:54');

-- --------------------------------------------------------

--
-- Table structure for table `ration_shop`
--

CREATE TABLE `ration_shop` (
  `shop_id` int(11) NOT NULL,
  `password` longtext NOT NULL,
  `shop_no` varchar(10) NOT NULL,
  `taluk_id` int(11) NOT NULL,
  `shop_address` varchar(255) NOT NULL,
  `mobile` varchar(15) NOT NULL,
  `pin` int(11) NOT NULL,
  `emp_name` varchar(200) NOT NULL,
  `emp_address` varchar(200) NOT NULL,
  `emp_gender` varchar(10) NOT NULL,
  `contact_no` bigint(20) NOT NULL,
  `delete_status` int(11) NOT NULL DEFAULT '0',
  `date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ration_shop`
--

INSERT INTO `ration_shop` (`shop_id`, `password`, `shop_no`, `taluk_id`, `shop_address`, `mobile`, `pin`, `emp_name`, `emp_address`, `emp_gender`, `contact_no`, `delete_status`, `date`) VALUES
(125, 'asdf', '1007', 4, '  bzjhsuwjs,sm\r\nbagfsyshkw\r\n\r\n									                  ', '7896541239', 458963, 'Sanjay', '        djnldcnmx          ', 'male', 5698745, 0, '2017-09-02 22:12:57'),
(124, 'qwert', '1005', 9, 'ayhgzjhjzhgah\r\nbvjHZja\r\nsxhbsjxh						                                                                        ', '1458963214', 623896, '', 'fgthgfdadfg                                                                   \r\n                                    ', 'female', 52698712, 0, '2017-09-02 22:12:57'),
(123, 'shop12', '1001', 12, 'hshabzmnzamz\r\nzzxnanxbaj\r\nsvanbmabz', '4545454', 54526, '', '', '', 0, 0, '2017-09-02 22:12:57'),
(126, 'zxcvb', '1008', 0, '                             \r\n                               fsjxjjxnxn\r\nambzhaghjxhb\r\nsxbshushx\r\n\r\n									                  ', '7854123698', 654789, '', 'dfffffffffff', '', 0, 0, '2017-09-02 22:12:57'),
(127, 'qwertt', '786', 7, ' \r\n		kkjsvikmx\r\nnsfgujsdbhn\r\nndgyhdj							', '4589632147', 2365478, '', '', '', 0, 0, '2017-09-02 22:12:57'),
(129, 'qqqqqq', '5345', 1, 'qqqqqqq', '1111111111', 111111, 'wwwwww', 'fffffffffffff', 'male', 2147483647, 0, '2017-09-02 22:12:57'),
(131, 'qqqqqq', '2222', 10, 'ssssd sds d', '3333333333', 444444, 'sssd', 'df sdfsd fsdf dfsdfs', 'male', 2147483647, 0, '2017-09-02 23:42:16'),
(132, 'wwwwww', '777', 17, '                             \r\n                              555555ttttttt                  ', '3344556677', 778899, 'ttyyy', '                                    ddddddd cfff                                  \r\n                                    ', 'female', 2147483647, 1, '2017-09-02 23:47:40'),
(133, 'qqqqqq', '12', 7, '                             \r\n                              sdfs sdfsdf sdf                  ', '5566778899', 3333333, 'eeeeeeeeee', '                                     dsffdasdf sdf sdf3                                  \r\n                                    ', 'male', 4544332255, 1, '2017-09-11 09:49:19');

-- --------------------------------------------------------

--
-- Table structure for table `stock`
--

CREATE TABLE `stock` (
  `stock_id` int(11) NOT NULL,
  `product` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `total_price` float NOT NULL,
  `delete_status` int(11) NOT NULL DEFAULT '0',
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `stock`
--

INSERT INTO `stock` (`stock_id`, `product`, `quantity`, `total_price`, `delete_status`, `date`) VALUES
(1, 52, 1, 15, 0, '2017-09-03 09:21:00'),
(2, 52, 2, 30, 0, '2017-09-03 09:21:49'),
(3, 52, 3, 45, 0, '2017-09-03 09:22:20'),
(4, 52, 9, 135, 0, '2017-09-03 09:36:43'),
(5, 52, 12, 180, 0, '2017-09-03 11:20:05'),
(6, 23, 234, 5148, 0, '2017-09-11 16:56:20');

-- --------------------------------------------------------

--
-- Table structure for table `taluk`
--

CREATE TABLE `taluk` (
  `taluk_id` int(11) NOT NULL,
  `dist` varchar(10) NOT NULL,
  `name` varchar(200) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `taluk`
--

INSERT INTO `taluk` (`taluk_id`, `dist`, `name`) VALUES
(1, '1', 'Neyyattinkara'),
(2, '1', 'Kattakada'),
(3, '1', 'Nedumangadu'),
(4, '1', 'Thiruvananthapuram'),
(5, '1', 'Chirayinkeezhu'),
(6, '1', 'Varkala'),
(7, '2', 'Kollam'),
(8, '2', 'Kunnathoor'),
(9, '2', 'Karunagappally'),
(10, '2', 'Kottarakkara'),
(11, '2', 'Punalur'),
(12, '2', 'Pathanapuram'),
(13, '3', 'Adoor'),
(14, '3', 'Konni'),
(15, '3', 'Kozhenchery'),
(16, '3', 'Ranni'),
(17, '3', 'Mallappally'),
(18, '3', 'Thiruvalla'),
(19, '3', 'Chenganoor'),
(20, '4', 'Mavelikkara'),
(21, '4', 'Karthikappally');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`username`);

--
-- Indexes for table `card`
--
ALTER TABLE `card`
  ADD PRIMARY KEY (`card_id`),
  ADD UNIQUE KEY `card_no` (`card_no`);

--
-- Indexes for table `card_transaction`
--
ALTER TABLE `card_transaction`
  ADD PRIMARY KEY (`transaction_id`);

--
-- Indexes for table `complaint`
--
ALTER TABLE `complaint`
  ADD PRIMARY KEY (`complaint_id`);

--
-- Indexes for table `distribution`
--
ALTER TABLE `distribution`
  ADD PRIMARY KEY (`distribution_id`);

--
-- Indexes for table `district`
--
ALTER TABLE `district`
  ADD PRIMARY KEY (`dist_id`);

--
-- Indexes for table `member`
--
ALTER TABLE `member`
  ADD PRIMARY KEY (`member_id`);

--
-- Indexes for table `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`pr_id`);

--
-- Indexes for table `ration_shop`
--
ALTER TABLE `ration_shop`
  ADD PRIMARY KEY (`shop_id`);

--
-- Indexes for table `stock`
--
ALTER TABLE `stock`
  ADD PRIMARY KEY (`stock_id`);

--
-- Indexes for table `taluk`
--
ALTER TABLE `taluk`
  ADD PRIMARY KEY (`taluk_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `card`
--
ALTER TABLE `card`
  MODIFY `card_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `card_transaction`
--
ALTER TABLE `card_transaction`
  MODIFY `transaction_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `complaint`
--
ALTER TABLE `complaint`
  MODIFY `complaint_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT for table `distribution`
--
ALTER TABLE `distribution`
  MODIFY `distribution_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;
--
-- AUTO_INCREMENT for table `district`
--
ALTER TABLE `district`
  MODIFY `dist_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;
--
-- AUTO_INCREMENT for table `member`
--
ALTER TABLE `member`
  MODIFY `member_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;
--
-- AUTO_INCREMENT for table `product`
--
ALTER TABLE `product`
  MODIFY `pr_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=61;
--
-- AUTO_INCREMENT for table `ration_shop`
--
ALTER TABLE `ration_shop`
  MODIFY `shop_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=134;
--
-- AUTO_INCREMENT for table `stock`
--
ALTER TABLE `stock`
  MODIFY `stock_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `taluk`
--
ALTER TABLE `taluk`
  MODIFY `taluk_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
