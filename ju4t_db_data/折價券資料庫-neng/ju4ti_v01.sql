-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- 主機： 127.0.0.1
-- 產生時間： 2020-12-22 11:37:31
-- 伺服器版本： 10.4.17-MariaDB
-- PHP 版本： 7.3.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- 資料庫： `ju4ti`
--

-- --------------------------------------------------------

--
-- 資料表結構 `awards`
--

CREATE TABLE `awards` (
  `sid` int(11) NOT NULL,
  `prize` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- 傾印資料表的資料 `awards`
--

INSERT INTO `awards` (`sid`, `prize`) VALUES
(1, '9折優惠券'),
(2, '8折優惠券'),
(3, '7折優惠券');

-- --------------------------------------------------------

--
-- 資料表結構 `awards_detail`
--

CREATE TABLE `awards_detail` (
  `sid` int(11) NOT NULL,
  `member_sid` int(11) NOT NULL,
  `prize_sid` int(11) NOT NULL,
  `created_at` date NOT NULL,
  `deadline` datetime NOT NULL,
  `used` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- 傾印資料表的資料 `awards_detail`
--

INSERT INTO `awards_detail` (`sid`, `member_sid`, `prize_sid`, `created_at`, `deadline`, `used`) VALUES
(2, 2, 1, '2020-12-16', '2020-12-16 16:03:02', 0),
(3, 2, 3, '2020-12-16', '2020-12-16 16:03:02', 0),
(4, 3, 4, '2020-12-16', '2020-12-16 16:03:02', 0),
(5, 2, 2, '2020-12-16', '2020-12-16 16:03:02', 0),
(6, 1, 4, '2020-12-16', '2020-12-16 16:03:02', 0),
(7, 4, 3, '2020-12-16', '2020-12-16 16:03:02', 0),
(8, 5, 1, '2020-12-16', '2020-12-16 16:03:02', 0),
(9, 6, 3, '2020-12-16', '2020-12-16 16:03:02', 0),
(10, 1, 3, '2020-12-16', '2020-12-16 16:03:02', 0),
(11, 2, 2, '2020-12-16', '2020-12-16 16:03:02', 0),
(12, 1, 4, '2020-12-16', '2020-12-16 16:03:02', 0),
(16, 1, 1, '2020-12-31', '2020-12-03 00:00:00', 1),
(17, 0, 0, '0000-00-00', '0000-00-00 00:00:00', 0),
(18, 1, 1, '0000-00-00', '0000-00-00 00:00:00', 1),
(20, 0, 0, '0000-00-00', '0000-00-00 00:00:00', 0),
(32, 555, 5, '2020-12-22', '2023-10-17 00:00:00', 0);

--
-- 已傾印資料表的索引
--

--
-- 資料表索引 `awards`
--
ALTER TABLE `awards`
  ADD PRIMARY KEY (`sid`);

--
-- 資料表索引 `awards_detail`
--
ALTER TABLE `awards_detail`
  ADD PRIMARY KEY (`sid`);

--
-- 在傾印的資料表使用自動遞增(AUTO_INCREMENT)
--

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `awards`
--
ALTER TABLE `awards`
  MODIFY `sid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `awards_detail`
--
ALTER TABLE `awards_detail`
  MODIFY `sid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
