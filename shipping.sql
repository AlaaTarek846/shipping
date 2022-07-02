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
(1, '15 مايو', 1, NULL, NULL),
(2, 'الازبكية', 1, NULL, NULL),
(3, 'البساتين', 1, NULL, NULL),
(4, 'التبين', 1, NULL, NULL),
(5, 'الخليفة', 1, NULL, NULL),
(6, 'الدراسة', 1, NULL, NULL),
(7, 'الدرب الاحمر', 1, NULL, NULL),
(8, 'الزاوية الحمراء', 1, NULL, NULL),
(9, 'الزيتون', 1, NULL, NULL),
(10, 'الساحل', 1, NULL, NULL),
(11, 'السلام', 1, NULL, NULL),
(12, 'السيدة زينب', 1, NULL, NULL),
(13, 'الشرابية', 1, NULL, NULL),
(14, 'مدينة الشروق', 1, NULL, NULL),
(15, 'الظاهر', 1, NULL, NULL),
(16, 'العتبة', 1, NULL, NULL),
(17, 'القاهرة الجديدة', 1, NULL, NULL),
(18, 'المرج', 1, NULL, NULL),
(19, 'عزبة النخل', 1, NULL, NULL),
(20, 'المطرية', 1, NULL, NULL),
(21, 'المعادى', 1, NULL, NULL),
(22, 'المعصرة', 1, NULL, NULL),
(23, 'المقطم', 1, NULL, NULL),
(24, 'المنيل', 1, NULL, NULL),
(25, 'الموسكى', 1, NULL, NULL),
(26, 'النزهة', 1, NULL, NULL),
(27, 'الوايلى', 1, NULL, NULL),
(28, 'باب الشعرية', 1, NULL, NULL),
(29, 'بولاق', 1, NULL, NULL),
(30, 'جاردن سيتى', 1, NULL, NULL),
(31, 'حدائق القبة', 1, NULL, NULL),
(32, 'حلوان', 1, NULL, NULL),
(33, 'دار السلام', 1, NULL, NULL),
(34, 'شبرا', 1, NULL, NULL),
(35, 'طره', 1, NULL, NULL),
(36, 'عابدين', 1, NULL, NULL),
(37, 'عباسية', 1, NULL, NULL),
(38, 'عين شمس', 1, NULL, NULL),
(39, 'مدينة نصر', 1, NULL, NULL),
(40, 'مصر الجديدة', 1, NULL, NULL),
(41, 'مصر القديمة', 1, NULL, NULL),
(42, 'منشية ناصر', 1, NULL, NULL),
(43, 'مدينة بدر', 1, NULL, NULL),
(44, 'مدينة العبور', 1, NULL, NULL),
(45, 'وسط البلد', 1, NULL, NULL),
(46, 'الزمالك', 1, NULL, NULL),
(47, 'قصر النيل', 1, NULL, NULL),
(48, 'الرحاب', 1, NULL, NULL),
(49, 'القطامية', 1, NULL, NULL),
(50, 'مدينتي', 1, NULL, NULL),
(51, 'روض الفرج', 1, NULL, NULL),
(52, 'شيراتون', 1, NULL, NULL),
(53, 'الجمالية', 1, NULL, NULL),
(54, 'العاشر من رمضان', 1, NULL, NULL),
(55, 'الحلمية', 1, NULL, NULL),
(56, 'النزهة الجديدة', 1, NULL, NULL),
(57, 'العاصمة الإدارية', 1, NULL, NULL),
(58, 'الجيزة', 2, NULL, NULL),
(59, 'السادس من أكتوبر', 2, NULL, NULL),
(60, 'الشيخ زايد', 2, NULL, NULL),
(61, 'الحوامدية', 2, NULL, NULL),
(62, 'البدرشين', 2, NULL, NULL),
(63, 'الصف', 2, NULL, NULL),
(64, 'أطفيح', 2, NULL, NULL),
(65, 'العياط', 2, NULL, NULL),
(66, 'الباويطي', 2, NULL, NULL),
(67, 'منشأة القناطر', 2, NULL, NULL),
(68, 'أوسيم', 2, NULL, NULL),
(69, 'كرداسة', 2, NULL, NULL),
(70, 'أبو النمرس', 2, NULL, NULL),
(71, 'كفر غطاطي', 2, NULL, NULL),
(72, 'منشأة البكاري', 2, NULL, NULL),
(73, 'الدقى', 2, NULL, NULL),
(74, 'العجوزة', 2, NULL, NULL),
(75, 'الهرم', 2, NULL, NULL),
(76, 'الوراق', 2, NULL, NULL),
(77, 'امبابة', 2, NULL, NULL),
(78, 'بولاق الدكرور', 2, NULL, NULL),
(79, 'الواحات البحرية', 2, NULL, NULL),
(80, 'العمرانية', 2, NULL, NULL),
(81, 'المنيب', 2, NULL, NULL),
(82, 'بين السرايات', 2, NULL, NULL),
(83, 'الكيت كات', 2, NULL, NULL),
(84, 'المهندسين', 2, NULL, NULL),
(85, 'فيصل', 2, NULL, NULL),
(86, 'أبو رواش', 2, NULL, NULL),
(87, 'حدائق الأهرام', 2, NULL, NULL),
(88, 'الحرانية', 2, NULL, NULL),
(89, 'حدائق اكتوبر', 2, NULL, NULL),
(90, 'صفط اللبن', 2, NULL, NULL),
(91, 'القرية الذكية', 2, NULL, NULL),
(92, 'ارض اللواء', 2, NULL, NULL),
(93, 'ابو قير', 3, NULL, NULL),
(94, 'الابراهيمية', 3, NULL, NULL),
(95, 'الأزاريطة', 3, NULL, NULL),
(96, 'الانفوشى', 3, NULL, NULL),
(97, 'الدخيلة', 3, NULL, NULL),
(98, 'السيوف', 3, NULL, NULL),
(99, 'العامرية', 3, NULL, NULL),
(100, 'اللبان', 3, NULL, NULL),
(101, 'المفروزة', 3, NULL, NULL),
(102, 'المنتزه', 3, NULL, NULL),
(103, 'المنشية', 3, NULL, NULL),
(104, 'الناصرية', 3, NULL, NULL),
(105, 'امبروزو', 3, NULL, NULL),
(106, 'باب شرق', 3, NULL, NULL),
(107, 'برج العرب', 3, NULL, NULL),
(108, 'ستانلى', 3, NULL, NULL),
(109, 'سموحة', 3, NULL, NULL),
(110, 'سيدى بشر', 3, NULL, NULL),
(111, 'شدس', 3, NULL, NULL),
(112, 'غيط العنب', 3, NULL, NULL),
(113, 'فلمينج', 3, NULL, NULL),
(114, 'فيكتوريا', 3, NULL, NULL),
(115, 'كامب شيزار', 3, NULL, NULL),
(116, 'كرموز', 3, NULL, NULL),
(117, 'محطة الرمل', 3, NULL, NULL),
(118, 'مينا البصل', 3, NULL, NULL),
(119, 'العصافرة', 3, NULL, NULL),
(120, 'العجمي', 3, NULL, NULL),
(121, 'بكوس', 3, NULL, NULL),
(122, 'بولكلي', 3, NULL, NULL),
(123, 'كليوباترا', 3, NULL, NULL),
(124, 'جليم', 3, NULL, NULL),
(125, 'المعمورة', 3, NULL, NULL),
(126, 'المندرة', 3, NULL, NULL),
(127, 'محرم بك', 3, NULL, NULL),
(128, 'الشاطبي', 3, NULL, NULL),
(129, 'سيدي جابر', 3, NULL, NULL),
(130, 'الساحل الشمالي', 3, NULL, NULL),
(131, 'الحضرة', 3, NULL, NULL),
(132, 'العطارين', 3, NULL, NULL),
(133, 'سيدي كرير', 3, NULL, NULL),
(134, 'الجمرك', 3, NULL, NULL),
(135, 'المكس', 3, NULL, NULL),
(136, 'مارينا', 3, NULL, NULL),
(137, 'المنصورة', 4, NULL, NULL),
(138, 'طلخا', 4, NULL, NULL),
(139, 'ميت غمر', 4, NULL, NULL),
(140, 'دكرنس', 4, NULL, NULL),
(141, 'أجا', 4, NULL, NULL),
(142, 'منية النصر', 4, NULL, NULL),
(143, 'السنبلاوين', 4, NULL, NULL),
(144, 'الكردي', 4, NULL, NULL),
(145, 'بني عبيد', 4, NULL, NULL),
(146, 'المنزلة', 4, NULL, NULL),
(147, 'تمي الأمديد', 4, NULL, NULL),
(148, 'الجمالية', 4, NULL, NULL),
(149, 'شربين', 4, NULL, NULL),
(150, 'المطرية', 4, NULL, NULL),
(151, 'بلقاس', 4, NULL, NULL),
(152, 'ميت سلسيل', 4, NULL, NULL),
(153, 'جمصة', 4, NULL, NULL),
(154, 'محلة دمنة', 4, NULL, NULL),
(155, 'نبروه', 4, NULL, NULL),
(156, 'الغردقة', 5, NULL, NULL),
(157, 'رأس غارب', 5, NULL, NULL),
(158, 'سفاجا', 5, NULL, NULL),
(159, 'القصير', 5, NULL, NULL),
(160, 'مرسى علم', 5, NULL, NULL),
(161, 'الشلاتين', 5, NULL, NULL),
(162, 'حلايب', 5, NULL, NULL),
(163, 'الدهار', 5, NULL, NULL),
(164, 'دمنهور', 6, NULL, NULL),
(165, 'كفر الدوار', 6, NULL, NULL),
(166, 'رشيد', 6, NULL, NULL),
(167, 'إدكو', 6, NULL, NULL),
(168, 'أبو المطامير', 6, NULL, NULL),
(169, 'أبو حمص', 6, NULL, NULL),
(170, 'الدلنجات', 6, NULL, NULL),
(171, 'المحمودية', 6, NULL, NULL),
(172, 'الرحمانية', 6, NULL, NULL),
(173, 'إيتاي البارود', 6, NULL, NULL),
(174, 'حوش عيسى', 6, NULL, NULL),
(175, 'شبراخيت', 6, NULL, NULL),
(176, 'كوم حمادة', 6, NULL, NULL),
(177, 'بدر', 6, NULL, NULL),
(178, 'وادي النطرون', 6, NULL, NULL),
(179, 'النوبارية الجديدة', 6, NULL, NULL),
(180, 'النوبارية', 6, NULL, NULL),
(181, 'الفيوم', 7, NULL, NULL),
(182, 'الفيوم الجديدة', 7, NULL, NULL),
(183, 'طامية', 7, NULL, NULL),
(184, 'سنورس', 7, NULL, NULL),
(185, 'إطسا', 7, NULL, NULL),
(186, 'إبشواي', 7, NULL, NULL),
(187, 'يوسف الصديق', 7, NULL, NULL),
(188, 'الحادقة', 7, NULL, NULL),
(189, 'اطسا', 7, NULL, NULL),
(190, 'الجامعة', 7, NULL, NULL),
(191, 'السيالة', 7, NULL, NULL),
(192, 'طنطا', 8, NULL, NULL),
(193, 'المحلة الكبرى', 8, NULL, NULL),
(194, 'كفر الزيات', 8, NULL, NULL),
(195, 'زفتى', 8, NULL, NULL),
(196, 'السنطة', 8, NULL, NULL),
(197, 'قطور', 8, NULL, NULL),
(198, 'بسيون', 8, NULL, NULL),
(199, 'سمنود', 8, NULL, NULL),
(200, 'الإسماعيلية', 9, NULL, NULL),
(201, 'فايد', 9, NULL, NULL),
(202, 'القنطرة شرق', 9, NULL, NULL),
(203, 'القنطرة غرب', 9, NULL, NULL),
(204, 'التل الكبير', 9, NULL, NULL),
(205, 'أبو صوير', 9, NULL, NULL),
(206, 'القصاصين الجديدة', 9, NULL, NULL),
(207, 'نفيشة', 9, NULL, NULL),
(208, 'الشيخ زايد', 9, NULL, NULL),
(209, 'شبين الكوم', 10, NULL, NULL),
(210, 'مدينة السادات', 10, NULL, NULL),
(211, 'منوف', 10, NULL, NULL),
(212, 'سرس الليان', 10, NULL, NULL),
(213, 'أشمون', 10, NULL, NULL),
(214, 'الباجور', 10, NULL, NULL),
(215, 'قويسنا', 10, NULL, NULL),
(216, 'بركة السبع', 10, NULL, NULL),
(217, 'تلا', 10, NULL, NULL),
(218, 'الشهداء', 10, NULL, NULL),
(219, 'المنيا', 11, NULL, NULL),
(220, 'المنيا الجديدة', 11, NULL, NULL),
(221, 'العدوة', 11, NULL, NULL),
(222, 'مغاغة', 11, NULL, NULL),
(223, 'بني مزار', 11, NULL, NULL),
(224, 'مطاي', 11, NULL, NULL),
(225, 'سمالوط', 11, NULL, NULL),
(226, 'المدينة الفكرية', 11, NULL, NULL),
(227, 'ملوي', 11, NULL, NULL),
(228, 'دير مواس', 11, NULL, NULL),
(229, 'ابو قرقاص', 11, NULL, NULL),
(230, 'ارض سلطان', 11, NULL, NULL),
(231, 'بنها', 12, NULL, NULL),
(232, 'قليوب', 12, NULL, NULL),
(233, 'شبرا الخيمة', 12, NULL, NULL),
(234, 'القناطر الخيرية', 12, NULL, NULL),
(235, 'الخانكة', 12, NULL, NULL),
(236, 'كفر شكر', 12, NULL, NULL),
(237, 'طوخ', 12, NULL, NULL),
(238, 'قها', 12, NULL, NULL),
(239, 'العبور', 12, NULL, NULL),
(240, 'الخصوص', 12, NULL, NULL),
(241, 'شبين القناطر', 12, NULL, NULL),
(242, 'مسطرد', 12, NULL, NULL),
(243, 'الخارجة', 13, NULL, NULL),
(244, 'باريس', 13, NULL, NULL),
(245, 'موط', 13, NULL, NULL),
(246, 'الفرافرة', 13, NULL, NULL),
(247, 'بلاط', 13, NULL, NULL),
(248, 'الداخلة', 13, NULL, NULL),
(249, 'السويس', 14, NULL, NULL),
(250, 'الجناين', 14, NULL, NULL),
(251, 'عتاقة', 14, NULL, NULL),
(252, 'العين السخنة', 14, NULL, NULL),
(253, 'فيصل', 14, NULL, NULL),
(254, 'أسوان', 15, NULL, NULL),
(255, 'أسوان الجديدة', 15, NULL, NULL),
(256, 'دراو', 15, NULL, NULL),
(257, 'كوم أمبو', 15, NULL, NULL),
(258, 'نصر النوبة', 15, NULL, NULL),
(259, 'كلابشة', 15, NULL, NULL),
(260, 'إدفو', 15, NULL, NULL),
(261, 'الرديسية', 15, NULL, NULL),
(262, 'البصيلية', 15, NULL, NULL),
(263, 'السباعية', 15, NULL, NULL),
(264, 'ابوسمبل السياحية', 15, NULL, NULL),
(265, 'مرسى علم', 15, NULL, NULL),
(266, 'أسيوط', 16, NULL, NULL),
(267, 'أسيوط الجديدة', 16, NULL, NULL),
(268, 'ديروط', 16, NULL, NULL),
(269, 'منفلوط', 16, NULL, NULL),
(270, 'القوصية', 16, NULL, NULL),
(271, 'أبنوب', 16, NULL, NULL),
(272, 'أبو تيج', 16, NULL, NULL),
(273, 'الغنايم', 16, NULL, NULL),
(274, 'ساحل سليم', 16, NULL, NULL),
(275, 'البداري', 16, NULL, NULL),
(276, 'صدفا', 16, NULL, NULL),
(277, 'بني سويف', 17, NULL, NULL),
(278, 'بني سويف الجديدة', 17, NULL, NULL),
(279, 'الواسطى', 17, NULL, NULL),
(280, 'ناصر', 17, NULL, NULL),
(281, 'إهناسيا', 17, NULL, NULL),
(282, 'ببا', 17, NULL, NULL),
(283, 'الفشن', 17, NULL, NULL),
(284, 'سمسطا', 17, NULL, NULL),
(285, 'الاباصيرى', 17, NULL, NULL),
(286, 'مقبل', 17, NULL, NULL),
(287, 'بورسعيد', 18, NULL, NULL),
(288, 'بورفؤاد', 18, NULL, NULL),
(289, 'العرب', 18, NULL, NULL),
(290, 'حى الزهور', 18, NULL, NULL),
(291, 'حى الشرق', 18, NULL, NULL),
(292, 'حى الضواحى', 18, NULL, NULL),
(293, 'حى المناخ', 18, NULL, NULL),
(294, 'حى مبارك', 18, NULL, NULL),
(295, 'دمياط', 19, NULL, NULL),
(296, 'دمياط الجديدة', 19, NULL, NULL),
(297, 'رأس البر', 19, NULL, NULL),
(298, 'فارسكور', 19, NULL, NULL),
(299, 'الزرقا', 19, NULL, NULL),
(300, 'السرو', 19, NULL, NULL),
(301, 'الروضة', 19, NULL, NULL),
(302, 'كفر البطيخ', 19, NULL, NULL),
(303, 'عزبة البرج', 19, NULL, NULL),
(304, 'ميت أبو غالب', 19, NULL, NULL),
(305, 'كفر سعد', 19, NULL, NULL),
(306, 'الزقازيق', 20, NULL, NULL),
(307, 'العاشر من رمضان', 20, NULL, NULL),
(308, 'منيا القمح', 20, NULL, NULL),
(309, 'بلبيس', 20, NULL, NULL),
(310, 'مشتول السوق', 20, NULL, NULL),
(311, 'القنايات', 20, NULL, NULL),
(312, 'أبو حماد', 20, NULL, NULL),
(313, 'القرين', 20, NULL, NULL),
(314, 'ههيا', 20, NULL, NULL),
(315, 'أبو كبير', 20, NULL, NULL),
(316, 'فاقوس', 20, NULL, NULL),
(317, 'الصالحية الجديدة', 20, NULL, NULL),
(318, 'الإبراهيمية', 20, NULL, NULL),
(319, 'ديرب نجم', 20, NULL, NULL),
(320, 'كفر صقر', 20, NULL, NULL),
(321, 'أولاد صقر', 20, NULL, NULL),
(322, 'الحسينية', 20, NULL, NULL),
(323, 'صان الحجر القبلية', 20, NULL, NULL),
(324, 'منشأة أبو عمر', 20, NULL, NULL),
(325, 'الطور', 21, NULL, NULL),
(326, 'شرم الشيخ', 21, NULL, NULL),
(327, 'دهب', 21, NULL, NULL),
(328, 'نويبع', 21, NULL, NULL),
(329, 'طابا', 21, NULL, NULL),
(330, 'سانت كاترين', 21, NULL, NULL),
(331, 'أبو رديس', 21, NULL, NULL),
(332, 'أبو زنيمة', 21, NULL, NULL),
(333, 'رأس سدر', 21, NULL, NULL),
(334, 'كفر الشيخ', 22, NULL, NULL),
(335, 'وسط البلد كفر الشيخ', 22, NULL, NULL),
(336, 'دسوق', 22, NULL, NULL),
(337, 'فوه', 22, NULL, NULL),
(338, 'مطوبس', 22, NULL, NULL),
(339, 'برج البرلس', 22, NULL, NULL),
(340, 'بلطيم', 22, NULL, NULL),
(341, 'مصيف بلطيم', 22, NULL, NULL),
(342, 'الحامول', 22, NULL, NULL),
(343, 'بيلا', 22, NULL, NULL),
(344, 'الرياض', 22, NULL, NULL),
(345, 'سيدي سالم', 22, NULL, NULL),
(346, 'قلين', 22, NULL, NULL),
(347, 'سيدي غازي', 22, NULL, NULL),
(348, 'مرسى مطروح', 23, NULL, NULL),
(349, 'الحمام', 23, NULL, NULL),
(350, 'العلمين', 23, NULL, NULL),
(351, 'الضبعة', 23, NULL, NULL),
(352, 'النجيلة', 23, NULL, NULL),
(353, 'سيدي براني', 23, NULL, NULL),
(354, 'السلوم', 23, NULL, NULL),
(355, 'سيوة', 23, NULL, NULL),
(356, 'مارينا', 23, NULL, NULL),
(357, 'الساحل الشمالى', 23, NULL, NULL),
(358, 'الأقصر', 24, NULL, NULL),
(359, 'الأقصر الجديدة', 24, NULL, NULL),
(360, 'إسنا', 24, NULL, NULL),
(361, 'طيبة الجديدة', 24, NULL, NULL),
(362, 'الزينية', 24, NULL, NULL),
(363, 'البياضية', 24, NULL, NULL),
(364, 'القرنة', 24, NULL, NULL),
(365, 'أرمنت', 24, NULL, NULL),
(366, 'الطود', 24, NULL, NULL),
(367, 'قنا', 25, NULL, NULL),
(368, 'قنا الجديدة', 25, NULL, NULL),
(369, 'ابو طشت', 25, NULL, NULL),
(370, 'نجع حمادي', 25, NULL, NULL),
(371, 'دشنا', 25, NULL, NULL),
(372, 'الوقف', 25, NULL, NULL),
(373, 'قفط', 25, NULL, NULL),
(374, 'نقادة', 25, NULL, NULL),
(375, 'فرشوط', 25, NULL, NULL),
(376, 'قوص', 25, NULL, NULL),
(377, 'العريش', 26, NULL, NULL),
(378, 'الشيخ زويد', 26, NULL, NULL),
(379, 'نخل', 26, NULL, NULL),
(380, 'رفح', 26, NULL, NULL),
(381, 'بئر العبد', 26, NULL, NULL),
(382, 'الحسنة', 26, NULL, NULL),
(383, 'سوهاج', 27, NULL, NULL),
(384, 'سوهاج الجديدة', 27, NULL, NULL),
(385, 'أخميم', 27, NULL, NULL),
(386, 'أخميم الجديدة', 27, NULL, NULL),
(387, 'البلينا', 27, NULL, NULL),
(388, 'المراغة', 27, NULL, NULL),
(389, 'المنشأة', 27, NULL, NULL),
(390, 'دار السلام', 27, NULL, NULL),
(391, 'جرجا', 27, NULL, NULL),
(392, 'جهينة الغربية', 27, NULL, NULL),
(393, 'ساقلته', 27, NULL, NULL),
(394, 'طما', 27, NULL, NULL),
(395, 'طهطا', 27, NULL, NULL),
(396, 'الكوثر', 27, NULL, NULL);

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
(1, 'القاهرة', NULL, NULL),
(2, 'الجيزة', NULL, NULL),
(3, 'الأسكندرية', NULL, NULL),
(4, 'الدقهلية', NULL, NULL),
(5, 'البحر الأحمر', NULL, NULL),
(6, 'البحيرة', NULL, NULL),
(7, 'الفيوم', NULL, NULL),
(8, 'الغربية', NULL, NULL),
(9, 'الإسماعلية', NULL, NULL),
(10, 'المنوفية', NULL, NULL),
(11, 'المنيا', NULL, NULL),
(12, 'القليوبية', NULL, NULL),
(13, 'الوادي الجديد', NULL, NULL),
(14, 'السويس', NULL, NULL),
(15, 'اسوان', NULL, NULL),
(16, 'اسيوط', NULL, NULL),
(17, 'بني سويف', NULL, NULL),
(18, 'بورسعيد', NULL, NULL),
(19, 'دمياط', NULL, NULL),
(20, 'الشرقية', NULL, NULL),
(21, 'جنوب سيناء', NULL, NULL),
(22, 'كفر الشيخ', NULL, NULL),
(23, 'مطروح', NULL, NULL),
(24, 'الأقصر', NULL, NULL),
(25, 'قنا', NULL, NULL),
(26, 'شمال سيناء', NULL, NULL),
(27, 'سوهاج', NULL, NULL);

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
(1, 'كاش', 'كاش', '2022-06-08 11:35:27', '2022-06-08 11:35:27'),
(2, 'فيزا', 'فيزا', '2022-06-08 11:35:27', '2022-06-08 11:35:27');

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
(1, 'منتج غير ملائم', '2022-06-08 11:35:27', '2022-06-08 11:35:27'),
(2, 'جودة غير مقبولة', '2022-06-08 11:35:27', '2022-06-08 11:35:27'),
(3, 'عميل متهرب', '2022-06-08 11:35:27', '2022-06-08 11:35:27'),
(4, 'مشكلة تخص السعر', '2022-06-08 11:35:27', '2022-06-08 11:35:27'),
(5, 'تأخير التوصيل', '2022-06-08 11:35:28', '2022-06-08 11:35:28'),
(6, 'الطلب مكرر', '2022-06-08 11:35:28', '2022-06-08 11:35:28'),
(7, 'التغليف تالف', '2022-06-08 11:35:28', '2022-06-08 11:35:28'),
(8, 'التليفون مغلق', '2022-06-08 11:35:28', '2022-06-08 11:35:28'),
(9, 'العميل لا يرد', '2022-06-08 11:35:28', '2022-06-08 11:35:28'),
(10, 'عنوان خطأ', '2022-06-08 11:35:28', '2022-06-08 11:35:28');

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
(1, 'تسليم و تحصيل', '2022-06-08 11:35:26', '2022-06-08 11:35:26'),
(2, ' تحصيل', '2022-06-08 11:35:27', '2022-06-08 11:35:27'),
(3, ' تسليم', '2022-06-08 11:35:27', '2022-06-08 11:35:27');

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
(1, 'طلب بيك اب', '2022-06-08 11:35:26', '2022-06-08 11:35:26'),
(2, 'المندوب فى الطريق لاستلام البيك اب', '2022-06-08 11:35:26', '2022-06-08 11:35:26'),
(3, 'تم استلام البيك اب', '2022-06-08 11:35:26', '2022-06-08 11:35:26'),
(4, 'في الطريق الي المخزن', '2022-06-08 11:35:26', '2022-06-08 11:35:26'),
(5, 'تم التسليم في المخزن', '2022-06-08 11:35:26', '2022-06-08 11:35:26'),
(6, 'قيد التوصيل', '2022-06-08 11:35:26', '2022-06-08 11:35:26'),
(7, 'تسليم ناجح', '2022-06-08 11:35:26', '2022-06-08 11:35:26'),
(8, 'مرتجع جزئي  مسدد قيمة الشحن', '2022-06-08 11:35:26', '2022-06-08 11:35:26'),
(9, ' مرتجع جزئي و لم يسديد قيمة الشحن', '2022-06-08 11:35:26', '2022-06-08 11:35:26'),
(10, 'مرتجع كامل مسدد قيمة الشحن', '2022-06-08 11:35:26', '2022-06-08 11:35:26'),
(11, 'مرتجع كامل و لم يسدد قيمة الشحن', '2022-06-08 11:35:26', '2022-06-08 11:35:26'),
(12, 'شحنه ملغية', '2022-06-08 11:35:26', '2022-06-08 11:35:26');

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
(1, 'سكوتر', 40.00, '2022-06-08 11:35:27', '2022-06-08 11:35:27'),
(2, 'عربية', 50.00, '2022-06-08 11:35:27', '2022-06-08 11:35:27');

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
(1, 'كيلو', 10, 50.00, NULL, NULL);

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
