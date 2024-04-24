-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1:3306
-- Время создания: Апр 24 2024 г., 16:30
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
  `date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `poll_id` int NOT NULL,
  `name` varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `phone` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `email` varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `status` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL DEFAULT 'app-new'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Дамп данных таблицы `apps`
--

INSERT INTO `apps` (`id`, `date`, `poll_id`, `name`, `phone`, `email`, `status`) VALUES
(1, '2024-04-17 14:02:55', 7, 'test1', '+7 (990) 046-32-14', 'languder2@gmail.com', 'app-open'),
(2, '2024-04-18 08:38:59', 7, 'John Dow', '+7 (990) 046-32-14', 'asd@sda.ru', 'app-open'),
(3, '2024-04-18 08:39:23', 7, 'John Dow', '+7 (990) 041-28-69', 'languder2@gmail.com', 'app-closed'),
(4, '2024-04-18 08:39:39', 7, 'test', '+7 (131) 231-23-12', 'i.ivanov@ya.ru', 'app-banned'),
(5, '2024-04-18 12:49:48', 7, 'asdasd', '+7 (990) 041-28-69', 'asd@sda.ru', 'app-open'),
(6, '2024-04-18 12:50:13', 7, '123123asd', '+7 (449) 903-27-44', 'languder2@gmail.com', 'app-open'),
(7, '2024-04-18 13:33:41', 7, 'ktrasdasd', '+7 (990) 041-28-69', 'languder2@gmail.com', 'app-atwork');

-- --------------------------------------------------------

--
-- Структура таблицы `apps_detail`
--

CREATE TABLE `apps_detail` (
  `appID` int NOT NULL,
  `poll` json DEFAULT NULL,
  `comments` json DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Дамп данных таблицы `apps_detail`
--

INSERT INTO `apps_detail` (`appID`, `poll`, `comments`) VALUES
(1, '{\"answers\": [{\"answer\": \"С машинами, механизмами\", \"question\": \"Мне хотелось бы работать:\"}, {\"answer\": \"Иметь возможность заниматься творчеством\", \"question\": \"Главное в жизни:\"}, {\"answer\": \"Интересных изобретениях\", \"question\": \"Я предпочитаю читать статьи о:\"}, {\"answer\": \"Экономической ситуации\", \"question\": \"Больший интерес у меня вызовет сообщение о:\"}, {\"answer\": \"В помещении, где много людей\", \"question\": \"Я предпочту работать:\"}], \"poll_id\": \"7\", \"results\": [{\"id\": \"11\", \"link\": \"https://mgu-mlt.ru/\", \"name\": \"фиксированный результат\", \"weight\": 1}, {\"id\": \"11\", \"link\": \"https://mgu-mlt.ru/\", \"name\": \"фиксированный результат\", \"weight\": 1}], \"poll_name\": \"active\"}', '[]'),
(2, '{\"answers\": [{\"answer\": \"С детьми или сверстниками\", \"question\": \"Мне хотелось бы работать:\"}, {\"answer\": \"Вести здоровый образ жизни\", \"question\": \"Главное в жизни:\"}, {\"answer\": \"Интересных изобретениях\", \"question\": \"Я предпочитаю читать статьи о:\"}, {\"answer\": \"Научном открытии\", \"question\": \"Больший интерес у меня вызовет сообщение о:\"}, {\"answer\": \"В помещении, где много людей\", \"question\": \"Я предпочту работать:\"}], \"poll_id\": \"7\", \"results\": [{\"id\": \"11\", \"link\": \"https://mgu-mlt.ru/\", \"name\": \"фиксированный результат\", \"weight\": 1}, {\"id\": \"11\", \"link\": \"https://mgu-mlt.ru/\", \"name\": \"фиксированный результат\", \"weight\": 1}], \"poll_name\": \"active\"}', NULL),
(3, '{\"answers\": [{\"answer\": \"С машинами, механизмами\", \"question\": \"Мне хотелось бы работать:\"}, {\"answer\": \"Вести здоровый образ жизни\", \"question\": \"Главное в жизни:\"}, {\"answer\": \"Выдающихся ученых и их открытиях\", \"question\": \"Я предпочитаю читать статьи о:\"}, {\"answer\": \"Научном открытии\", \"question\": \"Больший интерес у меня вызовет сообщение о:\"}, {\"answer\": \"В помещении, где много людей\", \"question\": \"Я предпочту работать:\"}], \"poll_id\": \"7\", \"results\": [{\"id\": \"11\", \"link\": \"https://mgu-mlt.ru/\", \"name\": \"фиксированный результат\", \"weight\": 1}, {\"id\": \"11\", \"link\": \"https://mgu-mlt.ru/\", \"name\": \"фиксированный результат\", \"weight\": 1}], \"poll_name\": \"active\"}', '[]'),
(4, '{\"answers\": [{\"answer\": \"С детьми или сверстниками\", \"question\": \"Мне хотелось бы работать:\"}, {\"answer\": \"Вести здоровый образ жизни\", \"question\": \"Главное в жизни:\"}, {\"answer\": \"Жизни и творчестве писателей, художников, музыкантов\", \"question\": \"Я предпочитаю читать статьи о:\"}, {\"answer\": \"Научном открытии\", \"question\": \"Больший интерес у меня вызовет сообщение о:\"}, {\"answer\": \"В необычных условиях\", \"question\": \"Я предпочту работать:\"}], \"poll_id\": \"7\", \"results\": [{\"id\": \"11\", \"link\": \"https://mgu-mlt.ru/\", \"name\": \"фиксированный результат\", \"weight\": 1}, {\"id\": \"11\", \"link\": \"https://mgu-mlt.ru/\", \"name\": \"фиксированный результат\", \"weight\": 1}], \"poll_name\": \"active\"}', NULL),
(5, '{\"answers\": [{\"answer\": \"С детьми или сверстниками\", \"question\": \"Мне хотелось бы работать:\"}, {\"answer\": \"Вести здоровый образ жизни\", \"question\": \"Главное в жизни:\"}, {\"answer\": \"Жизни и творчестве писателей, художников, музыкантов\", \"question\": \"Я предпочитаю читать статьи о:\"}, {\"answer\": \"Научном открытии\", \"question\": \"Больший интерес у меня вызовет сообщение о:\"}, {\"answer\": \"В помещении, где много людей\", \"question\": \"Я предпочту работать:\"}], \"poll_id\": \"7\", \"results\": [{\"id\": \"11\", \"link\": \"https://mgu-mlt.ru/\", \"name\": \"фиксированный результат\", \"weight\": 1}, {\"id\": \"11\", \"link\": \"https://mgu-mlt.ru/\", \"name\": \"фиксированный результат\", \"weight\": 1}], \"poll_name\": \"active\"}', NULL),
(6, '{\"answers\": [{\"answer\": \"С детьми или сверстниками\", \"question\": \"Мне хотелось бы работать:\"}, {\"answer\": \"Вести здоровый образ жизни\", \"question\": \"Главное в жизни:\"}, {\"answer\": \"Интересных изобретениях\", \"question\": \"Я предпочитаю читать статьи о:\"}, {\"answer\": \"Научном открытии\", \"question\": \"Больший интерес у меня вызовет сообщение о:\"}, {\"answer\": \"В необычных условиях\", \"question\": \"Я предпочту работать:\"}], \"poll_id\": \"7\", \"results\": [{\"id\": \"11\", \"link\": \"https://mgu-mlt.ru/\", \"name\": \"фиксированный результат\", \"weight\": 1}, {\"id\": \"11\", \"link\": \"https://mgu-mlt.ru/\", \"name\": \"фиксированный результат\", \"weight\": 1}], \"poll_name\": \"active\"}', '[{\"dt\": \"18-04-2024 12:57:24\", \"comment\": \"asdas123\"}, {\"dt\": \"18-04-2024 12:57:26\", \"comment\": \"rear\"}, {\"dt\": \"18-04-2024 12:57:28\", \"comment\": \"435432413\"}, {\"dt\": \"18-04-2024 12:57:30\", \"comment\": \"test\"}]'),
(7, '{\"answers\": [{\"answer\": \"С машинами, механизмами\", \"question\": \"Мне хотелось бы работать:\"}, {\"answer\": \"Иметь возможность заниматься творчеством\", \"question\": \"Главное в жизни:\"}, {\"answer\": \"Выдающихся ученых и их открытиях\", \"question\": \"Я предпочитаю читать статьи о:\"}, {\"answer\": \"Научном открытии\", \"question\": \"Больший интерес у меня вызовет сообщение о:\"}, {\"answer\": \"В помещении, где много людей\", \"question\": \"Я предпочту работать:\"}], \"poll_id\": \"7\", \"results\": [{\"id\": \"11\", \"link\": \"https://mgu-mlt.ru/\", \"name\": \"фиксированный результат\", \"weight\": 1}, {\"id\": \"11\", \"link\": \"https://mgu-mlt.ru/\", \"name\": \"фиксированный результат\", \"weight\": 1}], \"poll_name\": \"active\"}', NULL);

-- --------------------------------------------------------

--
-- Структура таблицы `clients`
--

CREATE TABLE `clients` (
  `id` int NOT NULL,
  `type` enum('email','phone') CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `contact` varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `count` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Дамп данных таблицы `clients`
--

INSERT INTO `clients` (`id`, `type`, `contact`, `count`) VALUES
(1, 'email', 'languder2@gmail.com', 4),
(2, 'email', 'asd@sda.ru', 2),
(3, 'email', 'i.ivanov@ya.ru', 1),
(4, 'phone', '+7 (990) 046-32-14', 2),
(5, 'phone', '+7 (990) 041-28-69', 3),
(6, 'phone', '+7 (131) 231-23-12', 1),
(7, 'phone', '+7 (449) 903-27-44', 1);

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
-- Структура таблицы `notifications`
--

CREATE TABLE `notifications` (
  `id` int NOT NULL,
  `date` datetime NOT NULL,
  `appID` int DEFAULT NULL,
  `name` varchar(100) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `description` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Дамп данных таблицы `notifications`
--

INSERT INTO `notifications` (`id`, `date`, `appID`, `name`, `description`) VALUES
(1, '2024-04-24 16:30:00', 7, 'asd', 'asdasd123 123 2');

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
(7, 'Активный', 11, '1'),
(29, 'asd', 3, '0');

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
(9, 'Мне хотелось бы работать:', 7, '[{\"sort\": 1, \"answer\": \"С детьми или сверстниками\", \"result\": \"0\", \"status\": 1, \"weight\": \"\"}, {\"sort\": 2, \"answer\": \"С машинами, механизмами\", \"result\": \"0\", \"status\": 1, \"weight\": \"\"}, {\"sort\": 3, \"answer\": \"С объектами природы\", \"result\": \"0\", \"status\": 1, \"weight\": \"\"}]', 1, '1'),
(10, 'Главное в жизни:', 7, '[{\"sort\": 1, \"answer\": \"Иметь возможность заниматься творчеством\", \"result\": \"0\", \"status\": 1, \"weight\": \"\"}, {\"sort\": 2, \"answer\": \"Вести здоровый образ жизни\", \"result\": \"0\", \"status\": 1, \"weight\": \"\"}, {\"sort\": 3, \"answer\": \"Тщательно планировать свои дела\", \"result\": \"0\", \"status\": 1, \"weight\": \"\"}]', 2, '1'),
(11, 'Я предпочитаю читать статьи о:', 7, '[{\"sort\": 1, \"answer\": \"Выдающихся ученых и их открытиях\", \"result\": \"0\", \"status\": 1, \"weight\": \"\"}, {\"sort\": 2, \"answer\": \"Интересных изобретениях\", \"result\": \"0\", \"status\": 1, \"weight\": \"\"}, {\"sort\": 3, \"answer\": \"Жизни и творчестве писателей, художников, музыкантов\", \"result\": \"0\", \"status\": 1, \"weight\": \"\"}]', 3, '1'),
(12, 'Больший интерес у меня вызовет сообщение о:', 7, '[{\"sort\": 1, \"answer\": \"Научном открытии\", \"result\": \"0\", \"status\": 1, \"weight\": \"\"}, {\"sort\": 2, \"answer\": \"Художественной выставке\", \"result\": \"0\", \"status\": 1, \"weight\": \"\"}, {\"sort\": 3, \"answer\": \"Экономической ситуации\", \"result\": \"0\", \"status\": 1, \"weight\": \"\"}]', 4, '1'),
(13, 'Я предпочту работать:', 7, '[{\"sort\": 1, \"answer\": \"В помещении, где много людей\", \"result\": \"0\", \"status\": 1, \"weight\": \"\"}, {\"sort\": 2, \"answer\": \"В необычных условиях\", \"result\": \"0\", \"status\": 1, \"weight\": \"\"}, {\"sort\": 3, \"answer\": \"В обычном кабинете\", \"result\": \"0\", \"status\": 1, \"weight\": \"\"}]', 5, '1'),
(37, 'asd', 29, '[{\"sort\": 1, \"answer\": \"asd\", \"result\": \"0\", \"status\": 1, \"weight\": \"\"}]', 1, '0');

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
(11, 'фиксированный результат', 'https://mgu-mlt.ru/', 'desc 1', '1', 9);

-- --------------------------------------------------------

--
-- Структура таблицы `statuses`
--

CREATE TABLE `statuses` (
  `code` varchar(30) COLLATE utf8mb4_general_ci NOT NULL,
  `grp` varchar(20) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `name` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `sort` int NOT NULL DEFAULT '1000',
  `access` tinyint(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Дамп данных таблицы `statuses`
--

INSERT INTO `statuses` (`code`, `grp`, `name`, `sort`, `access`) VALUES
('app-atwork', 'app', 'В работе', 200, 1),
('app-banned', 'app', 'Забанен', 500, 1),
('app-closed', 'app', 'Закрытая', 300, 1),
('app-new', 'app', 'Новая', 100, 0),
('app-open', 'app', 'Открытая', 150, 1);

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
-- Индексы таблицы `apps_detail`
--
ALTER TABLE `apps_detail`
  ADD PRIMARY KEY (`appID`);

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
-- Индексы таблицы `notifications`
--
ALTER TABLE `notifications`
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
-- Индексы таблицы `statuses`
--
ALTER TABLE `statuses`
  ADD PRIMARY KEY (`code`);

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
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT для таблицы `clients`
--
ALTER TABLE `clients`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT для таблицы `menu`
--
ALTER TABLE `menu`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT для таблицы `notifications`
--
ALTER TABLE `notifications`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT для таблицы `polls`
--
ALTER TABLE `polls`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT для таблицы `questions`
--
ALTER TABLE `questions`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

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
