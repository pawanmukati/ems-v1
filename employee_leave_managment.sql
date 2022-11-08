-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 07, 2022 at 02:31 PM
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
-- Database: `employee_leave_managment`
--

-- --------------------------------------------------------

--
-- Table structure for table `employee`
--

CREATE TABLE `employee` (
  `id` int(10) NOT NULL,
  `username` varchar(255) DEFAULT NULL,
  `email` varchar(255) NOT NULL,
  `mobile` varchar(15) NOT NULL,
  `password` varchar(255) NOT NULL,
  `department_id` int(20) NOT NULL,
  `address` varchar(2000) NOT NULL,
  `birthday` date NOT NULL,
  `role` int(11) NOT NULL,
  `employee_id` int(11) NOT NULL,
  `user_role` varchar(255) DEFAULT NULL,
  `doj` date DEFAULT NULL,
  `term_condition` varchar(255) DEFAULT NULL,
  `bank_name` varchar(255) DEFAULT NULL,
  `holder_name` varchar(255) DEFAULT NULL,
  `ifsc_code` varchar(255) DEFAULT NULL,
  `account_number` varchar(255) DEFAULT NULL,
  `basic_salary` varchar(15) DEFAULT NULL,
  `hra` varchar(15) DEFAULT NULL,
  `pt` varchar(15) DEFAULT NULL,
  `oa` varchar(15) DEFAULT NULL,
  `pic` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `employee`
--

INSERT INTO `employee` (`id`, `username`, `email`, `mobile`, `password`, `department_id`, `address`, `birthday`, `role`, `employee_id`, `user_role`, `doj`, `term_condition`, `bank_name`, `holder_name`, `ifsc_code`, `account_number`, `basic_salary`, `hra`, `pt`, `oa`, `pic`) VALUES
(1000031, 'Janobe Martins', 'janobe@janobe.com', '123456789', 'janobe3', 0, 'indore', '1999-12-20', 2, 411, 'employee', '2020-08-24', 'Lorem ipsum, dolor sit amet consectetur adipisicing elit. Ipsa, in!', 'axis bank of india', 'Janobe Martins', 'ifsc0001234', '1236547890', '50,000', '250', '150', '200', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `employee_payroll_data`
--

CREATE TABLE `employee_payroll_data` (
  `id` int(10) NOT NULL,
  `empid` varchar(6) NOT NULL,
  `months` varchar(255) NOT NULL,
  `total_working_days` int(255) NOT NULL,
  `present_days` int(255) NOT NULL,
  `leaves` int(255) NOT NULL,
  `total_hrs` int(255) NOT NULL,
  `paid_leaves` int(255) NOT NULL,
  `adjusments` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `employee_payroll_data`
--

INSERT INTO `employee_payroll_data` (`id`, `empid`, `months`, `total_working_days`, `present_days`, `leaves`, `total_hrs`, `paid_leaves`, `adjusments`) VALUES
(42, '411', 'Nov-22', 25, 24, 1, 180, 1, '0'),
(43, '412', 'Nov-22', 25, 23, 2, 175, 1, '150'),
(44, '413', 'Nov-22', 25, 22, 3, 172, 1, '300'),
(45, '414', 'Nov-22', 25, 24, 2, 174, 1, '150'),
(46, '415', 'Nov-22', 25, 23, 1, 178, 1, '0'),
(47, '416', 'Nov-22', 25, 22, 2, 180, 1, '150'),
(48, '417', 'Nov-22', 25, 24, 3, 175, 1, '300'),
(49, '418', 'Nov-22', 25, 23, 2, 172, 1, '150'),
(50, '419', 'Nov-22', 25, 22, 1, 174, 1, '0'),
(51, '420', 'Nov-22', 25, 24, 3, 178, 1, '300');

-- --------------------------------------------------------

--
-- Table structure for table `leave`
--

CREATE TABLE `leave` (
  `id` int(50) NOT NULL,
  `employee_id` int(50) NOT NULL,
  `leave_id` int(50) NOT NULL,
  `leave_from` varchar(255) NOT NULL,
  `leave_to` varchar(255) NOT NULL,
  `leave_description` varchar(255) NOT NULL,
  `leave_status` int(50) NOT NULL,
  `username` varchar(255) NOT NULL,
  `leave_role` int(11) DEFAULT NULL,
  `oa_remark` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `leave`
--

INSERT INTO `leave` (`id`, `employee_id`, `leave_id`, `leave_from`, `leave_to`, `leave_description`, `leave_status`, `username`, `leave_role`, `oa_remark`) VALUES
(1, 20, 2, '2000-10-10', '2000-10-10', 'hey', 1, 'john doe', 2, NULL),
(2, 7, 3, '2000-10-10', '2000-10-10', 'hey peter', 1, 'peter', NULL, NULL),
(6, 9, 3, '2020-10-10', '2020-10-10', 'two days leave', 3, 'john doe', NULL, NULL),
(7, 10, 2, '2003-12-10', '2003-12-10', 'peter leave', 3, 'Peter', NULL, NULL),
(9, 9, 2, '1010-10-10', '1010-10-10', 'sssasasasasasasas', 3, 'john doe', NULL, NULL),
(10, 17, 2, '1999-10-10', '1999-10-10', 'leave', 1, 'john doe', NULL, NULL),
(11, 17, 3, '2003-10-03', '2003-10-05', 'one day leave', 1, 'john doe', NULL, NULL),
(35, 63, 2, '2002-10-10', '2002-10-10', 'one', 1, 'subadmin', 1, NULL),
(36, 93, 2, '1010-10-10', '1010-10-10', 'this is for testing', 2, 'john doe', NULL, NULL),
(37, 63, 1, '1999-12-12', '1999-12-12', 'one day leave', 3, 'subadmin', NULL, NULL),
(38, 63, 3, '2020-10-01', '2020-10-01', 'fdfgffdf', 2, 'subadmin', NULL, NULL),
(39, 63, 1, '2022-06-29', '2022-03-24', 'asdasd ', 1, 'diwali celebration', NULL, NULL),
(40, 63, 3, '2022-11-02', '2022-10-20', 'jj', 1, 'asdasd', NULL, NULL),
(41, 93, 2, '2022-11-03', '2022-11-23', 'asdasd', 3, 'diwali by suryakant', NULL, NULL),
(42, 1000003, 2, '2022-11-01', '2022-11-01', 'one day leave', 3, 'john doe', NULL, NULL),
(43, 1000006, 2, '2022-11-01', '2022-11-01', 'one day leave', 3, 'subadmin', NULL, NULL),
(44, 1000006, 3, '2022-11-02', '2022-11-02', 'one day leave', 2, 'subadmin', NULL, NULL),
(45, 1000004, 2, '2022-11-02', '2022-11-02', 'this is for testing', 3, 'peter boncel', NULL, 'sdadasdsa'),
(46, 1000004, 3, '2022-11-04', '2022-11-04', 'one day leavefdffdfdfdf', 3, 'peter boncel', NULL, 'sdsdsadsads'),
(47, 1000003, 3, '2022-11-03', '2022-11-03', 'this is for testing', 3, 'john doesssss', NULL, 'sdsdssd'),
(48, 1000031, 2, '2022-11-07', '2022-11-07', 'one day leave', 3, 'Janobe Martins', NULL, 'dsds');

-- --------------------------------------------------------

--
-- Table structure for table `leave_type`
--

CREATE TABLE `leave_type` (
  `id` int(255) NOT NULL,
  `leave_type` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `leave_type`
--

INSERT INTO `leave_type` (`id`, `leave_type`) VALUES
(1, 'casual leave'),
(2, 'Sick leave'),
(3, 'Privilege Leave(PL)');

-- --------------------------------------------------------

--
-- Table structure for table `role_type`
--

CREATE TABLE `role_type` (
  `id` int(15) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `user_type` varchar(50) NOT NULL,
  `username` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `role_type`
--

INSERT INTO `role_type` (`id`, `email`, `password`, `user_type`, `username`) VALUES
(1, 'pawan.mukati@newtechfusion.com', '0', 'admin', 'pawan'),
(71, 'jonny@mail.com', '3', 'employee', 'jonny'),
(77, 'haryyy@mail.com', '3', 'employee', 'harry'),
(96, 'john.doe@newtechfusion.com', '0', 'employee', 'john doe'),
(97, 'peter@mail.com', '3', 'employee', 'peter'),
(98, 'dany.richerd@mail.com', '3', 'employee', 'dany richerd'),
(99, 'sub.admin@newtechfusion.com', '0', 'subadmin', 'subadmin'),
(100, 'test@mail.com', '3', 'employee', 'sasa'),
(101, 'testing@mail.com', '3', 'employee', 'test');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `employee`
--
ALTER TABLE `employee`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `employee_payroll_data`
--
ALTER TABLE `employee_payroll_data`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `leave`
--
ALTER TABLE `leave`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `leave_type`
--
ALTER TABLE `leave_type`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `role_type`
--
ALTER TABLE `role_type`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `employee`
--
ALTER TABLE `employee`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1000032;

--
-- AUTO_INCREMENT for table `employee_payroll_data`
--
ALTER TABLE `employee_payroll_data`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=52;

--
-- AUTO_INCREMENT for table `leave`
--
ALTER TABLE `leave`
  MODIFY `id` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=49;

--
-- AUTO_INCREMENT for table `leave_type`
--
ALTER TABLE `leave_type`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `role_type`
--
ALTER TABLE `role_type`
  MODIFY `id` int(15) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=102;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
