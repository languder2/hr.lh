-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1:3306
-- Время создания: Апр 11 2024 г., 06:53
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
-- Структура таблицы `apps`
--

CREATE TABLE `apps` (
  `id` int NOT NULL,
  `time` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `poll_id` int NOT NULL,
  `poll_name` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `answers` json NOT NULL,
  `results` json NOT NULL,
  `name` varchar(200) COLLATE utf8mb4_general_ci NOT NULL,
  `phone` varchar(20) COLLATE utf8mb4_general_ci NOT NULL,
  `email` varchar(200) COLLATE utf8mb4_general_ci NOT NULL,
  `status` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `comment` text COLLATE utf8mb4_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Дамп данных таблицы `apps`
--

INSERT INTO `apps` (`id`, `time`, `poll_id`, `poll_name`, `answers`, `results`, `name`, `phone`, `email`, `status`, `comment`) VALUES
(1, '2024-04-10 22:16:33', 2, 'test poll 2', '[{\"answer\": \"a3\", \"question\": \"q1\"}]', '[{\"id\": \"2\", \"link\": \"https://mgu-mlt.ru/fakultety/fakultet-estestvennyh-nauk/\", \"name\": \"res 3\", \"weight\": 3}]', '', '', 'languder2@gmail.com', 'new', ''),
(2, '2024-04-10 22:22:48', 1, 'test poll', '[{\"answer\": \"q1a1\", \"question\": \"q1\"}, {\"answer\": \"q1a3\", \"question\": \"q2\"}, {\"answer\": \"q3a2\", \"question\": \"q3\"}]', '[{\"id\": \"2\", \"link\": \"https://mgu-mlt.ru/fakultety/fakultet-estestvennyh-nauk/\", \"name\": \"res 3\", \"weight\": 3}, {\"id\": \"4\", \"link\": \"https://mgu-mlt.ru/fakultety/tehnicheskiy-fakultet/\", \"name\": \"res 1\", \"weight\": 3}]', 'asd12', '+7 (990) 046-32-14', 'languder2@gmail.com', 'new', ''),
(3, '2024-04-10 23:47:27', 1, 'test poll', '[{\"answer\": \"q1a1\", \"question\": \"q1\"}, {\"answer\": \"q1a3\", \"question\": \"q2\"}, {\"answer\": \"q3a2\", \"question\": \"q3\"}]', '[{\"id\": \"2\", \"link\": \"https://mgu-mlt.ru/fakultety/fakultet-estestvennyh-nauk/\", \"name\": \"res 3\", \"weight\": 3}, {\"id\": \"4\", \"link\": \"https://mgu-mlt.ru/fakultety/tehnicheskiy-fakultet/\", \"name\": \"res 1\", \"weight\": 3}]', '2del', '+7 (990) 046-32-14', 'languder2@gmail.com', 'new', '');

-- --------------------------------------------------------

--
-- Структура таблицы `clients`
--

CREATE TABLE `clients` (
  `id` int NOT NULL,
  `type` enum('email','phone') COLLATE utf8mb4_general_ci NOT NULL,
  `contact` varchar(200) COLLATE utf8mb4_general_ci NOT NULL,
  `count` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Дамп данных таблицы `clients`
--

INSERT INTO `clients` (`id`, `type`, `contact`, `count`) VALUES
(1, 'email', 'languder2@gmail.com', 3),
(2, 'phone', '+7 (990) 046-32-14', 2);

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Дамп данных таблицы `menu`
--

INSERT INTO `menu` (`id`, `parent`, `name`, `link`, `section`, `sort`, `newTab`, `comment`, `display`) VALUES
(1, 0, 'Выход', 'admin/exit/', 'admin', 100, 'false', '', '1'),
(2, 0, 'Опросы', 'admin/polls/', 'admin', 20, 'false', '', '1'),
(5, 0, 'Результаты', 'admin/results/', 'admin', 30, 'false', '', '1'),
(6, 0, 'Заявки', 'admin/apps/', 'admin', 10, 'false', '', '1');

-- --------------------------------------------------------

--
-- Структура таблицы `polls`
--

CREATE TABLE `polls` (
  `id` int NOT NULL,
  `name` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `result` int NOT NULL,
  `status` enum('0','1') CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Дамп данных таблицы `polls`
--

INSERT INTO `polls` (`id`, `name`, `result`, `status`) VALUES
(1, 'test poll', 11, '1'),
(2, 'test poll 2', 11, '1'),
(3, 'test', 2, '1'),
(4, 'poll1', 3, '1');

-- --------------------------------------------------------

--
-- Структура таблицы `questions`
--

CREATE TABLE `questions` (
  `id` int NOT NULL,
  `question` varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `poll` int DEFAULT NULL,
  `answers` json NOT NULL,
  `sort` int NOT NULL DEFAULT '100',
  `status` enum('0','1') CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Дамп данных таблицы `questions`
--

INSERT INTO `questions` (`id`, `question`, `poll`, `answers`, `sort`, `status`) VALUES
(1, 'q1', 1, '[{\"sort\": 1, \"answer\": \"q1a1\", \"result\": \"4\", \"status\": 1, \"weight\": \"1\"}, {\"sort\": 2, \"answer\": \"q1a2\", \"result\": \"0\", \"status\": 1, \"weight\": \"\"}, {\"sort\": 3, \"answer\": \"q1a3\", \"result\": \"2\", \"status\": 1, \"weight\": \"3\"}]', 1, '1'),
(2, 'q2', 1, '[{\"sort\": 1, \"answer\": \"q1a1\", \"result\": \"4\", \"status\": 1, \"weight\": \"1\"}, {\"sort\": 2, \"answer\": \"q1a2\", \"result\": \"0\", \"status\": 1, \"weight\": \"\"}, {\"sort\": 3, \"answer\": \"q1a3\", \"result\": \"2\", \"status\": 1, \"weight\": \"3\"}]', 2, '1'),
(3, 'q3', 1, '[{\"sort\": 1, \"answer\": \"q3a1\", \"result\": \"3\", \"status\": 1, \"weight\": \"2\"}, {\"sort\": 2, \"answer\": \"q3a2\", \"result\": \"4\", \"status\": 1, \"weight\": \"2\"}, {\"sort\": 3, \"answer\": \"q3a3\", \"result\": \"2\", \"status\": 1, \"weight\": \"0\"}]', 3, '1'),
(4, 'q1', 2, '[{\"sort\": 1, \"answer\": \"a1\", \"result\": \"4\", \"status\": 1, \"weight\": \"1\"}, {\"sort\": 2, \"answer\": \"a2\", \"result\": \"3\", \"status\": 1, \"weight\": \"2\"}, {\"sort\": 3, \"answer\": \"a3\", \"result\": \"2\", \"status\": 1, \"weight\": \"3\"}, {\"sort\": 4, \"answer\": \"a4\", \"result\": \"3\", \"status\": 1, \"weight\": \"\"}, {\"sort\": 5, \"answer\": \"a5\", \"result\": \"0\", \"status\": 1, \"weight\": \"\"}, {\"sort\": 6, \"answer\": \"a6\", \"result\": \"0\", \"status\": 1, \"weight\": \"\"}, {\"sort\": 7, \"answer\": \"a7\", \"result\": \"0\", \"status\": 1, \"weight\": \"\"}, {\"sort\": 8, \"answer\": \"a8\", \"result\": \"0\", \"status\": 1, \"weight\": \"\"}, {\"sort\": 9, \"answer\": \"a9\", \"result\": \"0\", \"status\": 1, \"weight\": \"\"}, {\"sort\": 10, \"answer\": \"a10\", \"result\": \"0\", \"status\": 1, \"weight\": \"\"}, {\"sort\": 11, \"answer\": \"a11\", \"result\": \"0\", \"status\": 1, \"weight\": \"\"}, {\"sort\": 12, \"answer\": \"a12\", \"result\": \"0\", \"status\": 1, \"weight\": \"\"}]', 1, '1'),
(5, '123', 3, '[{\"sort\": 1, \"answer\": \"3\", \"result\": \"0\", \"status\": 1, \"weight\": \"\"}, {\"sort\": 2, \"answer\": \"2\", \"result\": \"0\", \"status\": 1, \"weight\": \"\"}, {\"sort\": 3, \"answer\": \"a\", \"result\": \"0\", \"status\": 1, \"weight\": \"\"}]', 1, '1'),
(6, '', 4, '[{\"sort\": 1, \"answer\": \"3\", \"result\": \"0\", \"status\": 1, \"weight\": \"\"}, {\"sort\": 2, \"answer\": \"a\", \"result\": \"0\", \"status\": 1, \"weight\": \"\"}, {\"sort\": 3, \"answer\": \"4\", \"result\": \"0\", \"status\": 1, \"weight\": \"\"}]', 1, '1');

-- --------------------------------------------------------

--
-- Структура таблицы `results`
--

CREATE TABLE `results` (
  `id` int NOT NULL,
  `name` varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `link` varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `description` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `status` enum('1','0') CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL DEFAULT '0',
  `sort` int NOT NULL DEFAULT '100'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Дамп данных таблицы `results`
--

INSERT INTO `results` (`id`, `name`, `link`, `description`, `status`, `sort`) VALUES
(2, 'res 3', 'https://mgu-mlt.ru/fakultety/fakultet-estestvennyh-nauk/', 'asda', '1', 6),
(3, 'res 2', 'https://mgu-mlt.ru/fakultety/gumanitarno-pedagogicheskiy-fakultet/', 'asda', '1', 7),
(4, 'res 1', 'https://mgu-mlt.ru/fakultety/tehnicheskiy-fakultet/', 'asdasd asdas d as', '1', 8),
(11, 'фиксированный результат', 'https://mgu-mlt.ru/', 'desc 1', '1', 9);

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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
-- Индексы таблицы `apps`
--
ALTER TABLE `apps`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `clients`
--
ALTER TABLE `clients`
  ADD PRIMARY KEY (`id`);

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
-- AUTO_INCREMENT для таблицы `apps`
--
ALTER TABLE `apps`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT для таблицы `clients`
--
ALTER TABLE `clients`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT для таблицы `menu`
--
ALTER TABLE `menu`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT для таблицы `polls`
--
ALTER TABLE `polls`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT для таблицы `questions`
--
ALTER TABLE `questions`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT для таблицы `results`
--
ALTER TABLE `results`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT для таблицы `users`
--
ALTER TABLE `users`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
