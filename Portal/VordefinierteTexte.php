<?php
 require_once "../config.php";
 require_once "session.php";
?>

<!DOCTYPE HTML>
<html>
<?php
 require_once "FEEDCUBE_icon.php"
?><head>
<link class="jsbin" href="http://ajax.googleapis.com/ajax/libs/jqueryui/1/themes/base/jquery-ui.css" rel="stylesheet" type="text/css" />
<script class="jsbin" src="http://ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js"></script>
<script class="jsbin" src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8.0/jquery-ui.min.js"></script>

    <meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Feedback Auswertung</title>
	<link href="bootstrap.css" rel="stylesheet" type="text/css">
	<link href="charts.css" rel="stylesheet" type="text/css">
	<link href="system_optionen.css" rel="stylesheet" type="text/css">
	<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.3/Chart.min.js"></script>
	<?php
	include "Leistung_speichern.php";
	?>
</head>
<body class="text-center">
 <!-- Load an icon library to show a hamburger menu (bars) on small screens -->
<script src="https://kit.fontawesome.com/9059ff5bc6.js" crossorigin="anonymous"></script>
<link href="navigation.css" rel="stylesheet" type="text/css">
<script type="text/javascript" src="navigation.js"></script>	
    <div class="header">
	<?php
	include "navigation_admin.php";
?>
<script>
	document.getElementById("VordefinierteTexte").className = "active";
	document.getElementById("System").style.backgroundColor = "lightgrey";
</script>
<h1 style="font-size:30px; margin-bottom:20px;"><img src="../assets/brand/text-format.png" width="60"> Texte</h1>
<p style="margin-bottom:30px"> Definiere welche Texte bei der Abgabe von Feedback und bei der Teilnahme an Umfragen angezeigt wird</p>	</div>

	</div>
	<div class="scroll">
	<style>
	.überschrift{
		background-color: <?php $sql='SELECT farbe FROM system'; $exec=mysqli_query($link,$sql); $result=mysqli_fetch_assoc($exec); echo $result['farbe']?>;
	}
	</style>
	<!--
	<form>
	<label class="überschrift">Lizenz</label><label class="überschrift"></label>
	<label>Lizenzmodell:</label>
	<div class="system" id="Lizenzmodell" name="Lizemzmodell">Free Version <button>Upgrade</button></div>
	<label>Lizenz gültig bis:</label>
	<div class="system" id="Lizenzdatum" name="Lizenzdatum">Unlimited</div>
	<label>max Anzahl an Benutzern:</label>
	<div class="system" id="max_user" name="max_user">5</div>
	<label>genutzte Anzahl an Benutzern:</label>
	<div class="system" id="used_user" name="used_user">5</div>
	</form>
-->
	<form action="updateText.php" method="post" enctype="multipart/form-data" style="margin-top:10px; grid-template-columns: auto; border:none">
	<div style="background-color:GhostWhite; display:grid; margin-bottom:20px">
	<label style="margin-bottom:-13px;">Text vor Feedback Abgabe:</label>
	<textarea name ="Text_vor_Abgabe" rows="3" cols="50" style="border: 0.5px solid rgba(0, 0, 0, 0.2); border-radius:3px; margin:10px;">
<?php
	$sql = "SELECT Text_vor_Abgabe FROM system";
	$query = mysqli_query($link, $sql);
	$result = mysqli_fetch_array($query);
	echo $result["Text_vor_Abgabe"];
?>
	</textarea>
	<label style="margin-bottom:-13px;">Übersetzung:</label>
	<textarea name="Text_before_Feedback" rows="3" cols="50" style="border: 0.5px solid rgba(0, 0, 0, 0.2); border-radius:3px; margin:10px;margin-bottom:10px;">
<?php
	$sql = "SELECT Text_before_Feedback FROM system";
	$query = mysqli_query($link, $sql);
	$result = mysqli_fetch_array($query);
	echo $result["Text_before_Feedback"];
?>
	</textarea>
</div>
<div style="background-color:GhostWhite; display:grid">
	<label style="margin-bottom:-13px;">Text nach Feedback Abgabe:</label>
	<textarea name="Text_nach_Abgabe"rows="3" cols="50" style="border: 0.5px solid rgba(0, 0, 0, 0.2); border-radius:3px; margin:10px;">
<?php
	$sql = "SELECT Text_nach_Abgabe FROM system";
	$query = mysqli_query($link, $sql);
	$result = mysqli_fetch_array($query);
	echo $result["Text_nach_Abgabe"];
?>
	</textarea>
	<label style="margin-bottom:-13px;">Übersetzung:</label>
	<textarea name="Text_after_Feedback" rows="3" cols="50" style="border: 0.5px solid rgba(0, 0, 0, 0.2); border-radius:3px; margin:10px;">
<?php
	$sql = "SELECT Text_after_Feedback FROM system";
	$query = mysqli_query($link, $sql);
	$result = mysqli_fetch_array($query);
	echo $result["Text_after_Feedback"];
?>
	</textarea>
</div>
	<div></div>
	<input class="btn fa-input"  type="submit" value="&#xf0C7; speichern" style="margin:auto; margin-top:30px; margin-bottom:30px; color:white; background-color:<?php $sql='SELECT farbe FROM system'; $exec=mysqli_query($link,$sql); $result=mysqli_fetch_assoc($exec); echo $result['farbe']?>"></input>
	</form>
	</div>
    </body>
</html>