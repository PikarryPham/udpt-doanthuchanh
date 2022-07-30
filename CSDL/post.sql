-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 18, 2022 at 02:32 PM
-- Server version: 10.4.13-MariaDB
-- PHP Version: 7.2.31

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `post`
--

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `CATEGORIES_ID` int(11) NOT NULL,
  `NAME` varchar(50) COLLATE utf8mb4_vietnamese_ci NOT NULL COMMENT 'tên thể loại',
  `DESCRIPTION` varchar(100) COLLATE utf8mb4_vietnamese_ci NOT NULL COMMENT 'mô tả thể loại',
  `CREATE_DATE` datetime NOT NULL,
  `UPDATE_DATE` datetime DEFAULT NULL,
  `STATUS` smallint(6) NOT NULL COMMENT 'tình trạng thể loại có khả dụng hay không'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_vietnamese_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`CATEGORIES_ID`, `NAME`, `DESCRIPTION`, `CREATE_DATE`, `UPDATE_DATE`, `STATUS`) VALUES
(1, 'Tuyển dụng', 'Chứa các bài đăng về thông tin tuyển dụng trong công ty', '2021-11-04 00:00:00', NULL, 1),
(2, 'Xã hội', 'Chứa các bài đăng về thông tin tình hình xã hội hiện nay như giá xăng, thời tiết,...', '2021-11-04 00:00:00', NULL, 1),
(3, 'Kinh tế', 'Chứa các bài đăng về thông tin tình hình kinh tế hiện nay như giá cổ phiếu, chứng khoán, phỏng vấn d', '2021-11-04 00:00:00', NULL, 1),
(4, 'Tình hình công ty', 'Chứa các bài đăng về thông tin công ty như thành tích, kế hoạch tương lai,..', '2021-11-04 00:00:00', NULL, 1),
(5, 'Team building', 'Chứa các bài đăng về thông tin hoạt động tổ chức cho nhân viên như tân niên, tất niên,...', '2021-11-04 00:00:00', NULL, 1);

-- --------------------------------------------------------

--
-- Table structure for table `categories_subscribe`
--

