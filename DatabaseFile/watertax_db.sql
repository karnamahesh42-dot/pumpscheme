-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 23, 2025 at 08:17 PM
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
-- Database: `watertax_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `departments`
--

CREATE TABLE `departments` (
  `id` int(11) NOT NULL,
  `department_name` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `departments`
--

INSERT INTO `departments` (`id`, `department_name`) VALUES
(2, 'Finance'),
(3, 'HR'),
(1, 'IT'),
(4, 'Procurement'),
(6, 'Security'),
(5, 'Stores');

-- --------------------------------------------------------

--
-- Table structure for table `land_records`
--

CREATE TABLE `land_records` (
  `id` int(11) NOT NULL,
  `serial_no` int(11) DEFAULT NULL,
  `khata_no` varchar(50) DEFAULT NULL,
  `pattadar_name` varchar(255) DEFAULT NULL,
  `lp_number` varchar(50) DEFAULT NULL,
  `old_survey_no` varchar(100) DEFAULT NULL,
  `ulpin` varchar(50) DEFAULT NULL,
  `land_nature` varchar(100) DEFAULT NULL,
  `land_sub_nature` varchar(100) DEFAULT NULL,
  `land_classification` varchar(150) DEFAULT NULL,
  `land_sub_classification` varchar(150) DEFAULT NULL,
  `lp_extent` decimal(10,2) DEFAULT NULL,
  `pay_amount` decimal(10,2) DEFAULT 0.00,
  `pay_status` enum('Pending','Paid') DEFAULT 'Pending',
  `payed_at` date DEFAULT NULL,
  `payed_by` int(2) NOT NULL,
  `possession_type` varchar(100) DEFAULT NULL,
  `contact_details` varchar(150) DEFAULT NULL,
  `remarks` text DEFAULT NULL,
  `created_at` datetime DEFAULT current_timestamp(),
  `tax_amount` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `land_records`
--

INSERT INTO `land_records` (`id`, `serial_no`, `khata_no`, `pattadar_name`, `lp_number`, `old_survey_no`, `ulpin`, `land_nature`, `land_sub_nature`, `land_classification`, `land_sub_classification`, `lp_extent`, `pay_amount`, `pay_status`, `payed_at`, `payed_by`, `possession_type`, `contact_details`, `remarks`, `created_at`, `tax_amount`) VALUES
(2, 1, '637', '3ొణతాల పట్టియ్యమ్మ / వీరవెంకట రామారావు', '1115', '271-2', '-', 'పట్టా / జిరాయితీ భూమి', '- / -', 'మాగాణి / పల్లం / తరి', 'మధ్యస్థ/చిన్న నీటి వనరుల కింద భూమి / -', 0.98, 0.00, 'Pending', NULL, 0, 'వారసత్వం', 'XXXX-XXXX-3888 / 95XXXXXX14', '-', '2025-12-22 23:33:00', 0),
(3, 2, '637', '3ొణతాల పట్టియ్యమ్మ / వీరవెంకట రామారావు', '1532', '355-4', '-', 'పట్టా / జిరాయితీ భూమి', '- / -', 'మెట్ట / మెరక / ఖుష్కి', 'పట్టాదారు / -', 1.01, 0.00, 'Pending', NULL, 0, 'వారసత్వం', 'XXXX-XXXX-3888 / 95XXXXXX14', '-', '2025-12-22 23:33:00', 0),
(4, 3, '637', '3ొణతాల పట్టియ్యమ్మ / వీరవెంకట రామారావు', '1534', '355-1,355-2,355-5', '-', 'పట్టా / జిరాయితీ భూమి', '- / -', 'మాగాణి / పల్లం / తరి', 'మధ్యస్థ/చిన్న నీటి వనరుల కింద భూమి / -', 1.10, 0.00, 'Pending', NULL, 0, 'వారసత్వం', 'XXXX-XXXX-3888 / 95XXXXXX14', '-', '2025-12-22 23:33:00', 0),
(5, 1, '5174', 'Addagarla Rama Krishna / Addagarla Saggurudu', '1207', '279', '-', 'పట్టా / జిరాయితీ భూమి', '- / -', 'మాగాణి / పల్లం / తరి', 'మధ్యస్థ/చిన్న నీటి వనరుల కింద భూమి / -', 0.22, 0.00, 'Pending', NULL, 0, 'కొనుగోలు / క్రయం', 'XXXX-XXXX-8117 / 90XXXXXX46', '-', '2025-12-22 23:33:00', 0),
(6, 2, '5174', 'Addagarla Rama Krishna / Addagarla Saggurudu', '1208', '279', '-', 'పట్టా / జిరాయితీ భూమి', '- / -', 'మాగాణి / పల్లం / తరి', 'మధ్యస్థ/చిన్న నీటి వనరుల కింద భూమి / -', 0.22, 0.00, 'Pending', NULL, 0, 'కొనుగోలు / క్రయం', 'XXXX-XXXX-8117 / 90XXXXXX46', '-', '2025-12-22 23:33:00', 0),
(7, 3, '5174', 'Addagarla Rama Krishna / Addagarla Saggurudu', '1209', '279', '-', 'పట్టా / జిరాయితీ భూమి', '- / -', 'మాగాణి / పల్లం / తరి', 'మధ్యస్థ/చిన్న నీటి వనరుల కింద భూమి / -', 0.22, 0.00, 'Pending', NULL, 0, 'కొనుగోలు / క్రయం', 'XXXX-XXXX-8117 / 90XXXXXX46', '-', '2025-12-22 23:33:00', 0),
(8, 4, '5174', 'Addagarla Rama Krishna / Addagarla Saggurudu', '1210', '279', '-', 'పట్టా / జిరాయితీ భూమి', '- / -', 'మాగాణి / పల్లం / తరి', 'మధ్యస్థ/చిన్న నీటి వనరుల కింద భూమి / -', 0.22, 0.00, 'Pending', NULL, 0, 'కొనుగోలు / క్రయం', 'XXXX-XXXX-8117 / 90XXXXXX46', '-', '2025-12-22 23:33:00', 0),
(9, 5, '5174', 'Addagarla Rama Krishna / Addagarla Saggurudu', '1220', '279', '-', 'పట్టా / జిరాయితీ భూమి', '- / -', 'మాగాణి / పల్లం / తరి', 'మధ్యస్థ/చిన్న నీటి వనరుల కింద భూమి / -', 0.22, 0.00, 'Pending', NULL, 0, 'కొనుగోలు / క్రయం', 'XXXX-XXXX-8117 / 90XXXXXX46', '-', '2025-12-22 23:33:00', 0),
(10, 1, '5025', 'Addala Pravallika / Addala Satyanarayana', '1395', '325-1', '-', 'పట్టా / జిరాయితీ భూమి', '- / -', 'మాగాణి / పల్లం / తరి', 'మధ్యస్థ/చిన్న నీటి వనరుల కింద భూమి / -', 0.69, 0.00, 'Pending', NULL, 0, 'కొనుగోలు / క్రయం', 'XXXX-XXXX-6233 / 94XXXXXX95', '-', '2025-12-22 23:33:00', 0),
(11, 2, '5025', 'Addala Pravallika / Addala Satyanarayana', '2148', '444-1', '-', 'పట్టా / జిరాయితీ భూమి', '- / -', 'మాగాణి / పల్లం / తరి', 'మధ్యస్థ/చిన్న నీటి వనరుల కింద భూమి / -', 0.73, 0.00, 'Pending', NULL, 0, 'కొనుగోలు / క్రయం', 'XXXX-XXXX-6233 / 94XXXXXX95', '-', '2025-12-22 23:33:00', 0),
(12, 1, '5206', 'Adireddy Lakshmi Krishna Padmavathi / Adireddy Siva Kumar', '4996', '243', '-', 'పట్టా / జిరాయితీ భూమి', '- / -', 'మాగాణి / పల్లం / తరి', 'మధ్యస్థ/చిన్న నీటి వనరుల కింద భూమి / -', 0.50, 0.00, 'Pending', NULL, 0, 'విభజన', 'XXXX-XXXX-6487 / 94XXXXXX23', '-', '2025-12-22 23:33:00', 0),
(13, 1, '5163', 'Akkabattula Lakshmanarao / Simhadri', '4959', '569-3', '-', 'పట్టా / జిరాయితీ భూమి', '- / -', 'మెట్ట / మెరక / ఖుష్కి', 'పట్టాదారు / -', 1.00, 0.00, 'Pending', NULL, 0, 'కొనుగోలు / క్రయం', 'XXXX-XXXX-6709 / 99XXXXXX35', '-', '2025-12-22 23:33:00', 0),
(14, 1, '5046', 'Akula Srilakshmi / Akula Rambabu', '4526', '678-1,679-2', '-', 'పట్టా / జిరాయితీ భూమి', '- / -', 'మాగాణి / పల్లం / తరి', 'మధ్యస్థ/చిన్న నీటి వనరుల కింద భూమి / -', 0.50, 0.00, 'Pending', NULL, 0, 'కొనుగోలు / క్రయం', 'XXXX-XXXX-2154 / 92XXXXXX10', '-', '2025-12-22 23:33:01', 0),
(15, 2, '5046', 'Akula Srilakshmi / Akula Rambabu', '4955', '606-2B', '-', 'పట్టా / జిరాయితీ భూమి', '- / -', 'మెట్ట / మెరక / ఖుష్కి', 'పట్టాదారు / -', 0.30, 0.00, 'Pending', NULL, 0, 'బహుమతి', 'XXXX-XXXX-2154 / 92XXXXXX10', '-', '2025-12-22 23:33:01', 0),
(16, 1, '5098', 'Alle Veera Venkata Satyavathi / Alle Satyanarayana', '4722', '182', '-', 'పట్టా / జిరాయితీ భూమి', '- / -', 'మాగాణి / పల్లం / తరి', 'మధ్యస్థ/చిన్న నీటి వనరుల కింద భూమి / -', 0.25, 0.00, 'Pending', NULL, 0, 'బహుమతి', 'XXXX-XXXX-9446 / 80XXXXXX17', '-', '2025-12-22 23:33:01', 0),
(17, 1, '5226', 'Althi Jyotsna Devi / Althi Bapiraju', '862', '190-2D2', '-', 'పట్టా / జిరాయితీ భూమి', '- / -', 'మాగాణి / పల్లం / తరి', 'మధ్యస్థ/చిన్న నీటి వనరుల కింద భూమి / -', 0.51, 0.00, 'Pending', NULL, 0, 'బహుమతి', 'XXXX-XXXX-5111 / 81XXXXXX00', '-', '2025-12-22 23:33:01', 0),
(18, 1, '5032', 'Amisetti Ramakrishna / Late Amisetti Lakshmanaswami', '5485', '175-6', '-', 'పట్టా / జిరాయితీ భూమి', '- / -', 'మాగాణి / పల్లం / తరి', 'మధ్యస్థ/చిన్న నీటి వనరుల కింద భూమి / -', 0.30, 0.00, 'Pending', NULL, 0, 'కొనుగోలు / క్రయం', 'XXXX-XXXX-0260 / 70XXXXXX46', '-', '2025-12-22 23:33:01', 0),
(20, 1, '2565', 'Golla Mahesh Karna/Golla Anjineyulu', '125', '251-B', '000', 'పట్టా / జిరాయితీ భూమి', 'పల్లం / మెరక', '', '', 0.25, 0.00, 'Pending', NULL, 0, 'వారసత్వం / కొనుగోలు / క్రయం / బహుమతి / విభజన', '8919146333', 'test', '2025-12-23 21:01:36', 0),
(21, 2, '2565', 'Golla Mahesh Karna/Golla Anjineyulu', '159', '252-A', '000', 'పట్టా / జిరాయితీ భూమి', 'పల్లం / మెరక', '', '', 0.50, 0.00, 'Pending', NULL, 0, 'వారసత్వం / కొనుగోలు / క్రయం / బహుమతి / విభజన', '8919146333', 'test', '2025-12-23 21:01:36', 0),
(22, 1, '7531', 'Golla Philip/Golla Anjineyulu', '1321', '123-S', '', 'పట్టా / జిరాయితీ భూమి', '-/-', 'పల్లం / మెరక', '', 0.20, 100.00, 'Paid', '2025-12-24', 1, 'వారసత్వం / కొనుగోలు / క్రయం / బహుమతి / విభజన', '', '', '2025-12-23 22:24:46', 1200);

-- --------------------------------------------------------

--
-- Table structure for table `land_sub_nature_master`
--

CREATE TABLE `land_sub_nature_master` (
  `id` int(11) NOT NULL,
  `name_te` varchar(150) NOT NULL,
  `name_en` varchar(150) DEFAULT NULL,
  `status` tinyint(4) DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `land_survey_master`
--

CREATE TABLE `land_survey_master` (
  `id` int(11) NOT NULL,
  `lp_number` int(11) NOT NULL,
  `old_survey_no` varchar(100) DEFAULT NULL,
  `sub_division` varchar(50) DEFAULT NULL,
  `ulpin` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `ownership_type_master`
--

CREATE TABLE `ownership_type_master` (
  `id` int(11) NOT NULL,
  `name_te` varchar(100) NOT NULL,
  `status` tinyint(4) DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` int(11) NOT NULL,
  `role_name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `role_name`) VALUES
(2, 'admin'),
(4, 'security'),
(1, 'superadmin'),
(3, 'user');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `priority` int(11) NOT NULL DEFAULT 0,
  `name` varchar(200) DEFAULT NULL,
  `company_name` varchar(150) DEFAULT NULL,
  `department_id` int(11) DEFAULT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role_id` int(11) NOT NULL,
  `active` tinyint(1) NOT NULL DEFAULT 1,
  `hash_key` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `created_by` int(11) DEFAULT current_timestamp(),
  `email` varchar(150) NOT NULL,
  `employee_code` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `priority`, `name`, `company_name`, `department_id`, `username`, `password`, `role_id`, `active`, `hash_key`, `created_at`, `created_by`, `email`, `employee_code`) VALUES
