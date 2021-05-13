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

<img class="center" src="../assets/<?php echo $subdomain ?>/logo/<?php
	$dir = "../assets/".$subdomain."/logo/";
	$file = scandir($dir);
	echo $file[2];
	?>" alt="" width="220" height="70">

<div class="container">

<select class="center" name="Auswahl_Trainer" required>
<?php

    $sql = "SELECT name, username, Is_Trainer FROM users WHERE Is_Trainer = 1 AND name!='Alle Berater'";
    $result = mysqli_query($link, $sql) ;
	echo '<option value="" selected disabled hidden>Wähle deinen Berater</option>';
    while($row = mysqli_fetch_assoc($result)) {
		echo "<option>".$row['name']."</option>";
}
?>
</select>
<select class="center" name="Auswahl_Leistung" required>
	<option value="" selected disabled hidden>Welche Leistung möchten Sie bewerten?</option>
  <?php
  include "Auswahl_Leistung_Teilnehmer.php"
  ?>
</select>
</div>
<input class="center_button" type="submit" value="WEITER">


</form>
</body>
</html>