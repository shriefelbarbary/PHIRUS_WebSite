-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 27, 2025 at 03:41 PM
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
-- Database: `authentication`
--

-- --------------------------------------------------------

--
-- Table structure for table `attachment_analysis`
--

CREATE TABLE `attachment_analysis` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `check_id` varchar(255) NOT NULL,
  `file_id` varchar(255) NOT NULL,
  `malicious_detections` int(11) DEFAULT NULL,
  `undetected_detections` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `attachment_analysis`
--

INSERT INTO `attachment_analysis` (`id`, `user_id`, `check_id`, `file_id`, `malicious_detections`, `undetected_detections`, `created_at`) VALUES
(2, 54, 'att-1751030452113', 'YWVhZDU3MmNkZmY4YWQxMmI4NTRiOTY0Y2JlNDBjMmU6MTc1MTAzMDM2Ng==', 0, 63, '2025-06-27 13:20:52'),
(3, 54, 'att-1751030584494', 'MzA1ZmU5ODhiMTM5ODRhMDdiNDZlZjg4OWM3NWJiYTE6MTc1MTAzMDU0Mw==', 0, 63, '2025-06-27 13:23:04');

-- --------------------------------------------------------

--
-- Table structure for table `blacklist_checks`
--

CREATE TABLE `blacklist_checks` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `check_id` varchar(100) NOT NULL,
  `domain` varchar(255) NOT NULL,
  `status` varchar(100) NOT NULL,
  `malicious_votes` int(11) DEFAULT 0,
  `suspicious_votes` int(11) DEFAULT 0,
  `checked_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `blacklist_checks`
--

INSERT INTO `blacklist_checks` (`id`, `user_id`, `check_id`, `domain`, `status`, `malicious_votes`, `suspicious_votes`, `checked_at`) VALUES
(1, 54, 'bl-1750950688663', 'chatgpt.com', 'alert', 1, 0, '2025-06-26 15:11:28'),
(2, 54, 'bl-1750950705427', 'google.com', 'safe', 0, 0, '2025-06-26 15:11:45'),
(3, 54, 'bl-1750950707725', 'google.com', 'safe', 0, 0, '2025-06-26 15:11:47');

-- --------------------------------------------------------

--
-- Table structure for table `email_security_checks`
--

CREATE TABLE `email_security_checks` (
  `check_id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `domain` varchar(255) NOT NULL,
  `spf_status` varchar(32) DEFAULT NULL,
  `spf_mail_from` varchar(255) DEFAULT NULL,
  `spf_authorized` varchar(16) DEFAULT NULL,
  `spf_comment` text DEFAULT NULL,
  `spf_authorization` tinyint(1) DEFAULT NULL,
  `dkim_status` varchar(32) DEFAULT NULL,
  `dkim_domain` varchar(255) DEFAULT NULL,
  `dkim_integrity` varchar(64) DEFAULT NULL,
  `dkim_comment` text DEFAULT NULL,
  `dmarc_status` varchar(32) DEFAULT NULL,
  `dmarc_policy` varchar(32) DEFAULT NULL,
  `dmarc_alignment` varchar(32) DEFAULT NULL,
  `dmarc_comment` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `email_security_checks`
--

INSERT INTO `email_security_checks` (`check_id`, `user_id`, `domain`, `spf_status`, `spf_mail_from`, `spf_authorized`, `spf_comment`, `spf_authorization`, `dkim_status`, `dkim_domain`, `dkim_integrity`, `dkim_comment`, `dmarc_status`, `dmarc_policy`, `dmarc_alignment`, `dmarc_comment`, `created_at`) VALUES
(1, 54, 'chatgpt.com', 'pass', 'chatgpt.com', 'Yes', 'SPF validation passed.', NULL, 'pass', 'chatgpt.com', 'Intact', 'DKIM validation passed.', 'pass', 'reject', 'Passed', 'DMARC validation passed. Policy applied: reject. Domain alignment: Passed.', '2025-06-27 12:14:22');

