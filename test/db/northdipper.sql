-- phpMyAdmin SQL Dump
-- version 4.8.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: 2018 年 8 月 12 日 07:08
-- サーバのバージョン： 5.7.22-log
-- PHP Version: 5.6.34

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `northdipper`
--

-- --------------------------------------------------------

--
-- テーブルの構造 `followings`
--

CREATE TABLE `followings` (
  `userid` varchar(255) NOT NULL,
  `following_userid` varchar(255) NOT NULL,
  `following_time` timestamp NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- テーブルのデータのダンプ `followings`
--

INSERT INTO `followings` (`userid`, `following_userid`, `following_time`) VALUES
('ando', 'endo', '2018-08-11 20:43:36'),
('ando', 'itakura', '2018-08-11 20:53:36'),
('ando', 'kamei', '2018-08-11 21:12:36'),
('ando', 'kenzaki', '2018-08-11 21:25:36'),
('ando', 'kinoshita', '2018-08-11 22:10:35'),
('ando', 'kobayashi', '2018-08-11 21:43:46'),
('ando', 'kubota', '2018-08-11 22:03:36'),
('ando', 'ozaki', '2018-08-11 22:04:12'),
('ando', 'sato', '2018-08-11 22:05:36'),
('ando', 'shimura', '2018-08-11 22:06:44'),
('ando', 'uematshu', '2018-08-11 22:07:51'),
('endo', 'ando', '2018-08-11 20:43:36'),
('itakura', 'ando', '2018-08-11 20:53:36'),
('kamei', 'ando', '2018-08-11 21:12:36'),
('kenzaki', 'ando', '2018-08-11 21:25:36'),
('kinoshita', 'ando', '2018-08-11 22:10:35'),
('kobayashi', 'ando', '2018-08-11 21:43:46'),
('kubota', 'ando', '2018-08-11 22:03:36'),
('ozaki', 'ando', '2018-08-11 22:04:12'),
('sato', 'ando', '2018-08-11 22:05:36'),
('shimura', 'ando', '2018-08-11 22:06:44'),
('uematshu', 'ando', '2018-08-11 22:07:51');

-- --------------------------------------------------------

--
-- テーブルの構造 `tweets`
--

CREATE TABLE `tweets` (
  `id` int(11) NOT NULL,
  `userid` varchar(255) NOT NULL,
  `sentence` varchar(255) NOT NULL,
  `created_time` timestamp NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- テーブルのデータのダンプ `tweets`
--

INSERT INTO `tweets` (`id`, `userid`, `sentence`, `created_time`) VALUES
(36, 'ando', '初めてのツイート', '2018-08-11 21:21:11'),
(37, 'ando', '二回目のツイート', '2018-08-11 21:21:19'),
(38, 'ando', 'http://example.com', '2018-08-11 21:21:35'),
(39, 'ando', 'URLがきちんとリンクになるか', '2018-08-11 21:21:48'),
(40, 'ando', 'テストツイート1', '2018-08-11 21:22:16'),
(41, 'ando', 'テストツイート2', '2018-08-11 21:22:25'),
(42, 'ando', 'テストツイート3', '2018-08-11 21:22:29'),
(43, 'ando', 'テストツイート4', '2018-08-11 21:22:32'),
(44, 'ando', 'テストツイート5', '2018-08-11 21:22:36'),
(45, 'ando', 'テストツイート6', '2018-08-11 21:22:40'),
(46, 'ando', 'テストツイート7', '2018-08-11 21:22:47'),
(47, 'endo', '初めてのツイート', '2018-08-11 21:23:30'),
(48, 'endo', 'http://endo.com', '2018-08-11 21:23:46'),
(49, 'endo', 'リンク > https://hogehoge.com', '2018-08-11 21:24:15');

-- --------------------------------------------------------

--
-- テーブルの構造 `users`
--

CREATE TABLE `users` (
  `userid` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `mailaddress` varchar(255) NOT NULL,
  `created_time` timestamp NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- テーブルのデータのダンプ `users`
--

INSERT INTO `users` (`userid`, `username`, `password`, `mailaddress`, `created_time`) VALUES
('ando', 'ando', '$2y$10$IyMje1.KyQbJTRl9YNAZf.CZ3SxUf.pUAm0754L9Fe4VVjBd7MAsO', 'ando@ando.com', '2018-08-11 20:33:36'),
('endo', 'endo', '$2y$10$ZsbFxyzqqO0aTEqnY0DR5eEMGKnLj/RxmGYo0.4Nj9XgioVPD9uC6', 'endo@endo.com', '2018-08-11 20:33:36'),
('itakura', 'itakura', '$2y$10$aVXb39sYJNR6FkpRBw.T3eC1xtRQUNmQy0gICqruLEsrHTJjpRB1O', 'itakura@itakura.com', '2018-08-11 20:33:36'),
('kamei', 'kamei', '$2y$10$KkQrX7Zem4G0IpWuldF6xOA.Q96jbCNxTzfk2QGEGfHQrTVYzMtkq', 'kamei@kamei.com', '2018-08-11 20:33:36'),
('kenzaki', 'kenzaki', '$2y$10$0pTiRgqmx0ArkqEqEj6RgeVzb4ZI8PWjnCZP4nIG06txOXy/VtV3S', 'kenzaki@kenzaki.com', '2018-08-11 20:33:36'),
('kinoshita', 'kinoshita', '$2y$10$Uc9D.MWeSBYowwT9JSsk6uKN8BoCKlAfNvv1VsxVK7P3Fus3RDFbC', 'kinoshita@kinoshita.com', '2018-08-11 20:33:36'),
('kobayashi', 'kobayashi', '$2y$10$gXbSA/J79dilYAOdlBeI9.lNtzDo1TUqqwsWFKjwHH1lNLtmNz4a2', 'kobayashi@kobayashi.com', '2018-08-11 20:33:36'),
('kubota', 'kubota', '$2y$10$dYRX4gcGbMS1G28ABF3qk.b0U3kGXb/DJzypTlb7bhk9rR3MDFDZm', 'kubota@kubota.com', '2018-08-11 20:33:36'),
('ozaki', 'ozaki', '$2y$10$q.MnMaa/jTVUavXy6U7FUeLhrQw16yfCGnwMkiva3VnE.SiwqiyJO', 'ozaki@ozaki.com', '2018-08-11 20:33:36'),
('sato', 'sato', '$2y$10$58IiC3QKrQ0hUsfvDH1ptONNZbvNjvVCU57LHcYZpe8mGB6pqhlf.', 'sato@sato.com', '0000-00-00 00:00:00'),
('shimura', 'shimura', '$2y$10$jp7wJTDF.8pgmOoLK5VCneQLjeRc2401K4/PpgiOvvdXbrAugXEd.', 'shimura@shimura.com', '0000-00-00 00:00:00'),
('uematsu', 'uematsu', '$2y$10$AaexwQTRCmmc1FLSm97pIuFgfFp9H70..RBRW8.8H9fFsu28kcZIC', 'uematsu@uematsu.com', '2018-08-11 20:33:36');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `followings`
--
ALTER TABLE `followings`
  ADD PRIMARY KEY (`userid`,`following_userid`);

--
-- Indexes for table `tweets`
--
ALTER TABLE `tweets`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`userid`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tweets`
--
ALTER TABLE `tweets`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=50;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
