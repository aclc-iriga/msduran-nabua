-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 24, 2023 at 03:49 PM
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
-- Database: `msduran-nabua`
--

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

CREATE TABLE `admins` (
  `id` tinyint(3) UNSIGNED NOT NULL,
  `number` tinyint(3) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `avatar` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `called_at` timestamp NULL DEFAULT NULL,
  `pinged_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`id`, `number`, `name`, `avatar`, `username`, `password`, `called_at`, `pinged_at`, `created_at`, `updated_at`) VALUES
(1, 1, 'DEVELOPMENT', 'no-avatar.jpg', 'admin', 'admin', NULL, NULL, '2023-02-19 07:36:32', '2023-04-24 13:46:24');

-- --------------------------------------------------------

--
-- Table structure for table `arrangements`
--

CREATE TABLE `arrangements` (
  `id` smallint(5) UNSIGNED NOT NULL,
  `event_id` smallint(5) UNSIGNED NOT NULL,
  `team_id` tinyint(3) UNSIGNED NOT NULL,
  `order` tinyint(3) UNSIGNED NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` tinyint(3) UNSIGNED NOT NULL,
  `competition_id` tinyint(3) UNSIGNED NOT NULL,
  `slug` varchar(32) NOT NULL,
  `title` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `competition_id`, `slug`, `title`, `created_at`, `updated_at`) VALUES
(1, 1, 'coronation-night', 'Coronation Night', '2023-04-19 11:13:11', '2023-04-24 08:58:03');

-- --------------------------------------------------------

--
-- Table structure for table `competitions`
--

