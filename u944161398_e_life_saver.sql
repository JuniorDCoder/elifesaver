-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Aug 10, 2023 at 08:45 AM
-- Server version: 10.5.19-MariaDB-cll-lve
-- PHP Version: 7.2.34

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `u944161398_e_life_saver`
--

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

CREATE TABLE `admins` (
  `id` int(11) NOT NULL,
  `admin_name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(256) NOT NULL,
  `last_login` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`id`, `admin_name`, `email`, `password`, `last_login`) VALUES
(1, 'Junior DCoder', 'dcoder@gmail.com', '$2y$10$OfQs130jnpf/r1T6svtqG.IqnXgBetfglUIpS03qFrCNJE/7wIjTS', '2023-08-05 14:00:27');

-- --------------------------------------------------------

--
-- Table structure for table `blood`
--

CREATE TABLE `blood` (
  `blood_id` int(12) NOT NULL,
  `blood_type` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `blood`
--

INSERT INTO `blood` (`blood_id`, `blood_type`) VALUES
(1, 'A+'),
(2, 'A-'),
(3, 'B+'),
(4, 'B-'),
(5, 'AB+'),
(6, 'AB-'),
(7, 'O+'),
(8, 'O-');

-- --------------------------------------------------------

--
-- Table structure for table `blood_appeals`
--

CREATE TABLE `blood_appeals` (
  `appeal_id` int(11) NOT NULL,
  `patient_id` int(11) DEFAULT NULL,
  `donor_id` int(11) DEFAULT NULL,
  `number_of_bags` int(11) NOT NULL,
  `blood_group` enum('A+','A-','B+','B-','AB+','AB-','O+','O-') NOT NULL,
  `health_facility` varchar(256) NOT NULL,
  `medical_info` varchar(6000) DEFAULT NULL,
  `creation_date` datetime DEFAULT NULL,
  `status` enum('pending','accepted') NOT NULL DEFAULT 'pending'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `blood_appeals`
--

INSERT INTO `blood_appeals` (`appeal_id`, `patient_id`, `donor_id`, `number_of_bags`, `blood_group`, `health_facility`, `medical_info`, `creation_date`, `status`) VALUES
(1, 4, NULL, 2, 'AB+', 'Nkwen Baptist Hostpital(Bingo annex)', 'Diabetic\r\nAsthmatic\r\nAllergies ', '2023-07-26 12:17:22', 'pending'),
(2, 11, NULL, 2, 'A+', 'Bamenda ', '', '2023-07-26 17:24:42', 'pending'),
(3, 4, NULL, 2, 'A+', 'Bamenda regional hospital ', 'fever\n', '2023-07-26 19:02:38', 'pending'),
(4, 4, NULL, 2, 'A+', '', '', '2023-07-26 19:04:30', 'pending'),
(5, 4, NULL, 2, 'A+', '', '', '2023-07-26 19:10:45', 'pending'),
(6, NULL, 37, 2, 'A+', '', '', '2023-07-26 19:39:23', 'pending'),
(7, 11, NULL, 2, 'A+', '', '', '2023-07-27 20:59:09', 'pending'),
(8, NULL, 30, 2, 'A+', '', '', '2023-07-28 18:25:00', 'pending'),
(9, NULL, 37, 3, 'AB+', 'Nkwen Baptist Hostpital(Bingo annex)', '', '2023-07-28 18:37:56', 'pending'),
(10, 10, NULL, 1, 'AB+', 'Nkwen Baptist Hostpital(Bingo annex)', 'Diabetes', '2023-07-29 15:34:52', 'pending'),
(11, 11, NULL, 2, 'A+', 'mbingo ', 'fever\n', '2023-07-29 19:08:31', 'pending'),
(12, 4, NULL, 2, 'A+', 'Shalom hospital ', 'constipation ', '2023-07-29 19:44:39', 'pending'),
(19, 4, NULL, 2, 'A+', 'Bambui district hospital ', 'malaria\n', '2023-07-30 14:31:28', 'pending'),
(20, 11, NULL, 2, 'A+', 'bamenda regional hospital ', 'anaemia\n', '2023-07-30 18:35:44', 'pending'),
(21, NULL, 37, 2, 'A+', '', '', '2023-07-30 19:10:22', 'pending'),
(22, NULL, 50, 2, '', 'Nkwen Baptist Hostpital(Bingo annex)', 'j', '2023-07-30 19:39:08', 'pending'),
(23, 10, NULL, 2, 'A+', 'Nkwen Baptist Hostpital(Bingo annex)', 'now sick', '2023-07-30 19:41:24', 'pending'),
(24, 4, NULL, 5, 'B+', 'Nkwen Baptist Hostpital(Bingo annex)', '', '2023-07-30 19:42:55', 'pending'),
(25, 4, NULL, 1, 'AB+', 'Nkwen Baptist Hostpital(Bingo annex)', 'None', '2023-07-30 20:32:08', 'pending'),
(26, NULL, 37, 2, 'A+', 'mbingo anex', 'anaemia\n', '2023-07-31 18:20:40', 'pending'),
(27, 12, NULL, 2, 'A+', 'Nkwen Baptist Hostpital(Bingo annex)', 'Medical info', '2023-07-31 21:11:33', 'pending'),
(28, NULL, 12, 3, 'A+', 'Bamenda Regional Hospital', '', '2023-08-01 00:24:53', 'pending'),
(29, NULL, 12, 2, 'A+', 'mbingo anex ', 'anaemia ', '2023-08-01 08:11:08', 'pending'),
(30, NULL, 12, 2, 'O-', 'mbingo ', '', '2023-08-01 08:13:22', 'pending'),
(31, NULL, 12, 2, 'O-', 'Bamenda regional hospital ', '', '2023-08-01 09:23:39', 'pending'),
(32, 10, NULL, 2, 'A+', 'unib', 'how far', '2023-08-01 09:39:41', 'pending'),
(33, 10, NULL, 2, 'A+', 'unib', 'how far', '2023-08-01 09:39:44', 'pending'),
(34, 11, NULL, 2, 'A+', '', '\n', '2023-08-03 16:10:36', 'pending'),
(35, 11, NULL, 2, 'A+', '', 'fever', '2023-08-03 16:13:01', 'pending'),
(36, 11, NULL, 2, 'A+', '', '', '2023-08-03 16:14:39', 'pending'),
(37, NULL, 37, 2, 'A+', 'mbingo anex ', 'anaemia ', '2023-08-04 18:16:38', 'pending'),
(41, NULL, 12, 2, 'B+', 'Nkwen Baptist Hostpital(Bingo annex)', 'Med', '2023-08-05 09:17:33', 'pending'),
(42, 13, NULL, 2, 'O+', 'Nkwen Baptist Hostpital(Bingo annex)', 'None', '2023-08-05 09:27:39', 'pending'),
(43, 13, NULL, 2, 'O+', 'Nkwen Baptist Hostpital(Bingo annex)', 'None', '2023-08-05 09:27:46', 'pending'),
(44, 14, NULL, 1, 'O+', 'Bamenda Regional Hospital', 'Dialysis ', '2023-08-05 10:29:42', 'pending'),
(45, 15, NULL, 3, 'O-', 'Nkwen Baptist Hostpital(Bingo annex)', 'Patient on dialysis ', '2023-08-05 14:27:06', 'pending'),
(46, 4, NULL, 3, 'O+', 'Nkwen Baptist Hostpital(Bingo annex)', 'Allergies', '2023-08-09 15:12:33', 'pending'),
(47, 11, NULL, 2, 'A+', '', '', '2023-08-09 21:43:17', 'pending'),
(48, 11, NULL, 2, 'A+', 'Nkwen Baptist Hostpital(Bingo annex)', '', '2023-08-09 21:48:21', 'pending');

--
-- Triggers `blood_appeals`
--
DELIMITER $$
CREATE TRIGGER `blood_appeals_creation_date_trigger` BEFORE INSERT ON `blood_appeals` FOR EACH ROW SET NEW.creation_date = DATE_ADD(NOW(), INTERVAL 1 HOUR)
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `blood_bank`
--

CREATE TABLE `blood_bank` (
  `blood_bank_id` int(20) NOT NULL,
  `blood_type` enum('A+','A-','B+','B-','AB+','AB-','O+','O-') NOT NULL,
  `bts_number` varchar(20) NOT NULL,
  `date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `blood_bank`
--

INSERT INTO `blood_bank` (`blood_bank_id`, `blood_type`, `bts_number`, `date`) VALUES
(1, 'A+', 'Ba232502', '2023-07-26'),
(2, 'A-', 'Ba230509', '2023-07-26'),
(1, 'A-', 'Ba232502', '2023-07-26'),
(1, 'A+', 'Ba232502', '2023-07-02');

-- --------------------------------------------------------

--
-- Table structure for table `credit`
--

CREATE TABLE `credit` (
  `credit_id` int(18) NOT NULL,
  `bts_number` varchar(18) NOT NULL,
  `donation_no` int(12) NOT NULL,
  `credit` int(18) NOT NULL,
  `id` int(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `credit`
--

INSERT INTO `credit` (`credit_id`, `bts_number`, `donation_no`, `credit`, `id`) VALUES
(1, 'Ba232805', 1, 100, 1),
(2, 'Ba232805', 2, 2000, 37);

-- --------------------------------------------------------

--
-- Table structure for table `doctors`
--

CREATE TABLE `doctors` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone` varchar(20) NOT NULL,
  `health_facility_id` int(11) NOT NULL,
  `last_login` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `donation_status`
--

CREATE TABLE `donation_status` (
  `donation_statuss_id` int(12) NOT NULL,
  `bts_number` varchar(20) NOT NULL,
  `date` date NOT NULL DEFAULT current_timestamp(),
  `location` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `donors`
--

CREATE TABLE `donors` (
  `id` int(11) NOT NULL,
  `donor_name` varchar(255) NOT NULL,
  `gender` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone` varchar(20) NOT NULL,
  `address` varchar(255) NOT NULL,
  `city` varchar(255) NOT NULL,
  `blood_group` enum('A+','A-','B+','B-','AB+','AB-','O+','O-') NOT NULL,
  `last_donation_date` date DEFAULT NULL,
  `registration_token` varchar(64) NOT NULL,
  `bts_number` varchar(255) NOT NULL,
  `last_login` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `donors`
--

INSERT INTO `donors` (`id`, `donor_name`, `gender`, `password`, `email`, `phone`, `address`, `city`, `blood_group`, `last_donation_date`, `registration_token`, `bts_number`, `last_login`) VALUES
(12, 'Junior', 'male', '$2y$10$EP/zHFxlPFQ/U/vrg93Zj.TiJliDB1b5vk1BCLy1vpyvq6nqGgQUq', 'juniorngu84@gmail.com', '+237677802114', 'Baforkum', 'Bambili', 'O-', NULL, '', 'Ba230509', '2023-08-10'),
(13, 'Edrick', 'male', '$2y$10$UzWpOk1XdQJzGAl4C1fUkutQMMIJvS.s97zviWtVSz3fgYyyK3YvO', 'deman@gmail.com', '237677802114', 'Mile 9', 'Bambili', 'A-', NULL, '', 'Ba235747', '2023-07-26'),
(28, 'Syn', 'female', '$2y$10$HSscsahEBJzkW9r8Q4Sp2uskBFnERFpy5EjjO4/9GCyz9bws6AqlC', 'syn@gail.com', '+237677802114', 'asdasd', 'asdas', 'A+', NULL, '', 'Ba232835', '2023-07-25'),
(29, 'Syntyche', 'male', '$2y$10$srYwseYDBWgw/frxwfhzwu9unPERje8vOZRXINMuFLnWJwdkFd5jW', 'syn@mail.com', '+237677802114', 'Baforkum', 'qweq', 'O-', NULL, '', 'Ba233522', '2023-07-25'),
(30, 'donor', 'female', '$2y$10$ZMrzBBM5ks1npmGuPNfn9OT4gAmmM432TgzLcYkX3G7sD8t1zW1iK', 'donor@gmail.com', '672269760', 'cameroon', 'bamenda', 'A+', NULL, '', 'Ba232502', '2023-08-01'),
(32, 'edrick ', 'Female', '$2y$10$MctAB4rASIvYhFbLwTca8.Txnd9en9y9pNNu93lkLny1w1mUoefU.', 'edrick08@gmail.com ', '680692014', 'Bamenda ', 'bili', 'B+', NULL, '', 'Ba235245', '2023-07-25'),
(33, 'Loui', 'male', '$2y$10$mlLkGbNTwhOU9PzJsO.St.vGbLITyfHTxcE2FdysvQ8OVUV760iQy', 'loui@gmail.com', '+237677802114', 'asfasf', 'qweq', 'A-', NULL, '', 'Ba235807', '2023-07-25'),
(34, 'qwertyui', 'female', '$2y$10$/Aba9DA2vQgvp0MrGajSoOCScOiR2jttyEkPepz9En9M7P365bzjq', 'ghjk@sdfg.com', '12345678', 'cvb', 'qwert', 'O-', NULL, '', 'Ba230555', '2023-07-25'),
(35, 'Deman ', 'Female', '$2y$10$7VhWovW1uA/9czkrY836KeGL3gAm7H2b5LBkz1f28YKxR0VvJoyfO', 'demn@gmail.com', '680692014', 'bamenda ', 'bambili ', 'AB+', NULL, '', 'Ba230745', '2023-07-25'),
(36, 'demand', 'Male', '$2y$10$mVtlulYNnngpRNjXvYX/pOkTrItJ16OU9QjXQ7zKb3WcZ61/QriwC', 'sem@gmail.com', '680692014', 'bamenda ', 'bili', 'O+', NULL, '', 'Ba232330', '2023-07-25'),
(37, 'Edrick Deman', 'Male', '$2y$10$LnINxfZOtSIE0a13ANOJ3.Vw6fwwWnI53s6iyoGEGieKSeNliFcce', 'dema@gmail.com', '237680692014', 'Bamenda', 'bambili Cameroon ', 'AB+', NULL, '', 'Ba232805', '2023-08-09'),
(38, 'Yo', 'female', '$2y$10$.6Q8efjVGHWmMSkJvMeGL.FPx1dpV.3bd9PDq9v5fLCgvUfK91Jz2', 'yo@gmail.com', '237677802114', 'Baforkum', 'Bambili', 'O-', NULL, '', 'Ba233516', '2023-07-27'),
(45, 'Ndeni Judith', 'female', '$2y$10$2wXSzNUYrnm4mHmz9EMJkON63kHSz892Ed0W0bM1qdEaHOdDVGrv.', 'judith@gmail.com', '+237677802114', 'Baforkum', 'Bambili', 'A-', NULL, '18007e5426029092e5e6e89a7eb5f5e7944ef5d4b646b1b7f7a1ca7ee494cb2b', 'Ba232153', '2023-07-31'),
(46, 'Chi Karl Junior', 'male', '$2y$10$zO4fbLDbJzTHiCdLR2Nv/eAwAUo4oHis.CrSA8ZtpQ/45VURdB0kK', 'jkarl730@gmail.com', '+237672734872', 'Bamenda, Cameroon', 'Bamenda', 'A+', NULL, '1afd86ad66d7e0cec468151c125a4473c43002594c2c51af4641925a4701f231', 'Ba235718', '2023-08-06'),
(47, 'Rahimatou', 'female', '$2y$10$rWJnMI8/lreKm5flzW6AF.XTAWPDuQ3D6SOL0ssKi01A3VqXsIwcu', 'rahimatou@gmail.com', '673045071', 'Nkwen', 'Bda', '', NULL, '91515082044d665acd55d5e16210687d26799c5cd45ffc62fe5888814e184a93', 'Ba231455', '2023-07-30'),
(48, 'Rahimatou', 'female', '$2y$10$WvrYZ77llbXxZyy73B5k8.rldsralI2tZrXF62wjFxFBw9IEY7L5a', 'rahimatou@gmail.com', '673045071', 'Nkwen', 'Bda', '', NULL, '4b33b6eb3718c5ac2814ba4530f15e7cea8ab9c1df6db054a7a78aa22a576a5b', 'Ba231455', '2023-07-30'),
(49, 'Edrick', 'Male', '$2y$10$TvxFyVrjCo81Jvy24POM3Ok1JVfEozOgAMvkLCUEgPCjlkZ/Nje/G', 'decoder@gmail.com', '680692014', 'bamenda Cameroon ', 'bambili ', 'O+', NULL, 'd310cdf19d479a8a1072703d9a1ef586ed1d3e2b5075ce5c26b1a7d28bffae21', 'Ba234012', '2023-07-30'),
(50, 'chi Karl ', 'female', '$2y$10$.rN4St3yy88Bupv9lnGpmOwQE8oRS9tur51C/1WBioCpDn446xtUe', 'donor2@gmail.com', '5641863', 'cbvnbm', 'dgfhgjhkl', 'A+', NULL, '2a5d3a8e8400d9ee88a8a6d5896c5d1aaf929cc03ccbe908bf37035120e29465', 'Ba232808', '2023-08-09'),
(51, 'Simon njoya', 'male', '$2y$10$MXqBAw0.8Nl1b6ETLOHBNOglN6gN.639b.S23umo5y19RMpexE4xe', 'njoya@gmail.com', '672269760', 'Address', 'Bamenda ', 'O-', NULL, '835b5a1b149c780ae3abe9380f6b5a6bf3b37d462f59d05f63ec71f4d54c53cb', 'Ba230508', '2023-08-05'),
(52, 'Lem Meklia', 'female', '$2y$10$zLlwDRgNDxtoQpzb4/jIJ.h3pptdNmQnwHQJ0uVghAkLy.G7pUd0u', 'lemmeklia88@gmail.com', '654140260', 'Mile 3 Nkwen', 'Bamenda', '', NULL, '3b1d54449c71f52a8c0ba709b7806887fa86bd9f590811c122bcd33291a6e310', 'Ba234029', '2023-08-05'),
(53, 'Simon ', 'male', '$2y$10$rMcm61l3ytpZAtPX9AUsnuSAGoc2PUJA5bBnRkKoIoYtA.NsEFcKu', 'simon.njoya.m@gmail.com', '674628373', 'Nkwen ', 'Bamenda ', 'O-', NULL, '001e8cc289198a2daf0f3ea9796678641b0ab819c621102d44652e1dbe244199', 'Ba233208', '2023-08-05');

-- --------------------------------------------------------

--
-- Table structure for table `health_facilities`
--

CREATE TABLE `health_facilities` (
  `health_facility_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `city` varchar(12) NOT NULL,
  `address` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `health_facilities`
--

INSERT INTO `health_facilities` (`health_facility_id`, `name`, `city`, `address`) VALUES
(1, 'Bamenda Regional Hospital', '', 'Hospital round about'),
(2, 'Nkwen Baptist Hostpital(Bingo annex)', '', 'finance juntion, nkwen');

-- --------------------------------------------------------

--
-- Table structure for table `inventory`
--

CREATE TABLE `inventory` (
  `id` int(11) NOT NULL,
  `health_facility_id` int(11) NOT NULL,
  `item_name` varchar(255) NOT NULL,
  `quantity` int(11) NOT NULL,
  `expiration_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `lab_results`
--

CREATE TABLE `lab_results` (
  `id` int(11) NOT NULL,
  `donor_id` int(11) NOT NULL,
  `test_type` varchar(255) NOT NULL,
  `result_value` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `notifications`
--

CREATE TABLE `notifications` (
  `id` int(11) NOT NULL,
  `message` text NOT NULL,
  `recipient_type` enum('patient','donor','nurse','admin') NOT NULL,
  `recipient_id` int(11) NOT NULL,
  `timestamp` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `patients`
--

CREATE TABLE `patients` (
  `id` int(11) NOT NULL,
  `patient_name` varchar(255) NOT NULL,
  `gender` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone` varchar(20) NOT NULL,
  `city` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL,
  `blood_group` enum('A+','A-','B+','B-','AB+','AB-','O+','O-') DEFAULT NULL,
  `last_login` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `patients`
--

INSERT INTO `patients` (`id`, `patient_name`, `gender`, `password`, `email`, `phone`, `city`, `address`, `blood_group`, `last_login`) VALUES
(4, 'UniB', 'male', '$2y$10$n5HYSj6wSs9t77TNpjh2Xekj8QayUz.hL6YwExWjykJSfVrWfXkFS', 'unib@gmail.com', '677802114', '', '', NULL, '2023-08-10 08:33:36'),
(5, 'Nsom Emmanuel ', 'male', '$2y$10$Ubs9wO.OriaBthgW6GGY3u7yXdI/jCgo.vGIaY9toV4LZmHbMU.1m', 'emmanuel4unib@gmail.com', '672269760', '', '', NULL, '2023-07-29 22:51:40'),
(6, 'Syntyche Demgne', 'female', '$2y$10$NSSW6Ok1syz8WVTLCruHV.WRe8GDKgev6zAXGzz3Gmf3/fyUCH/ti', 'syntyche@gmail.com', '+237677802114', '', '', NULL, '2023-07-25 10:12:31'),
(7, 'Edrick', 'female', '$2y$10$.zRQobjfCXANIdlGyKzjA.hWcqNFaAMMThZy8pLcNpvzYUCfs8wUq', 'edrickn08@gmail.com', '680692014', '', '', NULL, '2023-07-25 10:32:46'),
(8, 'Edrick Deman', 'female', '$2y$10$1TCWFtvwT0odL9I3633Qw.f7Lcn0a145B71emXcLPwAPYIgMXasbW', 'edrikn08@gmail.com', '680692014', '', '', NULL, '2023-07-25 10:24:30'),
(9, 'don', 'N/A', '$2y$10$l.GARu3jQMO.4m/YRvKkXOH58Qul4.GYwgDM5lUWIXGElzw.aAa9m', 'don@gmail.com', '680692014', '', '', NULL, '2023-07-25 22:25:16'),
(10, 'patient', 'male', '$2y$10$H.WdKHny28SriGd8i123Puj/5XVJZDj8x4kDLIyBozbYrMVQyFLTy', 'patient@gmail.com', '56451', '', '', NULL, '2023-08-10 08:31:07'),
(11, 'edrick', 'male', '$2y$10$8/SBUzIkiYkKPZoBXG.U5OKmxzgAMP3lfh4Wkzol0zoVcJxpKB90S', 'deman@gmail.com', '680692014', '', '', NULL, '2023-08-09 20:24:12'),
(12, 'Patient two', 'male', '$2y$10$bILG/7h1ymdcTzm7fZht8.GgQUxUiSiKhmIl7KxUkzTxV/qzRIBRK', 'patient2@gmail.com', '', '', '', NULL, '2023-08-05 03:31:33'),
(13, 'Moffor Blessing', 'female', '$2y$10$c8/QLNDKzrMlAi7aOhJkwuvE05aG.hkNrEknmkIdh3I4BjDPSuVnK', 'blessing@gmail.com', '+237677802114', '', '', NULL, '2023-08-05 08:27:04'),
(14, 'veren marie kiynyuy', 'female', '$2y$10$6UJodxvBLwByw82eq8/Ph.rd39LYkALD0xya51VGJCClxF1AzxUAW', 'kiynyuyverenmarie417@gmail.com', '670192662', '', '', NULL, '2023-08-05 09:32:01'),
(15, 'Simon ', 'male', '$2y$10$VY8Gg8DP67AYxJimPQt5y.7O2gg6JiOxOR77BJeV90BngimzJ.VJy', 'simon.njoya.m@gmail.com', '674628373', '', '', NULL, '2023-08-05 13:24:41');

-- --------------------------------------------------------

--
-- Table structure for table `results_serology`
--

CREATE TABLE `results_serology` (
  `results_id` int(12) NOT NULL,
  `bts` varchar(12) NOT NULL,
  `HCV` enum('Positive','Negative') NOT NULL,
  `HBAg` enum('Positive','Negative') NOT NULL,
  `HIV` enum('Positive','Negative') NOT NULL,
  `syphilis` enum('Positive','Negative') NOT NULL,
  `weight` int(12) NOT NULL,
  `bp_up` int(20) NOT NULL,
  `bp_down` int(20) NOT NULL,
  `hb` int(20) NOT NULL,
  `HCV_elisa` varchar(50) DEFAULT NULL,
  `HBsAg_elisa` varchar(50) DEFAULT NULL,
  `HIV_elisa` varchar(50) DEFAULT NULL,
  `observation` varchar(300) DEFAULT NULL,
  `date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `results_serology`
--

INSERT INTO `results_serology` (`results_id`, `bts`, `HCV`, `HBAg`, `HIV`, `syphilis`, `weight`, `bp_up`, `bp_down`, `hb`, `HCV_elisa`, `HBsAg_elisa`, `HIV_elisa`, `observation`, `date`) VALUES
(1, 'Ba230509', 'Positive', 'Positive', 'Positive', 'Positive', 60, 120, 95, 12, '0.0123', '1.45', '1.3', 'This patient will die ', '0000-00-00 00:00:00'),
(2, 'Ba233208', 'Positive', 'Negative', 'Positive', 'Positive', 58, 120, 80, 16, '20', '20', '20', 'patient can not donate', '2023-08-05 13:36:58');

-- --------------------------------------------------------

--
-- Table structure for table `vaccine`
--

CREATE TABLE `vaccine` (
  `vaccine_id` int(12) NOT NULL,
  `vaccine_name` varchar(60) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `vaccine`
--

INSERT INTO `vaccine` (`vaccine_id`, `vaccine_name`) VALUES
(1, 'yellowFever'),
(2, 'Covid 19'),
(3, 'HepB1'),
(4, 'HepB2'),
(5, 'HepB3');

-- --------------------------------------------------------

--
-- Table structure for table `vaccine_status`
--

CREATE TABLE `vaccine_status` (
  `vaccine_status_id` int(20) NOT NULL,
  `bts_number` varchar(20) NOT NULL,
  `status` enum('Taken','Not taken') NOT NULL,
  `vaccine_id` int(20) NOT NULL,
  `date` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `vaccine_status`
--

INSERT INTO `vaccine_status` (`vaccine_status_id`, `bts_number`, `status`, `vaccine_id`, `date`) VALUES
(1, 'Ba232502', 'Taken', 3, '2023-07-25'),
(2, 'Ba232502', 'Taken', 1, '2023-07-25'),
(3, 'Ba232502', 'Taken', 2, '2023-07-25'),
(4, 'Ba232502', 'Taken', 4, '2023-07-25'),
(5, 'Ba232502', 'Taken', 5, '2023-07-25');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `blood_appeals`
--
ALTER TABLE `blood_appeals`
  ADD PRIMARY KEY (`appeal_id`),
  ADD KEY `patient_id` (`patient_id`),
  ADD KEY `donor_id` (`donor_id`);

--
-- Indexes for table `doctors`
--
ALTER TABLE `doctors`
  ADD PRIMARY KEY (`id`),
  ADD KEY `health_facility_id` (`health_facility_id`);

--
-- Indexes for table `donors`
--
ALTER TABLE `donors`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `health_facilities`
--
ALTER TABLE `health_facilities`
  ADD PRIMARY KEY (`health_facility_id`);

--
-- Indexes for table `inventory`
--
ALTER TABLE `inventory`
  ADD PRIMARY KEY (`id`),
  ADD KEY `health_facility_id` (`health_facility_id`);

--
-- Indexes for table `lab_results`
--
ALTER TABLE `lab_results`
  ADD PRIMARY KEY (`id`),
  ADD KEY `donor_id` (`donor_id`);

--
-- Indexes for table `notifications`
--
ALTER TABLE `notifications`
  ADD PRIMARY KEY (`id`),
  ADD KEY `recipient_id` (`recipient_id`);

--
-- Indexes for table `patients`
--
ALTER TABLE `patients`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admins`
--
ALTER TABLE `admins`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `blood_appeals`
--
ALTER TABLE `blood_appeals`
  MODIFY `appeal_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=49;

--
-- AUTO_INCREMENT for table `doctors`
--
ALTER TABLE `doctors`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `donors`
--
ALTER TABLE `donors`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=59;

--
-- AUTO_INCREMENT for table `health_facilities`
--
ALTER TABLE `health_facilities`
  MODIFY `health_facility_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `inventory`
--
ALTER TABLE `inventory`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `lab_results`
--
ALTER TABLE `lab_results`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `notifications`
--
ALTER TABLE `notifications`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `patients`
--
ALTER TABLE `patients`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `blood_appeals`
--
ALTER TABLE `blood_appeals`
  ADD CONSTRAINT `blood_appeals_ibfk_1` FOREIGN KEY (`patient_id`) REFERENCES `patients` (`id`),
  ADD CONSTRAINT `blood_appeals_ibfk_2` FOREIGN KEY (`donor_id`) REFERENCES `donors` (`id`);

--
-- Constraints for table `doctors`
--
ALTER TABLE `doctors`
  ADD CONSTRAINT `doctors_ibfk_1` FOREIGN KEY (`health_facility_id`) REFERENCES `health_facilities` (`health_facility_id`);

--
-- Constraints for table `inventory`
--
ALTER TABLE `inventory`
  ADD CONSTRAINT `inventory_ibfk_1` FOREIGN KEY (`health_facility_id`) REFERENCES `health_facilities` (`health_facility_id`);

--
-- Constraints for table `lab_results`
--
ALTER TABLE `lab_results`
  ADD CONSTRAINT `lab_results_ibfk_1` FOREIGN KEY (`donor_id`) REFERENCES `donors` (`id`);

--
-- Constraints for table `notifications`
--
ALTER TABLE `notifications`
  ADD CONSTRAINT `notifications_ibfk_1` FOREIGN KEY (`recipient_id`) REFERENCES `donors` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