-- --------------------------------------------------------

--
-- Table structure for table `header_checks`
--

CREATE TABLE `header_checks` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `check_id` varchar(50) NOT NULL,
  `from_email` text DEFAULT NULL,
  `to_email` text DEFAULT NULL,
  `subject` text DEFAULT NULL,
  `date` varchar(255) DEFAULT NULL,
  `message_id` varchar(255) DEFAULT NULL,
  `reply_to` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `header_checks`
--

INSERT INTO `header_checks` (`id`, `user_id`, `check_id`, `from_email`, `to_email`, `subject`, `date`, `message_id`, `reply_to`, `created_at`) VALUES
(1, 54, 'hdr-1750951550007', 'shefo@example.com', 'nourhan@example.com', 'Test Email', 'Fri, 4 APR 2025 4:57:23 +0000', '<ABC123@example.com>', 'mhmd@example.com', '2025-06-26 15:25:50');

-- --------------------------------------------------------

--
-- Table structure for table `image_steg_checks`
--

CREATE TABLE `image_steg_checks` (
  `check_id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `filename` varchar(255) NOT NULL,
  `hidden` tinyint(1) NOT NULL,
  `extracted_message` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `id` int(11) NOT NULL,
  `email` varchar(100) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `password_reset_tokens`
--

INSERT INTO `password_reset_tokens` (`id`, `email`, `token`, `created_at`) VALUES
(16, 'shefo993@gmail.com', '6918', '2025-04-18 17:45:08'),
(17, 'amr@gmail.com', '5237', '2025-04-18 17:54:01'),
(18, 'shefo993@gmail.com', '5598', '2025-04-26 12:11:47'),
(19, 'shefo993@gmail.com', '2873', '2025-04-26 12:14:45'),
(20, 'shefo9@gmail.com', '7402', '2025-04-26 12:17:06'),
(21, 'shefo993@gmail.com', '6579', '2025-04-26 12:17:37');

-- --------------------------------------------------------

--
-- Table structure for table `ssl_checks`
--

CREATE TABLE `ssl_checks` (
  `check_id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `issued_to` varchar(255) NOT NULL,
  `issuer` varchar(255) NOT NULL,
  `valid_from` datetime NOT NULL,
  `valid_to` datetime NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `ssl_checks`
--

INSERT INTO `ssl_checks` (`check_id`, `user_id`, `issued_to`, `issuer`, `valid_from`, `valid_to`, `created_at`) VALUES
(1, 54, 'chatgpt.com', 'WE1', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '2025-06-27 11:49:20'),
(2, 54, 'chatgpt.com', 'WE1', '2025-06-01 02:45:43', '2025-08-30 03:45:39', '2025-06-27 11:50:58');

-- --------------------------------------------------------

--
-- Table structure for table `url_scan_results`
--

CREATE TABLE `url_scan_results` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `url` text NOT NULL,
  `domain` varchar(255) DEFAULT NULL,
  `path` text DEFAULT NULL,
  `query` text DEFAULT NULL,
  `scheme` varchar(10) DEFAULT NULL,
  `port` int(11) DEFAULT NULL,
  `prediction` varchar(20) NOT NULL,
  `harmless_count` int(11) DEFAULT 0,
  `malicious_count` int(11) DEFAULT 0,
  `suspicious_count` int(11) DEFAULT 0,
  `undetected_count` int(11) DEFAULT 0,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `url_scan_results`
--

INSERT INTO `url_scan_results` (`id`, `user_id`, `url`, `domain`, `path`, `query`, `scheme`, `port`, `prediction`, `harmless_count`, `malicious_count`, `suspicious_count`, `undetected_count`, `created_at`) VALUES
(1, 54, 'https://chatgpt.com/c/685d7e49-869c-8001-b302-452779e7e6be', 'chatgpt.com', '/c/685d7e49-869c-8001-b302-452779e7e6be', '', 'HTTPS', 443, '1', 67, 1, 0, 29, '2025-06-27 12:27:53');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(255) NOT NULL,
  `username` varchar(300) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(200) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `subscription_type` enum('free','pro') DEFAULT 'free'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `email`, `password`, `created_at`, `subscription_type`) VALUES
