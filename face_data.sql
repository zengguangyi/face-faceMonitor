-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: 2016-03-24 14:46:38
-- 服务器版本： 5.6.17
-- PHP Version: 5.5.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `facemonitor`
--

-- --------------------------------------------------------

--
-- 表的结构 `face_data`
--

CREATE TABLE IF NOT EXISTS `face_data` (
  `id` int(5) NOT NULL AUTO_INCREMENT COMMENT '序号',
  `faceid` varchar(50) NOT NULL COMMENT 'face_id脸key',
  `faceurl` varchar(200) NOT NULL COMMENT '脸图片url',
  `personname` varchar(50) NOT NULL COMMENT '脸所属person',
  `imgname` varchar(60) NOT NULL COMMENT '存储在项目中的文件名',
  `createtime` varchar(22) NOT NULL COMMENT '创建时间',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=9093 ;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
