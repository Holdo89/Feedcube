<?php

 require_once "../config.php";
 require_once "session.php";
?>



<!DOCTYPE HTML>

<html>
<?php
 require_once "FEEDCUBE_icon.php"
?>
<head>
	<div w3-include-html="FEEDCUBE_icon.html"></div>
    <meta charset="UTF-8">

	<meta name="viewport" content="width=device-width, initial-scale=1">

	<title>Feedback Auswertung</title>

	<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
	<link href="bootstrap.css" rel="stylesheet" type="text/css">
	<link href="charts.css" rel="stylesheet" type="text/css">
	<link href="slider-range.css" rel="stylesheet" type="text/css">
	<script type="text/javascript" src="hidefunction.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.3/Chart.min.js"></script>


</head>

<body class="text-center">

 <!-- Load an icon library to show a hamburger menu (bars) on small screens -->

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

<link href="navigation.css" rel="stylesheet" type="text/css">

<script type="text/javascript" src="navigation.js"></script>	





<div class="header">

<?php
	include "navigation_admin.php";		//Pie and COlumnchart
?>

<div style="width:90vw; margin:auto; @media only screen and (max-width: 600px){width:100vw; margin:0;}">	

<div>

<h2>Hi <b><?php echo htmlspecialchars($_SESSION["username"]); ?></b>, Willkommen auf der Startseite von</h2>

<img class="mb-4" src="../assets/brand/FEEDCUBE_logo_login.svg" alt="" width="300" height="120">

<div style="text-align:left;margin-top:20px;margin-bottom:20px">

<p>Hier kannst du dein Kunden und Mitarbeiter Feedback auswerten, eigenes Feedback zu deiner beruflichen Situation abgeben und anonyme Blogbeiträge erstellen. 

Dabei werden sowohl multiplechoice Fragen gestellt, als auch Fragen die eine Texteingabe erfordern.</p>

<p><b>Auswertung des Kunden-Feedbacks</b></p>

<p> <i class="fa fa-line-chart" aria-hidden="true"> </i> Auswertung: Hier kannst du die Auswertung der

	multiplechoice Antworten als Diagramme sichtbar machen, und die Kommentare seperat gelistet betrachten. Wähle dafür zwischen Metriken und Kommentaren. Wähle eine Frage zu einer Leistung die du auswerten 

	möchtest und bestimme einen Zeitraum den du auswerten möchtest. Es wird nur Feedback ausgewertet, welches in dem gewählten Zeitraum abgegeben wurde.

</p>



<p><i class="fa fa-file-text-o" aria-hidden="true"></i> Formulare: Hier findest du die Auswertung deines Kunden-Feedbacks in Form von ausgefüllten Fragebögen, in chronologischer Reihenfolge.</p> 

</div>

<a class="w3-btn" style="background-color:rgba(3, 122, 143, 0.904); color:white; border-radius:5px;width:150px;margin-bottom:10px" href="feedback_charts.php"><i class="fa fa-line-chart" aria-hidden="true"></i> Auswertung</a>

<a class="w3-btn" style="background-color:rgba(3, 122, 143, 0.904); color:white; border-radius:5px;width:150px;margin-bottom:10px" href="forms_admin.php"><i class="fa fa-file-text-o" aria-hidden="true"></i> Formulare</a>



<div style="text-align:left;margin-top:20px;margin-bottom:20px">

<p style="margin-top:30px;"><b>Mitarbeiter-Feedback und interne Beiträge</b></p>



<p> <i class="fa fa-bullhorn" aria-hidden="true"></i> Feedback: Alle 7 Tage kannst du hier anonymes Mitarbeiter-Feedback abgeben, indem du interne Fragen beantwortest. Sobald du Feedback abgegeben

 hast kannst du die Auswertung einsehen, indem du zwischen Metriken und Kommentare wählst.</p>

<p><i class="fa fa-comments-o" aria-hidden="true"></i> Blog: Erstelle anonyme Blogbeiträge und kommentiere andere Einträge. Hier findet ein offener Austausch zwischen dir und deinen Kollegen statt.</p> 



</div>

<a class="w3-btn" style="background-color:rgba(204, 101, 5, 0.918); color:white; border-radius:5px;margin-bottom:10px;width:150px" href="Intern.php"><i class="fa fa-bullhorn" aria-hidden="true"></i> Feedback</a>

<a class="w3-btn" style="background-color:rgba(204, 101, 5, 0.918); color:white; border-radius:5px;margin-bottom:10px;width:150px" href="interner_blog.php"><i class="fa fa-comments-o" aria-hidden="true"></i> Blog</a>



<div style="text-align:left;margin-top:20px;margin-bottom:20px">

<p style="margin-top:30px;"><b>Administrator Optionen</b></p>



<p>Administratoren können bei der Auswertung des Kunden Feedbacks einzelne Berater auswählen oder das gesammelte Feedback aller Berater auswerten. Als Administrator bist du dazu in der Lage, Fragen die an Kunden gestellt werden, 

	aber auch Fragen des Mitarbeiter Feedbacks, zu bearbeiten, zu löschen und neu Fragen hinzuzufügen. Ebenso kannst du multiplechoice Antwortmöglichkeiten editieren,

	Daten von gespeicherten Benutzern bearbeiten und löschen und neue Passwörter und Administrator Rechte an ausgewählte Benutzer vergeben. Als Admin ist es dir vorbehalten, neue Leistungen hinzuzufügen, bestehende zu bearbeiten oder zu löschen. 

	Wähle dafür den Reiter Optionen und eine der folgenden Bereiche:



</p>



</div>

<div style="margin-bottom:10vh">

<a class="w3-btn" style="background-color:rgba(66, 4, 78, 0.904); color:white; border-radius:5px;margin-bottom:10px;width:180px" href="Fragen.php"><i class="fa fa-question-circle-o" aria-hidden="true"></i> Feedbackfragen</a>

<a class="w3-btn" style="background-color:rgba(66, 4, 78, 0.904); color:white; border-radius:5px;margin-bottom:10px;width:150px" href="Usermanagement.php"><i class="fa fa-user" aria-hidden="true"></i> Benutzer</a>

<a class="w3-btn" style="background-color:rgba(66, 4, 78, 0.904); color:white; border-radius:5px;margin-bottom:10px;width:150px" href="Leistungmanagement.php"><i class="fa fa-graduation-cap" aria-hidden="true"></i> Leistungen</a>

</div>

</div>

</div>

</body>

</html>





