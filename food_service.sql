-- phpMyAdmin SQL Dump
-- version 3.5.1
-- http://www.phpmyadmin.net
--
-- Хост: 127.0.0.1
-- Время создания: Мар 25 2015 г., 00:21
-- Версия сервера: 5.5.25
-- Версия PHP: 5.3.13

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- База данных: `food_service`
--

-- --------------------------------------------------------

--
-- Структура таблицы `categories`
--

CREATE TABLE IF NOT EXISTS `categories` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(30) NOT NULL,
  `parent_ID` int(11) DEFAULT NULL,
  PRIMARY KEY (`ID`),
  UNIQUE KEY `name` (`name`),
  KEY `parent_ID` (`parent_ID`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=16 ;

--
-- Дамп данных таблицы `categories`
--

INSERT INTO `categories` (`ID`, `name`, `parent_ID`) VALUES
(1, 'Всё меню', NULL),
(2, 'Кухня', 1),
(3, 'Итальянская / Европейская', 2),
(4, 'Азиатская', 2),
(5, 'Японская', 4),
(6, 'Китайская', 4),
(7, 'Корейская', 4),
(8, 'Суши и роллы', 9),
(9, 'Вид блюда', 1),
(10, 'Пицца', 9),
(11, 'Салаты и холодные закуски', 9),
(12, 'Супы', 9),
(13, 'Вторые блюда', 9),
(14, 'Гарниры', 9),
(15, 'Американская / Мексиканская', 2);

-- --------------------------------------------------------

--
-- Структура таблицы `categories_dishes`
--

CREATE TABLE IF NOT EXISTS `categories_dishes` (
  `categories_ID` int(11) NOT NULL,
  `dishes_ID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `categories_dishes`
--

INSERT INTO `categories_dishes` (`categories_ID`, `dishes_ID`) VALUES
(5, 1),
(11, 1),
(3, 2),
(11, 2),
(3, 3),
(10, 3),
(5, 4),
(8, 4),
(5, 5),
(8, 5),
(13, 6),
(6, 6),
(3, 9),
(13, 9),
(7, 10),
(12, 10);

-- --------------------------------------------------------

--
-- Структура таблицы `dishes`
--

CREATE TABLE IF NOT EXISTS `dishes` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(40) NOT NULL,
  `price` int(11) NOT NULL,
  `piclink` varchar(200) DEFAULT NULL,
  `description` mediumtext,
  `active` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`ID`),
  UNIQUE KEY `name` (`name`),
  UNIQUE KEY `ID` (`ID`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=11 ;

--
-- Дамп данных таблицы `dishes`
--

INSERT INTO `dishes` (`ID`, `name`, `price`, `piclink`, `description`, `active`) VALUES
(1, 'Кайсо Сарада', 235, 'kaiso_sarada.jpg', 'Водоросли, ореховый соус', 1),
(2, 'Греческий салат', 284, 'grecheskii_salat.jpg', 'Салатные листья, помидоры, огурцы, сладкий перец, лук, маслины, каперсы, сыр фета', 1),
(3, 'Пицца "Маргарита", 26 см', 290, 'margarita.png', 'Соус, сыр, базилик', 1),
(4, 'Ролл "Филадельфия"', 310, 'roll_philadelphia.png', 'Ролл с мягким сыром, огурцом, авокадо, обёрнутый в филе лосося', 1),
(5, 'Кайсо', 65, 'kaiso.jpg', 'Суши с морскими водорослями', 1),
(6, 'Утка по-пекински', 2800, 'pekinskaya_utka.jpg', 'Традиционная утка по-пекински', 1),
(9, 'Мясная лазанья', 367, 'myasnaya_lasagne.jpg', 'Мясная лазанья с томатным соусом, соусом бешамель, запечённая под сыром моцарелла', 1),
(10, 'Кимчи Тиге', 210, 'kimchi_tige.jpg', 'Суп из свинины, с шампиньонами и острой капустой', 1);

-- --------------------------------------------------------

--
-- Структура таблицы `orders`
--

CREATE TABLE IF NOT EXISTS `orders` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `state` int(11) NOT NULL,
  `user` int(11) NOT NULL,
  `delivery_info` varchar(100) NOT NULL,
  `checksum` int(11) NOT NULL,
  `checkdate` date NOT NULL,
  `comments` mediumtext,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Структура таблицы `orders_dishes`
--

CREATE TABLE IF NOT EXISTS `orders_dishes` (
  `orders_ID` int(11) NOT NULL,
  `dishes_ID` int(11) NOT NULL,
  `amount` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(40) NOT NULL,
  `pass` varchar(40) NOT NULL,
  PRIMARY KEY (`ID`),
  UNIQUE KEY `name` (`username`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=6 ;

--
-- Дамп данных таблицы `users`
--

INSERT INTO `users` (`ID`, `username`, `pass`) VALUES
(2, '1', 'c4ca4238a0b923820dcc509a6f75849b'),
(3, 'user1', 'a722c63db8ec8625af6cf71cb8c2d939'),
(4, 'user2', 'c1572d05424d0ecb2a65ec6a82aeacbf'),
(5, 'user3', '3afc79b597f88a72528e864cf81856d2');

--
-- Ограничения внешнего ключа сохраненных таблиц
--

--
-- Ограничения внешнего ключа таблицы `categories`
--
ALTER TABLE `categories`
  ADD CONSTRAINT `categories_ibfk_1` FOREIGN KEY (`parent_ID`) REFERENCES `categories` (`ID`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
