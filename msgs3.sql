-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- 主機： 127.0.0.1
-- 產生時間： 2024-07-29 05:11:37
-- 伺服器版本： 10.4.32-MariaDB
-- PHP 版本： 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- 資料庫： `testphp`
--

-- --------------------------------------------------------

--
-- 資料表結構 `msgs`
--

CREATE TABLE `msgs3` (
  `id` int(11) NOT NULL,
  `name` varchar(30) NOT NULL,
  `category` int(3) DEFAULT NULL,
  `content` text NOT NULL,
  `createTime` datetime NOT NULL DEFAULT current_timestamp(),
  `modifyTime` datetime DEFAULT NULL,
  `endTime` datetime DEFAULT NULL,
  `isValid` int(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- 傾印資料表的資料 `msgs`
--

INSERT INTO `msgs3` (`id`, `name`, `category`, `content`, `createTime`, `modifyTime`, `endTime`, `isValid`) VALUES
(1, 'Ben', 2, '今天便當不好吃', '2024-07-26 14:19:56', NULL, NULL, 1),
(2, 'Ben', 2, '今天咖啡不好喝', '2024-07-26 14:29:23', NULL, NULL, 1),
(3, 'Mary', 1, '今天天氣不好', '2024-07-26 14:43:48', NULL, NULL, 1),
(14, 'Mary', 1, 'Mary來了', '2024-07-27 11:07:49', '2024-07-29 09:50:14', NULL, 1),
(15, 'Ben', 2, '露易莎竟然不用開發票', '2024-07-27 11:13:23', '2024-07-27 16:31:52', NULL, 1),
(16, 'Ben', 2, '生椰美式', '2024-07-27 11:16:32', '2024-07-27 15:30:07', NULL, 1),
(17, 'Ben', 1, '希望不要淹水', '2024-07-27 11:20:14', NULL, NULL, 1),
(22, 'Ben', 3, '喜歡看異世界轉生有魔法有建設的故事', '2024-07-29 08:22:51', NULL, NULL, 1),
(23, 'Mary', 3, '喜歡看反派千金類型的故事', '2024-07-29 08:27:23', NULL, NULL, 1),
(24, 'Ben', 4, '最近看的漫畫是迷宮飯完結篇', '2024-07-29 08:27:23', NULL, NULL, 1),
(25, 'Mary', 3, '小書痴的下剋上不錯看', '2024-07-29 08:27:23', NULL, NULL, 1),
(26, 'Ben', 2, '連續第四天生椰美式', '2024-07-29 08:27:23', NULL, NULL, 1),
(27, 'Ben', 2, '對面那家越式一點都不越式，雷', '2024-07-29 08:27:23', NULL, NULL, 1),
(28, 'Ben', 1, '台北的課快結束了，要回到沒便當店沒生椰咖啡的據點了', '2024-07-29 08:28:54', NULL, NULL, 1),
(29, 'Mary', 2, '五桐號的太妃糖珍珠真是邪惡', '2024-07-29 08:28:54', NULL, NULL, 1),
(30, 'Ben', 1, '今天很熱', '2024-07-29 09:05:35', NULL, NULL, 1),
(31, 'Mary', 1, '追劇好累', '2024-07-29 09:07:51', NULL, NULL, 1),
(32, 'Ben', 3, '進行諸島的賢者系列小說好看', '2024-07-29 09:09:40', NULL, NULL, 1),
(33, 'Ben', 3, '沙丘小說有夠難啃的, 名字很長很難記', '2024-07-29 09:10:12', NULL, NULL, 1),
(34, 'Mary', 1, '一下學太多要炸了啦', '2024-07-29 09:23:55', NULL, NULL, 1),
(35, 'Ben', 1, '大家的字體都調好小, 眼睛要花了', '2024-07-29 09:24:25', NULL, NULL, 1),
(36, 'Mary', 1, '好像胖了', '2024-07-29 10:39:34', NULL, NULL, 1),
(37, 'Ben', 1, '這樣還沒瘦!!', '2024-07-29 10:39:51', NULL, NULL, 1),
(38, 'Ben', 1, '天很藍', '2024-07-29 10:40:12', NULL, NULL, 1),
(39, 'Ben', 1, '需要有支可用esim的手機', '2024-07-29 10:40:36', NULL, NULL, 1);

--
-- 已傾印資料表的索引
--

--
-- 資料表索引 `msgs`
--
ALTER TABLE `msgs`
  ADD PRIMARY KEY (`id`);

--
-- 在傾印的資料表使用自動遞增(AUTO_INCREMENT)
--

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `msgs`
--
ALTER TABLE `msgs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
