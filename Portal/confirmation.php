<?php
 require_once "../config.php";
require_once "session.php";
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

	<title>Confirmation</title>

	<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
	<link href="bootstrap.css" rel="stylesheet" type="text/css">
	<link href="Confirmation.css" rel="stylesheet" type="text/css">
	<link href="slider-range.css" rel="stylesheet" type="text/css">
	<script type="text/javascript" src="hidefunction.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.3/Chart.min.js"></script>


</head>

<body class="text-center">

<style>
	.überschrift{
		background-color: <?php $sql='SELECT farbe FROM system'; $exec=mysqli_query($link,$sql); $result=mysqli_fetch_assoc($exec); echo $result['farbe']?>;
	}
</style>

 <!-- Load an icon library to show a hamburger menu (bars) on small screens -->

<script src="https://kit.fontawesome.com/9059ff5bc6.js" crossorigin="anonymous"></script>

<link href="navigation.css" rel="stylesheet" type="text/css">

<script type="text/javascript" src="navigation.js"></script>	


<div class="header">

<?php
	include "navigation_admin.php";
?>

<img class="mb-4" src="../assets/brand/FEEDCUBE_logo_login.svg" alt="" width="300" height="120">
<div style="text-align:center; margin:auto; margin-top:20px; margin-bottom:40px; font-size:18px; width:80vw; float:center;">
<p>Es gab neue Registrierungen im System</p><p>Bitte bestätige die neuen Benutzer oder lehne ihren Zugang ab</p> 
</div>
<div style="overflow:auto">
<form>
<label class="überschrift">Name</label><label class="überschrift">Username</label><label class="überschrift">Email</label><label class="überschrift"></label><label class="überschrift"></label>

<?php
$sql = "SELECT id, name, username, email FROM users WHERE Confirmed = 0";
        $result = mysqli_query($link,$sql);
        while($row = mysqli_fetch_assoc($result)) {
                echo "<div class = 'newUser' id='User_".$row["id"]."'>".$row["name"]."</div>";
                echo "<div class = 'newUser' id='Username_".$row["id"]."'>".$row["username"]."</div>";
                echo "<div class = 'newUser' id='Email_".$row["id"]."' >".$row["email"]."</div>"; 
				echo "<a type='button' class='center_button' style='background-color:green' href='set_trainer.php?Id=".$row["id"]."&Bool=1&Url=Start'><i class='fa fa-check' style='color:white'></i></a>";
				echo "<a type='button' class='center_button' style='background-color:red' href='User_entfernen.php?Id=".$row["id"]."&Username=".$row["username"]."'><i class='fa fa-trash' style='color:white'></i></a>";
        }
?>
</form>
</div>
<form action="setSuspendedConfirmation.php" style="text-align:center; margin:auto; display:block; min-width:20px">
<button type="submit" class="suspendButton" style="color:<?php $sql='SELECT farbe FROM system'; $exec=mysqli_query($link,$sql); $result=mysqli_fetch_assoc($exec); echo $result['farbe']?>;border-color:<?php $sql='SELECT farbe FROM system'; $exec=mysqli_query($link,$sql); $result=mysqli_fetch_assoc($exec); echo $result['farbe']?>;">Überspringen</button>
</form>
</body>
</html>





