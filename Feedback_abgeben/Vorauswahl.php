<?php
// Start the session
session_start();
//unset($_COOKIE["feedback_abgegeben"]);
//setcookie('feedback_abgegeben', '', time() - 3600, '/'); // empty value and old timestamp
if(isset($_COOKIE["feedback_abgegeben"])) {
	header("location:Feedback_abgegeben.php");
  }

$_SESSION["Trainer"] = $_REQUEST["Trainer"];
$_SESSION["Leistung"] = $_REQUEST["Leistung"];		//true für das erste mal in das feedback eingestiegen
$_SESSION["Sprache"] = $_REQUEST["Sprache"];

include "../config.php";
$sql_test = "SELECT Leistung from leistungen WHERE ID = ".$_SESSION['Leistung'];
$exec_test = mysqli_query($link,$sql_test);
$leistung_titel = mysqli_fetch_array($exec_test); 
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
<link href="css/fancy_auswahl.css?v=1" rel="stylesheet" type="text/css">
<form action="Frage.php" method="post">
<img class="center" src="../assets/<?php echo $subdomain ?>/logo/<?php
	$dir = "../assets/".$subdomain."/logo/";
	$file = scandir($dir);
	echo $file[2];
	?>" alt="" width="220" height="100" style='object-fit:scale-down'>
<label style="line-height:23px">
<?php 

if($_SESSION["Sprache"]=="Deutsch")
{
	echo "<label>Vielen Dank für die Teilnahme am Kurs <b>".$leistung_titel["Leistung"]." </b>. 
	Wir freuen uns über jedes Feedback, um unsere Seminare weiter zu verbessern. 
	<div style='text-align:center; margin:auto'>";
	include "showAvatarChosenTrainer.php";
	echo"<br>
	Ich wünsche dir weiterhin viel Erfolg!<br>
	Dein Trainer: <b>".$_SESSION["Trainer"]."</b>
	<input class='center_button' type='submit' value='Feedback starten'>";
}
else if($_SESSION["Sprache"]=="Englisch")
{
	echo "<label>Thank you for your participation on the course <b>".$leistung_titel["Leistung"]." </b>. 
	We use Feedback, to further improve the quality of our seminars. 
	<div style='text-align:center; margin:auto'>";
	include "showAvatarChosenTrainer.php";
	echo"<br>
	I wish you all the best!<br>
	Your Trainer: <b>".$_SESSION["Trainer"]."</b>
	<input class='center_button' type='submit' value='Start Feedback'>";
}
?>
</form>
</body>
</html>
