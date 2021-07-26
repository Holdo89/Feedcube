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
<link href="css/fancy_auswahl.css" rel="stylesheet" type="text/css">
<form action="Frage.php" method="post">
<img class="center" src="../assets/<?php echo $subdomain ?>/logo/<?php
	$dir = "../assets/".$subdomain."/logo/";
	$file = scandir($dir);
	echo $file[2];
	?>" alt="" width="220" height="70">
<label align=center style="line-height:23px;">
<?php 

if($_SESSION["Sprache"]=="Deutsch")
{
	$sql = "SELECT Text_vor_Abgabe FROM system";
	$query = mysqli_query($link, $sql);
	$result = mysqli_fetch_array($query);
	echo $result["Text_vor_Abgabe"]."</label>
	<p style='margin-top:15px;'>Trainer: <b>".$_SESSION["Trainer"]."</b></p>
	<p>Seminar: <b>".$leistung_titel["Leistung"]."</b></p>
	<input class='center_button' type='submit' value='Feedback starten'>";
}
else if($_SESSION["Sprache"]=="Englisch")
{
	$sql = "SELECT Text_before_Feedback FROM system";
	$query = mysqli_query($link, $sql);
	$result = mysqli_fetch_array($query);
	echo $result["Text_before_Feedback"]."</label>
	<p style='margin-top:15px;'>Trainer: <b>".$_SESSION["Trainer"]."</b></p>
	<p>Seminar: <b>".$leistung_titel["Leistung"]."</b></p>
	<input class='center_button' type='submit' value='start feedback'>";
}
?>
</form>
</body>
</html>
