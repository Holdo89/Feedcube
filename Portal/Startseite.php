<?php
require_once "../config.php";
require_once "session.php";

$sql = "SELECT Is_Admin FROM users WHERE username ='".$_SESSION["username"]."'";
$exec = mysqli_query($link,$sql);
$row = mysqli_fetch_assoc($exec);
$IsAdmin = $row["Is_Admin"];
/*
if($IsAdmin==1)
{
    $Trainer=$_REQUEST["Trainer"];
}
else*/
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
	<link href="slider-range.css" rel="stylesheet" type="text/css">
	<script type="text/javascript" src="hidefunction.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.3/Chart.min.js"></script>

				<?php
				include "Draw_Charts.php";		//Pie and COlumnchart
				include "Draw_Trend_Chart.php";
				include "Create_Blog.php";
			?>

  <script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
  <script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/jqueryui/1.11.4/jquery-ui.min.js"></script>
  <script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/jqueryui-touch-punch/0.2.3/jquery.ui.touch-punch.min.js"></script>
  <script type="text/javascript" src="rangeslider_jquery.js"> </script>

</head>
<body class="text-center">
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
  .überschrift {margin-top:10px;margin-bottom:5px;}
</style>

<!--erstes Kapitel Inhalt des Seminars-->

<div class="container">
  <div class="btn-group">
  	<button type="button" id="metriken_button" class="btn btn-primary" onclick="change_color('metriken_button','text_button','<?php $sql='SELECT farbe FROM system'; $exec=mysqli_query($link,$sql); $result=mysqli_fetch_assoc($exec); echo $result['farbe']?>'); hide('fullAuswahl','blog'); hide('charts','blog');">Team</button>
    <button type="button" id="text_button" class="btn btn-primary" onclick="change_color('text_button','metriken_button','<?php $sql='SELECT farbe FROM system'; $exec=mysqli_query($link,$sql); $result=mysqli_fetch_assoc($exec); echo $result['farbe']?>'); hide('fullAuswahl','charts');hide('blog','fullAuswahl');">Individuell</button>
  </div>
</div>

<div class="startdashboard">
<div class="überschrift"><b>Singlechoice</b> </div> <div class="überschrift"><b>Total</b></div> <div class="überschrift"><b>Trend</b> </div>
<?php
	include "Fragen_Startseite.php";
	questions("Singlechoice", $link, "externes_feedback");
?>


<div class="überschrift"><b>Schieberegler</b> </div> <div class="überschrift"><b>Total</b></div> <div class="überschrift"><b>Trend</b> </div>

<?php
	questions("Schieberegler", $link, "externes_feedback");
?>

<div class="überschrift"><b>Multiplechoice</b></div><div class="überschrift"><b>Häufigste</b></div> <div class="überschrift"><b>Seltenste</b> </div>

<?php
	questions("Multiplechoice", $link, "externes_feedback");
?>

</div>
</div>
</div>


</body>
</html>





