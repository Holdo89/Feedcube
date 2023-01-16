<?php
// Start the session
session_start();
//unset($_COOKIE["feedback_abgegeben"]);
//setcookie('feedback_abgegeben', '', time() - 3600, '/'); // empty value and old timestamp

$_SESSION["Umfrage"] = $_REQUEST["Umfrage"];		//true für das erste mal in das feedback eingestiegen

if(isset($_COOKIE["Umfrage".$_SESSION["Umfrage"]."_teilgenommen"])) {
	header("location:Feedback_abgegeben.php");
  }

include "../config.php";
$sql_test = "SELECT Umfrage from umfragen WHERE ID = ".$_SESSION['Umfrage'];
$exec_test = mysqli_query($link,$sql_test);
$Umfrage_titel = mysqli_fetch_array($exec_test); 
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
	?>" alt="" width="220" height="70" style='object-fit:scale-down'>
<label align=center style="line-height:23px;">
<?php 
	echo "Vielen Dank für die Teilnahme an der folgenden Umfrage</label><br><br>
	<p>Umfrage: <b>".$Umfrage_titel["Umfrage"]."</b></p>
	<input class='center_button' type='submit' value='Feedback starten'>";

?>
</form>
</body>
</html>
