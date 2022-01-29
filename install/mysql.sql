-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- 主机： localhost
-- 生成日期： 2022-01-25 14:41:27
-- 服务器版本： 5.6.50-log
-- PHP 版本： 7.4.22

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- 数据库： `testtest`
--

-- --------------------------------------------------------

--
-- 表的结构 `contents`
--

CREATE TABLE `contents` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) NOT NULL,
  `top` varchar(10) NOT NULL DEFAULT '0',
  `tittle` varchar(200) NOT NULL,
  `oneimg` varchar(255) NOT NULL DEFAULT '../assets/admin/image/fiXyUH.png',
  `content` longtext NOT NULL,
  `ip` varchar(15) NOT NULL,
  `time` datetime NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- 表的结构 `system`
--

CREATE TABLE `system` (
  `name` varchar(32) NOT NULL,
  `value` text
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `system`
--

INSERT INTO `system` (`name`, `value`) VALUES
('copyright', 'Copyright © 2022 <a href=\"//fatda.cn\">Fatda.cn</a> All rights reserved'),
('description', '这是一个很不错的站点!'),
('friends', '<div class=\"col-md-3 col-sm-6 col-xs-12 animate-box fadeInUp animated\">\r\n	<div class=\"fh5co-footer-widget\">\r\n		<h3>Company</h3>\r\n		<ul class=\"fh5co-links\">\r\n			<li><a href=\"#\">About Us</a></li>\r\n			<li><a href=\"#\">Careers</a></li>\r\n			<li><a href=\"#\">Feature Tour</a></li>\r\n			<li><a href=\"#\">Pricing</a></li>\r\n			<li><a href=\"#\">Team</a></li>\r\n		</ul>\r\n	</div>\r\n</div>\r\n<div class=\"col-md-3 col-sm-6 col-xs-12 animate-box fadeInUp animated\">\r\n	<div class=\"fh5co-footer-widget\">\r\n		<h3>Support</h3>\r\n		<ul class=\"fh5co-links\">\r\n			<li><a href=\"#\">Knowledge Base</a></li>\r\n			<li><a href=\"#\">24/7 Call Support</a></li>\r\n			<li><a href=\"#\">Video Demos</a></li>\r\n			<li><a href=\"#\">Terms of Use</a></li>\r\n			<li><a href=\"#\">Privacy Policy</a></li>\r\n		</ul>\r\n	</div>\r\n</div>\r\n<div class=\"col-md-3 col-sm-6 col-xs-12 animate-box fadeInUp animated\">\r\n	<div class=\"fh5co-footer-widget\">\r\n		<h3>Contact Us</h3>\r\n		<p>\r\n			<a href=\"mailto:info@freehtml5.co\">info@Freehtml5</a> <br>\r\n			198 West 21th Street, <br>\r\n			Suite 721 New York NY 10016 <br>\r\n			<a href=\"tel:+123456789\">+12 34  5677 89</a>\r\n		</p>\r\n	</div>\r\n</div>\r\n<div class=\"col-md-3 col-sm-6 col-xs-12 animate-box fadeInUp animated\">\r\n	<div class=\"fh5co-footer-widget\">\r\n		<h3>Follow Us</h3>\r\n		<ul class=\"fh5co-social\">\r\n			<li><a href=\"#\"><i class=\"icon-twitter\"></i></a></li>\r\n			<li><a href=\"#\"><i class=\"icon-facebook\"></i></a></li>\r\n			<li><a href=\"#\"><i class=\"icon-google-plus\"></i></a></li>\r\n			<li><a href=\"#\"><i class=\"icon-instagram\"></i></a></li>\r\n			<li><a href=\"#\"><i class=\"icon-youtube-play\"></i></a></li>\r\n		</ul>\r\n	</div>\r\n</div>'),
('keyworld', 'PaperPay,吃纸怪'),
('tittle', 'PaperPay'),
('url', '127.0.0.1');

-- --------------------------------------------------------

--
-- 表的结构 `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `power` varchar(255) NOT NULL DEFAULT '2',
  `set_time` datetime NOT NULL,
  `sign_time` datetime NOT NULL,
  `sign_ip` varchar(15) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- 转储表的索引
--

--
-- 表的索引 `contents`
--
ALTER TABLE `contents`
  ADD PRIMARY KEY (`id`);

--
-- 表的索引 `system`
--
ALTER TABLE `system`
  ADD PRIMARY KEY (`name`);

--
-- 表的索引 `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- 在导出的表使用AUTO_INCREMENT
--

--
-- 使用表AUTO_INCREMENT `contents`
--
ALTER TABLE `contents`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- 使用表AUTO_INCREMENT `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
