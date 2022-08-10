-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 10, 2022 at 05:02 AM
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
-- Table structure for table `categories_subscribe`
--

CREATE TABLE `categories_subscribe` (
  `SUBSCRIBE_ID` int(11) NOT NULL COMMENT 'trường này để lưu khóa tự tăng thể hiện mã của việc đăng ký',
  `EMPLOYEE_ID` int(11) NOT NULL COMMENT 'trường này là khóa ngoại tham chiếu đến mã nhân viên',
  `CATEGORIES_ID` int(11) NOT NULL COMMENT 'trường này là khóa ngoại tham chiếu đến mã thể loại',
  `SUBSCRIBE_DATE` datetime NOT NULL COMMENT 'trường này là ngày mà nhân viên đăng ký thể loại',
  `NOTIFICATION_FLAG` smallint(6) NOT NULL COMMENT 'trường này thể hiện nhân viên có muốn nhận thông báo khi có bài viết mới được đăng ký được đăng lên hệ thống không'
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
-- Table structure for table `department`
--

CREATE TABLE `department` (
  `DEPART_ID` int(11) NOT NULL COMMENT 'ID của phòng ban, là trường tự tăng',
  `MANAGER_ID` int(11) DEFAULT NULL COMMENT 'Trường này ghi ID của nhân viên quản lý phòng ban. Tham chiếu từ bảng "employee"',
  `NAME` varchar(522) COLLATE utf8mb4_vietnamese_ci NOT NULL COMMENT 'Tên đầy đủ của phòng ban',
  `PHONE` varchar(12) COLLATE utf8mb4_vietnamese_ci DEFAULT NULL COMMENT 'SĐT để liên lạc với phòng ban'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_vietnamese_ci COMMENT='Bảng này cho biết thông tin của một văn phòng/ban ';

--
-- Dumping data for table `department`
--

INSERT INTO `department` (`DEPART_ID`, `MANAGER_ID`, `NAME`, `PHONE`) VALUES
(1, 1, 'Phòng Kế toán', '0586037708'),
(2, 2, 'Phòng Quan hệ quốc tế', '0586484874'),
(3, 3, 'Phòng Nhân sự', '0586073704'),
(4, 4, 'Phòng Công nghệ thông tin', '0367778384'),
(5, 5, 'Phòng Giám đốc', '0366878384');

-- --------------------------------------------------------

--
-- Table structure for table `employee`
--

CREATE TABLE `employee` (
  `EMPLOYEE_ID` int(11) NOT NULL COMMENT 'ID của nhân viên, là trường tự tăng',
  `DEPART_ID` int(11) DEFAULT NULL COMMENT 'ID của phòng ban mà nhân viên này đang làm việc. Tham chiếu từ bảng deparment',
  `MANAGER_ID` int(11) DEFAULT NULL COMMENT 'ID của quản lý có quản lý nhân viên này. Quản lý không có ai quản lý mình thì để NULL, tham chiếu từ chính bảng employee',
  `NAME` varchar(255) COLLATE utf8mb4_vietnamese_ci NOT NULL COMMENT 'Họ tên đầy đủ của nhân viên',
  `EMAIL` varchar(50) COLLATE utf8mb4_vietnamese_ci NOT NULL COMMENT 'Email công ty của nhân viên',
  `PHONE` varchar(12) COLLATE utf8mb4_vietnamese_ci DEFAULT NULL COMMENT 'SĐT của nhân viên',
  `SALARY_RATE` decimal(10,0) NOT NULL DEFAULT 0 COMMENT 'Tiền lương dự trù của nhân viên',
  `TYPE` text COLLATE utf8mb4_vietnamese_ci NOT NULL COMMENT 'Loại hình làm việc: "Full-time", "Part-time", "Temporary", "Seasonal"',
  `USERNAME` varchar(255) COLLATE utf8mb4_vietnamese_ci NOT NULL DEFAULT 'admin' COMMENT 'Username của mỗi nhân viên. Username được cấp bởi công ty. Truong nay la unique',
  `PASSWORD` varchar(522) COLLATE utf8mb4_vietnamese_ci NOT NULL DEFAULT '12345678' COMMENT 'Password của mỗi nhân viên. Password được cấp bởi công ty',
  `TITLE` varchar(255) COLLATE utf8mb4_vietnamese_ci NOT NULL COMMENT 'Vị trí làm việc của nhân viên đó. VD: "Software Engineer"',
  `STATUS` varchar(255) COLLATE utf8mb4_vietnamese_ci NOT NULL DEFAULT 'Enabled' COMMENT 'Trạng thái làm việc hiện tại của NV đó. VD: "Enabled", "Disabled"',
  `ADDRESS` varchar(522) COLLATE utf8mb4_vietnamese_ci DEFAULT NULL COMMENT 'Địa chỉ nhà của nhân viên đó',
  `CMND/CCCD` varchar(255) COLLATE utf8mb4_vietnamese_ci NOT NULL COMMENT 'CMND/CAN CUOC CONG DAN cua nhan vien do. Truong nay la unique',
  `START_DATE` datetime NOT NULL DEFAULT current_timestamp() COMMENT 'Thời gian nhân viên đó bắt đầu làm việc tại công ty',
  `ROLE` varchar(255) COLLATE utf8mb4_vietnamese_ci NOT NULL DEFAULT 'Employee' COMMENT 'Vai trò của nhân viên đó trong công ty. Mặc định là "Employee". Ngoài ra sẽ còn có "Manager", "CEO", "COO",...',
  `AVATAR_URL` varchar(10000) COLLATE utf8mb4_vietnamese_ci DEFAULT NULL COMMENT 'Chứa link ảnh avatar của nhân viên',
  `END_DATE` datetime DEFAULT NULL COMMENT 'Thời gian nhân viên đó kết thúc làm việc tại công ty. Mặc định là NULL. Thời gian này phải >= START DATE',
  `DOB` date NOT NULL COMMENT 'Chứa ngày tháng năm sinh (Date of Birth) của nhân viên đó'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_vietnamese_ci COMMENT='Bảng này chứa thông tin của nhân viên';

--
-- Dumping data for table `employee`
--

INSERT INTO `employee` (`EMPLOYEE_ID`, `DEPART_ID`, `MANAGER_ID`, `NAME`, `EMAIL`, `PHONE`, `SALARY_RATE`, `TYPE`, `USERNAME`, `PASSWORD`, `TITLE`, `STATUS`, `ADDRESS`, `CMND/CCCD`, `START_DATE`, `ROLE`, `AVATAR_URL`, `END_DATE`, `DOB`) VALUES
(1, 1, 5, 'Mã Vân Tiên', 'mavantien801@gmail.com', '0798234759', '30000000', 'Full-time', 'mavantien', 'cong', 'Accounting Manager', 'Enabled', '21 Xã Thanh Hà, Huyện Thanh Liêm, Hà Nam', '0123456789', '2018-07-01 09:00:00', 'Manager', 'https://images.unsplash.com/photo-1494790108377-be9c29b29330?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=1887&q=80', NULL, '1990-07-04'),
(2, 2, 5, 'Nguyễn Thị Thùy Dương', 'nguyenthithuyduong@gmail.com', '0919007159', '27000000', 'Full-time', 'nguyenthithuyduong', 'cong', 'Head Of International Relations', 'Enabled', '65 Trung Nhi Street, Le Loi Ward', '0299958918', '2017-12-01 09:00:00', 'Manager', 'https://images.unsplash.com/photo-1438761681033-6461ffad8d80?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=870&q=80', NULL, '1981-12-12'),
(3, 3, 5, 'Ân Hải Nam', 'anhainam727@gmail.com', '0901863279', '35000000', 'Full-time', 'anhainam', 'cong', 'Senior HRBP ', 'Enabled', 'Xã Bằng Cốc, Huyện Hàm Yên, Tuyên Quang', '013890451', '2016-07-02 13:42:33', 'Manager', 'https://images.unsplash.com/photo-1570295999919-56ceb5ecca61?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=580&q=80', NULL, '1995-11-25'),
(4, 4, 5, 'Đỗ Khánh Vi', 'dokhanhvi850@gmail.com', '0597623841', '50000000', 'Full-time', 'dokhanhvi', 'cong', 'IT Lead', 'Enabled', '29A Phường Cam Lộc, Thành phố Cam Ranh, Khánh Hòa', '0987654321', '2017-05-31 08:30:00', 'Manager', 'https://images.unsplash.com/photo-1580489944761-15a19d654956?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=461&q=80', NULL, '1981-10-04'),
(5, 5, NULL, 'Phan Thị Nguyên Trang', 'sophiepham2k@gmail.com', '0943807159', '60000000', 'Full-time', 'admin', 'cong', 'Company Chief Executive Officer', 'Enabled', 'Xã Bình Thủy, Huyện Châu Phú, An Giang', '0312458907', '2012-05-01 12:00:00', 'CEO', 'https://images.unsplash.com/photo-1472099645785-5658abf4ff4e?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=870&q=80', NULL, '1975-01-01'),
(6, 4, 4, 'Trần Chí Dũng', 'tamashini2000@gmail.com', '0959107159', '15000000', 'Full-time', 'tranchidung', 'cong', 'Project Manager', 'Enabled', '12B Xã Bình Thủy, Huyện Châu Phú, An Giang', '0387958907', '2019-05-01 12:00:00', 'Manager', 'https://images.unsplash.com/photo-1507591064344-4c6ce005b128?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=870&q=80', NULL, '1989-01-05'),
(7, 4, 6, 'Hoàng Trúc Linh', 'hoangtruclinh@gmail.com', '0989007159', '10000000', 'Part-time', 'hoangtruclinh', 'cong', 'Data Analyst', 'Enabled', '65 Trung Nhi Street, Le Loi Ward', '0387958918', '2022-06-01 09:00:00', 'Employee', 'https://images.unsplash.com/photo-1548142813-c348350df52b?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=389&q=80', NULL, '1999-12-05'),
(8, 4, 6, 'Nguyễn Trung Tín', 'sophiepham2k@gmail.com', '0919127159', '13500000', 'Seasonal', 'nguyentrungtin', 'cong', 'Software Engineer', 'Enabled', '89A Hoang Van Thu Street, CMT8 Ward', '0212458917', '2021-12-30 09:00:00', 'Employee', 'https://images.unsplash.com/photo-1556157382-97eda2d62296?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=870&q=80', NULL, '1999-12-12'),
(9, 4, 6, 'Trần Minh Tiến', 'tranminhtien@gmail.com', '0901890456', '12000000', 'Full-time', 'tranminhtien', 'cong', 'Software Engineer', 'Enabled', '5 Nguyen Binh Khiem Street, Cam Linh Ward', '0123490192', '2022-06-01 17:37:41', 'Employee', 'https://images.unsplash.com/photo-1543132220-3ec99c6094dc?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=387&q=80', NULL, '1997-11-04'),
(10, 3, 3, 'Nguyễn Thị Linh Chi', 'nguyenthilinhchi@gmail.com', '0908789032', '13000000', 'Temporary', 'nguyenthilinhchi', 'cong', 'HRBP Manager Intern', 'Disabled', '227 Nguyễn Văn Cừ P.5 Q.5 TP.HCM', '0981958907', '2021-12-01 10:41:33', 'Employee', 'https://images.unsplash.com/photo-1514315384763-ba401779410f?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=383&q=80', '2022-07-16 10:36:55', '1999-12-30'),
(12, 4, 6, 'Đỗ Ngọc Nga', 'dongocnga@gmail.com', '0346868990', '6000000', 'Full-time', 'dongocnga', 'cong', 'Data Scientist Intern', 'Disabled', '210A CMT8 P.15 Q.Tân Bình TP.HCM', '0290858918', '2021-07-01 10:41:40', 'Employee', 'https://images.unsplash.com/photo-1529626455594-4ff0802cfb7e?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=387&q=80', '2022-07-17 10:41:40', '2001-01-01'),
(13, 4, 6, 'Nguyễn Thị Minh Tú', 'nguyenthiminhtu@gmail.com', '0586484992', '35000000', 'Temporary', 'nguyenthiminhtu', 'cong', 'Software Architecture', 'Enabled', '19A Nguyễn Thị Minh Khai Q.3 TP.HCM', '0931490192', '2020-07-31 10:41:40', 'Employee', 'https://images.unsplash.com/photo-1506794778202-cad84cf45f1d?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=387&q=80', NULL, '1984-09-12'),
(14, 4, 6, 'Satoh Takeru', 'satohtakeru@gmail.com', '0918234744', '40000000', 'Full-time', 'satohtakeru', 'cong', 'Senior Software Engineer', 'Enabled', '123 Nguyễn Văn Cừ P.5 Q.5 TP.HCM', '02001490192', '2020-06-01 10:52:17', 'Employee', 'https://images.unsplash.com/photo-1508341591423-4347099e1f19?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=387&q=80', NULL, '1995-10-26'),
(15, 4, 6, 'Đinh Ngọc Phi Linh', 'dinhngocphilinh@gmail.com', '0957807123', '20500000', 'Seasonal', 'dinhngocphilinh', 'cong', 'Junior Data Scientist', 'Enabled', '289 Cộng Hòa Q.Tân Bình TP.HCM', '02921490192', '2021-07-01 10:56:05', 'Employee', 'https://images.unsplash.com/photo-1563306406-e66174fa3787?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=387&q=80', NULL, '1993-05-04');

-- --------------------------------------------------------

--
-- Table structure for table `leave type history`
--

CREATE TABLE `leave type history` (
  `EMPLOYEE_ID` int(11) NOT NULL COMMENT 'Chứa ID của nhân viên. Tham chiếu từ bảng employee',
  `LEAVE_TYPEID` int(11) NOT NULL COMMENT 'Chứa ID của loại nghỉ phép. Tham chiếu từ bảng Leave Type',
  `USED_DAY` int(11) NOT NULL DEFAULT 0 COMMENT 'Tổng số ngày nghỉ mà nhân viên đó đã sử dụng cho loại nghỉ phép đó',
  `REMAINING_DAY` int(11) NOT NULL DEFAULT 16 COMMENT 'Tổng số ngày nghỉ mà nhân viên còn của loại nghỉ phép đó',
  `COMMENT` varchar(5000) COLLATE utf8mb4_vietnamese_ci NOT NULL COMMENT 'Bình luận của nhân viên',
  `CREATE_DATE` datetime NOT NULL DEFAULT current_timestamp() COMMENT 'Thời gian của một thông tin nghỉ phép tương ứng vs 1 loại nghỉ phép của 1 nhân viên. Cột này được dùng để lọc số ngày nghỉ phép còn lại và đã sử dụng cho từng loại leave type của từng nhân viên theo năm'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_vietnamese_ci;

--
-- Dumping data for table `leave type history`
--

INSERT INTO `leave type history` (`EMPLOYEE_ID`, `LEAVE_TYPEID`, `USED_DAY`, `REMAINING_DAY`, `COMMENT`, `CREATE_DATE`) VALUES
(9, 4, 4, 26, 'Nghỉ vì bị bệnh phải nhập viện', '2022-08-10 09:50:01'),
(14, 1, 2, 14, '', '2022-08-10 09:50:01'),
(14, 3, 1, 7, '', '2022-08-10 09:50:01'),
(14, 4, 1, 29, '', '2022-08-10 09:50:01'),
(15, 2, 2, 4, '', '2022-08-10 09:50:01');

-- --------------------------------------------------------

--
-- Table structure for table `leave_type`
--

CREATE TABLE `leave_type` (
  `LEAVETYPE_ID` int(11) NOT NULL COMMENT 'Chứa ID của loại nghỉ phép',
  `DESCRIPTION` varchar(255) COLLATE utf8mb4_vietnamese_ci NOT NULL COMMENT 'Chứa thông tin về loại nghỉ phép đó',
  `TOTAL_DAY` int(11) NOT NULL DEFAULT 16 COMMENT 'Chứa thông tin về tổng số ngày nghỉ của loại nghỉ phép đó'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_vietnamese_ci COMMENT='Bảng này cho biết thông tin của các loại nghỉ phép';

--
-- Dumping data for table `leave_type`
--

INSERT INTO `leave_type` (`LEAVETYPE_ID`, `DESCRIPTION`, `TOTAL_DAY`) VALUES
(1, 'Annual Leave', 16),
(2, 'Personal Leave', 6),
(3, 'Compensation Leave', 8),
(4, 'Sick Leave (Non-paid)', 30),
(5, 'Non-paid Leave', 30),
(6, 'Maternity Leave (Non-paid)', 60),
(7, 'Engagement Ceremony', 2),
(8, 'Wedding Leave', 3),
(9, 'Relative Funeral Leave', 3);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `categories_subscribe`
--
ALTER TABLE `categories_subscribe`
  ADD PRIMARY KEY (`SUBSCRIBE_ID`),
  ADD KEY `FK_SUBCRIBE_EMPLOYEE` (`EMPLOYEE_ID`);

--
-- Indexes for table `department`
--
ALTER TABLE `department`
  ADD PRIMARY KEY (`DEPART_ID`),
  ADD KEY `FK_Department_Manager` (`MANAGER_ID`);

--
-- Indexes for table `employee`
--
ALTER TABLE `employee`
  ADD PRIMARY KEY (`EMPLOYEE_ID`),
  ADD UNIQUE KEY `username_ind` (`USERNAME`),
  ADD UNIQUE KEY `cmnd_index` (`CMND/CCCD`),
  ADD KEY `FK_Department_Working` (`DEPART_ID`),
  ADD KEY `FK_Manager_Employee` (`MANAGER_ID`);

--
-- Indexes for table `leave type history`
--
ALTER TABLE `leave type history`
  ADD PRIMARY KEY (`EMPLOYEE_ID`,`LEAVE_TYPEID`,`CREATE_DATE`) USING BTREE,
  ADD KEY `FK_Leave_Type_Ref` (`LEAVE_TYPEID`);

--
-- Indexes for table `leave_type`
--
ALTER TABLE `leave_type`
  ADD PRIMARY KEY (`LEAVETYPE_ID`),
  ADD UNIQUE KEY `leave_type_describe` (`DESCRIPTION`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `categories_subscribe`
--
ALTER TABLE `categories_subscribe`
  MODIFY `SUBSCRIBE_ID` int(11) NOT NULL AUTO_INCREMENT COMMENT 'trường này để lưu khóa tự tăng thể hiện mã của việc đăng ký', AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `department`
--
ALTER TABLE `department`
  MODIFY `DEPART_ID` int(11) NOT NULL AUTO_INCREMENT COMMENT 'ID của phòng ban, là trường tự tăng', AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `employee`
--
ALTER TABLE `employee`
  MODIFY `EMPLOYEE_ID` int(11) NOT NULL AUTO_INCREMENT COMMENT 'ID của nhân viên, là trường tự tăng', AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `leave_type`
--
ALTER TABLE `leave_type`
  MODIFY `LEAVETYPE_ID` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Chứa ID của loại nghỉ phép', AUTO_INCREMENT=10;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `categories_subscribe`
--
ALTER TABLE `categories_subscribe`
  ADD CONSTRAINT `FK_SUBCRIBE_EMPLOYEE` FOREIGN KEY (`EMPLOYEE_ID`) REFERENCES `employee` (`EMPLOYEE_ID`);

--
-- Constraints for table `department`
--
ALTER TABLE `department`
  ADD CONSTRAINT `FK_Department_Manager` FOREIGN KEY (`MANAGER_ID`) REFERENCES `employee` (`EMPLOYEE_ID`);

--
-- Constraints for table `employee`
--
ALTER TABLE `employee`
  ADD CONSTRAINT `FK_Department_Working` FOREIGN KEY (`DEPART_ID`) REFERENCES `department` (`DEPART_ID`),
  ADD CONSTRAINT `FK_Manager_Employee` FOREIGN KEY (`MANAGER_ID`) REFERENCES `employee` (`EMPLOYEE_ID`);

--
-- Constraints for table `leave type history`
--
ALTER TABLE `leave type history`
  ADD CONSTRAINT `FK_Leave_Type_Emp` FOREIGN KEY (`EMPLOYEE_ID`) REFERENCES `employee` (`EMPLOYEE_ID`),
  ADD CONSTRAINT `FK_Leave_Type_Ref` FOREIGN KEY (`LEAVE_TYPEID`) REFERENCES `leave_type` (`LEAVETYPE_ID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
