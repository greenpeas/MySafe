-- phpMyAdmin SQL Dump
-- version 4.0.6
-- http://www.phpmyadmin.net
--
-- Хост: localhost
-- Время создания: Окт 03 2013 г., 20:49
-- Версия сервера: 5.5.31-MariaDB
-- Версия PHP: 5.3.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- База данных: `safe`
--
CREATE DATABASE IF NOT EXISTS `safe` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `safe`;

-- --------------------------------------------------------

--
-- Структура таблицы `documents`
--

DROP TABLE IF EXISTS `documents`;
CREATE TABLE IF NOT EXISTS `documents` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_safe` int(11) NOT NULL,
  `name` blob NOT NULL,
  `iv` tinyblob NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id_safe` (`id_safe`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Документ в сейфе' AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Структура таблицы `documents_fields`
--

DROP TABLE IF EXISTS `documents_fields`;
CREATE TABLE IF NOT EXISTS `documents_fields` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_document` int(11) NOT NULL,
  `name` blob NOT NULL,
  `value` blob NOT NULL,
  `iv` tinyblob NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id_document` (`id_document`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Поля документа с зашифрованными значениями' AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Структура таблицы `safes`
--

DROP TABLE IF EXISTS `safes`;
CREATE TABLE IF NOT EXISTS `safes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_user` int(11) NOT NULL,
  `name` blob NOT NULL,
  `iv` tinyblob NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id_user` (`id_user`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Сейфы пользователей' AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Структура таблицы `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user` varchar(100) NOT NULL,
  `lastvisit_at` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Ограничения внешнего ключа сохраненных таблиц
--

--
-- Ограничения внешнего ключа таблицы `documents`
--
ALTER TABLE `documents`
  ADD CONSTRAINT `fk_safe` FOREIGN KEY (`id_safe`) REFERENCES `safes` (`id`) ON DELETE CASCADE;

--
-- Ограничения внешнего ключа таблицы `documents_fields`
--
ALTER TABLE `documents_fields`
  ADD CONSTRAINT `fk_document` FOREIGN KEY (`id_document`) REFERENCES `documents` (`id`) ON DELETE CASCADE;

--
-- Ограничения внешнего ключа таблицы `safes`
--
ALTER TABLE `safes`
  ADD CONSTRAINT `fk_users` FOREIGN KEY (`id_user`) REFERENCES `users` (`id`) ON DELETE CASCADE;
