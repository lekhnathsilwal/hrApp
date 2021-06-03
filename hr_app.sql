-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 03, 2021 at 02:05 PM
-- Server version: 10.4.19-MariaDB
-- PHP Version: 7.4.19

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `hr_app`
--

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

CREATE TABLE `admins` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `company_id` bigint(20) UNSIGNED DEFAULT NULL,
  `position` varchar(64) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `gender` varchar(8) COLLATE utf8mb4_unicode_ci NOT NULL,
  `type` tinyint(1) NOT NULL,
  `contact` bigint(20) NOT NULL,
  `profile_picture` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` tinyint(1) NOT NULL,
  `created_by` bigint(20) UNSIGNED DEFAULT NULL,
  `updated_by` bigint(20) UNSIGNED DEFAULT NULL,
  `deleted_by` bigint(20) UNSIGNED DEFAULT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`id`, `name`, `email`, `company_id`, `position`, `gender`, `type`, `contact`, `profile_picture`, `password`, `status`, `created_by`, `updated_by`, `deleted_by`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Super Admin', 'super@admin.com', NULL, NULL, 'male', 0, 9843180434, 'snap20210322070936.jpg', '$2y$10$2Zbg6bRxr1auvLRcbnOrx.O3YbMeK.a1rIaMZLR1Y.XiyueoYgAia', 1, NULL, 1, NULL, 'QqVJU8vDgljCBimdXT9pP2q0ntnsWdceInlTRbZUblwVRkgOVKlr8ASbbGff', '2019-12-29 23:52:55', '2021-03-22 01:24:36'),
(3, 'Sunil Pathak', 'sunil.pathak@gmail.com', 1, 'GM', 'male', 1, 9841344256, 'viber_image_2019-12-14_14-35-21_1577685700.jpg', '$2y$10$36d8ijCfa7jXh3V4aJD6buJQ.z7e/qsUQ9bHh.sEbXPfG/ATy603m', 1, 1, 1, 1, 'CyfZUToS9tUwL1rqXxhwf45NCwDx3cqsqwpjuYWUr2bn0AqUS1rF9DBv0jQu', '2019-12-30 00:16:40', '2020-01-01 02:52:45'),
(5, 'Ramesh Basaula', 'ramesh.basaula@gmail.com', 2, 'GM', 'male', 1, 9846456765, '7010d-15750379274286-800_1577850583.jpg', '$2y$10$DQ1elRi1wa9GjZVm88f5bu0RE4T4QkIAqWGYix0IaYP.7c50yXPYi', 1, 1, 5, NULL, 'ZCAim4m77h9YRXA7uiJub8eZ5rkWqXQW2LWSh2eL6bvuD9m1tMmIHvp9dIkI', '2019-12-30 02:00:07', '2019-12-31 22:04:43'),
(6, 'Sudip gharti magar', 'sudip.gm@gmail.com', 3, 'Manager', 'male', 1, 9843180434, 'images_1577867991.jpg', '$2y$10$mkAqZGjXX8UyU8l4kDGMseiwUENoyW6/oG08afSKx4k8TyD0RO9ni', 1, 1, NULL, NULL, NULL, '2020-01-01 02:54:51', '2020-01-01 02:54:51'),
(7, 'Ram Thapa', 'ram@gmail.com', 1, 'Manager', 'male', 2, 9846456765, 'luka-siradze_1577868415.jpg', '$2y$10$SUNYSR6Tqce7i.utWZBNteXoRKfhkfcgSmuNKyUZWPd7WsqvUwEx6', 1, 3, 1, 1, '2fsOREjPX1K4ujplaRWGsLc0gVoO5HCVfZZzaPIVnAxdJZ4nNiofGPE84eqd', '2020-01-01 03:01:55', '2021-03-22 01:27:25'),
(20, 'Sandip Silwal', 'sandip.silwal.ss@gmail.com', NULL, NULL, 'male', 0, 9843180434, 'nopp.jpg', '$2y$10$w2QG4ubfmB2Y5O1J8/5ym.7EKVeHKoqFJ6PnTtOK937vVR1Azs9uS', 0, NULL, NULL, 1, NULL, '2020-01-02 03:09:20', '2020-01-02 23:33:30'),
(21, 'kjyoiuh', 'aerg@gmail.com', 1, 'Manager', 'male', 1, 9843125486, 'nopp.jpg', '$2y$10$WeS7QasC.Z1s1Qe7h7qW9O0vgu/ea7dH6u4PZ9THBV27q8Z2lQS1i', 1, 1, NULL, NULL, NULL, '2021-03-22 01:33:02', '2021-03-22 01:33:02'),
(22, 'lekhnath silwal', 'lekhnath.silwal.ls@gmail.com', 1, 'Principal', 'male', 2, 9843567456, 'nopp.jpg', '$2y$10$qFfwCrkXi29KjMz/uQfnMeBpTionr4UXGPPzqkj2FLcf2pasMHY4C', 1, 3, NULL, NULL, NULL, '2021-03-22 01:50:44', '2021-03-22 01:50:44'),
(23, 'Piyush Chor', 'pmaharjanrocks@gmail.com', 2, 'CEO', 'male', 1, 9808977556, 'nopp.jpg', '$2y$10$Xu1Arieg0601wWYN1Ys6YOrm325H/SwMnKkJz.B9FU9DOK3cB.zKK', 1, 1, NULL, NULL, 'WwEYofvi2ZDzND4rRJUXJcpOepmf1cMZka3oqOriKgoepoei1Qywnx2ZePSR', '2021-03-22 01:54:08', '2021-03-22 01:54:08');

-- --------------------------------------------------------

--
-- Table structure for table `admin_roles`
--

CREATE TABLE `admin_roles` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `admin_id` bigint(20) UNSIGNED NOT NULL,
  `role_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `admin_roles`
