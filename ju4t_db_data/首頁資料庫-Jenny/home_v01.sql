-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- 主機： 127.0.0.1
-- 產生時間： 2020-12-18 10:14:02
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
-- 資料表結構 `home_hero_img`
--

CREATE TABLE `home_hero_img` (
  `sid` int(11) NOT NULL,
  `picture` varchar(50) DEFAULT NULL,
  `description` varchar(50) NOT NULL,
  `view` tinyint(1) DEFAULT NULL,
  `created_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- 傾印資料表的資料 `home_hero_img`
--

INSERT INTO `home_hero_img` (`sid`, `picture`, `description`, `view`, `created_at`) VALUES
(1, NULL, 'first', 1, '2020-12-17 10:24:12'),
(2, NULL, 'second', 1, '2020-12-17 17:17:53'),
(3, NULL, 'third', 1, '2020-12-17 17:29:05'),
(4, NULL, 'fourth', 1, '2020-12-17 17:31:53'),
(5, NULL, 'fifth', 1, '2020-12-17 17:40:50');

--
-- 已傾印資料表的索引
--

--
-- 資料表索引 `home_hero_img`
--
ALTER TABLE `home_hero_img`
  ADD PRIMARY KEY (`sid`);

--
-- 在傾印的資料表使用自動遞增(AUTO_INCREMENT)
--

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `home_hero_img`
--
ALTER TABLE `home_hero_img`
  MODIFY `sid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
