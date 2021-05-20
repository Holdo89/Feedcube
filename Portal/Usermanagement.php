<?php
 require_once "session.php";
 require_once "../config.php";
?>

<!DOCTYPE HTML>
<html>
<?php
 require_once "FEEDCUBE_icon.php"
?><head>
    <meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Feedback Auswertung</title>
	<link href="charts.css" rel="stylesheet" type="text/css">
	<link href="User_optionen.css" rel="stylesheet" type="text/css">
	<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.3/Chart.min.js"></script>
	<?php
	include "User_speichern.php"
	?>

</head>
<style>
/* The Modal (background) */
.modal {
  display: none; /* Hidden by default */
  position: fixed; /* Stay in place */
  z-index: 1; /* Sit on top */
  padding-top: 100px; /* Location of the box */
  left: 0;
  top: 0;
  width: 100%; /* Full width */
  height: 100%; /* Full height */
  overflow: auto; /* Enable scroll if needed */
  background-color: rgb(0,0,0); /* Fallback color */
  background-color: rgba(0,0,0,0.4); /* Black w/ opacity */
}

/* Modal Content */
.modal-content {
  background-color: #fefefe;
  margin: auto;
  border: 1px solid #888;
  width: 50%;
}

/* The Close Button */
.close {
  color: #aaaaaa;
  float: right;
  font-size: 28px;
  font-weight: bold;
}

.close:hover,
.close:focus {
  color: #000;
  text-decoration: none;
  cursor: pointer;
}
</style>

<body class="text-center">
 <!-- Load an icon library to show a hamburger menu (bars) on small screens -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<link href="navigation.css" rel="stylesheet" type="text/css">
