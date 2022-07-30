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
-- Cấu trúc bảng cho bảng `task`
--

CREATE TABLE `task` (
  `employee_id` int(11) NOT NULL,
  `task_id` int(11) NOT NULL,
  `proj_id` int(11) NOT NULL,
  `name` varchar(256) COLLATE utf8mb4_vietnamese_ci NOT NULL,
  `description` varchar(256) COLLATE utf8mb4_vietnamese_ci NOT NULL,
  `status` varchar(256) COLLATE utf8mb4_vietnamese_ci NOT NULL,
  `estimate_duration` varchar(256) COLLATE utf8mb4_vietnamese_ci NOT NULL,
  `start_date` date NOT NULL,
  `end_date` date NOT NULL,
  `real_duration` varchar(256) COLLATE utf8mb4_vietnamese_ci NOT NULL,
  `comment` varchar(256) COLLATE utf8mb4_vietnamese_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_vietnamese_ci;

--
-- Đang đổ dữ liệu cho bảng `task`
--

INSERT INTO `task` (`employee_id`, `task_id`, `proj_id`, `name`, `description`, `status`, `estimate_duration`, `start_date`, `end_date`, `real_duration`, `comment`) VALUES
(1, 1, 1, 'Connecting', 'Connect to datasource using credentials', 'In Process', '1 day', '2022-08-02', '2022-08-03', '', ''),
(1, 1, 2, 'Coding', 'Remove columns', 'In Process', '1 day', '2022-08-06', '2022-08-07', '', ''),
(1, 1, 3, 'Coding', 'Remove columns', 'In Process', '1 day', '2022-08-06', '2022-08-07', '', ''),
(1, 1, 4, 'Visualize', 'Use bar chart to visualize data', 'Pending', '1 day', '2022-08-08', '2022-08-09', '', ''),
(1, 1, 5, 'Visualize', 'Use bar chart to visualize data', 'Pending', '1 day', '2022-08-08', '2022-08-09', '', '');

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `task`
--
ALTER TABLE `task`
  ADD PRIMARY KEY (`employee_id`,`task_id`,`proj_id`),
  ADD KEY `FK_TASK_PROJECT` (`proj_id`);

--
-- Các ràng buộc cho các bảng đã đổ
--

--
-- Các ràng buộc cho bảng `task`
--
ALTER TABLE `task`
  ADD CONSTRAINT `FK_TASK_PROJECT` FOREIGN KEY (`proj_id`) REFERENCES `project` (`proj_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
