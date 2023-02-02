<?php
 require_once "../config.php";
 require_once "session.php";
 include "RedirectToStart.php";
?>

<!DOCTYPE HTML>
<html>
<?php
 require_once "FEEDCUBE_icon.php"
?><head>
    <meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Antworten</title>
	<link href="bootstrap.css?v=1" rel="stylesheet" type="text/css">
	<link href="charts.css?v=1" rel="stylesheet" type="text/css">
	<link href="Fragen.css?v=1" rel="stylesheet" type="text/css">
	<link href="tooltip.css?v=1" rel="stylesheet" type="text/css">
	<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.3/Chart.min.js"></script>
	<?php
	include "Frage_speichern.php";
	?>
</head>
<style>

/* The Modal (background) */
.modal {
  display: none; /* Hidden by default */
  position: fixed; /* Stay in place */
  z-index: 1; /* Sit on top */
  padding-top: 30px; /* Location of the box */
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

#Kursfragen form.ui-state-highlight {
    padding: 20px;
    background-color: #eaecec;
    border: 1px dotted #ccc;
    cursor: move;
    margin-top: 12px;
    }
#interne_Fragen form.ui-state-highlight {
    padding: 20px;
    background-color: #eaecec;
    border: 1px dotted #ccc;
    cursor: move;
    margin-top: 12px;
    }

#Antworten_Bewertungen form.ui-state-highlight {
	width:70%;
    padding: 20px;
    background-color: #eaecec;
    border: 1px dotted #ccc;
    cursor: move;
    margin-top: 12px;
    }


#Antworten_Multiplechoice form.ui-state-highlight {
	width:70%;
    padding: 20px;
    background-color: #eaecec;
    border: 1px dotted #ccc;
    cursor: move;
    margin-top: 12px;
    }
    
.modalform{
    width:90%; 
    max-width:1000px; 
    padding:30px; 
    overflow:auto; 
    border-radius: 15px;
}

.center_button:hover .tooltiptext {
  visibility: visible;
}

</style>
	<script>
	function Antwort_speichern(id,typ) {
		speichern_antwort(id, typ);
	;}

	function Antwort_löschen(id,typ) {
  	if (confirm("Wollen Sie diese Antwort entfernen? Ihre bestehenden Daten zu dieser Antwort werden ebenfalls entfernt"))
	  {entfernen_antwort(id,typ);
		alert("Die Antwort wurde gelöscht");
		location.reload();}
	;}
	</script>
<script src="https://code.jquery.com/jquery-1.12.4.js"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui-touch-punch/0.2.3/jquery.ui.touch-punch.min.js"></script>
<script src="touchjquery.js?v=1"></script>
<body class="text-center">
 <!-- Load an icon library to show a hamburger menu (bars) on small screens -->
<script src="https://kit.fontawesome.com/9059ff5bc6.js" crossorigin="anonymous"></script>
<link href="navigation.css?v=1" rel="stylesheet" type="text/css">
<script type="text/javascript" src="navigation.js?v=1"></script>	
    <div class="header">
	<?php
	include "navigation_admin.php";	
?>
<script>
	document.getElementById("Antworten").className = "active";
	document.getElementById("System").style.backgroundColor = "lightgrey";
