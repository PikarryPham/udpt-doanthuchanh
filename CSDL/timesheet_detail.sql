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
-- Cấu trúc bảng cho bảng `timesheet_detail`
--

CREATE TABLE `timesheet_detail` (
  `timesheet_id` int(11) NOT NULL,
  `timedetail_id` int(11) NOT NULL,
  `date` date NOT NULL,
  `number_hour` int(11) NOT NULL,
  `task_name` varchar(256) COLLATE utf8mb4_vietnamese_ci NOT NULL,
  `team_project_name` varchar(256) COLLATE utf8mb4_vietnamese_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_vietnamese_ci;

--
-- Đang đổ dữ liệu cho bảng `timesheet_detail`
--

INSERT INTO `timesheet_detail` (`timesheet_id`, `timedetail_id`, `date`, `number_hour`, `task_name`, `team_project_name`) VALUES
(1, 1, '2022-07-12', 8, 'Preprocess data', 'DnA Team'),
(2, 1, '2022-07-14', 4, 'Preprocess data', 'DnA Team'),
(2, 2, '2022-07-14', 4, 'Visualize data', 'DnA Team'),
(3, 1, '2022-07-14', 8, 'Visualize data', 'DnA Team'),
(4, 1, '2022-07-14', 8, 'Visualize data', 'DnA Team'),
(5, 1, '2022-07-12', 8, 'Clean data', 'DnA Team');

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `timesheet_detail`
--
ALTER TABLE `timesheet_detail`
  ADD PRIMARY KEY (`timesheet_id`,`timedetail_id`);

--
-- Các ràng buộc cho các bảng đã đổ
--

--
-- Các ràng buộc cho bảng `timesheet_detail`
--
ALTER TABLE `timesheet_detail`
  ADD CONSTRAINT `FK_TSDETAIL_TIMESHEET` FOREIGN KEY (`timesheet_id`) REFERENCES `timesheet` (`timesheet_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
