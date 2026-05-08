-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 08, 2026 at 03:16 PM
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
-- Database: `db2432452`
--

-- --------------------------------------------------------

--
-- Table structure for table `books`
--

CREATE TABLE `books` (
  `book_id` int(11) NOT NULL,
  `book_name` varchar(255) NOT NULL,
  `book_description` text NOT NULL,
  `released_date` date NOT NULL,
  `rating` decimal(10,0) NOT NULL,
  `image_url` varchar(500) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `books`
--

INSERT INTO `books` (`book_id`, `book_name`, `book_description`, `released_date`, `rating`, `image_url`) VALUES
(1, 'Honey and Spice', 'As host of radio show Brown Sugar, Kiki Banjo\'s mission is to protect her listeners from heartbreak. Which puts Whitewell College\'s newest student, handsome \'player\' Malakai Korede, at the top of her hitlist.', '2022-07-05', 4, NULL),
(2, 'When I think of you ', 'The story follows Kaliya Wilson, a film school graduate stuck as a receptionist, and Danny Prescott, a hotshot director whose career is taking off. ', '2025-04-16', 3, NULL),
(3, 'Only for the week', 'Bishop about a one-week fling between Janelle, maid of honour, and Rome, the best man, at a destination wedding. The story follows their undeniable chemistry as they try to keep their affair temporary, but their connection deepens, leading them to question if a week-long agreement can become a lifetime of love. It\'s known for its Black love, spicy romance, and messy family dynamics. ', '2023-05-24', 5, NULL),
(4, 'Before I let go ', 'A compelling second chance romance story centred around a divorced couple whose world falls apart. It is tender, powerful, emotional, and so very authentic in the telling', '2022-11-15', 4, NULL),
(5, 'The Worst Best Man', 'A romantic comedy by Mia Sosa about a wedding planner who is forced to work with her ex-fiancé\'s brother, the man who convinced him to leave her at the altar. The book follows the \"enemies-to-lovers\" trope as the two must cooperate to land a new dream job, all while a steamy, witty attraction develops between them.', '2020-02-04', 4, NULL),
(6, 'Noelly', 'lovely girl', '2011-11-18', 9, 'y');

-- --------------------------------------------------------

--
-- Table structure for table `events`
--

CREATE TABLE `events` (
  `id` int(11) NOT NULL,
  `title` varchar(150) NOT NULL,
  `description` text NOT NULL,
  `event_date` datetime NOT NULL,
  `location` varchar(150) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `events`
--

INSERT INTO `events` (`id`, `title`, `description`, `event_date`, `location`, `created_at`) VALUES
(1, 'Freshers Welcome Fair', 'Meet student societies and explore campus opportunities.', '2026-09-20 10:00:00', 'City Campus', '2026-03-08 19:57:24'),
(2, 'Careers Workshop', 'CV writing and interview preparation session.', '2026-09-25 14:00:00', 'Ambika Paul Building', '2026-03-08 19:57:24'),
(3, 'Library Skills Session', 'Learn how to use university digital resources.', '2026-09-28 11:00:00', 'Harrison Library', '2026-03-08 19:57:24');

-- --------------------------------------------------------

--
-- Table structure for table `event_bookings`
--

CREATE TABLE `event_bookings` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `event_id` int(11) NOT NULL,
  `booked_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `event_bookings`
--

INSERT INTO `event_bookings` (`id`, `user_id`, `event_id`, `booked_at`) VALUES
(1, 2, 1, '2026-03-08 20:03:04'),
(2, 2, 2, '2026-03-08 20:03:05'),
(3, 2, 3, '2026-03-08 20:03:06'),
(15, 1, 1, '2026-03-09 14:16:23');

-- --------------------------------------------------------

--
-- Table structure for table `rewards`
--

CREATE TABLE `rewards` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `description` text NOT NULL,
  `points_cost` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `rewards`
--

INSERT INTO `rewards` (`id`, `name`, `description`, `points_cost`, `created_at`) VALUES
(1, 'Free Coffee Voucher', 'Redeem a free campus drink.', 250, '2026-05-08 12:53:56'),
(2, 'University Hoodie Discount', 'Get money off university merchandise.', 500, '2026-05-08 12:53:56'),
(3, 'Priority Event Access', 'Get early booking for selected events.', 800, '2026-05-08 12:53:56');

-- --------------------------------------------------------

--
-- Table structure for table `reward_claims`
--

CREATE TABLE `reward_claims` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `reward_id` int(11) NOT NULL,
  `claimed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `student_id` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `student_id`, `email`, `password`, `created_at`) VALUES
(1, '2432452', 'S.Ratnayaka@wlv.ac.uk', '$2y$10$Jd46/16O1tD7KKOyxSfo3.aejXGN9a4/gwqjpUF0UL0K1Rm7eztY.', '2026-03-01 23:14:27'),
(2, '1234', 'test@yahoo.com', '$2y$10$chCWimhvIJ2mJxKWQZD2T.uazmDTtwLBsM3z3Hs2p6NxGSf/IG6q2', '2026-03-08 19:51:37'),
(9, '2405377', 'O.Ikwe@wlv.ac.uk', '$2y$12$dgh1/dkQlKF/X8nkzq/xhO.S6wLCUjQ7tbBGnnNDpULhG9G3q6FSS', '2026-03-09 14:29:02'),
(10, '2218338', 's.o.boahen@wlv.ac.uk', '$2y$10$Z3idPVWsVWYYLEBY1lJKfuZ1NyDwMie8p.BAfDdHpwlK7POOMbzsW', '2026-03-15 23:19:14');

-- --------------------------------------------------------

--
-- Table structure for table `user_points`
--

CREATE TABLE `user_points` (
  `user_id` int(11) NOT NULL,
  `points` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `books`
--
ALTER TABLE `books`
  ADD PRIMARY KEY (`book_id`);

--
-- Indexes for table `events`
--
ALTER TABLE `events`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `event_bookings`
--
ALTER TABLE `event_bookings`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `unique_booking` (`user_id`,`event_id`),
  ADD KEY `event_id` (`event_id`);

--
-- Indexes for table `rewards`
--
ALTER TABLE `rewards`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `reward_claims`
--
ALTER TABLE `reward_claims`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `reward_id` (`reward_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `student_id` (`student_id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `user_points`
--
ALTER TABLE `user_points`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `events`
--
ALTER TABLE `events`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `event_bookings`
--
ALTER TABLE `event_bookings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `rewards`
--
ALTER TABLE `rewards`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `reward_claims`
--
ALTER TABLE `reward_claims`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `event_bookings`
--
ALTER TABLE `event_bookings`
  ADD CONSTRAINT `event_bookings_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `event_bookings_ibfk_2` FOREIGN KEY (`event_id`) REFERENCES `events` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `reward_claims`
--
ALTER TABLE `reward_claims`
  ADD CONSTRAINT `reward_claims_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `reward_claims_ibfk_2` FOREIGN KEY (`reward_id`) REFERENCES `rewards` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `user_points`
--
ALTER TABLE `user_points`
  ADD CONSTRAINT `user_points_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
