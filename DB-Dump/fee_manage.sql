-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 11, 2023 at 12:14 PM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `fee_manage`
--

-- --------------------------------------------------------

--
-- Table structure for table `bus_fee`
--

CREATE TABLE `bus_fee` (
  `id` int(11) NOT NULL,
  `regno` int(11) NOT NULL,
  `sname` varchar(35) NOT NULL,
  `gender` varchar(10) NOT NULL,
  `commty` varchar(40) NOT NULL,
  `bcode` int(11) NOT NULL,
  `bname` varchar(20) NOT NULL,
  `sem` int(11) NOT NULL,
  `month` varchar(40) NOT NULL,
  `year` varchar(40) NOT NULL,
  `bus_no` int(11) NOT NULL,
  `stop_place` varchar(30) NOT NULL,
  `fee` int(11) NOT NULL,
  `fee_bal` int(11) NOT NULL,
  `fee_paid` int(11) NOT NULL,
  `transaction_id` text NOT NULL,
  `paid_date` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `bus_fee`
--

INSERT INTO `bus_fee` (`id`, `regno`, `sname`, `gender`, `commty`, `bcode`, `bname`, `sem`, `month`, `year`, `bus_no`, `stop_place`, `fee`, `fee_bal`, `fee_paid`, `transaction_id`, `paid_date`) VALUES
(1, 12503957, 'Haridasan', 'Male', 'MBC', 1052, 'CSE', 1, '6', '2023', 10, 'Anguchettypalayam', 500, 500, 0, '', 0),
(3, 12503957, 'Haridasan', 'Male', 'MBC', 1052, 'CSE', 2, '6', '2023', 10, 'Anguchettypalayam', 500, 0, 500, 'cs_test_a12d2LYVmP11E5hNw8ypgEw4UltmraalZOMkRw3Rw0B3rGqtx78s3f6Kcs', 1681201216);

-- --------------------------------------------------------

--
-- Table structure for table `college_fee`
--

CREATE TABLE `college_fee` (
  `id` int(11) NOT NULL,
  `regno` int(11) NOT NULL,
  `sname` varchar(30) NOT NULL,
  `bcode` int(11) NOT NULL,
  `bname` varchar(35) NOT NULL,
  `sem` varchar(35) NOT NULL,
  `month` varchar(40) NOT NULL,
  `year` varchar(40) NOT NULL,
  `fee` int(11) NOT NULL,
  `fee_paid` int(11) NOT NULL,
  `transaction_id` text NOT NULL,
  `paid_date` int(11) NOT NULL,
  `fee_bal` int(11) NOT NULL,
  `scheme` varchar(30) NOT NULL,
  `gender` varchar(30) NOT NULL,
  `commty` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `college_fee`
--

INSERT INTO `college_fee` (`id`, `regno`, `sname`, `bcode`, `bname`, `sem`, `month`, `year`, `fee`, `fee_paid`, `transaction_id`, `paid_date`, `fee_bal`, `scheme`, `gender`, `commty`) VALUES
(1, 12503957, 'Haridasan', 1052, 'CSE', '1', '06', '2023', 15000, 0, '', 0, 15000, 'L', 'Male', 'MBC'),
(3, 12503957, 'Haridasan', 1052, 'CSE', '2', '', '', 15000, 0, '', 0, 15000, 'L', 'Male', 'MBC'),
(6, 12503957, 'Haridasan', 1052, 'CSE', '3', '', '', 15000, 0, '', 0, 15000, 'L', 'Male', 'MBC'),
(8, 12503957, 'Haridasan', 1052, 'CSE', '4', '', '', 10000, 0, '', 0, 10000, 'L', 'Male', 'MBC'),
(18, 12503957, 'Haridasan', 1052, 'CSE', '6', '', '', 15000, 0, '', 0, 15000, 'L', 'Male', 'MBC'),
(20, 12503957, 'Haridasan', 1052, 'CSE', '5', '05', '2023', 20000, 10000, 'cs_test_a1veJ5tqbn7QPw4UPA9zKDGbuFl2Wj4xskZ479n403iSNqk7UOGReGDb4A', 1681203709, 10000, 'L', 'Male', 'MBC');

-- --------------------------------------------------------

--
-- Table structure for table `exam_fee`
--

CREATE TABLE `exam_fee` (
  `id` int(11) NOT NULL,
  `regno` int(11) NOT NULL,
  `sname` varchar(30) NOT NULL,
  `gender` varchar(30) NOT NULL,
  `commty` varchar(30) NOT NULL,
  `bcode` int(11) NOT NULL,
  `bname` varchar(30) NOT NULL,
  `sem` varchar(30) NOT NULL,
  `month` int(11) NOT NULL,
  `year` int(11) NOT NULL,
  `fee` int(11) NOT NULL,
  `fee_paid` int(11) NOT NULL,
  `fee_bal` int(11) NOT NULL,
  `transaction_id` text NOT NULL,
  `paid_date` int(11) NOT NULL,
  `scheme` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `exam_fee`
--

INSERT INTO `exam_fee` (`id`, `regno`, `sname`, `gender`, `commty`, `bcode`, `bname`, `sem`, `month`, `year`, `fee`, `fee_paid`, `fee_bal`, `transaction_id`, `paid_date`, `scheme`) VALUES
(1, 12503957, 'Haridasan', 'Male', 'MBC', 1052, 'CSE', '1', 7, 2023, 1500, 0, 1500, '', 0, 'L'),
(4, 12503957, 'Haridasan', 'Male', 'MBC', 1052, 'CSE', '2', 8, 2023, 9000, 0, 9000, '', 0, 'L'),
(5, 12503957, 'Haridasan', 'Male', 'MBC', 1052, 'CSE', '3', 11, 2024, 1000, 1000, 0, 'cs_test_a1v7PSZthnv8QdGHNwES504Yyemn22NRnOK4cJPoRLs6Pw4fSG66I6NhYm', 1681203648, 'L');

-- --------------------------------------------------------

--
-- Table structure for table `hostel_fee`
--

CREATE TABLE `hostel_fee` (
  `id` int(11) NOT NULL,
  `regno` int(11) NOT NULL,
  `sname` varchar(30) NOT NULL,
  `gender` varchar(30) NOT NULL,
  `dob` date NOT NULL,
  `commty` varchar(20) NOT NULL,
  `bcode` int(11) NOT NULL,
  `bname` varchar(30) NOT NULL,
  `sem` int(11) NOT NULL,
  `month` varchar(40) NOT NULL,
  `year` varchar(4) NOT NULL,
  `room_no` int(11) NOT NULL,
  `staff_name` varchar(30) NOT NULL,
  `sphone_no` int(11) NOT NULL,
  `mail_id` varchar(30) NOT NULL,
  `adress` text NOT NULL,
  `fee` int(11) NOT NULL,
  `fee_bal` int(11) NOT NULL,
  `fee_paid` int(11) NOT NULL,
  `transaction_id` text NOT NULL,
  `paid_date` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `hostel_fee`
--

INSERT INTO `hostel_fee` (`id`, `regno`, `sname`, `gender`, `dob`, `commty`, `bcode`, `bname`, `sem`, `month`, `year`, `room_no`, `staff_name`, `sphone_no`, `mail_id`, `adress`, `fee`, `fee_bal`, `fee_paid`, `transaction_id`, `paid_date`) VALUES
(3, 12503957, 'Haridasan', 'Male', '1994-02-05', 'MBC', 1052, 'CSE', 1, '6', '2023', 7, 'Muthu', 2147483647, 'hdasshp@gmail.com', '117, Iyyanar Kovil St', 5000, 5000, 0, '', 0),
(4, 12503957, 'Haridasan', 'Male', '1994-02-05', 'MBC', 1052, 'CSE', 2, '6', '2023', 7, 'Muthu', 2147483647, 'hdasshp@gmail.com', '117, Iyyanar Kovil St', 5000, 0, 5000, 'cs_test_a1rYKoYlYyRzkTPNHepKFfE3QhaAv1Gd4yKLYgULIP1IN5MN7vqy8bGb6Z', 1681201853);

-- --------------------------------------------------------

--
-- Table structure for table `login`
--

CREATE TABLE `login` (
  `id` int(11) NOT NULL,
  `username` text NOT NULL,
  `password` text NOT NULL,
  `type` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `login`
--

INSERT INTO `login` (`id`, `username`, `password`, `type`) VALUES
(1, 'admin', '25f9e794323b453885f5181f1b624d0b', 'admin'),
(2, '12503957', '25d55ad283aa400af464c76d713c07ad', 'student'),
(3, 'haridas@gmail.com', '25d55ad283aa400af464c76d713c07ad', 'student');

-- --------------------------------------------------------

--
-- Table structure for table `other_fee`
--

CREATE TABLE `other_fee` (
  `regno` int(11) NOT NULL,
  `sname` varchar(30) NOT NULL,
  `gender` varchar(10) NOT NULL,
  `commty` varchar(15) NOT NULL,
  `bcode` int(11) NOT NULL,
  `bname` varchar(30) NOT NULL,
  `sem` int(11) NOT NULL,
  `fee1` int(11) NOT NULL,
  `fee2` int(11) NOT NULL,
  `fee3` int(11) NOT NULL,
  `fee4` int(11) NOT NULL,
  `fee5` int(11) NOT NULL,
  `fee6` int(11) NOT NULL,
  `fee7` int(11) NOT NULL,
  `total_fee` int(11) NOT NULL,
  `paid_date` date NOT NULL,
  `fee_bal` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `student_details`
--

CREATE TABLE `student_details` (
  `regno` int(11) NOT NULL,
  `sname` varchar(35) NOT NULL,
  `gender` varchar(10) NOT NULL,
  `dob` date NOT NULL,
  `bcode` int(11) NOT NULL,
  `bname` varchar(30) NOT NULL,
  `address` text NOT NULL,
  `sphone_no` varchar(11) NOT NULL,
  `commty` varchar(15) NOT NULL,
  `join_aca_year` varchar(40) NOT NULL,
  `admi_type` varchar(20) NOT NULL,
  `mail_id` text NOT NULL,
  `days_scholar` varchar(20) NOT NULL,
  `hostel_scholar` varchar(20) NOT NULL,
  `bus_travel` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `student_details`
--

INSERT INTO `student_details` (`regno`, `sname`, `gender`, `dob`, `bcode`, `bname`, `address`, `sphone_no`, `commty`, `join_aca_year`, `admi_type`, `mail_id`, `days_scholar`, `hostel_scholar`, `bus_travel`) VALUES
(12503957, 'Haridasan', 'Male', '1994-02-05', 1052, 'CSE', '117, Iyyanar Kovil St', '7502013113', 'MBC', '2011-12', 'First Year', 'hdasshp@gmail.com', '1', '0', '1');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `bus_fee`
--
ALTER TABLE `bus_fee`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `regno` (`regno`,`bcode`,`sem`);

--
-- Indexes for table `college_fee`
--
ALTER TABLE `college_fee`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `regno` (`regno`,`bcode`,`sem`);

--
-- Indexes for table `exam_fee`
--
ALTER TABLE `exam_fee`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `regno` (`regno`,`bcode`,`sem`);

--
-- Indexes for table `hostel_fee`
--
ALTER TABLE `hostel_fee`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `regno` (`regno`,`bcode`,`sem`);

--
-- Indexes for table `login`
--
ALTER TABLE `login`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `student_details`
--
ALTER TABLE `student_details`
  ADD UNIQUE KEY `regno` (`regno`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `bus_fee`
--
ALTER TABLE `bus_fee`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `college_fee`
--
ALTER TABLE `college_fee`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `exam_fee`
--
ALTER TABLE `exam_fee`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `hostel_fee`
--
ALTER TABLE `hostel_fee`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `login`
--
ALTER TABLE `login`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
