-- phpMyAdmin SQL Dump
-- version 4.5.4.1deb2ubuntu2
-- http://www.phpmyadmin.net
--
-- Хост: localhost
-- Время создания: Сен 08 2017 г., 14:54
-- Версия сервера: 5.7.19-0ubuntu0.16.04.1
-- Версия PHP: 5.6.31-4+ubuntu16.04.1+deb.sury.org+4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `wp_news`
--

-- --------------------------------------------------------

--
-- Структура таблицы `articles`
--

CREATE TABLE `articles` (
  `id` int(11) UNSIGNED NOT NULL,
  `title` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `short_content` text COLLATE utf8_unicode_ci NOT NULL,
  `content` text COLLATE utf8_unicode_ci NOT NULL,
  `author_name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `likes` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `type` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Дамп данных таблицы `articles`
--

INSERT INTO `articles` (`id`, `title`, `date`, `short_content`, `content`, `author_name`, `likes`, `type`) VALUES
(1, 'Android Oreo officially arrives, but it isn\'t on phones just yet', '2017-08-22 07:38:28', 'Builds for Pixel and Nexus devices enter carrier testing, rollout imminent', 'Google is pushing Android Oreo, the official name of the next version of its mobile OS, out of developer preview / public beta and onto its Android Open Source Project today. The company also confirmed that builds for Pixel and Nexus 5X / 6P have entered carrier testing, meaning over-the-air rollout should be happening “soon,” including updates for Nexus Player and Pixel C devices.\r\n\r\nAs promised from Google I/O, Android Oreo brings feature updates including notification dots on app icons, picture-in-picture mode, Android Instant App compatibility, and an autofill tool to help quickly and securely enter passwords and other personal information. The OS will also limit background apps from overusing your device’s battery to help extend charge. But most controversially (in my opinion, anyway), the official arrival of Android Oreo marks the death of the blob emoji, with more than 60 redesigned versions replacing the flat-designed blob faces and animal emoji.\r\n\r\nThe final version of Android Oreo will also roll out to those in the beta program today. For more information on how to download it to your device, check out Google’s blog for instructions. For everyone else waiting to receive OTA updates on their non-Google phones, get comfortable. The wait for wider rollouts begins.', 'Natt Garun', '104', 'NewsPublication'),
(2, 'Snapchat is going to try to make original scripted shows again', '2017-08-23 19:41:59', 'But Snap’s head of content says the company doesn’t want to compete with TV', 'Snapchat wants to have its own original scripted shows by the end of this year. At the Edinburgh International Television Festival today, Snapchat’s head of content, Nick Bell, called scripted programming an “interesting next venture” for the company, Variety reports.\r\n\r\nWhile Snapchat’s plans seem vague, focusing on scripted shows feels like an inevitable decision. Up until now, the company has mostly relied on networks with built-in audiences to create Snapchat-ready versions of already-popular TV shows. This year, Snapchat partnered with NBC for a news show and a series of Saturday Night Live shorts, with ABC for a Bachelor recap show, and with A&E for another reality show about dating.\r\n\r\nSCRIPTED SHOWS FEEL INEVITABLE, IF RISKY\r\n\r\nScripted, original content could help Snapchat legitimize its entertainment goals while giving it more control over the content it provides to users. But original content is risky and expensive, especially as Snapchat continues to suffer from slow user growth. The service actually launched its first scripted series back in 2015. It was called Literally Can’t Even, and it was widely panned by viewers.\r\n\r\nBut Snapchat says it wants to complement, rather than compete with, linear television. “Mobile is not a TV killer,” Bell said, according to The Hollywood Reporter. “We see mobile as being fundamentally a new medium.”\r\n\r\nBell reportedly said Snapchat is also considering the idea of working with movie studios to hype upcoming films in the lull between franchise releases.', 'Lizzie Plaugic', '10', 'NewsPublication'),
(3, 'BACK TO SCHOOL GUIDE 2017', '2017-08-23 19:44:40', 'For a generation of students, “summer’s over” is about to become the most annoying phrase ever.', 'But it’s true: the fall 2017 semester is about to begin, and it’s time to once again make sure you have the right laptop, the best headphones, and other essentials. Whether it’s simply making sure you have all the college supplies for your new dorm room or looking for belated gift ideas for high school graduation, we’ve got you covered.', 'The Verge', '8', 'NewsPublication'),
(4, 'sadadad', '2017-08-24 20:55:13', 'adadadad', 'sadadada', NULL, '0', NULL),
(24, 'Заголовок: 5', '2017-08-24 21:04:48', '5', 'Детально: 5', NULL, '1', NULL),
(26, '7', '2017-08-24 21:05:03', '7', '7', NULL, NULL, NULL),
(27, '8', '2017-08-24 21:05:11', '8', '8', NULL, '2', NULL),
(28, '9', '2017-08-24 21:05:17', '9', '9', NULL, '100', NULL),
(32, 'asdadsad', '2017-08-25 07:59:51', 'sadsadsadsad', 'sadsadsadsa', NULL, '8', NULL),
(37, 'qwerty', '2017-08-26 20:58:07', 'ytrewq', 'qwertyytrewq', NULL, '1', NULL);

-- --------------------------------------------------------

--
-- Структура таблицы `likes`
--

CREATE TABLE `likes` (
  `id` int(11) NOT NULL,
  `postid` int(11) NOT NULL,
  `userid` int(11) NOT NULL,
  `num` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Структура таблицы `user`
--

CREATE TABLE `user` (
  `id` int(11) UNSIGNED NOT NULL,
  `email` char(16) COLLATE utf8_unicode_ci NOT NULL,
  `password` char(41) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Дамп данных таблицы `user`
--

INSERT INTO `user` (`id`, `email`, `password`) VALUES
(1, 'me@lysak.me', 'lysak'),
(2, 'admin@admin', '21232f297a57a5a743894a0e4a801fc3');

-- --------------------------------------------------------

--
-- Структура таблицы `usertbl`
--

CREATE TABLE `usertbl` (
  `id` int(11) NOT NULL,
  `full_name` varchar(32) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `email` varchar(32) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `username` varchar(20) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `password` varchar(32) COLLATE utf8_unicode_ci NOT NULL DEFAULT ''
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Дамп данных таблицы `usertbl`
--

INSERT INTO `usertbl` (`id`, `full_name`, `email`, `username`, `password`) VALUES
(1, 'Dmytrii Lysak', 'me@me', 'lysak', '1'),
(2, 'sad', 'wqeq@wewe', 'ly1', '1'),
(3, 'sadadad', 'a@a', 'ly2', '1'),
(4, 'jaskdhak', 'ddslkd@lskdlskd', 'дн3', '1'),
(5, 'sadada', 'sddd@sddd', 'rootly', '1'),
(6, 'klfsja', 'djsd@djsd', 'ly55', '1'),
(7, 'sdad', 'sdaad@sfsf', 'ly56', '1'),
(8, 'dfsfs', 'sdfdsf@sdjhs', 'root51', '1');

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `articles`
--
ALTER TABLE `articles`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `likes`
--
ALTER TABLE `likes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_art` (`postid`),
  ADD KEY `id_usr` (`userid`);

--
-- Индексы таблицы `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id` (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Индексы таблицы `usertbl`
--
ALTER TABLE `usertbl`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `articles`
--
ALTER TABLE `articles`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;
--
-- AUTO_INCREMENT для таблицы `likes`
--
ALTER TABLE `likes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT для таблицы `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT для таблицы `usertbl`
--
ALTER TABLE `usertbl`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