--

INSERT INTO `admin_roles` (`id`, `admin_id`, `role_id`, `created_at`, `updated_at`) VALUES
(1, 3, 1, '2019-12-30 00:16:40', '2019-12-30 00:16:40'),
(3, 5, 1, '2019-12-30 02:00:07', '2019-12-30 02:00:07'),
(4, 6, 1, '2020-01-01 02:54:51', '2020-01-01 02:54:51'),
(5, 7, 2, '2020-01-01 03:01:55', '2020-01-01 03:01:55'),
(6, 22, 2, '2021-03-22 01:50:50', '2021-03-22 01:50:50'),
(7, 23, 1, '2021-03-22 01:54:13', '2021-03-22 01:54:13');

-- --------------------------------------------------------

--
-- Table structure for table `companies`
--

CREATE TABLE `companies` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `companies`
--

INSERT INTO `companies` (`id`, `name`, `image`, `created_at`, `updated_at`) VALUES
(1, 'F1Soft', 'f1-soft_1577867311.png', '2019-12-30 00:00:35', '2020-01-01 02:43:31'),
(2, 'Cotiviti', 'cotiviti_1577867326.jpg', '2019-12-30 00:01:26', '2020-01-01 02:43:46'),
(3, 'Yomari', 'Final_YCO-Logo_1577867352.gif', '2020-01-01 02:44:12', '2020-01-01 02:44:12'),
(4, 'Fuse Machine', 'fusemachine_1577867375.jpg', '2020-01-01 02:44:35', '2020-01-01 02:44:35'),
(5, 'Mercantile', 'mercantile_logo_nepal79bad91_1577867419.jpg', '2020-01-01 02:45:19', '2020-01-01 02:45:19');

-- --------------------------------------------------------

--
-- Table structure for table `crudables`
--

CREATE TABLE `crudables` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `crudables`
--

