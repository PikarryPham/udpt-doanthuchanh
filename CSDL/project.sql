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
-- Cấu trúc bảng cho bảng `project`
--

CREATE TABLE `project` (
  `proj_id` int(11) NOT NULL,
  `manager_id` int(11) NOT NULL,
  `name` varchar(256) COLLATE utf8mb4_vietnamese_ci NOT NULL,
  `description` varchar(256) COLLATE utf8mb4_vietnamese_ci DEFAULT NULL,
  `start_date` date NOT NULL,
  `estimate_duration` varchar(256) COLLATE utf8mb4_vietnamese_ci DEFAULT NULL,
  `status` varchar(256) COLLATE utf8mb4_vietnamese_ci NOT NULL,
  `complete_per` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_vietnamese_ci;

--
-- Đang đổ dữ liệu cho bảng `project`
--

INSERT INTO `project` (`proj_id`, `manager_id`, `name`, `description`, `start_date`, `estimate_duration`, `status`, `complete_per`) VALUES
(1, 4, 'Data Migration', 'Prepare data pipeline to move data from Mysql to Postgres.', '2022-08-02', '2 days', 'Incompleted', 0),
(2, 4, 'Data Cleaning', 'Remove unecessary columns', '2022-08-06', '3 days', 'Incompleted', 0),
(3, 5, 'Data Cleaning', 'Remove unecessary columns', '2022-08-06', '3 days', 'Incompleted', 0),
(4, 5, 'Data Visualization', 'Visualize data using bar chart', '2022-08-08', '1 day', 'Incompleted', 0),
(5, 5, 'Data Visualization', 'Visualize data using bar chart', '2022-08-08', '1 day', 'Incompleted', 0);

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `project`
--
ALTER TABLE `project`
  ADD PRIMARY KEY (`proj_id`,`manager_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
