-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Jun 13, 2024 at 02:01 PM
-- Server version: 10.6.18-MariaDB-cll-lve-log
-- PHP Version: 8.1.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `nedelch1_xs`
--

-- --------------------------------------------------------

--
-- Table structure for table `books`
--

CREATE TABLE `books` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `isbn` varchar(13) NOT NULL,
  `description` text DEFAULT NULL,
  `user_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

--
-- Dumping data for table `books`
--

INSERT INTO `books` (`id`, `name`, `isbn`, `description`, `user_id`, `created_at`) VALUES
(1, 'Harry Potter and the Sorcerers Stone', '1338878921', 'Custom Description here :)', 2, '2024-06-13 10:54:46'),
(2, 'Would You Rather... the Harry Potter Fan Edition!', '979-881710564', 'This book is published by Independently Published. The book is published on 2022', 2, '2024-06-13 10:55:17'),
(3, 'Official Harry Potter Cookbook', '1338893076', 'This book is published by Scholastic. The book is published on 2023', 2, '2024-06-13 10:55:39'),
(4, 'Unofficial Ultimate Harry Potter Spellbook', '978-194817424', 'This book is published by Topix Media Lab. The book is published on 2019', 2, '2024-06-13 10:55:56'),
(5, 'InvestiGators', '1250849896', 'This book is published by Roaring Brook Press. The book is published on 2023', 2, '2024-06-13 10:56:11'),
(6, 'InvestiGators 2', '978-125022000', 'This book is published by First Second. The book is published on Feb 23, 2021', 2, '2024-06-13 10:56:29');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `first_name` varchar(50) NOT NULL,
  `last_name` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `active` tinyint(1) DEFAULT 0,
  `deleted` int(11) NOT NULL DEFAULT 0,
  `is_admin` tinyint(1) DEFAULT 0,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `first_name`, `last_name`, `email`, `password`, `active`, `deleted`, `is_admin`, `created_at`) VALUES
(1, 'Georgi', 'Nedelchev', 'nedelcev@mail.bg', '$2y$10$SxrxprKwh1b2hi7l3qoni.ZZgNyAXNg8fdIMjerdyq7ejjNdkUUra', 1, 0, 1, '2024-06-13 10:44:41'),
(2, 'Admin', 'Testov', 'admin@nedelchev.eu', '$2y$10$FTwTWi3b1KYuPSMwR92aI.4fQn.CTKJUxn5gAYGlZld/QtHkP/o8G', 1, 0, 1, '2024-06-13 10:45:03'),
(3, 'User', 'Testov', 'test@nedelchev.eu', '$2y$10$aqUDhMxHJibkgGpQsm93beILSoI4QcjLSltRA172MnkrTVXp7iqLm', 1, 0, 0, '2024-06-13 10:45:26');

-- --------------------------------------------------------

--
-- Table structure for table `user_books`
--

CREATE TABLE `user_books` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `book_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `books`
--
ALTER TABLE `books`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `isbn` (`isbn`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `user_books`
--
ALTER TABLE `user_books`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `book_id` (`book_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `books`
--
ALTER TABLE `books`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `user_books`
--
ALTER TABLE `user_books`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
