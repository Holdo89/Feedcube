<?php
// Start the session
session_start();
//unset($_COOKIE["feedback_abgegeben"]);
//setcookie('feedback_abgegeben', '', time() - 3600, '/'); // empty value and old timestamp
if(isset($_COOKIE["feedback_abgegeben"])) {
	header("location:Feedback_abgegeben.php");
  }
$_SESSION["Backbutton"] = true;
$_SESSION["Helpindex"] = false; 
$_SESSION["Trainer"] = $_REQUEST["Trainer"];
$_SESSION["Leistung"] = $_REQUEST["Leistung"];		//true für das erste mal in das feedback eingestiegen
$_SESSION["Fragenindex"] = 1;
$_SESSION["Fragen"] = array();		//speichert die Antworten
$_SESSION["Fragen_ID"] = array();	//speichert die ID der Fragen die ausgewählt wurden
include "../Portal/config.php";
?>

<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Feedback abgeben</title>
  </head>

<body style= "background-image: url('../assets/<?php echo $subdomain ?>/bg_givefb/<?php
	$dir = "../assets/".$subdomain."/bg_givefb/";
	$file = scandir($dir);
	echo $file[2];
	?>');">
<link href="css/fancy_auswahl.css" rel="stylesheet" type="text/css">
<form action="Frage.php?0" method="post">
<label align=center><?php echo"Vielen Dank für dein Feedback zur Teilnahme an folgendem Kurs</label>
<p style='margin-top:15px;'>Trainer: <b>".$_SESSION["Trainer"]."</b></p>
<p>Leistung: <b>".$_SESSION["Leistung"]?></b></p>
<input class="center_button" type="submit" value="Feedback starten">
</form>
</body>
</html>
