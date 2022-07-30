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
-- Cấu trúc bảng cho bảng `document_post`
--

CREATE TABLE `document_post` (
  `document_id` int(11) NOT NULL,
  `manager_id` int(11) NOT NULL,
  `title` varchar(256) COLLATE utf8mb4_vietnamese_ci NOT NULL,
  `content` varchar(256) COLLATE utf8mb4_vietnamese_ci NOT NULL,
  `create_date` date NOT NULL,
  `update_date` date NOT NULL,
  `categories` varchar(256) COLLATE utf8mb4_vietnamese_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_vietnamese_ci;

--
-- Đang đổ dữ liệu cho bảng `document_post`
--

INSERT INTO `document_post` (`document_id`, `manager_id`, `title`, `content`, `create_date`, `update_date`, `categories`) VALUES
(1, 5, 'Guideline to use log in function.', 'Input username and password then click LogIn button.', '2022-08-30', '2022-08-31', 'Guideline'),
(2, 5, 'Guideline to use check in/check out function.', 'Input check in/check out time when you arrive and leave the work.', '2022-08-30', '2022-08-31', 'Guideline'),
(3, 4, 'Guideline to use request account function.', 'Input the request account type and reason -> click Submit', '2022-08-30', '2022-08-31', 'Guideline'),
(4, 4, 'Guideline to use request device function.', 'Input the requested device and reason -> click Submit', '2022-08-30', '2022-08-31', 'Guideline'),
(5, 4, 'Guideline to use request OT function.', 'Input the requested OT time and reason -> click Submit', '2022-08-30', '2022-08-31', 'Guideline');

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `document_post`
--
ALTER TABLE `document_post`
  ADD PRIMARY KEY (`document_id`,`manager_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
