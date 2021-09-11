<?php
 require_once "../config.php";
 session_start();
 
// Check if the user is logged in, if not then redirect him to login page
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: login.php");
    exit;
}
?>



<!DOCTYPE HTML>

<html>
<?php
 require_once "FEEDCUBE_icon.php"
?>
<head>
	<div w3-include-html="FEEDCUBE_icon.html"></div>
    <meta charset="UTF-8">

	<meta name="viewport" content="width=device-width, initial-scale=1">

	<title>Feedback Auswertung</title>

	<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
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

<?php
	include "navigationpending.php";
?>

<div>

<h2>Hi <b><?php echo htmlspecialchars($_SESSION["username"]); ?></b>, Willkommen auf der Startseite von</h2>

<img class="mb-4" src="../assets/brand/FEEDCUBE_logo_login.svg" alt="" width="300" height="120">
<div style="grid-template-columns: auto auto;">
<div style="text-align:center; margin:auto; margin-top:20px; margin-bottom:40px; font-size:18px; width:80vw; float:center;">

<p>Deine Registrierung wurde noch nicht bestätigt.</p> 
	<p>Um den Vorgang zu beschleunigen kontaktiere bitte einen Feedcube Administrator.</b></p>

</div>
<img class="undraw_chart_empty" src="undraw_Confirmation.svg" alt="">
</div>

</div>
</body>

</html>





