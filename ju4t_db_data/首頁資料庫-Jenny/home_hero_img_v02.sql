-- phpMyAdmin SQL Dump
-- version 5.0.3
-- https://www.phpmyadmin.net/
--
-- 主機： 127.0.0.1
-- 產生時間： 2020-12-24 05:45:12
-- 伺服器版本： 10.4.14-MariaDB
-- PHP 版本： 7.2.34

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- 資料庫： `ju4t_midterm`
--

-- --------------------------------------------------------

--
-- 資料表結構 `home_hero_img`
--

CREATE TABLE `home_hero_img` (
  `sid` int(11) NOT NULL,
  `picture` varchar(50) NOT NULL,
  `description` varchar(50) NOT NULL,
  `view` tinyint(1) DEFAULT NULL,
  `created_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- 傾印資料表的資料 `home_hero_img`
--

INSERT INTO `home_hero_img` (`sid`, `picture`, `description`, `view`, `created_at`) VALUES
(1, '5fe2ba922ee58.png', 'first', 1, '2020-12-23 11:33:38'),
(2, '5fe2e3547e1d1.png', 'second', 1, '2020-12-23 14:27:32'),
(3, '5fe303e39d263.png', 'third', 1, '2020-12-23 16:46:27'),
(4, '5fe3fbba7ea54.png', 'fourth', 1, '2020-12-24 10:23:54'),
(5, '5fe4051eab75b.png', 'fifth', 1, '2020-12-24 11:11:53'),
(6, '5fe40a54e3d6a.png', 'six', 1, '2020-12-24 11:26:12'),
(7, '5fe40a6ed4463.png', 'seven', 0, '2020-12-24 11:26:38'),
(8, '5fe40a8969b5d.png', 'eight', 1, '2020-12-24 11:27:05'),
(9, '5fe3eb3bf0a6b.png', 'nine', 1, '2020-12-24 11:27:20'),
(10, '5fe403ad96bf2.png', 'ten', 0, '2020-12-24 10:57:49'),
(11, '5fe407bb1126b.png', 'eleven', 1, '2020-12-24 11:27:35'),
(12, '5fe40aea2d07e.png', 'twelve', 0, '2020-12-24 11:28:42');

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
  MODIFY `sid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
