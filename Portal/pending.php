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

	<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css?v=1">
	<link href="bootstrap.css?v=1" rel="stylesheet" type="text/css">
	<link href="charts.css?v=1" rel="stylesheet" type="text/css">
	<link href="slider-range.css?v=1" rel="stylesheet" type="text/css">
	<script type="text/javascript" src="hidefunction.js?v=1"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.3/Chart.min.js"></script>


</head>

<body class="text-center">

 <!-- Load an icon library to show a hamburger menu (bars) on small screens -->

<script src="https://kit.fontawesome.com/9059ff5bc6.js" crossorigin="anonymous"></script>

<link href="navigation.css?v=1" rel="stylesheet" type="text/css">

<script type="text/javascript" src="navigation.js?v=1"></script>	


<div class="header">

<?php
	include "navigationpending.php";
?>

<div>

<h2>Hi <b><?php echo htmlspecialchars($_SESSION["username"]); ?></b>, Willkommen auf der Startseite von</h2>

<img class="mb-4" src="../assets/brand/FEEDCUBE_logo_login.png" alt="" height="90" style="margin-top:30px; margin-bottom:30px">
<div style="grid-template-columns: auto auto;">
<div style="text-align:center; margin:auto; margin-top:20px; margin-bottom:40px; font-size:18px; width:80vw; float:center;">

<p>Deine Registrierung wurde noch nicht bestätigt.</p> 
	<p>Um den Vorgang zu beschleunigen kontaktiere bitte einen Feedcube Administrator.</b></p>

</div>
<img class="undraw_chart_empty" src="../assets/brand/confirm.png" alt="">
</div>

</div>
</body>

</html>





