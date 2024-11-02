-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 02, 2024 at 04:49 PM
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
-- Database: `aws`
--

-- --------------------------------------------------------

--
-- Table structure for table `booking`
--

CREATE TABLE `booking` (
  `booking_id` int(11) NOT NULL,
  `customer_id` int(10) NOT NULL,
  `room_id` int(10) NOT NULL,
  `date` varchar(40) NOT NULL,
  `quantity` int(10) NOT NULL,
  `cost` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `booking`
--

INSERT INTO `booking` (`booking_id`, `customer_id`, `room_id`, `date`, `quantity`, `cost`) VALUES
(3, 3, 1, '05/11/2024 - 06/11/2024', 1, 1234),
(4, 3, 1, '05/11/2024 - 06/11/2024', 1, 1234),
(5, 3, 1, '05/11/2024 - 06/11/2024', 1, 1234),
(6, 3, 1, '05/11/2024 - 06/11/2024', 1, 1234),
(7, 5, 1, '05/11/2024 - 06/11/2024', 1, 1234);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `email` varchar(254) NOT NULL,
  `firstname` varchar(50) NOT NULL,
  `lastname` varchar(50) NOT NULL,
  `username` varchar(30) NOT NULL,
  `password` char(60) NOT NULL,
  `position` varchar(50) NOT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `email`, `firstname`, `lastname`, `username`, `password`, `position`, `created_at`, `updated_at`) VALUES
(3, 'st5907586@bodin4ac.th', 'jiradthawath', 'assawakolsolpapha', 'customer', '$2y$10$apv2JNJwuLENrq1UngGaSOn5CtVtWZp8XwX/4c60a5H09NaqmF6ZK', 'c', '2024-11-02 00:39:25', '2024-11-02 00:48:38'),
(4, '65070121@kmitl.ac.th', 'no1', 'no2', 'admin', '$2y$10$B0cU3mLLXB2qsBN.eC5PbOGTwCww.uClLCw7iXkvuRYpHqmJPZBzS', 'a', '2024-11-02 00:48:28', '2024-11-02 00:49:08'),
(5, 'user1@gmail.com', 'pranpreeya', 'MMM', 'user1', '$2y$10$Q0/JOqIqODiwhopJxrD4jOZ82WhAF//Fw0nMQI9CVqiYHZTwU/hTq', 'c', '2024-11-02 15:47:04', '2024-11-02 15:47:04');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `booking`
--
ALTER TABLE `booking`
  ADD PRIMARY KEY (`booking_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`),
  ADD UNIQUE KEY `username` (`username`),
  ADD KEY `idx_users_email` (`email`),
  ADD KEY `idx_users_username` (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `booking`
--
ALTER TABLE `booking`
  MODIFY `booking_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
