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
-- Database: `pagoalform`
--

-- --------------------------------------------------------

--
-- Table structure for table `pa_goal`
--

CREATE TABLE `pa_goal` (
  `PAGOAL_ID` int(11) NOT NULL COMMENT 'ID của một PA form. Mỗi PA Form sẽ có nhiều thông tin mục tiêu ',
  `EMPLOYEECREATE_ID` int(11) NOT NULL COMMENT 'ID của nhân viên tạo ra PA Form đó. Tham chiếu từ bảng employee',
  `MANAGER_ID` int(11) NOT NULL COMMENT 'ID của quản lý cấp 1 quản lý PA form và nhân viên tạo PA Form. Tham chiếu từ bảng employee',
  `LASTUPDATE_DATE` datetime NOT NULL DEFAULT '1970-01-01 00:00:00' COMMENT 'Thời gian cập nhật PA Form gần đây nhất. Mặc định để là ''1970-01-01 00:00:00''',
  `STATUS` varchar(255) COLLATE utf8mb4_vietnamese_ci NOT NULL DEFAULT 'Draft' COMMENT 'Trạng thái xử lý của request OT. Gồm 1 trong 5 trạng thái: Draft, Pending, Approved, Rejected, Cancelled.',
  `TOTAL_GOALS` int(11) NOT NULL DEFAULT 1 COMMENT 'Tổng mục tiêu của PA Form. Thông tin này được tính trên số lượng thông tin chi tiết goal của bảng pa goal detail cho PA Form đó',
  `UNSUBMIT_REASON` varchar(5000) COLLATE utf8mb4_vietnamese_ci DEFAULT NULL COMMENT 'Lý do nhân viên muốn hủy gửi (unsubmit) form PA. Nếu trường này có thông tin, trạng thái của request bắt buộc là Cancelled, mặc định là None	',
  `MANAGER_COMMENT` varchar(5000) COLLATE utf8mb4_vietnamese_ci DEFAULT NULL COMMENT 'Ghi lí do quản lý cấp 1 từ chối form PA. Nếu trường này có thông tin, trạng thái của form phải là "Rejected", mặc định là None',
  `DEADLINE_PAGOAL` datetime NOT NULL COMMENT 'Deadline phải nộp PA Form. Thời gian này phải >= LASTUPDATE_DATE'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_vietnamese_ci COMMENT='Bảng này cho biết thông tin của một PA Form';

--
-- Dumping data for table `pa_goal`
--

INSERT INTO `pa_goal` (`PAGOAL_ID`, `EMPLOYEECREATE_ID`, `MANAGER_ID`, `LASTUPDATE_DATE`, `STATUS`, `TOTAL_GOALS`, `UNSUBMIT_REASON`, `MANAGER_COMMENT`, `DEADLINE_PAGOAL`) VALUES
(1, 8, 6, '2021-07-11 21:00:00', 'Approved', 3, NULL, NULL, '2021-07-30 23:00:00'),
(2, 8, 6, '2022-08-08 10:37:20', 'Pending', 1, '', '', '2022-08-10 16:45:23'),
(3, 8, 6, '2019-09-17 19:37:34', 'Pending', 1, '', NULL, '2019-07-31 23:02:00'),
(4, 15, 6, '2022-07-16 12:00:00', 'Draft', 1, NULL, NULL, '2022-07-31 23:00:00'),
(5, 14, 6, '2022-07-28 22:23:01', 'Rejected', 0, NULL, 'Mục tiêu của PA này còn quá mơ hồ và quá rộng, chưa thực sự cụ thể', '2022-07-31 23:00:00'),
(6, 14, 6, '2022-07-29 14:58:44', 'Rejected', 1, NULL, 'Khoong phu hop de lam', '2022-07-31 23:00:00'),
(7, 8, 6, '2016-08-31 21:00:00', 'Pending', 2, NULL, NULL, '2016-08-31 23:00:00'),
(9, 8, 6, '2020-09-02 08:45:20', 'Rejected', 1, NULL, 'Không hợp lệ', '2020-09-30 08:45:20'),
(10, 8, 6, '2017-09-02 15:45:20', 'Approved', 1, NULL, '', '2017-09-30 23:45:20'),
(11, 8, 6, '2018-07-25 17:55:00', 'Pending', 1, NULL, NULL, '2018-07-31 23:55:55');

-- --------------------------------------------------------

--
-- Table structure for table `pa_goal_detail`
--

CREATE TABLE `pa_goal_detail` (
  `PAGOALDETAIL_ID` int(11) NOT NULL COMMENT 'ID của một chi tiết mục tiêu (goal). Một form PA có thể có nhiều thông tin chi tiết mục tiêu',
  `PAGOAL_ID` int(11) NOT NULL COMMENT 'ID của PA Form mà chi tiết mục tiêu thuộc về. Tham chiếu từ bảng pa goal',
  `GOAL_NAME` varchar(255) COLLATE utf8mb4_vietnamese_ci DEFAULT NULL COMMENT 'Chứa thông tin về tên của mục tiêu',
  `ACTION_STEP` varchar(5000) COLLATE utf8mb4_vietnamese_ci DEFAULT NULL COMMENT 'Chứa các bước thực hiện mục tiêu đó',
  `DUE_DATE` datetime NOT NULL DEFAULT '1970-01-01 00:00:00' COMMENT 'Ngày dự kiến hoàn thành của mục tiêu',
  `COMPLETED_DATE` datetime NOT NULL DEFAULT '1970-01-01 00:00:00' COMMENT 'Ngày hoàn thành thực tế của mục tiêu. Mặc định để là 1970-01-01 00:00:00, trong TH trạng thái của mục tiêu là "Completed" thì trường này phải có giá trỊ sao cho Complete Date phải >= Due Date',
  `STATUS` varchar(255) COLLATE utf8mb4_vietnamese_ci NOT NULL DEFAULT 'Processing' COMMENT 'Trạng thái hoàn thành của mục tiêu đó.Có 1 trong 2 trạng thái "Processing", "Completed". Lưu ý: Trạng thái này của mục tiêu khác với trạng thái của PA Form. Trạng thái này nhân viên có thể sửa được.',
  `COMMENT` varchar(5000) COLLATE utf8mb4_vietnamese_ci DEFAULT NULL COMMENT 'Bình luận của nhân viên về mục tiêu mà mình tạo ra'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_vietnamese_ci COMMENT='Bảng này cho biết thông tin của 1 CHI TIẾT goal của PA Form';

--
-- Dumping data for table `pa_goal_detail`
--

INSERT INTO `pa_goal_detail` (`PAGOALDETAIL_ID`, `PAGOAL_ID`, `GOAL_NAME`, `ACTION_STEP`, `DUE_DATE`, `COMPLETED_DATE`, `STATUS`, `COMMENT`) VALUES
(1, 1, 'Kiếm thêm được nhiều dự án hơn', '1. Mở rộng mối quan hệ\r\n2. Thuyết phục khách hàng\r\n3. Kiếm được khách hàng\r\n4. Chốt dự án + giá cả', '2021-11-30 23:00:00', '2021-11-01 09:00:00', 'Completed', 'Cần hoàn thành nhanh nhất có thể'),
(2, 1, 'Hoàn thành chứng chỉ Oracle Certified Associate (OCA) trong thời gian càng sớm càng tốt', '- Học và sử dụng Oracle cơ bản\r\n- Tham gia khóa học luyện chứng chỉ Oracle Certified Associate (OCA)', '2021-09-01 23:00:00', '2021-08-01 00:00:00', 'Completed', 'Không có comment'),
(3, 1, 'Hoàn thành chứng chỉ Specialist cho Oracle Database 12c', '- Học và sử dụng Oracle cơ bản\r\n- Tham gia khóa học luyện chứng chỉ Specialist cho Oracle Database 12c', '2021-11-01 00:00:00', '2021-10-28 00:00:00', 'Completed', 'Có thể hoàn thành cuối cùng vì chứng chỉ này không bắt buộc'),
(9, 3, 'Hoàn thành chứng chỉ \"Certified in the Governance of Enterprise IT – CGEIT\" trước giữa tháng 8', '- Dành nhiều thời gian hơn để học và ôn luyện thi mỗi ngày ít nhất 2 tiếng\r\n- Giảm bớt thời gian học và làm việc xuống', '2022-08-15 00:00:00', '1970-01-01 00:00:00', 'Processing', 'Là mục tiêu ưu tiên'),
(10, 4, 'Hoàn thành chứng chỉ \"Data Science Council of America (DASCA) Principle Data Scientist (PDS)\" trước cuối tháng 12', 'Tập trung nhiều giờ hơn để ôn và luyện thi chứng chỉ', '2022-12-31 23:00:00', '1970-01-01 00:00:00', 'Processing', NULL),
(12, 6, 'Hoàn thành chứng chỉ AWS Certified Solutions Architect – Associate trước tháng 10 năm 2022', 'Dành thời gian ôn luyện ít nhất mỗi ngày 30 phút - 1 tiếng. Vào thứ 7, CN thì ôn nhiều hơn (>=2 tiếng)', '2022-09-30 23:59:00', '1970-01-01 00:00:00', 'Processing', NULL),
(16, 7, 'Kiếm thêm được nhiều tiền', '1. Mở rộng mối quan hệ\r\n2. Thuyết phục khách hàng\r\n3. Kiếm được khách hang trả thêm tiền\r\n5. Nhận tiên hihi', '2016-11-21 21:00:00', '2016-10-31 21:00:00', 'Completed', 'Cần hoàn thành nhanh nhất có thể'),
(17, 7, 'Mở quán ăn nhỏ gần trường', '1. Mở rộng mối quan hệ\r\n2. Thuyết phục khách hàng\r\n3. Kiếm được khách hang trả thêm tiền\r\n5. Nhận tiền hoa hồng hihi', '2016-11-21 21:00:00', '2016-10-31 21:00:00', 'Completed', 'Không có mức độ ưu tiên quá cao'),
(18, 9, 'Học tiếng nhật đủ target', '1. Đặt mục tiêu đạt N3\r\n2. Đến trung tâm học 3 ngày/tuần\r\n3. Tự ôn ở nhà 5h/ngày', '2020-12-31 21:00:00', '2020-11-29 21:00:00', 'Completed', 'Có mức độ ưu tiên cao vì công ty cần'),
(36, 2, 'Gì v mấy má ui', 'kHÔNG CÓ GÌ', '2022-08-30 00:00:00', '2022-08-01 00:00:00', 'Completed', 'KHUM CÓ GÌ');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `pa_goal`
--
ALTER TABLE `pa_goal`
  ADD PRIMARY KEY (`PAGOAL_ID`),
  ADD KEY `FK_Employee_Create` (`EMPLOYEECREATE_ID`),
  ADD KEY `FK_Employee_Manager` (`MANAGER_ID`);

--
-- Indexes for table `pa_goal_detail`
--
ALTER TABLE `pa_goal_detail`
  ADD PRIMARY KEY (`PAGOALDETAIL_ID`,`PAGOAL_ID`),
  ADD KEY `FK_PAGoal_Related` (`PAGOAL_ID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `pa_goal`
--
ALTER TABLE `pa_goal`
  MODIFY `PAGOAL_ID` int(11) NOT NULL AUTO_INCREMENT COMMENT 'ID của một PA form. Mỗi PA Form sẽ có nhiều thông tin mục tiêu ', AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `pa_goal_detail`
--
ALTER TABLE `pa_goal_detail`
  MODIFY `PAGOALDETAIL_ID` int(11) NOT NULL AUTO_INCREMENT COMMENT 'ID của một chi tiết mục tiêu (goal). Một form PA có thể có nhiều thông tin chi tiết mục tiêu', AUTO_INCREMENT=37;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `pa_goal_detail`
--
ALTER TABLE `pa_goal_detail`
  ADD CONSTRAINT `FK_PAGoal_Related` FOREIGN KEY (`PAGOAL_ID`) REFERENCES `pa_goal` (`PAGOAL_ID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
