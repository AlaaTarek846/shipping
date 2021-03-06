-- phpMyAdmin SQL Dump
-- version 5.1.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 08, 2022 at 01:44 PM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 7.4.29

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `shipping`
--

-- --------------------------------------------------------

--
-- Table structure for table `additional_services`
--

CREATE TABLE `additional_services` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `price` double(8,2) NOT NULL DEFAULT 0.00,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

CREATE TABLE `admins` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `photo` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`id`, `name`, `photo`, `user_id`, `created_at`, `updated_at`) VALUES
(1, 'Super_Admin', NULL, 1, '2022-06-08 11:35:26', '2022-06-08 11:35:26');

-- --------------------------------------------------------

--
-- Table structure for table `advertisements`
--

CREATE TABLE `advertisements` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `photo` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `areas`
--

CREATE TABLE `areas` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `province_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `branches`
--

CREATE TABLE `branches` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `address` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `location` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `photo` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phone` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `area_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `cities`
--

CREATE TABLE `cities` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `city_name_ar` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `governorate_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `cities`
--

INSERT INTO `cities` (`id`, `city_name_ar`, `governorate_id`, `created_at`, `updated_at`) VALUES
(1, '15 ????????', 1, NULL, NULL),
(2, '????????????????', 1, NULL, NULL),
(3, '????????????????', 1, NULL, NULL),
(4, '????????????', 1, NULL, NULL),
(5, '??????????????', 1, NULL, NULL),
(6, '??????????????', 1, NULL, NULL),
(7, '?????????? ????????????', 1, NULL, NULL),
(8, '?????????????? ??????????????', 1, NULL, NULL),
(9, '??????????????', 1, NULL, NULL),
(10, '????????????', 1, NULL, NULL),
(11, '????????????', 1, NULL, NULL),
(12, '???????????? ????????', 1, NULL, NULL),
(13, '????????????????', 1, NULL, NULL),
(14, '?????????? ????????????', 1, NULL, NULL),
(15, '????????????', 1, NULL, NULL),
(16, '????????????', 1, NULL, NULL),
(17, '?????????????? ??????????????', 1, NULL, NULL),
(18, '??????????', 1, NULL, NULL),
(19, '???????? ??????????', 1, NULL, NULL),
(20, '??????????????', 1, NULL, NULL),
(21, '??????????????', 1, NULL, NULL),
(22, '??????????????', 1, NULL, NULL),
(23, '????????????', 1, NULL, NULL),
(24, '????????????', 1, NULL, NULL),
(25, '??????????????', 1, NULL, NULL),
(26, '????????????', 1, NULL, NULL),
(27, '??????????????', 1, NULL, NULL),
(28, '?????? ??????????????', 1, NULL, NULL),
(29, '??????????', 1, NULL, NULL),
(30, '?????????? ????????', 1, NULL, NULL),
(31, '?????????? ??????????', 1, NULL, NULL),
(32, '??????????', 1, NULL, NULL),
(33, '?????? ????????????', 1, NULL, NULL),
(34, '????????', 1, NULL, NULL),
(35, '??????', 1, NULL, NULL),
(36, '????????????', 1, NULL, NULL),
(37, '????????????', 1, NULL, NULL),
(38, '?????? ??????', 1, NULL, NULL),
(39, '?????????? ??????', 1, NULL, NULL),
(40, '?????? ??????????????', 1, NULL, NULL),
(41, '?????? ??????????????', 1, NULL, NULL),
(42, '?????????? ????????', 1, NULL, NULL),
(43, '?????????? ??????', 1, NULL, NULL),
(44, '?????????? ????????????', 1, NULL, NULL),
(45, '?????? ??????????', 1, NULL, NULL),
(46, '??????????????', 1, NULL, NULL),
(47, '?????? ??????????', 1, NULL, NULL),
(48, '????????????', 1, NULL, NULL),
(49, '????????????????', 1, NULL, NULL),
(50, '????????????', 1, NULL, NULL),
(51, '?????? ??????????', 1, NULL, NULL),
(52, '??????????????', 1, NULL, NULL),
(53, '????????????????', 1, NULL, NULL),
(54, '???????????? ???? ??????????', 1, NULL, NULL),
(55, '??????????????', 1, NULL, NULL),
(56, '???????????? ??????????????', 1, NULL, NULL),
(57, '?????????????? ????????????????', 1, NULL, NULL),
(58, '????????????', 2, NULL, NULL),
(59, '???????????? ???? ????????????', 2, NULL, NULL),
(60, '?????????? ????????', 2, NULL, NULL),
(61, '??????????????????', 2, NULL, NULL),
(62, '????????????????', 2, NULL, NULL),
(63, '????????', 2, NULL, NULL),
(64, '??????????', 2, NULL, NULL),
(65, '????????????', 2, NULL, NULL),
(66, '????????????????', 2, NULL, NULL),
(67, '?????????? ??????????????', 2, NULL, NULL),
(68, '??????????', 2, NULL, NULL),
(69, '????????????', 2, NULL, NULL),
(70, '?????? ????????????', 2, NULL, NULL),
(71, '?????? ??????????', 2, NULL, NULL),
(72, '?????????? ??????????????', 2, NULL, NULL),
(73, '??????????', 2, NULL, NULL),
(74, '??????????????', 2, NULL, NULL),
(75, '??????????', 2, NULL, NULL),
(76, '????????????', 2, NULL, NULL),
(77, '????????????', 2, NULL, NULL),
(78, '?????????? ??????????????', 2, NULL, NULL),
(79, '?????????????? ??????????????', 2, NULL, NULL),
(80, '??????????????????', 2, NULL, NULL),
(81, '????????????', 2, NULL, NULL),
(82, '?????? ????????????????', 2, NULL, NULL),
(83, '?????????? ??????', 2, NULL, NULL),
(84, '??????????????????', 2, NULL, NULL),
(85, '????????', 2, NULL, NULL),
(86, '?????? ????????', 2, NULL, NULL),
(87, '?????????? ??????????????', 2, NULL, NULL),
(88, '????????????????', 2, NULL, NULL),
(89, '?????????? ????????????', 2, NULL, NULL),
(90, '?????? ??????????', 2, NULL, NULL),
(91, '???????????? ????????????', 2, NULL, NULL),
(92, '?????? ????????????', 2, NULL, NULL),
(93, '?????? ??????', 3, NULL, NULL),
(94, '??????????????????????', 3, NULL, NULL),
(95, '??????????????????', 3, NULL, NULL),
(96, '????????????????', 3, NULL, NULL),
(97, '??????????????', 3, NULL, NULL),
(98, '????????????', 3, NULL, NULL),
(99, '????????????????', 3, NULL, NULL),
(100, '????????????', 3, NULL, NULL),
(101, '????????????????', 3, NULL, NULL),
(102, '??????????????', 3, NULL, NULL),
(103, '??????????????', 3, NULL, NULL),
(104, '????????????????', 3, NULL, NULL),
(105, '??????????????', 3, NULL, NULL),
(106, '?????? ??????', 3, NULL, NULL),
(107, '?????? ??????????', 3, NULL, NULL),
(108, '????????????', 3, NULL, NULL),
(109, '??????????', 3, NULL, NULL),
(110, '???????? ??????', 3, NULL, NULL),
(111, '??????', 3, NULL, NULL),
(112, '?????? ??????????', 3, NULL, NULL),
(113, '????????????', 3, NULL, NULL),
(114, '????????????????', 3, NULL, NULL),
(115, '???????? ??????????', 3, NULL, NULL),
(116, '??????????', 3, NULL, NULL),
(117, '???????? ??????????', 3, NULL, NULL),
(118, '???????? ??????????', 3, NULL, NULL),
(119, '????????????????', 3, NULL, NULL),
(120, '????????????', 3, NULL, NULL),
(121, '????????', 3, NULL, NULL),
(122, '????????????', 3, NULL, NULL),
(123, '??????????????????', 3, NULL, NULL),
(124, '????????', 3, NULL, NULL),
(125, '????????????????', 3, NULL, NULL),
(126, '??????????????', 3, NULL, NULL),
(127, '???????? ????', 3, NULL, NULL),
(128, '??????????????', 3, NULL, NULL),
(129, '???????? ????????', 3, NULL, NULL),
(130, '???????????? ??????????????', 3, NULL, NULL),
(131, '????????????', 3, NULL, NULL),
(132, '????????????????', 3, NULL, NULL),
(133, '???????? ????????', 3, NULL, NULL),
(134, '????????????', 3, NULL, NULL),
(135, '??????????', 3, NULL, NULL),
(136, '????????????', 3, NULL, NULL),
(137, '????????????????', 4, NULL, NULL),
(138, '????????', 4, NULL, NULL),
(139, '?????? ??????', 4, NULL, NULL),
(140, '??????????', 4, NULL, NULL),
(141, '??????', 4, NULL, NULL),
(142, '???????? ??????????', 4, NULL, NULL),
(143, '????????????????????', 4, NULL, NULL),
(144, '????????????', 4, NULL, NULL),
(145, '?????? ????????', 4, NULL, NULL),
(146, '??????????????', 4, NULL, NULL),
(147, '?????? ??????????????', 4, NULL, NULL),
(148, '????????????????', 4, NULL, NULL),
(149, '??????????', 4, NULL, NULL),
(150, '??????????????', 4, NULL, NULL),
(151, '??????????', 4, NULL, NULL),
(152, '?????? ??????????', 4, NULL, NULL),
(153, '????????', 4, NULL, NULL),
(154, '???????? ????????', 4, NULL, NULL),
(155, '??????????', 4, NULL, NULL),
(156, '??????????????', 5, NULL, NULL),
(157, '?????? ????????', 5, NULL, NULL),
(158, '??????????', 5, NULL, NULL),
(159, '????????????', 5, NULL, NULL),
(160, '???????? ??????', 5, NULL, NULL),
(161, '????????????????', 5, NULL, NULL),
(162, '??????????', 5, NULL, NULL),
(163, '????????????', 5, NULL, NULL),
(164, '????????????', 6, NULL, NULL),
(165, '?????? ????????????', 6, NULL, NULL),
(166, '????????', 6, NULL, NULL),
(167, '????????', 6, NULL, NULL),
(168, '?????? ????????????????', 6, NULL, NULL),
(169, '?????? ??????', 6, NULL, NULL),
(170, '????????????????', 6, NULL, NULL),
(171, '??????????????????', 6, NULL, NULL),
(172, '??????????????????', 6, NULL, NULL),
(173, '?????????? ??????????????', 6, NULL, NULL),
(174, '?????? ????????', 6, NULL, NULL),
(175, '??????????????', 6, NULL, NULL),
(176, '?????? ??????????', 6, NULL, NULL),
(177, '??????', 6, NULL, NULL),
(178, '???????? ??????????????', 6, NULL, NULL),
(179, '?????????????????? ??????????????', 6, NULL, NULL),
(180, '??????????????????', 6, NULL, NULL),
(181, '????????????', 7, NULL, NULL),
(182, '???????????? ??????????????', 7, NULL, NULL),
(183, '??????????', 7, NULL, NULL),
(184, '??????????', 7, NULL, NULL),
(185, '????????', 7, NULL, NULL),
(186, '????????????', 7, NULL, NULL),
(187, '???????? ????????????', 7, NULL, NULL),
(188, '??????????????', 7, NULL, NULL),
(189, '????????', 7, NULL, NULL),
(190, '??????????????', 7, NULL, NULL),
(191, '??????????????', 7, NULL, NULL),
(192, '????????', 8, NULL, NULL),
(193, '???????????? ????????????', 8, NULL, NULL),
(194, '?????? ????????????', 8, NULL, NULL),
(195, '????????', 8, NULL, NULL),
(196, '????????????', 8, NULL, NULL),
(197, '????????', 8, NULL, NULL),
(198, '??????????', 8, NULL, NULL),
(199, '??????????', 8, NULL, NULL),
(200, '??????????????????????', 9, NULL, NULL),
(201, '????????', 9, NULL, NULL),
(202, '?????????????? ??????', 9, NULL, NULL),
(203, '?????????????? ??????', 9, NULL, NULL),
(204, '???????? ????????????', 9, NULL, NULL),
(205, '?????? ????????', 9, NULL, NULL),
(206, '???????????????? ??????????????', 9, NULL, NULL),
(207, '??????????', 9, NULL, NULL),
(208, '?????????? ????????', 9, NULL, NULL),
(209, '???????? ??????????', 10, NULL, NULL),
(210, '?????????? ??????????????', 10, NULL, NULL),
(211, '????????', 10, NULL, NULL),
(212, '?????? ????????????', 10, NULL, NULL),
(213, '??????????', 10, NULL, NULL),
(214, '??????????????', 10, NULL, NULL),
(215, '????????????', 10, NULL, NULL),
(216, '???????? ??????????', 10, NULL, NULL),
(217, '??????', 10, NULL, NULL),
(218, '??????????????', 10, NULL, NULL),
(219, '????????????', 11, NULL, NULL),
(220, '???????????? ??????????????', 11, NULL, NULL),
(221, '????????????', 11, NULL, NULL),
(222, '??????????', 11, NULL, NULL),
(223, '?????? ????????', 11, NULL, NULL),
(224, '????????', 11, NULL, NULL),
(225, '????????????', 11, NULL, NULL),
(226, '?????????????? ??????????????', 11, NULL, NULL),
(227, '????????', 11, NULL, NULL),
(228, '?????? ????????', 11, NULL, NULL),
(229, '?????? ??????????', 11, NULL, NULL),
(230, '?????? ??????????', 11, NULL, NULL),
(231, '????????', 12, NULL, NULL),
(232, '??????????', 12, NULL, NULL),
(233, '???????? ????????????', 12, NULL, NULL),
(234, '?????????????? ??????????????', 12, NULL, NULL),
(235, '??????????????', 12, NULL, NULL),
(236, '?????? ??????', 12, NULL, NULL),
(237, '??????', 12, NULL, NULL),
(238, '??????', 12, NULL, NULL),
(239, '????????????', 12, NULL, NULL),
(240, '????????????', 12, NULL, NULL),
(241, '???????? ??????????????', 12, NULL, NULL),
(242, '??????????', 12, NULL, NULL),
(243, '??????????????', 13, NULL, NULL),
(244, '??????????', 13, NULL, NULL),
(245, '??????', 13, NULL, NULL),
(246, '????????????????', 13, NULL, NULL),
(247, '????????', 13, NULL, NULL),
(248, '??????????????', 13, NULL, NULL),
(249, '????????????', 14, NULL, NULL),
(250, '??????????????', 14, NULL, NULL),
(251, '??????????', 14, NULL, NULL),
(252, '?????????? ????????????', 14, NULL, NULL),
(253, '????????', 14, NULL, NULL),
(254, '??????????', 15, NULL, NULL),
(255, '?????????? ??????????????', 15, NULL, NULL),
(256, '????????', 15, NULL, NULL),
(257, '?????? ????????', 15, NULL, NULL),
(258, '?????? ????????????', 15, NULL, NULL),
(259, '????????????', 15, NULL, NULL),
(260, '????????', 15, NULL, NULL),
(261, '????????????????', 15, NULL, NULL),
(262, '????????????????', 15, NULL, NULL),
(263, '????????????????', 15, NULL, NULL),
(264, '?????????????? ????????????????', 15, NULL, NULL),
(265, '???????? ??????', 15, NULL, NULL),
(266, '??????????', 16, NULL, NULL),
(267, '?????????? ??????????????', 16, NULL, NULL),
(268, '??????????', 16, NULL, NULL),
(269, '????????????', 16, NULL, NULL),
(270, '??????????????', 16, NULL, NULL),
(271, '??????????', 16, NULL, NULL),
(272, '?????? ??????', 16, NULL, NULL),
(273, '??????????????', 16, NULL, NULL),
(274, '???????? ????????', 16, NULL, NULL),
(275, '??????????????', 16, NULL, NULL),
(276, '????????', 16, NULL, NULL),
(277, '?????? ????????', 17, NULL, NULL),
(278, '?????? ???????? ??????????????', 17, NULL, NULL),
(279, '??????????????', 17, NULL, NULL),
(280, '????????', 17, NULL, NULL),
(281, '??????????????', 17, NULL, NULL),
(282, '??????', 17, NULL, NULL),
(283, '??????????', 17, NULL, NULL),
(284, '??????????', 17, NULL, NULL),
(285, '??????????????????', 17, NULL, NULL),
(286, '????????', 17, NULL, NULL),
(287, '??????????????', 18, NULL, NULL),
(288, '??????????????', 18, NULL, NULL),
(289, '??????????', 18, NULL, NULL),
(290, '???? ????????????', 18, NULL, NULL),
(291, '???? ??????????', 18, NULL, NULL),
(292, '???? ??????????????', 18, NULL, NULL),
(293, '???? ????????????', 18, NULL, NULL),
(294, '???? ??????????', 18, NULL, NULL),
(295, '??????????', 19, NULL, NULL),
(296, '?????????? ??????????????', 19, NULL, NULL),
(297, '?????? ????????', 19, NULL, NULL),
(298, '??????????????', 19, NULL, NULL),
(299, '????????????', 19, NULL, NULL),
(300, '??????????', 19, NULL, NULL),
(301, '????????????', 19, NULL, NULL),
(302, '?????? ????????????', 19, NULL, NULL),
(303, '???????? ??????????', 19, NULL, NULL),
(304, '?????? ?????? ????????', 19, NULL, NULL),
(305, '?????? ??????', 19, NULL, NULL),
(306, '????????????????', 20, NULL, NULL),
(307, '???????????? ???? ??????????', 20, NULL, NULL),
(308, '???????? ??????????', 20, NULL, NULL),
(309, '??????????', 20, NULL, NULL),
(310, '?????????? ??????????', 20, NULL, NULL),
(311, '????????????????', 20, NULL, NULL),
(312, '?????? ????????', 20, NULL, NULL),
(313, '????????????', 20, NULL, NULL),
(314, '????????', 20, NULL, NULL),
(315, '?????? ????????', 20, NULL, NULL),
(316, '??????????', 20, NULL, NULL),
(317, '???????????????? ??????????????', 20, NULL, NULL),
(318, '??????????????????????', 20, NULL, NULL),
(319, '???????? ??????', 20, NULL, NULL),
(320, '?????? ??????', 20, NULL, NULL),
(321, '?????????? ??????', 20, NULL, NULL),
(322, '????????????????', 20, NULL, NULL),
(323, '?????? ?????????? ??????????????', 20, NULL, NULL),
(324, '?????????? ?????? ??????', 20, NULL, NULL),
(325, '??????????', 21, NULL, NULL),
(326, '?????? ??????????', 21, NULL, NULL),
(327, '??????', 21, NULL, NULL),
(328, '??????????', 21, NULL, NULL),
(329, '????????', 21, NULL, NULL),
(330, '???????? ????????????', 21, NULL, NULL),
(331, '?????? ????????', 21, NULL, NULL),
(332, '?????? ??????????', 21, NULL, NULL),
(333, '?????? ??????', 21, NULL, NULL),
(334, '?????? ??????????', 22, NULL, NULL),
(335, '?????? ?????????? ?????? ??????????', 22, NULL, NULL),
(336, '????????', 22, NULL, NULL),
(337, '??????', 22, NULL, NULL),
(338, '??????????', 22, NULL, NULL),
(339, '?????? ????????????', 22, NULL, NULL),
(340, '??????????', 22, NULL, NULL),
(341, '???????? ??????????', 22, NULL, NULL),
(342, '??????????????', 22, NULL, NULL),
(343, '????????', 22, NULL, NULL),
(344, '????????????', 22, NULL, NULL),
(345, '???????? ????????', 22, NULL, NULL),
(346, '????????', 22, NULL, NULL),
(347, '???????? ????????', 22, NULL, NULL),
(348, '???????? ??????????', 23, NULL, NULL),
(349, '????????????', 23, NULL, NULL),
(350, '??????????????', 23, NULL, NULL),
(351, '????????????', 23, NULL, NULL),
(352, '??????????????', 23, NULL, NULL),
(353, '???????? ??????????', 23, NULL, NULL),
(354, '????????????', 23, NULL, NULL),
(355, '????????', 23, NULL, NULL),
(356, '????????????', 23, NULL, NULL),
(357, '???????????? ??????????????', 23, NULL, NULL),
(358, '????????????', 24, NULL, NULL),
(359, '???????????? ??????????????', 24, NULL, NULL),
(360, '????????', 24, NULL, NULL),
(361, '???????? ??????????????', 24, NULL, NULL),
(362, '??????????????', 24, NULL, NULL),
(363, '????????????????', 24, NULL, NULL),
(364, '????????????', 24, NULL, NULL),
(365, '??????????', 24, NULL, NULL),
(366, '??????????', 24, NULL, NULL),
(367, '??????', 25, NULL, NULL),
(368, '?????? ??????????????', 25, NULL, NULL),
(369, '?????? ??????', 25, NULL, NULL),
(370, '?????? ??????????', 25, NULL, NULL),
(371, '????????', 25, NULL, NULL),
(372, '??????????', 25, NULL, NULL),
(373, '??????', 25, NULL, NULL),
(374, '??????????', 25, NULL, NULL),
(375, '??????????', 25, NULL, NULL),
(376, '??????', 25, NULL, NULL),
(377, '????????????', 26, NULL, NULL),
(378, '?????????? ????????', 26, NULL, NULL),
(379, '??????', 26, NULL, NULL),
(380, '??????', 26, NULL, NULL),
(381, '?????? ??????????', 26, NULL, NULL),
(382, '????????????', 26, NULL, NULL),
(383, '??????????', 27, NULL, NULL),
(384, '?????????? ??????????????', 27, NULL, NULL),
(385, '??????????', 27, NULL, NULL),
(386, '?????????? ??????????????', 27, NULL, NULL),
(387, '??????????????', 27, NULL, NULL),
(388, '??????????????', 27, NULL, NULL),
(389, '??????????????', 27, NULL, NULL),
(390, '?????? ????????????', 27, NULL, NULL),
(391, '????????', 27, NULL, NULL),
(392, '?????????? ??????????????', 27, NULL, NULL),
(393, '????????????', 27, NULL, NULL),
(394, '??????', 27, NULL, NULL),
(395, '????????', 27, NULL, NULL),
(396, '????????????', 27, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `clients`
--

CREATE TABLE `clients` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_2` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phone` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone_2` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `photo` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `google_location` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `city_id` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `companies`
--

CREATE TABLE `companies` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `address` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phone` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `photo` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `google_location` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `flyer_stock` int(11) DEFAULT NULL,
  `pick_up_fee` double(8,2) DEFAULT 0.00,
  `minimum_sunday_pick_up` double(8,2) DEFAULT 0.00,
  `shipment_type` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 0,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `city_id` bigint(20) UNSIGNED NOT NULL,
  `branch_id` bigint(20) UNSIGNED DEFAULT NULL,
  `payment_type_id` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `company_accounts`
--

CREATE TABLE `company_accounts` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `total_price` double(8,2) NOT NULL DEFAULT 0.00,
  `company_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `company_shipment_details`
--

CREATE TABLE `company_shipment_details` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `shipment_price` double(8,2) NOT NULL DEFAULT 0.00,
  `company_id` bigint(20) UNSIGNED NOT NULL,
  `shipment_id` bigint(20) UNSIGNED NOT NULL,
  `company_account_id` bigint(20) UNSIGNED DEFAULT NULL,
  `shipment_status_id` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `company_shipping_area_prices`
--

CREATE TABLE `company_shipping_area_prices` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `transportation_price` double(8,2) NOT NULL DEFAULT 0.00,
  `delivery_time` int(11) DEFAULT NULL,
  `returned_time` int(11) DEFAULT NULL,
  `area_id` bigint(20) UNSIGNED NOT NULL,
  `company_id` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `complains`
--

CREATE TABLE `complains` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `notes` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 0,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `connects`
--

CREATE TABLE `connects` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `phone` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone_2` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email_2` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `notes` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 0,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `countries`
--

CREATE TABLE `countries` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `departments`
--

CREATE TABLE `departments` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `detail_shipment_representatives`
--

CREATE TABLE `detail_shipment_representatives` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `representative_id` bigint(20) UNSIGNED NOT NULL,
  `shipment_id` bigint(20) UNSIGNED NOT NULL,
  `shipment_status_id` bigint(20) UNSIGNED NOT NULL,
  `store_id` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `employees`
--

CREATE TABLE `employees` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `address` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `cv` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `photo` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `face_ID_card_pic` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `back_ID_card_pic` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `salary` double(8,2) NOT NULL DEFAULT 0.00,
  `wallet` double(8,2) DEFAULT 0.00,
  `commission` double(8,2) DEFAULT 0.00,
  `department_id` bigint(20) UNSIGNED NOT NULL,
  `branch_id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `job_id` bigint(20) UNSIGNED NOT NULL,
  `city_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `expenses`
--

CREATE TABLE `expenses` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `label` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `expandedIcon` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'pi pi-folder-open',
  `collapsedIcon` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'pi pi-folder',
  `expense_id` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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
-- Table structure for table `governorates`
--

CREATE TABLE `governorates` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `governorate_name_ar` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `governorates`
--

INSERT INTO `governorates` (`id`, `governorate_name_ar`, `created_at`, `updated_at`) VALUES
(1, '??????????????', NULL, NULL),
(2, '????????????', NULL, NULL),
(3, '????????????????????', NULL, NULL),
(4, '????????????????', NULL, NULL),
(5, '?????????? ????????????', NULL, NULL),
(6, '??????????????', NULL, NULL),
(7, '????????????', NULL, NULL),
(8, '??????????????', NULL, NULL),
(9, '????????????????????', NULL, NULL),
(10, '????????????????', NULL, NULL),
(11, '????????????', NULL, NULL),
(12, '??????????????????', NULL, NULL),
(13, '???????????? ????????????', NULL, NULL),
(14, '????????????', NULL, NULL),
(15, '??????????', NULL, NULL),
(16, '??????????', NULL, NULL),
(17, '?????? ????????', NULL, NULL),
(18, '??????????????', NULL, NULL),
(19, '??????????', NULL, NULL),
(20, '??????????????', NULL, NULL),
(21, '???????? ??????????', NULL, NULL),
(22, '?????? ??????????', NULL, NULL),
(23, '??????????', NULL, NULL),
(24, '????????????', NULL, NULL),
(25, '??????', NULL, NULL),
(26, '???????? ??????????', NULL, NULL),
(27, '??????????', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `import_shipmentts`
--

CREATE TABLE `import_shipmentts` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `order_number` int(11) DEFAULT NULL,
  `client_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `client_code` int(11) DEFAULT NULL,
  `area` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `address` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone_2` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `name_product` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `description_product` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `weight` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `size` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `count` int(11) DEFAULT NULL,
  `price` double(8,2) NOT NULL DEFAULT 0.00,
  `delivery_date` date DEFAULT NULL,
  `notes` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `service_types` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '0',
  `additional_service` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '0',
  `end` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `incomes`
--

CREATE TABLE `incomes` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `label` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `expandedIcon` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'pi pi-folder-open',
  `collapsedIcon` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'pi pi-folder',
  `income_id` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `income_and_expenses`
--

CREATE TABLE `income_and_expenses` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `price` double(8,2) NOT NULL DEFAULT 0.00,
  `notes` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `payment_date` date NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `treasurie_id` bigint(20) UNSIGNED DEFAULT NULL,
  `expense_id` bigint(20) UNSIGNED DEFAULT NULL,
  `income_id` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `jobs`
--

CREATE TABLE `jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `maps`
--

CREATE TABLE `maps` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `distance` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `location` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `representative_id` bigint(20) UNSIGNED NOT NULL,
  `shipment_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `messages`
--

CREATE TABLE `messages` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `text` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `message_representatives`
--

CREATE TABLE `message_representatives` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `photo` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `representative_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
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
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2022_03_12_142517_create_admins_table', 1),
(5, '2022_03_12_142518_create_governorates_table', 1),
(6, '2022_03_12_142519_create_cities_table', 1),
(7, '2022_03_13_094150_create_countries_table', 1),
(8, '2022_03_13_143638_create_provinces_table', 1),
(9, '2022_03_13_144422_create_areas_table', 1),
(10, '2022_03_13_144423_create_representatives_table', 1),
(11, '2022_03_13_144424_create_clients_table', 1),
(12, '2022_03_14_110448_create_jobs_table', 1),
(13, '2022_03_14_110727_create_departments_table', 1),
(14, '2022_03_14_212424_create_branches_table', 1),
(15, '2022_03_14_212425_create_payment_types_table', 1),
(16, '2022_03_19_095719_create_companies_table', 1),
(17, '2022_03_19_152515_create_shipment_types_table', 1),
(18, '2022_03_19_152527_create_transport_types_table', 1),
(19, '2022_03_20_091056_laratrust_setup_tables', 1),
(20, '2022_03_26_113922_create_service_types_table', 1),
(21, '2022_03_29_112933_create_reasons_table', 1),
(22, '2022_03_30_1112934_create_import_shipmentts_table', 1),
(23, '2022_03_30_111538_create_employees_table', 1),
(24, '2022_03_30_111539_create_stores_table', 1),
(25, '2022_03_30_112930_create_additional_services_table', 1),
(26, '2022_03_30_112931_create_shipping_area_prices_table', 1),
(27, '2022_03_30_112931_create_weights_table', 1),
(28, '2022_03_30_112932_create_shipment_status_table', 1),
(29, '2022_03_30_112933_create_shipments_table', 1),
(30, '2022_03_31_092512_create_shipment_transfers_table', 1),
(31, '2022_04_04_093910_create_pick_ups_table', 1),
(32, '2022_04_04_095300_create_connects_table', 1),
(33, '2022_04_11_110012_create_offers_table', 1),
(34, '2022_04_11_110053_create_storage_systems_table', 1),
(35, '2022_04_11_115705_create_offer_companies_table', 1),
(36, '2022_04_11_115719_create_storage_system_companies_table', 1),
(37, '2022_04_14_185116_create_complains_table', 1),
(38, '2022_04_17_210416_create_company_shipping_area_prices_table', 1),
(39, '2022_04_20_000137_create_weight_companies_table', 1),
(40, '2022_04_21_202238_create_company_accounts_table', 1),
(41, '2022_04_21_202239_create_company_shipment_details_table', 1),
(42, '2022_04_22_010409_create_representative_areas_table', 1),
(43, '2022_04_22_011248_create_message_representatives_table', 1),
(44, '2022_04_22_011518_create_representative_accounts_table', 1),
(45, '2022_04_22_013339_create_representative_moves_table', 1),
(46, '2022_04_22_014019_create_representative_account_details_table', 1),
(47, '2022_04_25_142029_create_stocks_table', 1),
(48, '2022_04_25_142132_create_stock_details_table', 1),
(49, '2022_05_20_233301_create_detail_shipment_representatives_table', 1),
(50, '2022_05_21_164057_create_treasuries_table', 1),
(51, '2022_05_23_145944_create_incomes_table', 1),
(52, '2022_05_23_150119_create_expenses_table', 1),
(53, '2022_05_23_155446_create_income_and_expenses_table', 1),
(54, '2022_05_24_115818_create_transferring_treasuries_table', 1),
(55, '2022_05_28_173239_create_advertisements_table', 1),
(56, '2022_05_28_173439_create_messages_table', 1),
(57, '2022_06_04_140440_create_maps_table', 1),
(58, '2022_06_07_114413_create_notifications_table', 1);

-- --------------------------------------------------------

--
-- Table structure for table `notifications`
--

CREATE TABLE `notifications` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `body` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `is_watch` tinyint(1) NOT NULL DEFAULT 0,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `offers`
--

CREATE TABLE `offers` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `offer_companies`
--

CREATE TABLE `offer_companies` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `offer_id` bigint(20) UNSIGNED DEFAULT NULL,
  `company_id` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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
-- Table structure for table `payment_types`
--

CREATE TABLE `payment_types` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `payment_types`
--

INSERT INTO `payment_types` (`id`, `type`, `description`, `created_at`, `updated_at`) VALUES
(1, '??????', '??????', '2022-06-08 11:35:27', '2022-06-08 11:35:27'),
(2, '????????', '????????', '2022-06-08 11:35:27', '2022-06-08 11:35:27');

-- --------------------------------------------------------

--
-- Table structure for table `permissions`
--

CREATE TABLE `permissions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `display_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `permission_role`
--

CREATE TABLE `permission_role` (
  `permission_id` bigint(20) UNSIGNED NOT NULL,
  `role_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `permission_user`
--

CREATE TABLE `permission_user` (
  `permission_id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `user_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `pick_ups`
--

CREATE TABLE `pick_ups` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `qty` int(11) NOT NULL,
  `notes` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 0,
  `transport_type_id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `provinces`
--

CREATE TABLE `provinces` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `country_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `reasons`
--

CREATE TABLE `reasons` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `reasons`
--

INSERT INTO `reasons` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1, '???????? ?????? ??????????', '2022-06-08 11:35:27', '2022-06-08 11:35:27'),
(2, '???????? ?????? ????????????', '2022-06-08 11:35:27', '2022-06-08 11:35:27'),
(3, '???????? ??????????', '2022-06-08 11:35:27', '2022-06-08 11:35:27'),
(4, '?????????? ?????? ??????????', '2022-06-08 11:35:27', '2022-06-08 11:35:27'),
(5, '?????????? ??????????????', '2022-06-08 11:35:28', '2022-06-08 11:35:28'),
(6, '?????????? ????????', '2022-06-08 11:35:28', '2022-06-08 11:35:28'),
(7, '?????????????? ????????', '2022-06-08 11:35:28', '2022-06-08 11:35:28'),
(8, '???????????????? ????????', '2022-06-08 11:35:28', '2022-06-08 11:35:28'),
(9, '???????????? ???? ??????', '2022-06-08 11:35:28', '2022-06-08 11:35:28'),
(10, '?????????? ??????', '2022-06-08 11:35:28', '2022-06-08 11:35:28');

-- --------------------------------------------------------

--
-- Table structure for table `representatives`
--

CREATE TABLE `representatives` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `address` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `photo` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `license_photo` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `fish_photo` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `national_id` bigint(20) DEFAULT NULL,
  `wallet` double(8,2) DEFAULT NULL,
  `salary` double(8,2) NOT NULL,
  `commission` double(8,2) NOT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `cv` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `city_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `representative_accounts`
--

CREATE TABLE `representative_accounts` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `total_commissions` double(8,2) NOT NULL DEFAULT 0.00,
  `collection_balance` double(8,2) NOT NULL DEFAULT 0.00,
  `representative_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `representative_account_details`
--

CREATE TABLE `representative_account_details` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `collection_balance` double(8,2) NOT NULL DEFAULT 0.00,
  `commission` double(8,2) NOT NULL DEFAULT 0.00,
  `representative_id` bigint(20) UNSIGNED NOT NULL,
  `representative_account_id` bigint(20) UNSIGNED DEFAULT NULL,
  `shipment_id` bigint(20) UNSIGNED NOT NULL,
  `shipment_status_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `representative_areas`
--

CREATE TABLE `representative_areas` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `receipt_commission` double(8,2) NOT NULL DEFAULT 0.00,
  `return_commission` double(8,2) NOT NULL DEFAULT 0.00,
  `area_id` bigint(20) UNSIGNED NOT NULL,
  `representative_id` bigint(20) UNSIGNED NOT NULL,
  `service_type_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `representative_moves`
--

CREATE TABLE `representative_moves` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `date` date NOT NULL,
  `time` time NOT NULL,
  `google_location` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `area` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `representative_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `display_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `name`, `display_name`, `description`, `created_at`, `updated_at`) VALUES
(1, 'super_admin', 'Super Admin', 'Super Admin', '2022-06-08 11:35:25', '2022-06-08 11:35:25'),
(2, 'accountant', 'Accountant', 'Accountant', '2022-06-08 11:35:25', '2022-06-08 11:35:25'),
(3, 'Store_keeper', 'Store Keeper', 'Store Keeper', '2022-06-08 11:35:25', '2022-06-08 11:35:25'),
(4, 'Customer_Service', 'Customer Service', 'Customer Service', '2022-06-08 11:35:26', '2022-06-08 11:35:26'),
(5, 'Staff_Supervisor', 'Staff Supervisor', 'Staff Supervisor', '2022-06-08 11:35:26', '2022-06-08 11:35:26');

-- --------------------------------------------------------

--
-- Table structure for table `role_user`
--

CREATE TABLE `role_user` (
  `role_id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `user_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `role_user`
--

INSERT INTO `role_user` (`role_id`, `user_id`, `user_type`) VALUES
(1, 1, 'App\\Models\\User');

-- --------------------------------------------------------

--
-- Table structure for table `service_types`
--

CREATE TABLE `service_types` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `service_types`
--

INSERT INTO `service_types` (`id`, `type`, `created_at`, `updated_at`) VALUES
(1, '?????????? ?? ??????????', '2022-06-08 11:35:26', '2022-06-08 11:35:26'),
(2, ' ??????????', '2022-06-08 11:35:27', '2022-06-08 11:35:27'),
(3, ' ??????????', '2022-06-08 11:35:27', '2022-06-08 11:35:27');

-- --------------------------------------------------------

--
-- Table structure for table `shipments`
--

CREATE TABLE `shipments` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name_shipment` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `customer_code` int(11) DEFAULT NULL,
  `product_price` double(8,2) DEFAULT 0.00,
  `order_number` int(11) DEFAULT NULL,
  `count` int(11) DEFAULT NULL,
  `shipping_price` double(8,2) DEFAULT 0.00,
  `return_price` double(8,2) NOT NULL DEFAULT 0.00,
  `weight` int(11) DEFAULT NULL,
  `size` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `notes` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `delivery_date` date DEFAULT NULL,
  `client_id` bigint(20) UNSIGNED DEFAULT NULL,
  `area_id` bigint(20) UNSIGNED NOT NULL,
  `service_type_id` bigint(20) UNSIGNED DEFAULT NULL,
  `store_id` bigint(20) UNSIGNED DEFAULT NULL,
  `shipment_status_id` bigint(20) UNSIGNED DEFAULT NULL,
  `representative_id` bigint(20) UNSIGNED DEFAULT NULL,
  `sender_id` bigint(20) UNSIGNED NOT NULL,
  `additional_service_id` bigint(20) UNSIGNED DEFAULT NULL,
  `reason_id` bigint(20) UNSIGNED DEFAULT NULL,
  `end` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `shipment_status`
--

CREATE TABLE `shipment_status` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `shipment_status`
--

INSERT INTO `shipment_status` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1, '?????? ?????? ????', '2022-06-08 11:35:26', '2022-06-08 11:35:26'),
(2, '?????????????? ???? ???????????? ?????????????? ?????????? ????', '2022-06-08 11:35:26', '2022-06-08 11:35:26'),
(3, '???? ???????????? ?????????? ????', '2022-06-08 11:35:26', '2022-06-08 11:35:26'),
(4, '???? ???????????? ?????? ????????????', '2022-06-08 11:35:26', '2022-06-08 11:35:26'),
(5, '???? ?????????????? ???? ????????????', '2022-06-08 11:35:26', '2022-06-08 11:35:26'),
(6, '?????? ??????????????', '2022-06-08 11:35:26', '2022-06-08 11:35:26'),
(7, '?????????? ????????', '2022-06-08 11:35:26', '2022-06-08 11:35:26'),
(8, '?????????? ????????  ???????? ???????? ??????????', '2022-06-08 11:35:26', '2022-06-08 11:35:26'),
(9, ' ?????????? ???????? ?? ???? ?????????? ???????? ??????????', '2022-06-08 11:35:26', '2022-06-08 11:35:26'),
(10, '?????????? ???????? ???????? ???????? ??????????', '2022-06-08 11:35:26', '2022-06-08 11:35:26'),
(11, '?????????? ???????? ?? ???? ???????? ???????? ??????????', '2022-06-08 11:35:26', '2022-06-08 11:35:26'),
(12, '???????? ??????????', '2022-06-08 11:35:26', '2022-06-08 11:35:26');

-- --------------------------------------------------------

--
-- Table structure for table `shipment_transfers`
--

CREATE TABLE `shipment_transfers` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `store_start_id` bigint(20) UNSIGNED NOT NULL,
  `shipment_id` bigint(20) UNSIGNED NOT NULL,
  `representative_id` bigint(20) UNSIGNED DEFAULT NULL,
  `store_end_id` bigint(20) UNSIGNED DEFAULT NULL,
  `employee_id` bigint(20) UNSIGNED NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 0,
  `notes` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `shipment_types`
--

CREATE TABLE `shipment_types` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `price` double(8,2) NOT NULL DEFAULT 0.00,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `shipping_area_prices`
--

CREATE TABLE `shipping_area_prices` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `transportation_price` double(8,2) NOT NULL DEFAULT 0.00,
  `delivery_time` int(11) DEFAULT NULL,
  `returned_time` int(11) DEFAULT NULL,
  `area_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `stocks`
--

CREATE TABLE `stocks` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name_product` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `unit_price` double(8,2) NOT NULL DEFAULT 0.00,
  `count` int(11) NOT NULL,
  `company_id` bigint(20) UNSIGNED NOT NULL,
  `store_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `stock_details`
--

CREATE TABLE `stock_details` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `unit_price` double(8,2) NOT NULL DEFAULT 0.00,
  `count` int(11) NOT NULL,
  `stock_id` bigint(20) UNSIGNED NOT NULL,
  `shipment_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `storage_systems`
--

CREATE TABLE `storage_systems` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `storage_system_companies`
--

CREATE TABLE `storage_system_companies` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `storage_system_id` bigint(20) UNSIGNED DEFAULT NULL,
  `company_id` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `stores`
--

CREATE TABLE `stores` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `branche_id` bigint(20) UNSIGNED NOT NULL,
  `employee_id` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `transferring_treasuries`
--

CREATE TABLE `transferring_treasuries` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `price` double(8,2) NOT NULL DEFAULT 0.00,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `treasurie_start_id` bigint(20) UNSIGNED DEFAULT NULL,
  `treasurie_end_id` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `transport_types`
--

CREATE TABLE `transport_types` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `price` double(8,2) NOT NULL DEFAULT 0.00,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `transport_types`
--

INSERT INTO `transport_types` (`id`, `type`, `price`, `created_at`, `updated_at`) VALUES
(1, '??????????', 40.00, '2022-06-08 11:35:27', '2022-06-08 11:35:27'),
(2, '??????????', 50.00, '2022-06-08 11:35:27', '2022-06-08 11:35:27');

-- --------------------------------------------------------

--
-- Table structure for table `treasuries`
--

CREATE TABLE `treasuries` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `label` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `expandedIcon` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'pi pi-folder-open',
  `collapsedIcon` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'pi pi-folder',
  `treasury_id` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone_number` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `user_type` enum('admin','client','representative','employee','company') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'client',
  `token` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `firebase_id` int(11) DEFAULT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `email`, `email_verified_at`, `password`, `phone_number`, `is_active`, `user_type`, `token`, `firebase_id`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'super_admin@app.com', NULL, '$2y$10$rU.q6PR.o2B.eU5XLqmHJejfs2hk.hsW72mhdlcO.jFNw7mvHLIIW', '12345678910', 1, 'admin', NULL, NULL, NULL, '2022-06-08 11:35:26', '2022-06-08 11:35:26');

-- --------------------------------------------------------

--
-- Table structure for table `weights`
--

CREATE TABLE `weights` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `type` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `limit` int(11) NOT NULL,
  `price` double(8,2) NOT NULL DEFAULT 0.00,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `weights`
--

INSERT INTO `weights` (`id`, `type`, `limit`, `price`, `created_at`, `updated_at`) VALUES
(1, '????????', 10, 50.00, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `weight_companies`
--

CREATE TABLE `weight_companies` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `type` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `limit` int(11) NOT NULL,
  `price` double(8,2) NOT NULL DEFAULT 0.00,
  `company_id` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `additional_services`
--
ALTER TABLE `additional_services`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`id`),
  ADD KEY `admins_user_id_foreign` (`user_id`);

--
-- Indexes for table `advertisements`
--
ALTER TABLE `advertisements`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `areas`
--
ALTER TABLE `areas`
  ADD PRIMARY KEY (`id`),
  ADD KEY `areas_province_id_foreign` (`province_id`);

--
-- Indexes for table `branches`
--
ALTER TABLE `branches`
  ADD PRIMARY KEY (`id`),
  ADD KEY `branches_area_id_foreign` (`area_id`);

--
-- Indexes for table `cities`
--
ALTER TABLE `cities`
  ADD PRIMARY KEY (`id`),
  ADD KEY `cities_governorate_id_foreign` (`governorate_id`);

--
-- Indexes for table `clients`
--
ALTER TABLE `clients`
  ADD PRIMARY KEY (`id`),
  ADD KEY `clients_user_id_foreign` (`user_id`),
  ADD KEY `clients_city_id_foreign` (`city_id`);

--
-- Indexes for table `companies`
--
ALTER TABLE `companies`
  ADD PRIMARY KEY (`id`),
  ADD KEY `companies_user_id_foreign` (`user_id`),
  ADD KEY `companies_city_id_foreign` (`city_id`),
  ADD KEY `companies_branch_id_foreign` (`branch_id`),
  ADD KEY `companies_payment_type_id_foreign` (`payment_type_id`);

--
-- Indexes for table `company_accounts`
--
ALTER TABLE `company_accounts`
  ADD PRIMARY KEY (`id`),
  ADD KEY `company_accounts_company_id_foreign` (`company_id`);

--
-- Indexes for table `company_shipment_details`
--
ALTER TABLE `company_shipment_details`
  ADD PRIMARY KEY (`id`),
  ADD KEY `company_shipment_details_company_id_foreign` (`company_id`),
  ADD KEY `company_shipment_details_shipment_id_foreign` (`shipment_id`),
  ADD KEY `company_shipment_details_company_account_id_foreign` (`company_account_id`),
  ADD KEY `company_shipment_details_shipment_status_id_foreign` (`shipment_status_id`);

--
-- Indexes for table `company_shipping_area_prices`
--
ALTER TABLE `company_shipping_area_prices`
  ADD PRIMARY KEY (`id`),
  ADD KEY `company_shipping_area_prices_area_id_foreign` (`area_id`),
  ADD KEY `company_shipping_area_prices_company_id_foreign` (`company_id`);

--
-- Indexes for table `complains`
--
ALTER TABLE `complains`
  ADD PRIMARY KEY (`id`),
  ADD KEY `complains_user_id_foreign` (`user_id`);

--
-- Indexes for table `connects`
--
ALTER TABLE `connects`
  ADD PRIMARY KEY (`id`),
  ADD KEY `connects_user_id_foreign` (`user_id`);

--
-- Indexes for table `countries`
--
ALTER TABLE `countries`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `departments`
--
ALTER TABLE `departments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `detail_shipment_representatives`
--
ALTER TABLE `detail_shipment_representatives`
  ADD PRIMARY KEY (`id`),
  ADD KEY `detail_shipment_representatives_representative_id_foreign` (`representative_id`),
  ADD KEY `detail_shipment_representatives_shipment_id_foreign` (`shipment_id`),
  ADD KEY `detail_shipment_representatives_shipment_status_id_foreign` (`shipment_status_id`),
  ADD KEY `detail_shipment_representatives_store_id_foreign` (`store_id`);

--
-- Indexes for table `employees`
--
ALTER TABLE `employees`
  ADD PRIMARY KEY (`id`),
  ADD KEY `employees_department_id_foreign` (`department_id`),
  ADD KEY `employees_branch_id_foreign` (`branch_id`),
  ADD KEY `employees_user_id_foreign` (`user_id`),
  ADD KEY `employees_job_id_foreign` (`job_id`),
  ADD KEY `employees_city_id_foreign` (`city_id`);

--
-- Indexes for table `expenses`
--
ALTER TABLE `expenses`
  ADD PRIMARY KEY (`id`),
  ADD KEY `expenses_expense_id_foreign` (`expense_id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `governorates`
--
ALTER TABLE `governorates`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `import_shipmentts`
--
ALTER TABLE `import_shipmentts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `incomes`
--
ALTER TABLE `incomes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `incomes_income_id_foreign` (`income_id`);

--
-- Indexes for table `income_and_expenses`
--
ALTER TABLE `income_and_expenses`
  ADD PRIMARY KEY (`id`),
  ADD KEY `income_and_expenses_user_id_foreign` (`user_id`),
  ADD KEY `income_and_expenses_treasurie_id_foreign` (`treasurie_id`),
  ADD KEY `income_and_expenses_expense_id_foreign` (`expense_id`),
  ADD KEY `income_and_expenses_income_id_foreign` (`income_id`);

--
-- Indexes for table `jobs`
--
ALTER TABLE `jobs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `maps`
--
ALTER TABLE `maps`
  ADD PRIMARY KEY (`id`),
  ADD KEY `maps_representative_id_foreign` (`representative_id`),
  ADD KEY `maps_shipment_id_foreign` (`shipment_id`);

--
-- Indexes for table `messages`
--
ALTER TABLE `messages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `message_representatives`
--
ALTER TABLE `message_representatives`
  ADD PRIMARY KEY (`id`),
  ADD KEY `message_representatives_representative_id_foreign` (`representative_id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `notifications`
--
ALTER TABLE `notifications`
  ADD PRIMARY KEY (`id`),
  ADD KEY `notifications_user_id_foreign` (`user_id`);

--
-- Indexes for table `offers`
--
ALTER TABLE `offers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `offer_companies`
--
ALTER TABLE `offer_companies`
  ADD PRIMARY KEY (`id`),
  ADD KEY `offer_companies_offer_id_foreign` (`offer_id`),
  ADD KEY `offer_companies_company_id_foreign` (`company_id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `payment_types`
--
ALTER TABLE `payment_types`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `permissions`
--
ALTER TABLE `permissions`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `permissions_name_unique` (`name`);

--
-- Indexes for table `permission_role`
--
ALTER TABLE `permission_role`
  ADD PRIMARY KEY (`permission_id`,`role_id`),
  ADD KEY `permission_role_role_id_foreign` (`role_id`);

--
-- Indexes for table `permission_user`
--
ALTER TABLE `permission_user`
  ADD PRIMARY KEY (`user_id`,`permission_id`,`user_type`),
  ADD KEY `permission_user_permission_id_foreign` (`permission_id`);

--
-- Indexes for table `pick_ups`
--
ALTER TABLE `pick_ups`
  ADD PRIMARY KEY (`id`),
  ADD KEY `pick_ups_transport_type_id_foreign` (`transport_type_id`),
  ADD KEY `pick_ups_user_id_foreign` (`user_id`);

--
-- Indexes for table `provinces`
--
ALTER TABLE `provinces`
  ADD PRIMARY KEY (`id`),
  ADD KEY `provinces_country_id_foreign` (`country_id`);

--
-- Indexes for table `reasons`
--
ALTER TABLE `reasons`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `representatives`
--
ALTER TABLE `representatives`
  ADD PRIMARY KEY (`id`),
  ADD KEY `representatives_user_id_foreign` (`user_id`),
  ADD KEY `representatives_city_id_foreign` (`city_id`);

--
-- Indexes for table `representative_accounts`
--
ALTER TABLE `representative_accounts`
  ADD PRIMARY KEY (`id`),
  ADD KEY `representative_accounts_representative_id_foreign` (`representative_id`);

--
-- Indexes for table `representative_account_details`
--
ALTER TABLE `representative_account_details`
  ADD PRIMARY KEY (`id`),
  ADD KEY `representative_account_details_representative_id_foreign` (`representative_id`),
  ADD KEY `representative_account_details_representative_account_id_foreign` (`representative_account_id`),
  ADD KEY `representative_account_details_shipment_id_foreign` (`shipment_id`),
  ADD KEY `representative_account_details_shipment_status_id_foreign` (`shipment_status_id`);

--
-- Indexes for table `representative_areas`
--
ALTER TABLE `representative_areas`
  ADD PRIMARY KEY (`id`),
  ADD KEY `representative_areas_area_id_foreign` (`area_id`),
  ADD KEY `representative_areas_representative_id_foreign` (`representative_id`),
  ADD KEY `representative_areas_service_type_id_foreign` (`service_type_id`);

--
-- Indexes for table `representative_moves`
--
ALTER TABLE `representative_moves`
  ADD PRIMARY KEY (`id`),
  ADD KEY `representative_moves_representative_id_foreign` (`representative_id`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `roles_name_unique` (`name`);

--
-- Indexes for table `role_user`
--
ALTER TABLE `role_user`
  ADD PRIMARY KEY (`user_id`,`role_id`,`user_type`),
  ADD KEY `role_user_role_id_foreign` (`role_id`);

--
-- Indexes for table `service_types`
--
ALTER TABLE `service_types`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `shipments`
--
ALTER TABLE `shipments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `shipments_client_id_foreign` (`client_id`),
  ADD KEY `shipments_area_id_foreign` (`area_id`),
  ADD KEY `shipments_service_type_id_foreign` (`service_type_id`),
  ADD KEY `shipments_store_id_foreign` (`store_id`),
  ADD KEY `shipments_shipment_status_id_foreign` (`shipment_status_id`),
  ADD KEY `shipments_representative_id_foreign` (`representative_id`),
  ADD KEY `shipments_sender_id_foreign` (`sender_id`),
  ADD KEY `shipments_additional_service_id_foreign` (`additional_service_id`),
  ADD KEY `shipments_reason_id_foreign` (`reason_id`);

--
-- Indexes for table `shipment_status`
--
ALTER TABLE `shipment_status`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `shipment_transfers`
--
ALTER TABLE `shipment_transfers`
  ADD PRIMARY KEY (`id`),
  ADD KEY `shipment_transfers_store_start_id_foreign` (`store_start_id`),
  ADD KEY `shipment_transfers_shipment_id_foreign` (`shipment_id`),
  ADD KEY `shipment_transfers_representative_id_foreign` (`representative_id`),
  ADD KEY `shipment_transfers_store_end_id_foreign` (`store_end_id`),
  ADD KEY `shipment_transfers_employee_id_foreign` (`employee_id`);

--
-- Indexes for table `shipment_types`
--
ALTER TABLE `shipment_types`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `shipping_area_prices`
--
ALTER TABLE `shipping_area_prices`
  ADD PRIMARY KEY (`id`),
  ADD KEY `shipping_area_prices_area_id_foreign` (`area_id`);

--
-- Indexes for table `stocks`
--
ALTER TABLE `stocks`
  ADD PRIMARY KEY (`id`),
  ADD KEY `stocks_company_id_foreign` (`company_id`),
  ADD KEY `stocks_store_id_foreign` (`store_id`);

--
-- Indexes for table `stock_details`
--
ALTER TABLE `stock_details`
  ADD PRIMARY KEY (`id`),
  ADD KEY `stock_details_stock_id_foreign` (`stock_id`),
  ADD KEY `stock_details_shipment_id_foreign` (`shipment_id`);

--
-- Indexes for table `storage_systems`
--
ALTER TABLE `storage_systems`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `storage_system_companies`
--
ALTER TABLE `storage_system_companies`
  ADD PRIMARY KEY (`id`),
  ADD KEY `storage_system_companies_storage_system_id_foreign` (`storage_system_id`),
  ADD KEY `storage_system_companies_company_id_foreign` (`company_id`);

--
-- Indexes for table `stores`
--
ALTER TABLE `stores`
  ADD PRIMARY KEY (`id`),
  ADD KEY `stores_branche_id_foreign` (`branche_id`),
  ADD KEY `stores_employee_id_foreign` (`employee_id`);

--
-- Indexes for table `transferring_treasuries`
--
ALTER TABLE `transferring_treasuries`
  ADD PRIMARY KEY (`id`),
  ADD KEY `transferring_treasuries_user_id_foreign` (`user_id`),
  ADD KEY `transferring_treasuries_treasurie_start_id_foreign` (`treasurie_start_id`),
  ADD KEY `transferring_treasuries_treasurie_end_id_foreign` (`treasurie_end_id`);

--
-- Indexes for table `transport_types`
--
ALTER TABLE `transport_types`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `treasuries`
--
ALTER TABLE `treasuries`
  ADD PRIMARY KEY (`id`),
  ADD KEY `treasuries_treasury_id_foreign` (`treasury_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- Indexes for table `weights`
--
ALTER TABLE `weights`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `weight_companies`
--
ALTER TABLE `weight_companies`
  ADD PRIMARY KEY (`id`),
  ADD KEY `weight_companies_company_id_foreign` (`company_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `additional_services`
--
ALTER TABLE `additional_services`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `admins`
--
ALTER TABLE `admins`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `advertisements`
--
ALTER TABLE `advertisements`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `areas`
--
ALTER TABLE `areas`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `branches`
--
ALTER TABLE `branches`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `cities`
--
ALTER TABLE `cities`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=397;

--
-- AUTO_INCREMENT for table `clients`
--
ALTER TABLE `clients`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `companies`
--
ALTER TABLE `companies`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `company_accounts`
--
ALTER TABLE `company_accounts`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `company_shipment_details`
--
ALTER TABLE `company_shipment_details`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `company_shipping_area_prices`
--
ALTER TABLE `company_shipping_area_prices`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `complains`
--
ALTER TABLE `complains`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `connects`
--
ALTER TABLE `connects`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `countries`
--
ALTER TABLE `countries`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `departments`
--
ALTER TABLE `departments`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `detail_shipment_representatives`
--
ALTER TABLE `detail_shipment_representatives`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `employees`
--
ALTER TABLE `employees`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `expenses`
--
ALTER TABLE `expenses`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `governorates`
--
ALTER TABLE `governorates`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `import_shipmentts`
--
ALTER TABLE `import_shipmentts`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `incomes`
--
ALTER TABLE `incomes`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `income_and_expenses`
--
ALTER TABLE `income_and_expenses`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `maps`
--
ALTER TABLE `maps`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `messages`
--
ALTER TABLE `messages`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `message_representatives`
--
ALTER TABLE `message_representatives`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=59;

--
-- AUTO_INCREMENT for table `notifications`
--
ALTER TABLE `notifications`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `offers`
--
ALTER TABLE `offers`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `offer_companies`
--
ALTER TABLE `offer_companies`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `payment_types`
--
ALTER TABLE `payment_types`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `permissions`
--
ALTER TABLE `permissions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `pick_ups`
--
ALTER TABLE `pick_ups`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `provinces`
--
ALTER TABLE `provinces`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `reasons`
--
ALTER TABLE `reasons`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `representatives`
--
ALTER TABLE `representatives`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `representative_accounts`
--
ALTER TABLE `representative_accounts`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `representative_account_details`
--
ALTER TABLE `representative_account_details`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `representative_areas`
--
ALTER TABLE `representative_areas`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `representative_moves`
--
ALTER TABLE `representative_moves`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `service_types`
--
ALTER TABLE `service_types`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `shipments`
--
ALTER TABLE `shipments`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `shipment_status`
--
ALTER TABLE `shipment_status`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `shipment_transfers`
--
ALTER TABLE `shipment_transfers`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `shipment_types`
--
ALTER TABLE `shipment_types`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `shipping_area_prices`
--
ALTER TABLE `shipping_area_prices`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `stocks`
--
ALTER TABLE `stocks`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `stock_details`
--
ALTER TABLE `stock_details`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `storage_systems`
--
ALTER TABLE `storage_systems`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `storage_system_companies`
--
ALTER TABLE `storage_system_companies`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `stores`
--
ALTER TABLE `stores`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `transferring_treasuries`
--
ALTER TABLE `transferring_treasuries`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `transport_types`
--
ALTER TABLE `transport_types`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `treasuries`
--
ALTER TABLE `treasuries`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `weights`
--
ALTER TABLE `weights`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `weight_companies`
--
ALTER TABLE `weight_companies`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `admins`
--
ALTER TABLE `admins`
  ADD CONSTRAINT `admins_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `areas`
--
ALTER TABLE `areas`
  ADD CONSTRAINT `areas_province_id_foreign` FOREIGN KEY (`province_id`) REFERENCES `provinces` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `branches`
--
ALTER TABLE `branches`
  ADD CONSTRAINT `branches_area_id_foreign` FOREIGN KEY (`area_id`) REFERENCES `areas` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `cities`
--
ALTER TABLE `cities`
  ADD CONSTRAINT `cities_governorate_id_foreign` FOREIGN KEY (`governorate_id`) REFERENCES `governorates` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `clients`
--
ALTER TABLE `clients`
  ADD CONSTRAINT `clients_city_id_foreign` FOREIGN KEY (`city_id`) REFERENCES `cities` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `clients_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `companies`
--
ALTER TABLE `companies`
  ADD CONSTRAINT `companies_branch_id_foreign` FOREIGN KEY (`branch_id`) REFERENCES `branches` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `companies_city_id_foreign` FOREIGN KEY (`city_id`) REFERENCES `cities` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `companies_payment_type_id_foreign` FOREIGN KEY (`payment_type_id`) REFERENCES `payment_types` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `companies_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `company_accounts`
--
ALTER TABLE `company_accounts`
  ADD CONSTRAINT `company_accounts_company_id_foreign` FOREIGN KEY (`company_id`) REFERENCES `companies` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `company_shipment_details`
--
ALTER TABLE `company_shipment_details`
  ADD CONSTRAINT `company_shipment_details_company_account_id_foreign` FOREIGN KEY (`company_account_id`) REFERENCES `company_accounts` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `company_shipment_details_company_id_foreign` FOREIGN KEY (`company_id`) REFERENCES `companies` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `company_shipment_details_shipment_id_foreign` FOREIGN KEY (`shipment_id`) REFERENCES `shipments` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `company_shipment_details_shipment_status_id_foreign` FOREIGN KEY (`shipment_status_id`) REFERENCES `shipment_status` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `company_shipping_area_prices`
--
ALTER TABLE `company_shipping_area_prices`
  ADD CONSTRAINT `company_shipping_area_prices_area_id_foreign` FOREIGN KEY (`area_id`) REFERENCES `areas` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `company_shipping_area_prices_company_id_foreign` FOREIGN KEY (`company_id`) REFERENCES `companies` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `complains`
--
ALTER TABLE `complains`
  ADD CONSTRAINT `complains_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `connects`
--
ALTER TABLE `connects`
  ADD CONSTRAINT `connects_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `detail_shipment_representatives`
--
ALTER TABLE `detail_shipment_representatives`
  ADD CONSTRAINT `detail_shipment_representatives_representative_id_foreign` FOREIGN KEY (`representative_id`) REFERENCES `representatives` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `detail_shipment_representatives_shipment_id_foreign` FOREIGN KEY (`shipment_id`) REFERENCES `shipments` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `detail_shipment_representatives_shipment_status_id_foreign` FOREIGN KEY (`shipment_status_id`) REFERENCES `shipment_status` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `detail_shipment_representatives_store_id_foreign` FOREIGN KEY (`store_id`) REFERENCES `stores` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `employees`
--
ALTER TABLE `employees`
  ADD CONSTRAINT `employees_branch_id_foreign` FOREIGN KEY (`branch_id`) REFERENCES `branches` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `employees_city_id_foreign` FOREIGN KEY (`city_id`) REFERENCES `cities` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `employees_department_id_foreign` FOREIGN KEY (`department_id`) REFERENCES `departments` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `employees_job_id_foreign` FOREIGN KEY (`job_id`) REFERENCES `jobs` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `employees_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `expenses`
--
ALTER TABLE `expenses`
  ADD CONSTRAINT `expenses_expense_id_foreign` FOREIGN KEY (`expense_id`) REFERENCES `expenses` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `incomes`
--
ALTER TABLE `incomes`
  ADD CONSTRAINT `incomes_income_id_foreign` FOREIGN KEY (`income_id`) REFERENCES `incomes` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `income_and_expenses`
--
ALTER TABLE `income_and_expenses`
  ADD CONSTRAINT `income_and_expenses_expense_id_foreign` FOREIGN KEY (`expense_id`) REFERENCES `expenses` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `income_and_expenses_income_id_foreign` FOREIGN KEY (`income_id`) REFERENCES `incomes` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `income_and_expenses_treasurie_id_foreign` FOREIGN KEY (`treasurie_id`) REFERENCES `treasuries` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `income_and_expenses_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `maps`
--
ALTER TABLE `maps`
  ADD CONSTRAINT `maps_representative_id_foreign` FOREIGN KEY (`representative_id`) REFERENCES `representatives` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `maps_shipment_id_foreign` FOREIGN KEY (`shipment_id`) REFERENCES `shipments` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `message_representatives`
--
ALTER TABLE `message_representatives`
  ADD CONSTRAINT `message_representatives_representative_id_foreign` FOREIGN KEY (`representative_id`) REFERENCES `representatives` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `notifications`
--
ALTER TABLE `notifications`
  ADD CONSTRAINT `notifications_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `offer_companies`
--
ALTER TABLE `offer_companies`
  ADD CONSTRAINT `offer_companies_company_id_foreign` FOREIGN KEY (`company_id`) REFERENCES `companies` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `offer_companies_offer_id_foreign` FOREIGN KEY (`offer_id`) REFERENCES `offers` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `permission_role`
--
ALTER TABLE `permission_role`
  ADD CONSTRAINT `permission_role_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `permission_role_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `permission_user`
--
ALTER TABLE `permission_user`
  ADD CONSTRAINT `permission_user_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `pick_ups`
--
ALTER TABLE `pick_ups`
  ADD CONSTRAINT `pick_ups_transport_type_id_foreign` FOREIGN KEY (`transport_type_id`) REFERENCES `transport_types` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `pick_ups_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `provinces`
--
ALTER TABLE `provinces`
  ADD CONSTRAINT `provinces_country_id_foreign` FOREIGN KEY (`country_id`) REFERENCES `countries` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `representatives`
--
ALTER TABLE `representatives`
  ADD CONSTRAINT `representatives_city_id_foreign` FOREIGN KEY (`city_id`) REFERENCES `cities` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `representatives_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `representative_accounts`
--
ALTER TABLE `representative_accounts`
  ADD CONSTRAINT `representative_accounts_representative_id_foreign` FOREIGN KEY (`representative_id`) REFERENCES `representatives` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `representative_account_details`
--
ALTER TABLE `representative_account_details`
  ADD CONSTRAINT `representative_account_details_representative_account_id_foreign` FOREIGN KEY (`representative_account_id`) REFERENCES `representative_accounts` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `representative_account_details_representative_id_foreign` FOREIGN KEY (`representative_id`) REFERENCES `representatives` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `representative_account_details_shipment_id_foreign` FOREIGN KEY (`shipment_id`) REFERENCES `shipments` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `representative_account_details_shipment_status_id_foreign` FOREIGN KEY (`shipment_status_id`) REFERENCES `shipment_status` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `representative_areas`
--
ALTER TABLE `representative_areas`
  ADD CONSTRAINT `representative_areas_area_id_foreign` FOREIGN KEY (`area_id`) REFERENCES `areas` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `representative_areas_representative_id_foreign` FOREIGN KEY (`representative_id`) REFERENCES `representatives` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `representative_areas_service_type_id_foreign` FOREIGN KEY (`service_type_id`) REFERENCES `service_types` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `representative_moves`
--
ALTER TABLE `representative_moves`
  ADD CONSTRAINT `representative_moves_representative_id_foreign` FOREIGN KEY (`representative_id`) REFERENCES `representatives` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `role_user`
--
ALTER TABLE `role_user`
  ADD CONSTRAINT `role_user_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `shipments`
--
ALTER TABLE `shipments`
  ADD CONSTRAINT `shipments_additional_service_id_foreign` FOREIGN KEY (`additional_service_id`) REFERENCES `additional_services` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `shipments_area_id_foreign` FOREIGN KEY (`area_id`) REFERENCES `areas` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `shipments_client_id_foreign` FOREIGN KEY (`client_id`) REFERENCES `clients` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `shipments_reason_id_foreign` FOREIGN KEY (`reason_id`) REFERENCES `reasons` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `shipments_representative_id_foreign` FOREIGN KEY (`representative_id`) REFERENCES `representatives` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `shipments_sender_id_foreign` FOREIGN KEY (`sender_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `shipments_service_type_id_foreign` FOREIGN KEY (`service_type_id`) REFERENCES `service_types` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `shipments_shipment_status_id_foreign` FOREIGN KEY (`shipment_status_id`) REFERENCES `shipment_status` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `shipments_store_id_foreign` FOREIGN KEY (`store_id`) REFERENCES `stores` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `shipment_transfers`
--
ALTER TABLE `shipment_transfers`
  ADD CONSTRAINT `shipment_transfers_employee_id_foreign` FOREIGN KEY (`employee_id`) REFERENCES `employees` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `shipment_transfers_representative_id_foreign` FOREIGN KEY (`representative_id`) REFERENCES `representatives` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `shipment_transfers_shipment_id_foreign` FOREIGN KEY (`shipment_id`) REFERENCES `shipments` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `shipment_transfers_store_end_id_foreign` FOREIGN KEY (`store_end_id`) REFERENCES `stores` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `shipment_transfers_store_start_id_foreign` FOREIGN KEY (`store_start_id`) REFERENCES `stores` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `shipping_area_prices`
--
ALTER TABLE `shipping_area_prices`
  ADD CONSTRAINT `shipping_area_prices_area_id_foreign` FOREIGN KEY (`area_id`) REFERENCES `areas` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `stocks`
--
ALTER TABLE `stocks`
  ADD CONSTRAINT `stocks_company_id_foreign` FOREIGN KEY (`company_id`) REFERENCES `companies` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `stocks_store_id_foreign` FOREIGN KEY (`store_id`) REFERENCES `stores` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `stock_details`
--
ALTER TABLE `stock_details`
  ADD CONSTRAINT `stock_details_shipment_id_foreign` FOREIGN KEY (`shipment_id`) REFERENCES `shipments` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `stock_details_stock_id_foreign` FOREIGN KEY (`stock_id`) REFERENCES `stocks` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `storage_system_companies`
--
ALTER TABLE `storage_system_companies`
  ADD CONSTRAINT `storage_system_companies_company_id_foreign` FOREIGN KEY (`company_id`) REFERENCES `companies` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `storage_system_companies_storage_system_id_foreign` FOREIGN KEY (`storage_system_id`) REFERENCES `storage_systems` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `stores`
--
ALTER TABLE `stores`
  ADD CONSTRAINT `stores_branche_id_foreign` FOREIGN KEY (`branche_id`) REFERENCES `branches` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `stores_employee_id_foreign` FOREIGN KEY (`employee_id`) REFERENCES `employees` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `transferring_treasuries`
--
ALTER TABLE `transferring_treasuries`
  ADD CONSTRAINT `transferring_treasuries_treasurie_end_id_foreign` FOREIGN KEY (`treasurie_end_id`) REFERENCES `treasuries` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `transferring_treasuries_treasurie_start_id_foreign` FOREIGN KEY (`treasurie_start_id`) REFERENCES `treasuries` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `transferring_treasuries_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `treasuries`
--
ALTER TABLE `treasuries`
  ADD CONSTRAINT `treasuries_treasury_id_foreign` FOREIGN KEY (`treasury_id`) REFERENCES `treasuries` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `weight_companies`
--
ALTER TABLE `weight_companies`
  ADD CONSTRAINT `weight_companies_company_id_foreign` FOREIGN KEY (`company_id`) REFERENCES `companies` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