CREATE TABLE `competitions` (
  `id` tinyint(3) UNSIGNED NOT NULL,
  `slug` varchar(32) NOT NULL,
  `title` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `competitions`
--

INSERT INTO `competitions` (`id`, `slug`, `title`, `created_at`, `updated_at`) VALUES
(1, 'msduran-nabua-2023', 'Miss Duran 2023', '2023-04-06 13:24:04', '2023-04-06 13:24:04');

-- --------------------------------------------------------

--
-- Table structure for table `criteria`
--

CREATE TABLE `criteria` (
  `id` smallint(5) UNSIGNED NOT NULL,
  `event_id` smallint(5) UNSIGNED NOT NULL,
  `title` varchar(255) NOT NULL,
  `percentage` float UNSIGNED NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `criteria`
--

INSERT INTO `criteria` (`id`, `event_id`, `title`, `percentage`, `created_at`, `updated_at`) VALUES
(1, 1, 'Mastery', 30, '2023-04-23 11:35:55', '2023-04-23 11:35:55'),
(2, 1, 'Poise and Carriage', 30, '2023-04-23 11:36:39', '2023-04-23 11:36:39'),
(3, 1, 'Stage Presence', 20, '2023-04-23 11:37:02', '2023-04-23 11:37:02'),
(4, 1, 'Overall Impact', 20, '2023-04-23 11:37:15', '2023-04-23 11:37:15'),
(5, 2, 'Stage Projection', 40, '2023-04-23 11:38:38', '2023-04-23 11:38:38'),
(6, 2, 'Figure', 30, '2023-04-23 11:38:57', '2023-04-23 11:38:57'),
(7, 2, 'Poise and Confidence', 30, '2023-04-23 11:39:12', '2023-04-23 11:39:12'),
(8, 3, 'Beauty of the Face', 30, '2023-04-23 11:39:34', '2023-04-23 11:39:34'),
(9, 3, 'Stage Presence', 30, '2023-04-23 11:39:55', '2023-04-23 11:39:55'),
(10, 3, 'Design and Fitting', 20, '2023-04-23 11:40:11', '2023-04-23 11:40:11'),
(11, 3, 'Overall Impact', 20, '2023-04-23 11:40:30', '2023-04-23 11:40:30'),
(12, 4, 'Beauty ', 50, '2023-04-23 11:40:48', '2023-04-23 11:40:48'),
(13, 4, 'Intelligence', 50, '2023-04-23 11:40:58', '2023-04-23 11:40:58'),
(14, 5, 'Beauty', 50, '2023-04-23 11:41:31', '2023-04-23 11:41:31'),
(15, 5, 'Intelligence', 50, '2023-04-23 11:42:17', '2023-04-23 11:42:17');

-- --------------------------------------------------------

--
-- Table structure for table `deductions`
--

CREATE TABLE `deductions` (
  `id` mediumint(8) UNSIGNED NOT NULL,
  `technical_id` tinyint(3) UNSIGNED NOT NULL,
  `event_id` smallint(5) UNSIGNED NOT NULL,
  `team_id` tinyint(3) UNSIGNED NOT NULL,
  `value` float UNSIGNED NOT NULL DEFAULT 0,
  `is_locked` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `eliminations`
--

CREATE TABLE `eliminations` (
  `id` mediumint(9) NOT NULL,
  `event_id` smallint(5) UNSIGNED NOT NULL,
  `team_id` tinyint(3) UNSIGNED NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `eliminations`
--

INSERT INTO `eliminations` (`id`, `event_id`, `team_id`, `created_at`, `updated_at`) VALUES
(1, 5, 1, '2023-04-24 08:10:50', '2023-04-24 08:10:50'),
(2, 5, 2, '2023-04-24 08:10:51', '2023-04-24 08:10:51'),
(3, 5, 3, '2023-04-24 08:10:52', '2023-04-24 08:10:52'),
(4, 5, 4, '2023-04-24 08:10:52', '2023-04-24 08:10:52'),
(5, 5, 5, '2023-04-24 08:10:54', '2023-04-24 08:10:54'),
(6, 5, 6, '2023-04-24 08:10:54', '2023-04-24 08:10:54'),
(7, 5, 7, '2023-04-24 08:10:55', '2023-04-24 08:10:55'),
(8, 5, 8, '2023-04-24 08:10:55', '2023-04-24 08:10:55'),
(9, 5, 9, '2023-04-24 08:10:56', '2023-04-24 08:10:56'),
(10, 5, 10, '2023-04-24 08:10:57', '2023-04-24 08:10:57'),
(11, 5, 11, '2023-04-24 08:10:58', '2023-04-24 08:10:58'),
(12, 5, 12, '2023-04-24 08:10:58', '2023-04-24 08:10:58'),
(13, 5, 13, '2023-04-24 08:10:59', '2023-04-24 08:10:59');

-- --------------------------------------------------------

--
-- Table structure for table `events`
--

CREATE TABLE `events` (
  `id` smallint(5) UNSIGNED NOT NULL,
  `category_id` tinyint(3) UNSIGNED NOT NULL,
  `slug` varchar(32) NOT NULL,
  `title` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `events`
--

INSERT INTO `events` (`id`, `category_id`, `slug`, `title`, `created_at`, `updated_at`) VALUES
(1, 1, 'production', 'Production ', '2023-04-23 08:49:16', '2023-04-24 08:56:26'),
(2, 1, 'swimsuit', 'Swimsuit ', '2023-04-23 08:49:43', '2023-04-24 08:56:00'),
(3, 1, 'long-gown', 'Long Gown', '2023-04-23 08:50:22', '2023-04-24 08:56:09'),
(4, 1, 'preliminary-qa', 'Preliminary Q & A', '2023-04-23 08:58:41', '2023-04-23 12:09:44'),
(5, 1, 'final-qa', 'Final Q & A', '2023-04-23 08:59:16', '2023-04-23 12:09:49');

-- --------------------------------------------------------

--
-- Table structure for table `judges`
--

CREATE TABLE `judges` (
  `id` tinyint(3) UNSIGNED NOT NULL,
  `number` tinyint(3) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `avatar` varchar(255) DEFAULT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `called_at` timestamp NULL DEFAULT NULL,
  `pinged_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `judges`
--

INSERT INTO `judges` (`id`, `number`, `name`, `avatar`, `username`, `password`, `called_at`, `pinged_at`, `created_at`, `updated_at`) VALUES
(1, 1, 'Judge 01', 'no-avatar.jpg', 'judge01', 'judge01', NULL, NULL, '2023-04-06 13:58:11', '2023-04-24 05:15:03'),
(2, 2, 'Judge 02', 'no-avatar.jpg', 'judge02', 'judge02', NULL, NULL, '2023-04-06 13:58:28', '2023-04-24 05:15:38'),
(3, 3, 'Judge 03', 'no-avatar.jpg', 'judge03', 'judge03', NULL, NULL, '2023-04-06 13:58:42', '2023-04-24 05:16:12'),
(4, 4, 'Judge 04', 'no-avatar.jpg', 'judge04', 'judge04', NULL, NULL, '2023-04-06 13:59:26', '2023-04-24 05:16:39'),
(5, 5, 'Judge 05', 'no-avatar.jpg', 'judge05', 'judge05', NULL, NULL, '2023-04-06 14:00:00', '2023-04-24 09:01:05'),
(6, 6, 'Judge 06', 'no-avatar.jpg', 'judge06', 'judge06', NULL, NULL, '2023-04-19 11:13:48', '2023-04-19 11:14:25'),
(7, 7, 'Judge 07', 'no-avatar.jpg', 'judge07', 'judge07', NULL, NULL, '2023-04-19 11:13:48', '2023-04-19 11:14:28');

-- --------------------------------------------------------

--
-- Table structure for table `judge_event`
--

CREATE TABLE `judge_event` (
  `id` tinyint(3) UNSIGNED NOT NULL,
  `judge_id` tinyint(3) UNSIGNED NOT NULL,
  `event_id` smallint(5) UNSIGNED NOT NULL,
  `is_chairman` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `judge_event`
--

INSERT INTO `judge_event` (`id`, `judge_id`, `event_id`, `is_chairman`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 0, '2023-04-23 14:43:05', '2023-04-23 14:43:05'),
(2, 1, 2, 0, '2023-04-23 14:43:08', '2023-04-23 14:43:08'),
(3, 1, 3, 0, '2023-04-23 14:43:12', '2023-04-23 14:43:12'),
(4, 1, 4, 0, '2023-04-23 14:43:36', '2023-04-23 14:43:36'),
(5, 1, 5, 0, '2023-04-23 14:43:50', '2023-04-23 14:43:50'),
(6, 2, 1, 0, '2023-04-23 14:43:54', '2023-04-23 14:43:54'),
(7, 2, 2, 0, '2023-04-23 14:43:57', '2023-04-23 14:43:57'),
(8, 2, 3, 0, '2023-04-23 14:44:00', '2023-04-23 14:44:00'),
(9, 2, 4, 0, '2023-04-23 14:44:03', '2023-04-23 14:44:03'),
(10, 2, 5, 0, '2023-04-23 14:44:05', '2023-04-23 14:44:05'),
(11, 3, 1, 0, '2023-04-23 14:44:10', '2023-04-23 14:44:10'),
(12, 3, 2, 0, '2023-04-23 14:44:13', '2023-04-23 14:44:13'),
(13, 3, 3, 0, '2023-04-23 14:44:15', '2023-04-23 14:44:15'),
(14, 3, 4, 0, '2023-04-23 14:44:18', '2023-04-23 14:44:18'),
(15, 3, 5, 0, '2023-04-23 14:44:20', '2023-04-23 14:44:20'),
(16, 4, 1, 0, '2023-04-23 14:44:26', '2023-04-23 14:44:26'),
(17, 4, 2, 0, '2023-04-23 14:44:29', '2023-04-23 14:44:29'),
(18, 4, 3, 0, '2023-04-23 14:44:31', '2023-04-23 14:44:31'),
(19, 4, 4, 0, '2023-04-23 14:44:33', '2023-04-23 14:44:33'),
(20, 4, 5, 0, '2023-04-23 14:44:36', '2023-04-23 14:44:36'),
(21, 5, 1, 0, '2023-04-23 15:16:24', '2023-04-23 15:16:24'),
(22, 5, 2, 0, '2023-04-23 15:16:26', '2023-04-23 15:16:26'),
(23, 5, 3, 0, '2023-04-23 15:16:29', '2023-04-23 15:16:29'),
(24, 5, 4, 0, '2023-04-23 15:16:32', '2023-04-23 15:16:32'),
(25, 5, 5, 0, '2023-04-23 15:16:35', '2023-04-23 15:16:35'),
(26, 6, 1, 0, '2023-04-24 13:44:43', '2023-04-24 13:44:43'),
(27, 6, 2, 0, '2023-04-24 13:44:45', '2023-04-24 13:44:45'),
(28, 6, 3, 0, '2023-04-24 13:44:49', '2023-04-24 13:44:49'),
(29, 6, 4, 0, '2023-04-24 13:44:51', '2023-04-24 13:44:51'),
(30, 6, 5, 0, '2023-04-24 13:44:53', '2023-04-24 13:44:53'),
(31, 7, 1, 0, '2023-04-24 13:45:00', '2023-04-24 13:45:00'),
(32, 7, 2, 0, '2023-04-24 13:45:02', '2023-04-24 13:45:02'),
(33, 7, 3, 0, '2023-04-24 13:45:05', '2023-04-24 13:45:05'),
(34, 7, 4, 0, '2023-04-24 13:45:07', '2023-04-24 13:45:07'),
(35, 7, 5, 0, '2023-04-24 13:45:09', '2023-04-24 13:45:09');

-- --------------------------------------------------------

--
-- Table structure for table `noshows`
--

CREATE TABLE `noshows` (
  `id` smallint(5) UNSIGNED NOT NULL,
  `event_id` smallint(5) UNSIGNED NOT NULL,
  `team_id` tinyint(3) UNSIGNED NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `participants`
--

CREATE TABLE `participants` (
  `id` smallint(5) UNSIGNED NOT NULL,
  `team_id` tinyint(3) UNSIGNED NOT NULL,
  `event_id` smallint(5) UNSIGNED NOT NULL,
  `number` smallint(5) UNSIGNED NOT NULL,
  `first_name` varchar(255) NOT NULL,
  `middle_name` varchar(255) DEFAULT NULL,
  `last_name` varchar(255) NOT NULL,
  `gender` enum('male','female') NOT NULL,
  `avatar` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `points`
--

CREATE TABLE `points` (
  `id` smallint(5) UNSIGNED NOT NULL,
  `event_id` smallint(5) UNSIGNED NOT NULL,
  `rank` tinyint(3) UNSIGNED NOT NULL,
  `value` float UNSIGNED NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `ratings`
--

CREATE TABLE `ratings` (
  `id` mediumint(8) UNSIGNED NOT NULL,
  `judge_id` tinyint(3) UNSIGNED NOT NULL,
  `criteria_id` smallint(5) UNSIGNED NOT NULL,
  `team_id` tinyint(3) UNSIGNED NOT NULL,
  `value` float UNSIGNED NOT NULL DEFAULT 0,
  `is_locked` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `teams`
--

CREATE TABLE `teams` (
  `id` tinyint(3) UNSIGNED NOT NULL,
  `number` tinyint(4) NOT NULL DEFAULT 0,
  `name` varchar(255) NOT NULL,
  `location` varchar(64) NOT NULL,
  `avatar` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `teams`
--

INSERT INTO `teams` (`id`, `number`, `name`, `location`, `avatar`, `created_at`, `updated_at`) VALUES
(1, 1, 'ELLAINE DIMANARIG', 'Santiago, Iriga City', '01-ellaine-dimaranig.jpg', '2023-04-19 11:31:48', '2023-04-19 11:31:48'),
(2, 2, 'KRISTEL OLIVE REJESUS', 'Ponso, Polangui, Albay', '02-kristel-olive-rejesus.jpg', '2023-04-19 11:31:48', '2023-04-19 11:31:48'),
(3, 3, 'MARY DINE MONGE', 'Sto Domingo, Iriga City', '03-mary-dine-monge.jpg', '2023-04-19 11:31:48', '2023-04-19 11:31:48'),
(4, 4, 'MIEN MIE EGIPTO', 'San Agustin, Iriga City', '04-mien-mie-egipto.jpg', '2023-04-19 11:31:48', '2023-04-19 11:31:48'),
(5, 5, 'TRISHA LOPEZ', 'San Pascual, Buhi', '05-trisha-lopez.jpg', '2023-04-19 11:31:48', '2023-04-19 11:31:48'),
(6, 6, 'BERNADETTE PANALIGAN', 'Palsong, Bula', '06-bernadette-panaligan.jpg', '2023-04-19 11:31:48', '2023-04-19 11:31:48'),
(7, 7, 'MARA MONTE', 'Sta. Justina, Buhi', '07-mara-monte.jpg', '2023-04-19 11:31:48', '2023-04-19 11:31:48'),
(8, 8, 'EURICKA LYN MORAÑA', 'San Vicente Gorong-Gorong, Nabua', '08-euricka-lyn-moraña.jpg', '2023-04-19 11:31:48', '2023-04-19 11:31:48'),
(9, 9, 'AGATHA KAYE OLAYON', 'Sto Domingo, Iriga City', '09-agatha-kaye-olayon.jpg', '2023-04-19 11:31:48', '2023-04-19 11:31:48'),
(10, 10, 'ANGELA SHERIZA TINO', 'Santiago, Bato', '10-angela-sheriza-tino.jpg', '2023-04-19 11:31:48', '2023-04-19 11:31:48'),
(11, 11, 'CRISTELLE MAY SERMONA', 'Sta. Cruz, Nabua', '11-cristelle-may-sermona.jpg', '2023-04-19 11:31:48', '2023-04-19 11:31:48'),
(12, 12, 'CHYNNA ALEXA ENIMEDEZ', 'Duran, Nabua', '12-chynna-alexa-enimedez.jpg', '2023-04-19 11:31:48', '2023-04-19 11:31:48'),
(13, 13, 'CLARISE PEREGRINO', 'San Antonio Ogbon, Nabua', '13-clarise-peregrino.jpg', '2023-04-19 11:31:48', '2023-04-19 11:31:48');

-- --------------------------------------------------------

--
-- Table structure for table `technicals`
--

CREATE TABLE `technicals` (
  `id` tinyint(3) UNSIGNED NOT NULL,
  `number` tinyint(3) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `avatar` varchar(255) DEFAULT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `called_at` timestamp NULL DEFAULT NULL,
  `pinged_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `technicals`
--

INSERT INTO `technicals` (`id`, `number`, `name`, `avatar`, `username`, `password`, `called_at`, `pinged_at`, `created_at`, `updated_at`) VALUES
(1, 1, 'Technical 01', 'no-avatar.jpg', 'technical01', 'technical01', NULL, NULL, '2023-02-19 08:58:58', '2023-04-06 14:00:12');

-- --------------------------------------------------------

--
-- Table structure for table `technical_event`
--

CREATE TABLE `technical_event` (
  `id` tinyint(3) UNSIGNED NOT NULL,
  `technical_id` tinyint(3) UNSIGNED NOT NULL,
  `event_id` smallint(5) UNSIGNED NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `titles`
--

CREATE TABLE `titles` (
  `id` smallint(5) UNSIGNED NOT NULL,
  `event_id` smallint(5) UNSIGNED NOT NULL,
  `rank` tinyint(3) UNSIGNED NOT NULL DEFAULT 1,
  `title` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `titles`
--

INSERT INTO `titles` (`id`, `event_id`, `rank`, `title`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 'Best in Production', '2023-04-23 14:41:12', '2023-04-24 08:58:58'),
(2, 1, 2, '', '2023-04-23 14:41:12', '2023-04-23 14:41:12'),
(3, 1, 3, '', '2023-04-23 14:41:12', '2023-04-23 14:41:12'),
(4, 1, 4, '', '2023-04-23 14:41:12', '2023-04-23 14:41:12'),
(5, 1, 5, '', '2023-04-23 14:41:12', '2023-04-23 14:41:12'),
(6, 1, 6, '', '2023-04-23 14:41:12', '2023-04-23 14:41:12'),
(7, 1, 7, '', '2023-04-23 14:41:12', '2023-04-23 14:41:12'),
(8, 1, 8, '', '2023-04-23 14:41:12', '2023-04-23 14:41:12'),
(9, 1, 9, '', '2023-04-23 14:41:12', '2023-04-23 14:41:12'),
(10, 1, 10, '', '2023-04-23 14:41:12', '2023-04-23 14:41:12'),
(11, 1, 11, '', '2023-04-23 14:41:12', '2023-04-23 14:41:12'),
(12, 1, 12, '', '2023-04-23 14:41:12', '2023-04-23 14:41:12'),
(13, 1, 13, '', '2023-04-23 14:41:12', '2023-04-23 14:41:12'),
(14, 2, 1, 'Best in Swimsuit ', '2023-04-23 14:41:12', '2023-04-24 08:55:18'),
(15, 2, 2, '', '2023-04-23 14:41:12', '2023-04-23 14:41:12'),
(16, 2, 3, '', '2023-04-23 14:41:12', '2023-04-23 14:41:12'),
(17, 2, 4, '', '2023-04-23 14:41:12', '2023-04-23 14:41:12'),
(18, 2, 5, '', '2023-04-23 14:41:12', '2023-04-23 14:41:12'),
(19, 2, 6, '', '2023-04-23 14:41:12', '2023-04-23 14:41:12'),
(20, 2, 7, '', '2023-04-23 14:41:12', '2023-04-23 14:41:12'),
(21, 2, 8, '', '2023-04-23 14:41:12', '2023-04-23 14:41:12'),
(22, 2, 9, '', '2023-04-23 14:41:12', '2023-04-23 14:41:12'),
(23, 2, 10, '', '2023-04-23 14:41:12', '2023-04-23 14:41:12'),
(24, 2, 11, '', '2023-04-23 14:41:12', '2023-04-23 14:41:12'),
(25, 2, 12, '', '2023-04-23 14:41:12', '2023-04-23 14:41:12'),
(26, 2, 13, '', '2023-04-23 14:41:12', '2023-04-23 14:41:12'),
(27, 3, 1, 'Best in Long Gown ', '2023-04-23 14:41:12', '2023-04-24 08:55:10'),
(28, 3, 2, '', '2023-04-23 14:41:12', '2023-04-23 14:41:12'),
(29, 3, 3, '', '2023-04-23 14:41:12', '2023-04-23 14:41:12'),
(30, 3, 4, '', '2023-04-23 14:41:12', '2023-04-23 14:41:12'),
(31, 3, 5, '', '2023-04-23 14:41:12', '2023-04-23 14:41:12'),
(32, 3, 6, '', '2023-04-23 14:41:12', '2023-04-23 14:41:12'),
(33, 3, 7, '', '2023-04-23 14:41:12', '2023-04-23 14:41:12'),
(34, 3, 8, '', '2023-04-23 14:41:12', '2023-04-23 14:41:12'),
(35, 3, 9, '', '2023-04-23 14:41:12', '2023-04-23 14:41:12'),
(36, 3, 10, '', '2023-04-23 14:41:12', '2023-04-23 14:41:12'),
(37, 3, 11, '', '2023-04-23 14:41:12', '2023-04-23 14:41:12'),
(38, 3, 12, '', '2023-04-23 14:41:12', '2023-04-23 14:41:12'),
(39, 3, 13, '', '2023-04-23 14:41:12', '2023-04-23 14:41:12'),
(40, 4, 1, '', '2023-04-23 14:41:12', '2023-04-24 08:53:04'),
(41, 4, 2, '', '2023-04-23 14:41:12', '2023-04-23 14:41:12'),
(42, 4, 3, '', '2023-04-23 14:41:12', '2023-04-23 14:41:12'),
(43, 4, 4, '', '2023-04-23 14:41:12', '2023-04-23 14:41:12'),
(44, 4, 5, '', '2023-04-23 14:41:12', '2023-04-23 14:41:12'),
(45, 4, 6, '', '2023-04-23 14:41:12', '2023-04-23 14:41:12'),
(46, 4, 7, '', '2023-04-23 14:41:12', '2023-04-23 14:41:12'),
(47, 4, 8, '', '2023-04-23 14:41:12', '2023-04-23 14:41:12'),
(48, 4, 9, '', '2023-04-23 14:41:12', '2023-04-23 14:41:12'),
(49, 4, 10, '', '2023-04-23 14:41:12', '2023-04-23 14:41:12'),
(50, 4, 11, '', '2023-04-23 14:41:12', '2023-04-23 14:41:12'),
(51, 4, 12, '', '2023-04-23 14:41:12', '2023-04-23 14:41:12'),
(52, 4, 13, '', '2023-04-23 14:41:12', '2023-04-23 14:41:12'),
(53, 5, 1, 'Miss Duran 2023', '2023-04-23 14:41:12', '2023-04-23 15:45:53'),
(54, 5, 2, 'Miss Lawig Duran', '2023-04-23 14:41:12', '2023-04-23 15:46:07'),
(55, 5, 3, 'Miss Duran Tourism', '2023-04-23 14:41:12', '2023-04-23 15:46:17'),
(56, 5, 4, '1st Runner Up', '2023-04-23 14:41:12', '2023-04-23 15:46:27'),
(57, 5, 5, '2nd Runner Up', '2023-04-23 14:41:12', '2023-04-23 15:46:30'),
(58, 5, 6, '', '2023-04-23 14:41:12', '2023-04-23 14:41:12'),
(59, 5, 7, '', '2023-04-23 14:41:12', '2023-04-23 14:41:12'),
(60, 5, 8, '', '2023-04-23 14:41:12', '2023-04-23 14:41:12'),
(61, 5, 9, '', '2023-04-23 14:41:12', '2023-04-23 14:41:12'),
(62, 5, 10, '', '2023-04-23 14:41:12', '2023-04-23 14:41:12'),
(63, 5, 11, '', '2023-04-23 14:41:12', '2023-04-23 14:41:12'),
(64, 5, 12, '', '2023-04-23 14:41:12', '2023-04-23 14:41:12'),
(65, 5, 13, '', '2023-04-23 14:41:12', '2023-04-23 14:41:12');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `arrangements`
--
ALTER TABLE `arrangements`
  ADD PRIMARY KEY (`id`),
  ADD KEY `event_id` (`event_id`),
  ADD KEY `team_id` (`team_id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`),
  ADD KEY `competition_id` (`competition_id`);

--
-- Indexes for table `competitions`
--
ALTER TABLE `competitions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `criteria`
--
ALTER TABLE `criteria`
  ADD PRIMARY KEY (`id`),
  ADD KEY `event_id` (`event_id`);

--
-- Indexes for table `deductions`
--
ALTER TABLE `deductions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `judge_id` (`technical_id`),
  ADD KEY `team_id` (`team_id`),
  ADD KEY `event_id` (`event_id`);

--
-- Indexes for table `eliminations`
--
ALTER TABLE `eliminations`
  ADD PRIMARY KEY (`id`),
  ADD KEY `event_id` (`event_id`),
  ADD KEY `team_id` (`team_id`);

--
-- Indexes for table `events`
--
ALTER TABLE `events`
  ADD PRIMARY KEY (`id`),
  ADD KEY `area_id` (`category_id`);

--
-- Indexes for table `judges`
--
ALTER TABLE `judges`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `judge_event`
--
ALTER TABLE `judge_event`
  ADD PRIMARY KEY (`id`),
  ADD KEY `judge_id` (`judge_id`),
  ADD KEY `event_id` (`event_id`);

--
-- Indexes for table `noshows`
--
ALTER TABLE `noshows`
  ADD PRIMARY KEY (`id`),
  ADD KEY `event_id` (`event_id`),
  ADD KEY `team_id` (`team_id`);

--
-- Indexes for table `participants`
--
ALTER TABLE `participants`
  ADD PRIMARY KEY (`id`),
  ADD KEY `team_id` (`team_id`),
  ADD KEY `event_id` (`event_id`);

--
-- Indexes for table `points`
--
ALTER TABLE `points`
  ADD PRIMARY KEY (`id`),
  ADD KEY `event_id` (`event_id`);

--
-- Indexes for table `ratings`
--
ALTER TABLE `ratings`
  ADD PRIMARY KEY (`id`),
  ADD KEY `judge_id` (`judge_id`),
  ADD KEY `team_id` (`team_id`),
  ADD KEY `criteria_id` (`criteria_id`);

--
-- Indexes for table `teams`
--
ALTER TABLE `teams`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `technicals`
--
ALTER TABLE `technicals`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `technical_event`
--
ALTER TABLE `technical_event`
  ADD PRIMARY KEY (`id`),
  ADD KEY `judge_id` (`technical_id`),
  ADD KEY `event_id` (`event_id`);

--
-- Indexes for table `titles`
--
ALTER TABLE `titles`
  ADD PRIMARY KEY (`id`),
  ADD KEY `event_id` (`event_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admins`
--
ALTER TABLE `admins`
  MODIFY `id` tinyint(3) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `arrangements`
--
ALTER TABLE `arrangements`
  MODIFY `id` smallint(5) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` tinyint(3) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `competitions`
--
ALTER TABLE `competitions`
  MODIFY `id` tinyint(3) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `criteria`
--
ALTER TABLE `criteria`
  MODIFY `id` smallint(5) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `deductions`
--
ALTER TABLE `deductions`
  MODIFY `id` mediumint(8) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `eliminations`
--
ALTER TABLE `eliminations`
  MODIFY `id` mediumint(9) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `events`
--
ALTER TABLE `events`
  MODIFY `id` smallint(5) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `judges`
--
ALTER TABLE `judges`
  MODIFY `id` tinyint(3) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `judge_event`
--
ALTER TABLE `judge_event`
  MODIFY `id` tinyint(3) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT for table `noshows`
--
ALTER TABLE `noshows`
  MODIFY `id` smallint(5) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `participants`
--
ALTER TABLE `participants`
  MODIFY `id` smallint(5) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `points`
--
ALTER TABLE `points`
  MODIFY `id` smallint(5) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `ratings`
--
ALTER TABLE `ratings`
  MODIFY `id` mediumint(8) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `teams`
--
ALTER TABLE `teams`
  MODIFY `id` tinyint(3) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `technicals`
--
ALTER TABLE `technicals`
  MODIFY `id` tinyint(3) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `technical_event`
--
ALTER TABLE `technical_event`
  MODIFY `id` tinyint(3) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `titles`
--
ALTER TABLE `titles`
  MODIFY `id` smallint(5) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=79;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `arrangements`
--
ALTER TABLE `arrangements`
  ADD CONSTRAINT `arrangements_ibfk_1` FOREIGN KEY (`team_id`) REFERENCES `teams` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `arrangements_ibfk_2` FOREIGN KEY (`event_id`) REFERENCES `events` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `categories`
--
ALTER TABLE `categories`
  ADD CONSTRAINT `categories_ibfk_1` FOREIGN KEY (`competition_id`) REFERENCES `competitions` (`id`) ON UPDATE CASCADE;

--
-- Constraints for table `criteria`
--
ALTER TABLE `criteria`
  ADD CONSTRAINT `criteria_ibfk_1` FOREIGN KEY (`event_id`) REFERENCES `events` (`id`) ON UPDATE CASCADE;

--
-- Constraints for table `deductions`
--
ALTER TABLE `deductions`
  ADD CONSTRAINT `deductions_ibfk_1` FOREIGN KEY (`event_id`) REFERENCES `events` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `deductions_ibfk_2` FOREIGN KEY (`team_id`) REFERENCES `teams` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `deductions_ibfk_3` FOREIGN KEY (`technical_id`) REFERENCES `technicals` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `eliminations`
--
ALTER TABLE `eliminations`
  ADD CONSTRAINT `eliminations_ibfk_1` FOREIGN KEY (`event_id`) REFERENCES `events` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `eliminations_ibfk_2` FOREIGN KEY (`team_id`) REFERENCES `teams` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `events`
--
ALTER TABLE `events`
  ADD CONSTRAINT `events_ibfk_1` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON UPDATE CASCADE;

--
-- Constraints for table `judge_event`
--
ALTER TABLE `judge_event`
  ADD CONSTRAINT `judge_event_ibfk_1` FOREIGN KEY (`judge_id`) REFERENCES `judges` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `judge_event_ibfk_2` FOREIGN KEY (`event_id`) REFERENCES `events` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `noshows`
--
ALTER TABLE `noshows`
  ADD CONSTRAINT `noshows_ibfk_1` FOREIGN KEY (`event_id`) REFERENCES `events` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `noshows_ibfk_2` FOREIGN KEY (`team_id`) REFERENCES `teams` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `participants`
--
ALTER TABLE `participants`
  ADD CONSTRAINT `participants_ibfk_1` FOREIGN KEY (`team_id`) REFERENCES `teams` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `participants_ibfk_2` FOREIGN KEY (`event_id`) REFERENCES `events` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `points`
--
ALTER TABLE `points`
  ADD CONSTRAINT `points_ibfk_1` FOREIGN KEY (`event_id`) REFERENCES `events` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `ratings`
--
ALTER TABLE `ratings`
  ADD CONSTRAINT `ratings_ibfk_1` FOREIGN KEY (`criteria_id`) REFERENCES `criteria` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `ratings_ibfk_2` FOREIGN KEY (`team_id`) REFERENCES `teams` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `ratings_ibfk_3` FOREIGN KEY (`judge_id`) REFERENCES `judges` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `technical_event`
--
ALTER TABLE `technical_event`
  ADD CONSTRAINT `technical_event_ibfk_2` FOREIGN KEY (`technical_id`) REFERENCES `technicals` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `technical_event_ibfk_3` FOREIGN KEY (`event_id`) REFERENCES `events` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `titles`
--
ALTER TABLE `titles`
  ADD CONSTRAINT `titles_ibfk_1` FOREIGN KEY (`event_id`) REFERENCES `events` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
