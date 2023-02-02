-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Erstellungszeit: 24. Jan 2021 um 23:46
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
-- Datenbank: `feedpeak_empty`
--

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `admin`
--

CREATE TABLE `admin` (
  `ID` int(11) NOT NULL,
  `Datum` timestamp NOT NULL DEFAULT current_timestamp(),
  `Typ` varchar(200) NOT NULL,
  `Fragenbeschreibung` varchar(500) NOT NULL,
  `Kapitel` varchar(500) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4;

--
-- Daten für Tabelle `admin`
--

INSERT INTO `admin` (`ID`, `Datum`, `Typ`, `Fragenbeschreibung`, `Kapitel`) VALUES
(258, '2021-01-07 14:08:56', 'multiple_choice', 'Testmulti', 'Test'),
(259, '2021-01-07 14:09:07', 'rangeslider', 'Testrange', 'Test'),
(260, '2021-01-07 14:09:15', 'text', 'Testtext', 'Test');

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
  `Frage_258` int(11) DEFAULT NULL,
  `Frage_259` int(11) DEFAULT NULL,
  `Frage_260` varchar(1000) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4;

--
-- Daten für Tabelle `externes_feedback`
--

INSERT INTO `externes_feedback` (`ID`, `Datum`, `Username`, `Trainer`, `Leistung`, `Frage_258`, `Frage_259`, `Frage_260`) VALUES
(160, '2020-01-09 23:36:25', 'Holdo', 'Dominic Holzweber', 'Test', 2, 50, 'dwqdf'),
(159, '2020-10-08 22:51:37', 'Holdo', 'Dominic Holzweber', 'Test', 2, 50, 'Test');

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
(58, '2021-01-17 21:49:38', 'text', 'Text');

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
  `Frage_56` int(11) DEFAULT NULL,
  `Frage_57` int(11) DEFAULT NULL,
  `Frage_58` varchar(1000) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4;

--
-- Daten für Tabelle `umfragenfeedback`
--

INSERT INTO `umfragenfeedback` (`ID`, `Datum`, `Frage_56`, `Frage_57`, `Frage_58`) VALUES
(54, '2021-01-05 13:49:32', 1, NULL, NULL),
(56, '2021-01-06 00:18:37', 6, NULL, NULL);

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
(37, '2021-01-07 14:09:41', 'Test');

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `bewertung_answers`
--

CREATE TABLE `bewertung_answers` (
  `ID` int(11) NOT NULL,
  `Answers` varchar(2000) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4;

--
-- Daten für Tabelle `bewertung_answers`
--

INSERT INTO `bewertung_answers` (`ID`, `Answers`) VALUES
(18, 'unbrauchbar'),
(19, 'schlecht'),
(20, 'eher negativ'),
(21, 'eher positiv'),
(22, 'gut'),
(24, 'sehr gut');

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
-- Tabellenstruktur für Tabelle `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(30) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(500) NOT NULL,
  `created_at` datetime DEFAULT current_timestamp(),
  `umfragenfeedback_abgegeben` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `Is_Admin` tinyint(1) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4;

--
-- Daten für Tabelle `users`
--

INSERT INTO `users` (`id`, `name`, `username`, `password`, `email`, `created_at`, `umfragenfeedback_abgegeben`, `Is_Admin`) VALUES
(68, 'Admin', 'Admin', '$2y$10$QCYntC.QWxn8h1H.o/8q.Oo/97GaZEZ3DfkVNY7/fdk6MJlOJHFM.', 'info@treevelop.com', '2020-09-18 20:13:48', '2021-01-06 00:14:14', 1),
(71, 'Alle Berater', 'externes_feedback', '$2y$10$PlR96zGJ.YgsNpYO0dAKVehz48R0DgcpA7hxMFxECRHp3MDc8w4UG', 'trainer@email.com', '2020-09-18 20:22:23', '2020-10-04 00:03:49', 0),
(87, 'Dominic Holzweber', 'Holdo', '$2y$10$WvKUeDN7REl.hq2kUoLqVOc5B/LDRLeJuH4SMZhsqcnb0xvqh0XWK', 'treevelop@hotmail.com', '2021-01-02 20:54:00', '2021-01-06 00:18:37', 0);

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
-- Indizes für die Tabelle `bewertung_answers`
--
ALTER TABLE `bewertung_answers`
  ADD PRIMARY KEY (`ID`);

--
-- Indizes für die Tabelle `rangeslider_answers`
--
ALTER TABLE `rangeslider_answers`
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
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=261;

--
-- AUTO_INCREMENT für Tabelle `externes_feedback`
--
ALTER TABLE `externes_feedback`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=161;

--
-- AUTO_INCREMENT für Tabelle `intern`
--
ALTER TABLE `intern`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=59;

--
-- AUTO_INCREMENT für Tabelle `interner_blog`
--
ALTER TABLE `interner_blog`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT für Tabelle `interner_blog_kommentare`
--
ALTER TABLE `interner_blog_kommentare`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT für Tabelle `umfragenfeedback`
--
ALTER TABLE `umfragenfeedback`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=57;

--
-- AUTO_INCREMENT für Tabelle `leistungen`
--
ALTER TABLE `leistungen`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

--
-- AUTO_INCREMENT für Tabelle `bewertung_answers`
--
ALTER TABLE `bewertung_answers`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT für Tabelle `rangeslider_answers`
--
ALTER TABLE `rangeslider_answers`
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
