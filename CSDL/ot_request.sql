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
-- Database: `ot_request`
--

-- --------------------------------------------------------

--
-- Table structure for table `request ot`
--

CREATE TABLE `request ot` (
  `ROT_ID` int(11) NOT NULL COMMENT 'Mã của 1 request OT, là trường tự tăng',
  `EMPLOYEE_ID` int(11) NOT NULL COMMENT 'Chứa ID của nhân viên tạo ra request OT',
  `MANAGER_ID` int(11) NOT NULL COMMENT 'Chứa ID của nhân viên quản lý cấp 1 của nhân viên tạo ra request',
  `REASON` varchar(5000) COLLATE utf8mb4_vietnamese_ci NOT NULL COMMENT 'Lý do nhân viên muốn làm việc OT',
  `CREATE_DATE` timestamp NOT NULL DEFAULT current_timestamp() COMMENT 'Thời gian tạo request OT',
  `UPDATE_DATE` timestamp NOT NULL DEFAULT current_timestamp() COMMENT 'Thời gian cập nhật thông tin của request OT gần nhất. Mặc định là 1970-01-01 00:00:00, khi được cập nhật lại, thời gian này phải >= CREATE_DATE',
  `STATUS` varchar(255) COLLATE utf8mb4_vietnamese_ci NOT NULL DEFAULT 'Draft' COMMENT 'Trạng thái xử lý của request OT. Gồm 1 trong 5 trạng thái: Draft, Pending, Approved, Rejected, Cancelled. Được điền tự động bởi hệ thống, nhân viên không thể sửa.',
  `MANAGER_COMMENT` varchar(5000) COLLATE utf8mb4_vietnamese_ci DEFAULT 'None' COMMENT 'Ghi lí do quản lý cấp 1 từ chối request OT. Nếu trường này có thông tin, trạng thái của request phải là "Rejected", mặc định là None',
  `START_DATE` date NOT NULL DEFAULT '1970-01-01' COMMENT 'Ngày bắt đầu dự kiến làm việc OT',
  `ESTIMATED_HOURS` decimal(11,0) NOT NULL DEFAULT 0 COMMENT 'Tổng thời gian dự kiến sẽ làm việc OT. Thời gian này được tính dựa trên chi tiết request ot từ bảng request ot detail',
  `END_DATE` date NOT NULL DEFAULT '1970-01-01' COMMENT 'Ngày kết thúc dự kiến làm việc OT. Mặc định có giá trị là 1970-01-01, khi được cập nhật lại, thời gian này phải >= Ngày bắt đầu OT',
  `UNSUBMIT_REASON` varchar(5000) COLLATE utf8mb4_vietnamese_ci DEFAULT 'None' COMMENT 'Lý do nhân viên muốn hủy gửi (unsubmit) request OT. Nếu trường này có thông tin, trạng thái của request bắt buộc là Cancelled, mặc định là None',
  `NOTIFICATION_FLAG` tinyint(4) NOT NULL DEFAULT 0 COMMENT 'Nhân viên khi tạo request OT chọn "Yes" hay "No" cho mục "Email follow up". 0 là No, 1 là Yes'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_vietnamese_ci COMMENT='Bảng này cho biết thông tin của 1 request OT';

--
-- Dumping data for table `request ot`
--

INSERT INTO `request ot` (`ROT_ID`, `EMPLOYEE_ID`, `MANAGER_ID`, `REASON`, `CREATE_DATE`, `UPDATE_DATE`, `STATUS`, `MANAGER_COMMENT`, `START_DATE`, `ESTIMATED_HOURS`, `END_DATE`, `UNSUBMIT_REASON`, `NOTIFICATION_FLAG`) VALUES
(2, 15, 6, 'Làm không kịp nên tăng ca để kịp tiến độ dự án mới', '2022-07-17 05:08:03', '2022-07-18 05:08:03', 'Pending', 'None', '2022-07-16', '4', '2022-07-16', 'None', 1),
(3, 14, 6, 'Anh có việc gia đình cần nghỉ 1 tuần nên anh cần tăng ca để làm bù để kịp tiến độ dự án.', '2022-07-15 05:12:35', '2022-07-15 06:12:35', 'Approved', 'None', '2022-08-01', '6', '2022-08-03', 'None', 1),
(4, 8, 6, 'Dự án Alola cần bàn giao cho khách hàng gấp vào cuối tháng 8 nên em cần OT để kịp tiến độ', '2022-07-17 05:14:54', '2029-07-22 05:50:04', 'Canceled', '', '2022-07-23', '13', '2022-07-27', 'em Chịu rồi anh', 1),
(22, 8, 6, 'bản vip', '2022-07-29 01:32:02', '2029-07-21 18:32:02', 'Canceled', '', '2022-07-29', '0', '2022-07-29', 'ádasdasd', 0),
(23, 8, 6, 'demo post', '2022-07-29 01:33:09', '2029-07-21 18:33:09', 'Canceled', '', '2022-07-29', '2', '2022-07-29', 'chịu thôi anh zai', 0),
(26, 8, 6, 'game gì đó', '2022-07-29 01:41:59', '2029-07-21 18:41:59', 'Canceled', '', '2022-07-29', '2', '2022-07-29', 'trở về nè', 0),
(27, 8, 6, 'một con bọ cute', '2022-07-29 01:45:23', '2029-07-21 18:50:19', 'Canceled', '', '2022-07-29', '2', '2022-07-29', 'sadasdas', 0),
(29, 8, 6, 'gi ddos ', '2022-07-29 02:21:41', '2029-07-21 19:21:41', 'Pending', '', '2022-07-29', '2', '2022-07-29', '', 0),
(30, 8, 6, 'gi ddos ', '2022-07-29 02:21:49', '2029-07-21 19:21:49', 'Pending', '', '2022-07-29', '2', '2022-07-29', '', 0),
(31, 8, 6, 'asdasdasdas', '2022-07-29 02:24:41', '2029-07-21 19:24:48', 'Pending', '', '2022-07-29', '2', '2022-07-29', '', 0),
(32, 8, 6, 'asdasdasd', '2022-07-29 02:24:56', '2029-07-21 19:24:57', 'Pending', '', '2022-07-29', '0', '2022-07-29', '', 0),
(33, 8, 6, 'demo ?', '2022-07-29 02:25:08', '2029-07-21 19:25:08', 'Pending', '', '2022-07-29', '2', '2022-07-29', '', 0),
(34, 8, 6, 'demo nao', '2022-07-29 02:25:30', '2029-07-21 19:25:30', 'Pending', '', '2022-07-29', '2', '2022-07-29', '', 0),
(35, 8, 6, 'demo nhe', '2022-07-29 02:27:39', '2029-07-21 19:27:39', 'Draft', '', '2022-07-29', '0', '2022-07-29', '', 0),
(36, 8, 6, 'demo cai nhe', '2022-07-29 02:28:00', '2029-07-21 19:28:00', 'Draft', '', '2022-07-29', '0', '2022-07-29', '', 0),
(37, 8, 6, 'demo cai nhe', '2022-07-29 02:28:02', '2029-07-21 19:28:02', 'Pending', '', '2022-07-29', '0', '2022-07-29', '', 0),
(38, 8, 6, 'aHIHI AHIHI', '2022-07-29 02:28:36', '2022-08-08 00:42:37', 'Pending', '', '2022-08-08', '6', '2022-08-17', '', 1),
(39, 8, 6, 'Hehehebehehehehehe', '2022-07-29 02:33:03', '2022-08-07 01:20:50', 'Canceled', '', '2022-07-31', '3', '2022-12-31', 'Không muốn làm nữa thì nghỉ', 0),
(41, 8, 6, 'mình sửa lại xíu thôi', '2022-07-29 02:34:36', '2029-07-21 20:36:48', 'Canceled', '', '2022-07-28', '5', '2022-08-11', 'Không muốn OT nữa cực quá', 0),
(42, 8, 6, 'day là bản rác ?\r\nkhông phải', '2022-07-29 02:36:59', '2029-07-21 19:37:09', 'Canceled', '', '2022-07-29', '3', '2022-07-29', 'sorry em nhầm', 0),
(44, 8, 6, 'Chay deadline dis sml ', '2022-07-29 13:48:21', '2022-07-30 04:09:40', 'Canceled', '', '2022-08-10', '3', '2022-08-11', 'Không thích làm nữa', 0),
(45, 8, 6, 'mhu mhu', '2022-07-30 16:11:41', '2022-08-06 18:10:11', 'Pending', '', '2022-07-31', '4', '2022-08-07', '', 1),
(46, 6, 4, 'OT THÊM MỘT NGÀY ĐỂ MỐT ĐI CHƠI', '2022-07-30 16:21:30', '2022-07-30 04:22:39', 'Pending', '', '2022-07-31', '1', '2022-07-31', '', 0),
(47, 8, 6, 'Tui muốn OT để kiếm thêm tiền', '2022-07-31 09:49:05', '2022-07-30 23:37:24', 'Canceled', '', '2022-08-01', '4', '2022-08-02', 'Chán r k muốn làm nữa', 1),
(48, 8, 6, 'Muốn OT vào tháng 12', '2022-07-31 11:40:22', '2022-07-30 23:40:41', 'Canceled', '', '2022-12-12', '4', '2022-12-13', 'Không muốn làm nữa thì nghỉ thôi', 1),
(49, 8, 6, 'Tạo mới để test mail', '2022-08-08 00:39:35', '2022-08-07 19:45:18', 'Canceled', '', '2022-08-08', '7', '2022-08-10', 'Méo muốn làm nữa', 1);

-- --------------------------------------------------------

--
-- Table structure for table `request ot detail`
--

CREATE TABLE `request ot detail` (
  `ROTDETAIL_ID` int(11) NOT NULL COMMENT 'ID của một chi tiết request OT. Một request OT có thể có nhiều thông tin chi tiết',
  `ROT_ID` int(11) NOT NULL COMMENT 'ID của request OT mà chi tiết request OT thuộc về. Tham chiếu từ bảng request ot',
  `DATE` date NOT NULL DEFAULT '1970-01-01' COMMENT 'Ngày nhân viên làm việc OT',
  `HOUR` decimal(10,0) NOT NULL DEFAULT 0 COMMENT 'Số giờ trong 1 ngày mà nhân viên đó làm việc OT. Không được quá 4 giờ trong 1 ngày'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_vietnamese_ci COMMENT='Bảng này cho biết thông tin của một CHI TIẾT request OT';

--
-- Dumping data for table `request ot detail`
--

INSERT INTO `request ot detail` (`ROTDETAIL_ID`, `ROT_ID`, `DATE`, `HOUR`) VALUES
(10, 2, '2022-07-16', '4'),
(11, 3, '2022-08-01', '3'),
(12, 3, '2022-08-02', '2'),
(13, 3, '2022-08-03', '1'),
(23, 4, '2022-07-25', '4'),
(24, 4, '2022-07-26', '4'),
(25, 4, '2022-07-27', '4'),
(26, 4, '2022-07-23', '1'),
(56, 23, '2022-07-29', '1'),
(57, 23, '2022-07-29', '1'),
(58, 26, '2022-07-29', '1'),
(59, 26, '2022-07-29', '1'),
(60, 27, '2022-07-29', '1'),
(61, 27, '2022-07-29', '1'),
(65, 29, '2022-07-29', '1'),
(66, 29, '2022-07-29', '1'),
(67, 30, '2022-07-29', '1'),
(68, 30, '2022-07-29', '1'),
(73, 31, '2022-07-29', '1'),
(74, 31, '2022-07-29', '1'),
(75, 33, '2022-07-29', '1'),
(76, 33, '2022-07-29', '1'),
(77, 34, '2022-07-29', '1'),
(78, 34, '2022-07-29', '1'),
(100, 42, '2022-07-29', '1'),
(101, 42, '2022-07-29', '1'),
(102, 42, '2022-07-29', '1'),
(165, 41, '2022-07-28', '1'),
(166, 41, '2022-07-31', '1'),
(167, 41, '2022-08-11', '3'),
(370, 44, '2022-08-10', '1'),
(371, 44, '2022-08-11', '2'),
(401, 46, '2022-07-31', '1'),
(410, 47, '2022-08-01', '3'),
(411, 47, '2022-08-02', '1'),
(416, 48, '2022-12-12', '3'),
(417, 48, '2022-12-13', '1'),
(418, 45, '2022-07-31', '2'),
(419, 45, '2022-08-02', '1'),
(420, 45, '2022-08-07', '1'),
(421, 39, '2022-07-31', '1'),
(422, 39, '2022-12-31', '1'),
(423, 39, '2022-08-07', '1'),
(433, 38, '2022-08-08', '1'),
(434, 38, '2022-08-15', '1'),
(435, 38, '2022-08-17', '4'),
(436, 49, '2022-08-08', '4'),
(437, 49, '2022-08-10', '3');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `request ot`
--
ALTER TABLE `request ot`
  ADD PRIMARY KEY (`ROT_ID`),
  ADD KEY `FK_EmployeeCreate` (`EMPLOYEE_ID`),
  ADD KEY `FK_Appraiser_Manage` (`MANAGER_ID`);

--
-- Indexes for table `request ot detail`
--
ALTER TABLE `request ot detail`
  ADD PRIMARY KEY (`ROTDETAIL_ID`,`ROT_ID`),
  ADD KEY `FK_OTReq_Related` (`ROT_ID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `request ot`
--
ALTER TABLE `request ot`
  MODIFY `ROT_ID` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Mã của 1 request OT, là trường tự tăng', AUTO_INCREMENT=50;

--
-- AUTO_INCREMENT for table `request ot detail`
--
ALTER TABLE `request ot detail`
  MODIFY `ROTDETAIL_ID` int(11) NOT NULL AUTO_INCREMENT COMMENT 'ID của một chi tiết request OT. Một request OT có thể có nhiều thông tin chi tiết', AUTO_INCREMENT=438;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `request ot detail`
--
ALTER TABLE `request ot detail`
  ADD CONSTRAINT `FK_OTReq_Related` FOREIGN KEY (`ROT_ID`) REFERENCES `request ot` (`ROT_ID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
