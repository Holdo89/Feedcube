-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Erstellungszeit: 02. Feb 2022 um 00:38
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

--
-- Daten für Tabelle `admin`
--

INSERT INTO `admin` (`ID`, `Datum`, `Typ`, `Antworttyp`, `Fragenbeschreibung`, `Kapitel`, `Frage_Englisch`, `Kapitel_Englisch`, `post_order_no`, `post_id`, `Fragenset_12`, `Leistung_6`) VALUES
(71, '2022-01-30 08:27:11', 'Bewertung', 'vordefiniert', 'TEst', '', '', '', 1, 1, NULL, 1),
(72, '2022-01-30 08:36:04', 'Bewertung', 'vordefiniert', 'ofibuewmq qphefoiug weö0fhiwe9uiFWE  ?', 'Test2', 'feiwfew', 'TEs 3', 2, 2, NULL, 1);

--
-- Daten für Tabelle `bewertung_answers`
--

INSERT INTO `bewertung_answers` (`ID`, `Answers`, `Answers_Englisch`, `Fragenspezifisch`, `post_order_no`, `post_id`, `Frage_71`, `Frage_72`) VALUES
(7, 'Sehr gut', NULL, 0, 1, 1, 1, 1),
(8, 'Gut', NULL, 0, 2, 2, 1, NULL),
(9, 'Neutral', NULL, 0, 3, 3, 1, NULL),
(10, 'Negativ', NULL, 0, 4, 4, 1, NULL),
(11, 'Sehr schlecht', NULL, 0, 5, 5, 1, NULL);

--
-- Daten für Tabelle `fragensets`
--

INSERT INTO `fragensets` (`ID`, `Datum`, `Fragenset`) VALUES
(12, '2022-01-13 16:04:54', 'Test');

--
-- Daten für Tabelle `intern`
--

INSERT INTO `intern` (`ID`, `Datum`, `Typ`, `Antworttyp`, `Fragen_intern`, `Frage_Englisch`, `post_order_no`, `post_id`, `Umfrage_35`, `Umfrage_36`, `Umfrage_37`, `Umfrage_38`, `Umfrage_39`, `Umfrage_40`) VALUES
(32, '2022-01-30 15:12:07', 'Multiplechoice', 'fragenspezifisch', 'Testfrage', NULL, 1, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(33, '2022-01-30 15:17:06', 'Schieberegler', 'vordefiniert', 'fwef', NULL, 2, 2, NULL, NULL, NULL, NULL, NULL, NULL),
(34, '2022-01-30 15:18:11', 'Schieberegler', 'vordefiniert', 'nkl', NULL, 3, 3, NULL, NULL, NULL, NULL, NULL, NULL),
(35, '2022-01-30 15:19:30', 'Text', '', 'few', NULL, 4, 4, NULL, NULL, NULL, NULL, NULL, NULL);

--
-- Daten für Tabelle `leistungen`
--

INSERT INTO `leistungen` (`ID`, `Datum`, `Leistung`, `Fragenset`) VALUES
(6, '2022-01-29 14:03:30', 'Testleistung', 0);

--
-- Daten für Tabelle `multiplechoice_answers`
--

INSERT INTO `multiplechoice_answers` (`ID`, `Answers`, `Answers_Englisch`, `Fragenspezifisch`, `post_order_no`, `post_id`, `Intern_32`) VALUES
(15, 'Tess', NULL, 0, 1, 1, NULL),
(16, 'Test2jflkrkn4kirkrk4nhtz hzyhuv zx  4n5jkttz', NULL, 0, 2, 2, NULL),
(23, 'Hallo1', NULL, 32, 1, 1, 1),
(24, 'Hallo2', NULL, 32, 1, 1, 1);

--
-- Daten für Tabelle `rangeslider_answers`
--

INSERT INTO `rangeslider_answers` (`ID`, `range_max`, `range_min`, `columns`, `Frage_ID`, `Intern_ID`) VALUES
(6, 100, 0, 5, 0, 33),
(7, 100, 0, 5, 0, 34);

--
-- Daten für Tabelle `system`
--

INSERT INTO `system` (`ID`, `lizenzmodell`, `gültigkeit`, `max_anzahl_benutzer`, `anzahl_benutzer`, `farbe`, `bgbild_abgeben`, `bgbild_login`, `Text_vor_Abgabe`, `Text_before_Feedback`, `Text_nach_Abgabe`, `Text_after_Feedback`, `SkipIntro`) VALUES
(1, 'Free Version', '2031-05-12', 5, 5, '#084f6e', '', '', 'Vielen Dank für das Feedback zur Teilnahme an folgendem Kurs.		', 'Thank you very much for your feedback and your participation on the following seminar.		', 'Vielen Dank für das Feedback zum Seminar. Wir schätzen die Meinung der Teilnehmer sehr und versuchen dadurch die Qualität unsere Kurse stetig zu verbessern.		', 'Thank you very much for your feedback. We appreciate your input which will be used to improve the quality of our seminars.	', 1);

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

--
-- Daten für Tabelle `users`
--

INSERT INTO `users` (`id`, `name`, `username`, `password`, `email`, `created_at`, `umfragenfeedback_abgegeben`, `Is_Admin`, `Is_Trainer`, `Is_Creator`, `Confirmed`, `passwortcode`, `passwortcode_time`) VALUES
(1, 'test', 'test', '$2y$10$c7dOQDphK6CaGTbT/vccWuB09nReARZLvwPauG//ZeLagEd.FoybG', 'd.holzweber@hotmail.com', '2022-01-06 05:14:03', '2022-01-14 07:51:28', 1, 0, 1, 1, NULL, NULL),
(6, 'Dominic Holzweber', 'Holdo', '$2y$10$DycP2i9bkZfS4qedAVAvqO606Lm2puEQy7lxI8pFus57KHbdkQ3lq', 'Holdo89@gmail.com', '2022-01-13 14:16:16', '2022-01-16 15:22:28', 0, 1, 0, 1, NULL, NULL);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
