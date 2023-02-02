-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Erstellungszeit: 02. Feb 2022 um 00:37
-- Server-Version: 10.4.22-MariaDB
-- PHP-Version: 8.1.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Datenbank: `feedcube_test`
--

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `admin`
--

CREATE TABLE `admin` (
  `ID` int(11) NOT NULL,
  `Datum` timestamp NOT NULL DEFAULT current_timestamp(),
  `Typ` varchar(200) NOT NULL,
  `Antworttyp` varchar(40) NOT NULL,
  `Fragen_extern` varchar(500) NOT NULL,
  `Kapitel` varchar(500) NOT NULL,
  `Frage_Englisch` varchar(500) DEFAULT NULL,
  `Kapitel_Englisch` varchar(500) DEFAULT NULL,
  `post_order_no` int(11) NOT NULL,
  `post_id` int(11) NOT NULL,
  `Fragenset_12` tinyint(1) DEFAULT NULL,
  `Leistung_6` tinyint(1) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4;

--
-- Daten für Tabelle `admin`
--

INSERT INTO `admin` (`ID`, `Datum`, `Typ`, `Antworttyp`, `Fragen_extern`, `Kapitel`, `Frage_Englisch`, `Kapitel_Englisch`, `post_order_no`, `post_id`, `Fragenset_12`, `Leistung_6`) VALUES
(71, '2022-01-30 08:27:11', 'Bewertung', 'vordefiniert', 'TEst', '', '', '', 1, 1, NULL, 1),
(72, '2022-01-30 08:36:04', 'Bewertung', 'vordefiniert', 'ofibuewmq qphefoiug weö0fhiwe9uiFWE  ?', 'Test2', 'feiwfew', 'TEs 3', 2, 2, NULL, 1);

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `bewertung_answers`
--

CREATE TABLE `bewertung_answers` (
  `ID` int(11) NOT NULL,
  `Answers` varchar(2000) NOT NULL,
  `Answers_Englisch` varchar(500) DEFAULT NULL,
  `Fragenspezifisch` int(10) NOT NULL,
  `post_order_no` int(11) NOT NULL,
  `post_id` int(11) NOT NULL,
  `Frage_71` tinyint(1) DEFAULT NULL,
  `Frage_72` tinyint(1) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4;

--
-- Daten für Tabelle `bewertung_answers`
--

INSERT INTO `bewertung_answers` (`ID`, `Answers`, `Answers_Englisch`, `Fragenspezifisch`, `post_order_no`, `post_id`, `Frage_71`, `Frage_72`) VALUES
(7, 'Sehr gut', NULL, 0, 1, 1, 1, 1),
(8, 'Gut', NULL, 0, 2, 2, 1, NULL),
(9, 'Neutral', NULL, 0, 3, 3, 1, NULL),
(10, 'Negativ', NULL, 0, 4, 4, 1, NULL),
(11, 'Sehr schlecht', NULL, 0, 5, 5, 1, NULL);

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `kursfeedback`
--

CREATE TABLE `kursfeedback` (
  `ID` int(11) NOT NULL,
  `Datum` timestamp NOT NULL DEFAULT current_timestamp(),
  `Username` varchar(200) NOT NULL,
  `Trainer` varchar(200) NOT NULL,
  `Leistung` varchar(200) NOT NULL,
  `Frage_71` text DEFAULT NULL,
  `Frage_72` text DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `fragensets`
--

CREATE TABLE `fragensets` (
  `ID` int(11) NOT NULL,
  `Datum` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `Fragenset` varchar(500) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4;

--
-- Daten für Tabelle `fragensets`
--

INSERT INTO `fragensets` (`ID`, `Datum`, `Fragenset`) VALUES
(12, '2022-01-13 16:04:54', 'Test');

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `intern`
--

CREATE TABLE `intern` (
  `ID` int(11) NOT NULL,
  `Datum` timestamp NOT NULL DEFAULT current_timestamp(),
  `Typ` varchar(200) NOT NULL,
  `Antworttyp` varchar(40) NOT NULL,
  `Fragen_intern` varchar(500) NOT NULL,
  `Frage_Englisch` varchar(500) DEFAULT NULL,
  `post_order_no` int(11) NOT NULL,
  `post_id` int(11) NOT NULL,
  `Umfrage_35` tinyint(1) DEFAULT NULL,
  `Umfrage_36` tinyint(1) DEFAULT NULL,
  `Umfrage_37` tinyint(1) DEFAULT NULL,
  `Umfrage_38` tinyint(1) DEFAULT NULL,
  `Umfrage_39` tinyint(1) DEFAULT NULL,
  `Umfrage_40` tinyint(1) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4;

--
-- Daten für Tabelle `intern`
--

INSERT INTO `intern` (`ID`, `Datum`, `Typ`, `Antworttyp`, `Fragen_intern`, `Frage_Englisch`, `post_order_no`, `post_id`, `Umfrage_35`, `Umfrage_36`, `Umfrage_37`, `Umfrage_38`, `Umfrage_39`, `Umfrage_40`) VALUES
(32, '2022-01-30 15:12:07', 'Multiplechoice', 'fragenspezifisch', 'Testfrage', NULL, 1, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(33, '2022-01-30 15:17:06', 'Schieberegler', 'vordefiniert', 'fwef', NULL, 2, 2, NULL, NULL, NULL, NULL, NULL, NULL),
(34, '2022-01-30 15:18:11', 'Schieberegler', 'vordefiniert', 'nkl', NULL, 3, 3, NULL, NULL, NULL, NULL, NULL, NULL),
(35, '2022-01-30 15:19:30', 'Text', '', 'few', NULL, 4, 4, NULL, NULL, NULL, NULL, NULL, NULL);

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
-- Tabellenstruktur für Tabelle `umfragenfeedback`
--

CREATE TABLE `umfragenfeedback` (
  `ID` int(11) NOT NULL,
  `Datum` timestamp NOT NULL DEFAULT current_timestamp(),
  `Umfrage` varchar(200) NOT NULL,
  `Frage_32` int(11) DEFAULT NULL,
  `Frage_33` int(11) DEFAULT NULL,
  `Frage_34` int(11) DEFAULT NULL,
  `Frage_35` text DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `leistungen`
--

CREATE TABLE `leistungen` (
  `ID` int(11) NOT NULL,
  `Datum` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `Leistung` varchar(500) NOT NULL,
  `Fragenset` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4;

--
-- Daten für Tabelle `leistungen`
--

INSERT INTO `leistungen` (`ID`, `Datum`, `Leistung`, `Fragenset`) VALUES
(6, '2022-01-29 14:03:30', 'Testleistung', 0);

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `multiplechoice_answers`
--

CREATE TABLE `multiplechoice_answers` (
  `ID` int(11) NOT NULL,
  `Answers` varchar(2000) NOT NULL,
  `Answers_Englisch` varchar(500) DEFAULT NULL,
  `Fragenspezifisch` int(10) NOT NULL,
  `post_order_no` int(11) NOT NULL,
  `post_id` int(11) NOT NULL,
  `Intern_32` tinyint(1) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4;

--
-- Daten für Tabelle `multiplechoice_answers`
--

INSERT INTO `multiplechoice_answers` (`ID`, `Answers`, `Answers_Englisch`, `Fragenspezifisch`, `post_order_no`, `post_id`, `Intern_32`) VALUES
(15, 'Tess', NULL, 0, 1, 1, NULL),
(16, 'Test2jflkrkn4kirkrk4nhtz hzyhuv zx  4n5jkttz', NULL, 0, 2, 2, NULL),
(23, 'Hallo1', NULL, 32, 1, 1, 1),
(24, 'Hallo2', NULL, 32, 1, 1, 1);

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `rangeslider_answers`
--

CREATE TABLE `rangeslider_answers` (
  `ID` int(11) NOT NULL,
  `range_max` int(11) NOT NULL,
  `range_min` int(11) NOT NULL,
  `columns` int(11) NOT NULL,
  `Frage_ID` int(11) NOT NULL,
  `Intern_ID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Daten für Tabelle `rangeslider_answers`
--

INSERT INTO `rangeslider_answers` (`ID`, `range_max`, `range_min`, `columns`, `Frage_ID`, `Intern_ID`) VALUES
(6, 100, 0, 5, 0, 33),
(7, 100, 0, 5, 0, 34);

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
  `bgbild_login` varchar(1000) NOT NULL,
  `Text_vor_Abgabe` varchar(1000) DEFAULT NULL,
  `Text_before_Feedback` varchar(1000) DEFAULT NULL,
  `Text_nach_Abgabe` varchar(1000) DEFAULT NULL,
  `Text_after_Feedback` varchar(1000) DEFAULT NULL,
  `SkipIntro` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Daten für Tabelle `system`
--

INSERT INTO `system` (`ID`, `lizenzmodell`, `gültigkeit`, `max_anzahl_benutzer`, `anzahl_benutzer`, `farbe`, `bgbild_abgeben`, `bgbild_login`, `Text_vor_Abgabe`, `Text_before_Feedback`, `Text_nach_Abgabe`, `Text_after_Feedback`, `SkipIntro`) VALUES
(1, 'Free Version', '2031-05-12', 5, 5, '#084f6e', '', '', 'Vielen Dank für das Feedback zur Teilnahme an folgendem Kurs.		', 'Thank you very much for your feedback and your participation on the following seminar.		', 'Vielen Dank für das Feedback zum Seminar. Wir schätzen die Meinung der Teilnehmer sehr und versuchen dadurch die Qualität unsere Kurse stetig zu verbessern.		', 'Thank you very much for your feedback. We appreciate your input which will be used to improve the quality of our seminars.	', 1);

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `umfragen`
--

CREATE TABLE `umfragen` (
  `ID` int(11) NOT NULL,
  `Datum` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `Umfrage` varchar(500) NOT NULL,
  `Benachrichtigung` varchar(30) NOT NULL,
  `Intervall` int(10) DEFAULT NULL,
  `Benutzer` varchar(500) NOT NULL,
  `Benachrichtigungsdatum` date DEFAULT NULL,
  `Fragenset` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4;

--
-- Daten für Tabelle `umfragen`
--

INSERT INTO `umfragen` (`ID`, `Datum`, `Umfrage`, `Benachrichtigung`, `Intervall`, `Benutzer`, `Benachrichtigungsdatum`, `Fragenset`) VALUES
(40, '2022-02-01 23:35:35', 'Alle', 'niemals', 1, '|Holdo||test|', '2022-02-25', 0),
(39, '2022-02-01 23:34:48', 'TEstumfarge    e  ', 'niemals', 7, '', '2022-02-25', 0),
(38, '2022-02-01 23:34:13', 'TEstumfarge    e', 'niemals', 1, '|Holdo|', '2022-03-03', 0),
(37, '2022-02-01 23:33:47', 'TEstumfarge  ', 'niemals', 1, '|test|', '2022-02-18', 0),
(36, '2022-02-01 23:33:25', 'TEstumfarge', 'niemals', 1, '|Holdo|', '2022-02-25', 0),
(35, '2022-02-01 23:29:40', 'klndql', 'niemals', 1, '|Holdo||test|', '2022-02-23', 0);

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(30) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL DEFAULT 'neuespasswort',
  `email` varchar(500) NOT NULL,
  `created_at` datetime DEFAULT current_timestamp(),
  `umfragenfeedback_abgegeben` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `Is_Admin` tinyint(1) NOT NULL,
  `Is_Trainer` tinyint(4) NOT NULL,
  `Is_Creator` tinyint(1) NOT NULL,
  `Confirmed` tinyint(1) NOT NULL,
  `passwortcode` varchar(255) DEFAULT NULL,
  `passwortcode_time` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4;

--
-- Daten für Tabelle `users`
--

INSERT INTO `users` (`id`, `name`, `username`, `password`, `email`, `created_at`, `umfragenfeedback_abgegeben`, `Is_Admin`, `Is_Trainer`, `Is_Creator`, `Confirmed`, `passwortcode`, `passwortcode_time`) VALUES
(1, 'test', 'test', '$2y$10$c7dOQDphK6CaGTbT/vccWuB09nReARZLvwPauG//ZeLagEd.FoybG', 'd.holzweber@hotmail.com', '2022-01-06 05:14:03', '2022-01-14 07:51:28', 1, 0, 1, 1, NULL, NULL),
(6, 'Dominic Holzweber', 'Holdo', '$2y$10$DycP2i9bkZfS4qedAVAvqO606Lm2puEQy7lxI8pFus57KHbdkQ3lq', 'Holdo89@gmail.com', '2022-01-13 14:16:16', '2022-01-16 15:22:28', 0, 1, 0, 1, NULL, NULL);

--
-- Indizes der exportierten Tabellen
--

--
-- Indizes für die Tabelle `admin`
--
ALTER TABLE `admin`
  ADD UNIQUE KEY `ID` (`ID`);

--
-- Indizes für die Tabelle `bewertung_answers`
--
ALTER TABLE `bewertung_answers`
  ADD PRIMARY KEY (`ID`);

--
-- Indizes für die Tabelle `kursfeedback`
--
ALTER TABLE `kursfeedback`
  ADD UNIQUE KEY `ID` (`ID`);

--
-- Indizes für die Tabelle `fragensets`
--
ALTER TABLE `fragensets`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `ID` (`ID`);

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
-- Indizes für die Tabelle `umfragenfeedback`
--
ALTER TABLE `umfragenfeedback`
  ADD UNIQUE KEY `ID` (`ID`);

--
-- Indizes für die Tabelle `leistungen`
--
ALTER TABLE `leistungen`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `ID` (`ID`);

--
-- Indizes für die Tabelle `multiplechoice_answers`
--
ALTER TABLE `multiplechoice_answers`
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
-- Indizes für die Tabelle `umfragen`
--
ALTER TABLE `umfragen`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `ID` (`ID`);

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
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=73;

--
-- AUTO_INCREMENT für Tabelle `bewertung_answers`
--
ALTER TABLE `bewertung_answers`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT für Tabelle `kursfeedback`
--
ALTER TABLE `kursfeedback`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT für Tabelle `fragensets`
--
ALTER TABLE `fragensets`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT für Tabelle `intern`
--
ALTER TABLE `intern`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT für Tabelle `interner_blog`
--
ALTER TABLE `interner_blog`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT für Tabelle `interner_blog_kommentare`
--
ALTER TABLE `interner_blog_kommentare`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT für Tabelle `umfragenfeedback`
--
ALTER TABLE `umfragenfeedback`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT für Tabelle `leistungen`
--
ALTER TABLE `leistungen`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT für Tabelle `multiplechoice_answers`
--
ALTER TABLE `multiplechoice_answers`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT für Tabelle `rangeslider_answers`
--
ALTER TABLE `rangeslider_answers`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT für Tabelle `system`
--
ALTER TABLE `system`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT für Tabelle `umfragen`
--
ALTER TABLE `umfragen`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;

--
-- AUTO_INCREMENT für Tabelle `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
