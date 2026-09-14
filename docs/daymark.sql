-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Gegenereerd op: 14 sep 2026 om 19:28
-- Serverversie: 10.4.32-MariaDB
-- PHP-versie: 8.2.12

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
-- Tabelstructuur voor tabel `habits`
--

CREATE TABLE `habits` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `title` varchar(50) NOT NULL,
  `description` varchar(300) NOT NULL,
  `frequency` varchar(10) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Gegevens worden geëxporteerd voor tabel `habits`
--

INSERT INTO `habits` (`id`, `user_id`, `title`, `description`, `frequency`, `created_at`, `updated_at`) VALUES
(1, 0, 'dwadwa', '5', '2', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(2, 2, 'dwdad', 'dwadwa', '5', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(3, 2, 'dwadwa', 'dwadwa', '5', '2026-09-14 14:08:41', '0000-00-00 00:00:00'),
(4, 2, 'dwadwad', 'dwadwa', '3', '2026-09-14 14:41:41', '0000-00-00 00:00:00');

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
-- AUTO_INCREMENT voor een tabel `habits`
--
ALTER TABLE `habits`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT voor een tabel `habit_logs`
--
ALTER TABLE `habit_logs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT voor een tabel `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
