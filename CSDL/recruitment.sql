-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 18, 2022 at 03:00 PM
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
-- Database: `recruitment`
--

-- --------------------------------------------------------

--
-- Table structure for table `cv`
--

CREATE TABLE `cv` (
  `CV_ID` int(11) NOT NULL,
  `MANAGER_ID` int(11) NOT NULL,
  `EMPLOYEE_ID` int(11) DEFAULT NULL COMMENT 'tham chiếu đến bảng nhân viên',
  `NAME` varchar(50) COLLATE utf8mb4_vietnamese_ci NOT NULL,
  `EMAIL` varchar(120) COLLATE utf8mb4_vietnamese_ci NOT NULL,
  `URL` varchar(2048) COLLATE utf8mb4_vietnamese_ci NOT NULL COMMENT 'địa chỉ file chức CV',
  `ACADEMIC_TRANSCRIPT_URL` varchar(2048) COLLATE utf8mb4_vietnamese_ci DEFAULT NULL COMMENT 'địa chỉ file chứa bảng điểm, có thể null',
  `JOB_TITLE` varchar(100) COLLATE utf8mb4_vietnamese_ci NOT NULL,
  `COMMENT` varchar(500) COLLATE utf8mb4_vietnamese_ci DEFAULT NULL COMMENT 'ghi chú của nhân viên tuyển dụng với ứng viên',
  `DATE_OF_APPLICATION` datetime NOT NULL,
  `STATUS` varchar(50) COLLATE utf8mb4_vietnamese_ci NOT NULL COMMENT 'tình trạng cv: pending, screening, interviewing, approved, archived'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_vietnamese_ci;

--
-- Dumping data for table `cv`
--

INSERT INTO `cv` (`CV_ID`, `MANAGER_ID`, `EMPLOYEE_ID`, `NAME`, `EMAIL`, `URL`, `ACADEMIC_TRANSCRIPT_URL`, `JOB_TITLE`, `COMMENT`, `DATE_OF_APPLICATION`, `STATUS`) VALUES
(1, 3, NULL, 'Trần Kiến Huy', 'tkhuy@gmail.com', 'https://CV/CV/tkhuy.pdf', 'https://CV/AcademicTranscript/tkhuy.pdf', 'Data Engineer', NULL, '2022-06-25 00:00:00', 'Pending'),
(2, 3, NULL, 'Trần Khang', 'tkhang@gmail.com', 'https://CV/CV/tkhang.pdf', 'https://CV/AcademicTranscript/tkhang.pdf', 'Data Engineer', NULL, '2022-06-26 00:00:00', 'Pending'),
(3, 3, NULL, 'Võ Kiến Tâm', 'vktam@gmail.com', 'https://CV/CV/vktam.pdf', 'https://CV/AcademicTranscript/vktam.pdf', 'Quality Control', NULL, '2022-05-25 00:00:00', 'Screening'),
(4, 3, NULL, 'Phan Văn Thịnh', 'pvthinh@gmail.com', 'https://CV/CV/pvthinh.pdf', NULL, 'Senior Software Engineer', NULL, '2022-04-25 00:00:00', 'Pending'),
(5, 3, NULL, 'Trần Kiến Huy Hoàng', 'tkhhoang@gmail.com', 'https://CV/CV/tkhhoang.pdf', 'https://CV/AcademicTranscript/tkhhoang.pdf', 'Data Engineer', NULL, '2022-06-25 00:00:00', 'Pending');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cv`
--
ALTER TABLE `cv`
  ADD PRIMARY KEY (`CV_ID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `cv`
--
ALTER TABLE `cv`
  MODIFY `CV_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
