-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Máy chủ: 127.0.0.1
-- Thời gian đã tạo: Th7 23, 2022 lúc 06:58 PM
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
-- Cấu trúc bảng cho bảng `request wfh`
--

CREATE TABLE `request wfh` (
  `rwfh_id` int(11) NOT NULL,
  `employecreate_id` int(11) NOT NULL,
  `manager_id` int(11) NOT NULL,
  `reason` varchar(256) COLLATE utf8mb4_vietnamese_ci NOT NULL,
  `create_date` date NOT NULL,
  `from_date` date NOT NULL,
  `update_date` date NOT NULL,
  `status` varchar(256) COLLATE utf8mb4_vietnamese_ci NOT NULL,
  `manager_comment` varchar(256) COLLATE utf8mb4_vietnamese_ci DEFAULT NULL,
  `to_date` date NOT NULL,
  `unsubmit_reason` varchar(256) COLLATE utf8mb4_vietnamese_ci DEFAULT NULL,
  `notification_flag` varchar(256) COLLATE utf8mb4_vietnamese_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_vietnamese_ci;

--
-- Đang đổ dữ liệu cho bảng `request wfh`
--

INSERT INTO `request wfh` (`rwfh_id`, `employecreate_id`, `manager_id`, `reason`, `create_date`, `from_date`, `update_date`, `status`, `manager_comment`, `to_date`, `unsubmit_reason`, `notification_flag`) VALUES
(1, 1, 4, 'I have a sick', '2022-08-30', '2022-09-01', '2022-08-30', 'Pending', NULL, '2022-09-03', NULL, 'False'),
(2, 2, 4, 'I have a sick - Covid', '2022-08-30', '2022-09-01', '2022-08-30', 'Pending', 'Ok you can leave', '2022-09-03', NULL, 'True'),
(3, 3, 4, 'I have a sick - Covid', '2022-08-30', '2022-09-01', '2022-08-30', 'Confirm', 'Ok you can leave', '2022-09-03', NULL, 'True'),
(4, 3, 4, 'I have a vacation', '2022-08-30', '2022-10-01', '2022-08-30', 'Pending', NULL, '2022-10-03', NULL, 'True'),
(5, 2, 4, 'I have a vacation', '2022-08-30', '2022-10-01', '2022-08-30', 'Pending', NULL, '2022-10-03', NULL, 'True');

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `request wfh`
--
ALTER TABLE `request wfh`
  ADD PRIMARY KEY (`rwfh_id`,`employecreate_id`,`manager_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