(51, 'amr', 'amr@gmail.com', '$2y$10$7UJrbYoTV93cIHlS2KH6aOO8aid9o6UcuTV.wI7jdJMas5stGs6S.', '2025-06-17 14:13:45', 'pro'),
(53, 'mhmd', 'mhmd@gmail.com', '$2y$10$pHyPMtweJDp9uY1ahV.IRu3sI6d.ww6lBTLq3njxCR0hc9PQ1v6h2', '2025-06-26 14:46:49', 'free'),
(54, 'drnehal', 'dr@gmail.com', '$2y$10$VSZ63inxxOzMuA1gRoEK7uQv2z.RnSrCFimu1cRwrN2q5dzc5Y0SW', '2025-06-26 14:58:35', 'free'),
(55, 'mhmdd', 'm@gmail.com', '$2y$10$O50ALxygIQSRdOMKTKR.6ewaryMg9m5T2BtEIiFLTxJa6w9qZ/w3u', '2025-06-26 21:05:49', 'free');

-- --------------------------------------------------------

--
-- Table structure for table `video_steg_checks`
--

CREATE TABLE `video_steg_checks` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `filename` varchar(255) NOT NULL,
  `hidden` tinyint(1) NOT NULL,
  `message` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `video_steg_checks`
--

INSERT INTO `video_steg_checks` (`id`, `user_id`, `filename`, `hidden`, `message`, `created_at`) VALUES
(1, 54, 'unknown.mp4', 0, 'No hidden message found', '2025-06-27 13:16:14'),
(2, 54, 'sample_1.mp4', 0, 'No hidden message found', '2025-06-27 13:17:04'),
(3, 54, 'file_example_MP4_480_1_5MG.mp4', 0, 'No hidden message found', '2025-06-27 13:18:14'),
(4, 54, 'file_example_MP4_480_1_5MG.mp4', 0, 'No hidden message found', '2025-06-27 13:18:30');

-- --------------------------------------------------------

--
-- Table structure for table `whois_results`
--

