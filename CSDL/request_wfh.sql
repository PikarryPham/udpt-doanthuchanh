-- phpMyAdmin SQL Dump
-- version 4.9.7
-- https://www.phpmyadmin.net/
--
-- Máy chủ: localhost:8889
-- Thời gian đã tạo: Th8 18, 2022 lúc 04:25 PM
-- Phiên bản máy phục vụ: 5.7.34
-- Phiên bản PHP: 8.0.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- Cơ sở dữ liệu: `main_service`
--

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `request wfh`
--

CREATE TABLE `request wfh` (
  `RWFH_ID` int(11) NOT NULL COMMENT 'Mã của 1 request wfh, là trường tự tăng',
  `EMPLOYEE_ID` int(11) NOT NULL COMMENT 'Chứa ID của nhân viên tạo ra request WFH',
  `MANAGER_ID` int(11) NOT NULL COMMENT 'Chứa ID của nhân viên quản lý cấp 1 của nhân viên tạo ra request',
  `REASON` varchar(5000) COLLATE utf8mb4_vietnamese_ci NOT NULL COMMENT 'Lý do nhân viên muốn làm việc WFH',
  `CREATE_DATE` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT 'Thời gian tạo request WFH',
  `UPDATE_DATE` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT 'Thời gian cập nhật thông tin của request WFH gần nhất. Mặc định là 1970-01-01 00:00:00, khi được cập nhật lại, thời gian này phải >= CREATE_DATE',
  `STATUS` varchar(255) COLLATE utf8mb4_vietnamese_ci NOT NULL DEFAULT 'Draft' COMMENT 'Trạng thái xử lý của request WFH. Gồm 1 trong 5 trạng thái: Draft, Pending, Approved, Rejected, Cancelled. Được điền tự động bởi hệ thống, nhân viên không thể sửa.',
  `MANAGER_COMMENT` varchar(5000) COLLATE utf8mb4_vietnamese_ci DEFAULT 'None' COMMENT 'Ghi lí do quản lý cấp 1 từ chối request WFH. Nếu trường này có thông tin, trạng thái của request phải là "Rejected", mặc định là None',
  `FROM_DATE` date NOT NULL DEFAULT '1970-01-01' COMMENT 'Ngày bắt đầu dự kiến làm việc WFH',
  `TO_DATE` date NOT NULL DEFAULT '1970-01-01' COMMENT 'Ngày kết thúc dự kiến làm việc WFH. Mặc định có giá trị là 1970-01-01, khi được cập nhật lại, thời gian này phải >= Ngày bắt đầu WFH',
  `UNSUBMIT_REASON` varchar(5000) COLLATE utf8mb4_vietnamese_ci DEFAULT 'None' COMMENT 'Lý do nhân viên muốn hủy gửi (unsubmit) request OT. Nếu trường này có thông tin, trạng thái của request bắt buộc là Cancelled, mặc định là None',
  `NOTIFICATION_FLAG` tinyint(4) NOT NULL DEFAULT '0' COMMENT 'Nhân viên khi tạo request OT chọn "Yes" hay "No" cho mục "Email follow up". 0 là No, 1 là Yes'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_vietnamese_ci COMMENT='Bảng này cho biết thông tin của 1 request WFH';

--
-- Đang đổ dữ liệu cho bảng `request wfh`
--

INSERT INTO `request wfh` (`RWFH_ID`, `EMPLOYEE_ID`, `MANAGER_ID`, `REASON`, `CREATE_DATE`, `UPDATE_DATE`, `STATUS`, `MANAGER_COMMENT`, `FROM_DATE`, `TO_DATE`, `UNSUBMIT_REASON`, `NOTIFICATION_FLAG`) VALUES
(2, 2, 3, 'WFH because Covid Pandemic', '2022-08-17 08:38:44', '2022-08-17 08:38:44', 'Draft', 'None', '2020-01-04', '2020-01-13', 'None', 0),
(3, 1, 2, 'WFH because Covid Pandemic', '2022-08-17 08:41:32', '2022-08-17 08:41:32', 'Draft', 'None', '2020-01-01', '2020-01-03', 'None', 0),
(4, 1, 1, 'Has sick family member to take care of', '2022-08-17 08:41:32', '2022-08-17 08:41:32', 'Draft', 'None', '2020-01-03', '2020-01-09', 'None', 0),
(50, 3, 4, 'Go to hospital because crash accident', '2022-08-17 09:17:28', '2022-08-17 09:17:28', 'Draft', '', '2020-07-21', '2020-07-23', '', 1),
(51, 2, 2, 'Go to hospital because crash accident', '2022-08-17 09:19:08', '2022-08-17 09:19:08', 'Draft', '', '2020-07-21', '2020-07-23', '', 1),
(52, 1, 2, 'Covid Pandemic', '2022-08-18 15:48:04', '2022-08-18 15:48:04', 'Draft', '', '2020-08-21', '2020-08-23', '', 1),
(53, 1, 2, 'Covid Pandemic', '2022-08-18 15:48:19', '2022-08-18 15:48:19', 'Draft', '', '2020-08-24', '2020-08-30', '', 1),
(54, 1, 2, 'Covid Pandemic', '2022-08-18 15:48:34', '2022-08-18 15:48:34', 'Draft', '', '2020-09-02', '2020-09-03', '', 1),
(55, 1, 2, 'Covid Pandemic', '2022-08-18 15:48:42', '2022-08-18 15:48:42', 'Draft', '', '2020-10-02', '2020-10-03', '', 1),
(56, 1, 2, 'Covid Pandemic', '2022-08-18 15:48:53', '2022-08-18 15:48:53', 'Draft', '', '2020-10-23', '2020-10-24', '', 1);

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `request wfh`
--
ALTER TABLE `request wfh`
  ADD PRIMARY KEY (`RWFH_ID`),
  ADD KEY `FK_EmployeeCreate` (`EMPLOYEE_ID`),
  ADD KEY `FK_Appraiser_Manage` (`MANAGER_ID`);

--
-- AUTO_INCREMENT cho các bảng đã đổ
--

--
-- AUTO_INCREMENT cho bảng `request wfh`
--
ALTER TABLE `request wfh`
  MODIFY `RWFH_ID` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Mã của 1 request wfh, là trường tự tăng', AUTO_INCREMENT=57;

-- phpMyAdmin SQL Dump
-- version 4.9.7
-- https://www.phpmyadmin.net/
--
-- Máy chủ: localhost:8889
-- Thời gian đã tạo: Th8 18, 2022 lúc 04:27 PM
-- Phiên bản máy phục vụ: 5.7.34
-- Phiên bản PHP: 8.0.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- Cơ sở dữ liệu: `main_service`
--

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `request wfh detail`
--

CREATE TABLE `request wfh detail` (
  `RWFHDETAIL_ID` int(11) NOT NULL COMMENT 'ID của một chi tiết requestWFH. Một request WFH có thể có nhiều thông tin chi tiết',
  `RWFH_ID` int(11) NOT NULL COMMENT 'ID của request WFH mà chi tiết request WFH thuộc về. Tham chiếu từ bảng request WFH',
  `DATE` date NOT NULL DEFAULT '1970-01-01' COMMENT 'Ngày nhân viên làm việc WFH'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_vietnamese_ci COMMENT='Bảng này cho biết thông tin của một CHI TIẾT request wfh';

--
-- Đang đổ dữ liệu cho bảng `request wfh detail`
--

INSERT INTO `request wfh detail` (`RWFHDETAIL_ID`, `RWFH_ID`, `DATE`) VALUES
(439, 51, '2020-07-21'),
(440, 51, '2020-07-22'),
(441, 51, '2020-07-23'),
(442, 51, '2020-01-05'),
(443, 4, '2020-01-03'),
(444, 4, '2020-01-04'),
(445, 4, '2020-01-05'),
(446, 4, '2020-01-06'),
(447, 4, '2020-01-07'),
(448, 4, '2020-01-08');

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `request wfh detail`
--
ALTER TABLE `request wfh detail`
  ADD PRIMARY KEY (`RWFHDETAIL_ID`,`RWFH_ID`),
  ADD KEY `FK_WFHReq_Related` (`RWFH_ID`);

--
-- AUTO_INCREMENT cho các bảng đã đổ
--

--
-- AUTO_INCREMENT cho bảng `request wfh detail`
--
ALTER TABLE `request wfh detail`
  MODIFY `RWFHDETAIL_ID` int(11) NOT NULL AUTO_INCREMENT COMMENT 'ID của một chi tiết requestWFH. Một request WFH có thể có nhiều thông tin chi tiết', AUTO_INCREMENT=449;

--
-- Các ràng buộc cho các bảng đã đổ
--

--
-- Các ràng buộc cho bảng `request wfh detail`
--
ALTER TABLE `request wfh detail`
  ADD CONSTRAINT `FK_WFHReq_Related` FOREIGN KEY (`RWFH_ID`) REFERENCES `request wfh` (`RWFH_ID`);