(1, 0, 'mahesh', 'UKMPL', 1, 'superadmin', '274d015c638f62ba24b19ca23c9c9503', 1, 1, 'HASHKEY123', '2025-11-20 09:28:43', NULL, 'maheshkarna42@gmail.com', '2523011'),
(5, 0, 'Sreenivas', 'UKMPL', 1, 'sreenivas', '4afcb80b6e9cd9a83efdf1ec48a1c856', 2, 1, 'HASHKEY123', '2025-11-21 05:54:24', 1, 'ukmledp@ramojifilmcity.com', '12345678'),
(6, 0, 'Prakash', 'UKMPL', 3, 'hruser2', '1b0041377a27ec89d4ff989d048f5e85', 3, 1, 'HASHKEY123', '2025-11-21 22:15:08', 1, 'prakash@gmail.com', '789654159'),
(7, 0, 'Prasad ', 'UKMPL', 3, 'hrhod', 'f271d1efdfba760f7145d4436f845b8e', 2, 1, 'HASHKEY123', '2025-11-22 05:56:17', 1, 'prasad@gmail.com', '951357456'),
(8, 0, 'Sury kumar', 'UKMPL', 1, 'ituser', '8e3f128f3e5075f40cd8b8361cb1d24d', 3, 1, 'HASHKEY123', '2025-11-24 00:22:13', 1, 'kumar@gmail.com', '87456321'),
(9, 10, 'Radhika', 'UKMPL', 2, 'radhika', '2a14558094169ea7f79f928213fd9a20', 3, 1, 'HASHKEY123', '2025-11-24 03:40:59', 1, 'radhika@gmail.com', '951456357'),
(10, 10, 'Sailesh Kumar', 'UKMPL', 2, 'sailesh', '439dd07182ce0dcd1f225293d85be464', 2, 1, 'HASHKEY123', '2025-11-27 23:56:49', 5, 'miscentraloffice@ramojifilmcity.com', '741963258'),
(11, 2, 'Satish Kumar', 'UKMPL', 2, 'satish', '135c44d20155d3a67bc984f17492a3d3', 2, 1, 'HASHKEY123', '2025-11-30 09:57:12', 5, 'gmaccounts@ramojifilmcity.com', '321987456'),
(12, 0, 'pallam raju', 'UKMPL', 3, 'hruser', '5980d6ad05354bd8681adff071323804', 3, 1, 'HASHKEY123', '2025-11-30 15:37:58', 5, 'raju@gmail.com', '456812397'),
(13, 10, 'khan', 'UKMPL', 6, 'security', '7f56499c9bcb7018d17adba024f12b36', 4, 1, NULL, '2025-12-01 10:32:56', 5, 'khan@gmail.com', '89595875'),
(14, 0, 'Kumar', 'UKMPL', 5, 'kumar', 'b9b580e1f1d30f72a52c9696dfa3c1a3', 3, 0, NULL, '2025-12-02 03:46:21', 5, 'kumar@gmail.com', '53532581'),
(15, 0, 'Mahesh', 'UKMPL', 5, 'stores@rfc.com', 'bde72de2ac7798197faa307a4df2db69', 3, 1, 'HASHKEY123', '2025-12-09 11:46:10', 1, 'store@gmail.com', '123456'),
(16, 3, 'Lokesh', 'UKMPL', 2, 'lokesh', 'd273c8b0aa7f42e27fe0ea75f896167a', 2, 1, 'HASHKEY123', '2025-12-12 15:37:09', 1, 'lokesh@gmail.com', '87456321'),
(18, 1, 'K Ravindara Rao', 'UKMPL', 2, 'kravindra', '6c185769e88bffa03bed6a8129277205', 2, 1, 'HASHKEY123', '2025-12-13 09:29:06', 1, 'ravindra@gmail.com', '789564264'),
(19, 10, 'Ramarao', 'UKMPL', 2, 'ramarao', 'c29026d4d8d5bbdde0f2c246de65f93d', 3, 1, 'HASHKEY123', '2025-12-19 14:25:27', 1, 'rama@gmail.com', '7894563');

