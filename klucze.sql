-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: mysql1.small.pl
-- Generation Time: Mar 04, 2024 at 05:52 PM
-- Wersja serwera: 8.0.35
-- Wersja PHP: 7.3.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `m1475_klucze`
--

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `archiwum`
--

CREATE TABLE `archiwum` (
  `archiwum_id` int NOT NULL,
  `opis` text CHARACTER SET utf8mb3 COLLATE utf8mb3_polish_ci NOT NULL,
  `data` datetime DEFAULT NULL,
  `uzytkownik_id` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_polish_ci;

--
-- Dumping data for table `archiwum`
--

INSERT INTO `archiwum` (`archiwum_id`, `opis`, `data`, `uzytkownik_id`) VALUES
(38, 'Usunięto ucznia: Imie Nazwisko z klasy 1KLASA', '2023-01-01 12:00:00', 1),
(101, 'Pomyślnie zmieniono hasło.', '2024-02-14 12:47:16', 3);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `ip`
--

CREATE TABLE `ip` (
  `adres` char(16) CHARACTER SET utf8mb3 COLLATE utf8mb3_bin NOT NULL,
  `czas` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_bin;

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `klasa`
--

CREATE TABLE `klasa` (
  `klasa_id` int NOT NULL,
  `nazwa` text CHARACTER SET utf8mb3 COLLATE utf8mb3_polish_ci NOT NULL,
  `skrot` text CHARACTER SET utf8mb3 COLLATE utf8mb3_polish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_polish_ci;

--
-- Dumping data for table `klasa`
--

INSERT INTO `klasa` (`klasa_id`, `nazwa`, `skrot`) VALUES
(1, '1 Technik Programista', '1TP');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `lokalizacja`
--

CREATE TABLE `lokalizacja` (
  `lokalizacja_id` int NOT NULL,
  `pozycja` text CHARACTER SET utf8mb3 COLLATE utf8mb3_polish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_polish_ci;

--
-- Dumping data for table `lokalizacja`
--

INSERT INTO `lokalizacja` (`lokalizacja_id`, `pozycja`) VALUES
(2, 'warsztaty'),
(3, 'szatnia'),
(4, 'hala');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `sesja`
--

CREATE TABLE `sesja` (
  `sesja_id` int NOT NULL,
  `klucz` text CHARACTER SET utf8mb3 COLLATE utf8mb3_polish_ci NOT NULL,
  `szyfr` text CHARACTER SET utf8mb3 COLLATE utf8mb3_polish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_polish_ci;

--
-- Dumping data for table `sesja`
--

INSERT INTO `sesja` (`sesja_id`, `klucz`, `szyfr`) VALUES
(1, 'englishHardTalkToBe', 'C7478917688AC45D8F6CC0F7189B193A1712AAFDA78648C8B7C7D06767A244EC');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `status`
--

CREATE TABLE `status` (
  `status_id` int NOT NULL,
  `wartosc` text CHARACTER SET utf8mb3 COLLATE utf8mb3_polish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_polish_ci;

--
-- Dumping data for table `status`
--

INSERT INTO `status` (`status_id`, `wartosc`) VALUES
(1, 'zgubiony'),
(2, 'zniszczony'),
(3, 'do wymiany zamka'),
(4, 'do dorobienia kluczy');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `szafka`
--

CREATE TABLE `szafka` (
  `szafka_id` int NOT NULL,
  `kod` text CHARACTER SET utf8mb3 COLLATE utf8mb3_polish_ci NOT NULL,
  `ilosc_kluczy` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_polish_ci;

--
-- Dumping data for table `szafka`
--

INSERT INTO `szafka` (`szafka_id`, `kod`, `ilosc_kluczy`) VALUES
(1, '1', 3),
(2, '2', 2),
(3, '3', 2),
(4, '4', 2),
(5, '5', 3),
(6, '6', 2),
(7, '7', 2),
(8, '8', 2),
(9, '9', 2),
(10, '10', 2),
(11, '11', 2),
(12, '12', 2),
(13, '13', 2),
(14, '14', 2),
(15, '15', 2),
(16, '16', 2),
(17, '17', 2),
(18, '18', 2),
(19, '19', 2),
(20, '20', 2),
(21, '21', 2),
(22, '22', 2),
(23, '23', 2),
(24, '24', 2),
(25, '25', 2),
(26, '26', 2),
(27, '27', 2),
(28, '28', 2),
(29, '29', 2),
(30, '30', 2),
(31, '31', 2),
(32, '32', 2),
(33, '33', 2),
(34, '34', 2),
(35, '35', 2),
(36, '36', 2),
(37, '37', 2),
(38, '38', 2),
(39, '39', 2),
(40, '40', 2),
(41, '41', 2),
(42, '42', 2),
(43, '43', 2),
(44, '44', 2),
(45, '45', 2),
(46, '46', 2),
(47, '47', 2),
(48, '48', 2),
(49, '49', 2),
(50, '50', 2),
(51, '51', 2),
(52, '52', 2),
(53, '53', 2),
(54, '54', 3),
(55, '55', 2),
(56, '56', 2),
(57, '57', 2),
(58, '58', 2),
(59, '59', 2),
(60, '60', 2),
(61, '61', 2),
(62, '62', 2),
(63, '63', 2),
(64, '64', 2),
(65, '65', 2),
(66, '66', 3),
(67, '67', 2),
(68, '68', 2),
(69, '69', 2),
(70, '70', 2),
(71, '71', 2),
(72, '72', 3),
(73, '73', 2),
(74, '74', 2),
(75, '75', 2),
(76, '76', 2),
(77, '77', 2),
(78, '78', 2),
(79, '79', 2),
(80, '80', 2),
(81, '81', 3),
(82, '82', 2),
(83, '83', 2),
(84, '84', 2),
(85, '85', 2),
(86, '86', 2),
(87, '87', 2),
(88, '88', 2),
(89, '89', 2),
(90, '90', 2),
(91, '91', 2),
(92, '92', 2),
(93, '93', 2),
(94, '94', 2),
(95, '95', 2),
(96, '96', 2),
(97, '97', 2),
(98, '98', 2),
(99, '99', 2),
(100, '100', 2),
(101, '101', 2),
(102, '102', 2),
(103, '103', 2),
(104, '104', 2),
(105, '105', 2),
(106, '106', 2),
(107, '107', 2),
(108, '108', 2),
(109, '199', 2),
(110, '200', 2),
(111, '201', 2),
(112, '202', 2),
(113, '203', 2),
(114, '204', 2),
(115, '205', 2),
(116, '206', 2),
(117, '207', 2),
(118, '208', 2),
(119, '209', 2),
(120, '210', 2),
(121, '211', 2),
(122, '212', 2),
(123, '213', 3),
(124, '214', 2),
(125, '215', 3),
(126, '216', 2),
(127, '217', 2),
(128, '218', 2),
(129, '219', 2),
(130, '220', 2),
(131, '221', 2),
(132, '222', 2),
(133, '223', 2),
(134, '224', 2),
(135, '225', 2),
(136, '226', 2),
(137, '227', 2),
(138, '228', 2),
(139, '229', 2),
(140, '230', 2),
(141, '231', 2),
(142, '232', 2),
(143, '233', 2),
(144, '234', 2),
(145, '1A', 2),
(146, '1B', 2),
(147, '1C', 2),
(148, '1D', 2),
(149, '2A', 2),
(150, '2B', 2),
(151, '2C', 2),
(152, '2D', 2),
(153, '3A', 2),
(154, '3B', 2),
(155, '3C', 2),
(156, '3D', 2),
(157, '4A', 2),
(158, '4B', 2),
(159, '4C', 2),
(160, '4D', 2),
(161, '5A', 3),
(162, '5B', 2),
(163, '5C', 2),
(164, '5D', 2),
(165, '6A', 2),
(166, '6B', 2),
(167, '6C', 2),
(168, '6D', 3),
(169, '7A', 2),
(170, '7B', 2),
(171, '7C', 2),
(172, '7D', 2),
(173, '8A', 2),
(174, '8B', 2),
(175, '8C', 3),
(176, '8D', 2),
(177, '9A', 2),
(178, '9B', 2),
(179, '9C', 2),
(180, '9D', 2),
(181, '10A', 2),
(182, '10B', 2),
(183, '10C', 2),
(184, '10D', 2),
(185, '11A', 2),
(186, '11B', 2),
(187, '11C', 2),
(188, '11D', 2),
(189, '12A', 4),
(190, '12B', 2),
(191, '12C', 2),
(192, '12D', 4),
(193, '13A', 2),
(194, '13B', 2),
(195, '13C', 2),
(196, '13D', 2),
(197, '14A', 2),
(198, '14B', 2),
(199, '14C', 2),
(200, '14D', 2),
(201, '15A', 2),
(202, '15B', 2),
(203, '15C', 2),
(204, '15D', 2),
(205, '16A', 2),
(206, '16B', 2),
(207, '16C', 2),
(208, '16D', 2),
(209, '17A', 2),
(210, '17B', 2),
(211, '17C', 2),
(212, '17D', 2),
(213, '18A', 2),
(214, '18B', 2),
(215, '18C', 2),
(216, '18D', 2),
(217, '19A', 2),
(218, '19B', 2),
(219, '19C', 2),
(220, '19D', 2),
(221, '20A', 2),
(222, '20B', 2),
(223, '20C', 2),
(224, '20D', 2),
(225, '21A', 2),
(226, '21B', 3),
(227, '21C', 2),
(228, '21D', 2),
(229, '22A', 2),
(230, '22B', 2),
(231, '22C', 3),
(232, '22D', 2),
(233, '23A', 2),
(234, '23B', 2),
(235, '23C', 2),
(236, '23D', 2),
(237, '24A', 3),
(238, '24B', 2),
(239, '24C', 2),
(240, '24D', 2),
(241, '25A', 2),
(242, '25B', 2),
(243, '25C', 3),
(244, '25D', 2),
(245, '26A', 2),
(246, '26B', 2),
(247, '26C', 2),
(248, '26D', 3),
(249, '27A', 2),
(250, '27B', 2),
(251, '27C', 2),
(252, '27D', 2),
(253, '28A', 2),
(254, '28B', 2),
(255, '28C', 2),
(256, '28D', 2),
(257, '29A', 4),
(258, '29B', 2),
(259, '29C', 2),
(260, '29D', 2),
(261, '30A', 4),
(262, '30B', 2),
(263, '30C', 3),
(264, '30D', 2),
(265, '31A', 2),
(266, '31B', 2),
(267, '31C', 2),
(268, '31D', 2),
(269, '32A', 3),
(270, '32B', 3),
(271, '32C', 2),
(272, '32D', 2),
(273, '33A', 2),
(274, '33B', 2),
(275, '33C', 2),
(276, '33D', 2),
(277, '34A', 2),
(278, '34B', 2),
(279, '34C', 2),
(280, '34D', 2),
(281, '35A', 2),
(282, '35B', 2),
(283, '35C', 2),
(284, '35D', 2),
(285, '36A', 2),
(286, '36B', 2),
(287, '36C', 2),
(288, '36D', 2),
(289, '37A', 2),
(290, '37B', 2),
(291, '37C', 2),
(292, '37D', 2),
(293, '38A', 2),
(294, '38B', 2),
(295, '38C', 2),
(296, '38D', 2),
(297, '39A', 2),
(298, '39B', 2),
(299, '39C', 2),
(300, '39D', 3),
(301, '40A', 2),
(302, '40B', 2),
(303, '40C', 2),
(304, '40D', 2),
(305, '41A', 2),
(306, '41B', 2),
(307, '41C', 2),
(308, '41D', 2),
(309, '42A', 2),
(310, '42B', 2),
(311, '42C', 2),
(312, '42D', 3),
(313, '43A', 2),
(314, '43B', 2),
(315, '43C', 2),
(316, '43D', 2),
(317, '44A', 2),
(318, '44B', 3),
(319, '44C', 2),
(320, '44D', 2),
(321, '45A', 2),
(322, '45B', 2),
(323, '45C', 3),
(324, '45D', 2),
(325, '46A', 2),
(326, '46B', 2),
(327, '46C', 2),
(328, '46D', 2),
(329, '47A', 2),
(330, '47B', 2),
(331, '47C', 2),
(332, '47D', 2),
(333, '48A', 2),
(334, '48B', 2),
(335, '48C', 2),
(336, '48D', 2),
(337, '49A', 2),
(338, '49B', 2),
(339, '49C', 2),
(340, '49D', 2),
(341, '50A', 2),
(342, '50B', 2),
(343, '50C', 2),
(344, '50D', 2),
(345, '51A', 2),
(346, '51B', 2),
(347, '51C', 2),
(348, '51D', 2),
(349, '52A', 2),
(350, '52B', 2),
(351, '52C', 2),
(352, '52D', 2),
(353, '53A', 2),
(354, '53B', 2),
(355, '53C', 2),
(356, '53D', 2),
(357, '54A', 2),
(358, '54B', 2),
(359, '54C', 2),
(360, '54D', 2),
(361, '55A', 2),
(362, '55B', 2),
(363, '55C', 2),
(364, '55D', 2),
(365, '56A', 2),
(366, '56B', 2),
(367, '56C', 2),
(368, '56D', 2),
(369, '57A', 2),
(370, '57B', 2),
(371, '57C', 2),
(372, '57D', 2),
(373, '58A', 2),
(374, '58B', 2),
(375, '58C', 2),
(376, '58D', 2),
(377, '59A', 2),
(378, '59B', 2),
(379, '59C', 2),
(380, '59D', 2),
(381, '60A', 2),
(382, '60B', 2),
(383, '60C', 2),
(384, '60D', 2),
(385, '61A', 2),
(386, '61B', 2),
(387, '61C', 3),
(388, '61D', 2),
(389, '62A', 2),
(390, '62B', 2),
(391, '62C', 2),
(392, '62D', 2),
(393, '63A', 2),
(394, '63B', 2),
(395, '63C', 2),
(396, '63D', 2),
(397, '64A', 2),
(398, '64B', 2),
(399, '64C', 2),
(400, '64D', 3),
(401, '65A', 2),
(402, '65B', 2),
(403, '65C', 2),
(404, '65D', 2),
(405, '66A', 2),
(406, '66B', 2),
(407, '66C', 2),
(408, '66D', 2),
(409, '67A', 2),
(410, '67B', 2),
(411, '67C', 2),
(412, '67D', 2),
(413, '68A', 2),
(414, '68B', 2),
(415, '68C', 2),
(416, '68D', 2),
(417, '69A', 2),
(418, '69B', 2),
(419, '69C', 2),
(420, '69D', 2),
(421, '70A', 2),
(422, '70B', 2),
(423, '70C', 2),
(424, '70D', 2),
(425, '71A', 2),
(426, '71B', 2),
(427, '71C', 2),
(428, '71D', 2),
(429, '72A', 3),
(430, '72B', 2),
(431, '72C', 2),
(432, '72D', 2),
(433, '73A', 2),
(434, '73B', 2),
(435, '73C', 2),
(436, '73D', 2),
(437, '74A', 2),
(438, '74B', 2),
(439, '74C', 2),
(440, '74D', 2),
(441, '75A', 2),
(442, '75B', 2),
(443, '75C', 2),
(444, '75D', 2),
(445, '76A', 2),
(446, '76B', 2),
(447, '76C', 2),
(448, '76D', 2),
(449, '77A', 2),
(450, '77B', 2),
(451, '77C', 2),
(452, '77D', 2),
(453, '78A', 2),
(454, '78B', 2),
(455, '78C', 2),
(456, '78D', 2),
(457, '79A', 2),
(458, '79B', 2),
(459, '79C', 2),
(460, '79D', 2),
(461, '80A', 2),
(462, '80B', 3),
(463, '80C', 2),
(464, '80D', 2),
(465, '81A', 2),
(466, '81B', 2),
(467, '81C', 3),
(468, '81D', 2),
(469, '82A', 2),
(470, '82B', 2),
(471, '82C', 2),
(472, '82D', 2),
(473, '83A', 2),
(474, '83B', 2),
(475, '83C', 2),
(476, '83D', 2),
(477, '84A', 3),
(478, '84B', 2),
(479, '84C', 2),
(480, '84D', 2),
(481, '85A', 2),
(482, '85B', 2),
(483, '85C', 2),
(484, '85D', 2),
(485, '86A', 2),
(486, '86B', 2),
(487, '86C', 2),
(488, '86D', 2),
(489, '87A', 2),
(490, '87B', 2),
(491, '87C', 2),
(492, '87D', 2),
(493, '88A', 2),
(494, '88B', 2),
(495, '88C', 2),
(496, '88D', 2),
(497, '89A', 2),
(498, '89B', 2),
(499, '89C', 2),
(500, '89D', 2),
(501, '90A', 2),
(502, '90B', 2),
(503, '90C', 2),
(504, '90D', 2),
(505, '91A', 2),
(506, '91B', 2),
(507, '91C', 2),
(508, '91D', 2),
(509, '92A', 2),
(510, '92B', 2),
(511, '92C', 3),
(512, '92D', 3),
(513, '93A', 2),
(514, '93B', 2),
(515, '93C', 2),
(516, '93D', 2),
(517, '94A', 2),
(518, '94B', 2),
(519, '94C', 2),
(520, '94D', 2),
(521, '95A', 2),
(522, '95B', 2),
(523, '95C', 2),
(524, '95D', 2),
(525, '96A', 2),
(526, '96B', 2),
(527, '96C', 0),
(528, '96D', 3),
(529, '97A', 2),
(530, '97B', 2),
(531, '97C', 2),
(532, '97D', 2),
(533, '109', 2),
(534, '110', 2),
(535, '111', 2),
(536, '112', 2),
(537, '113', 2),
(538, '114', 2),
(539, '115', 2),
(540, '116', 2),
(541, '117', 2),
(542, '118', 2),
(543, '119', 2),
(544, '120', 2),
(545, '121', 2),
(546, '122', 2),
(547, '123', 2),
(548, '124', 2),
(549, '125', 2),
(550, '126', 2),
(551, '127', 2),
(552, '128', 2),
(553, '129', 2),
(554, '130', 2),
(555, '131', 2),
(556, '132', 2),
(557, '133', 3),
(558, '134', 2),
(559, '135', 2),
(560, '136', 2),
(561, '137', 2),
(562, '138', 2),
(563, '139', 2),
(564, '140', 2),
(565, '141', 2),
(566, '142', 2),
(567, '143', 2),
(568, '144', 4),
(569, '145', 2),
(570, '146', 2),
(571, '147', 2),
(572, '148', 2),
(573, '149', 2),
(574, '150', 2),
(575, '151', 2),
(576, '152', 2),
(577, '153', 2),
(578, '154', 2),
(579, '155', 2),
(580, '156', 2),
(581, '157', 2),
(582, '158', 2),
(583, '159', 2),
(584, '160', 2),
(585, '161', 2),
(586, '162', 2),
(587, '163', 2),
(588, '164', 2),
(589, '165', 2),
(590, '166', 2),
(591, '167', 2),
(592, '168', 2),
(593, '169', 2),
(594, '170', 2),
(595, '171', 2),
(596, '172', 2),
(597, '173', 2),
(598, '174', 2),
(599, '175', 2),
(600, '176', 2),
(601, '177', 2),
(602, '178', 2),
(603, '179', 2),
(604, '180', 2),
(605, '181', 2),
(606, '182', 2),
(607, '183', 2),
(608, '184', 2),
(609, '185', 2),
(610, '186', 2),
(611, '187', 2),
(612, '188', 2),
(613, '189', 2),
(614, '190', 2),
(615, '191', 2),
(616, '192', 2),
(617, '193', 2),
(618, '194', 2),
(619, '195', 2),
(620, '196', 2),
(621, '197', 2),
(622, '198', 2);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `szafka_lokalizacja`
--

CREATE TABLE `szafka_lokalizacja` (
  `szafka_lokalizacja_id` int NOT NULL,
  `szafka_id` int NOT NULL,
  `lokalizacja_id` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_polish_ci;

--
-- Dumping data for table `szafka_lokalizacja`
--

INSERT INTO `szafka_lokalizacja` (`szafka_lokalizacja_id`, `szafka_id`, `lokalizacja_id`) VALUES
(1, 1, 4),
(2, 2, 4),
(3, 3, 4),
(4, 4, 4),
(5, 5, 4),
(6, 6, 4),
(7, 7, 4),
(8, 8, 4),
(9, 9, 4),
(10, 10, 4),
(11, 11, 4),
(12, 12, 4),
(13, 13, 4),
(14, 14, 4),
(15, 15, 4),
(16, 16, 4),
(17, 17, 4),
(18, 18, 4),
(19, 19, 4),
(20, 20, 4),
(21, 21, 4),
(22, 22, 4),
(23, 23, 4),
(24, 24, 4),
(25, 25, 4),
(26, 26, 4),
(27, 27, 4),
(28, 28, 4),
(29, 29, 4),
(30, 30, 4),
(31, 31, 4),
(32, 32, 4),
(33, 33, 4),
(34, 34, 4),
(35, 35, 4),
(36, 36, 4),
(37, 37, 4),
(38, 38, 4),
(39, 39, 4),
(40, 40, 4),
(41, 41, 4),
(42, 42, 4),
(43, 43, 4),
(44, 44, 4),
(45, 45, 4),
(46, 46, 4),
(47, 47, 4),
(48, 48, 4),
(49, 49, 4),
(50, 50, 4),
(51, 51, 4),
(52, 52, 4),
(53, 53, 4),
(54, 54, 4),
(55, 55, 4),
(56, 56, 4),
(57, 57, 4),
(58, 58, 4),
(59, 59, 4),
(60, 60, 4),
(61, 61, 4),
(62, 62, 4),
(63, 63, 4),
(64, 64, 4),
(65, 65, 4),
(66, 66, 4),
(67, 67, 4),
(68, 68, 4),
(69, 69, 4),
(70, 70, 4),
(71, 71, 4),
(72, 72, 4),
(73, 73, 4),
(74, 74, 4),
(75, 75, 4),
(76, 76, 4),
(77, 77, 4),
(78, 78, 4),
(79, 79, 4),
(80, 80, 4),
(81, 81, 4),
(82, 82, 4),
(83, 83, 4),
(84, 84, 4),
(85, 85, 4),
(86, 86, 4),
(87, 87, 4),
(88, 88, 4),
(89, 89, 4),
(90, 90, 4),
(91, 91, 4),
(92, 92, 4),
(93, 93, 4),
(94, 94, 4),
(95, 95, 4),
(96, 96, 4),
(97, 97, 4),
(98, 98, 4),
(99, 99, 4),
(100, 100, 4),
(101, 101, 4),
(102, 102, 4),
(103, 103, 4),
(104, 104, 4),
(105, 105, 4),
(106, 106, 4),
(107, 107, 4),
(108, 108, 4),
(109, 109, 4),
(110, 110, 4),
(111, 111, 4),
(112, 112, 4),
(113, 113, 4),
(114, 114, 4),
(115, 115, 4),
(116, 116, 4),
(117, 117, 4),
(118, 118, 4),
(119, 119, 4),
(120, 120, 4),
(121, 121, 4),
(122, 122, 4),
(123, 123, 4),
(124, 124, 4),
(125, 125, 4),
(126, 126, 4),
(127, 127, 4),
(128, 128, 4),
(129, 129, 4),
(130, 130, 4),
(131, 131, 4),
(132, 132, 4),
(133, 133, 4),
(134, 134, 4),
(135, 135, 4),
(136, 136, 4),
(137, 137, 4),
(138, 138, 4),
(139, 139, 4),
(140, 140, 4),
(141, 141, 4),
(142, 142, 4),
(143, 143, 4),
(144, 144, 4),
(145, 145, 3),
(146, 146, 3),
(147, 147, 3),
(148, 148, 3),
(149, 149, 3),
(150, 150, 3),
(151, 151, 3),
(152, 152, 3),
(153, 153, 3),
(154, 154, 3),
(155, 155, 3),
(156, 156, 3),
(157, 157, 3),
(158, 158, 3),
(159, 159, 3),
(160, 160, 3),
(161, 161, 3),
(162, 162, 3),
(163, 163, 3),
(164, 164, 3),
(165, 165, 3),
(166, 166, 3),
(167, 167, 3),
(168, 168, 3),
(169, 169, 3),
(170, 170, 3),
(171, 171, 3),
(172, 172, 3),
(173, 173, 3),
(174, 174, 3),
(175, 175, 3),
(176, 176, 3),
(177, 177, 3),
(178, 178, 3),
(179, 179, 3),
(180, 180, 3),
(181, 181, 3),
(182, 182, 3),
(183, 183, 3),
(184, 184, 3),
(185, 185, 3),
(186, 186, 3),
(187, 187, 3),
(188, 188, 3),
(189, 189, 3),
(190, 190, 3),
(191, 191, 3),
(192, 192, 3),
(193, 193, 3),
(194, 194, 3),
(195, 195, 3),
(196, 196, 3),
(197, 197, 3),
(198, 198, 3),
(199, 199, 3),
(200, 200, 3),
(201, 201, 3),
(202, 202, 3),
(203, 203, 3),
(204, 204, 3),
(205, 205, 3),
(206, 206, 3),
(207, 207, 3),
(208, 208, 3),
(209, 209, 3),
(210, 210, 3),
(211, 211, 3),
(212, 212, 3),
(213, 213, 3),
(214, 214, 3),
(215, 215, 3),
(216, 216, 3),
(217, 217, 3),
(218, 218, 3),
(219, 219, 3),
(220, 220, 3),
(221, 221, 3),
(222, 222, 3),
(223, 223, 3),
(224, 224, 3),
(225, 225, 3),
(226, 226, 3),
(227, 227, 3),
(228, 228, 3),
(229, 229, 3),
(230, 230, 3),
(231, 231, 3),
(232, 232, 3),
(233, 233, 3),
(234, 234, 3),
(235, 235, 3),
(236, 236, 3),
(237, 237, 3),
(238, 238, 3),
(239, 239, 3),
(240, 240, 3),
(241, 241, 3),
(242, 242, 3),
(243, 243, 3),
(244, 244, 3),
(245, 245, 3),
(246, 246, 3),
(247, 247, 3),
(248, 248, 3),
(249, 249, 3),
(250, 250, 3),
(251, 251, 3),
(252, 252, 3),
(253, 253, 3),
(254, 254, 3),
(255, 255, 3),
(256, 256, 3),
(257, 257, 3),
(258, 258, 3),
(259, 259, 3),
(260, 260, 3),
(261, 261, 3),
(262, 262, 3),
(263, 263, 3),
(264, 264, 3),
(265, 265, 3),
(266, 266, 3),
(267, 267, 3),
(268, 268, 3),
(269, 269, 3),
(270, 270, 3),
(271, 271, 3),
(272, 272, 3),
(273, 273, 3),
(274, 274, 3),
(275, 275, 3),
(276, 276, 3),
(277, 277, 3),
(278, 278, 3),
(279, 279, 3),
(280, 280, 3),
(281, 281, 3),
(282, 282, 3),
(283, 283, 3),
(284, 284, 3),
(285, 285, 3),
(286, 286, 3),
(287, 287, 3),
(288, 288, 3),
(289, 289, 3),
(290, 290, 3),
(291, 291, 3),
(292, 292, 3),
(293, 293, 3),
(294, 294, 3),
(295, 295, 3),
(296, 296, 3),
(297, 297, 3),
(298, 298, 3),
(299, 299, 3),
(300, 300, 3),
(301, 301, 3),
(302, 302, 3),
(303, 303, 3),
(304, 304, 3),
(305, 305, 3),
(306, 306, 3),
(307, 307, 3),
(308, 308, 3),
(309, 309, 3),
(310, 310, 3),
(311, 311, 3),
(312, 312, 3),
(313, 313, 3),
(314, 314, 3),
(315, 315, 3),
(316, 316, 3),
(317, 317, 3),
(318, 318, 3),
(319, 319, 3),
(320, 320, 3),
(321, 321, 3),
(322, 322, 3),
(323, 323, 3),
(324, 324, 3),
(325, 325, 3),
(326, 326, 3),
(327, 327, 3),
(328, 328, 3),
(329, 329, 3),
(330, 330, 3),
(331, 331, 3),
(332, 332, 3),
(333, 333, 3),
(334, 334, 3),
(335, 335, 3),
(336, 336, 3),
(337, 337, 3),
(338, 338, 3),
(339, 339, 3),
(340, 340, 3),
(341, 341, 3),
(342, 342, 3),
(343, 343, 3),
(344, 344, 3),
(345, 345, 3),
(346, 346, 3),
(347, 347, 3),
(348, 348, 3),
(349, 349, 3),
(350, 350, 3),
(351, 351, 3),
(352, 352, 3),
(353, 353, 3),
(354, 354, 3),
(355, 355, 3),
(356, 356, 3),
(357, 357, 3),
(358, 358, 3),
(359, 359, 3),
(360, 360, 3),
(361, 361, 3),
(362, 362, 3),
(363, 363, 3),
(364, 364, 3),
(365, 365, 3),
(366, 366, 3),
(367, 367, 3),
(368, 368, 3),
(369, 369, 3),
(370, 370, 3),
(371, 371, 3),
(372, 372, 3),
(373, 373, 3),
(374, 374, 3),
(375, 375, 3),
(376, 376, 3),
(377, 377, 3),
(378, 378, 3),
(379, 379, 3),
(380, 380, 3),
(381, 381, 3),
(382, 382, 3),
(383, 383, 3),
(384, 384, 3),
(385, 385, 3),
(386, 386, 3),
(387, 387, 3),
(388, 388, 3),
(389, 389, 3),
(390, 390, 3),
(391, 391, 3),
(392, 392, 3),
(393, 393, 3),
(394, 394, 3),
(395, 395, 3),
(396, 396, 3),
(397, 397, 3),
(398, 398, 3),
(399, 399, 3),
(400, 400, 3),
(401, 401, 3),
(402, 402, 3),
(403, 403, 3),
(404, 404, 3),
(405, 405, 3),
(406, 406, 3),
(407, 407, 3),
(408, 408, 3),
(409, 409, 3),
(410, 410, 3),
(411, 411, 3),
(412, 412, 3),
(413, 413, 3),
(414, 414, 3),
(415, 415, 3),
(416, 416, 3),
(417, 417, 3),
(418, 418, 3),
(419, 419, 3),
(420, 420, 3),
(421, 421, 3),
(422, 422, 3),
(423, 423, 3),
(424, 424, 3),
(425, 425, 3),
(426, 426, 3),
(427, 427, 3),
(428, 428, 3),
(429, 429, 3),
(430, 430, 3),
(431, 431, 3),
(432, 432, 3),
(433, 433, 3),
(434, 434, 3),
(435, 435, 3),
(436, 436, 3),
(437, 437, 3),
(438, 438, 3),
(439, 439, 3),
(440, 440, 3),
(441, 441, 3),
(442, 442, 3),
(443, 443, 3),
(444, 444, 3),
(445, 445, 3),
(446, 446, 3),
(447, 447, 3),
(448, 448, 3),
(449, 449, 3),
(450, 450, 3),
(451, 451, 3),
(452, 452, 3),
(453, 453, 3),
(454, 454, 3),
(455, 455, 3),
(456, 456, 3),
(457, 457, 3),
(458, 458, 3),
(459, 459, 3),
(460, 460, 3),
(461, 461, 3),
(462, 462, 3),
(463, 463, 3),
(464, 464, 3),
(465, 465, 3),
(466, 466, 3),
(467, 467, 3),
(468, 468, 3),
(469, 469, 3),
(470, 470, 3),
(471, 471, 3),
(472, 472, 3),
(473, 473, 3),
(474, 474, 3),
(475, 475, 3),
(476, 476, 3),
(477, 477, 3),
(478, 478, 3),
(479, 479, 3),
(480, 480, 3),
(481, 481, 3),
(482, 482, 3),
(483, 483, 3),
(484, 484, 3),
(485, 485, 3),
(486, 486, 3),
(487, 487, 3),
(488, 488, 3),
(489, 489, 3),
(490, 490, 3),
(491, 491, 3),
(492, 492, 3),
(493, 493, 3),
(494, 494, 3),
(495, 495, 3),
(496, 496, 3),
(497, 497, 3),
(498, 498, 3),
(499, 499, 3),
(500, 500, 3),
(501, 501, 3),
(502, 502, 3),
(503, 503, 3),
(504, 504, 3),
(505, 505, 3),
(506, 506, 3),
(507, 507, 3),
(508, 508, 3),
(509, 509, 3),
(510, 510, 3),
(511, 511, 3),
(512, 512, 3),
(513, 513, 3),
(514, 514, 3),
(515, 515, 3),
(516, 516, 3),
(517, 517, 3),
(518, 518, 3),
(519, 519, 3),
(520, 520, 3),
(521, 521, 3),
(522, 522, 3),
(523, 523, 3),
(524, 524, 3),
(525, 525, 3),
(526, 526, 3),
(527, 527, 3),
(528, 528, 3),
(529, 529, 3),
(530, 530, 3),
(531, 531, 3),
(532, 532, 3),
(533, 533, 2),
(534, 534, 2),
(535, 535, 2),
(536, 536, 2),
(537, 537, 2),
(538, 538, 2),
(539, 539, 2),
(540, 540, 2),
(541, 541, 2),
(542, 542, 2),
(543, 543, 2),
(544, 544, 2),
(545, 545, 2),
(546, 546, 2),
(547, 547, 2),
(548, 548, 2),
(549, 549, 2),
(550, 550, 2),
(551, 551, 2),
(552, 552, 2),
(553, 553, 2),
(554, 554, 2),
(555, 555, 2),
(556, 556, 2),
(557, 557, 2),
(558, 558, 2),
(559, 559, 2),
(560, 560, 2),
(561, 561, 2),
(562, 562, 2),
(563, 563, 2),
(564, 564, 2),
(565, 565, 2),
(566, 566, 2),
(567, 567, 2),
(568, 568, 2),
(569, 569, 2),
(570, 570, 2),
(571, 571, 2),
(572, 572, 2),
(573, 573, 2),
(574, 574, 2),
(575, 575, 2),
(576, 576, 2),
(577, 577, 2),
(578, 578, 2),
(579, 579, 2),
(580, 580, 2),
(581, 581, 2),
(582, 582, 2),
(583, 583, 2),
(584, 584, 2),
(585, 585, 2),
(586, 586, 2),
(587, 587, 2),
(588, 588, 2),
(589, 589, 2),
(590, 590, 2),
(591, 591, 2),
(592, 592, 2),
(593, 593, 2),
(594, 594, 2),
(595, 595, 2),
(596, 596, 2),
(597, 597, 2),
(598, 598, 2),
(599, 599, 2),
(600, 600, 2),
(601, 601, 2),
(602, 602, 2),
(603, 603, 2),
(604, 604, 2),
(605, 605, 2),
(606, 606, 2),
(607, 607, 2),
(608, 608, 2),
(609, 609, 2),
(610, 610, 2),
(611, 611, 2),
(612, 612, 2),
(613, 613, 2),
(614, 614, 2),
(615, 615, 2),
(616, 616, 2),
(617, 617, 2),
(618, 618, 2),
(619, 619, 2),
(620, 620, 2),
(621, 621, 2),
(622, 622, 2);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `szafka_status`
--

CREATE TABLE `szafka_status` (
  `szafka_status_id` int NOT NULL,
  `uczen_szafka_id` int NOT NULL,
  `status_id` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_polish_ci;

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `uczen`
--

CREATE TABLE `uczen` (
  `uczen_id` int NOT NULL,
  `imie` text CHARACTER SET utf8mb3 COLLATE utf8mb3_polish_ci NOT NULL,
  `nazwisko` text CHARACTER SET utf8mb3 COLLATE utf8mb3_polish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_polish_ci;

--
-- Dumping data for table `uczen`
--

INSERT INTO `uczen` (`uczen_id`, `imie`, `nazwisko`) VALUES
(1, 'Imie1', 'Nazwisko1'),
(2, 'Imie2', 'Nazwisko2'),
(3, 'Imie3', 'Nazwisko3'),
(4, 'Imie4', 'Nazwisko4'),
(5, 'Imie5', 'Nazwisko5'),
(6, 'Imie6', 'Nazwisko6');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `uczen_klasa`
--

CREATE TABLE `uczen_klasa` (
  `uczen_klasa_id` int NOT NULL,
  `uczen_id` int NOT NULL,
  `klasa_id` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_polish_ci;

--
-- Dumping data for table `uczen_klasa`
--

INSERT INTO `uczen_klasa` (`uczen_klasa_id`, `uczen_id`, `klasa_id`) VALUES
(1, 1, 1),
(2, 2, 1),
(3, 3, 1),
(4, 4, 1),
(5, 5, 1),
(6, 6, 1);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `uczen_szafka`
--

CREATE TABLE `uczen_szafka` (
  `uczen_szafka_id` int NOT NULL,
  `uczen_id` int DEFAULT NULL,
  `szafka_id` int NOT NULL,
  `klasa_id` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_polish_ci;

--
-- Dumping data for table `uczen_szafka`
--

INSERT INTO `uczen_szafka` (`uczen_szafka_id`, `uczen_id`, `szafka_id`, `klasa_id`) VALUES
(1, 1, 603, 30);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `uzytkownik`
--

CREATE TABLE `uzytkownik` (
  `uzytkownik_id` int NOT NULL,
  `login` text CHARACTER SET utf8mb3 COLLATE utf8mb3_polish_ci NOT NULL,
  `haslo` text CHARACTER SET utf8mb3 COLLATE utf8mb3_polish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_polish_ci;

--
-- Dumping data for table `uzytkownik`
--

INSERT INTO `uzytkownik` (`uzytkownik_id`, `login`, `haslo`) VALUES
(1, 'test', ''),
(3, 'test1', '');

--
-- Indeksy dla zrzutów tabel
--

--
-- Indeksy dla tabeli `archiwum`
--
ALTER TABLE `archiwum`
  ADD PRIMARY KEY (`archiwum_id`);

--
-- Indeksy dla tabeli `klasa`
--
ALTER TABLE `klasa`
  ADD PRIMARY KEY (`klasa_id`);

--
-- Indeksy dla tabeli `lokalizacja`
--
ALTER TABLE `lokalizacja`
  ADD PRIMARY KEY (`lokalizacja_id`);

--
-- Indeksy dla tabeli `sesja`
--
ALTER TABLE `sesja`
  ADD PRIMARY KEY (`sesja_id`);

--
-- Indeksy dla tabeli `status`
--
ALTER TABLE `status`
  ADD PRIMARY KEY (`status_id`);

--
-- Indeksy dla tabeli `szafka`
--
ALTER TABLE `szafka`
  ADD PRIMARY KEY (`szafka_id`);

--
-- Indeksy dla tabeli `szafka_lokalizacja`
--
ALTER TABLE `szafka_lokalizacja`
  ADD PRIMARY KEY (`szafka_lokalizacja_id`),
  ADD KEY `szafka_id` (`szafka_id`),
  ADD KEY `lokalizacja_id` (`lokalizacja_id`);

--
-- Indeksy dla tabeli `szafka_status`
--
ALTER TABLE `szafka_status`
  ADD PRIMARY KEY (`szafka_status_id`),
  ADD KEY `uczen_szafka_id` (`uczen_szafka_id`),
  ADD KEY `szafka_status_ibfk_1` (`status_id`);

--
-- Indeksy dla tabeli `uczen`
--
ALTER TABLE `uczen`
  ADD PRIMARY KEY (`uczen_id`);

--
-- Indeksy dla tabeli `uczen_klasa`
--
ALTER TABLE `uczen_klasa`
  ADD PRIMARY KEY (`uczen_klasa_id`),
  ADD KEY `klasa_id` (`klasa_id`),
  ADD KEY `uczen_id` (`uczen_id`);

--
-- Indeksy dla tabeli `uczen_szafka`
--
ALTER TABLE `uczen_szafka`
  ADD PRIMARY KEY (`uczen_szafka_id`),
  ADD KEY `szafka_id` (`szafka_id`),
  ADD KEY `uczen_id` (`uczen_id`),
  ADD KEY `klasa_id` (`klasa_id`);

--
-- Indeksy dla tabeli `uzytkownik`
--
ALTER TABLE `uzytkownik`
  ADD PRIMARY KEY (`uzytkownik_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `archiwum`
--
ALTER TABLE `archiwum`
  MODIFY `archiwum_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=102;

--
-- AUTO_INCREMENT for table `klasa`
--
ALTER TABLE `klasa`
  MODIFY `klasa_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

--
-- AUTO_INCREMENT for table `lokalizacja`
--
ALTER TABLE `lokalizacja`
  MODIFY `lokalizacja_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `sesja`
--
ALTER TABLE `sesja`
  MODIFY `sesja_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `status`
--
ALTER TABLE `status`
  MODIFY `status_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `szafka`
--
ALTER TABLE `szafka`
  MODIFY `szafka_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=625;

--
-- AUTO_INCREMENT for table `szafka_lokalizacja`
--
ALTER TABLE `szafka_lokalizacja`
  MODIFY `szafka_lokalizacja_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=624;

--
-- AUTO_INCREMENT for table `szafka_status`
--
ALTER TABLE `szafka_status`
  MODIFY `szafka_status_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `uczen`
--
ALTER TABLE `uczen`
  MODIFY `uczen_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1070;

--
-- AUTO_INCREMENT for table `uczen_klasa`
--
ALTER TABLE `uczen_klasa`
  MODIFY `uczen_klasa_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1070;

--
-- AUTO_INCREMENT for table `uczen_szafka`
--
ALTER TABLE `uczen_szafka`
  MODIFY `uczen_szafka_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1124;

--
-- AUTO_INCREMENT for table `uzytkownik`
--
ALTER TABLE `uzytkownik`
  MODIFY `uzytkownik_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `szafka_lokalizacja`
--
ALTER TABLE `szafka_lokalizacja`
  ADD CONSTRAINT `szafka_lokalizacja_ibfk_1` FOREIGN KEY (`szafka_id`) REFERENCES `szafka` (`szafka_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `szafka_lokalizacja_ibfk_2` FOREIGN KEY (`lokalizacja_id`) REFERENCES `lokalizacja` (`lokalizacja_id`) ON DELETE CASCADE ON UPDATE RESTRICT;

--
-- Constraints for table `szafka_status`
--
ALTER TABLE `szafka_status`
  ADD CONSTRAINT `szafka_status_ibfk_1` FOREIGN KEY (`status_id`) REFERENCES `status` (`status_id`) ON UPDATE RESTRICT,
  ADD CONSTRAINT `szafka_status_ibfk_2` FOREIGN KEY (`uczen_szafka_id`) REFERENCES `uczen_szafka` (`uczen_szafka_id`) ON DELETE CASCADE ON UPDATE RESTRICT;

--
-- Constraints for table `uczen_klasa`
--
ALTER TABLE `uczen_klasa`
  ADD CONSTRAINT `uczen_klasa_ibfk_1` FOREIGN KEY (`klasa_id`) REFERENCES `klasa` (`klasa_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `uczen_klasa_ibfk_2` FOREIGN KEY (`uczen_id`) REFERENCES `uczen` (`uczen_id`) ON DELETE CASCADE;

--
-- Constraints for table `uczen_szafka`
--
ALTER TABLE `uczen_szafka`
  ADD CONSTRAINT `uczen_szafka_ibfk_1` FOREIGN KEY (`szafka_id`) REFERENCES `szafka` (`szafka_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `uczen_szafka_ibfk_2` FOREIGN KEY (`uczen_id`) REFERENCES `uczen` (`uczen_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `uczen_szafka_ibfk_3` FOREIGN KEY (`klasa_id`) REFERENCES `klasa` (`klasa_id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
