-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 05, 2022 at 02:52 PM
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
  `CREATE_DATE` datetime NOT NULL DEFAULT '1970-01-01 00:00:00' COMMENT 'Thời gian tạo request OT',
  `UPDATE_DATE` datetime NOT NULL DEFAULT '1970-01-01 00:00:00' COMMENT 'Thời gian cập nhật thông tin của request OT gần nhất. Mặc định là 1970-01-01 00:00:00, khi được cập nhật lại, thời gian này phải >= CREATE_DATE',
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
(1, 8, 6, 'Cần hoàn thành gấp', '2022-07-11 17:40:03', '2022-08-05 07:47:16', 'Pending', '', '2022-08-05', '4', '2022-08-31', '', 0),
(2, 15, 6, 'Làm không kịp nên tăng ca để kịp tiến độ dự án mới', '2022-07-17 12:08:03', '2022-07-18 12:08:03', 'Pending', 'None', '2022-07-16', '4', '2022-07-16', 'None', 1),
(3, 14, 6, 'Anh có việc gia đình cần nghỉ 1 tuần nên anh cần tăng ca để làm bù để kịp tiến độ dự án.', '2022-07-15 12:12:35', '2022-07-15 13:12:35', 'Approved', 'None', '2022-08-01', '6', '2022-08-03', 'None', 1),
(5, 8, 6, 'Em xin OT để tuần sau em nghỉ đi chơi với người yêu', '2022-07-16 12:14:54', '2022-07-17 15:25:54', 'Canceled', 'None', '2022-08-15', '4', '2022-08-18', 'Lí do em ghi còn chưa thật sự hợp lí, em xin được thu hồi request để gửi lại request mới', 0),
(6, 8, 6, 'Test OT request lần 2', '1970-01-01 00:00:00', '2022-08-05 07:48:40', 'Draft', '', '2022-08-05', '4', '2022-08-07', '', 0),
(7, 8, 6, 'Test OT request lần 3 để có phân trang', '1970-01-01 00:00:00', '2022-08-05 07:49:33', 'Canceled', '', '2022-09-05', '6', '2022-10-07', 'Không thích oT nữa :)', 0),
(8, 8, 6, 'Ê điền lí do vào', '1970-01-01 00:00:00', '2022-08-05 07:51:20', 'Draft', '', '2022-10-15', '5', '2022-10-17', '', 0),
(9, 8, 6, 'TUI CẦN OT ĐỂ T9 NGHỈ 2 TUẦN', '1970-01-01 00:00:00', '2022-08-05 07:51:53', 'Pending', '', '2022-08-24', '8', '2022-08-25', '', 0);

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
(6, 5, '2022-08-15', '1'),
(7, 5, '2022-08-16', '1'),
(8, 5, '2022-08-17', '1'),
(9, 5, '2022-08-18', '1'),
(10, 2, '2022-07-16', '4'),
(11, 3, '2022-08-01', '3'),
(12, 3, '2022-08-02', '2'),
(13, 3, '2022-08-03', '1'),
(18, 1, '2022-08-05', '3'),
(19, 1, '2022-08-31', '1'),
(20, 6, '2022-08-05', '1'),
(21, 6, '2022-08-07', '3'),
(25, 7, '2022-09-05', '1'),
(26, 7, '2022-10-05', '1'),
(27, 7, '2022-10-07', '4'),
(28, 8, '2022-10-15', '1'),
(29, 8, '2022-10-17', '4'),
(32, 9, '2022-08-24', '4'),
(33, 9, '2022-08-25', '4');

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
  MODIFY `ROT_ID` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Mã của 1 request OT, là trường tự tăng', AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `request ot detail`
--
ALTER TABLE `request ot detail`
  MODIFY `ROTDETAIL_ID` int(11) NOT NULL AUTO_INCREMENT COMMENT 'ID của một chi tiết request OT. Một request OT có thể có nhiều thông tin chi tiết', AUTO_INCREMENT=34;

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
