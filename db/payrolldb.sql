-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 18, 2024 at 03:46 AM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.0.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `payrolldb`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `username` varchar(30) NOT NULL,
  `password` varchar(60) NOT NULL,
  `firstname` varchar(50) NOT NULL,
  `lastname` varchar(50) NOT NULL,
  `photo` varchar(200) NOT NULL,
  `created_on` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `username`, `password`, `firstname`, `lastname`, `photo`, `created_on`) VALUES
(1, 'arzel', 'arzel', 'Arzel John', 'Zolina', 'admin.jpg', '2022-10-20');

-- --------------------------------------------------------

--
-- Table structure for table `attendance`
--

CREATE TABLE `attendance` (
  `id` int(11) NOT NULL,
  `employee_id` int(11) NOT NULL,
  `date` date NOT NULL,
  `time_in` time NOT NULL,
  `status` int(1) NOT NULL,
  `time_out` time NOT NULL,
  `num_hr` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `attendance`
--

INSERT INTO `attendance` (`id`, `employee_id`, `date`, `time_in`, `status`, `time_out`, `num_hr`) VALUES
(102, 6, '2024-03-03', '09:00:00', 1, '17:00:00', 8),
(103, 6, '2024-03-04', '09:00:00', 1, '17:00:00', 8),
(104, 6, '2024-03-05', '09:00:00', 1, '17:00:00', 8),
(105, 6, '2024-03-06', '09:00:00', 1, '17:00:00', 8),
(106, 6, '2024-03-07', '09:00:00', 1, '17:00:00', 8),
(107, 6, '2024-03-08', '09:00:00', 1, '17:00:00', 8),
(108, 6, '2024-03-09', '09:00:00', 1, '17:00:00', 8),
(109, 6, '2024-03-10', '09:00:00', 1, '17:00:00', 8),
(110, 6, '2024-03-11', '09:00:00', 1, '17:00:00', 8),
(111, 6, '2024-03-12', '09:00:00', 1, '17:00:00', 8),
(112, 6, '2024-03-13', '09:00:00', 1, '17:00:00', 8),
(113, 6, '2024-03-14', '09:00:00', 1, '17:00:00', 8),
(114, 6, '2024-03-15', '09:00:00', 1, '17:00:00', 8),
(115, 6, '2024-03-16', '09:00:00', 1, '17:00:00', 8),
(116, 6, '2024-03-17', '09:00:00', 1, '17:00:00', 8),
(117, 6, '2024-03-18', '09:00:00', 1, '17:00:00', 8),
(118, 6, '2024-03-19', '09:00:00', 1, '17:00:00', 8),
(119, 6, '2024-03-20', '09:00:00', 1, '17:00:00', 8),
(120, 6, '2024-03-21', '09:00:00', 1, '17:00:00', 8),
(131, 7, '2024-03-01', '09:00:00', 1, '17:00:00', 8),
(132, 7, '2024-03-02', '09:00:00', 1, '17:00:00', 8),
(133, 7, '2024-03-03', '09:00:00', 1, '17:00:00', 8),
(134, 7, '2024-03-04', '09:00:00', 1, '17:00:00', 8),
(135, 7, '2024-03-05', '09:00:00', 1, '17:00:00', 8),
(136, 7, '2024-03-06', '09:00:00', 1, '17:00:00', 8),
(137, 7, '2024-03-07', '09:00:00', 1, '17:00:00', 8),
(138, 7, '2024-03-08', '09:00:00', 1, '17:00:00', 8),
(139, 7, '2024-03-09', '09:00:00', 1, '17:00:00', 8),
(140, 7, '2024-03-10', '09:00:00', 1, '17:00:00', 8),
(141, 7, '2024-03-11', '09:00:00', 1, '17:00:00', 8),
(142, 7, '2024-03-12', '09:00:00', 1, '17:00:00', 8),
(143, 7, '2024-03-13', '09:00:00', 1, '17:00:00', 8),
(144, 7, '2024-03-14', '09:00:00', 1, '17:00:00', 8),
(145, 7, '2024-03-15', '09:00:00', 1, '17:00:00', 8),
(146, 7, '2024-03-16', '09:00:00', 1, '17:00:00', 8),
(147, 7, '2024-03-17', '09:00:00', 1, '17:00:00', 8),
(148, 7, '2024-03-18', '09:00:00', 1, '17:00:00', 8),
(154, 10, '2024-03-23', '09:00:00', 1, '17:00:00', 8),
(162, 5, '2024-03-18', '10:30:14', 0, '10:30:17', 0),
(163, 10, '2024-03-18', '10:30:39', 0, '10:30:44', 0);

-- --------------------------------------------------------

--
-- Table structure for table `cashadvance`
--

CREATE TABLE `cashadvance` (
  `id` int(11) NOT NULL,
  `date_advance` date NOT NULL,
  `employee_id` varchar(15) NOT NULL,
  `amount` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `cashadvance`
--

INSERT INTO `cashadvance` (`id`, `date_advance`, `employee_id`, `amount`) VALUES
(2, '2018-05-02', '1', 1000),
(3, '2018-05-02', '1', 1000);

-- --------------------------------------------------------

--
-- Table structure for table `deductions`
--

CREATE TABLE `deductions` (
  `id` int(11) NOT NULL,
  `description` varchar(100) NOT NULL,
  `amount` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `deductions`
--

INSERT INTO `deductions` (`id`, `description`, `amount`) VALUES
(1, 'SSS', 100),
(2, 'Pagibig', 150),
(3, 'PhilHealth', 150);

-- --------------------------------------------------------

--
-- Table structure for table `employees`
--

CREATE TABLE `employees` (
  `id` int(11) NOT NULL,
  `employee_id` varchar(15) NOT NULL,
  `username` varchar(255) NOT NULL,
  `firstname` varchar(50) NOT NULL,
  `lastname` varchar(50) NOT NULL,
  `address` text NOT NULL,
  `birthdate` date NOT NULL,
  `contact_info` varchar(100) NOT NULL,
  `gender` varchar(10) NOT NULL,
  `position_id` int(11) NOT NULL,
  `schedule_id` int(11) NOT NULL,
  `photo` varchar(200) NOT NULL,
  `created_on` date NOT NULL,
  `feedback_message` text NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `employees`
--

INSERT INTO `employees` (`id`, `employee_id`, `username`, `firstname`, `lastname`, `address`, `birthdate`, `contact_info`, `gender`, `position_id`, `schedule_id`, `photo`, `created_on`, `feedback_message`, `password`) VALUES
(5, 'SWC351682097', '', 'Sulayman', 'Sacandal', 'Tupi, South Cotabato', '2022-09-26', '0909090901', 'Male', 1, 1, 'kuya.jpg', '2022-10-20', '', ''),
(6, 'MYC690542781', '', 'Zyra', 'Pinggoy', 'Surallah South Cotabato', '2000-10-17', '0915184849', 'Male', 2, 1, 'zyra.jpg', '2022-10-20', 'sasasa', ''),
(7, 'DIR671295830', '', 'Marjorie', 'Montano', 'Surallah South Cotabato', '2001-08-08', '09154184895', 'Female', 4, 2, 'marjorie.jpg', '2022-10-20', '', ''),
(8, 'HNO248137905', '', 'Arnie', 'Lastimoso', 'Tupi South Cotabato', '2002-05-09', '09048548497', 'Female', 5, 1, 'arnie.png', '2022-10-20', '', ''),
(9, 'ZQJ783540162', '', 'Ariel', 'Rivamonte', 'Polomolok South Cotabato', '2000-10-03', '0945215487', 'Male', 1, 2, 'ariel.jpg', '2022-10-20', '', ''),
(10, 'KHY240756813', 'arzel', 'arzel', 'zolina', 'polomolok', '2023-09-10', '09099932932', 'Male', 1, 1, '', '2023-08-02', 'oki', 'arzel'),
(11, 'TVB982604137', '123', 'test', 'test', 'polomolok', '2001-03-26', '0921218721', 'Male', 2, 1, 'pia.png', '2024-03-13', 'ssassa', '123');

-- --------------------------------------------------------

--
-- Table structure for table `overtime`
--

CREATE TABLE `overtime` (
  `id` int(11) NOT NULL,
  `employee_id` varchar(15) NOT NULL,
  `hours` double NOT NULL,
  `rate` double NOT NULL,
  `date_overtime` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `position`
--

CREATE TABLE `position` (
  `id` int(11) NOT NULL,
  `description` varchar(150) NOT NULL,
  `rate` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `position`
--

INSERT INTO `position` (`id`, `description`, `rate`) VALUES
(1, 'Manager', 500),
(2, 'Chef', 200),
(3, 'Waiter', 200),
(4, 'Cashier', 250),
(5, 'Bartender', 370),
(6, 'Dishwasher', 250);

-- --------------------------------------------------------

--
-- Table structure for table `schedules`
--

CREATE TABLE `schedules` (
  `id` int(11) NOT NULL,
  `time_in` time NOT NULL,
  `time_out` time NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `schedules`
--

INSERT INTO `schedules` (`id`, `time_in`, `time_out`) VALUES
(1, '07:00:00', '16:00:00'),
(2, '08:00:00', '17:00:00'),
(3, '09:00:00', '18:00:00'),
(4, '10:00:00', '19:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `shift_requests`
--

CREATE TABLE `shift_requests` (
  `id` int(11) NOT NULL,
  `employee_id` int(11) NOT NULL,
  `requested_shift` varchar(50) NOT NULL,
  `request_date` date NOT NULL,
  `status` enum('Pending','Approved','Rejected') NOT NULL DEFAULT 'Pending',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `attendance`
--
ALTER TABLE `attendance`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cashadvance`
--
ALTER TABLE `cashadvance`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `deductions`
--
ALTER TABLE `deductions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `employees`
--
ALTER TABLE `employees`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `overtime`
--
ALTER TABLE `overtime`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `position`
--
ALTER TABLE `position`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `schedules`
--
ALTER TABLE `schedules`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `shift_requests`
--
ALTER TABLE `shift_requests`
  ADD PRIMARY KEY (`id`),

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `attendance`
--
ALTER TABLE `attendance`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=164;

--
-- AUTO_INCREMENT for table `cashadvance`
--
ALTER TABLE `cashadvance`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `deductions`
--
ALTER TABLE `deductions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `employees`
--
ALTER TABLE `employees`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `overtime`
--
ALTER TABLE `overtime`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `position`
--
ALTER TABLE `position`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `schedules`
--
ALTER TABLE `schedules`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `shift_requests`
--
ALTER TABLE `shift_requests`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `shift_requests`
--


/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