CREATE TABLE `categories_subscribe` (
  `SUBSCRIBE_ID` int(11) NOT NULL,
  `EMPLOYEE_ID` int(11) NOT NULL,
  `CATEGORIES_ID` int(11) NOT NULL,
  `SUBSCRIBE_DATE` datetime NOT NULL,
  `NOTIFICATION_FLAG` smallint(6) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_vietnamese_ci;

--
-- Dumping data for table `categories_subscribe`
--

INSERT INTO `categories_subscribe` (`SUBSCRIBE_ID`, `EMPLOYEE_ID`, `CATEGORIES_ID`, `SUBSCRIBE_DATE`, `NOTIFICATION_FLAG`) VALUES
(1, 1, 2, '2022-05-01 00:00:00', 0),
(2, 2, 3, '2022-04-01 00:00:00', 0),
(3, 4, 1, '2022-07-01 00:00:00', 0),
(4, 7, 4, '2022-07-01 00:00:00', 1),
(5, 10, 2, '2022-05-01 00:00:00', 0);

-- --------------------------------------------------------

--
-- Table structure for table `comment`
--

CREATE TABLE `comment` (
  `POST_ID` int(11) NOT NULL,
  `COMMENT_ID` int(11) NOT NULL,
  `EMPLOYEE_ID` int(11) NOT NULL COMMENT 'trường này là khóa ngoại tham chiếu đến nhân viên',
  `CONTENT` varchar(350) COLLATE utf8mb4_vietnamese_ci NOT NULL COMMENT 'nội dung comment, tối đa 300 chữ',
  `CREATE_DATE` datetime NOT NULL,
  `UPDATE_DATE` datetime DEFAULT NULL,
  `LIKE_STATUS` int(11) NOT NULL COMMENT 'tổng lượt like'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_vietnamese_ci;

--
-- Dumping data for table `comment`
--

INSERT INTO `comment` (`POST_ID`, `COMMENT_ID`, `EMPLOYEE_ID`, `CONTENT`, `CREATE_DATE`, `UPDATE_DATE`, `LIKE_STATUS`) VALUES
(2, 1, 1, 'Oh no !', '2022-06-04 00:00:00', NULL, 0),
(3, 1, 4, 'Lừa đảo !!', '2022-04-04 00:00:00', NULL, 0),
(5, 1, 1, 'WoW :v', '2022-07-04 00:00:00', NULL, 0),
(5, 2, 2, 'Mong chờ ghê', '2022-07-04 00:00:00', NULL, 0),
(5, 3, 3, 'Iu sếp !', '2022-07-04 00:00:00', NULL, 0);

-- --------------------------------------------------------

--
-- Table structure for table `information_post`
--

CREATE TABLE `information_post` (
  `POST_ID` int(11) NOT NULL,
  `MANAGER_ID` int(11) NOT NULL,
  `CATEGORIES_ID` int(11) NOT NULL,
  `TITLE` varchar(100) COLLATE utf8mb4_vietnamese_ci NOT NULL COMMENT 'tiêu đề bài đăng',
  `CREATE_DATE` datetime NOT NULL,
  `UPDATE_DATE` datetime DEFAULT NULL,
  `CONTENT` varchar(500) COLLATE utf8mb4_vietnamese_ci NOT NULL COMMENT 'nội dung trong bài đăng, giới hạn ở 400 chữ',
  `TOTAL_LIKES` int(11) NOT NULL COMMENT 'tổng lượt thích',
  `TOTAL_SUBCRIBERS` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_vietnamese_ci;

--
-- Dumping data for table `information_post`
--

INSERT INTO `information_post` (`POST_ID`, `MANAGER_ID`, `CATEGORIES_ID`, `TITLE`, `CREATE_DATE`, `UPDATE_DATE`, `CONTENT`, `TOTAL_LIKES`, `TOTAL_SUBCRIBERS`) VALUES
(1, 2, 1, 'Tuyển dụng quý 1 năm 2022', '2022-01-04 00:00:00', NULL, 'Đây là danh sách những vị trí công ty cần tuyển vào quý 1 năm 2022: <br> Software Engineer: 1 vị trí. <br> Data engineer: 4 vị trí. <br> <br> Nếu nhân viên có ứng viên muốn giới thiệu hãy liên hệ anh Nam phòng nhân sự. Xin cảm ơn', 0, NULL),
(2, 3, 2, 'Giá xăng tiếp tục tăng trong tháng 6-2022', '2022-06-04 00:00:00', NULL, 'Giá xăng được dự kiến sẽ tăng thêm 300 đồng so với kỳ trước, lý do cho sự biến động này đến từ sự khủng hoảng nhiên liệu do cuộc chiến tranh Nga và Ukraina, dự báo sắp tới thì giá xăng vẫn sẽ tăng mà không có dấu hiệu hạ nhiệt', 0, NULL),
(3, 3, 3, 'Tương lai tiền ảo đang lung lay', '2022-01-04 00:00:00', NULL, 'Tỷ phú Bill Gates cho biết ý kiến của mình là: Tiền ảo hay NFT là một sự lừa đảo, kiếm tiền từ thuyết kẻ ngu ngốc hơn, là khi bạn đầu tư vào một mặt hàng giá cao, rủi ro cao và bán lại mặt hàng đó cho người thiếu hiểu biết hơn mình để kiếm lời. Ông Bill Gates còn cho biết thêm ông sẽ không bao giờ khuyến khích đầu tư vào tiền ảo trừ khi bạn là người nhiều tiền như Elon Musk,...', 0, NULL),
(4, 3, 4, 'Lợi nhuận công ty tháng 6/2022', '2022-07-04 00:00:00', NULL, 'Tháng vừa qua, công ty đã gặt hái được nhiều thành công, lợi nhuận cao hơn đến 50% so với cùng kỳ năm ngoái, vượt xa chỉ tiêu ban lãnh đạo đề ra. Ban quản lý xin gửi lời cảm ơn đến tất cả nhân viên vì những cố găng không mệt mỏi của họ trong suốt thời gian qua', 0, NULL),
(5, 3, 5, 'Du lịch Phú Quốc giữa năm', '2022-07-04 00:00:00', NULL, 'Công ty tổ chức chuyến đi Phú Quốc 4 ngày 3 đêm để cảm ơn những sự cố gắng của nhân viên, chi tiết hãy xem thêm ở file đính kèm', 0, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `media_related_contents`
--

CREATE TABLE `media_related_contents` (
  `POST_ID` int(11) NOT NULL,
  `MEDIA_CONTENT_ID` int(11) NOT NULL,
  `TITLE` varchar(200) COLLATE utf8mb4_vietnamese_ci NOT NULL COMMENT 'tên nội dung, gói gon trong 200 ký tự',
  `URL` varchar(2049) COLLATE utf8mb4_vietnamese_ci NOT NULL COMMENT 'link dẫn đến nội dung, ảnh, video,...',
  `CREATE_DATE` datetime NOT NULL,
  `UPDATE_DATE` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_vietnamese_ci;

--
-- Dumping data for table `media_related_contents`
--

INSERT INTO `media_related_contents` (`POST_ID`, `MEDIA_CONTENT_ID`, `TITLE`, `URL`, `CREATE_DATE`, `UPDATE_DATE`) VALUES
(1, 1, 'Ảnh', 'https://abc.com', '2022-01-04 00:00:00', NULL),
(2, 1, 'Ảnh minh họa', 'https://abcd.com', '2022-06-04 00:00:00', NULL),
(3, 1, 'Ảnh minh họa', 'https://abcde.com', '2022-01-04 00:00:00', NULL),
(4, 1, 'Ảnh', 'https://abcdef.com', '2022-07-04 00:00:00', NULL),
(5, 1, 'Ảnh', 'https://abc.com', '2022-07-04 00:00:00', NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`CATEGORIES_ID`);

--
-- Indexes for table `categories_subscribe`
--
ALTER TABLE `categories_subscribe`
  ADD PRIMARY KEY (`SUBSCRIBE_ID`),
  ADD KEY `FK_SUBCRIBE_CATEGORIES` (`CATEGORIES_ID`);

--
-- Indexes for table `comment`
--
ALTER TABLE `comment`
  ADD PRIMARY KEY (`POST_ID`,`COMMENT_ID`);

--
-- Indexes for table `information_post`
--
ALTER TABLE `information_post`
  ADD PRIMARY KEY (`POST_ID`),
  ADD KEY `FK_POST_CATEGORIES` (`CATEGORIES_ID`);

--
-- Indexes for table `media_related_contents`
--
ALTER TABLE `media_related_contents`
  ADD PRIMARY KEY (`POST_ID`,`MEDIA_CONTENT_ID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `information_post`
--
ALTER TABLE `information_post`
  MODIFY `POST_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `categories_subscribe`
--
ALTER TABLE `categories_subscribe`
  ADD CONSTRAINT `FK_SUBCRIBE_CATEGORIES` FOREIGN KEY (`CATEGORIES_ID`) REFERENCES `categories` (`CATEGORIES_ID`);

--
-- Constraints for table `comment`
--
ALTER TABLE `comment`
  ADD CONSTRAINT `FK_COMMENT_POST` FOREIGN KEY (`POST_ID`) REFERENCES `information_post` (`POST_ID`);

--
-- Constraints for table `information_post`
--
ALTER TABLE `information_post`
  ADD CONSTRAINT `FK_POST_CATEGORIES` FOREIGN KEY (`CATEGORIES_ID`) REFERENCES `categories` (`CATEGORIES_ID`);

--
-- Constraints for table `media_related_contents`
--
ALTER TABLE `media_related_contents`
  ADD CONSTRAINT `FK_MEDIA_POST` FOREIGN KEY (`POST_ID`) REFERENCES `information_post` (`POST_ID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
