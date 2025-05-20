-- phpMyAdmin SQL Dump
-- version 5.1.1deb5ubuntu1
-- https://www.phpmyadmin.net/
--
-- Хост: localhost:3306
-- Время создания: Май 20 2025 г., 04:08
-- Версия сервера: 8.0.42-0ubuntu0.22.04.1
-- Версия PHP: 8.4.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `dbsst_db_asu`
--

-- --------------------------------------------------------

--
-- Структура таблицы `answers`
--

CREATE TABLE `answers` (
  `id` int NOT NULL,
  `id_question` int NOT NULL,
  `text` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `position` int DEFAULT NULL,
  `right_answer` varchar(250) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Структура таблицы `biometric_module`
--

CREATE TABLE `biometric_module` (
  `id` int NOT NULL,
  `id_user` int NOT NULL,
  `id_faculties` varchar(250) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `id_s_l` varchar(250) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Структура таблицы `bugaltaria_module`
--

CREATE TABLE `bugaltaria_module` (
  `id` int NOT NULL,
  `id_user` int NOT NULL,
  `id_faculties` varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `id_s_l` varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Дамп данных таблицы `bugaltaria_module`
--

INSERT INTO `bugaltaria_module` (`id`, `id_user`, `id_faculties`, `id_s_l`) VALUES
(24, 3632, 'ALL', 'ALL');

-- --------------------------------------------------------

--
-- Структура таблицы `commission_module`
--

CREATE TABLE `commission_module` (
  `id` int NOT NULL,
  `id_user` int NOT NULL,
  `id_faculties` varchar(80) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `id_s_l` varchar(80) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `id_countries` varchar(80) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `s_y` int NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Дамп данных таблицы `commission_module`
--

INSERT INTO `commission_module` (`id`, `id_user`, `id_faculties`, `id_s_l`, `id_countries`, `s_y`) VALUES
(1, 16, 'ALL', 'ALL', 'ALL', 24),
(2, 15, 'ALL', 'ALL', 'ALL', 24),
(3, 21, 'ALL', 'ALL', 'ALL', 24),
(4, 14, 'ALL', 'ALL', 'ALL', 24),
(5, 13, 'ALL', 'ALL', 'ALL', 24),
(6, 52, 'ALL', 'ALL', 'ALL', 24);

-- --------------------------------------------------------

--
-- Структура таблицы `contingent_module`
--

CREATE TABLE `contingent_module` (
  `id` int NOT NULL,
  `id_user` int NOT NULL,
  `id_faculty` varchar(80) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `id_s_l` varchar(80) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `id_s_v` varchar(80) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `id_countries` varchar(80) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `permission` smallint NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Дамп данных таблицы `contingent_module`
--

INSERT INTO `contingent_module` (`id`, `id_user`, `id_faculty`, `id_s_l`, `id_s_v`, `id_countries`, `permission`) VALUES
(17, 13, '3,4,5', 'ALL', 'ALL', 'ALL', 1),
(16, 15, '1', 'ALL', 'ALL', 'ALL', 1),
(18, 14, '3', 'ALL', 'ALL', 'ALL', 1),
(19, 3410, '2,4', 'ALL', 'ALL', 'ALL', 1),
(3, 3685, 'ALL', 'ALL', 'ALL', 'ALL', 10),
(21, 3192, '6', 'ALL', 'ALL', 'ALL', 6),
(23, 52, 'ALL', 'ALL', 'ALL', 'ALL', 10);

-- --------------------------------------------------------

--
-- Структура таблицы `countries`
--

CREATE TABLE `countries` (
  `id` int NOT NULL,
  `title` varchar(100) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb3;

--
-- Дамп данных таблицы `countries`
--

INSERT INTO `countries` (`id`, `title`) VALUES
(1, 'Ҷумҳурии Тоҷикистон'),
(2, 'Ҷумҳурии Узбекистон'),
(3, 'Ҷумҳурии Туркменистон'),
(4, 'Ҷумҳурии Исломии Афғонистон'),
(5, 'Федератсияи Россия'),
(6, 'Ҷумҳурии мардумии Чин');

-- --------------------------------------------------------

--
-- Структура таблицы `course`
--

CREATE TABLE `course` (
  `id` int NOT NULL,
  `title` varchar(10) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb3;

--
-- Дамп данных таблицы `course`
--

INSERT INTO `course` (`id`, `title`) VALUES
(1, 'Курси 1'),
(2, 'Курси 2'),
(3, 'Курси 3'),
(4, 'Курси 4'),
(5, 'Курси 5');

-- --------------------------------------------------------

--
-- Структура таблицы `credits_table`
--

CREATE TABLE `credits_table` (
  `id` int NOT NULL,
  `vazifa` varchar(1000) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `soat` int NOT NULL,
  `credit` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Дамп данных таблицы `credits_table`
--

INSERT INTO `credits_table` (`id`, `vazifa`, `soat`, `credit`) VALUES
(1, 'Профессор, доктори илм', 552, 23),
(2, 'Профессор, номзади илм', 552, 23),
(3, 'Дотсент, номзади илм', 576, 24),
(4, 'Дотсент, бе унвони илмӣ', 600, 25),
(5, 'Муаллими калон, номзади илм', 600, 25),
(6, 'Ассистент, номзади илм', 600, 25),
(7, 'Муаллими калон, бе унвони илмӣ', 624, 26),
(8, 'Ассистент, бе унвони илмӣ', 648, 27);

-- --------------------------------------------------------

--
-- Структура таблицы `davrho`
--

CREATE TABLE `davrho` (
  `id` int NOT NULL,
  `title` varchar(500) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `short` varchar(500) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `start_date` date NOT NULL,
  `finish_date` date NOT NULL,
  `file` varchar(60) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `students` int DEFAULT NULL,
  `s_y` int NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Дамп данных таблицы `davrho`
--

INSERT INTO `davrho` (`id`, `title`, `short`, `start_date`, `finish_date`, `file`, `students`, `s_y`) VALUES
(1, 'тақсимоти асосии Маркази миллии тестии назди Президенти Ҷумҳурии Тоҷикистон', 'тақсимоти асосии ММТ', '2024-11-18', '2024-11-18', 'davr_1.xlsx', 724, 24),
(2, 'Қабули анъанавӣ', 'Қабули анъанавӣ', '2024-07-26', '2024-08-30', NULL, NULL, 24),
(5, 'тақсимоти такрории Маркази миллии тестии назди Президенти Ҷумҳурии Тоҷикистон', 'тақсимоти такрории ММТ', '2024-08-19', '2024-08-31', 'davr_5.xlsx', 127, 24),
(6, 'тақсимоти такрории сеюм Маркази миллии тестии назди Президенти Ҷумҳурии Тоҷикистон', 'тақсимоти такрории сеюм  ММТ', '2024-08-29', '2024-09-05', NULL, NULL, 24),
(7, 'Идомаи таҳсил', 'Идомаи таҳсил', '2024-09-25', '2024-10-04', NULL, NULL, 24),
(8, 'Маълумоти дуюм', 'Маълумоти дуюм', '2024-09-25', '2024-10-10', NULL, NULL, 24),
(9, 'тақсимоти чоруми Маркази миллии тестии назди Президенти Ҷумҳурии Тоҷикистон', 'тақсимоти такрории чоруми  ММТ', '2024-10-01', '2024-10-15', NULL, NULL, 24),
(10, 'Қабули Магистратура ба  курси 1', 'Қабули Магистратура ба  курси 1', '2024-11-19', '2024-11-19', 'davr_10.xlsx', NULL, 24),
(11, 'Қабули шаҳрвандони Ҳоричи', 'Қабули шаҳрвандони Ҳоричи', '2024-11-16', '2024-11-16', NULL, NULL, 24),
(12, 'КАбули ММТ декарбри', 'КАбули ММТ декарбри', '2024-12-26', '2025-04-26', NULL, NULL, 24);

-- --------------------------------------------------------

--
-- Структура таблицы `departaments`
--

CREATE TABLE `departaments` (
  `id` int NOT NULL,
  `id_faculteis` int DEFAULT NULL,
  `title` varchar(500) NOT NULL,
  `short` varchar(500) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `id_mudir` int DEFAULT NULL,
  `s_y` int DEFAULT NULL,
  `h_y` int DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb3;

--
-- Дамп данных таблицы `departaments`
--

INSERT INTO `departaments` (`id`, `id_faculteis`, `title`, `short`, `id_mudir`, `s_y`, `h_y`) VALUES
(17, NULL, 'Кафедраи идоракунии давлатӣ ва маҳаллӣ', NULL, NULL, 24, 1),
(16, NULL, 'Кафедраи таҳлили иқтисодӣ ва омор', NULL, NULL, 24, 1),
(15, NULL, 'Кафедраи менеҷменти молиявӣ ва андозбандӣ', NULL, NULL, 24, 1),
(14, NULL, 'Кафедраи молия', NULL, NULL, 24, 1),
(13, NULL, 'Кафедраи фаъолияти бонкӣ', NULL, NULL, 24, 1),
(12, NULL, 'Кафедраи иқтисодиёти ҷаҳон', NULL, NULL, 24, 1),
(11, NULL, 'Кафедраи соҳибкорӣ ва иқтисодиёти соҳавӣ', NULL, NULL, 24, 1),
(10, NULL, 'Кафедраи назарияи иқтисодӣ', NULL, NULL, 24, 1),
(9, NULL, 'Кафедраи баҳисобгирии муҳосибӣ ва аудит', NULL, NULL, 24, 1),
(8, NULL, 'Кафедраи варзиш ва мудофиаи гражданӣ', NULL, NULL, 24, 1),
(7, NULL, 'Кафедраи таърих ва фалсафа', NULL, NULL, 24, 1),
(6, NULL, 'Кафедраи хизматрасониҳои тиббӣ-осоишгоҳӣ', NULL, NULL, 24, 1),
(5, NULL, 'Кафедраи сайёҳӣ ва бизнеси меҳмондорӣ', NULL, NULL, 24, 1),
(4, NULL, 'Кафедраи менеҷмент ва маркетинг', NULL, NULL, 24, 1),
(3, NULL, 'Кафедраи барномасозӣ ва низомҳои зеҳнӣ', NULL, NULL, 24, 1),
(2, NULL, 'Кафедраи технологияҳои иттилоотӣ ва иқтисодиёти рақамӣ', NULL, NULL, 24, 1),
(18, NULL, 'Кафедраи фаъолияти гумрукӣ', NULL, NULL, 24, 1),
(19, 4, 'Кафедраи ҳуқуқ', NULL, NULL, 24, 1),
(20, NULL, 'Кафедраи забон ва фарҳанг', NULL, NULL, 24, 1),
(21, NULL, 'Кафедраи забон ва адабиёти рус', NULL, NULL, 24, 1),
(22, NULL, 'Кафедраи забонҳои хориҷӣ ва робитаҳои байнифарҳангӣ', NULL, NULL, 24, 1),
(23, NULL, 'Кафедраи географияи иқтисодӣ ва экология', NULL, NULL, 24, 1),
(24, NULL, 'Кафедраи риёзиёт дар иқтисодиёт', NULL, NULL, 24, 1);

-- --------------------------------------------------------

--
-- Структура таблицы `departaments_member`
--

CREATE TABLE `departaments_member` (
  `id` int NOT NULL,
  `id_departament` int NOT NULL,
  `id_teacher` int NOT NULL,
  `id_credits_table` int DEFAULT NULL,
  `id_worker_type` int NOT NULL,
  `s_y` int NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb3;

-- --------------------------------------------------------

--
-- Структура таблицы `department_education`
--

CREATE TABLE `department_education` (
  `id` int NOT NULL,
  `id_user` int NOT NULL,
  `id_faculties` varchar(25) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `id_s_l` varchar(25) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Структура таблицы `diploms`
--

CREATE TABLE `diploms` (
  `id` int NOT NULL,
  `id_student` int NOT NULL,
  `id_s_l` int NOT NULL,
  `soli_xatm` int NOT NULL,
  `diplom_number` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `diplom_reg_number` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `date_gek` date NOT NULL,
  `kasb` varchar(300) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `add_author` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Структура таблицы `districts`
--

CREATE TABLE `districts` (
  `id` int NOT NULL,
  `id_region` int NOT NULL,
  `name` varchar(250) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb3;

--
-- Дамп данных таблицы `districts`
--

INSERT INTO `districts` (`id`, `id_region`, `name`) VALUES
(1, 1, 'ш. Бохтар\r\n'),
(2, 1, 'ш. Кӯлоб\r\n\r\n'),
(3, 1, 'ш. Норак\r\n'),
(4, 1, 'ш. Леваканд'),
(5, 1, 'н. Абдураҳмони Ҷомӣ\r\n'),
(6, 1, 'н. Балҷувон'),
(7, 1, 'н. Кӯшониён\r\n'),
(8, 1, 'н. Вахш\r\n'),
(9, 1, 'н. Восеъ'),
(10, 1, 'н. Данғара\r\n'),
(11, 1, 'н. Ҷалолиддини Балхӣ\r\n\r\n'),
(12, 1, 'н. Дӯстӣ\r\n'),
(13, 1, 'н. Қубодиён\r\n'),
(14, 1, 'н. Ҷайҳун\r\n'),
(15, 1, 'н. Мир Сайид Алии Ҳамадонӣ\r\n'),
(16, 1, 'н. Мӯъминобод\r\n'),
(17, 1, 'н. Носири Хусрав\r\n'),
(18, 1, 'н. Панҷ\r\n'),
(19, 1, 'н. Темурмалик\r\n'),
(20, 1, 'н. Фархор\r\n'),
(21, 1, 'н. Ховалинг\r\n'),
(22, 1, 'н. Хуросон\r\n'),
(23, 1, 'н. Шаҳритус\r\n'),
(24, 1, 'н. Шамсиддин Шоҳин\r\n'),
(25, 1, 'н. Ёвон'),
(26, 2, 'ш. Хоруғ\r\n'),
(27, 2, 'н. Ванҷ'),
(28, 2, 'н. Дарвоз\r\n'),
(29, 2, 'н. Ишкошим\r\n'),
(30, 2, 'н. Мурғоб\r\n'),
(31, 2, 'н. Роштқалъа\r\n'),
(32, 2, 'н. Рӯшон\r\n'),
(33, 2, 'н. Шуғнон'),
(34, 3, 'ш. Хуҷанд\r\n'),
(35, 3, 'ш. Истаравшан\r\n'),
(36, 3, 'ш. Исфара\r\n'),
(37, 3, 'ш. Гулистон\r\n'),
(38, 3, 'ш. Конибодом\r\n'),
(39, 3, 'ш. Панҷакент\r\n'),
(40, 3, 'ш. Истиқлол\r\n'),
(41, 3, 'ш. Бӯстон\r\n'),
(42, 3, 'н. Айнӣ\r\n'),
(43, 3, 'н. Ашт\r\n'),
(44, 3, 'н. Бобоҷон Ғафуров\r\n'),
(45, 3, 'н. Деваштич\r\n'),
(46, 3, 'н. Зафаробод\r\n'),
(47, 3, 'н. Кӯҳистони Мастчоҳ\r\n'),
(48, 3, 'н. Масчоҳ\r\n'),
(49, 3, 'н. Ҷаббор Расулов\r\n'),
(50, 3, 'н. Спитамен\r\n\r\n'),
(51, 3, 'н. Шаҳристон'),
(52, 4, 'ш. Роғун\r\n'),
(53, 4, 'н. Варзоб\r\n'),
(54, 4, 'ш. Ваҳдат\r\n'),
(55, 4, 'н. Лахш\r\n'),
(56, 4, 'н. Нуробод\r\n'),
(57, 4, 'н. Рашт\r\n'),
(58, 4, 'н. Рӯдакӣ\r\n'),
(59, 4, 'н. Сангвор\r\n'),
(60, 4, 'н. Тоҷикобод\r\n'),
(61, 4, 'ш. Турсунзода\r\n'),
(62, 4, 'н. Файзобод\r\n'),
(63, 4, 'н. Шаҳринав\r\n\r\n'),
(64, 4, 'ш. Ҳисор'),
(65, 5, 'н. Исмоили Сомонӣ'),
(66, 5, 'н. Сино'),
(67, 5, 'н. Фирдавсӣ'),
(68, 5, 'н. Шоҳмансур'),
(73, 7, 'ш. Кобул'),
(74, 8, 'н. Саросиё'),
(75, 9, 'шаҳри Файзобод');

-- --------------------------------------------------------

--
-- Структура таблицы `elonho`
--

CREATE TABLE `elonho` (
  `id` int NOT NULL,
  `type` int NOT NULL COMMENT '1 омузгорон\r\n2 донишҷӯён\r\n3 Ҳама',
  `title` varchar(500) NOT NULL,
  `text` text NOT NULL,
  `author` int NOT NULL,
  `add_date` datetime NOT NULL,
  `editor` int DEFAULT NULL,
  `edit_date` datetime DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb3;

-- --------------------------------------------------------

--
-- Структура таблицы `faculties`
--

CREATE TABLE `faculties` (
  `id` int NOT NULL,
  `title` varchar(250) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `short_title` varchar(150) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `faculties`
--

INSERT INTO `faculties` (`id`, `title`, `short_title`) VALUES
(1, 'Институти технологияҳои рақамӣ ва зеҳни сунъӣ', 'ИТРЗС'),
(2, 'Институти сайёҳӣ', 'Институти сайёҳӣ'),
(3, 'Молия ва қарз', 'Молия ва қарз'),
(4, 'Ҳуқуқ ва гумрук', 'Ҳуқуқ ва гумрук'),
(10, 'Докторантура (PHD)', 'Докторантура (PHD)'),
(6, 'Муштарак', 'Муштарак'),
(7, 'Институти иқтисодиёти ҷаҳон ва муносибатҳои байналмилалӣ', 'ИИҶМБ'),
(9, 'Магистратура', 'Магистратура'),
(12, 'Маркази таҳсилотӣ фосилавӣ ва муттасил', 'МТФМ'),
(5, 'Гуманитарию педагогӣ', 'Гуманитарию педагогӣ'),
(14, 'Институти технологияҳои рақамӣ ва зеҳни сунъӣ', 'ИТРЗС');

-- --------------------------------------------------------

--
-- Структура таблицы `faculties_settings`
--

CREATE TABLE `faculties_settings` (
  `id` int NOT NULL,
  `id_faculty` int NOT NULL,
  `id_decan` int DEFAULT NULL,
  `id_zam_ta` int DEFAULT NULL,
  `id_zam_tarb` int DEFAULT NULL,
  `id_zam_ilm` int DEFAULT NULL,
  `s_y` int NOT NULL,
  `h_y` int NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb3;

--
-- Дамп данных таблицы `faculties_settings`
--

INSERT INTO `faculties_settings` (`id`, `id_faculty`, `id_decan`, `id_zam_ta`, `id_zam_tarb`, `id_zam_ilm`, `s_y`, `h_y`) VALUES
(1, 1, 259, NULL, NULL, NULL, 24, 1),
(2, 2, 259, NULL, NULL, NULL, 24, 1),
(3, 3, 259, NULL, NULL, NULL, 24, 1),
(4, 4, 259, NULL, NULL, NULL, 24, 1),
(5, 5, 259, NULL, NULL, NULL, 24, 1),
(6, 6, 259, NULL, NULL, NULL, 24, 1),
(7, 7, 259, NULL, NULL, NULL, 24, 1),
(8, 9, 259, NULL, NULL, NULL, 24, 1),
(9, 10, 259, NULL, NULL, NULL, 24, 1),
(10, 11, 259, NULL, NULL, NULL, 24, 1),
(11, 12, 259, NULL, NULL, NULL, 24, 1),
(12, 15, 259, NULL, NULL, NULL, 25, 2);

-- --------------------------------------------------------

--
-- Структура таблицы `fan_test`
--

CREATE TABLE `fan_test` (
  `id` int NOT NULL,
  `id_departament` int DEFAULT NULL,
  `title_tj` varchar(255) NOT NULL,
  `title_ru` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `title_en` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb3;

--
-- Дамп данных таблицы `fan_test`
--

INSERT INTO `fan_test` (`id`, `id_departament`, `title_tj`, `title_ru`, `title_en`) VALUES
(1, NULL, 'Фалсафа', NULL, NULL),
(2, NULL, 'Таърихи муосири Тоҷикистон', NULL, NULL),
(3, NULL, 'Фарҳангшиносӣ ва диншиносӣ', NULL, NULL),
(4, NULL, 'Сотсиология', NULL, NULL),
(5, NULL, 'Сиёсатшиносӣ', NULL, NULL),
(6, NULL, 'Ҳуқуқ аз руи ихтисос', NULL, NULL),
(7, NULL, 'Назарияи иқтисодӣ', NULL, NULL),
(8, NULL, 'Забони тоҷикӣ аз рӯи ихтисос', NULL, NULL),
(9, NULL, 'Забони русӣ аз рӯи ихтисос', NULL, NULL),
(10, NULL, 'Забони хориҷи аз рӯи ихтисос', NULL, NULL),
(11, NULL, 'Технологияҳои информатсионӣ', NULL, NULL),
(12, NULL, 'Географияи иқтисодии Тоҷикистон бо асосҳои демография', NULL, NULL),
(13, NULL, 'Экология', NULL, NULL),
(14, NULL, 'Техникаи бехатарӣ', NULL, NULL),
(15, NULL, 'Математика дар иқтисодиёт', NULL, NULL),
(16, NULL, 'Асосҳои алгоритм ва забонҳои барномасозӣ', NULL, NULL),
(17, NULL, 'Математикаи олӣ', NULL, NULL),
(18, NULL, 'Схемотехника', NULL, NULL),
(19, NULL, 'Кибернетика', NULL, NULL),
(20, NULL, 'Омор', NULL, NULL),
(21, NULL, 'Эконометрика', NULL, NULL),
(22, NULL, 'Моделсозии иқтисодӣ-риёзӣ', NULL, NULL),
(23, NULL, 'Воситаҳои барномавии таҷҳизоти техникаи ҳисоббарор', NULL, NULL),
(24, NULL, 'Архитектураи низомҳои иттилоотӣ', NULL, NULL),
(25, NULL, 'Технология ва усулҳои барномасозӣ', NULL, NULL),
(26, NULL, 'Практикуми маҷмӯӣ оид ба ихтисос', NULL, NULL),
(27, NULL, 'Бехатарии шабакаҳои компютерӣ', NULL, NULL),
(28, NULL, 'Технологияи барномасозии С++/С#', NULL, NULL),
(29, NULL, 'Асосҳои Веб-технология', NULL, NULL),
(30, NULL, 'Забони барномасозии JAVA', NULL, NULL),
(31, NULL, 'Таъминоти барномавии бехавф', NULL, NULL),
(32, NULL, 'Асосҳои назариявии равандҳои иттилоотӣ', NULL, NULL),
(33, NULL, 'Таҷрибаомӯзии таълимӣ', NULL, NULL),
(34, NULL, 'Таҷрибаомӯзии истеҳсолӣ', NULL, NULL),
(35, NULL, 'Таҷрибаомӯзии пешаздипломӣ', NULL, NULL),
(36, NULL, 'Имтиҳони давлатӣ', NULL, NULL),
(37, NULL, 'Кори тахассусии хатм', NULL, NULL),
(38, NULL, 'Тарбияи ҷисмонӣ', NULL, NULL);

-- --------------------------------------------------------

--
-- Структура таблицы `farqiyatho`
--

CREATE TABLE `farqiyatho` (
  `id` int NOT NULL,
  `id_student` int NOT NULL,
  `author` int NOT NULL,
  `status` int NOT NULL DEFAULT '0',
  `s_y` int NOT NULL,
  `h_y` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Дамп данных таблицы `farqiyatho`
--

INSERT INTO `farqiyatho` (`id`, `id_student`, `author`, `status`, `s_y`, `h_y`) VALUES
(2, 2970, 15, 0, 24, 1),
(4, 3709, 3192, 1, 24, 1),
(7, 3731, 3192, 1, 24, 1),
(8, 3736, 3192, 1, 24, 1),
(9, 3713, 3192, 1, 24, 1),
(11, 3708, 3192, 1, 24, 1),
(12, 3716, 3192, 1, 24, 1),
(13, 409, 3192, 1, 24, 1),
(14, 802, 3192, 1, 24, 1),
(15, 1582, 3192, 1, 24, 1),
(16, 1558, 3192, 1, 24, 1),
(17, 902, 3192, 1, 24, 1),
(18, 936, 3192, 1, 24, 1),
(19, 1006, 3192, 1, 24, 1),
(20, 1049, 3192, 1, 24, 1),
(22, 3636, 3192, 1, 24, 1),
(23, 3810, 3192, 1, 24, 1),
(24, 1210, 3192, 1, 24, 1),
(25, 3712, 3192, 1, 24, 1),
(26, 3727, 3192, 1, 24, 1),
(27, 3730, 3192, 1, 24, 1),
(29, 3847, 10, 0, 24, 2);

-- --------------------------------------------------------

--
-- Структура таблицы `farqiyatho_content`
--

CREATE TABLE `farqiyatho_content` (
  `id` int NOT NULL,
  `id_farqiyat` int NOT NULL,
  `id_fan` int NOT NULL,
  `type` int DEFAULT NULL,
  `credit` int DEFAULT NULL,
  `money` float DEFAULT NULL,
  `id_course` int NOT NULL,
  `id_teacher` int NOT NULL,
  `status` int NOT NULL DEFAULT '0',
  `s_y` int NOT NULL,
  `h_y` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Дамп данных таблицы `farqiyatho_content`
--

INSERT INTO `farqiyatho_content` (`id`, `id_farqiyat`, `id_fan`, `type`, `credit`, `money`, `id_course`, `id_teacher`, `status`, `s_y`, `h_y`) VALUES
(3, 4, 3295, 1, 4, 352, 1, 3113, 0, 21, 2),
(11, 7, 3334, 1, 4, 352, 1, 3129, 1, 21, 2),
(12, 7, 1422, 1, 4, 352, 2, 3299, 1, 22, 1),
(13, 7, 3338, 1, 2, 176, 2, 3129, 1, 22, 2),
(14, 7, 3335, 1, 6, 528, 3, 3129, 1, 23, 1),
(15, 7, 3335, 2, 0, 0, 3, 3129, 0, 23, 1),
(16, 7, 3340, 1, 3, 264, 3, 3129, 1, 23, 1),
(17, 7, 1144, 1, 4, 352, 3, 3129, 1, 23, 2),
(18, 8, 3309, 1, 4, 352, 2, 3111, 1, 22, 1),
(19, 8, 2671, 1, 2, 176, 2, 3075, 1, 22, 2),
(20, 8, 3319, 1, 3, 264, 3, 3111, 1, 23, 1),
(21, 8, 3320, 1, 3, 264, 3, 3111, 1, 23, 1),
(22, 8, 2960, 1, 3, 264, 3, 3309, 1, 23, 1),
(23, 8, 2839, 1, 2, 176, 3, 3136, 0, 23, 2),
(24, 8, 3322, 1, 4, 352, 3, 3112, 1, 23, 2),
(26, 9, 3334, 1, 4, 352, 1, 3129, 1, 23, 2),
(28, 11, 3361, 1, 4, 352, 2, 3112, 0, 23, 2),
(29, 12, 3361, 1, 4, 352, 2, 3112, 0, 23, 2),
(30, 13, 3316, 1, 4, 352, 2, 3112, 1, 23, 1),
(31, 13, 1360, 1, 3, 264, 2, 3113, 1, 23, 2),
(32, 13, 3361, 1, 4, 352, 2, 3112, 1, 23, 2),
(33, 14, 3316, 1, 4, 352, 2, 3112, 1, 23, 1),
(34, 15, 3316, 1, 4, 352, 2, 3112, 1, 23, 1),
(35, 15, 1360, 1, 3, 264, 2, 3113, 1, 23, 2),
(36, 15, 3361, 1, 4, 352, 2, 3112, 1, 23, 2),
(37, 16, 3316, 1, 4, 352, 2, 3112, 1, 23, 1),
(38, 16, 1360, 1, 3, 264, 2, 3113, 1, 23, 2),
(39, 16, 3361, 1, 4, 352, 2, 3112, 1, 23, 2),
(40, 17, 3316, 1, 4, 352, 2, 3112, 1, 23, 1),
(41, 17, 1360, 1, 3, 264, 2, 3113, 1, 23, 2),
(42, 17, 3361, 1, 4, 352, 2, 3112, 1, 23, 2),
(43, 18, 3316, 1, 4, 352, 2, 3112, 1, 23, 1),
(44, 18, 1360, 1, 3, 264, 2, 3113, 1, 23, 2),
(45, 18, 3361, 1, 4, 352, 2, 3112, 1, 23, 2),
(46, 19, 3316, 1, 4, 352, 2, 3112, 1, 23, 1),
(47, 19, 1360, 1, 3, 264, 2, 3113, 1, 23, 2),
(48, 19, 3361, 1, 4, 352, 2, 3112, 1, 23, 2),
(49, 20, 3316, 1, 4, 352, 2, 3112, 0, 23, 1),
(50, 20, 1360, 1, 3, 264, 2, 3113, 0, 23, 2),
(51, 20, 3361, 1, 4, 352, 2, 3113, 0, 23, 2),
(53, 22, 3334, 1, 4, 352, 1, 3129, 1, 21, 2),
(54, 22, 3338, 1, 2, 176, 2, 3129, 1, 22, 2),
(55, 22, 3335, 1, 6, 528, 3, 3129, 1, 23, 1),
(56, 22, 3335, 2, 0, 0, 3, 3129, 1, 23, 1),
(57, 22, 3340, 1, 3, 264, 3, 3129, 1, 23, 1),
(58, 22, 1144, 1, 4, 352, 3, 3129, 1, 23, 2),
(59, 23, 2, 1, 2, 176, 1, 3340, 0, 23, 1),
(60, 23, 1665, 1, 2, 176, 1, 3340, 0, 23, 1),
(61, 23, 2417, 1, 4, 352, 1, 3315, 0, 23, 1),
(62, 23, 76, 1, 7, 616, 1, 3124, 1, 23, 1),
(63, 23, 7, 1, 2, 176, 1, 3340, 0, 23, 2),
(64, 23, 8, 1, 2, 176, 1, 3101, 0, 23, 2),
(65, 23, 12, 1, 2, 176, 1, 3364, 0, 23, 2),
(66, 23, 2455, 1, 4, 352, 1, 3361, 0, 23, 2),
(67, 23, 3295, 1, 4, 352, 1, 3305, 0, 23, 2),
(68, 24, 3316, 1, 4, 352, 2, 3112, 1, 23, 1),
(69, 25, 12, 1, 2, 176, 1, 3364, 1, 23, 2),
(70, 25, 3355, 1, 2, 176, 1, 3351, 1, 23, 2),
(71, 25, 3295, 1, 4, 352, 1, 3112, 1, 23, 2),
(72, 26, 3316, 1, 4, 352, 2, 3112, 1, 22, 1),
(73, 26, 3309, 1, 4, 352, 2, 3113, 1, 22, 1),
(74, 26, 3318, 1, 4, 352, 2, 3111, 1, 22, 2),
(75, 26, 2960, 1, 3, 264, 3, 3308, 0, 23, 1),
(76, 26, 3322, 1, 4, 352, 3, 3112, 1, 23, 2),
(77, 27, 3316, 1, 4, 352, 2, 3661, 1, 23, 1),
(78, 27, 3309, 1, 4, 352, 2, 3111, 1, 23, 1),
(79, 27, 2671, 1, 2, 176, 2, 3140, 1, 23, 2),
(80, 27, 1, 1, 3, 264, 2, 3342, 1, 23, 2),
(81, 27, 3318, 1, 4, 352, 2, 3111, 1, 23, 2),
(82, 27, 3361, 1, 4, 352, 2, 3183, 1, 23, 2),
(83, 29, 3167, 1, 5, 440, 3, 3160, 0, 24, 1),
(84, 29, 3167, 2, 0, 0, 3, 3160, 0, 24, 1),
(85, 29, 3207, 1, 4, 352, 3, 3357, 0, 24, 1);

-- --------------------------------------------------------

--
-- Структура таблицы `groups`
--

CREATE TABLE `groups` (
  `id` int NOT NULL,
  `title` varchar(255) NOT NULL,
  `lang` varchar(90) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb3;

--
-- Дамп данных таблицы `groups`
--

INSERT INTO `groups` (`id`, `title`, `lang`) VALUES
(1, 'та', 'Тоҷикӣ'),
(3, 'тб', 'Тоҷикӣ'),
(4, 'тв', 'Тоҷикӣ'),
(5, 'А3', 'Тоҷикӣ'),
(15, 'ра', 'Руси'),
(9, 'А4', 'Тоҷикӣ'),
(12, 'рб', 'Руси'),
(13, 'сс', 'Англисӣ'),
(14, 'рв', 'Руси');

-- --------------------------------------------------------

--
-- Структура таблицы `iqtibosho`
--

CREATE TABLE `iqtibosho` (
  `id` int NOT NULL,
  `id_nt` int NOT NULL,
  `semestr` int NOT NULL,
  `id_faculty` int NOT NULL,
  `id_s_l` int NOT NULL,
  `id_s_v` int NOT NULL,
  `id_course` int NOT NULL,
  `id_spec` int NOT NULL,
  `id_group` int NOT NULL,
  `id_fan` int NOT NULL,
  `soatbay` int DEFAULT NULL,
  `credits` float NOT NULL,
  `imtihon` float DEFAULT NULL,
  `lk_soat` int DEFAULT NULL,
  `am_soat` int DEFAULT NULL,
  `cmro_soat` int DEFAULT NULL,
  `loihai_kursi` int DEFAULT NULL,
  `kori_kursi` int DEFAULT NULL,
  `tajrib_talimi` int DEFAULT NULL,
  `tajrib_istehsoli` int DEFAULT NULL,
  `tajrib_pesh_a_d` int DEFAULT NULL,
  `kori_bakalavri` int DEFAULT NULL,
  `com_imt_davlati` int DEFAULT NULL,
  `hamagi` int DEFAULT NULL,
  `id_departament` int DEFAULT NULL,
  `parent_group` int DEFAULT NULL COMMENT 'Барои селанамои',
  `signature` int DEFAULT NULL,
  `s_y` int NOT NULL DEFAULT '24'
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Дамп данных таблицы `iqtibosho`
--

INSERT INTO `iqtibosho` (`id`, `id_nt`, `semestr`, `id_faculty`, `id_s_l`, `id_s_v`, `id_course`, `id_spec`, `id_group`, `id_fan`, `soatbay`, `credits`, `imtihon`, `lk_soat`, `am_soat`, `cmro_soat`, `loihai_kursi`, `kori_kursi`, `tajrib_talimi`, `tajrib_istehsoli`, `tajrib_pesh_a_d`, `kori_bakalavri`, `com_imt_davlati`, `hamagi`, `id_departament`, `parent_group`, `signature`, `s_y`) VALUES
(1, 9, 3, 1, 1, 1, 2, 8, 1, 1, NULL, 4, 3, 32, 16, 24, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 72, NULL, NULL, NULL, 24),
(2, 9, 3, 1, 1, 1, 2, 8, 1, 16, NULL, 6, 3, 32, 16, 48, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 96, NULL, NULL, NULL, 24),
(3, 9, 3, 1, 1, 1, 2, 8, 1, 18, NULL, 5, 3, 32, 16, 48, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 96, NULL, NULL, NULL, 24),
(4, 9, 3, 1, 1, 1, 2, 8, 1, 25, NULL, 6, 3, 32, 16, 48, NULL, 38, NULL, NULL, NULL, NULL, NULL, 96, NULL, NULL, NULL, 24),
(5, 9, 4, 1, 1, 1, 2, 8, 1, 5, NULL, 3, 4, 16, 8, 24, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 48, NULL, NULL, NULL, 24),
(6, 9, 4, 1, 1, 1, 2, 8, 1, 21, NULL, 6, 4, 32, 16, 48, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 96, NULL, NULL, NULL, 24),
(7, 9, 4, 1, 1, 1, 2, 8, 1, 24, NULL, 6, 4, 32, 16, 48, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 96, NULL, NULL, NULL, 24),
(8, 9, 4, 1, 1, 1, 2, 8, 1, 30, NULL, 6, 4, 32, 16, 48, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 96, NULL, NULL, NULL, 24),
(9, 9, 4, 1, 1, 1, 2, 8, 1, 33, NULL, 3, 4, 16, 8, 24, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 48, NULL, NULL, NULL, 24);

-- --------------------------------------------------------

--
-- Структура таблицы `jd`
--

CREATE TABLE `jd` (
  `id` int NOT NULL,
  `bast` int DEFAULT NULL,
  `id_faculty` int NOT NULL,
  `id_s_l` int NOT NULL DEFAULT '1',
  `id_s_v` int NOT NULL DEFAULT '1',
  `id_course` int NOT NULL,
  `id_spec` int NOT NULL,
  `id_group` int NOT NULL,
  `ruz` int NOT NULL,
  `soat` int NOT NULL,
  `id_fan` int NOT NULL,
  `lessons_type` int NOT NULL,
  `id_teacher` int NOT NULL,
  `s_y` int NOT NULL,
  `h_y` int NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb3;

-- --------------------------------------------------------

--
-- Структура таблицы `khobgoh`
--

CREATE TABLE `khobgoh` (
  `id` int NOT NULL,
  `id_khobgoh` int NOT NULL,
  `number_home` int NOT NULL,
  `id_user` int NOT NULL,
  `s_y` int NOT NULL,
  `author` int NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Дамп данных таблицы `khobgoh`
--

INSERT INTO `khobgoh` (`id`, `id_khobgoh`, `number_home`, `id_user`, `s_y`, `author`) VALUES
(1, 1, 131, 2563, 24, 10),
(2, 1, 115, 422, 24, 10),
(3, 1, 1, 1254, 24, 10),
(4, 1, 305, 2373, 24, 10),
(5, 1, 405, 3405, 24, 10),
(6, 1, 312, 358, 24, 10),
(7, 1, 212, 2610, 24, 10),
(8, 1, 310, 1934, 24, 10);

-- --------------------------------------------------------

--
-- Структура таблицы `khobgoh_module`
--

CREATE TABLE `khobgoh_module` (
  `id` int NOT NULL,
  `id_user` int NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Структура таблицы `lessons_type`
--

CREATE TABLE `lessons_type` (
  `id` int NOT NULL,
  `title_tj` varchar(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `title_ru` varchar(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `title_en` varchar(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Дамп данных таблицы `lessons_type`
--

INSERT INTO `lessons_type` (`id`, `title_tj`, `title_ru`, `title_en`) VALUES
(1, 'Лексия', NULL, NULL),
(2, 'Амалӣ', NULL, NULL),
(3, 'Лабораторӣ', NULL, NULL),
(4, 'Семинарӣ', NULL, NULL);

-- --------------------------------------------------------

--
-- Структура таблицы `litsey_module`
--

CREATE TABLE `litsey_module` (
  `id` int NOT NULL,
  `id_user` int NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Структура таблицы `mavodho`
--

CREATE TABLE `mavodho` (
  `id` int NOT NULL,
  `id_iqtibos` int NOT NULL,
  `id_week` int NOT NULL,
  `id_fan` int NOT NULL,
  `title` varchar(250) NOT NULL,
  `text` longtext NOT NULL,
  `date` varchar(50) NOT NULL,
  `updated` varchar(50) DEFAULT NULL,
  `author` int DEFAULT NULL,
  `updated_by` int DEFAULT NULL,
  `views` int NOT NULL DEFAULT '0',
  `s_y` int NOT NULL,
  `h_y` int NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb3;

-- --------------------------------------------------------

--
-- Структура таблицы `messages`
--

CREATE TABLE `messages` (
  `id` int NOT NULL,
  `code` varchar(255) NOT NULL,
  `title` varchar(500) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb3;

--
-- Дамп данных таблицы `messages`
--

INSERT INTO `messages` (`id`, `code`, `title`) VALUES
(1, 'NOT_ACCESS', 'Шумо иҷозати воридшавӣ ба системаро надоред!'),
(2, 'LOGIN_FALSE', 'Логин ва/ё парол нодуруст аст!'),
(3, 'NOT_ACCESS_FOR_ADMIN', 'Шумо иҷозати супер администраторро надоред!'),
(4, 'SUCCESS_INSERT', 'Маълумотҳо бо мувафақият сабт карда шуданд.'),
(5, 'SUCCESS_UPDATE', 'Маълумотҳо бо мувафақият иваз карда шуданд.'),
(6, 'NOT_ACCESS_FOR_TEACHER', 'Шумо иҷозати омӯзгорро надоред!'),
(7, 'NOQUEST', 'Дар ин фан савол нест!'),
(8, 'POPITKA', 'Хатогии номуълум ба вуқуъ омад!!');

-- --------------------------------------------------------

--
-- Структура таблицы `nations`
--

CREATE TABLE `nations` (
  `id` int NOT NULL,
  `title` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Дамп данных таблицы `nations`
--

INSERT INTO `nations` (`id`, `title`) VALUES
(1, 'Тоҷик'),
(2, 'Узбек'),
(3, 'Туркмен'),
(4, 'Қирғиз'),
(5, 'Рус'),
(6, 'Афғон'),
(7, 'Дигар');

-- --------------------------------------------------------

--
-- Структура таблицы `nt_content`
--

CREATE TABLE `nt_content` (
  `id` int NOT NULL,
  `id_nt` int NOT NULL,
  `semestr` int NOT NULL,
  `id_fan` int NOT NULL,
  `intixobi` int DEFAULT NULL,
  `k_k` varchar(10) DEFAULT NULL,
  `kori_nazorati` int DEFAULT NULL,
  `c_u` float NOT NULL,
  `c_f_u` float NOT NULL,
  `c_a` float NOT NULL,
  `cmro` float NOT NULL,
  `cmd` float NOT NULL,
  `author` int NOT NULL,
  `editor` int DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb3;

--
-- Дамп данных таблицы `nt_content`
--

INSERT INTO `nt_content` (`id`, `id_nt`, `semestr`, `id_fan`, `intixobi`, `k_k`, `kori_nazorati`, `c_u`, `c_f_u`, `c_a`, `cmro`, `cmd`, `author`, `editor`) VALUES
(75, 9, 3, 1, NULL, NULL, NULL, 4, 3, 2, 1, 1, 2, NULL),
(76, 9, 1, 2, NULL, NULL, NULL, 3, 2, 1, 1, 1, 2, NULL),
(77, 9, 2, 3, NULL, NULL, NULL, 3, 2, 1, 1, 1, 2, NULL),
(78, 9, 2, 4, NULL, NULL, NULL, 3, 2, 1, 1, 1, 2, NULL),
(79, 9, 4, 5, NULL, NULL, NULL, 3, 2, 1, 1, 1, 2, NULL),
(80, 9, 2, 6, NULL, NULL, NULL, 3, 2, 1, 1, 1, 2, NULL),
(81, 9, 1, 7, NULL, NULL, NULL, 3, 2, 1, 1, 1, 2, NULL),
(82, 9, 1, 8, NULL, NULL, NULL, 3, 2, 1, 1, 1, 2, NULL),
(83, 9, 1, 9, NULL, NULL, NULL, 6, 4, 2, 2, 2, 2, NULL),
(84, 9, 2, 10, NULL, NULL, NULL, 6, 4, 2, 2, 2, 2, NULL),
(85, 9, 1, 11, NULL, NULL, NULL, 5, 4, 2, 2, 1, 2, NULL),
(86, 9, 1, 12, NULL, NULL, NULL, 3, 2, 1, 1, 1, 2, NULL),
(87, 9, 2, 13, NULL, NULL, NULL, 3, 2, 1, 1, 1, 2, NULL),
(88, 9, 1, 14, NULL, NULL, NULL, 3, 2, 1, 1, 1, 2, NULL),
(89, 9, 2, 15, NULL, NULL, NULL, 6, 4, 2, 2, 2, 2, NULL),
(90, 9, 3, 16, NULL, NULL, NULL, 6, 4, 2, 2, 2, 2, NULL),
(91, 9, 1, 17, NULL, NULL, NULL, 4, 3, 2, 1, 1, 2, NULL),
(92, 9, 3, 18, NULL, NULL, NULL, 5, 4, 2, 2, 1, 2, NULL),
(93, 9, 6, 19, NULL, NULL, NULL, 6, 4, 2, 2, 2, 2, NULL),
(94, 9, 2, 20, NULL, NULL, NULL, 6, 5, 3, 2, 1, 2, NULL),
(95, 9, 4, 21, NULL, NULL, NULL, 6, 5, 2, 2, 2, 2, NULL),
(96, 9, 5, 22, NULL, NULL, NULL, 6, 4, 3, 2, 1, 2, NULL),
(97, 9, 8, 23, NULL, NULL, NULL, 6, 4, 2, 2, 2, 2, NULL),
(98, 9, 4, 24, NULL, NULL, NULL, 6, 4, 2, 2, 2, 2, NULL),
(99, 9, 3, 25, NULL, '1', NULL, 6, 4, 2, 2, 2, 2, NULL),
(100, 9, 5, 26, NULL, NULL, NULL, 6, 4, 2, 2, 2, 2, NULL),
(101, 9, 6, 27, NULL, '1', NULL, 6, 4, 2, 2, 2, 2, NULL),
(102, 9, 5, 28, NULL, NULL, NULL, 6, 4, 2, 2, 2, 2, NULL),
(103, 9, 7, 29, NULL, NULL, NULL, 6, 4, 2, 2, 2, 2, NULL),
(104, 9, 4, 30, NULL, NULL, NULL, 6, 4, 2, 2, 2, 2, NULL),
(105, 9, 7, 31, NULL, NULL, NULL, 6, 4, 2, 2, 2, 2, NULL),
(106, 9, 6, 32, NULL, NULL, NULL, 6, 4, 2, 2, 2, 2, NULL),
(107, 9, 4, 33, NULL, NULL, NULL, 3, 2, 1, 1, 1, 2, NULL),
(108, 9, 6, 34, NULL, NULL, NULL, 3, 2, 0, 2, 1, 2, NULL),
(109, 9, 8, 35, NULL, NULL, NULL, 9, 4, 0, 4, 5, 2, NULL),
(110, 9, 8, 36, NULL, NULL, NULL, 3, 1, 0, 1, 2, 2, NULL),
(111, 9, 8, 37, NULL, NULL, NULL, 6, 2, 0, 2, 4, 2, NULL),
(112, 9, 2, 38, NULL, NULL, NULL, 3, 2, 1, 1, 1, 4, NULL),
(113, 9, 1, 38, NULL, NULL, NULL, 3, 2, 1, 1, 1, 4, NULL);

-- --------------------------------------------------------

--
-- Структура таблицы `nt_list`
--

CREATE TABLE `nt_list` (
  `id` int NOT NULL,
  `title` varchar(150) NOT NULL DEFAULT 'Соли тасдиқи нақша',
  `soli_tasdiq` int NOT NULL,
  `id_faculty` int NOT NULL,
  `id_s_l` int NOT NULL,
  `id_s_v` int NOT NULL,
  `id_spec` int NOT NULL,
  `author` int NOT NULL,
  `editor` int DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb3;

--
-- Дамп данных таблицы `nt_list`
--

INSERT INTO `nt_list` (`id`, `title`, `soli_tasdiq`, `id_faculty`, `id_s_l`, `id_s_v`, `id_spec`, `author`, `editor`) VALUES
(9, 'Соли тасдиқи нақша', 2022, 1, 1, 1, 8, 2, NULL);

-- --------------------------------------------------------

--
-- Структура таблицы `qabul_plan`
--

CREATE TABLE `qabul_plan` (
  `id` int NOT NULL,
  `title` varchar(250) NOT NULL,
  `s_y` int NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb3;

--
-- Дамп данных таблицы `qabul_plan`
--

INSERT INTO `qabul_plan` (`id`, `title`, `s_y`) VALUES
(7, 'Нақшаи қабул', 25),
(4, 'Нақшаи қабул', 21),
(3, 'Нақшаи қабул', 22),
(5, 'Нақшаи қабул', 23),
(6, 'Нақшаи қабул', 24);

-- --------------------------------------------------------

--
-- Структура таблицы `qabul_plan_detail`
--

CREATE TABLE `qabul_plan_detail` (
  `id` int NOT NULL,
  `id_qabul_plan` int NOT NULL,
  `id_spec` int NOT NULL,
  `id_s_l` int NOT NULL,
  `id_s_v` int NOT NULL,
  `id_s_t` int NOT NULL,
  `money` float DEFAULT NULL,
  `money_other` float DEFAULT NULL,
  `lang` varchar(10) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL,
  `plan` int NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb3;

--
-- Дамп данных таблицы `qabul_plan_detail`
--

INSERT INTO `qabul_plan_detail` (`id`, `id_qabul_plan`, `id_spec`, `id_s_l`, `id_s_v`, `id_s_t`, `money`, `money_other`, `lang`, `plan`) VALUES
(9, 1, 1, 1, 1, 1, 1000, 10000, 'tojiki', 1),
(10, 4, 6, 1, 1, 2, NULL, NULL, 'tojiki', 2),
(11, 4, 6, 1, 1, 1, 3850, 5400, 'tojiki', 48),
(12, 4, 58, 1, 1, 2, NULL, NULL, 'tojiki', 2),
(13, 4, 58, 1, 1, 1, 5260, 7400, 'tojiki', 23),
(14, 4, 58, 1, 1, 1, 5260, 7545, 'rusi', 25),
(16, 4, 127, 1, 2, 1, 5260, 7545, 'rusi', 25),
(17, 4, 32, 1, 1, 2, NULL, NULL, 'tojiki', 2),
(18, 4, 32, 1, 1, 1, 4700, 7545, 'tojiki', 48),
(19, 4, 33, 1, 1, 2, NULL, NULL, 'tojiki', 2),
(20, 4, 33, 1, 1, 1, 4700, 7545, 'tojiki', 23),
(21, 4, 33, 1, 1, 1, 4700, 7545, 'rusi', 25),
(22, 4, 134, 1, 2, 1, 4700, 7545, 'tojiki', 20),
(23, 4, 7, 1, 1, 1, 4800, 7545, 'tojiki', 23),
(24, 4, 7, 1, 1, 2, NULL, NULL, 'tojiki', 2),
(25, 4, 12, 1, 1, 1, 3400, 5400, 'tojiki', 23),
(26, 4, 12, 1, 1, 2, NULL, NULL, 'tojiki', 2),
(27, 4, 61, 1, 1, 2, NULL, NULL, 'tojiki', 2),
(28, 4, 61, 1, 1, 1, 3660, 5400, 'tojiki', 48),
(29, 4, 135, 1, 2, 1, 3660, 5400, 'tojiki', 20),
(30, 4, 62, 1, 1, 1, 3660, 5400, 'tojiki', 23),
(31, 4, 62, 1, 1, 2, NULL, NULL, 'tojiki', 2),
(32, 4, 63, 1, 1, 1, 3400, 5400, 'tojiki', 48),
(33, 4, 63, 1, 1, 2, NULL, NULL, 'tojiki', 2),
(34, 4, 39, 1, 1, 1, 3400, 5400, 'tojiki', 23),
(35, 4, 39, 1, 1, 2, NULL, NULL, 'tojiki', 2),
(36, 4, 40, 1, 1, 1, 3400, 5400, 'tojiki', 23),
(37, 4, 40, 1, 1, 2, NULL, NULL, 'tojiki', 2),
(38, 4, 45, 1, 1, 1, 4450, 5400, 'tojiki', 48),
(125, 3, 32, 1, 1, 2, NULL, NULL, 'tojiki', 4),
(40, 4, 125, 1, 2, 1, 4450, 5400, 'rusi', 20),
(41, 4, 51, 1, 1, 1, 5260, NULL, 'tojiki', 23),
(42, 4, 51, 1, 1, 2, NULL, NULL, 'tojiki', 2),
(43, 4, 51, 1, 1, 1, 5260, 5400, 'rusi', 25),
(44, 4, 126, 1, 2, 1, 5260, 5400, 'tojiki', 20),
(45, 4, 45, 1, 1, 1, 4450, 5400, 'rusi', 25),
(46, 4, 13, 1, 1, 1, 3400, 5400, 'tojiki', 48),
(47, 4, 13, 1, 1, 2, NULL, NULL, 'tojiki', 2),
(48, 4, 14, 1, 1, 2, NULL, NULL, 'tojiki', 2),
(49, 4, 14, 1, 1, 1, 3400, 5400, 'tojiki', 73),
(50, 4, 137, 1, 2, 1, 3400, 5400, 'tojiki', 20),
(51, 4, 18, 1, 1, 1, 3400, 5400, 'tojiki', 48),
(52, 4, 18, 1, 1, 2, NULL, NULL, 'tojiki', 2),
(53, 4, 18, 1, 1, 1, 3400, 5400, 'rusi', 25),
(54, 4, 136, 1, 2, 1, 3400, 5400, 'rusi', 25),
(55, 4, 59, 1, 1, 1, 3400, 5400, 'tojiki', 23),
(56, 4, 59, 1, 1, 2, NULL, NULL, 'tojiki', 2),
(57, 4, 59, 1, 1, 1, 3400, 5400, 'rusi', 25),
(58, 4, 129, 1, 2, 1, 3400, 5400, 'tojiki', 25),
(59, 4, 55, 1, 1, 1, 5260, 5400, 'tojiki', 48),
(60, 4, 55, 1, 1, 2, NULL, NULL, 'tojiki', 2),
(61, 4, 128, 1, 2, 1, 5260, 5400, 'tojiki', 20),
(62, 4, 8, 1, 1, 1, 3850, 5400, 'tojiki', 23),
(63, 4, 8, 1, 1, 2, NULL, NULL, 'tojiki', 2),
(64, 4, 19, 1, 1, 1, 3400, 5400, 'rusi', 48),
(65, 4, 19, 1, 1, 2, NULL, NULL, 'rusi', 2),
(66, 4, 151, 1, 2, 1, 3400, 5400, 'rusi', 25),
(67, 4, 67, 1, 1, 1, 5260, 5400, 'tojiki', 98),
(68, 4, 67, 1, 1, 2, NULL, NULL, 'tojiki', 2),
(69, 4, 66, 1, 1, 1, 5260, 5400, 'tojiki', 98),
(70, 4, 66, 1, 1, 2, NULL, NULL, 'tojiki', 2),
(71, 4, 142, 1, 2, 1, 5260, 5400, 'tojiki', 20),
(72, 4, 20, 1, 1, 1, 4200, 5400, 'tojiki', 48),
(73, 4, 20, 1, 1, 2, NULL, NULL, 'tojiki', 2),
(74, 4, 20, 1, 1, 1, 4200, 5400, 'rusi', 25),
(75, 4, 152, 1, 2, 1, 4200, 5400, 'rusi', 20),
(76, 4, 53, 1, 1, 1, 4700, 5400, 'tojiki', 23),
(77, 4, 53, 1, 1, 2, NULL, NULL, 'tojiki', 2),
(78, 4, 21, 1, 1, 1, 3400, 5400, 'tojiki', 23),
(79, 4, 21, 1, 1, 2, NULL, NULL, 'tojiki', 2),
(80, 4, 34, 1, 1, 1, 4700, 5400, 'tojiki', 23),
(81, 4, 34, 1, 1, 2, NULL, NULL, 'tojiki', 2),
(82, 4, 94, 1, 1, 1, 3400, 5400, 'tojiki', 23),
(83, 4, 94, 1, 1, 2, NULL, NULL, 'tojiki', 2),
(84, 4, 68, 1, 1, 1, 6000, 100000, 'tojiki', 23),
(85, 4, 68, 1, 1, 2, NULL, NULL, 'tojiki', 2),
(86, 4, 77, 1, 1, 1, 6000, 10000, 'tojiki', 23),
(87, 4, 52, 1, 1, 1, 4200, 5400, 'tojiki', 23),
(88, 4, 52, 1, 1, 2, NULL, NULL, 'tojiki', 2),
(89, 4, 153, 1, 2, 1, 4200, 5400, 'tojiki', 25),
(90, 4, 154, 1, 1, 1, 4200, 5400, 'tojiki', 23),
(91, 4, 154, 1, 1, 2, NULL, NULL, 'tojiki', 2),
(92, 4, 155, 1, 2, 1, 4200, 5400, 'tojiki', 25),
(93, 4, 156, 1, 1, 1, 4200, 5400, 'rusi', 23),
(94, 4, 156, 1, 1, 2, NULL, NULL, 'rusi', 2),
(95, 4, 157, 1, 1, 1, 4200, 5400, 'rusi', 23),
(96, 4, 157, 1, 1, 2, NULL, NULL, 'rusi', 2),
(97, 4, 158, 1, 1, 1, 3500, 5400, 'tojiki', 23),
(98, 4, 158, 1, 1, 2, NULL, NULL, 'tojiki', 2),
(99, 4, 17, 1, 1, 1, 4200, 5400, 'tojiki', 23),
(100, 4, 17, 1, 1, 2, NULL, NULL, 'tojiki', 2),
(102, 4, 159, 1, 2, 1, 4200, 5400, 'tojiki', 25),
(103, 4, 73, 1, 1, 1, 6000, 5400, 'tojiki', 23),
(104, 4, 73, 1, 1, 2, NULL, NULL, 'tojiki', 2),
(105, 4, 56, 1, 1, 1, 6000, 5400, 'tojiki', 23),
(106, 4, 56, 1, 1, 2, NULL, NULL, 'tojiki', 2),
(107, 4, 72, 1, 1, 1, 6000, 10000, 'tojiki', 23),
(108, 4, 72, 1, 1, 2, NULL, NULL, 'tojiki', 2),
(109, 4, 74, 1, 1, 1, 6000, 10000, 'tojiki', 23),
(110, 4, 74, 1, 1, 2, NULL, NULL, 'tojiki', 2),
(111, 4, 75, 1, 1, 1, 6000, 10000, 'tojiki', 23),
(112, 4, 75, 1, 1, 2, NULL, NULL, 'tojiki', 2),
(113, 4, 71, 1, 1, 1, 6000, 10000, 'tojiki', 23),
(114, 4, 71, 1, 1, 2, NULL, NULL, 'tojiki', 2),
(116, 4, 45, 1, 1, 2, NULL, NULL, 'tojiki', 2),
(118, 4, 138, 1, 2, 1, 5260, 5400, 'tojiki', 20),
(124, 3, 127, 1, 2, 1, 5465, 7545, 'rusi', 25),
(121, 3, 58, 1, 1, 2, NULL, NULL, 'tojiki', 2),
(122, 3, 58, 1, 1, 1, 5755, 7400, 'tojiki', 23),
(123, 3, 58, 1, 1, 1, 5755, 7545, 'rusi', 25),
(126, 3, 32, 1, 1, 1, 5140, 7545, 'tojiki', 46),
(127, 3, 33, 1, 1, 2, NULL, NULL, 'tojiki', 4),
(128, 3, 33, 1, 1, 1, 5140, 7545, 'tojiki', 21),
(129, 3, 33, 1, 1, 1, 5140, 7545, 'rusi', 25),
(130, 3, 134, 1, 2, 1, 4700, 7545, 'tojiki', 20),
(131, 3, 7, 1, 1, 1, 5250, 5400, 'tojiki', 23),
(132, 3, 7, 1, 1, 2, NULL, NULL, 'tojiki', 2),
(133, 3, 12, 1, 1, 1, 3400, 5400, 'tojiki', 21),
(134, 3, 12, 1, 1, 2, NULL, NULL, 'tojiki', 4),
(135, 3, 61, 1, 1, 2, NULL, NULL, 'tojiki', 2),
(136, 3, 61, 1, 1, 1, 4000, 5400, 'tojiki', 48),
(137, 3, 135, 1, 2, 1, 3400, 5400, 'tojiki', 20),
(138, 3, 62, 1, 1, 1, 4000, 5400, 'tojiki', 23),
(139, 3, 62, 1, 1, 2, NULL, NULL, 'tojiki', 2),
(140, 3, 63, 1, 1, 1, 3850, 5400, 'tojiki', 48),
(141, 3, 63, 1, 1, 2, NULL, NULL, 'tojiki', 2),
(142, 3, 39, 1, 1, 1, 3720, 5400, 'tojiki', 21),
(143, 3, 39, 1, 1, 2, NULL, NULL, 'tojiki', 4),
(144, 3, 40, 1, 1, 1, 4025, 5400, 'tojiki', 21),
(145, 3, 40, 1, 1, 2, NULL, NULL, 'tojiki', 4),
(146, 3, 45, 1, 1, 1, 4870, 5400, 'tojiki', 48),
(147, 3, 45, 1, 1, 1, 4870, 5400, 'rusi', 25),
(148, 3, 45, 1, 1, 2, NULL, NULL, 'tojiki', 2),
(149, 3, 125, 1, 2, 1, 4430, 5400, 'rusi', 20),
(150, 3, 51, 1, 1, 1, 5775, NULL, 'tojiki', 23),
(151, 3, 51, 1, 1, 2, NULL, NULL, 'tojiki', 2),
(152, 3, 51, 1, 1, 1, 5775, 5400, 'rusi', 25),
(153, 3, 126, 1, 2, 1, 5465, 5400, 'tojiki', 20),
(154, 3, 13, 1, 1, 1, 4365, 5400, 'tojiki', 48),
(155, 3, 13, 1, 1, 2, NULL, NULL, 'tojiki', 2),
(156, 3, 14, 1, 1, 2, NULL, NULL, 'tojiki', 2),
(157, 3, 14, 1, 1, 1, 3850, 5400, 'tojiki', 73),
(158, 3, 137, 1, 2, 1, 3270, 5400, 'tojiki', 20),
(159, 3, 18, 1, 1, 1, 3720, 5400, 'tojiki', 50),
(160, 3, 18, 1, 1, 2, NULL, NULL, 'tojiki', 4),
(161, 3, 18, 1, 1, 2, NULL, NULL, 'rusi', 3),
(163, 3, 18, 1, 1, 1, 3720, 5400, 'rusi', 22),
(164, 3, 59, 1, 1, 1, 4850, 5400, 'tojiki', 23),
(165, 3, 59, 1, 1, 2, NULL, NULL, 'tojiki', 2),
(166, 3, 59, 1, 1, 1, 4850, 5400, 'rusi', 25),
(167, 3, 129, 1, 2, 1, 4400, 5400, 'tojiki', 25),
(168, 3, 55, 1, 1, 1, 5755, 5400, 'tojiki', 48),
(169, 3, 55, 1, 1, 2, NULL, NULL, 'tojiki', 2),
(170, 3, 128, 1, 2, 1, 5465, 5400, 'tojiki', 20),
(171, 3, 8, 1, 1, 1, 4210, 5400, 'tojiki', 21),
(172, 3, 8, 1, 1, 2, NULL, NULL, 'tojiki', 4),
(173, 3, 19, 1, 1, 1, 3720, 5400, 'rusi', 45),
(174, 3, 19, 1, 1, 2, NULL, NULL, 'rusi', 5),
(175, 3, 67, 1, 1, 1, 5755, 5400, 'tojiki', 98),
(176, 3, 67, 1, 1, 2, NULL, NULL, 'tojiki', 2),
(177, 3, 66, 1, 1, 1, 5260, 5400, 'tojiki', 98),
(178, 3, 66, 1, 1, 2, NULL, NULL, 'tojiki', 2),
(179, 3, 142, 1, 2, 1, 5465, 5400, 'tojiki', 20),
(180, 3, 6, 1, 1, 2, NULL, NULL, 'tojiki', 4),
(181, 3, 6, 1, 1, 1, 4210, 5400, 'tojiki', 46),
(182, 3, 20, 1, 1, 1, 4365, 5400, 'tojiki', 48),
(183, 3, 20, 1, 1, 2, NULL, NULL, 'tojiki', 2),
(184, 3, 20, 1, 1, 2, NULL, NULL, 'rusi', 3),
(185, 3, 152, 1, 2, 1, 4365, 5400, 'rusi', 20),
(186, 3, 20, 1, 1, 1, 4365, 5400, 'rusi', 22),
(187, 3, 53, 1, 1, 1, 6225, 5400, 'tojiki', 23),
(188, 3, 53, 1, 1, 2, NULL, NULL, 'tojiki', 2),
(189, 3, 21, 1, 1, 1, 3535, 5400, 'tojiki', 20),
(190, 3, 21, 1, 1, 2, NULL, NULL, 'tojiki', 5),
(191, 3, 34, 1, 1, 1, 4885, 5400, 'tojiki', 21),
(192, 3, 34, 1, 1, 2, NULL, NULL, 'tojiki', 4),
(193, 3, 94, 1, 1, 1, 3535, 5400, 'tojiki', 21),
(194, 3, 94, 1, 1, 2, NULL, NULL, 'tojiki', 4),
(195, 3, 68, 1, 1, 1, 6235, 100000, 'tojiki', 23),
(196, 3, 68, 1, 1, 2, NULL, NULL, 'tojiki', 2),
(197, 3, 71, 1, 1, 1, 6235, 10000, 'tojiki', 21),
(198, 3, 71, 1, 1, 2, NULL, NULL, 'tojiki', 4),
(199, 3, 72, 1, 1, 1, 6235, 10000, 'tojiki', 21),
(200, 3, 72, 1, 1, 2, NULL, NULL, 'tojiki', 4),
(201, 3, 73, 1, 1, 1, 6235, 5400, 'tojiki', 23),
(202, 3, 73, 1, 1, 2, NULL, NULL, 'tojiki', 2),
(203, 3, 74, 1, 1, 1, 6000, 10000, 'tojiki', 23),
(204, 3, 74, 1, 1, 2, NULL, NULL, 'tojiki', 2),
(205, 3, 75, 1, 1, 1, 6235, 10000, 'tojiki', 21),
(206, 3, 75, 1, 1, 2, NULL, NULL, 'tojiki', 4),
(207, 3, 138, 1, 2, 1, 6235, 5400, 'tojiki', 20),
(230, 3, 56, 1, 1, 1, 6235, 5400, 'tojiki', 23),
(209, 3, 151, 1, 2, 1, 3400, 5400, 'rusi', 25),
(210, 3, 153, 1, 2, 1, 8750, 5400, 'tojiki', 25),
(211, 3, 154, 1, 1, 1, 4365, 5400, 'tojiki', 50),
(212, 3, 154, 1, 1, 2, NULL, NULL, 'tojiki', 5),
(213, 3, 155, 1, 2, 1, 4365, 5400, 'tojiki', 25),
(214, 3, 156, 1, 1, 1, 4365, 5400, 'rusi', 21),
(215, 3, 156, 1, 1, 2, NULL, NULL, 'rusi', 4),
(216, 3, 157, 1, 1, 1, 4365, 5400, 'rusi', 20),
(217, 3, 157, 1, 1, 2, NULL, NULL, 'rusi', 5),
(225, 3, 17, 1, 1, 1, 4365, 5400, 'tojiki', 50),
(220, 3, 159, 1, 2, 1, 4365, 5400, 'tojiki', 25),
(221, 3, 52, 1, 1, 1, 4365, 5400, 'tojiki', 21),
(222, 3, 52, 1, 1, 2, NULL, NULL, 'tojiki', 4),
(223, 3, 22, 1, 1, 1, 3635, 5400, 'tojiki', 20),
(224, 3, 22, 1, 1, 2, NULL, NULL, 'tojiki', 5),
(226, 3, 17, 1, 1, 2, NULL, NULL, 'tojiki', 5),
(227, 4, 77, 1, 1, 2, NULL, NULL, 'tojiki', 2),
(228, 3, 77, 1, 1, 1, 6235, 10000, 'tojiki', 23),
(229, 3, 77, 1, 1, 2, NULL, NULL, 'tojiki', 2),
(231, 3, 56, 1, 1, 2, NULL, NULL, 'tojiki', 2),
(232, 3, 3, 1, 1, 1, 4200, 5400, 'tojiki', 22),
(233, 3, 3, 1, 1, 2, NULL, NULL, 'tojiki', 3),
(234, 3, 1, 1, 1, 1, 3850, 5400, 'tojiki', 20),
(235, 3, 1, 1, 1, 2, NULL, NULL, 'tojiki', 5),
(236, 3, 9, 1, 1, 1, 6000, 5400, 'tojiki', 21),
(237, 3, 9, 1, 1, 2, NULL, NULL, 'tojiki', 4),
(238, 3, 160, 1, 2, 1, 6000, 5400, 'tojiki', 25),
(239, 3, 4, 1, 1, 1, 3850, 5400, 'tojiki', 20),
(240, 3, 4, 1, 1, 2, NULL, NULL, 'tojiki', 5),
(241, 3, 91, 1, 1, 1, 4200, 5400, 'tojiki', 20),
(242, 3, 91, 1, 1, 2, NULL, NULL, 'tojiki', 5),
(243, 3, 161, 1, 1, 1, 3850, 5400, 'tojiki', 20),
(244, 3, 161, 1, 1, 2, NULL, NULL, 'tojiki', 5),
(245, 3, 162, 1, 2, 1, 3850, 5400, 'tojiki', 25),
(246, 3, 23, 1, 1, 1, 3850, 5400, 'tojiki', 20),
(247, 3, 23, 1, 1, 2, NULL, NULL, 'tojiki', 5),
(248, 3, 96, 1, 1, 1, 3850, 5400, 'tojiki', 20),
(249, 3, 96, 1, 1, 2, NULL, NULL, 'tojiki', 5),
(250, 3, 15, 1, 1, 1, 3850, 5400, 'tojiki', 20),
(251, 3, 15, 1, 1, 2, NULL, NULL, 'tojiki', 5),
(252, 3, 86, 1, 1, 1, 3850, NULL, 'tojiki', 20),
(253, 3, 86, 1, 1, 2, NULL, NULL, 'tojiki', 5),
(254, 3, 98, 1, 1, 1, 3635, 5400, 'tojiki', 21),
(255, 3, 98, 1, 1, 2, NULL, NULL, 'tojiki', 4),
(256, 3, 37, 1, 1, 1, 4000, 5400, 'tojiki', 22),
(257, 3, 37, 1, 1, 2, NULL, NULL, 'tojiki', 3),
(258, 3, 103, 1, 1, 1, 6000, 5400, 'rusi', 25),
(259, 3, 104, 1, 1, 1, 6000, 10000, 'rusi', 25),
(260, 3, 105, 1, 1, 1, 6000, 10000, 'rusi', 25),
(261, 5, 58, 1, 1, 2, NULL, NULL, 'tojiki', 15),
(262, 5, 58, 1, 1, 1, 6366, 7400, 'tojiki', 47),
(263, 5, 58, 1, 1, 1, 5755, 7545, 'rusi', 32),
(264, 5, 127, 1, 2, 1, 5465, 7545, 'tojiki', 10),
(265, 5, 58, 1, 1, 1, 5751, 10000, 'tojiki', 20),
(266, 5, 34, 1, 1, 1, 6111, 5400, 'tojiki', 64),
(267, 5, 34, 1, 1, 2, NULL, NULL, 'tojiki', 11),
(268, 5, 32, 1, 1, 2, NULL, NULL, 'tojiki', 10),
(269, 5, 32, 1, 1, 1, 5781, 7545, 'tojiki', 65),
(270, 5, 33, 1, 1, 2, NULL, NULL, 'tojiki', 5),
(271, 5, 33, 1, 1, 1, 5781, 7545, 'tojiki', 20),
(273, 5, 134, 1, 2, 1, 4700, 5400, 'tojiki', 10),
(274, 5, 7, 1, 1, 1, 5561, 5400, 'tojiki', 19),
(275, 5, 7, 1, 1, 2, NULL, NULL, 'tojiki', 11),
(276, 5, 12, 1, 1, 1, 4403, 5400, 'tojiki', 15),
(277, 5, 12, 1, 1, 2, NULL, NULL, 'tojiki', 10),
(278, 5, 52, 1, 1, 1, 4213, 5400, 'tojiki', 15),
(279, 5, 52, 1, 1, 2, NULL, NULL, 'tojiki', 10),
(282, 5, 93, 1, 1, 1, 4711, 7545, 'tojiki', 15),
(283, 5, 93, 1, 1, 2, NULL, NULL, 'tojiki', 10),
(284, 5, 91, 1, 1, 1, 4831, 5400, 'tojiki', 18),
(285, 5, 91, 1, 1, 2, NULL, NULL, 'tojiki', 12),
(286, 5, 87, 1, 1, 1, 5411, 10000, 'tojiki', 45),
(287, 5, 87, 1, 1, 2, NULL, NULL, 'tojiki', 5),
(288, 5, 85, 1, 1, 1, 3996, 5400, 'tojiki', 15),
(289, 5, 85, 1, 1, 2, NULL, NULL, 'tojiki', 10),
(290, 5, 88, 1, 1, 1, 6211, 5400, 'tojiki', 20),
(291, 5, 88, 1, 1, 2, NULL, NULL, 'tojiki', 5),
(292, 5, 11, 1, 1, 1, 5161, 7545, 'tojiki', 15),
(293, 5, 11, 1, 1, 2, NULL, NULL, 'tojiki', 10),
(294, 5, 61, 1, 1, 2, NULL, NULL, 'tojiki', 18),
(295, 5, 61, 1, 1, 1, 4911, 5400, 'tojiki', 57),
(296, 5, 135, 1, 2, 1, 4900, 5400, 'tojiki', 10),
(297, 5, 62, 1, 1, 1, 4711, 5400, 'tojiki', 38),
(298, 5, 62, 1, 1, 2, NULL, NULL, 'tojiki', 12),
(299, 5, 39, 1, 1, 1, 4403, 5400, 'tojiki', 15),
(300, 5, 39, 1, 1, 2, NULL, NULL, 'tojiki', 10),
(301, 5, 21, 1, 1, 1, 4193, 5400, 'tojiki', 15),
(302, 5, 21, 1, 1, 2, NULL, NULL, 'tojiki', 10),
(303, 5, 20, 1, 1, 1, 5013, 5400, 'tojiki', 15),
(304, 5, 20, 1, 1, 2, NULL, NULL, 'tojiki', 10),
(305, 5, 152, 1, 2, 1, 4365, 5400, 'rusi', 20),
(306, 5, 40, 1, 1, 1, 6446, 5400, 'tojiki', 35),
(307, 5, 40, 1, 1, 2, NULL, NULL, 'tojiki', 15),
(308, 5, 53, 1, 1, 1, 6225, 5400, 'tojiki', 23),
(309, 5, 53, 1, 1, 2, NULL, NULL, 'tojiki', 2),
(310, 5, 5, 1, 1, 2, NULL, NULL, 'tojiki', 5),
(311, 5, 5, 1, 1, 1, 4000, 10000, 'tojiki', 20),
(317, 5, 45, 1, 1, 1, 5768, 5400, 'rusi', 23),
(316, 5, 45, 1, 1, 1, 5768, 5400, 'tojiki', 38),
(318, 5, 45, 1, 1, 2, NULL, NULL, 'rusi', 2),
(319, 5, 126, 1, 2, 1, 5260, 5400, 'tojiki', 20),
(430, 7, 45, 1, 1, 1, 6100, 5400, 'rusi', 20),
(321, 5, 45, 1, 1, 1, 4870, 5400, 'rusi', 25),
(322, 5, 3, 1, 1, 1, 5031, 5400, 'tojiki', 15),
(323, 5, 3, 1, 1, 2, NULL, NULL, 'tojiki', 10),
(324, 5, 4, 1, 1, 1, 6446, 5400, 'tojiki', 15),
(325, 5, 4, 1, 1, 2, NULL, NULL, 'tojiki', 10),
(326, 5, 98, 1, 1, 1, 4546, 5400, 'tojiki', 15),
(327, 5, 98, 1, 1, 2, NULL, NULL, 'tojiki', 10),
(328, 5, 51, 1, 1, 1, 6065, 10000, 'tojiki', 70),
(329, 5, 51, 1, 1, 2, NULL, NULL, 'rusi', 2),
(330, 5, 51, 1, 1, 1, 6065, 5400, 'rusi', 23),
(331, 5, 125, 1, 2, 1, 4430, 5400, 'rusi', 20),
(332, 5, 51, 1, 1, 2, NULL, NULL, 'tojiki', 5),
(333, 5, 23, 1, 1, 1, 4546, 5400, 'tojiki', 18),
(334, 5, 23, 1, 1, 2, NULL, NULL, 'tojiki', 7),
(335, 5, 13, 1, 1, 1, 5113, 5400, 'tojiki', 19),
(336, 5, 13, 1, 1, 2, NULL, NULL, 'tojiki', 11),
(337, 5, 100, 1, 1, 1, 4711, 5400, 'tojiki', 20),
(338, 5, 100, 1, 1, 2, NULL, NULL, 'tojiki', 5),
(342, 5, 14, 1, 1, 1, 4565, 5400, 'tojiki', 44),
(341, 5, 14, 1, 1, 2, NULL, NULL, 'tojiki', 6),
(343, 5, 137, 1, 2, 1, 3270, 5400, 'tojiki', 10),
(344, 5, 18, 1, 1, 1, 4403, NULL, 'tojiki', 21),
(345, 5, 18, 1, 1, 2, NULL, NULL, 'tojiki', 4),
(346, 5, 16, 1, 1, 1, 5411, 10000, 'tojiki', 20),
(347, 5, 16, 1, 1, 2, NULL, NULL, 'tojiki', 5),
(348, 5, 15, 1, 1, 1, 4546, 5400, 'tojiki', 20),
(349, 5, 15, 1, 1, 2, NULL, NULL, 'tojiki', 5),
(350, 5, 59, 1, 2, 1, 5751, 5400, 'tojiki', 20),
(351, 5, 59, 1, 1, 2, NULL, NULL, 'tojiki', 5),
(355, 5, 55, 1, 1, 1, 6171, 5400, 'tojiki', 60),
(354, 5, 55, 1, 1, 2, NULL, NULL, 'tojiki', 15),
(356, 5, 55, 1, 1, 1, 6171, NULL, 'rusi', 25),
(357, 5, 128, 1, 2, 1, 5465, 5400, 'tojiki', 10),
(360, 5, 56, 1, 1, 1, 6446, 5400, 'tojiki', 20),
(361, 5, 56, 1, 1, 2, NULL, NULL, 'tojiki', 5),
(362, 5, 47, 1, 1, 1, 6411, 7545, 'tojiki', 20),
(363, 5, 47, 1, 1, 2, NULL, NULL, 'tojiki', 5),
(364, 5, 8, 1, 1, 1, 4912, 5400, 'tojiki', 40),
(365, 5, 8, 1, 1, 2, NULL, NULL, 'tojiki', 10),
(366, 5, 37, 1, 1, 1, 4931, 5400, 'tojiki', 15),
(367, 5, 37, 1, 1, 2, NULL, NULL, 'tojiki', 10),
(368, 5, 60, 1, 1, 1, 4060, 5400, 'tojiki', 20),
(369, 5, 60, 1, 1, 2, NULL, NULL, 'tojiki', 10),
(370, 5, 19, 1, 1, 1, 4303, 5400, 'rusi', 15),
(371, 5, 19, 1, 1, 2, NULL, NULL, 'rusi', 10),
(372, 5, 29, 1, 1, 1, 5311, 5400, 'tojiki', 20),
(373, 5, 29, 1, 1, 2, NULL, NULL, 'tojiki', 5),
(374, 5, 48, 1, 1, 1, 6211, 5400, 'tojiki', 23),
(375, 5, 48, 1, 1, 2, NULL, NULL, 'tojiki', 7),
(376, 5, 9, 1, 1, 1, 6456, 10000, 'tojiki', 20),
(377, 5, 9, 1, 1, 2, NULL, NULL, 'tojiki', 5),
(378, 5, 46, 1, 1, 1, 5691, NULL, 'tojiki', 15),
(379, 5, 46, 1, 1, 2, NULL, NULL, 'tojiki', 10),
(380, 5, 73, 1, 1, 1, 6446, 5400, 'tojiki', 20),
(381, 5, 73, 1, 1, 2, NULL, NULL, 'tojiki', 5),
(382, 5, 49, 1, 1, 1, 5511, 5400, 'tojiki', 15),
(383, 5, 49, 1, 1, 2, NULL, NULL, 'tojiki', 10),
(384, 5, 38, 1, 1, 1, 4711, 100000, 'tojiki', 15),
(385, 5, 38, 1, 1, 2, NULL, NULL, 'tojiki', 10),
(386, 5, 71, 1, 1, 1, 4656, 10000, 'tojiki', 20),
(387, 5, 71, 1, 1, 2, NULL, NULL, 'tojiki', 5),
(388, 5, 86, 1, 1, 1, 5031, 5400, 'tojiki', 13),
(389, 5, 86, 1, 1, 2, NULL, NULL, 'tojiki', 12),
(390, 5, 67, 1, 1, 2, NULL, NULL, 'tojiki', 6),
(391, 5, 67, 1, 1, 1, 6066, 5400, 'tojiki', 19),
(392, 5, 66, 1, 1, 1, 6066, 5400, 'tojiki', 44),
(393, 5, 66, 1, 1, 2, NULL, NULL, 'tojiki', 6),
(394, 5, 142, 1, 2, 1, 5465, 5400, 'tojiki', 10),
(395, 5, 6, 1, 1, 2, NULL, NULL, 'tojiki', 10),
(396, 5, 6, 1, 1, 1, 4210, 5400, 'tojiki', 46),
(575, 7, 2, 1, 1, 1, 4000, 10000, 'tojiki', 17),
(397, 5, 1, 1, 1, 1, 4970, 10000, 'tojiki', 20),
(398, 5, 1, 1, 1, 2, NULL, NULL, 'tojiki', 5),
(399, 5, 28, 1, 1, 1, 5611, 10000, 'tojiki', 20),
(400, 5, 28, 1, 1, 2, NULL, NULL, 'tojiki', 5),
(401, 5, 79, 1, 1, 1, 5751, 5400, 'tojiki', 20),
(402, 5, 79, 1, 1, 2, NULL, NULL, 'tojiki', 5),
(403, 5, 68, 1, 1, 1, 6446, 100000, 'tojiki', 95),
(404, 5, 68, 1, 1, 2, NULL, NULL, 'tojiki', 5),
(405, 5, 138, 1, 2, 1, 6235, 5400, 'tojiki', 10),
(406, 5, 50, 1, 1, 1, 6411, 5400, 'tojiki', 41),
(407, 5, 50, 1, 1, 2, NULL, NULL, 'tojiki', 9),
(408, 5, 70, 1, 1, 1, 6411, 10000, 'tojiki', 20),
(409, 5, 70, 1, 1, 2, NULL, NULL, 'tojiki', 5),
(410, 5, 77, 1, 1, 1, 6446, 10000, 'tojiki', 70),
(411, 5, 77, 1, 1, 2, NULL, NULL, 'tojiki', 5),
(412, 5, 72, 1, 1, 1, 6546, 10000, 'tojiki', 20),
(413, 5, 72, 1, 1, 2, NULL, NULL, 'tojiki', 5),
(414, 5, 103, 1, 1, 1, 4000, 10000, 'rusi', 25),
(415, 5, 104, 1, 1, 1, 4000, 10000, 'rusi', 25),
(416, 5, 105, 1, 1, 1, 4000, 10000, 'rusi', 25),
(418, 6, 103, 1, 1, 1, 6000, 6500, 'rusi', 10),
(419, 6, 104, 1, 1, 1, 6000, 6500, 'rusi', 10),
(420, 6, 105, 1, 1, 1, 4365, 6500, 'rusi', 5),
(421, 7, 55, 1, 1, 1, 7000, 5400, 'tojiki', 45),
(422, 7, 55, 1, 1, 2, NULL, NULL, 'tojiki', 5),
(423, 7, 55, 1, 1, 1, 7000, NULL, 'rusi', 20),
(424, 7, 128, 1, 2, 1, 5600, 5400, 'tojiki', 25),
(425, 7, 55, 1, 1, 2, NULL, NULL, 'rusi', 5),
(426, 7, 33, 1, 1, 1, 6100, 7545, 'rusi', 25),
(427, 7, 33, 1, 1, 2, NULL, NULL, 'tojiki', 5),
(428, 7, 33, 1, 1, 1, 6100, 7545, 'tojiki', 20),
(429, 7, 134, 1, 2, 1, 4700, 5400, 'tojiki', 25),
(431, 7, 45, 1, 1, 1, 6100, 5400, 'tojiki', 45),
(432, 7, 45, 1, 1, 2, NULL, NULL, 'rusi', 5),
(433, 7, 45, 1, 1, 2, NULL, NULL, 'tojiki', 5),
(434, 7, 125, 1, 2, 1, 4430, 5400, 'rusi', 20),
(435, 7, 13, 1, 1, 1, 5113, 5400, 'tojiki', 45),
(436, 7, 13, 1, 1, 2, NULL, NULL, 'tojiki', 5),
(437, 7, 62, 1, 1, 1, 4711, 5400, 'tojiki', 20),
(438, 7, 62, 1, 1, 2, NULL, NULL, 'tojiki', 5),
(439, 7, 146, 1, 2, 1, 4210, 5400, 'tojiki', 20),
(440, 7, 6, 1, 1, 2, NULL, NULL, 'tojiki', 5),
(441, 7, 6, 1, 1, 1, 4912, 5400, 'tojiki', 45),
(442, 7, 19, 1, 1, 1, 4000, 5400, 'rusi', 45),
(443, 7, 19, 1, 1, 2, NULL, NULL, 'rusi', 5),
(444, 7, 12, 1, 1, 1, 4000, 5400, 'tojiki', 20),
(445, 7, 12, 1, 1, 2, NULL, NULL, 'tojiki', 5),
(446, 7, 40, 1, 1, 1, 4000, 5400, 'tojiki', 17),
(447, 7, 40, 1, 1, 2, NULL, NULL, 'tojiki', 8),
(448, 7, 59, 1, 1, 1, 5000, 5400, 'rusi', 45),
(449, 7, 129, 1, 2, 1, 4000, 5400, 'tojiki', 25),
(450, 7, 59, 1, 1, 2, NULL, NULL, 'tojiki', 5),
(451, 7, 63, 1, 1, 1, 4000, 5400, 'tojiki', 17),
(452, 7, 63, 1, 1, 2, NULL, NULL, 'tojiki', 8),
(453, 7, 18, 1, 1, 1, 4403, NULL, 'tojiki', 20),
(454, 7, 18, 1, 1, 2, NULL, NULL, 'tojiki', 5),
(455, 7, 18, 1, 1, 2, NULL, NULL, 'rusi', 5),
(456, 7, 18, 1, 1, 1, 4403, 5400, 'rusi', 20),
(457, 7, 136, 1, 2, 1, 3160, 10000, 'tojiki', 25),
(458, 7, 39, 1, 1, 1, 4403, 5400, 'tojiki', 20),
(459, 7, 39, 1, 1, 2, NULL, NULL, 'tojiki', 5),
(460, 7, 14, 1, 1, 1, 4565, 5400, 'tojiki', 45),
(461, 7, 14, 1, 1, 2, NULL, NULL, 'tojiki', 5),
(462, 7, 137, 1, 2, 1, 3270, 5400, 'tojiki', 20),
(463, 7, 51, 1, 1, 1, 7000, 5400, 'rusi', 20),
(464, 7, 51, 1, 1, 1, 7000, 10000, 'tojiki', 45),
(465, 7, 51, 1, 1, 2, NULL, NULL, 'rusi', 5),
(466, 7, 51, 1, 1, 1, 6065, 5400, 'rusi', 23),
(467, 7, 51, 1, 1, 2, NULL, NULL, 'tojiki', 5),
(468, 7, 126, 1, 2, 1, 5460, 5400, 'tojiki', 20),
(469, 7, 58, 1, 1, 2, NULL, NULL, 'tojiki', 5),
(470, 7, 58, 1, 1, 2, NULL, NULL, 'rusi', 5),
(471, 7, 58, 1, 1, 1, 7000, 7545, 'rusi', 20),
(472, 7, 58, 1, 1, 1, 7000, 10000, 'tojiki', 20),
(473, 7, 127, 1, 2, 1, 5465, 7545, 'tojiki', 25),
(474, 7, 32, 1, 1, 2, NULL, NULL, 'rusi', 5),
(475, 7, 133, 1, 2, 1, 4700, 7545, 'tojiki', 65),
(476, 7, 32, 1, 1, 1, 5781, 7545, 'rusi', 20),
(477, 7, 32, 1, 1, 2, NULL, NULL, 'tojiki', 5),
(478, 7, 32, 1, 1, 1, 5781, 7545, 'tojiki', 20),
(479, 7, 61, 1, 1, 1, 4911, 5400, 'tojiki', 45),
(480, 7, 61, 1, 1, 2, NULL, NULL, 'tojiki', 5),
(481, 7, 135, 1, 2, 1, 3400, 5400, 'tojiki', 20),
(482, 7, 7, 1, 1, 1, 5561, 5400, 'tojiki', 20),
(483, 7, 7, 1, 1, 2, NULL, NULL, 'tojiki', 5),
(484, 7, 8, 1, 1, 1, 4912, 5400, 'tojiki', 20),
(485, 7, 8, 1, 1, 2, NULL, NULL, 'tojiki', 5),
(486, 7, 20, 1, 1, 1, 5013, 5400, 'tojiki', 45),
(487, 7, 20, 1, 1, 2, NULL, NULL, 'tojiki', 5),
(488, 7, 152, 1, 2, 1, 4365, 5400, 'rusi', 20),
(489, 7, 68, 1, 1, 1, 7000, 100000, 'tojiki', 45),
(490, 7, 68, 1, 1, 2, NULL, NULL, 'tojiki', 5),
(491, 7, 138, 1, 2, 1, 6235, 5400, 'tojiki', 25),
(492, 7, 66, 1, 1, 1, 7000, 5400, 'tojiki', 95),
(493, 7, 66, 1, 1, 2, NULL, NULL, 'tojiki', 5),
(494, 7, 142, 1, 2, 1, 5600, 5400, 'tojiki', 20),
(495, 7, 67, 1, 1, 2, NULL, NULL, 'tojiki', 5),
(496, 7, 67, 1, 1, 1, 6066, 5400, 'tojiki', 95),
(497, 7, 53, 1, 1, 1, 6446, 5400, 'tojiki', 20),
(498, 7, 53, 1, 1, 2, NULL, NULL, 'tojiki', 5),
(499, 7, 47, 1, 1, 1, 6411, 7545, 'tojiki', 48),
(500, 7, 47, 1, 1, 2, NULL, NULL, 'tojiki', 2),
(501, 7, 47, 1, 1, 2, NULL, NULL, 'rusi', 3),
(502, 7, 47, 1, 1, 1, 6411, 5400, 'rusi', 22),
(503, 7, 143, 1, 2, 1, 5465, 5400, 'rusi', 25),
(504, 7, 34, 1, 1, 1, 6111, 5400, 'tojiki', 20),
(505, 7, 34, 1, 1, 2, NULL, NULL, 'tojiki', 5),
(506, 7, 48, 1, 1, 1, 6211, 5400, 'rusi', 25),
(507, 7, 48, 1, 1, 2, NULL, NULL, 'tojiki', 5),
(508, 7, 48, 1, 1, 1, 6211, 5400, 'tojiki', 20),
(509, 7, 50, 1, 1, 1, 6411, 5400, 'tojiki', 40),
(510, 7, 50, 1, 1, 2, NULL, NULL, 'tojiki', 10),
(511, 7, 16, 1, 1, 1, 5411, 10000, 'tojiki', 20),
(512, 7, 16, 1, 1, 2, NULL, NULL, 'tojiki', 5),
(513, 7, 73, 1, 1, 1, 6446, 5400, 'tojiki', 20),
(514, 7, 73, 1, 1, 2, NULL, NULL, 'tojiki', 5),
(515, 7, 77, 1, 1, 1, 7000, 10000, 'tojiki', 45),
(516, 7, 77, 1, 1, 2, NULL, NULL, 'tojiki', 5),
(517, 7, 140, 1, 2, 1, 6235, 10000, 'tojiki', 20),
(518, 7, 56, 1, 1, 1, 6446, 5400, 'tojiki', 20),
(519, 7, 56, 1, 1, 2, NULL, NULL, 'tojiki', 5),
(520, 7, 72, 1, 1, 1, 6546, 10000, 'tojiki', 20),
(521, 7, 72, 1, 1, 2, NULL, NULL, 'tojiki', 5),
(522, 7, 71, 1, 1, 1, 6235, 10000, 'tojiki', 20),
(523, 7, 71, 1, 1, 2, NULL, NULL, 'tojiki', 5),
(524, 7, 3, 1, 1, 1, 5031, 5400, 'tojiki', 20),
(525, 7, 3, 1, 1, 2, NULL, NULL, 'tojiki', 5),
(526, 7, 9, 1, 1, 1, 6446, 10000, 'tojiki', 20),
(527, 7, 9, 1, 1, 2, NULL, NULL, 'tojiki', 5),
(528, 7, 91, 1, 1, 1, 4831, 5400, 'tojiki', 20),
(529, 7, 91, 1, 1, 2, NULL, NULL, 'tojiki', 5),
(530, 7, 60, 1, 1, 1, 4060, 5400, 'tojiki', 20),
(531, 7, 60, 1, 1, 2, NULL, NULL, 'tojiki', 5),
(532, 7, 15, 1, 1, 1, 4546, 5400, 'tojiki', 20),
(533, 7, 15, 1, 1, 2, NULL, NULL, 'tojiki', 5),
(534, 7, 1, 1, 1, 1, 4970, 10000, 'tojiki', 20),
(535, 7, 1, 1, 1, 2, NULL, NULL, 'tojiki', 5),
(536, 7, 4, 1, 1, 1, 6456, 5400, 'tojiki', 17),
(537, 7, 4, 1, 1, 2, NULL, NULL, 'tojiki', 8),
(538, 7, 36, 1, 1, 1, 4811, 10000, 'tojiki', 17),
(539, 7, 36, 1, 1, 2, NULL, NULL, 'tojiki', 8),
(540, 7, 23, 1, 1, 1, 4546, 5400, 'tojiki', 17),
(541, 7, 23, 1, 1, 2, NULL, NULL, 'tojiki', 8),
(542, 7, 98, 1, 1, 1, 4546, 5400, 'tojiki', 20),
(543, 7, 98, 1, 1, 2, NULL, NULL, 'tojiki', 5),
(544, 7, 37, 1, 1, 1, 3500, 5400, 'tojiki', 17),
(545, 7, 37, 1, 1, 2, NULL, NULL, 'tojiki', 8),
(546, 7, 79, 1, 1, 1, 5751, 5400, 'tojiki', 15),
(547, 7, 79, 1, 1, 2, NULL, NULL, 'tojiki', 10),
(548, 7, 141, 1, 2, 1, 4000, NULL, 'tojiki', 25),
(549, 7, 28, 1, 1, 1, 5611, 10000, 'tojiki', 20),
(550, 7, 28, 1, 1, 2, NULL, NULL, 'tojiki', 5),
(551, 7, 29, 1, 1, 1, 5311, 5400, 'tojiki', 20),
(552, 7, 29, 1, 1, 2, NULL, NULL, 'tojiki', 5),
(553, 7, 41, 1, 1, 1, 4311, 5400, 'tojiki', 17),
(554, 7, 41, 1, 1, 2, NULL, NULL, 'tojiki', 8),
(555, 7, 42, 1, 1, 1, 3500, 5400, 'tojiki', 17),
(556, 7, 42, 1, 1, 2, NULL, NULL, 'tojiki', 8),
(557, 7, 11, 1, 1, 1, 5161, 7545, 'tojiki', 20),
(558, 7, 11, 1, 1, 2, NULL, NULL, 'tojiki', 5),
(563, 7, 70, 1, 1, 1, 6411, 10000, 'tojiki', 20),
(560, 7, 10, 1, 1, 2, NULL, NULL, 'tojiki', 5),
(561, 7, 10, 1, 1, 1, 4500, 5400, 'tojiki', 20),
(564, 7, 70, 1, 1, 2, NULL, NULL, 'tojiki', 5),
(565, 7, 92, 1, 1, 1, 3600, 10000, 'tojiki', 20),
(566, 7, 92, 1, 1, 2, NULL, NULL, 'tojiki', 5),
(567, 7, 93, 1, 1, 1, 3600, 10000, 'tojiki', 20),
(568, 7, 93, 1, 1, 2, NULL, NULL, 'tojiki', 5),
(569, 7, 99, 1, 1, 1, 3600, 5400, 'tojiki', 20),
(570, 7, 99, 1, 1, 2, NULL, NULL, 'tojiki', 5),
(571, 7, 46, 1, 1, 1, 4500, 5400, 'tojiki', 20),
(572, 7, 46, 1, 1, 2, NULL, NULL, 'tojiki', 5),
(573, 7, 5, 1, 1, 2, NULL, NULL, 'tojiki', 5),
(574, 7, 5, 1, 1, 1, 4620, 10000, 'tojiki', 20),
(576, 7, 2, 1, 1, 2, NULL, NULL, 'tojiki', 8),
(577, 7, 87, 1, 1, 1, 7000, 10000, 'tojiki', 20),
(578, 7, 87, 1, 1, 2, NULL, NULL, 'tojiki', 5),
(579, 7, 149, 1, 2, 1, 5600, 5400, 'tojiki', 25),
(580, 7, 88, 1, 1, 1, 7000, 5400, 'tojiki', 20),
(581, 7, 88, 1, 1, 2, NULL, NULL, 'tojiki', 5),
(582, 7, 85, 1, 1, 1, 5000, 5400, 'tojiki', 20),
(583, 7, 85, 1, 1, 2, NULL, NULL, 'tojiki', 5),
(584, 7, 147, 1, 2, 1, 5000, 10000, 'tojiki', 20),
(585, 7, 49, 1, 1, 1, 5511, 5400, 'tojiki', 20),
(586, 7, 49, 1, 1, 2, NULL, NULL, 'tojiki', 5),
(587, 7, 35, 1, 1, 1, 5361, 5400, 'tojiki', 20),
(588, 7, 35, 1, 1, 2, NULL, NULL, 'tojiki', 5),
(589, 7, 102, 1, 1, 1, 3500, 100000, 'tojiki', 17),
(590, 7, 102, 1, 1, 2, NULL, NULL, 'tojiki', 8),
(591, 7, 81, 1, 1, 1, 3500, 10000, 'tojiki', 20),
(592, 7, 81, 1, 1, 2, NULL, NULL, 'tojiki', 5),
(593, 7, 65, 1, 1, 1, 4000, 5400, 'tojiki', 19),
(594, 7, 65, 1, 1, 2, NULL, NULL, 'tojiki', 6),
(595, 7, 144, 1, 2, 1, 3000, 5400, 'tojiki', 25),
(596, 7, 64, 1, 1, 1, 6000, 10000, 'tojiki', 20),
(597, 7, 64, 1, 1, 2, NULL, NULL, 'tojiki', 5),
(598, 7, 57, 1, 1, 1, 6000, 10000, 'tojiki', 20),
(599, 7, 57, 1, 1, 2, NULL, NULL, 'tojiki', 5),
(600, 7, 43, 1, 1, 1, 4000, 10000, 'tojiki', 20),
(601, 7, 43, 1, 1, 2, NULL, NULL, 'tojiki', 5),
(602, 7, 44, 1, 1, 1, 3500, 10000, 'tojiki', 20),
(603, 7, 44, 1, 1, 2, NULL, NULL, 'tojiki', 5),
(604, 7, 100, 1, 1, 1, 3600, 5400, 'tojiki', 20),
(605, 7, 100, 1, 1, 2, NULL, NULL, 'tojiki', 5),
(606, 7, 101, 1, 1, 1, 3600, 10000, 'tojiki', 20),
(607, 7, 101, 1, 1, 2, NULL, NULL, 'tojiki', 5),
(608, 7, 145, 1, 1, 1, 3500, 10000, 'tojiki', 20),
(609, 7, 165, 1, 1, 1, 5600, 10000, 'tojiki', 20),
(610, 7, 165, 1, 1, 2, NULL, NULL, 'tojiki', 5),
(611, 7, 132, 1, 2, 1, 4000, 10000, 'tojiki', 25),
(612, 7, 82, 1, 1, 1, 4000, NULL, 'tojiki', 20),
(613, 7, 82, 1, 1, 2, NULL, NULL, 'tojiki', 5),
(614, 7, 150, 1, 1, 1, 3000, 10000, 'tojiki', 25),
(615, 7, 90, 1, 1, 1, 4000, 5400, 'tojiki', 20),
(616, 7, 90, 1, 1, 2, NULL, NULL, 'tojiki', 5),
(617, 7, 78, 1, 1, 1, 7000, 100000, 'tojiki', 20),
(618, 7, 78, 1, 1, 1, 7000, 100000, 'rusi', 20),
(619, 7, 78, 1, 1, 2, NULL, NULL, 'tojiki', 5),
(620, 7, 78, 1, 1, 2, NULL, NULL, 'rusi', 5),
(621, 5, 166, 1, 1, 1, NULL, NULL, 'tojiki', 25),
(622, 7, 166, 1, 2, 1, 5000, 5400, 'tojiki', 25),
(623, 7, 76, 1, 1, 1, 6000, 100000, 'tojiki', 20),
(624, 7, 76, 1, 1, 2, NULL, NULL, 'tojiki', 5),
(625, 7, 69, 1, 1, 1, 5500, 5400, 'tojiki', 20),
(626, 7, 69, 1, 1, 2, NULL, NULL, 'tojiki', 5),
(627, 7, 27, 1, 1, 1, 3500, 10000, 'tojiki', 20),
(628, 7, 27, 1, 1, 2, NULL, NULL, 'tojiki', 5),
(631, 7, 54, 1, 1, 1, 5500, 100000, 'tojiki', 20),
(632, 7, 54, 1, 1, 2, NULL, NULL, 'tojiki', 5),
(633, 7, 130, 1, 2, 1, 4000, 100000, 'tojiki', 25),
(634, 7, 26, 1, 1, 1, 3500, 5400, 'tojiki', 20),
(635, 7, 26, 1, 1, 2, NULL, NULL, 'tojiki', 5),
(636, 7, 25, 1, 1, 1, 3500, 100000, 'tojiki', 20),
(637, 7, 25, 1, 1, 2, NULL, NULL, 'tojiki', 5),
(638, 7, 80, 1, 1, 1, 3500, 10000, 'tojiki', 20),
(639, 7, 80, 1, 1, 2, NULL, NULL, 'tojiki', 5),
(640, 7, 148, 1, 2, 1, 3000, 100000, 'tojiki', 25),
(641, 7, 83, 1, 1, 1, 5000, 100000, 'tojiki', 20),
(642, 7, 83, 1, 1, 2, NULL, NULL, 'tojiki', 5),
(643, 7, 24, 1, 1, 1, 3500, 100000, 'tojiki', 20),
(644, 7, 24, 1, 1, 2, NULL, NULL, 'tojiki', 5),
(645, 7, 89, 1, 1, 1, 4000, 100000, 'tojiki', 20),
(646, 7, 89, 1, 1, 2, NULL, NULL, 'tojiki', 5),
(647, 7, 30, 1, 1, 1, 4500, 100000, 'tojiki', 20),
(648, 7, 30, 1, 1, 2, NULL, NULL, 'tojiki', 5),
(649, 7, 86, 1, 1, 1, 3500, 5400, 'tojiki', 20),
(650, 7, 86, 1, 1, 2, NULL, NULL, 'tojiki', 5),
(651, 7, 103, 1, 1, 1, 3500, 5400, 'rusi', 25),
(652, 7, 104, 1, 1, 1, 3500, 10000, 'rusi', 25),
(653, 7, 105, 1, 1, 1, 3500, 10000, 'rusi', 25),
(654, 7, 107, 1, 1, 1, 3500, 10000, 'rusi', 25),
(655, 7, 106, 1, 1, 1, 3500, 100000, 'rusi', 25),
(656, 6, 58, 1, 1, 2, NULL, NULL, 'tojiki', 10),
(657, 6, 58, 1, 1, 2, NULL, NULL, 'rusi', 3),
(658, 6, 58, 1, 1, 1, 6366, 8570, 'rusi', 22),
(659, 6, 58, 1, 1, 1, 6366, 8570, 'tojiki', 75),
(660, 6, 127, 1, 2, 1, 5465, 6000, 'tojiki', 10),
(664, 6, 134, 1, 2, 1, 4700, 6000, 'tojiki', 10),
(662, 6, 33, 1, 1, 2, NULL, NULL, 'tojiki', 3),
(663, 6, 33, 1, 1, 1, 5781, 8570, 'tojiki', 22),
(665, 6, 45, 1, 1, 1, 5768, 8570, 'rusi', 23),
(666, 6, 45, 1, 1, 1, 5768, 8570, 'tojiki', 40),
(667, 6, 45, 1, 1, 2, NULL, NULL, 'rusi', 2),
(668, 6, 45, 1, 1, 2, NULL, NULL, 'tojiki', 10),
(669, 6, 125, 1, 2, 1, 4430, 6000, 'rusi', 10),
(670, 6, 7, 1, 1, 1, 5561, 8570, 'tojiki', 16),
(671, 6, 7, 1, 1, 2, NULL, NULL, 'tojiki', 5),
(672, 6, 13, 1, 1, 1, 5113, 8570, 'tojiki', 22),
(673, 6, 13, 1, 1, 2, NULL, NULL, 'tojiki', 3),
(674, 6, 62, 1, 1, 1, 4711, 6500, 'tojiki', 17),
(675, 6, 62, 1, 1, 2, NULL, NULL, 'tojiki', 3),
(676, 6, 6, 1, 1, 2, NULL, NULL, 'tojiki', 5),
(677, 6, 6, 1, 1, 1, 4210, 6500, 'tojiki', 10),
(678, 6, 146, 1, 2, 1, 4210, 6500, 'tojiki', 10),
(679, 6, 19, 1, 1, 1, 4303, 6500, 'rusi', 10),
(680, 6, 19, 1, 1, 2, NULL, NULL, 'rusi', 5),
(681, 6, 12, 1, 1, 1, 4403, 5400, 'tojiki', 20),
(682, 6, 12, 1, 1, 2, NULL, NULL, 'tojiki', 5),
(683, 6, 40, 1, 1, 1, 4739, 6500, 'tojiki', 20),
(684, 6, 40, 1, 1, 2, NULL, NULL, 'tojiki', 5),
(685, 6, 56, 1, 1, 1, 6446, 6500, 'tojiki', 20),
(686, 6, 56, 1, 1, 2, NULL, NULL, 'tojiki', 5),
(687, 6, 59, 1, 2, 1, 5751, 6500, 'tojiki', 5),
(688, 6, 59, 1, 1, 2, NULL, NULL, 'tojiki', 5),
(689, 6, 129, 1, 2, 1, 4400, 6000, 'tojiki', 10),
(690, 6, 63, 1, 1, 1, 4546, 6500, 'tojiki', 5),
(691, 6, 63, 1, 1, 2, NULL, NULL, 'tojiki', 5),
(692, 6, 18, 1, 1, 1, 4403, 6500, 'tojiki', 15),
(693, 6, 18, 1, 1, 2, NULL, NULL, 'tojiki', 10),
(694, 6, 136, 1, 2, 1, 3160, 6000, 'tojiki', 10),
(695, 6, 39, 1, 1, 1, 4403, 6500, 'tojiki', 15),
(696, 6, 39, 1, 1, 2, NULL, NULL, 'tojiki', 10),
(697, 6, 14, 1, 1, 1, 4565, 6500, 'tojiki', 55),
(698, 6, 14, 1, 1, 2, NULL, NULL, 'tojiki', 5),
(699, 6, 137, 1, 2, 1, 3270, 6000, 'tojiki', 10),
(700, 6, 51, 1, 1, 1, 6065, 6500, 'tojiki', 85),
(703, 6, 126, 1, 2, 1, 5465, 6000, 'tojiki', 10),
(702, 6, 51, 1, 1, 1, 6065, 6500, 'rusi', 25),
(704, 6, 61, 1, 1, 1, 4911, 6500, 'tojiki', 40),
(705, 6, 61, 1, 1, 2, NULL, NULL, 'tojiki', 10),
(706, 6, 135, 1, 2, 1, 3400, 6000, 'tojiki', 10),
(707, 6, 55, 1, 1, 2, NULL, NULL, 'tojiki', 10),
(708, 6, 55, 1, 1, 1, 6171, 8570, 'tojiki', 75),
(709, 6, 55, 1, 1, 2, NULL, NULL, 'rusi', 3),
(710, 6, 55, 1, 1, 1, 6171, 8570, 'rusi', 22),
(711, 6, 128, 1, 2, 1, 5461, 8000, 'tojiki', 10),
(712, 6, 8, 1, 1, 2, NULL, NULL, 'tojiki', 5),
(713, 6, 8, 1, 1, 1, 4942, 6500, 'tojiki', 25),
(718, 6, 67, 1, 1, 1, 6066, 6500, 'tojiki', 20),
(715, 6, 66, 1, 1, 2, NULL, NULL, 'tojiki', 5),
(716, 6, 66, 1, 1, 1, 6066, 6500, 'tojiki', 45),
(717, 6, 142, 1, 2, 1, 5465, 6000, 'tojiki', 10),
(721, 6, 20, 1, 1, 1, 5013, 6500, 'tojiki', 7),
(720, 6, 67, 1, 1, 2, NULL, NULL, 'tojiki', 5),
(722, 6, 20, 1, 1, 2, NULL, NULL, 'tojiki', 5),
(723, 6, 152, 1, 2, 1, 4365, 6000, 'tojiki', 10),
(724, 6, 53, 1, 1, 1, 6446, 6500, 'tojiki', 20),
(725, 6, 53, 1, 1, 2, NULL, NULL, 'tojiki', 5),
(726, 6, 21, 1, 1, 1, 3535, 6500, 'tojiki', 5),
(727, 6, 21, 1, 1, 2, NULL, NULL, 'tojiki', 2),
(728, 6, 34, 1, 1, 1, 6111, 6500, 'tojiki', 17),
(729, 6, 34, 1, 1, 2, NULL, NULL, 'tojiki', 8),
(730, 6, 138, 1, 2, 1, 6235, 6000, 'tojiki', 10),
(731, 6, 52, 1, 1, 1, 4213, 6500, 'tojiki', 5),
(732, 6, 52, 1, 1, 2, NULL, NULL, 'tojiki', 10),
(734, 6, 22, 1, 1, 1, 3635, 6500, 'tojiki', 5),
(735, 6, 22, 1, 1, 2, NULL, NULL, 'tojiki', 2),
(736, 6, 73, 1, 1, 1, 6446, 6500, 'tojiki', 20),
(737, 6, 77, 1, 1, 1, 6446, 6500, 'tojiki', 45),
(738, 6, 77, 1, 1, 2, NULL, NULL, 'tojiki', 5),
(739, 6, 140, 1, 2, 1, 6235, 6000, 'tojiki', 10),
(740, 6, 72, 1, 1, 1, 6546, 6500, 'tojiki', 10),
(741, 6, 72, 1, 1, 2, NULL, NULL, 'tojiki', 5),
(742, 6, 74, 1, 1, 1, 6235, 6500, 'tojiki', 5),
(743, 6, 74, 1, 1, 2, NULL, NULL, 'tojiki', 2),
(744, 6, 75, 1, 1, 1, 6235, 6500, 'tojiki', 5),
(745, 6, 71, 1, 1, 1, 6235, 6500, 'tojiki', 5),
(746, 6, 71, 1, 1, 2, NULL, NULL, 'tojiki', 5),
(747, 6, 3, 1, 1, 1, 5031, 6500, 'tojiki', 5),
(748, 6, 3, 1, 1, 2, NULL, NULL, 'tojiki', 10),
(749, 6, 9, 1, 1, 1, 6446, 6500, 'tojiki', 10),
(750, 6, 91, 1, 1, 1, 4831, 6500, 'tojiki', 5),
(830, 6, 98, 1, 1, 1, 4546, 6500, 'tojiki', 5),
(752, 6, 15, 1, 1, 1, 4546, 6500, 'tojiki', 5),
(753, 6, 15, 1, 1, 2, NULL, NULL, 'tojiki', 5),
(754, 6, 1, 1, 1, 1, 4970, 6500, 'tojiki', 5),
(755, 6, 1, 1, 1, 2, NULL, NULL, 'tojiki', 5),
(756, 6, 4, 1, 1, 1, 6556, 6500, 'tojiki', 5),
(757, 6, 4, 1, 1, 2, NULL, NULL, 'tojiki', 5),
(758, 6, 84, 1, 1, 1, 5031, 6500, 'tojiki', 10),
(759, 6, 84, 1, 1, 2, NULL, NULL, 'tojiki', 5),
(760, 6, 23, 1, 1, 1, 4546, 6500, 'tojiki', 5),
(761, 6, 23, 1, 1, 2, NULL, NULL, 'tojiki', 5),
(762, 6, 37, 1, 1, 1, 4931, 6500, 'tojiki', 5),
(763, 6, 47, 1, 1, 1, 6411, 6500, 'tojiki', 30),
(764, 6, 47, 1, 1, 2, NULL, NULL, 'tojiki', 10),
(765, 6, 143, 1, 2, 1, 5665, 6000, 'tojiki', 10),
(766, 6, 48, 1, 1, 1, 6211, 6500, 'tojiki', 20),
(767, 6, 48, 1, 1, 2, NULL, NULL, 'tojiki', 5),
(768, 6, 50, 1, 1, 1, 6411, 6500, 'tojiki', 10),
(769, 6, 50, 1, 1, 2, NULL, NULL, 'tojiki', 5),
(770, 6, 16, 1, 1, 1, 5411, 6500, 'tojiki', 10),
(771, 6, 16, 1, 1, 2, NULL, NULL, 'tojiki', 5),
(772, 6, 97, 1, 1, 1, 4811, 6500, 'tojiki', 5),
(773, 6, 97, 1, 1, 2, NULL, NULL, 'tojiki', 3),
(774, 6, 60, 1, 1, 1, 4060, 6500, 'tojiki', 20),
(775, 6, 60, 1, 1, 2, NULL, NULL, 'tojiki', 5),
(776, 6, 96, 1, 1, 1, 4811, 6500, 'tojiki', 5),
(777, 6, 96, 1, 1, 2, NULL, NULL, 'tojiki', 5),
(778, 6, 79, 1, 1, 1, 5751, 6500, 'tojiki', 20),
(779, 6, 79, 1, 1, 2, NULL, NULL, 'tojiki', 5),
(780, 6, 141, 1, 2, 1, 4000, 6000, 'tojiki', 10),
(781, 6, 28, 1, 1, 1, 5611, 6500, 'tojiki', 49),
(782, 6, 28, 1, 1, 2, NULL, NULL, 'tojiki', 3),
(783, 6, 29, 1, 1, 1, 5311, 6500, 'tojiki', 40),
(784, 6, 29, 1, 1, 2, NULL, NULL, 'tojiki', 5),
(785, 6, 41, 1, 1, 1, 4311, 6500, 'tojiki', 10),
(786, 6, 41, 1, 1, 2, NULL, NULL, 'tojiki', 5),
(787, 6, 42, 1, 1, 1, 3500, 6500, 'tojiki', 10),
(788, 6, 42, 1, 1, 2, NULL, NULL, 'tojiki', 5),
(789, 6, 11, 1, 1, 1, 5161, 6500, 'tojiki', 10),
(790, 6, 11, 1, 1, 2, NULL, NULL, 'tojiki', 5),
(791, 6, 10, 1, 1, 1, 5161, 6500, 'tojiki', 2),
(792, 6, 10, 1, 1, 2, NULL, NULL, 'tojiki', 2),
(793, 6, 70, 1, 1, 1, 6411, 6500, 'tojiki', 15),
(794, 6, 70, 1, 1, 2, NULL, NULL, 'tojiki', 5),
(795, 6, 92, 1, 1, 1, 4711, 6500, 'tojiki', 5),
(796, 6, 92, 1, 1, 2, NULL, NULL, 'tojiki', 5),
(797, 6, 163, 1, 1, 1, 4711, 6500, 'tojiki', 10),
(798, 6, 163, 1, 1, 2, NULL, NULL, 'tojiki', 5),
(799, 6, 101, 1, 1, 1, 4711, 6500, 'tojiki', 10),
(800, 6, 100, 1, 1, 2, NULL, NULL, 'tojiki', 5),
(801, 6, 145, 1, 2, 1, 3500, 6000, 'tojiki', 10),
(802, 6, 46, 1, 1, 1, 5691, 6500, 'tojiki', 5),
(803, 6, 46, 1, 1, 2, NULL, NULL, 'tojiki', 5),
(804, 6, 5, 1, 1, 1, 4620, 6500, 'tojiki', 5),
(805, 6, 5, 1, 1, 2, NULL, NULL, 'tojiki', 5),
(806, 6, 2, 1, 1, 1, 4711, 6500, 'tojiki', 5),
(807, 6, 2, 1, 1, 2, NULL, NULL, 'tojiki', 2),
(808, 6, 38, 1, 1, 1, 4000, 6500, 'tojiki', 5),
(809, 6, 38, 1, 1, 2, NULL, NULL, 'tojiki', 2),
(810, 6, 87, 1, 1, 1, 5411, 6500, 'tojiki', 30),
(811, 6, 87, 1, 1, 2, NULL, NULL, 'tojiki', 5),
(812, 6, 88, 1, 1, 1, 6211, 6500, 'tojiki', 30),
(813, 6, 88, 1, 1, 2, NULL, NULL, 'tojiki', 5),
(814, 6, 85, 1, 1, 1, 3996, 6500, 'tojiki', 30),
(815, 6, 85, 1, 1, 2, NULL, NULL, 'tojiki', 5),
(816, 6, 147, 1, 2, 1, 3996, 6000, 'tojiki', 10),
(817, 6, 49, 1, 1, 1, 5511, 6500, 'tojiki', 20),
(818, 6, 49, 1, 1, 2, NULL, NULL, 'tojiki', 5),
(819, 6, 35, 1, 1, 1, 5361, 6500, 'tojiki', 10),
(820, 6, 35, 1, 1, 2, NULL, NULL, 'tojiki', 5),
(821, 6, 102, 1, 1, 1, 4711, 6500, 'tojiki', 10),
(822, 6, 102, 1, 1, 2, NULL, NULL, 'tojiki', 5),
(823, 6, 81, 1, 1, 1, 4711, 6500, 'tojiki', 10),
(824, 6, 81, 1, 1, 2, NULL, NULL, 'tojiki', 5),
(825, 6, 32, 1, 1, 1, 5781, 6500, 'tojiki', 55),
(826, 6, 32, 1, 1, 2, NULL, NULL, 'tojiki', 5),
(827, 6, 133, 1, 2, 1, 4700, 6000, 'tojiki', 10),
(831, 6, 98, 1, 1, 2, NULL, NULL, 'tojiki', 5),
(829, 6, 91, 1, 1, 2, NULL, NULL, 'tojiki', 5);

-- --------------------------------------------------------

--
-- Структура таблицы `questions`
--

CREATE TABLE `questions` (
  `id` int NOT NULL,
  `id_faculty` int NOT NULL,
  `id_s_l` int NOT NULL,
  `id_s_v` int NOT NULL,
  `id_course` int NOT NULL,
  `id_spec` int NOT NULL,
  `id_fan` int NOT NULL,
  `lang` varchar(2) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `type` int NOT NULL,
  `rating` int NOT NULL DEFAULT '1',
  `text` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `s_y` int NOT NULL,
  `h_y` int NOT NULL,
  `author` int NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Структура таблицы `rasidho`
--

CREATE TABLE `rasidho` (
  `id` int NOT NULL,
  `tranid` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `type` int NOT NULL DEFAULT '1' COMMENT '1-Қабули ҳуҷҷат\r\n2-Шартномаи таҳсил 3-Хобгоҳ 4 5 6',
  `id_student` int NOT NULL,
  `payed_from` varchar(1500) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `check_date` date NOT NULL,
  `check_money` float NOT NULL,
  `bank` int DEFAULT NULL,
  `payed` int NOT NULL DEFAULT '0',
  `payed_date` datetime DEFAULT NULL,
  `payed_author` int DEFAULT NULL,
  `s_y` int NOT NULL,
  `author` int DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb3;

-- --------------------------------------------------------

--
-- Структура таблицы `rasid_module`
--

CREATE TABLE `rasid_module` (
  `id` int NOT NULL,
  `id_user` int NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Дамп данных таблицы `rasid_module`
--

INSERT INTO `rasid_module` (`id`, `id_user`) VALUES
(1, 52);

-- --------------------------------------------------------

--
-- Структура таблицы `rat`
--

CREATE TABLE `rat` (
  `id` int NOT NULL,
  `id_user` int NOT NULL,
  `author` int NOT NULL,
  `file` varchar(250) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `date` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Дублирующая структура для представления `real_faculties`
-- (См. Ниже фактическое представление)
--
CREATE TABLE `real_faculties` (
`id_faculty` int
,`title` varchar(250)
,`short_title` varchar(150)
,`s_y` int
,`h_y` int
);

-- --------------------------------------------------------

--
-- Структура таблицы `regions`
--

CREATE TABLE `regions` (
  `id` int NOT NULL,
  `id_country` int DEFAULT NULL,
  `name` varchar(500) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb3;

--
-- Дамп данных таблицы `regions`
--

INSERT INTO `regions` (`id`, `id_country`, `name`) VALUES
(1, 1, 'Вилояти Хатлон'),
(2, 1, 'Вилояти Мухтори Кӯҳистони Бадахшон'),
(3, 1, 'Вилояти Суғд'),
(4, 1, 'Ноҳияҳои тобеи ҷумҳурӣ'),
(5, 1, 'Шаҳри Душанбе'),
(7, 4, 'Шаҳри Кобул'),
(8, 2, 'Вилояти Сурхандарё'),
(9, 4, 'Вилояти Бадахшон');

-- --------------------------------------------------------

--
-- Структура таблицы `results`
--

CREATE TABLE `results` (
  `id` int NOT NULL,
  `id_faculty` int DEFAULT NULL,
  `id_s_l` int DEFAULT NULL,
  `id_s_v` int DEFAULT NULL,
  `id_course` int DEFAULT NULL,
  `id_spec` int DEFAULT NULL,
  `id_group` int DEFAULT NULL,
  `id_student` int NOT NULL,
  `id_fan` int NOT NULL,
  `type` int DEFAULT NULL COMMENT '1 - имтиҳон, 2 - маҳорат, 3 - кори курси, 4 - таҷрибаомӯзи',
  `nf_1_score` float DEFAULT '0',
  `nf_1_absent` float DEFAULT '0',
  `nf_1_score_r` int DEFAULT NULL,
  `nf_1_add_date` varchar(30) DEFAULT NULL,
  `nf_1_author` int DEFAULT NULL,
  `nf_2_score` float DEFAULT '0',
  `nf_2_absent` float DEFAULT '0',
  `nf_2_score_r` int DEFAULT NULL,
  `nf_2_add_date` varchar(30) DEFAULT NULL,
  `nf_2_author` int DEFAULT NULL,
  `imt_status` int DEFAULT '0',
  `imt_score` float DEFAULT NULL,
  `imt_add_date` varchar(30) DEFAULT NULL,
  `imt_author` int DEFAULT NULL,
  `total_score` float DEFAULT NULL,
  `total_score_author` int DEFAULT NULL,
  `trimestr_status` int DEFAULT NULL,
  `trimestr_score` float DEFAULT NULL,
  `trimestr_add_date` varchar(30) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `trimestr_author` int DEFAULT NULL,
  `kori_kursi` int DEFAULT NULL,
  `kori_kursi_add_date` varchar(30) DEFAULT NULL,
  `kori_kursi_author` int DEFAULT NULL,
  `semestr` int DEFAULT NULL,
  `s_y` int DEFAULT NULL,
  `h_y` int DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb3;

-- --------------------------------------------------------

--
-- Структура таблицы `results_student`
--

CREATE TABLE `results_student` (
  `id` int NOT NULL,
  `id_fan` int NOT NULL,
  `id_teacher` int NOT NULL,
  `score` float NOT NULL,
  `date` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Структура таблицы `results_teacher`
--

CREATE TABLE `results_teacher` (
  `id` int NOT NULL,
  `id_fan` int NOT NULL,
  `id_teacher` int NOT NULL,
  `score` float NOT NULL,
  `date` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Структура таблицы `results_variants`
--

CREATE TABLE `results_variants` (
  `id` int NOT NULL,
  `id_student` int NOT NULL,
  `id_fan` int NOT NULL,
  `id_questions` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci,
  `id_answers` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci,
  `date` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `s_y` int NOT NULL,
  `h_y` int NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Структура таблицы `sarboriho`
--

CREATE TABLE `sarboriho` (
  `id` int NOT NULL,
  `id_iqtibos` int NOT NULL,
  `type` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `soat` float NOT NULL,
  `id_teacher` int NOT NULL,
  `author` int DEFAULT NULL,
  `date_add` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `editor` int DEFAULT NULL,
  `date_update` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `s_y` int NOT NULL DEFAULT '23'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Структура таблицы `score_history`
--

CREATE TABLE `score_history` (
  `id` int NOT NULL,
  `id_student` int NOT NULL,
  `id_fan` int NOT NULL,
  `score_type` int NOT NULL COMMENT '1 - КМД Р1, \r\n2 - ДАВОМОТ Р1,\r\n3 - РЕЙТИНГ 1, \r\n4 - КМД Р2, \r\n5 - ДАВОМОТ Р2,\r\n6 - РЕЙТИНГ 2, \r\n7- ИМТИХОН',
  `old_score` float NOT NULL,
  `new_score` float NOT NULL,
  `date` varchar(30) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL,
  `author` int NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb3;

-- --------------------------------------------------------

--
-- Структура таблицы `shurbo`
--

CREATE TABLE `shurbo` (
  `id` int NOT NULL,
  `id_student` int NOT NULL,
  `text` text,
  `s_y` int NOT NULL,
  `h_y` int NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb3;

--
-- Дамп данных таблицы `shurbo`
--

INSERT INTO `shurbo` (`id`, `id_student`, `text`, `s_y`, `h_y`) VALUES
(6, 66, 'Барои дарсшикани зиёда аз 51 соат.', 24, 1),
(7, 81, 'Барои дарсшикани зиёда аз 57 соат.', 24, 1),
(331, 1961, 'Барои дарсшикани зиёда аз 118 соат.', 24, 1),
(14, 155, 'Барои дарсшикани зиёда аз 105 соат.', 24, 1),
(16, 178, 'Барои дарсшикани зиёда аз 49 соат.', 24, 1),
(19, 187, 'Барои дарсшикани зиёда аз 98 соат.', 24, 1),
(20, 193, 'Барои дарсшикани зиёда аз 53 соат.', 24, 1),
(313, 778, 'Барои дарсшикани зиёда аз 74 соат.', 24, 1),
(25, 236, 'Барои дарсшикани зиёда аз 71 соат.', 24, 1),
(299, 171, 'Барои дарсшикани зиёда аз 60 соат.', 24, 1),
(32, 319, 'Барои дарсшикани зиёда аз 186 соат.', 24, 1),
(39, 389, 'Барои дарсшикани зиёда аз 261 соат.', 24, 1),
(333, 2013, 'Барои дарсшикани зиёда аз 50 соат.', 24, 1),
(328, 1848, 'Барои дарсшикани зиёда аз 55 соат.', 24, 1),
(48, 443, 'Барои дарсшикани зиёда аз 151 соат.', 24, 1),
(49, 451, 'Барои дарсшикани зиёда аз 71 соат.', 24, 1),
(237, 105, 'Барои дарсшикани зиёда аз 48 соат.', 24, 1),
(52, 507, 'Барои дарсшикани зиёда аз 195 соат.', 24, 1),
(225, 530, NULL, 24, 1),
(55, 540, 'Барои дарсшикани зиёда аз 58 соат.', 24, 1),
(57, 580, 'Барои дарсшикани зиёда аз 192 соат.', 24, 1),
(59, 619, 'Барои дарсшикани зиёда аз 135 соат.', 24, 1),
(60, 624, 'Барои дарсшикани зиёда аз 72 соат.', 24, 1),
(62, 677, 'Барои дарсшикани зиёда аз 148 соат.', 24, 1),
(68, 720, 'Барои дарсшикани зиёда аз 70 соат.', 24, 1),
(70, 724, 'Барои дарсшикани зиёда аз 67 соат.', 24, 1),
(73, 741, 'Барои дарсшикани зиёда аз 192 соат.', 24, 1),
(74, 744, 'Барои дарсшикани зиёда аз 48 соат.', 24, 1),
(76, 752, 'Барои дарсшикани зиёда аз 49 соат.', 24, 1),
(77, 774, 'Барои дарсшикани зиёда аз 146 соат.', 24, 1),
(309, 687, 'Барои дарсшикани зиёда аз 56 соат.', 24, 1),
(82, 805, 'Барои дарсшикани зиёда аз 66 соат.', 24, 1),
(83, 837, 'Барои дарсшикани зиёда аз 66 соат.', 24, 1),
(84, 844, 'Барои дарсшикани зиёда аз 107 соат.', 24, 1),
(87, 852, 'Барои дарсшикани зиёда аз 123 соат.', 24, 1),
(325, 1681, 'Барои дарсшикани зиёда аз 95 соат.', 24, 1),
(93, 923, 'Барои дарсшикани зиёда аз 95 соат.', 24, 1),
(95, 955, 'Барои дарсшикани зиёда аз 105 соат.', 24, 1),
(97, 967, 'Барои дарсшикани зиёда аз 61 соат.', 24, 1),
(327, 1715, 'Барои дарсшикани зиёда аз 78 соат.', 24, 1),
(100, 1038, 'Барои дарсшикани зиёда аз 59 соат.', 24, 1),
(101, 1052, 'Барои дарсшикани зиёда аз 59 соат.', 24, 1),
(102, 1065, 'Барои дарсшикани зиёда аз 213 соат.', 24, 1),
(103, 1079, 'Барои дарсшикани зиёда аз 71 соат.', 24, 1),
(104, 1093, 'Барои дарсшикани зиёда аз 102 соат.', 24, 1),
(110, 1221, 'Барои дарсшикани зиёда аз 72 соат.', 24, 1),
(112, 1258, 'Барои дарсшикани зиёда аз 78 соат.', 24, 1),
(113, 1304, 'Барои дарсшикани зиёда аз 78 соат.', 24, 1),
(115, 1370, 'Барои дарсшикани зиёда аз 60 соат.', 24, 1),
(118, 1420, 'Барои дарсшикани зиёда аз 49 соат.', 24, 1),
(119, 1439, 'Барои дарсшикани зиёда аз 62 соат.', 24, 1),
(122, 1503, 'Барои дарсшикани зиёда аз 62 соат.', 24, 1),
(123, 1536, 'Барои дарсшикани зиёда аз 73 соат.', 24, 1),
(124, 1541, 'Барои дарсшикани зиёда аз 52 соат.', 24, 1),
(125, 1543, 'Барои дарсшикани зиёда аз 48 соат.', 24, 1),
(126, 1552, 'Барои дарсшикани зиёда аз 60 соат.', 24, 1),
(127, 1574, 'Барои дарсшикани зиёда аз 62 соат.', 24, 1),
(128, 1618, 'Барои дарсшикани зиёда аз 213 соат.', 24, 1),
(130, 1662, 'Барои дарсшикани зиёда аз 136 соат.', 24, 1),
(131, 1664, 'Барои дарсшикани зиёда аз 94 соат.', 24, 1),
(134, 1709, 'Барои дарсшикани зиёда аз 61 соат.', 24, 1),
(138, 1766, 'Барои дарсшикани зиёда аз 129 соат.', 24, 1),
(139, 1784, 'Барои дарсшикани зиёда аз 135 соат.', 24, 1),
(140, 1830, 'Барои дарсшикани зиёда аз 79 соат.', 24, 1),
(141, 1839, 'Барои дарсшикани зиёда аз 53 соат.', 24, 1),
(145, 1906, 'Барои дарсшикани зиёда аз 70 соат.', 24, 1),
(321, 1242, 'Барои дарсшикани зиёда аз 66 соат.', 24, 1),
(148, 1979, 'Барои дарсшикани зиёда аз 134 соат.', 24, 1),
(149, 1991, 'Барои дарсшикани зиёда аз 52 соат.', 24, 1),
(320, 1118, 'Барои дарсшикани зиёда аз 51 соат.', 24, 1),
(152, 2023, 'Барои дарсшикани зиёда аз 54 соат.', 24, 1),
(154, 2064, 'Барои дарсшикани зиёда аз 59 соат.', 24, 1),
(155, 2081, 'Барои дарсшикани зиёда аз 142 соат.', 24, 1),
(156, 2094, 'Барои дарсшикани зиёда аз 96 соат.', 24, 1),
(158, 2113, 'Барои дарсшикани зиёда аз 77 соат.', 24, 1),
(159, 2130, 'Барои дарсшикани зиёда аз 74 соат.', 24, 1),
(161, 2154, 'Барои дарсшикани зиёда аз 95 соат.', 24, 1),
(319, 1028, 'Барои дарсшикани зиёда аз 50 соат.', 24, 1),
(163, 2183, 'Барои дарсшикани зиёда аз 88 соат.', 24, 1),
(164, 2187, 'Барои дарсшикани зиёда аз 52 соат.', 24, 1),
(165, 2189, 'Барои дарсшикани зиёда аз 100 соат.', 24, 1),
(166, 2223, 'Барои дарсшикани зиёда аз 56 соат.', 24, 1),
(167, 2243, 'Барои дарсшикани зиёда аз 72 соат.', 24, 1),
(168, 2247, 'Барои дарсшикани зиёда аз 58 соат.', 24, 1),
(169, 2256, 'Барои дарсшикани зиёда аз 90 соат.', 24, 1),
(315, 906, 'Барои дарсшикани зиёда аз 55 соат.', 24, 1),
(171, 2280, 'Барои дарсшикани зиёда аз 76 соат.', 24, 1),
(172, 2505, 'Барои дарсшикани зиёда аз 60 соат.', 24, 1),
(175, 2562, 'Барои дарсшикани зиёда аз 68 соат.', 24, 1),
(176, 2570, 'Барои дарсшикани зиёда аз 70 соат.', 24, 1),
(177, 2602, 'Барои дарсшикани зиёда аз 58 соат.', 24, 1),
(180, 2654, 'Барои дарсшикани зиёда аз 79 соат.', 24, 1),
(181, 2697, 'Барои дарсшикани зиёда аз 166 соат.', 24, 1),
(329, 1853, 'Барои дарсшикани зиёда аз 52 соат.', 24, 1),
(185, 2882, 'Барои дарсшикани зиёда аз 62 соат.', 24, 1),
(186, 2917, 'Барои дарсшикани зиёда аз 64 соат.', 24, 1),
(187, 2961, 'Барои дарсшикани зиёда аз 52 соат.', 24, 1),
(189, 3048, 'Барои дарсшикани зиёда аз 60 соат.', 24, 1),
(191, 3448, 'Барои дарсшикани зиёда аз 54 соат.', 24, 1),
(192, 3494, 'Барои дарсшикани зиёда аз 72 соат.', 24, 1),
(194, 3521, 'Барои дарсшикани зиёда аз 137 соат.', 24, 1),
(195, 3537, 'Барои дарсшикани зиёда аз 132 соат.', 24, 1),
(196, 3569, 'Барои дарсшикани зиёда аз 67 соат.', 24, 1),
(197, 3572, 'Барои дарсшикани зиёда аз 57 соат.', 24, 1),
(198, 3574, 'Барои дарсшикани зиёда аз 67 соат.', 24, 1),
(199, 3607, 'Барои дарсшикани зиёда аз 56 соат.', 24, 1),
(201, 3674, 'Барои дарсшикани зиёда аз 62 соат.', 24, 1),
(202, 3710, 'Барои дарсшикани зиёда аз 68 соат.', 24, 1),
(204, 3730, 'Барои дарсшикани зиёда аз 67 соат.', 24, 1),
(207, 135, 'Барои дарсшикани зиёда аз 50 соат.', 24, 1),
(233, 1562, NULL, 24, 1),
(312, 737, 'Барои дарсшикани зиёда аз 55 соат.', 24, 1),
(219, 980, 'Барои дарсшикани зиёда аз 61 соат.', 24, 1),
(220, 1130, 'Барои дарсшикани зиёда аз 64 соат.', 24, 1),
(332, 2005, 'Барои дарсшикани зиёда аз 48 соат.', 24, 1),
(222, 1244, 'Барои дарсшикани зиёда аз 59 соат.', 24, 1),
(224, 2254, 'Барои дарсшикани зиёда аз 48 соат.', 24, 1),
(338, 2550, 'Барои дарсшикани зиёда аз 66 соат.', 24, 1),
(257, 402, 'Барои дарсшикани зиёда аз 91 соат.', 24, 1),
(330, 1876, 'Барои дарсшикани зиёда аз 63 соат.', 24, 1),
(345, 268, NULL, 24, 1),
(346, 663, NULL, 24, 1),
(337, 2263, 'Барои дарсшикани зиёда аз 62 соат.', 24, 1),
(339, 2634, 'Барои дарсшикани зиёда аз 52 соат.', 24, 1),
(336, 2178, 'Барои дарсшикани зиёда аз 64 соат.', 24, 1),
(281, 1410, 'Барои дарсшикани зиёда аз 56 соат.', 24, 1),
(283, 1945, 'Барои дарсшикани зиёда аз 52 соат.', 24, 1),
(284, 1984, 'Барои дарсшикани зиёда аз 55 соат.', 24, 1),
(285, 2062, 'Барои дарсшикани зиёда аз 50 соат.', 24, 1),
(286, 2078, 'Барои дарсшикани зиёда аз 61 соат.', 24, 1),
(322, 1243, 'Барои дарсшикани зиёда аз 51 соат.', 24, 1),
(323, 1440, 'Барои дарсшикани зиёда аз 53 соат.', 24, 1),
(291, 2875, 'Барои дарсшикани зиёда аз 49 соат.', 24, 1),
(292, 3022, 'Барои дарсшикани зиёда аз 73 соат.', 24, 1),
(347, 329, NULL, 24, 1),
(316, 917, 'Барои дарсшикани зиёда аз 50 соат.', 24, 1),
(342, 3655, 'Барои дарсшикани зиёда аз 50 соат.', 24, 1),
(343, 3810, 'Барои дарсшикани зиёда аз 55 соат.', 24, 1),
(355, 2608, 'Барои дарсшикани зиёда аз 75 соат.', 24, 1),
(356, 447, 'Барои дарсшикани зиёда аз 59 соат.', 24, 1),
(357, 459, 'Барои дарсшикани зиёда аз 61 соат.', 24, 1),
(358, 283, 'Барои дарсшикани зиёда аз 53 соат.', 24, 1),
(359, 641, 'Барои дарсшикани зиёда аз 74 соат.', 24, 1),
(360, 365, 'Барои дарсшикани зиёда аз 80 соат.', 24, 1),
(361, 259, 'Барои дарсшикани зиёда аз 73 соат.', 24, 1),
(362, 260, 'Барои дарсшикани зиёда аз 72 соат.', 24, 1),
(363, 796, 'Барои дарсшикани зиёда аз 70 соат.', 24, 1),
(364, 3502, 'Барои дарсшикани зиёда аз 50 соат.', 24, 1),
(365, 123, 'Барои дарсшикани зиёда аз 54 соат.', 24, 1),
(366, 2525, 'Барои дарсшикани зиёда аз 53 соат.', 24, 1),
(367, 2738, 'Барои дарсшикани зиёда аз 57 соат.', 24, 1),
(368, 708, 'Барои дарсшикани зиёда аз 88 соат.', 24, 1),
(369, 414, 'Барои дарсшикани зиёда аз 64 соат.', 24, 1),
(370, 875, 'Барои дарсшикани зиёда аз 53 соат.', 24, 1),
(371, 2841, 'Барои дарсшикани зиёда аз 57 соат.', 24, 1),
(372, 826, 'Барои дарсшикани зиёда аз 48 соат.', 24, 1),
(373, 791, 'Барои дарсшикани зиёда аз 50 соат.', 24, 1),
(374, 374, 'Барои дарсшикани зиёда аз 49 соат.', 24, 1),
(375, 585, 'Барои дарсшикани зиёда аз 49 соат.', 24, 1),
(376, 470, 'Барои дарсшикани зиёда аз 59 соат.', 24, 1),
(377, 126, 'Барои дарсшикани зиёда аз 72 соат.', 24, 1),
(378, 248, 'Барои дарсшикани зиёда аз 59 соат.', 24, 1),
(379, 182, 'Барои дарсшикани зиёда аз 79 соат.', 24, 1),
(380, 776, 'Барои дарсшикани зиёда аз 104 соат.', 24, 1),
(381, 702, 'Барои дарсшикани зиёда аз 140 соат.', 24, 1),
(382, 855, 'Барои дарсшикани зиёда аз 111 соат.', 24, 1),
(383, 738, 'Барои дарсшикани зиёда аз 77 соат.', 24, 1),
(384, 232, 'Барои дарсшикани зиёда аз 81 соат.', 24, 1),
(385, 169, 'Барои дарсшикани зиёда аз 60 соат.', 24, 1),
(386, 186, 'Барои дарсшикани зиёда аз 52 соат.', 24, 1),
(387, 794, 'Барои дарсшикани зиёда аз 48 соат.', 24, 1),
(388, 316, 'Барои дарсшикани зиёда аз 70 соат.', 24, 1),
(389, 480, 'Барои дарсшикани зиёда аз 74 соат.', 24, 1),
(390, 240, 'Барои дарсшикани зиёда аз 70 соат.', 24, 1),
(391, 361, 'Барои дарсшикани зиёда аз 69 соат.', 24, 1),
(392, 354, 'Барои дарсшикани зиёда аз 103 соат.', 24, 1),
(393, 748, 'Барои дарсшикани зиёда аз 71 соат.', 24, 1),
(394, 371, 'Барои дарсшикани зиёда аз 154 соат.', 24, 1),
(395, 734, 'Барои дарсшикани зиёда аз 143 соат.', 24, 1),
(396, 394, 'Барои дарсшикани зиёда аз 48 соат.', 24, 1),
(397, 873, 'Барои дарсшикани зиёда аз 151 соат.', 24, 1),
(398, 148, 'Барои дарсшикани зиёда аз 101 соат.', 24, 1),
(399, 896, 'Барои дарсшикани зиёда аз 104 соат.', 24, 1),
(400, 207, 'Барои дарсшикани зиёда аз 94 соат.', 24, 1),
(401, 250, 'Барои дарсшикани зиёда аз 82 соат.', 24, 1),
(402, 390, 'Барои дарсшикани зиёда аз 129 соат.', 24, 1),
(403, 851, 'Барои дарсшикани зиёда аз 70 соат.', 24, 1),
(404, 336, 'Барои дарсшикани зиёда аз 64 соат.', 24, 1),
(405, 689, 'Барои дарсшикани зиёда аз 49 соат.', 24, 1),
(406, 418, 'Барои дарсшикани зиёда аз 185 соат.', 24, 1),
(407, 231, 'Барои дарсшикани зиёда аз 119 соат.', 24, 1),
(408, 1627, 'Барои дарсшикани зиёда аз 171 соат.', 24, 1),
(409, 546, 'Барои дарсшикани зиёда аз 117 соат.', 24, 1),
(410, 413, 'Барои дарсшикани зиёда аз 191 соат.', 24, 1),
(411, 416, 'Барои дарсшикани зиёда аз 144 соат.', 24, 1),
(412, 534, 'Барои дарсшикани зиёда аз 142 соат.', 24, 1),
(413, 2027, 'Барои дарсшикани зиёда аз 106 соат.', 24, 1),
(414, 581, 'Барои дарсшикани зиёда аз 74 соат.', 24, 1),
(415, 935, 'Барои дарсшикани зиёда аз 71 соат.', 24, 1),
(416, 112, 'Барои дарсшикани зиёда аз 72 соат.', 24, 1),
(417, 1724, 'Барои дарсшикани зиёда аз 63 соат.', 24, 1),
(418, 2097, 'Барои дарсшикани зиёда аз 56 соат.', 24, 1),
(419, 2139, 'Барои дарсшикани зиёда аз 73 соат.', 24, 1),
(420, 1692, 'Барои дарсшикани зиёда аз 66 соат.', 24, 1),
(421, 1373, 'Барои дарсшикани зиёда аз 77 соат.', 24, 1),
(422, 3432, 'Барои дарсшикани зиёда аз 58 соат.', 24, 1),
(423, 1201, 'Барои дарсшикани зиёда аз 82 соат.', 24, 1),
(424, 964, 'Барои дарсшикани зиёда аз 114 соат.', 24, 1),
(425, 2351, 'Барои дарсшикани зиёда аз 88 соат.', 24, 1),
(426, 1129, 'Барои дарсшикани зиёда аз 58 соат.', 24, 1),
(427, 140, 'Барои дарсшикани зиёда аз 73 соат.', 24, 1),
(428, 3723, 'Барои дарсшикани зиёда аз 122 соат.', 24, 1),
(429, 196, 'Барои дарсшикани зиёда аз 52 соат.', 24, 1),
(430, 722, 'Барои дарсшикани зиёда аз 70 соат.', 24, 1),
(431, 1117, 'Барои дарсшикани зиёда аз 58 соат.', 24, 1),
(432, 151, 'Барои дарсшикани зиёда аз 62 соат.', 24, 1),
(433, 2810, 'Барои дарсшикани зиёда аз 56 соат.', 24, 1),
(434, 848, 'Барои дарсшикани зиёда аз 64 соат.', 24, 1),
(435, 1212, 'Барои дарсшикани зиёда аз 76 соат.', 24, 1),
(436, 275, 'Барои дарсшикани зиёда аз 50 соат.', 24, 1),
(437, 364, 'Барои дарсшикани зиёда аз 66 соат.', 24, 1),
(438, 1502, 'Барои дарсшикани зиёда аз 60 соат.', 24, 1),
(439, 1462, 'Барои дарсшикани зиёда аз 52 соат.', 24, 1),
(440, 1755, 'Барои дарсшикани зиёда аз 60 соат.', 24, 1),
(441, 3811, 'Барои дарсшикани зиёда аз 116 соат.', 24, 1),
(442, 685, 'Барои дарсшикани зиёда аз 79 соат.', 24, 1),
(443, 448, 'Барои дарсшикани зиёда аз 50 соат.', 24, 1),
(444, 505, 'Барои дарсшикани зиёда аз 49 соат.', 24, 1),
(445, 425, 'Барои дарсшикани зиёда аз 61 соат.', 24, 1),
(446, 999, 'Барои дарсшикани зиёда аз 49 соат.', 24, 1),
(448, 1800, 'Барои дарсшикани зиёда аз 50 соат.', 24, 2),
(449, 3817, 'Барои дарсшикани зиёда аз 82 соат.', 24, 2),
(450, 2043, 'Барои дарсшикани зиёда аз 53 соат.', 24, 2),
(451, 2278, 'Барои дарсшикани зиёда аз 53 соат.', 24, 2),
(452, 1733, 'Барои дарсшикани зиёда аз 70 соат.', 24, 2),
(453, 1236, 'Барои дарсшикани зиёда аз 57 соат.', 24, 2),
(454, 1240, 'Барои дарсшикани зиёда аз 48 соат.', 24, 2),
(455, 2084, 'Барои дарсшикани зиёда аз 49 соат.', 24, 2),
(456, 1536, 'Барои дарсшикани зиёда аз 61 соат.', 24, 2),
(459, 1084, 'Барои дарсшикани зиёда аз 77 соат.', 24, 2),
(458, 3465, 'Барои дарсшикани зиёда аз 48 соат.', 24, 2),
(460, 2280, 'Барои дарсшикани зиёда аз 96 соат.', 24, 2),
(461, 3864, 'Барои дарсшикани зиёда аз 96 соат.', 24, 2),
(462, 1942, 'Барои дарсшикани зиёда аз 55 соат.', 24, 2),
(463, 1845, 'Барои дарсшикани зиёда аз 56 соат.', 24, 2),
(464, 2255, 'Барои дарсшикани зиёда аз 63 соат.', 24, 2),
(465, 2141, 'Барои дарсшикани зиёда аз 51 соат.', 24, 2),
(466, 2125, 'Барои дарсшикани зиёда аз 55 соат.', 24, 2),
(467, 2723, 'Барои дарсшикани зиёда аз 48 соат.', 24, 2),
(468, 2933, 'Барои дарсшикани зиёда аз 49 соат.', 24, 2),
(469, 2896, 'Барои дарсшикани зиёда аз 58 соат.', 24, 2),
(470, 3399, 'Барои дарсшикани зиёда аз 48 соат.', 24, 2);

-- --------------------------------------------------------

--
-- Структура таблицы `sokhtor`
--

CREATE TABLE `sokhtor` (
  `id` int NOT NULL,
  `id_parent` int DEFAULT NULL,
  `title_tj` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `title_ru` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `title_en` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `short_title_tj` varchar(25) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `salary` float DEFAULT NULL,
  `s_y` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Структура таблицы `specialties`
--

CREATE TABLE `specialties` (
  `id` int NOT NULL,
  `id_faculty` int NOT NULL,
  `id_departaments` int DEFAULT NULL,
  `title_tj` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `title_ru` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `title_en` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `code` varchar(25) NOT NULL,
  `id_s_l` int DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb3;

--
-- Дамп данных таблицы `specialties`
--

INSERT INTO `specialties` (`id`, `id_faculty`, `id_departaments`, `title_tj`, `title_ru`, `title_en`, `code`, `id_s_l`) VALUES
(1, 1, NULL, 'Технологияҳои иттилоотии идора дар иқтисодиёт', '', '', '1-3103060104', 1),
(2, 1, NULL, 'Таълими касбӣ (Информатика)', '', '', '1-08010107', 1),
(3, 1, NULL, 'Информатикаи иқтисодӣ', '', '', '1-250112', 1),
(4, 1, NULL, 'Кибернетикаи иқтисодӣ (Технологияҳои иттилоотӣ дар иқтисодиёт)', '', '', '1-31030602', 1),
(5, 1, NULL, 'Иқтисодиёти рақамӣ', '', '', '1-25011026', 1),
(6, 1, NULL, 'Технология ва низоми иттилоотӣ (дар иқтисодиёт)', '', '', '1-40010202', 1),
(7, 1, NULL, 'Бехатарии иттилоотӣ', '', '', '1-40010104', 1),
(8, 1, NULL, 'Муҳандиси барномавӣ', '', '', '1-40010108', 1),
(9, 1, NULL, 'Системаҳои компютерии бонкӣ', '', '', '1-40010103', 1),
(10, 1, NULL, 'Технологияи зеҳнии компютерии реинжиниринг ва бизнес-равандҳо', '', '', '1-40030103', 1),
(11, 1, NULL, 'Зеҳни сунъӣ', '', '', '1-400103', 1),
(12, 1, NULL, 'Бизнес-маъмуриятчигӣ дар соҳаи истеҳсолот ва хизмат', '', '', '1-26020101', 1),
(13, 1, NULL, 'Маркетинг', '', '', '1-260203', 1),
(14, 1, NULL, 'Менеҷмент', '', '', '1-260202', 1),
(15, 1, NULL, 'Менеҷменти инноватсионӣ', '', '', '1-26020203', 1),
(16, 1, NULL, 'Менеҷменти байналмилалӣ', '', '', '1-26020202', 1),
(17, 1, NULL, 'Маркетинг дар сайёҳӣ', '', '', '1-26020312', 1),
(18, 2, NULL, 'Менеҷмент дар соҳаи сайёҳии байналмилалӣ', '', '', '1-26020210', 1),
(19, 2, NULL, 'Саёҳат ва меҳмондорӣ', '', '', '1-890101', 1),
(20, 2, NULL, 'Иқтисодиёт ва идораи сайёҳӣ', '', '', '1-25010717', 1),
(21, 2, NULL, 'Иқтисодиёт ва идора дар корхонаи хоҷагиҳои меҳмондорӣ ва тарабхона', '', '', '1-25010718', 1),
(22, 2, NULL, 'Технологияи маҳсулот ва ташкили хуроки умум', '', '', '1-91010101', 1),
(23, 2, NULL, 'Кори осорхона ва ҳифзи ёдгориҳои таърихию фарҳангӣ (мероси фарҳангӣ ва сайёҳӣ)', '', '', '1-23011204', 1),
(24, 2, NULL, 'Сайёҳии экологӣ', '', '', '89010104', 1),
(25, 2, NULL, 'Сервиси тарабхона ва меҳмонхона', '', '', '1-91020101', 1),
(26, 2, NULL, 'Иқтисодиёт ва ташкили бизнеси тарабхонаҳо', '', '', '1-25010732', 1),
(27, 2, NULL, 'Менеҷменти тарабхона ва меҳмонхона', '', '', '1-26020222', 1),
(28, 2, NULL, 'Тибби сайёҳӣ ', '', '', '1-79010301', 1),
(29, 2, NULL, 'Сайёҳии осоишгоҳӣ-табобатӣ', '', '', '1-8902017901', 1),
(30, 2, NULL, 'Таърих', '', '', '1-020101', 1),
(31, 2, NULL, 'Кори иҷтимоӣ (Фаъолияти иҷтимоӣ-омӯзгорӣ)', '', '', '1-86010101', 1),
(32, 7, NULL, 'Баҳисобгирии бухгалтерӣ, таҳлил ва аудит дар бонкҳо', '', '', '1-25010801', 1),
(33, 7, NULL, 'Баҳисобгирии бухгалтерӣ, таҳлил ва аудит дар саноат', '', '', '1-25010805', 1),
(34, 7, NULL, 'Аудит ва ревизия', '', '', '1-250111', 1),
(163, 5, NULL, 'Географияи иқтисодиёт', '', '', '1-02040503', 1),
(35, 7, NULL, 'Баҳисобгирии бухгалтерӣ, таҳлил ва аудит дар муассисаҳои буҷетӣ ва илмӣ', '', '', '1-25010803', 1),
(36, 7, NULL, 'Менеҷмети экологӣ ва аудит дар саноат', '', '', '1-570102', 1),
(37, 7, NULL, 'Назарияи иқтисодӣ', '', '', '1-250101', 1),
(38, 7, NULL, 'Таълими касбӣ (Иқтисодиёт ва идора)', '', '', '1-08010108', 1),
(39, 7, NULL, 'Иқтисодиёт ва идора дар корхонаҳои саноатӣ', '', '', '1-25010711', 1),
(40, 7, NULL, 'Иқтисодиёт ва ташкили истеҳсолот (энергетика)', '', '', '1-27010110', 1),
(41, 7, NULL, 'Иқтисодиёт ва ташкили истеҳсолот (саноати сабук)', '', '', '1-27010116', 1),
(42, 7, NULL, 'Иқтисодиёт ва ташкили истеҳсолот (саноати хурокворӣ)', '', '', '1-27010120', 1),
(43, 7, NULL, 'Иқтисодиёт ва идоракунӣ дар корхонаҳои савдо', '', '', '1-250107 05', 1),
(44, 7, NULL, 'Иқтисодиёт ва ташкили фаъолияти соҳибкорӣ', '', '', '1-25010731', 1),
(45, 7, NULL, 'Иқтисодиёти ҷаҳонӣ', '', '', '1-250103', 1),
(46, 7, NULL, 'Танзими давлатии иқтисодиёти миллӣ', '', '', '1-26010301', 1),
(47, 7, NULL, 'Муносибатҳои байналмилалӣ', '', '', '1-230101', 1),
(48, 7, NULL, 'Сиёсати берунӣ ва дипломатия', '', '', '1-23010101', 1),
(49, 7, NULL, 'Ташкили робитаҳои байналмилалӣ', '', '', '1-23010103', 1),
(50, 7, NULL, 'Хадамоти консулӣ', '', '', '1-24010106', 1),
(51, 3, NULL, 'Кори бонкӣ', '', '', '1-25010402', 1),
(52, 3, NULL, 'Бозори фондӣ', '', '', '1-25010408', 1),
(53, 3, NULL, 'Иқтисодиёти молиявӣ ва бонкӣ', '', '', '1-25010202', 1),
(54, 3, NULL, 'Менеҷменти бонкӣ', '', '', '1-26020217', 1),
(55, 3, NULL, 'Молия ва қарз', '', '', '1-250104', 1),
(56, 3, NULL, 'Молия ва назорат дар фаъолияти гумрук', '', '', '1-25010409', 1),
(57, 3, NULL, 'Иқтисодиёти молиявӣ', '', '', '1-31030503', 1),
(58, 3, NULL, 'Андоз ва андозбандӣ', '', '', '1-25010403', 1),
(59, 3, NULL, 'Менеҷменти молиявӣ', '', '', '1-25010410', 1),
(60, 3, NULL, 'Омор', '', '', '1-250105', 1),
(61, 4, NULL, 'Идораи давлатӣ', '', '', '1-260101', 1),
(62, 4, NULL, 'Идораи мақомоти маҳаллӣ', '', '', '1-26010101', 1),
(63, 4, NULL, 'Идоракунии зиддибӯҳронии корхона', '', '', '1-26020106', 1),
(64, 4, NULL, 'Идораи давлатӣ ва ҳуқуқ', '', '', '1-260102', 1),
(65, 4, NULL, 'Ташкили фаъолияти мақомоти давлатӣ', '', '', '1-24010201', 1),
(66, 4, NULL, 'Таъминоти ҳуқуқии фаъолияти гумрукӣ', '', '', '1-96010101', 1),
(67, 4, NULL, 'Таъмини иқтисодии фаъолияти гумрукӣ', '', '', '1-96010102', 1),
(68, 4, NULL, 'Хадамоти гумрук', '', '', '1-96010100', 1),
(69, 4, NULL, 'Бехатарии иқтисодӣ', '', '', '1-96010103', 1),
(70, 4, NULL, 'Ҳуқуқи байналмилалӣ', '', '', '1-24010105', 1),
(71, 4, NULL, 'Таъминоти ҳуқуқии фаъолияти тиҷоратӣ', '', '', '1-24010301', 1),
(72, 4, NULL, 'Ҳуқуқи иқтисодӣ', '', '', '1-240103', 1),
(73, 4, NULL, 'Танзими ҳуқуқии молия ва қарз', '', '', '1-24010302', 1),
(74, 4, NULL, 'Таъминоти ҳуқуқи фаъолияти соҳибкори дар корхонаҳои хурду миёна', '', '', '1-26020104', 1),
(75, 4, NULL, 'Иқтисодиёт ва таъмини ҳуқуқи фаъолияти хоҷагидорӣ', '', '', '1-25010721', 1),
(76, 4, NULL, 'Ҳуқуқи андозу бонкӣ', '', '', '1-24010204', 1),
(77, 4, NULL, 'Ҳуқуқи гумрукӣ', '', '', '1-25010205', 1),
(78, 4, NULL, 'Ҳуқуқшиносӣ', '', '', '1-240102', 1),
(79, 4, NULL, 'Фаъолияти ҳифзи ҳуқуқ (Полиси сайёҳӣ)', '', '', '1-93010101', 1),
(80, 5, NULL, 'Забон ва адабиёти тоҷик', '', '', '1-020301', 1),
(81, 5, NULL, 'Рӯзноманигории байналмилалӣ', '', '', '1- 230109', 1),
(82, 5, NULL, 'Таҳсилоти  томактабӣ', '', '', '1-010101', 1),
(83, 5, NULL, 'Филологияи шарқ (забони арабӣ)', '', '', '1-210507', 1),
(84, 5, NULL, 'Таъминоти забонии робитаҳои байнифарҳангӣ (робитањои иќтисодии берунї)', '', '', '1-23010205', 1),
(85, 5, NULL, 'Забони хориҷӣ (забони русӣ)', '', '', '1-020306', 1),
(86, 5, NULL, 'Таъминоти забонии робитаҳои байнифарҳангӣ (Хизматрасонии иттилоотӣ)', '', '', '1-23010201', 1),
(87, 5, NULL, 'Забони хориҷӣ (забони англисӣ)', '', '', '1-020306', 1),
(88, 5, NULL, 'Забони хориҷӣ (забони хитоӣ)', '', '', '1-020306', 1),
(89, 5, NULL, 'Забони хориҷӣ (забони олмонӣ)', '', '', '1-020306', 1),
(90, 5, NULL, 'Таҳсилоти ибтидоӣ. Забони хориҷӣ (Забони англисӣ)', '', '', '1-01020205', 1),
(91, 5, NULL, 'Географияи сайёҳӣ ва менеҷменти саёҳат', '', '', '1-3102010203', 1),
(92, 5, NULL, 'География. Ҳифзи табиат', '', '', '1-02040504', 1),
(93, 5, NULL, 'География. Иқтисодиёт', '', '', '1-02040503', 1),
(94, 5, NULL, 'Иќтисодиёти истифодаи табиат', '', '', '1-25010722', 1),
(95, 5, NULL, 'Технология (Хизматрасонӣ)', '', '', '1-02060103', 1),
(96, 5, NULL, 'Менеҷменти экологӣ', '', '', '1-26020205', 1),
(97, 5, NULL, 'Метрология, стандартикунонӣ ва сертифкатсия', '', '', '1-540101', 1),
(98, 5, NULL, 'Кишваршиносӣ ва сайёҳӣ', '', '', '1-03020109', 1),
(99, 5, NULL, 'Математика (фаъолияти илмию педагогӣ)', '', '', '1-31030102', 1),
(100, 5, NULL, 'Математикаи амалӣ (фаъолияти илмию истеҳсолӣ)', '', '', '1-31030303', 1),
(101, 5, NULL, 'Математикаи амалӣ (фаъолияти илмию педагогӣ)', '', '', '1-31030302', 1),
(102, 5, NULL, 'Физика (фаъолияти илмию педагогӣ)', '', '', '1-31040103', 1),
(103, 6, NULL, 'Туризм', '', '', '430302', 1),
(104, 6, NULL, 'Фаъолияти меҳмонхонавӣ', '', '', '430303', 1),
(105, 6, NULL, 'Сервис', '', '', '430301', 1),
(106, 6, NULL, 'Иқтисодиёт (Иқтисодиёти корхона ва ташкилот)', 'Иқтисодиёт (Иқтисодиёти корхона ва ташкилот)', '', '380301', 1),
(107, 6, NULL, 'Менеҷмент (Менеҷменти ташкилот)', '', '', '380302', 1),
(109, 9, NULL, 'Молия ва қарз', '', '', '1-250104', 3),
(110, 9, NULL, 'Андоз ва андозбандӣ', '', '', '1-25010403', 3),
(122, 11, NULL, 'Иқтисодиёти соҳибкорӣ', '', '', '08000606', 7),
(112, 9, NULL, 'Иқтисод ва идораи саёҳӣ', '', '', '1-25010717', 3),
(113, 9, NULL, 'Менеҷ дар соҳаи саёҳӣ байналмилалӣ', '', '', '1-26020210', 3),
(114, 9, NULL, 'Баҳисобгирии бухгалтерӣ, таҳлил ва аудит', '', '', '1-250108', 3),
(115, 9, NULL, 'Таъминоти иқтисодии фаъолияти гумрукӣ', '', '', '1-96010102', 3),
(116, 9, NULL, 'Иқтисодиёти ҷаҳон', '', '', '1-250103', 3),
(117, 9, NULL, 'Идораи давлатӣ', '', '', '1-260101', 3),
(119, 10, NULL, 'Баҳисобгирӣ ва аудит', '', '', '6D0508', 4),
(120, 10, NULL, 'Иқтисодиёт', '', '', '6D0506', 4),
(121, 10, NULL, 'Идоракунии давлатӣ ва маҳалӣ', '', '', '6D0510', 4),
(123, 11, NULL, 'Менеҷмент, маркетинг ва нархгӯзорӣ', '', '', '080010', 7),
(124, 11, NULL, 'Иқтисодиёти соҳаи сайёҳӣ', '', '', '08000406', 7),
(125, 12, NULL, 'Иқтисодиёти ҷаҳонӣ', '', '', '1-250103', 1),
(126, 12, NULL, 'Кори бонкӣ', '', '', '1-25010402', 1),
(127, 12, NULL, 'Андоз ва андозбандӣ', '', '', '1-25010403', 1),
(128, 12, NULL, 'Молия ва қарз', '', '', '1-250104', 1),
(129, 12, NULL, 'Менеҷменти молиявӣ', '', '', '1-25010410', 1),
(130, 12, NULL, 'Менеҷменти бонкӣ', '', '', '1-25010417', 1),
(131, 12, NULL, 'Иқтисодиёт ва идораи сайёҳӣ', '', '', '1-25010717', 1),
(132, 12, NULL, 'Баҳисобгирии бухгалтерӣ, таҳлил ва аудит', '', '', '1-250108', 1),
(133, 12, NULL, 'Баҳисобгирии бухгалтерӣ, таҳлил ва аудит дар бонкҳо', '', '', '1-25010801', 1),
(134, 12, NULL, 'Баҳисобгирии бухгалтерӣ, таҳлил ва аудит дар саноат', '', '', '1-25010805', 1),
(135, 12, NULL, 'Идораи давлатӣ', '', '', '1-260101', 1),
(136, 12, NULL, 'Менеҷмент дар соҳаи сайёҳии байналмилалӣ', '', '', '1-26020210', 1),
(137, 12, NULL, 'Менеҷмент', '', '', '1-260202', 1),
(138, 12, NULL, 'Хадамоти гумрук', '', '', '1-960101', 1),
(139, 12, NULL, 'Ҳуқуқишиносӣ', '', '', '1-240102', 1),
(140, 12, NULL, 'Ҳуқуқи гумрукӣ', '', '', '1-24010205', 1),
(141, 12, NULL, 'Фаъолияти ҳифзи ҳуқуқ (Полиси сайёҳи)', '', '', '1-93010101', 1),
(142, 12, NULL, 'Таъминоти ҳуқуқии фаъолияти гумрукӣ', '', '', '1-96010101', 1),
(143, 12, NULL, 'Муносибатҳои байналмилалӣ', '', '', '1-230101', 1),
(144, 12, NULL, 'Ташкили фаъолияти мақомоти давлатӣ', '', '', '1-24010201', 1),
(145, 12, NULL, 'Математикаи амалӣ  (фаъолияти илмию педагогӣ)', '', '', '1-31030302', 1),
(146, 12, NULL, 'Технология ва низоми иттилоотӣ (дар иқтисодиёт)', '', '', '1-40010202', 1),
(147, 12, NULL, 'Забони хориҷӣ (забони русӣ)', '', '', '1-020306', 1),
(148, 12, NULL, 'Забон ва адабиёти тоҷик', '', '', '1-020301', 1),
(149, 12, NULL, 'Забони хориҷӣ (забони англисӣ)', '', '', '1-020306', 1),
(150, 12, NULL, 'Таҳсилоти томактабӣ', '', '', '1-010101', 1),
(151, 12, NULL, 'Саёҳат ва меҳмондорӣ', '', '', '1-890101', 1),
(152, 12, NULL, 'Иқтисодиёт ва идораи сайёҳӣ', '', '', '1-25010717', 1),
(153, 12, NULL, 'Бозори фондӣ', '', '', '1-25010408', 1),
(154, 6, NULL, 'Сервиси сайёҳӣ', '', '', '1-89010103', 1),
(155, 12, NULL, 'Сервиси сайёҳӣ', '', '', '1-89010103', 1),
(156, 2, NULL, 'Фаъолияти экскурсионӣ', '', '', '1-89010104', 1),
(157, 2, NULL, 'Сайёҳии кӯҳӣ', '', '', '1-89020101', 1),
(158, 2, NULL, 'Ташкили хизматрасонӣ дар муассисаҳои хуроки умум', '', '', '1-89010105', 1),
(159, 12, NULL, 'Маркетинг дар сайёҳӣ', '', '', '1-26020312', 1),
(160, 12, NULL, 'Системаҳои компютерии бонкӣ', '', '', '1-40010103', 1),
(161, 1, NULL, 'Технология (Хизматрасонӣ)', '', '', '1-02060103', 1),
(162, 12, NULL, 'Технология (Хизматрасонӣ)', '', '', '1-02060103', 1),
(165, 7, NULL, 'Баҳисобгирии бухгалтерӣ, таҳлил ва  аудит', '', '', '1-250108', 1),
(166, 12, NULL, 'Ҳуқуқшиносӣ', '', '', '1-240102', 1);

-- --------------------------------------------------------

--
-- Дублирующая структура для представления `state_groups`
-- (См. Ниже фактическое представление)
--
CREATE TABLE `state_groups` (
`id_faculty` int
,`id_s_l` int
,`id_s_v` int
,`id_course` int
,`id_spec` int
,`id_group` int
,`s_y` int
,`h_y` int
);

-- --------------------------------------------------------

--
-- Структура таблицы `stds_farmonho`
--

CREATE TABLE `stds_farmonho` (
  `id` int NOT NULL,
  `id_student` int NOT NULL,
  `farmon_type` int NOT NULL,
  `id_sabab_khorij` int DEFAULT NULL,
  `farmon_number` varchar(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `farmon_date` date NOT NULL,
  `farmon_text` varchar(3000) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `asos_text` varchar(300) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `farmon_add_time` datetime DEFAULT NULL,
  `author` int NOT NULL,
  `s_y` int DEFAULT NULL,
  `h_y` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Структура таблицы `stds_farmon_type`
--

CREATE TABLE `stds_farmon_type` (
  `id` int NOT NULL,
  `title_tj` varchar(50) NOT NULL,
  `title_ru` varchar(50) NOT NULL,
  `title_en` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Структура таблицы `std_study_groups`
--

CREATE TABLE `std_study_groups` (
  `id` int NOT NULL,
  `status` int NOT NULL DEFAULT '1',
  `id_faculty` int NOT NULL COMMENT 'Факултет',
  `id_s_l` int NOT NULL COMMENT 'Бакалавр, м 2-юм',
  `id_s_v` int NOT NULL COMMENT 'Рузона, Ғоибона',
  `id_course` int NOT NULL COMMENT 'Курс',
  `id_spec` int NOT NULL COMMENT 'Ихтисос',
  `id_group` int NOT NULL COMMENT 'Гуруҳ',
  `lang` varchar(2) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT 'tj' COMMENT 'Забони таҳсил',
  `id_nt` int DEFAULT NULL COMMENT 'Нақшаи таълим',
  `s_y` int NOT NULL COMMENT 'Соли таҳсил',
  `h_y` int NOT NULL COMMENT 'Нимсолаи таҳсил'
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb3;

--
-- Дамп данных таблицы `std_study_groups`
--

INSERT INTO `std_study_groups` (`id`, `status`, `id_faculty`, `id_s_l`, `id_s_v`, `id_course`, `id_spec`, `id_group`, `lang`, `id_nt`, `s_y`, `h_y`) VALUES
(1, 1, 1, 1, 1, 1, 12, 1, 'tj', NULL, 25, 1),
(2, 1, 1, 1, 1, 1, 12, 1, 'tj', NULL, 25, 2),
(3, 1, 1, 1, 1, 2, 14, 1, 'tj', NULL, 24, 1),
(4, 1, 1, 1, 1, 2, 14, 1, 'tj', NULL, 24, 2),
(5, 1, 1, 1, 1, 2, 14, 1, 'tj', NULL, 25, 1),
(6, 1, 1, 1, 1, 2, 14, 1, 'tj', NULL, 25, 2),
(7, 1, 1, 1, 1, 2, 14, 3, 'tj', NULL, 24, 1),
(8, 1, 1, 1, 1, 2, 14, 3, 'tj', NULL, 24, 2),
(9, 1, 1, 1, 1, 2, 14, 3, 'tj', NULL, 25, 1),
(10, 1, 1, 1, 1, 2, 14, 3, 'tj', NULL, 25, 2),
(11, 1, 1, 1, 1, 2, 15, 1, 'tj', NULL, 24, 1),
(12, 1, 1, 1, 1, 2, 15, 1, 'tj', NULL, 24, 2),
(13, 1, 1, 1, 1, 2, 15, 1, 'tj', NULL, 25, 1),
(14, 1, 1, 1, 1, 2, 15, 1, 'tj', NULL, 25, 2),
(15, 1, 1, 1, 1, 2, 6, 1, 'tj', NULL, 24, 1),
(16, 1, 1, 1, 1, 2, 6, 1, 'tj', NULL, 24, 2),
(17, 1, 1, 1, 1, 2, 6, 1, 'tj', NULL, 25, 1),
(18, 1, 1, 1, 1, 2, 6, 1, 'tj', NULL, 25, 2),
(19, 1, 1, 1, 1, 2, 9, 1, 'tj', NULL, 24, 1),
(20, 1, 1, 1, 1, 2, 9, 1, 'tj', NULL, 24, 2),
(21, 1, 1, 1, 1, 2, 9, 1, 'tj', NULL, 25, 1),
(22, 1, 1, 1, 1, 2, 9, 1, 'tj', NULL, 25, 2),
(23, 1, 1, 1, 1, 2, 8, 1, 'tj', NULL, 24, 1),
(24, 1, 1, 1, 1, 2, 8, 1, 'tj', NULL, 24, 2),
(25, 1, 1, 1, 1, 2, 8, 1, 'tj', 9, 25, 1),
(26, 1, 1, 1, 1, 2, 8, 1, 'tj', NULL, 25, 2),
(27, 1, 1, 1, 1, 2, 8, 3, 'tj', NULL, 24, 1),
(28, 1, 1, 1, 1, 2, 8, 3, 'tj', NULL, 24, 2),
(29, 1, 1, 1, 1, 2, 8, 3, 'tj', NULL, 25, 1),
(30, 1, 1, 1, 1, 2, 8, 3, 'tj', NULL, 25, 2),
(31, 1, 1, 1, 1, 2, 7, 1, 'tj', NULL, 24, 1),
(32, 1, 1, 1, 1, 2, 7, 1, 'tj', NULL, 24, 2),
(33, 1, 1, 1, 1, 2, 7, 1, 'tj', NULL, 25, 1),
(34, 1, 1, 1, 1, 2, 7, 1, 'tj', NULL, 25, 2),
(35, 1, 1, 1, 1, 1, 14, 1, 'tj', NULL, 25, 1),
(36, 1, 1, 1, 1, 1, 14, 1, 'tj', NULL, 25, 2),
(37, 1, 1, 1, 1, 2, 11, 1, 'tj', NULL, 24, 1),
(38, 1, 1, 1, 1, 2, 11, 1, 'tj', NULL, 24, 2),
(39, 1, 1, 1, 1, 2, 11, 1, 'tj', NULL, 25, 1),
(40, 1, 1, 1, 1, 2, 11, 1, 'tj', NULL, 25, 2),
(41, 1, 1, 1, 1, 2, 5, 1, 'tj', NULL, 24, 1),
(42, 1, 1, 1, 1, 2, 5, 1, 'tj', NULL, 24, 2),
(43, 1, 1, 1, 1, 2, 5, 1, 'tj', NULL, 25, 1),
(44, 1, 1, 1, 1, 2, 5, 1, 'tj', NULL, 25, 2),
(45, 1, 1, 1, 1, 1, 1, 1, 'tj', NULL, 25, 1),
(47, 1, 1, 1, 1, 3, 12, 1, 'tj', NULL, 23, 1),
(48, 1, 1, 1, 1, 3, 12, 1, 'tj', NULL, 23, 2),
(49, 1, 1, 1, 1, 3, 12, 1, 'tj', NULL, 24, 1),
(50, 1, 1, 1, 1, 3, 12, 1, 'tj', NULL, 24, 2),
(51, 1, 1, 1, 1, 3, 12, 1, 'tj', NULL, 25, 1),
(52, 1, 1, 1, 1, 3, 12, 1, 'tj', NULL, 25, 2),
(53, 1, 1, 1, 1, 3, 14, 1, 'tj', NULL, 23, 1),
(54, 1, 1, 1, 1, 3, 14, 1, 'tj', NULL, 23, 2),
(55, 1, 1, 1, 1, 3, 14, 1, 'tj', NULL, 24, 1),
(56, 1, 1, 1, 1, 3, 14, 1, 'tj', NULL, 24, 2),
(57, 1, 1, 1, 1, 3, 14, 1, 'tj', NULL, 25, 1),
(58, 1, 1, 1, 1, 3, 14, 1, 'tj', NULL, 25, 2),
(59, 1, 1, 1, 1, 3, 14, 3, 'tj', NULL, 23, 1),
(60, 1, 1, 1, 1, 3, 14, 3, 'tj', NULL, 23, 2),
(61, 1, 1, 1, 1, 3, 14, 3, 'tj', NULL, 24, 1),
(62, 1, 1, 1, 1, 3, 14, 3, 'tj', NULL, 24, 2),
(63, 1, 1, 1, 1, 3, 14, 3, 'tj', NULL, 25, 1),
(64, 1, 1, 1, 1, 3, 14, 3, 'tj', NULL, 25, 2);

-- --------------------------------------------------------

--
-- Структура таблицы `structure`
--

CREATE TABLE `structure` (
  `id` int NOT NULL,
  `pid` int NOT NULL,
  `type` tinyint DEFAULT NULL,
  `pos` int DEFAULT NULL,
  `name` varchar(255) NOT NULL,
  `name_short_ru` varchar(255) NOT NULL,
  `name_short_tj` varchar(255) NOT NULL,
  `name_full_ru` tinytext NOT NULL,
  `name_full_tj` tinytext NOT NULL,
  `detail_ru` tinytext NOT NULL,
  `detail_tj` tinytext NOT NULL,
  `visible` tinyint(1) DEFAULT NULL,
  `deleted` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb3;

-- --------------------------------------------------------

--
-- Структура таблицы `students`
--

CREATE TABLE `students` (
  `id` int NOT NULL,
  `status` int NOT NULL DEFAULT '1' COMMENT '1 - мехонад. 0 - хориҷ',
  `id_student` int NOT NULL COMMENT 'ID донишҷӯ',
  `id_faculty` int DEFAULT NULL COMMENT 'ID факултет',
  `id_s_l` int DEFAULT NULL COMMENT 'Бакалавр, маълумоти 2юм',
  `id_s_v` int DEFAULT NULL COMMENT 'Рузона, Гоибона',
  `id_course` int DEFAULT NULL COMMENT 'ID курс',
  `id_spec` int DEFAULT NULL COMMENT 'ID ихтисос',
  `id_group` int DEFAULT NULL COMMENT 'ID гуруҳ',
  `id_s_t` int DEFAULT NULL COMMENT 'Шартомавӣ, бучавӣ, квота',
  `balance` float DEFAULT NULL,
  `sh_persent` float DEFAULT NULL,
  `foreign` int DEFAULT NULL,
  `vazi_oilavi` int NOT NULL DEFAULT '1' COMMENT '1 - ятим нест 2 - ятими кул 3 - модар надорад 4 - падар надорад',
  `s_y` int NOT NULL COMMENT 'ID соли таҳсил',
  `h_y` int NOT NULL COMMENT 'ID нимсолаи таҳсил'
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb3;

--
-- Дамп данных таблицы `students`
--

INSERT INTO `students` (`id`, `status`, `id_student`, `id_faculty`, `id_s_l`, `id_s_v`, `id_course`, `id_spec`, `id_group`, `id_s_t`, `balance`, `sh_persent`, `foreign`, `vazi_oilavi`, `s_y`, `h_y`) VALUES
(1, 1, 23, 1, 1, 1, 1, 12, 1, 2, NULL, NULL, NULL, 1, 25, 1),
(2, 1, 23, 1, 1, 1, 1, 12, 1, 2, NULL, NULL, NULL, 1, 25, 2),
(3, 1, 24, 1, 1, 1, 1, 12, 1, 1, NULL, NULL, NULL, 1, 25, 1),
(4, 1, 24, 1, 1, 1, 1, 12, 1, 1, NULL, NULL, NULL, 1, 25, 2),
(5, 1, 25, 1, 1, 1, 1, 12, 1, 1, NULL, NULL, NULL, 1, 25, 1),
(6, 1, 25, 1, 1, 1, 1, 12, 1, 1, NULL, NULL, NULL, 1, 25, 2),
(7, 1, 26, 1, 1, 1, 1, 12, 1, 1, NULL, NULL, NULL, 1, 25, 1),
(8, 1, 26, 1, 1, 1, 1, 12, 1, 1, NULL, NULL, NULL, 1, 25, 2),
(9, 1, 27, 1, 1, 1, 1, 14, 1, 1, NULL, NULL, NULL, 1, 24, 1),
(10, 1, 27, 1, 1, 1, 1, 14, 1, 1, NULL, NULL, NULL, 1, 24, 2),
(11, 1, 27, 1, 1, 1, 2, 14, 1, 1, NULL, NULL, NULL, 1, 25, 1),
(12, 1, 27, 1, 1, 1, 2, 14, 1, 1, NULL, NULL, NULL, 1, 25, 2),
(13, 1, 28, 1, 1, 1, 1, 14, 1, 1, NULL, NULL, NULL, 1, 24, 1),
(14, 1, 28, 1, 1, 1, 1, 14, 1, 1, NULL, NULL, NULL, 1, 24, 2),
(15, 1, 28, 1, 1, 1, 2, 14, 1, 1, NULL, NULL, NULL, 1, 25, 1),
(16, 1, 28, 1, 1, 1, 2, 14, 1, 1, NULL, NULL, NULL, 1, 25, 2),
(17, 1, 29, 1, 1, 1, 1, 14, 1, 2, NULL, NULL, NULL, 1, 24, 1),
(18, 1, 29, 1, 1, 1, 1, 14, 1, 2, NULL, NULL, NULL, 1, 24, 2),
(19, 1, 29, 1, 1, 1, 2, 14, 1, 2, NULL, NULL, NULL, 1, 25, 1),
(20, 1, 29, 1, 1, 1, 2, 14, 1, 2, NULL, NULL, NULL, 1, 25, 2),
(21, 1, 30, 1, 1, 1, 1, 14, 1, 2, NULL, NULL, NULL, 1, 24, 1),
(22, 1, 30, 1, 1, 1, 1, 14, 1, 2, NULL, NULL, NULL, 1, 24, 2),
(23, 1, 30, 1, 1, 1, 2, 14, 1, 2, NULL, NULL, NULL, 1, 25, 1),
(24, 1, 30, 1, 1, 1, 2, 14, 1, 2, NULL, NULL, NULL, 1, 25, 2),
(25, 1, 31, 1, 1, 1, 1, 14, 1, 1, NULL, NULL, NULL, 1, 24, 1),
(26, 1, 31, 1, 1, 1, 1, 14, 1, 1, NULL, NULL, NULL, 1, 24, 2),
(27, 1, 31, 1, 1, 1, 2, 14, 1, 1, NULL, NULL, NULL, 1, 25, 1),
(28, 1, 31, 1, 1, 1, 2, 14, 1, 1, NULL, NULL, NULL, 1, 25, 2),
(29, 1, 32, 1, 1, 1, 1, 14, 1, 1, NULL, NULL, NULL, 1, 24, 1),
(30, 1, 32, 1, 1, 1, 1, 14, 1, 1, NULL, NULL, NULL, 1, 24, 2),
(31, 1, 32, 1, 1, 1, 2, 14, 1, 1, NULL, NULL, NULL, 1, 25, 1),
(32, 1, 32, 1, 1, 1, 2, 14, 1, 1, NULL, NULL, NULL, 1, 25, 2),
(33, 1, 33, 1, 1, 1, 1, 14, 1, 2, NULL, NULL, NULL, 1, 24, 1),
(34, 1, 33, 1, 1, 1, 1, 14, 1, 2, NULL, NULL, NULL, 1, 24, 2),
(35, 1, 33, 1, 1, 1, 2, 14, 1, 2, NULL, NULL, NULL, 1, 25, 1),
(36, 1, 33, 1, 1, 1, 2, 14, 1, 2, NULL, NULL, NULL, 1, 25, 2),
(37, 1, 34, 1, 1, 1, 1, 14, 1, 1, NULL, NULL, NULL, 1, 24, 1),
(38, 1, 34, 1, 1, 1, 1, 14, 1, 1, NULL, NULL, NULL, 1, 24, 2),
(39, 1, 34, 1, 1, 1, 2, 14, 1, 1, NULL, NULL, NULL, 1, 25, 1),
(40, 1, 34, 1, 1, 1, 2, 14, 1, 1, NULL, NULL, NULL, 1, 25, 2),
(41, 1, 35, 1, 1, 1, 1, 14, 1, 1, NULL, NULL, NULL, 1, 24, 1),
(42, 1, 35, 1, 1, 1, 1, 14, 1, 1, NULL, NULL, NULL, 1, 24, 2),
(43, 1, 35, 1, 1, 1, 2, 14, 1, 1, NULL, NULL, NULL, 1, 25, 1),
(44, 1, 35, 1, 1, 1, 2, 14, 1, 2, NULL, NULL, NULL, 1, 25, 2),
(45, 1, 36, 1, 1, 1, 1, 14, 1, 2, NULL, NULL, NULL, 1, 24, 1),
(46, 1, 36, 1, 1, 1, 1, 14, 1, 2, NULL, NULL, NULL, 1, 24, 2),
(47, 1, 36, 1, 1, 1, 2, 14, 1, 2, NULL, NULL, NULL, 1, 25, 1),
(48, 1, 36, 1, 1, 1, 2, 14, 1, 2, NULL, NULL, NULL, 1, 25, 2),
(49, 1, 37, 1, 1, 1, 1, 14, 1, 1, NULL, NULL, NULL, 1, 24, 1),
(50, 1, 37, 1, 1, 1, 1, 14, 1, 1, NULL, NULL, NULL, 1, 24, 2),
(51, 1, 37, 1, 1, 1, 2, 14, 1, 1, NULL, NULL, NULL, 1, 25, 1),
(52, 1, 37, 1, 1, 1, 2, 14, 1, 1, NULL, NULL, NULL, 1, 25, 2),
(53, 1, 38, 1, 1, 1, 1, 14, 1, 2, NULL, NULL, NULL, 1, 24, 1),
(54, 1, 38, 1, 1, 1, 1, 14, 1, 2, NULL, NULL, NULL, 1, 24, 2),
(55, 1, 38, 1, 1, 1, 2, 14, 1, 2, NULL, NULL, NULL, 1, 25, 1),
(56, 1, 38, 1, 1, 1, 2, 14, 1, 2, NULL, NULL, NULL, 1, 25, 2),
(57, 1, 39, 1, 1, 1, 1, 14, 1, 1, NULL, NULL, NULL, 1, 24, 1),
(58, 1, 39, 1, 1, 1, 1, 14, 1, 1, NULL, NULL, NULL, 1, 24, 2),
(59, 1, 39, 1, 1, 1, 2, 14, 1, 1, NULL, NULL, NULL, 1, 25, 1),
(60, 1, 39, 1, 1, 1, 2, 14, 1, 1, NULL, NULL, NULL, 1, 25, 2),
(61, 1, 40, 1, 1, 1, 1, 14, 1, 1, NULL, NULL, NULL, 1, 24, 1),
(62, 1, 40, 1, 1, 1, 1, 14, 1, 1, NULL, NULL, NULL, 1, 24, 2),
(63, 1, 40, 1, 1, 1, 2, 14, 1, 1, NULL, NULL, NULL, 1, 25, 1),
(64, 1, 40, 1, 1, 1, 2, 14, 1, 1, NULL, NULL, NULL, 1, 25, 2),
(65, 1, 41, 1, 1, 1, 1, 14, 1, 2, NULL, NULL, NULL, 1, 24, 1),
(66, 1, 41, 1, 1, 1, 1, 14, 1, 2, NULL, NULL, NULL, 1, 24, 2),
(67, 1, 41, 1, 1, 1, 2, 14, 1, 2, NULL, NULL, NULL, 1, 25, 1),
(68, 1, 41, 1, 1, 1, 2, 14, 1, 2, NULL, NULL, NULL, 1, 25, 2),
(69, 1, 42, 1, 1, 1, 1, 14, 1, 1, NULL, NULL, NULL, 1, 24, 1),
(70, 1, 42, 1, 1, 1, 1, 14, 1, 1, NULL, NULL, NULL, 1, 24, 2),
(71, 1, 42, 1, 1, 1, 2, 14, 1, 1, NULL, NULL, NULL, 1, 25, 1),
(72, 1, 42, 1, 1, 1, 2, 14, 1, 1, NULL, NULL, NULL, 1, 25, 2),
(73, 1, 43, 1, 1, 1, 1, 14, 1, 1, NULL, NULL, NULL, 1, 24, 1),
(74, 1, 43, 1, 1, 1, 1, 14, 1, 1, NULL, NULL, NULL, 1, 24, 2),
(75, 1, 43, 1, 1, 1, 2, 14, 1, 1, NULL, NULL, NULL, 1, 25, 1),
(76, 1, 43, 1, 1, 1, 2, 14, 1, 1, NULL, NULL, NULL, 1, 25, 2),
(77, 1, 44, 1, 1, 1, 1, 14, 1, 1, NULL, NULL, NULL, 1, 24, 1),
(78, 1, 44, 1, 1, 1, 1, 14, 1, 1, NULL, NULL, NULL, 1, 24, 2),
(79, 1, 44, 1, 1, 1, 2, 14, 1, 1, NULL, NULL, NULL, 1, 25, 1),
(80, 1, 44, 1, 1, 1, 2, 14, 1, 1, NULL, NULL, NULL, 1, 25, 2),
(81, 1, 45, 1, 1, 1, 1, 14, 3, 1, NULL, NULL, NULL, 1, 24, 1),
(82, 1, 45, 1, 1, 1, 1, 14, 3, 1, NULL, NULL, NULL, 1, 24, 2),
(83, 1, 45, 1, 1, 1, 2, 14, 3, 1, NULL, NULL, NULL, 1, 25, 1),
(84, 1, 45, 1, 1, 1, 2, 14, 3, 1, NULL, NULL, NULL, 1, 25, 2),
(85, 1, 46, 1, 1, 1, 1, 14, 3, 1, NULL, NULL, NULL, 1, 24, 1),
(86, 1, 46, 1, 1, 1, 1, 14, 3, 1, NULL, NULL, NULL, 1, 24, 2),
(87, 1, 46, 1, 1, 1, 2, 14, 3, 1, NULL, NULL, NULL, 1, 25, 1),
(88, 1, 46, 1, 1, 1, 2, 14, 3, 1, NULL, NULL, NULL, 1, 25, 2),
(89, 1, 47, 1, 1, 1, 1, 14, 3, 1, NULL, NULL, NULL, 1, 24, 1),
(90, 1, 47, 1, 1, 1, 2, 14, 3, 1, NULL, NULL, NULL, 1, 25, 1),
(91, 1, 47, 1, 1, 1, 2, 14, 3, 1, NULL, NULL, NULL, 1, 25, 2),
(92, 1, 48, 1, 1, 1, 1, 14, 3, 1, NULL, NULL, NULL, 1, 24, 1),
(93, 1, 48, 1, 1, 1, 1, 14, 3, 1, NULL, NULL, NULL, 1, 24, 2),
(94, 1, 48, 1, 1, 1, 2, 14, 3, 1, NULL, NULL, NULL, 1, 25, 1),
(95, 1, 48, 1, 1, 1, 2, 14, 3, 1, NULL, NULL, NULL, 1, 25, 2),
(96, 1, 49, 1, 1, 1, 1, 14, 3, 1, NULL, NULL, NULL, 1, 24, 1),
(97, 1, 49, 1, 1, 1, 1, 14, 3, 1, NULL, NULL, NULL, 1, 24, 2),
(98, 1, 49, 1, 1, 1, 2, 14, 3, 1, NULL, NULL, NULL, 1, 25, 1),
(99, 1, 49, 1, 1, 1, 2, 14, 3, 1, NULL, NULL, NULL, 1, 25, 2),
(100, 1, 50, 1, 1, 1, 1, 14, 3, 1, NULL, NULL, NULL, 1, 24, 1),
(101, 1, 50, 1, 1, 1, 1, 14, 3, 1, NULL, NULL, NULL, 1, 24, 2),
(102, 1, 50, 1, 1, 1, 2, 14, 3, 1, NULL, NULL, NULL, 1, 25, 1),
(103, 1, 50, 1, 1, 1, 2, 14, 3, 1, NULL, NULL, NULL, 1, 25, 2),
(104, 1, 51, 1, 1, 1, 1, 14, 3, 1, NULL, NULL, NULL, 1, 24, 1),
(105, 1, 51, 1, 1, 1, 1, 14, 3, 1, NULL, NULL, NULL, 1, 24, 2),
(106, 1, 51, 1, 1, 1, 2, 14, 3, 1, NULL, NULL, NULL, 1, 25, 1),
(107, 1, 51, 1, 1, 1, 2, 14, 3, 1, NULL, NULL, NULL, 1, 25, 2),
(108, 1, 52, 1, 1, 1, 1, 14, 3, 1, NULL, NULL, NULL, 1, 24, 1),
(109, 1, 52, 1, 1, 1, 1, 14, 3, 1, NULL, NULL, NULL, 1, 24, 2),
(110, 1, 52, 1, 1, 1, 2, 14, 3, 1, NULL, NULL, NULL, 1, 25, 1),
(111, 1, 52, 1, 1, 1, 2, 14, 3, 1, NULL, NULL, NULL, 1, 25, 2),
(112, 1, 53, 1, 1, 1, 1, 14, 3, 1, NULL, NULL, NULL, 1, 24, 1),
(113, 1, 53, 1, 1, 1, 1, 14, 3, 1, NULL, NULL, NULL, 1, 24, 2),
(114, 1, 53, 1, 1, 1, 2, 14, 3, 1, NULL, NULL, NULL, 1, 25, 1),
(115, 1, 53, 1, 1, 1, 2, 14, 3, 1, NULL, NULL, NULL, 1, 25, 2),
(116, 1, 54, 1, 1, 1, 1, 14, 3, 1, NULL, NULL, NULL, 1, 24, 1),
(117, 1, 54, 1, 1, 1, 1, 14, 3, 1, NULL, NULL, NULL, 1, 24, 2),
(118, 1, 54, 1, 1, 1, 2, 14, 3, 1, NULL, NULL, NULL, 1, 25, 1),
(119, 1, 54, 1, 1, 1, 2, 14, 3, 1, NULL, NULL, NULL, 1, 25, 2),
(120, 1, 55, 1, 1, 1, 1, 14, 3, 1, NULL, NULL, NULL, 1, 24, 1),
(121, 1, 55, 1, 1, 1, 1, 14, 3, 1, NULL, NULL, NULL, 1, 24, 2),
(122, 1, 55, 1, 1, 1, 2, 14, 3, 1, NULL, NULL, NULL, 1, 25, 1),
(123, 1, 55, 1, 1, 1, 2, 14, 3, 1, NULL, NULL, NULL, 1, 25, 2),
(124, 1, 56, 1, 1, 1, 1, 14, 3, 1, NULL, NULL, NULL, 1, 24, 1),
(125, 1, 56, 1, 1, 1, 1, 14, 3, 1, NULL, NULL, NULL, 1, 24, 2),
(126, 1, 56, 1, 1, 1, 2, 14, 3, 1, NULL, NULL, NULL, 1, 25, 1),
(127, 1, 56, 1, 1, 1, 2, 14, 3, 1, NULL, NULL, NULL, 1, 25, 2),
(128, 1, 57, 1, 1, 1, 1, 14, 3, 1, NULL, NULL, NULL, 1, 24, 1),
(129, 1, 57, 1, 1, 1, 1, 14, 3, 1, NULL, NULL, NULL, 1, 24, 2),
(130, 1, 57, 1, 1, 1, 2, 14, 3, 1, NULL, NULL, NULL, 1, 25, 1),
(131, 1, 57, 1, 1, 1, 2, 14, 3, 1, NULL, NULL, NULL, 1, 25, 2),
(132, 1, 58, 1, 1, 1, 1, 14, 3, 1, NULL, NULL, NULL, 1, 24, 1),
(133, 1, 58, 1, 1, 1, 1, 14, 3, 1, NULL, NULL, NULL, 1, 24, 2),
(134, 1, 58, 1, 1, 1, 2, 14, 3, 1, NULL, NULL, NULL, 1, 25, 1),
(135, 1, 58, 1, 1, 1, 2, 14, 3, 1, NULL, NULL, NULL, 1, 25, 2),
(136, 1, 59, 1, 1, 1, 1, 14, 3, 1, NULL, NULL, NULL, 1, 24, 1),
(137, 1, 59, 1, 1, 1, 1, 14, 3, 1, NULL, NULL, NULL, 1, 24, 2),
(138, 1, 59, 1, 1, 1, 2, 14, 3, 1, NULL, NULL, NULL, 1, 25, 1),
(139, 1, 59, 1, 1, 1, 2, 14, 3, 1, NULL, NULL, NULL, 1, 25, 2),
(140, 1, 60, 1, 1, 1, 1, 14, 3, 1, NULL, NULL, NULL, 1, 24, 1),
(141, 1, 60, 1, 1, 1, 1, 14, 3, 1, NULL, NULL, NULL, 1, 24, 2),
(142, 1, 60, 1, 1, 1, 2, 14, 3, 1, NULL, NULL, NULL, 1, 25, 1),
(143, 1, 60, 1, 1, 1, 2, 14, 3, 1, NULL, NULL, NULL, 1, 25, 2),
(144, 1, 61, 1, 1, 1, 1, 14, 3, 1, NULL, NULL, NULL, 1, 24, 1),
(145, 1, 61, 1, 1, 1, 1, 14, 3, 1, NULL, NULL, NULL, 1, 24, 2),
(146, 1, 61, 1, 1, 1, 2, 14, 3, 1, NULL, NULL, NULL, 1, 25, 1),
(147, 1, 61, 1, 1, 1, 2, 14, 3, 1, NULL, NULL, NULL, 1, 25, 2),
(148, 1, 62, 1, 1, 1, 1, 14, 3, 1, NULL, NULL, NULL, 1, 24, 1),
(149, 1, 62, 1, 1, 1, 1, 14, 3, 1, NULL, NULL, NULL, 1, 24, 2),
(150, 1, 62, 1, 1, 1, 2, 14, 3, 1, NULL, NULL, NULL, 1, 25, 1),
(151, 1, 62, 1, 1, 1, 2, 14, 3, 1, NULL, NULL, NULL, 1, 25, 2),
(152, 1, 63, 1, 1, 1, 1, 14, 3, 1, NULL, NULL, NULL, 1, 24, 1),
(153, 1, 63, 1, 1, 1, 1, 14, 3, 1, NULL, NULL, NULL, 1, 24, 2),
(154, 1, 63, 1, 1, 1, 2, 14, 3, 1, NULL, NULL, NULL, 1, 25, 1),
(155, 1, 63, 1, 1, 1, 2, 14, 3, 1, NULL, NULL, NULL, 1, 25, 2),
(156, 1, 64, 1, 1, 1, 1, 14, 1, 1, NULL, NULL, NULL, 1, 24, 1),
(157, 1, 64, 1, 1, 1, 1, 14, 1, 1, NULL, NULL, NULL, 1, 24, 2),
(158, 1, 64, 1, 1, 1, 2, 14, 1, 1, NULL, NULL, NULL, 1, 25, 1),
(159, 1, 64, 1, 1, 1, 2, 14, 3, 1, NULL, NULL, NULL, 1, 25, 2),
(160, 1, 65, 1, 1, 1, 1, 12, 1, 1, NULL, NULL, NULL, 1, 25, 1),
(161, 1, 65, 1, 1, 1, 1, 12, 1, 1, NULL, NULL, NULL, 1, 25, 2),
(162, 1, 66, 1, 1, 1, 1, 12, 1, 1, NULL, NULL, NULL, 1, 25, 1),
(163, 1, 66, 1, 1, 1, 1, 12, 1, 1, NULL, NULL, NULL, 1, 25, 2),
(164, 1, 67, 1, 1, 1, 1, 12, 1, 1, NULL, NULL, NULL, 1, 25, 1),
(165, 1, 67, 1, 1, 1, 1, 12, 1, 1, NULL, NULL, NULL, 1, 25, 2),
(166, 1, 68, 1, 1, 1, 1, 12, 1, 1, NULL, NULL, NULL, 1, 25, 1),
(167, 1, 68, 1, 1, 1, 1, 12, 1, 2, NULL, NULL, NULL, 1, 25, 2),
(168, 1, 69, 1, 1, 1, 1, 15, 1, 2, NULL, NULL, NULL, 1, 24, 1),
(169, 1, 69, 1, 1, 1, 1, 15, 1, 2, NULL, NULL, NULL, 1, 24, 2),
(170, 1, 69, 1, 1, 1, 2, 15, 1, 2, NULL, NULL, NULL, 1, 25, 1),
(171, 1, 69, 1, 1, 1, 2, 15, 1, 2, NULL, NULL, NULL, 1, 25, 2),
(172, 1, 70, 1, 1, 1, 1, 15, 1, 1, NULL, NULL, NULL, 1, 24, 1),
(173, 1, 70, 1, 1, 1, 1, 15, 1, 1, NULL, NULL, NULL, 1, 24, 2),
(174, 1, 70, 1, 1, 1, 2, 15, 1, 1, NULL, NULL, NULL, 1, 25, 1),
(175, 1, 70, 1, 1, 1, 2, 15, 1, 1, NULL, NULL, NULL, 1, 25, 2),
(176, 1, 71, 1, 1, 1, 1, 15, 1, 1, NULL, NULL, NULL, 1, 24, 1),
(177, 1, 71, 1, 1, 1, 1, 15, 1, 1, NULL, NULL, NULL, 1, 24, 2),
(178, 1, 71, 1, 1, 1, 2, 15, 1, 1, NULL, NULL, NULL, 1, 25, 1),
(179, 1, 71, 1, 1, 1, 2, 15, 1, 1, NULL, NULL, NULL, 1, 25, 2),
(180, 1, 72, 1, 1, 1, 1, 15, 1, 2, NULL, NULL, NULL, 1, 24, 1),
(181, 1, 72, 1, 1, 1, 1, 15, 1, 2, NULL, NULL, NULL, 1, 24, 2),
(182, 1, 72, 1, 1, 1, 2, 15, 1, 2, NULL, NULL, NULL, 1, 25, 1),
(183, 1, 72, 1, 1, 1, 2, 15, 1, 2, NULL, NULL, NULL, 1, 25, 2),
(184, 1, 73, 1, 1, 1, 1, 15, 1, 1, NULL, NULL, NULL, 1, 24, 1),
(185, 1, 73, 1, 1, 1, 1, 15, 1, 1, NULL, NULL, NULL, 1, 24, 2),
(186, 1, 73, 1, 1, 1, 2, 15, 1, 1, NULL, NULL, NULL, 1, 25, 1),
(187, 1, 73, 1, 1, 1, 2, 15, 1, 2, NULL, NULL, NULL, 1, 25, 2),
(188, 1, 74, 1, 1, 1, 1, 15, 1, 1, NULL, NULL, NULL, 1, 24, 1),
(189, 1, 74, 1, 1, 1, 1, 15, 1, 1, NULL, NULL, NULL, 1, 24, 2),
(190, 1, 74, 1, 1, 1, 2, 15, 1, 1, NULL, NULL, NULL, 1, 25, 1),
(191, 1, 74, 1, 1, 1, 2, 15, 1, 1, NULL, NULL, NULL, 1, 25, 2),
(192, 1, 75, 1, 1, 1, 1, 15, 1, 1, NULL, NULL, NULL, 1, 24, 1),
(193, 1, 75, 1, 1, 1, 1, 15, 1, 1, NULL, NULL, NULL, 1, 24, 2),
(194, 1, 75, 1, 1, 1, 2, 15, 1, 1, NULL, NULL, NULL, 1, 25, 1),
(195, 1, 75, 1, 1, 1, 2, 15, 1, 1, NULL, NULL, NULL, 1, 25, 2),
(196, 1, 76, 1, 1, 1, 1, 15, 1, 1, NULL, NULL, NULL, 1, 24, 1),
(197, 1, 76, 1, 1, 1, 1, 15, 1, 1, NULL, NULL, NULL, 1, 24, 2),
(198, 1, 76, 1, 1, 1, 2, 15, 1, 1, NULL, NULL, NULL, 1, 25, 1),
(199, 1, 76, 1, 1, 1, 2, 15, 1, 1, NULL, NULL, NULL, 1, 25, 2),
(200, 1, 77, 1, 1, 1, 1, 15, 1, 1, NULL, NULL, NULL, 1, 24, 1),
(201, 1, 77, 1, 1, 1, 1, 15, 1, 1, NULL, NULL, NULL, 1, 24, 2),
(202, 1, 77, 1, 1, 1, 2, 15, 1, 1, NULL, NULL, NULL, 1, 25, 1),
(203, 1, 77, 1, 1, 1, 2, 15, 1, 1, NULL, NULL, NULL, 1, 25, 2),
(204, 1, 78, 1, 1, 1, 1, 15, 1, 1, NULL, NULL, NULL, 1, 24, 1),
(205, 1, 78, 1, 1, 1, 1, 15, 1, 1, NULL, NULL, NULL, 1, 24, 2),
(206, 1, 78, 1, 1, 1, 2, 15, 1, 1, NULL, NULL, NULL, 1, 25, 1),
(207, 1, 78, 1, 1, 1, 2, 15, 1, 1, NULL, NULL, NULL, 1, 25, 2),
(208, 1, 79, 1, 1, 1, 1, 15, 1, 1, NULL, NULL, NULL, 1, 24, 1),
(209, 1, 79, 1, 1, 1, 1, 15, 1, 1, NULL, NULL, NULL, 1, 24, 2),
(210, 1, 79, 1, 1, 1, 2, 15, 1, 1, NULL, NULL, NULL, 1, 25, 1),
(211, 1, 79, 1, 1, 1, 2, 15, 1, 1, NULL, NULL, NULL, 1, 25, 2),
(212, 1, 80, 1, 1, 1, 1, 15, 1, 2, NULL, NULL, NULL, 1, 24, 1),
(213, 1, 80, 1, 1, 1, 1, 15, 1, 2, NULL, NULL, NULL, 1, 24, 2),
(214, 1, 80, 1, 1, 1, 2, 15, 1, 2, NULL, NULL, NULL, 1, 25, 1),
(215, 1, 80, 1, 1, 1, 2, 15, 1, 2, NULL, NULL, NULL, 1, 25, 2),
(216, 1, 81, 1, 1, 1, 1, 15, 1, 2, NULL, NULL, NULL, 1, 24, 1),
(217, 1, 81, 1, 1, 1, 1, 15, 1, 2, NULL, NULL, NULL, 1, 24, 2),
(218, 1, 81, 1, 1, 1, 2, 15, 1, 2, NULL, NULL, NULL, 1, 25, 1),
(219, 1, 81, 1, 1, 1, 2, 15, 1, 2, NULL, NULL, NULL, 1, 25, 2),
(220, 1, 82, 1, 1, 1, 1, 15, 1, 2, NULL, NULL, NULL, 1, 24, 1),
(221, 1, 82, 1, 1, 1, 1, 15, 1, 2, NULL, NULL, NULL, 1, 24, 2),
(222, 1, 82, 1, 1, 1, 2, 15, 1, 2, NULL, NULL, NULL, 1, 25, 1),
(223, 1, 82, 1, 1, 1, 2, 15, 1, 2, NULL, NULL, NULL, 1, 25, 2),
(224, 1, 83, 1, 1, 1, 1, 15, 1, 1, NULL, NULL, NULL, 1, 24, 1),
(225, 1, 83, 1, 1, 1, 1, 15, 1, 1, NULL, NULL, NULL, 1, 24, 2),
(226, 1, 83, 1, 1, 1, 2, 15, 1, 1, NULL, NULL, NULL, 1, 25, 1),
(227, 1, 83, 1, 1, 1, 2, 15, 1, 1, NULL, NULL, NULL, 1, 25, 2),
(228, 1, 84, 1, 1, 1, 1, 15, 1, 2, NULL, NULL, NULL, 1, 24, 1),
(229, 1, 84, 1, 1, 1, 1, 15, 1, 2, NULL, NULL, NULL, 1, 24, 2),
(230, 1, 84, 1, 1, 1, 2, 15, 1, 2, NULL, NULL, NULL, 1, 25, 1),
(231, 1, 84, 1, 1, 1, 2, 15, 1, 2, NULL, NULL, NULL, 1, 25, 2),
(232, 1, 85, 1, 1, 1, 1, 15, 1, 2, NULL, NULL, NULL, 1, 24, 1),
(233, 1, 85, 1, 1, 1, 1, 15, 1, 2, NULL, NULL, NULL, 1, 24, 2),
(234, 1, 85, 1, 1, 1, 2, 15, 1, 2, NULL, NULL, NULL, 1, 25, 1),
(235, 1, 85, 1, 1, 1, 2, 15, 1, 2, NULL, NULL, NULL, 1, 25, 2),
(236, 1, 86, 1, 1, 1, 1, 15, 1, 1, NULL, NULL, NULL, 1, 24, 1),
(237, 1, 86, 1, 1, 1, 1, 15, 1, 1, NULL, NULL, NULL, 1, 24, 2),
(238, 1, 86, 1, 1, 1, 2, 15, 1, 1, NULL, NULL, NULL, 1, 25, 1),
(239, 1, 86, 1, 1, 1, 2, 15, 1, 1, NULL, NULL, NULL, 1, 25, 2),
(240, 1, 87, 1, 1, 1, 1, 15, 1, 1, NULL, NULL, NULL, 1, 24, 1),
(241, 1, 87, 1, 1, 1, 1, 15, 1, 1, NULL, NULL, NULL, 1, 24, 2),
(242, 1, 87, 1, 1, 1, 2, 15, 1, 1, NULL, NULL, NULL, 1, 25, 1),
(243, 1, 87, 1, 1, 1, 2, 15, 1, 1, NULL, NULL, NULL, 1, 25, 2),
(244, 1, 88, 1, 1, 1, 1, 15, 1, 2, NULL, NULL, NULL, 1, 24, 1),
(245, 1, 88, 1, 1, 1, 1, 15, 1, 2, NULL, NULL, NULL, 1, 24, 2),
(246, 1, 88, 1, 1, 1, 2, 15, 1, 2, NULL, NULL, NULL, 1, 25, 1),
(247, 1, 88, 1, 1, 1, 2, 15, 1, 2, NULL, NULL, NULL, 1, 25, 2),
(248, 1, 89, 1, 1, 1, 1, 15, 1, 2, NULL, NULL, NULL, 1, 24, 1),
(249, 1, 89, 1, 1, 1, 1, 15, 1, 2, NULL, NULL, NULL, 1, 24, 2),
(250, 1, 89, 1, 1, 1, 2, 15, 1, 2, NULL, NULL, NULL, 1, 25, 1),
(251, 1, 89, 1, 1, 1, 2, 15, 1, 2, NULL, NULL, NULL, 1, 25, 2),
(252, 1, 90, 1, 1, 1, 1, 6, 1, 2, NULL, NULL, NULL, 1, 24, 1),
(253, 1, 90, 1, 1, 1, 1, 6, 1, 2, NULL, NULL, NULL, 1, 24, 2),
(254, 1, 90, 1, 1, 1, 2, 6, 1, 2, NULL, NULL, NULL, 1, 25, 1),
(255, 1, 90, 1, 1, 1, 2, 6, 1, 2, NULL, NULL, NULL, 1, 25, 2),
(256, 1, 91, 1, 1, 1, 1, 6, 1, 1, NULL, NULL, NULL, 1, 24, 1),
(257, 1, 91, 1, 1, 1, 1, 6, 1, 1, NULL, NULL, NULL, 1, 24, 2),
(258, 1, 91, 1, 1, 1, 2, 6, 1, 1, NULL, NULL, NULL, 1, 25, 1),
(259, 1, 91, 1, 1, 1, 2, 6, 1, 1, NULL, NULL, NULL, 1, 25, 2),
(260, 1, 92, 1, 1, 1, 1, 6, 1, 1, NULL, NULL, NULL, 1, 24, 1),
(261, 1, 92, 1, 1, 1, 1, 6, 1, 1, NULL, NULL, NULL, 1, 24, 2),
(262, 1, 92, 1, 1, 1, 2, 6, 1, 1, NULL, NULL, NULL, 1, 25, 1),
(263, 1, 92, 1, 1, 1, 2, 6, 1, 1, NULL, NULL, NULL, 1, 25, 2),
(264, 1, 93, 1, 1, 1, 1, 6, 1, 1, NULL, NULL, NULL, 1, 24, 1),
(265, 1, 93, 1, 1, 1, 1, 6, 1, 1, NULL, NULL, NULL, 1, 24, 2),
(266, 1, 93, 1, 1, 1, 2, 6, 1, 1, NULL, NULL, NULL, 1, 25, 1),
(267, 1, 93, 1, 1, 1, 2, 6, 1, 1, NULL, NULL, NULL, 1, 25, 2),
(268, 1, 94, 1, 1, 1, 1, 6, 1, 1, NULL, NULL, NULL, 1, 24, 1),
(269, 1, 94, 1, 1, 1, 1, 6, 1, 1, NULL, NULL, NULL, 1, 24, 2),
(270, 1, 94, 1, 1, 1, 2, 6, 1, 1, NULL, NULL, NULL, 1, 25, 1),
(271, 1, 94, 1, 1, 1, 2, 6, 1, 1, NULL, NULL, NULL, 1, 25, 2),
(272, 1, 95, 1, 1, 1, 1, 6, 1, 1, NULL, NULL, NULL, 1, 24, 1),
(273, 1, 95, 1, 1, 1, 1, 6, 1, 1, NULL, NULL, NULL, 1, 24, 2),
(274, 1, 95, 1, 1, 1, 2, 6, 1, 1, NULL, NULL, NULL, 1, 25, 1),
(275, 1, 95, 1, 1, 1, 2, 6, 1, 1, NULL, NULL, NULL, 1, 25, 2),
(276, 1, 96, 1, 1, 1, 1, 6, 1, 1, NULL, NULL, NULL, 1, 24, 1),
(277, 1, 96, 1, 1, 1, 1, 6, 1, 1, NULL, NULL, NULL, 1, 24, 2),
(278, 1, 96, 1, 1, 1, 2, 6, 1, 1, NULL, NULL, NULL, 1, 25, 1),
(279, 1, 96, 1, 1, 1, 2, 6, 1, 1, NULL, NULL, NULL, 1, 25, 2),
(280, 1, 97, 1, 1, 1, 1, 6, 1, 2, NULL, NULL, NULL, 1, 24, 1),
(281, 1, 97, 1, 1, 1, 1, 6, 1, 2, NULL, NULL, NULL, 1, 24, 2),
(282, 1, 97, 1, 1, 1, 2, 6, 1, 2, NULL, NULL, NULL, 1, 25, 1),
(1039, 1, 291, 1, 1, 1, 1, 14, 3, 1, NULL, NULL, NULL, 1, 23, 1),
(284, 1, 98, 1, 1, 1, 1, 6, 1, 1, NULL, NULL, NULL, 1, 24, 1),
(285, 1, 98, 1, 1, 1, 1, 6, 1, 1, NULL, NULL, NULL, 1, 24, 2),
(286, 1, 98, 1, 1, 1, 2, 6, 1, 1, NULL, NULL, NULL, 1, 25, 1),
(287, 1, 98, 1, 1, 1, 2, 6, 1, 1, NULL, NULL, NULL, 1, 25, 2),
(288, 1, 99, 1, 1, 1, 1, 6, 1, 2, NULL, NULL, NULL, 1, 24, 1),
(289, 1, 99, 1, 1, 1, 1, 6, 1, 2, NULL, NULL, NULL, 1, 24, 2),
(290, 1, 99, 1, 1, 1, 2, 6, 1, 2, NULL, NULL, NULL, 1, 25, 1),
(291, 1, 99, 1, 1, 1, 2, 6, 1, 2, NULL, NULL, NULL, 1, 25, 2),
(292, 1, 100, 1, 1, 1, 1, 6, 1, 1, NULL, NULL, NULL, 1, 24, 1),
(293, 1, 100, 1, 1, 1, 1, 6, 1, 1, NULL, NULL, NULL, 1, 24, 2),
(294, 1, 100, 1, 1, 1, 2, 6, 1, 1, NULL, NULL, NULL, 1, 25, 1),
(295, 1, 100, 1, 1, 1, 2, 6, 1, 1, NULL, NULL, NULL, 1, 25, 2),
(296, 1, 101, 1, 1, 1, 1, 6, 1, 1, NULL, NULL, NULL, 1, 24, 1),
(297, 1, 101, 1, 1, 1, 1, 6, 1, 1, NULL, NULL, NULL, 1, 24, 2),
(298, 1, 101, 1, 1, 1, 2, 6, 1, 1, NULL, NULL, NULL, 1, 25, 1),
(299, 1, 101, 1, 1, 1, 2, 6, 1, 1, NULL, NULL, NULL, 1, 25, 2),
(300, 1, 102, 1, 1, 1, 1, 6, 1, 1, NULL, NULL, NULL, 1, 24, 1),
(301, 1, 102, 1, 1, 1, 1, 6, 1, 1, NULL, NULL, NULL, 1, 24, 2),
(302, 1, 102, 1, 1, 1, 2, 6, 1, 1, NULL, NULL, NULL, 1, 25, 1),
(303, 1, 102, 1, 1, 1, 2, 6, 1, 1, NULL, NULL, NULL, 1, 25, 2),
(304, 1, 103, 1, 1, 1, 1, 6, 1, 1, NULL, NULL, NULL, 1, 24, 1),
(305, 1, 103, 1, 1, 1, 1, 6, 1, 1, NULL, NULL, NULL, 1, 24, 2),
(306, 1, 103, 1, 1, 1, 2, 6, 1, 1, NULL, NULL, NULL, 1, 25, 1),
(307, 1, 103, 1, 1, 1, 2, 6, 1, 1, NULL, NULL, NULL, 1, 25, 2),
(308, 1, 104, 1, 1, 1, 1, 6, 1, 1, NULL, NULL, NULL, 1, 24, 1),
(309, 1, 104, 1, 1, 1, 1, 6, 1, 1, NULL, NULL, NULL, 1, 24, 2),
(310, 1, 104, 1, 1, 1, 2, 6, 1, 1, NULL, NULL, NULL, 1, 25, 1),
(311, 1, 104, 1, 1, 1, 2, 6, 1, 1, NULL, NULL, NULL, 1, 25, 2),
(312, 1, 105, 1, 1, 1, 1, 6, 1, 1, NULL, NULL, NULL, 1, 24, 1),
(313, 1, 105, 1, 1, 1, 1, 6, 1, 1, NULL, NULL, NULL, 1, 24, 2),
(314, 1, 105, 1, 1, 1, 2, 6, 1, 1, NULL, NULL, NULL, 1, 25, 1),
(315, 1, 105, 1, 1, 1, 2, 6, 1, 1, NULL, NULL, NULL, 1, 25, 2),
(316, 1, 106, 1, 1, 1, 1, 6, 1, 2, NULL, NULL, NULL, 1, 24, 1),
(317, 1, 106, 1, 1, 1, 1, 6, 1, 2, NULL, NULL, NULL, 1, 24, 2),
(318, 1, 106, 1, 1, 1, 2, 6, 1, 2, NULL, NULL, NULL, 1, 25, 1),
(319, 1, 106, 1, 1, 1, 2, 6, 1, 2, NULL, NULL, NULL, 1, 25, 2),
(320, 1, 107, 1, 1, 1, 1, 6, 1, 2, NULL, NULL, NULL, 1, 24, 1),
(321, 1, 107, 1, 1, 1, 1, 6, 1, 2, NULL, NULL, NULL, 1, 24, 2),
(322, 1, 107, 1, 1, 1, 2, 6, 1, 2, NULL, NULL, NULL, 1, 25, 1),
(323, 1, 107, 1, 1, 1, 2, 6, 1, 2, NULL, NULL, NULL, 1, 25, 2),
(324, 1, 108, 1, 1, 1, 1, 6, 1, 1, NULL, NULL, NULL, 1, 24, 1),
(325, 1, 108, 1, 1, 1, 1, 6, 1, 1, NULL, NULL, NULL, 1, 24, 2),
(326, 1, 108, 1, 1, 1, 2, 6, 1, 1, NULL, NULL, NULL, 1, 25, 1),
(327, 1, 108, 1, 1, 1, 2, 6, 1, 1, NULL, NULL, NULL, 1, 25, 2),
(328, 1, 109, 1, 1, 1, 1, 6, 1, 1, NULL, NULL, NULL, 1, 24, 1),
(329, 1, 109, 1, 1, 1, 1, 6, 1, 1, NULL, NULL, NULL, 1, 24, 2),
(330, 1, 109, 1, 1, 1, 2, 6, 1, 1, NULL, NULL, NULL, 1, 25, 1),
(331, 1, 109, 1, 1, 1, 2, 6, 1, 1, NULL, NULL, NULL, 1, 25, 2),
(332, 1, 110, 1, 1, 1, 1, 6, 1, 1, NULL, NULL, NULL, 1, 24, 1),
(333, 1, 110, 1, 1, 1, 1, 6, 1, 1, NULL, NULL, NULL, 1, 24, 2),
(334, 1, 110, 1, 1, 1, 2, 6, 1, 1, NULL, NULL, NULL, 1, 25, 1),
(335, 1, 110, 1, 1, 1, 2, 6, 1, 1, NULL, NULL, NULL, 1, 25, 2),
(336, 1, 111, 1, 1, 1, 1, 6, 1, 1, NULL, NULL, NULL, 1, 24, 1),
(337, 1, 111, 1, 1, 1, 1, 6, 1, 1, NULL, NULL, NULL, 1, 24, 2),
(338, 1, 111, 1, 1, 1, 2, 6, 1, 1, NULL, NULL, NULL, 1, 25, 1),
(339, 1, 111, 1, 1, 1, 2, 6, 1, 1, NULL, NULL, NULL, 1, 25, 2),
(340, 1, 112, 1, 1, 1, 1, 6, 1, 1, NULL, NULL, NULL, 1, 24, 1),
(341, 1, 112, 1, 1, 1, 1, 6, 1, 1, NULL, NULL, NULL, 1, 24, 2),
(342, 1, 112, 1, 1, 1, 2, 6, 1, 1, NULL, NULL, NULL, 1, 25, 1),
(343, 1, 112, 1, 1, 1, 2, 6, 1, 2, NULL, NULL, NULL, 1, 25, 2),
(344, 1, 113, 1, 1, 1, 1, 6, 1, 2, NULL, NULL, NULL, 1, 24, 1),
(345, 1, 113, 1, 1, 1, 1, 6, 1, 2, NULL, NULL, NULL, 1, 24, 2),
(346, 1, 113, 1, 1, 1, 2, 6, 1, 2, NULL, NULL, NULL, 1, 25, 1),
(347, 1, 113, 1, 1, 1, 2, 6, 1, 2, NULL, NULL, NULL, 1, 25, 2),
(348, 1, 114, 1, 1, 1, 1, 6, 1, 1, NULL, NULL, NULL, 1, 24, 1),
(349, 1, 114, 1, 1, 1, 1, 6, 1, 1, NULL, NULL, NULL, 1, 24, 2),
(350, 1, 114, 1, 1, 1, 2, 6, 1, 1, NULL, NULL, NULL, 1, 25, 1),
(351, 1, 114, 1, 1, 1, 2, 6, 1, 1, NULL, NULL, NULL, 1, 25, 2),
(352, 1, 115, 1, 1, 1, 1, 6, 1, 2, NULL, NULL, NULL, 1, 24, 1),
(353, 1, 115, 1, 1, 1, 1, 6, 1, 2, NULL, NULL, NULL, 1, 24, 2),
(354, 1, 115, 1, 1, 1, 2, 6, 1, 2, NULL, NULL, NULL, 1, 25, 1),
(355, 1, 115, 1, 1, 1, 2, 6, 1, 2, NULL, NULL, NULL, 1, 25, 2),
(356, 1, 116, 1, 1, 1, 1, 6, 1, 1, NULL, NULL, NULL, 1, 24, 1),
(357, 1, 116, 1, 1, 1, 1, 6, 1, 1, NULL, NULL, NULL, 1, 24, 2),
(358, 1, 116, 1, 1, 1, 2, 6, 1, 1, NULL, NULL, NULL, 1, 25, 1),
(359, 1, 116, 1, 1, 1, 2, 6, 1, 1, NULL, NULL, NULL, 1, 25, 2),
(360, 1, 117, 1, 1, 1, 1, 6, 1, 1, NULL, NULL, NULL, 1, 24, 1),
(361, 1, 117, 1, 1, 1, 1, 6, 1, 1, NULL, NULL, NULL, 1, 24, 2),
(362, 1, 117, 1, 1, 1, 2, 6, 1, 1, NULL, NULL, NULL, 1, 25, 1),
(363, 1, 117, 1, 1, 1, 2, 6, 1, 1, NULL, NULL, NULL, 1, 25, 2),
(364, 1, 118, 1, 1, 1, 1, 6, 1, 1, NULL, NULL, NULL, 1, 24, 1),
(365, 1, 118, 1, 1, 1, 1, 6, 1, 1, NULL, NULL, NULL, 1, 24, 2),
(366, 1, 118, 1, 1, 1, 2, 6, 1, 1, NULL, NULL, NULL, 1, 25, 1),
(367, 1, 118, 1, 1, 1, 2, 6, 1, 1, NULL, NULL, NULL, 1, 25, 2),
(368, 1, 119, 1, 1, 1, 1, 9, 1, 2, NULL, NULL, NULL, 1, 24, 1),
(369, 1, 119, 1, 1, 1, 1, 9, 1, 2, NULL, NULL, NULL, 1, 24, 2),
(370, 1, 119, 1, 1, 1, 2, 9, 1, 2, NULL, NULL, NULL, 1, 25, 1),
(371, 1, 119, 1, 1, 1, 2, 9, 1, 2, NULL, NULL, NULL, 1, 25, 2),
(372, 1, 120, 1, 1, 1, 1, 9, 1, 1, NULL, NULL, NULL, 1, 24, 1),
(373, 1, 120, 1, 1, 1, 1, 9, 1, 1, NULL, NULL, NULL, 1, 24, 2),
(374, 1, 120, 1, 1, 1, 2, 9, 1, 1, NULL, NULL, NULL, 1, 25, 1),
(375, 1, 120, 1, 1, 1, 2, 9, 1, 1, NULL, NULL, NULL, 1, 25, 2),
(376, 1, 121, 1, 1, 1, 1, 9, 1, 1, NULL, NULL, NULL, 1, 24, 1),
(377, 1, 121, 1, 1, 1, 1, 9, 1, 1, NULL, NULL, NULL, 1, 24, 2),
(378, 1, 121, 1, 1, 1, 2, 9, 1, 1, NULL, NULL, NULL, 1, 25, 1),
(379, 1, 121, 1, 1, 1, 2, 9, 1, 1, NULL, NULL, NULL, 1, 25, 2),
(380, 1, 122, 1, 1, 1, 1, 6, 1, 1, NULL, NULL, NULL, 1, 24, 1),
(381, 1, 122, 1, 1, 1, 1, 6, 1, 1, NULL, NULL, NULL, 1, 24, 2),
(382, 1, 122, 1, 1, 1, 2, 6, 1, 1, NULL, NULL, NULL, 1, 25, 1),
(383, 1, 122, 1, 1, 1, 2, 9, 1, 1, NULL, NULL, NULL, 1, 25, 2),
(384, 1, 123, 1, 1, 1, 1, 9, 1, 1, NULL, NULL, NULL, 1, 24, 1),
(385, 1, 123, 1, 1, 1, 1, 9, 1, 1, NULL, NULL, NULL, 1, 24, 2),
(386, 1, 123, 1, 1, 1, 2, 9, 1, 1, NULL, NULL, NULL, 1, 25, 1),
(387, 1, 123, 1, 1, 1, 2, 9, 1, 1, NULL, NULL, NULL, 1, 25, 2),
(388, 1, 124, 1, 1, 1, 1, 9, 1, 2, NULL, NULL, NULL, 1, 24, 1),
(389, 1, 124, 1, 1, 1, 1, 9, 1, 2, NULL, NULL, NULL, 1, 24, 2),
(390, 1, 124, 1, 1, 1, 2, 9, 1, 2, NULL, NULL, NULL, 1, 25, 1),
(391, 1, 124, 1, 1, 1, 2, 9, 1, 2, NULL, NULL, NULL, 1, 25, 2),
(392, 1, 125, 1, 1, 1, 1, 9, 1, 2, NULL, NULL, NULL, 1, 24, 1),
(393, 1, 125, 1, 1, 1, 1, 9, 1, 2, NULL, NULL, NULL, 1, 24, 2),
(394, 1, 125, 1, 1, 1, 2, 9, 1, 2, NULL, NULL, NULL, 1, 25, 1),
(395, 1, 125, 1, 1, 1, 2, 9, 1, 2, NULL, NULL, NULL, 1, 25, 2),
(396, 1, 126, 1, 1, 1, 1, 9, 1, 2, NULL, NULL, NULL, 1, 24, 1),
(397, 1, 126, 1, 1, 1, 1, 9, 1, 2, NULL, NULL, NULL, 1, 24, 2),
(398, 1, 126, 1, 1, 1, 2, 9, 1, 2, NULL, NULL, NULL, 1, 25, 1),
(399, 1, 126, 1, 1, 1, 2, 9, 1, 2, NULL, NULL, NULL, 1, 25, 2),
(400, 1, 127, 1, 1, 1, 1, 9, 1, 2, NULL, NULL, NULL, 1, 24, 1),
(401, 1, 127, 1, 1, 1, 1, 9, 1, 2, NULL, NULL, NULL, 1, 24, 2),
(402, 1, 127, 1, 1, 1, 2, 9, 1, 2, NULL, NULL, NULL, 1, 25, 1),
(403, 1, 127, 1, 1, 1, 2, 9, 1, 2, NULL, NULL, NULL, 1, 25, 2),
(404, 1, 128, 1, 1, 1, 1, 9, 1, 2, NULL, NULL, NULL, 1, 24, 1),
(405, 1, 128, 1, 1, 1, 1, 9, 1, 2, NULL, NULL, NULL, 1, 24, 2),
(406, 1, 128, 1, 1, 1, 2, 9, 1, 2, NULL, NULL, NULL, 1, 25, 1),
(407, 1, 128, 1, 1, 1, 2, 9, 1, 2, NULL, NULL, NULL, 1, 25, 2),
(408, 1, 129, 1, 1, 1, 1, 9, 1, 1, NULL, NULL, NULL, 1, 24, 1),
(409, 1, 129, 1, 1, 1, 1, 9, 1, 1, NULL, NULL, NULL, 1, 24, 2),
(410, 1, 129, 1, 1, 1, 2, 9, 1, 1, NULL, NULL, NULL, 1, 25, 1),
(411, 1, 129, 1, 1, 1, 2, 9, 1, 1, NULL, NULL, NULL, 1, 25, 2),
(412, 1, 130, 1, 1, 1, 1, 9, 1, 2, NULL, NULL, NULL, 1, 24, 1),
(413, 1, 130, 1, 1, 1, 1, 9, 1, 2, NULL, NULL, NULL, 1, 24, 2),
(414, 1, 130, 1, 1, 1, 2, 9, 1, 2, NULL, NULL, NULL, 1, 25, 1),
(415, 1, 130, 1, 1, 1, 2, 9, 1, 2, NULL, NULL, NULL, 1, 25, 2),
(416, 1, 131, 1, 1, 1, 1, 9, 1, 1, NULL, NULL, NULL, 1, 24, 1),
(417, 1, 131, 1, 1, 1, 1, 9, 1, 1, NULL, NULL, NULL, 1, 24, 2),
(418, 1, 131, 1, 1, 1, 2, 9, 1, 1, NULL, NULL, NULL, 1, 25, 1),
(419, 1, 131, 1, 1, 1, 2, 9, 1, 1, NULL, NULL, NULL, 1, 25, 2),
(420, 1, 132, 1, 1, 1, 1, 9, 1, 1, NULL, NULL, NULL, 1, 24, 1),
(421, 1, 132, 1, 1, 1, 1, 9, 1, 1, NULL, NULL, NULL, 1, 24, 2),
(422, 1, 132, 1, 1, 1, 2, 9, 1, 1, NULL, NULL, NULL, 1, 25, 1),
(423, 1, 132, 1, 1, 1, 2, 9, 1, 1, NULL, NULL, NULL, 1, 25, 2),
(424, 1, 133, 1, 1, 1, 1, 9, 1, 1, NULL, NULL, NULL, 1, 24, 1),
(425, 1, 133, 1, 1, 1, 1, 9, 1, 1, NULL, NULL, NULL, 1, 24, 2),
(426, 1, 133, 1, 1, 1, 2, 9, 1, 1, NULL, NULL, NULL, 1, 25, 1),
(427, 1, 133, 1, 1, 1, 2, 9, 1, 1, NULL, NULL, NULL, 1, 25, 2),
(428, 1, 134, 1, 1, 1, 1, 9, 1, 1, NULL, NULL, NULL, 1, 24, 1),
(429, 1, 134, 1, 1, 1, 1, 9, 1, 1, NULL, NULL, NULL, 1, 24, 2),
(430, 1, 134, 1, 1, 1, 2, 9, 1, 1, NULL, NULL, NULL, 1, 25, 1),
(431, 1, 134, 1, 1, 1, 2, 9, 1, 1, NULL, NULL, NULL, 1, 25, 2),
(432, 1, 135, 1, 1, 1, 1, 9, 1, 2, NULL, NULL, NULL, 1, 24, 1),
(433, 1, 135, 1, 1, 1, 1, 9, 1, 2, NULL, NULL, NULL, 1, 24, 2),
(434, 1, 135, 1, 1, 1, 2, 9, 1, 2, NULL, NULL, NULL, 1, 25, 1),
(435, 1, 135, 1, 1, 1, 2, 9, 1, 2, NULL, NULL, NULL, 1, 25, 2),
(436, 1, 136, 1, 1, 1, 1, 9, 1, 2, NULL, NULL, NULL, 1, 24, 1),
(437, 1, 136, 1, 1, 1, 1, 9, 1, 2, NULL, NULL, NULL, 1, 24, 2),
(438, 1, 136, 1, 1, 1, 2, 9, 1, 2, NULL, NULL, NULL, 1, 25, 1),
(439, 1, 136, 1, 1, 1, 2, 9, 1, 2, NULL, NULL, NULL, 1, 25, 2),
(440, 1, 137, 1, 1, 1, 1, 12, 1, 2, NULL, NULL, NULL, 1, 25, 1),
(441, 1, 137, 1, 1, 1, 1, 12, 1, 2, NULL, NULL, NULL, 1, 25, 2),
(442, 1, 138, 1, 1, 1, 1, 12, 1, 1, NULL, NULL, NULL, 1, 25, 1),
(443, 1, 138, 1, 1, 1, 1, 12, 1, 1, NULL, NULL, NULL, 1, 25, 2),
(444, 1, 139, 1, 1, 1, 1, 12, 1, 1, NULL, NULL, NULL, 1, 25, 1),
(445, 1, 139, 1, 1, 1, 1, 12, 1, 1, NULL, NULL, NULL, 1, 25, 2),
(446, 1, 140, 1, 1, 1, 1, 12, 1, 1, NULL, NULL, NULL, 1, 25, 1),
(447, 1, 140, 1, 1, 1, 1, 12, 1, 1, NULL, NULL, NULL, 1, 25, 2),
(448, 1, 141, 1, 1, 1, 1, 12, 1, 1, NULL, NULL, NULL, 1, 25, 1),
(449, 1, 141, 1, 1, 1, 1, 12, 1, 1, NULL, NULL, NULL, 1, 25, 2),
(450, 1, 142, 1, 1, 1, 1, 12, 1, 1, NULL, NULL, NULL, 1, 25, 2),
(451, 1, 143, 1, 1, 1, 1, 12, 1, 1, NULL, NULL, NULL, 1, 25, 1),
(452, 1, 143, 1, 1, 1, 1, 12, 1, 1, NULL, NULL, NULL, 1, 25, 2),
(453, 1, 144, 1, 1, 1, 1, 12, 1, 1, NULL, NULL, NULL, 1, 25, 2),
(454, 1, 145, 1, 1, 1, 1, 12, 1, 1, NULL, NULL, NULL, 1, 25, 1),
(455, 1, 145, 1, 1, 1, 1, 12, 1, 1, NULL, NULL, NULL, 1, 25, 2),
(456, 1, 47, 1, 1, 1, 1, 14, 3, 1, NULL, NULL, NULL, 1, 24, 2),
(457, 1, 144, 1, 1, 1, 1, 12, 1, 1, NULL, NULL, NULL, 1, 25, 1),
(458, 1, 142, 1, 1, 1, 1, 12, 1, 1, NULL, NULL, NULL, 1, 25, 1),
(459, 1, 146, 1, 1, 1, 1, 6, 1, 2, NULL, NULL, NULL, 1, 24, 1),
(460, 1, 146, 1, 1, 1, 1, 6, 1, 2, NULL, NULL, NULL, 1, 24, 2),
(461, 1, 146, 1, 1, 1, 2, 6, 1, 2, NULL, NULL, NULL, 1, 25, 1),
(462, 1, 146, 1, 1, 1, 2, 8, 1, 2, NULL, NULL, NULL, 1, 25, 2),
(463, 1, 147, 1, 1, 1, 1, 8, 1, 2, NULL, NULL, NULL, 1, 24, 1),
(464, 1, 147, 1, 1, 1, 1, 8, 1, 2, NULL, NULL, NULL, 1, 24, 2),
(465, 1, 147, 1, 1, 1, 2, 8, 1, 2, NULL, NULL, NULL, 1, 25, 1),
(466, 1, 147, 1, 1, 1, 2, 8, 1, 2, NULL, NULL, NULL, 1, 25, 2),
(467, 1, 148, 1, 1, 1, 1, 8, 1, 1, NULL, NULL, NULL, 1, 24, 1),
(468, 1, 148, 1, 1, 1, 1, 8, 1, 1, NULL, NULL, NULL, 1, 24, 2),
(469, 1, 148, 1, 1, 1, 2, 8, 1, 1, NULL, NULL, NULL, 1, 25, 1),
(470, 1, 148, 1, 1, 1, 2, 8, 1, 1, NULL, NULL, NULL, 1, 25, 2),
(471, 1, 149, 1, 1, 1, 1, 8, 1, 1, NULL, NULL, NULL, 1, 24, 1),
(472, 1, 149, 1, 1, 1, 1, 8, 1, 1, NULL, NULL, NULL, 1, 24, 2),
(473, 1, 149, 1, 1, 1, 2, 8, 1, 1, NULL, NULL, NULL, 1, 25, 1),
(474, 1, 149, 1, 1, 1, 2, 8, 1, 1, NULL, NULL, NULL, 1, 25, 2),
(475, 1, 150, 1, 1, 1, 1, 8, 1, 2, NULL, NULL, NULL, 1, 24, 1),
(476, 1, 150, 1, 1, 1, 1, 8, 1, 2, NULL, NULL, NULL, 1, 24, 2),
(477, 1, 150, 1, 1, 1, 2, 8, 1, 2, NULL, NULL, NULL, 1, 25, 1),
(478, 1, 150, 1, 1, 1, 2, 8, 1, 2, NULL, NULL, NULL, 1, 25, 2),
(479, 1, 151, 1, 1, 1, 1, 8, 1, 2, NULL, NULL, NULL, 1, 24, 1),
(480, 1, 151, 1, 1, 1, 1, 8, 1, 2, NULL, NULL, NULL, 1, 24, 2),
(481, 1, 151, 1, 1, 1, 2, 8, 1, 2, NULL, NULL, NULL, 1, 25, 1),
(482, 1, 151, 1, 1, 1, 2, 8, 1, 2, NULL, NULL, NULL, 1, 25, 2),
(483, 1, 152, 1, 1, 1, 1, 8, 1, 2, NULL, NULL, NULL, 1, 24, 1),
(484, 1, 152, 1, 1, 1, 1, 8, 1, 2, NULL, NULL, NULL, 1, 24, 2),
(485, 1, 152, 1, 1, 1, 2, 8, 1, 2, NULL, NULL, NULL, 1, 25, 1),
(486, 1, 152, 1, 1, 1, 2, 8, 1, 2, NULL, NULL, NULL, 1, 25, 2),
(487, 1, 153, 1, 1, 1, 1, 8, 1, 1, NULL, NULL, NULL, 1, 24, 1),
(488, 1, 153, 1, 1, 1, 1, 8, 1, 1, NULL, NULL, NULL, 1, 24, 2),
(489, 1, 153, 1, 1, 1, 2, 8, 1, 1, NULL, NULL, NULL, 1, 25, 1),
(490, 1, 153, 1, 1, 1, 2, 8, 1, 1, NULL, NULL, NULL, 1, 25, 2),
(491, 1, 154, 1, 1, 1, 1, 8, 1, 1, NULL, NULL, NULL, 1, 24, 1),
(492, 1, 154, 1, 1, 1, 1, 8, 1, 1, NULL, NULL, NULL, 1, 24, 2),
(493, 1, 154, 1, 1, 1, 2, 8, 1, 1, NULL, NULL, NULL, 1, 25, 1),
(494, 1, 154, 1, 1, 1, 2, 8, 1, 1, NULL, NULL, NULL, 1, 25, 2),
(495, 1, 155, 1, 1, 1, 1, 8, 1, 1, NULL, NULL, NULL, 1, 24, 1),
(496, 1, 155, 1, 1, 1, 1, 8, 1, 1, NULL, NULL, NULL, 1, 24, 2),
(497, 1, 155, 1, 1, 1, 2, 8, 1, 1, NULL, NULL, NULL, 1, 25, 1),
(498, 1, 155, 1, 1, 1, 2, 8, 1, 1, NULL, NULL, NULL, 1, 25, 2),
(499, 1, 156, 1, 1, 1, 1, 8, 1, 1, NULL, NULL, NULL, 1, 24, 1),
(500, 1, 156, 1, 1, 1, 1, 8, 1, 1, NULL, NULL, NULL, 1, 24, 2),
(501, 1, 156, 1, 1, 1, 2, 8, 1, 1, NULL, NULL, NULL, 1, 25, 1),
(502, 1, 156, 1, 1, 1, 2, 8, 1, 1, NULL, NULL, NULL, 1, 25, 2),
(503, 1, 157, 1, 1, 1, 1, 8, 1, 1, NULL, NULL, NULL, 1, 24, 1),
(504, 1, 157, 1, 1, 1, 1, 8, 1, 1, NULL, NULL, NULL, 1, 24, 2),
(505, 1, 157, 1, 1, 1, 2, 8, 1, 1, NULL, NULL, NULL, 1, 25, 1),
(506, 1, 157, 1, 1, 1, 2, 8, 1, 1, NULL, NULL, NULL, 1, 25, 2),
(507, 1, 158, 1, 1, 1, 1, 8, 1, 1, NULL, NULL, NULL, 1, 24, 1),
(508, 1, 158, 1, 1, 1, 1, 8, 1, 1, NULL, NULL, NULL, 1, 24, 2),
(509, 1, 158, 1, 1, 1, 2, 8, 1, 1, NULL, NULL, NULL, 1, 25, 1),
(510, 1, 158, 1, 1, 1, 2, 8, 1, 1, NULL, NULL, NULL, 1, 25, 2),
(511, 1, 159, 1, 1, 1, 1, 8, 1, 1, NULL, NULL, NULL, 1, 24, 1),
(512, 1, 159, 1, 1, 1, 1, 8, 1, 1, NULL, NULL, NULL, 1, 24, 2),
(513, 1, 159, 1, 1, 1, 2, 8, 1, 1, NULL, NULL, NULL, 1, 25, 1),
(514, 1, 159, 1, 1, 1, 2, 8, 1, 1, NULL, NULL, NULL, 1, 25, 2),
(515, 1, 160, 1, 1, 1, 1, 8, 1, 1, NULL, NULL, NULL, 1, 24, 1),
(516, 1, 160, 1, 1, 1, 1, 8, 1, 1, NULL, NULL, NULL, 1, 24, 2),
(517, 1, 160, 1, 1, 1, 2, 8, 1, 1, NULL, NULL, NULL, 1, 25, 1),
(518, 1, 160, 1, 1, 1, 2, 8, 1, 1, NULL, NULL, NULL, 1, 25, 2),
(519, 1, 161, 1, 1, 1, 1, 8, 1, 1, NULL, NULL, NULL, 1, 24, 1),
(520, 1, 161, 1, 1, 1, 1, 8, 1, 1, NULL, NULL, NULL, 1, 24, 2),
(521, 1, 161, 1, 1, 1, 2, 8, 1, 1, NULL, NULL, NULL, 1, 25, 1),
(522, 1, 161, 1, 1, 1, 2, 8, 1, 1, NULL, NULL, NULL, 1, 25, 2),
(523, 1, 162, 1, 1, 1, 1, 8, 1, 1, NULL, NULL, NULL, 1, 24, 1),
(524, 1, 162, 1, 1, 1, 1, 8, 1, 1, NULL, NULL, NULL, 1, 24, 2),
(525, 1, 162, 1, 1, 1, 2, 8, 1, 1, NULL, NULL, NULL, 1, 25, 1),
(526, 1, 162, 1, 1, 1, 2, 8, 1, 1, NULL, NULL, NULL, 1, 25, 2),
(527, 1, 163, 1, 1, 1, 1, 8, 1, 1, NULL, NULL, NULL, 1, 24, 1),
(528, 1, 163, 1, 1, 1, 1, 8, 1, 1, NULL, NULL, NULL, 1, 24, 2),
(529, 1, 163, 1, 1, 1, 2, 8, 1, 1, NULL, NULL, NULL, 1, 25, 1),
(530, 1, 163, 1, 1, 1, 2, 8, 1, 1, NULL, NULL, NULL, 1, 25, 2),
(531, 1, 164, 1, 1, 1, 1, 8, 1, 1, NULL, NULL, NULL, 1, 24, 1),
(532, 1, 164, 1, 1, 1, 1, 8, 1, 1, NULL, NULL, NULL, 1, 24, 2),
(533, 1, 164, 1, 1, 1, 2, 8, 1, 1, NULL, NULL, NULL, 1, 25, 1),
(534, 1, 164, 1, 1, 1, 2, 8, 1, 1, NULL, NULL, NULL, 1, 25, 2),
(535, 1, 165, 1, 1, 1, 1, 8, 3, 1, NULL, NULL, NULL, 1, 24, 1),
(536, 1, 165, 1, 1, 1, 1, 8, 3, 1, NULL, NULL, NULL, 1, 24, 2),
(537, 1, 165, 1, 1, 1, 2, 8, 3, 1, NULL, NULL, NULL, 1, 25, 1),
(538, 1, 165, 1, 1, 1, 2, 8, 3, 1, NULL, NULL, NULL, 1, 25, 2),
(539, 1, 166, 1, 1, 1, 1, 8, 3, 2, NULL, NULL, NULL, 1, 24, 1),
(540, 1, 166, 1, 1, 1, 1, 8, 3, 2, NULL, NULL, NULL, 1, 24, 2),
(541, 1, 166, 1, 1, 1, 2, 8, 3, 2, NULL, NULL, NULL, 1, 25, 1),
(542, 1, 166, 1, 1, 1, 2, 8, 3, 2, NULL, NULL, NULL, 1, 25, 2),
(543, 1, 167, 1, 1, 1, 1, 8, 3, 1, NULL, NULL, NULL, 1, 24, 1),
(544, 1, 167, 1, 1, 1, 1, 8, 3, 1, NULL, NULL, NULL, 1, 24, 2),
(545, 1, 167, 1, 1, 1, 2, 8, 3, 1, NULL, NULL, NULL, 1, 25, 1),
(546, 1, 167, 1, 1, 1, 2, 8, 3, 1, NULL, NULL, NULL, 1, 25, 2),
(547, 1, 168, 1, 1, 1, 1, 8, 3, 1, NULL, NULL, NULL, 1, 24, 1),
(548, 1, 168, 1, 1, 1, 1, 8, 3, 1, NULL, NULL, NULL, 1, 24, 2),
(549, 1, 168, 1, 1, 1, 2, 8, 3, 1, NULL, NULL, NULL, 1, 25, 1),
(550, 1, 168, 1, 1, 1, 2, 8, 3, 1, NULL, NULL, NULL, 1, 25, 2),
(551, 1, 169, 1, 1, 1, 1, 8, 3, 1, NULL, NULL, NULL, 1, 24, 1),
(552, 1, 169, 1, 1, 1, 1, 8, 3, 1, NULL, NULL, NULL, 1, 24, 2),
(553, 1, 169, 1, 1, 1, 2, 8, 3, 1, NULL, NULL, NULL, 1, 25, 1),
(554, 1, 169, 1, 1, 1, 2, 8, 3, 1, NULL, NULL, NULL, 1, 25, 2),
(555, 1, 170, 1, 1, 1, 1, 8, 3, 1, NULL, NULL, NULL, 1, 24, 1),
(556, 1, 170, 1, 1, 1, 1, 8, 3, 1, NULL, NULL, NULL, 1, 24, 2),
(557, 1, 170, 1, 1, 1, 2, 8, 3, 1, NULL, NULL, NULL, 1, 25, 1),
(558, 1, 170, 1, 1, 1, 2, 8, 3, 1, NULL, NULL, NULL, 1, 25, 2),
(559, 1, 171, 1, 1, 1, 1, 8, 3, 1, NULL, NULL, NULL, 1, 24, 1),
(560, 1, 171, 1, 1, 1, 1, 8, 3, 1, NULL, NULL, NULL, 1, 24, 2),
(561, 1, 171, 1, 1, 1, 2, 8, 3, 1, NULL, NULL, NULL, 1, 25, 1),
(562, 1, 171, 1, 1, 1, 2, 8, 3, 1, NULL, NULL, NULL, 1, 25, 2),
(563, 1, 172, 1, 1, 1, 1, 8, 3, 1, NULL, NULL, NULL, 1, 24, 1),
(564, 1, 172, 1, 1, 1, 1, 8, 3, 1, NULL, NULL, NULL, 1, 24, 2),
(565, 1, 172, 1, 1, 1, 2, 8, 3, 1, NULL, NULL, NULL, 1, 25, 1),
(566, 1, 172, 1, 1, 1, 2, 8, 3, 1, NULL, NULL, NULL, 1, 25, 2),
(567, 1, 173, 1, 1, 1, 1, 8, 3, 1, NULL, NULL, NULL, 1, 24, 1),
(568, 1, 173, 1, 1, 1, 1, 8, 3, 1, NULL, NULL, NULL, 1, 24, 2),
(569, 1, 173, 1, 1, 1, 2, 8, 3, 1, NULL, NULL, NULL, 1, 25, 1),
(570, 1, 173, 1, 1, 1, 2, 8, 3, 2, NULL, NULL, NULL, 1, 25, 2),
(571, 1, 174, 1, 1, 1, 1, 8, 3, 1, NULL, NULL, NULL, 1, 24, 1),
(572, 1, 174, 1, 1, 1, 1, 8, 3, 1, NULL, NULL, NULL, 1, 24, 2),
(573, 1, 174, 1, 1, 1, 2, 8, 3, 1, NULL, NULL, NULL, 1, 25, 1),
(574, 1, 174, 1, 1, 1, 2, 8, 3, 1, NULL, NULL, NULL, 1, 25, 2),
(575, 1, 175, 1, 1, 1, 1, 8, 3, 1, NULL, NULL, NULL, 1, 24, 1),
(576, 1, 175, 1, 1, 1, 1, 8, 3, 1, NULL, NULL, NULL, 1, 24, 2),
(577, 1, 175, 1, 1, 1, 2, 8, 3, 1, NULL, NULL, NULL, 1, 25, 1),
(578, 1, 175, 1, 1, 1, 2, 8, 3, 1, NULL, NULL, NULL, 1, 25, 2),
(579, 1, 176, 1, 1, 1, 1, 8, 3, 2, NULL, NULL, NULL, 1, 24, 1),
(580, 1, 176, 1, 1, 1, 1, 8, 3, 2, NULL, NULL, NULL, 1, 24, 2),
(581, 1, 176, 1, 1, 1, 2, 8, 3, 2, NULL, NULL, NULL, 1, 25, 1),
(582, 1, 176, 1, 1, 1, 2, 8, 3, 2, NULL, NULL, NULL, 1, 25, 2),
(583, 1, 177, 1, 1, 1, 1, 8, 3, 1, NULL, NULL, NULL, 1, 24, 1),
(584, 1, 177, 1, 1, 1, 1, 8, 3, 1, NULL, NULL, NULL, 1, 24, 2),
(585, 1, 177, 1, 1, 1, 2, 8, 3, 1, NULL, NULL, NULL, 1, 25, 1),
(586, 1, 177, 1, 1, 1, 2, 8, 3, 1, NULL, NULL, NULL, 1, 25, 2),
(587, 1, 178, 1, 1, 1, 1, 8, 3, 1, NULL, NULL, NULL, 1, 24, 1),
(588, 1, 178, 1, 1, 1, 1, 8, 3, 1, NULL, NULL, NULL, 1, 24, 2),
(589, 1, 178, 1, 1, 1, 2, 8, 3, 1, NULL, NULL, NULL, 1, 25, 1),
(590, 1, 178, 1, 1, 1, 2, 8, 3, 1, NULL, NULL, NULL, 1, 25, 2),
(591, 1, 179, 1, 1, 1, 1, 8, 3, 1, NULL, NULL, NULL, 1, 24, 1),
(592, 1, 179, 1, 1, 1, 1, 8, 3, 1, NULL, NULL, NULL, 1, 24, 2),
(593, 1, 179, 1, 1, 1, 2, 8, 3, 1, NULL, NULL, NULL, 1, 25, 1),
(594, 1, 179, 1, 1, 1, 2, 8, 3, 1, NULL, NULL, NULL, 1, 25, 2),
(595, 1, 180, 1, 1, 1, 1, 8, 3, 1, NULL, NULL, NULL, 1, 24, 1),
(596, 1, 180, 1, 1, 1, 1, 8, 3, 1, NULL, NULL, NULL, 1, 24, 2),
(597, 1, 180, 1, 1, 1, 2, 8, 3, 1, NULL, NULL, NULL, 1, 25, 1),
(598, 1, 180, 1, 1, 1, 2, 8, 3, 1, NULL, NULL, NULL, 1, 25, 2),
(599, 1, 181, 1, 1, 1, 1, 8, 3, 1, NULL, NULL, NULL, 1, 24, 1),
(600, 1, 181, 1, 1, 1, 1, 8, 3, 1, NULL, NULL, NULL, 1, 24, 2),
(601, 1, 181, 1, 1, 1, 2, 8, 3, 1, NULL, NULL, NULL, 1, 25, 1),
(602, 1, 181, 1, 1, 1, 2, 8, 3, 1, NULL, NULL, NULL, 1, 25, 2),
(603, 1, 182, 1, 1, 1, 1, 8, 3, 1, NULL, NULL, NULL, 1, 24, 1),
(604, 1, 182, 1, 1, 1, 1, 8, 3, 1, NULL, NULL, NULL, 1, 24, 2),
(605, 1, 182, 1, 1, 1, 2, 8, 3, 1, NULL, NULL, NULL, 1, 25, 1),
(606, 1, 182, 1, 1, 1, 2, 8, 3, 1, NULL, NULL, NULL, 1, 25, 2),
(607, 1, 183, 1, 1, 1, 1, 8, 3, 1, NULL, NULL, NULL, 1, 24, 1),
(608, 1, 183, 1, 1, 1, 1, 8, 3, 1, NULL, NULL, NULL, 1, 24, 2),
(609, 1, 183, 1, 1, 1, 2, 8, 3, 1, NULL, NULL, NULL, 1, 25, 1),
(610, 1, 183, 1, 1, 1, 2, 8, 3, 1, NULL, NULL, NULL, 1, 25, 2),
(611, 1, 184, 1, 1, 1, 1, 8, 3, 1, NULL, NULL, NULL, 1, 24, 1),
(612, 1, 184, 1, 1, 1, 1, 8, 3, 1, NULL, NULL, NULL, 1, 24, 2),
(613, 1, 184, 1, 1, 1, 2, 8, 3, 1, NULL, NULL, NULL, 1, 25, 1),
(614, 1, 184, 1, 1, 1, 2, 8, 3, 1, NULL, NULL, NULL, 1, 25, 2),
(615, 1, 185, 1, 1, 1, 1, 7, 1, 1, NULL, NULL, NULL, 1, 24, 1),
(616, 1, 185, 1, 1, 1, 1, 7, 1, 1, NULL, NULL, NULL, 1, 24, 2),
(617, 1, 185, 1, 1, 1, 2, 7, 1, 1, NULL, NULL, NULL, 1, 25, 1),
(618, 1, 185, 1, 1, 1, 2, 7, 1, 1, NULL, NULL, NULL, 1, 25, 2),
(619, 1, 186, 1, 1, 1, 1, 7, 1, 2, NULL, NULL, NULL, 1, 24, 1),
(620, 1, 186, 1, 1, 1, 1, 7, 1, 2, NULL, NULL, NULL, 1, 24, 2),
(621, 1, 186, 1, 1, 1, 2, 7, 1, 2, NULL, NULL, NULL, 1, 25, 1),
(622, 1, 186, 1, 1, 1, 2, 7, 1, 2, NULL, NULL, NULL, 1, 25, 2),
(623, 1, 187, 1, 1, 1, 1, 7, 1, 1, NULL, NULL, NULL, 1, 24, 1),
(624, 1, 187, 1, 1, 1, 1, 7, 1, 1, NULL, NULL, NULL, 1, 24, 2),
(625, 1, 187, 1, 1, 1, 2, 7, 1, 1, NULL, NULL, NULL, 1, 25, 1),
(626, 1, 187, 1, 1, 1, 2, 7, 1, 1, NULL, NULL, NULL, 1, 25, 2),
(627, 1, 188, 1, 1, 1, 1, 7, 1, 1, NULL, NULL, NULL, 1, 24, 1),
(628, 1, 188, 1, 1, 1, 1, 7, 1, 1, NULL, NULL, NULL, 1, 24, 2),
(629, 1, 188, 1, 1, 1, 2, 7, 1, 1, NULL, NULL, NULL, 1, 25, 1),
(630, 1, 188, 1, 1, 1, 2, 7, 1, 1, NULL, NULL, NULL, 1, 25, 2),
(631, 1, 189, 1, 1, 1, 1, 7, 1, 1, NULL, NULL, NULL, 1, 24, 1),
(632, 1, 189, 1, 1, 1, 1, 7, 1, 1, NULL, NULL, NULL, 1, 24, 2),
(633, 1, 189, 1, 1, 1, 2, 7, 1, 1, NULL, NULL, NULL, 1, 25, 1),
(634, 1, 189, 1, 1, 1, 2, 7, 1, 1, NULL, NULL, NULL, 1, 25, 2),
(635, 1, 190, 1, 1, 1, 1, 8, 1, 1, NULL, NULL, NULL, 1, 24, 1),
(636, 1, 190, 1, 1, 1, 1, 8, 1, 1, NULL, NULL, NULL, 1, 24, 2),
(637, 1, 190, 1, 1, 1, 2, 8, 1, 1, NULL, NULL, NULL, 1, 25, 1),
(638, 1, 190, 1, 1, 1, 2, 7, 1, 1, NULL, NULL, NULL, 1, 25, 2),
(639, 1, 191, 1, 1, 1, 1, 7, 1, 1, NULL, NULL, NULL, 1, 24, 1),
(640, 1, 191, 1, 1, 1, 1, 7, 1, 1, NULL, NULL, NULL, 1, 24, 2),
(641, 1, 191, 1, 1, 1, 2, 7, 1, 1, NULL, NULL, NULL, 1, 25, 1),
(642, 1, 191, 1, 1, 1, 2, 7, 1, 1, NULL, NULL, NULL, 1, 25, 2),
(643, 1, 192, 1, 1, 1, 1, 7, 1, 1, NULL, NULL, NULL, 1, 24, 1),
(644, 1, 192, 1, 1, 1, 1, 7, 1, 1, NULL, NULL, NULL, 1, 24, 2),
(645, 1, 192, 1, 1, 1, 2, 7, 1, 1, NULL, NULL, NULL, 1, 25, 1),
(646, 1, 192, 1, 1, 1, 2, 7, 1, 1, NULL, NULL, NULL, 1, 25, 2),
(647, 1, 193, 1, 1, 1, 1, 7, 1, 1, NULL, NULL, NULL, 1, 24, 1),
(648, 1, 193, 1, 1, 1, 1, 7, 1, 1, NULL, NULL, NULL, 1, 24, 2),
(649, 1, 193, 1, 1, 1, 2, 7, 1, 1, NULL, NULL, NULL, 1, 25, 1),
(650, 1, 193, 1, 1, 1, 2, 7, 1, 1, NULL, NULL, NULL, 1, 25, 2),
(651, 1, 194, 1, 1, 1, 1, 7, 1, 1, NULL, NULL, NULL, 1, 24, 1),
(652, 1, 194, 1, 1, 1, 1, 7, 1, 1, NULL, NULL, NULL, 1, 24, 2),
(653, 1, 194, 1, 1, 1, 2, 7, 1, 1, NULL, NULL, NULL, 1, 25, 1),
(654, 1, 194, 1, 1, 1, 2, 7, 1, 1, NULL, NULL, NULL, 1, 25, 2),
(655, 1, 195, 1, 1, 1, 1, 7, 1, 2, NULL, NULL, NULL, 1, 24, 1),
(656, 1, 195, 1, 1, 1, 1, 7, 1, 2, NULL, NULL, NULL, 1, 24, 2),
(657, 1, 195, 1, 1, 1, 2, 7, 1, 2, NULL, NULL, NULL, 1, 25, 1),
(658, 1, 195, 1, 1, 1, 2, 7, 1, 2, NULL, NULL, NULL, 1, 25, 2),
(659, 1, 196, 1, 1, 1, 1, 7, 1, 2, NULL, NULL, NULL, 1, 24, 1),
(660, 1, 196, 1, 1, 1, 1, 7, 1, 2, NULL, NULL, NULL, 1, 24, 2),
(661, 1, 196, 1, 1, 1, 2, 7, 1, 2, NULL, NULL, NULL, 1, 25, 1),
(662, 1, 196, 1, 1, 1, 2, 7, 1, 2, NULL, NULL, NULL, 1, 25, 2),
(663, 1, 197, 1, 1, 1, 1, 7, 1, 1, NULL, NULL, NULL, 1, 24, 1),
(664, 1, 197, 1, 1, 1, 1, 7, 1, 1, NULL, NULL, NULL, 1, 24, 2),
(665, 1, 197, 1, 1, 1, 2, 7, 1, 1, NULL, NULL, NULL, 1, 25, 1),
(666, 1, 197, 1, 1, 1, 2, 7, 1, 1, NULL, NULL, NULL, 1, 25, 2),
(667, 1, 198, 1, 1, 1, 1, 7, 1, 1, NULL, NULL, NULL, 1, 24, 1),
(668, 1, 198, 1, 1, 1, 1, 7, 1, 1, NULL, NULL, NULL, 1, 24, 2),
(669, 1, 198, 1, 1, 1, 2, 7, 1, 1, NULL, NULL, NULL, 1, 25, 1),
(670, 1, 198, 1, 1, 1, 2, 7, 1, 1, NULL, NULL, NULL, 1, 25, 2),
(671, 1, 199, 1, 1, 1, 1, 14, 1, 1, NULL, NULL, NULL, 1, 25, 1),
(672, 1, 199, 1, 1, 1, 1, 14, 1, 1, NULL, NULL, NULL, 1, 25, 2),
(673, 1, 200, 1, 1, 1, 1, 14, 1, 1, NULL, NULL, NULL, 1, 25, 1),
(674, 1, 200, 1, 1, 1, 1, 14, 1, 1, NULL, NULL, NULL, 1, 25, 2),
(675, 1, 201, 1, 1, 1, 1, 12, 1, 1, NULL, NULL, NULL, 1, 25, 1),
(676, 1, 201, 1, 1, 1, 1, 14, 1, 1, NULL, NULL, NULL, 1, 25, 2),
(677, 1, 202, 1, 1, 1, 1, 14, 1, 2, NULL, NULL, NULL, 1, 25, 1),
(678, 1, 202, 1, 1, 1, 1, 14, 1, 2, NULL, NULL, NULL, 1, 25, 2),
(679, 1, 203, 1, 1, 1, 1, 14, 1, 1, NULL, NULL, NULL, 1, 25, 1),
(680, 1, 203, 1, 1, 1, 1, 14, 1, 1, NULL, NULL, NULL, 1, 25, 2),
(681, 1, 204, 1, 1, 1, 1, 14, 1, 1, NULL, NULL, NULL, 1, 25, 1),
(682, 1, 204, 1, 1, 1, 1, 14, 1, 1, NULL, NULL, NULL, 1, 25, 2),
(683, 1, 205, 1, 1, 1, 1, 14, 1, 1, NULL, NULL, NULL, 1, 25, 1),
(684, 1, 205, 1, 1, 1, 1, 14, 1, 1, NULL, NULL, NULL, 1, 25, 2),
(685, 1, 206, 1, 1, 1, 1, 14, 1, 1, NULL, NULL, NULL, 1, 25, 1),
(686, 1, 206, 1, 1, 1, 1, 14, 1, 1, NULL, NULL, NULL, 1, 25, 2),
(687, 1, 207, 1, 1, 1, 1, 14, 1, 1, NULL, NULL, NULL, 1, 25, 1),
(688, 1, 207, 1, 1, 1, 1, 14, 1, 1, NULL, NULL, NULL, 1, 25, 2),
(689, 1, 208, 1, 1, 1, 1, 14, 1, 1, NULL, NULL, NULL, 1, 25, 1),
(690, 1, 208, 1, 1, 1, 1, 14, 1, 1, NULL, NULL, NULL, 1, 25, 2),
(691, 1, 209, 1, 1, 1, 1, 11, 1, 2, NULL, NULL, NULL, 1, 24, 1),
(692, 1, 209, 1, 1, 1, 1, 11, 1, 2, NULL, NULL, NULL, 1, 24, 2),
(693, 1, 209, 1, 1, 1, 2, 11, 1, 2, NULL, NULL, NULL, 1, 25, 1),
(694, 1, 209, 1, 1, 1, 2, 11, 1, 2, NULL, NULL, NULL, 1, 25, 2),
(695, 1, 210, 1, 1, 1, 1, 11, 1, 1, NULL, NULL, NULL, 1, 24, 1),
(696, 1, 210, 1, 1, 1, 1, 11, 1, 1, NULL, NULL, NULL, 1, 24, 2),
(697, 1, 210, 1, 1, 1, 2, 11, 1, 1, NULL, NULL, NULL, 1, 25, 1),
(698, 1, 210, 1, 1, 1, 2, 11, 1, 1, NULL, NULL, NULL, 1, 25, 2),
(699, 1, 211, 1, 1, 1, 1, 11, 1, 1, NULL, NULL, NULL, 1, 24, 1),
(700, 1, 211, 1, 1, 1, 1, 11, 1, 1, NULL, NULL, NULL, 1, 24, 2),
(701, 1, 211, 1, 1, 1, 2, 11, 1, 1, NULL, NULL, NULL, 1, 25, 1),
(702, 1, 211, 1, 1, 1, 2, 11, 1, 1, NULL, NULL, NULL, 1, 25, 2),
(703, 1, 212, 1, 1, 1, 1, 11, 1, 2, NULL, NULL, NULL, 1, 24, 1),
(704, 1, 212, 1, 1, 1, 1, 11, 1, 2, NULL, NULL, NULL, 1, 24, 2),
(705, 1, 212, 1, 1, 1, 2, 11, 1, 2, NULL, NULL, NULL, 1, 25, 1),
(706, 1, 212, 1, 1, 1, 2, 11, 1, 2, NULL, NULL, NULL, 1, 25, 2),
(707, 1, 213, 1, 1, 1, 1, 11, 1, 2, NULL, NULL, NULL, 1, 24, 1),
(708, 1, 213, 1, 1, 1, 1, 11, 1, 2, NULL, NULL, NULL, 1, 24, 2),
(709, 1, 213, 1, 1, 1, 2, 11, 1, 2, NULL, NULL, NULL, 1, 25, 1),
(710, 1, 213, 1, 1, 1, 2, 11, 1, 2, NULL, NULL, NULL, 1, 25, 2),
(711, 1, 214, 1, 1, 1, 1, 11, 1, 1, NULL, NULL, NULL, 1, 24, 1),
(712, 1, 214, 1, 1, 1, 1, 11, 1, 1, NULL, NULL, NULL, 1, 24, 2),
(713, 1, 214, 1, 1, 1, 2, 11, 1, 1, NULL, NULL, NULL, 1, 25, 1),
(714, 1, 214, 1, 1, 1, 2, 11, 1, 1, NULL, NULL, NULL, 1, 25, 2),
(715, 1, 215, 1, 1, 1, 1, 11, 1, 1, NULL, NULL, NULL, 1, 24, 1),
(716, 1, 215, 1, 1, 1, 1, 11, 1, 1, NULL, NULL, NULL, 1, 24, 2),
(717, 1, 215, 1, 1, 1, 2, 11, 1, 1, NULL, NULL, NULL, 1, 25, 1),
(718, 1, 215, 1, 1, 1, 2, 11, 1, 1, NULL, NULL, NULL, 1, 25, 2),
(719, 1, 216, 1, 1, 1, 1, 11, 1, 1, NULL, NULL, NULL, 1, 24, 1),
(720, 1, 216, 1, 1, 1, 1, 11, 1, 1, NULL, NULL, NULL, 1, 24, 2),
(721, 1, 216, 1, 1, 1, 2, 11, 1, 1, NULL, NULL, NULL, 1, 25, 1),
(722, 1, 216, 1, 1, 1, 2, 11, 1, 1, NULL, NULL, NULL, 1, 25, 2),
(723, 1, 217, 1, 1, 1, 1, 11, 1, 2, NULL, NULL, NULL, 1, 24, 1),
(724, 1, 217, 1, 1, 1, 1, 11, 1, 2, NULL, NULL, NULL, 1, 24, 2),
(725, 1, 217, 1, 1, 1, 2, 11, 1, 2, NULL, NULL, NULL, 1, 25, 1),
(726, 1, 217, 1, 1, 1, 2, 11, 1, 2, NULL, NULL, NULL, 1, 25, 2),
(727, 1, 218, 1, 1, 1, 1, 11, 1, 2, NULL, NULL, NULL, 1, 24, 1),
(728, 1, 218, 1, 1, 1, 1, 11, 1, 2, NULL, NULL, NULL, 1, 24, 2),
(729, 1, 218, 1, 1, 1, 2, 11, 1, 2, NULL, NULL, NULL, 1, 25, 1),
(730, 1, 218, 1, 1, 1, 2, 11, 1, 2, NULL, NULL, NULL, 1, 25, 2),
(731, 1, 219, 1, 1, 1, 1, 14, 1, 1, NULL, NULL, NULL, 1, 25, 1),
(732, 1, 219, 1, 1, 1, 1, 14, 1, 1, NULL, NULL, NULL, 1, 25, 2),
(733, 1, 220, 1, 1, 1, 1, 11, 1, 1, NULL, NULL, NULL, 1, 24, 1),
(734, 1, 220, 1, 1, 1, 1, 11, 1, 1, NULL, NULL, NULL, 1, 24, 2),
(735, 1, 220, 1, 1, 1, 2, 11, 1, 1, NULL, NULL, NULL, 1, 25, 1),
(736, 1, 220, 1, 1, 1, 2, 11, 1, 1, NULL, NULL, NULL, 1, 25, 2),
(737, 1, 221, 1, 1, 1, 1, 14, 1, 1, NULL, NULL, NULL, 1, 25, 1),
(738, 1, 221, 1, 1, 1, 1, 14, 1, 1, NULL, NULL, NULL, 1, 25, 2),
(739, 1, 222, 1, 1, 1, 1, 11, 1, 2, NULL, NULL, NULL, 1, 24, 1),
(740, 1, 222, 1, 1, 1, 1, 11, 1, 2, NULL, NULL, NULL, 1, 24, 2),
(741, 1, 222, 1, 1, 1, 2, 11, 1, 2, NULL, NULL, NULL, 1, 25, 1),
(742, 1, 222, 1, 1, 1, 2, 11, 1, 2, NULL, NULL, NULL, 1, 25, 2),
(743, 1, 223, 1, 1, 1, 1, 14, 1, 2, NULL, NULL, NULL, 1, 25, 1),
(744, 1, 223, 1, 1, 1, 1, 14, 1, 2, NULL, NULL, NULL, 1, 25, 2),
(745, 1, 224, 1, 1, 1, 1, 14, 1, 1, NULL, NULL, NULL, 1, 25, 1),
(746, 1, 224, 1, 1, 1, 1, 14, 1, 1, NULL, NULL, NULL, 1, 25, 2),
(747, 1, 225, 1, 1, 1, 1, 14, 1, 2, NULL, NULL, NULL, 1, 25, 1),
(748, 1, 225, 1, 1, 1, 1, 14, 1, 2, NULL, NULL, NULL, 1, 25, 2),
(749, 1, 226, 1, 1, 1, 1, 11, 1, 1, NULL, NULL, NULL, 1, 24, 1),
(750, 1, 226, 1, 1, 1, 1, 11, 1, 1, NULL, NULL, NULL, 1, 24, 2),
(751, 1, 226, 1, 1, 1, 2, 11, 1, 1, NULL, NULL, NULL, 1, 25, 1),
(752, 1, 226, 1, 1, 1, 2, 11, 1, 1, NULL, NULL, NULL, 1, 25, 2),
(753, 1, 227, 1, 1, 1, 1, 14, 1, 1, NULL, NULL, NULL, 1, 25, 1),
(754, 1, 227, 1, 1, 1, 1, 14, 1, 1, NULL, NULL, NULL, 1, 25, 2),
(755, 1, 228, 1, 1, 1, 1, 11, 1, 1, NULL, NULL, NULL, 1, 24, 1),
(756, 1, 228, 1, 1, 1, 1, 11, 1, 1, NULL, NULL, NULL, 1, 24, 2),
(757, 1, 228, 1, 1, 1, 2, 11, 1, 1, NULL, NULL, NULL, 1, 25, 1),
(758, 1, 228, 1, 1, 1, 2, 11, 1, 1, NULL, NULL, NULL, 1, 25, 2),
(759, 1, 229, 1, 1, 1, 1, 11, 1, 1, NULL, NULL, NULL, 1, 24, 1),
(760, 1, 229, 1, 1, 1, 1, 11, 1, 1, NULL, NULL, NULL, 1, 24, 2),
(761, 1, 229, 1, 1, 1, 2, 11, 1, 1, NULL, NULL, NULL, 1, 25, 1),
(762, 1, 229, 1, 1, 1, 2, 11, 1, 1, NULL, NULL, NULL, 1, 25, 2),
(763, 1, 230, 1, 1, 1, 1, 11, 1, 1, NULL, NULL, NULL, 1, 24, 1),
(764, 1, 230, 1, 1, 1, 1, 11, 1, 1, NULL, NULL, NULL, 1, 24, 2),
(765, 1, 230, 1, 1, 1, 2, 11, 1, 1, NULL, NULL, NULL, 1, 25, 1),
(766, 1, 230, 1, 1, 1, 2, 11, 1, 1, NULL, NULL, NULL, 1, 25, 2),
(767, 1, 231, 1, 1, 1, 1, 11, 1, 2, NULL, NULL, NULL, 1, 24, 1),
(768, 1, 231, 1, 1, 1, 1, 11, 1, 2, NULL, NULL, NULL, 1, 24, 2),
(769, 1, 231, 1, 1, 1, 2, 11, 1, 2, NULL, NULL, NULL, 1, 25, 1),
(770, 1, 231, 1, 1, 1, 2, 11, 1, 2, NULL, NULL, NULL, 1, 25, 2),
(771, 1, 232, 1, 1, 1, 1, 5, 1, 2, NULL, NULL, NULL, 1, 24, 1),
(772, 1, 232, 1, 1, 1, 1, 5, 1, 2, NULL, NULL, NULL, 1, 24, 2),
(773, 1, 232, 1, 1, 1, 2, 5, 1, 2, NULL, NULL, NULL, 1, 25, 1),
(774, 1, 232, 1, 1, 1, 2, 5, 1, 2, NULL, NULL, NULL, 1, 25, 2),
(775, 1, 233, 1, 1, 1, 1, 5, 1, 2, NULL, NULL, NULL, 1, 24, 1),
(776, 1, 233, 1, 1, 1, 1, 5, 1, 2, NULL, NULL, NULL, 1, 24, 2),
(777, 1, 233, 1, 1, 1, 2, 5, 1, 2, NULL, NULL, NULL, 1, 25, 1),
(778, 1, 233, 1, 1, 1, 2, 5, 1, 2, NULL, NULL, NULL, 1, 25, 2),
(779, 1, 234, 1, 1, 1, 1, 5, 1, 2, NULL, NULL, NULL, 1, 24, 1),
(780, 1, 234, 1, 1, 1, 1, 5, 1, 2, NULL, NULL, NULL, 1, 24, 2),
(781, 1, 234, 1, 1, 1, 2, 5, 1, 2, NULL, NULL, NULL, 1, 25, 1),
(782, 1, 234, 1, 1, 1, 2, 5, 1, 2, NULL, NULL, NULL, 1, 25, 2),
(783, 1, 235, 1, 1, 1, 1, 5, 1, 2, NULL, NULL, NULL, 1, 24, 1),
(784, 1, 235, 1, 1, 1, 1, 5, 1, 2, NULL, NULL, NULL, 1, 24, 2),
(785, 1, 235, 1, 1, 1, 2, 5, 1, 2, NULL, NULL, NULL, 1, 25, 1),
(786, 1, 235, 1, 1, 1, 2, 5, 1, 2, NULL, NULL, NULL, 1, 25, 2),
(787, 1, 236, 1, 1, 1, 1, 5, 1, 2, NULL, NULL, NULL, 1, 24, 1),
(788, 1, 236, 1, 1, 1, 1, 5, 1, 2, NULL, NULL, NULL, 1, 24, 2),
(789, 1, 236, 1, 1, 1, 2, 5, 1, 2, NULL, NULL, NULL, 1, 25, 1),
(790, 1, 236, 1, 1, 1, 2, 5, 1, 2, NULL, NULL, NULL, 1, 25, 2),
(791, 1, 237, 1, 1, 1, 1, 5, 1, 2, NULL, NULL, NULL, 1, 24, 1),
(792, 1, 237, 1, 1, 1, 1, 5, 1, 2, NULL, NULL, NULL, 1, 24, 2),
(793, 1, 237, 1, 1, 1, 2, 5, 1, 2, NULL, NULL, NULL, 1, 25, 1),
(794, 1, 237, 1, 1, 1, 2, 5, 1, 2, NULL, NULL, NULL, 1, 25, 2),
(795, 1, 238, 1, 1, 1, 1, 5, 1, 1, NULL, NULL, NULL, 1, 24, 1),
(796, 1, 238, 1, 1, 1, 1, 5, 1, 1, NULL, NULL, NULL, 1, 24, 2),
(797, 1, 238, 1, 1, 1, 2, 5, 1, 1, NULL, NULL, NULL, 1, 25, 1),
(798, 1, 238, 1, 1, 1, 2, 5, 1, 1, NULL, NULL, NULL, 1, 25, 2),
(799, 1, 239, 1, 1, 1, 1, 5, 1, 2, NULL, NULL, NULL, 1, 24, 1),
(800, 1, 239, 1, 1, 1, 1, 5, 1, 2, NULL, NULL, NULL, 1, 24, 2),
(801, 1, 239, 1, 1, 1, 2, 5, 1, 2, NULL, NULL, NULL, 1, 25, 1),
(802, 1, 239, 1, 1, 1, 2, 5, 1, 2, NULL, NULL, NULL, 1, 25, 2),
(803, 1, 240, 1, 1, 1, 1, 5, 1, 2, NULL, NULL, NULL, 1, 24, 1);
INSERT INTO `students` (`id`, `status`, `id_student`, `id_faculty`, `id_s_l`, `id_s_v`, `id_course`, `id_spec`, `id_group`, `id_s_t`, `balance`, `sh_persent`, `foreign`, `vazi_oilavi`, `s_y`, `h_y`) VALUES
(804, 1, 240, 1, 1, 1, 1, 5, 1, 2, NULL, NULL, NULL, 1, 24, 2),
(805, 1, 240, 1, 1, 1, 2, 5, 1, 2, NULL, NULL, NULL, 1, 25, 1),
(806, 1, 240, 1, 1, 1, 2, 5, 1, 2, NULL, NULL, NULL, 1, 25, 2),
(807, 1, 241, 1, 1, 1, 1, 5, 1, 2, NULL, NULL, NULL, 1, 24, 1),
(808, 1, 241, 1, 1, 1, 1, 5, 1, 2, NULL, NULL, NULL, 1, 24, 2),
(809, 1, 241, 1, 1, 1, 2, 5, 1, 2, NULL, NULL, NULL, 1, 25, 1),
(810, 1, 241, 1, 1, 1, 2, 5, 1, 2, NULL, NULL, NULL, 1, 25, 2),
(811, 1, 242, 1, 1, 1, 1, 5, 1, 2, NULL, NULL, NULL, 1, 24, 1),
(812, 1, 242, 1, 1, 1, 1, 5, 1, 2, NULL, NULL, NULL, 1, 24, 2),
(813, 1, 242, 1, 1, 1, 2, 5, 1, 2, NULL, NULL, NULL, 1, 25, 1),
(814, 1, 242, 1, 1, 1, 2, 5, 1, 2, NULL, NULL, NULL, 1, 25, 2),
(815, 1, 243, 1, 1, 1, 1, 5, 1, 2, NULL, NULL, NULL, 1, 24, 1),
(816, 1, 243, 1, 1, 1, 1, 5, 1, 2, NULL, NULL, NULL, 1, 24, 2),
(817, 1, 243, 1, 1, 1, 2, 5, 1, 2, NULL, NULL, NULL, 1, 25, 1),
(818, 1, 243, 1, 1, 1, 2, 5, 1, 2, NULL, NULL, NULL, 1, 25, 2),
(819, 1, 244, 1, 1, 1, 1, 5, 1, 2, NULL, NULL, NULL, 1, 24, 1),
(820, 1, 244, 1, 1, 1, 1, 5, 1, 2, NULL, NULL, NULL, 1, 24, 2),
(821, 1, 244, 1, 1, 1, 2, 5, 1, 2, NULL, NULL, NULL, 1, 25, 1),
(822, 1, 244, 1, 1, 1, 2, 5, 1, 2, NULL, NULL, NULL, 1, 25, 2),
(823, 1, 245, 1, 1, 1, 1, 5, 1, 1, NULL, NULL, NULL, 1, 24, 1),
(824, 1, 245, 1, 1, 1, 1, 5, 1, 1, NULL, NULL, NULL, 1, 24, 2),
(825, 1, 245, 1, 1, 1, 2, 5, 1, 1, NULL, NULL, NULL, 1, 25, 1),
(826, 1, 245, 1, 1, 1, 2, 5, 1, 1, NULL, NULL, NULL, 1, 25, 2),
(827, 1, 246, 1, 1, 1, 1, 5, 1, 2, NULL, NULL, NULL, 1, 24, 1),
(828, 1, 246, 1, 1, 1, 1, 5, 1, 2, NULL, NULL, NULL, 1, 24, 2),
(829, 1, 246, 1, 1, 1, 2, 5, 1, 2, NULL, NULL, NULL, 1, 25, 1),
(830, 1, 246, 1, 1, 1, 2, 5, 1, 2, NULL, NULL, NULL, 1, 25, 2),
(831, 1, 247, 1, 1, 1, 1, 5, 1, 1, NULL, NULL, NULL, 1, 24, 1),
(832, 1, 247, 1, 1, 1, 1, 5, 1, 1, NULL, NULL, NULL, 1, 24, 2),
(833, 1, 247, 1, 1, 1, 2, 5, 1, 1, NULL, NULL, NULL, 1, 25, 1),
(834, 1, 247, 1, 1, 1, 2, 5, 1, 1, NULL, NULL, NULL, 1, 25, 2),
(835, 1, 248, 1, 1, 1, 1, 5, 1, 1, NULL, NULL, NULL, 1, 24, 1),
(836, 1, 248, 1, 1, 1, 1, 5, 1, 1, NULL, NULL, NULL, 1, 24, 2),
(837, 1, 248, 1, 1, 1, 2, 5, 1, 1, NULL, NULL, NULL, 1, 25, 1),
(838, 1, 248, 1, 1, 1, 2, 5, 1, 1, NULL, NULL, NULL, 1, 25, 2),
(839, 1, 249, 1, 1, 1, 1, 14, 1, 1, NULL, NULL, NULL, 1, 25, 1),
(840, 1, 249, 1, 1, 1, 1, 14, 1, 1, NULL, NULL, NULL, 1, 25, 2),
(841, 1, 250, 1, 1, 1, 1, 14, 1, 1, NULL, NULL, NULL, 1, 25, 1),
(842, 1, 250, 1, 1, 1, 1, 14, 1, 1, NULL, NULL, NULL, 1, 25, 2),
(843, 1, 251, 1, 1, 1, 1, 14, 1, 1, NULL, NULL, NULL, 1, 25, 1),
(844, 1, 251, 1, 1, 1, 1, 14, 1, 1, NULL, NULL, NULL, 1, 25, 2),
(845, 1, 252, 1, 1, 1, 1, 14, 1, 1, NULL, NULL, NULL, 1, 25, 1),
(846, 1, 252, 1, 1, 1, 1, 14, 1, 1, NULL, NULL, NULL, 1, 25, 2),
(847, 1, 253, 1, 1, 1, 1, 14, 1, 1, NULL, NULL, NULL, 1, 25, 1),
(848, 1, 253, 1, 1, 1, 1, 14, 1, 1, NULL, NULL, NULL, 1, 25, 2),
(849, 1, 254, 1, 1, 1, 1, 14, 1, 1, NULL, NULL, NULL, 1, 25, 2),
(850, 1, 255, 1, 1, 1, 1, 14, 1, 1, NULL, NULL, NULL, 1, 25, 1),
(851, 1, 255, 1, 1, 1, 1, 14, 1, 1, NULL, NULL, NULL, 1, 25, 2),
(852, 1, 256, 1, 1, 1, 1, 1, 1, 1, NULL, NULL, NULL, 1, 25, 1),
(853, 1, 256, 1, 1, 1, 1, 14, 1, 1, NULL, NULL, NULL, 1, 25, 2),
(854, 1, 257, 1, 1, 1, 1, 14, 1, 1, NULL, NULL, NULL, 1, 25, 1),
(855, 1, 257, 1, 1, 1, 1, 14, 1, 1, NULL, NULL, NULL, 1, 25, 2),
(856, 1, 258, 1, 1, 1, 1, 14, 1, 1, NULL, NULL, NULL, 1, 25, 1),
(857, 1, 258, 1, 1, 1, 1, 14, 1, 1, NULL, NULL, NULL, 1, 25, 2),
(858, 1, 260, 1, 1, 1, 1, 12, 1, 2, NULL, NULL, NULL, 1, 23, 1),
(859, 1, 260, 1, 1, 1, 1, 12, 1, 2, NULL, NULL, NULL, 1, 23, 2),
(860, 1, 260, 1, 1, 1, 2, 12, 1, 2, NULL, NULL, NULL, 1, 24, 1),
(861, 1, 260, 1, 1, 1, 2, 12, 1, 2, NULL, NULL, NULL, 1, 24, 2),
(862, 1, 260, 1, 1, 1, 3, 12, 1, 2, NULL, NULL, NULL, 1, 25, 1),
(863, 1, 260, 1, 1, 1, 3, 12, 1, 2, NULL, NULL, NULL, 1, 25, 2),
(864, 1, 261, 1, 1, 1, 1, 12, 1, 1, NULL, NULL, NULL, 1, 23, 1),
(865, 1, 261, 1, 1, 1, 1, 12, 1, 1, NULL, NULL, NULL, 1, 23, 2),
(866, 1, 261, 1, 1, 1, 2, 12, 1, 1, NULL, NULL, NULL, 1, 24, 1),
(867, 1, 261, 1, 1, 1, 2, 12, 1, 1, NULL, NULL, NULL, 1, 24, 2),
(868, 1, 261, 1, 1, 1, 3, 12, 1, 1, NULL, NULL, NULL, 1, 25, 1),
(869, 1, 261, 1, 1, 1, 3, 12, 1, 1, NULL, NULL, NULL, 1, 25, 2),
(870, 1, 262, 1, 1, 1, 1, 12, 1, 1, NULL, NULL, NULL, 1, 23, 1),
(871, 1, 262, 1, 1, 1, 1, 12, 1, 1, NULL, NULL, NULL, 1, 23, 2),
(872, 1, 262, 1, 1, 1, 2, 12, 1, 1, NULL, NULL, NULL, 1, 24, 1),
(873, 1, 262, 1, 1, 1, 2, 12, 1, 1, NULL, NULL, NULL, 1, 24, 2),
(874, 1, 262, 1, 1, 1, 3, 12, 1, 1, NULL, NULL, NULL, 1, 25, 1),
(875, 1, 262, 1, 1, 1, 3, 12, 1, 1, NULL, NULL, NULL, 1, 25, 2),
(876, 1, 263, 1, 1, 1, 1, 12, 1, 1, NULL, NULL, NULL, 1, 23, 1),
(877, 1, 263, 1, 1, 1, 1, 12, 1, 1, NULL, NULL, NULL, 1, 23, 2),
(878, 1, 263, 1, 1, 1, 2, 12, 1, 1, NULL, NULL, NULL, 1, 24, 1),
(879, 1, 263, 1, 1, 1, 2, 12, 1, 1, NULL, NULL, NULL, 1, 24, 2),
(880, 1, 263, 1, 1, 1, 3, 12, 1, 1, NULL, NULL, NULL, 1, 25, 1),
(881, 1, 263, 1, 1, 1, 3, 12, 1, 1, NULL, NULL, NULL, 1, 25, 2),
(882, 1, 264, 1, 1, 1, 1, 12, 1, 1, NULL, NULL, NULL, 1, 23, 1),
(883, 1, 264, 1, 1, 1, 1, 12, 1, 1, NULL, NULL, NULL, 1, 23, 2),
(884, 1, 264, 1, 1, 1, 2, 12, 1, 1, NULL, NULL, NULL, 1, 24, 1),
(885, 1, 264, 1, 1, 1, 2, 12, 1, 1, NULL, NULL, NULL, 1, 24, 2),
(886, 1, 264, 1, 1, 1, 3, 12, 1, 1, NULL, NULL, NULL, 1, 25, 1),
(887, 1, 264, 1, 1, 1, 3, 12, 1, 1, NULL, NULL, NULL, 1, 25, 2),
(888, 1, 265, 1, 1, 1, 1, 12, 1, 1, NULL, NULL, NULL, 1, 23, 1),
(889, 1, 265, 1, 1, 1, 1, 12, 1, 1, NULL, NULL, NULL, 1, 23, 2),
(890, 1, 265, 1, 1, 1, 2, 12, 1, 1, NULL, NULL, NULL, 1, 24, 1),
(891, 1, 265, 1, 1, 1, 2, 12, 1, 1, NULL, NULL, NULL, 1, 24, 2),
(892, 1, 265, 1, 1, 1, 3, 12, 1, 1, NULL, NULL, NULL, 1, 25, 1),
(893, 1, 265, 1, 1, 1, 3, 12, 1, 1, NULL, NULL, NULL, 1, 25, 2),
(894, 1, 266, 1, 1, 1, 1, 12, 1, 1, NULL, NULL, NULL, 1, 23, 1),
(895, 1, 266, 1, 1, 1, 1, 12, 1, 1, NULL, NULL, NULL, 1, 23, 2),
(896, 1, 266, 1, 1, 1, 2, 12, 1, 1, NULL, NULL, NULL, 1, 24, 1),
(897, 1, 266, 1, 1, 1, 2, 12, 1, 1, NULL, NULL, NULL, 1, 24, 2),
(898, 1, 266, 1, 1, 1, 3, 12, 1, 1, NULL, NULL, NULL, 1, 25, 1),
(899, 1, 266, 1, 1, 1, 3, 12, 1, 1, NULL, NULL, NULL, 1, 25, 2),
(900, 1, 267, 1, 1, 1, 1, 12, 1, 2, NULL, NULL, NULL, 1, 23, 1),
(901, 1, 267, 1, 1, 1, 1, 12, 1, 2, NULL, NULL, NULL, 1, 23, 2),
(902, 1, 267, 1, 1, 1, 2, 12, 1, 2, NULL, NULL, NULL, 1, 24, 1),
(903, 1, 267, 1, 1, 1, 2, 12, 1, 2, NULL, NULL, NULL, 1, 24, 2),
(904, 1, 267, 1, 1, 1, 3, 12, 1, 2, NULL, NULL, NULL, 1, 25, 1),
(905, 1, 267, 1, 1, 1, 3, 12, 1, 2, NULL, NULL, NULL, 1, 25, 2),
(906, 1, 268, 1, 1, 1, 1, 12, 1, 1, NULL, NULL, NULL, 1, 23, 1),
(907, 1, 268, 1, 1, 1, 1, 12, 1, 1, NULL, NULL, NULL, 1, 23, 2),
(908, 1, 268, 1, 1, 1, 2, 12, 1, 1, NULL, NULL, NULL, 1, 24, 1),
(909, 1, 268, 1, 1, 1, 2, 12, 1, 1, NULL, NULL, NULL, 1, 24, 2),
(910, 1, 268, 1, 1, 1, 3, 12, 1, 1, NULL, NULL, NULL, 1, 25, 1),
(911, 1, 268, 1, 1, 1, 3, 12, 1, 1, NULL, NULL, NULL, 1, 25, 2),
(912, 1, 269, 1, 1, 1, 1, 12, 1, 1, NULL, NULL, NULL, 1, 23, 1),
(913, 1, 269, 1, 1, 1, 1, 12, 1, 1, NULL, NULL, NULL, 1, 23, 2),
(914, 1, 269, 1, 1, 1, 2, 12, 1, 1, NULL, NULL, NULL, 1, 24, 1),
(915, 1, 269, 1, 1, 1, 2, 12, 1, 1, NULL, NULL, NULL, 1, 24, 2),
(916, 1, 269, 1, 1, 1, 3, 12, 1, 1, NULL, NULL, NULL, 1, 25, 1),
(917, 1, 269, 1, 1, 1, 3, 12, 1, 1, NULL, NULL, NULL, 1, 25, 2),
(918, 1, 270, 1, 1, 1, 1, 12, 1, 1, NULL, NULL, NULL, 1, 23, 1),
(919, 1, 270, 1, 1, 1, 1, 12, 1, 1, NULL, NULL, NULL, 1, 23, 2),
(920, 1, 270, 1, 1, 1, 2, 12, 1, 1, NULL, NULL, NULL, 1, 24, 1),
(921, 1, 270, 1, 1, 1, 2, 12, 1, 1, NULL, NULL, NULL, 1, 24, 2),
(922, 1, 270, 1, 1, 1, 3, 12, 1, 1, NULL, NULL, NULL, 1, 25, 1),
(923, 1, 270, 1, 1, 1, 3, 12, 1, 1, NULL, NULL, NULL, 1, 25, 2),
(924, 1, 271, 1, 1, 1, 1, 12, 1, 1, NULL, NULL, NULL, 1, 23, 1),
(925, 1, 271, 1, 1, 1, 1, 12, 1, 1, NULL, NULL, NULL, 1, 23, 2),
(926, 1, 271, 1, 1, 1, 2, 12, 1, 1, NULL, NULL, NULL, 1, 24, 1),
(927, 1, 271, 1, 1, 1, 2, 12, 1, 1, NULL, NULL, NULL, 1, 24, 2),
(928, 1, 271, 1, 1, 1, 3, 12, 1, 1, NULL, NULL, NULL, 1, 25, 1),
(929, 1, 271, 1, 1, 1, 3, 12, 1, 1, NULL, NULL, NULL, 1, 25, 2),
(930, 1, 272, 1, 1, 1, 1, 12, 1, 1, NULL, NULL, NULL, 1, 23, 1),
(931, 1, 272, 1, 1, 1, 1, 12, 1, 1, NULL, NULL, NULL, 1, 23, 2),
(932, 1, 272, 1, 1, 1, 2, 12, 1, 1, NULL, NULL, NULL, 1, 24, 1),
(933, 1, 272, 1, 1, 1, 2, 12, 1, 1, NULL, NULL, NULL, 1, 24, 2),
(934, 1, 272, 1, 1, 1, 3, 12, 1, 1, NULL, NULL, NULL, 1, 25, 1),
(935, 1, 272, 1, 1, 1, 3, 12, 1, 1, NULL, NULL, NULL, 1, 25, 2),
(936, 1, 273, 1, 1, 1, 1, 12, 1, 1, NULL, NULL, NULL, 1, 23, 1),
(937, 1, 273, 1, 1, 1, 1, 12, 1, 1, NULL, NULL, NULL, 1, 23, 2),
(938, 1, 273, 1, 1, 1, 2, 12, 1, 1, NULL, NULL, NULL, 1, 24, 1),
(939, 1, 273, 1, 1, 1, 2, 12, 1, 1, NULL, NULL, NULL, 1, 24, 2),
(940, 1, 273, 1, 1, 1, 3, 12, 1, 1, NULL, NULL, NULL, 1, 25, 1),
(941, 1, 273, 1, 1, 1, 3, 12, 1, 1, NULL, NULL, NULL, 1, 25, 2),
(942, 1, 274, 1, 1, 1, 1, 14, 1, 1, NULL, NULL, NULL, 1, 23, 1),
(943, 1, 274, 1, 1, 1, 1, 14, 1, 1, NULL, NULL, NULL, 1, 23, 2),
(944, 1, 274, 1, 1, 1, 2, 14, 1, 1, NULL, NULL, NULL, 1, 24, 1),
(945, 1, 274, 1, 1, 1, 2, 14, 1, 1, NULL, NULL, NULL, 1, 24, 2),
(946, 1, 274, 1, 1, 1, 3, 14, 1, 1, NULL, NULL, NULL, 1, 25, 1),
(947, 1, 274, 1, 1, 1, 3, 14, 1, 1, NULL, NULL, NULL, 1, 25, 2),
(948, 1, 275, 1, 1, 1, 1, 14, 1, 1, NULL, NULL, NULL, 1, 23, 1),
(949, 1, 275, 1, 1, 1, 1, 14, 1, 1, NULL, NULL, NULL, 1, 23, 2),
(950, 1, 275, 1, 1, 1, 2, 14, 1, 1, NULL, NULL, NULL, 1, 24, 1),
(951, 1, 275, 1, 1, 1, 2, 14, 1, 1, NULL, NULL, NULL, 1, 24, 2),
(952, 1, 275, 1, 1, 1, 3, 14, 1, 1, NULL, NULL, NULL, 1, 25, 1),
(953, 1, 275, 1, 1, 1, 3, 14, 1, 1, NULL, NULL, NULL, 1, 25, 2),
(954, 1, 276, 1, 1, 1, 1, 14, 1, 2, NULL, NULL, NULL, 1, 23, 1),
(955, 1, 276, 1, 1, 1, 1, 14, 1, 2, NULL, NULL, NULL, 1, 23, 2),
(956, 1, 276, 1, 1, 1, 2, 14, 1, 2, NULL, NULL, NULL, 1, 24, 1),
(957, 1, 276, 1, 1, 1, 2, 14, 1, 2, NULL, NULL, NULL, 1, 24, 2),
(958, 1, 276, 1, 1, 1, 3, 14, 1, 2, NULL, NULL, NULL, 1, 25, 1),
(959, 1, 276, 1, 1, 1, 3, 14, 1, 2, NULL, NULL, NULL, 1, 25, 2),
(960, 1, 277, 1, 1, 1, 3, 14, 1, 2, NULL, NULL, NULL, 1, 25, 2),
(961, 1, 278, 1, 1, 1, 1, 14, 1, 1, NULL, NULL, NULL, 1, 23, 1),
(962, 1, 278, 1, 1, 1, 1, 14, 1, 1, NULL, NULL, NULL, 1, 23, 2),
(963, 1, 278, 1, 1, 1, 2, 14, 1, 1, NULL, NULL, NULL, 1, 24, 1),
(964, 1, 278, 1, 1, 1, 2, 14, 1, 1, NULL, NULL, NULL, 1, 24, 2),
(965, 1, 278, 1, 1, 1, 3, 14, 1, 1, NULL, NULL, NULL, 1, 25, 1),
(966, 1, 278, 1, 1, 1, 3, 14, 1, 1, NULL, NULL, NULL, 1, 25, 2),
(967, 1, 279, 1, 1, 1, 1, 14, 1, 2, NULL, NULL, NULL, 1, 23, 1),
(968, 1, 279, 1, 1, 1, 1, 14, 1, 2, NULL, NULL, NULL, 1, 23, 2),
(969, 1, 279, 1, 1, 1, 2, 14, 1, 2, NULL, NULL, NULL, 1, 24, 1),
(970, 1, 279, 1, 1, 1, 2, 14, 1, 2, NULL, NULL, NULL, 1, 24, 2),
(971, 1, 279, 1, 1, 1, 3, 14, 1, 2, NULL, NULL, NULL, 1, 25, 1),
(972, 1, 279, 1, 1, 1, 3, 14, 1, 2, NULL, NULL, NULL, 1, 25, 2),
(973, 1, 280, 1, 1, 1, 1, 14, 1, 1, NULL, NULL, NULL, 1, 23, 1),
(974, 1, 280, 1, 1, 1, 1, 14, 1, 1, NULL, NULL, NULL, 1, 23, 2),
(975, 1, 280, 1, 1, 1, 2, 14, 1, 1, NULL, NULL, NULL, 1, 24, 1),
(976, 1, 280, 1, 1, 1, 2, 14, 1, 1, NULL, NULL, NULL, 1, 24, 2),
(977, 1, 280, 1, 1, 1, 3, 14, 1, 1, NULL, NULL, NULL, 1, 25, 1),
(978, 1, 280, 1, 1, 1, 3, 14, 1, 1, NULL, NULL, NULL, 1, 25, 2),
(979, 1, 281, 1, 1, 1, 1, 14, 1, 2, NULL, NULL, NULL, 1, 23, 1),
(980, 1, 281, 1, 1, 1, 1, 14, 1, 2, NULL, NULL, NULL, 1, 23, 2),
(981, 1, 281, 1, 1, 1, 2, 14, 1, 2, NULL, NULL, NULL, 1, 24, 1),
(982, 1, 281, 1, 1, 1, 2, 14, 1, 2, NULL, NULL, NULL, 1, 24, 2),
(983, 1, 281, 1, 1, 1, 3, 14, 1, 2, NULL, NULL, NULL, 1, 25, 1),
(984, 1, 281, 1, 1, 1, 3, 14, 1, 2, NULL, NULL, NULL, 1, 25, 2),
(985, 1, 282, 1, 1, 1, 1, 14, 1, 1, NULL, NULL, NULL, 1, 23, 1),
(986, 1, 282, 1, 1, 1, 1, 14, 1, 1, NULL, NULL, NULL, 1, 23, 2),
(987, 1, 282, 1, 1, 1, 2, 14, 1, 1, NULL, NULL, NULL, 1, 24, 1),
(988, 1, 282, 1, 1, 1, 2, 14, 1, 1, NULL, NULL, NULL, 1, 24, 2),
(989, 1, 282, 1, 1, 1, 3, 14, 1, 1, NULL, NULL, NULL, 1, 25, 1),
(990, 1, 282, 1, 1, 1, 3, 14, 1, 1, NULL, NULL, NULL, 1, 25, 2),
(991, 1, 283, 1, 1, 1, 1, 14, 1, 1, NULL, NULL, NULL, 1, 23, 1),
(992, 1, 283, 1, 1, 1, 1, 14, 1, 1, NULL, NULL, NULL, 1, 23, 2),
(993, 1, 283, 1, 1, 1, 2, 14, 1, 1, NULL, NULL, NULL, 1, 24, 1),
(994, 1, 283, 1, 1, 1, 2, 14, 1, 1, NULL, NULL, NULL, 1, 24, 2),
(995, 1, 283, 1, 1, 1, 3, 14, 1, 1, NULL, NULL, NULL, 1, 25, 1),
(996, 1, 283, 1, 1, 1, 3, 14, 1, 1, NULL, NULL, NULL, 1, 25, 2),
(997, 1, 284, 1, 1, 1, 1, 14, 1, 1, NULL, NULL, NULL, 1, 23, 1),
(998, 1, 284, 1, 1, 1, 1, 14, 1, 1, NULL, NULL, NULL, 1, 23, 2),
(999, 1, 284, 1, 1, 1, 2, 14, 1, 1, NULL, NULL, NULL, 1, 24, 1),
(1000, 1, 284, 1, 1, 1, 2, 14, 1, 1, NULL, NULL, NULL, 1, 24, 2),
(1001, 1, 284, 1, 1, 1, 3, 14, 1, 1, NULL, NULL, NULL, 1, 25, 1),
(1002, 1, 284, 1, 1, 1, 3, 14, 1, 1, NULL, NULL, NULL, 1, 25, 2),
(1003, 1, 285, 1, 1, 1, 1, 14, 1, 2, NULL, NULL, NULL, 1, 23, 1),
(1004, 1, 285, 1, 1, 1, 1, 14, 1, 2, NULL, NULL, NULL, 1, 23, 2),
(1005, 1, 285, 1, 1, 1, 2, 14, 1, 2, NULL, NULL, NULL, 1, 24, 1),
(1006, 1, 285, 1, 1, 1, 2, 14, 1, 2, NULL, NULL, NULL, 1, 24, 2),
(1007, 1, 285, 1, 1, 1, 3, 14, 1, 2, NULL, NULL, NULL, 1, 25, 1),
(1008, 1, 285, 1, 1, 1, 3, 14, 1, 2, NULL, NULL, NULL, 1, 25, 2),
(1009, 1, 286, 1, 1, 1, 1, 14, 1, 1, NULL, NULL, NULL, 1, 23, 1),
(1010, 1, 286, 1, 1, 1, 1, 14, 1, 1, NULL, NULL, NULL, 1, 23, 2),
(1011, 1, 286, 1, 1, 1, 2, 14, 1, 1, NULL, NULL, NULL, 1, 24, 1),
(1012, 1, 286, 1, 1, 1, 2, 14, 1, 1, NULL, NULL, NULL, 1, 24, 2),
(1013, 1, 286, 1, 1, 1, 3, 14, 1, 1, NULL, NULL, NULL, 1, 25, 1),
(1014, 1, 286, 1, 1, 1, 3, 14, 1, 1, NULL, NULL, NULL, 1, 25, 2),
(1015, 1, 287, 1, 1, 1, 1, 14, 1, 1, NULL, NULL, NULL, 1, 23, 1),
(1016, 1, 287, 1, 1, 1, 1, 14, 1, 1, NULL, NULL, NULL, 1, 23, 2),
(1017, 1, 287, 1, 1, 1, 2, 14, 1, 1, NULL, NULL, NULL, 1, 24, 1),
(1018, 1, 287, 1, 1, 1, 2, 14, 1, 1, NULL, NULL, NULL, 1, 24, 2),
(1019, 1, 287, 1, 1, 1, 3, 14, 1, 1, NULL, NULL, NULL, 1, 25, 1),
(1020, 1, 287, 1, 1, 1, 3, 14, 1, 1, NULL, NULL, NULL, 1, 25, 2),
(1021, 1, 288, 1, 1, 1, 1, 14, 1, 1, NULL, NULL, NULL, 1, 23, 1),
(1022, 1, 288, 1, 1, 1, 1, 14, 1, 1, NULL, NULL, NULL, 1, 23, 2),
(1023, 1, 288, 1, 1, 1, 2, 14, 1, 1, NULL, NULL, NULL, 1, 24, 1),
(1024, 1, 288, 1, 1, 1, 2, 14, 1, 1, NULL, NULL, NULL, 1, 24, 2),
(1025, 1, 288, 1, 1, 1, 3, 14, 1, 1, NULL, NULL, NULL, 1, 25, 1),
(1026, 1, 288, 1, 1, 1, 3, 14, 1, 1, NULL, NULL, NULL, 1, 25, 2),
(1027, 1, 289, 1, 1, 1, 1, 14, 1, 1, NULL, NULL, NULL, 1, 23, 1),
(1028, 1, 289, 1, 1, 1, 1, 14, 1, 1, NULL, NULL, NULL, 1, 23, 2),
(1029, 1, 289, 1, 1, 1, 2, 14, 1, 1, NULL, NULL, NULL, 1, 24, 1),
(1030, 1, 289, 1, 1, 1, 2, 14, 1, 1, NULL, NULL, NULL, 1, 24, 2),
(1031, 1, 289, 1, 1, 1, 3, 14, 1, 1, NULL, NULL, NULL, 1, 25, 1),
(1032, 1, 289, 1, 1, 1, 3, 14, 1, 1, NULL, NULL, NULL, 1, 25, 2),
(1033, 1, 290, 1, 1, 1, 1, 14, 1, 1, NULL, NULL, NULL, 1, 23, 1),
(1034, 1, 290, 1, 1, 1, 1, 14, 1, 1, NULL, NULL, NULL, 1, 23, 2),
(1035, 1, 290, 1, 1, 1, 2, 14, 1, 1, NULL, NULL, NULL, 1, 24, 1),
(1036, 1, 290, 1, 1, 1, 2, 14, 1, 1, NULL, NULL, NULL, 1, 24, 2),
(1037, 1, 290, 1, 1, 1, 3, 14, 1, 1, NULL, NULL, NULL, 1, 25, 1),
(1038, 1, 290, 1, 1, 1, 3, 14, 1, 1, NULL, NULL, NULL, 1, 25, 2),
(1040, 1, 291, 1, 1, 1, 1, 14, 3, 1, NULL, NULL, NULL, 1, 23, 2),
(1041, 1, 291, 1, 1, 1, 2, 14, 3, 1, NULL, NULL, NULL, 1, 24, 1),
(1042, 1, 291, 1, 1, 1, 2, 14, 3, 1, NULL, NULL, NULL, 1, 24, 2),
(1043, 1, 291, 1, 1, 1, 3, 14, 3, 1, NULL, NULL, NULL, 1, 25, 1),
(1044, 1, 291, 1, 1, 1, 3, 14, 3, 1, NULL, NULL, NULL, 1, 25, 2),
(1045, 1, 292, 1, 1, 1, 1, 14, 3, 1, NULL, NULL, NULL, 1, 23, 1),
(1046, 1, 292, 1, 1, 1, 1, 14, 3, 1, NULL, NULL, NULL, 1, 23, 2),
(1047, 1, 292, 1, 1, 1, 2, 14, 3, 1, NULL, NULL, NULL, 1, 24, 1),
(1048, 1, 292, 1, 1, 1, 2, 14, 3, 1, NULL, NULL, NULL, 1, 24, 2),
(1049, 1, 292, 1, 1, 1, 3, 14, 3, 1, NULL, NULL, NULL, 1, 25, 1),
(1050, 1, 292, 1, 1, 1, 3, 14, 3, 1, NULL, NULL, NULL, 1, 25, 2),
(1051, 1, 293, 1, 1, 1, 1, 14, 3, 1, NULL, NULL, NULL, 1, 23, 1),
(1052, 1, 293, 1, 1, 1, 1, 14, 3, 1, NULL, NULL, NULL, 1, 23, 2),
(1053, 1, 293, 1, 1, 1, 2, 14, 3, 1, NULL, NULL, NULL, 1, 24, 1),
(1054, 1, 293, 1, 1, 1, 2, 14, 3, 1, NULL, NULL, NULL, 1, 24, 2),
(1055, 1, 293, 1, 1, 1, 3, 14, 3, 1, NULL, NULL, NULL, 1, 25, 1),
(1056, 1, 293, 1, 1, 1, 3, 14, 3, 1, NULL, NULL, NULL, 1, 25, 2),
(1057, 1, 294, 1, 1, 1, 1, 14, 3, 2, NULL, NULL, NULL, 1, 23, 1),
(1058, 1, 294, 1, 1, 1, 1, 14, 3, 2, NULL, NULL, NULL, 1, 23, 2),
(1059, 1, 294, 1, 1, 1, 2, 14, 3, 2, NULL, NULL, NULL, 1, 24, 1),
(1060, 1, 294, 1, 1, 1, 2, 14, 3, 2, NULL, NULL, NULL, 1, 24, 2),
(1061, 1, 294, 1, 1, 1, 3, 14, 3, 2, NULL, NULL, NULL, 1, 25, 1),
(1062, 1, 294, 1, 1, 1, 3, 14, 3, 2, NULL, NULL, NULL, 1, 25, 2),
(1063, 1, 295, 1, 1, 1, 1, 14, 3, 1, NULL, NULL, NULL, 1, 23, 1),
(1064, 1, 295, 1, 1, 1, 1, 14, 3, 1, NULL, NULL, NULL, 1, 23, 2),
(1065, 1, 295, 1, 1, 1, 2, 14, 3, 1, NULL, NULL, NULL, 1, 24, 1),
(1066, 1, 295, 1, 1, 1, 2, 14, 3, 1, NULL, NULL, NULL, 1, 24, 2),
(1067, 1, 295, 1, 1, 1, 3, 14, 3, 1, NULL, NULL, NULL, 1, 25, 1),
(1068, 1, 295, 1, 1, 1, 3, 14, 3, 1, NULL, NULL, NULL, 1, 25, 2),
(1069, 1, 296, 1, 1, 1, 1, 14, 3, 1, NULL, NULL, NULL, 1, 23, 1),
(1070, 1, 296, 1, 1, 1, 1, 14, 3, 1, NULL, NULL, NULL, 1, 23, 2),
(1071, 1, 296, 1, 1, 1, 2, 14, 3, 1, NULL, NULL, NULL, 1, 24, 1),
(1072, 1, 296, 1, 1, 1, 2, 14, 3, 1, NULL, NULL, NULL, 1, 24, 2),
(1073, 1, 296, 1, 1, 1, 3, 14, 3, 1, NULL, NULL, NULL, 1, 25, 1),
(1074, 1, 296, 1, 1, 1, 3, 14, 3, 1, NULL, NULL, NULL, 1, 25, 2),
(1075, 1, 297, 1, 1, 1, 1, 14, 1, 1, NULL, NULL, NULL, 1, 23, 1),
(1076, 1, 297, 1, 1, 1, 1, 14, 1, 1, NULL, NULL, NULL, 1, 23, 2),
(1077, 1, 297, 1, 1, 1, 2, 14, 1, 1, NULL, NULL, NULL, 1, 24, 1),
(1078, 1, 297, 1, 1, 1, 2, 14, 1, 1, NULL, NULL, NULL, 1, 24, 2),
(1079, 1, 297, 1, 1, 1, 3, 14, 1, 1, NULL, NULL, NULL, 1, 25, 1),
(1080, 1, 297, 1, 1, 1, 3, 14, 3, 1, NULL, NULL, NULL, 1, 25, 2),
(1081, 1, 298, 1, 1, 1, 1, 14, 3, 1, NULL, NULL, NULL, 1, 23, 1),
(1082, 1, 298, 1, 1, 1, 1, 14, 3, 1, NULL, NULL, NULL, 1, 23, 2),
(1083, 1, 298, 1, 1, 1, 2, 14, 3, 1, NULL, NULL, NULL, 1, 24, 1),
(1084, 1, 298, 1, 1, 1, 2, 14, 3, 1, NULL, NULL, NULL, 1, 24, 2),
(1085, 1, 298, 1, 1, 1, 3, 14, 3, 1, NULL, NULL, NULL, 1, 25, 1),
(1086, 1, 298, 1, 1, 1, 3, 14, 3, 1, NULL, NULL, NULL, 1, 25, 2),
(1087, 1, 299, 1, 1, 1, 1, 14, 3, 1, NULL, NULL, NULL, 1, 23, 1),
(1088, 1, 299, 1, 1, 1, 1, 14, 3, 1, NULL, NULL, NULL, 1, 23, 2),
(1089, 1, 299, 1, 1, 1, 2, 14, 3, 1, NULL, NULL, NULL, 1, 24, 1),
(1090, 1, 299, 1, 1, 1, 2, 14, 3, 1, NULL, NULL, NULL, 1, 24, 2),
(1091, 1, 299, 1, 1, 1, 3, 14, 3, 1, NULL, NULL, NULL, 1, 25, 1),
(1092, 1, 299, 1, 1, 1, 3, 14, 3, 1, NULL, NULL, NULL, 1, 25, 2),
(1093, 1, 300, 1, 1, 1, 1, 14, 3, 1, NULL, NULL, NULL, 1, 23, 1),
(1094, 1, 300, 1, 1, 1, 1, 14, 3, 1, NULL, NULL, NULL, 1, 23, 2),
(1095, 1, 300, 1, 1, 1, 2, 14, 3, 1, NULL, NULL, NULL, 1, 24, 1),
(1096, 1, 300, 1, 1, 1, 2, 14, 3, 1, NULL, NULL, NULL, 1, 24, 2),
(1097, 1, 300, 1, 1, 1, 3, 14, 3, 1, NULL, NULL, NULL, 1, 25, 1),
(1098, 1, 300, 1, 1, 1, 3, 14, 3, 1, NULL, NULL, NULL, 1, 25, 2),
(1099, 1, 301, 1, 1, 1, 1, 14, 3, 1, NULL, NULL, NULL, 1, 23, 1),
(1100, 1, 301, 1, 1, 1, 1, 14, 3, 1, NULL, NULL, NULL, 1, 23, 2),
(1101, 1, 301, 1, 1, 1, 2, 14, 3, 1, NULL, NULL, NULL, 1, 24, 1),
(1102, 1, 301, 1, 1, 1, 2, 14, 3, 1, NULL, NULL, NULL, 1, 24, 2),
(1103, 1, 301, 1, 1, 1, 3, 14, 3, 1, NULL, NULL, NULL, 1, 25, 1),
(1104, 1, 301, 1, 1, 1, 3, 14, 3, 1, NULL, NULL, NULL, 1, 25, 2),
(1105, 1, 302, 1, 1, 1, 1, 14, 3, 1, NULL, NULL, NULL, 1, 23, 1),
(1106, 1, 302, 1, 1, 1, 1, 14, 3, 1, NULL, NULL, NULL, 1, 23, 2),
(1107, 1, 302, 1, 1, 1, 2, 14, 3, 1, NULL, NULL, NULL, 1, 24, 1),
(1108, 1, 302, 1, 1, 1, 2, 14, 3, 1, NULL, NULL, NULL, 1, 24, 2),
(1109, 1, 302, 1, 1, 1, 3, 14, 3, 1, NULL, NULL, NULL, 1, 25, 1),
(1110, 1, 302, 1, 1, 1, 3, 14, 3, 1, NULL, NULL, NULL, 1, 25, 2),
(1111, 1, 303, 1, 1, 1, 1, 14, 1, 1, NULL, NULL, NULL, 1, 23, 1),
(1112, 1, 303, 1, 1, 1, 1, 14, 1, 1, NULL, NULL, NULL, 1, 23, 2),
(1113, 1, 303, 1, 1, 1, 2, 14, 1, 1, NULL, NULL, NULL, 1, 24, 1),
(1114, 1, 303, 1, 1, 1, 2, 14, 1, 1, NULL, NULL, NULL, 1, 24, 2),
(1115, 1, 303, 1, 1, 1, 3, 14, 1, 1, NULL, NULL, NULL, 1, 25, 1),
(1116, 1, 303, 1, 1, 1, 3, 14, 3, 1, NULL, NULL, NULL, 1, 25, 2),
(1117, 1, 304, 1, 1, 1, 1, 14, 3, 1, NULL, NULL, NULL, 1, 23, 1),
(1118, 1, 304, 1, 1, 1, 1, 14, 3, 1, NULL, NULL, NULL, 1, 23, 2),
(1119, 1, 304, 1, 1, 1, 2, 14, 3, 1, NULL, NULL, NULL, 1, 24, 1),
(1120, 1, 304, 1, 1, 1, 2, 14, 3, 1, NULL, NULL, NULL, 1, 24, 2),
(1121, 1, 304, 1, 1, 1, 3, 14, 3, 1, NULL, NULL, NULL, 1, 25, 1),
(1122, 1, 304, 1, 1, 1, 3, 14, 3, 1, NULL, NULL, NULL, 1, 25, 2),
(1123, 1, 305, 1, 1, 1, 1, 14, 3, 1, NULL, NULL, NULL, 1, 23, 1),
(1124, 1, 305, 1, 1, 1, 1, 14, 3, 1, NULL, NULL, NULL, 1, 23, 2),
(1125, 1, 305, 1, 1, 1, 2, 14, 3, 1, NULL, NULL, NULL, 1, 24, 1),
(1126, 1, 305, 1, 1, 1, 2, 14, 3, 1, NULL, NULL, NULL, 1, 24, 2),
(1127, 1, 305, 1, 1, 1, 3, 14, 3, 1, NULL, NULL, NULL, 1, 25, 1),
(1128, 1, 305, 1, 1, 1, 3, 14, 3, 1, NULL, NULL, NULL, 1, 25, 2),
(1129, 1, 306, 1, 1, 1, 1, 14, 3, 1, NULL, NULL, NULL, 1, 23, 1),
(1130, 1, 306, 1, 1, 1, 1, 14, 3, 1, NULL, NULL, NULL, 1, 23, 2),
(1131, 1, 306, 1, 1, 1, 2, 14, 3, 1, NULL, NULL, NULL, 1, 24, 1),
(1132, 1, 306, 1, 1, 1, 2, 14, 3, 1, NULL, NULL, NULL, 1, 24, 2),
(1133, 1, 306, 1, 1, 1, 3, 14, 3, 1, NULL, NULL, NULL, 1, 25, 1),
(1134, 1, 306, 1, 1, 1, 3, 14, 3, 1, NULL, NULL, NULL, 1, 25, 2),
(1135, 1, 307, 1, 1, 1, 1, 14, 3, 1, NULL, NULL, NULL, 1, 23, 1),
(1136, 1, 307, 1, 1, 1, 1, 14, 3, 1, NULL, NULL, NULL, 1, 23, 2),
(1137, 1, 307, 1, 1, 1, 2, 14, 3, 1, NULL, NULL, NULL, 1, 24, 1),
(1138, 1, 307, 1, 1, 1, 2, 14, 3, 1, NULL, NULL, NULL, 1, 24, 2),
(1139, 1, 307, 1, 1, 1, 3, 14, 3, 1, NULL, NULL, NULL, 1, 25, 1),
(1140, 1, 307, 1, 1, 1, 3, 14, 3, 1, NULL, NULL, NULL, 1, 25, 2);

-- --------------------------------------------------------

--
-- Структура таблицы `students_absents`
--

CREATE TABLE `students_absents` (
  `id` int NOT NULL,
  `id_student` int NOT NULL,
  `id_fan` int NOT NULL,
  `rating` int DEFAULT NULL,
  `absents` int NOT NULL,
  `semestr` int NOT NULL,
  `s_y` int NOT NULL,
  `h_y` int NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Структура таблицы `student_litsey`
--

CREATE TABLE `student_litsey` (
  `id` int NOT NULL,
  `id_xonanda` int NOT NULL,
  `id_sinf` int NOT NULL,
  `id_group` int NOT NULL,
  `balance` float NOT NULL DEFAULT '2450',
  `s_y` int NOT NULL,
  `h_y` int NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Структура таблицы `student_mmt_information`
--

CREATE TABLE `student_mmt_information` (
  `id` int NOT NULL,
  `id_student` int NOT NULL,
  `number_mmt` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `total_score_mmt` float DEFAULT NULL,
  `davri_qabul_mmt` int DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Структура таблицы `study_level`
--

CREATE TABLE `study_level` (
  `id` int NOT NULL,
  `title` varchar(255) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb3;

--
-- Дамп данных таблицы `study_level`
--

INSERT INTO `study_level` (`id`, `title`) VALUES
(1, 'Бакалавр'),
(2, 'Таҳсилоти дуюм'),
(3, 'Магистратура'),
(4, 'Докторантура');

-- --------------------------------------------------------

--
-- Структура таблицы `study_type`
--

CREATE TABLE `study_type` (
  `id` int NOT NULL,
  `title` varchar(255) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb3;

--
-- Дамп данных таблицы `study_type`
--

INSERT INTO `study_type` (`id`, `title`) VALUES
(1, 'Шартномавӣ'),
(2, 'Буҷавӣ'),
(3, 'Квота'),
(4, 'Бурсия');

-- --------------------------------------------------------

--
-- Структура таблицы `study_view`
--

CREATE TABLE `study_view` (
  `id` int NOT NULL,
  `title` varchar(50) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb3;

--
-- Дамп данных таблицы `study_view`
--

INSERT INTO `study_view` (`id`, `title`) VALUES
(1, 'Рӯзона'),
(2, 'Фосилавӣ');

-- --------------------------------------------------------

--
-- Структура таблицы `study_years`
--

CREATE TABLE `study_years` (
  `id` int NOT NULL,
  `title` varchar(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb3;

--
-- Дамп данных таблицы `study_years`
--

INSERT INTO `study_years` (`id`, `title`) VALUES
(24, '2024-2025'),
(23, '2023-2024'),
(22, '2022-2023'),
(21, '2021-2022'),
(25, '2025-2026');

-- --------------------------------------------------------

--
-- Структура таблицы `suporishho`
--

CREATE TABLE `suporishho` (
  `id` int NOT NULL,
  `id_iqtibos` int NOT NULL,
  `id_week` int NOT NULL,
  `id_fan` int NOT NULL,
  `title` varchar(250) NOT NULL,
  `text` longtext NOT NULL,
  `date` varchar(50) NOT NULL,
  `updated` varchar(50) DEFAULT NULL,
  `author` int DEFAULT NULL,
  `updated_by` int DEFAULT NULL,
  `views` int DEFAULT '0',
  `s_y` int NOT NULL,
  `h_y` int NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb3;

-- --------------------------------------------------------

--
-- Структура таблицы `teacher_module`
--

CREATE TABLE `teacher_module` (
  `id` int NOT NULL,
  `id_user` int NOT NULL,
  `ALL` varchar(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `READ` varchar(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Структура таблицы `tests`
--

CREATE TABLE `tests` (
  `id` int NOT NULL,
  `id_iqtibos` int NOT NULL,
  `id_faculty` int NOT NULL,
  `id_s_l` int NOT NULL,
  `id_s_v` int NOT NULL,
  `id_course` int NOT NULL,
  `id_spec` int NOT NULL,
  `id_group` int NOT NULL,
  `id_fan` int NOT NULL,
  `imt_type` int NOT NULL DEFAULT '1' COMMENT '1-тести\r\n2-хати\r\n3-махорат\r\n4-шифохи',
  `test_type` int NOT NULL DEFAULT '1' COMMENT '1-донишгоҳи\r\n2-факултети\r\n3-тахасусӣ/ихтисосӣ',
  `status` int NOT NULL,
  `r_1_date` datetime DEFAULT NULL,
  `r_2_date` datetime DEFAULT NULL,
  `datetime` datetime DEFAULT NULL,
  `r_1_access` int NOT NULL DEFAULT '0',
  `r_2_access` int NOT NULL DEFAULT '0',
  `s_y` int NOT NULL,
  `h_y` int NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Структура таблицы `tests_settings`
--

CREATE TABLE `tests_settings` (
  `id` int NOT NULL,
  `id_fan` int NOT NULL,
  `score` int NOT NULL DEFAULT '30',
  `t1` int DEFAULT NULL,
  `t2` int DEFAULT NULL,
  `t3` int DEFAULT NULL,
  `t4` int DEFAULT NULL,
  `t5` int DEFAULT NULL,
  `t6` int DEFAULT NULL,
  `s_y` int NOT NULL,
  `h_y` int NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Дамп данных таблицы `tests_settings`
--

INSERT INTO `tests_settings` (`id`, `id_fan`, `score`, `t1`, `t2`, `t3`, `t4`, `t5`, `t6`, `s_y`, `h_y`) VALUES
(1, 3171, 30, 10, 1, 2, 2, 3, 3, 24, 1),
(2, 3193, 30, 20, 0, 0, 0, 0, 0, 24, 1),
(3, 2917, 30, 10, 0, 0, 2, 3, 5, 24, 1),
(4, 3355, 30, 12, 0, 0, 0, 4, 4, 24, 1),
(5, 76, 30, 8, 0, 0, 0, 0, 0, 24, 1),
(6, 8, 30, 20, 0, 0, 0, 0, 0, 24, 1),
(7, 7, 30, 20, 0, 0, 0, 0, 0, 24, 1),
(8, 2813, 30, 20, 0, 0, 0, 0, 0, 24, 1),
(9, 10, 30, 20, 0, 0, 0, 0, 0, 24, 1),
(10, 2577, 30, 3, NULL, NULL, NULL, NULL, NULL, 24, 1),
(11, 2677, 30, 20, 0, 0, 0, 0, 0, 24, 1),
(12, 3, 30, 10, 0, 0, 0, 0, 0, 24, 1),
(13, 4, 30, 20, 0, 0, 0, 0, 0, 24, 1),
(14, 14, 30, 20, 0, 0, 0, 0, 0, 24, 1),
(15, 1, 30, 20, 0, 0, 0, 0, 0, 24, 1),
(16, 3006, 30, 20, 0, 0, 0, 0, 0, 24, 1),
(17, 2766, 30, 20, 0, 0, 0, 0, 0, 24, 1),
(18, 2883, 30, 20, 0, 0, 0, 0, 0, 24, 1),
(19, 3002, 30, 15, 0, 5, 4, 4, 2, 24, 1),
(20, 3146, 30, 20, 0, 0, 0, 0, 0, 24, 1),
(21, 3045, 30, 20, 0, 0, 0, 0, 0, 24, 1),
(22, 3007, 30, 20, 0, 0, 0, 0, 0, 24, 1),
(23, 3008, 30, 20, 0, 0, 0, 0, 0, 24, 1),
(24, 2808, 30, 20, 0, 0, 0, 0, 0, 24, 1),
(25, 364, 30, 20, 0, 0, 0, 0, 0, 24, 1),
(26, 2913, 30, 20, 0, 0, 0, 0, 0, 24, 1),
(27, 2914, 30, 10, 0, 0, 0, 0, 0, 24, 1),
(28, 113, 30, 20, 0, 0, 0, 0, 0, 24, 1),
(29, 2809, 30, 20, 0, 0, 0, 0, 0, 24, 1),
(30, 2839, 30, 10, 0, 0, 0, 0, 0, 24, 1),
(31, 3234, 30, 20, 0, 0, 0, 0, 0, 24, 1),
(32, 40, 30, 10, 0, 0, 0, 0, 0, 24, 1),
(33, 1505, 30, 14, 6, 0, 0, 0, 0, 24, 1),
(34, 2874, 30, 20, 0, 0, 0, 0, 0, 24, 1),
(35, 1980, 30, 8, 0, 0, 0, 0, 0, 24, 1),
(36, 2842, 30, 10, 0, 0, 0, 0, 0, 24, 1),
(37, 2804, 30, 20, 0, 0, 0, 0, 0, 24, 1),
(38, 2960, 30, 20, 0, 0, 0, 0, 0, 24, 1),
(39, 3101, 30, 20, 0, 0, 0, 0, 0, 24, 1),
(40, 3057, 30, 20, 0, 0, 0, 0, 0, 24, 1),
(41, 3149, 30, 20, 0, 0, 0, 0, 0, 24, 1),
(42, 3120, 30, 15, 0, 0, 5, 0, 0, 24, 1),
(43, 3071, 30, 20, 0, 0, 0, 0, 0, 24, 1),
(44, 2, 30, 10, 0, 0, 0, 0, 0, 24, 1),
(45, 3012, 30, 20, 0, 0, 0, 0, 0, 24, 1),
(46, 1069, 30, 20, 0, 0, 0, 0, 0, 24, 1),
(47, 94, 30, 15, 0, 0, 0, 0, 0, 24, 1),
(48, 3005, 30, 20, 0, 0, 0, 0, 0, 24, 1),
(49, 3110, 30, 20, 0, 0, 0, 0, 0, 24, 1),
(50, 3010, 30, 20, 0, 0, 0, 0, 0, 24, 1),
(51, 3106, 30, 20, 0, 0, 0, 0, 0, 24, 1),
(52, 2905, 30, 20, 0, 0, 0, 0, 0, 24, 1),
(53, 2775, 30, 20, 0, 0, 0, 0, 0, 24, 1),
(54, 3052, 30, 20, 0, 0, 0, 0, 0, 24, 1),
(55, 3126, 30, 20, 0, 0, 0, 0, 0, 24, 1),
(56, 3121, 30, 20, 0, 0, 0, 0, 0, 24, 1),
(57, 3144, 30, 20, 0, 0, 0, 0, 0, 24, 1),
(58, 3068, 30, 20, 0, 0, 0, 0, 0, 24, 1),
(59, 3031, 30, 20, 0, 0, 0, 0, 0, 24, 1),
(60, 3044, 30, 20, 0, 0, 0, 0, 0, 24, 1),
(61, 2884, 30, 20, 0, 0, 0, 0, 0, 24, 1),
(62, 3260, 30, 20, 0, 0, 0, 0, 0, 24, 1),
(63, 2791, 30, 20, 0, 0, 0, 0, 0, 24, 1),
(64, 2802, 30, 20, 0, 0, 0, 0, 0, 24, 1),
(65, 3396, 30, 20, 0, 0, 0, 0, 0, 24, 1),
(66, 3464, 30, 20, 0, 0, 0, 0, 0, 24, 1),
(67, 2965, 30, 20, 0, 0, 0, 0, 0, 24, 1),
(68, 2967, 30, 20, 0, 0, 0, 0, 0, 24, 1),
(69, 2957, 30, 20, 2, 2, 0, 2, 1, 24, 1),
(70, 12, 30, 20, 0, 0, 0, 0, 0, 24, 1),
(71, 2990, 30, 18, 2, 0, 0, 0, 0, 24, 1),
(72, 44, 30, 20, 0, 0, 0, 0, 0, 24, 1),
(73, 3325, 30, 20, 0, 0, 0, 0, 0, 24, 1),
(74, 2456, 30, 20, 0, 0, 0, 0, 0, 24, 1),
(75, 1145, 30, 20, 0, 0, 0, 0, 0, 24, 1),
(76, 2961, 30, 20, 0, 0, 0, 0, 0, 24, 1),
(77, 3284, 30, 20, 0, 0, 0, 0, 0, 24, 1),
(78, 3326, 30, 20, 0, 0, 0, 0, 0, 24, 1),
(79, 1196, 30, 20, 0, 0, 0, 0, 0, 24, 1),
(80, 1268, 30, 20, 0, 0, 0, 0, 0, 24, 1),
(81, 3254, 30, 20, 0, 0, 0, 0, 0, 24, 1),
(82, 2835, 30, 20, 0, 0, 0, 0, 0, 24, 1),
(83, 3309, 30, 20, 0, 0, 0, 0, 0, 24, 1),
(84, 3319, 30, 20, 0, 0, 0, 0, 0, 24, 1),
(85, 3340, 30, 20, 0, 0, 0, 0, 0, 24, 1),
(86, 2841, 30, 20, 0, 0, 0, 0, 0, 24, 1),
(87, 2812, 30, 20, 0, 0, 0, 0, 0, 24, 1),
(88, 2767, 30, 15, 0, 0, 0, 0, 5, 24, 1),
(89, 3351, 30, 20, 0, 0, 0, 0, 0, 24, 1),
(90, 6, 30, 15, 0, 0, 0, 0, 0, 24, 1),
(91, 854, 30, 10, 0, 0, 0, 0, 0, 24, 1),
(92, 3302, 30, 20, 0, 0, 0, 0, 0, 24, 1),
(93, 3411, 30, 20, 0, 0, 0, 0, 0, 24, 1),
(94, 2834, 30, 20, 0, 0, 0, 0, 0, 24, 1),
(95, 2982, 30, 20, 0, 0, 0, 0, 0, 24, 1),
(96, 1291, 30, 20, 0, 0, 0, 0, 0, 24, 1),
(97, 3073, 30, NULL, NULL, NULL, NULL, NULL, NULL, 24, 1),
(98, 2824, 30, 20, 0, 0, 0, 0, 0, 24, 1),
(99, 3016, 30, 20, 0, 0, 0, 0, 0, 24, 1),
(100, 2859, 30, 20, 0, 0, 0, 0, 0, 24, 1),
(101, 3019, 30, 20, 0, 0, 0, 0, 0, 24, 1),
(102, 3009, 30, 20, 0, 0, 0, 0, 0, 24, 1),
(103, 3167, 30, 20, 0, 0, 0, 0, 0, 24, 1),
(104, 3221, 30, 20, 0, 0, 0, 0, 0, 24, 1),
(105, 3208, 30, 20, 0, 0, 0, 0, 0, 24, 1),
(106, 3042, 30, 20, 0, 0, 0, 0, 0, 24, 1),
(107, 3046, 30, 20, 0, 0, 0, 0, 0, 24, 1),
(108, 2782, 30, 20, 0, 0, 0, 0, 0, 24, 1),
(109, 2785, 30, 20, 0, 0, 0, 0, 0, 24, 1),
(110, 1692, 30, 20, 0, 0, 0, 0, 0, 24, 1),
(111, 2909, 30, 20, 0, 0, 0, 0, 0, 24, 1),
(112, 2789, 30, 20, 0, 0, 0, 0, 0, 24, 1),
(113, 2927, 30, 20, 0, 0, 0, 0, 0, 24, 1),
(114, 3056, 30, 20, 0, 0, 0, 0, 0, 24, 1),
(115, 3460, 30, 20, 0, 0, 0, 0, 0, 24, 1),
(116, 3099, 30, 20, 0, 0, 0, 0, 0, 24, 1),
(117, 1747, 30, 80, 0, 0, 0, 0, 0, 24, 1),
(118, 2989, 30, 0, 20, 0, 0, 0, 0, 24, 1),
(119, 3182, 30, 20, 0, 0, 0, 0, 0, 24, 1),
(120, 2815, 30, 20, 0, 0, 0, 0, 0, 24, 1),
(121, 3032, 30, 20, 0, 0, 0, 0, 0, 24, 1),
(122, 2958, 30, 20, 0, 0, 0, 0, 0, 24, 1),
(123, 3053, 30, 20, 0, 0, 0, 0, 0, 24, 1),
(124, 3037, 30, 20, 0, 0, 0, 0, 0, 24, 1),
(125, 2796, 30, 20, 0, 0, 0, 0, 0, 24, 1),
(126, 3084, 30, 20, 0, 0, 0, 0, 0, 24, 1),
(127, 3092, 30, 20, 0, 0, 0, 0, 0, 24, 1),
(128, 3030, 30, 20, 0, 0, 0, 0, 0, 24, 1),
(129, 1124, 30, 20, 0, 0, 0, 0, 0, 24, 1),
(130, 3070, 30, 20, 0, 0, 0, 0, 0, 24, 1),
(131, 3047, 30, 20, 0, 0, 0, 0, 0, 24, 1),
(132, 3020, 30, 20, 0, 0, 0, 0, 0, 24, 1),
(133, 3454, 30, 20, 0, 0, 0, 0, 0, 24, 1),
(134, 3138, 30, 20, 0, 0, 0, 0, 0, 24, 1),
(135, 3139, 30, 20, 0, 0, 0, 0, 0, 24, 1),
(136, 3195, 30, 20, 0, 0, 0, 0, 0, 24, 1),
(137, 2814, 30, 15, 0, 0, 0, 0, 0, 24, 1),
(138, 1551, 30, 20, 0, 0, 0, 0, 0, 24, 1),
(139, 3192, 30, 2, 0, 0, 0, 0, 0, 24, 1),
(140, 3183, 30, 20, 0, 0, 0, 0, 0, 24, 1),
(141, 2768, 30, 20, 0, 0, 0, 0, 0, 24, 1),
(142, 3001, 30, 20, 0, 0, 0, 0, 0, 24, 1),
(143, 3093, 30, 20, 0, 0, 0, 0, 0, 24, 1),
(144, 9, 30, 20, 0, 0, 0, 0, 0, 24, 1),
(145, 2778, 30, 20, 0, 0, 0, 0, 0, 24, 1),
(146, 3034, 30, 20, 0, 0, 0, 0, 0, 24, 1),
(147, 3097, 30, 20, 0, 0, 0, 0, 0, 24, 1),
(148, 5, 30, 10, 0, 0, 0, 0, 0, 24, 1),
(149, 1235, 30, 20, 0, 0, 0, 0, 0, 24, 1),
(150, 2816, 30, 20, 0, 0, 0, 0, 0, 24, 1),
(151, 2849, 30, 20, 0, 0, 0, 0, 0, 24, 1),
(152, 2671, 30, 8, 0, 0, 0, 0, 0, 24, 1),
(153, 3332, 30, 20, 0, 0, 0, 0, 0, 24, 1),
(154, 3344, 30, 20, 0, 0, 0, 0, 0, 24, 1),
(155, 3265, 30, 25, 3, 0, 0, 0, 0, 24, 1),
(156, 3345, 30, 10, 0, 0, 0, 0, 0, 24, 1),
(157, 1246, 30, 20, 0, 0, 0, 0, 0, 24, 1),
(158, 1251, 30, 20, 0, 0, 0, 0, 0, 24, 1),
(159, 3252, 30, 20, 0, 0, 0, 0, 0, 24, 1),
(160, 3220, 30, 20, 0, 0, 0, 0, 0, 24, 1),
(161, 1236, 30, 20, 0, 0, 0, 0, 0, 24, 1),
(162, 1166, 30, 20, 0, 0, 0, 0, 0, 24, 1),
(163, 3337, 30, 20, 0, 0, 0, 0, 0, 24, 1),
(164, 3335, 30, 25, 0, 0, 0, 0, 0, 24, 1),
(165, 1148, 30, 20, 0, 0, 0, 0, 0, 24, 1),
(166, 3445, 30, 20, 0, 0, 0, 0, 0, 24, 1),
(167, 2417, 30, 20, 0, 0, 0, 0, 0, 24, 1),
(168, 3040, 30, 20, 0, 0, 0, 0, 0, 24, 1),
(169, 2524, 30, 20, 0, 0, 0, 0, 0, 24, 1),
(170, 3153, 30, 20, 0, 0, 0, 0, 0, 24, 1),
(171, 3228, 30, 20, 0, 0, 0, 0, 0, 24, 1),
(172, 3314, 30, 20, 0, 0, 0, 0, 0, 24, 1),
(173, 3313, 30, 20, 0, 0, 0, 0, 0, 24, 1),
(174, 3036, 30, 20, 0, 0, 0, 0, 0, 24, 1),
(175, 2993, 30, 10, 0, 0, 0, 0, 0, 24, 1),
(176, 3189, 30, 20, 0, 0, 0, 0, 0, 24, 1),
(177, 3239, 30, 20, 0, 0, 0, 0, 0, 24, 1),
(178, 3258, 30, 20, 0, 0, 0, 0, 0, 24, 1),
(179, 3429, 30, 20, 0, 0, 0, 0, 0, 24, 1),
(180, 2847, 30, 20, 0, 0, 0, 0, 0, 24, 1),
(181, 3461, 30, 25, 0, 0, 0, 0, 0, 24, 1),
(182, 1220, 30, 20, 0, 0, 0, 0, 0, 24, 1),
(183, 3291, 30, 20, 0, 0, 0, 0, 0, 24, 1),
(184, 3264, 30, 20, 0, 0, 0, 0, 0, 24, 1),
(185, 1144, 30, 20, 0, 0, 0, 0, 0, 24, 1),
(186, 3296, 30, 20, 0, 0, 0, 0, 0, 24, 1),
(187, 3462, 30, 20, 0, 0, 0, 0, 10, 24, 1),
(188, 2968, 30, 20, 0, 0, 0, 0, 0, 24, 1),
(189, 3463, 30, 20, 0, 0, 0, 0, 0, 24, 1),
(190, 3219, 30, 20, 0, 0, 0, 0, 0, 24, 1),
(191, 1526, 30, 20, 0, 0, 0, 0, 0, 24, 1),
(192, 1202, 30, 20, 0, 0, 0, 0, 0, 24, 1),
(193, 3447, 30, 20, 0, 0, 0, 0, 0, 24, 1),
(194, 2911, 30, 20, 0, 0, 0, 0, 0, 24, 1),
(195, 2926, 30, 20, 0, 0, 0, 0, 0, 24, 1),
(196, 2902, 30, 20, 20, 0, 0, 0, 0, 24, 1),
(197, 2951, 30, 10, 0, 0, 0, 0, 0, 24, 1),
(198, 2826, 30, 20, 0, 0, 0, 0, 0, 24, 1),
(199, 2856, 30, 20, 0, 0, 0, 0, 0, 24, 1),
(200, 2832, 30, 20, 0, 0, 0, 0, 0, 24, 1),
(201, 2953, 30, 20, 0, 0, 0, 0, 0, 24, 1),
(202, 3080, 30, 20, 0, 0, 0, 0, 0, 24, 1),
(203, 2964, 30, 20, 0, 0, 0, 0, 0, 24, 1),
(204, 1422, 30, 20, 0, 0, 0, 0, 0, 24, 1),
(205, 3331, 30, 20, 0, 0, 0, 0, 0, 24, 1),
(206, 2869, 30, 20, 0, 0, 0, 0, 0, 24, 1),
(207, 3287, 30, 20, 0, 0, 0, 0, 0, 24, 1),
(208, 3231, 30, 20, 0, 0, 0, 0, 0, 24, 1),
(209, 3235, 30, 10, 4, 2, 4, 0, 0, 24, 1),
(210, 3242, 30, 20, 0, 0, 0, 0, 0, 24, 1),
(211, 2955, 30, 20, 0, 0, 0, 0, 0, 24, 1),
(212, 1360, 30, 20, 0, 0, 0, 0, 0, 24, 1),
(213, 3316, 30, 20, 0, 0, 0, 0, 0, 24, 1),
(214, 3382, 30, 20, 0, 0, 0, 0, 0, 24, 1),
(215, 3250, 30, 20, 0, 0, 0, 0, 0, 24, 1),
(216, 3111, 30, 20, 0, 0, 0, 0, 0, 24, 1),
(217, 3096, 30, 20, 0, 0, 0, 0, 0, 24, 1),
(218, 3113, 30, 20, 0, 0, 0, 0, 0, 24, 1),
(219, 3249, 30, 15, 0, 0, 0, 0, 0, 24, 1),
(220, 3372, 30, 20, 0, 0, 0, 0, 0, 24, 1),
(221, 3074, 30, 20, 0, 0, 0, 0, 0, 24, 1),
(222, 2963, 30, 20, 0, 0, 0, 0, 0, 24, 1),
(223, 1108, 30, 20, 0, 0, 0, 0, 0, 24, 1),
(224, 2017, 30, 20, 0, 0, 0, 0, 0, 24, 1),
(225, 3274, 30, 20, 0, 0, 0, 0, 0, 24, 1),
(226, 3268, 30, 20, 0, 0, 0, 0, 0, 24, 1),
(227, 2781, 30, 20, 0, 0, 0, 0, 0, 24, 1),
(228, 2899, 30, 20, 0, 0, 0, 0, 0, 24, 1),
(229, 2794, 30, 20, 0, 0, 0, 0, 0, 24, 1),
(230, 2792, 30, 20, 0, 0, 0, 0, 0, 24, 1),
(231, 2770, 30, 20, 0, 0, 0, 0, 0, 24, 1),
(232, 611, 30, 10, 0, 0, 0, 0, 0, 24, 1),
(233, 1923, 30, 20, 0, 0, 0, 0, 0, 24, 1),
(234, 2918, 30, 20, 0, 0, 0, 0, 0, 24, 1),
(235, 2820, 30, 20, 0, 0, 0, 0, 0, 24, 1),
(236, 2886, 30, 20, 0, 0, 0, 0, 0, 24, 1),
(237, 2800, 30, 20, 0, 0, 0, 0, 0, 24, 1),
(238, 3374, 30, 20, 0, 0, 0, 0, 0, 24, 1),
(239, 2803, 30, 20, 0, 0, 0, 0, 0, 24, 1),
(240, 2885, 30, 20, 0, 0, 0, 0, 0, 24, 1),
(241, 2867, 30, 15, 0, 0, 0, 0, 0, 24, 1),
(242, 3215, 30, 20, 0, 0, 0, 0, 0, 24, 1),
(243, 3162, 30, 20, 0, 0, 0, 0, 0, 24, 1),
(244, 3198, 30, 20, 0, 0, 0, 0, 0, 24, 1),
(245, 2822, 30, 20, 0, 0, 0, 0, 0, 24, 1),
(246, 2852, 30, 20, 0, 0, 0, 0, 0, 24, 1),
(247, 3078, 30, 20, 0, 0, 0, 0, 0, 24, 1),
(248, 2810, 30, 20, 0, 0, 0, 0, 0, 24, 1),
(249, 3102, 30, 20, 0, 0, 0, 0, 0, 24, 1),
(250, 2818, 30, 20, 0, 0, 0, 0, 0, 24, 1),
(251, 1121, 30, 20, 0, 0, 0, 0, 0, 24, 1),
(252, 3437, 30, 19, 0, 0, 0, 0, 1, 24, 1),
(253, 3225, 30, 20, 0, 0, 0, 0, 0, 24, 1),
(254, 2997, 30, 20, 0, 0, 0, 0, 0, 24, 1),
(255, 2866, 30, 20, 0, 0, 0, 0, 0, 24, 1),
(256, 3436, 30, 20, 0, 0, 0, 8, 10, 24, 1),
(257, 2995, 30, 20, 0, 0, 0, 0, 0, 24, 1),
(258, 2895, 30, 20, 0, 0, 0, 0, 0, 24, 1),
(259, 2854, 30, 20, 0, 0, 0, 0, 0, 24, 1),
(260, 2998, 30, 20, 0, 0, 0, 0, 0, 24, 1),
(261, 3422, 30, 20, 0, 0, 0, 0, 0, 24, 1),
(262, 3184, 30, 20, 0, 0, 0, 0, 0, 24, 1),
(263, 2857, 30, 20, 0, 0, 0, 0, 0, 24, 1),
(264, 3075, 30, 20, 0, 0, 0, 0, 0, 24, 1),
(265, 2254, 30, 20, 0, 0, 0, 0, 0, 24, 1),
(266, 3435, 30, 20, 0, 0, 0, 0, 0, 24, 1),
(267, 3238, 30, 20, 0, 0, 0, 0, 0, 24, 1),
(268, 2882, 30, 20, 0, 0, 0, 0, 0, 24, 1),
(269, 2994, 30, 20, 0, 0, 0, 0, 0, 24, 1),
(270, 3387, 30, 20, 0, 0, 0, 0, 0, 24, 1),
(271, 2855, 30, 20, 0, 0, 0, 0, 0, 24, 1),
(272, 3107, 30, 20, 0, 0, 0, 0, 0, 24, 1),
(273, 1232, 30, 20, 0, 0, 0, 0, 0, 24, 1),
(274, 2837, 30, 20, 0, 0, 0, 0, 0, 24, 1),
(275, 3311, 30, 20, 0, 0, 0, 0, 0, 24, 1),
(276, 2919, 30, 20, 0, 0, 0, 0, 0, 24, 1),
(277, 2944, 30, 20, 0, 0, 0, 0, 0, 24, 1),
(278, 3412, 30, 20, 0, 0, 0, 0, 0, 24, 1),
(279, 2825, 30, 20, 0, 0, 0, 0, 0, 24, 1),
(280, 3145, 30, 20, 0, 0, 0, 0, 0, 24, 1),
(281, 3210, 30, 20, 0, 0, 0, 0, 0, 24, 1),
(282, 3181, 30, 20, 0, 0, 0, 0, 0, 24, 1),
(283, 3420, 30, 20, 0, 0, 0, 0, 0, 24, 1),
(284, 3211, 30, 20, 0, 0, 0, 0, 0, 24, 1),
(285, 3169, 30, 20, 0, 0, 0, 0, 0, 24, 1),
(286, 3205, 30, 10, 0, 0, 0, 0, 0, 24, 1),
(287, 3310, 30, 20, 0, 0, 0, 0, 0, 24, 1),
(288, 3392, 30, 20, 0, 0, 0, 0, 0, 24, 1),
(289, 3312, 30, 20, 0, 0, 0, 0, 0, 24, 1),
(290, 3076, 30, 20, 0, 0, 0, 0, 0, 24, 1),
(291, 2236, 30, 20, 0, 0, 0, 0, 0, 24, 1),
(292, 3129, 30, 20, 0, 0, 0, 0, 0, 24, 1),
(293, 1550, 30, 20, 0, 0, 0, 0, 0, 24, 1),
(294, 3069, 30, 20, 0, 0, 0, 0, 0, 24, 1),
(295, 2991, 30, 20, 0, 0, 0, 0, 0, 24, 1),
(296, 3286, 30, 10, 0, 0, 0, 0, 0, 24, 1),
(297, 3244, 30, 20, 0, 0, 0, 0, 0, 24, 1),
(298, 1198, 30, 10, 0, 0, 0, 0, 0, 24, 1),
(299, 3456, 30, 20, 0, 0, 0, 0, 0, 24, 1),
(300, 3035, 30, 20, 0, 0, 0, 0, 0, 24, 1),
(301, 3033, 30, 20, 0, 0, 0, 0, 0, 24, 1),
(302, 2807, 30, 20, 0, 0, 0, 0, 0, 24, 1),
(303, 3455, 30, 20, 0, 0, 0, 0, 0, 24, 1),
(304, 1743, 30, 10, 0, 0, 0, 0, 0, 24, 1),
(305, 3178, 30, 20, 0, 0, 0, 0, 0, 24, 1),
(306, 3400, 30, 20, 0, 0, 0, 0, 0, 24, 1),
(307, 3263, 30, 20, 0, 0, 0, 0, 0, 24, 1),
(308, 3438, 30, 20, 0, 0, 0, 0, 0, 24, 1),
(309, 3230, 30, 20, 0, 0, 0, 0, 0, 24, 1),
(310, 356, 30, 20, 0, 0, 0, 0, 0, 24, 1),
(311, 3207, 30, 20, 0, 0, 0, 0, 0, 24, 1),
(312, 2772, 30, 20, 0, 0, 0, 0, 0, 24, 1),
(313, 3170, 30, 20, 0, 0, 0, 0, 0, 24, 1),
(314, 2915, 30, 20, 0, 0, 0, 0, 0, 24, 1),
(315, 3315, 30, 20, 0, 0, 0, 0, 0, 24, 1),
(316, 3292, 30, 20, 0, 0, 0, 0, 0, 24, 1),
(317, 2780, 30, 20, 0, 0, 0, 0, 0, 24, 1),
(318, 3172, 30, 20, 0, 0, 0, 0, 0, 24, 1),
(319, 3173, 30, 20, 0, 0, 0, 0, 0, 24, 1),
(320, 2851, 30, 20, 0, 0, 0, 0, 0, 24, 1),
(321, 2908, 30, 20, 0, 0, 0, 0, 0, 24, 1),
(322, 625, 30, 20, 0, 0, 0, 0, 0, 24, 1),
(323, 3175, 30, 20, 0, 0, 0, 0, 0, 24, 1),
(324, 2871, 30, 20, 0, 0, 0, 0, 0, 24, 1),
(325, 2873, 30, 10, 0, 0, 0, 0, 0, 24, 1),
(326, 3301, 30, 20, 0, 0, 0, 0, 0, 24, 1),
(327, 3421, 30, 20, 0, 0, 0, 0, 0, 24, 1),
(328, 3423, 30, 20, 0, 0, 0, 0, 0, 24, 1),
(329, 3333, 30, 20, 0, 0, 0, 0, 0, 24, 1),
(330, 3156, 30, 20, 0, 0, 0, 0, 0, 24, 1),
(331, 2910, 30, 20, 0, 0, 0, 0, 0, 24, 1),
(332, 2956, 30, 20, 0, 0, 0, 0, 0, 24, 1),
(333, 3089, 30, 0, 10, 0, 0, 10, 0, 24, 1),
(334, 3389, 30, 20, 0, 0, 0, 0, 0, 24, 1),
(335, 3416, 30, 20, 0, 0, 0, 0, 0, 24, 1),
(336, 1245, 30, 20, 0, 0, 0, 0, 0, 24, 1),
(337, 3243, 30, 20, 0, 0, 0, 0, 0, 24, 1),
(338, 1912, 30, 20, 0, 0, 0, 0, 0, 24, 1),
(339, 3485, 30, 20, 0, 0, 0, 0, 0, 24, 1),
(340, 3441, 30, 20, 0, 0, 0, 0, 0, 24, 1),
(341, 3457, 30, 20, 0, 0, 0, 0, 0, 24, 1),
(342, 3450, 30, 20, 0, 0, 0, 0, 0, 24, 1),
(343, 3449, 30, 20, 0, 0, 0, 0, 0, 24, 1),
(344, 1914, 30, 20, 0, 0, 0, 0, 0, 24, 1),
(345, 3489, 30, 20, 20, 0, 0, 0, 0, 24, 1),
(346, 3414, 30, 20, 0, 0, 0, 0, 0, 24, 1),
(347, 3415, 30, 20, 0, 0, 0, 0, 0, 24, 1),
(348, 3487, 30, 20, 0, 0, 0, 0, 0, 24, 1),
(349, 3492, 30, 20, 0, 0, 0, 0, 0, 24, 1),
(350, 3493, 30, 20, 0, 0, 0, 0, 0, 24, 1),
(351, 3440, 30, 20, 0, 0, 0, 0, 0, 24, 1),
(352, 3448, 30, 20, 0, 0, 0, 0, 0, 24, 1),
(353, 3486, 30, 3, 3, 3, 3, 3, 3, 24, 1),
(354, 3439, 30, 20, 0, 0, 0, 0, 0, 24, 1),
(355, 7, 30, 20, 0, 0, 0, 0, 0, 24, 2),
(356, 3082, 30, 20, 0, 0, 0, 0, 0, 24, 2),
(357, 1198, 30, 13, 7, 0, 0, 0, 0, 24, 2),
(358, 3432, 30, 20, 0, 0, 0, 0, 0, 24, 2),
(359, 2814, 30, 20, 0, 0, 0, 0, 0, 24, 2),
(360, 2828, 30, 20, 0, 0, 0, 0, 0, 24, 2),
(361, 2906, 30, 20, 0, 0, 0, 0, 0, 24, 2),
(362, 2988, 30, 20, 0, 0, 0, 0, 0, 24, 2),
(363, 2786, 30, 20, 0, 0, 0, 0, 0, 24, 2),
(364, 3157, 30, 20, 0, 0, 0, 0, 0, 24, 2),
(365, 3041, 30, 20, 0, 0, 0, 0, 0, 24, 2),
(366, 3475, 30, 20, 0, 0, 0, 0, 0, 24, 2),
(367, 3226, 30, 20, 0, 0, 0, 0, 0, 24, 2),
(368, 3334, 30, 20, 0, 0, 0, 0, 0, 24, 2),
(369, 3163, 30, 20, 0, 0, 0, 0, 0, 24, 2),
(370, 3033, 30, 20, NULL, NULL, NULL, NULL, NULL, 24, 2),
(371, 2783, 30, 20, NULL, NULL, NULL, NULL, NULL, 24, 2),
(372, 2860, 30, 20, NULL, NULL, NULL, NULL, NULL, 24, 2),
(373, 1550, 30, 20, 0, 0, 0, 0, 0, 24, 2),
(374, 2876, 30, 20, NULL, NULL, NULL, NULL, NULL, 24, 2),
(375, 1370, 30, 20, NULL, NULL, NULL, NULL, NULL, 24, 2),
(376, 2801, 30, 20, 0, 0, 0, 0, 0, 24, 2),
(377, 2797, 30, 20, 0, 0, 0, 0, 0, 24, 2),
(378, 1743, 30, 20, NULL, NULL, NULL, NULL, NULL, 24, 2),
(379, 3259, 30, 20, 0, 0, 0, 0, 0, 24, 2),
(380, 3154, 30, 20, 0, 0, 0, 0, 0, 24, 2),
(381, 3077, 30, 20, NULL, NULL, NULL, NULL, NULL, 24, 2),
(382, 3357, 30, 20, NULL, NULL, NULL, NULL, NULL, 24, 2),
(383, 3199, 30, 20, 0, 0, 0, 0, 0, 24, 2),
(384, 1925, 30, 20, NULL, NULL, NULL, NULL, NULL, 24, 2),
(385, 3255, 30, 20, 0, 0, 0, 0, 0, 24, 2),
(386, 3200, 30, 20, NULL, NULL, NULL, NULL, NULL, 24, 2),
(387, 2950, 30, 20, NULL, NULL, NULL, NULL, NULL, 24, 2),
(388, 2985, 30, 20, 0, 0, 0, 0, 0, 24, 2),
(389, 2832, 30, 20, 0, 0, 0, 0, 0, 24, 2),
(390, 2953, 30, 20, NULL, NULL, NULL, NULL, NULL, 24, 2),
(391, 3295, 30, 20, 0, 0, 0, 0, 0, 24, 2),
(392, 3469, 30, 20, NULL, NULL, NULL, NULL, NULL, 24, 2),
(393, 1422, 30, 20, NULL, NULL, NULL, NULL, NULL, 24, 2),
(394, 3373, 30, 20, 0, 0, 0, 0, 0, 24, 2),
(395, 3089, 30, 20, 0, 0, 0, 0, 0, 24, 2),
(396, 2766, 30, 20, 0, 0, 0, 0, 0, 24, 2),
(397, 3361, 30, 20, NULL, NULL, NULL, NULL, NULL, 24, 2),
(398, 140, 30, 20, 0, 0, 0, 0, 0, 24, 2),
(399, 3443, 30, 20, NULL, NULL, NULL, NULL, NULL, 24, 2),
(400, 2862, 30, 20, NULL, NULL, NULL, NULL, NULL, 24, 2),
(401, 3390, 30, 2, 2, 0, 0, 0, 4, 24, 2),
(402, 3389, 30, 20, 0, 0, 0, 0, 0, 24, 2),
(403, 12, 30, 20, 0, 0, 0, 0, 0, 24, 2),
(404, 414, 30, 20, NULL, NULL, NULL, NULL, NULL, 24, 2),
(405, 2585, 30, 20, NULL, NULL, NULL, NULL, NULL, 24, 2),
(406, 2973, 30, 20, NULL, NULL, NULL, NULL, NULL, 24, 2),
(407, 3400, 30, 20, NULL, NULL, NULL, NULL, NULL, 24, 2),
(408, 2958, 30, 20, NULL, NULL, NULL, NULL, NULL, 24, 2),
(409, 3425, 30, 20, NULL, NULL, NULL, NULL, NULL, 24, 2),
(410, 3016, 30, 20, 0, 0, 0, 0, 0, 24, 2),
(411, 3081, 30, 20, NULL, NULL, NULL, NULL, NULL, 24, 2),
(412, 3001, 30, 20, 0, 0, 0, 0, 0, 24, 2),
(413, 3094, 30, 20, 0, 0, 0, 0, 0, 24, 2),
(414, 4, 30, 20, 0, 0, 0, 0, 0, 24, 2),
(415, 9, 30, 20, 0, 0, 0, 0, 0, 24, 2),
(416, 8, 30, 20, 0, 0, 0, 0, 0, 24, 2),
(417, 10, 30, 20, 0, 0, 0, 0, 0, 24, 2),
(418, 3419, 30, 20, NULL, NULL, NULL, NULL, NULL, 24, 2),
(419, 3260, 30, 20, 0, 0, 0, 0, 0, 24, 2),
(420, 3271, 30, 20, 0, 0, 0, 0, 0, 24, 2),
(421, 2790, 30, 20, NULL, NULL, NULL, NULL, NULL, 24, 2),
(422, 2845, 30, 20, 0, 0, 0, 0, 0, 24, 2),
(423, 3304, 30, 20, NULL, NULL, NULL, NULL, NULL, 24, 2),
(424, 37, 30, 0, NULL, NULL, NULL, NULL, NULL, 24, 2),
(425, 2182, 30, 20, NULL, NULL, NULL, NULL, NULL, 24, 2),
(426, 3444, 30, 20, NULL, NULL, NULL, NULL, NULL, 24, 2),
(427, 2839, 30, 14, 3, 0, 0, 0, 3, 24, 2),
(428, 3343, 30, 20, NULL, NULL, NULL, NULL, NULL, 24, 2),
(429, 1360, 30, 20, 0, 0, 0, 0, 0, 24, 2),
(430, 3087, 30, 20, NULL, NULL, NULL, NULL, NULL, 24, 2),
(431, 3049, 30, 20, 0, 0, 0, 0, 0, 24, 2),
(432, 2793, 30, 20, 0, 0, 0, 0, 0, 24, 2),
(433, 3392, 30, 20, NULL, NULL, NULL, NULL, NULL, 24, 2),
(434, 2770, 30, 20, 0, 0, 0, 0, 0, 24, 2),
(435, 611, 30, 20, 0, 0, 0, 0, 0, 24, 2),
(436, 38, 30, 20, NULL, NULL, NULL, NULL, NULL, 24, 2),
(437, 3058, 30, 20, NULL, NULL, NULL, NULL, NULL, 24, 2),
(438, 1923, 30, 20, NULL, NULL, NULL, NULL, NULL, 24, 2),
(439, 3403, 30, 20, NULL, NULL, NULL, NULL, NULL, 24, 2),
(440, 3038, 30, 20, 0, 0, 0, 0, 0, 24, 2),
(441, 3030, 30, 20, 0, 0, 0, 0, 0, 24, 2),
(442, 2823, 30, 20, NULL, NULL, NULL, NULL, NULL, 24, 2),
(443, 2844, 30, 20, 0, 0, 0, 0, 0, 24, 2),
(444, 3267, 30, 20, 0, 0, 0, 0, 0, 24, 2),
(445, 2817, 30, 20, 0, 0, 0, 0, 0, 24, 2),
(446, 3180, 30, 20, 0, 0, 0, 0, 0, 24, 2),
(447, 1144, 30, 20, 0, 0, 0, 0, 0, 24, 2),
(448, 2769, 30, 20, 0, 0, 0, 0, 0, 24, 2),
(449, 80, 30, 20, 0, 0, 0, 0, 0, 24, 2),
(450, 3495, 30, 20, NULL, NULL, NULL, NULL, NULL, 24, 2),
(451, 1980, 30, 20, 0, 0, 0, 0, 0, 24, 2),
(452, 76, 30, 2, 0, 3, 0, 0, 3, 24, 2),
(453, 3401, 30, 20, NULL, NULL, NULL, NULL, NULL, 24, 2),
(454, 2859, 30, 20, 0, 0, 0, 0, 0, 24, 2),
(455, 1148, 30, 20, 0, 0, 0, 0, 0, 24, 2),
(456, 3338, 30, 20, 0, 0, 0, 0, 0, 24, 2),
(457, 3491, 30, 20, NULL, NULL, NULL, NULL, NULL, 24, 2),
(458, 3490, 30, 20, NULL, NULL, NULL, NULL, NULL, 24, 2),
(459, 3418, 30, 20, NULL, NULL, NULL, NULL, NULL, 24, 2),
(460, 113, 30, 20, 0, 0, 0, 0, 0, 24, 2),
(461, 2771, 30, 20, NULL, NULL, NULL, NULL, NULL, 24, 2),
(462, 2788, 30, 20, NULL, NULL, NULL, NULL, NULL, 24, 2),
(463, 2796, 30, 20, 0, 0, 0, 0, 0, 24, 2),
(464, 2795, 30, 20, NULL, NULL, NULL, NULL, NULL, 24, 2),
(465, 2836, 30, 20, 0, 0, 0, 0, 0, 24, 2),
(466, 2455, 30, 20, 0, 0, 0, 0, 0, 24, 2),
(467, 3229, 30, 20, NULL, NULL, NULL, NULL, NULL, 24, 2),
(468, 2841, 30, 20, 0, 0, 0, 0, 0, 24, 2),
(469, 40, 30, 20, 0, 0, 0, 0, 0, 24, 2),
(470, 3484, 30, 20, NULL, NULL, NULL, NULL, NULL, 24, 2),
(471, 3308, 30, 20, 0, 0, 0, 0, 0, 24, 2),
(472, 3313, 30, 20, NULL, NULL, NULL, NULL, NULL, 24, 2),
(473, 1202, 30, 20, NULL, NULL, NULL, NULL, NULL, 24, 2),
(474, 3237, 30, 10, 5, 5, 5, 0, 0, 24, 2),
(475, 3270, 30, 20, 0, 0, 0, 0, 0, 24, 2),
(476, 3322, 30, 20, 0, 0, 0, 0, 0, 24, 2),
(477, 3273, 30, 20, 0, 0, 0, 0, 0, 24, 2),
(478, 44, 30, 20, NULL, NULL, NULL, NULL, NULL, 24, 2),
(479, 3240, 30, 20, NULL, NULL, NULL, NULL, NULL, 24, 2),
(480, 2896, 30, 20, NULL, NULL, NULL, NULL, NULL, 24, 2),
(481, 2805, 30, 20, 0, 0, 0, 0, 0, 24, 2),
(482, 3206, 30, 20, 0, 0, 0, 0, 0, 24, 2),
(483, 3428, 30, 20, NULL, NULL, NULL, NULL, NULL, 24, 2),
(484, 3015, 30, 20, NULL, NULL, NULL, NULL, NULL, 24, 2),
(485, 1100, 30, 20, NULL, NULL, NULL, NULL, NULL, 24, 2),
(486, 3453, 30, 20, NULL, NULL, NULL, NULL, NULL, 24, 2),
(487, 2979, 30, 20, NULL, NULL, NULL, NULL, NULL, 24, 2),
(488, 2974, 30, 20, 0, 0, 0, 0, 0, 24, 2),
(489, 1537, 30, 20, 0, 0, 0, 0, 0, 24, 2),
(490, 1990, 30, 20, 0, 0, 0, 0, 0, 24, 2),
(491, 1913, 30, 20, NULL, NULL, NULL, NULL, NULL, 24, 2),
(492, 3017, 30, 20, 0, 0, 0, 0, 0, 24, 2),
(493, 3216, 30, 20, NULL, NULL, NULL, NULL, NULL, 24, 2),
(494, 2772, 30, 20, 0, 0, 0, 0, 0, 24, 2),
(495, 3417, 30, 20, NULL, NULL, NULL, NULL, NULL, 24, 2),
(496, 2784, 30, 20, 0, 0, 0, 0, 0, 24, 2),
(497, 3321, 30, 20, 0, 0, 0, 0, 0, 24, 2),
(498, 3394, 30, 20, NULL, NULL, NULL, NULL, NULL, 24, 2),
(499, 3326, 30, 20, NULL, NULL, NULL, NULL, NULL, 24, 2),
(500, 3323, 30, 20, 0, 0, 0, 0, 0, 24, 2),
(501, 3191, 30, 20, 0, 0, 0, 0, 0, 24, 2),
(502, 3410, 30, 20, NULL, NULL, NULL, NULL, NULL, 24, 2),
(503, 3236, 30, 20, 0, 0, 0, 0, 0, 24, 2),
(504, 6, 30, 20, 0, 0, 0, 0, 0, 24, 2),
(505, 2776, 30, 20, NULL, NULL, NULL, NULL, NULL, 24, 2),
(506, 2986, 30, 20, 0, 0, 0, 0, 0, 24, 2),
(507, 2875, 30, 20, 0, 0, 0, 0, 0, 24, 2),
(508, 3319, 30, 20, NULL, NULL, NULL, NULL, NULL, 24, 2),
(509, 3318, 30, 20, 0, 0, 0, 0, 0, 24, 2),
(510, 3426, 30, 20, NULL, NULL, NULL, NULL, NULL, 24, 2),
(511, 5, 30, 20, 0, 0, 0, 0, 0, 24, 2),
(512, 2871, 30, 20, NULL, NULL, NULL, NULL, NULL, 24, 2),
(513, 2777, 30, 20, 0, 0, 0, 0, 0, 24, 2),
(514, 3051, 30, 20, 0, 0, 0, 0, 0, 24, 2),
(515, 3261, 30, 20, NULL, NULL, NULL, NULL, NULL, 24, 2),
(516, 3190, 30, 20, NULL, NULL, NULL, NULL, NULL, 24, 2),
(517, 48, 30, 20, NULL, NULL, NULL, NULL, NULL, 24, 2),
(518, 3363, 30, 20, 0, 0, 0, 0, 0, 24, 2),
(519, 3342, 30, 20, NULL, NULL, NULL, NULL, NULL, 24, 2),
(520, 3000, 30, 20, NULL, NULL, NULL, NULL, NULL, 24, 2),
(521, 1747, 30, 20, NULL, NULL, NULL, NULL, NULL, 24, 2),
(522, 3039, 30, 20, 0, 0, 0, 0, 0, 24, 2),
(523, 3452, 30, 20, NULL, NULL, NULL, NULL, NULL, 24, 2),
(524, 3006, 30, 20, NULL, NULL, NULL, NULL, NULL, 24, 2),
(525, 3044, 30, 20, 0, 0, 0, 0, 0, 24, 2),
(526, 3013, 30, 20, NULL, NULL, NULL, NULL, NULL, 24, 2),
(527, 3007, 30, 20, NULL, NULL, NULL, NULL, NULL, 24, 2),
(528, 3091, 30, 20, NULL, NULL, NULL, NULL, NULL, 24, 2),
(529, 3115, 30, 20, 0, 0, 0, 0, 0, 24, 2),
(530, 3336, 30, 20, NULL, NULL, NULL, NULL, NULL, 24, 2),
(531, 3104, 30, 20, NULL, NULL, NULL, NULL, NULL, 24, 2),
(532, 2, 30, 20, 0, 0, 0, 0, 0, 24, 2),
(533, 2498, 30, 20, 0, 0, 0, 0, 0, 24, 2),
(534, 2165, 30, 20, NULL, NULL, NULL, NULL, NULL, 24, 2),
(535, 3458, 30, 20, NULL, NULL, NULL, NULL, NULL, 24, 2),
(536, 3238, 30, 20, 0, 0, 0, 0, 0, 24, 2),
(537, 3442, 30, 20, NULL, NULL, NULL, NULL, NULL, 24, 2),
(538, 3247, 30, 20, NULL, NULL, NULL, NULL, NULL, 24, 2),
(539, 3459, 30, 20, NULL, NULL, NULL, NULL, NULL, 24, 2),
(540, 1922, 30, 0, NULL, NULL, NULL, NULL, NULL, 24, 2),
(541, 2789, 30, 20, 0, 0, 0, 0, 0, 24, 2),
(542, 3176, 30, 20, NULL, NULL, NULL, NULL, NULL, 24, 2),
(543, 3424, 30, 20, NULL, NULL, NULL, NULL, NULL, 24, 2),
(544, 3427, 30, 20, NULL, NULL, NULL, NULL, NULL, 24, 2),
(545, 1088, 30, 20, NULL, NULL, NULL, NULL, NULL, 24, 2),
(546, 2774, 30, 20, NULL, NULL, NULL, NULL, NULL, 24, 2),
(547, 3063, 30, 20, NULL, NULL, NULL, NULL, NULL, 24, 2),
(548, 2960, 30, 20, 0, 0, 0, 0, 0, 24, 2),
(549, 2961, 30, 20, 0, 0, 0, 0, 0, 24, 2),
(550, 3057, 30, 20, 0, 0, 0, 0, 0, 24, 2),
(551, 2417, 30, 20, 0, 0, 0, 0, 0, 24, 2),
(552, 3028, 30, 20, NULL, NULL, NULL, NULL, NULL, 24, 2),
(553, 3112, 30, 20, NULL, NULL, NULL, NULL, NULL, 24, 2),
(554, 2811, 30, 20, NULL, NULL, NULL, NULL, NULL, 24, 2),
(555, 2913, 30, 20, 0, 0, 0, 0, 0, 24, 2),
(556, 3088, 30, 20, NULL, NULL, NULL, NULL, NULL, 24, 2),
(557, 2818, 30, 20, 0, 0, 0, 0, 0, 24, 2),
(558, 2956, 30, 20, 0, 0, 0, 0, 0, 24, 2),
(559, 2787, 30, 20, 0, 0, 0, 0, 0, 24, 2),
(560, 2800, 30, 20, 0, 0, 0, 0, 0, 24, 2),
(561, 2907, 30, 20, 0, 0, 0, 0, 0, 24, 2),
(562, 2954, 30, 20, 0, 0, 0, 0, 0, 24, 2),
(563, 2808, 30, 20, 0, 0, 0, 0, 0, 24, 2),
(564, 2799, 30, 20, 0, 0, 0, 0, 0, 24, 2),
(565, 2833, 30, 20, 0, 0, 0, 0, 0, 24, 2),
(566, 2843, 30, 20, NULL, NULL, NULL, NULL, NULL, 24, 2),
(567, 3488, 30, 20, NULL, NULL, NULL, NULL, NULL, 24, 2),
(568, 75, 30, 20, NULL, NULL, NULL, NULL, NULL, 24, 2),
(569, 3451, 30, 20, NULL, NULL, NULL, NULL, NULL, 24, 2),
(570, 2829, 30, 20, 0, 0, 0, 0, 0, 24, 2),
(571, 3202, 30, 20, NULL, NULL, NULL, NULL, NULL, 24, 2),
(572, 3477, 30, 20, NULL, NULL, NULL, NULL, NULL, 24, 2),
(573, 2820, 30, 20, 0, 0, 0, 0, 0, 24, 2),
(574, 3262, 30, 20, NULL, NULL, NULL, NULL, NULL, 24, 2),
(575, 2773, 30, 20, 0, 0, 0, 0, 0, 24, 2),
(576, 3494, 30, 20, NULL, NULL, NULL, NULL, NULL, 24, 2),
(577, 1, 30, 20, 0, 0, 0, 0, 0, 24, 2),
(578, 3, 30, 20, 0, 0, 0, 0, 0, 24, 2),
(579, 2853, 30, 10, 1, 1, 0, 4, 4, 24, 2),
(580, 3362, 30, 20, 0, 0, 0, 0, 0, 24, 2),
(581, 3230, 30, 20, 0, 0, 0, 0, 0, 24, 2),
(582, 14, 30, 20, NULL, NULL, NULL, NULL, NULL, 24, 2),
(583, 2912, 30, 20, NULL, NULL, NULL, NULL, NULL, 24, 2),
(584, 2881, 30, 20, NULL, NULL, NULL, NULL, NULL, 24, 2),
(585, 3164, 30, 20, 0, 0, 0, 0, 0, 24, 2),
(586, 2821, 30, 20, NULL, NULL, NULL, NULL, NULL, 24, 2),
(587, 3161, 30, 20, NULL, NULL, NULL, NULL, NULL, 24, 2),
(588, 2872, 30, 20, NULL, NULL, NULL, NULL, NULL, 24, 2),
(589, 13, 30, 20, NULL, NULL, NULL, NULL, NULL, 24, 2),
(590, 3355, 30, 20, 0, 0, 0, 0, 0, 24, 2),
(591, 89, 30, 20, NULL, NULL, NULL, NULL, NULL, 24, 2),
(592, 2671, 30, 8, 0, 0, 4, 0, 8, 24, 2),
(593, 3402, 30, 20, 0, 0, 0, 0, 0, 24, 2),
(594, 94, 30, 20, 0, 0, 0, 0, 0, 24, 2),
(595, 3003, 30, 20, 0, 0, 0, 0, 0, 24, 2),
(596, 3155, 30, 20, NULL, NULL, NULL, NULL, NULL, 24, 2),
(597, 2861, 30, 20, 0, 0, 0, 0, 0, 24, 2),
(598, 2992, 30, 20, NULL, NULL, NULL, NULL, NULL, 24, 2);

-- --------------------------------------------------------

--
-- Структура таблицы `test_center_module`
--

CREATE TABLE `test_center_module` (
  `id` int NOT NULL,
  `id_user` int NOT NULL,
  `id_faculties` varchar(250) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `id_s_l` varchar(250) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Структура таблицы `trimestr`
--

CREATE TABLE `trimestr` (
  `id` int NOT NULL,
  `id_student` int NOT NULL,
  `author` int NOT NULL,
  `date` date NOT NULL,
  `money` float DEFAULT NULL,
  `status` int DEFAULT NULL,
  `s_y` int NOT NULL,
  `h_y` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Структура таблицы `trimestr_content`
--

CREATE TABLE `trimestr_content` (
  `id` int NOT NULL,
  `id_trimestr` int NOT NULL,
  `id_faculty` int NOT NULL,
  `id_s_l` int NOT NULL,
  `id_s_v` int NOT NULL,
  `id_course` int NOT NULL,
  `id_spec` int NOT NULL,
  `id_group` int NOT NULL,
  `id_fan` int NOT NULL,
  `imt_type` int DEFAULT NULL,
  `old_score` float NOT NULL,
  `c_u` float DEFAULT NULL,
  `c_f_u` float NOT NULL,
  `money` float NOT NULL,
  `id_teacher` int DEFAULT NULL,
  `status` int NOT NULL DEFAULT '0',
  `s_y` int NOT NULL,
  `h_y` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Структура таблицы `users`
--

CREATE TABLE `users` (
  `id` int NOT NULL,
  `fullname_tj` varchar(500) CHARACTER SET utf32 COLLATE utf32_unicode_ci NOT NULL,
  `fullname_ru` varchar(500) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `login` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `first_login` varchar(25) DEFAULT NULL,
  `last_login` varchar(25) DEFAULT NULL,
  `counter` int NOT NULL DEFAULT '0',
  `birthday` varchar(20) DEFAULT NULL,
  `jins` int DEFAULT NULL,
  `photo` varchar(50) DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL,
  `phone` varchar(50) DEFAULT NULL,
  `phone_parents` varchar(250) DEFAULT NULL,
  `v_ijtimoi` int DEFAULT NULL,
  `from_family` int DEFAULT NULL,
  `v_oilavi` int DEFAULT NULL,
  `family_info` text,
  `xobgoh` int DEFAULT NULL,
  `unvoni_harbi` int DEFAULT NULL,
  `lashkar` int DEFAULT NULL,
  `access` int NOT NULL DEFAULT '1',
  `rating_access` int DEFAULT NULL,
  `archive` int DEFAULT NULL,
  `access_type` int NOT NULL DEFAULT '3' COMMENT '0-супер админ\r\n1-админ\r\n2-омузгор\r\n3-донишҷу\r\n4-литсей\r\n5-кормандон\r\n6-жител хобгох',
  `added_by` int DEFAULT NULL,
  `added_time` varchar(50) DEFAULT NULL,
  `s_y` int NOT NULL DEFAULT '24',
  `h_y` int NOT NULL DEFAULT '2'
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb3;

--
-- Дамп данных таблицы `users`
--

INSERT INTO `users` (`id`, `fullname_tj`, `fullname_ru`, `login`, `password`, `first_login`, `last_login`, `counter`, `birthday`, `jins`, `photo`, `email`, `phone`, `phone_parents`, `v_ijtimoi`, `from_family`, `v_oilavi`, `family_info`, `xobgoh`, `unvoni_harbi`, `lashkar`, `access`, `rating_access`, `archive`, `access_type`, `added_by`, `added_time`, `s_y`, `h_y`) VALUES
(1, 'Ашурзода Бахром Хайриддин', NULL, 'bahrom1', ',f[hjv91', '2024-07-23 03:45:08', '2025-01-21 14:00:15', 45, '1990-02-11', 1, '1.png', NULL, '+992918455665', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, 1, NULL, NULL, 24, 2),
(2, 'Administrator', NULL, 'muhammad0707', 'realmadrid0707', '2024-07-22 04:21:43', '2025-05-16 07:38:07', 228, '1994-12-26', 1, '2.png', NULL, '+992988686970', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, 1, NULL, NULL, 25, 1),
(3, 'Ibrohim', 'Ibrohim', 'ibrohim', 'Kulob2023*', '2024-07-24 07:07:53', '2025-05-14 18:03:35', 105, '1995-19-01', 1, '', NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, 1, 1, NULL, 24, 2),
(4, 'Yusupov Jasur', 'Юсупов Ҷасур', 'admin1', '12345', '2024-07-22 04:21:57', '2025-05-20 08:36:13', 1253, NULL, 1, '', NULL, '934232302', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, 1, 1, NULL, 25, 1),
(39, 'Содаткадамова Мадина Мубораккадаовна', 'Содаткадамова Мадина Мубораккадаовна', '2025010017', '2025010017', NULL, NULL, 0, NULL, 0, NULL, NULL, NULL, NULL, 1, 1, 1, 'Падар - Модар -', NULL, NULL, NULL, 1, NULL, NULL, 3, 4, '2025-05-15 10:19:07', 24, 2),
(38, 'Сафаров Саймуҳаммад Ҷурахонович', 'Сафаров Саймуҳаммад Ҷурахонович', '2025010016', '2025010016', NULL, NULL, 0, NULL, 1, NULL, NULL, NULL, NULL, 1, 1, 1, 'Падар - Модар -', NULL, NULL, NULL, 1, NULL, NULL, 3, 4, '2025-05-15 10:18:45', 24, 2),
(37, 'Салимов Аминҷон Валиевич', 'Салимов Аминҷон Валиевич', '2025010015', '2025010015', NULL, NULL, 0, NULL, 1, NULL, NULL, NULL, NULL, 1, 1, 1, 'Падар - Модар -', NULL, NULL, NULL, 1, NULL, NULL, 3, 4, '2025-05-15 10:18:23', 24, 2),
(36, 'Саймуминзода Муҳаммад Саймумин', 'Саймуминзода Муҳаммад Саймумин', '2025010014', '2025010014', NULL, NULL, 0, NULL, 1, NULL, NULL, NULL, NULL, 1, 1, 1, 'Падар - Модар -', NULL, NULL, NULL, 1, NULL, NULL, 3, 4, '2025-05-15 10:18:00', 24, 2),
(35, 'Рачабов Шаҳриёр Худоёрович', 'Рачабов Шаҳриёр Худоёрович', '2025010013', '2025010013', NULL, NULL, 0, '', 1, NULL, NULL, NULL, NULL, 1, 1, 1, 'Падар - Модар -', NULL, NULL, 1, 1, NULL, NULL, 3, 4, '2025-05-15 10:17:33', 24, 2),
(34, 'Насурдинов Саймуддин Бадриддинович', 'Насурдинов Саймуддин Бадриддинович', '2025010012', '2025010012', NULL, NULL, 0, NULL, 1, NULL, NULL, NULL, NULL, 1, 1, 1, 'Падар - Модар -', NULL, NULL, NULL, 1, NULL, NULL, 3, 4, '2025-05-15 10:17:02', 24, 2),
(33, 'Мирзоев Акмалҷон Рустамович', 'Мирзоев Акмалҷон Рустамович', '2025010011', '2025010011', NULL, NULL, 0, NULL, 1, NULL, NULL, NULL, NULL, 1, 1, 1, 'Падар - Модар -', NULL, NULL, NULL, 1, NULL, NULL, 3, 4, '2025-05-15 10:16:27', 24, 2),
(32, 'Қосимов Шаҳбоз Қудбидинович', 'Қосимов Шаҳбоз Қудбидинович', '2025010010', '2025010010', NULL, NULL, 0, NULL, 1, NULL, NULL, NULL, NULL, 1, 1, 1, 'Падар - Модар -', NULL, NULL, NULL, 1, NULL, NULL, 3, 4, '2025-05-15 10:16:04', 24, 2),
(31, 'Иброҳимзода Фархунда Низомиддин', 'Иброҳимзода Фархунда Низомиддин', '2025010009', '2025010009', NULL, NULL, 0, NULL, 0, NULL, NULL, NULL, NULL, 1, 1, 1, 'Падар - Модар -', NULL, NULL, NULL, 1, NULL, NULL, 3, 4, '2025-05-15 10:15:39', 24, 2),
(30, 'Бобоев Ораш Абдусаторович', 'Бобоев Ораш Абдусаторович', '2025010008', '2025010008', NULL, NULL, 0, NULL, 1, NULL, NULL, NULL, NULL, 1, 1, 1, 'Падар - Модар -', NULL, NULL, NULL, 1, NULL, NULL, 3, 4, '2025-05-15 10:15:14', 24, 2),
(29, 'Бердова Оҷатбегим Бердовна', 'Бердова Оҷатбегим Бердовна', '2025010007', '2025010007', NULL, NULL, 0, NULL, 0, NULL, NULL, NULL, NULL, 1, 1, 1, 'Падар - Модар -', NULL, NULL, NULL, 1, NULL, NULL, 3, 4, '2025-05-15 10:14:45', 24, 2),
(28, 'Баротов Шаҳриёр Қурбоналиевич', 'Баротов Шаҳриёр Қурбоналиевич', '2025010006', '2025010006', NULL, NULL, 0, NULL, 1, NULL, NULL, NULL, NULL, 1, 1, 1, 'Падар - Модар -', NULL, NULL, NULL, 1, NULL, NULL, 3, 4, '2025-05-15 10:14:13', 24, 2),
(27, 'Ашурқулов Дилшод Давронович', 'Ашурқулов Дилшод Давронович', '2025010005', '2025010005', NULL, NULL, 0, NULL, 1, NULL, NULL, NULL, NULL, 1, 1, 1, 'Падар - Модар -', NULL, NULL, NULL, 1, NULL, NULL, 3, 4, '2025-05-15 10:13:25', 24, 2),
(26, 'Калонов Муҳаммад Баҳридинович', 'Калонов Муҳаммад Баҳридинович', '2025010004', '2025010004', NULL, NULL, 0, NULL, 1, NULL, NULL, NULL, NULL, 1, 1, 1, 'Падар - Модар -', NULL, NULL, NULL, 1, NULL, NULL, 3, 4, '2025-05-15 09:37:19', 24, 2),
(25, 'Анақулов Нозимҷон Умедҷонович', 'Анақулов Нозимҷон Умедҷонович', '2025010003', '2025010003', NULL, NULL, 0, NULL, 1, NULL, NULL, NULL, NULL, 1, 1, 1, 'Падар - Модар -', NULL, NULL, NULL, 1, NULL, NULL, 3, 4, '2025-05-15 09:36:58', 24, 2),
(24, 'Азизов Акбарҷон Қулназарович', 'Азизов Акбарҷон Қулназарович', '2025010002', '2025010002', NULL, NULL, 0, NULL, 1, NULL, NULL, NULL, NULL, 1, 1, 1, 'Падар - Модар -', NULL, NULL, NULL, 1, NULL, NULL, 3, 4, '2025-05-15 09:36:35', 24, 2),
(23, 'Абдурамонова Нафиса Убайдуллоевна', 'Абдурамонова Нафиса Убайдуллоевна', '2025010001', '2025010001', NULL, NULL, 0, NULL, 0, NULL, NULL, NULL, NULL, 1, 1, 1, 'Падар - Модар -', NULL, NULL, NULL, 1, NULL, NULL, 3, 4, '2025-05-15 08:47:07', 24, 2),
(40, 'Ҷаборзода Маҳмуд Шодиқурбон', 'Ҷаборзода Маҳмуд Шодиқурбон', '2025010018', '2025010018', NULL, NULL, 0, NULL, 1, NULL, NULL, NULL, NULL, 1, 1, 1, 'Падар - Модар -', NULL, NULL, NULL, 1, NULL, NULL, 3, 4, '2025-05-15 10:19:43', 24, 2),
(41, 'Шохуморова Ҳоҷатбегим Шаҳриёровна', 'Шохуморова Ҳоҷатбегим Шаҳриёровна', '2025010019', '2025010019', NULL, NULL, 0, NULL, 0, NULL, NULL, NULL, NULL, 1, 1, 1, 'Падар - Модар -', NULL, NULL, NULL, 1, NULL, NULL, 3, 4, '2025-05-15 10:20:06', 24, 2),
(42, 'Ҷуъмахонзода Муҳаммадҷон', 'Ҷуъмахонзода Муҳаммадҷон', '2025010020', '2025010020', NULL, NULL, 0, NULL, 1, NULL, NULL, NULL, NULL, 1, 1, 1, 'Падар - Модар -', NULL, NULL, NULL, 1, NULL, NULL, 3, 4, '2025-05-15 10:20:30', 24, 2),
(43, 'Бозоров Масрур Ҳикматуллоевич', 'Бозоров Масрур Ҳикматуллоевич', '2025010021', '2025010021', NULL, NULL, 0, NULL, 1, NULL, NULL, NULL, NULL, 1, 1, 1, 'Падар - Модар -', NULL, NULL, NULL, 1, NULL, NULL, 3, 4, '2025-05-15 10:20:57', 24, 2),
(44, 'Назарзода Алиҷон Муҳаммадвали', 'Назарзода Алиҷон Муҳаммадвали', '2025010022', '2025010022', NULL, NULL, 0, NULL, 1, NULL, NULL, NULL, NULL, 1, 1, 1, 'Падар - Модар -', NULL, NULL, NULL, 1, NULL, NULL, 3, 4, '2025-05-15 10:21:42', 24, 2),
(45, 'Абдуллоев Муҳаммадамин Мадаминович', 'Абдуллоев Муҳаммадамин Мадаминович', '2025010023', '2025010023', NULL, NULL, 0, NULL, 1, NULL, NULL, NULL, NULL, 1, 1, 1, 'Падар - Модар -', NULL, NULL, NULL, 1, NULL, NULL, 3, 4, '2025-05-15 10:25:13', 24, 2),
(46, 'Асозода Мухаммадисо Барҳом', 'Асозода Мухаммадисо Барҳом', '2025010024', '2025010024', NULL, NULL, 0, NULL, 1, NULL, NULL, NULL, NULL, 1, 1, 1, 'Падар - Модар -', NULL, NULL, NULL, 1, NULL, NULL, 3, 4, '2025-05-15 10:25:37', 24, 2),
(47, 'Зикриёи Муродали Сафарзода', 'Зикриёи Муродали Сафарзода', '2025010025', '2025010025', NULL, NULL, 0, NULL, 1, NULL, NULL, NULL, NULL, 1, 1, 1, 'Падар - Модар -', NULL, NULL, NULL, 1, NULL, NULL, 3, 4, '2025-05-15 10:26:00', 24, 2),
(48, 'Имомқулзода Фаворис Уктамҷон', 'Имомқулзода Фаворис Уктамҷон', '2025010026', '2025010026', NULL, NULL, 0, NULL, 1, NULL, NULL, NULL, NULL, 1, 1, 1, 'Падар - Модар -', NULL, NULL, NULL, 1, NULL, NULL, 3, 4, '2025-05-15 10:26:21', 24, 2),
(49, 'Камолов Сунаътулло Маҳмадрозиқович', 'Камолов Сунаътулло Маҳмадрозиқович', '2025010027', '2025010027', NULL, NULL, 0, NULL, 1, NULL, NULL, NULL, NULL, 1, 1, 1, 'Падар - Модар -', NULL, NULL, NULL, 1, NULL, NULL, 3, 4, '2025-05-15 10:26:42', 24, 2),
(50, 'Маматқулов Умаралӣ Бозорович', 'Маматқулов Умаралӣ Бозорович', '2025010028', '2025010028', NULL, NULL, 0, NULL, 1, NULL, NULL, NULL, NULL, 1, 1, 1, 'Падар - Модар -', NULL, NULL, NULL, 1, NULL, NULL, 3, 4, '2025-05-15 10:27:04', 24, 2),
(51, 'Мирзоев Абубакр Зайдуллоевич', 'Мирзоев Абубакр Зайдуллоевич', '2025010029', '2025010029', NULL, NULL, 0, NULL, 1, NULL, NULL, NULL, NULL, 1, 1, 1, 'Падар - Модар -', NULL, NULL, NULL, 1, NULL, NULL, 3, 4, '2025-05-15 10:27:27', 24, 2),
(52, 'Мирзоев Фаррух Ҷамшедович', 'Мирзоев Фаррух Ҷамшедович', '2025010030', '2025010030', NULL, NULL, 0, NULL, 1, NULL, NULL, NULL, NULL, 1, 1, 1, 'Падар - Модар -', NULL, NULL, NULL, 1, NULL, NULL, 3, 4, '2025-05-15 10:27:46', 24, 2),
(53, 'Мирзоева Наргис Давлаталиевна', 'Мирзоева Наргис Давлаталиевна', '2025010031', '2025010031', NULL, NULL, 0, NULL, 0, NULL, NULL, NULL, NULL, 1, 1, 1, 'Падар - Модар -', NULL, NULL, NULL, 1, NULL, NULL, 3, 4, '2025-05-15 10:28:08', 24, 2),
(54, 'Наботов Султонҷон Назриевич', 'Наботов Султонҷон Назриевич', '2025010032', '2025010032', NULL, NULL, 0, NULL, 1, NULL, NULL, NULL, NULL, 1, 1, 1, 'Падар - Модар -', NULL, NULL, NULL, 1, NULL, NULL, 3, 4, '2025-05-15 10:28:30', 24, 2),
(55, 'Пирмаҳмадзода Эмомали Зафар', 'Пирмаҳмадзода Эмомали Зафар', '2025010033', '2025010033', NULL, NULL, 0, NULL, 1, NULL, NULL, NULL, NULL, 1, 1, 1, 'Падар - Модар -', NULL, NULL, NULL, 1, NULL, NULL, 3, 4, '2025-05-15 10:28:48', 24, 2),
(56, 'Пушкашова Ганҷина Дилдорбековна', 'Пушкашова Ганҷина Дилдорбековна', '2025010034', '2025010034', NULL, NULL, 0, NULL, 0, NULL, NULL, NULL, NULL, 1, 1, 1, 'Падар - Модар -', NULL, NULL, NULL, 1, NULL, NULL, 3, 4, '2025-05-15 10:29:05', 24, 2),
(57, 'Раҳимова Шоҳзода Комиловна', 'Раҳимова Шоҳзода Комиловна', '2025010035', '2025010035', NULL, NULL, 0, NULL, 0, NULL, NULL, NULL, NULL, 1, 1, 1, 'Падар - Модар -', NULL, NULL, NULL, 1, NULL, NULL, 3, 4, '2025-05-15 10:29:26', 24, 2),
(58, 'Раҷабов Умед Ҷ', 'Раҷабов Умед Ҷ', '2025010036', '2025010036', NULL, NULL, 0, NULL, 1, NULL, NULL, NULL, NULL, 1, 1, 1, 'Падар - Модар -', NULL, NULL, NULL, 1, NULL, NULL, 3, 4, '2025-05-15 10:29:45', 24, 2),
(59, 'Хабибова Фарзина Султоновна', 'Хабибова Фарзина Султоновна', '2025010037', '2025010037', NULL, NULL, 0, NULL, 0, NULL, NULL, NULL, NULL, 1, 1, 1, 'Падар - Модар -', NULL, NULL, NULL, 1, NULL, NULL, 3, 4, '2025-05-15 10:30:02', 24, 2),
(60, 'Холзода Хуҷаиброим Гулҳамад', 'Холзода Хуҷаиброим Гулҳамад', '2025010038', '2025010038', NULL, NULL, 0, NULL, 1, NULL, NULL, NULL, NULL, 1, 1, 1, 'Падар - Модар -', NULL, NULL, NULL, 1, NULL, NULL, 3, 4, '2025-05-15 10:30:27', 24, 2),
(61, 'Қаландарзода Амин Исҳоқ', 'Қаландарзода Амин Исҳоқ', '2025010039', '2025010039', NULL, NULL, 0, NULL, 1, NULL, NULL, NULL, NULL, 1, 1, 1, 'Падар - Модар -', NULL, NULL, NULL, 1, NULL, NULL, 3, 4, '2025-05-15 10:30:56', 24, 2),
(62, 'Шарипов Набиҷон Маҳмадюсуфович', 'Шарипов Набиҷон Маҳмадюсуфович', '2025010040', '2025010040', NULL, NULL, 0, NULL, 1, NULL, NULL, NULL, NULL, 1, 1, 1, 'Падар - Модар -', NULL, NULL, NULL, 1, NULL, NULL, 3, 4, '2025-05-15 10:31:24', 24, 2),
(63, 'Сафарзода Аъзамшоҳи Саидшариф', 'Сафарзода Аъзамшоҳи Саидшариф', '2025010041', '2025010041', NULL, NULL, 0, NULL, 1, NULL, NULL, NULL, NULL, 1, 1, 1, 'Падар - Модар -', NULL, NULL, NULL, 1, NULL, NULL, 3, 4, '2025-05-15 10:31:58', 24, 2),
(64, 'Дониёров Зайнур', 'Дониёров Зайнур', '2025010042', '2025010042', NULL, NULL, 0, '', 1, NULL, NULL, NULL, NULL, 1, 1, 1, 'Падар - Модар -', NULL, NULL, 1, 1, NULL, NULL, 3, 4, '2025-05-15 10:32:27', 24, 2),
(65, 'Миров Вайсиддин Муҳриддинович', 'Миров Вайсиддин Муҳриддинович', '2025010043', '2025010043', NULL, NULL, 0, NULL, 1, NULL, NULL, NULL, NULL, 1, 1, 1, 'Падар - Модар -', NULL, NULL, NULL, 1, NULL, NULL, 3, 4, '2025-05-15 10:36:20', 24, 2),
(66, 'Набизода Фазлиддин Авродхон', 'Набизода Фазлиддин Авродхон', '2025010044', '2025010044', NULL, NULL, 0, NULL, 1, NULL, NULL, NULL, NULL, 1, 1, 1, 'Падар - Модар -', NULL, NULL, NULL, 1, NULL, NULL, 3, 4, '2025-05-15 10:36:38', 24, 2),
(67, 'Раҷабалиев Маҳмуд Парвизович', 'Раҷабалиев Маҳмуд Парвизович', '2025010045', '2025010045', NULL, NULL, 0, NULL, 1, NULL, NULL, NULL, NULL, 1, 1, 1, 'Падар - Модар -', NULL, NULL, NULL, 1, NULL, NULL, 3, 4, '2025-05-15 10:37:00', 24, 2),
(68, 'Сафарализода Меҳроб Хушвахт', 'Сафарализода Меҳроб Хушвахт', '2025010046', '2025010046', NULL, NULL, 0, '', 1, NULL, NULL, NULL, NULL, 1, 1, 1, 'Падар - Модар -', NULL, NULL, 1, 1, NULL, NULL, 3, 4, '2025-05-15 10:37:15', 24, 2),
(69, 'Абдуллоева Анисабону Баҳриддиновна', 'Абдуллоева Анисабону Баҳриддиновна', '2025010047', '2025010047', NULL, NULL, 0, NULL, 0, NULL, NULL, NULL, NULL, 1, 1, 1, 'Падар - Модар -', NULL, NULL, NULL, 1, NULL, NULL, 3, 4, '2025-05-15 10:44:18', 24, 2),
(70, 'Абдуллозода Комрон Алишер', 'Абдуллозода Комрон Алишер', '2025010048', '2025010048', NULL, NULL, 0, NULL, 1, NULL, NULL, NULL, NULL, 1, 1, 1, 'Падар - Модар -', NULL, NULL, NULL, 1, NULL, NULL, 3, 4, '2025-05-15 10:44:39', 24, 2),
(71, 'Аброров Рамазон Қуватбекович', 'Аброров Рамазон Қуватбекович', '2025010049', '2025010049', NULL, NULL, 0, NULL, 1, NULL, NULL, NULL, NULL, 1, 1, 1, 'Падар - Модар -', NULL, NULL, NULL, 1, NULL, NULL, 3, 4, '2025-05-15 10:45:06', 24, 2),
(72, 'Ғуломов Рустам Икромиддинович', 'Ғуломов Рустам Икромиддинович', '2025010050', '2025010050', NULL, NULL, 0, NULL, 1, NULL, NULL, NULL, NULL, 1, 1, 1, 'Падар - Модар -', NULL, NULL, NULL, 1, NULL, NULL, 3, 4, '2025-05-15 10:45:27', 24, 2),
(73, 'Исмоилзода Идимох Исуф', 'Исмоилзода Идимох Исуф', '2025010051', '2025010051', NULL, NULL, 0, '', 0, NULL, NULL, NULL, NULL, 1, 1, 1, 'Падар - Модар -', NULL, NULL, 1, 1, NULL, NULL, 3, 4, '2025-05-15 10:45:49', 24, 2),
(74, 'Кабутзода Ҳадиятулло Абдухалил', 'Кабутзода Ҳадиятулло Абдухалил', '2025010052', '2025010052', NULL, NULL, 0, NULL, 1, NULL, NULL, NULL, NULL, 1, 1, 1, 'Падар - Модар -', NULL, NULL, NULL, 1, NULL, NULL, 3, 4, '2025-05-15 10:47:03', 24, 2),
(75, 'Қамчинов Суҳроб Рустамович', 'Қамчинов Суҳроб Рустамович', '2025010053', '2025010053', NULL, NULL, 0, NULL, 1, NULL, NULL, NULL, NULL, 1, 1, 1, 'Падар - Модар -', NULL, NULL, NULL, 1, NULL, NULL, 3, 4, '2025-05-15 10:47:22', 24, 2),
(76, 'Қосимов Билолидин Тоҷиддинович', 'Қосимов Билолидин Тоҷиддинович', '2025000001', '2025000001', NULL, NULL, 0, NULL, 1, NULL, NULL, NULL, NULL, 1, 1, 1, 'Падар - Модар -', NULL, NULL, NULL, 1, NULL, NULL, 3, 4, '2025-05-15 10:47:38', 24, 2),
(77, 'Қувватзода Самариддин Ҳасан', 'Қувватзода Самариддин Ҳасан', '2025000002', '2025000002', NULL, NULL, 0, NULL, 1, NULL, NULL, NULL, NULL, 1, 1, 1, 'Падар - Модар -', NULL, NULL, NULL, 1, NULL, NULL, 3, 4, '2025-05-15 10:48:02', 24, 2),
(78, 'Назарзода Шарифчон Абдувохид', 'Назарзода Шарифчон Абдувохид', '2025000003', '2025000003', NULL, NULL, 0, NULL, 1, NULL, NULL, NULL, NULL, 1, 1, 1, 'Падар - Модар -', NULL, NULL, NULL, 1, NULL, NULL, 3, 4, '2025-05-15 10:48:21', 24, 2),
(79, 'Наимов Умар Шоҳмуродович', 'Наимов Умар Шоҳмуродович', '2025000004', '2025000004', NULL, NULL, 0, NULL, 1, NULL, NULL, NULL, NULL, 1, 1, 1, 'Падар - Модар -', NULL, NULL, NULL, 1, NULL, NULL, 3, 4, '2025-05-15 10:48:39', 24, 2),
(80, 'Нозанини Чамшед', 'Нозанини Чамшед', '2025000005', '2025000005', NULL, NULL, 0, NULL, 0, NULL, NULL, NULL, NULL, 1, 1, 1, 'Падар - Модар -', NULL, NULL, NULL, 1, NULL, NULL, 3, 4, '2025-05-15 10:49:05', 24, 2),
(81, 'Саидов Фазлиддин Ҷумаевич', 'Саидов Фазлиддин Ҷумаевич', '2025000006', '2025000006', NULL, NULL, 0, NULL, 1, NULL, NULL, NULL, NULL, 1, 1, 1, 'Падар - Модар -', NULL, NULL, NULL, 1, NULL, NULL, 3, 4, '2025-05-15 10:49:26', 24, 2),
(82, 'Сафарзода Холмуҳамад Абдусалом', 'Сафарзода Холмуҳамад Абдусалом', '2025000007', '2025000007', NULL, NULL, 0, NULL, 1, NULL, NULL, NULL, NULL, 1, 1, 1, 'Падар - Модар -', NULL, NULL, NULL, 1, NULL, NULL, 3, 4, '2025-05-15 10:49:44', 24, 2),
(83, 'Фариддуни Сайҷафар', 'Фариддуни Сайҷафар', '2025000008', '2025000008', NULL, NULL, 0, NULL, 1, NULL, NULL, NULL, NULL, 1, 1, 1, 'Падар - Модар -', NULL, NULL, NULL, 1, NULL, NULL, 3, 4, '2025-05-15 10:50:08', 24, 2),
(84, 'Фозилова Камила Мироншоевна', 'Фозилова Камила Мироншоевна', '2025000009', '2025000009', NULL, NULL, 0, NULL, 0, NULL, NULL, NULL, NULL, 1, 1, 1, 'Падар - Модар -', NULL, NULL, NULL, 1, NULL, NULL, 3, 4, '2025-05-15 10:50:30', 24, 2),
(85, 'Хабибзода Бахтовари Мухиддин', 'Хабибзода Бахтовари Мухиддин', '2025000010', '2025000010', NULL, NULL, 0, NULL, 1, NULL, NULL, NULL, NULL, 1, 1, 1, 'Падар - Модар -', NULL, NULL, NULL, 1, NULL, NULL, 3, 4, '2025-05-15 10:50:59', 24, 2),
(86, 'Хошоков Муҳаммадамин Раҷабоевич', 'Хошоков Муҳаммадамин Раҷабоевич', '2025000011', '2025000011', NULL, NULL, 0, NULL, 1, NULL, NULL, NULL, NULL, 1, 1, 1, 'Падар - Модар -', NULL, NULL, NULL, 1, NULL, NULL, 3, 4, '2025-05-15 10:51:29', 24, 2),
(87, 'Ҷобирзода Маҳмадали Исломуддин', 'Ҷобирзода Маҳмадали Исломуддин', '2025000012', '2025000012', NULL, NULL, 0, NULL, 1, NULL, NULL, NULL, NULL, 1, 1, 1, 'Падар - Модар -', NULL, NULL, NULL, 1, NULL, NULL, 3, 4, '2025-05-15 10:51:52', 24, 2),
(88, 'Шарифзода Суҳробҷон Олимшоҳ', 'Шарифзода Суҳробҷон Олимшоҳ', '2025000013', '2025000013', NULL, NULL, 0, NULL, 1, NULL, NULL, NULL, NULL, 1, 1, 1, 'Падар - Модар -', NULL, NULL, NULL, 1, NULL, NULL, 3, 4, '2025-05-15 10:52:15', 24, 2),
(89, 'Ярханов Рахимҷон Наимҷонович', 'Ярханов Рахимҷон Наимҷонович', '2025000014', '2025000014', NULL, NULL, 0, NULL, 1, NULL, NULL, NULL, NULL, 1, 1, 1, 'Падар - Модар -', NULL, NULL, NULL, 1, NULL, NULL, 3, 4, '2025-05-15 10:52:32', 24, 2),
(90, 'Абдуқаҳоров Исломҷон Абдулҳакимович', 'Абдуқаҳоров Исломҷон Абдулҳакимович', '2025000015', '2025000015', NULL, NULL, 0, NULL, 1, NULL, NULL, NULL, NULL, 1, 1, 1, 'Падар - Модар -', NULL, NULL, NULL, 1, NULL, NULL, 3, 4, '2025-05-15 10:54:52', 24, 2),
(91, 'Алишеров Нур Алишерович', 'Алишеров Нур Алишерович', '2025000016', '2025000016', NULL, NULL, 0, NULL, 1, NULL, NULL, NULL, NULL, 1, 1, 1, 'Падар - Модар -', NULL, NULL, NULL, 1, NULL, NULL, 3, 4, '2025-05-15 10:55:25', 24, 2),
(92, 'Ашуров Қодирҷон Олимҷонович', 'Ашуров Қодирҷон Олимҷонович', '2025000017', '2025000017', NULL, NULL, 0, NULL, 1, NULL, NULL, NULL, NULL, 1, 1, 1, 'Падар - Модар -', NULL, NULL, NULL, 1, NULL, NULL, 3, 4, '2025-05-15 10:56:29', 24, 2),
(93, 'Бобохонов Муртазо', 'Бобохонов Муртазо', '2025000018', '2025000018', NULL, NULL, 0, NULL, 1, NULL, NULL, NULL, NULL, 1, 1, 1, 'Падар - Модар -', NULL, NULL, NULL, 1, NULL, NULL, 3, 4, '2025-05-15 10:56:48', 24, 2),
(94, 'Зокирзода Қудрат Абдумуслим', 'Зокирзода Қудрат Абдумуслим', '2025000019', '2025000019', NULL, NULL, 0, NULL, 1, NULL, NULL, NULL, NULL, 1, 1, 1, 'Падар - Модар -', NULL, NULL, NULL, 1, NULL, NULL, 3, 4, '2025-05-15 10:57:04', 24, 2),
(95, 'Камолзода Амруллои Олимхон', 'Камолзода Амруллои Олимхон', '2025000020', '2025000020', NULL, NULL, 0, NULL, 1, NULL, NULL, NULL, NULL, 1, 1, 1, 'Падар - Модар -', NULL, NULL, NULL, 1, NULL, NULL, 3, 4, '2025-05-15 10:57:22', 24, 2),
(96, 'Каримзода Хушназар', 'Каримзода Хушназар', '2025000021', '2025000021', NULL, NULL, 0, NULL, 1, NULL, NULL, NULL, NULL, 1, 1, 1, 'Падар - Модар -', NULL, NULL, NULL, 1, NULL, NULL, 3, 4, '2025-05-15 10:57:39', 24, 2),
(97, 'Қурбонов Муҳаммадшариф Муҳубидинович', 'Қурбонов Муҳаммадшариф Муҳубидинович', '2025000022', '2025000022', NULL, NULL, 0, NULL, 1, NULL, NULL, NULL, NULL, 1, 1, 1, 'Падар - Модар -', NULL, NULL, NULL, 1, NULL, NULL, 3, 4, '2025-05-15 10:59:27', 24, 2),
(98, 'Назаров Шаҳром Ашуралиеввич', 'Назаров Шаҳром Ашуралиеввич', '2025000023', '2025000023', NULL, NULL, 0, NULL, 1, NULL, NULL, NULL, NULL, 1, 1, 1, 'Падар - Модар -', NULL, NULL, NULL, 1, NULL, NULL, 3, 4, '2025-05-15 10:59:56', 24, 2),
(99, 'Расулов Ёқубҷон Алишерович', 'Расулов Ёқубҷон Алишерович', '2025000024', '2025000024', NULL, NULL, 0, NULL, 1, NULL, NULL, NULL, NULL, 1, 1, 1, 'Падар - Модар -', NULL, NULL, NULL, 1, NULL, NULL, 3, 4, '2025-05-15 11:00:14', 24, 2),
(100, 'Раҷабова Фархунда Муҳаммадовна', 'Раҷабова Фархунда Муҳаммадовна', '2025000025', '2025000025', NULL, NULL, 0, NULL, 0, NULL, NULL, NULL, NULL, 1, 1, 1, 'Падар - Модар -', NULL, NULL, NULL, 1, NULL, NULL, 3, 4, '2025-05-15 11:01:15', 24, 2),
(101, 'Саидов Зоиршоҳ', 'Саидов Зоиршоҳ', '2025000026', '2025000026', NULL, NULL, 0, NULL, 1, NULL, NULL, NULL, NULL, 1, 1, 1, 'Падар - Модар -', NULL, NULL, NULL, 1, NULL, NULL, 3, 4, '2025-05-15 11:01:46', 24, 2),
(102, 'Сатторов Муҳаммад Шоҳимардонович', 'Сатторов Муҳаммад Шоҳимардонович', '2025000027', '2025000027', NULL, NULL, 0, NULL, 1, NULL, NULL, NULL, NULL, 1, 1, 1, 'Падар - Модар -', NULL, NULL, NULL, 1, NULL, NULL, 3, 4, '2025-05-15 11:02:17', 24, 2),
(103, 'Сафарзода Саидмаҳмуд', 'Сафарзода Саидмаҳмуд', '2025000028', '2025000028', NULL, NULL, 0, NULL, 1, NULL, NULL, NULL, NULL, 1, 1, 1, 'Падар - Модар -', NULL, NULL, NULL, 1, NULL, NULL, 3, 4, '2025-05-15 11:02:40', 24, 2),
(104, 'Сафарзода Саъдӣ Шарафиддин', 'Сафарзода Саъдӣ Шарафиддин', '2025000029', '2025000029', NULL, NULL, 0, NULL, 1, NULL, NULL, NULL, NULL, 1, 1, 1, 'Падар - Модар -', NULL, NULL, NULL, 1, NULL, NULL, 3, 4, '2025-05-15 11:02:57', 24, 2),
(105, 'Тураев Шаҳбоз Дилшодович', 'Тураев Шаҳбоз Дилшодович', '2025000030', '2025000030', NULL, NULL, 0, NULL, 1, NULL, NULL, NULL, NULL, 1, 1, 1, 'Падар - Модар -', NULL, NULL, NULL, 1, NULL, NULL, 3, 4, '2025-05-15 11:03:18', 24, 2),
(106, 'Фаридуни Убайдулло', 'Фаридуни Убайдулло', '2025000031', '2025000031', NULL, NULL, 0, NULL, 1, NULL, NULL, NULL, NULL, 1, 1, 1, 'Падар - Модар -', NULL, NULL, NULL, 1, NULL, NULL, 3, 4, '2025-05-15 11:03:50', 24, 2),
(107, 'Ҳавлоев Фарух Тоҳирҷонович', 'Ҳавлоев Фарух Тоҳирҷонович', '2025000032', '2025000032', NULL, NULL, 0, NULL, 1, NULL, NULL, NULL, NULL, 1, 1, 1, 'Падар - Модар -', NULL, NULL, NULL, 1, NULL, NULL, 3, 4, '2025-05-15 11:04:14', 24, 2),
(108, 'Ҳасанов Меҳроб Абдусаломович', 'Ҳасанов Меҳроб Абдусаломович', '2025000033', '2025000033', NULL, NULL, 0, NULL, 1, NULL, NULL, NULL, NULL, 1, 1, 1, 'Падар - Модар -', NULL, NULL, NULL, 1, NULL, NULL, 3, 4, '2025-05-15 11:04:35', 24, 2),
(109, 'Ҳусейнов Сафарбек Ҳамидуллоевич', 'Ҳусейнов Сафарбек Ҳамидуллоевич', '2025000034', '2025000034', NULL, NULL, 0, NULL, 1, NULL, NULL, NULL, NULL, 1, 1, 1, 'Падар - Модар -', NULL, NULL, NULL, 1, NULL, NULL, 3, 4, '2025-05-15 11:07:06', 24, 2),
(110, 'Ҳусенов Муҳаммадшо Қутбидинович', 'Ҳусенов Муҳаммадшо Қутбидинович', '2025000035', '2025000035', NULL, NULL, 0, NULL, 1, NULL, NULL, NULL, NULL, 1, 1, 1, 'Падар - Модар -', NULL, NULL, NULL, 1, NULL, NULL, 3, 4, '2025-05-15 11:07:30', 24, 2),
(111, 'Шайхов Насимҷон Муқимович', 'Шайхов Насимҷон Муқимович', '2025000036', '2025000036', NULL, NULL, 0, NULL, 1, NULL, NULL, NULL, NULL, 1, 1, 1, 'Падар - Модар -', NULL, NULL, NULL, 1, NULL, NULL, 3, 4, '2025-05-15 11:07:52', 24, 2),
(112, 'Шарипов Абубакр Давлатхоҷаевич', 'Шарипов Абубакр Давлатхоҷаевич', '2025000037', '2025000037', NULL, NULL, 0, '', 1, NULL, NULL, NULL, NULL, 1, 1, 1, 'Падар - Модар -', NULL, NULL, 1, 1, NULL, NULL, 3, 4, '2025-05-15 11:08:13', 24, 2),
(113, 'Шарифзода Рамазон Иброҳим', 'Шарифзода Рамазон Иброҳим', '2025000038', '2025000038', NULL, NULL, 0, NULL, 1, NULL, NULL, NULL, NULL, 1, 1, 1, 'Падар - Модар -', NULL, NULL, NULL, 1, NULL, NULL, 3, 4, '2025-05-15 11:09:42', 24, 2),
(114, 'Шаҳруллоҳи Одил', 'Шаҳруллоҳи Одил', '2025000039', '2025000039', NULL, NULL, 0, NULL, 1, NULL, NULL, NULL, NULL, 1, 1, 1, 'Падар - Модар -', NULL, NULL, NULL, 1, NULL, NULL, 3, 4, '2025-05-15 11:11:26', 24, 2),
(115, 'Эмомзода Дилафруз Намозали', 'Эмомзода Дилафруз Намозали', '2025000040', '2025000040', NULL, NULL, 0, NULL, 0, NULL, NULL, NULL, NULL, 1, 1, 1, 'Падар - Модар -', NULL, NULL, NULL, 1, NULL, NULL, 3, 4, '2025-05-15 11:12:22', 24, 2),
(116, 'Манонов Сорбон', 'Манонов Сорбон', '2025000041', '2025000041', NULL, NULL, 0, NULL, 1, NULL, NULL, NULL, NULL, 1, 1, 1, 'Падар - Модар -', NULL, NULL, NULL, 1, NULL, NULL, 3, 4, '2025-05-15 11:13:03', 24, 2),
(117, 'Гулов Раҷабмаҳмад', 'Гулов Раҷабмаҳмад', '2025000042', '2025000042', NULL, NULL, 0, NULL, 1, NULL, NULL, NULL, NULL, 1, 1, 1, 'Падар - Модар -', NULL, NULL, NULL, 1, NULL, NULL, 3, 4, '2025-05-15 11:13:53', 24, 2),
(118, 'Ҷабборов Шукруллоҳ Фатҳуллоевич', 'Ҷабборов Шукруллоҳ Фатҳуллоевич', '2025000043', '2025000043', NULL, NULL, 0, NULL, 1, NULL, NULL, NULL, NULL, 1, 1, 1, 'Падар - Модар -', NULL, NULL, NULL, 1, NULL, NULL, 3, 4, '2025-05-15 11:14:26', 24, 2),
(119, 'Абдураҳимзода Мухаммадёсин Носир', 'Абдураҳимзода Мухаммадёсин Носир', '2025000044', '2025000044', NULL, NULL, 0, NULL, 1, NULL, NULL, NULL, NULL, 1, 1, 1, 'Падар - Модар -', NULL, NULL, NULL, 1, NULL, NULL, 3, 4, '2025-05-15 11:15:55', 24, 2),
(120, 'Акобирзода Хаёмиддин Нурулло', 'Акобирзода Хаёмиддин Нурулло', '2025000045', '2025000045', NULL, NULL, 0, NULL, 1, NULL, NULL, NULL, NULL, 1, 1, 1, 'Падар - Модар -', NULL, NULL, NULL, 1, NULL, NULL, 3, 4, '2025-05-15 11:16:19', 24, 2),
(121, 'Ахмадчони Саймуддин', 'Ахмадчони Саймуддин', '2025000046', '2025000046', NULL, NULL, 0, NULL, 1, NULL, NULL, NULL, NULL, 1, 1, 1, 'Падар - Модар -', NULL, NULL, NULL, 1, NULL, NULL, 3, 4, '2025-05-15 11:16:39', 24, 2),
(122, 'Давлатов Раҷабали Рустамҷонович', 'Давлатов Раҷабали Рустамҷонович', '2025000047', '2025000047', NULL, NULL, 0, '', 1, NULL, NULL, NULL, NULL, 1, 1, 1, 'Падар - Модар -', NULL, NULL, 1, 1, NULL, NULL, 3, 4, '2025-05-15 11:17:06', 24, 2),
(123, 'Исоев Мухибулло Фуркатжонович', 'Исоев Мухибулло Фуркатжонович', '2025000048', '2025000048', NULL, NULL, 0, NULL, 1, NULL, NULL, NULL, NULL, 1, 1, 1, 'Падар - Модар -', NULL, NULL, NULL, 1, NULL, NULL, 3, 4, '2025-05-15 11:17:27', 24, 2),
(124, 'Меликзода Илҳомуддин Шамсулло', 'Меликзода Илҳомуддин Шамсулло', '2025000049', '2025000049', NULL, NULL, 0, NULL, 1, NULL, NULL, NULL, NULL, 1, 1, 1, 'Падар - Модар -', NULL, NULL, NULL, 1, NULL, NULL, 3, 4, '2025-05-15 11:17:49', 24, 2),
(125, 'Насуллоева Тутёбегим Насуллоевна', 'Насуллоева Тутёбегим Насуллоевна', '2025000050', '2025000050', NULL, NULL, 0, NULL, 0, NULL, NULL, NULL, NULL, 1, 1, 1, 'Падар - Модар -', NULL, NULL, NULL, 1, NULL, NULL, 3, 4, '2025-05-15 11:18:10', 24, 2),
(126, 'Одинаев Илёс Шомудинович', 'Одинаев Илёс Шомудинович', '2025000051', '2025000051', NULL, NULL, 0, NULL, 1, NULL, NULL, NULL, NULL, 1, 1, 1, 'Падар - Модар -', NULL, NULL, NULL, 1, NULL, NULL, 3, 4, '2025-05-15 11:18:37', 24, 2),
(127, 'Парвинзода  Абрунисо Парвин', 'Парвинзода  Абрунисо Парвин', '2025000052', '2025000052', NULL, NULL, 0, NULL, 0, NULL, NULL, NULL, NULL, 1, 1, 1, 'Падар - Модар -', NULL, NULL, NULL, 1, NULL, NULL, 3, 4, '2025-05-15 11:19:01', 24, 2),
(128, 'Рафизода Муҳсин Муҳаммади', 'Рафизода Муҳсин Муҳаммади', '2025000053', '2025000053', NULL, NULL, 0, NULL, 1, NULL, NULL, NULL, NULL, 1, 1, 1, 'Падар - Модар -', NULL, NULL, NULL, 1, NULL, NULL, 3, 4, '2025-05-15 11:19:26', 24, 2),
(129, 'Раҳимов Мудасир Фарҳодович', 'Раҳимов Мудасир Фарҳодович', '2025000054', '2025000054', NULL, NULL, 0, NULL, 1, NULL, NULL, NULL, NULL, 1, 1, 1, 'Падар - Модар -', NULL, NULL, NULL, 1, NULL, NULL, 3, 4, '2025-05-15 11:19:47', 24, 2),
(130, 'Раҳимов Ҳайдаршоҳ Масъудович', 'Раҳимов Ҳайдаршоҳ Масъудович', '2025000055', '2025000055', NULL, NULL, 0, NULL, 1, NULL, NULL, NULL, NULL, 1, 1, 1, 'Падар - Модар -', NULL, NULL, NULL, 1, NULL, NULL, 3, 4, '2025-05-15 11:20:07', 24, 2),
(131, 'Раҳмонов Маҳфулло Шарифхонович', 'Раҳмонов Маҳфулло Шарифхонович', '2025000056', '2025000056', NULL, NULL, 0, NULL, 1, NULL, NULL, NULL, NULL, 1, 1, 1, 'Падар - Модар -', NULL, NULL, NULL, 1, NULL, NULL, 3, 4, '2025-05-15 11:22:50', 24, 2),
(132, 'Сангов Шаҳром Баҳромович', 'Сангов Шаҳром Баҳромович', '2025000057', '2025000057', NULL, NULL, 0, NULL, 1, NULL, NULL, NULL, NULL, 1, 1, 1, 'Падар - Модар -', NULL, NULL, NULL, 1, NULL, NULL, 3, 4, '2025-05-15 11:23:13', 24, 2),
(133, 'Сафаров Исмоил Ҳокимҷонович', 'Сафаров Исмоил Ҳокимҷонович', '2025000058', '2025000058', NULL, NULL, 0, NULL, 1, NULL, NULL, NULL, NULL, 1, 1, 1, 'Падар - Модар -', NULL, NULL, NULL, 1, NULL, NULL, 3, 4, '2025-05-15 11:23:32', 24, 2),
(134, 'Хушмуроди Сафархон', 'Хушмуроди Сафархон', '2025000059', '2025000059', NULL, NULL, 0, NULL, 1, NULL, NULL, NULL, NULL, 1, 1, 1, 'Падар - Модар -', NULL, NULL, NULL, 1, NULL, NULL, 3, 4, '2025-05-15 11:23:49', 24, 2),
(135, 'Ҳабибуллозода  Субҳон Давлатҷон', 'Ҳабибуллозода  Субҳон Давлатҷон', '2025000060', '2025000060', NULL, NULL, 0, NULL, 1, NULL, NULL, NULL, NULL, 1, 1, 1, 'Падар - Модар -', NULL, NULL, NULL, 1, NULL, NULL, 3, 4, '2025-05-15 11:24:17', 24, 2),
(136, 'Ҷалолов Суҳбатиллоҳ  Бахтибекович', 'Ҷалолов Суҳбатиллоҳ  Бахтибекович', '2025000061', '2025000061', NULL, NULL, 0, NULL, 1, NULL, NULL, NULL, NULL, 1, 1, 1, 'Падар - Модар -', NULL, NULL, NULL, 1, NULL, NULL, 3, 4, '2025-05-15 11:24:56', 24, 2),
(137, 'Саъидов Ёқубҷон Давлатбекович', 'Саъидов Ёқубҷон Давлатбекович', '2025000062', '2025000062', NULL, NULL, 0, NULL, 1, NULL, NULL, NULL, NULL, 1, 1, 1, 'Падар - Модар -', NULL, NULL, NULL, 1, NULL, NULL, 3, 4, '2025-05-15 11:37:22', 24, 2),
(138, 'Ҳасанов Шаҳобиддин Нозирович', 'Ҳасанов Шаҳобиддин Нозирович', '2025000063', '2025000063', NULL, NULL, 0, NULL, 1, NULL, NULL, NULL, NULL, 1, 1, 1, 'Падар - Модар -', NULL, NULL, NULL, 1, NULL, NULL, 3, 4, '2025-05-15 11:37:44', 24, 2),
(139, 'Шоинов Шоҳин Хуршедович', 'Шоинов Шоҳин Хуршедович', '2025000064', '2025000064', NULL, NULL, 0, NULL, 1, NULL, NULL, NULL, NULL, 1, 1, 1, 'Падар - Модар -', NULL, NULL, NULL, 1, NULL, NULL, 3, 4, '2025-05-15 11:38:16', 24, 2),
(140, 'Юсупов Саидҷон Камолович', 'Юсупов Саидҷон Камолович', '2025000065', '2025000065', NULL, NULL, 0, NULL, 1, NULL, NULL, NULL, NULL, 1, 1, 1, 'Падар - Модар -', NULL, NULL, NULL, 1, NULL, NULL, 3, 4, '2025-05-15 11:38:33', 24, 2),
(141, 'Юсуфзода Амирхон Шерхон', 'Юсуфзода Амирхон Шерхон', '2025000066', '2025000066', NULL, NULL, 0, NULL, 1, NULL, NULL, NULL, NULL, 1, 1, 1, 'Падар - Модар -', NULL, NULL, NULL, 1, NULL, NULL, 3, 4, '2025-05-15 11:38:51', 24, 2),
(142, 'Раҳмонов Иршод Толибшоевич', 'Раҳмонов Иршод Толибшоевич', '2025000067', '2025000067', NULL, NULL, 0, NULL, 1, NULL, NULL, NULL, NULL, 1, 1, 1, 'Падар - Модар -', NULL, NULL, NULL, 1, NULL, NULL, 3, 4, '2025-05-15 11:39:06', 24, 2),
(143, 'Раҳмонзода Муҳаммадҷон Раҷабали', 'Раҳмонзода Муҳаммадҷон Раҷабали', '2025000068', '2025000068', NULL, NULL, 0, NULL, 1, NULL, NULL, NULL, NULL, 1, 1, 1, 'Падар - Модар -', NULL, NULL, NULL, 1, NULL, NULL, 3, 4, '2025-05-15 11:39:22', 24, 2),
(144, 'Раҷабалиев Алиҷон Сайдахмадович', 'Раҷабалиев Алиҷон Сайдахмадович', '2025000069', '2025000069', NULL, NULL, 0, NULL, 1, NULL, NULL, NULL, NULL, 1, 1, 1, 'Падар - Модар -', NULL, NULL, NULL, 1, NULL, NULL, 3, 4, '2025-05-15 11:39:39', 24, 2),
(145, 'Қосимов Ҷаҳонмеҳр Ҷалолиддинович', 'Қосимов Ҷаҳонмеҳр Ҷалолиддинович', '2025000070', '2025000070', NULL, NULL, 0, NULL, 1, NULL, NULL, NULL, NULL, 1, 1, 1, 'Падар - Модар -', NULL, NULL, NULL, 1, NULL, NULL, 3, 4, '2025-05-15 11:39:55', 24, 2),
(146, 'Алиев Беҳзод Саймухторович', 'Алиев Беҳзод Саймухторович', '2025000071', '2025000071', NULL, NULL, 0, '', 1, NULL, NULL, NULL, NULL, 1, 1, 1, 'Падар - Модар -', NULL, NULL, 1, 1, NULL, NULL, 3, 4, '2025-05-15 12:00:57', 24, 2),
(147, 'Алиев Ҷаҳонгир Ҷонфидоевич', 'Алиев Ҷаҳонгир Ҷонфидоевич', '2025000072', '2025000072', NULL, NULL, 0, NULL, 1, NULL, NULL, NULL, NULL, 1, 1, 1, 'Падар - Модар -', NULL, NULL, NULL, 1, NULL, NULL, 3, 4, '2025-05-15 12:01:39', 24, 2),
(148, 'Алматов Саидхон Исмоилович', 'Алматов Саидхон Исмоилович', '2025000073', '2025000073', NULL, NULL, 0, NULL, 1, NULL, NULL, NULL, NULL, 1, 1, 1, 'Падар - Модар -', NULL, NULL, NULL, 1, NULL, NULL, 3, 4, '2025-05-15 12:14:45', 24, 2),
(149, 'Вадудов Орифшоҳ Анваршоҳевич', 'Вадудов Орифшоҳ Анваршоҳевич', '2025000074', '2025000074', NULL, NULL, 0, NULL, 1, NULL, NULL, NULL, NULL, 1, 1, 1, 'Падар - Модар -', NULL, NULL, NULL, 1, NULL, NULL, 3, 4, '2025-05-15 12:15:14', 24, 2),
(150, 'Гуреззода Аслиддин Вайсиддин', 'Гуреззода Аслиддин Вайсиддин', '2025000075', '2025000075', NULL, NULL, 0, NULL, 1, NULL, NULL, NULL, NULL, 1, 1, 1, 'Падар - Модар -', NULL, NULL, NULL, 1, NULL, NULL, 3, 4, '2025-05-15 12:17:30', 24, 2),
(151, 'Додхудоев Ҳилоли Русланович', 'Додхудоев Ҳилоли Русланович', '2025000076', '2025000076', NULL, NULL, 0, NULL, 1, NULL, NULL, NULL, NULL, 1, 1, 1, 'Падар - Модар -', NULL, NULL, NULL, 1, NULL, NULL, 3, 4, '2025-05-15 12:17:58', 24, 2),
(152, 'Доробекова Зуҳро Амидхоновна', 'Доробекова Зуҳро Амидхоновна', '2025000077', '2025000077', NULL, NULL, 0, NULL, 0, NULL, NULL, NULL, NULL, 1, 1, 1, 'Падар - Модар -', NULL, NULL, NULL, 1, NULL, NULL, 3, 4, '2025-05-15 12:18:18', 24, 2),
(153, 'Маҳмадшарифов Эҳсон Музаффарович', 'Маҳмадшарифов Эҳсон Музаффарович', '2025000078', '2025000078', NULL, NULL, 0, NULL, 1, NULL, NULL, NULL, NULL, 1, 1, 1, 'Падар - Модар -', NULL, NULL, NULL, 1, NULL, NULL, 3, 4, '2025-05-15 12:18:43', 24, 2),
(154, 'Мусофиров Умар  Умедҷонович', 'Мусофиров Умар  Умедҷонович', '2025000079', '2025000079', NULL, NULL, 0, NULL, 1, NULL, NULL, NULL, NULL, 1, 1, 1, 'Падар - Модар -', NULL, NULL, NULL, 1, NULL, NULL, 3, 4, '2025-05-15 12:19:52', 24, 2),
(155, 'Нематов Наимҷон Махсадуллоевич', 'Нематов Наимҷон Махсадуллоевич', '2025000080', '2025000080', NULL, NULL, 0, NULL, 1, NULL, NULL, NULL, NULL, 1, 1, 1, 'Падар - Модар -', NULL, NULL, NULL, 1, NULL, NULL, 3, 4, '2025-05-15 12:20:13', 24, 2),
(156, 'Одиназода Абдураҳим Абуднасим', 'Одиназода Абдураҳим Абуднасим', '2025000081', '2025000081', NULL, NULL, 0, NULL, 1, NULL, NULL, NULL, NULL, 1, 1, 1, 'Падар - Модар -', NULL, NULL, NULL, 1, NULL, NULL, 3, 4, '2025-05-15 12:20:31', 24, 2),
(157, 'Саидшоев Аюбҷон Исмоилович', 'Саидшоев Аюбҷон Исмоилович', '2025000082', '2025000082', NULL, NULL, 0, NULL, 1, NULL, NULL, NULL, NULL, 1, 1, 1, 'Падар - Модар -', NULL, NULL, NULL, 1, NULL, NULL, 3, 4, '2025-05-15 12:20:52', 24, 2),
(158, 'Сатторов Нурмаҳмад Холмуродович', 'Сатторов Нурмаҳмад Холмуродович', '2025000083', '2025000083', NULL, NULL, 0, NULL, 1, NULL, NULL, NULL, NULL, 1, 1, 1, 'Падар - Модар -', NULL, NULL, NULL, 1, NULL, NULL, 3, 4, '2025-05-15 12:21:12', 24, 2),
(159, 'Усмонов Аслиддин  Эргашалиевич', 'Усмонов Аслиддин  Эргашалиевич', '2025000084', '2025000084', NULL, NULL, 0, NULL, 1, NULL, NULL, NULL, NULL, 1, 1, 1, 'Падар - Модар -', NULL, NULL, NULL, 1, NULL, NULL, 3, 4, '2025-05-15 12:21:40', 24, 2),
(160, 'Ҳазратқулов Исломиддин Илҳомҷонович', 'Ҳазратқулов Исломиддин Илҳомҷонович', '2025000085', '2025000085', NULL, NULL, 0, NULL, 1, NULL, NULL, NULL, NULL, 1, 1, 1, 'Падар - Модар -', NULL, NULL, NULL, 1, NULL, NULL, 3, 4, '2025-05-15 12:22:07', 24, 2),
(161, 'Саипов Комрон Ҷалолидинович', 'Саипов Комрон Ҷалолидинович', '2025000086', '2025000086', NULL, NULL, 0, NULL, 1, NULL, NULL, NULL, NULL, 1, 1, 1, 'Падар - Модар -', NULL, NULL, NULL, 1, NULL, NULL, 3, 4, '2025-05-15 12:22:31', 24, 2),
(162, 'ҚурбоновШоҳрух', 'ҚурбоновШоҳрух', '2025000087', '2025000087', NULL, NULL, 0, NULL, 1, NULL, NULL, NULL, NULL, 1, 1, 1, 'Падар - Модар -', NULL, NULL, NULL, 1, NULL, NULL, 3, 4, '2025-05-15 12:22:51', 24, 2),
(163, 'Маҳмадов Давлатшо', 'Маҳмадов Давлатшо', '2025000088', '2025000088', NULL, NULL, 0, NULL, 1, NULL, NULL, NULL, NULL, 1, 1, 1, 'Падар - Модар -', NULL, NULL, NULL, 1, NULL, NULL, 3, 4, '2025-05-15 12:23:14', 24, 2),
(164, 'Ғуломсардаров Рамазон', 'Ғуломсардаров Рамазон', '2025000089', '2025000089', NULL, NULL, 0, NULL, 1, NULL, NULL, NULL, NULL, 1, 1, 1, 'Падар - Модар -', NULL, NULL, NULL, 1, NULL, NULL, 3, 4, '2025-05-15 12:23:45', 24, 2),
(165, 'Акобиров Аслиддин Фазлиддинович', 'Акобиров Аслиддин Фазлиддинович', '2025000090', '2025000090', NULL, NULL, 0, NULL, 1, NULL, NULL, NULL, NULL, 1, 1, 1, 'Падар - Модар -', NULL, NULL, NULL, 1, NULL, NULL, 3, 4, '2025-05-15 12:42:44', 24, 2),
(166, 'Амаков Абдумубин Абдумуқимович', 'Амаков Абдумубин Абдумуқимович', '2025000091', '2025000091', NULL, NULL, 0, NULL, 1, NULL, NULL, NULL, NULL, 1, 1, 1, 'Падар - Модар -', NULL, NULL, NULL, 1, NULL, NULL, 3, 4, '2025-05-15 12:43:09', 24, 2),
(167, 'Гулов Сомонҷон Баҳриддинович', 'Гулов Сомонҷон Баҳриддинович', '2025000092', '2025000092', NULL, NULL, 0, NULL, 1, NULL, NULL, NULL, NULL, 1, 1, 1, 'Падар - Модар -', NULL, NULL, NULL, 1, NULL, NULL, 3, 4, '2025-05-15 12:43:32', 24, 2),
(168, 'Ёров Акбар  Абдулазизович', 'Ёров Акбар  Абдулазизович', '2025000093', '2025000093', NULL, NULL, 0, NULL, 1, NULL, NULL, NULL, NULL, 1, 1, 1, 'Падар - Модар -', NULL, NULL, NULL, 1, NULL, NULL, 3, 4, '2025-05-15 12:43:50', 24, 2),
(169, 'Ёров Искандар Атоиддинович', 'Ёров Искандар Атоиддинович', '2025000094', '2025000094', NULL, NULL, 0, NULL, 1, NULL, NULL, NULL, NULL, 1, 1, 1, 'Падар - Модар -', NULL, NULL, NULL, 1, NULL, NULL, 3, 4, '2025-05-15 12:44:26', 24, 2),
(170, 'Иброҳимзода Ҳусейн', 'Иброҳимзода Ҳусейн', '2025000095', '2025000095', NULL, NULL, 0, NULL, 1, NULL, NULL, NULL, NULL, 1, 1, 1, 'Падар - Модар -', NULL, NULL, NULL, 1, NULL, NULL, 3, 4, '2025-05-15 12:44:54', 24, 2),
(171, 'Идиев Муслим Шуҳратович', 'Идиев Муслим Шуҳратович', '2025000096', '2025000096', NULL, NULL, 0, NULL, 1, NULL, NULL, NULL, NULL, 1, 1, 1, 'Падар - Модар -', NULL, NULL, NULL, 1, NULL, NULL, 3, 4, '2025-05-15 12:45:25', 24, 2),
(172, 'Қодиров Султон Улуғбекович', 'Қодиров Султон Улуғбекович', '2025000097', '2025000097', NULL, NULL, 0, NULL, 1, NULL, NULL, NULL, NULL, 1, 1, 1, 'Падар - Модар -', NULL, NULL, NULL, 1, NULL, NULL, 3, 4, '2025-05-15 12:45:54', 24, 2),
(173, 'Қурбонализода Насимхон Али', 'Қурбонализода Насимхон Али', '2025000098', '2025000098', NULL, NULL, 0, '', 1, NULL, NULL, NULL, NULL, 1, 1, 1, 'Падар - Модар -', NULL, NULL, 1, 1, NULL, NULL, 3, 4, '2025-05-15 12:46:19', 24, 2),
(174, 'Қурбонов Муҳаммадорзу Абдуҳакимович', 'Қурбонов Муҳаммадорзу Абдуҳакимович', '2025000099', '2025000099', NULL, NULL, 0, NULL, 1, NULL, NULL, NULL, NULL, 1, 1, 1, 'Падар - Модар -', NULL, NULL, NULL, 1, NULL, NULL, 3, 4, '2025-05-15 12:47:27', 24, 2),
(175, 'Қурбонов Яҳё Зикриёевич', 'Қурбонов Яҳё Зикриёевич', '2025000100', '2025000100', NULL, NULL, 0, NULL, 1, NULL, NULL, NULL, NULL, 1, 1, 1, 'Падар - Модар -', NULL, NULL, NULL, 1, NULL, NULL, 3, 4, '2025-05-15 12:48:38', 24, 2),
(176, 'Мираминов Ҳусейн Абдухалилович', 'Мираминов Ҳусейн Абдухалилович', '2025000101', '2025000101', NULL, NULL, 0, NULL, 1, NULL, NULL, NULL, NULL, 1, 1, 1, 'Падар - Модар -', NULL, NULL, NULL, 1, NULL, NULL, 3, 4, '2025-05-15 12:49:02', 24, 2),
(177, 'Михточшои Мироҷиддин', 'Михточшои Мироҷиддин', '2025000102', '2025000102', NULL, NULL, 0, NULL, 1, NULL, NULL, NULL, NULL, 1, 1, 1, 'Падар - Модар -', NULL, NULL, NULL, 1, NULL, NULL, 3, 4, '2025-05-15 12:49:36', 24, 2),
(178, 'Назиров Абубакр Насимович', 'Назиров Абубакр Насимович', '2025000103', '2025000103', NULL, NULL, 0, NULL, 1, NULL, NULL, NULL, NULL, 1, 1, 1, 'Падар - Модар -', NULL, NULL, NULL, 1, NULL, NULL, 3, 4, '2025-05-15 12:50:00', 24, 2),
(179, 'Сирожев Маъруфҷон Маҳмудович', 'Сирожев Маъруфҷон Маҳмудович', '2025000104', '2025000104', NULL, NULL, 0, NULL, 1, NULL, NULL, NULL, NULL, 1, 1, 1, 'Падар - Модар -', NULL, NULL, NULL, 1, NULL, NULL, 3, 4, '2025-05-15 12:50:30', 24, 2),
(180, 'Табаров Диловар', 'Табаров Диловар', '2025000105', '2025000105', NULL, NULL, 0, NULL, 1, NULL, NULL, NULL, NULL, 1, 1, 1, 'Падар - Модар -', NULL, NULL, NULL, 1, NULL, NULL, 3, 4, '2025-05-15 12:50:50', 24, 2),
(181, 'Туразода Муҳаммад Мустафом', 'Туразода Муҳаммад Мустафо', '2025000106', '2025000106', NULL, NULL, 0, NULL, 1, NULL, NULL, NULL, NULL, 1, 1, 1, 'Падар - Модар -', NULL, NULL, NULL, 1, NULL, NULL, 3, 4, '2025-05-15 12:51:32', 24, 2),
(182, 'Холов Тоҳирҷон Тоҷиддинович', 'Холов Тоҳирҷон Тоҷиддинович', '2025000107', '2025000107', NULL, NULL, 0, NULL, 1, NULL, NULL, NULL, NULL, 1, 1, 1, 'Падар - Модар -', NULL, NULL, NULL, 1, NULL, NULL, 3, 4, '2025-05-15 12:51:50', 24, 2),
(183, 'Ҷумаев Мухиддин Бобоназарович', 'Ҷумаев Мухиддин Бобоназарович', '2025000108', '2025000108', NULL, NULL, 0, NULL, 1, NULL, NULL, NULL, NULL, 1, 1, 1, 'Падар - Модар -', NULL, NULL, NULL, 1, NULL, NULL, 3, 4, '2025-05-15 12:52:20', 24, 2),
(184, 'Яқубов Саидмумин', 'Яқубов Саидмумин', '2025000109', '2025000109', NULL, NULL, 0, NULL, 1, NULL, NULL, NULL, NULL, 1, 1, 1, 'Падар - Модар -', NULL, NULL, NULL, 1, NULL, NULL, 3, 4, '2025-05-15 12:52:41', 24, 2),
(185, 'Абдуллозода Шеркавич Вирканиен', 'Абдуллозода Шеркавич Вирканиен', '2025000110', '2025000110', NULL, NULL, 0, NULL, 1, NULL, NULL, NULL, NULL, 1, 1, 1, 'Падар - Модар -', NULL, NULL, NULL, 1, NULL, NULL, 3, 4, '2025-05-15 12:53:42', 24, 2),
(186, 'Ализода Бобоҷон Зайниддин', 'Ализода Бобоҷон Зайниддин', '2025000111', '2025000111', NULL, NULL, 0, NULL, 1, NULL, NULL, NULL, NULL, 1, 1, 1, 'Падар - Модар -', NULL, NULL, NULL, 1, NULL, NULL, 3, 4, '2025-05-15 12:54:05', 24, 2),
(187, 'Гадоев Ҳумайни Ҳикматуллоевич', 'Гадоев Ҳумайни Ҳикматуллоевич', '2025000112', '2025000112', NULL, NULL, 0, NULL, 1, NULL, NULL, NULL, NULL, 1, 1, 1, 'Падар - Модар -', NULL, NULL, NULL, 1, NULL, NULL, 3, 4, '2025-05-15 12:54:35', 24, 2),
(188, 'Гадоев Шарифчон Шералиевич', 'Гадоев Шарифчон Шералиевич', '2025000113', '2025000113', NULL, NULL, 0, NULL, 1, NULL, NULL, NULL, NULL, 1, 1, 1, 'Падар - Модар -', NULL, NULL, NULL, 1, NULL, NULL, 3, 4, '2025-05-15 12:54:53', 24, 2),
(189, 'Иброҳимзода Меҳрон Одилҷон', 'Иброҳимзода Меҳрон Одилҷон', '2025000114', '2025000114', NULL, NULL, 0, NULL, 1, NULL, NULL, NULL, NULL, 1, 1, 1, 'Падар - Модар -', NULL, NULL, NULL, 1, NULL, NULL, 3, 4, '2025-05-15 12:55:13', 24, 2),
(190, 'Камилов Сиёвуш Фирдавсович', 'Камилов Сиёвуш Фирдавсович', '2025000115', '2025000115', NULL, NULL, 0, '', 1, NULL, NULL, NULL, NULL, 1, 1, 1, 'Падар - Модар -', NULL, NULL, 1, 1, NULL, NULL, 3, 4, '2025-05-15 12:55:34', 24, 2),
(191, 'Муслимов Резвон Абдуғафорович', 'Муслимов Резвон Абдуғафорович', '2025000116', '2025000116', NULL, NULL, 0, NULL, 1, NULL, NULL, NULL, NULL, 1, 1, 1, 'Падар - Модар -', NULL, NULL, NULL, 1, NULL, NULL, 3, 4, '2025-05-15 13:00:52', 24, 2),
(192, 'Нуров Беҳруз Таввакалович', 'Нуров Беҳруз Таввакалович', '2025000117', '2025000117', NULL, NULL, 0, NULL, 1, NULL, NULL, NULL, NULL, 1, 1, 1, 'Падар - Модар -', NULL, NULL, NULL, 1, NULL, NULL, 3, 4, '2025-05-15 13:01:14', 24, 2),
(193, 'Равшанзода Қосимҷон Идибег', 'Равшанзода Қосимҷон Идибег', '2025000118', '2025000118', NULL, NULL, 0, NULL, 1, NULL, NULL, NULL, NULL, 1, 1, 1, 'Падар - Модар -', NULL, NULL, NULL, 1, NULL, NULL, 3, 4, '2025-05-15 13:01:36', 24, 2),
(194, 'Раҳматов Абдулбасир Мирзоҷонович', 'Раҳматов Абдулбасир Мирзоҷонович', '2025000119', '2025000119', NULL, NULL, 0, NULL, 1, NULL, NULL, NULL, NULL, 1, 1, 1, 'Падар - Модар -', NULL, NULL, NULL, 1, NULL, NULL, 3, 4, '2025-05-15 13:01:56', 24, 2),
(195, 'Холов Шукрулло Баҳромович', 'Холов Шукрулло Баҳромович', '2025000120', '2025000120', NULL, NULL, 0, NULL, 1, NULL, NULL, NULL, NULL, 1, 1, 1, 'Падар - Модар -', NULL, NULL, NULL, 1, NULL, NULL, 3, 4, '2025-05-15 13:02:17', 24, 2),
(196, 'Хуршедзода Сулҳия', 'Хуршедзода Сулҳия', '2025000121', '2025000121', NULL, NULL, 0, NULL, 0, NULL, NULL, NULL, NULL, 1, 1, 1, 'Падар - Модар -', NULL, NULL, NULL, 1, NULL, NULL, 3, 4, '2025-05-15 13:02:36', 24, 2),
(197, 'Ҷабборов Муҳаммадҷон Абдуҷабборович', 'Ҷабборов Муҳаммадҷон Абдуҷабборович', '2025000122', '2025000122', NULL, NULL, 0, NULL, 1, NULL, NULL, NULL, NULL, 1, 1, 1, 'Падар - Модар -', NULL, NULL, NULL, 1, NULL, NULL, 3, 4, '2025-05-15 13:02:59', 24, 2),
(198, 'Қурбонов Меҳроб', 'Қурбонов Меҳроб', '2025000123', '2025000123', NULL, NULL, 0, NULL, 1, NULL, NULL, NULL, NULL, 1, 1, 1, 'Падар - Модар -', NULL, NULL, NULL, 1, NULL, NULL, 3, 4, '2025-05-15 13:03:21', 24, 2),
(199, 'Амонов Музаффар Олимович', 'Амонов Музаффар Олимович', '2025000124', '2025000124', NULL, NULL, 0, NULL, 1, NULL, NULL, NULL, NULL, 1, 1, 1, 'Падар - Модар -', NULL, NULL, NULL, 1, NULL, NULL, 3, 4, '2025-05-15 13:04:41', 24, 2),
(200, 'Бачабекзода Рамазон Амробег', 'Бачабекзода Рамазон Амробег', '2025000125', '2025000125', NULL, NULL, 0, NULL, 1, NULL, NULL, NULL, NULL, 1, 1, 1, 'Падар - Модар -', NULL, NULL, NULL, 1, NULL, NULL, 3, 4, '2025-05-15 13:04:59', 24, 2),
(201, 'Ғайратзода Салоҳиддин Сафарали', 'Ғайратзода Салоҳиддин Сафарали', '2025000126', '2025000126', NULL, NULL, 0, '', 1, NULL, NULL, NULL, NULL, 1, 1, 1, 'Падар - Модар -', NULL, NULL, 1, 1, NULL, NULL, 3, 4, '2025-05-15 13:10:38', 24, 2),
(202, 'Гафоров Беҳрӯз Комилович', 'Гафоров Беҳрӯз Комилович', '2025000127', '2025000127', NULL, NULL, 0, NULL, 1, NULL, NULL, NULL, NULL, 1, 1, 1, 'Падар - Модар -', NULL, NULL, NULL, 1, NULL, NULL, 3, 4, '2025-05-15 13:11:02', 24, 2),
(203, 'Зарипов Насибулло Илхомҷонович', 'Зарипов Насибулло Илхомҷонович', '2025000128', '2025000128', NULL, NULL, 0, NULL, 1, NULL, NULL, NULL, NULL, 1, 1, 1, 'Падар - Модар -', NULL, NULL, NULL, 1, NULL, NULL, 3, 4, '2025-05-15 13:12:32', 24, 2),
(204, 'Икромов Насрулло Алишерович', 'Икромов Насрулло Алишерович', '2025000129', '2025000129', NULL, NULL, 0, NULL, 1, NULL, NULL, NULL, NULL, 1, 1, 1, 'Падар - Модар -', NULL, NULL, NULL, 1, NULL, NULL, 3, 4, '2025-05-15 13:12:52', 24, 2),
(205, 'Исматов Абубакр Исуфҷонович', 'Исматов Абубакр Исуфҷонович', '2025000130', '2025000130', NULL, NULL, 0, NULL, 1, NULL, NULL, NULL, NULL, 1, 1, 1, 'Падар - Модар -', NULL, NULL, NULL, 1, NULL, NULL, 3, 4, '2025-05-15 13:13:07', 24, 2),
(206, 'Қуронбеков  Адиб Ҷамшедович', 'Қуронбеков  Адиб Ҷамшедович', '2025000131', '2025000131', NULL, NULL, 0, NULL, 1, NULL, NULL, NULL, NULL, 1, 1, 1, 'Падар - Модар -', NULL, NULL, NULL, 1, NULL, NULL, 3, 4, '2025-05-15 13:13:22', 24, 2),
(207, 'Миралиев Саидбек Комилҷонович', 'Миралиев Саидбек Комилҷонович', '2025000132', '2025000132', NULL, NULL, 0, NULL, 1, NULL, NULL, NULL, NULL, 1, 1, 1, 'Падар - Модар -', NULL, NULL, NULL, 1, NULL, NULL, 3, 4, '2025-05-15 13:13:35', 24, 2),
(208, 'Мирзозода Фараҳноз Давлатқадам', 'Мирзозода Фараҳноз Давлатқадам', '2025000133', '2025000133', NULL, NULL, 0, '', 0, NULL, NULL, NULL, NULL, 1, 1, 1, 'Падар - Модар -', NULL, NULL, 1, 1, NULL, NULL, 3, 4, '2025-05-15 13:13:50', 24, 2),
(209, 'Аббосзода Ораш Зафар', 'Аббосзода Ораш Зафар', '2025000134', '2025000134', NULL, NULL, 0, NULL, 1, NULL, NULL, NULL, NULL, 1, 1, 1, 'Падар - Модар -', NULL, NULL, NULL, 1, NULL, NULL, 3, 4, '2025-05-15 13:14:37', 24, 2),
(210, 'Абдувалиев Акмалхон Зафархонович', 'Абдувалиев Акмалхон Зафархонович', '2025000135', '2025000135', NULL, NULL, 0, NULL, 1, NULL, NULL, NULL, NULL, 1, 1, 1, 'Падар - Модар -', NULL, NULL, NULL, 1, NULL, NULL, 3, 4, '2025-05-15 13:16:52', 24, 2),
(211, 'Абдувалиев Акрамхон Зафархонович', 'Абдувалиев Акрамхон Зафархонович', '2025000136', '2025000136', NULL, NULL, 0, NULL, 1, NULL, NULL, NULL, NULL, 1, 1, 1, 'Падар - Модар -', NULL, NULL, NULL, 1, NULL, NULL, 3, 4, '2025-05-15 13:17:15', 24, 2),
(212, 'Аминов Парвиз Файзалиевич', 'Аминов Парвиз Файзалиевич', '2025000137', '2025000137', NULL, NULL, 0, NULL, 1, NULL, NULL, NULL, NULL, 1, 1, 1, 'Падар - Модар -', NULL, NULL, NULL, 1, NULL, NULL, 3, 4, '2025-05-15 13:17:34', 24, 2),
(213, 'Исмоилов Тоҳир Таваралиевич', 'Исмоилов Тоҳир Таваралиевич', '2025000138', '2025000138', NULL, NULL, 0, NULL, 1, NULL, NULL, NULL, NULL, 1, 1, 1, 'Падар - Модар -', NULL, NULL, NULL, 1, NULL, NULL, 3, 4, '2025-05-15 13:17:57', 24, 2),
(214, 'Қодири Муқимзода', 'Қодири Муқимзода', '2025000139', '2025000139', NULL, NULL, 0, NULL, 1, NULL, NULL, NULL, NULL, 1, 1, 1, 'Падар - Модар -', NULL, NULL, NULL, 1, NULL, NULL, 3, 4, '2025-05-15 13:18:21', 24, 2),
(215, 'Махматшоев Икромҷон Заробудинович', 'Махматшоев Икромҷон Заробудинович', '2025000140', '2025000140', NULL, NULL, 0, NULL, 1, NULL, NULL, NULL, NULL, 1, 1, 1, 'Падар - Модар -', NULL, NULL, NULL, 1, NULL, NULL, 3, 4, '2025-05-15 13:18:42', 24, 2),
(216, 'Маҳмадиев Мансурҷон Самиджонович', 'Маҳмадиев Мансурҷон Самиджонович', '2025000141', '2025000141', NULL, NULL, 0, NULL, 1, NULL, NULL, NULL, NULL, 1, 1, 1, 'Падар - Модар -', NULL, NULL, NULL, 1, NULL, NULL, 3, 4, '2025-05-15 13:19:01', 24, 2),
(217, 'Нарзуллозода Иқбол Дилшод', 'Нарзуллозода Иқбол Дилшод', '2025000142', '2025000142', NULL, NULL, 0, NULL, 1, NULL, NULL, NULL, NULL, 1, 1, 1, 'Падар - Модар -', NULL, NULL, NULL, 1, NULL, NULL, 3, 4, '2025-05-15 13:19:23', 24, 2),
(218, 'Рустамов Фурӯзон Абдуҷабборович', 'Рустамов Фурӯзон Абдуҷабборович', '2025000143', '2025000143', NULL, NULL, 0, NULL, 1, NULL, NULL, NULL, NULL, 1, 1, 1, 'Падар - Модар -', NULL, NULL, NULL, 1, NULL, NULL, 3, 4, '2025-05-15 13:19:41', 24, 2),
(219, 'Набиев Хусан Дониёрович', 'Набиев Хусан Дониёрович', '2025000144', '2025000144', NULL, NULL, 0, NULL, 1, NULL, NULL, NULL, NULL, 1, 1, 1, 'Падар - Модар -', NULL, NULL, NULL, 1, NULL, NULL, 3, 4, '2025-05-15 13:19:51', 24, 2),
(220, 'Саидзода Садриддин Самаридин', 'Саидзода Садриддин Самаридин', '2025000145', '2025000145', NULL, NULL, 0, NULL, 1, NULL, NULL, NULL, NULL, 1, 1, 1, 'Падар - Модар -', NULL, NULL, NULL, 1, NULL, NULL, 3, 4, '2025-05-15 13:19:58', 24, 2),
(221, 'Рақибов Умед Растамович', 'Рақибов Умед Растамович', '2025000146', '2025000146', NULL, NULL, 0, NULL, 1, NULL, NULL, NULL, NULL, 1, 1, 1, 'Падар - Модар -', NULL, NULL, NULL, 1, NULL, NULL, 3, 4, '2025-05-15 13:20:08', 24, 2),
(222, 'Тағоев Нуриддин Илҳомиддинович', 'Тағоев Нуриддин Илҳомиддинович', '2025000147', '2025000147', NULL, NULL, 0, NULL, 1, NULL, NULL, NULL, NULL, 1, 1, 1, 'Падар - Модар -', NULL, NULL, NULL, 1, NULL, NULL, 3, 4, '2025-05-15 13:20:18', 24, 2),
(223, 'Салихов Баҳодур Ҷамолидинович', 'Салихов Баҳодур Ҷамолидинович', '2025000148', '2025000148', NULL, NULL, 0, NULL, 1, NULL, NULL, NULL, NULL, 1, 1, 1, 'Падар - Модар -', NULL, NULL, NULL, 1, NULL, NULL, 3, 4, '2025-05-15 13:20:27', 24, 2),
(224, 'Сатторов Шаҳриёр Файзиддинович', 'Сатторов Шаҳриёр Файзиддинович', '2025000149', '2025000149', NULL, NULL, 0, NULL, 1, NULL, NULL, NULL, NULL, 1, 1, 1, 'Падар - Модар -', NULL, NULL, NULL, 1, NULL, NULL, 3, 4, '2025-05-15 13:21:49', 24, 2),
(225, 'Сафарализода Лоиқ Шерали', 'Сафарализода Лоиқ Шерали', '2025000150', '2025000150', NULL, NULL, 0, NULL, 1, NULL, NULL, NULL, NULL, 1, 1, 1, 'Падар - Модар -', NULL, NULL, NULL, 1, NULL, NULL, 3, 4, '2025-05-15 13:22:11', 24, 2),
(226, 'Тоҷов Салмон', 'Тоҷов Салмон', '2025000151', '2025000151', NULL, NULL, 0, NULL, 1, NULL, NULL, NULL, NULL, 1, 1, 1, 'Падар - Модар -', NULL, NULL, NULL, 1, NULL, NULL, 3, 4, '2025-05-15 13:22:21', 24, 2);
INSERT INTO `users` (`id`, `fullname_tj`, `fullname_ru`, `login`, `password`, `first_login`, `last_login`, `counter`, `birthday`, `jins`, `photo`, `email`, `phone`, `phone_parents`, `v_ijtimoi`, `from_family`, `v_oilavi`, `family_info`, `xobgoh`, `unvoni_harbi`, `lashkar`, `access`, `rating_access`, `archive`, `access_type`, `added_by`, `added_time`, `s_y`, `h_y`) VALUES
(227, 'Сулаймонов Оятулло Изатуллоевич', 'Сулаймонов Оятулло Изатуллоевич', '2025000152', '2025000152', NULL, NULL, 0, NULL, 1, NULL, NULL, NULL, NULL, 1, 1, 1, 'Падар - Модар -', NULL, NULL, NULL, 1, NULL, NULL, 3, 4, '2025-05-15 13:22:27', 24, 2),
(228, 'Умарзода Муҳаммад', 'Умарзода Муҳаммад', '2025000153', '2025000153', NULL, NULL, 0, NULL, 1, NULL, NULL, NULL, NULL, 1, 1, 1, 'Падар - Модар -', NULL, NULL, NULL, 1, NULL, NULL, 3, 4, '2025-05-15 13:22:47', 24, 2),
(229, 'Фозилзода Фирдавс Уктам', 'Фозилзода Фирдавс Уктам', '2025000154', '2025000154', NULL, NULL, 0, NULL, 1, NULL, NULL, NULL, NULL, 1, 1, 1, 'Падар - Модар -', NULL, NULL, NULL, 1, NULL, NULL, 3, 4, '2025-05-15 13:23:15', 24, 2),
(230, 'Шодиев Фозилбек Сафарбекович', 'Шодиев Фозилбек Сафарбекович', '2025000155', '2025000155', NULL, NULL, 0, NULL, 1, NULL, NULL, NULL, NULL, 1, 1, 1, 'Падар - Модар -', NULL, NULL, NULL, 1, NULL, NULL, 3, 4, '2025-05-15 13:23:37', 24, 2),
(231, 'Шоҳзода Шодмеҳр Абдусамад', 'Шоҳзода Шодмеҳр Абдусамад', '2025000156', '2025000156', NULL, NULL, 0, NULL, 1, NULL, NULL, NULL, NULL, 1, 1, 1, 'Падар - Модар -', NULL, NULL, NULL, 1, NULL, NULL, 3, 4, '2025-05-15 13:23:59', 24, 2),
(232, 'Абдулназарзода Билол Абдулназар', 'Абдулназарзода Билол Абдулназар', '2025000157', '2025000157', NULL, NULL, 0, NULL, 1, NULL, NULL, NULL, NULL, 1, 1, 1, 'Падар - Модар -', NULL, NULL, NULL, 1, NULL, NULL, 3, 4, '2025-05-15 13:29:25', 24, 2),
(233, 'Амонуллоев Азизулло Джумаевич', 'Амонуллоев Азизулло Джумаевич', '2025000158', '2025000158', NULL, NULL, 0, NULL, 1, NULL, NULL, NULL, NULL, 1, 1, 1, 'Падар - Модар -', NULL, NULL, NULL, 1, NULL, NULL, 3, 4, '2025-05-15 13:29:44', 24, 2),
(234, 'Ашуров Саймурод Маҳмараҷабович', 'Ашуров Саймурод Маҳмараҷабович', '2025000159', '2025000159', NULL, NULL, 0, NULL, 1, NULL, NULL, NULL, NULL, 1, 1, 1, 'Падар - Модар -', NULL, NULL, NULL, 1, NULL, NULL, 3, 4, '2025-05-15 13:30:04', 24, 2),
(235, 'Идриси Саймехточ', 'Идриси Саймехточ', '2025000160', '2025000160', NULL, NULL, 0, NULL, 1, NULL, NULL, NULL, NULL, 1, 1, 1, 'Падар - Модар -', NULL, NULL, NULL, 1, NULL, NULL, 3, 4, '2025-05-15 13:30:29', 24, 2),
(236, 'Камолзода Амирчон Шерафган', 'Камолзода Амирчон Шерафган', '2025000161', '2025000161', NULL, NULL, 0, NULL, 1, NULL, NULL, NULL, NULL, 1, 1, 1, 'Падар - Модар -', NULL, NULL, NULL, 1, NULL, NULL, 3, 4, '2025-05-15 13:31:09', 24, 2),
(237, 'Қучқорбекова Файзигул Рамазоновна', 'Қучқорбекова Файзигул Рамазоновна', '2025000162', '2025000162', NULL, NULL, 0, NULL, 0, NULL, NULL, NULL, NULL, 1, 1, 1, 'Падар - Модар -', NULL, NULL, NULL, 1, NULL, NULL, 3, 4, '2025-05-15 13:31:32', 24, 2),
(238, 'Мирсаидова Нӯшофарин Фаридуновна', 'Мирсаидова Нӯшофарин Фаридуновна', '2025000163', '2025000163', NULL, NULL, 0, NULL, 0, NULL, NULL, NULL, NULL, 1, 1, 1, 'Падар - Модар -', NULL, NULL, NULL, 1, NULL, NULL, 3, 4, '2025-05-15 13:31:47', 24, 2),
(239, 'Раҷабова Аниса Нематовна', 'Раҷабова Аниса Нематовна', '2025000164', '2025000164', NULL, NULL, 0, NULL, 0, NULL, NULL, NULL, NULL, 1, 1, 1, 'Падар - Модар -', NULL, NULL, NULL, 1, NULL, NULL, 3, 4, '2025-05-15 13:32:09', 24, 2),
(240, 'Саидшоева Гулроза Саидсодиқовна', 'Саидшоева Гулроза Саидсодиқовна', '2025000165', '2025000165', NULL, NULL, 0, NULL, 0, NULL, NULL, NULL, NULL, 1, 1, 1, 'Падар - Модар -', NULL, NULL, NULL, 1, NULL, NULL, 3, 4, '2025-05-15 13:36:19', 24, 2),
(241, 'Файзов Идибек Абдулазизович', 'Файзов Идибек Абдулазизович', '2025000166', '2025000166', NULL, NULL, 0, NULL, 1, NULL, NULL, NULL, NULL, 1, 1, 1, 'Падар - Модар -', NULL, NULL, NULL, 1, NULL, NULL, 3, 4, '2025-05-15 13:36:43', 24, 2),
(242, 'Холдонова Омина Абдуллоевна', 'Холдонова Омина Абдуллоевна', '2025000167', '2025000167', NULL, NULL, 0, NULL, 0, NULL, NULL, NULL, NULL, 1, 1, 1, 'Падар - Модар -', NULL, NULL, NULL, 1, NULL, NULL, 3, 4, '2025-05-15 13:37:08', 24, 2),
(243, 'Хуморов Муҳаммад Амрихудоевич', 'Хуморов Муҳаммад Амрихудоевич', '2025000168', '2025000168', NULL, NULL, 0, NULL, 1, NULL, NULL, NULL, NULL, 1, 1, 1, 'Падар - Модар -', NULL, NULL, NULL, 1, NULL, NULL, 3, 4, '2025-05-15 13:37:35', 24, 2),
(244, 'Ҳасанзода Сиёвуш Исмонали', 'Ҳасанзода Сиёвуш Исмонали', '2025000169', '2025000169', NULL, NULL, 0, NULL, 1, NULL, NULL, NULL, NULL, 1, 1, 1, 'Падар - Модар -', NULL, NULL, NULL, 1, NULL, NULL, 3, 4, '2025-05-15 13:38:00', 24, 2),
(245, 'Чилахонзода Комрон Навруз', 'Чилахонзода Комрон Навруз', '2025000170', '2025000170', NULL, NULL, 0, NULL, 1, NULL, NULL, NULL, NULL, 1, 1, 1, 'Падар - Модар -', NULL, NULL, NULL, 1, NULL, NULL, 3, 4, '2025-05-15 13:38:23', 24, 2),
(246, 'Шарипзода Хочикурбон Чумахон', 'Шарипзода Хочикурбон Чумахон', '2025000171', '2025000171', NULL, NULL, 0, NULL, 1, NULL, NULL, NULL, NULL, 1, 1, 1, 'Падар - Модар -', NULL, NULL, NULL, 1, NULL, NULL, 3, 4, '2025-05-15 13:38:46', 24, 2),
(247, 'Шоҳзода Яқуб Искандар', 'Шоҳзода Яқуб Искандар', '2025000172', '2025000172', NULL, NULL, 0, NULL, 1, NULL, NULL, NULL, NULL, 1, 1, 1, 'Падар - Модар -', NULL, NULL, NULL, 1, NULL, NULL, 3, 4, '2025-05-15 13:39:09', 24, 2),
(248, 'Туфонов Исмоил Ҳ', 'Туфонов Исмоил Ҳ', '2025000173', '2025000173', NULL, NULL, 0, NULL, 1, NULL, NULL, NULL, NULL, 1, 1, 1, 'Падар - Модар -', NULL, NULL, NULL, 1, NULL, NULL, 3, 4, '2025-05-15 13:39:30', 24, 2),
(249, 'Холов Фирдавси Суҳробович', 'Холов Фирдавси Суҳробович', '2025000174', '2025000174', NULL, NULL, 0, NULL, 1, NULL, NULL, NULL, NULL, 1, 1, 1, 'Падар - Модар -', NULL, NULL, NULL, 1, NULL, NULL, 3, 4, '2025-05-15 16:02:41', 24, 2),
(250, 'Худойдодов Анас Саидасрорович', 'Худойдодов Анас Саидасрорович', '2025000175', '2025000175', NULL, NULL, 0, NULL, 1, NULL, NULL, NULL, NULL, 1, 1, 1, 'Падар - Модар -', NULL, NULL, NULL, 1, NULL, NULL, 3, 4, '2025-05-15 16:02:54', 24, 2),
(251, 'Ҳафиззода Раҳматулло Суҳроб', 'Ҳафиззода Раҳматулло Суҳроб', '2025000176', '2025000176', NULL, NULL, 0, NULL, 1, NULL, NULL, NULL, NULL, 1, 1, 1, 'Падар - Модар -', NULL, NULL, NULL, 1, NULL, NULL, 3, 4, '2025-05-15 16:03:08', 24, 2),
(252, 'Шамсов Меҳроб Саъдиевич', 'Шамсов Меҳроб Саъдиевич', '2025000177', '2025000177', NULL, NULL, 0, NULL, 1, NULL, NULL, NULL, NULL, 1, 1, 1, 'Падар - Модар -', NULL, NULL, NULL, 1, NULL, NULL, 3, 4, '2025-05-15 16:03:25', 24, 2),
(253, 'Латифова Лайло Рустамовна', 'Латифова Лайло Рустамовна', '2025000178', '2025000178', NULL, NULL, 0, '', 0, NULL, NULL, NULL, NULL, 1, 1, 1, 'Падар - Модар -', NULL, NULL, 1, 1, NULL, NULL, 3, 4, '2025-05-15 16:03:42', 24, 2),
(254, 'Лоиқов Муҳаммад Ҳошимович', 'Лоиқов Муҳаммад Ҳошимович', '2025000179', '2025000179', NULL, NULL, 0, NULL, 1, NULL, NULL, NULL, NULL, 1, 1, 1, 'Падар - Модар -', NULL, NULL, NULL, 1, NULL, NULL, 3, 4, '2025-05-15 16:04:10', 24, 2),
(255, 'Ғафуров Афзалшо Камолиддинович', 'Ғафуров Афзалшо Камолиддинович', '2025000180', '2025000180', NULL, NULL, 0, NULL, 1, NULL, NULL, NULL, NULL, 1, 1, 1, 'Падар - Модар -', NULL, NULL, NULL, 1, NULL, NULL, 3, 4, '2025-05-15 16:04:28', 24, 2),
(256, 'Давлятов Хуршед Бахтиёрович', 'Давлятов Хуршед Бахтиёрович', '2025000181', '2025000181', NULL, NULL, 0, '', 1, NULL, NULL, NULL, NULL, 1, 1, 1, 'Падар - Модар -', NULL, NULL, 1, 1, NULL, NULL, 3, 4, '2025-05-15 16:04:47', 24, 2),
(257, 'Ҷалалов Умед Байдилаевич', 'Ҷалалов Умед Байдилаевич', '2025000182', '2025000182', NULL, NULL, 0, NULL, 1, NULL, NULL, NULL, NULL, 1, 1, 1, 'Падар - Модар -', NULL, NULL, NULL, 1, NULL, NULL, 3, 4, '2025-05-15 16:05:07', 24, 2),
(258, 'Маҳмуродов Абубакр Маҳмадкаримович', 'Маҳмуродов Абубакр Маҳмадкаримович', '2025000183', '2025000183', NULL, NULL, 0, NULL, 1, NULL, NULL, NULL, NULL, 1, 1, 1, 'Падар - Модар -', NULL, NULL, NULL, 1, NULL, NULL, 3, 4, '2025-05-15 16:06:05', 24, 2),
(259, 'Мирзозоза Абдусалом', 'Мирзозоза Абдусалом', 'mirzozoza/25', 'mirzozoza/25', NULL, NULL, 0, '', 1, NULL, '', '', '', 1, 1, 1, 'Падар - Модар -', NULL, NULL, NULL, 1, NULL, NULL, 2, 4, '16.05.2025, 08:33:51', 24, 2),
(260, 'Абдуллоев Самариддин Суҳробович', 'Абдуллоев Самариддин Суҳробович', '2025000184', '2025000184', NULL, NULL, 0, NULL, 1, NULL, NULL, NULL, NULL, 1, 1, 1, 'Падар - Модар -', NULL, NULL, NULL, 1, NULL, NULL, 3, 4, '2025-05-16 10:56:59', 24, 2),
(261, 'Азизов Шохинчон Акмалчонович', 'Азизов Шохинчон Акмалчонович', '2025000185', '2025000185', NULL, NULL, 0, NULL, 1, NULL, NULL, NULL, NULL, 1, 1, 1, 'Падар - Модар -', NULL, NULL, NULL, 1, NULL, NULL, 3, 4, '2025-05-16 10:57:28', 24, 2),
(262, 'Бегиҷонов Алиҷон Амирхонович', 'Бегиҷонов Алиҷон Амирхонович', '2025000186', '2025000186', NULL, NULL, 0, NULL, 1, NULL, NULL, NULL, NULL, 1, 1, 1, 'Падар - Модар -', NULL, NULL, NULL, 1, NULL, NULL, 3, 4, '2025-05-16 10:57:52', 24, 2),
(263, 'Биёбониева Рудоба Ҷаъфархоновна', 'Биёбониева Рудоба Ҷаъфархоновна', '2025000187', '2025000187', NULL, NULL, 0, NULL, 0, NULL, NULL, NULL, NULL, 1, 1, 1, 'Падар - Модар -', NULL, NULL, NULL, 1, NULL, NULL, 3, 4, '2025-05-16 10:58:13', 24, 2),
(264, 'Ғаниев Шамсиддин Юлдошевич', 'Ғаниев Шамсиддин Юлдошевич', '2025000188', '2025000188', NULL, NULL, 0, NULL, 1, NULL, NULL, NULL, NULL, 1, 1, 1, 'Падар - Модар -', NULL, NULL, NULL, 1, NULL, NULL, 3, 4, '2025-05-16 10:58:51', 24, 2),
(265, 'Зиёева Оиша Абдуқодировна', 'Зиёева Оиша Абдуқодировна', '2025000189', '2025000189', NULL, NULL, 0, NULL, 0, NULL, NULL, NULL, NULL, 1, 1, 1, 'Падар - Модар -', NULL, NULL, NULL, 1, NULL, NULL, 3, 4, '2025-05-16 10:59:12', 24, 2),
(266, 'Каримзода Бахтовар Ҳайдаралӣ', 'Каримзода Бахтовар Ҳайдаралӣ', '2025000190', '2025000190', NULL, NULL, 0, NULL, 1, NULL, NULL, NULL, NULL, 1, 1, 1, 'Падар - Модар -', NULL, NULL, NULL, 1, NULL, NULL, 3, 4, '2025-05-16 10:59:40', 24, 2),
(267, 'Нуриддинзода Фазлиддин Нуриддин', 'Нуриддинзода Фазлиддин Нуриддин', '2025000191', '2025000191', NULL, NULL, 0, NULL, 1, NULL, NULL, NULL, NULL, 1, 1, 1, 'Падар - Модар -', NULL, NULL, NULL, 1, NULL, NULL, 3, 4, '2025-05-16 11:00:09', 24, 2),
(268, 'Равшанов Равшан Тоҷиддинович', 'Равшанов Равшан Тоҷиддинович', '2025000192', '2025000192', NULL, NULL, 0, NULL, 1, NULL, NULL, NULL, NULL, 1, 1, 1, 'Падар - Модар -', NULL, NULL, NULL, 1, NULL, NULL, 3, 4, '2025-05-16 11:00:33', 24, 2),
(269, 'Раҷабзода Хусрав Шоди', 'Раҷабзода Хусрав Шоди', '2025000193', '2025000193', NULL, NULL, 0, NULL, 1, NULL, NULL, NULL, NULL, 1, 1, 1, 'Падар - Модар -', NULL, NULL, NULL, 1, NULL, NULL, 3, 4, '2025-05-16 11:01:01', 24, 2),
(270, 'Сафарзода Зайдулло Ёқубҷон', 'Сафарзода Зайдулло Ёқубҷон', '2025000194', '2025000194', NULL, NULL, 0, NULL, 1, NULL, NULL, NULL, NULL, 1, 1, 1, 'Падар - Модар -', NULL, NULL, NULL, 1, NULL, NULL, 3, 4, '2025-05-16 11:01:23', 24, 2),
(271, 'Худойбердиева Парвина Аҳмадалиевна', 'Худойбердиева Парвина Аҳмадалиевна', '2025000195', '2025000195', NULL, NULL, 0, NULL, 0, NULL, NULL, NULL, NULL, 1, 1, 1, 'Падар - Модар -', NULL, NULL, NULL, 1, NULL, NULL, 3, 4, '2025-05-16 11:01:44', 24, 2),
(272, 'Ҳикматов Фаридун Вайсидинович', 'Ҳикматов Фаридун Вайсидинович', '2025000196', '2025000196', NULL, NULL, 0, NULL, 1, NULL, NULL, NULL, NULL, 1, 1, 1, 'Падар - Модар -', NULL, NULL, NULL, 1, NULL, NULL, 3, 4, '2025-05-16 11:02:04', 24, 2),
(273, 'Шарифзода Сумая Бобоҷон', 'Шарифзода Сумая Бобоҷон', '2025000197', '2025000197', NULL, NULL, 0, NULL, 0, NULL, NULL, NULL, NULL, 1, 1, 1, 'Падар - Модар -', NULL, NULL, NULL, 1, NULL, NULL, 3, 4, '2025-05-16 11:02:28', 24, 2),
(274, 'Абдуллоев Ахмадҷон Сафарбекович', 'Абдуллоев Ахмадҷон Сафарбекович', '2025000198', '2025000198', NULL, NULL, 0, NULL, 1, NULL, NULL, NULL, NULL, 1, 1, 1, 'Падар - Модар -', NULL, NULL, NULL, 1, NULL, NULL, 3, 4, '2025-05-16 11:05:24', 24, 2),
(275, 'Азизов Мираҳмад Бегаҳмадович', 'Азизов Мираҳмад Бегаҳмадович', '2025000199', '2025000199', NULL, NULL, 0, NULL, 1, NULL, NULL, NULL, NULL, 1, 1, 1, 'Падар - Модар -', NULL, NULL, NULL, 1, NULL, NULL, 3, 4, '2025-05-16 11:07:20', 24, 2),
(276, 'Бозоров Хокимшох Хамзалиевич', 'Бозоров Хокимшох Хамзалиевич', '2025000200', '2025000200', NULL, NULL, 0, NULL, 1, NULL, NULL, NULL, NULL, 1, 1, 1, 'Падар - Модар -', NULL, NULL, NULL, 1, NULL, NULL, 3, 4, '2025-05-16 11:07:56', 24, 2),
(277, 'Ватаншозода Ёсимин', 'Ватаншозода Ёсимин', '2025000201', '2025000201', NULL, NULL, 0, '', 0, NULL, NULL, NULL, NULL, 1, 1, 1, 'Падар - Модар -', NULL, NULL, 1, 1, NULL, NULL, 3, 4, '2025-05-16 11:08:49', 24, 2),
(278, 'Исоқзода Файзиддин Қиёмиддин', 'Исоқзода Файзиддин Қиёмиддин', '2025000202', '2025000202', NULL, NULL, 0, NULL, 1, NULL, NULL, NULL, NULL, 1, 1, 1, 'Падар - Модар -', NULL, NULL, NULL, 1, NULL, NULL, 3, 4, '2025-05-16 11:10:17', 24, 2),
(279, 'Кодиров Бахтиёр Нодирович', 'Кодиров Бахтиёр Нодирович', '2025000203', '2025000203', NULL, NULL, 0, NULL, 1, NULL, NULL, NULL, NULL, 1, 1, 1, 'Падар - Модар -', NULL, NULL, NULL, 1, NULL, NULL, 3, 4, '2025-05-16 11:12:29', 24, 2),
(280, 'Қурбонзода Содиқ Парвиз', 'Қурбонзода Содиқ Парвиз', '2025000204', '2025000204', NULL, NULL, 0, NULL, 1, NULL, NULL, NULL, NULL, 1, 1, 1, 'Падар - Модар -', NULL, NULL, NULL, 1, NULL, NULL, 3, 4, '2025-05-16 11:13:00', 24, 2),
(281, 'Мақбулшоева Дилафруз Холиқназаровна', 'Мақбулшоева Дилафруз Холиқназаровна', '2025000205', '2025000205', NULL, NULL, 0, NULL, 0, NULL, NULL, NULL, NULL, 1, 1, 1, 'Падар - Модар -', NULL, NULL, NULL, 1, NULL, NULL, 3, 4, '2025-05-16 11:13:28', 24, 2),
(282, 'Мусульманова Фариза Рустамовна', 'Мусульманова Фариза Рустамовна', '2025000206', '2025000206', NULL, NULL, 0, NULL, 0, NULL, NULL, NULL, NULL, 1, 1, 1, 'Падар - Модар -', NULL, NULL, NULL, 1, NULL, NULL, 3, 4, '2025-05-16 11:14:02', 24, 2),
(291, 'Асадулоев Умар Исмоилович', 'Асадулоев Умар Исмоилович', '2025000215', '2025000215', NULL, NULL, 0, NULL, 1, NULL, NULL, NULL, NULL, 1, 1, 1, 'Падар - Модар -', NULL, NULL, NULL, 1, NULL, NULL, 3, 4, '2025-05-16 13:36:18', 24, 2),
(284, 'Наимзода Эҳсони Сулаймон', 'Наимзода Эҳсони Сулаймон', '2025000208', '2025000208', NULL, NULL, 0, NULL, 1, NULL, NULL, NULL, NULL, 1, 1, 1, 'Падар - Модар -', NULL, NULL, NULL, 1, NULL, NULL, 3, 4, '2025-05-16 11:16:24', 24, 2),
(285, 'Нуралиева Дилоро Сайдалиевна', 'Нуралиева Дилоро Сайдалиевна', '2025000209', '2025000209', NULL, NULL, 0, NULL, 0, NULL, NULL, NULL, NULL, 1, 1, 1, 'Падар - Модар -', NULL, NULL, NULL, 1, NULL, NULL, 3, 4, '2025-05-16 11:16:49', 24, 2),
(286, 'Нурхонзода Фирдавс Навруз', 'Нурхонзода Фирдавс Навруз', '2025000210', '2025000210', NULL, NULL, 0, NULL, 1, NULL, NULL, NULL, NULL, 1, 1, 1, 'Падар - Модар -', NULL, NULL, NULL, 1, NULL, NULL, 3, 4, '2025-05-16 11:17:10', 24, 2),
(287, 'Саидов Хушбахт Ҳамрокулович', 'Саидов Хушбахт Ҳамрокулович', '2025000211', '2025000211', NULL, NULL, 0, NULL, 1, NULL, NULL, NULL, NULL, 1, 1, 1, 'Падар - Модар -', NULL, NULL, NULL, 1, NULL, NULL, 3, 4, '2025-05-16 11:17:32', 24, 2),
(288, 'Худойдодов Муҳаммадаюбҷон Саймидинович', 'Худойдодов Муҳаммадаюбҷон Саймидинович', '2025000212', '2025000212', NULL, NULL, 0, NULL, 1, NULL, NULL, NULL, NULL, 1, 1, 1, 'Падар - Модар -', NULL, NULL, NULL, 1, NULL, NULL, 3, 4, '2025-05-16 11:18:14', 24, 2),
(289, 'Ҳаётов Азизҷон Баҳодурович', 'Ҳаётов Азизҷон Баҳодурович', '2025000213', '2025000213', NULL, NULL, 0, NULL, 1, NULL, NULL, NULL, NULL, 1, 1, 1, 'Падар - Модар -', NULL, NULL, NULL, 1, NULL, NULL, 3, 4, '2025-05-16 11:18:32', 24, 2),
(290, 'Шарипов Фозил Шокирович', 'Шарипов Фозил Шокирович', '2025000214', '2025000214', NULL, NULL, 0, NULL, 1, NULL, NULL, NULL, NULL, 1, 1, 1, 'Падар - Модар -', NULL, NULL, NULL, 1, NULL, NULL, 3, 4, '2025-05-16 11:18:56', 24, 2),
(292, 'Ғарибмамадова Нурафшон Асматҷоновна', 'Ғарибмамадова Нурафшон Асматҷоновна', '2025000216', '2025000216', NULL, NULL, 0, '', 0, NULL, NULL, NULL, NULL, 1, 1, 1, 'Падар - Модар -', NULL, NULL, 1, 1, NULL, NULL, 3, 4, '2025-05-16 13:36:40', 24, 2),
(293, 'Зайналобиддини Давлатмурод', 'Зайналобиддини Давлатмурод', '2025000217', '2025000217', NULL, NULL, 0, NULL, 1, NULL, NULL, NULL, NULL, 1, 1, 1, 'Падар - Модар -', NULL, NULL, NULL, 1, NULL, NULL, 3, 4, '2025-05-16 13:37:38', 24, 2),
(294, 'Зокирова Маҳина Анваровна', 'Зокирова Маҳина Анваровна', '2025000218', '2025000218', NULL, NULL, 0, NULL, 0, NULL, NULL, NULL, NULL, 1, 1, 1, 'Падар - Модар -', NULL, NULL, NULL, 1, NULL, NULL, 3, 4, '2025-05-16 13:38:01', 24, 2),
(295, 'Қурбонов Обидҷон Сайалиевич', 'Қурбонов Обидҷон Сайалиевич', '2025000219', '2025000219', NULL, NULL, 0, NULL, 1, NULL, NULL, NULL, NULL, 1, 1, 1, 'Падар - Модар -', NULL, NULL, NULL, 1, NULL, NULL, 3, 4, '2025-05-16 13:38:28', 24, 2),
(296, 'Маконов Абдубасир Баҳриддинович', 'Маконов Абдубасир Баҳриддинович', '2025000220', '2025000220', NULL, NULL, 0, NULL, 1, NULL, NULL, NULL, NULL, 1, 1, 1, 'Падар - Модар -', NULL, NULL, NULL, 1, NULL, NULL, 3, 4, '2025-05-16 13:39:03', 24, 2),
(297, 'Мамадаминбеков Назмия Юсуфовна', 'Мамадаминбеков Назмия Юсуфовна', '2025000221', '2025000221', NULL, NULL, 0, '', 0, NULL, NULL, NULL, NULL, 1, 1, 1, 'Падар - Модар -', NULL, NULL, 1, 1, NULL, NULL, 3, 4, '2025-05-16 13:39:27', 24, 2),
(298, 'Муҳаммадии Иброҳими Олим', 'Муҳаммадии Иброҳими Олим', '2025000222', '2025000222', NULL, NULL, 0, NULL, 1, NULL, NULL, NULL, NULL, 1, 1, 1, 'Падар - Модар -', NULL, NULL, NULL, 1, NULL, NULL, 3, 4, '2025-05-16 13:39:51', 24, 2),
(299, 'Неъмонов Точиддин Шарофович', 'Неъмонов Точиддин Шарофович', '2025000223', '2025000223', NULL, NULL, 0, NULL, 1, NULL, NULL, NULL, NULL, 1, 1, 1, 'Падар - Модар -', NULL, NULL, NULL, 1, NULL, NULL, 3, 4, '2025-05-16 13:40:19', 24, 2),
(300, 'Рабизода Ҷаҳоншои Шамшод', 'Рабизода Ҷаҳоншои Шамшод', '2025000224', '2025000224', NULL, NULL, 0, NULL, 1, NULL, NULL, NULL, NULL, 1, 1, 1, 'Падар - Модар -', NULL, NULL, NULL, 1, NULL, NULL, 3, 4, '2025-05-16 13:41:03', 24, 2),
(301, 'Сабзаев Беҳрӯз Ҷумахонович', 'Сабзаев Беҳрӯз Ҷумахонович', '2025000225', '2025000225', NULL, NULL, 0, NULL, 1, NULL, NULL, NULL, NULL, 1, 1, 1, 'Падар - Модар -', NULL, NULL, NULL, 1, NULL, NULL, 3, 4, '2025-05-16 13:41:32', 24, 2),
(302, 'Саидзода Саҳобиддин Қудратулло', 'Саидзода Саҳобиддин Қудратулло', '2025000226', '2025000226', NULL, NULL, 0, NULL, 1, NULL, NULL, NULL, NULL, 1, 1, 1, 'Падар - Модар -', NULL, NULL, NULL, 1, NULL, NULL, 3, 4, '2025-05-16 13:41:58', 24, 2),
(303, 'Сувонов Субхон Шодмонович', 'Сувонов Субхон Шодмонович', '2025000227', '2025000227', NULL, NULL, 0, '', 1, NULL, NULL, NULL, NULL, 1, 1, 1, 'Падар - Модар -', NULL, NULL, 1, 1, NULL, NULL, 3, 4, '2025-05-16 13:42:17', 24, 2),
(304, 'Ҳабибов Маҳмадсаид Сафаралиевич', 'Ҳабибов Маҳмадсаид Сафаралиевич', '2025000228', '2025000228', NULL, NULL, 0, NULL, 1, NULL, NULL, NULL, NULL, 1, 1, 1, 'Падар - Модар -', NULL, NULL, NULL, 1, NULL, NULL, 3, 4, '2025-05-16 13:43:19', 24, 2),
(305, 'Ҷаборзода Икромҷон Зувайдулло', 'Ҷаборзода Икромҷон Зувайдулло', '2025000229', '2025000229', NULL, NULL, 0, NULL, 1, NULL, NULL, NULL, NULL, 1, 1, 1, 'Падар - Модар -', NULL, NULL, NULL, 1, NULL, NULL, 3, 4, '2025-05-16 13:43:49', 24, 2),
(306, 'Ҷонова Наргиса Саломовна', 'Ҷонова Наргиса Саломовна', '2025000230', '2025000230', NULL, NULL, 0, NULL, 0, NULL, NULL, NULL, NULL, 1, 1, 1, 'Падар - Модар -', NULL, NULL, NULL, 1, NULL, NULL, 3, 4, '2025-05-16 13:44:13', 24, 2),
(307, 'Шарифзода Эмомали Шариф', 'Шарифзода Эмомали Шариф', '2025000231', '2025000231', NULL, NULL, 0, NULL, 1, NULL, NULL, NULL, NULL, 1, 1, 1, 'Падар - Модар -', NULL, NULL, NULL, 1, NULL, NULL, 3, 4, '2025-05-16 13:44:37', 24, 2);

-- --------------------------------------------------------

--
-- Структура таблицы `users_2`
--

CREATE TABLE `users_2` (
  `id` int NOT NULL,
  `type` int NOT NULL DEFAULT '2' COMMENT '1-довталаб, 2-хатмкунанда',
  `fio` varchar(250) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `log` varchar(50) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `pass` varchar(50) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `ac` int NOT NULL DEFAULT '0',
  `level` int NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Структура таблицы `users_biometric`
--

CREATE TABLE `users_biometric` (
  `id` int NOT NULL,
  `id_user` int NOT NULL,
  `scan1_finger1` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci,
  `scan1_finger2` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci,
  `scan2_finger1` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci,
  `scan2_finger2` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci,
  `added_by` int DEFAULT NULL,
  `added_date` datetime DEFAULT NULL,
  `updated_by` int DEFAULT NULL,
  `updated_date` datetime DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Структура таблицы `user_passports`
--

CREATE TABLE `user_passports` (
  `id` int NOT NULL,
  `id_user` int NOT NULL,
  `number` varchar(50) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `date` varchar(16) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `maqomot` varchar(250) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `rma` int DEFAULT NULL,
  `id_country` int DEFAULT NULL,
  `id_nation` int DEFAULT NULL,
  `id_region` int DEFAULT NULL,
  `id_district` int DEFAULT NULL,
  `address` varchar(500) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `joi_kor` varchar(300) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb3;

--
-- Дамп данных таблицы `user_passports`
--

INSERT INTO `user_passports` (`id`, `id_user`, `number`, `date`, `maqomot`, `rma`, `id_country`, `id_nation`, `id_region`, `id_district`, `address`, `joi_kor`) VALUES
(1, 23, NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL, NULL),
(2, 24, NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL, NULL),
(3, 25, NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL, NULL),
(4, 26, NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL, NULL),
(5, 27, NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL, NULL),
(6, 28, NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL, NULL),
(7, 29, NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL, NULL),
(8, 30, NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL, NULL),
(9, 31, NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL, NULL),
(10, 32, NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL, NULL),
(11, 33, NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL, NULL),
(12, 34, NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL, NULL),
(13, 35, '', '', '', NULL, NULL, 1, NULL, NULL, NULL, NULL),
(14, 36, NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL, NULL),
(15, 37, NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL, NULL),
(16, 38, NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL, NULL),
(17, 39, NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL, NULL),
(18, 40, NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL, NULL),
(19, 41, NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL, NULL),
(20, 42, NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL, NULL),
(21, 43, NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL, NULL),
(22, 44, NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL, NULL),
(23, 45, NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL, NULL),
(24, 46, NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL, NULL),
(25, 47, NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL, NULL),
(26, 48, NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL, NULL),
(27, 49, NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL, NULL),
(28, 50, NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL, NULL),
(29, 51, NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL, NULL),
(30, 52, NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL, NULL),
(31, 53, NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL, NULL),
(32, 54, NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL, NULL),
(33, 55, NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL, NULL),
(34, 56, NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL, NULL),
(35, 57, NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL, NULL),
(36, 58, NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL, NULL),
(37, 59, NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL, NULL),
(38, 60, NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL, NULL),
(39, 61, NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL, NULL),
(40, 62, NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL, NULL),
(41, 63, NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL, NULL),
(42, 64, '', '', '', NULL, NULL, 1, NULL, NULL, NULL, NULL),
(43, 65, NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL, NULL),
(44, 66, NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL, NULL),
(45, 67, NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL, NULL),
(46, 68, '', '', '', NULL, NULL, 1, NULL, NULL, NULL, NULL),
(47, 69, NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL, NULL),
(48, 70, NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL, NULL),
(49, 71, NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL, NULL),
(50, 72, NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL, NULL),
(51, 73, '', '', '', NULL, NULL, 1, NULL, NULL, NULL, NULL),
(52, 74, NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL, NULL),
(53, 75, NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL, NULL),
(54, 76, NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL, NULL),
(55, 77, NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL, NULL),
(56, 78, NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL, NULL),
(57, 79, NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL, NULL),
(58, 80, NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL, NULL),
(59, 81, NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL, NULL),
(60, 82, NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL, NULL),
(61, 83, NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL, NULL),
(62, 84, NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL, NULL),
(63, 85, NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL, NULL),
(64, 86, NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL, NULL),
(65, 87, NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL, NULL),
(66, 88, NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL, NULL),
(67, 89, NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL, NULL),
(68, 90, NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL, NULL),
(69, 91, NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL, NULL),
(70, 92, NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL, NULL),
(71, 93, NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL, NULL),
(72, 94, NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL, NULL),
(73, 95, NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL, NULL),
(74, 96, NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL, NULL),
(75, 97, NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL, NULL),
(76, 98, NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL, NULL),
(77, 99, NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL, NULL),
(78, 100, NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL, NULL),
(79, 101, NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL, NULL),
(80, 102, NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL, NULL),
(81, 103, NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL, NULL),
(82, 104, NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL, NULL),
(83, 105, NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL, NULL),
(84, 106, NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL, NULL),
(85, 107, NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL, NULL),
(86, 108, NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL, NULL),
(87, 109, NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL, NULL),
(88, 110, NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL, NULL),
(89, 111, NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL, NULL),
(90, 112, '', '', '', NULL, NULL, 1, NULL, NULL, NULL, NULL),
(91, 113, NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL, NULL),
(92, 114, NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL, NULL),
(93, 115, NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL, NULL),
(94, 116, NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL, NULL),
(95, 117, NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL, NULL),
(96, 118, NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL, NULL),
(97, 119, NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL, NULL),
(98, 120, NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL, NULL),
(99, 121, NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL, NULL),
(100, 122, '', '', '', NULL, NULL, 1, NULL, NULL, NULL, NULL),
(101, 123, NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL, NULL),
(102, 124, NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL, NULL),
(103, 125, NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL, NULL),
(104, 126, NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL, NULL),
(105, 127, NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL, NULL),
(106, 128, NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL, NULL),
(107, 129, NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL, NULL),
(108, 130, NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL, NULL),
(109, 131, NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL, NULL),
(110, 132, NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL, NULL),
(111, 133, NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL, NULL),
(112, 134, NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL, NULL),
(113, 135, NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL, NULL),
(114, 136, NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL, NULL),
(115, 137, NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL, NULL),
(116, 138, NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL, NULL),
(117, 139, NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL, NULL),
(118, 140, NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL, NULL),
(119, 141, NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL, NULL),
(120, 142, NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL, NULL),
(121, 143, NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL, NULL),
(122, 144, NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL, NULL),
(123, 145, NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL, NULL),
(124, 146, '', '', '', NULL, NULL, 1, NULL, NULL, NULL, NULL),
(125, 147, NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL, NULL),
(126, 148, NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL, NULL),
(127, 149, NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL, NULL),
(128, 150, NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL, NULL),
(129, 151, NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL, NULL),
(130, 152, NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL, NULL),
(131, 153, NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL, NULL),
(132, 154, NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL, NULL),
(133, 155, NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL, NULL),
(134, 156, NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL, NULL),
(135, 157, NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL, NULL),
(136, 158, NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL, NULL),
(137, 159, NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL, NULL),
(138, 160, NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL, NULL),
(139, 161, NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL, NULL),
(140, 162, NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL, NULL),
(141, 163, NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL, NULL),
(142, 164, NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL, NULL),
(143, 165, NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL, NULL),
(144, 166, NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL, NULL),
(145, 167, NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL, NULL),
(146, 168, NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL, NULL),
(147, 169, NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL, NULL),
(148, 170, NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL, NULL),
(149, 171, NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL, NULL),
(150, 172, NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL, NULL),
(151, 173, '', '', '', NULL, NULL, 1, NULL, NULL, NULL, NULL),
(152, 174, NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL, NULL),
(153, 175, NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL, NULL),
(154, 176, NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL, NULL),
(155, 177, NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL, NULL),
(156, 178, NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL, NULL),
(157, 179, NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL, NULL),
(158, 180, NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL, NULL),
(159, 181, NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL, NULL),
(160, 182, NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL, NULL),
(161, 183, NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL, NULL),
(162, 184, NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL, NULL),
(163, 185, NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL, NULL),
(164, 186, NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL, NULL),
(165, 187, NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL, NULL),
(166, 188, NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL, NULL),
(167, 189, NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL, NULL),
(168, 190, '', '', '', NULL, NULL, 1, NULL, NULL, NULL, NULL),
(169, 191, NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL, NULL),
(170, 192, NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL, NULL),
(171, 193, NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL, NULL),
(172, 194, NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL, NULL),
(173, 195, NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL, NULL),
(174, 196, NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL, NULL),
(175, 197, NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL, NULL),
(176, 198, NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL, NULL),
(177, 199, NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL, NULL),
(178, 200, NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL, NULL),
(179, 201, '', '', '', NULL, NULL, 1, NULL, NULL, NULL, NULL),
(180, 202, NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL, NULL),
(181, 203, NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL, NULL),
(182, 204, NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL, NULL),
(183, 205, NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL, NULL),
(184, 206, NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL, NULL),
(185, 207, NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL, NULL),
(186, 208, '', '', '', NULL, NULL, 1, NULL, NULL, NULL, NULL),
(187, 209, NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL, NULL),
(188, 210, NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL, NULL),
(189, 211, NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL, NULL),
(190, 212, NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL, NULL),
(191, 213, NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL, NULL),
(192, 214, NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL, NULL),
(193, 215, NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL, NULL),
(194, 216, NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL, NULL),
(195, 217, NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL, NULL),
(196, 218, NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL, NULL),
(197, 219, NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL, NULL),
(198, 220, NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL, NULL),
(199, 221, NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL, NULL),
(200, 222, NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL, NULL),
(201, 223, NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL, NULL),
(202, 224, NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL, NULL),
(203, 225, NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL, NULL),
(204, 226, NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL, NULL),
(205, 227, NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL, NULL),
(206, 228, NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL, NULL),
(207, 229, NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL, NULL),
(208, 230, NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL, NULL),
(209, 231, NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL, NULL),
(210, 232, NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL, NULL),
(211, 233, NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL, NULL),
(212, 234, NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL, NULL),
(213, 235, NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL, NULL),
(214, 236, NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL, NULL),
(215, 237, NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL, NULL),
(216, 238, NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL, NULL),
(217, 239, NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL, NULL),
(218, 240, NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL, NULL),
(219, 241, NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL, NULL),
(220, 242, NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL, NULL),
(221, 243, NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL, NULL),
(222, 244, NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL, NULL),
(223, 245, NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL, NULL),
(224, 246, NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL, NULL),
(225, 247, NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL, NULL),
(226, 248, NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL, NULL),
(227, 249, NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL, NULL),
(228, 250, NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL, NULL),
(229, 251, NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL, NULL),
(230, 252, NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL, NULL),
(231, 253, '', '', '', NULL, NULL, 1, NULL, NULL, NULL, NULL),
(232, 254, NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL, NULL),
(233, 255, NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL, NULL),
(234, 256, '', '', '', NULL, NULL, 1, NULL, NULL, NULL, NULL),
(235, 257, NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL, NULL),
(236, 258, NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL, NULL),
(237, 259, '', '', '', NULL, NULL, 1, NULL, NULL, '', NULL),
(238, 260, NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL, NULL),
(239, 261, NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL, NULL),
(240, 262, NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL, NULL),
(241, 263, NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL, NULL),
(242, 264, NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL, NULL),
(243, 265, NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL, NULL),
(244, 266, NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL, NULL),
(245, 267, NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL, NULL),
(246, 268, NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL, NULL),
(247, 269, NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL, NULL),
(248, 270, NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL, NULL),
(249, 271, NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL, NULL),
(250, 272, NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL, NULL),
(251, 273, NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL, NULL),
(252, 274, NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL, NULL),
(253, 275, NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL, NULL),
(254, 276, NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL, NULL),
(255, 277, '', '', '', NULL, NULL, 1, NULL, NULL, NULL, NULL),
(256, 278, NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL, NULL),
(257, 279, NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL, NULL),
(258, 280, NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL, NULL),
(259, 281, NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL, NULL),
(260, 282, NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL, NULL),
(261, 283, '', '', '', NULL, NULL, 1, NULL, NULL, NULL, NULL),
(262, 284, NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL, NULL),
(263, 285, NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL, NULL),
(264, 286, NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL, NULL),
(265, 287, NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL, NULL),
(266, 288, NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL, NULL),
(267, 289, NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL, NULL),
(268, 290, NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL, NULL),
(269, 291, NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL, NULL),
(270, 292, '', '', '', NULL, NULL, 1, NULL, NULL, NULL, NULL),
(271, 293, NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL, NULL),
(272, 294, NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL, NULL),
(273, 295, NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL, NULL),
(274, 296, NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL, NULL),
(275, 297, '', '', '', NULL, NULL, 1, NULL, NULL, NULL, NULL),
(276, 298, NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL, NULL),
(277, 299, NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL, NULL),
(278, 300, NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL, NULL),
(279, 301, NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL, NULL),
(280, 302, NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL, NULL),
(281, 303, '', '', '', NULL, NULL, 1, NULL, NULL, NULL, NULL),
(282, 304, NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL, NULL),
(283, 305, NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL, NULL),
(284, 306, NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL, NULL),
(285, 307, NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Структура таблицы `user_udecation`
--

CREATE TABLE `user_udecation` (
  `id` int NOT NULL,
  `id_user` int NOT NULL,
  `id_khatm_namud` int DEFAULT NULL,
  `id_hujjat` int DEFAULT NULL,
  `soli_xatm` int DEFAULT NULL,
  `silsila` varchar(10) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `number_hujjat` varchar(250) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `date_hujjat` varchar(16) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `number_scholl` varchar(500) DEFAULT NULL,
  `muasisa_name` varchar(500) DEFAULT NULL,
  `muasisa_lang` varchar(2) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `spec` varchar(500) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb3;

--
-- Дамп данных таблицы `user_udecation`
--

INSERT INTO `user_udecation` (`id`, `id_user`, `id_khatm_namud`, `id_hujjat`, `soli_xatm`, `silsila`, `number_hujjat`, `date_hujjat`, `number_scholl`, `muasisa_name`, `muasisa_lang`, `spec`) VALUES
(1, 23, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'tj', NULL),
(2, 24, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'tj', NULL),
(3, 25, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'tj', NULL),
(4, 26, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'tj', NULL),
(5, 27, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'tj', NULL),
(6, 28, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'tj', NULL),
(7, 29, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'tj', NULL),
(8, 30, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'tj', NULL),
(9, 31, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'tj', NULL),
(10, 32, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'tj', NULL),
(11, 33, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'tj', NULL),
(12, 34, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'tj', NULL),
(13, 35, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'tj', NULL),
(14, 36, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'tj', NULL),
(15, 37, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'tj', NULL),
(16, 38, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'tj', NULL),
(17, 39, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'tj', NULL),
(18, 40, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'tj', NULL),
(19, 41, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'tj', NULL),
(20, 42, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'tj', NULL),
(21, 43, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'tj', NULL),
(22, 44, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'tj', NULL),
(23, 45, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'tj', NULL),
(24, 46, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'tj', NULL),
(25, 47, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'tj', NULL),
(26, 48, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'tj', NULL),
(27, 49, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'tj', NULL),
(28, 50, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'tj', NULL),
(29, 51, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'tj', NULL),
(30, 52, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'tj', NULL),
(31, 53, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'tj', NULL),
(32, 54, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'tj', NULL),
(33, 55, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'tj', NULL),
(34, 56, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'tj', NULL),
(35, 57, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'tj', NULL),
(36, 58, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'tj', NULL),
(37, 59, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'tj', NULL),
(38, 60, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'tj', NULL),
(39, 61, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'tj', NULL),
(40, 62, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'tj', NULL),
(41, 63, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'tj', NULL),
(42, 64, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'tj', NULL),
(43, 65, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'tj', NULL),
(44, 66, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'tj', NULL),
(45, 67, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'tj', NULL),
(46, 68, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'tj', NULL),
(47, 69, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'tj', NULL),
(48, 70, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'tj', NULL),
(49, 71, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'tj', NULL),
(50, 72, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'tj', NULL),
(51, 73, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'tj', NULL),
(52, 74, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'tj', NULL),
(53, 75, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'tj', NULL),
(54, 76, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'tj', NULL),
(55, 77, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'tj', NULL),
(56, 78, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'tj', NULL),
(57, 79, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'tj', NULL),
(58, 80, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'tj', NULL),
(59, 81, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'tj', NULL),
(60, 82, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'tj', NULL),
(61, 83, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'tj', NULL),
(62, 84, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'tj', NULL),
(63, 85, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'tj', NULL),
(64, 86, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'tj', NULL),
(65, 87, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'tj', NULL),
(66, 88, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'tj', NULL),
(67, 89, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'tj', NULL),
(68, 90, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'tj', NULL),
(69, 91, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'tj', NULL),
(70, 92, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'tj', NULL),
(71, 93, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'tj', NULL),
(72, 94, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'tj', NULL),
(73, 95, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'tj', NULL),
(74, 96, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'tj', NULL),
(75, 97, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'tj', NULL),
(76, 98, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'tj', NULL),
(77, 99, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'tj', NULL),
(78, 100, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'tj', NULL),
(79, 101, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'tj', NULL),
(80, 102, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'tj', NULL),
(81, 103, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'tj', NULL),
(82, 104, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'tj', NULL),
(83, 105, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'tj', NULL),
(84, 106, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'tj', NULL),
(85, 107, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'tj', NULL),
(86, 108, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'tj', NULL),
(87, 109, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'tj', NULL),
(88, 110, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'tj', NULL),
(89, 111, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'tj', NULL),
(90, 112, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'tj', NULL),
(91, 113, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'tj', NULL),
(92, 114, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'tj', NULL),
(93, 115, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'tj', NULL),
(94, 116, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'tj', NULL),
(95, 117, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'tj', NULL),
(96, 118, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'tj', NULL),
(97, 119, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'tj', NULL),
(98, 120, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'tj', NULL),
(99, 121, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'tj', NULL),
(100, 122, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'tj', NULL),
(101, 123, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'tj', NULL),
(102, 124, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'tj', NULL),
(103, 125, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'tj', NULL),
(104, 126, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'tj', NULL),
(105, 127, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'tj', NULL),
(106, 128, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'tj', NULL),
(107, 129, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'tj', NULL),
(108, 130, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'tj', NULL),
(109, 131, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'tj', NULL),
(110, 132, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'tj', NULL),
(111, 133, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'tj', NULL),
(112, 134, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'tj', NULL),
(113, 135, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'tj', NULL),
(114, 136, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'tj', NULL),
(115, 137, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'tj', NULL),
(116, 138, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'tj', NULL),
(117, 139, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'tj', NULL),
(118, 140, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'tj', NULL),
(119, 141, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'tj', NULL),
(120, 142, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'tj', NULL),
(121, 143, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'tj', NULL),
(122, 144, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'tj', NULL),
(123, 145, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'tj', NULL),
(124, 146, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'tj', NULL),
(125, 147, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'tj', NULL),
(126, 148, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'tj', NULL),
(127, 149, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'tj', NULL),
(128, 150, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'tj', NULL),
(129, 151, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'tj', NULL),
(130, 152, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'tj', NULL),
(131, 153, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'tj', NULL),
(132, 154, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'tj', NULL),
(133, 155, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'tj', NULL),
(134, 156, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'tj', NULL),
(135, 157, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'tj', NULL),
(136, 158, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'tj', NULL),
(137, 159, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'tj', NULL),
(138, 160, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'tj', NULL),
(139, 161, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'tj', NULL),
(140, 162, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'tj', NULL),
(141, 163, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'tj', NULL),
(142, 164, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'tj', NULL),
(143, 165, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'tj', NULL),
(144, 166, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'tj', NULL),
(145, 167, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'tj', NULL),
(146, 168, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'tj', NULL),
(147, 169, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'tj', NULL),
(148, 170, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'tj', NULL),
(149, 171, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'tj', NULL),
(150, 172, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'tj', NULL),
(151, 173, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'tj', NULL),
(152, 174, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'tj', NULL),
(153, 175, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'tj', NULL),
(154, 176, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'tj', NULL),
(155, 177, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'tj', NULL),
(156, 178, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'tj', NULL),
(157, 179, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'tj', NULL),
(158, 180, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'tj', NULL),
(159, 181, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'tj', NULL),
(160, 182, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'tj', NULL),
(161, 183, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'tj', NULL),
(162, 184, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'tj', NULL),
(163, 185, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'tj', NULL),
(164, 186, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'tj', NULL),
(165, 187, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'tj', NULL),
(166, 188, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'tj', NULL),
(167, 189, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'tj', NULL),
(168, 190, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'tj', NULL),
(169, 191, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'tj', NULL),
(170, 192, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'tj', NULL),
(171, 193, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'tj', NULL),
(172, 194, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'tj', NULL),
(173, 195, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'tj', NULL),
(174, 196, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'tj', NULL),
(175, 197, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'tj', NULL),
(176, 198, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'tj', NULL),
(177, 199, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'tj', NULL),
(178, 200, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'tj', NULL),
(179, 201, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'tj', NULL),
(180, 202, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'tj', NULL),
(181, 203, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'tj', NULL),
(182, 204, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'tj', NULL),
(183, 205, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'tj', NULL),
(184, 206, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'tj', NULL),
(185, 207, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'tj', NULL),
(186, 208, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'tj', NULL),
(187, 209, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'tj', NULL),
(188, 210, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'tj', NULL),
(189, 211, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'tj', NULL),
(190, 212, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'tj', NULL),
(191, 213, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'tj', NULL),
(192, 214, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'tj', NULL),
(193, 215, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'tj', NULL),
(194, 216, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'tj', NULL),
(195, 217, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'tj', NULL),
(196, 218, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'tj', NULL),
(197, 219, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'tj', NULL),
(198, 220, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'tj', NULL),
(199, 221, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'tj', NULL),
(200, 222, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'tj', NULL),
(201, 223, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'tj', NULL),
(202, 224, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'tj', NULL),
(203, 225, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'tj', NULL),
(204, 226, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'tj', NULL),
(205, 227, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'tj', NULL),
(206, 228, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'tj', NULL),
(207, 229, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'tj', NULL),
(208, 230, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'tj', NULL),
(209, 231, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'tj', NULL),
(210, 232, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'tj', NULL),
(211, 233, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'tj', NULL),
(212, 234, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'tj', NULL),
(213, 235, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'tj', NULL),
(214, 236, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'tj', NULL),
(215, 237, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'tj', NULL),
(216, 238, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'tj', NULL),
(217, 239, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'tj', NULL),
(218, 240, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'tj', NULL),
(219, 241, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'tj', NULL),
(220, 242, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'tj', NULL),
(221, 243, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'tj', NULL),
(222, 244, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'tj', NULL),
(223, 245, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'tj', NULL),
(224, 246, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'tj', NULL),
(225, 247, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'tj', NULL),
(226, 248, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'tj', NULL),
(227, 249, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'tj', NULL),
(228, 250, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'tj', NULL),
(229, 251, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'tj', NULL),
(230, 252, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'tj', NULL),
(231, 253, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'tj', NULL),
(232, 254, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'tj', NULL),
(233, 255, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'tj', NULL),
(234, 256, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'tj', NULL),
(235, 257, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'tj', NULL),
(236, 258, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'tj', NULL),
(237, 259, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'tj', NULL),
(238, 260, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'tj', NULL),
(239, 261, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'tj', NULL),
(240, 262, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'tj', NULL),
(241, 263, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'tj', NULL),
(242, 264, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'tj', NULL),
(243, 265, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'tj', NULL),
(244, 266, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'tj', NULL),
(245, 267, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'tj', NULL),
(246, 268, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'tj', NULL),
(247, 269, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'tj', NULL),
(248, 270, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'tj', NULL),
(249, 271, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'tj', NULL),
(250, 272, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'tj', NULL),
(251, 273, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'tj', NULL),
(252, 274, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'tj', NULL),
(253, 275, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'tj', NULL),
(254, 276, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'tj', NULL),
(255, 277, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'tj', NULL),
(256, 278, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'tj', NULL),
(257, 279, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'tj', NULL),
(258, 280, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'tj', NULL),
(259, 281, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'tj', NULL),
(260, 282, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'tj', NULL),
(261, 283, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'tj', NULL),
(262, 284, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'tj', NULL),
(263, 285, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'tj', NULL),
(264, 286, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'tj', NULL),
(265, 287, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'tj', NULL),
(266, 288, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'tj', NULL),
(267, 289, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'tj', NULL),
(268, 290, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'tj', NULL),
(269, 291, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'tj', NULL),
(270, 292, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'tj', NULL),
(271, 293, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'tj', NULL),
(272, 294, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'tj', NULL),
(273, 295, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'tj', NULL),
(274, 296, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'tj', NULL),
(275, 297, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'tj', NULL),
(276, 298, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'tj', NULL),
(277, 299, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'tj', NULL),
(278, 300, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'tj', NULL),
(279, 301, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'tj', NULL),
(280, 302, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'tj', NULL),
(281, 303, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'tj', NULL),
(282, 304, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'tj', NULL),
(283, 305, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'tj', NULL),
(284, 306, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'tj', NULL),
(285, 307, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'tj', NULL);

-- --------------------------------------------------------

--
-- Структура таблицы `vazifaho`
--

CREATE TABLE `vazifaho` (
  `id` int NOT NULL,
  `name_tj` varchar(255) NOT NULL,
  `name_ru` varchar(255) NOT NULL,
  `full_name_tj` tinytext NOT NULL,
  `full_name_ru` tinytext NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb3;

-- --------------------------------------------------------

--
-- Структура таблицы `vazi_oilavi`
--

CREATE TABLE `vazi_oilavi` (
  `id` int NOT NULL,
  `title` varchar(500) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb3;

--
-- Дамп данных таблицы `vazi_oilavi`
--

INSERT INTO `vazi_oilavi` (`id`, `title`) VALUES
(1, 'Ятим нест'),
(2, 'Ятими кул'),
(3, 'Модар надорад'),
(4, 'Падар надорад');

-- --------------------------------------------------------

--
-- Структура таблицы `weeks`
--

CREATE TABLE `weeks` (
  `id` int NOT NULL,
  `title` varchar(50) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb3;

--
-- Дамп данных таблицы `weeks`
--

INSERT INTO `weeks` (`id`, `title`) VALUES
(1, 'Ҳафтаи 1'),
(2, 'Ҳафтаи 2'),
(3, 'Ҳафтаи 3'),
(4, 'Ҳафтаи 4'),
(5, 'Ҳафтаи 5'),
(6, 'Ҳафтаи 6'),
(7, 'Ҳафтаи 7'),
(8, 'Ҳафтаи 8'),
(9, 'Ҳафтаи 9'),
(10, 'Ҳафтаи 10'),
(11, 'Ҳафтаи 11'),
(12, 'Ҳафтаи 12'),
(13, 'Ҳафтаи 13'),
(14, 'Ҳафтаи 14'),
(15, 'Ҳафтаи 15'),
(16, 'Ҳафтаи 16');

-- --------------------------------------------------------

--
-- Структура таблицы `_datasonline`
--

CREATE TABLE `_datasonline` (
  `id` int NOT NULL,
  `id_user` int NOT NULL,
  `url` varchar(500) NOT NULL,
  `ip` varchar(50) DEFAULT NULL,
  `page_title` varchar(500) NOT NULL,
  `date` date NOT NULL,
  `first_time` varchar(10) DEFAULT NULL,
  `last_time` varchar(10) DEFAULT NULL,
  `counter` int NOT NULL DEFAULT '1'
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb3;

--
-- Дамп данных таблицы `_datasonline`
--

INSERT INTO `_datasonline` (`id`, `id_user`, `url`, `ip`, `page_title`, `date`, `first_time`, `last_time`, `counter`) VALUES
(1, 3, '/admin/?option=students&action=list&id_faculty=1&id_s_l=1&id_s_v=1&id_course=1&id_spec=12&id_group=1', '91.218.160.222', 'Донишҷӯён /  /  /  /  /  / ', '2025-05-14', '17:50:01', '17:50:39', 3),
(2, 3, '/admin/', '91.218.160.222', 'Омори гурӯҳҳо', '2025-05-14', '17:50:49', NULL, 1),
(3, 3, '/modules/students/students_ajax.php?option=showuseractions', '91.218.160.222', 'Дидани амалиётҳо: Ibrohim', '2025-05-14', '17:51:32', NULL, 1),
(4, 4, '/admin/?option=students&action=list&id_faculty=1&id_s_l=1&id_s_v=1&id_course=1&id_spec=12&id_group=1', '109.75.56.57', 'Донишҷӯён /  /  /  /  /  / ', '2025-05-14', '17:52:13', '17:52:24', 2),
(5, 4, '/admin/', '109.75.56.57', 'Омори гурӯҳҳо', '2025-05-14', '17:52:29', NULL, 1),
(6, 3, '/admin/?option=commission&action=studentstatistic&id_faculty=1', '91.218.160.222', 'Омори донишҷуён', '2025-05-14', '17:58:54', '18:03:35', 13),
(7, 4, '/admin/?option=commission&action=studentstatistic&id_faculty=1', '185.105.228.139', 'Омори донишҷуён', '2025-05-14', '20:57:26', NULL, 1),
(8, 4, '/admin/', '185.194.199.21', 'Омори гурӯҳҳо', '2025-05-15', '07:50:03', '14:01:41', 29),
(9, 4, '/admin/?option=students&action=list&id_faculty=1&id_s_l=1&id_s_v=1&id_course=1&id_spec=12&id_group=1', '185.194.199.21', 'Донишҷӯён /  /  /  /  /  / ', '2025-05-15', '07:50:18', NULL, 1),
(10, 4, '/admin/?option=commission&action=studentstatistic&id_faculty=1', '185.194.199.21', 'Омори донишҷуён', '2025-05-15', '07:50:27', '08:47:12', 2),
(11, 4, '/admin/?option=helper&action=mmt&code=107', '185.194.199.21', 'Интихоб дар ММТ: ДТТ', '2025-05-15', '08:12:13', NULL, 1),
(12, 4, '/admin/?option=helper&action=mmt&code=118', '185.194.199.21', 'Интихоб дар ММТ: ', '2025-05-15', '08:12:59', '08:13:48', 2),
(13, 4, '/admin/?option=print&action=contingent', '185.194.199.21', 'Контингент', '2025-05-15', '08:25:54', '08:47:45', 2),
(14, 4, '/admin/?option=students&action=add', '185.194.199.21', 'Иловакунии донишҷӯ', '2025-05-15', '08:46:17', '16:06:05', 243),
(15, 4, '/admin/?option=students&action=insert', '185.194.199.21', 'Иловакунии донишҷӯ: Абдурамонова Нафиса Убайдуллоевна', '2025-05-15', '08:47:07', NULL, 1),
(16, 4, '/admin/?option=students&action=harakat', '185.194.199.21', 'Ҳаракат', '2025-05-15', '08:48:12', '14:04:35', 3),
(17, 4, '/admin/?option=students&action=insert', '185.194.199.21', 'Иловакунии донишҷӯ: Азизов Акбарҷон Қулназарович', '2025-05-15', '09:36:35', NULL, 1),
(18, 4, '/admin/?option=students&action=insert', '185.194.199.21', 'Иловакунии донишҷӯ: Анақулов Нозимҷон Умедҷонович', '2025-05-15', '09:36:58', NULL, 1),
(19, 4, '/admin/?option=students&action=insert', '185.194.199.21', 'Иловакунии донишҷӯ: Калонов Муҳаммад Баҳридинович', '2025-05-15', '09:37:19', NULL, 1),
(20, 4, '/admin/?option=students&action=insert', '185.194.199.21', 'Иловакунии донишҷӯ: Ашурқулов Дилшод Давронович', '2025-05-15', '10:13:25', NULL, 1),
(21, 4, '/admin/?option=students&action=insert', '185.194.199.21', 'Иловакунии донишҷӯ: Баротов Шаҳриёр Қурбоналиевич', '2025-05-15', '10:14:13', NULL, 1),
(22, 4, '/admin/?option=students&action=insert', '185.194.199.21', 'Иловакунии донишҷӯ: Бердова Оҷатбегим Бердовна', '2025-05-15', '10:14:45', NULL, 1),
(23, 4, '/admin/?option=students&action=insert', '185.194.199.21', 'Иловакунии донишҷӯ: Бобоев Ораш Абдусаторович', '2025-05-15', '10:15:14', NULL, 1),
(24, 4, '/admin/?option=students&action=insert', '185.194.199.21', 'Иловакунии донишҷӯ: Иброҳимзода Фархунда Низомиддин ', '2025-05-15', '10:15:39', NULL, 1),
(25, 4, '/admin/?option=students&action=insert', '185.194.199.21', 'Иловакунии донишҷӯ: Қосимов Шаҳбоз Қудбидинович', '2025-05-15', '10:16:04', NULL, 1),
(26, 4, '/admin/?option=students&action=insert', '185.194.199.21', 'Иловакунии донишҷӯ: Мирзоев Акмалҷон Рустамович', '2025-05-15', '10:16:27', NULL, 1),
(27, 4, '/admin/?option=students&action=insert', '185.194.199.21', 'Иловакунии донишҷӯ: Насурдинов Саймуддин Бадриддинович', '2025-05-15', '10:17:02', NULL, 1),
(28, 4, '/admin/?option=students&action=insert', '185.194.199.21', 'Иловакунии донишҷӯ: Рачабов Шаҳриёр Худоёрович', '2025-05-15', '10:17:33', NULL, 1),
(29, 4, '/admin/?option=students&action=insert', '185.194.199.21', 'Иловакунии донишҷӯ: Саймуминзода Муҳаммад Саймумин', '2025-05-15', '10:18:00', NULL, 1),
(30, 4, '/admin/?option=students&action=insert', '185.194.199.21', 'Иловакунии донишҷӯ: Салимов Аминҷон Валиевич', '2025-05-15', '10:18:23', NULL, 1),
(31, 4, '/admin/?option=students&action=insert', '185.194.199.21', 'Иловакунии донишҷӯ: Сафаров Саймуҳаммад Ҷурахонович', '2025-05-15', '10:18:45', NULL, 1),
(32, 4, '/admin/?option=students&action=insert', '185.194.199.21', 'Иловакунии донишҷӯ: Содаткадамова Мадина Мубораккадаовна', '2025-05-15', '10:19:07', NULL, 1),
(33, 4, '/admin/?option=students&action=insert', '185.194.199.21', 'Иловакунии донишҷӯ: Ҷаборзода Маҳмуд Шодиқурбон ', '2025-05-15', '10:19:43', NULL, 1),
(34, 4, '/admin/?option=students&action=insert', '185.194.199.21', 'Иловакунии донишҷӯ: Шохуморова Ҳоҷатбегим Шаҳриёровна', '2025-05-15', '10:20:06', NULL, 1),
(35, 4, '/admin/?option=students&action=insert', '185.194.199.21', 'Иловакунии донишҷӯ: Ҷуъмахонзода Муҳаммадҷон', '2025-05-15', '10:20:30', NULL, 1),
(36, 4, '/admin/?option=students&action=insert', '185.194.199.21', 'Иловакунии донишҷӯ: Бозоров Масрур Ҳикматуллоевич', '2025-05-15', '10:20:57', NULL, 1),
(37, 4, '/admin/?option=students&action=insert', '185.194.199.21', 'Иловакунии донишҷӯ: Назарзода Алиҷон Муҳаммадвали', '2025-05-15', '10:21:42', NULL, 1),
(38, 4, '/admin/?option=students&action=list&id_faculty=1&id_s_l=1&id_s_v=1&id_course=2&id_spec=14&id_group=1', '185.194.199.21', 'Донишҷӯён / ИТРЗС / Бакалавр / Рӯзона / Курси 2 / 1-260202 / та', '2025-05-15', '10:22:10', '10:46:09', 7),
(39, 4, '/admin/?option=students&action=update_student', '185.194.199.21', 'Таҳриркунии донишҷӯ Рачабов Шаҳриёр Худоёрович', '2025-05-15', '10:23:47', NULL, 1),
(40, 4, '/admin/?option=students&action=insert', '185.194.199.21', 'Иловакунии донишҷӯ: Абдуллоев Муҳаммадамин Мадаминович', '2025-05-15', '10:25:13', NULL, 1),
(41, 4, '/admin/?option=students&action=insert', '185.194.199.21', 'Иловакунии донишҷӯ: Асозода Мухаммадисо Барҳом', '2025-05-15', '10:25:37', NULL, 1),
(42, 4, '/admin/?option=students&action=insert', '185.194.199.21', 'Иловакунии донишҷӯ: Зикриёи Муродали Сафарзода', '2025-05-15', '10:26:00', NULL, 1),
(43, 4, '/admin/?option=students&action=insert', '185.194.199.21', 'Иловакунии донишҷӯ: Имомқулзода Фаворис Уктамҷон', '2025-05-15', '10:26:21', NULL, 1),
(44, 4, '/admin/?option=students&action=insert', '185.194.199.21', 'Иловакунии донишҷӯ: Камолов Сунаътулло Маҳмадрозиқович', '2025-05-15', '10:26:42', NULL, 1),
(45, 4, '/admin/?option=students&action=insert', '185.194.199.21', 'Иловакунии донишҷӯ: Маматқулов Умаралӣ Бозорович', '2025-05-15', '10:27:04', NULL, 1),
(46, 4, '/admin/?option=students&action=insert', '185.194.199.21', 'Иловакунии донишҷӯ: Мирзоев Абубакр Зайдуллоевич', '2025-05-15', '10:27:27', NULL, 1),
(47, 4, '/admin/?option=students&action=insert', '185.194.199.21', 'Иловакунии донишҷӯ: Мирзоев Фаррух Ҷамшедович', '2025-05-15', '10:27:46', NULL, 1),
(48, 4, '/admin/?option=students&action=insert', '185.194.199.21', 'Иловакунии донишҷӯ: Мирзоева Наргис Давлаталиевна ', '2025-05-15', '10:28:08', NULL, 1),
(49, 4, '/admin/?option=students&action=insert', '185.194.199.21', 'Иловакунии донишҷӯ: Наботов Султонҷон Назриевич', '2025-05-15', '10:28:30', NULL, 1),
(50, 4, '/admin/?option=students&action=insert', '185.194.199.21', 'Иловакунии донишҷӯ: Пирмаҳмадзода Эмомали Зафар', '2025-05-15', '10:28:48', NULL, 1),
(51, 4, '/admin/?option=students&action=insert', '185.194.199.21', 'Иловакунии донишҷӯ: Пушкашова Ганҷина Дилдорбековна', '2025-05-15', '10:29:05', NULL, 1),
(52, 4, '/admin/?option=students&action=insert', '185.194.199.21', 'Иловакунии донишҷӯ: Раҳимова Шоҳзода Комиловна', '2025-05-15', '10:29:26', NULL, 1),
(53, 4, '/admin/?option=students&action=insert', '185.194.199.21', 'Иловакунии донишҷӯ: Раҷабов Умед Ҷ', '2025-05-15', '10:29:45', NULL, 1),
(54, 4, '/admin/?option=students&action=insert', '185.194.199.21', 'Иловакунии донишҷӯ: Хабибова Фарзина Султоновна', '2025-05-15', '10:30:02', NULL, 1),
(55, 4, '/admin/?option=students&action=insert', '185.194.199.21', 'Иловакунии донишҷӯ: Холзода Хуҷаиброим Гулҳамад', '2025-05-15', '10:30:27', NULL, 1),
(56, 4, '/admin/?option=students&action=insert', '185.194.199.21', 'Иловакунии донишҷӯ: Қаландарзода Амин Исҳоқ', '2025-05-15', '10:30:56', NULL, 1),
(57, 4, '/admin/?option=students&action=insert', '185.194.199.21', 'Иловакунии донишҷӯ: Шарипов Набиҷон Маҳмадюсуфович', '2025-05-15', '10:31:24', NULL, 1),
(58, 4, '/admin/?option=students&action=insert', '185.194.199.21', 'Иловакунии донишҷӯ: Сафарзода Аъзамшоҳи Саидшариф', '2025-05-15', '10:31:58', NULL, 1),
(59, 4, '/admin/?option=students&action=insert', '185.194.199.21', 'Иловакунии донишҷӯ: Дониёров Зайнур', '2025-05-15', '10:32:27', NULL, 1),
(60, 4, '/admin/?option=students&action=list&id_faculty=1&id_s_l=1&id_s_v=1&id_course=2&id_spec=14&id_group=3', '185.194.199.21', 'Донишҷӯён / ИТРЗС / Бакалавр / Рӯзона / Курси 2 / 1-260202 / тб', '2025-05-15', '10:32:54', '11:08:24', 6),
(61, 4, '/admin/?option=students&action=update_student', '185.194.199.21', 'Таҳриркунии донишҷӯ Дониёров Зайнур', '2025-05-15', '10:34:26', NULL, 1),
(62, 4, '/admin/?option=students&action=list&id_faculty=1&id_s_l=1&id_s_v=1&id_course=1&id_spec=12&id_group=1', '185.194.199.21', 'Донишҷӯён / ИТРЗС / Бакалавр / Рӯзона / Курси 1 / 1-26020101 / та', '2025-05-15', '10:34:53', '14:07:27', 8),
(63, 4, '/admin/?option=students&action=insert', '185.194.199.21', 'Иловакунии донишҷӯ: Миров Вайсиддин Муҳриддинович', '2025-05-15', '10:36:20', NULL, 1),
(64, 4, '/admin/?option=students&action=insert', '185.194.199.21', 'Иловакунии донишҷӯ: Набизода Фазлиддин Авродхон', '2025-05-15', '10:36:38', NULL, 1),
(65, 4, '/admin/?option=students&action=insert', '185.194.199.21', 'Иловакунии донишҷӯ: Раҷабалиев Маҳмуд Парвизович', '2025-05-15', '10:37:00', NULL, 1),
(66, 4, '/admin/?option=students&action=insert', '185.194.199.21', 'Иловакунии донишҷӯ: Сафарализода Меҳроб Хушвахт', '2025-05-15', '10:37:15', NULL, 1),
(67, 4, '/admin/?option=students&action=qarzdorho&id_faculty=1&id_s_l=1&id_s_v=1&id_course=2&id_spec=14&id_group=1&s_y=25&h_y=1', '185.194.199.21', 'Қарздорҳои ин гурӯҳ / ИТРЗС / Бакалавр / Рӯзона / Курси 2 / 1-260202 / та', '2025-05-15', '10:42:19', NULL, 1),
(68, 4, '/admin/?option=students&action=insert', '185.194.199.21', 'Иловакунии донишҷӯ: Абдуллоева Анисабону Баҳриддиновна', '2025-05-15', '10:44:18', NULL, 1),
(69, 4, '/admin/?option=students&action=insert', '185.194.199.21', 'Иловакунии донишҷӯ: Абдуллозода Комрон Алишер', '2025-05-15', '10:44:39', NULL, 1),
(70, 4, '/admin/?option=students&action=insert', '185.194.199.21', 'Иловакунии донишҷӯ: Аброров Рамазон Қуватбекович', '2025-05-15', '10:45:06', NULL, 1),
(71, 4, '/admin/?option=students&action=insert', '185.194.199.21', 'Иловакунии донишҷӯ: Ғуломов Рустам Икромиддинович', '2025-05-15', '10:45:28', NULL, 1),
(72, 4, '/admin/?option=students&action=insert', '185.194.199.21', 'Иловакунии донишҷӯ: Исмоилзода Идимох Исуф', '2025-05-15', '10:45:49', NULL, 1),
(73, 4, '/admin/?option=students&action=list&id_faculty=1&id_s_l=1&id_s_v=1&id_course=2&id_spec=15&id_group=1', '185.194.199.21', 'Донишҷӯён / ИТРЗС / Бакалавр / Рӯзона / Курси 2 / 1-26020203 / та', '2025-05-15', '10:46:18', '11:08:36', 4),
(74, 4, '/admin/?option=students&action=update_student', '185.194.199.21', 'Таҳриркунии донишҷӯ Исмоилзода Идимох Исуф', '2025-05-15', '10:46:29', NULL, 1),
(75, 4, '/admin/?option=students&action=insert', '185.194.199.21', 'Иловакунии донишҷӯ: Кабутзода Ҳадиятулло Абдухалил', '2025-05-15', '10:47:03', NULL, 1),
(76, 4, '/admin/?option=students&action=insert', '185.194.199.21', 'Иловакунии донишҷӯ: Қамчинов Суҳроб Рустамович', '2025-05-15', '10:47:22', NULL, 1),
(77, 4, '/admin/?option=students&action=insert', '185.194.199.21', 'Иловакунии донишҷӯ: Қосимов Билолидин Тоҷиддинович', '2025-05-15', '10:47:38', NULL, 1),
(78, 4, '/admin/?option=students&action=insert', '185.194.199.21', 'Иловакунии донишҷӯ: Қувватзода Самариддин Ҳасан', '2025-05-15', '10:48:03', NULL, 1),
(79, 4, '/admin/?option=students&action=insert', '185.194.199.21', 'Иловакунии донишҷӯ: Назарзода Шарифчон Абдувохид', '2025-05-15', '10:48:21', NULL, 1),
(80, 4, '/admin/?option=students&action=insert', '185.194.199.21', 'Иловакунии донишҷӯ: Наимов Умар Шоҳмуродович', '2025-05-15', '10:48:39', NULL, 1),
(81, 4, '/admin/?option=students&action=insert', '185.194.199.21', 'Иловакунии донишҷӯ: Нозанини Чамшед', '2025-05-15', '10:49:05', NULL, 1),
(82, 4, '/admin/?option=students&action=insert', '185.194.199.21', 'Иловакунии донишҷӯ: Саидов Фазлиддин Ҷумаевич', '2025-05-15', '10:49:26', NULL, 1),
(83, 4, '/admin/?option=students&action=insert', '185.194.199.21', 'Иловакунии донишҷӯ: Сафарзода Холмуҳамад Абдусалом', '2025-05-15', '10:49:44', NULL, 1),
(84, 4, '/admin/?option=students&action=insert', '185.194.199.21', 'Иловакунии донишҷӯ: Фариддуни Сайҷафар ', '2025-05-15', '10:50:08', NULL, 1),
(85, 4, '/admin/?option=students&action=insert', '185.194.199.21', 'Иловакунии донишҷӯ: Фозилова Камила Мироншоевна', '2025-05-15', '10:50:30', NULL, 1),
(86, 4, '/admin/?option=students&action=insert', '185.194.199.21', 'Иловакунии донишҷӯ: Хабибзода Бахтовари Мухиддин', '2025-05-15', '10:50:59', NULL, 1),
(87, 4, '/admin/?option=students&action=insert', '185.194.199.21', 'Иловакунии донишҷӯ: Хошоков Муҳаммадамин Раҷабоевич', '2025-05-15', '10:51:29', NULL, 1),
(88, 4, '/admin/?option=students&action=insert', '185.194.199.21', 'Иловакунии донишҷӯ: Ҷобирзода Маҳмадали Исломуддин', '2025-05-15', '10:51:52', NULL, 1),
(89, 4, '/admin/?option=students&action=insert', '185.194.199.21', 'Иловакунии донишҷӯ: Шарифзода Суҳробҷон Олимшоҳ', '2025-05-15', '10:52:15', NULL, 1),
(90, 4, '/admin/?option=students&action=insert', '185.194.199.21', 'Иловакунии донишҷӯ: Ярханов Рахимҷон Наимҷонович', '2025-05-15', '10:52:32', NULL, 1),
(91, 4, '/admin/?option=students&action=insert', '185.194.199.21', 'Иловакунии донишҷӯ: Абдуқаҳоров Исломҷон Абдулҳакимович', '2025-05-15', '10:54:52', NULL, 1),
(92, 4, '/admin/?option=students&action=insert', '185.194.199.21', 'Иловакунии донишҷӯ: Алишеров Нур Алишерович', '2025-05-15', '10:55:25', NULL, 1),
(93, 4, '/admin/?option=students&action=insert', '185.194.199.21', 'Иловакунии донишҷӯ: Ашуров Қодирҷон Олимҷонович', '2025-05-15', '10:56:29', NULL, 1),
(94, 4, '/admin/?option=students&action=insert', '185.194.199.21', 'Иловакунии донишҷӯ: Бобохонов Муртазо', '2025-05-15', '10:56:48', NULL, 1),
(95, 4, '/admin/?option=students&action=insert', '185.194.199.21', 'Иловакунии донишҷӯ: Зокирзода Қудрат Абдумуслим', '2025-05-15', '10:57:04', NULL, 1),
(96, 4, '/admin/?option=students&action=insert', '185.194.199.21', 'Иловакунии донишҷӯ: Камолзода Амруллои Олимхон ', '2025-05-15', '10:57:22', NULL, 1),
(97, 4, '/admin/?option=students&action=insert', '185.194.199.21', 'Иловакунии донишҷӯ: Каримзода Хушназар', '2025-05-15', '10:57:39', NULL, 1),
(98, 4, '/admin/?option=students&action=insert', '185.194.199.21', 'Иловакунии донишҷӯ: Қурбонов Муҳаммадшариф Муҳубидинович', '2025-05-15', '10:59:27', NULL, 1),
(99, 4, '/admin/?option=students&action=insert', '185.194.199.21', 'Иловакунии донишҷӯ: Назаров Шаҳром Ашуралиеввич', '2025-05-15', '10:59:56', NULL, 1),
(100, 4, '/admin/?option=students&action=insert', '185.194.199.21', 'Иловакунии донишҷӯ: Расулов Ёқубҷон Алишерович', '2025-05-15', '11:00:14', NULL, 1),
(101, 4, '/admin/?option=students&action=insert', '185.194.199.21', 'Иловакунии донишҷӯ: Раҷабова Фархунда Муҳаммадовна ', '2025-05-15', '11:01:15', NULL, 1),
(102, 4, '/admin/?option=students&action=insert', '185.194.199.21', 'Иловакунии донишҷӯ: Саидов Зоиршоҳ', '2025-05-15', '11:01:46', NULL, 1),
(103, 4, '/admin/?option=students&action=insert', '185.194.199.21', 'Иловакунии донишҷӯ: Сатторов Муҳаммад Шоҳимардонович', '2025-05-15', '11:02:17', NULL, 1),
(104, 4, '/admin/?option=students&action=insert', '185.194.199.21', 'Иловакунии донишҷӯ: Сафарзода Саидмаҳмуд', '2025-05-15', '11:02:40', NULL, 1),
(105, 4, '/admin/?option=students&action=insert', '185.194.199.21', 'Иловакунии донишҷӯ: Сафарзода Саъдӣ Шарафиддин ', '2025-05-15', '11:02:57', NULL, 1),
(106, 4, '/admin/?option=students&action=insert', '185.194.199.21', 'Иловакунии донишҷӯ: Тураев Шаҳбоз Дилшодович', '2025-05-15', '11:03:18', NULL, 1),
(107, 4, '/admin/?option=students&action=insert', '185.194.199.21', 'Иловакунии донишҷӯ: Фаридуни Убайдулло', '2025-05-15', '11:03:50', NULL, 1),
(108, 4, '/admin/?option=students&action=insert', '185.194.199.21', 'Иловакунии донишҷӯ: Ҳавлоев Фарух Тоҳирҷонович', '2025-05-15', '11:04:14', NULL, 1),
(109, 4, '/admin/?option=students&action=insert', '185.194.199.21', 'Иловакунии донишҷӯ: Ҳасанов Меҳроб Абдусаломович', '2025-05-15', '11:04:35', NULL, 1),
(110, 4, '/admin/?option=students&action=insert', '185.194.199.21', 'Иловакунии донишҷӯ: Ҳусейнов Сафарбек Ҳамидуллоевич', '2025-05-15', '11:07:06', NULL, 1),
(111, 4, '/admin/?option=students&action=insert', '185.194.199.21', 'Иловакунии донишҷӯ: Ҳусенов Муҳаммадшо Қутбидинович', '2025-05-15', '11:07:30', NULL, 1),
(112, 4, '/admin/?option=students&action=insert', '185.194.199.21', 'Иловакунии донишҷӯ: Шайхов Насимҷон Муқимович', '2025-05-15', '11:07:52', NULL, 1),
(113, 4, '/admin/?option=students&action=insert', '185.194.199.21', 'Иловакунии донишҷӯ: Шарипов Абубакр Давлатхоҷаевич', '2025-05-15', '11:08:13', NULL, 1),
(114, 4, '/admin/?option=students&action=list&id_faculty=1&id_s_l=1&id_s_v=1&id_course=2&id_spec=6&id_group=1', '185.194.199.21', 'Донишҷӯён / ИТРЗС / Бакалавр / Рӯзона / Курси 2 / 1-40010202 / та', '2025-05-15', '11:08:54', '14:06:13', 5),
(115, 4, '/admin/?option=students&action=update_student', '185.194.199.21', 'Таҳриркунии донишҷӯ Шарипов Абубакр Давлатхоҷаевич', '2025-05-15', '11:09:05', NULL, 1),
(116, 4, '/admin/?option=students&action=insert', '185.194.199.21', 'Иловакунии донишҷӯ: Шарифзода Рамазон Иброҳим', '2025-05-15', '11:09:42', NULL, 1),
(117, 4, '/admin/?option=students&action=insert', '185.194.199.21', 'Иловакунии донишҷӯ: Шаҳруллоҳи Одил', '2025-05-15', '11:11:26', NULL, 1),
(118, 4, '/admin/?option=students&action=insert', '185.194.199.21', 'Иловакунии донишҷӯ: Эмомзода Дилафруз Намозали', '2025-05-15', '11:12:22', NULL, 1),
(119, 4, '/admin/?option=students&action=insert', '185.194.199.21', 'Иловакунии донишҷӯ: Манонов Сорбон', '2025-05-15', '11:13:03', NULL, 1),
(120, 4, '/admin/?option=students&action=insert', '185.194.199.21', 'Иловакунии донишҷӯ: Гулов Раҷабмаҳмад', '2025-05-15', '11:13:53', NULL, 1),
(121, 4, '/admin/?option=students&action=insert', '185.194.199.21', 'Иловакунии донишҷӯ: Ҷабборов Шукруллоҳ Фатҳуллоевич ', '2025-05-15', '11:14:26', NULL, 1),
(122, 4, '/admin/?option=students&action=insert', '185.194.199.21', 'Иловакунии донишҷӯ: Абдураҳимзода Мухаммадёсин Носир', '2025-05-15', '11:15:55', NULL, 1),
(123, 4, '/admin/?option=students&action=insert', '185.194.199.21', 'Иловакунии донишҷӯ: Акобирзода Хаёмиддин Нурулло', '2025-05-15', '11:16:19', NULL, 1),
(124, 4, '/admin/?option=students&action=insert', '185.194.199.21', 'Иловакунии донишҷӯ: Ахмадчони Саймуддин', '2025-05-15', '11:16:39', NULL, 1),
(125, 4, '/admin/?option=students&action=insert', '185.194.199.21', 'Иловакунии донишҷӯ: Давлатов Раҷабали Рустамҷонович', '2025-05-15', '11:17:06', NULL, 1),
(126, 4, '/admin/?option=students&action=insert', '185.194.199.21', 'Иловакунии донишҷӯ: Исоев Мухибулло Фуркатжонович', '2025-05-15', '11:17:27', NULL, 1),
(127, 4, '/admin/?option=students&action=insert', '185.194.199.21', 'Иловакунии донишҷӯ: Меликзода Илҳомуддин Шамсулло', '2025-05-15', '11:17:49', NULL, 1),
(128, 4, '/admin/?option=students&action=insert', '185.194.199.21', 'Иловакунии донишҷӯ: Насуллоева Тутёбегим Насуллоевна', '2025-05-15', '11:18:10', NULL, 1),
(129, 4, '/admin/?option=students&action=insert', '185.194.199.21', 'Иловакунии донишҷӯ: Одинаев Илёс Шомудинович', '2025-05-15', '11:18:37', NULL, 1),
(130, 4, '/admin/?option=students&action=insert', '185.194.199.21', 'Иловакунии донишҷӯ: Парвинзода  Абрунисо Парвин', '2025-05-15', '11:19:01', NULL, 1),
(131, 4, '/admin/?option=students&action=insert', '185.194.199.21', 'Иловакунии донишҷӯ: Рафизода Муҳсин Муҳаммади', '2025-05-15', '11:19:26', NULL, 1),
(132, 4, '/admin/?option=students&action=insert', '185.194.199.21', 'Иловакунии донишҷӯ: Раҳимов Мудасир Фарҳодович', '2025-05-15', '11:19:47', NULL, 1),
(133, 4, '/admin/?option=students&action=insert', '185.194.199.21', 'Иловакунии донишҷӯ: Раҳимов Ҳайдаршоҳ Масъудович', '2025-05-15', '11:20:08', NULL, 1),
(134, 4, '/admin/?option=students&action=list&id_faculty=1&id_s_l=1&id_s_v=1&id_course=2&id_spec=9&id_group=1', '185.194.199.21', 'Донишҷӯён / ИТРЗС / Бакалавр / Рӯзона / Курси 2 / 1-40010103 / та', '2025-05-15', '11:20:32', '13:41:09', 4),
(135, 4, '/admin/?option=search&action=list&word=%D0%B4%D0%B0%D0%B2%D0%BB%D0%B0%D1%82%D0%BE%D0%B2', '185.194.199.21', 'Ҷустуҷу: давлатов', '2025-05-15', '11:22:03', '11:22:19', 2),
(136, 4, '/admin/?option=students&action=update_student', '185.194.199.21', 'Таҳриркунии донишҷӯ Давлатов Раҷабали Рустамҷонович', '2025-05-15', '11:22:19', NULL, 1),
(137, 4, '/admin/?option=students&action=insert', '185.194.199.21', 'Иловакунии донишҷӯ: Раҳмонов Маҳфулло Шарифхонович', '2025-05-15', '11:22:50', NULL, 1),
(138, 4, '/admin/?option=students&action=insert', '185.194.199.21', 'Иловакунии донишҷӯ: Сангов Шаҳром Баҳромович', '2025-05-15', '11:23:13', NULL, 1),
(139, 4, '/admin/?option=students&action=insert', '185.194.199.21', 'Иловакунии донишҷӯ: Сафаров Исмоил Ҳокимҷонович', '2025-05-15', '11:23:32', NULL, 1),
(140, 4, '/admin/?option=students&action=insert', '185.194.199.21', 'Иловакунии донишҷӯ: Хушмуроди Сафархон', '2025-05-15', '11:23:49', NULL, 1),
(141, 4, '/admin/?option=students&action=insert', '185.194.199.21', 'Иловакунии донишҷӯ: Ҳабибуллозода  Субҳон Давлатҷон', '2025-05-15', '11:24:17', NULL, 1),
(142, 4, '/admin/?option=students&action=insert', '185.194.199.21', 'Иловакунии донишҷӯ: Ҷалолов Суҳбатиллоҳ  Бахтибекович', '2025-05-15', '11:24:56', NULL, 1),
(143, 4, '/admin/?option=search&action=list&word=%D0%A1%D0%B0%D1%84%D0%B0%D1%80%D0%B0%D0%BB%D0%B8%D0%B7%D0%BE%D0%B4%D0%B0%20%D0%9C%D0%B5%D2%B3%D1%80%D0%BE%D0%B1%20%D0%A5%D1%83%D1%88%D0%B2%D0%B0%D1%85%D1%82', '185.194.199.21', 'Ҷустуҷу: Сафарализода Меҳроб Хушвахт', '2025-05-15', '11:36:51', '11:36:58', 2),
(144, 4, '/admin/?option=students&action=update_student', '185.194.199.21', 'Таҳриркунии донишҷӯ Сафарализода Меҳроб Хушвахт', '2025-05-15', '11:36:58', NULL, 1),
(145, 4, '/admin/?option=students&action=insert', '185.194.199.21', 'Иловакунии донишҷӯ: Саъидов Ёқубҷон Давлатбекович', '2025-05-15', '11:37:22', NULL, 1),
(146, 4, '/admin/?option=students&action=insert', '185.194.199.21', 'Иловакунии донишҷӯ: Ҳасанов Шаҳобиддин Нозирович', '2025-05-15', '11:37:44', NULL, 1),
(147, 4, '/admin/?option=search&action=list&word=%D0%A1%D0%B0%D1%8A%D0%B8%D0%B4%D0%BE%D0%B2%20%D0%81%D2%9B%D1%83%D0%B1%D2%B7%D0%BE%D0%BD%20%D0%94%D0%B0%D0%B2%D0%BB%D0%B0%D1%82%D0%B1%D0%B5%D0%BA%D0%BE%D0%B2%D0%B8%D1%87', '185.194.199.21', 'Ҷустуҷу: Саъидов Ёқубҷон Давлатбекович', '2025-05-15', '11:37:54', NULL, 1),
(148, 4, '/admin/?option=students&action=insert', '185.194.199.21', 'Иловакунии донишҷӯ: Шоинов Шоҳин Хуршедович', '2025-05-15', '11:38:16', NULL, 1),
(149, 4, '/admin/?option=students&action=insert', '185.194.199.21', 'Иловакунии донишҷӯ: Юсупов Саидҷон Камолович', '2025-05-15', '11:38:33', NULL, 1),
(150, 4, '/admin/?option=students&action=insert', '185.194.199.21', 'Иловакунии донишҷӯ: Юсуфзода Амирхон Шерхон', '2025-05-15', '11:38:51', NULL, 1),
(151, 4, '/admin/?option=students&action=insert', '185.194.199.21', 'Иловакунии донишҷӯ: Раҳмонов Иршод Толибшоевич', '2025-05-15', '11:39:06', NULL, 1),
(152, 4, '/admin/?option=students&action=insert', '185.194.199.21', 'Иловакунии донишҷӯ: Раҳмонзода Муҳаммадҷон Раҷабали', '2025-05-15', '11:39:22', NULL, 1),
(153, 4, '/admin/?option=students&action=insert', '185.194.199.21', 'Иловакунии донишҷӯ: Раҷабалиев Алиҷон Сайдахмадович', '2025-05-15', '11:39:39', NULL, 1),
(154, 4, '/admin/?option=students&action=insert', '185.194.199.21', 'Иловакунии донишҷӯ: Қосимов Ҷаҳонмеҳр Ҷалолиддинович', '2025-05-15', '11:39:55', NULL, 1),
(155, 4, '/admin/?option=students&action=insert', '185.194.199.21', 'Иловакунии донишҷӯ: Алиев Беҳзод Саймухторович', '2025-05-15', '12:00:57', NULL, 1),
(156, 4, '/admin/?option=students&action=insert', '185.194.199.21', 'Иловакунии донишҷӯ: Алиев Ҷаҳонгир Ҷонфидоевич', '2025-05-15', '12:01:39', NULL, 1),
(157, 4, '/admin/?option=search&action=list&word=%D0%90%D0%BB%D0%B8%D0%B5%D0%B2%20%D0%91%D0%B5%D2%B3%D0%B7%D0%BE%D0%B4%20%D0%A1%D0%B0%D0%B9%D0%BC%D1%83%D1%85%D1%82%D0%BE%D1%80%D0%BE%D0%B2%D0%B8%D1%87', '185.194.199.21', 'Ҷустуҷу: Алиев Беҳзод Саймухторович', '2025-05-15', '12:01:55', '12:02:05', 2),
(158, 4, '/admin/?option=students&action=update_student', '185.194.199.21', 'Таҳриркунии донишҷӯ Алиев Беҳзод Саймухторович', '2025-05-15', '12:02:05', NULL, 1),
(159, 4, '/admin/?option=students&action=list&id_faculty=1&id_s_l=1&id_s_v=1&id_course=2&id_spec=8&id_group=1', '185.194.199.21', 'Донишҷӯён / ИТРЗС / Бакалавр / Рӯзона / Курси 2 / 1-40010108 / та', '2025-05-15', '12:14:14', '14:07:50', 12),
(160, 4, '/admin/?option=students&action=insert', '185.194.199.21', 'Иловакунии донишҷӯ: Алматов Саидхон Исмоилович', '2025-05-15', '12:14:46', NULL, 1),
(161, 4, '/admin/?option=students&action=insert', '185.194.199.21', 'Иловакунии донишҷӯ: Вадудов Орифшоҳ Анваршоҳевич ', '2025-05-15', '12:15:14', NULL, 1),
(162, 4, '/admin/?option=students&action=insert', '185.194.199.21', 'Иловакунии донишҷӯ: Гуреззода Аслиддин Вайсиддин', '2025-05-15', '12:17:30', NULL, 1),
(163, 4, '/admin/?option=students&action=insert', '185.194.199.21', 'Иловакунии донишҷӯ: Додхудоев Ҳилоли Русланович', '2025-05-15', '12:17:58', NULL, 1),
(164, 4, '/admin/?option=students&action=insert', '185.194.199.21', 'Иловакунии донишҷӯ: Доробекова Зуҳро Амидхоновна', '2025-05-15', '12:18:18', NULL, 1),
(165, 4, '/admin/?option=students&action=insert', '185.194.199.21', 'Иловакунии донишҷӯ: Маҳмадшарифов Эҳсон Музаффарович', '2025-05-15', '12:18:43', NULL, 1),
(166, 4, '/admin/?option=students&action=insert', '185.194.199.21', 'Иловакунии донишҷӯ: Мусофиров Умар  Умедҷонович', '2025-05-15', '12:19:52', NULL, 1),
(167, 4, '/admin/?option=students&action=insert', '185.194.199.21', 'Иловакунии донишҷӯ: Нематов Наимҷон Махсадуллоевич', '2025-05-15', '12:20:14', NULL, 1),
(168, 4, '/admin/?option=students&action=insert', '185.194.199.21', 'Иловакунии донишҷӯ: Одиназода Абдураҳим Абуднасим', '2025-05-15', '12:20:31', NULL, 1),
(169, 4, '/admin/?option=students&action=insert', '185.194.199.21', 'Иловакунии донишҷӯ: Саидшоев Аюбҷон Исмоилович', '2025-05-15', '12:20:52', NULL, 1),
(170, 4, '/admin/?option=students&action=insert', '185.194.199.21', 'Иловакунии донишҷӯ: Сатторов Нурмаҳмад Холмуродович', '2025-05-15', '12:21:12', NULL, 1),
(171, 4, '/admin/?option=students&action=insert', '185.194.199.21', 'Иловакунии донишҷӯ: Усмонов Аслиддин  Эргашалиевич', '2025-05-15', '12:21:41', NULL, 1),
(172, 4, '/admin/?option=students&action=insert', '185.194.199.21', 'Иловакунии донишҷӯ: Ҳазратқулов Исломиддин Илҳомҷонович', '2025-05-15', '12:22:07', NULL, 1),
(173, 4, '/admin/?option=students&action=insert', '185.194.199.21', 'Иловакунии донишҷӯ: Саипов Комрон Ҷалолидинович', '2025-05-15', '12:22:31', NULL, 1),
(174, 4, '/admin/?option=students&action=insert', '185.194.199.21', 'Иловакунии донишҷӯ: ҚурбоновШоҳрух', '2025-05-15', '12:22:51', NULL, 1),
(175, 4, '/admin/?option=students&action=insert', '185.194.199.21', 'Иловакунии донишҷӯ: Маҳмадов Давлатшо', '2025-05-15', '12:23:14', NULL, 1),
(176, 4, '/admin/?option=students&action=insert', '185.194.199.21', 'Иловакунии донишҷӯ: Ғуломсардаров Рамазон', '2025-05-15', '12:23:45', NULL, 1),
(177, 4, '/admin/?option=students&action=insert', '185.194.199.21', 'Иловакунии донишҷӯ: Акобиров Аслиддин Фазлиддинович', '2025-05-15', '12:42:44', NULL, 1),
(178, 4, '/admin/?option=students&action=insert', '185.194.199.21', 'Иловакунии донишҷӯ: Амаков Абдумубин Абдумуқимович', '2025-05-15', '12:43:09', NULL, 1),
(179, 4, '/admin/?option=students&action=insert', '185.194.199.21', 'Иловакунии донишҷӯ: Гулов Сомонҷон Баҳриддинович', '2025-05-15', '12:43:32', NULL, 1),
(180, 4, '/admin/?option=students&action=insert', '185.194.199.21', 'Иловакунии донишҷӯ: Ёров Акбар  Абдулазизович', '2025-05-15', '12:43:50', NULL, 1),
(181, 4, '/admin/?option=students&action=insert', '185.194.199.21', 'Иловакунии донишҷӯ: Ёров Искандар Атоиддинович', '2025-05-15', '12:44:26', NULL, 1),
(182, 4, '/admin/?option=students&action=insert', '185.194.199.21', 'Иловакунии донишҷӯ: Иброҳимзода Ҳусейн', '2025-05-15', '12:44:54', NULL, 1),
(183, 4, '/admin/?option=students&action=insert', '185.194.199.21', 'Иловакунии донишҷӯ: Идиев Муслим Шуҳратович', '2025-05-15', '12:45:25', NULL, 1),
(184, 4, '/admin/?option=students&action=insert', '185.194.199.21', 'Иловакунии донишҷӯ: Қодиров Султон Улуғбекович', '2025-05-15', '12:45:54', NULL, 1),
(185, 4, '/admin/?option=students&action=insert', '185.194.199.21', 'Иловакунии донишҷӯ: Қурбонализода Насимхон Али', '2025-05-15', '12:46:19', NULL, 1),
(186, 4, '/admin/?option=search&action=list&word=%D2%9A%D1%83%D1%80%D0%B1%D0%BE%D0%BD%D0%B0%D0%BB%D0%B8%D0%B7%D0%BE%D0%B4%D0%B0%20%D0%9D%D0%B0%D1%81%D0%B8%D0%BC%D1%85%D0%BE%D0%BD%20%D0%90%D0%BB%D0%B8', '185.194.199.21', 'Ҷустуҷу: Қурбонализода Насимхон Али', '2025-05-15', '12:46:34', NULL, 1),
(187, 4, '/admin/?option=students&action=list&id_faculty=1&id_s_l=1&id_s_v=1&id_course=2&id_spec=8&id_group=3', '185.194.199.21', 'Донишҷӯён / ИТРЗС / Бакалавр / Рӯзона / Курси 2 / 1-40010108 / тб', '2025-05-15', '12:46:39', '13:00:10', 4),
(188, 4, '/admin/?option=students&action=update_student', '185.194.199.21', 'Таҳриркунии донишҷӯ Қурбонализода Насимхон Али', '2025-05-15', '12:46:50', NULL, 1),
(189, 4, '/admin/?option=students&action=insert', '185.194.199.21', 'Иловакунии донишҷӯ: Қурбонов Муҳаммадорзу Абдуҳакимович', '2025-05-15', '12:47:27', NULL, 1),
(190, 4, '/admin/?option=students&action=insert', '185.194.199.21', 'Иловакунии донишҷӯ: Қурбонов Яҳё Зикриёевич', '2025-05-15', '12:48:38', NULL, 1),
(191, 4, '/admin/?option=students&action=insert', '185.194.199.21', 'Иловакунии донишҷӯ: Мираминов Ҳусейн Абдухалилович', '2025-05-15', '12:49:02', NULL, 1),
(192, 4, '/admin/?option=students&action=insert', '185.194.199.21', 'Иловакунии донишҷӯ: Михточшои Мироҷиддин', '2025-05-15', '12:49:36', NULL, 1),
(193, 4, '/admin/?option=students&action=insert', '185.194.199.21', 'Иловакунии донишҷӯ: Назиров Абубакр Насимович', '2025-05-15', '12:50:00', NULL, 1),
(194, 4, '/admin/?option=students&action=insert', '185.194.199.21', 'Иловакунии донишҷӯ: Сирожев Маъруфҷон Маҳмудович', '2025-05-15', '12:50:30', NULL, 1),
(195, 4, '/admin/?option=students&action=insert', '185.194.199.21', 'Иловакунии донишҷӯ: Табаров Диловар ', '2025-05-15', '12:50:50', NULL, 1),
(196, 4, '/admin/?option=students&action=insert', '185.194.199.21', 'Иловакунии донишҷӯ: Туразода Муҳаммад Мустафом', '2025-05-15', '12:51:32', NULL, 1),
(197, 4, '/admin/?option=students&action=insert', '185.194.199.21', 'Иловакунии донишҷӯ: Холов Тоҳирҷон Тоҷиддинович', '2025-05-15', '12:51:50', NULL, 1),
(198, 4, '/admin/?option=students&action=insert', '185.194.199.21', 'Иловакунии донишҷӯ: Ҷумаев Мухиддин Бобоназарович', '2025-05-15', '12:52:20', NULL, 1),
(199, 4, '/admin/?option=students&action=insert', '185.194.199.21', 'Иловакунии донишҷӯ: Яқубов Саидмумин', '2025-05-15', '12:52:41', NULL, 1),
(200, 4, '/admin/?option=students&action=insert', '185.194.199.21', 'Иловакунии донишҷӯ: Абдуллозода Шеркавич Вирканиен', '2025-05-15', '12:53:42', NULL, 1),
(201, 4, '/admin/?option=students&action=insert', '185.194.199.21', 'Иловакунии донишҷӯ: Ализода Бобоҷон Зайниддин', '2025-05-15', '12:54:05', NULL, 1),
(202, 4, '/admin/?option=students&action=insert', '185.194.199.21', 'Иловакунии донишҷӯ: Гадоев Ҳумайни Ҳикматуллоевич', '2025-05-15', '12:54:35', NULL, 1),
(203, 4, '/admin/?option=students&action=insert', '185.194.199.21', 'Иловакунии донишҷӯ: Гадоев Шарифчон Шералиевич ', '2025-05-15', '12:54:53', NULL, 1),
(204, 4, '/admin/?option=students&action=insert', '185.194.199.21', 'Иловакунии донишҷӯ: Иброҳимзода Меҳрон Одилҷон', '2025-05-15', '12:55:13', NULL, 1),
(205, 4, '/admin/?option=students&action=insert', '185.194.199.21', 'Иловакунии донишҷӯ: Камилов Сиёвуш Фирдавсович', '2025-05-15', '12:55:34', NULL, 1),
(206, 4, '/admin/?option=search&action=list&word=%D0%9A%D0%B0%D0%BC%D0%B8%D0%BB%D0%BE%D0%B2%20%D0%A1%D0%B8%D1%91%D0%B2%D1%83%D1%88%20%D0%A4%D0%B8%D1%80%D0%B4%D0%B0%D0%B2%D1%81%D0%BE%D0%B2%D0%B8%D1%87', '185.194.199.21', 'Ҷустуҷу: Камилов Сиёвуш Фирдавсович', '2025-05-15', '12:57:25', '13:00:22', 5),
(207, 4, '/admin/?option=students&action=update_student', '185.194.199.21', 'Таҳриркунии донишҷӯ Камилов Сиёвуш Фирдавсович', '2025-05-15', '12:57:59', NULL, 1),
(208, 4, '/admin/?option=students&action=list&id_faculty=1&id_s_l=1&id_s_v=1&id_course=2&id_spec=7&id_group=1', '185.194.199.21', 'Донишҷӯён / ИТРЗС / Бакалавр / Рӯзона / Курси 2 / 1-40010104 / та', '2025-05-15', '12:59:07', '13:03:24', 3),
(209, 4, '/admin/?option=search&action=list&word=1.%D2%9A%D1%83%D1%80%D0%B1%D0%BE%D0%BD%D0%BE%D0%B2%20%D0%AF%D2%B3%D1%91%20%D0%97%D0%B8%D0%BA%D1%80%D0%B8%D1%91%D0%B5%D0%B2%D0%B8%D1%87', '185.194.199.21', 'Ҷустуҷу: 1.Қурбонов Яҳё Зикриёевич', '2025-05-15', '12:59:52', NULL, 1),
(210, 4, '/admin/?option=search&action=list&word=%D2%9A%D1%83%D1%80%D0%B1%D0%BE%D0%BD%D0%BE%D0%B2%20%D0%AF%D2%B3%D1%91%20%D0%97%D0%B8%D0%BA%D1%80%D0%B8%D1%91%D0%B5%D0%B2%D0%B8%D1%87', '185.194.199.21', 'Ҷустуҷу: Қурбонов Яҳё Зикриёевич', '2025-05-15', '13:00:07', NULL, 1),
(211, 4, '/admin/?option=students&action=insert', '185.194.199.21', 'Иловакунии донишҷӯ: Муслимов Резвон Абдуғафорович', '2025-05-15', '13:00:53', NULL, 1),
(212, 4, '/admin/?option=students&action=insert', '185.194.199.21', 'Иловакунии донишҷӯ: Нуров Беҳруз Таввакалович', '2025-05-15', '13:01:14', NULL, 1),
(213, 4, '/admin/?option=students&action=insert', '185.194.199.21', 'Иловакунии донишҷӯ: Равшанзода Қосимҷон Идибег', '2025-05-15', '13:01:36', NULL, 1),
(214, 4, '/admin/?option=students&action=insert', '185.194.199.21', 'Иловакунии донишҷӯ: Раҳматов Абдулбасир Мирзоҷонович', '2025-05-15', '13:01:56', NULL, 1),
(215, 4, '/admin/?option=students&action=insert', '185.194.199.21', 'Иловакунии донишҷӯ: Холов Шукрулло Баҳромович', '2025-05-15', '13:02:17', NULL, 1),
(216, 4, '/admin/?option=students&action=insert', '185.194.199.21', 'Иловакунии донишҷӯ: Хуршедзода Сулҳия', '2025-05-15', '13:02:36', NULL, 1),
(217, 4, '/admin/?option=students&action=insert', '185.194.199.21', 'Иловакунии донишҷӯ: Ҷабборов Муҳаммадҷон Абдуҷабборович', '2025-05-15', '13:02:59', NULL, 1),
(218, 4, '/admin/?option=students&action=insert', '185.194.199.21', 'Иловакунии донишҷӯ: Қурбонов Меҳроб ', '2025-05-15', '13:03:21', NULL, 1),
(219, 4, '/admin/?option=students&action=insert', '185.194.199.21', 'Иловакунии донишҷӯ: Амонов Музаффар Олимович', '2025-05-15', '13:04:41', NULL, 1),
(220, 4, '/admin/?option=students&action=insert', '185.194.199.21', 'Иловакунии донишҷӯ: Бачабекзода Рамазон Амробег', '2025-05-15', '13:04:59', NULL, 1),
(221, 4, '/admin/?option=students&action=insert', '185.194.199.21', 'Иловакунии донишҷӯ: Ғайратзода Салоҳиддин Сафарали', '2025-05-15', '13:10:38', NULL, 1),
(222, 4, '/admin/?option=students&action=insert', '185.194.199.21', 'Иловакунии донишҷӯ: Гафоров Беҳрӯз Комилович', '2025-05-15', '13:11:02', NULL, 1),
(223, 4, '/admin/?option=search&action=list&word=%D2%92%D0%B0%D0%B9%D1%80%D0%B0%D1%82%D0%B7%D0%BE%D0%B4%D0%B0%20%D0%A1%D0%B0%D0%BB%D0%BE%D2%B3%D0%B8%D0%B4%D0%B4%D0%B8%D0%BD%20%D0%A1%D0%B0%D1%84%D0%B0%D1%80%D0%B0%D0%BB%D0%B8', '185.194.199.21', 'Ҷустуҷу: Ғайратзода Салоҳиддин Сафарали', '2025-05-15', '13:11:12', '13:11:24', 2),
(224, 4, '/admin/?option=students&action=update_student', '185.194.199.21', 'Таҳриркунии донишҷӯ Ғайратзода Салоҳиддин Сафарали', '2025-05-15', '13:11:24', NULL, 1),
(225, 4, '/admin/?option=students&action=insert', '185.194.199.21', 'Иловакунии донишҷӯ: Зарипов Насибулло Илхомҷонович', '2025-05-15', '13:12:32', NULL, 1),
(226, 4, '/admin/?option=students&action=insert', '185.194.199.21', 'Иловакунии донишҷӯ: Икромов Насрулло Алишерович', '2025-05-15', '13:12:52', NULL, 1),
(227, 4, '/admin/?option=students&action=insert', '185.194.199.21', 'Иловакунии донишҷӯ: Исматов Абубакр Исуфҷонович', '2025-05-15', '13:13:07', NULL, 1),
(228, 4, '/admin/?option=students&action=insert', '185.194.199.21', 'Иловакунии донишҷӯ: Қуронбеков  Адиб Ҷамшедович', '2025-05-15', '13:13:22', NULL, 1),
(229, 4, '/admin/?option=students&action=insert', '185.194.199.21', 'Иловакунии донишҷӯ: Миралиев Саидбек Комилҷонович', '2025-05-15', '13:13:35', NULL, 1),
(230, 4, '/admin/?option=students&action=insert', '185.194.199.21', 'Иловакунии донишҷӯ: Мирзозода Фараҳноз Давлатқадам', '2025-05-15', '13:13:50', NULL, 1),
(231, 4, '/admin/?option=search&action=list&word=%D0%9C%D0%B8%D1%80%D0%B7%D0%BE%D0%B7%D0%BE%D0%B4%D0%B0%20%D0%A4%D0%B0%D1%80%D0%B0%D2%B3%D0%BD%D0%BE%D0%B7%20%D0%94%D0%B0%D0%B2%D0%BB%D0%B0%D1%82%D2%9B%D0%B0%D0%B4%D0%B0%D0%BC', '185.194.199.21', 'Ҷустуҷу: Мирзозода Фараҳноз Давлатқадам', '2025-05-15', '13:13:57', '13:14:05', 2),
(232, 4, '/admin/?option=students&action=update_student', '185.194.199.21', 'Таҳриркунии донишҷӯ Мирзозода Фараҳноз Давлатқадам', '2025-05-15', '13:14:05', NULL, 1),
(233, 4, '/admin/?option=students&action=insert', '185.194.199.21', 'Иловакунии донишҷӯ: Аббосзода Ораш Зафар', '2025-05-15', '13:14:37', NULL, 1),
(234, 4, '/admin/?option=students&action=insert', '185.194.199.21', 'Иловакунии донишҷӯ: Абдувалиев Акмалхон Зафархонович', '2025-05-15', '13:16:52', NULL, 1),
(235, 4, '/admin/?option=students&action=insert', '185.194.199.21', 'Иловакунии донишҷӯ: Абдувалиев Акрамхон Зафархонович', '2025-05-15', '13:17:15', NULL, 1),
(236, 4, '/admin/?option=students&action=insert', '185.194.199.21', 'Иловакунии донишҷӯ: Аминов Парвиз Файзалиевич', '2025-05-15', '13:17:35', NULL, 1),
(237, 4, '/admin/?option=students&action=insert', '185.194.199.21', 'Иловакунии донишҷӯ: Исмоилов Тоҳир Таваралиевич ', '2025-05-15', '13:17:57', NULL, 1),
(238, 4, '/admin/?option=students&action=insert', '185.194.199.21', 'Иловакунии донишҷӯ: Қодири Муқимзода ', '2025-05-15', '13:18:21', NULL, 1),
(239, 4, '/admin/?option=students&action=insert', '185.194.199.21', 'Иловакунии донишҷӯ: Махматшоев Икромҷон Заробудинович', '2025-05-15', '13:18:42', NULL, 1),
(240, 4, '/admin/?option=students&action=insert', '185.194.199.21', 'Иловакунии донишҷӯ: Маҳмадиев Мансурҷон Самиджонович', '2025-05-15', '13:19:02', NULL, 1),
(241, 4, '/admin/?option=students&action=insert', '185.194.199.21', 'Иловакунии донишҷӯ: Нарзуллозода Иқбол Дилшод', '2025-05-15', '13:19:23', NULL, 1),
(242, 4, '/admin/?option=students&action=insert', '185.194.199.21', 'Иловакунии донишҷӯ: Рустамов Фурӯзон Абдуҷабборович', '2025-05-15', '13:19:41', NULL, 1),
(243, 4, '/admin/?option=students&action=insert', '185.194.199.21', 'Иловакунии донишҷӯ: Набиев Хусан Дониёрович', '2025-05-15', '13:19:51', NULL, 1),
(244, 4, '/admin/?option=students&action=insert', '185.194.199.21', 'Иловакунии донишҷӯ: Саидзода Садриддин Самаридин', '2025-05-15', '13:19:58', NULL, 1),
(245, 4, '/admin/?option=students&action=insert', '185.194.199.21', 'Иловакунии донишҷӯ: Рақибов Умед Растамович', '2025-05-15', '13:20:08', NULL, 1),
(246, 4, '/admin/?option=students&action=insert', '185.194.199.21', 'Иловакунии донишҷӯ: Тағоев Нуриддин Илҳомиддинович', '2025-05-15', '13:20:18', NULL, 1),
(247, 4, '/admin/?option=students&action=insert', '185.194.199.21', 'Иловакунии донишҷӯ: Салихов Баҳодур Ҷамолидинович', '2025-05-15', '13:20:27', NULL, 1),
(248, 4, '/admin/?option=search&action=list&word=%D0%A2%D0%B0%D2%93%D0%BE%D0%B5%D0%B2%20%D0%9D%D1%83%D1%80%D0%B8%D0%B4%D0%B4%D0%B8%D0%BD%20%D0%98%D0%BB%D2%B3%D0%BE%D0%BC%D0%B8%D0%B4%D0%B4%D0%B8%D0%BD%D0%BE%D0%B2%D0%B8%D1%87', '185.194.199.21', 'Ҷустуҷу: Тағоев Нуриддин Илҳомиддинович', '2025-05-15', '13:21:41', NULL, 1),
(249, 4, '/admin/?option=students&action=list&id_faculty=1&id_s_l=1&id_s_v=1&id_course=2&id_spec=11&id_group=1', '185.194.199.21', 'Донишҷӯён / ИТРЗС / Бакалавр / Рӯзона / Курси 2 / 1-400103 / та', '2025-05-15', '13:21:45', '13:24:02', 2),
(250, 4, '/admin/?option=students&action=insert', '185.194.199.21', 'Иловакунии донишҷӯ: Сатторов Шаҳриёр Файзиддинович', '2025-05-15', '13:21:49', NULL, 1),
(251, 4, '/admin/?option=students&action=insert', '185.194.199.21', 'Иловакунии донишҷӯ: Сафарализода Лоиқ Шерали', '2025-05-15', '13:22:11', NULL, 1),
(252, 4, '/admin/?option=students&action=insert', '185.194.199.21', 'Иловакунии донишҷӯ: Тоҷов Салмон', '2025-05-15', '13:22:21', NULL, 1),
(253, 4, '/admin/?option=students&action=insert', '185.194.199.21', 'Иловакунии донишҷӯ: Сулаймонов Оятулло Изатуллоевич', '2025-05-15', '13:22:27', NULL, 1),
(254, 4, '/admin/?option=students&action=insert', '185.194.199.21', 'Иловакунии донишҷӯ: Умарзода Муҳаммад', '2025-05-15', '13:22:47', NULL, 1),
(255, 4, '/admin/?option=students&action=insert', '185.194.199.21', 'Иловакунии донишҷӯ: Фозилзода Фирдавс Уктам', '2025-05-15', '13:23:15', NULL, 1),
(256, 4, '/admin/?option=students&action=insert', '185.194.199.21', 'Иловакунии донишҷӯ: Шодиев Фозилбек Сафарбекович', '2025-05-15', '13:23:37', NULL, 1),
(257, 4, '/admin/?option=students&action=insert', '185.194.199.21', 'Иловакунии донишҷӯ: Шоҳзода Шодмеҳр Абдусамад', '2025-05-15', '13:23:59', NULL, 1),
(258, 4, '/admin/?option=students&action=insert', '185.194.199.21', 'Иловакунии донишҷӯ: Абдулназарзода Билол Абдулназар', '2025-05-15', '13:29:25', NULL, 1),
(259, 4, '/admin/?option=students&action=insert', '185.194.199.21', 'Иловакунии донишҷӯ: Амонуллоев Азизулло Джумаевич', '2025-05-15', '13:29:44', NULL, 1),
(260, 4, '/admin/?option=students&action=insert', '185.194.199.21', 'Иловакунии донишҷӯ: Ашуров Саймурод Маҳмараҷабович', '2025-05-15', '13:30:04', NULL, 1),
(261, 4, '/admin/?option=students&action=insert', '185.194.199.21', 'Иловакунии донишҷӯ: Идриси Саймехточ', '2025-05-15', '13:30:29', NULL, 1),
(262, 4, '/admin/?option=students&action=insert', '185.194.199.21', 'Иловакунии донишҷӯ: Камолзода Амирчон Шерафган', '2025-05-15', '13:31:09', NULL, 1),
(263, 4, '/admin/?option=students&action=insert', '185.194.199.21', 'Иловакунии донишҷӯ: Қучқорбекова Файзигул Рамазоновна', '2025-05-15', '13:31:32', NULL, 1),
(264, 4, '/admin/?option=students&action=insert', '185.194.199.21', 'Иловакунии донишҷӯ: Мирсаидова Нӯшофарин Фаридуновна', '2025-05-15', '13:31:48', NULL, 1),
(265, 4, '/admin/?option=students&action=insert', '185.194.199.21', 'Иловакунии донишҷӯ: Раҷабова Аниса Нематовна', '2025-05-15', '13:32:09', NULL, 1),
(266, 4, '/admin/?option=search&action=list&word=%D0%A0%D0%B0%D2%B7%D0%B0%D0%B1%D0%BE%D0%B2%D0%B0%20%D0%90%D0%BD%D0%B8%D1%81%D0%B0%20%D0%9D%D0%B5%D0%BC%D0%B0%D1%82%D0%BE%D0%B2%D0%BD%D0%B0', '185.194.199.21', 'Ҷустуҷу: Раҷабова Аниса Нематовна', '2025-05-15', '13:32:17', NULL, 1),
(267, 4, '/admin/?option=students&action=list&id_faculty=1&id_s_l=1&id_s_v=1&id_course=2&id_spec=5&id_group=1', '185.194.199.21', 'Донишҷӯён / ИТРЗС / Бакалавр / Рӯзона / Курси 2 / 1-25011026 / та', '2025-05-15', '13:32:20', '14:04:15', 3),
(268, 4, '/admin/?option=students&action=insert', '185.194.199.21', 'Иловакунии донишҷӯ: Саидшоева Гулроза Саидсодиқовна', '2025-05-15', '13:36:19', NULL, 1),
(269, 4, '/admin/?option=students&action=insert', '185.194.199.21', 'Иловакунии донишҷӯ: Файзов Идибек Абдулазизович', '2025-05-15', '13:36:43', NULL, 1),
(270, 4, '/admin/?option=students&action=insert', '185.194.199.21', 'Иловакунии донишҷӯ: Холдонова Омина Абдуллоевна', '2025-05-15', '13:37:08', NULL, 1),
(271, 4, '/admin/?option=students&action=insert', '185.194.199.21', 'Иловакунии донишҷӯ: Хуморов Муҳаммад Амрихудоевич', '2025-05-15', '13:37:35', NULL, 1),
(272, 4, '/admin/?option=students&action=insert', '185.194.199.21', 'Иловакунии донишҷӯ: Ҳасанзода Сиёвуш Исмонали', '2025-05-15', '13:38:00', NULL, 1),
(273, 4, '/admin/?option=students&action=insert', '185.194.199.21', 'Иловакунии донишҷӯ: Чилахонзода Комрон Навруз', '2025-05-15', '13:38:23', NULL, 1),
(274, 4, '/admin/?option=students&action=insert', '185.194.199.21', 'Иловакунии донишҷӯ: Шарипзода Хочикурбон Чумахон', '2025-05-15', '13:38:47', NULL, 1),
(275, 4, '/admin/?option=students&action=insert', '185.194.199.21', 'Иловакунии донишҷӯ: Шоҳзода Яқуб Искандар', '2025-05-15', '13:39:09', NULL, 1),
(276, 4, '/admin/?option=students&action=insert', '185.194.199.21', 'Иловакунии донишҷӯ: Туфонов Исмоил Ҳ', '2025-05-15', '13:39:31', NULL, 1),
(277, 4, '/admin/?option=students&action=structure', '185.194.199.21', 'Сохтор', '2025-05-15', '14:04:31', NULL, 1),
(278, 4, '/admin/?option=students&action=problems', '185.194.199.21', 'Камбудиҳо', '2025-05-15', '14:04:36', NULL, 1),
(279, 4, '/admin/?option=students&action=mintaqa', '185.194.199.21', 'Омори минтақавӣ', '2025-05-15', '14:04:38', NULL, 1),
(280, 4, '/admin/?option=students&action=groupstatistic', '185.194.199.21', 'Омори гурӯҳҳо', '2025-05-15', '14:04:40', NULL, 1),
(281, 4, '/admin/?option=students&action=list&id_faculty=1&id_s_l=1&id_s_v=1&id_course=1&id_spec=14&id_group=1', '185.194.199.21', 'Донишҷӯён / ИТРЗС / Бакалавр / Рӯзона / Курси 1 / 1-260202 / та', '2025-05-15', '14:07:14', '16:05:41', 5),
(282, 4, '/admin/?option=students&action=insert', '185.194.199.21', 'Иловакунии донишҷӯ: Холов Фирдавси Суҳробович', '2025-05-15', '16:02:41', NULL, 1),
(283, 4, '/admin/?option=students&action=insert', '185.194.199.21', 'Иловакунии донишҷӯ: Худойдодов Анас Саидасрорович', '2025-05-15', '16:02:55', NULL, 1),
(284, 4, '/admin/?option=students&action=insert', '185.194.199.21', 'Иловакунии донишҷӯ: Ҳафиззода Раҳматулло Суҳроб', '2025-05-15', '16:03:08', NULL, 1),
(285, 4, '/admin/?option=students&action=insert', '185.194.199.21', 'Иловакунии донишҷӯ: Шамсов Меҳроб Саъдиевич', '2025-05-15', '16:03:25', NULL, 1),
(286, 4, '/admin/?option=students&action=insert', '185.194.199.21', 'Иловакунии донишҷӯ: Латифова Лайло Рустамовна', '2025-05-15', '16:03:42', NULL, 1),
(287, 4, '/admin/?option=search&action=list&word=%D0%9B%D0%B0%D1%82%D0%B8%D1%84%D0%BE%D0%B2%D0%B0%20%D0%9B%D0%B0%D0%B9%D0%BB%D0%BE%20%D0%A0%D1%83%D1%81%D1%82%D0%B0%D0%BC%D0%BE%D0%B2%D0%BD%D0%B0', '185.194.199.21', 'Ҷустуҷу: Латифова Лайло Рустамовна', '2025-05-15', '16:03:49', '16:03:55', 2),
(288, 4, '/admin/?option=students&action=update_student', '185.194.199.21', 'Таҳриркунии донишҷӯ Латифова Лайло Рустамовна', '2025-05-15', '16:03:55', NULL, 1),
(289, 4, '/admin/?option=students&action=insert', '185.194.199.21', 'Иловакунии донишҷӯ: Лоиқов Муҳаммад Ҳошимович', '2025-05-15', '16:04:10', NULL, 1),
(290, 4, '/admin/?option=students&action=insert', '185.194.199.21', 'Иловакунии донишҷӯ: Ғафуров Афзалшо Камолиддинович', '2025-05-15', '16:04:28', NULL, 1),
(291, 4, '/admin/?option=students&action=insert', '185.194.199.21', 'Иловакунии донишҷӯ: Давлятов Хуршед Бахтиёрович', '2025-05-15', '16:04:47', NULL, 1),
(292, 4, '/admin/?option=students&action=insert', '185.194.199.21', 'Иловакунии донишҷӯ: Ҷалалов Умед Байдилаевич', '2025-05-15', '16:05:07', NULL, 1),
(293, 4, '/admin/?option=search&action=list&word=%D0%94%D0%B0%D0%B2%D0%BB%D1%8F%D1%82%D0%BE%D0%B2%20%D0%A5%D1%83%D1%80%D1%88%D0%B5%D0%B4%20%D0%91%D0%B0%D1%85%D1%82%D0%B8%D1%91%D1%80%D0%BE%D0%B2%D0%B8%D1%87', '185.194.199.21', 'Ҷустуҷу: Давлятов Хуршед Бахтиёрович', '2025-05-15', '16:05:29', '16:05:38', 2),
(294, 4, '/admin/?option=students&action=update_student', '185.194.199.21', 'Таҳриркунии донишҷӯ Давлятов Хуршед Бахтиёрович', '2025-05-15', '16:05:38', NULL, 1),
(295, 4, '/admin/?option=students&action=insert', '185.194.199.21', 'Иловакунии донишҷӯ: Маҳмуродов Абубакр Маҳмадкаримович', '2025-05-15', '16:06:05', NULL, 1),
(296, 2, '/admin/', '185.177.2.169', 'Омори гурӯҳҳо', '2025-05-15', '21:10:19', '21:14:51', 3),
(297, 2, '/modules/students/students_ajax.php?option=showuseractions', '185.177.2.169', 'Дидани амалиётҳо: Yusupov Jasur', '2025-05-15', '21:14:13', NULL, 1),
(298, 2, '/admin/?option=students&action=list&id_faculty=1&id_s_l=1&id_s_v=1&id_course=2&id_spec=5&id_group=1', '185.177.2.169', 'Донишҷӯён / ИТРЗС / Бакалавр / Рӯзона / Курси 2 / 1-25011026 / та', '2025-05-15', '21:15:38', NULL, 1),
(299, 2, '/admin/?option=students&action=list&id_faculty=1&id_s_l=1&id_s_v=1&id_course=2&id_spec=6&id_group=1', '185.177.2.169', 'Донишҷӯён / ИТРЗС / Бакалавр / Рӯзона / Курси 2 / 1-40010202 / та', '2025-05-15', '21:15:52', NULL, 1),
(300, 2, '/admin/?option=students&action=list&id_faculty=1&id_s_l=1&id_s_v=1&id_course=2&id_spec=7&id_group=1', '185.177.2.169', 'Донишҷӯён / ИТРЗС / Бакалавр / Рӯзона / Курси 2 / 1-40010104 / та', '2025-05-15', '21:16:04', NULL, 1),
(301, 2, '/admin/?option=search&action=list&word=%D0%9C%D1%83%D1%80%D0%BE%D0%B4%D0%BE%D0%B2', '185.177.2.169', 'Ҷустуҷу: Муродов', '2025-05-15', '21:16:13', '21:16:58', 2),
(302, 2, '/admin/?option=students&action=list&id_faculty=1&id_s_l=1&id_s_v=1&id_course=2&id_spec=8&id_group=1', '185.177.2.169', 'Донишҷӯён / ИТРЗС / Бакалавр / Рӯзона / Курси 2 / 1-40010108 / та', '2025-05-15', '21:16:27', '21:47:06', 4),
(303, 2, '/admin/?option=nt&action=list&id_faculty=1&id_s_l=1&id_s_v=1', '185.177.2.169', 'Нақшаҳои таълимӣ / ИТРЗС / Бакалавр / Рӯзона', '2025-05-15', '21:17:30', NULL, 1),
(304, 2, '/admin/?option=nt&action=add', '185.177.2.169', 'Иловакунии нақшаи таълимӣ', '2025-05-15', '21:17:37', NULL, 1),
(305, 2, '/admin/?option=nt&action=nt_list&id_nt=9', '185.177.2.169', 'Нақшаи таълимӣ / ИТРЗС / Бакалавр / Рӯзона / 2022 / 1-40010108', '2025-05-15', '21:18:06', '21:47:21', 6),
(306, 2, '/admin/?option=nt&action=nt_list&id_nt=9', '185.177.2.169', 'Нақшаи таълимӣ / ИТРЗС / Бакалавр / Рӯзона / 2022 / 1-40010108', '2025-05-16', '07:37:55', NULL, 1);
INSERT INTO `_datasonline` (`id`, `id_user`, `url`, `ip`, `page_title`, `date`, `first_time`, `last_time`, `counter`) VALUES
(307, 2, '/admin/', '185.177.2.169', 'Омори гурӯҳҳо', '2025-05-16', '07:38:07', NULL, 1),
(308, 4, '/admin/', '185.194.199.21', 'Омори гурӯҳҳо', '2025-05-16', '08:04:50', '14:19:05', 10),
(309, 4, '/admin/?option=nt&action=list&id_faculty=1&id_s_l=1&id_s_v=1', '185.194.199.21', 'Нақшаҳои таълимӣ / ИТРЗС / Бакалавр / Рӯзона', '2025-05-16', '08:05:01', '11:15:22', 4),
(310, 4, '/admin/?option=nt&action=nt_list&id_nt=9', '185.194.199.21', 'Нақшаи таълимӣ / ИТРЗС / Бакалавр / Рӯзона / 2022 / 1-40010108', '2025-05-16', '08:05:03', '11:15:24', 7),
(311, 4, '/admin/?option=commission&action=studentstatistic&id_faculty=1', '185.194.199.21', 'Омори донишҷуён', '2025-05-16', '08:06:31', '14:18:58', 2),
(312, 4, '/modules/students/students_ajax.php?option=showuseractions', '185.194.199.21', 'Дидани амалиётҳо: Administrator', '2025-05-16', '08:29:35', '08:30:06', 2),
(313, 4, '/modules/students/students_ajax.php?option=showuseractions', '185.194.199.21', 'Дидани амалиётҳо: Yusupov Jasur', '2025-05-16', '08:30:15', NULL, 1),
(314, 4, '/admin/?option=soxtor&action=departaments_list', '185.194.199.21', 'Руйхати кафедраҳо', '2025-05-16', '08:31:57', NULL, 1),
(315, 4, '/admin/?option=soxtor&action=faculties_list', '185.194.199.21', 'Руйхати факултетҳо', '2025-05-16', '08:32:08', '14:19:15', 7),
(316, 4, '/admin/?option=teachers&action=list', '185.194.199.21', 'Руйхати омӯзгорҳо', '2025-05-16', '08:33:31', NULL, 1),
(317, 4, '/admin/?option=teachers&action=add', '185.194.199.21', 'Иловакунии омӯзгор', '2025-05-16', '08:33:35', '08:33:51', 2),
(318, 4, '/admin/?option=teachers&action=insert', '185.194.199.21', 'Иловакунӣ: Мирзозоза Абдусалом', '2025-05-16', '08:33:51', NULL, 1),
(319, 4, '/admin/?option=soxtor&action=specs_list&id=15', '185.194.199.21', 'Институти технологияҳои рақамӣ ва зеҳни сунъӣ: Руйхати ихтисосҳо', '2025-05-16', '08:34:16', NULL, 1),
(320, 4, '/admin/?option=students&action=add', '185.194.199.21', 'Иловакунии донишҷӯ', '2025-05-16', '10:55:47', '13:44:37', 50),
(321, 4, '/admin/?option=students&action=insert', '185.194.199.21', 'Иловакунии донишҷӯ: Абдуллоев Самариддин Суҳробович', '2025-05-16', '10:56:59', NULL, 1),
(322, 4, '/admin/?option=students&action=insert', '185.194.199.21', 'Иловакунии донишҷӯ: Азизов Шохинчон Акмалчонович', '2025-05-16', '10:57:28', NULL, 1),
(323, 4, '/admin/?option=students&action=insert', '185.194.199.21', 'Иловакунии донишҷӯ: Бегиҷонов Алиҷон Амирхонович', '2025-05-16', '10:57:52', NULL, 1),
(324, 4, '/admin/?option=students&action=insert', '185.194.199.21', 'Иловакунии донишҷӯ: Биёбониева Рудоба Ҷаъфархоновна', '2025-05-16', '10:58:13', NULL, 1),
(325, 4, '/admin/?option=students&action=insert', '185.194.199.21', 'Иловакунии донишҷӯ: Ғаниев Шамсиддин Юлдошевич', '2025-05-16', '10:58:51', NULL, 1),
(326, 4, '/admin/?option=students&action=insert', '185.194.199.21', 'Иловакунии донишҷӯ: Зиёева Оиша Абдуқодировна', '2025-05-16', '10:59:12', NULL, 1),
(327, 4, '/admin/?option=students&action=insert', '185.194.199.21', 'Иловакунии донишҷӯ: Каримзода Бахтовар Ҳайдаралӣ', '2025-05-16', '10:59:40', NULL, 1),
(328, 4, '/admin/?option=students&action=insert', '185.194.199.21', 'Иловакунии донишҷӯ: Нуриддинзода Фазлиддин Нуриддин', '2025-05-16', '11:00:10', NULL, 1),
(329, 4, '/admin/?option=students&action=insert', '185.194.199.21', 'Иловакунии донишҷӯ: Равшанов Равшан Тоҷиддинович', '2025-05-16', '11:00:33', NULL, 1),
(330, 4, '/admin/?option=students&action=insert', '185.194.199.21', 'Иловакунии донишҷӯ: Раҷабзода Хусрав Шоди', '2025-05-16', '11:01:01', NULL, 1),
(331, 4, '/admin/?option=students&action=insert', '185.194.199.21', 'Иловакунии донишҷӯ: Сафарзода Зайдулло Ёқубҷон', '2025-05-16', '11:01:23', NULL, 1),
(332, 4, '/admin/?option=students&action=insert', '185.194.199.21', 'Иловакунии донишҷӯ: Худойбердиева Парвина Аҳмадалиевна', '2025-05-16', '11:01:44', NULL, 1),
(333, 4, '/admin/?option=students&action=insert', '185.194.199.21', 'Иловакунии донишҷӯ: Ҳикматов Фаридун Вайсидинович', '2025-05-16', '11:02:04', NULL, 1),
(334, 4, '/admin/?option=students&action=insert', '185.194.199.21', 'Иловакунии донишҷӯ: Шарифзода Сумая Бобоҷон', '2025-05-16', '11:02:28', NULL, 1),
(335, 4, '/admin/?option=search&action=list&word=%D0%A8%D0%B0%D1%80%D0%B8%D1%84%D0%B7%D0%BE%D0%B4%D0%B0%20%D0%A1%D1%83%D0%BC%D0%B0%D1%8F%20%D0%91%D0%BE%D0%B1%D0%BE%D2%B7%D0%BE%D0%BD', '185.194.199.21', 'Ҷустуҷу: Шарифзода Сумая Бобоҷон', '2025-05-16', '11:02:42', NULL, 1),
(336, 4, '/admin/?option=students&action=list&id_faculty=1&id_s_l=1&id_s_v=1&id_course=3&id_spec=12&id_group=1', '185.194.199.21', 'Донишҷӯён / ИТРЗС / Бакалавр / Рӯзона / Курси 3 / 1-26020101 / та', '2025-05-16', '11:03:06', NULL, 1),
(337, 4, '/admin/?option=students&action=insert', '185.194.199.21', 'Иловакунии донишҷӯ: Абдуллоев Ахмадҷон Сафарбекович', '2025-05-16', '11:05:25', NULL, 1),
(338, 4, '/admin/?option=search&action=list&word=%D0%90%D0%B7%D0%B8%D0%B7%D0%BE%D0%B2%20%D0%9C%D0%B8%D1%80%D0%B0%D2%B3%D0%BC%D0%B0%D0%B4%20%D0%91%D0%B5%D0%B3%D0%B0%D2%B3%D0%BC%D0%B0%D0%B4%D0%BE%D0%B2%D0%B8%D1%87', '185.194.199.21', 'Ҷустуҷу: Азизов Мираҳмад Бегаҳмадович', '2025-05-16', '11:07:05', NULL, 1),
(339, 4, '/admin/?option=students&action=insert', '185.194.199.21', 'Иловакунии донишҷӯ: Азизов Мираҳмад Бегаҳмадович', '2025-05-16', '11:07:21', NULL, 1),
(340, 4, '/admin/?option=students&action=insert', '185.194.199.21', 'Иловакунии донишҷӯ: Бозоров Хокимшох Хамзалиевич', '2025-05-16', '11:07:56', NULL, 1),
(341, 4, '/admin/?option=students&action=insert', '185.194.199.21', 'Иловакунии донишҷӯ: Ватаншозода Ёсимин', '2025-05-16', '11:08:49', NULL, 1),
(342, 4, '/admin/?option=search&action=list&word=%D0%92%D0%B0%D1%82%D0%B0%D0%BD%D1%88%D0%BE%D0%B7%D0%BE%D0%B4%D0%B0%20%D0%81%D1%81%D0%B8%D0%BC%D0%B8%D0%BD', '185.194.199.21', 'Ҷустуҷу: Ватаншозода Ёсимин', '2025-05-16', '11:08:57', '11:11:27', 3),
(343, 4, '/admin/?option=students&action=list&id_faculty=1&id_s_l=1&id_s_v=1&id_course=1&id_spec=14&id_group=1', '185.194.199.21', 'Донишҷӯён / ИТРЗС / Бакалавр / Рӯзона / Курси 1 / 1-260202 / та', '2025-05-16', '11:09:20', '11:11:26', 5),
(344, 4, '/admin/?option=students&action=addfarmon&id_student=252', '185.194.199.21', 'Иловакунии фармонҳо', '2025-05-16', '11:09:26', NULL, 1),
(345, 4, '/admin/?option=students&action=insert', '185.194.199.21', 'Иловакунии донишҷӯ: Исоқзода Файзиддин Қиёмиддин', '2025-05-16', '11:10:17', NULL, 1),
(346, 4, '/admin/?option=search&action=list&word=%D0%98%D1%81%D0%BE%D2%9B%D0%B7%D0%BE%D0%B4%D0%B0%20%D0%A4%D0%B0%D0%B9%D0%B7%D0%B8%D0%B4%D0%B4%D0%B8%D0%BD%20%D2%9A%D0%B8%D1%91%D0%BC%D0%B8%D0%B4%D0%B4%D0%B8%D0%BD', '185.194.199.21', 'Ҷустуҷу: Исоқзода Файзиддин Қиёмиддин', '2025-05-16', '11:10:32', NULL, 1),
(347, 4, '/admin/?option=students&action=list&id_faculty=1&id_s_l=1&id_s_v=1&id_course=3&id_spec=14&id_group=1', '185.194.199.21', 'Донишҷӯён / ИТРЗС / Бакалавр / Рӯзона / Курси 3 / 1-260202 / та', '2025-05-16', '11:10:36', '13:34:40', 9),
(348, 4, '/admin/?option=students&action=update_student', '185.194.199.21', 'Таҳриркунии донишҷӯ Ватаншозода Ёсимин', '2025-05-16', '11:11:18', NULL, 1),
(349, 4, '/admin/?option=students&action=insert', '185.194.199.21', 'Иловакунии донишҷӯ: Кодиров Бахтиёр Нодирович', '2025-05-16', '11:12:29', NULL, 1),
(350, 4, '/admin/?option=students&action=insert', '185.194.199.21', 'Иловакунии донишҷӯ: Қурбонзода Содиқ Парвиз', '2025-05-16', '11:13:00', NULL, 1),
(351, 4, '/admin/?option=students&action=insert', '185.194.199.21', 'Иловакунии донишҷӯ: Мақбулшоева Дилафруз Холиқназаровна', '2025-05-16', '11:13:28', NULL, 1),
(352, 4, '/admin/?option=students&action=insert', '185.194.199.21', 'Иловакунии донишҷӯ: Мусульманова Фариза Рустамовна', '2025-05-16', '11:14:03', NULL, 1),
(353, 4, '/admin/?option=students&action=insert', '185.194.199.21', 'Иловакунии донишҷӯ: Наимзода Эҳсони Сулаймон', '2025-05-16', '11:14:30', '11:16:24', 2),
(354, 4, '/admin/?option=search&action=list&word=%D0%9C%D1%83%D1%81%D1%83%D0%BB%D1%8C%D0%BC%D0%B0%D0%BD%D0%BE%D0%B2%D0%B0%20%D0%A4%D0%B0%D1%80%D0%B8%D0%B7%D0%B0%20%D0%A0%D1%83%D1%81%D1%82%D0%B0%D0%BC%D0%BE%D0%B2%D0%BD%D0%B0', '185.194.199.21', 'Ҷустуҷу: Мусульманова Фариза Рустамовна', '2025-05-16', '11:15:02', NULL, 1),
(355, 4, '/admin/?option=students&action=insert', '185.194.199.21', 'Иловакунии донишҷӯ: Нуралиева Дилоро Сайдалиевна', '2025-05-16', '11:16:49', NULL, 1),
(356, 4, '/admin/?option=students&action=insert', '185.194.199.21', 'Иловакунии донишҷӯ: Нурхонзода Фирдавс Навруз', '2025-05-16', '11:17:10', NULL, 1),
(357, 4, '/admin/?option=students&action=insert', '185.194.199.21', 'Иловакунии донишҷӯ: Саидов Хушбахт Ҳамрокулович', '2025-05-16', '11:17:32', NULL, 1),
(358, 4, '/admin/?option=students&action=insert', '185.194.199.21', 'Иловакунии донишҷӯ: Худойдодов Муҳаммадаюбҷон Саймидинович', '2025-05-16', '11:18:14', NULL, 1),
(359, 4, '/admin/?option=students&action=insert', '185.194.199.21', 'Иловакунии донишҷӯ: Ҳаётов Азизҷон Баҳодурович', '2025-05-16', '11:18:33', NULL, 1),
(360, 4, '/admin/?option=students&action=insert', '185.194.199.21', 'Иловакунии донишҷӯ: Шарипов Фозил Шокирович', '2025-05-16', '11:18:56', NULL, 1),
(361, 4, '/admin/?option=students&action=update_student', '185.194.199.21', 'Таҳриркунии донишҷӯ Наимзода Эҳсони Сулаймон', '2025-05-16', '11:19:40', NULL, 1),
(362, 4, '/admin/?option=students&action=groupstatistic', '185.194.199.21', 'Омори гурӯҳҳо', '2025-05-16', '11:26:41', NULL, 1),
(363, 4, '/admin/?option=students&action=mintaqa', '185.194.199.21', 'Омори минтақавӣ', '2025-05-16', '11:26:48', NULL, 1),
(364, 4, '/admin/?option=students&action=harakat', '185.194.199.21', 'Ҳаракат', '2025-05-16', '11:27:49', NULL, 1),
(365, 4, '/admin/?option=students&action=problems', '185.194.199.21', 'Камбудиҳо', '2025-05-16', '11:28:59', '11:29:24', 5),
(366, 4, '/admin/?option=nt&action=add', '185.194.199.21', 'Иловакунии нақшаи таълимӣ', '2025-05-16', '11:31:50', NULL, 1),
(367, 4, '/admin/?option=students&action=list&id_faculty=1&id_s_l=1&id_s_v=1&id_course=2&id_spec=5&id_group=1', '185.194.199.21', 'Донишҷӯён / ИТРЗС / Бакалавр / Рӯзона / Курси 2 / 1-25011026 / та', '2025-05-16', '11:38:41', NULL, 1),
(368, 4, '/admin/?option=search&action=list&word=%D0%90%D1%81%D0%B0%D0%B4%D1%83%D0%BB%D0%BE%D0%B5%D0%B2%20%D0%A3%D0%BC%D0%B0%D1%80%20%D0%98%D1%81%D0%BC%D0%BE%D0%B8%D0%BB%D0%BE%D0%B2%D0%B8%D1%87', '185.194.199.21', 'Ҷустуҷу: Асадулоев Умар Исмоилович', '2025-05-16', '13:35:49', NULL, 1),
(369, 4, '/admin/?option=students&action=insert', '185.194.199.21', 'Иловакунии донишҷӯ: Асадулоев Умар Исмоилович', '2025-05-16', '13:36:18', NULL, 1),
(370, 4, '/admin/?option=students&action=insert', '185.194.199.21', 'Иловакунии донишҷӯ: Ғарибмамадова Нурафшон Асматҷоновна', '2025-05-16', '13:36:40', NULL, 1),
(371, 4, '/admin/?option=search&action=list&word=%D2%92%D0%B0%D1%80%D0%B8%D0%B1%D0%BC%D0%B0%D0%BC%D0%B0%D0%B4%D0%BE%D0%B2%D0%B0%20%D0%9D%D1%83%D1%80%D0%B0%D1%84%D1%88%D0%BE%D0%BD%20%D0%90%D1%81%D0%BC%D0%B0%D1%82%D2%B7%D0%BE%D0%BD%D0%BE%D0%B2%D0%BD%D0%B0', '185.194.199.21', 'Ҷустуҷу: Ғарибмамадова Нурафшон Асматҷоновна', '2025-05-16', '13:36:54', NULL, 1),
(372, 4, '/admin/?option=students&action=list&id_faculty=1&id_s_l=1&id_s_v=1&id_course=3&id_spec=14&id_group=3', '185.194.199.21', 'Донишҷӯён / ИТРЗС / Бакалавр / Рӯзона / Курси 3 / 1-260202 / тб', '2025-05-16', '13:36:57', '13:46:10', 5),
(373, 4, '/admin/?option=students&action=update_student', '185.194.199.21', 'Таҳриркунии донишҷӯ Ғарибмамадова Нурафшон Асматҷоновна', '2025-05-16', '13:37:13', NULL, 1),
(374, 4, '/admin/?option=students&action=insert', '185.194.199.21', 'Иловакунии донишҷӯ: Зайналобиддини Давлатмурод', '2025-05-16', '13:37:38', NULL, 1),
(375, 4, '/admin/?option=students&action=insert', '185.194.199.21', 'Иловакунии донишҷӯ: Зокирова Маҳина Анваровна', '2025-05-16', '13:38:01', NULL, 1),
(376, 4, '/admin/?option=students&action=insert', '185.194.199.21', 'Иловакунии донишҷӯ: Қурбонов Обидҷон Сайалиевич', '2025-05-16', '13:38:28', NULL, 1),
(377, 4, '/admin/?option=students&action=insert', '185.194.199.21', 'Иловакунии донишҷӯ: Маконов Абдубасир Баҳриддинович', '2025-05-16', '13:39:03', NULL, 1),
(378, 4, '/admin/?option=students&action=insert', '185.194.199.21', 'Иловакунии донишҷӯ: Мамадаминбеков Назмия Юсуфовна', '2025-05-16', '13:39:27', NULL, 1),
(379, 4, '/admin/?option=students&action=insert', '185.194.199.21', 'Иловакунии донишҷӯ: Муҳаммадии Иброҳими Олим', '2025-05-16', '13:39:51', NULL, 1),
(380, 4, '/admin/?option=students&action=insert', '185.194.199.21', 'Иловакунии донишҷӯ: Неъмонов Точиддин Шарофович ', '2025-05-16', '13:40:19', NULL, 1),
(381, 4, '/admin/?option=students&action=insert', '185.194.199.21', 'Иловакунии донишҷӯ: Рабизода Ҷаҳоншои Шамшод', '2025-05-16', '13:41:03', NULL, 1),
(382, 4, '/admin/?option=students&action=insert', '185.194.199.21', 'Иловакунии донишҷӯ: Сабзаев Беҳрӯз Ҷумахонович', '2025-05-16', '13:41:32', NULL, 1),
(383, 4, '/admin/?option=students&action=insert', '185.194.199.21', 'Иловакунии донишҷӯ: Саидзода Саҳобиддин Қудратулло', '2025-05-16', '13:41:58', NULL, 1),
(384, 4, '/admin/?option=students&action=insert', '185.194.199.21', 'Иловакунии донишҷӯ: Сувонов Субхон Шодмонович', '2025-05-16', '13:42:17', NULL, 1),
(385, 4, '/admin/?option=students&action=insert', '185.194.199.21', 'Иловакунии донишҷӯ: Ҳабибов Маҳмадсаид Сафаралиевич', '2025-05-16', '13:43:19', NULL, 1),
(386, 4, '/admin/?option=students&action=insert', '185.194.199.21', 'Иловакунии донишҷӯ: Ҷаборзода Икромҷон Зувайдулло', '2025-05-16', '13:43:49', NULL, 1),
(387, 4, '/admin/?option=students&action=insert', '185.194.199.21', 'Иловакунии донишҷӯ: Ҷонова Наргиса Саломовна', '2025-05-16', '13:44:13', NULL, 1),
(388, 4, '/admin/?option=students&action=insert', '185.194.199.21', 'Иловакунии донишҷӯ: Шарифзода Эмомали Шариф', '2025-05-16', '13:44:37', NULL, 1),
(389, 4, '/admin/?option=search&action=list&word=%D0%9C%D0%B0%D0%BC%D0%B0%D0%B4%D0%B0%D0%BC%D0%B8%D0%BD%D0%B1%D0%B5%D0%BA%D0%BE%D0%B2%20%D0%9D%D0%B0%D0%B7%D0%BC%D0%B8%D1%8F%20%D0%AE%D1%81%D1%83%D1%84%D0%BE%D0%B2%D0%BD%D0%B0', '185.194.199.21', 'Ҷустуҷу: Мамадаминбеков Назмия Юсуфовна', '2025-05-16', '13:45:15', '13:45:26', 2),
(390, 4, '/admin/?option=students&action=update_student', '185.194.199.21', 'Таҳриркунии донишҷӯ Мамадаминбеков Назмия Юсуфовна', '2025-05-16', '13:45:25', NULL, 1),
(391, 4, '/admin/?option=search&action=list&word=%D0%A1%D1%83%D0%B2%D0%BE%D0%BD%D0%BE%D0%B2%20%D0%A1%D1%83%D0%B1%D1%85%D0%BE%D0%BD%20%D0%A8%D0%BE%D0%B4%D0%BC%D0%BE%D0%BD%D0%BE%D0%B2%D0%B8%D1%87', '185.194.199.21', 'Ҷустуҷу: Сувонов Субхон Шодмонович', '2025-05-16', '13:45:58', '13:46:07', 2),
(392, 4, '/admin/?option=students&action=update_student', '185.194.199.21', 'Таҳриркунии донишҷӯ Сувонов Субхон Шодмонович', '2025-05-16', '13:46:07', NULL, 1),
(393, 4, '/admin/', '185.194.199.21', 'Омори гурӯҳҳо', '2025-05-19', '08:17:57', '15:16:59', 7),
(394, 4, '/admin/?option=imtihonho&action=nasuporidand', '185.194.199.21', 'Иштирок накарданд', '2025-05-19', '08:23:43', NULL, 1),
(395, 4, '/admin/?option=nt&action=list&id_faculty=1&id_s_l=1&id_s_v=1', '185.194.199.21', 'Нақшаҳои таълимӣ / ИТРЗС / Бакалавр / Рӯзона', '2025-05-19', '08:24:05', NULL, 1),
(396, 4, '/admin/?option=nt&action=nt_list&id_nt=9', '185.194.199.21', 'Нақшаи таълимӣ / ИТРЗС / Бакалавр / Рӯзона / 2022 / 1-40010108', '2025-05-19', '08:24:08', '13:52:18', 2),
(397, 4, '/admin/?option=soxtor&action=departaments_list', '185.194.199.21', 'Руйхати кафедраҳо', '2025-05-19', '09:45:02', '13:24:36', 9),
(398, 4, '/admin/?option=soxtor&action=faculties_list', '185.194.199.21', 'Руйхати факултетҳо', '2025-05-19', '09:45:06', '10:10:10', 2),
(399, 4, '/admin/?option=teachers&action=list', '185.194.199.21', 'Руйхати омӯзгорҳо', '2025-05-19', '10:09:48', NULL, 1),
(400, 4, '/admin/?option=commission&action=statistic', '185.194.199.21', 'Омори коммисияи қабул', '2025-05-19', '13:24:40', NULL, 1),
(401, 4, '/admin/?option=print&action=contingent', '185.194.199.21', 'Контингент', '2025-05-19', '13:25:03', NULL, 1),
(402, 4, '/admin/', '185.194.199.21', 'Омори гурӯҳҳо', '2025-05-20', '07:36:02', '08:36:13', 3),
(403, 4, '/admin/?option=students&action=mintaqa', '185.194.199.21', 'Омори минтақавӣ', '2025-05-20', '07:37:41', NULL, 1),
(404, 4, '/admin/?option=students&action=groupstatistic', '185.194.199.21', 'Омори гурӯҳҳо', '2025-05-20', '07:38:15', NULL, 1),
(405, 4, '/admin/?option=nt&action=list&id_faculty=1&id_s_l=1&id_s_v=1', '185.194.199.21', 'Нақшаҳои таълимӣ / ИТРЗС / Бакалавр / Рӯзона', '2025-05-20', '07:39:19', '08:16:41', 2),
(406, 4, '/admin/?option=nt&action=nt_list&id_nt=9', '185.194.199.21', 'Нақшаи таълимӣ / ИТРЗС / Бакалавр / Рӯзона / 2022 / 1-40010108', '2025-05-20', '07:39:21', '08:16:43', 2),
(407, 4, '/admin/?option=soxtor&action=faculties_list', '185.194.199.21', 'Руйхати факултетҳо', '2025-05-20', '08:17:59', NULL, 1),
(408, 4, '/admin/?option=soxtor&action=departaments_list', '185.194.199.21', 'Руйхати кафедраҳо', '2025-05-20', '08:18:03', '08:18:14', 4);

-- --------------------------------------------------------

--
-- Структура таблицы `_vip_list`
--

CREATE TABLE `_vip_list` (
  `id` int NOT NULL,
  `id_student` int NOT NULL,
  `text` varchar(1500) NOT NULL,
  `s_y` int NOT NULL,
  `h_y` int NOT NULL,
  `date` datetime NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb3;

-- --------------------------------------------------------

--
-- Структура для представления `real_faculties`
--
DROP TABLE IF EXISTS `real_faculties`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `real_faculties`  AS SELECT DISTINCT `students`.`id_faculty` AS `id_faculty`, `faculties`.`title` AS `title`, `faculties`.`short_title` AS `short_title`, `students`.`s_y` AS `s_y`, `students`.`h_y` AS `h_y` FROM (`students` join `faculties` on((`students`.`id_faculty` = `faculties`.`id`))) ORDER BY `students`.`s_y` DESC, `students`.`h_y` ASC ;

-- --------------------------------------------------------

--
-- Структура для представления `state_groups`
--
DROP TABLE IF EXISTS `state_groups`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `state_groups`  AS SELECT DISTINCT `students`.`id_faculty` AS `id_faculty`, `students`.`id_s_l` AS `id_s_l`, `students`.`id_s_v` AS `id_s_v`, `students`.`id_course` AS `id_course`, `students`.`id_spec` AS `id_spec`, `students`.`id_group` AS `id_group`, `students`.`s_y` AS `s_y`, `students`.`h_y` AS `h_y` FROM `students` WHERE (`students`.`status` = '1') ORDER BY `students`.`s_y` DESC, `students`.`h_y` DESC, `students`.`id_faculty` ASC, `students`.`id_s_l` ASC, `students`.`id_s_v` ASC, `students`.`id_course` ASC, `students`.`id_spec` ASC, `students`.`id_group` ASC ;

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `answers`
--
ALTER TABLE `answers`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_question` (`id_question`),
  ADD KEY `right_answer` (`right_answer`),
  ADD KEY `position` (`position`);

--
-- Индексы таблицы `biometric_module`
--
ALTER TABLE `biometric_module`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_user` (`id_user`);

--
-- Индексы таблицы `bugaltaria_module`
--
ALTER TABLE `bugaltaria_module`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_user` (`id_user`);

--
-- Индексы таблицы `commission_module`
--
ALTER TABLE `commission_module`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_user` (`id_user`);

--
-- Индексы таблицы `contingent_module`
--
ALTER TABLE `contingent_module`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_user` (`id_user`);

--
-- Индексы таблицы `countries`
--
ALTER TABLE `countries`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `course`
--
ALTER TABLE `course`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `credits_table`
--
ALTER TABLE `credits_table`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `davrho`
--
ALTER TABLE `davrho`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `departaments`
--
ALTER TABLE `departaments`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `departaments_member`
--
ALTER TABLE `departaments_member`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_departament` (`id_departament`),
  ADD KEY `s_y` (`s_y`);

--
-- Индексы таблицы `department_education`
--
ALTER TABLE `department_education`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `diploms`
--
ALTER TABLE `diploms`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `districts`
--
ALTER TABLE `districts`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_region` (`id_region`);

--
-- Индексы таблицы `elonho`
--
ALTER TABLE `elonho`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `faculties`
--
ALTER TABLE `faculties`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `faculties_settings`
--
ALTER TABLE `faculties_settings`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_faculty` (`id_faculty`),
  ADD KEY `s_y` (`s_y`),
  ADD KEY `h_y` (`h_y`);

--
-- Индексы таблицы `fan_test`
--
ALTER TABLE `fan_test`
  ADD PRIMARY KEY (`id`);
ALTER TABLE `fan_test` ADD FULLTEXT KEY `title_tj` (`title_tj`);

--
-- Индексы таблицы `farqiyatho`
--
ALTER TABLE `farqiyatho`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_student` (`id_student`),
  ADD KEY `status` (`status`),
  ADD KEY `s_y` (`s_y`),
  ADD KEY `h_y` (`h_y`);

--
-- Индексы таблицы `farqiyatho_content`
--
ALTER TABLE `farqiyatho_content`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_farqiyat` (`id_farqiyat`),
  ADD KEY `id_fan` (`id_fan`),
  ADD KEY `type` (`type`),
  ADD KEY `id_course` (`id_course`),
  ADD KEY `id_teacher` (`id_teacher`),
  ADD KEY `status` (`status`),
  ADD KEY `s_y` (`s_y`),
  ADD KEY `h_y` (`h_y`);

--
-- Индексы таблицы `groups`
--
ALTER TABLE `groups`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `iqtibosho`
--
ALTER TABLE `iqtibosho`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_nt` (`id_nt`),
  ADD KEY `semestr` (`semestr`),
  ADD KEY `id_departament` (`id_departament`),
  ADD KEY `id_s_l` (`id_s_l`),
  ADD KEY `id_s_v` (`id_s_v`),
  ADD KEY `id_course` (`id_course`),
  ADD KEY `id_spec` (`id_spec`),
  ADD KEY `id_group` (`id_group`),
  ADD KEY `id_fan` (`id_fan`),
  ADD KEY `s_y` (`s_y`);

--
-- Индексы таблицы `jd`
--
ALTER TABLE `jd`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_faculty` (`id_faculty`),
  ADD KEY `id_course` (`id_course`),
  ADD KEY `id_spec` (`id_spec`),
  ADD KEY `id_group` (`id_group`),
  ADD KEY `id_fan` (`id_fan`),
  ADD KEY `id_teacher` (`id_teacher`),
  ADD KEY `s_y` (`s_y`),
  ADD KEY `h_y` (`h_y`);

--
-- Индексы таблицы `khobgoh`
--
ALTER TABLE `khobgoh`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_user` (`id_user`),
  ADD KEY `s_y` (`s_y`),
  ADD KEY `id_khobgoh` (`id_khobgoh`),
  ADD KEY `number_home` (`number_home`);

--
-- Индексы таблицы `khobgoh_module`
--
ALTER TABLE `khobgoh_module`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_user` (`id_user`);

--
-- Индексы таблицы `lessons_type`
--
ALTER TABLE `lessons_type`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `litsey_module`
--
ALTER TABLE `litsey_module`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_user` (`id_user`);

--
-- Индексы таблицы `mavodho`
--
ALTER TABLE `mavodho`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `messages`
--
ALTER TABLE `messages`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `nations`
--
ALTER TABLE `nations`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `nt_content`
--
ALTER TABLE `nt_content`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_nt` (`id_nt`),
  ADD KEY `semestr` (`semestr`),
  ADD KEY `id_fan` (`id_fan`);

--
-- Индексы таблицы `nt_list`
--
ALTER TABLE `nt_list`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_faculty` (`id_faculty`),
  ADD KEY `id_spec` (`id_spec`),
  ADD KEY `id_s_v` (`id_s_v`),
  ADD KEY `id_s_l` (`id_s_l`),
  ADD KEY `soli_tasdiq` (`soli_tasdiq`);

--
-- Индексы таблицы `qabul_plan`
--
ALTER TABLE `qabul_plan`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `qabul_plan_detail`
--
ALTER TABLE `qabul_plan_detail`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_qabul_plan` (`id_qabul_plan`),
  ADD KEY `id_spec` (`id_spec`),
  ADD KEY `id_s_l` (`id_s_l`),
  ADD KEY `id_s_v` (`id_s_v`),
  ADD KEY `id_s_t` (`id_s_t`);

--
-- Индексы таблицы `questions`
--
ALTER TABLE `questions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_faculty` (`id_faculty`),
  ADD KEY `id_s_l` (`id_s_l`),
  ADD KEY `id_s_v` (`id_s_v`),
  ADD KEY `id_course` (`id_course`),
  ADD KEY `id_spec` (`id_spec`),
  ADD KEY `id_fan` (`id_fan`),
  ADD KEY `lang` (`lang`),
  ADD KEY `type` (`type`);

--
-- Индексы таблицы `rasidho`
--
ALTER TABLE `rasidho`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `tranid` (`tranid`),
  ADD KEY `id_student` (`id_student`),
  ADD KEY `check_date` (`check_date`),
  ADD KEY `s_y` (`s_y`),
  ADD KEY `author` (`author`),
  ADD KEY `type` (`type`);

--
-- Индексы таблицы `rasid_module`
--
ALTER TABLE `rasid_module`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_user` (`id_user`);

--
-- Индексы таблицы `rat`
--
ALTER TABLE `rat`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `regions`
--
ALTER TABLE `regions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_country` (`id_country`);

--
-- Индексы таблицы `results`
--
ALTER TABLE `results`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_faculty` (`id_faculty`),
  ADD KEY `id_student` (`id_student`),
  ADD KEY `id_course` (`id_course`),
  ADD KEY `id_spec` (`id_spec`),
  ADD KEY `id_group` (`id_group`),
  ADD KEY `id_fan` (`id_fan`),
  ADD KEY `type` (`type`),
  ADD KEY `s_y` (`s_y`),
  ADD KEY `h_y` (`h_y`),
  ADD KEY `id_s_l` (`id_s_l`),
  ADD KEY `id_s_v` (`id_s_v`),
  ADD KEY `semestr` (`semestr`);

--
-- Индексы таблицы `results_student`
--
ALTER TABLE `results_student`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `results_teacher`
--
ALTER TABLE `results_teacher`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `results_variants`
--
ALTER TABLE `results_variants`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `sarboriho`
--
ALTER TABLE `sarboriho`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_iqtibos` (`id_iqtibos`),
  ADD KEY `id_teacher` (`id_teacher`),
  ADD KEY `type` (`type`);

--
-- Индексы таблицы `score_history`
--
ALTER TABLE `score_history`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_student` (`id_student`),
  ADD KEY `id_fan` (`id_fan`);

--
-- Индексы таблицы `shurbo`
--
ALTER TABLE `shurbo`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `sokhtor`
--
ALTER TABLE `sokhtor`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `specialties`
--
ALTER TABLE `specialties`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_faculty` (`id_faculty`),
  ADD KEY `id_s_l` (`id_s_l`);

--
-- Индексы таблицы `stds_farmonho`
--
ALTER TABLE `stds_farmonho`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `stds_farmon_type`
--
ALTER TABLE `stds_farmon_type`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `std_study_groups`
--
ALTER TABLE `std_study_groups`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_faculty` (`id_faculty`),
  ADD KEY `id_s_l` (`id_s_l`),
  ADD KEY `id_s_v` (`id_s_v`),
  ADD KEY `id_course` (`id_course`),
  ADD KEY `id_spec` (`id_spec`),
  ADD KEY `id_group` (`id_group`),
  ADD KEY `s_y` (`s_y`),
  ADD KEY `h_y` (`h_y`),
  ADD KEY `id_nt` (`id_nt`),
  ADD KEY `lang` (`lang`);

--
-- Индексы таблицы `structure`
--
ALTER TABLE `structure`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `students`
--
ALTER TABLE `students`
  ADD UNIQUE KEY `id` (`id`),
  ADD KEY `id_student` (`id_student`),
  ADD KEY `id_faculty` (`id_faculty`),
  ADD KEY `id_course` (`id_course`),
  ADD KEY `id_spec` (`id_spec`),
  ADD KEY `id_group` (`id_group`),
  ADD KEY `id_s_l` (`id_s_l`),
  ADD KEY `id_s_t` (`id_s_t`),
  ADD KEY `id_s_v` (`id_s_v`),
  ADD KEY `s_y` (`s_y`),
  ADD KEY `h_y` (`h_y`),
  ADD KEY `status` (`status`),
  ADD KEY `vazi_oilavi` (`vazi_oilavi`),
  ADD KEY `foreign` (`foreign`);

--
-- Индексы таблицы `students_absents`
--
ALTER TABLE `students_absents`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_student` (`id_student`),
  ADD KEY `id_fan` (`id_fan`),
  ADD KEY `s_y` (`s_y`),
  ADD KEY `h_y` (`h_y`),
  ADD KEY `rating` (`rating`);

--
-- Индексы таблицы `student_litsey`
--
ALTER TABLE `student_litsey`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_xonanda` (`id_xonanda`),
  ADD KEY `id_sinf` (`id_sinf`),
  ADD KEY `id_group` (`id_group`),
  ADD KEY `s_y` (`s_y`),
  ADD KEY `h_y` (`h_y`);

--
-- Индексы таблицы `student_mmt_information`
--
ALTER TABLE `student_mmt_information`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_student` (`id_student`),
  ADD KEY `davri_qabul_mmt` (`davri_qabul_mmt`);

--
-- Индексы таблицы `study_level`
--
ALTER TABLE `study_level`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `study_type`
--
ALTER TABLE `study_type`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `study_view`
--
ALTER TABLE `study_view`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `study_years`
--
ALTER TABLE `study_years`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `suporishho`
--
ALTER TABLE `suporishho`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_jd` (`id_iqtibos`),
  ADD KEY `id_week` (`id_week`),
  ADD KEY `id_fan` (`id_fan`),
  ADD KEY `s_y` (`s_y`),
  ADD KEY `h_y` (`h_y`);

--
-- Индексы таблицы `teacher_module`
--
ALTER TABLE `teacher_module`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `tests`
--
ALTER TABLE `tests`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_iqtibos` (`id_iqtibos`),
  ADD KEY `id_faculty` (`id_faculty`),
  ADD KEY `id_s_l` (`id_s_l`),
  ADD KEY `id_s_v` (`id_s_v`),
  ADD KEY `id_course` (`id_course`),
  ADD KEY `id_spec` (`id_spec`),
  ADD KEY `id_group` (`id_group`),
  ADD KEY `id_fan` (`id_fan`),
  ADD KEY `imt_type` (`imt_type`),
  ADD KEY `s_y` (`s_y`),
  ADD KEY `h_y` (`h_y`),
  ADD KEY `r_1_date` (`r_1_date`),
  ADD KEY `r_2_date` (`r_2_date`);

--
-- Индексы таблицы `tests_settings`
--
ALTER TABLE `tests_settings`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_fan` (`id_fan`),
  ADD KEY `s_y` (`s_y`),
  ADD KEY `h_y` (`h_y`);

--
-- Индексы таблицы `test_center_module`
--
ALTER TABLE `test_center_module`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_user` (`id_user`);

--
-- Индексы таблицы `trimestr`
--
ALTER TABLE `trimestr`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_student` (`id_student`),
  ADD KEY `author` (`author`),
  ADD KEY `s_y` (`s_y`),
  ADD KEY `h_y` (`h_y`);

--
-- Индексы таблицы `trimestr_content`
--
ALTER TABLE `trimestr_content`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_trimestr` (`id_trimestr`),
  ADD KEY `id_faculty` (`id_faculty`),
  ADD KEY `id_s_l` (`id_s_l`),
  ADD KEY `id_s_v` (`id_s_v`),
  ADD KEY `id_course` (`id_course`),
  ADD KEY `id_spec` (`id_spec`),
  ADD KEY `id_group` (`id_group`),
  ADD KEY `id_fan` (`id_fan`),
  ADD KEY `imt_type` (`imt_type`),
  ADD KEY `status` (`status`),
  ADD KEY `s_y` (`s_y`),
  ADD KEY `h_y` (`h_y`),
  ADD KEY `id_teacher` (`id_teacher`);

--
-- Индексы таблицы `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `login` (`login`),
  ADD KEY `access_type` (`access_type`),
  ADD KEY `jins` (`jins`),
  ADD KEY `password` (`password`),
  ADD KEY `added_by` (`added_by`),
  ADD KEY `v_oilavi` (`v_oilavi`);

--
-- Индексы таблицы `users_2`
--
ALTER TABLE `users_2`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `users_biometric`
--
ALTER TABLE `users_biometric`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_user` (`id_user`);

--
-- Индексы таблицы `user_passports`
--
ALTER TABLE `user_passports`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_user` (`id_user`),
  ADD KEY `id_country` (`id_country`),
  ADD KEY `id_nation` (`id_nation`),
  ADD KEY `id_region` (`id_region`),
  ADD KEY `id_district` (`id_district`);

--
-- Индексы таблицы `user_udecation`
--
ALTER TABLE `user_udecation`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_user` (`id_user`),
  ADD KEY `id_khatm_namud` (`id_khatm_namud`),
  ADD KEY `id_hujjat` (`id_hujjat`);

--
-- Индексы таблицы `vazifaho`
--
ALTER TABLE `vazifaho`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `vazi_oilavi`
--
ALTER TABLE `vazi_oilavi`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `weeks`
--
ALTER TABLE `weeks`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `_datasonline`
--
ALTER TABLE `_datasonline`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_user` (`id_user`),
  ADD KEY `date` (`date`);

--
-- Индексы таблицы `_vip_list`
--
ALTER TABLE `_vip_list`
  ADD PRIMARY KEY (`id`),
  ADD KEY `s_y` (`s_y`),
  ADD KEY `h_y` (`h_y`),
  ADD KEY `id_student` (`id_student`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `answers`
--
ALTER TABLE `answers`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `biometric_module`
--
ALTER TABLE `biometric_module`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `bugaltaria_module`
--
ALTER TABLE `bugaltaria_module`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT для таблицы `commission_module`
--
ALTER TABLE `commission_module`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT для таблицы `contingent_module`
--
ALTER TABLE `contingent_module`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT для таблицы `countries`
--
ALTER TABLE `countries`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT для таблицы `course`
--
ALTER TABLE `course`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT для таблицы `credits_table`
--
ALTER TABLE `credits_table`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT для таблицы `davrho`
--
ALTER TABLE `davrho`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT для таблицы `departaments`
--
ALTER TABLE `departaments`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT для таблицы `departaments_member`
--
ALTER TABLE `departaments_member`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `department_education`
--
ALTER TABLE `department_education`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `diploms`
--
ALTER TABLE `diploms`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `districts`
--
ALTER TABLE `districts`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=76;

--
-- AUTO_INCREMENT для таблицы `elonho`
--
ALTER TABLE `elonho`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT для таблицы `faculties`
--
ALTER TABLE `faculties`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT для таблицы `faculties_settings`
--
ALTER TABLE `faculties_settings`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT для таблицы `fan_test`
--
ALTER TABLE `fan_test`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;

--
-- AUTO_INCREMENT для таблицы `farqiyatho`
--
ALTER TABLE `farqiyatho`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT для таблицы `farqiyatho_content`
--
ALTER TABLE `farqiyatho_content`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=86;

--
-- AUTO_INCREMENT для таблицы `groups`
--
ALTER TABLE `groups`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT для таблицы `iqtibosho`
--
ALTER TABLE `iqtibosho`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT для таблицы `jd`
--
ALTER TABLE `jd`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `khobgoh`
--
ALTER TABLE `khobgoh`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT для таблицы `khobgoh_module`
--
ALTER TABLE `khobgoh_module`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT для таблицы `lessons_type`
--
ALTER TABLE `lessons_type`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT для таблицы `litsey_module`
--
ALTER TABLE `litsey_module`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `mavodho`
--
ALTER TABLE `mavodho`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `messages`
--
ALTER TABLE `messages`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT для таблицы `nations`
--
ALTER TABLE `nations`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT для таблицы `nt_content`
--
ALTER TABLE `nt_content`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=114;

--
-- AUTO_INCREMENT для таблицы `nt_list`
--
ALTER TABLE `nt_list`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT для таблицы `qabul_plan`
--
ALTER TABLE `qabul_plan`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT для таблицы `qabul_plan_detail`
--
ALTER TABLE `qabul_plan_detail`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=832;

--
-- AUTO_INCREMENT для таблицы `questions`
--
ALTER TABLE `questions`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `rasidho`
--
ALTER TABLE `rasidho`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `rasid_module`
--
ALTER TABLE `rasid_module`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT для таблицы `rat`
--
ALTER TABLE `rat`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `regions`
--
ALTER TABLE `regions`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT для таблицы `results`
--
ALTER TABLE `results`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `results_student`
--
ALTER TABLE `results_student`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `results_teacher`
--
ALTER TABLE `results_teacher`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `results_variants`
--
ALTER TABLE `results_variants`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `sarboriho`
--
ALTER TABLE `sarboriho`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `score_history`
--
ALTER TABLE `score_history`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `shurbo`
--
ALTER TABLE `shurbo`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=472;

--
-- AUTO_INCREMENT для таблицы `sokhtor`
--
ALTER TABLE `sokhtor`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `specialties`
--
ALTER TABLE `specialties`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=167;

--
-- AUTO_INCREMENT для таблицы `stds_farmonho`
--
ALTER TABLE `stds_farmonho`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `stds_farmon_type`
--
ALTER TABLE `stds_farmon_type`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `std_study_groups`
--
ALTER TABLE `std_study_groups`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=65;

--
-- AUTO_INCREMENT для таблицы `structure`
--
ALTER TABLE `structure`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `students`
--
ALTER TABLE `students`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1141;

--
-- AUTO_INCREMENT для таблицы `students_absents`
--
ALTER TABLE `students_absents`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `student_litsey`
--
ALTER TABLE `student_litsey`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `student_mmt_information`
--
ALTER TABLE `student_mmt_information`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `study_level`
--
ALTER TABLE `study_level`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT для таблицы `study_type`
--
ALTER TABLE `study_type`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT для таблицы `study_view`
--
ALTER TABLE `study_view`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT для таблицы `study_years`
--
ALTER TABLE `study_years`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT для таблицы `suporishho`
--
ALTER TABLE `suporishho`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `teacher_module`
--
ALTER TABLE `teacher_module`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `tests`
--
ALTER TABLE `tests`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `tests_settings`
--
ALTER TABLE `tests_settings`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=599;

--
-- AUTO_INCREMENT для таблицы `test_center_module`
--
ALTER TABLE `test_center_module`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `trimestr`
--
ALTER TABLE `trimestr`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `trimestr_content`
--
ALTER TABLE `trimestr_content`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `users`
--
ALTER TABLE `users`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=308;

--
-- AUTO_INCREMENT для таблицы `users_2`
--
ALTER TABLE `users_2`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT для таблицы `users_biometric`
--
ALTER TABLE `users_biometric`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `user_passports`
--
ALTER TABLE `user_passports`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=286;

--
-- AUTO_INCREMENT для таблицы `user_udecation`
--
ALTER TABLE `user_udecation`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=286;

--
-- AUTO_INCREMENT для таблицы `vazifaho`
--
ALTER TABLE `vazifaho`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `vazi_oilavi`
--
ALTER TABLE `vazi_oilavi`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT для таблицы `weeks`
--
ALTER TABLE `weeks`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT для таблицы `_datasonline`
--
ALTER TABLE `_datasonline`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=409;

--
-- AUTO_INCREMENT для таблицы `_vip_list`
--
ALTER TABLE `_vip_list`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
