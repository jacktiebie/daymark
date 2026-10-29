-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Gegenereerd op: 27 okt 2026 om 12:03
-- Serverversie: 10.4.32-MariaDB
-- PHP-versie: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `daymark`
--

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `daily_checkins`
--

CREATE TABLE `daily_checkins` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `mood` tinyint(10) NOT NULL,
  `energy` tinyint(10) NOT NULL,
  `productivity` tinyint(10) NOT NULL,
  `sleep` tinyint(10) NOT NULL,
  `overall_day` tinyint(10) NOT NULL,
  `note` text NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Gegevens worden geëxporteerd voor tabel `daily_checkins`
--

INSERT INTO `daily_checkins` (`id`, `user_id`, `mood`, `energy`, `productivity`, `sleep`, `overall_day`, `note`, `created_at`) VALUES
(8, 2, 5, 4, 3, 1, 3, 'dwadwad', '2026-09-28 23:28:30'),
(9, 2, 4, 3, 4, 2, 3, 'dwdaw', '2026-10-01 14:37:02'),
(10, 2, 4, 4, 3, 5, 4, '', '2026-10-02 17:25:33'),
(11, 2, 4, 3, 3, 3, 3, 'dwad', '2026-10-22 11:14:53');

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `goals`
--

CREATE TABLE `goals` (
  `id` int(100) NOT NULL,
  `user_id` int(100) NOT NULL,
  `title` varchar(20) NOT NULL,
  `description` varchar(30) NOT NULL,
  `target_value` int(100) NOT NULL,
  `current_value` int(100) NOT NULL,
  `unit` varchar(5) NOT NULL,
  `status` tinyint(1) NOT NULL,
  `due_date` date NOT NULL,
  `created_at` date NOT NULL DEFAULT current_timestamp(),
  `updated_at` date NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Gegevens worden geëxporteerd voor tabel `goals`
--

INSERT INTO `goals` (`id`, `user_id`, `title`, `description`, `target_value`, `current_value`, `unit`, `status`, `due_date`, `created_at`, `updated_at`) VALUES
(15, 2, 'Test', 'Test', 55, 3, 'KG', 0, '2026-10-25', '2026-10-03', '2026-10-03');

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `habits`
--

CREATE TABLE `habits` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `title` varchar(50) NOT NULL,
  `description` varchar(300) NOT NULL,
  `frequency` varchar(10) NOT NULL,
  `icon` varchar(20) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Gegevens worden geëxporteerd voor tabel `habits`
--

INSERT INTO `habits` (`id`, `user_id`, `title`, `description`, `frequency`, `icon`, `created_at`, `updated_at`) VALUES
(30, 2, 'Test', 'Test', '5', 'gym', '2026-10-03 13:09:02', '0000-00-00 00:00:00'),
(31, 2, 'dwad', 'dwda', '5', 'gym', '2026-10-22 11:29:27', '0000-00-00 00:00:00'),
(32, 2, 'dwad', 'dwad', '3', 'working', '2026-10-22 11:29:31', '0000-00-00 00:00:00'),
(33, 2, 'dwadad', 'dwadwad', '6', 'meditate', '2026-10-22 11:29:40', '0000-00-00 00:00:00'),
(34, 2, 'dwadaw', 'dwad', '3', 'meditate', '2026-10-22 11:29:47', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `habit_logs`
--

CREATE TABLE `habit_logs` (
  `id` int(11) NOT NULL,
  `habit_id` int(11) NOT NULL,
  `log_date` date NOT NULL,
  `completed` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Gegevens worden geëxporteerd voor tabel `habit_logs`
--

INSERT INTO `habit_logs` (`id`, `habit_id`, `log_date`, `completed`) VALUES
(8, 11, '2026-09-14', 0),
(9, 11, '2026-09-15', 0),
(10, 11, '2026-09-16', 0),
(23, 10, '2026-09-14', 0),
(24, 10, '2026-09-15', 0),
(25, 10, '2026-09-16', 0),
(26, 10, '2026-09-17', 0),
(27, 14, '2026-09-18', 0),
(28, 14, '2026-09-17', 0),
(29, 14, '2026-09-16', 0),
(30, 17, '2026-09-14', 0),
(31, 17, '2026-09-15', 0),
(32, 17, '2026-09-16', 0),
(33, 25, '2026-09-14', 0),
(35, 25, '2026-09-16', 0),
(36, 25, '2026-09-17', 0),
(38, 25, '2026-09-19', 0),
(39, 25, '2026-09-20', 0),
(40, 24, '2026-09-17', 0),
(41, 22, '2026-09-17', 0),
(42, 21, '2026-09-17', 0),
(43, 26, '2026-09-16', 0),
(44, 26, '2026-09-17', 0),
(45, 24, '2026-09-29', 0),
(46, 24, '2026-09-30', 0),
(47, 24, '2026-10-01', 0),
(48, 24, '2026-10-02', 0),
(49, 24, '2026-10-03', 0),
(50, 24, '2026-10-04', 0),
(51, 29, '2026-09-29', 0),
(52, 29, '2026-09-30', 0),
(53, 29, '2026-10-01', 0),
(54, 29, '2026-10-02', 0),
(55, 29, '2026-10-03', 0),
(56, 29, '2026-10-04', 0),
(57, 29, '2026-09-28', 0),
(59, 30, '2026-09-28', 0),
(60, 30, '2026-09-29', 0),
(61, 30, '2026-09-30', 0),
(62, 30, '2026-10-01', 0),
(63, 30, '2026-10-02', 0),
(64, 30, '2026-10-03', 0),
(65, 30, '2026-10-04', 0),
(66, 33, '2026-10-20', 0),
(67, 31, '2026-10-23', 0),
(68, 30, '2026-10-22', 0);

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `first_name` varchar(30) NOT NULL,
  `last_name` varchar(30) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(100) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Gegevens worden geëxporteerd voor tabel `users`
--

INSERT INTO `users` (`user_id`, `first_name`, `last_name`, `email`, `password`, `created_at`) VALUES
(1, 'Jack', 'Tiebie', 'jacktiebie@gmail.com', 'wdawdwadwdw232@@', '2026-09-02 17:34:59'),
(2, 'Jack', 'Tiebie', 'jacktiebie2@gmail.com', '$2y$10$I/Mj0z9lRzXexM8vnGBTFO5Xsw4TpcnLJacof4yU/W2xVKzgyehnW', '2026-09-02 19:03:24'),
(3, 'Jack', 'Tiebie', 'jacktiebie2@gmail.com', '$2y$10$s/alUYpJo9HwmAvhibW3WuUDWaQlh02.o6gMgbHo3083C/7GS.RDO', '2026-09-02 19:09:34'),
(4, 'Jack', 'Tiebie', 'jacktiebie2@gmail.com', '$2y$10$gamWax/oHZbKdnb6pRHq6.25v/kVORnBjjON5Mr57b.yCQbxIBOly', '2026-09-02 19:09:57'),
(5, 'Jack', 'Tiebie', 'jacktiebie123@gmail.com', '$2y$10$3cy5QMdkMW89IXNMs/Ip7OuB0UlxdmZ6XR.8R4fw2YVv68BgVwGha', '2026-09-04 16:24:08');

--
-- Indexen voor geëxporteerde tabellen
--

--
-- Indexen voor tabel `daily_checkins`
--
ALTER TABLE `daily_checkins`
  ADD PRIMARY KEY (`id`);

--
-- Indexen voor tabel `goals`
--
ALTER TABLE `goals`
  ADD PRIMARY KEY (`id`);

--
-- Indexen voor tabel `habits`
--
ALTER TABLE `habits`
  ADD PRIMARY KEY (`id`);

--
-- Indexen voor tabel `habit_logs`
--
ALTER TABLE `habit_logs`
  ADD PRIMARY KEY (`id`);

--
-- Indexen voor tabel `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT voor geëxporteerde tabellen
--

--
-- AUTO_INCREMENT voor een tabel `daily_checkins`
--
ALTER TABLE `daily_checkins`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT voor een tabel `goals`
--
ALTER TABLE `goals`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT voor een tabel `habits`
--
ALTER TABLE `habits`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT voor een tabel `habit_logs`
--
ALTER TABLE `habit_logs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=69;

--
-- AUTO_INCREMENT voor een tabel `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
