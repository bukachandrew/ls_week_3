-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1:3306
-- Время создания: Дек 11 2022 г., 13:01
-- Версия сервера: 10.2.38-MariaDB
-- Версия PHP: 8.0.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `loftschool_3`
--

-- --------------------------------------------------------

--
-- Структура таблицы `blog`
--

CREATE TABLE `blog` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `message` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `blog`
--

INSERT INTO `blog` (`id`, `user_id`, `message`, `image`, `created_at`) VALUES
(2, 1, '12', NULL, '2022-12-11 12:30:18'),
(3, 11, '123', NULL, '2022-12-11 13:36:00'),
(4, 1, 'eee', '../images/4avio.jpg', '2022-12-11 14:07:52');

-- --------------------------------------------------------

--
-- Структура таблицы `users`
--

CREATE TABLE `users` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `created_at`) VALUES
(1, 'admin', 'admin@gmail.com', 'e3dc1033d2955b464a0516b1353b22640e75d16f', '2022-12-08 21:10:40'),
(11, 'manager', 'manager@gmail.com', 'e3dc1033d2955b464a0516b1353b22640e75d16f', '2022-12-09 09:18:45'),
(12, 'Anton', 'anton@gmail.com', 'e3dc1033d2955b464a0516b1353b22640e75d16f', '2022-12-09 09:18:46'),
(13, 'Sergey', 'sergey@gmail.com', 'e3dc1033d2955b464a0516b1353b22640e75d16f', '2022-12-09 09:58:12'),
(14, 'Andrey', 'andrey@gmail.com', 'e3dc1033d2955b464a0516b1353b22640e75d16f', '2022-12-09 09:58:12'),
(15, '', '', 'ffeefc4231b00102398fb6ed2fb29fb6f2c8dfa2', '2022-12-09 09:58:45'),
(16, '', '', 'ffeefc4231b00102398fb6ed2fb29fb6f2c8dfa2', '2022-12-09 09:58:46'),
(17, '', '', 'ffeefc4231b00102398fb6ed2fb29fb6f2c8dfa2', '2022-12-09 09:58:54'),
(18, '', '', 'ffeefc4231b00102398fb6ed2fb29fb6f2c8dfa2', '2022-12-09 09:58:54'),
(19, 'testoviy', 'admin@efish.kz', 'b739408319720da8bdaac17abd8cfdff26acce50', '2022-12-09 10:00:48'),
(20, 'testoviy', 'admin@efish.kz', 'b739408319720da8bdaac17abd8cfdff26acce50', '2022-12-09 10:00:48');

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `blog`
--
ALTER TABLE `blog`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `blog`
--
ALTER TABLE `blog`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT для таблицы `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