</script>
		<h1 style="font-size:30px; margin-bottom:10px;"><img src="../assets/brand/check-mark.png" width="60" style="margin-top:-10px;"> Antworten </h1>
		Hier kannst du Antwortmöglichkeiten zu Feedbackfragen hinzufügen oder bearbeiten
	</div>
	<style>
	.überschrift{
		background-color: <?php $sql='SELECT farbe FROM system'; $exec=mysqli_query($link,$sql); $result=mysqli_fetch_assoc($exec); echo $result['farbe']?>;
	}
	</style>
	<div class="alert icon-alert with-arrow alert-success form-alter" role="alert" style="display:none;">
		<i class="fa fa-fw fa-check-circle"></i>
		<strong> Success ! </strong> <span class="success-message"> Die Reihenfolge der Antwortmöglichkeiten wurde erfolgreich bearbeitet </span>
	</div>
	<div class="alert icon-alert with-arrow alert-danger form-alter" role="alert" style="display:none;">
		<i class="fa fa-fw fa-times-circle"></i>
		<strong> Note !</strong> <span class="warning-message"> Eine leere Liste kann nicht sortiert werden </span>
	</div>
	<div id="range_alert" class="alert icon-alert with-arrow alert-danger form-alter" role="alert" style="display:none;">
		<i class="fa fa-fw fa-times-circle"></i>
		<strong> Note !</strong> <span class="warning-message"> Die angegebenen Werte waren nicht korrekt </span>
	</div>

	<form class="form_antworten" style="border-radius:5px 5px 0px 0px; margin-top:30px;">
	<label style="grid-column: 1 / span 2; padding-left:20px" class="überschrift">Bewertung</label>
	<label class="überschrift"></label>
	<label class="überschrift"></label>
	</form>
	<div id="Antworten_Bewertungen" class="scroll">
	<?php
		include "Antworten_Abfrage.php";
	?>
	</div>

	<button id="element" style="width:250px; background-color:<?php $sql='SELECT farbe FROM system'; $exec=mysqli_query($link,$sql); $result=mysqli_fetch_assoc($exec); echo $result['farbe']?>" onclick = "display(undefined,'answers', 'Bewertung')"> Bewertung hinzufügen</button>


	<!-- The Modal -->
	<div id="myModal" class="modal">
	</div>

	<script>
	
	$(document).ready(function(){
		$( "#Antworten_Bewertungen" ).sortable({
			placeholder : "ui-state-highlight",
			update  : function(event, ui)
			{	
				var post_order_ids = new Array();
				$('#Antworten_Bewertungen form').each(function(){
					post_order_ids.push($(this).data("post-id"));
				});
				$.ajax({
					url:"ajax_upload_antworten.php",
					method:"POST",
					data:{post_order_ids:post_order_ids},
					success:function(data)
					{
					 if(data){
					 	$(".alert-danger").hide();
					 	$(".alert-success ").show();
					 }else{
					 	$(".alert-success").hide();
					 	$(".alert-danger").show();
					 }
					}
				});
			}
		});
		$( "#Antworten_Multiplechoice" ).sortable({
			placeholder : "ui-state-highlight",
			update  : function(event, ui)
			{	
				var post_order_ids = new Array();
				$('#Antworten_Multiplechoice form').each(function(){
					post_order_ids.push($(this).data("post-id"));
				});
				$.ajax({
					url:"ajax_upload_antworten_multiplechoice.php",
					method:"POST",
					data:{post_order_ids:post_order_ids},
					success:function(data)
					{
					 if(data){
					 	$(".alert-danger").hide();
					 	$(".alert-success ").show();
					 }else{
					 	$(".alert-success").hide();
					 	$(".alert-danger").show();
					 }
					}
				});
			}
		});
	});

	var modal = document.getElementById("myModal");

	function display(id, type, questiontype) {

			if(questiontype=="Bewertung")
			{
				modal.innerHTML = '<form id="antwortBearbeiten" class="modalform" action="Antwort_Uebersetzung_save.php?Type=answers&Questiontype=Bewertung<?php 
			if(isset($_REQUEST["Step"]))
				{
					$Step = $_REQUEST["Step"];
					echo"&Step=".$Step;
				} ?>" method="post"><span class="close" onclick="hide_modal();">&times;</span><div class="Kommentare" style="margin:auto; text-align:left; width:90%"><h4 id="Überschrift">Antwort bearbeiten</h4><input id="ID_answers_Bewertung" name="ID_answers_Bewertung" style="visibility:hidden; height:0px"></input><h5>Antwort: </h5><input id="neue_Antwort" class="center_select" name="neue_Antwort" placeholder="Eingabe einer neuen Antwort" required></input><div name="uebersetzung" style="margin-top:40px;"><h5>Übersetzung: </h5><input class="center_select" id="englisch_answers_Bewertung" name ="englisch_answers_Bewertung" style="display:inline-block; width:100%; height:30px;" placeholder="Übersetzung in zweite Sprache" required"></input></div><h4><button type="submit" name = "Submit" style="background-color:white; border-radius:10px; border:1px; margin-bottom:20px;margin-top:10px; font-size:16px;" ><i class="fa fa-save"></i> speichern</button></div></form>';
			}

			if(questiontype=="Multiplechoice")
			{
  				modal.innerHTML = '<form id="antwortBearbeiten" class="modalform" action="Antwort_Uebersetzung_save.php?Type=answers&Questiontype=Multiplechoice<?php 
			if(isset($_REQUEST["Step"]))
				{
					$Step = $_REQUEST["Step"];
					echo"&Step=".$Step;
				} ?>" method="post"><span class="close" onclick="hide_modal();">&times;</span><div class="Kommentare" style="margin:auto; text-align:left; width:90%"><h4 id="Überschrift">Antwort bearbeiten</h4><input id="ID_answers_Multiplechoice" name="ID_answers_Multiplechoice" style="visibility:hidden; height:0px"></input><h5>Antwort: </h5><input id="neue_Antwort" class="center_select" name="neue_Antwort" placeholder="Eingabe einer neuen Antwort"  required></input><div name="uebersetzung" style="margin-top:40px;"><h5>Übersetzung: </h5><input class="center_select" id="englisch_answers_Multiplechoice" name ="englisch_answers_Multiplechoice" style="display:inline-block; width:100%; height:30px;" placeholder="Übersetzung in zweite Sprache" required></input></div><h4><button type="submit" name = "Submit" style="background-color:white; border-radius:10px; border:1px; margin-bottom:20px;margin-top:10px; font-size:16px;" ><i class="fa fa-save"></i> speichern</button></div></form>';
			}

		modal.style.display = "block";

		if(id!=undefined)
		{
			var div_id=document.getElementById("ID_"+type+"_"+questiontype);
			div_id.value=id;
			var xmlhttp_options = new XMLHttpRequest();

			var antwort_englisch = document.getElementById("englisch_"+type+"_"+questiontype);     
			xmlhttp_options.onreadystatechange = function() {
				if (this.readyState == 4 && this.status == 200) {
					antwort_englisch.value=this.responseText;
				}
			;};
			xmlhttp_options.open("GET", "Antwort_Uebersetzung.php?ID=" + id+"&Questiontype="+questiontype, false);
			xmlhttp_options.send();
		
			var xmlhttp_options = new XMLHttpRequest();

			var antwort = document.getElementById("neue_Antwort");     
			xmlhttp_options.onreadystatechange = function() {
				if (this.readyState == 4 && this.status == 200) {
					antwort.value=this.responseText;
				}
			;};
			xmlhttp_options.open("GET", "getAntwort.php?ID=" + id+"&Questiontype="+questiontype, false);
			xmlhttp_options.send();
		}
		else{
			if(questiontype=="Bewertung")
			{
				var buttonaction = "insert_antworten.php";
			}
			else
			{
				var buttonaction = "insert_antworten_multiplechoice.php";
			}
			var überschrift=document.getElementById("Überschrift");
			überschrift.innerHTML='Neue Antwort hinzufügen';
			var Antwortbearbeiten=document.getElementById("antwortBearbeiten");
			Antwortbearbeiten.action=buttonaction+"<?php 
	if(isset($_REQUEST["Step"]))
		{
			$Step = $_REQUEST["Step"];
			echo"?Step=".$Step;
		} ?>";

		}
	
}

	// When the user clicks anywhere outside of the modal, close it
	function hide_modal(){
		var modal = document.getElementById("myModal");
		modal.style.display = "none";
	}

	window.onclick = function(event) {
	if (event.target == modal) {
		modal.style.display = "none";
	}
	}
	</script>