INSERT INTO `crudables` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1, 'company', '2019-12-29 23:52:55', NULL),
(2, 'department', '2019-12-29 23:52:55', NULL),
(3, 'section', '2019-12-29 23:52:55', NULL),
(4, 'role', '2019-12-29 23:52:55', NULL),
(5, 'admin', '2019-12-29 23:52:55', NULL),
(6, 'employee', '2019-12-29 23:52:55', NULL),
(7, 'employee_experience', '2019-12-29 23:52:55', NULL),
(8, 'trash', '2019-12-29 23:52:55', NULL),
(9, 'super_admin', '2019-12-29 23:52:55', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `departments`
--

CREATE TABLE `departments` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` tinyint(1) NOT NULL,
  `created_by` bigint(20) UNSIGNED DEFAULT NULL,
  `updated_by` bigint(20) UNSIGNED DEFAULT NULL,
  `deleted_by` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `departments`
--

INSERT INTO `departments` (`id`, `name`, `description`, `image`, `status`, `created_by`, `updated_by`, `deleted_by`, `created_at`, `updated_at`) VALUES
(1, 'Software', 'sdfsdfsdf', '1_51hBjHEPtzrPgVVXKyxe2A_1577852697.png', 1, 3, 5, 3, '2019-12-30 00:17:25', '2019-12-31 22:39:57'),
(2, 'Human Resource', 'This is human resource department', 'Human_Resource1560252226864_1577869261.png', 1, 3, NULL, NULL, '2020-01-01 03:16:01', '2020-01-01 03:16:01'),
(3, 'Finance Department', 'This is finance department', 'income-23_1577869398.jpg', 1, 3, NULL, NULL, '2020-01-01 03:18:18', '2020-01-01 03:18:18'),
(4, 'Marketing', 'This is marketing department', '559-Marketing-Department-Organization-Tools-Responsibilities_1577869569.png', 1, 3, NULL, NULL, '2020-01-01 03:21:09', '2020-01-01 03:21:09');

-- --------------------------------------------------------

--
-- Table structure for table `employees`
--

CREATE TABLE `employees` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `address` varchar(128) COLLATE utf8mb4_unicode_ci NOT NULL,
  `contact` bigint(20) NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `gender` varchar(8) COLLATE utf8mb4_unicode_ci NOT NULL,
  `dob` date NOT NULL,
  `profile_picture` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` tinyint(1) NOT NULL,
  `created_by` bigint(20) UNSIGNED DEFAULT NULL,
  `updated_by` bigint(20) UNSIGNED DEFAULT NULL,
  `deleted_by` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `employees`
--

INSERT INTO `employees` (`id`, `name`, `address`, `contact`, `email`, `gender`, `dob`, `profile_picture`, `status`, `created_by`, `updated_by`, `deleted_by`, `created_at`, `updated_at`) VALUES
(1, 'sdfdf', 'sdf', 9846456765, 'asdfsdf@jlj.com', 'male', '2323-03-23', 'images_1577853159.jpg', 0, 3, 5, 1, '2019-12-30 00:21:31', '2020-01-01 05:30:05'),
(2, 'Hari Aryal', 'Gongabu, Kathmandu, Nepal', 9846456765, 'hari.aryal@gmail.com', 'male', '2019-12-26', 'fusemachine_1577686191.jpg', 1, 3, 3, 1, '2019-12-30 00:24:51', '2020-01-01 05:51:48'),
(3, 'Sandesh Lohani', 'Banasthali, Kathmandu, Nepal', 9841344256, 'sandesh@gmail.com', 'male', '1990-01-14', 'sandip_1577868644.jpg', 1, 3, 1, 1, '2020-01-01 03:05:44', '2021-03-22 01:27:31');

-- --------------------------------------------------------

--
-- Table structure for table `employee_histories`
--

CREATE TABLE `employee_histories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `employee_id` bigint(20) UNSIGNED NOT NULL,
  `company_id` bigint(20) UNSIGNED DEFAULT NULL,
  `joined_date` date NOT NULL,
  `position` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `department_id` bigint(20) UNSIGNED NOT NULL,
  `section_id` bigint(20) UNSIGNED NOT NULL,
  `resigned_date` date DEFAULT NULL,
  `supervisor_id` bigint(20) UNSIGNED DEFAULT NULL,
  `review` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` tinyint(1) NOT NULL,
  `shift_from` time NOT NULL,
  `shift_to` time NOT NULL,
  `created_by` bigint(20) UNSIGNED DEFAULT NULL,
  `updated_by` bigint(20) UNSIGNED DEFAULT NULL,
  `deleted_by` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `employee_histories`
--

INSERT INTO `employee_histories` (`id`, `employee_id`, `company_id`, `joined_date`, `position`, `department_id`, `section_id`, `resigned_date`, `supervisor_id`, `review`, `status`, `shift_from`, `shift_to`, `created_by`, `updated_by`, `deleted_by`, `created_at`, `updated_at`) VALUES
(1, 2, 1, '2017-03-12', 'sdfsdf', 1, 1, '2019-01-23', 3, 'asdfsdf', 1, '02:32:00', '02:32:00', 3, 3, NULL, '2019-12-30 00:28:23', '2020-01-01 05:53:14'),
(2, 2, 2, '2019-12-12', 'GM', 1, 1, '2019-12-20', 5, NULL, 1, '03:22:00', '02:32:00', 5, 5, 5, '2019-12-30 02:06:47', '2019-12-30 04:45:35'),
(3, 2, 2, '2019-12-17', 'GM', 1, 1, NULL, 5, NULL, 1, '14:23:00', '03:23:00', 5, 5, NULL, '2019-12-30 03:09:56', '2019-12-30 05:38:33'),
(4, 1, 2, '2020-01-16', 'GM', 1, 1, NULL, 5, NULL, 1, '12:59:00', '00:59:00', 5, NULL, NULL, '2019-12-31 22:47:15', '2019-12-31 22:47:15'),
(5, 3, 1, '2017-01-09', 'Junior Developer', 1, 2, NULL, 3, NULL, 1, '09:00:00', '18:00:00', 3, 3, NULL, '2020-01-01 03:08:45', '2020-01-01 03:14:54'),
(6, 1, 1, '2016-01-09', 'Senior Developer', 1, 3, '2020-01-15', 7, 'He was a good developer', 1, '09:00:00', '18:00:00', 3, NULL, NULL, '2020-01-01 03:12:39', '2020-01-01 03:12:39');

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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
(1, '2014_10_12_100000_create_password_resets_table', 1),
(2, '2019_08_19_000000_create_failed_jobs_table', 1),
(3, '2019_12_03_115046_create_companies_table', 1),
(4, '2019_12_04_075035_create_admins_table', 1),
(5, '2019_12_05_062804_create_crudables_table', 1),
(6, '2019_12_06_055038_create_roles_table', 1),
(7, '2019_12_07_065605_create_role_crudables_table', 1),
(8, '2019_12_08_063002_create_permissions_table', 1),
(9, '2019_12_08_063249_create_admin_roles_table', 1),
(10, '2019_12_09_053358_create_departments_table', 1),
(11, '2019_12_10_053513_create_sections_table', 1),
(12, '2019_12_11_075059_create_employees_table', 1),
(13, '2019_12_12_091601_create_employee_histories_table', 1);

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `permissions`
--

CREATE TABLE `permissions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `role_crudable_id` bigint(20) UNSIGNED NOT NULL,
  `c` tinyint(1) NOT NULL DEFAULT 0,
  `r` tinyint(1) NOT NULL DEFAULT 0,
  `u` tinyint(1) NOT NULL DEFAULT 0,
  `d` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `permissions`
--

INSERT INTO `permissions` (`id`, `role_crudable_id`, `c`, `r`, `u`, `d`, `created_at`, `updated_at`) VALUES
(22, 22, 1, 1, 1, 1, '2020-01-01 02:52:17', '2020-01-01 02:52:17'),
(23, 23, 1, 1, 1, 1, '2020-01-01 02:52:17', '2020-01-01 02:52:17'),
(24, 24, 1, 1, 1, 1, '2020-01-01 02:52:17', '2020-01-01 02:52:17'),
(25, 25, 1, 1, 1, 1, '2020-01-01 02:52:17', '2020-01-01 02:52:17'),
(26, 26, 1, 1, 1, 0, '2020-01-01 02:52:17', '2020-01-01 02:52:17'),
(27, 27, 1, 1, 1, 1, '2020-01-01 02:52:17', '2020-01-01 02:52:17'),
(28, 28, 1, 1, 0, 0, '2020-01-01 02:52:17', '2020-01-01 02:52:17'),
(29, 29, 1, 1, 1, 1, '2020-01-01 03:00:28', '2020-01-01 03:00:28'),
(30, 30, 1, 1, 1, 1, '2020-01-01 03:00:28', '2020-01-01 03:00:28'),
(31, 31, 1, 1, 1, 1, '2020-01-01 03:00:28', '2020-01-01 03:00:28'),
(32, 32, 1, 1, 1, 0, '2020-01-01 03:00:28', '2020-01-01 03:00:28'),
(33, 33, 1, 1, 1, 0, '2020-01-01 03:00:28', '2020-01-01 03:00:28'),
(34, 34, 1, 1, 1, 1, '2020-01-01 03:00:28', '2020-01-01 03:00:28'),
(35, 35, 1, 1, 0, 0, '2020-01-01 03:00:28', '2020-01-01 03:00:28');

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` tinyint(1) NOT NULL,
  `created_by` bigint(20) UNSIGNED DEFAULT NULL,
  `updated_by` bigint(20) UNSIGNED DEFAULT NULL,
  `deleted_by` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `name`, `status`, `created_by`, `updated_by`, `deleted_by`, `created_at`, `updated_at`) VALUES