-- --------------------------------------------------------

--
-- Table structure for table `user_hashkeys`
--

CREATE TABLE `user_hashkeys` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `hash_key` varchar(255) NOT NULL,
  `pass_key` varchar(50) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `visitor_logs`
--

CREATE TABLE `visitor_logs` (
  `id` int(11) NOT NULL,
  `visitor_request_id` int(11) NOT NULL,
  `action_type` varchar(50) NOT NULL,
  `old_status` varchar(50) DEFAULT NULL,
  `new_status` varchar(50) DEFAULT NULL,
  `remarks` text DEFAULT NULL,
  `performed_by` int(11) NOT NULL,
  `performed_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `visitor_logs`
--

INSERT INTO `visitor_logs` (`id`, `visitor_request_id`, `action_type`, `old_status`, `new_status`, `remarks`, `performed_by`, `performed_at`) VALUES
(1, 1, 'Created', NULL, 'approved', '--', 1, '2025-12-12 22:19:39'),
(2, 2, 'Created', NULL, 'pending', '--', 9, '2025-12-12 22:34:33'),
(3, 3, 'Created', NULL, 'pending', '--', 9, '2025-12-12 22:36:16'),
(4, 2, 'approved', 'pending', 'approved', NULL, 11, '2025-12-13 04:01:35'),
(5, 4, 'Created', NULL, 'pending', '--', 9, '2025-12-13 10:48:10'),
(6, 5, 'Created', NULL, 'pending', '--', 9, '2025-12-13 10:48:10'),
(7, 4, 'approved', 'pending', 'approved', NULL, 11, '2025-12-13 10:54:29'),
(8, 5, 'approved', 'pending', 'approved', NULL, 11, '2025-12-13 10:54:30'),
(9, 6, 'Created', NULL, 'pending', '--', 9, '2025-12-13 13:57:28'),
(10, 7, 'Created', NULL, 'pending', '--', 9, '2025-12-13 14:54:13'),
(11, 7, 'approved', 'pending', 'approved', NULL, 16, '2025-12-13 15:13:47'),
(12, 3, 'approved', 'pending', 'approved', NULL, 1, '2025-12-14 12:04:28');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `departments`
--
ALTER TABLE `departments`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `department_name` (`department_name`);

--
-- Indexes for table `land_records`
--
ALTER TABLE `land_records`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `land_sub_nature_master`
--
ALTER TABLE `land_sub_nature_master`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `land_survey_master`
--
ALTER TABLE `land_survey_master`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `lp_number` (`lp_number`,`old_survey_no`);

--
-- Indexes for table `ownership_type_master`
--
ALTER TABLE `ownership_type_master`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `role_name` (`role_name`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD KEY `department_id` (`department_id`),
  ADD KEY `role_id` (`role_id`),
  ADD KEY `created_by` (`created_by`);

--
-- Indexes for table `user_hashkeys`
--
ALTER TABLE `user_hashkeys`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `visitor_logs`
--
ALTER TABLE `visitor_logs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `visitor_request_id` (`visitor_request_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `departments`
--
ALTER TABLE `departments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `land_records`
--
ALTER TABLE `land_records`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `land_sub_nature_master`
--
ALTER TABLE `land_sub_nature_master`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `land_survey_master`
--
ALTER TABLE `land_survey_master`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `ownership_type_master`
--
ALTER TABLE `ownership_type_master`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `user_hashkeys`
--
ALTER TABLE `user_hashkeys`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `visitor_logs`
--
ALTER TABLE `visitor_logs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_ibfk_1` FOREIGN KEY (`department_id`) REFERENCES `departments` (`id`),
  ADD CONSTRAINT `users_ibfk_2` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`);

--
-- Constraints for table `user_hashkeys`
--
ALTER TABLE `user_hashkeys`
  ADD CONSTRAINT `user_hashkeys_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
