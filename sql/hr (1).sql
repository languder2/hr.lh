-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1:3306
-- Время создания: Апр 04 2024 г., 16:26
-- Версия сервера: 8.0.30
-- Версия PHP: 8.1.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `hr`
--

-- --------------------------------------------------------

--
-- Структура таблицы `menu`
--

CREATE TABLE `menu` (
  `id` int NOT NULL,
  `parent` int NOT NULL DEFAULT '0',
  `name` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `link` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `section` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `sort` int NOT NULL,
  `newTab` enum('true','false') CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT 'false',
  `comment` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `display` enum('0','1') CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Дамп данных таблицы `menu`
--

INSERT INTO `menu` (`id`, `parent`, `name`, `link`, `section`, `sort`, `newTab`, `comment`, `display`) VALUES
(1, 0, 'Exit', 'admin/exit/', 'admin', 100, 'false', '', '1'),
(2, 0, 'Polls', 'admin/polls/', 'admin', 10, 'false', '', '1'),
(5, 0, 'Results', 'admin/results/', 'admin', 20, 'false', '', '1'),
(6, 0, 'Applications', 'admin/applications/', 'admin', 30, 'false', '', '1');

-- --------------------------------------------------------

--
-- Структура таблицы `polls`
--

CREATE TABLE `polls` (
  `id` int NOT NULL,
  `name` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `result` int NOT NULL,
  `status` enum('0','1') CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Дамп данных таблицы `polls`
--

INSERT INTO `polls` (`id`, `name`, `result`, `status`) VALUES
(1, 'poll1', 1, '1'),
(2, 'poll1', 1, '1'),
(3, 'poll1', 1, '1'),
(4, 'poll1', 1, '1'),
(5, 'poll1', 1, '1'),
(6, 'poll1', 1, '1'),
(7, 'poll1', 1, '1'),
(8, 'poll1', 1, '1'),
(9, 'poll1', 1, '1'),
(10, 'poll1', 1, '1'),
(11, 'poll1', 1, '1'),
(12, 'poll1', 1, '1'),
(13, 'poll1', 1, '1'),
(14, 'poll1', 1, '1'),
(15, 'test', 0, '1'),
(16, 'test1', 0, '1');

-- --------------------------------------------------------

--
-- Структура таблицы `questions`
--

CREATE TABLE `questions` (
  `id` int NOT NULL,
  `question` varchar(200) COLLATE utf8mb4_general_ci NOT NULL,
  `poll` int DEFAULT NULL,
  `answers` json NOT NULL,
  `status` enum('0','1') CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Дамп данных таблицы `questions`
--

INSERT INTO `questions` (`id`, `question`, `poll`, `answers`, `status`) VALUES
(1, 'Worked?', 9, '{\"0\": {\"sort\": 1, \"answer\": \"yes\", \"result\": \"11\", \"status\": 1, \"weight\": \"1\"}, \"1\": {\"sort\": 4, \"answer\": \"no\", \"result\": \"3\", \"status\": 1, \"weight\": \"\"}, \"2\": {\"sort\": 2, \"answer\": \"( OO)\", \"result\": \"4\", \"status\": 1, \"weight\": \"3\"}, \"3\": {\"sort\": 3, \"answer\": \"who\", \"result\": \"0\", \"status\": 1, \"weight\": \"-1\"}}', '1'),
(2, 'why', 9, '[{\"sort\": 1, \"answer\": \"(Oo)\", \"result\": \"0\", \"status\": 1, \"weight\": \"\"}, {\"sort\": 2, \"answer\": \"blue\", \"result\": \"0\", \"status\": 1, \"weight\": \"\"}, {\"sort\": 3, \"answer\": \"worktime\", \"result\": \"0\", \"status\": 1, \"weight\": \"\"}]', '1'),
(3, '...', 9, '[{\"sort\": 1, \"answer\": \"variants?\", \"result\": \"0\", \"status\": 1, \"weight\": \"\"}]', '1'),
(4, 'Worked?', 10, '{\"0\": {\"sort\": 1, \"answer\": \"yes\", \"result\": \"11\", \"status\": 1, \"weight\": \"1\"}, \"1\": {\"sort\": 4, \"answer\": \"no\", \"result\": \"3\", \"status\": 1, \"weight\": \"\"}, \"2\": {\"sort\": 2, \"answer\": \"( OO)\", \"result\": \"4\", \"status\": 1, \"weight\": \"3\"}, \"3\": {\"sort\": 3, \"answer\": \"who\", \"result\": \"0\", \"status\": 1, \"weight\": \"-1\"}}', '1'),
(5, 'why', 10, '[{\"sort\": 1, \"answer\": \"(Oo)\", \"result\": \"0\", \"status\": 1, \"weight\": \"\"}, {\"sort\": 2, \"answer\": \"blue\", \"result\": \"0\", \"status\": 1, \"weight\": \"\"}, {\"sort\": 3, \"answer\": \"worktime\", \"result\": \"0\", \"status\": 1, \"weight\": \"\"}]', '1'),
(6, '...', 10, '[{\"sort\": 1, \"answer\": \"variants?\", \"result\": \"0\", \"status\": 1, \"weight\": \"\"}]', '1'),
(7, 'Worked?', 11, '{\"0\": {\"sort\": 1, \"answer\": \"yes\", \"result\": \"11\", \"status\": 1, \"weight\": \"1\"}, \"1\": {\"sort\": 4, \"answer\": \"no\", \"result\": \"3\", \"status\": 1, \"weight\": \"\"}, \"2\": {\"sort\": 2, \"answer\": \"( OO)\", \"result\": \"4\", \"status\": 1, \"weight\": \"3\"}, \"3\": {\"sort\": 3, \"answer\": \"who\", \"result\": \"0\", \"status\": 1, \"weight\": \"-1\"}}', '1'),
(8, 'why', 11, '[{\"sort\": 1, \"answer\": \"(Oo)\", \"result\": \"0\", \"status\": 1, \"weight\": \"\"}, {\"sort\": 2, \"answer\": \"blue\", \"result\": \"0\", \"status\": 1, \"weight\": \"\"}, {\"sort\": 3, \"answer\": \"worktime\", \"result\": \"0\", \"status\": 1, \"weight\": \"\"}]', '1'),
(9, '...', 11, '[{\"sort\": 1, \"answer\": \"variants?\", \"result\": \"0\", \"status\": 1, \"weight\": \"\"}]', '1'),
(10, 'Worked?', 12, '{\"0\": {\"sort\": 1, \"answer\": \"yes\", \"result\": \"11\", \"status\": 1, \"weight\": \"1\"}, \"1\": {\"sort\": 4, \"answer\": \"no\", \"result\": \"3\", \"status\": 1, \"weight\": \"\"}, \"2\": {\"sort\": 2, \"answer\": \"( OO)\", \"result\": \"4\", \"status\": 1, \"weight\": \"3\"}, \"3\": {\"sort\": 3, \"answer\": \"who\", \"result\": \"0\", \"status\": 1, \"weight\": \"-1\"}}', '1'),
(11, 'why', 12, '[{\"sort\": 1, \"answer\": \"(Oo)\", \"result\": \"0\", \"status\": 1, \"weight\": \"\"}, {\"sort\": 2, \"answer\": \"blue\", \"result\": \"0\", \"status\": 1, \"weight\": \"\"}, {\"sort\": 3, \"answer\": \"worktime\", \"result\": \"0\", \"status\": 1, \"weight\": \"\"}]', '1'),
(12, '...', 12, '[{\"sort\": 1, \"answer\": \"variants?\", \"result\": \"0\", \"status\": 1, \"weight\": \"\"}]', '1'),
(13, 'Worked?', 13, '{\"0\": {\"sort\": 1, \"answer\": \"yes\", \"result\": \"11\", \"status\": 1, \"weight\": \"1\"}, \"1\": {\"sort\": 4, \"answer\": \"no\", \"result\": \"3\", \"status\": 1, \"weight\": \"\"}, \"2\": {\"sort\": 2, \"answer\": \"( OO)\", \"result\": \"4\", \"status\": 1, \"weight\": \"3\"}, \"3\": {\"sort\": 3, \"answer\": \"who\", \"result\": \"0\", \"status\": 1, \"weight\": \"-1\"}}', '1'),
(14, 'why', 13, '[{\"sort\": 1, \"answer\": \"(Oo)\", \"result\": \"0\", \"status\": 1, \"weight\": \"\"}, {\"sort\": 2, \"answer\": \"blue\", \"result\": \"0\", \"status\": 1, \"weight\": \"\"}, {\"sort\": 3, \"answer\": \"worktime\", \"result\": \"0\", \"status\": 1, \"weight\": \"\"}]', '1'),
(15, '...', 13, '[{\"sort\": 1, \"answer\": \"variants?\", \"result\": \"0\", \"status\": 1, \"weight\": \"\"}]', '1'),
(16, 'Worked?', 14, '{\"0\": {\"sort\": 1, \"answer\": \"yes\", \"result\": \"11\", \"status\": 1, \"weight\": \"1\"}, \"1\": {\"sort\": 4, \"answer\": \"no\", \"result\": \"3\", \"status\": 1, \"weight\": \"\"}, \"2\": {\"sort\": 2, \"answer\": \"( OO)\", \"result\": \"4\", \"status\": 1, \"weight\": \"3\"}, \"3\": {\"sort\": 3, \"answer\": \"who\", \"result\": \"0\", \"status\": 1, \"weight\": \"-1\"}}', '1'),
(17, 'why', 14, '[{\"sort\": 1, \"answer\": \"(Oo)\", \"result\": \"0\", \"status\": 1, \"weight\": \"\"}, {\"sort\": 2, \"answer\": \"blue\", \"result\": \"0\", \"status\": 1, \"weight\": \"\"}, {\"sort\": 3, \"answer\": \"worktime\", \"result\": \"0\", \"status\": 1, \"weight\": \"\"}]', '1'),
(18, '...', 14, '[{\"sort\": 1, \"answer\": \"variants?\", \"result\": \"0\", \"status\": 1, \"weight\": \"\"}]', '1'),
(19, 'why', 15, '[{\"sort\": 1, \"answer\": \"\", \"result\": \"0\", \"status\": 1, \"weight\": \"\"}]', '1'),
(20, 'a1', 16, '[{\"sort\": 1, \"answer\": \"(Oo)\", \"result\": \"0\", \"status\": 1, \"weight\": \"\"}, {\"sort\": 2, \"answer\": \"blue\", \"result\": \"2\", \"status\": 1, \"weight\": \"2\"}, {\"sort\": 3, \"answer\": \"\", \"result\": \"0\", \"status\": 1, \"weight\": \"\"}]', '1'),
(21, 'a2', 16, '[{\"sort\": 1, \"answer\": \"variants?\", \"result\": \"3\", \"status\": 1, \"weight\": \"-1\"}]', '1');

-- --------------------------------------------------------

--
-- Структура таблицы `results`
--

CREATE TABLE `results` (
  `id` int NOT NULL,
  `name` varchar(200) COLLATE utf8mb4_general_ci NOT NULL,
  `link` varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `description` text COLLATE utf8mb4_general_ci NOT NULL,
  `status` enum('1','0') CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL DEFAULT '0',
  `sort` int NOT NULL DEFAULT '100'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Дамп данных таблицы `results`
--

INSERT INTO `results` (`id`, `name`, `link`, `description`, `status`, `sort`) VALUES
(2, 'test2', 'http://mgu-mlt.ru', 'asda', '1', 6),
(3, 'test3', 'http://mgu-mlt.ru', 'asda', '1', 7),
(4, 'current', 'http://mgu-mlt2.ru', 'asdasd asdas d as', '1', 8),
(11, 'test0', 'http://hr.lh', 'тест 1', '1', 9);

-- --------------------------------------------------------

--
-- Структура таблицы `users`
--

CREATE TABLE `users` (
  `id` int NOT NULL,
  `login` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `password` varchar(60) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `fio` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `perm` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `status` enum('0','1') CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Дамп данных таблицы `users`
--

INSERT INTO `users` (`id`, `login`, `password`, `fio`, `perm`, `status`) VALUES
(1, 'admin', '$2y$10$G7I7Gh9yEznkixKYierDTeslq0cVkFeSi89VbEjc5YW8warI.BzKq', 'Султан Сергей Викторович', 'admin', '1'),
(2, 'asd', 'asd', NULL, NULL, '1');

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `menu`
--
ALTER TABLE `menu`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `polls`
--
ALTER TABLE `polls`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `questions`
--
ALTER TABLE `questions`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `results`
--
ALTER TABLE `results`
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
-- AUTO_INCREMENT для таблицы `menu`
--
ALTER TABLE `menu`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT для таблицы `polls`
--
ALTER TABLE `polls`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT для таблицы `questions`
--
ALTER TABLE `questions`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT для таблицы `results`
--
ALTER TABLE `results`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT для таблицы `users`
--
ALTER TABLE `users`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
