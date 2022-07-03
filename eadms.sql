-- phpMyAdmin SQL Dump
-- version 5.1.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 03, 2022 at 10:51 AM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 8.1.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";

--
-- Database: `eadms`
--
CREATE DATABASE IF NOT EXISTS `eadms` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `eadms`;

-- --------------------------------------------------------

--
-- Table structure for table `details`
--

CREATE TABLE `details` (
  `det_id` int(10) NOT NULL,
  `doc_id` int(10) NOT NULL,
  `det_percent` int(3) NOT NULL,
  `det_date` date NOT NULL,
  `det_note` varchar(2000) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `details`
--

INSERT INTO `details` (`det_id`, `doc_id`, `det_percent`, `det_date`, `det_note`) VALUES
(1, 2, 10, '2021-06-07', 'Checking the file...'),
(6, 8, 4, '2022-06-18', 'test'),
(7, 8, 5, '2022-06-18', 'test update progress bar'),
(8, 8, 6, '2022-06-18', 'another one'),
(9, 8, 7, '2022-06-18', 'anothaa'),
(10, 8, 8, '2022-06-18', 'last'),
(11, 8, 9, '2022-06-18', 'last: electric boogaloo'),
(13, 8, 11, '2022-06-18', 'one last try'),
(14, 8, 12, '2022-06-18', 'im not smart'),
(18, 8, 24, '2022-06-18', 'random update'),
(20, 6, 50, '2022-06-19', 'i am speed'),
(21, 6, 100, '2022-06-19', 'Progress Completed'),
(23, 2, 21, '2022-06-19', 'More checking...'),
(25, 8, 54, '2022-06-19', 'planning to complete progress, to see the details after complete'),
(26, 8, 100, '2022-06-19', 'Progress Completed'),
(27, 2, 22, '2022-06-28', 'Checking'),
(28, 1, 100, '2022-06-28', 'Progress Completed');

-- --------------------------------------------------------

--
-- Table structure for table `document`
--

CREATE TABLE `document` (
  `doc_id` int(11) NOT NULL,
  `staff_id` int(10) NOT NULL,
  `doc_name` varchar(255) NOT NULL,
  `doc_date_received` date NOT NULL,
  `doc_date_accept` date DEFAULT NULL,
  `doc_date_complete` date DEFAULT NULL,
  `doc_file` mediumblob DEFAULT NULL,
  `doc_prog_current` int(3) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `document`
--

INSERT INTO `document` (`doc_id`, `staff_id`, `doc_name`, `doc_date_received`, `doc_date_accept`, `doc_date_complete`, `doc_file`, `doc_prog_current`) VALUES
(1, 23000001, 'CS230 BACHELOR OF COMPUTER SCIENCE (HONS.)', '2021-06-01', '2022-06-19', '2022-06-28', NULL, 100),
(2, 23000001, 'CS240 BACHELOR OF INFORMATION TECHNOLOGY (HONS.)', '2021-06-01', '2021-06-02', NULL, NULL, 22),
(4, 23000001, 'delet this', '2022-06-01', NULL, NULL, NULL, NULL),
(5, 23000001, 'delet this: electric boogaloo', '2022-06-01', NULL, NULL, NULL, NULL),
(6, 23000001, 'accept this', '2022-06-01', '2022-06-19', '2022-06-19', NULL, 100),
(7, 23000001, 'accept this: electric boogaloo', '2022-06-01', NULL, NULL, NULL, NULL),
(8, 23000001, 'update this after accept', '2022-06-01', '2022-06-15', '2022-06-19', NULL, 100),
(9, 23000001, 'CS241 BACHELOR OF SCIENCE (HONS.) STATISTICS', '2022-06-17', '2022-06-28', NULL, NULL, 0),
(10, 23000001, 'CS242 BACHELOR OF SCIENCE (HONS.) ACTUARIAL SCIENCE', '2022-07-01', NULL, NULL, NULL, NULL),
(11, 23000001, 'CS248 BACHELOR OF SCIENCE (HONS.) MANAGEMENT MATHEMATICS', '2022-07-02', NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `staff`
--

CREATE TABLE `staff` (
  `staff_id` int(10) NOT NULL,
  `staff_name` varchar(55) NOT NULL,
  `staff_pass` varchar(24) NOT NULL,
  `staff_fac` varchar(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `staff`
--

INSERT INTO `staff` (`staff_id`, `staff_name`, `staff_pass`, `staff_fac`) VALUES
(20100001, 'AdminAS', 'adminas', 'AS'),
(23000001, 'AdminCS', 'admincs', 'CS');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `details`
--
ALTER TABLE `details`
  ADD PRIMARY KEY (`det_id`),
  ADD KEY `details_ibfk_1` (`doc_id`);

--
-- Indexes for table `document`
--
ALTER TABLE `document`
  ADD PRIMARY KEY (`doc_id`),
  ADD KEY `staff_id` (`staff_id`);

--
-- Indexes for table `staff`
--
ALTER TABLE `staff`
  ADD PRIMARY KEY (`staff_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `details`
--
ALTER TABLE `details`
  MODIFY `det_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT for table `document`
--
ALTER TABLE `document`
  MODIFY `doc_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `details`
--
ALTER TABLE `details`
  ADD CONSTRAINT `details_ibfk_1` FOREIGN KEY (`doc_id`) REFERENCES `document` (`doc_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `document`
--
ALTER TABLE `document`
  ADD CONSTRAINT `document_ibfk_1` FOREIGN KEY (`staff_id`) REFERENCES `staff` (`staff_id`) ON UPDATE CASCADE;
COMMIT;
