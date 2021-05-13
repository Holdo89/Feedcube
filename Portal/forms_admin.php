<?php
 require_once "session.php";
 require_once "../config.php";
?>

<!DOCTYPE HTML>
<html>
<?php
 require_once "FEEDCUBE_icon.php"
?>  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Feedback abgeben</title>
	<link href="bootstrap.css" rel="stylesheet" type="text/css">
	<link href="forms.css" rel="stylesheet" type="text/css">
	<link href="charts.css" rel="stylesheet" type="text/css">
	<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.3/Chart.min.js"></script>
	
  </head>

<body class="text-center">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	<link href="navigation.css" rel="stylesheet" type="text/css">
	<script type="text/javascript" src="navigation.js"></script>

	<div class="header">
				<div class="topnav" id="myTopnav" style="background-color:<?php $sql="SELECT farbe FROM system"; $exec=mysqli_query($link,$sql); $result=mysqli_fetch_assoc($exec); echo $result['farbe']?>">

        	<a class="image" style="padding:0px; padding-bottom:5px;"href="Start.php">
			<img src="../assets/brand/FEEDCUBE_logo.png" style="float:left; margin-right:30px; margin-left:15px; margin-top:3px;" width="50" height="50">			
			<a style="  margin-bottom:20px; visibility: hidden;"></a>
			<div class="dropdown">
				<button class="dropbtn">Auswertung <i class="fa fa-caret-down"></i></button>
				<div class="dropdown-content">			
					<a href="feedback_charts.php"><i class="fa fa-bar-chart" aria-hidden="true"></i> Diagramme</a>
					<a href="forms_admin.php" class="active"><i class="fa fa-file-text-o" aria-hidden="true"></i> Formulare</a>				
				</div>
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
			<button class="dropbtn">Optionen 
      			<i class="fa fa-caret-down"></i>
    		</button>
			<div class="dropdown-content">
			<a href="Fragen.php"><i class="fa fa-question-circle-o" aria-hidden="true"></i> Feedbackfragen</a>
      				<a href="Usermanagement.php"><i class="fa fa-users" aria-hidden="true"></i> Benutzer</a>
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
		<h1 style="font-size:30px; margin-bottom:10px;">Formulare <i class="fa fa-file-text-o" aria-hidden="true"></i> </h1>
		<p style="margin-bottom:30px"> Hier findest du die Auswertung deines Kundenfeedbacks</p>	</div>
	<div id="Auswahl_Admin" class="grid-container-auswahl">
	<label class="Auswahl" style="font-size: 13pt;"> Wähle einen Berater: </label>
			<?php
				include "Auswahlmöglichkeiten_Trainer.php"
			?>
	</div>
	<div id="auswertungen" style="display:grid; margin:10px;">
	</div>
	<script>
	function formular(){
	var Trainer = Auswahl_Trainer.value;
	var xmlhttp = new XMLHttpRequest();
	xmlhttp.onreadystatechange = function() {
  	if (this.readyState == 4 && this.status == 200) {
		if (this.response.length==2) //Wenn kein response kommt dann haben wir eine Länge von 2
		{
        	var canvas = document.getElementById("auswertungen");
        	canvas.innerHTML="<label style='margin:50px'>Es wurde noch kein Feedback abgegeben</label>";
		}
		else{
			document.getElementById("auswertungen").innerHTML=this.responseText;
			var MyDiv=document.getElementById("auswertungen");
			var arr = MyDiv.getElementsByTagName('script');
			for (var n = 0; n < arr.length; n++)
			eval(arr[n].innerHTML);
		}
	}
	;};

	xmlhttp.open("GET", "formular_admin.php?Trainer=" + Trainer, true);
	xmlhttp.send();
	}
	formular()
	function deleteFeedback(id){
		if (confirm("Wollen Sie dieses Feedback wirklich entfernen?"))
	  	{
			var xmlhttp = new XMLHttpRequest();
			xmlhttp.open("GET", "deleteFeedback.php?Id=" + id, true);
			xmlhttp.send();
			location.reload();
	  }
	}

</script>
</body>
</html>