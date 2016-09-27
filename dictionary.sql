-- phpMyAdmin SQL Dump
-- version 4.0.10
-- http://www.phpmyadmin.net
--
-- Хост: 127.0.0.1:3306
-- Время создания: Сен 27 2016 г., 13:07
-- Версия сервера: 5.6.19-log
-- Версия PHP: 5.5.13

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- База данных: `dictionary`
--
CREATE DATABASE IF NOT EXISTS `dictionary` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `dictionary`;

-- --------------------------------------------------------

--
-- Структура таблицы `dictionary`
--

CREATE TABLE IF NOT EXISTS `dictionary` (
  `id` int(9) NOT NULL AUTO_INCREMENT,
  `english_name` varchar(127) NOT NULL,
  `russian_name` varchar(127) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=18 ;

--
-- Дамп данных таблицы `dictionary`
--

INSERT INTO `dictionary` (`id`, `english_name`, `russian_name`) VALUES
(1, 'apple', 'яблоко'),
(2, 'pear', 'слива'),
(3, 'orange', 'апельсин'),
(4, 'grape', 'виноград'),
(5, 'lemon', 'лимон'),
(6, 'pineapple', 'aнанас'),
(7, 'watermelon', 'арбуз'),
(8, 'coconut', 'кокос'),
(9, 'banana', 'банан'),
(10, 'pomelo', 'помело'),
(11, 'strawberry', 'клубника'),
(12, 'raspberry', 'малина'),
(13, 'melon', 'дыня'),
(14, 'apricot', 'абрикос'),
(15, 'mango', 'манго'),
(16, 'pomegranate', 'гранат'),
(17, 'cherry', 'вишня');

-- --------------------------------------------------------

--
-- Структура таблицы `errors`
--

CREATE TABLE IF NOT EXISTS `errors` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `word` varchar(127) NOT NULL,
  `answer` varchar(127) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Структура таблицы `statistic`
--

CREATE TABLE IF NOT EXISTS `statistic` (
  `id` int(15) NOT NULL AUTO_INCREMENT,
  `test_date` datetime NOT NULL,
  `username` varchar(255) NOT NULL,
  `points` int(9) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
