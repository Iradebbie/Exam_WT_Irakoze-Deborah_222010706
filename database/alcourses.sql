-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 23, 2024 at 07:48 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `alcourses`
--

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

CREATE TABLE `cart` (
  `id` int(11) NOT NULL,
  `course_Id` varchar(90) DEFAULT NULL,
  `course_name` varchar(90) DEFAULT NULL,
  `user_id` varchar(90) DEFAULT NULL,
  `price` varchar(90) DEFAULT NULL,
  `quantity` varchar(90) DEFAULT NULL,
  `image` varchar(90) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `cart`
--

INSERT INTO `cart` (`id`, `course_Id`, `course_name`, `user_id`, `price`, `quantity`, `image`) VALUES
(1, '2', 'big data', '7', '200', '1', 'uploads/bigdata.jpeg');

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` int(30) NOT NULL,
  `category` varchar(250) NOT NULL,
  `description` text DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `date_created` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `category`, `description`, `status`, `date_created`) VALUES
(1, 'datascience', 'statistics', 0, '2024-05-16 12:33:55'),
(2, 'datascience', 'statistics', 0, '2024-05-16 12:33:55'),
(3, 'quantem communication', 'this is the quantem courses', 12, '2024-05-18 13:30:32');

-- --------------------------------------------------------

--
-- Table structure for table `courses`
--

CREATE TABLE `courses` (
  `id` int(11) NOT NULL,
  `course_name` varchar(90) DEFAULT NULL,
  `course_category` varchar(90) DEFAULT NULL,
  `course_price` varchar(90) DEFAULT NULL,
  `course_decription` varchar(90) DEFAULT NULL,
  `lecture_ID` varchar(90) DEFAULT NULL,
  `courseImage` varchar(90) NOT NULL,
  `date_` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `courses`
--

INSERT INTO `courses` (`id`, `course_name`, `course_category`, `course_price`, `course_decription`, `lecture_ID`, `courseImage`, `date_`) VALUES
(1, 'data science', '1', '200', 'his caourse is free to leanr', '6', 'uploads/datascience.jpg', '2024-05-23 17:27:23'),
(2, 'big data', '3', '200', 'this course will be thought live  at campus', '2', 'uploads/bigdata.jpeg', '2024-05-23 17:31:02'),
(3, 'IOT', '2', '200', 'this iwill be thought online', '1', 'uploads/iot.jpeg', '2024-05-23 17:31:34');

-- --------------------------------------------------------

--
-- Table structure for table `enrollment`
--

CREATE TABLE `enrollment` (
  `id` int(11) NOT NULL,
  `studentId` varchar(90) DEFAULT NULL,
  `courseName` varchar(90) DEFAULT NULL,
  `courseId` varchar(90) DEFAULT NULL,
  `date_` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `enrollment`
--

INSERT INTO `enrollment` (`id`, `studentId`, `courseName`, `courseId`, `date_`) VALUES
(1, '5', 'lq', '6', '2024-05-18 07:56:01'),
(2, '5', 'lq', '6', '2024-05-18 07:57:30'),
(3, '5', 'lq', '6', '2024-05-18 07:59:19'),
(4, '5', 'big data', '5', '2024-05-18 08:03:30'),
(5, '5', 'stat', '4', '2024-05-18 08:03:30'),
(6, '5', 'stat', '4', '2024-05-18 08:08:46'),
(7, '5', 'lq', '6', '2024-05-18 08:08:46');

-- --------------------------------------------------------

--
-- Table structure for table `instructor`
--

CREATE TABLE `instructor` (
  `id` int(11) NOT NULL,
  `fulls_name` varchar(90) DEFAULT NULL,
  `phone_number` varchar(90) DEFAULT NULL,
  `Email` varchar(90) DEFAULT NULL,
  `Adress` varchar(90) DEFAULT NULL,
  `gender` varchar(90) DEFAULT NULL,
  `status` varchar(90) DEFAULT NULL,
  `age` varchar(90) DEFAULT NULL,
  `image` varchar(90) NOT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `instructor`
--

INSERT INTO `instructor` (`id`, `fulls_name`, `phone_number`, `Email`, `Adress`, `gender`, `status`, `age`, `image`, `date`) VALUES
(2, 'deboo4', '1234567', 'irakozedeborah46@gmail.com', 'kigali', 'Female', 'single', '21', 'uploads/Screenshot 2024-03-18 132232.png', '2024-05-16 00:06:30'),
(5, 'joakim', '12345', 'mutoni@gmail.com', 'huye', 'Male', 'active', 'q', 'uploads/Screenshot 2024-03-18 132447.png', '2024-05-16 08:46:13'),
(6, 'ciri', '56789', 'niyigena@gmail.com', 'rusizi', 'Male', 'active', '90', 'uploads/provider.png', '2024-05-18 11:40:53'),
(7, 'ciri@gmail.com', '1456789', 'ciri@gmail.com', 'rusiiz', 'Male', 'active', '8', 'uploads/Screenshot 2024-05-07 142110.png', '2024-05-20 07:14:44');

-- --------------------------------------------------------

--
-- Table structure for table `lecture`
--

CREATE TABLE `lecture` (
  `id` int(11) NOT NULL,
  `Full_name` varchar(90) DEFAULT NULL,
  `phone_number` varchar(90) DEFAULT NULL,
  `email` varchar(90) DEFAULT NULL,
  `Adress` varchar(90) DEFAULT NULL,
  `gender` varchar(90) DEFAULT NULL,
  `status` varchar(90) DEFAULT NULL,
  `age` varchar(90) DEFAULT NULL,
  `image` varchar(90) DEFAULT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `lecture`
--

INSERT INTO `lecture` (`id`, `Full_name`, `phone_number`, `email`, `Adress`, `gender`, `status`, `age`, `image`, `date`) VALUES
(1, 'irakoze Deborah', '123456', 'irakozedeborah46@gmail.com', 'huye', 'Female', 'married', '12', 'uploads/lect.jpg', '2024-05-23 17:29:13'),
(2, 'gatabazi', '1234567', 'tresormugambage@icloud.com', 'kigali', 'Female', 'single', '21', 'uploads/lect.jpg', '2024-05-23 17:29:52');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` int(11) NOT NULL,
  `studentId` int(11) DEFAULT NULL,
  `courseName` varchar(90) DEFAULT NULL,
  `courseId` int(11) DEFAULT NULL,
  `date_` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `sales`
--

CREATE TABLE `sales` (
  `id` int(11) NOT NULL,
  `studentId` int(11) DEFAULT NULL,
  `courseName` varchar(90) DEFAULT NULL,
  `courseId` int(11) DEFAULT NULL,
  `dateAdded` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `sales`
--

INSERT INTO `sales` (`id`, `studentId`, `courseName`, `courseId`, `dateAdded`) VALUES
(1, 5, 'stat', 4, '2024-05-18 08:08:46'),
(2, 5, 'lq', 6, '2024-05-18 08:08:46');

-- --------------------------------------------------------

--
-- Table structure for table `system_info`
--

CREATE TABLE `system_info` (
  `id` int(30) NOT NULL,
  `meta_field` text NOT NULL,
  `meta_value` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `system_info`
--

INSERT INTO `system_info` (`id`, `meta_field`, `meta_value`) VALUES
(11, 'logo', 'uploads/1626397500_book_logo.jpg'),
(14, 'cover', 'uploads/1626397620_books.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `system_log_info`
--

CREATE TABLE `system_log_info` (
  `id` int(11) NOT NULL,
  `logInfo` varchar(90) DEFAULT NULL,
  `userName` varchar(90) DEFAULT NULL,
  `dateDone` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `system_log_info`
--

INSERT INTO `system_log_info` (`id`, `logInfo`, `userName`, `dateDone`) VALUES
(1, 'logout', 'ciri@gmail.com', '2024-05-18 18:01:12'),
(2, 'logout', 'ciri@gmail.com', '2024-05-18 18:06:25'),
(3, 'LogIn', 'ciri@gmail.com', '2024-05-18 18:06:38'),
(4, 'logout', 'ciri@gmail.com', '2024-05-18 18:50:31'),
(5, 'LogIn', 'niyigena@gmail.com', '2024-05-19 21:06:47'),
(6, 'logout', 'niyigena@gmail.com', '2024-05-19 21:07:07'),
(7, 'LogIn', 'ciri@gmail.com', '2024-05-19 21:07:24'),
(8, 'LogIn', 'ciri@gmail.com', '2024-05-20 07:14:02'),
(9, 'logout', 'ciri@gmail.com', '2024-05-20 07:15:24'),
(10, 'LogIn', 'ciri@gmail.com', '2024-05-20 07:17:06'),
(11, 'logout', 'ciri@gmail.com', '2024-05-20 07:17:27'),
(12, 'LogIn', 'ciri@gmail.com', '2024-05-20 09:21:37'),
(13, 'LogIn', 'ciri@gmail.com', '2024-05-24 01:55:35'),
(14, 'logout', 'ciri@gmail.com', '2024-05-24 02:31:59');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `first_name` varchar(90) DEFAULT NULL,
  `last_name` varchar(90) DEFAULT NULL,
  `contact` varchar(90) DEFAULT NULL,
  `gender` varchar(90) DEFAULT NULL,
  `email` varchar(90) DEFAULT NULL,
  `password` varchar(90) DEFAULT NULL,
  `role` varchar(90) DEFAULT NULL,
  `image` varchar(90) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `first_name`, `last_name`, `contact`, `gender`, `email`, `password`, `role`, `image`) VALUES
(1, 'niyigena', 'mike', '123456789', 'Male', 'niyigenamike3@gmail.com', 'niyigenamike3@gmail.com', 'Student', ''),
(2, 'debie', 'debie', '67890', 'Female', 'debie@gmail.com', 'debie@gmail.com', 'Admin', ''),
(3, 'gicanda', 'gicanda', '12345678', 'Female', 'gicanda@gmail.com', 'gicanda@gmail.com', 'Student', ''),
(4, 'gicanda@gmail.com', 'gicanda@gmail.com', '345678', 'Male', 'gicanda@gmail.com', 'gicanda@gmail.com', 'Student', ''),
(5, 'alinem@gmail.com', 'alinem@gmail.com', '1234567890', 'Male', 'alinem@gmail.com', '7f7a76ab8e60181b8bead8621d4abd17', 'Student', ''),
(6, 'niyigena@gmail.com', 'niyigena@gmail.com', '67890', 'Male', 'niyigena@gmail.com', '9b04992739af437e4224e7f247c33f38', 'Student', ''),
(7, 'ciri@gmail.com', 'ciri@gmail.com', '2345678', 'Male', 'ciri@gmail.com', 'd1457b321ab5fc1260de7ac0c50de28a', 'Admin', ''),
(8, 'niyigena', 'mike', '67890', 'Male', 'niyigenamike3@gmail.com', '795e933bf69296cf7ce34452b0aede61', 'Admin', ''),
(9, 'irakoze', 'deborah', '1234567890', 'Female', 'irakozedeborah46@gmail.com', '42be95ec68cbf13e50f0e1312646d73d', 'Admin', ''),
(10, 'gatabazi', 'gatabazi', '1234567890', 'Male', 'gatabazi@gmail.com', '18adb8a1c79cd1036ea4ea5bf6c021d6', 'Student', '');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `courses`
--
ALTER TABLE `courses`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `enrollment`
--
ALTER TABLE `enrollment`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `instructor`
--
ALTER TABLE `instructor`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `lecture`
--
ALTER TABLE `lecture`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sales`
--
ALTER TABLE `sales`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `system_info`
--
ALTER TABLE `system_info`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `system_log_info`
--
ALTER TABLE `system_log_info`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `cart`
--
ALTER TABLE `cart`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `courses`
--
ALTER TABLE `courses`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `enrollment`
--
ALTER TABLE `enrollment`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `instructor`
--
ALTER TABLE `instructor`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `lecture`
--
ALTER TABLE `lecture`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `sales`
--
ALTER TABLE `sales`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `system_log_info`
--
ALTER TABLE `system_log_info`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
