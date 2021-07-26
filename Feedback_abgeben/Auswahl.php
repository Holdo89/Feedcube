<?php
// Start the session
session_start();
//unset($_COOKIE["feedback_abgegeben"]);
//setcookie('feedback_abgegeben', '', time() - 3600, '/'); // empty value and old timestamp
if(isset($_COOKIE["feedback_abgegeben"])) {
	header("location:Feedback_abgegeben.php");
  }
$_SESSION["Backbutton"] = false;
$_SESSION["Helpindex"] = true; 		//true für das erste mal in das feedback eingestiegen
$_SESSION["Fragenindex"] = 1;
$_SESSION["Fragen"] = array();		//speichert die Antworten
$_SESSION["Fragen_ID"] = array();	//speichert die ID der Fragen die ausgewählt wurden
include "../config.php";
?>

<!doctype html>
<html lang="en">
<?php
 require_once "FEEDCUBE_icon.php"
?>
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

<input type="text" id="Link" name="Link" style="margin-top:5px; display:none; width:95%; background-color:rgba(0,0,0,0.03);" readonly="true"></input>

<form id="FeedbackForm" action="" method="post">
<img class="center" src="../assets/<?php echo $subdomain ?>/logo/<?php
	$dir = "../assets/".$subdomain."/logo/";
	$file = scandir($dir);
	echo $file[2];
	?>" alt="" width="220" height="70">

<div class="container">

<select class="center" name="Auswahl_Trainer" id="Auswahl_Trainer" required>
<?php

    $sql = "SELECT name, username, Is_Trainer FROM users WHERE Is_Trainer = 1 AND name!='Alle Berater'";
    $result = mysqli_query($link, $sql) ;
	echo '<option value="" selected disabled hidden>Wähle den Kursleiter</option>';
    while($row = mysqli_fetch_assoc($result)) {
		echo "<option>".$row['name']."</option>";
}
?>
</select>
<select class="center" name="Auswahl_Leistung" id="Auswahl_Leistung" required>
	<option value="" selected disabled hidden>Wähle die Leistung</option>
  <?php
  include "Auswahl_Leistung_Teilnehmer.php"
  ?>
</select>
<select class="center" name="Auswahl_Sprache"  id="Auswahl_Sprache" required>
<option value="" selected disabled hidden>Wähle die Sprache</option>
	<option value="Deutsch">Deutsch</option>
	<option value="Englisch">Englisch</option>
</select>
</div>
<input class="center_button" type="submit" value="WEITER">
</form>

<script>
	var FeedbackForm = document.getElementById("FeedbackForm");
	var Auswahl_Trainer = document.getElementById("Auswahl_Trainer");
	var Auswahl_Leistung = document.getElementById("Auswahl_Leistung");
	var Auswahl_Sprache = document.getElementById("Auswahl_Sprache");
	var Sprache = "Deutsch";
	var Link = document.getElementById("Link");
	var current_url = window.location.href;
	var index = current_url.indexOf("Auswahl");
	current_url = current_url.substr(0,index);
	function createLink(){
		var prefix = "Feedback-Link:<div style='font-size:13px;'> ";
		Sprache = Auswahl_Sprache.value
		var Feedbacklink = current_url+"Vorauswahl.php?Trainer="+Auswahl_Trainer.value+"&Sprache="+Sprache+"&Leistung="+Auswahl_Leistung.value;
		Feedbacklink = Feedbacklink.replaceAll(" ","%20");
		Link.value = Feedbacklink;
		FeedbackForm.action = Feedbacklink;
	}
	Auswahl_Trainer.onchange = function(){
		createLink();
	};
	Auswahl_Leistung.onchange = function(){
		createLink();
	};
	Auswahl_Sprache.onchange = function(){
		createLink()
	};
</script>
</body>
</html>