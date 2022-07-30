-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Máy chủ: 127.0.0.1
-- Thời gian đã tạo: Th7 23, 2022 lúc 04:40 AM
-- Phiên bản máy phục vụ: 10.4.24-MariaDB
-- Phiên bản PHP: 8.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Cơ sở dữ liệu: `qlnv`
--

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `timesheet`
--

CREATE TABLE `timesheet` (
  `timesheet_id` int(11) NOT NULL,
  `employee_id` int(11) NOT NULL,
  `manager_id` int(11) NOT NULL,
  `start_date` date DEFAULT NULL,
  `end_date` date DEFAULT NULL,
  `total_hour` int(11) DEFAULT NULL,
  `unsubmit_reason` varchar(256) COLLATE utf8mb4_vietnamese_ci DEFAULT NULL,
  `manager_comment` varchar(256) COLLATE utf8mb4_vietnamese_ci DEFAULT NULL,
  `submit_date` date DEFAULT NULL,
  `status` varchar(256) COLLATE utf8mb4_vietnamese_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_vietnamese_ci;

--
-- Đang đổ dữ liệu cho bảng `timesheet`
--

INSERT INTO `timesheet` (`timesheet_id`, `employee_id`, `manager_id`, `start_date`, `end_date`, `total_hour`, `unsubmit_reason`, `manager_comment`, `submit_date`, `status`) VALUES
(1, 1, 4, '2022-07-12', '2022-07-12', 8, NULL, NULL, NULL, 'Draft'),
(2, 2, 4, '2022-07-14', '2022-07-14', 8, NULL, NULL, NULL, 'Draft'),
(3, 3, 4, '2022-07-14', '2022-07-14', 8, NULL, NULL, NULL, 'Pending'),
(4, 1, 4, '2022-07-14', '2022-07-14', 8, NULL, NULL, NULL, 'Draft'),
(5, 2, 4, '2022-07-12', '2022-07-12', 8, NULL, NULL, NULL, 'Draft');

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `timesheet`
--
ALTER TABLE `timesheet`
  ADD PRIMARY KEY (`timesheet_id`,`employee_id`,`manager_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
