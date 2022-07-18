-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 17, 2022 at 04:16 PM
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
-- Database: `pa_goal`
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
(2, 8, 6, '2022-07-17 16:45:23', 'Pending', 5, NULL, NULL, '2022-08-30 16:45:23'),
(3, 15, 6, '2022-07-17 19:37:34', 'Cancelled', 1, 'Không có đủ thời gian để hoàn thành mục tiêu', NULL, '2022-07-31 23:02:00'),
(4, 15, 6, '2022-07-16 12:00:00', 'Draft', 1, NULL, NULL, '2022-07-31 23:00:00'),
(5, 14, 6, '2022-07-14 19:44:33', 'Rejected', 1, NULL, 'Mục tiêu của PA này còn quá mơ hồ và quá rộng, chưa thực sự cụ thể', '2022-07-31 23:00:00'),
(6, 14, 6, '2022-07-17 19:51:58', 'Pending', 1, NULL, NULL, '2022-07-31 23:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `pa_goal detail`
--

CREATE TABLE `pa_goal detail` (
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
-- Dumping data for table `pa_goal detail`
--

INSERT INTO `pa_goal detail` (`PAGOALDETAIL_ID`, `PAGOAL_ID`, `GOAL_NAME`, `ACTION_STEP`, `DUE_DATE`, `COMPLETED_DATE`, `STATUS`, `COMMENT`) VALUES
(1, 1, 'Kiếm thêm được nhiều dự án hơn', '1. Mở rộng mối quan hệ\r\n2. Thuyết phục khách hàng\r\n3. Kiếm được khách hàng\r\n4. Chốt dự án + giá cả', '2021-11-30 23:00:00', '2021-11-01 09:00:00', 'Completed', 'Cần hoàn thành nhanh nhất có thể'),
(2, 1, 'Hoàn thành chứng chỉ Oracle Certified Associate (OCA) trong thời gian càng sớm càng tốt', '- Học và sử dụng Oracle cơ bản\r\n- Tham gia khóa học luyện chứng chỉ Oracle Certified Associate (OCA)', '2021-09-01 23:00:00', '2021-08-01 00:00:00', 'Completed', 'Không có comment'),
(3, 1, 'Hoàn thành chứng chỉ Specialist cho Oracle Database 12c', '- Học và sử dụng Oracle cơ bản\r\n- Tham gia khóa học luyện chứng chỉ Specialist cho Oracle Database 12c', '2021-11-01 00:00:00', '2021-10-28 00:00:00', 'Completed', 'Có thể hoàn thành cuối cùng vì chứng chỉ này không bắt buộc'),
(4, 2, 'Hoàn thành dự án Alola trước đầu tháng 10 năm nay', '- Tập trung nhiều giờ hơn để hoàn thành dự án Alola\r\n- Có thể OT thêm vài ngày để thúc đẩy tiến độ dự án, mỗi ngày OT tầm 3-4 tiếng.', '2022-09-30 23:21:27', '1970-01-01 00:00:00', 'Processing', 'Ưu tiên mục tiêu này trước các mục tiêu khác'),
(5, 2, 'Đạt được trình độ Tiếng Anh đầu ra ít nhất: IELTS 6.5 với kĩ năng Speaking >= 5.0 trước tháng 12/2022. Có thể quy đổi ra các chứng chỉ tương đương khác như TOEFL, TOEIC', '- Lập kế hoạch ôn luyện tiếng anh mỗi ngày ít nhất 30 phút\r\n- Luyện nói ở trung tâm VUS vào thứ 7 và CN ít nhất 1 tiếng rưỡi', '2022-11-30 23:00:00', '1970-01-01 00:00:00', 'Processing', 'Không được trễ tiến độ khi hoàn thành mục tiêu này'),
(6, 2, 'Tham gia chương trình Tình nguyện mùa hè xanh vào tháng 8 chung với công ty để đạt KPI', 'Hoàn thành nhanh các công việc trên công ty', '2022-08-30 23:00:00', '1970-01-01 00:00:00', 'Processing', NULL),
(7, 2, 'Hoàn thành chứng chỉ \"Chứng nhận trong quản trị doanh nghiệp CNTT\" ( Certified in the Governance of Enterprise IT – CGEIT)', 'Dành thời gian ôn luyện ít nhất mỗi ngày 30 phút - 1 tiếng. Vào thứ 7, CN thì ôn nhiều hơn (>=2 tiếng)', '2022-11-01 23:00:00', '1970-01-01 00:00:00', 'Processing', NULL),
(8, 2, 'Hoàn thành chứng chỉ \"AWS Certified Solutions Architect – Associate\"', '- Hoàn thành nhanh các công việc trên công ty\r\n- Học các kiến thức AWS cơ bản \r\n- Dành thời gian luyện đề mỗi ngày ít nhất 1 tiếng', '2022-12-31 00:00:00', '1970-01-01 00:00:00', 'Processing', 'Ưu tiên hoàn thành chứng chỉ này hơn các chứng chỉ khác'),
(9, 3, 'Hoàn thành chứng chỉ \"Certified in the Governance of Enterprise IT – CGEIT\" trước giữa tháng 8', '- Dành nhiều thời gian hơn để học và ôn luyện thi mỗi ngày ít nhất 2 tiếng\r\n- Giảm bớt thời gian học và làm việc xuống', '2022-08-15 00:00:00', '1970-01-01 00:00:00', 'Processing', 'Là mục tiêu ưu tiên'),
(10, 4, 'Hoàn thành chứng chỉ \"Data Science Council of America (DASCA) Principle Data Scientist (PDS)\" trước cuối tháng 12', 'Tập trung nhiều giờ hơn để ôn và luyện thi chứng chỉ', '2022-12-31 23:00:00', '1970-01-01 00:00:00', 'Processing', NULL),
(11, 5, 'Hoàn thành các chứng chỉ liên quan đến AWS trong năm nay', 'Chỉ cần tập trung nhiều vào việc ôn thi chứng chỉ là được', '2022-12-31 23:00:00', '1970-01-01 00:00:00', 'Processing', NULL),
(12, 6, 'Hoàn thành chứng chỉ AWS Certified Solutions Architect – Associate trước tháng 10 năm 2022', 'Dành thời gian ôn luyện ít nhất mỗi ngày 30 phút - 1 tiếng. Vào thứ 7, CN thì ôn nhiều hơn (>=2 tiếng)', '2022-09-30 23:59:00', '1970-01-01 00:00:00', 'Processing', NULL);

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
-- Indexes for table `pa_goal detail`
--
ALTER TABLE `pa_goal detail`
  ADD PRIMARY KEY (`PAGOALDETAIL_ID`,`PAGOAL_ID`),
  ADD KEY `FK_PAGoal_Related` (`PAGOAL_ID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `pa_goal`
--
ALTER TABLE `pa_goal`
  MODIFY `PAGOAL_ID` int(11) NOT NULL AUTO_INCREMENT COMMENT 'ID của một PA form. Mỗi PA Form sẽ có nhiều thông tin mục tiêu ', AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `pa_goal detail`
--
ALTER TABLE `pa_goal detail`
  MODIFY `PAGOALDETAIL_ID` int(11) NOT NULL AUTO_INCREMENT COMMENT 'ID của một chi tiết mục tiêu (goal). Một form PA có thể có nhiều thông tin chi tiết mục tiêu', AUTO_INCREMENT=13;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `pa_goal detail`
--
ALTER TABLE `pa_goal detail`
  ADD CONSTRAINT `FK_PAGoal_Related` FOREIGN KEY (`PAGOAL_ID`) REFERENCES `pa_goal` (`PAGOAL_ID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
