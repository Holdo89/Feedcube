-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Erstellungszeit: 16. Nov 2020 um 23:49
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
-- Datenbank: `feedtracker_treevelop`
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
(160, '2020-10-03 23:20:55', 'multiple_choice', 'fachliche Kompetenz des Beraters', 'der Berater'),
(161, '2020-10-03 23:22:10', 'text', 'ein Kommentar zu Ihrem Berater', 'der Berater'),
(162, '2020-10-03 23:25:36', 'multiple_choice', 'die Qualität der erbrachten Leistungen', 'die Umsetzung'),
(163, '2020-10-03 23:27:12', 'multiple_choice', 'die Kosten der erbrachten Leistungen', 'die Umsetzung'),
(164, '2020-10-03 23:28:40', 'text', 'Wie haben Sie die Zusammenarbeit mit Treevelop empfunden?', 'allgemeines Kommentar'),
(165, '2020-10-03 23:29:03', 'text', 'Was können wir noch verbessern?', 'Verbesserungsvorschläge');

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
  `Frage_160` int(11) DEFAULT NULL,
  `Frage_161` varchar(1000) DEFAULT NULL,
  `Frage_162` int(11) DEFAULT NULL,
  `Frage_163` int(11) DEFAULT NULL,
  `Frage_164` varchar(1000) DEFAULT NULL,
  `Frage_165` varchar(1000) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4;

--
-- Daten für Tabelle `externes_feedback`
--

INSERT INTO `externes_feedback` (`ID`, `Datum`, `Username`, `Trainer`, `Leistung`, `Frage_160`, `Frage_161`, `Frage_162`, `Frage_163`, `Frage_164`, `Frage_165`) VALUES
(61, '2020-10-01 23:49:44', 'Holdo', 'Dominic Holzweber', 'Automatisierung', 1, 'sympathisch und kompetent', 1, 2, 'es war eine tolle Zusammenarbeit und hoffe dass wir auch in Zukunft noch zusammen arbeiten werden ', 'ich war sehr zufrieden'),
(62, '2020-09-03 23:53:53', 'Verena', 'Verena Koch', 'Team-Events', 2, 'Sehr nette Dame, war sehr angenehm mit Ihr zu sprechen', 2, 3, 'Gut aber mit Verbesserungspotential', 'Unsere Beraterin war schwer zu erreichen'),
(80, '2020-10-06 11:17:02', 'Holdo', 'Dominic Holzweber', 'Automatisierung', 1, 'Sehr kompetent und freundlich', 2, 2, 'War eine tolle Zusammarbeit, ich werde Treevelop jederzeit weiterempfehlen', 'Kaum etwas'),
(65, '2020-10-04 00:36:36', 'Verena', 'Verena Koch', 'Team-Events', 1, 'Sehr kompetente Dame, hat uns toll beraten', 1, 2, 'Die Zusammenarbeit war sehr erfreulich', 'Hat soweit alles sehr gut gepasst');

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `intern`
--

CREATE TABLE `intern` (
  `ID` int(11) NOT NULL,
  `Datum` timestamp NOT NULL DEFAULT current_timestamp(),
  `Typ` varchar(200) NOT NULL,
  `Fragenbeschreibung` varchar(500) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4;

--
-- Daten für Tabelle `intern`
--

INSERT INTO `intern` (`ID`, `Datum`, `Typ`, `Fragenbeschreibung`) VALUES
(23, '2020-10-04 00:06:55', 'rangeslider', 'Derzeitige Stimmung im Unternehmen?'),
(24, '2020-10-04 00:07:14', 'text', 'Was würdest du gerne ändern?'),
(25, '2020-10-04 00:07:53', 'rangeslider', 'Wie motiviert fühlst du dich?'),
(26, '2020-10-04 00:08:20', 'text', 'Was würdest du dir von der Geschäftsführung wünschen?');

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
  `Frage_23` int(11) DEFAULT NULL,
  `Frage_24` varchar(1000) DEFAULT NULL,
  `Frage_25` int(11) DEFAULT NULL,
  `Frage_26` varchar(1000) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4;

--
-- Daten für Tabelle `umfragenfeedback`
--

INSERT INTO `umfragenfeedback` (`ID`, `Datum`, `Frage_23`, `Frage_24`, `Frage_25`, `Frage_26`) VALUES
(35, '2020-10-04 00:10:56', 80, 'Weniger Stress in der Arbeit', 65, 'Mehr Kontakt zu den Mitarbeitern');

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
(9, '2020-10-03 23:19:19', 'Automatisierung'),
(10, '2020-10-03 23:32:27', 'Feedtracker Software'),
(11, '2020-11-16 22:31:50', 'Online-Präsenz'),
(12, '2020-10-03 23:32:55', 'Team-Events');

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
(18, 'sehr gut'),
(19, 'gut'),
(20, 'eher positiv'),
(21, 'eher negativ'),
(22, 'schlecht'),
(23, 'unbrauchbar');

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
(68, 'Admin', 'Admin', '$2y$10$QCYntC.QWxn8h1H.o/8q.Oo/97GaZEZ3DfkVNY7/fdk6MJlOJHFM.', 'info@treevelop.com', '2020-09-18 20:13:48', '2020-10-06 10:14:59', 1),
(71, 'Alle Berater', 'externes_feedback', '$2y$10$PlR96zGJ.YgsNpYO0dAKVehz48R0DgcpA7hxMFxECRHp3MDc8w4UG', 'trainer@email.com', '2020-09-18 20:22:23', '2020-10-04 00:03:49', 0),
(72, 'Dominic Holzweber', 'Holdo', '$2y$10$8/rzZl5eO1oem.2xheBM5.qE1jpDnwHQrYAAJBKjR9/IkDWv4E1o6', 'dominic.holzweber@treevelop.com', '2020-10-04 01:30:05', '2020-10-11 23:23:02', 0),
(73, 'Verena Koch', 'Verena', '$2y$10$InrTb1c5umUwg6Y/kfbi0OFj/Q9HF8l17JZAaHDEZnUrCJpcJ2gSy', 'verena.koch@treevelop.com', '2020-10-04 01:31:03', '2020-10-06 10:14:44', 0);

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
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=166;

--
-- AUTO_INCREMENT für Tabelle `externes_feedback`
--
ALTER TABLE `externes_feedback`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=81;

--
-- AUTO_INCREMENT für Tabelle `intern`
--
ALTER TABLE `intern`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT für Tabelle `interner_blog`
--
ALTER TABLE `interner_blog`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT für Tabelle `interner_blog_kommentare`
--
ALTER TABLE `interner_blog_kommentare`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT für Tabelle `umfragenfeedback`
--
ALTER TABLE `umfragenfeedback`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT für Tabelle `leistungen`
--
ALTER TABLE `leistungen`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT für Tabelle `bewertung_answers`
--
ALTER TABLE `bewertung_answers`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT für Tabelle `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=74;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