CREATE TABLE `whois_results` (
  `feature_id` int(11) NOT NULL,
  `user_id` int(255) DEFAULT NULL,
  `domain_name` varchar(255) DEFAULT NULL,
  `status` varchar(255) DEFAULT NULL,
  `registrar` varchar(255) DEFAULT NULL,
  `creation_date` text DEFAULT NULL,
  `expiration_date` text DEFAULT NULL,
  `update_date` text DEFAULT NULL,
  `name_servers` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `whois_results`
--

INSERT INTO `whois_results` (`feature_id`, `user_id`, `domain_name`, `status`, `registrar`, `creation_date`, `expiration_date`, `update_date`, `name_servers`, `created_at`) VALUES
(14, 54, 'chatgpt.com', 'clientDeleteProhibited https://icann.org/epp#clientDeleteProhibited, clientTransferProhibited https://icann.org/epp#clientTransferProhibited, clientUpdateProhibited https://icann.org/epp#clientUpdateProhibited, serverDeleteProhibited https://icann.org/epp', 'MarkMonitor, Inc.', NULL, NULL, NULL, 'HASSAN.NS.CLOUDFLARE.COM, SAVANNA.NS.CLOUDFLARE.COM', '2025-06-27 13:33:40'),
(15, 54, 'chatgpt.com', 'clientDeleteProhibited https://icann.org/epp#clientDeleteProhibited, clientTransferProhibited https://icann.org/epp#clientTransferProhibited, clientUpdateProhibited https://icann.org/epp#clientUpdateProhibited, serverDeleteProhibited https://icann.org/epp', 'MarkMonitor, Inc.', NULL, NULL, NULL, 'HASSAN.NS.CLOUDFLARE.COM, SAVANNA.NS.CLOUDFLARE.COM', '2025-06-27 13:35:30'),
(16, 54, 'chatgpt.com', 'clientDeleteProhibited https://icann.org/epp#clientDeleteProhibited, clientTransferProhibited https://icann.org/epp#clientTransferProhibited, clientUpdateProhibited https://icann.org/epp#clientUpdateProhibited, serverDeleteProhibited https://icann.org/epp', 'MarkMonitor, Inc.', '[datetime.datetime(2022, 11, 30, 23, 59, 19), datetime.datetime(2022, 11, 30, 23, 59, 19, tzinfo=datetime.timezone.utc)]', '[datetime.datetime(2026, 11, 30, 23, 59, 19), datetime.datetime(2026, 11, 30, 23, 59, 19, tzinfo=datetime.timezone.utc)]', '[datetime.datetime(2024, 10, 17, 22, 20, 15), datetime.datetime(2024, 10, 17, 21, 31, 32, tzinfo=datetime.timezone.utc)]', 'HASSAN.NS.CLOUDFLARE.COM, SAVANNA.NS.CLOUDFLARE.COM', '2025-06-27 13:37:28');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `attachment_analysis`
--
ALTER TABLE `attachment_analysis`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `blacklist_checks`
--
ALTER TABLE `blacklist_checks`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `email_security_checks`
--
ALTER TABLE `email_security_checks`
  ADD PRIMARY KEY (`check_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `header_checks`
--
ALTER TABLE `header_checks`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `image_steg_checks`
--
ALTER TABLE `image_steg_checks`
  ADD PRIMARY KEY (`check_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ssl_checks`
--
ALTER TABLE `ssl_checks`
  ADD PRIMARY KEY (`check_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `url_scan_results`
--
ALTER TABLE `url_scan_results`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `email` (`email`),
  ADD UNIQUE KEY `password` (`password`);

--
-- Indexes for table `video_steg_checks`
--
ALTER TABLE `video_steg_checks`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `whois_results`
--
ALTER TABLE `whois_results`
  ADD PRIMARY KEY (`feature_id`),
  ADD KEY `user_id` (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `attachment_analysis`
--
ALTER TABLE `attachment_analysis`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `blacklist_checks`
--
ALTER TABLE `blacklist_checks`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `email_security_checks`
--
ALTER TABLE `email_security_checks`
  MODIFY `check_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `header_checks`
--
ALTER TABLE `header_checks`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `image_steg_checks`
--
ALTER TABLE `image_steg_checks`
  MODIFY `check_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `ssl_checks`
--
ALTER TABLE `ssl_checks`
  MODIFY `check_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `url_scan_results`
--
ALTER TABLE `url_scan_results`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=56;

--
-- AUTO_INCREMENT for table `video_steg_checks`
--
ALTER TABLE `video_steg_checks`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `whois_results`
--
ALTER TABLE `whois_results`
  MODIFY `feature_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `attachment_analysis`
--
ALTER TABLE `attachment_analysis`
  ADD CONSTRAINT `attachment_analysis_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `blacklist_checks`
--
ALTER TABLE `blacklist_checks`
  ADD CONSTRAINT `blacklist_checks_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `email_security_checks`
--
ALTER TABLE `email_security_checks`
  ADD CONSTRAINT `email_security_checks_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `header_checks`
--
ALTER TABLE `header_checks`
  ADD CONSTRAINT `header_checks_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `image_steg_checks`
--
ALTER TABLE `image_steg_checks`
  ADD CONSTRAINT `image_steg_checks_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `ssl_checks`
--
ALTER TABLE `ssl_checks`
  ADD CONSTRAINT `ssl_checks_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `url_scan_results`
--
ALTER TABLE `url_scan_results`
  ADD CONSTRAINT `url_scan_results_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `video_steg_checks`
--
ALTER TABLE `video_steg_checks`
  ADD CONSTRAINT `video_steg_checks_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `whois_results`
--
ALTER TABLE `whois_results`
  ADD CONSTRAINT `whois_results_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
