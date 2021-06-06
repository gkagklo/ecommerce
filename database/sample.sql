-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Φιλοξενητής: 127.0.0.1
-- Χρόνος δημιουργίας: 06 Ιουν 2021 στις 13:39:53
-- Έκδοση διακομιστή: 10.4.16-MariaDB
-- Έκδοση PHP: 7.4.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Βάση δεδομένων: `sample`
--

-- --------------------------------------------------------

--
-- Δομή πίνακα για τον πίνακα `admins`
--

CREATE TABLE `admins` (
  `id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `type` enum('Admin','Sub Admin') NOT NULL DEFAULT 'Admin',
  `categories_access` tinyint(4) NOT NULL DEFAULT 0,
  `products_access` tinyint(4) NOT NULL DEFAULT 0,
  `orders_access` tinyint(4) NOT NULL DEFAULT 0,
  `users_access` tinyint(4) NOT NULL DEFAULT 0,
  `posts_access` tinyint(4) NOT NULL DEFAULT 0,
  `banners_access` tinyint(4) NOT NULL DEFAULT 0,
  `admins_access` tinyint(4) NOT NULL DEFAULT 0,
  `coupons_access` tinyint(4) NOT NULL DEFAULT 0,
  `cmspages_access` tinyint(4) NOT NULL DEFAULT 0,
  `status` tinyint(4) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Άδειασμα δεδομένων του πίνακα `admins`
--

INSERT INTO `admins` (`id`, `username`, `email`, `password`, `type`, `categories_access`, `products_access`, `orders_access`, `users_access`, `posts_access`, `banners_access`, `admins_access`, `coupons_access`, `cmspages_access`, `status`, `created_at`, `updated_at`) VALUES
(1, 'admin', 'geogkagkloidis@hotmail.com', 'f2fcc0d38223719afaa10df93343739a', 'Admin', 0, 0, 0, 0, 0, 0, 0, 0, 0, 1, '2019-06-20 00:00:00', '2020-12-29 12:52:44'),
(11, 'papas', 'deathbreakerxx@hotmail.com', '98faf0db94a94a6e2d4ea47e7b2105d4', 'Sub Admin', 1, 1, 0, 0, 1, 1, 0, 0, 0, 1, '2019-08-10 14:54:59', '2020-12-29 12:50:38');

-- --------------------------------------------------------

--
-- Δομή πίνακα για τον πίνακα `banners`
--

CREATE TABLE `banners` (
  `id` int(11) NOT NULL,
  `image` varchar(255) NOT NULL,
  `title` varchar(255) NOT NULL,
  `link` varchar(255) NOT NULL,
  `status` tinyint(4) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Άδειασμα δεδομένων του πίνακα `banners`
--

INSERT INTO `banners` (`id`, `image`, `title`, `link`, `status`, `created_at`, `updated_at`) VALUES
(1, '83709.png', 'Men clothing', '/products/men', 1, '2019-06-20 22:43:43', '2019-06-20 23:21:12'),
(2, '10137.png', 'Women clothing', '/products/women', 1, '2019-06-20 22:44:40', '2019-06-20 23:21:42'),
(3, '62294.png', 'Kids clothing', '/products/kids', 1, '2019-06-20 22:44:54', '2019-06-20 23:22:18');

-- --------------------------------------------------------

--
-- Δομή πίνακα για τον πίνακα `cart`
--

CREATE TABLE `cart` (
  `id` int(10) UNSIGNED NOT NULL,
  `product_id` int(11) NOT NULL,
  `product_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `product_code` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `product_color` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `size` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `price` double(8,2) NOT NULL,
  `quantity` int(11) NOT NULL,
  `user_email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `session_id` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Δομή πίνακα για τον πίνακα `categories`
--

CREATE TABLE `categories` (
  `id` int(10) UNSIGNED NOT NULL,
  `parent_id` int(11) DEFAULT 0,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `url` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `meta_title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `meta_description` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `meta_keywords` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 1,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Άδειασμα δεδομένων του πίνακα `categories`
--

INSERT INTO `categories` (`id`, `parent_id`, `name`, `description`, `url`, `meta_title`, `meta_description`, `meta_keywords`, `status`, `remember_token`, `created_at`, `updated_at`) VALUES
(9, 0, 'Men', 'men clothing', 'men', 'Men clothing', 'men clothing', 'men clothing', 1, NULL, '2019-06-20 19:25:41', '2019-06-21 12:59:18'),
(10, 9, 'T-shirts', 't-shirts', 'men-clothing-tshirts', 'T-shirts for men', 'T-shirts for men', 'men, t-shirts, clothing', 1, NULL, '2019-06-20 19:51:16', '2019-06-21 13:02:05'),
(11, 0, 'Women', 'women', 'women', 'women clothing', 'women clothing', 'women clothing', 1, NULL, '2019-06-20 20:24:24', '2019-06-20 20:24:24'),
(12, 0, 'Kids', 'kids', 'kids', 'kids clothing', 'kids clothing', 'kids clothing', 1, NULL, '2019-06-20 20:27:42', '2019-06-20 20:27:42'),
(13, 9, 'Shorts', 'shorts for men', 'men-clothing-shorts', 'Shorts for men', 'Shorts for men', 'men, shorts, clothing', 1, NULL, '2019-06-21 11:18:46', '2019-06-21 13:03:28'),
(14, 9, 'Sports shoes', 'Sports shoes for men', 'men-clothing-sports-shoes', 'Sports shoes for men', 'Sports shoes for men', 'Men, sports shoes, clothing', 1, NULL, '2019-06-21 13:05:10', '2019-06-21 13:31:25'),
(15, 9, 'Jeans', 'Jeans for men', 'men-clothing-jeans', 'Jeans for men', 'Jeans for men', 'Men, jeans, clothing', 1, NULL, '2019-06-21 13:06:58', '2019-06-21 13:07:31'),
(17, 11, 'Dresses', 'Dresses for women', 'women-clothing-dresses', 'Dresses for women', 'Dresses for women', 'women, dresses, clothing', 1, NULL, '2019-06-21 15:14:17', '2019-06-21 15:15:06'),
(18, 12, 'T-shirts', 'T-shirts for kids', 'kids-clothing-tshirts', 'T-shirts for kids', 'T-shirts for kids', 'kids, tshirts, clothing', 1, NULL, '2019-06-21 15:17:55', '2019-06-21 15:17:55'),
(19, 11, 'Jeans', 'Jeans for women', 'women-clothing-jeans', 'Jeans for women', 'Jeans for women', 'Jeans, women, clothing', 1, NULL, '2019-06-22 10:10:28', '2019-06-22 10:10:41'),
(20, 11, 'Shorts & Skirts', 'Shorts & Skirts for women', 'women-clothing-Shorts&Skirts', 'Shorts & Skirts for women', 'Shorts & Skirts for women', 'Shorts & Skirts, women, clothing', 1, NULL, '2019-06-22 10:22:45', '2019-06-22 10:23:20'),
(21, 11, 'Sports Shoes', 'Sports Shoes for women', 'women-clothing-sports-shoes', 'Sports Shoes for women', 'Sports Shoes for women', 'Sports Shoes, women, clothing', 1, NULL, '2019-06-22 10:31:20', '2019-06-22 10:31:51');

-- --------------------------------------------------------

--
-- Δομή πίνακα για τον πίνακα `cms_pages`
--

CREATE TABLE `cms_pages` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `url` varchar(255) NOT NULL,
  `description` varchar(255) NOT NULL,
  `meta_title` varchar(255) NOT NULL,
  `meta_description` varchar(255) NOT NULL,
  `meta_keywords` varchar(255) NOT NULL,
  `status` tinyint(4) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Άδειασμα δεδομένων του πίνακα `cms_pages`
--

INSERT INTO `cms_pages` (`id`, `title`, `url`, `description`, `meta_title`, `meta_description`, `meta_keywords`, `status`, `created_at`, `updated_at`) VALUES
(1, 'About Us', 'about-us', '<p>information about our company</p>', 'About our company', 'ecommerce, clothes, sales', 'ecommerce, clothes, sales', 1, '2019-08-09 16:18:25', '2019-08-09 16:24:08');

-- --------------------------------------------------------

--
-- Δομή πίνακα για τον πίνακα `comments`
--

CREATE TABLE `comments` (
  `id` int(11) NOT NULL,
  `post_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `comment` text NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Άδειασμα δεδομένων του πίνακα `comments`
--

INSERT INTO `comments` (`id`, `post_id`, `user_id`, `comment`, `created_at`, `updated_at`) VALUES
(1, 3, 17, 'hello im geo', '2020-04-17 22:21:34', '2020-04-17 22:21:34');

-- --------------------------------------------------------

--
-- Δομή πίνακα για τον πίνακα `countries`
--

CREATE TABLE `countries` (
  `id` int(11) NOT NULL,
  `country_code` varchar(2) NOT NULL DEFAULT '',
  `country_name` varchar(100) NOT NULL DEFAULT ''
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Άδειασμα δεδομένων του πίνακα `countries`
--

INSERT INTO `countries` (`id`, `country_code`, `country_name`) VALUES
(1, 'AF', 'Afghanistan'),
(2, 'AL', 'Albania'),
(3, 'DZ', 'Algeria'),
(4, 'DS', 'American Samoa'),
(5, 'AD', 'Andorra'),
(6, 'AO', 'Angola'),
(7, 'AI', 'Anguilla'),
(8, 'AQ', 'Antarctica'),
(9, 'AG', 'Antigua and Barbuda'),
(10, 'AR', 'Argentina'),
(11, 'AM', 'Armenia'),
(12, 'AW', 'Aruba'),
(13, 'AU', 'Australia'),
(14, 'AT', 'Austria'),
(15, 'AZ', 'Azerbaijan'),
(16, 'BS', 'Bahamas'),
(17, 'BH', 'Bahrain'),
(18, 'BD', 'Bangladesh'),
(19, 'BB', 'Barbados'),
(20, 'BY', 'Belarus'),
(21, 'BE', 'Belgium'),
(22, 'BZ', 'Belize'),
(23, 'BJ', 'Benin'),
(24, 'BM', 'Bermuda'),
(25, 'BT', 'Bhutan'),
(26, 'BO', 'Bolivia'),
(27, 'BA', 'Bosnia and Herzegovina'),
(28, 'BW', 'Botswana'),
(29, 'BV', 'Bouvet Island'),
(30, 'BR', 'Brazil'),
(31, 'IO', 'British Indian Ocean Territory'),
(32, 'BN', 'Brunei Darussalam'),
(33, 'BG', 'Bulgaria'),
(34, 'BF', 'Burkina Faso'),
(35, 'BI', 'Burundi'),
(36, 'KH', 'Cambodia'),
(37, 'CM', 'Cameroon'),
(38, 'CA', 'Canada'),
(39, 'CV', 'Cape Verde'),
(40, 'KY', 'Cayman Islands'),
(41, 'CF', 'Central African Republic'),
(42, 'TD', 'Chad'),
(43, 'CL', 'Chile'),
(44, 'CN', 'China'),
(45, 'CX', 'Christmas Island'),
(46, 'CC', 'Cocos (Keeling) Islands'),
(47, 'CO', 'Colombia'),
(48, 'KM', 'Comoros'),
(49, 'CG', 'Congo'),
(50, 'CK', 'Cook Islands'),
(51, 'CR', 'Costa Rica'),
(52, 'HR', 'Croatia (Hrvatska)'),
(53, 'CU', 'Cuba'),
(54, 'CY', 'Cyprus'),
(55, 'CZ', 'Czech Republic'),
(56, 'DK', 'Denmark'),
(57, 'DJ', 'Djibouti'),
(58, 'DM', 'Dominica'),
(59, 'DO', 'Dominican Republic'),
(60, 'TP', 'East Timor'),
(61, 'EC', 'Ecuador'),
(62, 'EG', 'Egypt'),
(63, 'SV', 'El Salvador'),
(64, 'GQ', 'Equatorial Guinea'),
(65, 'ER', 'Eritrea'),
(66, 'EE', 'Estonia'),
(67, 'ET', 'Ethiopia'),
(68, 'FK', 'Falkland Islands (Malvinas)'),
(69, 'FO', 'Faroe Islands'),
(70, 'FJ', 'Fiji'),
(71, 'FI', 'Finland'),
(72, 'FR', 'France'),
(73, 'FX', 'France, Metropolitan'),
(74, 'GF', 'French Guiana'),
(75, 'PF', 'French Polynesia'),
(76, 'TF', 'French Southern Territories'),
(77, 'GA', 'Gabon'),
(78, 'GM', 'Gambia'),
(79, 'GE', 'Georgia'),
(80, 'DE', 'Germany'),
(81, 'GH', 'Ghana'),
(82, 'GI', 'Gibraltar'),
(83, 'GK', 'Guernsey'),
(84, 'GR', 'Greece'),
(85, 'GL', 'Greenland'),
(86, 'GD', 'Grenada'),
(87, 'GP', 'Guadeloupe'),
(88, 'GU', 'Guam'),
(89, 'GT', 'Guatemala'),
(90, 'GN', 'Guinea'),
(91, 'GW', 'Guinea-Bissau'),
(92, 'GY', 'Guyana'),
(93, 'HT', 'Haiti'),
(94, 'HM', 'Heard and Mc Donald Islands'),
(95, 'HN', 'Honduras'),
(96, 'HK', 'Hong Kong'),
(97, 'HU', 'Hungary'),
(98, 'IS', 'Iceland'),
(99, 'IN', 'India'),
(100, 'IM', 'Isle of Man'),
(101, 'ID', 'Indonesia'),
(102, 'IR', 'Iran (Islamic Republic of)'),
(103, 'IQ', 'Iraq'),
(104, 'IE', 'Ireland'),
(105, 'IL', 'Israel'),
(106, 'IT', 'Italy'),
(107, 'CI', 'Ivory Coast'),
(108, 'JE', 'Jersey'),
(109, 'JM', 'Jamaica'),
(110, 'JP', 'Japan'),
(111, 'JO', 'Jordan'),
(112, 'KZ', 'Kazakhstan'),
(113, 'KE', 'Kenya'),
(114, 'KI', 'Kiribati'),
(115, 'KP', 'Korea, Democratic People\'s Republic of'),
(116, 'KR', 'Korea, Republic of'),
(117, 'XK', 'Kosovo'),
(118, 'KW', 'Kuwait'),
(119, 'KG', 'Kyrgyzstan'),
(120, 'LA', 'Lao People\'s Democratic Republic'),
(121, 'LV', 'Latvia'),
(122, 'LB', 'Lebanon'),
(123, 'LS', 'Lesotho'),
(124, 'LR', 'Liberia'),
(125, 'LY', 'Libyan Arab Jamahiriya'),
(126, 'LI', 'Liechtenstein'),
(127, 'LT', 'Lithuania'),
(128, 'LU', 'Luxembourg'),
(129, 'MO', 'Macau'),
(130, 'MK', 'Macedonia'),
(131, 'MG', 'Madagascar'),
(132, 'MW', 'Malawi'),
(133, 'MY', 'Malaysia'),
(134, 'MV', 'Maldives'),
(135, 'ML', 'Mali'),
(136, 'MT', 'Malta'),
(137, 'MH', 'Marshall Islands'),
(138, 'MQ', 'Martinique'),
(139, 'MR', 'Mauritania'),
(140, 'MU', 'Mauritius'),
(141, 'TY', 'Mayotte'),
(142, 'MX', 'Mexico'),
(143, 'FM', 'Micronesia, Federated States of'),
(144, 'MD', 'Moldova, Republic of'),
(145, 'MC', 'Monaco'),
(146, 'MN', 'Mongolia'),
(147, 'ME', 'Montenegro'),
(148, 'MS', 'Montserrat'),
(149, 'MA', 'Morocco'),
(150, 'MZ', 'Mozambique'),
(151, 'MM', 'Myanmar'),
(152, 'NA', 'Namibia'),
(153, 'NR', 'Nauru'),
(154, 'NP', 'Nepal'),
(155, 'NL', 'Netherlands'),
(156, 'AN', 'Netherlands Antilles'),
(157, 'NC', 'New Caledonia'),
(158, 'NZ', 'New Zealand'),
(159, 'NI', 'Nicaragua'),
(160, 'NE', 'Niger'),
(161, 'NG', 'Nigeria'),
(162, 'NU', 'Niue'),
(163, 'NF', 'Norfolk Island'),
(164, 'MP', 'Northern Mariana Islands'),
(165, 'NO', 'Norway'),
(166, 'OM', 'Oman'),
(167, 'PK', 'Pakistan'),
(168, 'PW', 'Palau'),
(169, 'PS', 'Palestine'),
(170, 'PA', 'Panama'),
(171, 'PG', 'Papua New Guinea'),
(172, 'PY', 'Paraguay'),
(173, 'PE', 'Peru'),
(174, 'PH', 'Philippines'),
(175, 'PN', 'Pitcairn'),
(176, 'PL', 'Poland'),
(177, 'PT', 'Portugal'),
(178, 'PR', 'Puerto Rico'),
(179, 'QA', 'Qatar'),
(180, 'RE', 'Reunion'),
(181, 'RO', 'Romania'),
(182, 'RU', 'Russian Federation'),
(183, 'RW', 'Rwanda'),
(184, 'KN', 'Saint Kitts and Nevis'),
(185, 'LC', 'Saint Lucia'),
(186, 'VC', 'Saint Vincent and the Grenadines'),
(187, 'WS', 'Samoa'),
(188, 'SM', 'San Marino'),
(189, 'ST', 'Sao Tome and Principe'),
(190, 'SA', 'Saudi Arabia'),
(191, 'SN', 'Senegal'),
(192, 'RS', 'Serbia'),
(193, 'SC', 'Seychelles'),
(194, 'SL', 'Sierra Leone'),
(195, 'SG', 'Singapore'),
(196, 'SK', 'Slovakia'),
(197, 'SI', 'Slovenia'),
(198, 'SB', 'Solomon Islands'),
(199, 'SO', 'Somalia'),
(200, 'ZA', 'South Africa'),
(201, 'GS', 'South Georgia South Sandwich Islands'),
(202, 'SS', 'South Sudan'),
(203, 'ES', 'Spain'),
(204, 'LK', 'Sri Lanka'),
(205, 'SH', 'St. Helena'),
(206, 'PM', 'St. Pierre and Miquelon'),
(207, 'SD', 'Sudan'),
(208, 'SR', 'Suriname'),
(209, 'SJ', 'Svalbard and Jan Mayen Islands'),
(210, 'SZ', 'Swaziland'),
(211, 'SE', 'Sweden'),
(212, 'CH', 'Switzerland'),
(213, 'SY', 'Syrian Arab Republic'),
(214, 'TW', 'Taiwan'),
(215, 'TJ', 'Tajikistan'),
(216, 'TZ', 'Tanzania, United Republic of'),
(217, 'TH', 'Thailand'),
(218, 'TG', 'Togo'),
(219, 'TK', 'Tokelau'),
(220, 'TO', 'Tonga'),
(221, 'TT', 'Trinidad and Tobago'),
(222, 'TN', 'Tunisia'),
(223, 'TR', 'Turkey'),
(224, 'TM', 'Turkmenistan'),
(225, 'TC', 'Turks and Caicos Islands'),
(226, 'TV', 'Tuvalu'),
(227, 'UG', 'Uganda'),
(228, 'UA', 'Ukraine'),
(229, 'AE', 'United Arab Emirates'),
(230, 'GB', 'United Kingdom'),
(231, 'US', 'United States'),
(232, 'UM', 'United States minor outlying islands'),
(233, 'UY', 'Uruguay'),
(234, 'UZ', 'Uzbekistan'),
(235, 'VU', 'Vanuatu'),
(236, 'VA', 'Vatican City State'),
(237, 'VE', 'Venezuela'),
(238, 'VN', 'Vietnam'),
(239, 'VG', 'Virgin Islands (British)'),
(240, 'VI', 'Virgin Islands (U.S.)'),
(241, 'WF', 'Wallis and Futuna Islands'),
(242, 'EH', 'Western Sahara'),
(243, 'YE', 'Yemen'),
(244, 'ZR', 'Zaire'),
(245, 'ZM', 'Zambia'),
(246, 'ZW', 'Zimbabwe');

-- --------------------------------------------------------

--
-- Δομή πίνακα για τον πίνακα `coupons`
--

CREATE TABLE `coupons` (
  `id` int(10) UNSIGNED NOT NULL,
  `coupon_code` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `amount` int(11) NOT NULL,
  `amount_type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiry_date` date NOT NULL,
  `status` tinyint(4) NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Άδειασμα δεδομένων του πίνακα `coupons`
--

INSERT INTO `coupons` (`id`, `coupon_code`, `amount`, `amount_type`, `expiry_date`, `status`, `created_at`, `updated_at`) VALUES
(1, 'MYCOUPON', 50, 'Fixed', '2019-09-09', 1, '2019-08-09 15:47:10', '2019-08-09 12:47:10');

-- --------------------------------------------------------

--
-- Δομή πίνακα για τον πίνακα `delivery_addresses`
--

CREATE TABLE `delivery_addresses` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `user_email` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `last_name` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL,
  `city` varchar(255) NOT NULL,
  `state` varchar(255) NOT NULL,
  `country` varchar(255) NOT NULL,
  `pincode` varchar(255) NOT NULL,
  `mobile` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Άδειασμα δεδομένων του πίνακα `delivery_addresses`
--

INSERT INTO `delivery_addresses` (`id`, `user_id`, `user_email`, `name`, `last_name`, `address`, `city`, `state`, `country`, `pincode`, `mobile`, `created_at`, `updated_at`) VALUES
(1, 17, 'deathbreakerxx@hotmail.com', 'geo', 'gkagklo', 'elmazi 1', 'thessaloniki', 'ampelokipi', 'Greece', '56123', '6981472586', '2019-06-23 11:49:52', '2019-06-23 11:49:52'),
(2, 18, 'geogkagkloidis@hotmail.com', 'geo', 'gkagklo', 'peran 12', 'thessaloniki', 'ampelokipi', 'Greece', '56121', '6981236549', '2019-06-23 12:40:24', '2019-06-23 12:40:24');

-- --------------------------------------------------------

--
-- Δομή πίνακα για τον πίνακα `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Άδειασμα δεδομένων του πίνακα `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2018_03_18_090951_create_category_table', 2),
(4, '2018_03_18_100532_add_url_to_categories', 3),
(5, '2018_03_29_144354_create_products_table', 4),
(6, '2018_04_16_135232_create_products_attributes_table', 5),
(7, '2018_06_21_174929_create_cart_table', 6),
(8, '2018_07_09_150844_create_coupons_table', 7);

-- --------------------------------------------------------

--
-- Δομή πίνακα για τον πίνακα `orders`
--

CREATE TABLE `orders` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `user_email` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL,
  `city` varchar(255) NOT NULL,
  `state` varchar(255) NOT NULL,
  `pincode` varchar(255) NOT NULL,
  `country` varchar(255) NOT NULL,
  `mobile` varchar(255) NOT NULL,
  `coupon_code` varchar(255) NOT NULL,
  `coupon_amount` float NOT NULL,
  `order_status` varchar(255) NOT NULL,
  `payment_method` varchar(255) NOT NULL,
  `grand_total` float NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Άδειασμα δεδομένων του πίνακα `orders`
--

INSERT INTO `orders` (`id`, `user_id`, `user_email`, `name`, `address`, `city`, `state`, `pincode`, `country`, `mobile`, `coupon_code`, `coupon_amount`, `order_status`, `payment_method`, `grand_total`, `created_at`, `updated_at`) VALUES
(1, 17, 'deathbreakerxx@hotmail.com', 'geo', 'elmazi 1', 'thessaloniki', 'ampelokipi', '56123', 'Greece', '6981472586', '', 0, 'New', 'COD', 25, '2019-06-22 14:59:33', '2019-06-22 11:59:33'),
(2, 17, 'deathbreakerxx@hotmail.com', 'geo', 'elmazi 1', 'thessaloniki', 'ampelokipi', '56123', 'Greece', '6981472586', '', 0, 'New', 'COD', 75, '2019-06-23 12:31:50', '2019-06-23 09:31:50'),
(3, 17, 'deathbreakerxx@hotmail.com', 'geo', 'elmazi 1', 'thessaloniki', 'ampelokipi', '56123', 'Greece', '6981472586', '', 0, 'New', 'COD', 25, '2019-06-23 12:35:46', '2019-06-23 09:35:46'),
(4, 17, 'deathbreakerxx@hotmail.com', 'geo', 'elmazi 1', 'thessaloniki', 'ampelokipi', '56123', 'Greece', '6981472586', '', 0, 'New', 'Paypal', 65, '2019-06-23 13:35:59', '2019-06-23 10:35:59'),
(5, 17, 'deathbreakerxx@hotmail.com', 'geo', 'elmazi 1', 'thessaloniki', 'ampelokipi', '56123', 'Greece', '6981472586', '', 0, 'New', 'Paypal', 65, '2019-06-23 13:50:16', '2019-06-23 10:50:16'),
(6, 17, 'deathbreakerxx@hotmail.com', 'geo', 'elmazi 1', 'thessaloniki', 'ampelokipi', '56123', 'Greece', '6981472586', '', 0, 'New', 'Paypal', 25, '2019-06-23 14:49:58', '2019-06-23 11:49:58'),
(7, 18, 'geogkagkloidis@hotmail.com', 'geo', 'peran 12', 'thessaloniki', 'ampelokipi', '56121', 'Greece', '6981236549', '', 0, 'New', 'Paypal', 30, '2019-06-23 15:05:27', '2019-06-23 12:05:27'),
(8, 18, 'geogkagkloidis@hotmail.com', 'geo', 'peran 12', 'thessaloniki', 'ampelokipi', '56121', 'Greece', '6981236549', '', 0, 'New', 'Paypal', 15, '2019-06-23 15:30:54', '2019-06-23 12:30:54'),
(9, 18, 'geogkagkloidis@hotmail.com', 'geo', 'peran 12', 'thessaloniki', 'ampelokipi', '56121', 'Greece', '6981236549', '', 0, 'New', 'Paypal', 15, '2019-06-23 15:39:08', '2019-06-23 12:39:08'),
(10, 18, 'geogkagkloidis@hotmail.com', 'geo', 'peran 12', 'thessaloniki', 'ampelokipi', '56121', 'Greece', '6981236549', '', 0, 'New', 'Paypal', 30, '2019-06-23 15:40:28', '2019-06-23 12:40:28');

-- --------------------------------------------------------

--
-- Δομή πίνακα για τον πίνακα `orders_products`
--

CREATE TABLE `orders_products` (
  `id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `product_code` varchar(255) NOT NULL,
  `product_name` varchar(255) NOT NULL,
  `product_size` varchar(255) NOT NULL,
  `product_color` varchar(255) NOT NULL,
  `product_price` float NOT NULL,
  `product_qty` int(11) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Άδειασμα δεδομένων του πίνακα `orders_products`
--

INSERT INTO `orders_products` (`id`, `order_id`, `user_id`, `product_id`, `product_code`, `product_name`, `product_size`, `product_color`, `product_price`, `product_qty`, `created_at`, `updated_at`) VALUES
(1, 1, 17, 2, 'Rs.524-L', 'Men Charcoal Grey Printed Round Neck T-shirt', 'LARGE', 'Grey', 25, 1, '2019-06-22 14:59:33', '2019-06-22 11:59:33'),
(2, 2, 17, 4, 'Rs.399-XL', 'Men Black Solid Polo Collar T-shirt', 'XLARGE', 'Black', 15, 1, '2019-06-23 12:31:50', '2019-06-23 09:31:50'),
(3, 2, 17, 15, 'Rs.4399-40', 'Men Black Alphabounce RC 2 Running Shoes', '40', 'Black', 60, 1, '2019-06-23 12:31:50', '2019-06-23 09:31:50'),
(4, 3, 17, 20, 'Rs.944-38', 'Men Brown Straight Fit Mid-Rise Clean Look Jeans', '38', 'Brown', 25, 1, '2019-06-23 12:35:46', '2019-06-23 09:35:46'),
(5, 4, 17, 24, 'Rs.1319-38', 'Women Black Running Shoes', '38', 'Black', 65, 1, '2019-06-23 13:35:59', '2019-06-23 10:35:59'),
(6, 5, 17, 24, 'Rs.1319-38', 'Women Black Running Shoes', '38', 'Black', 65, 1, '2019-06-23 13:50:16', '2019-06-23 10:50:16'),
(7, 6, 17, 2, 'Rs.524-M', 'Men Charcoal Grey Printed Round Neck T-shirt', 'MEDIUM', 'Grey', 25, 1, '2019-06-23 14:49:58', '2019-06-23 11:49:58'),
(8, 7, 18, 1, 'Rs.239-L', 'Men Navy Printed Round Neck T-shirt', 'LARGE', 'Blue', 30, 1, '2019-06-23 15:05:27', '2019-06-23 12:05:27'),
(9, 8, 18, 4, 'Rs.399', 'Men Black Solid Polo Collar T-shirt', 'SMALL', 'Black', 15, 1, '2019-06-23 15:30:54', '2019-06-23 12:30:54'),
(10, 10, 18, 16, 'Rs.1019-40', 'Men Blue Vapour Slim Jeans', '40', 'Blue', 30, 1, '2019-06-23 15:40:28', '2019-06-23 12:40:28');

-- --------------------------------------------------------

--
-- Δομή πίνακα για τον πίνακα `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Δομή πίνακα για τον πίνακα `popular_products`
--

CREATE TABLE `popular_products` (
  `id` int(11) NOT NULL,
  `pro_id` int(11) NOT NULL,
  `uid` int(11) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Άδειασμα δεδομένων του πίνακα `popular_products`
--

INSERT INTO `popular_products` (`id`, `pro_id`, `uid`, `created_at`, `updated_at`) VALUES
(1, 1, 17, '2019-06-20 23:07:33', '2019-06-20 23:07:33'),
(2, 1, 17, '2019-06-20 23:08:22', '2019-06-20 23:08:22'),
(3, 1, 17, '2019-06-20 23:08:40', '2019-06-20 23:08:40'),
(4, 1, 17, '2019-06-20 23:17:11', '2019-06-20 23:17:11'),
(5, 16, 17, '2019-06-21 18:04:19', '2019-06-21 18:04:19'),
(6, 16, 17, '2019-06-21 18:04:25', '2019-06-21 18:04:25'),
(7, 16, 17, '2019-06-21 18:04:55', '2019-06-21 18:04:55'),
(8, 16, 17, '2019-06-21 18:05:52', '2019-06-21 18:05:52'),
(9, 5, 17, '2019-06-22 14:34:41', '2019-06-22 14:34:41'),
(10, 5, 17, '2019-06-22 14:35:39', '2019-06-22 14:35:39'),
(11, 5, 17, '2019-06-22 14:36:11', '2019-06-22 14:36:11'),
(12, 5, 17, '2019-06-22 14:39:45', '2019-06-22 14:39:45'),
(13, 5, 17, '2019-06-22 14:39:50', '2019-06-22 14:39:50'),
(14, 5, 17, '2019-06-22 14:40:09', '2019-06-22 14:40:09'),
(15, 5, 17, '2019-06-22 14:40:24', '2019-06-22 14:40:24'),
(16, 5, 17, '2019-06-22 14:41:44', '2019-06-22 14:41:44'),
(17, 5, 17, '2019-06-22 14:42:43', '2019-06-22 14:42:43'),
(18, 5, 17, '2019-06-22 14:42:55', '2019-06-22 14:42:55'),
(19, 5, 17, '2019-06-22 14:43:41', '2019-06-22 14:43:41'),
(20, 5, 17, '2019-06-22 14:44:14', '2019-06-22 14:44:14'),
(21, 5, 17, '2019-06-22 14:45:04', '2019-06-22 14:45:04'),
(22, 5, 17, '2019-06-22 14:45:25', '2019-06-22 14:45:25'),
(23, 5, 17, '2019-06-22 14:45:38', '2019-06-22 14:45:38'),
(24, 5, 17, '2019-06-22 14:45:48', '2019-06-22 14:45:48'),
(25, 5, 17, '2019-06-22 14:45:54', '2019-06-22 14:45:54'),
(26, 4, 17, '2019-06-22 14:46:06', '2019-06-22 14:46:06'),
(27, 5, 17, '2019-06-22 14:46:20', '2019-06-22 14:46:20'),
(28, 17, 17, '2019-06-22 14:47:32', '2019-06-22 14:47:32'),
(29, 17, 17, '2019-06-22 14:47:38', '2019-06-22 14:47:38'),
(30, 17, 17, '2019-06-22 14:47:38', '2019-06-22 14:47:38'),
(31, 17, 17, '2019-06-22 14:47:38', '2019-06-22 14:47:38'),
(32, 17, 17, '2019-06-22 14:47:39', '2019-06-22 14:47:39'),
(33, 17, 17, '2019-06-22 14:47:39', '2019-06-22 14:47:39'),
(34, 17, 17, '2019-06-22 14:47:40', '2019-06-22 14:47:40'),
(35, 17, 17, '2019-06-22 14:47:41', '2019-06-22 14:47:41'),
(36, 17, 17, '2019-06-22 14:47:41', '2019-06-22 14:47:41'),
(37, 17, 17, '2019-06-22 14:47:42', '2019-06-22 14:47:42'),
(38, 17, 17, '2019-06-22 14:47:43', '2019-06-22 14:47:43'),
(39, 17, 17, '2019-06-22 14:47:43', '2019-06-22 14:47:43'),
(40, 17, 17, '2019-06-22 14:47:44', '2019-06-22 14:47:44'),
(41, 17, 17, '2019-06-22 14:47:45', '2019-06-22 14:47:45'),
(42, 17, 17, '2019-06-22 14:47:45', '2019-06-22 14:47:45'),
(43, 17, 17, '2019-06-22 14:47:46', '2019-06-22 14:47:46'),
(44, 17, 17, '2019-06-22 14:47:47', '2019-06-22 14:47:47'),
(45, 17, 17, '2019-06-22 14:54:51', '2019-06-22 14:54:51'),
(46, 17, 17, '2019-06-22 14:54:52', '2019-06-22 14:54:52'),
(47, 17, 17, '2019-06-22 14:54:52', '2019-06-22 14:54:52'),
(48, 2, 17, '2019-06-22 14:55:35', '2019-06-22 14:55:35'),
(49, 15, 17, '2019-06-23 12:15:15', '2019-06-23 12:15:15'),
(50, 20, 17, '2019-06-23 12:32:23', '2019-06-23 12:32:23'),
(51, 18, 17, '2019-06-23 12:37:39', '2019-06-23 12:37:39'),
(52, 24, 17, '2019-06-23 12:50:52', '2019-06-23 12:50:52'),
(53, 24, 17, '2019-06-23 13:50:01', '2019-06-23 13:50:01'),
(54, 2, 17, '2019-06-23 14:49:05', '2019-06-23 14:49:05'),
(55, 1, 18, '2019-06-23 15:03:50', '2019-06-23 15:03:50'),
(56, 4, 18, '2019-06-23 15:30:22', '2019-06-23 15:30:22'),
(57, 16, 18, '2019-06-23 15:39:52', '2019-06-23 15:39:52'),
(58, 1, 18, '2019-06-26 12:55:00', '2019-06-26 12:55:00'),
(59, 1, 18, '2019-06-26 12:55:21', '2019-06-26 12:55:21'),
(60, 5, 18, '2019-06-26 12:56:32', '2019-06-26 12:56:32'),
(61, 2, 18, '2019-06-26 12:56:46', '2019-06-26 12:56:46'),
(62, 2, 18, '2019-06-26 12:57:52', '2019-06-26 12:57:52'),
(63, 1, 18, '2019-06-26 12:59:38', '2019-06-26 12:59:38'),
(64, 1, 18, '2019-06-26 13:04:22', '2019-06-26 13:04:22'),
(65, 1, 18, '2019-06-26 13:04:44', '2019-06-26 13:04:44'),
(66, 1, 18, '2019-06-26 13:04:59', '2019-06-26 13:04:59'),
(67, 1, 18, '2019-06-26 13:05:10', '2019-06-26 13:05:10'),
(68, 1, 18, '2019-06-26 13:08:25', '2019-06-26 13:08:25'),
(69, 1, 18, '2019-06-26 13:08:26', '2019-06-26 13:08:26'),
(70, 1, 18, '2019-06-26 13:08:40', '2019-06-26 13:08:40'),
(71, 1, 18, '2019-06-26 13:10:21', '2019-06-26 13:10:21'),
(72, 1, 17, '2019-06-26 13:10:47', '2019-06-26 13:10:47'),
(73, 1, 17, '2019-06-26 13:10:57', '2019-06-26 13:10:57'),
(74, 1, 17, '2019-06-26 13:11:13', '2019-06-26 13:11:13'),
(75, 1, 17, '2019-06-26 13:11:54', '2019-06-26 13:11:54'),
(76, 1, 17, '2019-06-26 13:12:04', '2019-06-26 13:12:04'),
(77, 1, 17, '2019-06-26 13:14:18', '2019-06-26 13:14:18'),
(78, 1, 17, '2019-06-26 13:14:21', '2019-06-26 13:14:21'),
(79, 1, 17, '2019-06-26 13:14:32', '2019-06-26 13:14:32'),
(80, 1, 17, '2019-06-26 13:14:45', '2019-06-26 13:14:45'),
(81, 1, 17, '2019-06-26 13:16:14', '2019-06-26 13:16:14'),
(82, 1, 17, '2019-06-26 13:18:38', '2019-06-26 13:18:38'),
(83, 1, 17, '2019-06-26 13:19:12', '2019-06-26 13:19:12'),
(84, 1, 17, '2019-06-26 13:19:22', '2019-06-26 13:19:22'),
(85, 1, 17, '2019-06-26 13:19:26', '2019-06-26 13:19:26'),
(86, 1, 17, '2019-06-26 13:21:02', '2019-06-26 13:21:02'),
(87, 1, 17, '2019-06-26 13:21:04', '2019-06-26 13:21:04'),
(88, 1, 17, '2019-06-26 13:21:44', '2019-06-26 13:21:44'),
(89, 1, 17, '2019-06-26 13:21:48', '2019-06-26 13:21:48'),
(90, 1, 17, '2019-06-26 13:21:58', '2019-06-26 13:21:58'),
(91, 1, 17, '2019-06-26 13:22:26', '2019-06-26 13:22:26'),
(92, 20, 17, '2019-06-27 13:17:54', '2019-06-27 13:17:54'),
(93, 19, 17, '2019-06-27 14:02:47', '2019-06-27 14:02:47'),
(94, 2, 18, '2019-06-27 14:03:47', '2019-06-27 14:03:47'),
(95, 10, 18, '2019-06-27 14:29:54', '2019-06-27 14:29:54'),
(96, 14, 18, '2019-06-27 14:31:19', '2019-06-27 14:31:19'),
(97, 20, 17, '2019-06-28 12:33:12', '2019-06-28 12:33:12'),
(98, 20, 18, '2019-06-28 13:09:46', '2019-06-28 13:09:46'),
(99, 20, 18, '2019-06-28 13:09:53', '2019-06-28 13:09:53'),
(100, 20, 18, '2019-06-28 13:09:56', '2019-06-28 13:09:56'),
(101, 20, 18, '2019-06-28 14:26:18', '2019-06-28 14:26:18'),
(102, 20, 18, '2019-06-28 14:26:23', '2019-06-28 14:26:23'),
(103, 20, 18, '2019-06-28 14:31:56', '2019-06-28 14:31:56'),
(104, 20, 18, '2019-06-28 14:33:37', '2019-06-28 14:33:37'),
(105, 20, 18, '2019-06-28 14:33:38', '2019-06-28 14:33:38'),
(106, 20, 18, '2019-06-28 14:33:40', '2019-06-28 14:33:40'),
(107, 20, 18, '2019-06-28 14:34:00', '2019-06-28 14:34:00'),
(108, 20, 18, '2019-06-28 14:34:02', '2019-06-28 14:34:02'),
(109, 20, 18, '2019-06-28 14:34:03', '2019-06-28 14:34:03'),
(110, 20, 18, '2019-06-28 14:34:05', '2019-06-28 14:34:05'),
(111, 20, 18, '2019-06-28 14:34:20', '2019-06-28 14:34:20'),
(112, 20, 18, '2019-06-28 14:34:22', '2019-06-28 14:34:22'),
(113, 18, 18, '2019-06-28 14:34:36', '2019-06-28 14:34:36'),
(114, 18, 18, '2019-06-28 14:34:52', '2019-06-28 14:34:52'),
(115, 18, 18, '2019-06-28 14:35:45', '2019-06-28 14:35:45'),
(116, 18, 18, '2019-06-28 14:35:47', '2019-06-28 14:35:47'),
(117, 20, 18, '2019-06-28 14:36:08', '2019-06-28 14:36:08'),
(118, 20, 18, '2019-06-28 14:36:22', '2019-06-28 14:36:22'),
(119, 19, 18, '2019-06-28 15:11:46', '2019-06-28 15:11:46'),
(120, 20, 18, '2019-06-28 19:30:00', '2019-06-28 19:30:00'),
(121, 25, 17, '2019-06-28 21:10:30', '2019-06-28 21:10:30'),
(122, 25, 17, '2019-06-28 21:15:11', '2019-06-28 21:15:11'),
(123, 15, 17, '2019-08-08 13:45:12', '2019-08-08 13:45:12'),
(124, 10, 17, '2019-11-21 10:55:09', '2019-11-21 10:55:09'),
(125, 10, 17, '2019-11-21 10:55:24', '2019-11-21 10:55:24'),
(126, 20, 17, '2019-11-21 10:57:57', '2019-11-21 10:57:57'),
(127, 25, 17, '2019-11-21 11:00:29', '2019-11-21 11:00:29'),
(128, 15, 17, '2019-11-21 11:02:15', '2019-11-21 11:02:15'),
(129, 15, 17, '2019-11-21 11:02:23', '2019-11-21 11:02:23'),
(130, 24, 17, '2020-04-17 22:20:30', '2020-04-17 22:20:30'),
(131, 20, 18, '2020-12-29 15:22:01', '2020-12-29 15:22:01');

-- --------------------------------------------------------

--
-- Δομή πίνακα για τον πίνακα `posts`
--

CREATE TABLE `posts` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `body` text NOT NULL,
  `image` varchar(255) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Άδειασμα δεδομένων του πίνακα `posts`
--

INSERT INTO `posts` (`id`, `title`, `body`, `image`, `created_at`, `updated_at`) VALUES
(2, 'Lorem ipsum dolor sit amet, consectetuer adipiscing elit.', '<p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Donec quam felis, ultricies nec, pellentesque eu, pretium quis, sem. Nulla consequat massa quis enim. Donec pede justo, fringilla vel, aliquet nec, vulputatqqqqq.</p>', '23495.jpg', '2019-06-21 17:35:11', '2019-08-09 16:03:59'),
(3, 'One morning, when Gregor Samsa woke from troubled', '<p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa.</p>\r\n\r\n<p>Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Donec quam felis, ultricies nec, pellentesque eu, pretium quis, sem. Nulla consequat massa quis enim. Donec pede justo, fringilla vel, aliquet nec, vulputate</p>', '80664.jpg', '2019-06-22 15:20:11', '2019-06-22 15:20:11');

-- --------------------------------------------------------

--
-- Δομή πίνακα για τον πίνακα `products`
--

CREATE TABLE `products` (
  `id` int(10) UNSIGNED NOT NULL,
  `category_id` int(11) NOT NULL,
  `product_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `product_brand` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `product_code` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `product_color` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `care` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `price` double(8,2) NOT NULL,
  `sale_price` double(8,2) DEFAULT 0.00,
  `image` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `video` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `new_arrival` tinyint(1) NOT NULL,
  `feature_item` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Άδειασμα δεδομένων του πίνακα `products`
--

INSERT INTO `products` (`id`, `category_id`, `product_name`, `product_brand`, `product_code`, `product_color`, `description`, `care`, `price`, `sale_price`, `image`, `video`, `status`, `new_arrival`, `feature_item`, `created_at`, `updated_at`) VALUES
(1, 10, 'Men Navy Printed Round Neck T-shirt', 'Roadster', 'Rs.239', 'Blue', '<p><strong>PRODUCT DETAILS&nbsp;</strong></p>\r\n\r\n<p>Navy blue printed T-shirt, has a round neck, short sleeves</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p><strong>Size &amp; Fit</strong></p>\r\n\r\n<p>The model (height 6&#39;) is wearing a size M</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p><strong>Specifications</strong></p>\r\n\r\n<p>Sleeve Styling: Regular Sleeves</p>\r\n\r\n<p>Multipack Set: Single</p>\r\n\r\n<p>Occasion: Casual</p>\r\n\r\n<p>Main Trend: New Basics</p>\r\n\r\n<p>Print or Pattern Type: Typography</p>\r\n\r\n<p>Neck: Round Neck</p>\r\n\r\n<p>Pattern: Printed</p>\r\n\r\n<p>Sleeve Length: Short Sleeves</p>\r\n\r\n<p>Wash Care: Machine Wash</p>\r\n\r\n<p>Fit: Regular Fit</p>\r\n\r\n<p>Length: Regular</p>\r\n\r\n<p>Pattern Coverage: Placement</p>\r\n\r\n<p>Fabric: Cotton</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p><strong>Complete The Look</strong></p>\r\n\r\n<p>Stand out this season when you go with the sleek style of a Roadster T-shirt. This navy blue piece can be styled with dark denims and canvas shoes when you&#39;re going out to eat with your friends.</p>', '100% cotton\r\nMachine-wash', 30.00, 0.00, '61453.jpg', '', 1, 0, 0, '2019-06-20 19:57:18', '2019-06-21 12:37:12'),
(2, 10, 'Men Charcoal Grey Printed Round Neck T-shirt', 'Jack & Jones', 'Rs.524', 'Grey', '<p><strong>PRODUCT DETAILS&nbsp;</strong></p>\r\n\r\n<p><a href=\"https://www.myntra.com/charcoal?src=pd\">Charcoal</a>&nbsp;<a href=\"https://www.myntra.com/grey?src=pd\">grey</a>&nbsp;printed T-shirt, has a round neck,&nbsp;<a href=\"https://www.myntra.com/short?src=pd\">short</a>&nbsp;sleeves</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p><strong>Size &amp; Fit</strong></p>\r\n\r\n<p>The model (height 6&#39;) is wearing a size M</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p><strong>Specifications</strong></p>\r\n\r\n<p>Sleeve Styling: Regular Sleeves</p>\r\n\r\n<p>Multipack Set: Single</p>\r\n\r\n<p>Occasion: Casual</p>\r\n\r\n<p>Main Trend: Typography or Slogan Prints</p>\r\n\r\n<p>Print or Pattern Type: Typography</p>\r\n\r\n<p>Neck: Round Neck</p>\r\n\r\n<p>Pattern: Printed</p>\r\n\r\n<p>Sleeve Length: Short Sleeves</p>\r\n\r\n<p>Wash Care: Machine Wash</p>\r\n\r\n<p>Fit: Slim Fit</p>\r\n\r\n<p>Length: Regular</p>\r\n\r\n<p>Pattern Coverage: Chest</p>\r\n\r\n<p>Fabric: Cotton</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p><strong>Complete The Look</strong></p>\r\n\r\n<p>Made of cotton, you&#39;ll love the high-quality fit and feel of this Jack &amp; Jones tee. When you&#39;re going for a stroll in the park, put this charcoal piece with a pair of chinos and sneakers to feel both comfortable and stylish outside.</p>', '100% cotton\r\nMachine-wash', 25.00, 0.00, '98161.jpg', '', 1, 0, 0, '2019-06-21 10:28:23', '2019-06-21 10:28:23'),
(3, 10, 'Men Navy Blue Solid Round Neck T-shirt', 'U.S. Polo Assn.', 'Rs.849', 'Blue', '<p><strong>PRODUCT DETAILS&nbsp;</strong></p>\r\n\r\n<p><a href=\"https://www.myntra.com/navy-blue?src=pd\">Navy blue</a>&nbsp;<a href=\"https://www.myntra.com/solid?src=pd\">solid</a>&nbsp;T-shirt, engineered with Equi-Dry technology, has a round neck,&nbsp;<a href=\"https://www.myntra.com/short?src=pd\">short</a>&nbsp;sleeves</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p><strong>Size &amp; Fit</strong></p>\r\n\r\n<p>The model (height 6&#39;) is wearing a size M</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p><strong>Specifications</strong></p>\r\n\r\n<p>Sleeve Styling: Regular Sleeves</p>\r\n\r\n<p>Multipack Set: Single</p>\r\n\r\n<p>Occasion: Sports</p>\r\n\r\n<p>Main Trend: New Basics</p>\r\n\r\n<p>Print or Pattern Type: Solid</p>\r\n\r\n<p>Neck: Round Neck</p>\r\n\r\n<p>Pattern: Solid</p>\r\n\r\n<p>Sleeve Length: Short Sleeves</p>\r\n\r\n<p>Wash Care: Machine Wash</p>\r\n\r\n<p>Fit: Regular Fit</p>\r\n\r\n<p>Length: Regular</p>\r\n\r\n<p>Fabric: Polyester</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p><strong>Complete The Look</strong></p>\r\n\r\n<p>Make a name for yourself this season with this cool T-shirt from U.S. Polo Assn. This navy blue piece can be styled with dark denims and canvas shoes when you&#39;re going out to eat with your friends.</p>', '100% polyester\r\nMachine-wash', 40.00, 0.00, '17267.jpg', '', 1, 1, 0, '2019-06-21 10:33:55', '2019-06-22 11:50:40'),
(4, 10, 'Men Black Solid Polo Collar T-shirt', 'HERENOW', 'Rs.399', 'Black', '<p><strong>PRODUCT DETAILS&nbsp;</strong></p>\r\n\r\n<p>Black solid T-shirt, has a polo collar, short sleeves</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p><strong>Size &amp; Fit</strong></p>\r\n\r\n<p>The model (height 6&#39;) is wearing a size M</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p><strong>Specifications</strong></p>\r\n\r\n<p>Sleeve Styling: Regular Sleeves</p>\r\n\r\n<p>Multipack Set: Single</p>\r\n\r\n<p>Occasion: Casual</p>\r\n\r\n<p>Main Trend: New Basics</p>\r\n\r\n<p>Print or Pattern Type: Solid</p>\r\n\r\n<p>Neck: Polo Collar</p>\r\n\r\n<p>Pattern: Solid</p>\r\n\r\n<p>Sleeve Length: Short Sleeves</p>\r\n\r\n<p>Wash Care: Machine Wash</p>\r\n\r\n<p>Fit: Regular Fit</p>\r\n\r\n<p>Length: Regular</p>\r\n\r\n<p>Fabric: Cotton</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p><strong>Complete The Look</strong></p>\r\n\r\n<p>Sometimes dressing up can be a bit much for the occasion. That&#39;s why you should consider one of these amazing T-shirts from HERE&amp;NOW. This black piece can be styled with dark denims and canvas shoes when you&#39;re going out to eat with your friends.</p>', 'Cotton \r\nMachine-wash', 15.00, 0.00, '91787.jpg', '', 1, 0, 0, '2019-06-21 10:47:11', '2019-06-21 10:47:11'),
(5, 10, 'Men White Printed Henley Neck T-shirt', 'Roadster', 'Rs.299', 'White', '<p><strong>PRODUCT DETAILS&nbsp;</strong></p>\r\n\r\n<p>White and navy blue printed T-shirt, has a Henley neck, short sleeves</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p><strong>Size &amp; Fit</strong></p>\r\n\r\n<p>The model (height 6&#39;) is wearing a size M</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p><strong>Specifications</strong></p>\r\n\r\n<p>Sleeve Styling: Regular Sleeves</p>\r\n\r\n<p>Multipack Set: Single</p>\r\n\r\n<p>Occasion: Casual</p>\r\n\r\n<p>Main Trend: Abstract</p>\r\n\r\n<p>Print or Pattern Type: Abstract</p>\r\n\r\n<p>Neck: Henley Neck</p>\r\n\r\n<p>Pattern: Printed</p>\r\n\r\n<p>Sleeve Length: Short Sleeves</p>\r\n\r\n<p>Wash Care: Machine Wash</p>\r\n\r\n<p>Fit: Regular Fit</p>\r\n\r\n<p>Length: Regular</p>\r\n\r\n<p>Fabric: Cotton</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p><strong>Complete The Look</strong></p>\r\n\r\n<p>You&#39;ll love the softness and durability of this high-fashion Roadster tee. Wear this white piece many ways, with dark wash jeans, cuffed chinos and more.</p>', 'Cotton\r\nMachine-wash', 19.99, 0.00, '45681.jpg', '', 1, 0, 0, '2019-06-21 10:54:38', '2019-06-21 10:54:38'),
(6, 13, 'Men Blue Washed Denim Shorts', 'Roadster', 'Rs.849', 'Blue', '<p><strong>PRODUCT DETAILS&nbsp;</strong></p>\r\n\r\n<p>Blue washed mid-rise denim shorts, has four pockets, a button closure</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p><strong>Size &amp; Fit</strong></p>\r\n\r\n<p>Regular Fit<br />\r\nThe model (height 6&#39;) is wearing a size 32</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p><strong>Specifications</strong></p>\r\n\r\n<p>Waist Rise: Mid-Rise</p>\r\n\r\n<p>Length: Above Knee</p>\r\n\r\n<p>Type: Denim Shorts</p>\r\n\r\n<p>Closure: Button</p>\r\n\r\n<p>Print or Pattern Type: Washed</p>\r\n\r\n<p>Fit: Regular Fit</p>\r\n\r\n<p>Number of Pockets: 4</p>\r\n\r\n<p>Occasion: Casual</p>\r\n\r\n<p>Knit or Woven: Woven</p>\r\n\r\n<p>Main Trend: New Basics</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p><strong>Complete The Look</strong></p>\r\n\r\n<p>Expand your summer and spring wardrobe collection with these super-cool blue solid shorts. This blue pair can be worn with a classic T-shirt and canvas shoes for a casual night out on the town.</p>', '98% cotton 2% elastane\r\nMachine-wash', 25.00, 0.00, '3936.jpg', '', 1, 0, 0, '2019-06-21 11:21:26', '2019-06-21 11:21:26'),
(7, 13, 'Men Olive Green Printed Regular Fit Chino Shorts', 'Roadster', 'Rs.649', 'Green', '<p><strong>PRODUCT DETAILS&nbsp;</strong></p>\r\n\r\n<p>Olive green printed mid-rise chino shorts, has 5 pockets, a button closure</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p><strong>Size &amp; Fit</strong></p>\r\n\r\n<p>Regular fit<br />\r\nThe model (height 6&#39;) is wearing a size 32</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p><strong>Specifications</strong></p>\r\n\r\n<p>Waist Rise: Mid-Rise</p>\r\n\r\n<p>Length: Knee Length</p>\r\n\r\n<p>Type: Chino Shorts</p>\r\n\r\n<p>Closure: Button</p>\r\n\r\n<p>Print or Pattern Type: Graphic</p>\r\n\r\n<p>Fit: Regular Fit</p>\r\n\r\n<p>Number of Pockets: 5</p>\r\n\r\n<p>Occasion: Casual</p>\r\n\r\n<p>Knit or Woven: Woven</p>\r\n\r\n<p>Main Trend: Conversational Print</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p><strong>Complete The Look</strong></p>\r\n\r\n<p>When you need to upgrade your summer wardrobe, opt for these casual olive printed shorts. Match this olive pair with a handsome shirt and easy loafers for your next date night.</p>', '100% cotton\r\nMachine-wash', 16.50, 0.00, '6753.jpg', '', 1, 0, 0, '2019-06-21 11:33:14', '2019-06-21 11:33:14'),
(8, 13, 'Men Blue Washed Distressed Regular Fit Denim Shorts', 'HERENOW', 'Rs.1049', 'Blue', '<p><strong>PRODUCT DETAILS&nbsp;</strong></p>\r\n\r\n<p>Blue washed mid-rise distressed denim shorts, has 5 pockets, a button and zip closure</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p><strong>Size &amp; Fit</strong></p>\r\n\r\n<p>Regular Fit&nbsp;<br />\r\nThe model (height 6&#39;) is wearing a size 32</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p><strong>Specifications</strong></p>\r\n\r\n<p>Waist Rise: Mid-Rise</p>\r\n\r\n<p>Length: Knee Length</p>\r\n\r\n<p>Type: Denim Shorts</p>\r\n\r\n<p>Closure: Button</p>\r\n\r\n<p>Print or Pattern Type: Washed</p>\r\n\r\n<p>Fit: Regular Fit</p>\r\n\r\n<p>Number of Pockets: 5</p>\r\n\r\n<p>Occasion: Casual</p>\r\n\r\n<p>Knit or Woven: Woven</p>\r\n\r\n<p>Surface Styling: Distressed</p>\r\n\r\n<p>Main Trend: Indigo</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p><strong>Complete The Look</strong></p>\r\n\r\n<p>Get these blue washed shorts to impress everyone this season. Match this blue pair with a handsome shirt and easy loafers for your next date night.</p>', '98.5% cotton, 1.5% elastane\r\nMachine-wash', 35.00, 0.00, '3052.jpg', '', 1, 1, 0, '2019-06-21 12:05:24', '2019-06-22 11:51:09'),
(9, 13, 'Men White Solid Active Regular Fit Sports Shorts', 'HRX by Hrithik Roshan', 'Rs.679', 'White', '<p><strong>PRODUCT DETAILS&nbsp;</strong></p>\r\n\r\n<p><strong>Special Technology:</strong></p>\r\n\r\n<p>Engineered with RAPID-DRY technology to keep you sweat free all day long and ultra-fresh freshness protection</p>\r\n\r\n<p><strong>Product Details :</strong></p>\r\n\r\n<p>White solid active mid-rise sports shorts, has two pockets, a drawstring closure</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p><strong>Size &amp; Fit</strong></p>\r\n\r\n<p>Regular Fit<br />\r\nThe model (height 6&#39;) is wearing a size 30</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p><strong>Specifications</strong></p>\r\n\r\n<p>Waist Rise: Mid-Rise</p>\r\n\r\n<p>Length: Above Knee</p>\r\n\r\n<p>Type: Sports Shorts</p>\r\n\r\n<p>Closure: Drawstring</p>\r\n\r\n<p>Print or Pattern Type: Solid</p>\r\n\r\n<p>Fit: Regular Fit</p>\r\n\r\n<p>Number of Pockets: 2</p>\r\n\r\n<p>Occasion: Sports</p>\r\n\r\n<p>Knit or Woven: Knitted</p>\r\n\r\n<p>Main Trend: New Basics</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p><strong>Complete The Look</strong></p>\r\n\r\n<p>You&#39;ll love the comfort and style of these trendy black printed shorts. This white pair can be worn with a classic T-shirt and sports shoes for a workout session.</p>', 'Cotton and elastane blend\r\nMachine-wash', 10.00, 0.00, '75411.jpg', '', 1, 0, 0, '2019-06-21 12:11:37', '2019-06-21 12:16:25'),
(10, 13, 'Men Red Rapid Dry Lightweight Dolphin Running shorts', 'HRX by Hrithik Roshan', 'Rs.479', 'Red', '<p><strong>PRODUCT DETAILS&nbsp;</strong></p>\r\n\r\n<p>The HRX Men&#39;s Running Shorts are constructed with a polyester lycra blend fabric that stretches to accommodate your every move. The Rapid Dry and Anti-microbial technology incorporated in the fabric ensures that you don&#39;t just look good while you run, you stay fresh too.<br />\r\n<br />\r\n<strong>Features</strong></p>\r\n\r\n<ol>\r\n	<li>Rapid Dry technology wicks sweat and dries fast.</li>\r\n	<li>Anti-Microbial technology keeps odor-causing microbes away.</li>\r\n	<li>Lightweight fabric</li>\r\n	<li>4-way stretch for full range of motion.</li>\r\n	<li>Dolphin hem</li>\r\n	<li>Mid rise waist gives secure fit.</li>\r\n	<li>Length: Above knee</li>\r\n	<li>Fit: Regular</li>\r\n</ol>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p><strong>Size &amp; Fit</strong></p>\r\n\r\n<p>Regular Fit<br />\r\nThe model (height 6&#39;) is wearing a size 32</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p><strong>Specifications</strong></p>\r\n\r\n<p>Waist Rise: Mid-Rise</p>\r\n\r\n<p>Length: Above Knee</p>\r\n\r\n<p>Type: Sports Shorts</p>\r\n\r\n<p>Closure: Drawstring</p>\r\n\r\n<p>Print or Pattern Type: Solid</p>\r\n\r\n<p>Fit: Regular Fit</p>\r\n\r\n<p>Occasion: Sports</p>\r\n\r\n<p>Knit or Woven: Woven</p>\r\n\r\n<p>Main Trend: New Basics</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p><strong>Complete The Look</strong></p>\r\n\r\n<p>These trendy red solid shorts will help you set the tone for this season. This red pair can be worn with a classic T-shirt and canvas shoes for a casual night out on the town.</p>', 'Polyester\r\nMachine-wash', 19.00, 0.00, '47217.jpg', '', 1, 0, 0, '2019-06-21 12:22:59', '2019-06-21 12:26:37'),
(11, 14, 'Men Green Running Shoes', 'ADIDAS', 'Rs.1999', 'Green', '<p><strong>PRODUCT DETAILS&nbsp;</strong></p>\r\n\r\n<p>A pair of green running sports shoes, has regular styling, lace-up detail<br />\r\nMesh upper<br />\r\nCushioned footbed<br />\r\nTextured and patterned outsole<br />\r\nWarranty: 3 months<br />\r\nWarranty provided by brand/manufacturer</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p><strong>Specifications</strong></p>\r\n\r\n<p>Sport: Running</p>\r\n\r\n<p>Material: Mesh</p>\r\n\r\n<p>Fastening: Lace-Ups</p>\r\n\r\n<p>Ankle Height: Regular</p>\r\n\r\n<p>Outsole Type: Marking</p>\r\n\r\n<p>Cleats: No Cleats</p>\r\n\r\n<p>Pronation for Running Shoes: Neutral</p>\r\n\r\n<p>Arch Type: Medium</p>\r\n\r\n<p>Cushioning: Medium</p>\r\n\r\n<p>Warranty: 3 months</p>\r\n\r\n<p>Surface Type: Court</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p><strong>Complete The Look</strong></p>\r\n\r\n<p>Treat your feet to these comfortable and super supportive sports shoes from ADIDAS. This green pair can be teamed with sports shorts and a casual tee when you&#39;re going to the gym with your friends.</p>', 'Mesh\r\nWipe with a clean, dry cloth to remove dust', 55.00, 0.00, '12682.jpg', '', 1, 0, 0, '2019-06-21 13:18:44', '2019-06-21 13:20:32'),
(12, 14, 'Men Black RIDE RUNNING Shoes', 'Reebok', 'Rs.1619', 'Black', '<p><strong>PRODUCT DETAILS&nbsp;</strong></p>\r\n\r\n<p><strong>Special Technology:</strong><br />\r\nPadded foam sockliner offers added comfort<br />\r\n<br />\r\n<strong>Design Details:</strong></p>\r\n\r\n<ol>\r\n	<li>Product Colour: Black</li>\r\n	<li>Mesh and synthetic upper construction</li>\r\n	<li>EVA midsole provides long-lasting cushioning</li>\r\n	<li>Non-Marking Rubber Outsole</li>\r\n	<li>Warranty: 3 months</li>\r\n	<li>Warranty provided by Brand/manufacturer</li>\r\n</ol>\r\n\r\n<p><strong>About Reebok&nbsp;RIDE RUNNER LP:</strong><br />\r\nFresh style comes to run this season in these breathable Reebok Ride Runner LP shoes for men built to fly in cushioned comfort. They have a combination of mono mesh and synthetic upper. EVA midsole provides long-lasting cushioning while the Non-Marking Rubber outsole adds on- and off-road durability and maximum traction and the Padded foam sockliner offers added comfort.</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p><strong>Specifications</strong></p>\r\n\r\n<p>Sport: Running</p>\r\n\r\n<p>Material: Mesh</p>\r\n\r\n<p>Fastening: Lace-Ups</p>\r\n\r\n<p>Ankle Height: Regular</p>\r\n\r\n<p>Outsole Type: Non-Marking</p>\r\n\r\n<p>Cleats: No Cleats</p>\r\n\r\n<p>Pronation for Running Shoes: Neutral</p>\r\n\r\n<p>Arch Type: Medium</p>\r\n\r\n<p>Cushioning: Medium</p>\r\n\r\n<p>Running Type: Road Running</p>\r\n\r\n<p>Warranty: 3 months</p>\r\n\r\n<p>Distance: Medium</p>\r\n\r\n<p>Surface Type: Hard</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p><strong>Complete The Look</strong></p>\r\n\r\n<p>Fresh style comes to run this season in these breathable Reebok Ride Runner LP shoes for men built to fly in cushioned comfort. They have a combination of mono mesh and synthetic upper. EVA midsole provides long-lasting cushioning</p>', 'Mesh\r\nTo clean just wipe off dirt with a wet cloth. Don\'t use detergents or solvents. Do not machine wash.', 45.00, 0.00, '66309.jpg', NULL, 1, 0, 0, '2019-06-21 13:26:15', '2019-06-21 13:26:15'),
(13, 14, 'Men MRUSHGY2 Grey Running Shoes', 'New Balance', 'Rs.9999', 'Grey', '<p><strong>PRODUCT DETAILS&nbsp;</strong></p>\r\n\r\n<p>A pair of grey running shoes, has regular styling detail<br />\r\nMesh upper<br />\r\nCushioned footbed<br />\r\nTextured and patterned outsole<br />\r\nWarranty: 3 months against manufacturing defects only<br />\r\nWarranty provided by Brand Owner / Manufacturer</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p><strong>Specifications</strong></p>\r\n\r\n<p>Sport: Running</p>\r\n\r\n<p>Material: Mesh</p>\r\n\r\n<p>Fastening: Lace-Ups</p>\r\n\r\n<p>Ankle Height: Regular</p>\r\n\r\n<p>Cleats: No Cleats</p>\r\n\r\n<p>Arch Type: Medium</p>\r\n\r\n<p>Cushioning: High</p>\r\n\r\n<p>Running Type: Road Running</p>\r\n\r\n<p>Warranty: 3 months</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p><strong>Complete The Look</strong></p>\r\n\r\n<p>You can be stylish when you&#39;re active with these on-trend sports shoes by New Balance. This grey pair can be teamed with sports shorts and a casual tee when you&#39;re going to the gym with your friends.</p>', 'Mesh \r\nWipe with a clean, dry cloth to remove dust', 35.00, 0.00, '5213.jpg', NULL, 1, 0, 0, '2019-06-21 13:42:11', '2019-06-21 13:42:11'),
(14, 14, 'Men Blue QUEST Running Shoes', 'Nike', 'Rs.3572', 'Blue', '<p><strong>PRODUCT DETAILS&nbsp;</strong></p>\r\n\r\n<p><strong>Special Technology</strong></p>\r\n\r\n<ul>\r\n	<li>The Nike Quest Men&#39;s Running Shoe wraps your foot in lightweight, breathable mesh, while Flywire cables give a secure fit.</li>\r\n	<li>The soft yet responsive foam feels supportive underfoot as you quicken your pace.</li>\r\n	<li>Flywire cables wrap your foot in lightweight support.</li>\r\n</ul>\r\n\r\n<p><strong>Design Details</strong></p>\r\n\r\n<ul>\r\n	<li>A pair of blue running sports shoes, has regular styling, lace-up detail</li>\r\n	<li>Mesh upper delivers targeted ventilation</li>\r\n	<li>Cushioned footbed</li>\r\n	<li>Textured and patterned outsole</li>\r\n	<li>Warranty: 6 months</li>\r\n	<li>Warranty provided by brand/manufacturer</li>\r\n</ul>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p><strong>Specifications</strong></p>\r\n\r\n<p>Sport: Running</p>\r\n\r\n<p>Material: Mesh</p>\r\n\r\n<p>Fastening: Lace-Ups</p>\r\n\r\n<p>Ankle Height: Regular</p>\r\n\r\n<p>Cleats: No Cleats</p>\r\n\r\n<p>Pronation for Running Shoes: Neutral</p>\r\n\r\n<p>Arch Type: Medium</p>\r\n\r\n<p>Cushioning: Medium</p>\r\n\r\n<p>Running Type: Road Running</p>\r\n\r\n<p>Warranty: 6 months</p>\r\n\r\n<p>Distance: Medium</p>\r\n\r\n<p>Surface Type: Hard</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p><strong>Complete The Look</strong></p>\r\n\r\n<p>You&#39;ll look and feel super stylish in these trendsetting sports shoes by Nike. Team this blue pair with track pants and a classic tee.</p>', 'Mesh\r\nWipe with a clean, dry cloth to remove dust', 30.00, 0.00, '51107.jpg', NULL, 1, 0, 0, '2019-06-21 13:50:09', '2019-06-21 13:50:09'),
(15, 14, 'Men Black Alphabounce RC 2 Running Shoes', 'ADIDAS', 'Rs.4399', 'Black', '<p><strong>PRODUCT DETAILS&nbsp;</strong></p>\r\n\r\n<p><strong>Special technologies</strong></p>\r\n\r\n<ol>\r\n	<li>Supportive Forgedmesh upper with Fitpanel overlay</li>\r\n	<li>Thin, breathable lining; Rubber outsole</li>\r\n	<li>Flexible Bounce midsole cushioning</li>\r\n	<li>Lightweight and breathable</li>\r\n</ol>\r\n\r\n<p><strong>Product design details</strong></p>\r\n\r\n<ol>\r\n	<li>Main materials: Mesh upper / Textile lining / Rubber outsole</li>\r\n	<li>Brand colour: Core black / ftwr white / carbon</li>\r\n	<li>Warranty: 3 months</li>\r\n	<li>Warranty provided by Brand Owner / Manufacturer</li>\r\n</ol>\r\n\r\n<p><strong>About ADIDAS Alphabounce RC 2 Running Shoes</strong><br />\r\nVersatile athletes can run or cross train in these neutral shoes. They have a seamless mesh upper that hugs the foot with a sock-like fit. Zones of support and stretch allow for multidirectional movement. Springy, responsive cushioning delivers long-lasting comfort.</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p><strong>Specifications</strong></p>\r\n\r\n<p>Sport: Running</p>\r\n\r\n<p>Material: Mesh</p>\r\n\r\n<p>Fastening: Lace-Ups</p>\r\n\r\n<p>Ankle Height: Regular</p>\r\n\r\n<p>Outsole Type: Marking</p>\r\n\r\n<p>Cleats: No Cleats</p>\r\n\r\n<p>Pronation for Running Shoes: Neutral</p>\r\n\r\n<p>Arch Type: Medium</p>\r\n\r\n<p>Cushioning: Medium</p>\r\n\r\n<p>Warranty: 3 months</p>\r\n\r\n<p>Surface Type: Court</p>\r\n\r\n<p>Technology: Bounce</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p><strong>Complete The Look</strong></p>\r\n\r\n<p>This pair of shoes from ADIDAS would be a perfect addition to your athleisure footwear collection. Match them up with a pair of breezy shorts and T-shirt to create a sporty look.</p>', 'Mesh\r\nWipe with a clean, dry cloth when needed', 60.00, 0.00, '20464.jpg', '', 1, 1, 0, '2019-06-21 13:55:13', '2019-06-22 11:52:10'),
(16, 15, 'Men Blue Vapour Slim Jeans', 'Pepe Jeans', 'Rs.1019', 'Blue', '<p><strong>PRODUCT DETAILS&nbsp;</strong></p>\r\n\r\n<p>Blue medium wash 5-pocket low-rise jeans, clean look with light fade, has a button and zip closure, waistband with belt loops</p>\r\n\r\n<p><strong>Size &amp; Fit</strong></p>\r\n\r\n<p>Slim fit<br />\r\nStretchable<br />\r\nThe model (height 6&#39;) is wearing a size 32</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p><strong>Specifications</strong></p>\r\n\r\n<p>Distress: Clean Look</p>\r\n\r\n<p>Waist Rise: Low-Rise</p>\r\n\r\n<p>Fade: Light Fade</p>\r\n\r\n<p>Shade: Dark</p>\r\n\r\n<p>Brand Fit Name: Vapour</p>\r\n\r\n<p>Fit: Slim Fit</p>\r\n\r\n<p>Length: Regular</p>\r\n\r\n<p>Waistband: With belt loops</p>\r\n\r\n<p>Stretch: Stretchable</p>\r\n\r\n<p>Closure: Button and Zip</p>\r\n\r\n<p>Reversible: No</p>\r\n\r\n<p>Number of Pockets: 5</p>\r\n\r\n<p>Occasion: Casual</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p><strong>Complete The Look</strong></p>\r\n\r\n<p>Discover the many benefits of these well-designed slim jeans from Pepe Jeans. Team them with a printed T-shirt and leather boots for a cool and casual weekend look.</p>', ' 98% cotton, 2% elastane\r\nMachine-wash', 30.00, 0.00, '3997.jpg', '', 1, 0, 0, '2019-06-21 15:00:37', '2019-06-21 15:02:49'),
(17, 15, 'Men Black Slim Tapered Jeans', 'HERENOW', 'Rs.799', 'Black', '<p><strong>PRODUCT DETAILS&nbsp;</strong></p>\r\n\r\n<p><a href=\"https://www.myntra.com/black?src=pd\">Black</a>&nbsp;dark wash 5-pocket mid-rise ankle-length&nbsp;<a href=\"https://www.myntra.com/jeans?src=pd\">jeans</a>, clean look with no fade, has a button and zip closure, waistband with belt loops</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p><strong>Size &amp; Fit</strong></p>\r\n\r\n<p>Slim tapered fit<br />\r\nStretchable<br />\r\nThe model (height 6&#39;) is wearing a size 32</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p><strong>Specifications</strong></p>\r\n\r\n<p>Distress: Clean Look</p>\r\n\r\n<p>Waist Rise: Mid-Rise</p>\r\n\r\n<p>Fade: No Fade</p>\r\n\r\n<p>Shade: Dark</p>\r\n\r\n<p>Fit: Slim Fit</p>\r\n\r\n<p>Length: Regular</p>\r\n\r\n<p>Waistband:&nbsp;With belt loops</p>\r\n\r\n<p>Stretch: Stretchable</p>\r\n\r\n<p>Closure: Button and Zip</p>\r\n\r\n<p>Reversible: No</p>\r\n\r\n<p>Number of Pockets: 5</p>\r\n\r\n<p>Occasion: Casual</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p><strong>Complete The Look</strong></p>\r\n\r\n<p>Upgrade your wardrobe with a pair of these trendsetting slim jeans by HERE&amp;NOW. When you have a low-key dinner date, wear yours with easy loafers and your favourite shirt.</p>', '98.5% cotton and 1.5% elastane \r\nMachine-wash', 23.00, 0.00, '28561.jpg', NULL, 1, 0, 0, '2019-06-22 09:09:51', '2019-06-22 09:09:51'),
(18, 15, 'Men Blue Slim Fit  Mid-Rise Clean Jeans', 'HIGHLANDER', 'Rs.519', 'Blue', '<p><strong>PRODUCT DETAILS&nbsp;</strong></p>\r\n\r\n<p>Blue light wash 5-pocket mid-rise jeans, clean look with no fade, has a button and zip closure, waistband with belt loops</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p><strong>Size &amp; Fit</strong></p>\r\n\r\n<p>Slim fit<br />\r\nStretchable<br />\r\nThe model (height 6&#39;) is wearing a size 32</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p><strong>Specifications</strong></p>\r\n\r\n<p>Distress: Clean Look</p>\r\n\r\n<p>Waist Rise: Mid-Rise</p>\r\n\r\n<p>Fade: No Fade</p>\r\n\r\n<p>Shade: Light</p>\r\n\r\n<p>Fit: Slim Fit</p>\r\n\r\n<p>Length: Regular</p>\r\n\r\n<p>Waistband: With belt loops</p>\r\n\r\n<p>Stretch: Stretchable</p>\r\n\r\n<p>Closure: Button and Zip</p>\r\n\r\n<p>Reversible: No</p>\r\n\r\n<p>Number of Pockets: 5</p>\r\n\r\n<p>Occasion: Casual</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p><strong>Complete The Look</strong></p>\r\n\r\n<p>Upgrade your wardrobe with a pair of these trendsetting slim jeans by HIGHLANDER. When you&#39;re hosting a dinner party, dress yours up with easy loafers and a trendy blazer.</p>', '97% Cotton 2.5% Polyester 0.5% Elastane\r\nMachine-wash', 20.00, 0.00, '3830.jpg', '', 1, 0, 0, '2019-06-22 09:15:49', '2019-06-22 09:29:22'),
(19, 15, 'Men Grey Slim Fit Mid-Rise Jeans', 'WROGN', 'Rs.1039', 'Grey', '<p><strong>PRODUCT DETAILS</strong>&nbsp;</p>\r\n\r\n<p>Grey light wash 5-pocket mid-rise jeans, clean look with heavy fade, has a button and zip closure, waistband with belt loops</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p><strong>Size &amp; Fit</strong></p>\r\n\r\n<p>Slim fit<br />\r\nStretchable<br />\r\nThe model (height 6&#39;) is wearing a size 32</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p><strong>Specifications</strong></p>\r\n\r\n<p>Distress: Clean Look</p>\r\n\r\n<p>Waist Rise: Mid-Rise</p>\r\n\r\n<p>Fade: Heavy Fade</p>\r\n\r\n<p>Shade: Light</p>\r\n\r\n<p>Fit: Slim Fit</p>\r\n\r\n<p>Length: Regular</p>\r\n\r\n<p>Waistband: With belt loops</p>\r\n\r\n<p>Stretch: Stretchable</p>\r\n\r\n<p>Closure: Button and Zip</p>\r\n\r\n<p>Reversible: No</p>\r\n\r\n<p>Number of Pockets: 5</p>\r\n\r\n<p>Occasion: Casual</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p><strong>Complete The Look</strong></p>\r\n\r\n<p>These slim jeans from WROGN will intensify your personal style statement. Style yours with sneakers and a light jacket when you need a casual outfit to run errands in.</p>', '98% cotton, 2% elastane\r\nMachine-wash', 15.00, 0.00, '87260.jpg', NULL, 1, 0, 0, '2019-06-22 09:21:18', '2019-06-22 09:21:18'),
(20, 15, 'Men Brown Straight Fit Mid-Rise Clean Look Jeans', 'FEVER', 'Rs.944', 'Brown', '<p><strong>PRODUCT DETAILS&nbsp;</strong></p>\r\n\r\n<p>Brown coloured wash 5-pocket mid-rise jeans, clean look with no fade, has a button and zip closure, waistband with belt loops</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p><strong>Size &amp; Fit</strong></p>\r\n\r\n<p>Straight Fit<br />\r\nThe model (height 6&#39;) is wearing a size 32</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p><strong>Specifications</strong></p>\r\n\r\n<p>Distress: Clean Look</p>\r\n\r\n<p>Waist Rise: Mid-Rise</p>\r\n\r\n<p>Fade: No Fade</p>\r\n\r\n<p>Shade: Coloured</p>\r\n\r\n<p>Fit: Straight Fit</p>\r\n\r\n<p>Length: Regular</p>\r\n\r\n<p>Waistband: With belt loops</p>\r\n\r\n<p>Stretch: Non Stretchable</p>\r\n\r\n<p>Closure: Button and Zip</p>\r\n\r\n<p>Reversible: No</p>\r\n\r\n<p>Number of Pockets: 5</p>\r\n\r\n<p>Occasion: Casual</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p><strong>Complete The Look</strong></p>\r\n\r\n<p>These stylish FEVER jeans offer a great fit, making it a must-have wardrobe essential. They can be styled with a printed T-shirt, a light jacket, and some Chelsea boots for a knockout date look.</p>', 'Cotton\r\nMachine-wash', 25.00, 0.00, '70080.jpg', NULL, 1, 0, 0, '2019-06-22 09:27:00', '2019-06-22 09:27:00'),
(21, 17, 'Women Green Printed Fit and Flare Dress', 'Tokyo Talkies', 'Rs.619', 'Green', '<p><strong>PRODUCT DETAILS&nbsp;</strong></p>\r\n\r\n<p>Green printed woven fit and flare dress, has a round neck, short sleeves,,, flared hem</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p><strong>Size &amp; Fit</strong></p>\r\n\r\n<p>Semi-Fit<br />\r\nThe model (height 5&#39;8&quot;) is wearing a size S</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p><strong>Specifications</strong></p>\r\n\r\n<p>Shape: Fit and Flare</p>\r\n\r\n<p>Neck: Round Neck</p>\r\n\r\n<p>Length: Above Knee</p>\r\n\r\n<p>Print or Pattern Type: Floral</p>\r\n\r\n<p>Sleeve Length: Short Sleeves</p>\r\n\r\n<p>Sleeve Styling: Regular Sleeves</p>\r\n\r\n<p>Occasion: Casual</p>\r\n\r\n<p>Knit or Woven: Woven</p>\r\n\r\n<p>Hemline: Flared</p>\r\n\r\n<p>Transparency: Opaque</p>\r\n\r\n<p>Surface Styling: Tie-Ups</p>\r\n\r\n<p>Main Trend: Floral</p>\r\n\r\n<p>Add-Ons: Comes with a belt</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p><strong>Complete The Look</strong></p>\r\n\r\n<p>Set the tone for this season with this one-of-a-kind Tokyo Talkies dress. The printed green piece can be matched with patent pumps and a pretty purse when you have a semi-formal event to attend.</p>', '100% polyester\r\nMachine-wash', 45.00, 0.00, '82456.jpg', '', 1, 1, 0, '2019-06-22 10:04:24', '2019-06-22 11:53:05'),
(22, 19, 'Women Blue Super Skinny Fit Mid-Rise Jeans', 'Tokyo Talkies', 'Rs.664', 'Blue', '<p><strong>PRODUCT DETAILS&nbsp;</strong></p>\r\n\r\n<p><a href=\"https://www.myntra.com/blue?src=pd\">Blue</a>&nbsp;<a href=\"https://www.myntra.com/medium?src=pd\">medium</a>&nbsp;wash 5-pocket mid-rise&nbsp;<a href=\"https://www.myntra.com/jeans?src=pd\">jeans</a>, clean look with light fade, has a button and zip closure, waistband with&nbsp;<a href=\"https://www.myntra.com/belt?src=pd\">belt</a>&nbsp;loops</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p><strong>Size &amp; Fit</strong></p>\r\n\r\n<p>Super Skinny Fit<br />\r\nStretchable<br />\r\nThe model (height 5&#39;8&quot;) is wearing a size 28</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p><strong>Specifications</strong></p>\r\n\r\n<p>Distress: Clean Look</p>\r\n\r\n<p>Waist Rise: Mid-Rise</p>\r\n\r\n<p>Fade: Light Fade</p>\r\n\r\n<p>Shade: Medium</p>\r\n\r\n<p>Fit: Super Skinny Fit</p>\r\n\r\n<p>Length: Regular</p>\r\n\r\n<p>Waistband: With belt loops</p>\r\n\r\n<p>Stretch: Stretchable</p>\r\n\r\n<p>Closure: Button and Zip</p>\r\n\r\n<p>Reversible: No</p>\r\n\r\n<p>Effects: Whiskers and Chevrons</p>\r\n\r\n<p>Number of Pockets: 5</p>\r\n\r\n<p>Occasion: Casual</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p><strong>Complete The Look</strong></p>\r\n\r\n<p>Take your style to the next level with these top-notch Tokyo Talkies skinny jeans. For a must-have party look, pair these with a chic tank top, patent pumps and a classic leather jacket.</p>', '98% cotton, 2% elastane\r\nMachine-wash', 30.00, 0.00, '73384.jpg', NULL, 1, 0, 0, '2019-06-22 10:14:15', '2019-06-22 10:14:15'),
(23, 20, 'Women Blue Self Design Regular Fit Denim Shorts', 'Levis', 'Rs.1749', 'Blue', '<p><strong>PRODUCT DETAILS&nbsp;</strong></p>\r\n\r\n<p>Blue self-design high-rise denim shorts, has five pockets, a button closure</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p><strong>Size &amp; Fit</strong></p>\r\n\r\n<p>Regular Fit<br />\r\nThe model (height 5&#39;8&quot;) is wearing a size 28</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p><strong>Specifications</strong></p>\r\n\r\n<p>Waist Rise: High-Rise</p>\r\n\r\n<p>Length: Above Knee</p>\r\n\r\n<p>Type: Denim Shorts</p>\r\n\r\n<p>Closure:&nbsp;Button</p>\r\n\r\n<p>Print or Pattern Type: Self Design</p>\r\n\r\n<p>Fit: Regular Fit</p>\r\n\r\n<p>Number of Pockets: 5</p>\r\n\r\n<p>Occasion: Casual</p>\r\n\r\n<p>Knit or Woven: Woven</p>\r\n\r\n<p>Main Trend: Indigo</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p><strong>Complete The Look</strong></p>\r\n\r\n<p>You&#39;ll love the comfort and style of these top-notch shorts made by Levis. Wear this blue pair with your favourite tee and canvas shoes when you&#39;re going to the movies with your friends.</p>', '99% cotton, 1% elastane\r\nMachine-wash', 20.00, 0.00, '86172.jpg', '', 1, 1, 0, '2019-06-22 10:27:21', '2019-06-22 11:52:53'),
(24, 21, 'Women Black Running Shoes', 'HRX by Hrithik Roshan', 'Rs.1319', 'Black', '<p><strong>PRODUCT DETAILS&nbsp;</strong></p>\r\n\r\n<p>A pair of black running sports shoes, has regular styling, lace-up detail<br />\r\nMesh upper<br />\r\nCushioned footbed<br />\r\nTextured and patterned outsole<br />\r\nWarranty: 3 months<br />\r\nWarranty provided by brand/manufacturer</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p><strong>Specifications</strong></p>\r\n\r\n<p>Sport: Running</p>\r\n\r\n<p>Material: Mesh</p>\r\n\r\n<p>Fastening: Lace-Ups</p>\r\n\r\n<p>Ankle Height: Regular</p>\r\n\r\n<p>Cleats: No Cleats</p>\r\n\r\n<p>Arch Type: Medium</p>\r\n\r\n<p>Cushioning: Medium</p>\r\n\r\n<p>Running Type: Road Running</p>\r\n\r\n<p>Warranty: 3 months</p>\r\n\r\n<p>Distance: Medium</p>\r\n\r\n<p>Surface Type: Outdoor</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p><strong>Complete The Look</strong></p>\r\n\r\n<p>Expand your athletic wardrobe with a brand new pair of comfy and trendy HRX by Hrithik Roshan running shoes. This black pair can be matched with athletic shorts and a basic tee when you&#39;re going to workout.</p>', 'Mesh\r\nWipe with a clean, dry cloth to remove dust', 65.00, 0.00, '27494.jpg', NULL, 1, 0, 0, '2019-06-22 10:35:19', '2019-06-22 10:35:19'),
(25, 18, 'Boys Yellow, White & Blue T-shirt', 'YK', 'Rs.389', 'Blue', '<p><strong>PRODUCT DETAILS&nbsp;</strong></p>\r\n\r\n<p>Yellow, white and blue colourblocked T-shirt, has a round neck, short sleeves</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p><strong>Specifications</strong></p>\r\n\r\n<p>Sleeve Styling: Regular Sleeves</p>\r\n\r\n<p>Multipack Set: Single</p>\r\n\r\n<p>Occasion: Casual</p>\r\n\r\n<p>Main Trend: Colourblocked</p>\r\n\r\n<p>Print or Pattern Type: Typography</p>\r\n\r\n<p>Neck: Round Neck</p>\r\n\r\n<p>Pattern: Colourblocked</p>\r\n\r\n<p>Sleeve Length: Short Sleeves</p>\r\n\r\n<p>Wash Care: Machine Wash</p>\r\n\r\n<p>Fit: Regular Fit</p>\r\n\r\n<p>Length: Regular</p>\r\n\r\n<p>Pattern Coverage: Chest</p>\r\n\r\n<p>Fabric: Cotton</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p><strong>Complete The Look</strong></p>\r\n\r\n<p>Your little explorer will love the ease of this versatile cotton YK T-shirt. When he&#39;s going to a picnic with friends, style this yellow T-shirt with dark denims and canvas shoes.</p>', 'Cotton\r\nMachine-wash', 10.00, 0.00, '17072.jpg', NULL, 1, 0, 0, '2019-06-22 11:21:30', '2019-06-22 11:21:30');

-- --------------------------------------------------------

--
-- Δομή πίνακα για τον πίνακα `products_attributes`
--

CREATE TABLE `products_attributes` (
  `id` int(10) UNSIGNED NOT NULL,
  `product_id` int(11) NOT NULL,
  `sku` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `size` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `price` double(8,2) NOT NULL,
  `stock` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Άδειασμα δεδομένων του πίνακα `products_attributes`
--

INSERT INTO `products_attributes` (`id`, `product_id`, `sku`, `size`, `price`, `stock`, `created_at`, `updated_at`) VALUES
(1, 2, 'Rs.524-S', 'SMALL', 25.00, 25, '2019-06-21 10:36:39', '2019-06-21 10:36:39'),
(2, 2, 'Rs.524-M', 'MEDIUM', 25.00, 24, '2019-06-21 10:36:39', '2019-06-23 11:49:58'),
(3, 2, 'Rs.524-L', 'LARGE', 25.00, 24, '2019-06-21 10:36:39', '2019-06-22 11:59:33'),
(4, 2, 'Rs.524-XL', 'XLARGE', 25.00, 25, '2019-06-21 10:36:39', '2019-06-21 10:36:39'),
(5, 3, 'Rs.849-S', 'SMALL', 40.00, 20, '2019-06-21 10:39:20', '2019-06-21 10:39:20'),
(6, 3, 'Rs.849-M', 'MEDIUM', 40.00, 20, '2019-06-21 10:39:20', '2019-06-21 10:39:20'),
(7, 3, 'Rs.849-L', 'LARGE', 40.00, 20, '2019-06-21 10:39:20', '2019-06-21 10:39:20'),
(9, 1, 'Rs.239-S', 'SMALL', 30.00, 15, '2019-06-21 10:43:02', '2019-06-21 10:43:02'),
(10, 1, 'Rs.239-M', 'MEDIUM', 30.00, 15, '2019-06-21 10:43:02', '2019-06-21 10:43:02'),
(11, 1, 'Rs.239-L', 'LARGE', 30.00, 14, '2019-06-21 10:43:02', '2019-06-23 12:05:27'),
(13, 4, 'Rs.399', 'SMALL', 15.00, 19, '2019-06-21 10:48:39', '2019-06-23 12:30:54'),
(14, 4, 'Rs.399-M', 'MEDIUM', 15.00, 20, '2019-06-21 10:48:39', '2019-06-21 10:48:39'),
(15, 4, 'Rs.399-L', 'LARGE', 15.00, 20, '2019-06-21 10:48:39', '2019-06-21 10:48:39'),
(17, 5, 'Rs.299-S', 'SMALL', 19.99, 30, '2019-06-21 10:56:02', '2019-06-21 10:56:02'),
(18, 5, 'Rs.299-M', 'MEDIUM', 19.99, 30, '2019-06-21 10:56:02', '2019-06-21 10:56:02'),
(19, 5, 'Rs.299-L', 'LARGE', 19.99, 30, '2019-06-21 10:56:02', '2019-06-21 10:56:02'),
(21, 5, 'Rs.299-XL', 'XLARGE', 19.99, 30, '2019-06-21 11:11:11', '2019-06-21 11:11:11'),
(22, 4, 'Rs.399-XL', 'XLARGE', 15.00, 19, '2019-06-21 11:12:15', '2019-06-23 09:31:50'),
(23, 3, 'Rs.849-XL', 'XLARGE', 40.00, 20, '2019-06-21 11:12:39', '2019-06-21 11:12:39'),
(24, 1, 'Rs.239-XL', 'XLARGE', 30.00, 15, '2019-06-21 11:14:13', '2019-06-21 11:14:13'),
(25, 6, 'Rs.849-32', '32', 25.00, 25, '2019-06-21 11:23:25', '2019-06-21 11:23:25'),
(26, 6, 'Rs.849-34', '34', 25.00, 25, '2019-06-21 11:23:25', '2019-06-21 11:23:25'),
(27, 6, 'Rs.849-36', '36', 25.00, 25, '2019-06-21 11:23:25', '2019-06-21 11:23:25'),
(28, 6, 'Rs.849-38', '38', 25.00, 25, '2019-06-21 11:23:25', '2019-06-21 11:23:25'),
(29, 7, 'Rs.649-32', '32', 16.50, 25, '2019-06-21 11:34:38', '2019-06-21 11:34:38'),
(30, 7, 'Rs.649-34', '34', 16.50, 25, '2019-06-21 11:34:38', '2019-06-21 11:34:38'),
(31, 7, 'Rs.649-36', '36', 16.50, 25, '2019-06-21 11:34:38', '2019-06-21 11:34:38'),
(32, 7, 'Rs.649-38', '38', 16.50, 25, '2019-06-21 11:34:38', '2019-06-21 11:34:38'),
(33, 8, 'Rs.1049-32', '32', 35.00, 35, '2019-06-21 12:06:55', '2019-06-21 12:06:55'),
(34, 8, 'Rs.1049-34', '34', 35.00, 35, '2019-06-21 12:06:55', '2019-06-21 12:06:55'),
(35, 8, 'Rs.1049-36', '36', 35.00, 35, '2019-06-21 12:06:55', '2019-06-21 12:06:55'),
(36, 8, 'Rs.1049-38', '38', 35.00, 35, '2019-06-21 12:06:56', '2019-06-21 12:06:56'),
(37, 9, 'Rs.679-32', '32', 10.00, 10, '2019-06-21 12:13:09', '2019-06-21 12:13:09'),
(38, 9, 'Rs.679-34', '34', 10.00, 10, '2019-06-21 12:13:10', '2019-06-21 12:13:10'),
(39, 9, 'Rs.679-36', '36', 10.00, 10, '2019-06-21 12:13:10', '2019-06-21 12:13:10'),
(40, 9, 'Rs.679-38', '38', 10.00, 10, '2019-06-21 12:13:10', '2019-06-21 12:13:10'),
(42, 10, 'Rs.479-32', '32', 19.00, 20, '2019-06-21 12:26:23', '2019-06-21 12:26:23'),
(43, 10, 'Rs.479-34', '34', 19.00, 20, '2019-06-21 12:26:24', '2019-06-21 12:26:24'),
(44, 10, 'Rs.479-36', '36', 19.00, 20, '2019-06-21 12:26:24', '2019-06-21 12:26:24'),
(45, 10, 'Rs.479-38', '38', 19.00, 20, '2019-06-21 12:26:24', '2019-06-21 12:26:24'),
(46, 11, 'Rs.1999-38', '38', 55.00, 25, '2019-06-21 13:20:19', '2019-06-21 13:20:19'),
(47, 11, 'Rs.1999-39', '39', 55.00, 25, '2019-06-21 13:20:19', '2019-06-21 13:20:19'),
(48, 11, 'Rs.1999-40', '40', 55.00, 25, '2019-06-21 13:20:19', '2019-06-21 13:20:19'),
(49, 11, 'Rs.1999-41', '41', 55.00, 25, '2019-06-21 13:20:19', '2019-06-21 13:20:19'),
(50, 12, 'Rs.1619-39', '39', 45.00, 30, '2019-06-21 13:29:14', '2019-06-21 13:29:14'),
(51, 12, 'Rs.1619-40', '40', 45.00, 30, '2019-06-21 13:29:14', '2019-06-21 13:29:14'),
(52, 12, 'Rs.1619-41', '41', 45.00, 30, '2019-06-21 13:29:14', '2019-06-21 13:29:14'),
(53, 12, 'Rs.1619-42', '42', 45.00, 30, '2019-06-21 13:29:14', '2019-06-21 13:29:14'),
(54, 13, 'Rs.9999-38', '38', 35.00, 35, '2019-06-21 13:43:15', '2019-06-21 13:43:15'),
(55, 13, 'Rs.9999-39', '39', 35.00, 35, '2019-06-21 13:43:16', '2019-06-21 13:43:16'),
(56, 13, 'Rs.9999-40', '40', 35.00, 35, '2019-06-21 13:43:16', '2019-06-21 13:43:16'),
(57, 13, 'Rs.9999-41', '41', 35.00, 35, '2019-06-21 13:43:16', '2019-06-21 13:43:16'),
(58, 14, 'Rs.3572-40', '40', 30.00, 20, '2019-06-21 13:51:30', '2019-06-21 13:51:30'),
(59, 14, 'Rs.3572-41', '41', 30.00, 20, '2019-06-21 13:51:30', '2019-06-21 13:51:30'),
(60, 14, 'Rs.3572-42', '42', 30.00, 20, '2019-06-21 13:51:30', '2019-06-21 13:51:30'),
(61, 14, 'Rs.3572-43', '43', 30.00, 20, '2019-06-21 13:51:30', '2019-06-21 13:51:30'),
(62, 15, 'Rs.4399-38', '38', 60.00, 35, '2019-06-21 13:56:12', '2019-06-21 13:56:12'),
(63, 15, 'Rs.4399-39', '39', 60.00, 35, '2019-06-21 13:56:12', '2019-06-21 13:56:12'),
(64, 15, 'Rs.4399-40', '40', 60.00, 34, '2019-06-21 13:56:12', '2019-06-23 09:31:50'),
(65, 15, 'Rs.4399-41', '41', 60.00, 35, '2019-06-21 13:56:12', '2019-06-21 13:56:12'),
(66, 16, 'Rs.1019-34', '34', 30.00, 40, '2019-06-21 15:03:31', '2019-06-21 15:03:31'),
(67, 16, 'Rs.1019-36', '36', 30.00, 40, '2019-06-21 15:03:31', '2019-06-21 15:03:31'),
(68, 16, 'Rs.1019-38', '38', 30.00, 40, '2019-06-21 15:03:31', '2019-06-21 15:03:31'),
(69, 16, 'Rs.1019-40', '40', 30.00, 39, '2019-06-21 15:03:31', '2019-06-23 12:40:28'),
(70, 17, 'Rs.799-30', '30', 23.00, 25, '2019-06-22 09:11:31', '2019-06-22 09:11:31'),
(71, 17, 'Rs.799-32', '32', 23.00, 25, '2019-06-22 09:11:31', '2019-06-22 09:11:31'),
(72, 17, 'Rs.799-34', '34', 23.00, 25, '2019-06-22 09:11:31', '2019-06-22 09:11:31'),
(73, 17, 'Rs.799-36', '36', 23.00, 25, '2019-06-22 09:11:31', '2019-06-22 09:11:31'),
(74, 18, 'Rs.519-30', '30', 20.00, 15, '2019-06-22 09:16:54', '2019-06-22 09:16:54'),
(75, 18, 'Rs.519-32', '32', 20.00, 15, '2019-06-22 09:16:54', '2019-06-22 09:16:54'),
(76, 18, 'Rs.519-34', '34', 20.00, 15, '2019-06-22 09:16:54', '2019-06-22 09:16:54'),
(77, 18, 'Rs.519-36', '36', 20.00, 15, '2019-06-22 09:16:54', '2019-06-22 09:16:54'),
(78, 19, 'Rs.1039-30', '30', 15.00, 30, '2019-06-22 09:22:34', '2019-06-22 09:22:34'),
(79, 19, 'Rs.1039-32', '32', 15.00, 30, '2019-06-22 09:22:35', '2019-06-22 09:22:35'),
(80, 19, 'Rs.1039-34', '34', 15.00, 30, '2019-06-22 09:22:35', '2019-06-22 09:22:35'),
(81, 19, 'Rs.1039-36', '36', 15.00, 30, '2019-06-22 09:22:35', '2019-06-22 09:22:35'),
(82, 20, 'Rs.944-34', '34', 25.00, 15, '2019-06-22 09:28:19', '2019-06-22 09:28:19'),
(83, 20, 'Rs.944-36', '36', 25.00, 15, '2019-06-22 09:28:19', '2019-06-22 09:28:19'),
(84, 20, 'Rs.944-38', '38', 25.00, 14, '2019-06-22 09:28:19', '2019-06-23 09:35:46'),
(85, 20, 'Rs.944-40', '40', 25.00, 15, '2019-06-22 09:28:19', '2019-06-22 09:28:19'),
(86, 21, 'Rs.619-S', 'SMALL', 45.00, 25, '2019-06-22 10:06:21', '2019-06-22 10:06:21'),
(87, 21, 'Rs.619-M', 'MEDIUM', 45.00, 25, '2019-06-22 10:06:21', '2019-06-22 10:06:21'),
(88, 21, 'Rs.619-L', 'LARGE', 45.00, 25, '2019-06-22 10:06:21', '2019-06-22 10:06:21'),
(89, 21, 'Rs.619-XL', 'XLARGE', 45.00, 25, '2019-06-22 10:06:21', '2019-06-22 10:06:21'),
(90, 22, 'Rs.664-26', '26', 30.00, 15, '2019-06-22 10:15:27', '2019-06-22 10:15:27'),
(91, 22, 'Rs.664-28', '28', 30.00, 15, '2019-06-22 10:15:27', '2019-06-22 10:15:27'),
(92, 22, 'Rs.664-30', '30', 30.00, 15, '2019-06-22 10:15:27', '2019-06-22 10:15:27'),
(93, 22, 'Rs.664-32', '32', 30.00, 15, '2019-06-22 10:15:27', '2019-06-22 10:15:27'),
(94, 23, 'Rs.1749-26', '26', 20.00, 20, '2019-06-22 10:28:23', '2019-06-22 10:28:23'),
(95, 23, 'Rs.1749-27', '27', 20.00, 20, '2019-06-22 10:28:23', '2019-06-22 10:28:23'),
(96, 23, 'Rs.1749-28', '28', 20.00, 20, '2019-06-22 10:28:23', '2019-06-22 10:28:23'),
(97, 23, 'Rs.1749-29', '29', 20.00, 20, '2019-06-22 10:28:23', '2019-06-22 10:28:23'),
(98, 24, 'Rs.1319-35', '35', 65.00, 30, '2019-06-22 10:37:02', '2019-06-22 10:37:02'),
(99, 24, 'Rs.1319-36', '36', 65.00, 30, '2019-06-22 10:37:02', '2019-06-22 10:37:02'),
(100, 24, 'Rs.1319-37', '37', 65.00, 30, '2019-06-22 10:37:02', '2019-06-22 10:37:02'),
(101, 24, 'Rs.1319-38', '38', 65.00, 28, '2019-06-22 10:37:02', '2019-06-23 10:50:16'),
(107, 25, 'Rs.389-3-4Y', '3-4Y', 10.00, 15, '2019-06-25 09:14:24', '2019-06-25 09:14:24'),
(108, 25, 'Rs.389-5-6Y', '5-6Y', 10.00, 15, '2019-06-25 09:14:24', '2019-06-25 09:14:24'),
(109, 25, 'Rs.389-7-8Y', '7-8Y', 10.00, 15, '2019-06-25 09:14:24', '2019-06-25 09:14:24');

-- --------------------------------------------------------

--
-- Δομή πίνακα για τον πίνακα `products_images`
--

CREATE TABLE `products_images` (
  `id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `image` varchar(255) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Άδειασμα δεδομένων του πίνακα `products_images`
--

INSERT INTO `products_images` (`id`, `product_id`, `image`, `created_at`, `updated_at`) VALUES
(1, 2, '66068.jpg', '2019-06-21 13:35:28', '2019-06-21 10:35:28'),
(2, 2, '39794.jpg', '2019-06-21 13:35:28', '2019-06-21 10:35:28'),
(3, 2, '52430.jpg', '2019-06-21 13:35:29', '2019-06-21 10:35:29'),
(4, 3, '17206.jpg', '2019-06-21 13:38:27', '2019-06-21 10:38:27'),
(5, 3, '40693.jpg', '2019-06-21 13:38:28', '2019-06-21 10:38:28'),
(6, 3, '27150.jpg', '2019-06-21 13:38:28', '2019-06-21 10:38:28'),
(7, 1, '51756.jpg', '2019-06-21 13:42:00', '2019-06-21 10:42:00'),
(8, 1, '76439.jpg', '2019-06-21 13:42:01', '2019-06-21 10:42:01'),
(9, 1, '80770.jpg', '2019-06-21 13:42:01', '2019-06-21 10:42:01'),
(10, 4, '75939.jpg', '2019-06-21 13:47:37', '2019-06-21 10:47:37'),
(11, 4, '32521.jpg', '2019-06-21 13:47:37', '2019-06-21 10:47:37'),
(12, 4, '61861.jpg', '2019-06-21 13:47:38', '2019-06-21 10:47:38'),
(13, 5, '86946.jpg', '2019-06-21 13:54:58', '2019-06-21 10:54:58'),
(14, 5, '78951.jpg', '2019-06-21 13:54:58', '2019-06-21 10:54:58'),
(15, 5, '67382.jpg', '2019-06-21 13:54:59', '2019-06-21 10:54:59'),
(16, 6, '31777.jpg', '2019-06-21 14:22:07', '2019-06-21 11:22:07'),
(17, 6, '12002.jpg', '2019-06-21 14:22:08', '2019-06-21 11:22:08'),
(18, 6, '52549.jpg', '2019-06-21 14:22:08', '2019-06-21 11:22:08'),
(19, 7, '26686.jpg', '2019-06-21 14:33:40', '2019-06-21 11:33:40'),
(20, 7, '90778.jpg', '2019-06-21 14:33:40', '2019-06-21 11:33:40'),
(21, 7, '95500.jpg', '2019-06-21 14:33:41', '2019-06-21 11:33:41'),
(24, 8, '63401.jpg', '2019-06-21 15:06:01', '2019-06-21 12:06:01'),
(25, 8, '28433.jpg', '2019-06-21 15:06:02', '2019-06-21 12:06:02'),
(26, 8, '98561.jpg', '2019-06-21 15:06:02', '2019-06-21 12:06:02'),
(27, 9, '18257.jpg', '2019-06-21 15:12:18', '2019-06-21 12:12:18'),
(28, 9, '78850.jpg', '2019-06-21 15:12:19', '2019-06-21 12:12:19'),
(29, 9, '45492.jpg', '2019-06-21 15:12:19', '2019-06-21 12:12:19'),
(30, 10, '32786.jpg', '2019-06-21 15:23:27', '2019-06-21 12:23:27'),
(31, 10, '92330.jpg', '2019-06-21 15:23:28', '2019-06-21 12:23:28'),
(32, 10, '82017.jpg', '2019-06-21 15:23:28', '2019-06-21 12:23:28'),
(33, 11, '15831.jpg', '2019-06-21 16:19:02', '2019-06-21 13:19:02'),
(34, 11, '7896.jpg', '2019-06-21 16:19:03', '2019-06-21 13:19:03'),
(35, 11, '21702.jpg', '2019-06-21 16:19:03', '2019-06-21 13:19:03'),
(36, 12, '80091.jpg', '2019-06-21 16:27:39', '2019-06-21 13:27:39'),
(37, 12, '82398.jpg', '2019-06-21 16:27:39', '2019-06-21 13:27:39'),
(38, 12, '63916.jpg', '2019-06-21 16:27:40', '2019-06-21 13:27:40'),
(39, 13, '45232.jpg', '2019-06-21 16:42:23', '2019-06-21 13:42:23'),
(40, 13, '58356.jpg', '2019-06-21 16:42:24', '2019-06-21 13:42:24'),
(41, 13, '26351.jpg', '2019-06-21 16:42:24', '2019-06-21 13:42:24'),
(42, 14, '25955.jpg', '2019-06-21 16:50:26', '2019-06-21 13:50:26'),
(43, 14, '85950.jpg', '2019-06-21 16:50:26', '2019-06-21 13:50:26'),
(44, 14, '43653.jpg', '2019-06-21 16:50:26', '2019-06-21 13:50:26'),
(45, 15, '38477.jpg', '2019-06-21 16:55:27', '2019-06-21 13:55:27'),
(46, 15, '83694.jpg', '2019-06-21 16:55:28', '2019-06-21 13:55:28'),
(47, 15, '3793.jpg', '2019-06-21 16:55:28', '2019-06-21 13:55:28'),
(48, 16, '85541.jpg', '2019-06-21 18:01:08', '2019-06-21 15:01:08'),
(49, 16, '33466.jpg', '2019-06-21 18:01:08', '2019-06-21 15:01:08'),
(50, 16, '55612.jpg', '2019-06-21 18:01:09', '2019-06-21 15:01:09'),
(51, 17, '6104.jpg', '2019-06-22 12:10:05', '2019-06-22 09:10:05'),
(52, 17, '94778.jpg', '2019-06-22 12:10:06', '2019-06-22 09:10:06'),
(53, 17, '81941.jpg', '2019-06-22 12:10:06', '2019-06-22 09:10:06'),
(54, 18, '60618.jpg', '2019-06-22 12:16:01', '2019-06-22 09:16:01'),
(55, 18, '88727.jpg', '2019-06-22 12:16:01', '2019-06-22 09:16:01'),
(56, 18, '60733.jpg', '2019-06-22 12:16:02', '2019-06-22 09:16:02'),
(57, 19, '89763.jpg', '2019-06-22 12:21:31', '2019-06-22 09:21:31'),
(58, 19, '92546.jpg', '2019-06-22 12:21:32', '2019-06-22 09:21:32'),
(59, 19, '32253.jpg', '2019-06-22 12:21:32', '2019-06-22 09:21:32'),
(60, 20, '56926.jpg', '2019-06-22 12:27:15', '2019-06-22 09:27:15'),
(61, 20, '90583.jpg', '2019-06-22 12:27:15', '2019-06-22 09:27:15'),
(62, 20, '74235.jpg', '2019-06-22 12:27:16', '2019-06-22 09:27:16'),
(63, 21, '71266.jpg', '2019-06-22 13:04:40', '2019-06-22 10:04:40'),
(64, 21, '5424.jpg', '2019-06-22 13:04:40', '2019-06-22 10:04:40'),
(65, 21, '31606.jpg', '2019-06-22 13:04:41', '2019-06-22 10:04:41'),
(66, 22, '80798.jpg', '2019-06-22 13:14:27', '2019-06-22 10:14:27'),
(67, 22, '97055.jpg', '2019-06-22 13:14:28', '2019-06-22 10:14:28'),
(68, 22, '50771.jpg', '2019-06-22 13:14:28', '2019-06-22 10:14:28'),
(69, 23, '71452.jpg', '2019-06-22 13:27:34', '2019-06-22 10:27:34'),
(70, 23, '42861.jpg', '2019-06-22 13:27:34', '2019-06-22 10:27:34'),
(71, 23, '90150.jpg', '2019-06-22 13:27:34', '2019-06-22 10:27:34'),
(72, 24, '75061.jpg', '2019-06-22 13:35:31', '2019-06-22 10:35:31'),
(73, 24, '86660.jpg', '2019-06-22 13:35:31', '2019-06-22 10:35:31'),
(74, 24, '19623.jpg', '2019-06-22 13:35:32', '2019-06-22 10:35:32'),
(75, 25, '73875.jpg', '2019-06-22 14:21:46', '2019-06-22 11:21:46'),
(76, 25, '52613.jpg', '2019-06-22 14:21:46', '2019-06-22 11:21:46'),
(77, 25, '93330.jpg', '2019-06-22 14:21:47', '2019-06-22 11:21:47'),
(78, 26, '99294.jpg', '2020-07-29 16:53:07', '2020-07-29 13:53:07'),
(79, 26, '54027.jpg', '2020-07-29 16:53:08', '2020-07-29 13:53:08'),
(80, 26, '77986.jpg', '2020-07-29 16:53:09', '2020-07-29 13:53:09');

-- --------------------------------------------------------

--
-- Δομή πίνακα για τον πίνακα `reviews`
--

CREATE TABLE `reviews` (
  `id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `comment` text NOT NULL,
  `rating` int(11) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Άδειασμα δεδομένων του πίνακα `reviews`
--

INSERT INTO `reviews` (`id`, `product_id`, `user_id`, `comment`, `rating`, `created_at`, `updated_at`) VALUES
(1, 5, 17, 'nice t-shirt just buy it!!!', 5, '2019-06-22 14:35:39', '2019-06-22 14:45:48'),
(2, 1, 18, 'not bad :D', 3, '2019-06-26 12:55:21', '2019-06-26 13:05:09'),
(3, 1, 17, 'wp', 5, '2019-06-26 13:11:13', '2019-06-26 13:12:03');

-- --------------------------------------------------------

--
-- Δομή πίνακα για τον πίνακα `users`
--

CREATE TABLE `users` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `gender` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `address` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `city` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `state` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `country` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `pincode` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `mobile` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 0,
  `banned` tinyint(1) DEFAULT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Άδειασμα δεδομένων του πίνακα `users`
--

INSERT INTO `users` (`id`, `name`, `last_name`, `gender`, `address`, `city`, `state`, `country`, `pincode`, `mobile`, `email`, `password`, `status`, `banned`, `image`, `remember_token`, `created_at`, `updated_at`) VALUES
(17, 'george', 'gkagklo', 'Male', 'elmazi 1', 'thessaloniki', 'ampelokipi', 'Greece', '56123', '6981472586', 'deathbreakerxx@hotmail.com', '$2y$10$/9NxK3Gr7mOHTpall0aEyOGbR/l2y6J6GRE2GFG.bI3.qHjvsPPH6', 1, 0, '56005.png', 'Rxs26Elomxm6GDUXAntd1fHGZMcR0chLhKEoASi7zZZC39DMr3d3caoOgEiw', '2019-06-20 19:03:05', '2020-04-17 19:14:05'),
(18, 'leonidas', 'serasis', 'Male', 'peran 12', 'thessaloniki', 'ampelokipi', 'Greece', '56121', '6981236549', 'geogkagkloidis@hotmail.com', '$2y$10$hCLpJqxJpCsH2qZ43yj5leQK5fZj4kiaRGtl4vjAkpYntMSgq3wxG', 1, 0, '62081.png', 'Nzjm1oQYG7DMTGndjDRnCLdPPLyV9VPh5vk869aSajnjZFix4YI5oK8T0OBb', '2019-06-22 12:04:38', '2019-06-24 09:33:47');

-- --------------------------------------------------------

--
-- Δομή πίνακα για τον πίνακα `wishlist`
--

CREATE TABLE `wishlist` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `pro_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Άδειασμα δεδομένων του πίνακα `wishlist`
--

INSERT INTO `wishlist` (`id`, `user_id`, `pro_id`, `created_at`, `updated_at`) VALUES
(1, 18, 10, '2020-12-29 13:24:15', '2020-12-29 13:24:15');

--
-- Ευρετήρια για άχρηστους πίνακες
--

--
-- Ευρετήρια για πίνακα `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`id`);

--
-- Ευρετήρια για πίνακα `banners`
--
ALTER TABLE `banners`
  ADD PRIMARY KEY (`id`);

--
-- Ευρετήρια για πίνακα `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`id`);

--
-- Ευρετήρια για πίνακα `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Ευρετήρια για πίνακα `cms_pages`
--
ALTER TABLE `cms_pages`
  ADD PRIMARY KEY (`id`);

--
-- Ευρετήρια για πίνακα `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`id`);

--
-- Ευρετήρια για πίνακα `countries`
--
ALTER TABLE `countries`
  ADD PRIMARY KEY (`id`);

--
-- Ευρετήρια για πίνακα `coupons`
--
ALTER TABLE `coupons`
  ADD PRIMARY KEY (`id`);

--
-- Ευρετήρια για πίνακα `delivery_addresses`
--
ALTER TABLE `delivery_addresses`
  ADD PRIMARY KEY (`id`);

--
-- Ευρετήρια για πίνακα `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Ευρετήρια για πίνακα `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`);

--
-- Ευρετήρια για πίνακα `orders_products`
--
ALTER TABLE `orders_products`
  ADD PRIMARY KEY (`id`);

--
-- Ευρετήρια για πίνακα `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Ευρετήρια για πίνακα `popular_products`
--
ALTER TABLE `popular_products`
  ADD PRIMARY KEY (`id`);

--
-- Ευρετήρια για πίνακα `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`id`);

--
-- Ευρετήρια για πίνακα `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- Ευρετήρια για πίνακα `products_attributes`
--
ALTER TABLE `products_attributes`
  ADD PRIMARY KEY (`id`);

--
-- Ευρετήρια για πίνακα `products_images`
--
ALTER TABLE `products_images`
  ADD PRIMARY KEY (`id`);

--
-- Ευρετήρια για πίνακα `reviews`
--
ALTER TABLE `reviews`
  ADD PRIMARY KEY (`id`);

--
-- Ευρετήρια για πίνακα `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- Ευρετήρια για πίνακα `wishlist`
--
ALTER TABLE `wishlist`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT για άχρηστους πίνακες
--

--
-- AUTO_INCREMENT για πίνακα `admins`
--
ALTER TABLE `admins`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT για πίνακα `banners`
--
ALTER TABLE `banners`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT για πίνακα `cart`
--
ALTER TABLE `cart`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT για πίνακα `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT για πίνακα `cms_pages`
--
ALTER TABLE `cms_pages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT για πίνακα `comments`
--
ALTER TABLE `comments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT για πίνακα `countries`
--
ALTER TABLE `countries`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=247;

--
-- AUTO_INCREMENT για πίνακα `coupons`
--
ALTER TABLE `coupons`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT για πίνακα `delivery_addresses`
--
ALTER TABLE `delivery_addresses`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT για πίνακα `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT για πίνακα `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT για πίνακα `orders_products`
--
ALTER TABLE `orders_products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT για πίνακα `popular_products`
--
ALTER TABLE `popular_products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=132;

--
-- AUTO_INCREMENT για πίνακα `posts`
--
ALTER TABLE `posts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT για πίνακα `products`
--
ALTER TABLE `products`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT για πίνακα `products_attributes`
--
ALTER TABLE `products_attributes`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=110;

--
-- AUTO_INCREMENT για πίνακα `products_images`
--
ALTER TABLE `products_images`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=81;

--
-- AUTO_INCREMENT για πίνακα `reviews`
--
ALTER TABLE `reviews`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT για πίνακα `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT για πίνακα `wishlist`
--
ALTER TABLE `wishlist`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
