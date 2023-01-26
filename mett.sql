-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 19, 2023 at 12:06 PM
-- Server version: 10.4.21-MariaDB
-- PHP Version: 8.0.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `mett`
--

-- --------------------------------------------------------

--
-- Table structure for table `category_service`
--

CREATE TABLE `category_service` (
  `category_service_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'images/serviceCategoryDefault.jpg',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `category_service`
--

INSERT INTO `category_service` (`category_service_id`, `name`, `image`, `created_at`, `updated_at`) VALUES
(1, 'Plant 1', 'images/service-1.jpg', NULL, '2023-01-16 02:03:50'),
(2, 'Plant 2', 'images/service-2.jpg', NULL, '2023-01-16 02:03:58'),
(3, 'Plant 3', 'images/service-3.jpg', NULL, '2023-01-16 02:04:07');

-- --------------------------------------------------------

--
-- Table structure for table `customer`
--

CREATE TABLE `customer` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'images/employeeDefault.jpg',
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `employee`
--

CREATE TABLE `employee` (
  `employee_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `skill` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'images/employeeDefault.jpg',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `employee`
--

INSERT INTO `employee` (`employee_id`, `name`, `skill`, `description`, `image`, `created_at`, `updated_at`) VALUES
(1, 'Adam Philips', 'Master Barber', 'Experienced in barber for 7 years', 'images/team-1.jpg', NULL, NULL),
(2, 'Dylan Adams', 'Hair Expert', 'Have good knowledge in hair world', 'images/team-2.jpg', NULL, NULL),
(3, 'Gloria Edwards', 'Beard Expert', 'Experienced in bread expert for 5 years', 'images/team-3.jpg', NULL, NULL),
(4, 'Josh Dunn', 'Color Expert', 'Experienced in coloring for 9 years', 'images/team-4.jpg', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `gallery`
--

CREATE TABLE `gallery` (
  `gallery_id` bigint(20) UNSIGNED NOT NULL,
  `category_service_id` bigint(20) UNSIGNED NOT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `message`
--

CREATE TABLE `message` (
  `message_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `messagetext` mediumtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `show` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `message`
--

INSERT INTO `message` (`message_id`, `name`, `email`, `title`, `messagetext`, `created_at`, `updated_at`, `show`) VALUES
(1, 'Widiareta', 'widiareta@gmail.com', 'It Was Very Nice Service', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.', NULL, NULL, 1),
(2, 'Hanum Aisyah Algadrie', 'hanumaisyah@gmail.com', 'I Love the style of my hair', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.', NULL, NULL, 0),
(3, 'Rimadhani Aula Marufah', 'rimadhani@gmail.com', 'My hair get pretty', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.', NULL, NULL, 1),
(4, 'Putri Lydia Puspita Sari', 'putri@gmail.com', 'I like the service', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.', NULL, NULL, 0),
(5, 'Omar Abdul', 'omar@gmail.com', 'I like the service', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.', NULL, NULL, 1),
(6, 'Ariono Septian Jaya', 'putri@gmail.com', 'You want beautiful hair? come here', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.', NULL, NULL, 1);

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2021_05_08_151351_create_employee_table', 1),
(5, '2021_05_08_152119_create_category_service_table', 1),
(6, '2021_05_08_152638_create_service_table', 1),
(7, '2021_05_08_153709_create_reservation_table', 1),
(8, '2021_05_08_155046_create_reservation_status_table', 1),
(9, '2021_05_08_160326_create_gallery_table', 1),
(10, '2021_05_08_160659_create_message_table', 1),
(11, '2021_05_18_074548_add_to_table_message', 1),
(12, '2022_07_15_135638_create_customer_table', 1);

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `reservation`
--

CREATE TABLE `reservation` (
  `reservation_id` bigint(20) UNSIGNED NOT NULL,
  `reservation_code` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nama` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `service_id` bigint(20) UNSIGNED NOT NULL,
  `date` date NOT NULL,
  `reservation_time` time DEFAULT NULL,
  `reservation_time_out` time DEFAULT NULL,
  `ket` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` tinyint(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `reservation`
--

INSERT INTO `reservation` (`reservation_id`, `reservation_code`, `nama`, `user_id`, `service_id`, `date`, `reservation_time`, `reservation_time_out`, `ket`, `status`, `created_at`, `updated_at`) VALUES
(16, 'RBX-3KVkqtNR', 'getn', 3, 1, '2023-01-18', '06:17:00', '07:30:00', 'wsrg', 1, '2023-01-17 19:51:05', '2023-01-18 00:41:22'),
(18, 'RBX-j5TqFSnL', 'sgrhgrtr', 3, 1, '2023-01-18', '10:54:00', '05:17:00', 'fgwrgwg', 1, '2023-01-17 19:54:32', '2023-01-18 00:41:22'),
(20, 'RBX-WLnyRsSD', 'aefe', 3, 1, '2023-01-18', '10:17:00', '10:18:00', 'dqaevfeav', 0, '2023-01-17 20:18:21', '2023-01-18 00:41:22'),
(21, 'RBX-sXrENJvM', 'adfef', 3, 4, '2023-01-18', '10:25:00', '12:26:00', 'arionos eptian', 1, '2023-01-17 20:25:21', '2023-01-18 00:41:22'),
(22, 'RBX-KViyoDAh', 'aefe', 3, 5, '2023-01-18', '14:26:00', '05:27:00', 'faefe', 1, '2023-01-18 00:26:47', '2023-01-18 00:41:22'),
(23, 'RBX-8DLACWx7', 'Ariono Septian Jaya', 3, 8, '2023-01-18', '14:40:00', '05:10:00', 'rrf4wf', 1, '2023-01-18 00:41:00', '2023-01-18 00:41:22'),
(33, 'RBX-r0c5R4mT', 'Ariono Septian Jaya', 3, 1, '2023-01-19', '10:05:00', '12:06:00', 'saya pinjam buku', 0, '2023-01-18 20:06:08', '2023-01-18 20:06:08'),
(34, 'RBX-sZ9T04Do', 'Ariono Septian Jaya', 3, 1, '2023-01-19', '10:08:00', '10:08:00', 'saya pinjam buku', 1, '2023-01-18 20:07:22', '2023-01-18 20:07:22'),
(35, 'RBX-Jg4kbfTh', 'Ariono Septian Jaya', 3, 4, '2023-01-19', '10:08:00', '11:08:00', 'saya pinjam buku', 0, '2023-01-18 20:08:42', '2023-01-18 20:08:42'),
(36, 'RBX-LrtIsPlB', 'Ariono Septian Jaya', 3, 1, '2023-01-19', '13:10:00', '14:10:00', 'aku pinjam yaa', 0, '2023-01-18 20:10:50', '2023-01-18 20:10:50');

-- --------------------------------------------------------

--
-- Table structure for table `reservation_status`
--

CREATE TABLE `reservation_status` (
  `reservation_status_id` bigint(20) UNSIGNED NOT NULL,
  `reservation_code` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` tinyint(1) NOT NULL,
  `price` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `reservation_status`
--

INSERT INTO `reservation_status` (`reservation_status_id`, `reservation_code`, `status`, `price`, `created_at`, `updated_at`) VALUES
(11, 'RBX-2u63sYvc', 1, 30000, '2023-01-16 02:01:33', '2023-01-16 20:19:10'),
(12, 'RBX-dhRYaKQu', 0, 20000, '2023-01-16 02:10:16', '2023-01-16 02:10:16');

-- --------------------------------------------------------

--
-- Table structure for table `service`
--

CREATE TABLE `service` (
  `service_id` bigint(20) UNSIGNED NOT NULL,
  `category_service_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `price` int(11) NOT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'images/serviceDefault.jpg',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `service`
--

INSERT INTO `service` (`service_id`, `category_service_id`, `name`, `price`, `image`, `created_at`, `updated_at`) VALUES
(1, 1, 'Meeting Room 1', 30000, 'images/price-1.jpg', NULL, '2023-01-16 02:03:34'),
(4, 2, 'Meeting Room 2', 20000, 'images/price-4.jpg', NULL, '2023-01-16 02:04:34'),
(5, 1, 'Meeting Room 3', 40000, 'images/price-5.jpg', NULL, '2023-01-16 02:04:51'),
(8, 1, 'Meeting Room 4', 15000, 'images/price-8.jpg', NULL, '2023-01-16 02:05:02');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `username` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'images/userDefault.jpg',
  `is_admin` tinyint(1) NOT NULL DEFAULT 0,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`user_id`, `name`, `username`, `phone`, `email`, `email_verified_at`, `password`, `image`, `is_admin`, `remember_token`, `created_at`, `updated_at`) VALUES
(3, 'Pegawai', 'Admin', '6582123533955', 'admin@gmail.com', NULL, '$2y$10$d52nkA85Wb9V4So8yO.7Zu.NIhz7e6Fu5D68Bc3IWR.FGqPrL9tlO', 'images/adminDefault.jpg', 1, NULL, NULL, NULL),
(4, 'Admin', 'Admin1', '65255464132135', 'admin1@gmail.com', NULL, '$2y$10$9iuiua0kjRGE8hr03X2r8.i5EjeiMctTBOHgWirFOdNc0idpCUL8C', 'images/adminDefault.jpg', 1, NULL, NULL, NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `category_service`
--
ALTER TABLE `category_service`
  ADD PRIMARY KEY (`category_service_id`) USING BTREE;

--
-- Indexes for table `customer`
--
ALTER TABLE `customer`
  ADD PRIMARY KEY (`id`) USING BTREE;

--
-- Indexes for table `employee`
--
ALTER TABLE `employee`
  ADD PRIMARY KEY (`employee_id`) USING BTREE;

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`) USING BTREE,
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`) USING BTREE;

--
-- Indexes for table `gallery`
--
ALTER TABLE `gallery`
  ADD PRIMARY KEY (`gallery_id`) USING BTREE,
  ADD KEY `gallery_category_service_id_foreign` (`category_service_id`) USING BTREE;

--
-- Indexes for table `message`
--
ALTER TABLE `message`
  ADD PRIMARY KEY (`message_id`) USING BTREE;

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`) USING BTREE;

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`) USING BTREE;

--
-- Indexes for table `reservation`
--
ALTER TABLE `reservation`
  ADD PRIMARY KEY (`reservation_id`),
  ADD KEY `reservation_reservation_code_index` (`reservation_code`),
  ADD KEY `reservation_user_id_foreign` (`user_id`),
  ADD KEY `reservation_service_id_foreign` (`service_id`);

--
-- Indexes for table `reservation_status`
--
ALTER TABLE `reservation_status`
  ADD PRIMARY KEY (`reservation_status_id`) USING BTREE,
  ADD KEY `reservation_status_reservation_code_foreign` (`reservation_code`) USING BTREE;

--
-- Indexes for table `service`
--
ALTER TABLE `service`
  ADD PRIMARY KEY (`service_id`) USING BTREE,
  ADD KEY `service_category_service_id_foreign` (`category_service_id`) USING BTREE;

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`user_id`) USING BTREE,
  ADD UNIQUE KEY `user_username_unique` (`username`) USING BTREE,
  ADD UNIQUE KEY `user_email_unique` (`email`) USING BTREE;

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `category_service`
--
ALTER TABLE `category_service`
  MODIFY `category_service_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `customer`
--
ALTER TABLE `customer`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `employee`
--
ALTER TABLE `employee`
  MODIFY `employee_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `gallery`
--
ALTER TABLE `gallery`
  MODIFY `gallery_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `message`
--
ALTER TABLE `message`
  MODIFY `message_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `reservation`
--
ALTER TABLE `reservation`
  MODIFY `reservation_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT for table `reservation_status`
--
ALTER TABLE `reservation_status`
  MODIFY `reservation_status_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `service`
--
ALTER TABLE `service`
  MODIFY `service_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `user_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `gallery`
--
ALTER TABLE `gallery`
  ADD CONSTRAINT `gallery_category_service_id_foreign` FOREIGN KEY (`category_service_id`) REFERENCES `category_service` (`category_service_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `reservation`
--
ALTER TABLE `reservation`
  ADD CONSTRAINT `reservation_service_id_foreign` FOREIGN KEY (`service_id`) REFERENCES `service` (`service_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `reservation_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `reservation_status`
--
ALTER TABLE `reservation_status`
  ADD CONSTRAINT `reservation_status_reservation_code_foreign` FOREIGN KEY (`reservation_code`) REFERENCES `reservation` (`reservation_code`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `service`
--
ALTER TABLE `service`
  ADD CONSTRAINT `service_category_service_id_foreign` FOREIGN KEY (`category_service_id`) REFERENCES `category_service` (`category_service_id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