<script type="text/javascript" src="navigation.js"></script>	
    <div class="header">
				<div class="topnav" id="myTopnav" style="background-color:<?php $sql="SELECT farbe FROM system"; $exec=mysqli_query($link,$sql); $result=mysqli_fetch_assoc($exec); echo $result['farbe']?>">

        <a class="image" style="padding:0px; padding-bottom:5px;"href="Start.php">
			<img src="../assets/brand/FEEDCUBE_logo.png" style="float:left; margin-right:30px; margin-left:15px; margin-top:3px;" width="50" height="50">
        </a>
						<a style="  margin-bottom:20px; visibility: hidden;"></a>
			<div class="dropdown">
			<button class="dropbtn">Auswertung 
      			<i class="fa fa-caret-down"></i>
    		</button>
			<div class="dropdown-content">			<a href="feedback_charts.php"><i class="fa fa-bar-chart" aria-hidden="true"></i> Diagramme</a>
			<a href="forms_admin.php"><i class="fa fa-file-text-o" aria-hidden="true"></i> Formulare</a>				</div>
			</div>
			<div class="dropdown">
			<button class="dropbtn">Intern
      			<i class="fa fa-caret-down"></i>
    		</button>
			<div class="dropdown-content">
				<a href="Intern.php"><i class="fa fa-bullhorn" aria-hidden="true"></i> Feedback</a>
     			<a href="interner_blog.php"><i class="fa fa-comments-o" aria-hidden="true"></i> Blog</a>
			</div>
			</div>
			<div class="dropdown">
			<button class="dropbtn" style="background-color: #ddd; color: white;">Optionen 
      			<i class="fa fa-caret-down"></i>
    		</button>
			<div class="dropdown-content">
			<a href="Fragen.php"><i class="fa fa-question-circle-o" aria-hidden="true"></i> Feedbackfragen</a>
      				<a href="Usermanagement.php" class="active"><i class="fa fa-users" aria-hidden="true"></i> Benutzer</a>
					<a href="Leistungmanagement.php"><i class="fa fa-graduation-cap" aria-hidden="true"></i> Leistungen</a>
			</div>
			</div>
			<a href="javascript:void(0);" class="icon" onclick="myFunction()">
			<i class="fa fa-bars"></i>
			</a>
			<div class="dropdown" style="float:right; margin-right:50px;">
			<button class="dropbtn"><i class="fa fa-user"></i> 
    		</button>
			<div class="dropdown-content" style="right:0; margin-right:20px;">
				<a href="reset-password.php"><i class="fa fa-lock" aria-hidden="true"></i> Passwort reset</a>
				<a href="logout.php"><i class="fa fa-sign-out" aria-hidden="true"></i> Abmelden</a>
			</div>
			</div>
			<a style="float:right; margin-right:10px;"href="System.php"><i class="fa fa-cog" aria-hidden="true"></i></a>
		</div> 
		<h1 style="font-size:30px; margin-bottom:10px;">Benutzer <i class="fa fa-users" aria-hidden="true"></i> </h1>
		<p style="margin-bottom:30px; text-align:center; margin-left:auto;"> Bearbeite hier Benutzer die internes Feedback abgeben und Kundenfeedback erhalten</p>	</div>
		</div>
	<div class="scroll">
	<style>
	.überschrift{
		background-color: <?php $sql='SELECT farbe FROM system'; $exec=mysqli_query($link,$sql); $result=mysqli_fetch_assoc($exec); echo $result['farbe']?>;
	}
	</style>
	<form action="insert_user.php" method="post">
	<label class="überschrift">Name</label><label class="überschrift">Username</label><label class="überschrift">Email</label><label class="überschrift">Admin</label><label class="überschrift">Trainer</label><label class="überschrift" style="text-align:center">Link</label><label class="überschrift" style="font-size:11px">Passwort</label><label class="überschrift"></label>
	<?php
		include "User_Abfrage.php";
	?>
	<script>
	function user_password_reset(id) {
  	if (confirm("Wollen Sie das Passwort zu diesem User ändern?"))
	  {<?php
// Define variables and initialize with empty values
$new_password = $confirm_password = "";
$new_password_err = $confirm_password_err = "";
		?>
	  alert("Die Änderungen wurden übernommen");
	}
	;}
	function user_abfrage_speichern(id) {
		speichern(id);
	}

	function user_abfrage_löschen(id) {
  	if (confirm("Wollen Sie diesen User entfernen? Ihre bestehendes Feedback zu diesem User wird ebenfalls entfernt"))
	  {entfernen(id);
		alert("User wurde gelöscht");
		location.reload();}
	;}
	</script>
	</form>
	</div>
		<!-- The Modal -->
	<div id="myModal" class="modal">
	<form style="display:block; padding:30px; width:70%;" method="post">
		<span class="close">&times;</span>
		<div id="Trainer_Auswahl" name="Trainer_Auswahl">Wähle dein Fragenset zur ausgewählten Leistung:</div>
		<?php
			include "Auswahlmöglichkeiten_Leistung.php"
		?>
		<p style="margin-top:20px;">Feedback-Link: </p>
		<input type="text" id="Link" name="Link" style="margin-top:5px; border:none; width:95%; background-color:rgba(0,0,0,0.03);" readonly="true"></input>
		<button id="copyButton" onclick="copyLink()" style="margin-top:20px; padding:7px; border:none; border-radius:2px; color:white; display:none; background-color:<?php $sql="SELECT farbe FROM system"; $exec=mysqli_query($link,$sql); $result=mysqli_fetch_assoc($exec); echo $result['farbe']?>">Link kopieren</button>
	</form>
	</div>
	<script>
	var modal = document.getElementById("myModal");
	var Trainer_element = document.getElementById("Trainer_Auswahl");
	function display(Trainer) {
		modal.style.display = "block";
		Trainer_element.value = Trainer;
		var Auswahl_Leistung = document.getElementById("Auswahl_Leistung");
		Auswahl_Leistung.value = "%"
		Trainer_element.innerHTML= "Erzeuge einen Feedback-Link für den Trainer <b>" + Trainer + "</b><div style='margin-top:20px;margin-bottom:20px'> Wähle eine Leistung die bewertet wird:</div>";
		var Link = document.getElementById("Link");
		Link.value = "";
	}
	// Get the <span> element that closes the modal
	var span = document.getElementsByClassName("close")[0];
	var Auswahl_Leistung = document.getElementById("Auswahl_Leistung");
	var Link = document.getElementById("Link");
	var copyButton = document.getElementById("copyButton");
	var current_url = window.location.href;
	var index = current_url.indexOf("Portal");
	current_url = current_url.substr(0,index)+"Feedback_abgeben";
	Auswahl_Leistung.onchange = function(){
		var prefix = "Feedback-Link:<div style='font-size:13px;'> ";
		var Feedbacklink = current_url+"/Vorauswahl.php?Trainer="+Trainer_element.value+"&Leistung="+Auswahl_Leistung.value;
		Feedbacklink = Feedbacklink.replaceAll(" ","%20");
		Link.value = Feedbacklink;
		copyButton.style.display = "block";
	};
	// When the user clicks on <span> (x), close the modal
	span.onclick = function() {
  		modal.style.display = "none";
		copyButton.style.display = "none";
	}

	// When the user clicks anywhere outside of the modal, close it
	window.onclick = function(event) {
	if (event.target == modal) {
		modal.style.display = "none";
		copyButton.style.display = "none";
	}
	}
	function copyLink() {
		var copyLink = document.getElementById("Link");
		copyLink.select();
		copyLink.setSelectionRange(0, 99999);
		document.execCommand("copy");
	}
	</script>
    </body>
</html>