-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 30, 2022 at 03:44 PM
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
-- Database: `main_service`
--

-- --------------------------------------------------------

--
-- Table structure for table `pa_feedback`
--

CREATE TABLE `pa_feedback` (
  `PAFB_ID` int(11) NOT NULL COMMENT 'ID của một thông tin feedback, là trường tự tăng',
  `EMPLOYEE_BEINGFEEDBACK_ID` int(11) NOT NULL COMMENT 'Chứa ID của nhân viên cần được đánh giá. Tham chiếu từ bảng employee',
  `EMPLOYEE_FEEDBACK_ID` int(11) NOT NULL COMMENT 'Chứa ID của nhân viên đánh giá, tham chiếu từ bảng employee',
  `RESPONDED_DATE` datetime NOT NULL DEFAULT '1970-01-01 00:00:00' COMMENT 'Thời gian phản hồi gần đây nhất của feedback',
  `CONTENT` varchar(10000) COLLATE utf8mb4_vietnamese_ci NOT NULL DEFAULT 'Hãy điền nội dung đánh giá ở đây' COMMENT 'Chứa nội dung feedback',
  `STATUS` varchar(255) COLLATE utf8mb4_vietnamese_ci NOT NULL DEFAULT 'Not responding' COMMENT 'Trạng thái xử lý của feedback. Gồm 1 trong 2 trạng thái "Not responding", "Responded". Được điền tự động bởi hệ thống, nhân viên không thể sửa. Trạng thái được chuyển sang "Responded" khi nhân viên có điền thông tin feedback',
  `DEADLINE_FEEDBACK` datetime NOT NULL DEFAULT current_timestamp() COMMENT 'Deadline cho việc đánh giá (feedback).  Trường này phải >= RESPONDED_DATE ',
  `EMPLOYEE_MANAGER` int(11) NOT NULL COMMENT 'Chứa ID của quản lý - người quản lý nhân viên làm feedback. Tham chiếu từ bảng Employee'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_vietnamese_ci COMMENT='Bảng này cho biết thông tin của một feedback';

--
-- Dumping data for table `pa_feedback`
--

INSERT INTO `pa_feedback` (`PAFB_ID`, `EMPLOYEE_BEINGFEEDBACK_ID`, `EMPLOYEE_FEEDBACK_ID`, `RESPONDED_DATE`, `CONTENT`, `STATUS`, `DEADLINE_FEEDBACK`, `EMPLOYEE_MANAGER`) VALUES
(1, 6, 8, '2022-07-11 17:48:54', 'Quản lý rất dễ thương, làm việc đúng giờ, teamwork tốt, nên phát huy.', 'Responded', '2022-08-31 23:00:00', 4),
(2, 9, 8, '2022-07-11 12:49:55', 'Đồng đội dễ thương, làm việc nhiệt tình, năng suất.', 'Responded', '2022-08-31 23:00:00', 6),
(3, 7, 8, '2022-07-10 17:51:12', 'Bạn nữ xinh, dễ thương, học hỏi nhanh, có chí tiến thủ', 'Responded', '2022-08-31 23:00:00', 6),
(4, 4, 6, '1970-01-01 00:00:00', 'Hãy điền nội dung đánh giá ở đây', 'Not responding', '2022-07-15 23:00:00', 5),
(5, 15, 8, '2022-07-17 11:03:46', 'Chị Linh làm việc rất chăm chỉ, giỏi và thân thiện. Chị ấy cũng thường xuyên giúp đỡ các thành viên khác', 'Responded', '2022-08-31 23:00:00', 6),
(6, 13, 8, '1970-01-01 00:00:00', 'Hãy điền nội dung đánh giá ở đây', 'Not responding', '2022-08-31 23:00:00', 6);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `pa_feedback`
--
ALTER TABLE `pa_feedback`
  ADD PRIMARY KEY (`PAFB_ID`),
  ADD KEY `FK_Employee_Being_Feedback` (`EMPLOYEE_BEINGFEEDBACK_ID`),
  ADD KEY `FK_Employee_Feedback` (`EMPLOYEE_FEEDBACK_ID`),
  ADD KEY `FK_Feedback_Manager` (`EMPLOYEE_MANAGER`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `pa_feedback`
--
ALTER TABLE `pa_feedback`
  MODIFY `PAFB_ID` int(11) NOT NULL AUTO_INCREMENT COMMENT 'ID của một thông tin feedback, là trường tự tăng', AUTO_INCREMENT=7;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `pa_feedback`
--
ALTER TABLE `pa_feedback`
  ADD CONSTRAINT `FK_Employee_Being_Feedback` FOREIGN KEY (`EMPLOYEE_BEINGFEEDBACK_ID`) REFERENCES `employee` (`EMPLOYEE_ID`),
  ADD CONSTRAINT `FK_Employee_Feedback` FOREIGN KEY (`EMPLOYEE_FEEDBACK_ID`) REFERENCES `employee` (`EMPLOYEE_ID`),
  ADD CONSTRAINT `FK_Feedback_Manager` FOREIGN KEY (`EMPLOYEE_MANAGER`) REFERENCES `employee` (`EMPLOYEE_ID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
