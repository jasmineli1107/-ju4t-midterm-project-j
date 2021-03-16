-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- 主機： 127.0.0.1
-- 產生時間： 2020-12-18 11:22:32
-- 伺服器版本： 10.4.16-MariaDB
-- PHP 版本： 7.3.24

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- 資料庫： `ju4t`
--

-- --------------------------------------------------------

--
-- 資料表結構 `admins`
--

CREATE TABLE `admins` (
  `sid` int(11) NOT NULL,
  `account` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `avatar` mediumtext DEFAULT NULL,
  `nickname` varchar(255) NOT NULL,
  `created_at` datetime NOT NULL,
  `update_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- 傾印資料表的資料 `admins`
--

INSERT INTO `admins` (`sid`, `account`, `password`, `avatar`, `nickname`, `created_at`, `update_at`) VALUES
(1, 'ju4t', '0000', NULL, 'ju4t_admin', '2020-12-18 10:14:51', '2020-12-18 10:14:51');

-- --------------------------------------------------------

--
-- 資料表結構 `member_address`
--

CREATE TABLE `member_address` (
  `sid` int(11) NOT NULL,
  `member_sid` int(11) DEFAULT NULL,
  `counties_sid` int(11) DEFAULT NULL,
  `district_sid` int(11) DEFAULT NULL,
  `receive_location` varchar(100) DEFAULT NULL,
  `receive_name` varchar(100) DEFAULT NULL,
  `receive_phone` char(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- 傾印資料表的資料 `member_address`
--

INSERT INTO `member_address` (`sid`, `member_sid`, `counties_sid`, `district_sid`, `receive_location`, `receive_name`, `receive_phone`) VALUES
(1, 71, 10, 153, '東信路271巷205號48樓', '漫妮', '0991099946'),
(2, 13, 4, 230, '溪心街734號88樓', '可馨', '0991992700'),
(3, 9, 16, 262, '豐偉路450巷382弄101號', 'Ivy', '0979915090'),
(4, 41, 2, 228, '楓林十街115號', '雨萌', '0995377247'),
(5, 46, 6, 48, '徐州五路四段777號71樓', '思宇', '0946181824'),
(6, 7, 11, 10, '崇德三路578巷419號', '小波', '0941484057'),
(7, 46, 22, 305, '金鋒一街九段757巷987弄517號50樓', '梓彤', '0965727389'),
(8, 90, 7, 357, '德正路759號43樓', '笑薇', '0951566638'),
(9, 50, 5, 344, '吉利四街七段158號', '松源', '0995377640'),
(10, 80, 11, 93, '富台東街四段849號60樓', '博豪', '0951055426'),
(11, 64, 13, 151, '功安一路298巷654號', '笑薇', '0943285338'),
(12, 74, 2, 332, '新富街389號', '宸瑜', '0967721969'),
(13, 43, 13, 339, '岩灣路三段278巷287號51樓', '尚霖', '0946896489'),
(14, 18, 11, 222, '平等十二路859巷789號64樓', '尚霖', '0993647545'),
(15, 9, 8, 297, '芎林鄉凱得街456號', '可卿', '0984114615'),
(16, 57, 2, 2, '久安二街854巷974弄965號', '宇宸', '0995927752'),
(17, 36, 13, 199, '永勝路三段267巷288號', 'Tommy', '0959110658'),
(18, 79, 19, 313, '環山九如街六段265巷396號', '以辰', '0902455975'),
(19, 34, 10, 234, '國賢一街62號', '家俞', '0940223180'),
(20, 89, 19, 312, '工業三路636巷445號67樓', '碧萱', '0940812834'),
(21, 56, 16, 19, '民主四街388巷347弄752號', '皓睿', '0908988655'),
(22, 43, 20, 176, '太原四街768號7樓', '永鑫', '0981567817'),
(23, 50, 11, 362, '大灣七路一段436巷86弄466號', '海程', '0973812074'),
(24, 16, 9, 360, '大華五路二段384號71樓', '宸瑜', '0957473603'),
(25, 22, 10, 94, '法院前街五段21號', '若瑾', '0977538319'),
(26, 3, 2, 243, '龍天街581巷162弄301號98樓', '雪兒', '0962028466'),
(27, 79, 11, 140, '文館路541巷651弄842號', '泰霖', '0977630562'),
(28, 89, 15, 83, '梅亭東路683號42樓', '展博', '0900651876'),
(29, 40, 14, 60, '德陽路八段298巷698號54樓', '阿菘', '0944204174'),
(30, 23, 21, 98, '大安港街573號74樓', 'Jerry', '0969274311'),
(31, 54, 22, 161, '軍福十八街七段746號59樓', '雪怡', '0991320104'),
(32, 16, 10, 288, '華泰一街三段997號', 'Tommy', '0995961903'),
(33, 11, 16, 305, '三和二路九段831巷67弄351號', '梓彤', '0974657068'),
(34, 2, 22, 145, '明野路一段882巷460弄629號22樓', '澄泓', '0904772304'),
(35, 56, 13, 105, '崇德十二街541巷571弄553號', '尚霖', '0962560104'),
(36, 84, 17, 61, '福陽路六段175巷52號', '梓焓', '0998070797'),
(37, 2, 6, 238, '永勝街九段338號93樓', 'Lili', '0969630454'),
(38, 89, 17, 357, '濱一街五段102巷208號32樓', 'Mark', '0981850349'),
(39, 97, 2, 266, '大學二十三街156號', '雅芙', '0978730831'),
(40, 32, 14, 144, '新寮一路四段356號', '雅芙', '0964562983'),
(41, 96, 21, 14, '民富十六街688巷601號', '亦涵', '0903580192'),
(42, 8, 11, 40, '斗苑路七段117巷211號', 'Rita', '0977968141'),
(43, 24, 1, 173, '鎮國路237巷957號', '月松', '0906412193'),
(44, 8, 18, 321, '長樂五路501巷392弄260號', '博裕', '0904721771'),
(45, 43, 15, 1, '站前街鐵路南舍街五段182號', '墨含', '0907350465'),
(46, 71, 6, 236, '三多五街七段525號94樓', '尹智', '0974593827'),
(47, 26, 11, 166, '竹社街七段890號', '博裕', '0978681696'),
(48, 61, 13, 300, '雙十街851巷823弄269號', '宸瑜', '0977295322'),
(49, 63, 9, 11, '青埔八街九段155號', 'Gary', '0948455485'),
(50, 84, 5, 355, '樹仁二街279號', 'Alice', '0957137907');

-- --------------------------------------------------------

--
-- 資料表結構 `member_counties`
--

CREATE TABLE `member_counties` (
  `sid` int(11) NOT NULL,
  `counties` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- 傾印資料表的資料 `member_counties`
--

INSERT INTO `member_counties` (`sid`, `counties`) VALUES
(1, '臺北市'),
(2, '新北市'),
(3, '基隆市'),
(4, '桃園市'),
(5, '新竹市'),
(6, '新竹縣'),
(7, '苗栗縣'),
(8, '臺中市'),
(9, '彰化縣'),
(10, '南投縣'),
(11, '雲林縣'),
(12, '嘉義市'),
(13, '嘉義縣'),
(14, '臺南市'),
(15, '高雄市'),
(16, '屏東縣'),
(17, '宜蘭縣'),
(18, '花蓮縣'),
(19, '臺東縣'),
(20, '澎湖縣'),
(21, '金門縣'),
(22, '連江縣');

-- --------------------------------------------------------

--
-- 資料表結構 `member_districts`
--

CREATE TABLE `member_districts` (
  `sid` int(11) NOT NULL,
  `counties_sid` int(11) NOT NULL,
  `districts` varchar(100) NOT NULL,
  `postal_code` char(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- 傾印資料表的資料 `member_districts`
--

INSERT INTO `member_districts` (`sid`, `counties_sid`, `districts`, `postal_code`) VALUES
(1, 2, '板橋區', '220'),
(2, 2, '新莊區', '242'),
(3, 2, '中和區', '235'),
(4, 2, '永和區', '234'),
(5, 2, '土城區', '236'),
(6, 2, '樹林區', '238'),
(7, 2, '三峽區', '237'),
(8, 2, '鶯歌區', '239'),
(9, 2, '三重區', '241'),
(10, 2, '蘆洲區', '247'),
(11, 2, '五股區', '248'),
(12, 2, '泰山區', '243'),
(13, 2, '林口區', '244'),
(14, 2, '八里區', '249'),
(15, 2, '淡水區', '251'),
(16, 2, '三芝區', '252'),
(17, 2, '石門區', '253'),
(18, 2, '金山區', '208'),
(19, 2, '萬里區', '207'),
(20, 2, '汐止區', '221'),
(21, 2, '瑞芳區', '224'),
(22, 2, '貢寮區', '228'),
(23, 2, '平溪區', '226'),
(24, 2, '雙溪區', '227'),
(25, 2, '新店區', '231'),
(26, 2, '深坑區', '222'),
(27, 2, '石碇區', '223'),
(28, 2, '坪林區', '232'),
(29, 2, '烏來區', '233'),
(30, 1, '中正區', '202'),
(31, 1, '大同區', '103'),
(32, 1, '中山區', '203'),
(33, 1, '松山區', '105'),
(34, 1, '大安區', '439'),
(35, 1, '萬華區', '108'),
(36, 1, '信義區', '201'),
(37, 1, '士林區', '111'),
(38, 1, '北投區', '112'),
(39, 1, '內湖區', '114'),
(40, 1, '南港區', '115'),
(41, 1, '文山區', '116'),
(42, 4, '桃園區', '330'),
(43, 4, '中壢區', '320'),
(44, 4, '平鎮區', '324'),
(45, 4, '八德區', '334'),
(46, 4, '楊梅區', '326'),
(47, 4, '蘆竹區', '338'),
(48, 4, '大溪區', '335'),
(49, 4, '龍潭區', '325'),
(50, 4, '龜山區', '333'),
(51, 4, '大園區', '337'),
(52, 4, '觀音區', '328'),
(53, 4, '新屋區', '327'),
(54, 4, '復興區', '336'),
(55, 8, '中區', '400'),
(56, 8, '東區', '401'),
(57, 8, '南區', '402'),
(58, 8, '西區', '403'),
(59, 8, '北區', '404'),
(60, 8, '北屯區', '406'),
(61, 8, '西屯區', '407'),
(62, 8, '南屯區', '408'),
(63, 8, '太平區', '411'),
(64, 8, '大里區', '412'),
(65, 8, '霧峰區', '413'),
(66, 8, '烏日區', '414'),
(67, 8, '豐原區', '420'),
(68, 8, '后里區', '421'),
(69, 8, '石岡區', '422'),
(70, 8, '東勢區', '423'),
(71, 8, '新社區', '426'),
(72, 8, '潭子區', '427'),
(73, 8, '大雅區', '428'),
(74, 8, '神岡區', '429'),
(75, 8, '大肚區', '432'),
(76, 8, '沙鹿區', '433'),
(77, 8, '龍井區', '434'),
(78, 8, '梧棲區', '435'),
(79, 8, '清水區', '436'),
(80, 8, '大甲區', '437'),
(81, 8, '外埔區', '438'),
(82, 8, '大安區', '439'),
(83, 8, '和平區', '424'),
(84, 14, '中西區', '700'),
(85, 14, '東區', '701'),
(86, 14, '南區', '702'),
(87, 14, '北區', '704'),
(88, 14, '安平區', '708'),
(89, 14, '安南區', '709'),
(90, 14, '永康區', '710'),
(91, 14, '歸仁區', '711'),
(92, 14, '新化區', '712'),
(93, 14, '左鎮區', '713'),
(94, 14, '玉井區', '714'),
(95, 14, '楠西區', '715'),
(96, 14, '南化區', '716'),
(97, 14, '仁德區', '717'),
(98, 14, '關廟區', '718'),
(99, 14, '龍崎區', '719'),
(100, 14, '官田區', '720'),
(101, 14, '麻豆區', '721'),
(102, 14, '佳里區', '722'),
(103, 14, '西港區', '723'),
(104, 14, '七股區', '724'),
(105, 14, '將軍區', '725'),
(106, 14, '學甲區', '726'),
(107, 14, '北門區', '727'),
(108, 14, '新營區', '730'),
(109, 14, '後壁區', '731'),
(110, 14, '白河區', '732'),
(111, 14, '東山區', '733'),
(112, 14, '六甲區', '734'),
(113, 14, '下營區', '735'),
(114, 14, '柳營區', '736'),
(115, 14, '鹽水區', '737'),
(116, 14, '善化區', '741'),
(117, 14, '大內區', '742'),
(118, 14, '山上區', '743'),
(119, 14, '新市區', '744'),
(120, 14, '安定區', '745'),
(121, 15, '楠梓區', '811'),
(122, 15, '左營區', '813'),
(123, 15, '鼓山區', '804'),
(124, 15, '三民區', '807'),
(125, 15, '鹽埕區', '803'),
(126, 15, '前金區', '801'),
(127, 15, '新興區', '800'),
(128, 15, '苓雅區', '802'),
(129, 15, '前鎮區', '806'),
(130, 15, '旗津區', '805'),
(131, 15, '小港區', '812'),
(132, 15, '鳳山區', '830'),
(133, 15, '大寮區', '831'),
(134, 15, '鳥松區', '833'),
(135, 15, '林園區', '832'),
(136, 15, '仁武區', '814'),
(137, 15, '大樹區', '840'),
(138, 15, '大社區', '815'),
(139, 15, '岡山區', '820'),
(140, 15, '路竹區', '821'),
(141, 15, '橋頭區', '825'),
(142, 15, '梓官區', '826'),
(143, 15, '彌陀區', '827'),
(144, 15, '永安區', '828'),
(145, 15, '燕巢區', '824'),
(146, 15, '田寮區', '823'),
(147, 15, '阿蓮區', '822'),
(148, 15, '茄萣區', '852'),
(149, 15, '湖內區', '829'),
(150, 15, '旗山區', '842'),
(151, 15, '美濃區', '843'),
(152, 15, '內門區', '845'),
(153, 15, '杉林區', '846'),
(154, 15, '甲仙區', '847'),
(155, 15, '六龜區', '844'),
(156, 15, '茂林區', '851'),
(157, 15, '桃源區', '848'),
(158, 15, '那瑪夏區', '849'),
(159, 3, '仁愛區', '200'),
(160, 3, '中正區', '202'),
(161, 3, '信義區', '201'),
(162, 3, '中山區', '203'),
(163, 3, '安樂區', '204'),
(164, 3, '暖暖區', '205'),
(165, 3, '七堵區', '206'),
(166, 6, '東區', '600'),
(167, 6, '北區', '300'),
(168, 6, '香山區', '300'),
(169, 12, '東區', '600'),
(170, 12, '西區', '600'),
(171, 6, '竹北市', '302'),
(172, 6, '竹東鎮', '310'),
(173, 6, '新埔鎮', '305'),
(174, 6, '關西鎮', '306'),
(175, 6, '湖口鄉', '303'),
(176, 6, '新豐鄉', '304'),
(177, 6, '峨眉鄉', '315'),
(178, 6, '寶山鄉', '308'),
(179, 6, '北埔鄉', '314'),
(180, 6, '芎林鄉', '307'),
(181, 6, '橫山鄉', '312'),
(182, 6, '尖石鄉', '313'),
(183, 6, '五峰鄉', '311'),
(184, 7, '苗栗市', '360'),
(185, 7, '頭份市', '351'),
(186, 7, '竹南鎮', '350'),
(187, 7, '後龍鎮', '356'),
(188, 7, '通霄鎮', '357'),
(189, 7, '苑裡鎮', '358'),
(190, 7, '卓蘭鎮', '369'),
(191, 7, '造橋鄉', '361'),
(192, 7, '西湖鄉', '368'),
(193, 7, '頭屋鄉', '362'),
(194, 7, '公館鄉', '363'),
(195, 7, '銅鑼鄉', '366'),
(196, 7, '三義鄉', '367'),
(197, 7, '大湖鄉', '364'),
(198, 7, '獅潭鄉', '354'),
(199, 7, '三灣鄉', '352'),
(200, 7, '南庄鄉', '353'),
(201, 7, '泰安鄉', '365'),
(202, 9, '彰化市', '500'),
(203, 9, '員林市', '510'),
(204, 9, '和美鎮', '508'),
(205, 9, '鹿港鎮', '505'),
(206, 9, '溪湖鎮', '514'),
(207, 9, '二林鎮', '526'),
(208, 9, '田中鎮', '520'),
(209, 9, '北斗鎮', '521'),
(210, 9, '花壇鄉', '503'),
(211, 9, '芬園鄉', '502'),
(212, 9, '大村鄉', '515'),
(213, 9, '永靖鄉', '512'),
(214, 9, '伸港鄉', '509'),
(215, 9, '線西鄉', '507'),
(216, 9, '福興鄉', '506'),
(217, 9, '秀水鄉', '504'),
(218, 9, '埔心鄉', '513'),
(219, 9, '埔鹽鄉', '516'),
(220, 9, '大城鄉', '527'),
(221, 9, '芳苑鄉', '528'),
(222, 9, '竹塘鄉', '525'),
(223, 9, '社頭鄉', '511'),
(224, 9, '二水鄉', '530'),
(225, 9, '田尾鄉', '522'),
(226, 9, '埤頭鄉', '523'),
(227, 9, '溪州鄉', '524'),
(228, 10, '南投市', '540'),
(229, 10, '埔里鎮', '545'),
(230, 10, '草屯鎮', '542'),
(231, 10, '竹山鎮', '557'),
(232, 10, '集集鎮', '552'),
(233, 10, '名間鄉', '551'),
(234, 10, '鹿谷鄉', '558'),
(235, 10, '中寮鄉', '541'),
(236, 10, '魚池鄉', '555'),
(237, 10, '國姓鄉', '544'),
(238, 10, '水里鄉', '553'),
(239, 10, '信義鄉', '556'),
(240, 10, '仁愛鄉', '546'),
(241, 11, '斗六市', '640'),
(242, 11, '斗南鎮', '630'),
(243, 11, '虎尾鎮', '632'),
(244, 11, '西螺鎮', '648'),
(245, 11, '土庫鎮', '633'),
(246, 11, '北港鎮', '651'),
(247, 11, '林內鄉', '643'),
(248, 11, '古坑鄉', '646'),
(249, 11, '大埤鄉', '631'),
(250, 11, '莿桐鄉', '647'),
(251, 11, '褒忠鄉', '634'),
(252, 11, '二崙鄉', '649'),
(253, 11, '崙背鄉', '637'),
(254, 11, '麥寮鄉', '638'),
(255, 11, '臺西鄉', '636'),
(256, 11, '東勢鄉', '635'),
(257, 11, '元長鄉', '655'),
(258, 11, '四湖鄉', '654'),
(259, 11, '口湖鄉', '653'),
(260, 11, '水林鄉', '652'),
(261, 13, '太保市', '612'),
(262, 13, '朴子市', '613'),
(263, 13, '布袋鎮', '625'),
(264, 13, '大林鎮', '622'),
(265, 13, '民雄鄉', '621'),
(266, 13, '溪口鄉', '623'),
(267, 13, '新港鄉', '616'),
(268, 13, '六腳鄉', '615'),
(269, 13, '東石鄉', '614'),
(270, 13, '義竹鄉', '624'),
(271, 13, '鹿草鄉', '611'),
(272, 13, '水上鄉', '608'),
(273, 13, '中埔鄉', '606'),
(274, 13, '竹崎鄉', '604'),
(275, 13, '梅山鄉', '603'),
(276, 13, '番路鄉', '602'),
(277, 13, '大埔鄉', '607'),
(278, 13, '阿里山鄉', '605'),
(279, 16, '屏東市', '900'),
(280, 16, '潮州鎮', '920'),
(281, 16, '東港鎮', '928'),
(282, 16, '恆春鎮', '946'),
(283, 16, '萬丹鄉', '913'),
(284, 16, '長治鄉', '908'),
(285, 16, '麟洛鄉', '909'),
(286, 16, '九如鄉', '904'),
(287, 16, '里港鄉', '905'),
(288, 16, '鹽埔鄉', '907'),
(289, 16, '高樹鄉', '906'),
(290, 16, '萬巒鄉', '923'),
(291, 16, '內埔鄉', '912'),
(292, 16, '竹田鄉', '911'),
(293, 16, '新埤鄉', '925'),
(294, 16, '枋寮鄉', '940'),
(295, 16, '新園鄉', '932'),
(296, 16, '崁頂鄉', '924'),
(297, 16, '林邊鄉', '927'),
(298, 16, '南州鄉', '926'),
(299, 16, '佳冬鄉', '931'),
(300, 16, '琉球鄉', '929'),
(301, 16, '車城鄉', '944'),
(302, 16, '滿州鄉', '947'),
(303, 16, '枋山鄉', '941'),
(304, 16, '霧臺鄉', '902'),
(305, 16, '瑪家鄉', '903'),
(306, 16, '泰武鄉', '921'),
(307, 16, '來義鄉', '922'),
(308, 16, '春日鄉', '942'),
(309, 16, '獅子鄉', '943'),
(310, 16, '牡丹鄉', '945'),
(311, 16, '三地門鄉', '901'),
(312, 17, '宜蘭市', '260'),
(313, 17, '頭城鎮', '261'),
(314, 17, '羅東鎮', '265'),
(315, 17, '蘇澳鎮', '270'),
(316, 17, '礁溪鄉', '262'),
(317, 17, '壯圍鄉', '263'),
(318, 17, '員山鄉', '264'),
(319, 17, '冬山鄉', '269'),
(320, 17, '五結鄉', '268'),
(321, 17, '三星鄉', '266'),
(322, 17, '大同鄉', '267'),
(323, 17, '南澳鄉', '272'),
(324, 18, '花蓮市', '970'),
(325, 18, '鳳林鎮', '975'),
(326, 18, '玉里鎮', '981'),
(327, 18, '新城鄉', '971'),
(328, 18, '吉安鄉', '973'),
(329, 18, '壽豐鄉', '974'),
(330, 18, '光復鄉', '976'),
(331, 18, '豐濱鄉', '977'),
(332, 18, '瑞穗鄉', '978'),
(333, 18, '富里鄉', '983'),
(334, 18, '秀林鄉', '972'),
(335, 18, '萬榮鄉', '979'),
(336, 18, '卓溪鄉', '982'),
(337, 19, '臺東市', '950'),
(338, 19, '成功鎮', '961'),
(339, 19, '關山鎮', '956'),
(340, 19, '長濱鄉', '962'),
(341, 19, '池上鄉', '958'),
(342, 19, '東河鄉', '959'),
(343, 19, '鹿野鄉', '955'),
(344, 19, '卑南鄉', '954'),
(345, 19, '大武鄉', '965'),
(346, 19, '綠島鄉', '951'),
(347, 19, '太麻里鄉', '963'),
(348, 19, '海端鄉', '957'),
(349, 19, '延平鄉', '953'),
(350, 19, '金峰鄉', '964'),
(351, 19, '達仁鄉', '966'),
(352, 19, '蘭嶼鄉', '952'),
(353, 20, '馬公市', '880'),
(354, 20, '湖西鄉', '885'),
(355, 20, '白沙鄉', '884'),
(356, 20, '西嶼鄉', '881'),
(357, 20, '望安鄉', '882'),
(358, 20, '七美鄉', '883'),
(359, 21, '金城鎮', '893'),
(360, 21, '金湖鎮', '891'),
(361, 21, '金沙鎮', '890'),
(362, 21, '金寧鄉', '892'),
(363, 21, '烈嶼鄉', '894'),
(364, 21, '烏坵鄉', '896'),
(365, 22, '南竿鄉', '209'),
(366, 22, '北竿鄉', '210'),
(367, 22, '莒光鄉', '211'),
(368, 22, '東引鄉', '212');

-- --------------------------------------------------------

--
-- 資料表結構 `member_list`
--

CREATE TABLE `member_list` (
  `sid` int(11) NOT NULL,
  `account` varchar(100) DEFAULT NULL,
  `password` varchar(100) DEFAULT NULL,
  `nickname` varchar(100) DEFAULT NULL,
  `headshot` varchar(255) DEFAULT NULL,
  `birthday` date DEFAULT NULL,
  `mobile` char(10) DEFAULT NULL,
  `activated` tinyint(1) NOT NULL,
  `create_at` datetime DEFAULT NULL,
  `update_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- 傾印資料表的資料 `member_list`
--

INSERT INTO `member_list` (`sid`, `account`, `password`, `nickname`, `headshot`, `birthday`, `mobile`, `activated`, `create_at`, `update_at`) VALUES
(1, 'hdunbavin0@upenn.edu', 'h9TM9PJIcq', '碧萱', 'https://robohash.org/etestoptio.jpg?size=50x50&set=set1', '1988-04-21', '0950024261', 1, '2020-01-29 04:46:00', '2020-12-28 07:31:00'),
(2, 'lmaplesden1@oracle.com', 'EgpKoROkdhOJ', '月松', 'https://robohash.org/perferendisvoluptatumasperiores.png?size=50x50&set=set1', '1958-10-15', '0969305052', 1, '2020-01-29 11:57:00', '2020-09-19 06:32:00'),
(3, 'cpennone2@oaic.gov.au', 'IxPcDhQqy2L', '宸瑜', 'https://robohash.org/consequatursequiqui.png?size=50x50&set=set1', '1975-11-06', '0992900125', 1, '2020-09-08 10:26:00', '2020-12-12 09:29:00'),
(4, 'rbodycote3@elegantthemes.com', 'W7TyjT', '宸瑜', 'https://robohash.org/etfugased.png?size=50x50&set=set1', '1959-05-17', '0907676087', 1, '2020-10-24 07:29:00', '2020-11-20 08:24:00'),
(5, 'leads4@ezinearticles.com', 'EC5rP4', '婧涵', 'https://robohash.org/animiautodio.png?size=50x50&set=set1', '1987-04-06', '0941108758', 1, '2020-09-17 11:13:00', '2020-11-09 08:18:00'),
(6, 'eeden5@google.co.uk', 'oM6RJAjG', 'Addie', 'https://robohash.org/asperioresverovoluptatem.png?size=50x50&set=set1', '2011-02-03', '0940321693', 1, '2020-02-02 05:10:00', '2020-07-28 12:18:00'),
(7, 'rmuskett6@purevolume.com', '5lOYk3b9g', 'Van', 'https://robohash.org/quibusdammaioreset.bmp?size=50x50&set=set1', '2010-02-17', '0998449079', 1, '2020-03-03 10:42:00', '2020-05-28 04:35:00'),
(8, 'mgladbeck7@ft.com', 'yFKGxRnzxf', '王曉明', 'https://robohash.org/quiquisexcepturi.png?size=50x50&set=set1', '2012-01-11', '0950477098', 1, '2020-05-29 07:26:00', '2020-12-02 03:20:00'),
(9, 'wfallens8@amazon.com', 'wldo9j', '漫妮', 'https://robohash.org/laudantiumodioplaceat.png?size=50x50&set=set1', '2003-02-09', '0900129988', 1, '2020-01-29 03:40:00', '2020-03-01 04:17:00'),
(10, 'ssculpher9@dot.gov', '359zxDpkk4on', '宸瑜', 'https://robohash.org/odiositvoluptatum.png?size=50x50&set=set1', '2008-07-10', '0977845646', 1, '2020-04-04 07:30:00', '2020-10-16 03:26:00'),
(11, 'sdenseya@earthlink.net', 'dVn5bIQbPd', '培安', 'https://robohash.org/maximedolortotam.jpg?size=50x50&set=set1', '2017-05-21', '0999631846', 1, '2020-11-02 06:22:00', '2020-11-07 05:04:00'),
(12, 'ldenysb@pbs.org', 'OjcJ1eqvA9Uh', '皓睿', 'https://robohash.org/temporefugitvero.png?size=50x50&set=set1', '1993-09-06', '0998204231', 1, '2020-06-24 10:29:00', '2020-07-26 08:00:00'),
(13, 'ikeesmanc@japanpost.jp', 'ust3jlVEsB', '芮涵', 'https://robohash.org/quaerataliasexercitationem.jpg?size=50x50&set=set1', '1982-08-20', '0993851549', 1, '2020-10-06 04:20:00', '2020-11-24 03:14:00'),
(14, 'adomercd@noaa.gov', 'ZtVh5bVca', '俊毅', 'https://robohash.org/exetquis.png?size=50x50&set=set1', '2014-03-16', '0994409047', 1, '2020-01-06 01:54:00', '2020-09-24 10:05:00'),
(15, 'jdrayne@over-blog.com', 'xPsh6wD', '宸赫', 'https://robohash.org/eosmollitiavoluptas.png?size=50x50&set=set1', '2020-06-05', '0969406617', 1, '2020-04-11 09:16:00', '2020-06-20 05:34:00'),
(16, 'nabbottsf@t.co', 'H30vof', 'Ken', 'https://robohash.org/recusandaenullavel.png?size=50x50&set=set1', '2017-04-23', '0997720665', 1, '2020-01-18 10:00:00', '2020-08-23 03:15:00'),
(17, 'cpedderg@fastcompany.com', 'PfYoCun9', '松源', 'https://robohash.org/itaquenatussit.png?size=50x50&set=set1', '2006-02-09', '0984798314', 1, '2020-09-15 12:59:00', '2020-10-04 09:47:00'),
(18, 'saceyh@apache.org', 'Q5BNzbsU2KW', '婧涵', 'https://robohash.org/consequatursitquisquam.png?size=50x50&set=set1', '1971-01-17', '0991856229', 1, '2020-02-08 12:16:00', '2020-12-24 08:56:00'),
(19, 'imaffiottii@vinaora.com', 'l7EcwTQ6V', 'Ian', 'https://robohash.org/evenietexqui.jpg?size=50x50&set=set1', '1955-11-04', '0978852314', 1, '2020-04-12 02:51:00', '2020-07-20 06:06:00'),
(20, 'sshillingfordj@dropbox.com', 'AhFXwAtvvA', '浩霖', 'https://robohash.org/quodremaliquam.png?size=50x50&set=set1', '1954-07-28', '0964395480', 1, '2020-01-25 10:13:00', '2020-10-01 06:36:00'),
(21, 'cgadsbyk@yelp.com', 'yvlsZppwEX', '美美', 'https://robohash.org/eaeligendivoluptatem.jpg?size=50x50&set=set1', '1959-05-07', '0909277535', 1, '2020-06-13 09:51:00', '2020-11-03 09:08:00'),
(22, 'mdelgardol@reference.com', 'uZhoZBvE', '永鑫', 'https://robohash.org/quieteum.png?size=50x50&set=set1', '1980-03-27', '0906036150', 1, '2020-08-08 04:14:00', '2020-08-15 01:48:00'),
(23, 'pscarglem@engadget.com', 'Scv2G2', '香茹', 'https://robohash.org/expeditadoloremlabore.bmp?size=50x50&set=set1', '2013-05-26', '0990203645', 1, '2020-04-18 03:56:00', '2020-09-10 01:14:00'),
(24, 'nbulwardn@wordpress.com', 'QsZEhQSnB48L', 'Ray', 'https://robohash.org/estautcupiditate.bmp?size=50x50&set=set1', '1951-02-07', '0945300632', 1, '2020-11-27 04:46:00', '2020-12-11 06:35:00'),
(25, 'dperriso@cbc.ca', 'JLqMN08oRBg', '羽彤', 'https://robohash.org/repellatreiciendisipsa.bmp?size=50x50&set=set1', '1995-07-11', '0996120875', 1, '2020-07-26 05:13:00', '2020-11-23 07:45:00'),
(26, 'bkingsworthp@comcast.net', 'rSVeoRKBt', 'Eddy', 'https://robohash.org/noneapossimus.bmp?size=50x50&set=set1', '1959-06-07', '0907031560', 1, '2020-06-03 02:41:00', '2020-12-05 09:42:00'),
(27, 'kbasketterq@cyberchimps.com', 'DzQ7vLCoHe', '浩成', 'https://robohash.org/quivelesse.bmp?size=50x50&set=set1', '1953-06-07', '0942285945', 1, '2020-03-05 11:07:00', '2020-09-21 12:44:00'),
(28, 'cnairner@networksolutions.com', 'p5C2ZWcdWX', '浩辰', 'https://robohash.org/voluptatemilloet.png?size=50x50&set=set1', '1965-08-11', '0966795707', 1, '2020-01-27 06:42:00', '2020-08-24 09:28:00'),
(29, 'rgwinns@cyberchimps.com', 'wTvOYCVqBZz', '尚霖', 'https://robohash.org/inventorecorporisvelit.bmp?size=50x50&set=set1', '1985-11-11', '0944276209', 1, '2020-04-02 01:17:00', '2020-06-11 01:56:00'),
(30, 'hcradduckt@forbes.com', 'ir8YOb', 'Tina', 'https://robohash.org/adsaepetemporibus.jpg?size=50x50&set=set1', '2014-08-19', '0906159892', 1, '2020-04-23 07:14:00', '2020-07-13 10:07:00'),
(31, 'hcharlinu@topsy.com', 'jNmxJSXEftJ', '永鑫', 'https://robohash.org/molestiascumquedolorem.jpg?size=50x50&set=set1', '2020-03-04', '0904191237', 1, '2020-04-05 13:00:00', '2020-11-17 11:55:00'),
(32, 'gmarielv@rakuten.co.jp', '75Vpf5swS7a0', '秉皓', 'https://robohash.org/odionecessitatibusaccusamus.bmp?size=50x50&set=set1', '1960-11-25', '0983699638', 1, '2020-07-01 11:55:00', '2020-08-16 02:47:00'),
(33, 'rchessonw@wordpress.com', 'A4W3K9ZVf2', '若含', 'https://robohash.org/cupiditateminusquasi.bmp?size=50x50&set=set1', '1966-10-02', '0994550161', 1, '2020-02-17 03:15:00', '2020-06-20 03:47:00'),
(34, 'aclemettx@go.com', 'y3mrUv', '香晴', 'https://robohash.org/sintsitullam.png?size=50x50&set=set1', '1976-01-09', '0904625541', 1, '2020-10-23 12:51:00', '2020-10-25 12:12:00'),
(35, 'bbriertony@cbsnews.com', '0L9gW7', '芷若', 'https://robohash.org/quiaoptiovoluptate.jpg?size=50x50&set=set1', '2000-03-06', '0997097052', 1, '2020-11-01 05:27:00', '2020-12-11 10:58:00'),
(36, 'mcurtissz@europa.eu', '5I4vlQpdTAA', '澄泓', 'https://robohash.org/cupiditatequisest.png?size=50x50&set=set1', '2020-07-16', '0996339804', 1, '2020-03-10 01:18:00', '2020-10-19 02:13:00'),
(37, 'mdhennin10@cafepress.com', 'eh1KuT', '永鑫', 'https://robohash.org/placeataliquamsuscipit.bmp?size=50x50&set=set1', '2001-09-09', '0901080681', 1, '2020-02-26 01:04:00', '2020-07-08 08:51:00'),
(38, 'smarshall11@marriott.com', 'oJdTMYA8tFl8', '俞明', 'https://robohash.org/quiaperiamerror.bmp?size=50x50&set=set1', '2016-09-01', '0906350057', 1, '2020-05-23 01:30:00', '2020-06-13 09:21:00'),
(39, 'gmatushenko12@huffingtonpost.com', '7mdvhsEYa', '浩成', 'https://robohash.org/namoccaecatinon.bmp?size=50x50&set=set1', '1997-10-01', '0991541488', 1, '2020-01-26 06:55:00', '2020-06-23 03:39:00'),
(40, 'bmains13@forbes.com', 'uKe2yuteZjoC', '墨含', 'https://robohash.org/etaddistinctio.png?size=50x50&set=set1', '1956-02-20', '0967698758', 1, '2020-02-02 03:48:00', '2020-06-30 12:15:00'),
(41, 'fpelos14@jiathis.com', 'bKDMaAMkn', '孜然', 'https://robohash.org/velitnihilnon.png?size=50x50&set=set1', '1956-04-04', '0947002214', 1, '2020-06-15 02:13:00', '2020-08-04 01:18:00'),
(42, 'cbryson15@ezinearticles.com', 'KESKSRb3kj8', '王楠', 'https://robohash.org/nullaquidoloribus.png?size=50x50&set=set1', '1963-06-18', '0991600458', 1, '2020-06-09 03:09:00', '2020-07-29 01:16:00'),
(43, 'jchesworth16@netvibes.com', 'LSj8W5', '俞天', 'https://robohash.org/commodiliberolaboriosam.jpg?size=50x50&set=set1', '2001-10-13', '0902364008', 1, '2020-04-06 07:00:00', '2020-08-12 06:00:00'),
(44, 'mdragonette17@plala.or.jp', 'yj5D2j2gkQ', '尹智', 'https://robohash.org/accusamusnullaeaque.png?size=50x50&set=set1', '1961-01-02', '0997390909', 1, '2020-04-06 05:02:00', '2020-12-05 09:09:00'),
(45, 'nduhig18@scientificamerican.com', 'y2TZl4ldRoN8', '若瑾', 'https://robohash.org/laborumvoluptatemarchitecto.jpg?size=50x50&set=set1', '1964-04-09', '0907833214', 1, '2020-06-26 07:39:00', '2020-07-05 08:51:00'),
(46, 'gleifer19@ucsd.edu', 'gCLyfZG7O', '展博', 'https://robohash.org/doloreomniseum.png?size=50x50&set=set1', '1989-11-12', '0995534025', 1, '2020-03-21 07:10:00', '2020-11-22 01:31:00'),
(47, 'cpettersen1a@opensource.org', 'VZgJvnQqbs6', '墨含', 'https://robohash.org/quaerattemporanon.png?size=50x50&set=set1', '1989-02-18', '0969252466', 1, '2020-07-04 04:15:00', '2020-09-22 06:37:00'),
(48, 'ibruntjen1b@unc.edu', 'TV9ODhM', '浩宇', 'https://robohash.org/voluptatumautconsequuntur.jpg?size=50x50&set=set1', '2020-01-11', '0902731362', 1, '2020-02-13 01:47:00', '2020-08-14 02:37:00'),
(49, 'njozsef1c@google.ca', 'hystbIYIsdpN', 'David', 'https://robohash.org/doloraliquamut.bmp?size=50x50&set=set1', '2017-08-12', '0981404363', 1, '2020-03-26 11:46:00', '2020-06-11 01:59:00'),
(50, 'ruebel1d@foxnews.com', '0dsCo2GY', '若瑾', 'https://robohash.org/minusrerumnesciunt.png?size=50x50&set=set1', '1975-05-21', '0951745963', 1, '2020-05-10 01:23:00', '2020-07-27 12:14:00'),
(51, 'btatershall1e@answers.com', 'k65M5lM', 'Pan', 'https://robohash.org/iustoquastenetur.png?size=50x50&set=set1', '1971-06-17', '0997678348', 1, '2020-03-26 09:15:00', '2020-11-18 04:06:00'),
(52, 'karchbold1f@hostgator.com', '6a2Oq5I', '昕磊', 'https://robohash.org/quaelaboreautem.png?size=50x50&set=set1', '2016-06-17', '0905003526', 1, '2020-01-26 12:32:00', '2020-06-06 01:53:00'),
(53, 'doughton1g@comsenz.com', 'ntZhib', '正梅', 'https://robohash.org/iureomnisrerum.png?size=50x50&set=set1', '1977-10-24', '0948290516', 1, '2020-04-01 09:02:00', '2020-10-10 12:23:00'),
(54, 'stwigg1h@discovery.com', 'PXqPfJ4', '浩成', 'https://robohash.org/doloresvoluptatequisquam.jpg?size=50x50&set=set1', '1956-03-16', '0902288891', 1, '2020-05-26 08:25:00', '2020-11-23 01:23:00'),
(55, 'ylutzmann1i@elegantthemes.com', 'T1ezCWiw', '琪煜', 'https://robohash.org/repudiandaequiaprovident.bmp?size=50x50&set=set1', '1979-10-04', '0978003860', 1, '2020-11-28 10:28:00', '2020-12-20 08:31:00'),
(56, 'ebletsoe1j@earthlink.net', '03Vvf9u22Fh', '奕漳', 'https://robohash.org/similiqueautearum.bmp?size=50x50&set=set1', '1954-11-15', '0967516635', 1, '2020-04-04 08:43:00', '2020-10-13 05:44:00'),
(57, 'abingley1k@whitehouse.gov', 'RYmHhUe3hm', '欣妍', 'https://robohash.org/accusantiuminnumquam.png?size=50x50&set=set1', '2010-01-15', '0984124577', 1, '2020-02-04 07:47:00', '2020-04-20 05:56:00'),
(58, 'dmcfall1l@pbs.org', 'oNjoACIwd', '松源', 'https://robohash.org/autemtemporain.bmp?size=50x50&set=set1', '1959-03-02', '0901644794', 1, '2020-07-07 09:43:00', '2020-11-30 01:58:00'),
(59, 'dheber1m@hud.gov', '9WRitVvLyInH', '澄泓', 'https://robohash.org/aliasexplicaboimpedit.jpg?size=50x50&set=set1', '1955-05-13', '0959557391', 1, '2020-03-06 09:14:00', '2020-10-09 06:07:00'),
(60, 'aadamolli1n@icq.com', 'D06YooMx2g', 'Alice', 'https://robohash.org/nihilquiacumque.png?size=50x50&set=set1', '1966-07-03', '0957102104', 1, '2020-08-30 10:45:00', '2020-10-10 02:07:00'),
(61, 'cuden1o@taobao.com', 'jouXd0031EZ', '婧涵', 'https://robohash.org/nisidoloribustenetur.bmp?size=50x50&set=set1', '1994-04-24', '0980084521', 1, '2020-03-18 08:34:00', '2020-07-13 01:50:00'),
(62, 'cfike1p@histats.com', 'jiwfUGY6', '雪怡', 'https://robohash.org/nostrumfacilisexercitationem.bmp?size=50x50&set=set1', '1981-10-05', '0980818844', 1, '2020-01-07 05:29:00', '2020-09-30 11:04:00'),
(63, 'chospital1q@google.com.au', 'd8YEHFMv2x', 'william', 'https://robohash.org/pariaturitaqueet.png?size=50x50&set=set1', '2015-01-17', '0977668117', 1, '2020-05-13 08:33:00', '2020-11-19 02:29:00'),
(64, 'cvasnev1r@reuters.com', 'RHxMg9', 'Yvonne', 'https://robohash.org/istevoluptatibusporro.bmp?size=50x50&set=set1', '1962-11-08', '0902690064', 1, '2020-01-05 09:33:00', '2020-03-06 12:02:00'),
(65, 'rralton1s@guardian.co.uk', 'prKUmw', '博裕', 'https://robohash.org/quisminusdeserunt.jpg?size=50x50&set=set1', '2012-06-29', '0950971903', 1, '2020-01-28 03:24:00', '2020-11-10 04:40:00'),
(66, 'hgatley1t@webnode.com', '72VHVIZlb', '尹智', 'https://robohash.org/repellatinciduntexpedita.bmp?size=50x50&set=set1', '1970-09-03', '0984216162', 1, '2020-03-02 03:45:00', '2020-08-03 09:01:00'),
(67, 'mvenn1u@webs.com', '9rnDcxw2', '宸瑜', 'https://robohash.org/sitetet.png?size=50x50&set=set1', '1984-02-13', '0949053606', 1, '2020-01-24 04:04:00', '2020-04-24 11:57:00'),
(68, 'naizikovitch1v@netscape.com', 'bIvCQ0cHg', '明美', 'https://robohash.org/quasiaccusamusut.jpg?size=50x50&set=set1', '2007-02-25', '0994474445', 1, '2020-02-20 08:20:00', '2020-09-26 06:42:00'),
(69, 'wshotboulte1w@amazon.de', 'XLdgM9WUKnr', '漫妮', 'https://robohash.org/odioillumperspiciatis.jpg?size=50x50&set=set1', '1969-02-08', '0900798115', 1, '2020-06-28 10:54:00', '2020-12-20 12:00:00'),
(70, 'lpollard1x@fotki.com', 'RhLSmZ8Dx', '宇涵', 'https://robohash.org/perspiciatisvoluptatemcommodi.jpg?size=50x50&set=set1', '1990-04-06', '0946423292', 1, '2020-10-07 07:34:00', '2020-10-26 11:55:00'),
(71, 'belham1y@aol.com', 'ceJVDfxZMSB', 'Ray', 'https://robohash.org/nihiloccaecatiqui.png?size=50x50&set=set1', '1958-11-30', '0998155622', 1, '2020-04-04 05:05:00', '2020-05-30 03:13:00'),
(72, 'bhiner1z@mlb.com', 'ujWKWbvgCV', '尹智', 'https://robohash.org/eospariaturdolores.jpg?size=50x50&set=set1', '1966-12-13', '0943195982', 1, '2020-06-09 12:16:00', '2020-08-16 08:41:00'),
(73, 'avizard20@comsenz.com', 'zyPqikucw2k', '睿杰', 'https://robohash.org/atexpeditaqui.bmp?size=50x50&set=set1', '1993-09-08', '0978231983', 1, '2020-06-05 01:43:00', '2020-08-09 03:36:00'),
(74, 'echazier21@blogger.com', 'Dt7Yjjm', '睿杰', 'https://robohash.org/magnialiquamoccaecati.jpg?size=50x50&set=set1', '2017-09-26', '0941358037', 1, '2020-03-02 09:31:00', '2020-06-08 12:10:00'),
(75, 'gmilkins22@aol.com', 'jgjfsAjBy', '凰羽', 'https://robohash.org/molestiaesedest.bmp?size=50x50&set=set1', '1990-11-11', '0992432084', 1, '2020-04-04 07:40:00', '2020-11-25 02:38:00'),
(76, 'mreach23@slate.com', 'b7HHjv', '梓彤', 'https://robohash.org/eumplaceatipsa.jpg?size=50x50&set=set1', '1977-09-19', '0984378102', 1, '2020-03-02 06:16:00', '2020-11-24 01:41:00'),
(77, 'fmordacai24@yahoo.com', 'GrKgchop21B6', '若瑾', 'https://robohash.org/estquodbeatae.bmp?size=50x50&set=set1', '1966-05-28', '0948959047', 1, '2020-04-24 06:55:00', '2020-06-26 09:55:00'),
(78, 'rcheine25@uol.com.br', '5ArofZwg', 'Elaine', 'https://robohash.org/magninemout.png?size=50x50&set=set1', '2010-11-22', '0957944390', 1, '2020-03-30 07:56:00', '2020-07-28 03:16:00'),
(79, 'bhamnet26@fc2.com', 'amlbZ7y1veb', '泰霖', 'https://robohash.org/avoluptatibusvoluptates.bmp?size=50x50&set=set1', '1977-02-16', '0967717405', 1, '2020-04-13 12:47:00', '2020-06-26 06:26:00'),
(80, 'mbright27@stanford.edu', 'dW2QQ2', '宸瑜', 'https://robohash.org/distinctioexpeditaconsequatur.jpg?size=50x50&set=set1', '1966-08-15', '0959470424', 1, '2020-03-09 07:52:00', '2020-03-17 12:37:00'),
(81, 'psonier28@businesswire.com', 'g4SuM1p', 'James', 'https://robohash.org/aliquamdignissimossit.png?size=50x50&set=set1', '1994-10-23', '0981533532', 1, '2020-02-07 01:10:00', '2020-05-20 03:42:00'),
(82, 'esurmeyer29@woothemes.com', 'knP5Ed', '秉皓', 'https://robohash.org/temporibusculpaveritatis.jpg?size=50x50&set=set1', '1970-05-06', '0977838953', 1, '2020-05-13 08:20:00', '2020-09-12 11:45:00'),
(83, 'nsealeaf2a@mysql.com', 'Anca4i', '宇涵', 'https://robohash.org/autemdistinctioullam.png?size=50x50&set=set1', '1964-07-12', '0967478510', 1, '2020-08-11 03:42:00', '2020-09-29 06:03:00'),
(84, 'bgolley2b@hud.gov', '5euHqBCg', '亦涵', 'https://robohash.org/assumendalaudantiumporro.jpg?size=50x50&set=set1', '1961-07-28', '0975162054', 1, '2020-06-08 10:51:00', '2020-06-13 08:57:00'),
(85, 'ygubbin2c@unblog.fr', 'UALNgQmw', 'Peter', 'https://robohash.org/eumnamtotam.jpg?size=50x50&set=set1', '1983-03-07', '0948030479', 1, '2020-10-02 06:24:00', '2020-11-15 05:03:00'),
(86, 'rdepport2d@meetup.com', 'f3IGyA', 'vanesssa', 'https://robohash.org/oditetlibero.jpg?size=50x50&set=set1', '1990-04-24', '0978842761', 1, '2020-04-11 11:53:00', '2020-11-14 10:37:00'),
(87, 'ckrolle2e@wikimedia.org', 'OPtUM7', 'Ian', 'https://robohash.org/blanditiisrecusandaeamet.bmp?size=50x50&set=set1', '1986-05-27', '0940903020', 1, '2020-07-15 08:35:00', '2020-12-15 07:46:00'),
(88, 'tdivis2f@mozilla.org', 'idVaH2Sv', '松源', 'https://robohash.org/doloresblanditiisvoluptas.jpg?size=50x50&set=set1', '2003-03-10', '0904342300', 1, '2020-03-14 10:01:00', '2020-08-08 05:01:00'),
(89, 'dvurley2g@jigsy.com', '5YzNV36Qp', '若瑾', 'https://robohash.org/porrodoloremvero.png?size=50x50&set=set1', '2016-01-13', '0985314803', 1, '2020-01-02 08:09:00', '2020-06-19 02:47:00'),
(90, 'tfarnhill2h@taobao.com', 'MlS0MXZmi', '丰逸', 'https://robohash.org/ullamquaeratrepudiandae.png?size=50x50&set=set1', '1975-01-28', '0957118297', 1, '2020-03-09 05:42:00', '2020-04-19 05:22:00'),
(91, 'espinley2i@twitpic.com', 'z8Udqo', '尚偉', 'https://robohash.org/ullamvoluptasducimus.jpg?size=50x50&set=set1', '1968-07-20', '0979882690', 1, '2020-01-29 02:48:00', '2020-02-25 02:02:00'),
(92, 'akelsow2j@cocolog-nifty.com', 'c8UUKig', '雅芙', 'https://robohash.org/nonpariaturconsequatur.png?size=50x50&set=set1', '1953-09-13', '0978906303', 1, '2020-03-19 02:06:00', '2020-06-04 07:23:00'),
(93, 'kworcs2k@ed.gov', 'O1jIRnM', '品逸', 'https://robohash.org/etblanditiislabore.png?size=50x50&set=set1', '1969-10-20', '0978328192', 1, '2020-10-17 09:03:00', '2020-12-03 11:00:00'),
(94, 'awooder2l@spiegel.de', 'LR9TrNshmic', '梓彤', 'https://robohash.org/solutanobisreprehenderit.bmp?size=50x50&set=set1', '1951-10-04', '0979353309', 1, '2020-09-17 03:24:00', '2020-11-05 02:52:00'),
(95, 'mbubbins2m@jalbum.net', '6UPGWUwNA7R2', '睿杰', 'https://robohash.org/assumendacumvoluptatem.bmp?size=50x50&set=set1', '2006-11-22', '0943780497', 1, '2020-02-06 05:29:00', '2020-06-18 05:17:00'),
(96, 'maddenbrooke2n@php.net', 'a2SP0vccsIB', '璟雯', 'https://robohash.org/corporiseamaiores.png?size=50x50&set=set1', '2016-06-24', '0908615051', 1, '2020-01-06 03:46:00', '2020-11-16 07:35:00'),
(97, 'bbeadham2o@shareasale.com', 'zgbUSr', '可晴', 'https://robohash.org/eaquiharum.jpg?size=50x50&set=set1', '2007-01-11', '0965135352', 1, '2020-11-30 08:31:00', '2020-12-23 04:06:00'),
(98, 'pcrauford2p@cargocollective.com', 'DndjWk', '雨婷', 'https://robohash.org/inventoresedullam.png?size=50x50&set=set1', '1977-02-02', '0993984837', 1, '2020-01-04 04:08:00', '2020-02-18 06:48:00'),
(99, 'aloisi2q@flickr.com', 'FXVtli', '昱漳', 'https://robohash.org/suscipitlaborumid.bmp?size=50x50&set=set1', '1994-04-10', '0992196343', 1, '2020-04-03 11:40:00', '2020-09-20 02:00:00'),
(100, 'smalicki2r@buzzfeed.com', 'Dk4eOd', '彤雨', 'https://robohash.org/eosutid.png?size=50x50&set=set1', '1988-09-15', '0959638567', 1, '2020-03-12 12:44:00', '2020-06-11 07:01:00');

--
-- 已傾印資料表的索引
--

--
-- 資料表索引 `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`sid`);

--
-- 資料表索引 `member_address`
--
ALTER TABLE `member_address`
  ADD PRIMARY KEY (`sid`),
  ADD KEY `member_sid` (`member_sid`),
  ADD KEY `counties_sid` (`counties_sid`),
  ADD KEY `district_sid` (`district_sid`);

--
-- 資料表索引 `member_counties`
--
ALTER TABLE `member_counties`
  ADD PRIMARY KEY (`sid`);

--
-- 資料表索引 `member_districts`
--
ALTER TABLE `member_districts`
  ADD PRIMARY KEY (`sid`),
  ADD KEY `counties_sid` (`counties_sid`);

--
-- 資料表索引 `member_list`
--
ALTER TABLE `member_list`
  ADD PRIMARY KEY (`sid`);

--
-- 在傾印的資料表使用自動遞增(AUTO_INCREMENT)
--

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `admins`
--
ALTER TABLE `admins`
  MODIFY `sid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `member_address`
--
ALTER TABLE `member_address`
  MODIFY `sid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=51;

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `member_counties`
--
ALTER TABLE `member_counties`
  MODIFY `sid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `member_districts`
--
ALTER TABLE `member_districts`
  MODIFY `sid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=369;

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `member_list`
--
ALTER TABLE `member_list`
  MODIFY `sid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=101;

--
-- 已傾印資料表的限制式
--

--
-- 資料表的限制式 `member_address`
--
ALTER TABLE `member_address`
  ADD CONSTRAINT `member_address_ibfk_1` FOREIGN KEY (`member_sid`) REFERENCES `member_list` (`sid`),
  ADD CONSTRAINT `member_address_ibfk_2` FOREIGN KEY (`counties_sid`) REFERENCES `member_counties` (`sid`),
  ADD CONSTRAINT `member_address_ibfk_3` FOREIGN KEY (`district_sid`) REFERENCES `member_districts` (`sid`);

--
-- 資料表的限制式 `member_districts`
--
ALTER TABLE `member_districts`
  ADD CONSTRAINT `member_districts_ibfk_1` FOREIGN KEY (`counties_sid`) REFERENCES `member_counties` (`sid`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