(1, 'Super Admin', 1, 1, 1, NULL, '2019-12-30 00:15:36', '2019-12-30 04:12:43'),
(2, 'admin', 1, 3, 3, NULL, '2019-12-30 00:19:16', '2020-01-01 03:00:28');

-- --------------------------------------------------------

--
-- Table structure for table `role_crudables`
--

CREATE TABLE `role_crudables` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `role_id` bigint(20) UNSIGNED NOT NULL,
  `crudable_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `role_crudables`
--

INSERT INTO `role_crudables` (`id`, `role_id`, `crudable_id`, `created_at`, `updated_at`) VALUES
(22, 1, 2, '2020-01-01 02:52:17', '2020-01-01 02:52:17'),
(23, 1, 3, '2020-01-01 02:52:17', '2020-01-01 02:52:17'),
(24, 1, 4, '2020-01-01 02:52:17', '2020-01-01 02:52:17'),
(25, 1, 5, '2020-01-01 02:52:17', '2020-01-01 02:52:17'),
(26, 1, 6, '2020-01-01 02:52:17', '2020-01-01 02:52:17'),
(27, 1, 7, '2020-01-01 02:52:17', '2020-01-01 02:52:17'),
(28, 1, 8, '2020-01-01 02:52:17', '2020-01-01 02:52:17'),
(29, 2, 2, '2020-01-01 03:00:28', '2020-01-01 03:00:28'),
(30, 2, 3, '2020-01-01 03:00:28', '2020-01-01 03:00:28'),
(31, 2, 4, '2020-01-01 03:00:28', '2020-01-01 03:00:28'),
(32, 2, 5, '2020-01-01 03:00:28', '2020-01-01 03:00:28'),
(33, 2, 6, '2020-01-01 03:00:28', '2020-01-01 03:00:28'),
(34, 2, 7, '2020-01-01 03:00:28', '2020-01-01 03:00:28'),
(35, 2, 8, '2020-01-01 03:00:28', '2020-01-01 03:00:28');

-- --------------------------------------------------------

--
-- Table structure for table `sections`
--

CREATE TABLE `sections` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` tinyint(1) NOT NULL,
  `department_id` bigint(20) UNSIGNED NOT NULL,
  `created_by` bigint(20) UNSIGNED DEFAULT NULL,
  `updated_by` bigint(20) UNSIGNED DEFAULT NULL,
  `deleted_by` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sections`
--

INSERT INTO `sections` (`id`, `name`, `description`, `image`, `status`, `department_id`, `created_by`, `updated_by`, `deleted_by`, `created_at`, `updated_at`) VALUES
(1, 'Android', 'This is android section', 'google_android_reuters_1557489952979_1577852771.jpg', 0, 1, 3, 5, 1, '2019-12-30 00:18:22', '2020-01-01 05:30:18'),
(2, 'Java', 'This is Java section', 'Java_1577868098.jpg', 1, 1, 3, NULL, NULL, '2020-01-01 02:56:38', '2020-01-01 02:56:38'),
(3, 'PHP Section', 'This is php section', 'download_1577868175.png', 1, 1, 3, NULL, NULL, '2020-01-01 02:57:55', '2020-01-01 02:57:55'),
(4, 'Payroll Section', 'This is payroll section', 'payroll_1577869433.jpg', 1, 3, 3, NULL, NULL, '2020-01-01 03:18:53', '2020-01-01 03:18:53'),
(5, 'Python Section', 'This is python section', 'python_1577869470.png', 1, 1, 3, NULL, NULL, '2020-01-01 03:19:30', '2020-01-01 03:19:30');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `admins_email_unique` (`email`),
  ADD KEY `admins_company_id_foreign` (`company_id`),
  ADD KEY `admins_created_by_foreign` (`created_by`),
  ADD KEY `admins_updated_by_foreign` (`updated_by`),
  ADD KEY `admins_deleted_by_foreign` (`deleted_by`);

--
-- Indexes for table `admin_roles`
--
ALTER TABLE `admin_roles`
  ADD PRIMARY KEY (`id`),
  ADD KEY `admin_roles_admin_id_foreign` (`admin_id`),
  ADD KEY `admin_roles_role_id_foreign` (`role_id`);

--
-- Indexes for table `companies`
--
ALTER TABLE `companies`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `companies_name_unique` (`name`);

--
-- Indexes for table `crudables`
--
ALTER TABLE `crudables`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `departments`
--
ALTER TABLE `departments`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `departments_name_unique` (`name`),
  ADD KEY `departments_created_by_foreign` (`created_by`),
  ADD KEY `departments_updated_by_foreign` (`updated_by`),
  ADD KEY `departments_deleted_by_foreign` (`deleted_by`);

--
-- Indexes for table `employees`
--
ALTER TABLE `employees`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `employees_email_unique` (`email`),
  ADD KEY `employees_created_by_foreign` (`created_by`),
  ADD KEY `employees_updated_by_foreign` (`updated_by`),
  ADD KEY `employees_deleted_by_foreign` (`deleted_by`);

--
-- Indexes for table `employee_histories`
--
ALTER TABLE `employee_histories`
  ADD PRIMARY KEY (`id`),
  ADD KEY `employee_histories_employee_id_foreign` (`employee_id`),
  ADD KEY `employee_histories_company_id_foreign` (`company_id`),
  ADD KEY `employee_histories_department_id_foreign` (`department_id`),
  ADD KEY `employee_histories_section_id_foreign` (`section_id`),
  ADD KEY `employee_histories_supervisor_id_foreign` (`supervisor_id`),
  ADD KEY `employee_histories_created_by_foreign` (`created_by`),
  ADD KEY `employee_histories_updated_by_foreign` (`updated_by`),
  ADD KEY `employee_histories_deleted_by_foreign` (`deleted_by`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `permissions`
--
ALTER TABLE `permissions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `permissions_role_crudable_id_foreign` (`role_crudable_id`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`),
  ADD KEY `roles_created_by_foreign` (`created_by`),
  ADD KEY `roles_updated_by_foreign` (`updated_by`),
  ADD KEY `roles_deleted_by_foreign` (`deleted_by`);

--
-- Indexes for table `role_crudables`
--
ALTER TABLE `role_crudables`
  ADD PRIMARY KEY (`id`),
  ADD KEY `role_crudables_role_id_foreign` (`role_id`),
  ADD KEY `role_crudables_crudable_id_foreign` (`crudable_id`);

--
-- Indexes for table `sections`
--
ALTER TABLE `sections`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sections_department_id_foreign` (`department_id`),
  ADD KEY `sections_created_by_foreign` (`created_by`),
  ADD KEY `sections_updated_by_foreign` (`updated_by`),
  ADD KEY `sections_deleted_by_foreign` (`deleted_by`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admins`
--
ALTER TABLE `admins`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `admin_roles`
--
ALTER TABLE `admin_roles`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `companies`
--
ALTER TABLE `companies`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `crudables`
--
ALTER TABLE `crudables`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `departments`
--
ALTER TABLE `departments`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `employees`
--
ALTER TABLE `employees`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `employee_histories`
--
ALTER TABLE `employee_histories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `permissions`
--
ALTER TABLE `permissions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `role_crudables`
--
ALTER TABLE `role_crudables`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT for table `sections`
--
ALTER TABLE `sections`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `admins`
--
ALTER TABLE `admins`
  ADD CONSTRAINT `admins_company_id_foreign` FOREIGN KEY (`company_id`) REFERENCES `companies` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `admins_created_by_foreign` FOREIGN KEY (`created_by`) REFERENCES `admins` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `admins_deleted_by_foreign` FOREIGN KEY (`deleted_by`) REFERENCES `admins` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `admins_updated_by_foreign` FOREIGN KEY (`updated_by`) REFERENCES `admins` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `admin_roles`
--
ALTER TABLE `admin_roles`
  ADD CONSTRAINT `admin_roles_admin_id_foreign` FOREIGN KEY (`admin_id`) REFERENCES `admins` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `admin_roles_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `departments`
--
ALTER TABLE `departments`
  ADD CONSTRAINT `departments_created_by_foreign` FOREIGN KEY (`created_by`) REFERENCES `admins` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `departments_deleted_by_foreign` FOREIGN KEY (`deleted_by`) REFERENCES `admins` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `departments_updated_by_foreign` FOREIGN KEY (`updated_by`) REFERENCES `admins` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `employees`
--
ALTER TABLE `employees`
  ADD CONSTRAINT `employees_created_by_foreign` FOREIGN KEY (`created_by`) REFERENCES `admins` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `employees_deleted_by_foreign` FOREIGN KEY (`deleted_by`) REFERENCES `admins` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `employees_updated_by_foreign` FOREIGN KEY (`updated_by`) REFERENCES `admins` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `employee_histories`
--
ALTER TABLE `employee_histories`
  ADD CONSTRAINT `employee_histories_company_id_foreign` FOREIGN KEY (`company_id`) REFERENCES `companies` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `employee_histories_created_by_foreign` FOREIGN KEY (`created_by`) REFERENCES `admins` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `employee_histories_deleted_by_foreign` FOREIGN KEY (`deleted_by`) REFERENCES `admins` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `employee_histories_department_id_foreign` FOREIGN KEY (`department_id`) REFERENCES `departments` (`id`),
  ADD CONSTRAINT `employee_histories_employee_id_foreign` FOREIGN KEY (`employee_id`) REFERENCES `employees` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `employee_histories_section_id_foreign` FOREIGN KEY (`section_id`) REFERENCES `sections` (`id`),
  ADD CONSTRAINT `employee_histories_supervisor_id_foreign` FOREIGN KEY (`supervisor_id`) REFERENCES `admins` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `employee_histories_updated_by_foreign` FOREIGN KEY (`updated_by`) REFERENCES `admins` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `permissions`
--
ALTER TABLE `permissions`
  ADD CONSTRAINT `permissions_role_crudable_id_foreign` FOREIGN KEY (`role_crudable_id`) REFERENCES `role_crudables` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `roles`
--
ALTER TABLE `roles`
  ADD CONSTRAINT `roles_created_by_foreign` FOREIGN KEY (`created_by`) REFERENCES `admins` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `roles_deleted_by_foreign` FOREIGN KEY (`deleted_by`) REFERENCES `admins` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `roles_updated_by_foreign` FOREIGN KEY (`updated_by`) REFERENCES `admins` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `role_crudables`
--
ALTER TABLE `role_crudables`
  ADD CONSTRAINT `role_crudables_crudable_id_foreign` FOREIGN KEY (`crudable_id`) REFERENCES `crudables` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `role_crudables_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `sections`
--
ALTER TABLE `sections`
  ADD CONSTRAINT `sections_created_by_foreign` FOREIGN KEY (`created_by`) REFERENCES `admins` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `sections_deleted_by_foreign` FOREIGN KEY (`deleted_by`) REFERENCES `admins` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `sections_department_id_foreign` FOREIGN KEY (`department_id`) REFERENCES `departments` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `sections_updated_by_foreign` FOREIGN KEY (`updated_by`) REFERENCES `admins` (`id`) ON DELETE SET NULL;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
