-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Erstellungszeit: 25. Feb 2021 um 01:48
-- Server-Version: 10.4.11-MariaDB
-- PHP-Version: 7.2.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Datenbank: `feedpeak_demo`
--

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `admin`
--

CREATE TABLE `admin` (
  `ID` int(11) NOT NULL,
  `Datum` timestamp NOT NULL DEFAULT current_timestamp(),
  `Typ` varchar(200) NOT NULL,
  `Fragen_extern` varchar(500) NOT NULL,
  `Kapitel` varchar(500) NOT NULL,
  `Leistung_39` tinyint(1) NOT NULL,
  `Leistung_37` tinyint(1) NOT NULL,
  `Leistung_38` tinyint(1) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4;

--
-- Daten für Tabelle `admin`
--

INSERT INTO `admin` (`ID`, `Datum`, `Typ`, `Fragen_extern`, `Kapitel`, `Leistung_39`, `Leistung_37`, `Leistung_38`) VALUES
(258, '2021-01-07 14:08:56', 'multiple_choice', 'Wie haben Sie den Trainer empfunden?', 'Test', 1, 0, 1),
(259, '2021-01-07 14:09:07', 'rangeslider', 'Testrange', 'Test', 1, 1, 1),
(260, '2021-01-07 14:09:15', 'text', 'Testtext', 'Test', 1, 1, 1),
(261, '2021-02-18 14:43:35', 'text', 'Email', 'Kontaktdaten', 0, 0, 0),
(271, '2021-02-20 00:42:39', 'multiple_choice', 'Wie haben Sie den Berater empfunden', 'Beratung', 1, 0, 0),
(274, '2021-02-22 09:47:55', 'multiple_choice', 'Testfrage', 'Test', 0, 0, 0);

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `externes_feedback`
--

CREATE TABLE `externes_feedback` (
  `ID` int(11) NOT NULL,
  `Datum` timestamp NOT NULL DEFAULT current_timestamp(),
  `Username` varchar(200) NOT NULL,
  `Trainer` varchar(200) NOT NULL,
  `Leistung` varchar(200) NOT NULL,
  `Frage_258` varchar(500) DEFAULT NULL,
  `Frage_259` int(11) DEFAULT NULL,
  `Frage_260` varchar(1000) DEFAULT NULL,
  `Frage_261` varchar(1000) DEFAULT NULL,
  `Frage_271` varchar(1000) DEFAULT NULL,
  `Frage_274` varchar(1000) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4;

--
-- Daten für Tabelle `externes_feedback`
--

INSERT INTO `externes_feedback` (`ID`, `Datum`, `Username`, `Trainer`, `Leistung`, `Frage_258`, `Frage_259`, `Frage_260`, `Frage_261`, `Frage_271`, `Frage_274`) VALUES
(433, '2021-02-24 20:59:18', 'Holdo', 'Dominic Holzweber', 'Test', 'unbrauchbar', 81, 'test2', NULL, 'eher negativ', NULL),
(432, '2021-02-24 20:58:36', 'Holdo', 'Dominic Holzweber', 'Test', 'unbrauchbar', 71, 'Test', NULL, 'eher positiv', NULL),
(431, '2021-02-23 14:05:47', 'Holdo', 'Dominic Holzweber', 'Test', 'eher negativ', 100, 'test', NULL, 'schlecht', NULL),
(430, '2021-01-23 14:03:28', 'Holdo', 'Dominic Holzweber', 'Test', 'eher negativ', NULL, 'test', NULL, 'schlecht', 'sehr gut'),
(429, '2021-02-23 14:02:22', 'Holdo', 'Dominic Holzweber', 'Test', 'eher negativ', NULL, 'test', NULL, 'eher negativ', 'gut'),
(428, '2021-02-23 12:02:31', 'Holdo', 'Dominic Holzweber', 'Test', 'unbrauchbar', NULL, 'test', NULL, 'eher negativ', 'sehr gut'),
(434, '2021-02-24 20:59:40', 'Holdo', 'Dominic Holzweber', 'Test', 'eher negativ', 11, 'test', NULL, 'gut', NULL),
(435, '2021-02-24 21:00:07', 'Holdo', 'Dominic Holzweber', 'Test', 'gut', 79, 'test', NULL, 'eher positiv', NULL),
(436, '2021-02-24 21:00:43', 'Holdo', 'Dominic Holzweber', 'Test', 'eher negativ', 72, 'test', NULL, 'schlecht', NULL),
(437, '2021-02-24 21:01:04', 'Holdo', 'Dominic Holzweber', 'Test', 'unbrauchbar', 87, 'test', NULL, 'gut', NULL),
(438, '2021-02-24 21:01:23', 'Holdo', 'Dominic Holzweber', 'Test', 'unbrauchbar', 69, 'test', NULL, 'eher negativ', NULL),
(439, '2021-02-24 21:01:45', 'Holdo', 'Dominic Holzweber', 'Test', 'eher negativ', 67, 'uzbdqw', NULL, 'gut', NULL);

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `intern`
--

CREATE TABLE `intern` (
  `ID` int(11) NOT NULL,
  `Datum` timestamp NOT NULL DEFAULT current_timestamp(),
  `Typ` varchar(200) NOT NULL,
  `Fragen_intern` varchar(500) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4;

--
-- Daten für Tabelle `intern`
--

INSERT INTO `intern` (`ID`, `Datum`, `Typ`, `Fragen_intern`) VALUES
(56, '2021-01-05 13:49:02', 'multiple_choice', 'Test'),
(57, '2021-01-17 21:49:31', 'rangeslider', 'Range'),
(58, '2021-01-17 21:49:38', 'text', 'Text'),
(59, '2021-02-18 21:28:32', 'multiple_choice', '');

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `interner_blog`
--

CREATE TABLE `interner_blog` (
  `ID` int(11) NOT NULL,
  `Beitrag` varchar(2000) NOT NULL,
  `Kommentar` varchar(2000) NOT NULL,
  `Timestamp` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4;

--
-- Daten für Tabelle `interner_blog`
--

INSERT INTO `interner_blog` (`ID`, `Beitrag`, `Kommentar`, `Timestamp`) VALUES
(15, 'Test', '', '2021-02-02 22:31:31');

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `interner_blog_kommentare`
--

CREATE TABLE `interner_blog_kommentare` (
  `ID` int(11) NOT NULL,
  `ID_von_Blogbeitrag` int(11) NOT NULL,
  `Kommentar` varchar(2000) NOT NULL,
  `Timestamp` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `internes_feedback`
--

CREATE TABLE `internes_feedback` (
  `ID` int(11) NOT NULL,
  `Datum` timestamp NOT NULL DEFAULT current_timestamp(),
  `Frage_56` int(11) DEFAULT NULL,
  `Frage_57` int(11) DEFAULT NULL,
  `Frage_58` varchar(1000) DEFAULT NULL,
  `Frage_59` int(11) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4;

--
-- Daten für Tabelle `internes_feedback`
--

INSERT INTO `internes_feedback` (`ID`, `Datum`, `Frage_56`, `Frage_57`, `Frage_58`, `Frage_59`) VALUES
(56, '2021-01-06 00:18:37', 6, NULL, NULL, NULL),
(58, '2021-02-17 22:40:54', 4, 83, 'Alles OK so weit', NULL),
(59, '2021-02-18 00:24:40', 4, 85, 'giut', NULL);

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `leistungen`
--

CREATE TABLE `leistungen` (
  `ID` int(11) NOT NULL,
  `Datum` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `Leistung` varchar(500) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4;

--
-- Daten für Tabelle `leistungen`
--

INSERT INTO `leistungen` (`ID`, `Datum`, `Leistung`) VALUES
(39, '2021-02-18 14:59:04', 'Test'),
(37, '2021-02-18 14:19:03', 'Beratung'),
(38, '2021-02-18 14:19:07', 'CPRE');

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `singlechoice_answers`
--

CREATE TABLE `singlechoice_answers` (
  `ID` int(11) NOT NULL,
  `Answers` varchar(2000) NOT NULL,
  `Frage_258` tinyint(1) NOT NULL,
  `Frage_259` tinyint(1) NOT NULL,
  `Frage_260` tinyint(1) NOT NULL,
  `Frage_261` tinyint(1) NOT NULL,
  `Frage_271` tinyint(1) NOT NULL,
  `Frage_274` tinyint(1) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4;

--
-- Daten für Tabelle `singlechoice_answers`
--

INSERT INTO `singlechoice_answers` (`ID`, `Answers`, `Frage_258`, `Frage_259`, `Frage_260`, `Frage_261`, `Frage_271`, `Frage_274`) VALUES
(18, 'unbrauchbar', 1, 1, 0, 1, 0, 0),
(19, 'schlecht', 0, 1, 0, 0, 1, 0),
(20, 'eher negativ', 1, 1, 0, 0, 1, 0),
(21, 'eher positiv', 0, 0, 0, 0, 1, 0),
(22, 'gut', 1, 0, 0, 0, 1, 1),
(24, 'sehr gut', 0, 0, 0, 1, 0, 1);

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `rangeslider_answers`
--

CREATE TABLE `rangeslider_answers` (
  `ID` int(11) NOT NULL,
  `range_max` int(11) NOT NULL,
  `range_min` int(11) NOT NULL,
  `columns` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Daten für Tabelle `rangeslider_answers`
--

INSERT INTO `rangeslider_answers` (`ID`, `range_max`, `range_min`, `columns`) VALUES
(1, 100, 0, 5);

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `system`
--

CREATE TABLE `system` (
  `ID` int(11) NOT NULL,
  `lizenzmodell` varchar(1000) NOT NULL,
  `gültigkeit` date NOT NULL,
  `max_anzahl_benutzer` int(11) NOT NULL,
  `anzahl_benutzer` int(11) NOT NULL,
  `farbe` varchar(1000) NOT NULL,
  `bgbild_abgeben` varchar(1000) NOT NULL,
  `bgbild_login` varchar(1000) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Daten für Tabelle `system`
--

INSERT INTO `system` (`ID`, `lizenzmodell`, `gültigkeit`, `max_anzahl_benutzer`, `anzahl_benutzer`, `farbe`, `bgbild_abgeben`, `bgbild_login`) VALUES
(1, 'Freepeak', '2031-05-12', 3, 3, '#093a58', '', '');

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(30) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(500) NOT NULL,
  `created_at` datetime DEFAULT current_timestamp(),
  `internes_feedback_abgegeben` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `Is_Admin` tinyint(1) NOT NULL,
  `Is_Trainer` tinyint(4) NOT NULL,
  `Is_Creator` tinyint(1) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4;

--
-- Daten für Tabelle `users`
--

INSERT INTO `users` (`id`, `name`, `username`, `password`, `email`, `created_at`, `internes_feedback_abgegeben`, `Is_Admin`, `Is_Trainer`, `Is_Creator`) VALUES
(68, 'Admin', 'Admin', '$2y$10$QCYntC.QWxn8h1H.o/8q.Oo/97GaZEZ3DfkVNY7/fdk6MJlOJHFM.', 'info@feedtracker.com', '2020-09-18 20:13:48', '2021-02-17 22:40:54', 1, 0, 1),
(71, 'Alle Berater', 'externes_feedback', '$2y$10$PlR96zGJ.YgsNpYO0dAKVehz48R0DgcpA7hxMFxECRHp3MDc8w4UG', 'trainer@email.com', '2020-09-18 20:22:23', '2021-02-01 12:29:09', 0, 1, 0),
(87, 'Dominic Holzweber', 'Holdo', '$2y$10$WvKUeDN7REl.hq2kUoLqVOc5B/LDRLeJuH4SMZhsqcnb0xvqh0XWK', 'd.holzweber@hotmail.com', '2021-01-02 20:54:00', '2021-02-20 22:47:44', 0, 1, 0);

--
-- Indizes der exportierten Tabellen
--

--
-- Indizes für die Tabelle `admin`
--
ALTER TABLE `admin`
  ADD UNIQUE KEY `ID` (`ID`);

--
-- Indizes für die Tabelle `externes_feedback`
--
ALTER TABLE `externes_feedback`
  ADD UNIQUE KEY `ID` (`ID`);

--
-- Indizes für die Tabelle `intern`
--
ALTER TABLE `intern`
  ADD UNIQUE KEY `ID` (`ID`);

--
-- Indizes für die Tabelle `interner_blog`
--
ALTER TABLE `interner_blog`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `ID` (`ID`);

--
-- Indizes für die Tabelle `interner_blog_kommentare`
--
ALTER TABLE `interner_blog_kommentare`
  ADD PRIMARY KEY (`ID`);

--
-- Indizes für die Tabelle `internes_feedback`
--
ALTER TABLE `internes_feedback`
  ADD UNIQUE KEY `ID` (`ID`);

--
-- Indizes für die Tabelle `leistungen`
--
ALTER TABLE `leistungen`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `ID` (`ID`);

--
-- Indizes für die Tabelle `singlechoice_answers`
--
ALTER TABLE `singlechoice_answers`
  ADD PRIMARY KEY (`ID`);

--
-- Indizes für die Tabelle `rangeslider_answers`
--
ALTER TABLE `rangeslider_answers`
  ADD PRIMARY KEY (`ID`);

--
-- Indizes für die Tabelle `system`
--
ALTER TABLE `system`
  ADD PRIMARY KEY (`ID`);

--
-- Indizes für die Tabelle `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT für exportierte Tabellen
--

--
-- AUTO_INCREMENT für Tabelle `admin`
--
ALTER TABLE `admin`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=278;

--
-- AUTO_INCREMENT für Tabelle `externes_feedback`
--
ALTER TABLE `externes_feedback`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=440;

--
-- AUTO_INCREMENT für Tabelle `intern`
--
ALTER TABLE `intern`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=60;

--
-- AUTO_INCREMENT für Tabelle `interner_blog`
--
ALTER TABLE `interner_blog`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT für Tabelle `interner_blog_kommentare`
--
ALTER TABLE `interner_blog_kommentare`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT für Tabelle `internes_feedback`
--
ALTER TABLE `internes_feedback`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=60;

--
-- AUTO_INCREMENT für Tabelle `leistungen`
--
ALTER TABLE `leistungen`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=68;

--
-- AUTO_INCREMENT für Tabelle `singlechoice_answers`
--
ALTER TABLE `singlechoice_answers`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT für Tabelle `rangeslider_answers`
--
ALTER TABLE `rangeslider_answers`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT für Tabelle `system`
--
ALTER TABLE `system`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT für Tabelle `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=88;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
