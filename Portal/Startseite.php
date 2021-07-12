<?php
require_once "../config.php";
require_once "session.php";

$sql = "SELECT Is_Admin FROM users WHERE username ='".$_SESSION["username"]."'";
$exec = mysqli_query($link,$sql);
$row = mysqli_fetch_assoc($exec);
$IsAdmin = $row["Is_Admin"];
$Trainer=$_SESSION["username"];
?>

<!DOCTYPE HTML>
<html>
<?php
 require_once "FEEDCUBE_icon.php"
?>
<head>
    <meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Feedback Auswertung</title>
	<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
	<link rel="icon" href="../assets/brand/FEEDCUBE_icon.png" type="image/gif">
	<link href="bootstrap.css" rel="stylesheet" type="text/css">
	<link href="charts.css" rel="stylesheet" type="text/css">

</head>
<body class="text-center" onload="Startstatistics()">
 <!-- Load an icon library to show a hamburger menu (bars) on small screens -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<link href="navigation.css" rel="stylesheet" type="text/css">
<script type="text/javascript" src="navigation.js"></script>
<div class="header">
<?php
		$sql = "SELECT Is_Admin FROM users WHERE username ='".$_SESSION["username"]."'";
		$exec = mysqli_query($link,$sql);
		$row = mysqli_fetch_assoc($exec);
		$IsAdmin = $row["Is_Admin"];
			if($IsAdmin == 1)
				include "navigation_admin.php";
			else
				include "navigation.php";
?>
</div> 
</div>

<div style="width:85vw; margin:auto; text-align:center; font-size:19px; @media only screen and (max-width: 600px){width:100vw}">	
<!--erstes Kapitel Inhalt des Seminars-->

<h2>Hi <b><?php echo htmlspecialchars($_SESSION["username"]); ?></b>, Willkommen auf der Startseite von</h2>
<img class="mb-4" src="../assets/brand/FEEDCUBE_logo_login.svg" alt="" width="300" height="120">
<p>Hier erhältst du einen Überblick über die Auswertung des Kunden und Mitarbeiter Feedbacks</p><br>

<style>
  .überschrift_start {margin-top:10px;margin-bottom:5px;}
</style>

<!--erstes Kapitel Inhalt des Seminars-->
<div id="Auswahl" class="grid-container-auswahl" style="width:78vw;">
	<label class="Auswahl" style="text-align:center; padding:0"> Wähle einen Berater: </label>
			<?php
				include "Auswahlmöglichkeiten_Trainer_Start.php"
			?>	
</div>

<div class="startdashboard" id="startdashboard">


</div>
</div>

<script>
	function Startstatistics(){
		var Trainer = Auswahl_Trainer.value;
		var dashboard = document.getElementById("startdashboard");
		var xmlhttp_options = new XMLHttpRequest();
     	xmlhttp_options.onreadystatechange = function() {
			if (this.readyState == 4 && this.status == 200) {
				dashboard.innerHTML=this.responseText;
			}
    	;};
    	xmlhttp_options.open("GET", "Start_Dashboard.php?Trainer=" + Trainer, false);
    	xmlhttp_options.send();
	}
</script>
</body>
</html>





