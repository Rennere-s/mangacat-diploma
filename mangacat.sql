-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1:3306
-- Время создания: Мар 28 2025 г., 21:51
-- Версия сервера: 8.0.19
-- Версия PHP: 7.4.5

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `mangacat`
--

-- --------------------------------------------------------

--
-- Структура таблицы `availability`
--

CREATE TABLE `availability` (
  `availability_id` int NOT NULL,
  `availability_name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `availability`
--

INSERT INTO `availability` (`availability_id`, `availability_name`) VALUES
(1, 'В наличии'),
(2, 'Не в наличии');

-- --------------------------------------------------------

--
-- Структура таблицы `genres`
--

CREATE TABLE `genres` (
  `genre_id` int NOT NULL,
  `genre_name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `genres`
--

INSERT INTO `genres` (`genre_id`, `genre_name`) VALUES
(1, 'Сёнен'),
(2, 'Сёдзё'),
(3, 'Сэйнен'),
(4, 'Дзёсэй'),
(5, 'Фентези'),
(6, 'Научная фантастика'),
(7, 'Экшн'),
(8, 'Комедия'),
(9, 'Ужасы'),
(10, 'Мистика'),
(11, 'Романтика'),
(12, 'Приключения'),
(13, 'Спорт'),
(14, 'Психология'),
(18, 'Детектив'),
(19, 'Историческое'),
(23, 'Меха'),
(25, 'Триллер'),
(28, 'Исекай'),
(30, 'Хоррор'),
(32, 'Детектив');

-- --------------------------------------------------------

--
-- Структура таблицы `goods`
--

CREATE TABLE `goods` (
  `good_id` int NOT NULL,
  `good_name` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `good_img` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `good_back_img` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `good_description` text CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `good_price` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `good_availability` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `goods`
--

INSERT INTO `goods` (`good_id`, `good_name`, `good_img`, `good_back_img`, `good_description`, `good_price`, `good_availability`) VALUES
(1, 'Атака титанов', '/img/product 1.jpg', '/img/product 1back.jpg', 'Манга о борьбе человечества с гигантами, угрожающими его выживанию. Юный Эрен Йегер вместе с друзьями сражается за свободу, открывая мрачные тайны. Эмоциональные персонажи, философские размышления и неожиданность сюжета подчиняют себе читателя. Приготовьтесь к эпической битве!', '15700 р.', 1),
(2, 'Ванпанчмен', '/img/product 2.jpg', '/img/product 2back.jpg', 'Захватывающая манга, созданная автором ONE, которая сочетает в себе элементы супергеройства, комедии и драмы. История следует за Сайтамой, обычным человеком, который, отчаявшись найти достойного соперника, стал героем только ради удовольствия. Его уникальная способность — завершать любые сражения одним ударом, что делает его одним из самых мощных существ в мире, однако и привносит в его жизнь рутину и скуку.', '10200 р.', 1),
(3, 'Ванпис', '/img/product 3.jpg', '/img/product 3back.jpg', 'История повествует о молодом мечтателе по имени Луффи, который мечтает стать Королем Пиратов. Для достижения этой амбициозной цели Луффи собирает разношерстную команду приключенцев, известных как \"Шляпки-соломенные\", и вместе они отправляются в захватывающее путешествие по огромному морю Гранд Лайна.', '12500 р.', 1),
(4, 'Великий из бродячих псов', '/img/product 4.jpg', '/img/product 4back.jpg', 'Захватывающая манга о мире, где люди обладают особыми способностями. Главный герой, Ацусо Дазаи, присоединяется к загадочному детективу Осаму Дазаи и команде Бродячих псов, чтобы расследовать преступления и сражаться с опасными противниками. Манга сочетает экшен, мистику и драму, исследуя темы дружбы и самопознания. Увлекательные сюжетные повороты и яркая графика делают это произведение настоящей жемчужиной для поклонников жанра.', '15600 р.', 1),
(5, 'Волейбол', '/img/product 5.jpg', '/img/product 5back.jpg', 'Динамичная манга, рассказывающая о подростке Хинате Шоё, который мечтает стать звездным волейболистом. Несмотря на свои небольшие габариты, он вступает в школьную команду и сталкивается с множеством вызовов на пути к успеху. Манга наполнена напряженными матчами, борьбой за мечты и важностью дружбы и командного духа. Яркая графика и глубокая проработка персонажей делают \"Волейбол\" вдохновляющей историей о страсти и упорстве в спорте.', '14600 р.', 1),
(6, 'Волк в доме', '/img/product 6.jpg', '/img/product 6back.jpg', 'Интригующая манга, которая сочетает в себе элементы фэнтези и драмы. История разворачивается вокруг Кадзутоки, человека с загадочным прошлым, который неожиданно оказывается в доме, полном неожиданных сюрпризов и секретов. Его жизнь меняется, когда он сталкивается с множеством необычных существ и загадочных обстоятельств, которые бросают вызов его восприятию мира.', '15500 р.', 1),
(7, 'Невероятные приключения ДжоДжо', '/img/product 7.jpg', '/img/product 7back.jpg', 'Погрузитесь в мир ярких красок, захватывающих боёв и невероятных приключений в манге \"Невероятные приключения ДжоДжо\" от мастера манги Хирохико Араки! Эта эпопея охватывает несколько эпох и поколений, представляя нам уникальные истории и персонажей, каждый из которых носит имя \"ДжоДжо\".', '17500 р.', 1),
(8, 'Евангелион', '/img/product 8.jpg', '/img/product 8back.jpg', 'Погрузитесь в мир манги \"Евангелион\" от Наоко Такеучи. История следит за подростком Синдзи Икари, который сражается с загадочными Ангелами, угрожающими человечеству. Эта манга исследует экзистенциальные вопросы, внутренние демоны и сложные человеческие отношения. Уникальный художественный стиль и глубокий философский подтекст делают \"Евангелион\" настоящей классикой, затрагивающей важнейшие темы жизни и жертвы.', '14700 р.', 1),
(9, 'Магическая битва', '/img/product 9.jpg', '/img/product 9back.jpg', 'Напряженная манга, которая погружает читателей в мир, где магия и демоны создают хаос. Главный герой, Юдзи Итодори, сталкивается с ужасом проклятий и волшебных существ, когда он решает защитить своих друзей и мир от надвигающейся угрозы. Вступив в ранговую школу магов, Юдзи обучается боевым искусствам и изучает магию, чтобы стать сильнее. Сочетая динамичные сражения, впечатляющую графику и глубокие персонажи, манга исследует темы дружбы, жертвы и борьбы со злом. Не пропустите эту захватывающую историю, полную неожиданных поворотов и ярких моментов!', '16400 р.', 1),
(10, 'Монолог фармацевта', '/img/product 10.jpg', '/img/product 10back.jpg', 'Главная героиня, МаоМао, является талантливым фармацевтом, которая использует свои знания о травах и зельях, чтобы помогать жителям своего городка.', '10100 р.', 1),
(11, 'О моем перерождении в слизь', '/img/product 11.jpg', '/img/product 11back.jpg', 'Представляет собой захватывающую историю, которая сочетает в себе элементы фэнтези, приключений и комедии. Сериал, основанный на одноимённой серии ранобэ, рассказывает о необычном пути главного героя, который после своей смерти в нашем мире попадает в фэнтезийный мир, переродившись в совершенно неожиданной форме — слизь.', '17200 р.', 1),
(12, 'Патриотизм мориарти', '/img/product 12.jpg', '/img/product 12back.jpg', 'Великобритания, конец XIX века. Три брата Мориарти решают уничтожить существующую классовую систему и создать справедливое общество, в котором не будет неравенства. Для достижения своей цели они наносят удары по состоятельным аристократам. В битву с преступниками вступает знаменитый сыщик Шерлок Холмс.', '10000 р.', 1),
(13, 'Я распродал свою жизнь за 10 тысяч йен за год', '/img/product 13.jpg', '/img/product 13back.jpg', 'Манга, которая повествует о последних месяцах жизни юноши по имени Кусуноки.', '14500 р.', 1);

-- --------------------------------------------------------

--
-- Структура таблицы `manga_genre`
--

CREATE TABLE `manga_genre` (
  `manga_genre_id` int NOT NULL,
  `g_manga_id` int NOT NULL,
  `m_genre_id` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `manga_genre`
--

INSERT INTO `manga_genre` (`manga_genre_id`, `g_manga_id`, `m_genre_id`) VALUES
(1, 1, 3),
(2, 1, 5),
(3, 1, 7),
(4, 1, 9),
(7, 2, 7),
(8, 2, 8),
(10, 3, 5),
(11, 3, 7),
(12, 3, 8),
(13, 3, 12),
(16, 4, 7),
(19, 5, 8),
(20, 5, 13),
(22, 6, 8),
(23, 6, 11),
(25, 7, 3),
(31, 7, 7),
(32, 7, 8),
(33, 7, 9),
(35, 7, 12),
(37, 8, 4),
(39, 8, 9),
(40, 8, 11),
(43, 9, 7),
(44, 9, 9),
(46, 9, 12),
(48, 10, 4),
(49, 10, 5),
(50, 10, 8),
(51, 10, 11),
(52, 11, 3),
(53, 11, 5),
(54, 11, 7),
(64, 12, 3),
(65, 12, 7),
(66, 12, 12),
(68, 12, 18),
(75, 13, 14),
(76, 4, 5),
(78, 4, 18),
(83, 1, 30);

-- --------------------------------------------------------

--
-- Структура таблицы `orders`
--

CREATE TABLE `orders` (
  `order_id` int NOT NULL,
  `order_user_id` int NOT NULL,
  `order_good_id` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `roles`
--

CREATE TABLE `roles` (
  `role_id` int NOT NULL,
  `role_name` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `roles`
--

INSERT INTO `roles` (`role_id`, `role_name`) VALUES
(1, 'Пользователь'),
(2, 'Администратор');

-- --------------------------------------------------------

--
-- Структура таблицы `users`
--

CREATE TABLE `users` (
  `user_id` int NOT NULL,
  `user_login` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `user_password` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `user_tel` varchar(255) NOT NULL,
  `user_email` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `user_date` date NOT NULL,
  `user_role` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `users`
--

INSERT INTO `users` (`user_id`, `user_login`, `user_password`, `user_tel`, `user_email`, `user_date`, `user_role`) VALUES
(2, 'adminka', '799ebac5b72a2b324a51ea24449e76d9', '89679993454', 'admin@admin.ru', '0001-01-01', 1),
(3, 'Rennere', 'debe81726dfab86ba2331b040892c382', '89055669072', 'rennere@yahoo.com', '2004-06-26', 2),
(7, 'adminka', 'e95d9d67cd16766b5e81da700b805f6b', '1', '1@1', '0001-01-01', 2),
(8, 'Rennere', '113d1c20296da92f96e32eac0db62fde', '89055669072', 'rennere@yahoo.com', '2004-06-26', 1);

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `availability`
--
ALTER TABLE `availability`
  ADD PRIMARY KEY (`availability_id`);

--
-- Индексы таблицы `genres`
--
ALTER TABLE `genres`
  ADD PRIMARY KEY (`genre_id`);

--
-- Индексы таблицы `goods`
--
ALTER TABLE `goods`
  ADD PRIMARY KEY (`good_id`),
  ADD KEY `good_availability` (`good_availability`);

--
-- Индексы таблицы `manga_genre`
--
ALTER TABLE `manga_genre`
  ADD PRIMARY KEY (`manga_genre_id`),
  ADD KEY `manga_id` (`g_manga_id`),
  ADD KEY `genre_id` (`m_genre_id`);

--
-- Индексы таблицы `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`order_id`),
  ADD KEY `good_id` (`order_good_id`),
  ADD KEY `user_id` (`order_user_id`) USING BTREE;

--
-- Индексы таблицы `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`role_id`);

--
-- Индексы таблицы `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`),
  ADD KEY `role` (`user_role`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `availability`
--
ALTER TABLE `availability`
  MODIFY `availability_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT для таблицы `genres`
--
ALTER TABLE `genres`
  MODIFY `genre_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT для таблицы `goods`
--
ALTER TABLE `goods`
  MODIFY `good_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT для таблицы `manga_genre`
--
ALTER TABLE `manga_genre`
  MODIFY `manga_genre_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=87;

--
-- AUTO_INCREMENT для таблицы `orders`
--
ALTER TABLE `orders`
  MODIFY `order_id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `roles`
--
ALTER TABLE `roles`
  MODIFY `role_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT для таблицы `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- Ограничения внешнего ключа сохраненных таблиц
--

--
-- Ограничения внешнего ключа таблицы `goods`
--
ALTER TABLE `goods`
  ADD CONSTRAINT `goods_ibfk_1` FOREIGN KEY (`good_availability`) REFERENCES `availability` (`availability_id`);

--
-- Ограничения внешнего ключа таблицы `manga_genre`
--
ALTER TABLE `manga_genre`
  ADD CONSTRAINT `manga_genre_ibfk_2` FOREIGN KEY (`m_genre_id`) REFERENCES `genres` (`genre_id`),
  ADD CONSTRAINT `manga_genre_ibfk_3` FOREIGN KEY (`g_manga_id`) REFERENCES `goods` (`good_id`);

--
-- Ограничения внешнего ключа таблицы `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_ibfk_1` FOREIGN KEY (`order_user_id`) REFERENCES `users` (`user_id`),
  ADD CONSTRAINT `orders_ibfk_2` FOREIGN KEY (`order_good_id`) REFERENCES `goods` (`good_id`);

--
-- Ограничения внешнего ключа таблицы `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_ibfk_1` FOREIGN KEY (`user_role`) REFERENCES `roles` (`role_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
