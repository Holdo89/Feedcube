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
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT für Tabelle `bewertung_answers`
--
ALTER TABLE `bewertung_answers`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT für Tabelle `kursfeedback`
--
ALTER TABLE `kursfeedback`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT für Tabelle `fragensets`
--
ALTER TABLE `fragensets`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT für Tabelle `intern`
--
ALTER TABLE `intern`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;

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
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT für Tabelle `leistungen`
--
ALTER TABLE `leistungen`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT für Tabelle `multiplechoice_answers`
--
ALTER TABLE `multiplechoice_answers`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT für Tabelle `rangeslider_answers`
--
ALTER TABLE `rangeslider_answers`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT für Tabelle `system`
--
ALTER TABLE `system`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT für Tabelle `umfragen`
--
ALTER TABLE `umfragen`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT für Tabelle `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
