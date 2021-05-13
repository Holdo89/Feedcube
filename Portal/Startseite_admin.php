<?php

 require_once "session.php";

 require_once "config.php";

?>



<!DOCTYPE HTML>

<html>

<head>

    <meta charset="UTF-8">

	<meta name="viewport" content="width=device-width, initial-scale=1">

	<title>Feedback Auswertung</title>

	<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
	<link rel="icon" href="../assets/brand/FEEDCUBE_icon.png" type="image/gif">

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

<div class="topnav" id="myTopnav" style="background-color:<?php $sql="SELECT farbe FROM system"; $exec=mysqli_query($link,$sql); $result=mysqli_fetch_assoc($exec); echo $result['farbe']?>">

		<a class="image" style="padding:0px;padding-bottom:5px"href="Start.php">

			<img src="../assets/brand/FEEDCUBE_logo.png" style="float:left; margin-right:30px; margin-left:15px; margin-top:3px;" width="50" height="50">

		</a>

			<a style="  margin-bottom:20px; visibility: hidden;"></a>

			<div class="dropdown">

				<button class="dropbtn">Auswertung <i class="fa fa-caret-down"></i></button>

				<div class="dropdown-content">			

					<a href="feedback_charts.php" class="active"><i class="fa fa-bar-chart" aria-hidden="true"></i> Diagramme</a>

					<a href="multiplechoice-responsive_2\tester_admin.php"><i class="fa fa-file-text-o" aria-hidden="true"></i> Formulare</a>				

				</div>

			</div>

			<div class="dropdown">

			<button class="dropbtn">Intern

      			<i class="fa fa-caret-down"></i>

    		</button>

			<div class="dropdown-content">

				<a href="Intern.php"><i class="fa fa-bullhorn" aria-hidden="true"></i> Feedback</a>

     			<a href="interner_blog.php"><i class="fa fa-comments-o" aria-hidden="true"></i> Blog</a>

			</div>

			</div>

			<div class="dropdown">

			<button class="dropbtn">Optionen 

      			<i class="fa fa-caret-down"></i>

    		</button>

			<div class="dropdown-content">

     				<a href="Fragen.php"><i class="fa fa-question-circle-o" aria-hidden="true"></i> Feedbackfragen</a>

      				<a href="Usermanagement.php"><i class="fa fa-users" aria-hidden="true"></i> Benutzer</a>

					<a href="Leistungmanagement.php"><i class="fa fa-graduation-cap" aria-hidden="true"></i> Leistungen</a>
				</div>

			</div>

			<a href="javascript:void(0);" class="icon" onclick="myFunction()">
			<i class="fa fa-bars"></i>
			</a>
			<div class="dropdown" style="float:right; margin-right:50px;">
			<button class="dropbtn"><i class="fa fa-user"></i> 
    		</button>
			<div class="dropdown-content" style="right:0; margin-right:20px;">
				<a href="reset-password.php"><i class="fa fa-lock" aria-hidden="true"></i> Passwort reset</a>
				<a href="logout.php"><i class="fa fa-sign-out" aria-hidden="true"></i> Abmelden</a>
			</div>
			</div>
			<a style="float:right; margin-right:10px;"href="System.php"><i class="fa fa-cog" aria-hidden="true"></i></a>
		</div> 



<div style="width:90vw; margin:auto; @media only screen and (max-width: 600px){width:100vw; margin:0;}">	





<div>

<h2>Hi <b><?php echo htmlspecialchars($_SESSION["username"]); ?></b>, Willkommen auf der Startseite von</h2>

<img class="mb-4" src="../assets/brand/FEEDCUBE_logo_login.svg" alt="" width="300" height="120">

<div style="text-align:left;margin-top:20px;margin-bottom:20px">

<p>Hier kannst du dein Kunden und Mitarbeiter Feedback auswerten, eigenes Feedback zu deiner beruflichen Situation abgeben und anonyme Blogbeiträge erstellen. 

Dabei werden sowohl multiplechoice Fragen gestellt, als auch Fragen die eine Texteingabe erfordern.</p>

<p><b>Auswertung des Kunden-Feedbacks</b></p>

<p> <i class="fa fa-bar-chart" aria-hidden="true"> </i> Diagramme: Hier kannst du die Auswertung der

	multiplechoice Antworten als Diagramme sichtbar machen, und die Kommentare seperat gelistet betrachten. Wähle dafür zwischen Metriken und Kommentaren. Wähle eine Frage zu einer Leistung die du auswerten 

	möchtest und bestimme einen Zeitraum den du auswerten möchtest. Es wird nur Feedback ausgewertet, welches in dem gewählten Zeitraum abgegeben wurde.

</p>



<p><i class="fa fa-file-text-o" aria-hidden="true"></i> Formulare: Hier findest du die Auswertung deines Kunden-Feedbacks in Form von ausgefüllten Fragebögen, in chronologischer Reihenfolge.</p> 

</div>

<a class="w3-btn" style="background-color:rgba(3, 122, 143, 0.904); color:white; border-radius:5px;width:150px;margin-bottom:10px" href="feedback_charts.php"><i class="fa fa-bar-chart" aria-hidden="true"></i> Diagramme</a>

<a class="w3-btn" style="background-color:rgba(3, 122, 143, 0.904); color:white; border-radius:5px;width:150px;margin-bottom:10px" href="multiplechoice-responsive_2\tester_admin.php"><i class="fa fa-file-text-o" aria-hidden="true"></i> Formulare</a>



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





