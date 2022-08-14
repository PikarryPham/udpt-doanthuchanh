-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 12, 2022 at 06:21 AM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 8.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `leave_request`
--

-- --------------------------------------------------------

--
-- Table structure for table `request_leave`
--

CREATE TABLE `request_leave` (
  `RLEAVE_ID` int(11) NOT NULL,
  `EMPLOYEE_ID` int(11) NOT NULL,
  `MANAGER_ID` int(11) NOT NULL,
  `NUMBER_DAYS` int(11) NOT NULL,
  `LEAVE_TYPE` int(11) NOT NULL COMMENT 'tham chiếu đến bảng leave type',
  `REASON` varchar(300) COLLATE utf8mb4_vietnamese_ci DEFAULT NULL COMMENT 'nêu rõ nguyên do nghỉ',
  `LEAVE_FROM` datetime NOT NULL,
  `LEAVE_TO` datetime NOT NULL,
  `CREATE_DATE` datetime NOT NULL,
  `UPDATE_DATE` datetime DEFAULT NULL,
  `STATUS` varchar(100) COLLATE utf8mb4_vietnamese_ci NOT NULL,
  `MANAGER_COMMENT` varchar(200) COLLATE utf8mb4_vietnamese_ci DEFAULT NULL COMMENT 'lý do từ chối yêu cầu của quản lý',
  `UNSUBMIT_REASON` varchar(200) COLLATE utf8mb4_vietnamese_ci DEFAULT NULL COMMENT 'lý do rút lại yêu cầu'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_vietnamese_ci;

--
-- Dumping data for table `request_leave`
--

INSERT INTO `request_leave` (`RLEAVE_ID`, `EMPLOYEE_ID`, `MANAGER_ID`, `NUMBER_DAYS`, `LEAVE_TYPE`, `REASON`, `LEAVE_FROM`, `LEAVE_TO`, `CREATE_DATE`, `UPDATE_DATE`, `STATUS`, `MANAGER_COMMENT`, `UNSUBMIT_REASON`) VALUES
(1, 1, 5, 2, 1, 'Sốt cao 40 độ', '2022-05-10 00:00:00', '2022-05-12 00:00:00', '2022-08-10 11:49:06', '2022-08-10 11:51:06', 'Approved', NULL, NULL),
(2, 2, 5, 3, 1, 'Sốt cao 40 độ', '2022-06-10 00:00:00', '2022-06-13 00:00:00', '2022-08-10 11:59:06', '2022-08-10 11:59:06', 'Approved', NULL, NULL),
(5, 7, 6, 5, 1, 'Sốt cao 38 độ', '2022-05-20 00:00:00', '2022-05-25 00:00:00', '2022-08-10 11:59:06', '2022-08-10 11:59:06', 'Rejected', 'Xạo', NULL),
(8, 8, 6, 1, 1, 'Nghỉ vì cần đi học thôi', '2021-07-15 00:00:00', '2021-07-15 00:00:00', '2021-07-10 12:00:00', NULL, 'Rejected', 'Đi học làm gì, đi làm đi!!!', NULL),
(9, 8, 6, 2, 8, 'Nghỉ vì đám cưới với vợ 2 ngày 1 đêm ở LA', '2021-12-15 00:00:00', '2021-12-16 00:00:00', '2021-12-12 12:00:00', '2021-12-14 12:00:00', 'Accepted', NULL, NULL),
(10, 8, 6, 2, 3, 'Nghỉ vì con sinh, là con gái ', '2022-08-11 20:00:00', '2022-08-12 23:55:00', '2022-08-11 21:01:00', '2022-08-11 21:30:00', 'Accepted', NULL, NULL),
(11, 8, 6, 1, 2, 'Nghỉ vì đi du lịch cần giờ vs bạn gái', '2021-11-12 09:01:00', '2021-11-12 23:01:00', '2021-11-10 12:01:00', '2021-11-10 15:01:00', 'Cancelled', NULL, 'Chia tay rồi nên không đi chơi nữa');

-- --------------------------------------------------------

--
-- Table structure for table `request_leave_detail`
--

CREATE TABLE `request_leave_detail` (
  `RLEAVEDETAIL_ID` int(11) NOT NULL,
  `RLEAVE_ID` int(11) NOT NULL,
  `DATE` datetime NOT NULL,
  `LEAVE_SHIFT` varchar(30) COLLATE utf8mb4_vietnamese_ci NOT NULL COMMENT 'all day, morning, afternoon'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_vietnamese_ci;

--
-- Dumping data for table `request_leave_detail`
--

INSERT INTO `request_leave_detail` (`RLEAVEDETAIL_ID`, `RLEAVE_ID`, `DATE`, `LEAVE_SHIFT`) VALUES
(1, 1, '2022-05-10 00:00:00', 'All day'),
(2, 1, '2022-05-11 00:00:00', 'All day'),
(1, 2, '2022-06-10 00:00:00', 'All day'),
(2, 2, '2022-06-11 00:00:00', 'All day'),
(3, 2, '2022-06-12 00:00:00', 'All day'),
(1, 5, '2022-05-20 00:00:00', 'All day'),
(2, 5, '2022-05-21 00:00:00', 'All day'),
(3, 5, '2022-05-22 00:00:00', 'All day'),
(4, 5, '2022-05-23 00:00:00', 'All day'),
(5, 5, '2022-05-24 00:00:00', 'All day'),
(1, 8, '2021-07-15 00:00:00', 'All day'),
(1, 9, '2021-12-15 00:00:00', 'All day'),
(2, 9, '2021-12-16 00:00:00', 'Morning'),
(1, 10, '2022-08-11 20:00:00', 'All day'),
(2, 10, '2022-08-12 23:55:00', 'All day'),
(1, 11, '2021-11-12 09:01:00', 'All day');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `request_leave`
--
ALTER TABLE `request_leave`
  ADD PRIMARY KEY (`RLEAVE_ID`);

--
-- Indexes for table `request_leave_detail`
--
ALTER TABLE `request_leave_detail`
  ADD PRIMARY KEY (`RLEAVE_ID`,`RLEAVEDETAIL_ID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `request_leave`
--
ALTER TABLE `request_leave`
  MODIFY `RLEAVE_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `request_leave_detail`
--
ALTER TABLE `request_leave_detail`
  ADD CONSTRAINT `FK_DETAIL_REQUEST_LEAVE` FOREIGN KEY (`RLEAVE_ID`) REFERENCES `request_leave` (`RLEAVE_ID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
