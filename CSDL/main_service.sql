-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 30, 2022 at 03:45 PM
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
(6, 4, 4, 'Trần Chí Dũng', 'tranchidung@gmail.com', '0959107159', '15000000', 'Full-time', 'tranchidung', 'cong', 'Project Manager', 'Enabled', '12B Xã Bình Thủy, Huyện Châu Phú, An Giang', '0387958907', '2019-05-01 12:00:00', 'Manager', 'https://images.unsplash.com/photo-1507591064344-4c6ce005b128?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=870&q=80', NULL, '1989-01-05'),
(7, 4, 6, 'Hoàng Trúc Linh', 'hoangtruclinh@gmail.com', '0989007159', '10000000', 'Part-time', 'hoangtruclinh', 'cong', 'Data Analyst', 'Enabled', '65 Trung Nhi Street, Le Loi Ward', '0387958918', '2022-06-01 09:00:00', 'Employee', 'https://images.unsplash.com/photo-1548142813-c348350df52b?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=389&q=80', NULL, '1999-12-05'),
(8, 4, 6, 'Nguyễn Trung Tín', 'nguyentrungtin@gmail.com', '0919127159', '13500000', 'Seasonal', 'nguyentrungtin', 'cong', 'Software Engineer', 'Enabled', '89A Hoang Van Thu Street, CMT8 Ward', '0212458917', '2021-12-30 09:00:00', 'Employee', 'https://images.unsplash.com/photo-1556157382-97eda2d62296?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=870&q=80', NULL, '1999-12-12'),
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
  `COMMENT` varchar(5000) COLLATE utf8mb4_vietnamese_ci NOT NULL COMMENT 'Bình luận của nhân viên'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_vietnamese_ci;

--
-- Dumping data for table `leave type history`
--

INSERT INTO `leave type history` (`EMPLOYEE_ID`, `LEAVE_TYPEID`, `USED_DAY`, `REMAINING_DAY`, `COMMENT`) VALUES
(9, 4, 4, 26, 'Nghỉ vì bị bệnh phải nhập viện'),
(14, 1, 2, 14, ''),
(14, 3, 1, 7, ''),
(14, 4, 1, 29, ''),
(15, 2, 2, 4, '');

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
-- Table structure for table `request ot`
--

CREATE TABLE `request ot` (
  `ROT_ID` int(11) NOT NULL COMMENT 'Mã của 1 request OT, là trường tự tăng',
  `EMPLOYEE_ID` int(11) NOT NULL COMMENT 'Chứa ID của nhân viên tạo ra request OT',
  `MANAGER_ID` int(11) NOT NULL COMMENT 'Chứa ID của nhân viên quản lý cấp 1 của nhân viên tạo ra request',
  `REASON` varchar(5000) COLLATE utf8mb4_vietnamese_ci NOT NULL COMMENT 'Lý do nhân viên muốn làm việc OT',
  `CREATE_DATE` datetime NOT NULL DEFAULT current_timestamp() COMMENT 'Thời gian tạo request OT',
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
(2, 15, 6, 'Làm không kịp nên tăng ca để kịp tiến độ dự án mới', '2022-07-17 12:08:03', '2022-07-18 12:08:03', 'Approved', 'None', '2022-07-16', '4', '2022-07-16', 'None', 1),
(3, 14, 6, 'Anh có việc gia đình cần nghỉ 1 tuần nên anh cần tăng ca để làm bù để kịp tiến độ dự án.', '2022-07-15 12:12:35', '2022-07-15 13:12:35', 'Approved', 'None', '2022-08-01', '6', '2022-08-03', 'None', 1),
(4, 8, 6, 'Dự án Alola cần bàn giao cho khách hàng gấp vào cuối tháng 8 nên em cần OT để kịp tiến độ', '2022-07-17 12:14:54', '2025-07-22 02:21:13', 'Pending', '', '2022-07-25', '12', '2022-07-25', '', 1),
(5, 8, 6, 'Em xin OT để tuần sau em nghỉ đi chơi với người yêu', '2022-07-16 12:14:54', '2022-07-17 15:25:54', 'Cancelled', 'None', '2022-08-15', '4', '2022-08-18', 'Lí do em ghi còn chưa thật sự hợp lí, em xin được thu hồi request để gửi lại request mới', 0),
(12, 15, 6, 'demo thử lần 2', '1970-01-01 00:00:00', '2025-07-22 10:17:49', 'Pending', '', '2022-07-25', '8', '2022-07-27', '', 1),
(13, 15, 6, 'demo lan 4', '2022-07-25 18:02:19', '2025-07-22 11:02:19', 'Draft', '', '2022-07-25', '0', '2022-07-25', '', 0),
(14, 15, 6, 'demo ', '2022-07-25 20:48:25', '2025-07-22 01:48:25', 'Pending', '', '2022-07-25', '0', '2022-07-25', '', 0),
(17, 8, 6, 'TMuốn nhiều tiền', '2022-07-25 20:55:39', '2027-07-22 05:21:17', 'Canceled', '', '2022-07-27', '7', '2022-07-27', 'Không muốn làm nữa', 1);

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
  ADD PRIMARY KEY (`EMPLOYEE_ID`,`LEAVE_TYPEID`),
  ADD KEY `FK_Leave_Type_Ref` (`LEAVE_TYPEID`);

--
-- Indexes for table `leave_type`
--
ALTER TABLE `leave_type`
  ADD PRIMARY KEY (`LEAVETYPE_ID`),
  ADD UNIQUE KEY `leave_type_describe` (`DESCRIPTION`);

--
-- Indexes for table `pa_goal`
--
ALTER TABLE `pa_goal`
  ADD PRIMARY KEY (`PAGOAL_ID`),
  ADD KEY `FK_Employee_Create` (`EMPLOYEECREATE_ID`),
  ADD KEY `FK_Employee_Manager` (`MANAGER_ID`);

--
-- Indexes for table `request ot`
--
ALTER TABLE `request ot`
  ADD PRIMARY KEY (`ROT_ID`),
  ADD KEY `FK_EmployeeCreate` (`EMPLOYEE_ID`),
  ADD KEY `FK_Appraiser_Manage` (`MANAGER_ID`);

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
-- AUTO_INCREMENT for table `pa_goal`
--
ALTER TABLE `pa_goal`
  MODIFY `PAGOAL_ID` int(11) NOT NULL AUTO_INCREMENT COMMENT 'ID của một PA form. Mỗi PA Form sẽ có nhiều thông tin mục tiêu ', AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `request ot`
--
ALTER TABLE `request ot`
  MODIFY `ROT_ID` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Mã của 1 request OT, là trường tự tăng', AUTO_INCREMENT=28;

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