<?php
    include "Tutorial_Schritt2_Info.php";
if (isset($_REQUEST["Step"])) {
    echo'
    <script>
	    document.getElementById("myTopnav").style.display="none";
    </script>
	<div class="content">
	        <button class="TutorialNavi" onclick = "zurück()"><i class="fa fa-arrow-left"></i><br>zurück</button>
			<progress id="progress" value="1" max="6" style="font-size:25px"></progress>
            <button class="TutorialNavi" onclick = "weiter()"><i class="fa fa-arrow-right"></i><br>weiter</button>
			<progress id="progressmobile" value="1" max="6" style="font-size:25px;"></progress>
    </div>';

    $Step=$_REQUEST["Step"];
}
?>
	<link href="Tutorialstyle.css?v=1" rel="stylesheet" type="text/css">
    <script src="Cookiefunctions.js?v=1" type="text/javascript"></script>

    <script>
				checkCookie("AntwortenInformationChecked", "AntwortenInfo_Modal")
				function weiter() {
					window.location.href = "Fragen.php?Step=3"
				}

				function zurück() {
					window.location.href = "Introstart.php"
				}
				
				function hideinformation(){
					document.getElementById("AntwortenInfo_Modal").style.display="none"
					document.cookie = "AntwortenInformationChecked=1; expires=Fri, 27 Mar 2122 12:00:00 UTC";
				}

        function hideinformationWithoutremembering(){
            document.getElementById("AntwortenInfo_Modal").style.display="none"
        }

    </script>

    </body>
</html>