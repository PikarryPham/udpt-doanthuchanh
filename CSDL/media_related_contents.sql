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
-- Cấu trúc bảng cho bảng `media_related_contents`
--

CREATE TABLE `media_related_contents` (
  `document_id` int(11) NOT NULL,
  `media_contentid` int(11) NOT NULL,
  `title` varchar(256) COLLATE utf8mb4_vietnamese_ci NOT NULL,
  `url` varchar(256) COLLATE utf8mb4_vietnamese_ci DEFAULT NULL,
  `create_date` date NOT NULL,
  `update_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_vietnamese_ci;

--
-- Đang đổ dữ liệu cho bảng `media_related_contents`
--

INSERT INTO `media_related_contents` (`document_id`, `media_contentid`, `title`, `url`, `create_date`, `update_date`) VALUES
(1, 1, 'File PDF Guideline', 'https://drive.google.com/drive/u/0/folders/12QR2yUv6l7eU5NfMyIh7rXcVQZ1WaZ8R', '2022-08-31', '2022-08-31');

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `media_related_contents`
--
ALTER TABLE `media_related_contents`
  ADD PRIMARY KEY (`document_id`,`media_contentid`);

--
-- Các ràng buộc cho các bảng đã đổ
--

--
-- Các ràng buộc cho bảng `media_related_contents`
--
ALTER TABLE `media_related_contents`
  ADD CONSTRAINT `FK_MEDIA_DOCUMENT` FOREIGN KEY (`document_id`) REFERENCES `document_post` (`document_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
