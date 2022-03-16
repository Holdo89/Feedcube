<?php
 require_once "../config.php";
 require_once "session.php";
?>

<!DOCTYPE HTML>
<html>
<?php
 require_once "FEEDCUBE_icon.php"
?><head>
       
    <meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Umfragen</title>
	<link rel = "stylesheet" href = "https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
	<link href="bootstrap.css" rel="stylesheet" type="text/css">
	<link href="Umfragen_Fragen.css" rel="stylesheet" type="text/css">
	<link href="tooltip.css" rel="stylesheet" type="text/css">
	<link href="umfrage_optionen.css" rel="stylesheet" type="text/css">
	<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.3/Chart.min.js"></script>
	<?php
	include "Umfrage_speichern.php";
	include "Fragenset_speichern.php";
	?>
	<script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
	<script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/jqueryui/1.11.4/jquery-ui.min.js"></script>
	<script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/jqueryui-touch-punch/0.2.3/jquery.ui.touch-punch.min.js"></script>
	<script src = "https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
	<script src = "https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
	<script src = "https://cdnjs.cloudflare.com/ajax/libs/bootstrap-multiselect/0.9.15/js/bootstrap-multiselect.min.js"></script>
	<link rel = "stylesheet" href = "https://cdnjs.cloudflare.com/ajax/libs/bootstrap-multiselect/0.9.15/css/bootstrap-multiselect.css"/>

	<script>
	$(document).ready(function() {
		$('#Auswahl_Trainer').multiselect({
		includeSelectAllOption: true,
		enableFiltering: true,
		enableCaseInsensitiveFiltering: true,
		filterPlaceholder:'Hier suchen..'
		});
	});
	</script>
<style>
.radio-inline, .checkbox-inline{
	border:none;
}
#element{
  width:250px;
  position: relative;
  margin:auto;
  text-align:center;
  margin-top:25px;
  margin-bottom:30px; 
  cursor:pointer; 
  padding:15px; 
  font-size: 16px; 
  border:none; 
  border-radius:30px; 
  color:white; 
  background-color:<?php $sql='SELECT farbe FROM system'; $exec=mysqli_query($link,$sql); $result=mysqli_fetch_assoc($exec); echo $result['farbe']?>
}

/* The Modal (background) */
.modal {
  display: none; /* Hidden by default */
  position: fixed; /* Stay in place */
  z-index: 1; /* Sit on top */
  padding-top: 50px; /* Location of the box */
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

.interne_Fragen form.ui-state-highlight {
    padding: 20px;
    background-color: #eaecec;
    border: 1px dotted #ccc;
    cursor: move;
    margin-top: 12px;
    }
	
.modalform{
    width:90%; 
    text-align:center;
    margin:auto;
    max-width:1000px; 
    padding:30px; 
    overflow:auto; 
    border-radius: 15px;
}


.center_button:hover .tooltiptext {
  visibility: visible;
}
</style>

</head>
<body class="text-center">
 <!-- Load an icon library to show a hamburger menu (bars) on small screens -->
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<script src="https://kit.fontawesome.com/662d1709e3.js" crossorigin="anonymous"></script>
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
<script>
	document.getElementById("Umfragen").className = "active";
	document.getElementById("UmfrageMöglichkeiten").style.backgroundColor = "lightgrey";
</script>
		<h1 style="font-size:30px; margin-bottom:10px;"><img src="../assets/brand/promotion.png" width="60"> Umfragen </h1>
		<p style="margin-bottom:30px"> Erstelle und bearbeite Umfragen zu denen Mitarbeiter und Kollegen Bewertungen abgeben</p>	</div>
		</div>
	<style>
	.überschrift{
		background-color: <?php $sql='SELECT farbe FROM system'; $exec=mysqli_query($link,$sql); $result=mysqli_fetch_assoc($exec); echo $result['farbe']?>;
	}
	</style>

	<form method="post">
	<label style ="grid-column: 1 / span 5; padding-left:10px" class="überschrift">Umfragen</label>
	</form>
	<?php
		include "Umfrage_Abfrage.php";
	?>

	<button id ="element" style="width:250px; background-color:<?php $sql='SELECT farbe FROM system'; $exec=mysqli_query($link,$sql); $result=mysqli_fetch_assoc($exec); echo $result['farbe']?>" onclick = "showNewUmfrageModal()"><i class="fa fa-bullhorn" style="font-size:19px" aria-hidden="true"></i> Umfrage hinzufügen</button>

	
	<!-- The Modal -->
	<div id="myModal" class="modal">
		<form class="modalform" id="Modalform" style="margin-bottom:40px; display:block; margin-top:-20px; overflow:hidden" action="<?php 
	echo $_SERVER["PHP_SELF"];
	if(isset($_REQUEST["Step"]))
		{
			$Step = $_REQUEST["Step"];
			echo"?Step=".$Step;
		} ?>" method="post">
			<span class="close" style="text-align:right" onclick="hide_modal()">&times;</span>
			<div style="text-align:left">
			<h4>Neue Frage hinzufügen</h4>
			<hr style="margin-bottom:30px; margin-top:-5px;">
					<p>Frage: <p>
					<input class="center_select" id="Frage"  name="Frage" placeholder="Eingabe einer neuen Frage" required></input>
					<div class="container">
					<br>
					<p>Fragentyp:</p>
						<label class="radio-inline">
						<input type="radio" name="Auswahl_Fragentyp" id="Bewertung" value="Bewertung" style="margin-top:10px;" oninput="showoptions()" required>Bewertung
						</label>
						<label class="radio-inline">
						<input type="radio" name="Auswahl_Fragentyp" id="Multiplechoice" value="Multiplechoice" style="margin-top:10px;" oninput="showoptions()" required>Multiplechoice
						</label>
						<label class="radio-inline">
						<input type="radio" name="Auswahl_Fragentyp" id="Schieberegler" value="Schieberegler" style="margin-top:10px;" oninput="showoptions()" required>Schieberegler
						</label>
						<label class="radio-inline">
						<input type="radio" name="Auswahl_Fragentyp" id="Text" value="Text" style="margin-top:10px;" oninput="showoptions()" required>Text
						</label>
					</div>
					<div id="Antworttyp_container" class="container" style="display:none">
					<p>Antworttyp:</p>
						<label class="radio-inline">
						<input type="radio" name="Auswahl_Antworttyp" id="vordefiniert" value="vordefiniert" style="margin-top:10px;" value="vordefiniert" oninput="showoptions()">Vordefiniert
						</label>
						<label class="radio-inline">
						<input type="radio" name="Auswahl_Antworttyp" id="fragenspezifisch" value="fragenspezifisch" style="margin-top:10px;" value="fragenspezifisch" oninput="showoptions()">Fragenspezifisch
						</label>
					</div>
					<input id="Umfragenid" name="Umfragenid" style="font-size:12px; display:none;" value = 0>
					</input>
					<input id="Fragenid" name="Fragenid" style="font-size:12px; display:none;" value = 0>
					</input>
					<input id="externinterntyp" name="externinterntyp" style="font-size:12px; display:none;">
					</input>
					<div id="Bewertungoptionen" style="font-size:12px; display:none;">
					</div>
					<div id="Multiplechoiceoptionen" style="font-size:12px; display:none;">
					</div>
					<span id="alert" class="alert icon-alert with-arrow alert-danger form-alter" role="alert" style="display:none;" ><?php echo $Schieberegler_err; ?></span>
					<div id="Rangeoptionen" style="font-size:12px; display:none;">
					</div>
					<div id="Rangeoptionen_fragenspezifisch" style="font-size:12px; display:none;">
					</div>
					<button type="submit" name = "Submit" style="background-color:white; border-radius:10px; border:1px; margin-bottom:20px;margin-top:10px; font-size:16px;" ><i class="fa fa-save"></i> speichern</button>
			</div>
		</form>
	</div>


	  <!-- The Modal -->
	<div id="neueUmfrage" class="modal">
		<form class="modalform" id="neueUmfrageForm" style="margin-bottom:40px; display:block; margin-top:-20px; overflow:visible" action="insert_Umfrage.php<?php
	if(isset($_REQUEST["Step"]))
		{
			$Step = $_REQUEST["Step"];
			echo"?Step=".$Step;
		} ?>" method="post">
			<span class="close" style="text-align:right" onclick="hide_newUmfragemodal()">&times;</span>
			<div style="text-align:left">
			<p id="ÜberschriftUmfrage" style="font-weight:bold">Neue Umfrage hinzufügen</p>
			<hr style="margin-bottom:30px; margin-top:-5px;">
			<p>Umfrage: </p>
			<input class="center_select" id="Umfrage"  name="Umfrage" placeholder="Eingabe einer neuen Umfrage" required></input>
			<br>
			<p>Umfragetyp:</p>
				<label class="radio-inline">
				<input type="radio" name="Auswahl_Umfragentyp" id="einmalig" value="einmalig" style="margin-top:10px;" oninput="hidenotificationoptionsdetails()" required>einmalig
				</label>
				<label class="radio-inline">
				<input type="radio" name="Auswahl_Umfragentyp" id="wiederkehrend" value="wiederkehrend" style="margin-top:10px;" oninput="notificationoptionsdetails()" required>wiederkehrend
				</label>
				<br>
				<br>
			<div id="Intervall" style="display:none">
				<p>Intervall für Teilnahme an der Umfrage:</p>
					<label class="radio-inline">
					<input type="radio" name="Benachrichtigungsintervall" id="1" value=1 style="margin-top:10px;" oninput="disablecustomintervall()">täglich
					</label>
					<label class="radio-inline">
					<input type="radio" name="Benachrichtigungsintervall" id="7" value=7 style="margin-top:10px;" oninput="disablecustomintervall()">wöchentlich
					</label>
					<label class="radio-inline">
					<input type="radio" name="Benachrichtigungsintervall" id="31" value=31 style="margin-top:10px;" oninput="disablecustomintervall()">monatlich
					</label>
					<label class="radio-inline">
					<input type="radio" name="Benachrichtigungsintervall" id="Benutzerdefiniert" value=0 style="margin-top:10px;" oninput="enablecustomintervall()">alle <input type="number" id="quantity" name="quantity" style="height:30px" min="1" max="365" disabled></input> Tage
					</label>
				<br>
				<br>
			</div>
			<p>Benachrichtigungen:</p>
			<?php
				include "toggle.php";
			?>
			<div id="Benachrichtigungsdetails" style="display:none">
				<p>Benutzer die benachrichtigt werden:
					<?php
						include "Auswahlmöglichkeiten_Benutzer.php";
					?>
				</p>
				<p>Nächste Benachrichtigung am:
				<input type="datetime-local" id="UmfrageDatum" style="border-left:none; border-right:none; border-top:none; " name="UmfrageDatum"></input>
				</p>
			</div>
			<br>
			<button type="submit" name = "Submit" style="background-color:white; border-radius:10px; border:1px; margin-bottom:20px;margin-top:10px; font-size:16px;" ><i class="fa fa-save"></i> speichern</button>
		</form>
	</div>
</div>
	<script>
	const myDate = new Date();
	myDate.setHours( myDate.getHours() + 1 );
	myDate.setMinutes( myDate.getMinutes() + 1 );
	var today = myDate.toISOString().slice(0,16);
	document.getElementById("UmfrageDatum").min=today;

	$(document).ready(function(){
		$( ".interne_Fragen" ).sortable({
			placeholder : "ui-state-highlight",
			update  : function(event, ui)
			{	
				var post_order_ids = new Array();
				$('.interne_Fragen form').each(function(){
					post_order_ids.push($(this).data("post-id"));
				});
				$.ajax({
					url:"ajax_upload_intern.php",
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

	function disablecustomintervall(){
		var customInterval = document.getElementById("quantity");
		quantity.disabled = true;
		quantity.value = "";
	}

	function enablecustomintervall(){
		var customInterval = document.getElementById("quantity");
		quantity.disabled = false;
	}
	function shownotifications(){
		var Benachrichtigungsdetails = document.getElementById("Benachrichtigungsdetails");
		if(Benachrichtigungsdetails.style.display=="none"){
			notificationoptions();
		}
		else{
			hidenotificationoptions();
			var Umfragedatum = document.getElementById("UmfrageDatum");
			Umfragedatum.value="";
		}

	}

	function hidenotificationoptions(){
		var Benachrichtigungsdetails = document.getElementById("Benachrichtigungsdetails");
		Benachrichtigungsdetails.style.display="none";	
		var AuswahlBenutzer = document.getElementById("Auswahl_Trainer");
		AuswahlBenutzer.required=false;	
		var Umfragedatum = document.getElementById("UmfrageDatum");
		Umfragedatum.required=false;
	}

	function notificationoptions(){
		var Benachrichtigungsdetails = document.getElementById("Benachrichtigungsdetails");
		Benachrichtigungsdetails.style.display="block";
		var AuswahlBenutzer = document.getElementById("Auswahl_Trainer");
		AuswahlBenutzer.required=true;	
		var Umfragedatum = document.getElementById("UmfrageDatum");
		Umfragedatum.required=true;	
	}
	function hidenotificationoptionsdetails(){
		var Intervall = document.getElementById("Intervall");
		Intervall.style.display="none";
		var Intervalloptionen = document.getElementsByName("Benachrichtigungsintervall");
		for(var i = 0; i<Intervalloptionen.length; i++)
		{
			Intervalloptionen[i].required=false;	
		}
	}

	function notificationoptionsdetails(){
		var Intervall = document.getElementById("Intervall");
		Intervall.style.display="block";	
		var Intervalloptionen = document.getElementsByName("Benachrichtigungsintervall");
		for(var i = 0; i<Intervalloptionen.length; i++)
		{
			Intervalloptionen[i].required=true;	
		}
	}

	function user_abfrage_speichern_intern(id) {
		speichern_intern(id);
	;}
	function user_abfrage_löschen_intern(id) {
  	if (confirm("Wollen Sie diese Frage entfernen? Ihre bestehenden Antworten zu dieser Frage werden ebenfalls entfernt"))
	  {entfernen_intern(id);
		alert("Die Frage wurde gelöscht");
		location.reload();}
	;}
	var modal = document.getElementById("myModal");
	var neueUmfragemodal = document.getElementById("neueUmfrage");
	var neueUmfragemodalform = document.getElementById("neueUmfrageForm");
	var Bewertungoptionen = document.getElementById("Bewertungoptionen");
	var Multiplechoiceoptionen = document.getElementById("Multiplechoiceoptionen");
	var Rangeoptionen = document.getElementById("Rangeoptionen");
	var Modalform = document.getElementById("Modalform");
	var neueUmfrageform = document.getElementById("neueUmfrageForm");

	function addSpecificAnswer(Fragentyp, id){
		var Answer = document.getElementById(Fragentyp.value+"newanswer").value;
		var Type = document.getElementById("externinterntyp").value;
		console.log("Answer:"+Answer)
		console.log(Fragentyp.value)
		if (Fragentyp.value == "Bewertung")
		{
			var inputtext='<input type="hidden" value="'+Answer+'_unchecked" name="checkbox[]"><input type="checkbox" style="margin-left:0px;" id="'+Answer+'_'+Type+'_Bewertung" name="checkbox[]" value="'+Answer+'" onclick="return false" checked><label for="'+ Answer +'_extern_Bewertung" style="border:none;"> '+Answer+'</label><br>';
			Bewertungoptionen.innerHTML = Bewertungoptionen.innerHTML + inputtext; 
		}
		else if (Fragentyp.value == "Multiplechoice")
		{
			var inputtext='<input type="hidden" value="'+Answer+'_unchecked" name="checkbox[]"><input type="checkbox" style="margin-left:0px;" id="'+Answer+'_'+Type+'_Multiplechoice" name="checkbox[]" value="'+Answer+'" onclick="return false" checked readonly><label for="'+ Answer +'_extern_Multiplechoice" style="border:none;"> '+Answer+'</label><br>';
			Multiplechoiceoptionen.innerHTML = Multiplechoiceoptionen.innerHTML + inputtext;
		}
		//Wenn die Id nicht 0 ist also eine bestehende Frage bearbeitet wird dann schreib die neue Antwort in die Datenbank sofort wenn sie hinzugefügt wird
		if(id!=0 && id!=undefined)
		{
			var xmlhttp_options = new XMLHttpRequest();
			xmlhttp_options.onreadystatechange = function() 
			{
				console.log("Response:"+this.responseText);
			;};
			xmlhttp_options.open("GET", "insert_Specific_Answer.php?ID=" + id + "&Answer=" +Answer+"&Fragentyp="+Fragentyp.value+"&Externinterntyp="+Type, false);
			xmlhttp_options.send();
		}
	}

	function getCheckedAntworttyp(id, type){

		var xmlhttp_options = new XMLHttpRequest();
		var frage = document.getElementById("Frage");     
		xmlhttp_options.onreadystatechange = function() 
		{
			if (this.readyState == 4 && this.status == 200) {
				frage.value=this.responseText;
			}
		;};
		xmlhttp_options.open("GET", "Fragen_Beschreibung.php?ID=" + id + "&Type=" +type, false);
		xmlhttp_options.send();

		var vordefiniert = document.getElementById("vordefiniert"); 
		var fragenspezifisch = document.getElementById("fragenspezifisch"); 
		xmlhttp_options.onreadystatechange = function() {
			if (this.readyState == 4 && this.status == 200) {
				if(this.response!="fragenspezifisch")
				{
					vordefiniert.checked=true;
				}
				else
				{
					fragenspezifisch.checked=true;
				}
			}
		;};
		xmlhttp_options.open("GET", "Fragen_Check_Fragenspezifisch.php?ID=" + id + "&Type=" +type, false);
		xmlhttp_options.send();
	}

	function Rangesliderabfrage(id, type){
		var xmlhttp_options = new XMLHttpRequest();
		var Schieberoutput = document.getElementById("SchieberID");
		var xmlhttp_options = new XMLHttpRequest();
		var ID = id;
		xmlhttp_options.onreadystatechange = function() {
			if (this.readyState == 4 && this.status == 200) {
				Schieberoutput.innerHTML=Schieberoutput.innerHTML+this.responseText;
			}
		;};
		xmlhttp_options.open("GET", "intern_Rangeslider_Abfrage.php?ID=" + ID, true);
		xmlhttp_options.send();
	}

	function checkAnswerboxes(id, type, questiontype){
		console.log("ID:"+id)
		console.log("Fragentyp:"+questiontype)
		console.log("Typ:"+type)
		if(id!=0)
		{
			var fragenspezifisch = "false";
			if(document.getElementById("fragenspezifisch").checked == true){
				fragenspezifisch = "true";
			}
			var xmlhttp1 = new XMLHttpRequest();

			xmlhttp1.onreadystatechange = function() {
			if (this.readyState == 4 && this.status == 200) {
				var checked_sets = this.response.split(",");
				var i=0;
				while (i<checked_sets.length){
					var checkbox = document.getElementById(checked_sets[i]+'_'+type+"_"+questiontype);
					console.log("not checked"+checkbox);
					checkbox.checked=false;	
					i=i+1;		
				}
				var xmlhttp = new XMLHttpRequest();

				xmlhttp.onreadystatechange = function() {
					if (this.readyState == 4 && this.status == 200) {
						var checked_sets = this.response.split(",");
						var i=0;
						while (i<checked_sets.length){
							var checkbox = document.getElementById(checked_sets[i]+'_'+type+"_"+questiontype);
							console.log("checked:"+checkbox);
							checkbox.checked=true;	
							i=i+1;		
						}
					}
				};
				xmlhttp.open("GET", "Fragen_get_Antwortenset_checked_"+type+".php?ID=" + id + "&Type="+questiontype, false);
				xmlhttp.send();
			}
			};
			xmlhttp1.open("GET", "Fragen_get_Antwortenset.php?ID=" + id  + "&Type="+questiontype+"&fragenspezifisch="+fragenspezifisch, false);
			xmlhttp1.send();
		}
	}

	function getFragenBeschreibung(id, type){
		var xmlhttp_options = new XMLHttpRequest();
		var frage = document.getElementById("Frage");     
				xmlhttp_options.onreadystatechange = function() {
					if (this.readyState == 4 && this.status == 200) {
						frage.value=this.responseText;
					}
				;};
				xmlhttp_options.open("GET", "Fragen_Beschreibung.php?ID=" + id + "&Type=" +type, false);
				xmlhttp_options.send();
	}

	function getFragenspezifischeAntworten(id, questiontype, type){
		if(id!=0)
		{
			var Modalform = document.getElementById("Modalform");
			var fragenspezifisch = document.getElementById("fragenspezifisch");
			
			document.getElementById(questiontype).checked=true;
			Modalform.action = "Fragen_relate_antworten.php?Id="+id+"&Type="+type+"&Questiontype="+questiontype;
			if(fragenspezifisch.checked == true)
			{
				var xmlhttp_options = new XMLHttpRequest();
				xmlhttp_options.onreadystatechange = function() {
					if (this.readyState == 4 && this.status == 200) {
						if(questiontype=="Bewertung"){
							Bewertungoptionen.innerHTML=this.responseText;
						}
						if(questiontype=="Multiplechoice"){
							Multiplechoiceoptionen.innerHTML=this.responseText;
						}
					}
				;};
				xmlhttp_options.open("GET", "Fragenspezifische_Antworten.php?ID=" + id + "&Fragentyp="+questiontype+"&Typ="+type, false);
				xmlhttp_options.send();					
			}
			else{
				if(questiontype=="Bewertung"){
					Bewertungoptionen.innerHTML='<h5>Wähle deine Antworten zur ausgewählten Frage:</h5>\
					<?php $sql = "SELECT Answers FROM bewertung_answers WHERE Fragenspezifisch = 0 ORDER BY post_order_no ASC"; $result = mysqli_query($link,$sql);while($row = mysqli_fetch_assoc($result)){echo'<input type="hidden" value="'.$row["Answers"].'_unchecked" name="checkbox[]"><input type="checkbox" style="margin-left:0px;" id="'.$row["Answers"].'_intern_Bewertung" name="checkbox[]" value="'.$row["Answers"].'"><label for="'.$row["Answers"].'_intern_Bewertung" style="border:none"> '.$row["Answers"].'</label><br>';}?>';
				}
				else{
					Multiplechoiceoptionen.innerHTML='<h5>Wähle deine Antworten zur ausgewählten Frage:</h5>\
					<?php $sql = "SELECT Answers FROM multiplechoice_answers WHERE Fragenspezifisch = 0 ORDER BY post_order_no ASC"; $result = mysqli_query($link,$sql);while($row = mysqli_fetch_assoc($result)){echo'<input type="hidden" value="'.$row["Answers"].'_unchecked" name="checkbox[]"><input type="checkbox" style="margin-left:0px;" id="'.$row["Answers"].'_intern_Multiplechoice" name="checkbox[]" value="'.$row["Answers"].'"><label for="'.$row["Answers"].'_intern_Multiplechoice" style="border:none"> '.$row["Answers"].'</label><br>';}?>';
				}		
			}
		}
		else{
			if(questiontype=="Bewertung")
			{
				Bewertungoptionen.innerHTML='<h5>Erstelle eine neue Antwort für diese Frage:</h5>\
				<input style="margin-left:0px; width:60%; min-width:220px;" id="'+questiontype+'newanswer" name="newanswer"></input>\
				<input type="button" onclick="addSpecificAnswer('+questiontype+')" value="hinzufügen"></input><br>\
				<h5>Wähle Antworten für diese Frage:</h5>';
			}
			if(questiontype=="Multiplechoice")
			{
				Multiplechoiceoptionen.innerHTML='<h5>Erstelle eine neue Antwort für diese Frage:</h5>\
				<input style="margin-left:0px; width:60%; min-width:220px;" id="'+questiontype+'newanswer" name="newanswer"></input>\
				<input type="button" onclick="addSpecificAnswer('+questiontype+')" value="hinzufügen"></input><br>\
				<h5>Wähle Antworten für diese Frage:</h5>';
			}
		}
	}

	function getUmfrageBeschreibung(id){
		var xmlhttp_options = new XMLHttpRequest();
		var UmfrageBeschreibung = document.getElementById("Umfrage");
		xmlhttp_options.onreadystatechange = function() {
			if (this.readyState == 4 && this.status == 200) {
				UmfrageBeschreibung.value=this.responseText.slice(0,-2);
			}
		;};
		xmlhttp_options.open("GET", "getUmfrageBeschreibung.php?ID=" + id, true);
		xmlhttp_options.send();
	}

	function resetBeschreibung(){
		var UmfrageBeschreibung = document.getElementById("Umfrage");
		UmfrageBeschreibung.value="";
	}

	function getBenachrichtigung(id){
		var xmlhttp_options = new XMLHttpRequest();
		xmlhttp_options.onreadystatechange = function() {
			if (this.readyState == 4 && this.status == 200) {
				var Benachrichtigung = document.getElementById(this.responseText.slice(0,-2));
				Benachrichtigung.checked=true;
			}
		;};
		xmlhttp_options.open("GET", "getBenachrichtigung.php?ID=" + id, false);
		xmlhttp_options.send();
	}

	function getIntervall(id){
		var xmlhttp_options = new XMLHttpRequest();
		xmlhttp_options.onreadystatechange = function() {
			if (this.readyState == 4 && this.status == 200) {
				console.log("Test:"+this.responseText.slice(0,-2))
				if(this.responseText.slice(0,-2) == "1"|| this.responseText.slice(0,-2) == "7"|| this.responseText.slice(0,-2) == "31")
				{
					var Intervall = document.getElementById(this.responseText.slice(0,-2));
					Intervall.checked=true;
				}
				else{
					if(this.responseText.slice(0,-2) != "0")
					{
						console.log("Test:"+this.responseText.slice(0,-2))
						var Intervall = document.getElementById("Benutzerdefiniert");
						Intervall.checked=true;
						var Quantity = document.getElementById("quantity");
						quantity.value=this.responseText.slice(0,-2);
						quantity.disabled=false;
					}
				}
			}
		;};
		xmlhttp_options.open("GET", "getIntervall.php?ID=" + id, true);
		xmlhttp_options.send();
	}
	
	function resetIntervall(){
		var xmlhttp_options = new XMLHttpRequest();
		xmlhttp_options.onreadystatechange = function() {
			if (this.readyState == 4 && this.status == 200) {
				var Intervall = document.getElementById("Benachrichtigungsintervall");
				Intervall.checked=true;
			}
		;};
		xmlhttp_options.open("GET", "getIntervall.php?ID=" + id, true);
		xmlhttp_options.send();
	}
	
	function getBenutzer(id){
		var u = 0;
		var selectbox=document.getElementsByClassName("multiselect-selected-text")[0];
		var selectbutton=document.getElementsByClassName("multiselect dropdown-toggle btn btn-default")[0];

		var checkboxes = document.querySelectorAll('input[type="checkbox"]');
		var xmlhttp_options = new XMLHttpRequest();
		xmlhttp_options.onreadystatechange = function() {
			if (this.readyState == 4 && this.status == 200) {
				console.log(this.responseText)
				for (var i = 0; i < checkboxes.length; i++) {
					if(checkboxes[i].value!="toggle")
					{
						if(checkboxes[i].value!="multiselect-all")
						{
							document.getElementById(checkboxes[i].value).selected=false
						}
							checkboxes[i].checked = false;
							var listitem = checkboxes[i].closest("li");
							listitem.className = "false";
						

						if(this.responseText.includes("|"+checkboxes[i].value+"|"))
						{
							console.log(checkboxes[i].value)
							document.getElementById(checkboxes[i].value).selected=true
							checkboxes[i].checked = true;
							var listitem = checkboxes[i].closest("li");
							listitem.className = "active";
							u=u+1;
							selectbox.innerHTML = u+" Benutzer gewählt";
						}
					}
				}
				selectbox.style.fontSize="15px";
				selectbutton.style.border="none";
				selectbutton.style.overflow="hidden";
				selectbutton.style.maxWidth="300px";

			}
		;};
		xmlhttp_options.open("GET", "getBenutzer.php?ID=" + id, true);
		xmlhttp_options.send();
		
	}

	function resetRadio()
	{
		var selectbox=document.getElementsByClassName("multiselect-selected-text")[0];
		var selectbutton=document.getElementsByClassName("multiselect dropdown-toggle btn btn-default")[0];

		selectbox.style.fontSize="15px";
		selectbutton.style.border="none";
		selectbutton.style.overflow="hidden";
		selectbutton.style.maxWidth="300px";
		selectbox.innerHTML = "kein Benutzer gewählt";
		var checkboxes = document.querySelectorAll('input[type="checkbox"]');
		var radio = document.querySelectorAll('input[type="radio"]');

		for (var i = 0; i < checkboxes.length; i++) {
			if(checkboxes[i].value!="toggle")
			{
				if(checkboxes[i].value!="multiselect-all")
				{
					document.getElementById(checkboxes[i].value).selected=false
				}
				checkboxes[i].checked = false;
				var listitem = checkboxes[i].closest("li");
				listitem.className = "false";
			}
		}

		for (var i = 0; i < radio.length; i++) {
			radio[i].checked = false;
		}
	}

	function getUmfrageDatum(id){
		var UmfrageDatum = document.getElementById('UmfrageDatum');
		var xmlhttp_options = new XMLHttpRequest();
		xmlhttp_options.onreadystatechange = function() {
			if (this.readyState == 4 && this.status == 200) {
				var UmfrageDatum = document.getElementById('UmfrageDatum');
				UmfrageDatum.value = this.responseText.replace(" ", "T").slice(0,-2);
			;}
		;};
		xmlhttp_options.open("GET", "getUmfrageDatum.php?ID=" + id, false);
		xmlhttp_options.send();
	}

	function resetUmfrageDatum(){
		document.getElementById('UmfrageDatum').value = "";
		var UmfrageDatum = document.getElementById('UmfrageDatum');
	}

	function showNewUmfrageModal(){
		document.getElementById("ÜberschriftUmfrage").innerHTML = "Neue Umfrage hinzufügen";
		document.getElementById("Benachrichtigungsdetails").style.display="none";
		neueUmfragemodal.style.display="block";
		neueUmfragemodalform.action = "insert_Umfrage.php<?php 
	if(isset($_REQUEST["Step"]))
		{
			$Step = $_REQUEST["Step"];
			echo"?Step=".$Step;
		} ?>";
		var Toggle = document.getElementById("toggle");
		Toggle.checked=false;
		resetRadio();
		resetBeschreibung();
		resetUmfrageDatum();
		hidenotificationoptionsdetails();
		hidenotificationoptions();
	}

	function showUmfrage(id){
		document.getElementById("ÜberschriftUmfrage").innerHTML = "Umfrage bearbeiten";
		resetRadio();
		neueUmfragemodal.style.display="block";
		neueUmfragemodalform.action = "update_Umfrage.php?Id="+id;
		getUmfrageBeschreibung(id);
		getBenachrichtigung(id);
		getIntervall(id);
		getBenutzer(id);
		getUmfrageDatum(id);
		var AuswahlUmfragentyp = document.getElementsByName("Auswahl_Umfragentyp");
		var AuswahlUmfragentyp_value;
		for(var i = 0; i < AuswahlUmfragentyp.length; i++){
			if(AuswahlUmfragentyp[i].checked){
				AuswahlUmfragentyp_value = AuswahlUmfragentyp[i].value;
			}
		}
		var Intervall = document.getElementById("Intervall");
		var Benachrichtigungsdetails = document.getElementById("Benachrichtigungsdetails");
		var Toggle = document.getElementById("toggle");
		Toggle.checked=false;
		hidenotificationoptions();
		hidenotificationoptionsdetails();
		var UmfrageDatum = document.getElementById('UmfrageDatum').value;
		console.log("UmfrageDatum:"+UmfrageDatum)
		if(UmfrageDatum != "")
		{
			Toggle.checked=true;
			notificationoptions();
	
		}
		if(AuswahlUmfragentyp_value=="wiederkehrend")
		{
			notificationoptionsdetails();	
		}
	}

	function display(id, type, questiontype, umfragenid) 
	{	
		document.getElementById('Umfragenid').value = umfragenid;
		document.getElementById('alert').style.display='none';
		document.getElementById("externinterntyp").value=type;

		if (questiontype == "Bewertung" || questiontype == "Multiplechoice")
		{
			document.getElementById('Antworttyp_container').style.display="block";
		}
		else{
			document.getElementById('Antworttyp_container').style.display="none";	
		}
		if(id && id!=0)
		{
			document.getElementById("Fragenid").value = id;
			document.getElementById("Bewertung").disabled=true;
			document.getElementById("Multiplechoice").disabled=true;
			document.getElementById("Schieberegler").disabled=true;
			document.getElementById("Text").disabled=true;
			document.getElementById(questiontype).disabled=false;
			modal.style.display = "block";

			getFragenBeschreibung(id,type);
			getCheckedAntworttyp(id, type);

			if(type=='intern')
			{
				if(questiontype=="Bewertung")
				{
					getFragenspezifischeAntworten(id, questiontype, type);
					Bewertungoptionen.style.display="block";
					Multiplechoiceoptionen.style.display="none";
					Rangeoptionen.style.display="none";		
				}
				else if(questiontype=="Multiplechoice")
				{	
					getFragenspezifischeAntworten(id, questiontype, type);
					Bewertungoptionen.style.display="none";
					Multiplechoiceoptionen.style.display="block";
					Rangeoptionen.style.display="none";	
				}

				if(questiontype=="Schieberegler")
				{
					document.getElementById("Schieberegler").checked=true;
					Rangeoptionen.innerHTML = '<h5>Wähle die Konfiguration des Schiebereglers:</h5><div style="grid-template-columns:2fr 2fr 2fr; display:grid"><label style="margin-bottom:0px">Minimum</label><label style="margin-bottom:0px">Maximum</label><label style="margin-bottom:0px"># Balken</label><div id="SchieberID" style="grid-template-columns:2fr 2fr 2fr; grid-column-start: 1; grid-column-end: -1;display:grid"></div></div>';
					var ID = id;
					Bewertungoptionen.style.display="none";
					Multiplechoiceoptionen.style.display="none";
					Rangeoptionen.style.display="block";
				}
				else if(questiontype=="Text")
				{	
					Modalform.action="Fragen_relate_antworten.php?Id="+id+"&Type=intern&Questiontype=Text";
					Bewertungoptionen.innerHTML='';	
					Bewertungoptionen.style.display="none";
					Multiplechoiceoptionen.style.display="none";
					Rangeoptionen.style.display="none";			
				}	
			}
			else{
				if(questiontype=="Bewertung")
				{
					modal.innerHTML = '<form class="modalform" action="Antwort_Uebersetzung_save.php?Type=answers&Questiontype=Bewertung" method="post"><input id="ID_answers_Bewertung" name="ID_answers_Bewertung" style="visibility:hidden"></input><div class="Kommentare" style="margin:auto; text-align:left"><span class="close" onclick="hide_modal();">&times;</span><div name="uebersetzung"><h4>Übersetzung</h4><h5>Antwort: </h5><input class="center_select" id="englisch_answers_Bewertung" name ="englisch_answers_Bewertung" style="display:inline-block ;width:500px; max-width:80%; width:80%; height:30px;"></input></div><h4><button type="submit" name = "Submit" style="background-color:white; border-radius:10px; border:1px; margin-bottom:20px;margin-top:10px; font-size:16px;" ><i class="fa fa-save"></i> speichern</button></div></form>';
				}
				if(questiontype=="Multiplechoice")
				{
					modal.innerHTML = '<form class="modalform" action="Antwort_Uebersetzung_save.php?Type=answers&Questiontype=Multiplechoice" method="post"><input id="ID_answers_Multiplechoice" name="ID_answers_Multiplechoice" style="visibility:hidden"></input><div class="Kommentare" style="margin:auto; text-align:left"><span class="close" onclick="hide_modal();">&times;</span><div name="uebersetzung"><h4>Übersetzung</h4><h5>Antwort: </h5><input class="center_select" id="englisch_answers_Multiplechoice" name ="englisch_answers_Multiplechoice" style="display:inline-block ;width:500px; max-width:80%; width:80%; height:30px;"></input></div><h4><button type="submit" name = "Submit" style="background-color:white; border-radius:10px; border:1px; margin-bottom:20px;margin-top:10px; font-size:16px;" ><i class="fa fa-save"></i> speichern</button></div></form>';
				}
			}

			if(questiontype=="Schieberegler")
			{
				Rangesliderabfrage(id, type);	
			}	
			if (document.getElementById("fragenspezifisch").checked==false){
				checkAnswerboxes(id, type, questiontype);
			}		
		}
		else if(id==0)
		{
			modal.style.display ="block";
			document.getElementById('alert').style.display='block';
		}
		else{
			var Modalform = document.getElementById("Modalform");
			Modalform.action="Umfragen.php<?php 
			if(isset($_REQUEST["Step"]))
				{
					$Step = $_REQUEST["Step"];
					echo"?Step=".$Step;
				} ?>";
			document.getElementById("Bewertung").disabled=false;
			document.getElementById("Multiplechoice").disabled=false;
			document.getElementById("Schieberegler").disabled=false;
			document.getElementById("Text").disabled=false;
			document.getElementById("Bewertung").checked=false;
			document.getElementById("Multiplechoice").checked=false;
			document.getElementById("Schieberegler").checked=false;
			document.getElementById("Text").checked=false;
			document.getElementById("fragenspezifisch").checked=false;
			document.getElementById("vordefiniert").checked=false;
			document.getElementById("Bewertungoptionen").style.display="none";
			document.getElementById("Multiplechoiceoptionen").style.display="none";
			document.getElementById("Rangeoptionen").style.display="none";
			document.getElementById("Frage").value="";

			modal.style.display ="block";
			document.getElementById("Fragenid").value = 0;
		}
	}

	function showoptions()
	{
		var xmlhttp_options = new XMLHttpRequest();

		document.getElementById('alert').style.display='none';
		var externinterntyp = document.getElementById("externinterntyp").value

		var Modalform = document.getElementById("Modalform");
		var id = document.getElementById('Fragenid').value;
		var Fragentyp = document.getElementsByName('Auswahl_Fragentyp');
		var Fragentyp_value;
		for(var i = 0; i < Fragentyp.length; i++){
			if(Fragentyp[i].checked){
				Fragentyp_value = Fragentyp[i].value;
			}
		}
		var Antworttyp = document.getElementsByName('Auswahl_Antworttyp');
		var Antworttyp_value;
		for(var i = 0; i < Antworttyp.length; i++){
			if(Antworttyp[i].checked){
				Antworttyp_value = Antworttyp[i].value;
			}
		}
		if (Fragentyp_value == "Bewertung" || Fragentyp_value == "Multiplechoice")
		{
			document.getElementById('Antworttyp_container').style.display="block";
			document.getElementById('vordefiniert').required=true;
			document.getElementById('fragenspezifisch').required=true;
		}
		else{
			document.getElementById('Antworttyp_container').style.display="none";
			document.getElementById('vordefiniert').required=false;
			document.getElementById('fragenspezifisch').required=false;	
		}
		var Bewertungoptionen = document.getElementById("Bewertungoptionen");
		var Multiplechoiceoptionen = document.getElementById("Multiplechoiceoptionen");
		var Rangeoptionen = document.getElementById("Rangeoptionen");
		var Rangeoptionen_fragenspezifisch = document.getElementById("Rangeoptionen_fragenspezifisch");

		if(Antworttyp_value == "vordefiniert")
		{
			console.log("showoptions")
			Rangeoptionen_fragenspezifisch.style.display="none";
			if (Fragentyp_value == "Bewertung")
			{
				Bewertungoptionen.style.display="block";
				Multiplechoiceoptionen.style.display="none";
				Rangeoptionen.style.display="none";
				Bewertungoptionen.innerHTML = '<h5>Wähle deine Antworten zur ausgewählten Frage:</h5>\
				<?php $sql = "SELECT Answers FROM bewertung_answers WHERE Fragenspezifisch = 0 ORDER BY post_order_no ASC"; $result = mysqli_query($link,$sql);while($row = mysqli_fetch_assoc($result)){echo'<input type="hidden" value="'.$row["Answers"].'_unchecked" name="checkbox[]"><input type="checkbox" style="margin-left:0px;" id="'.$row["Answers"].'_extern_Bewertung" name="checkbox[]" value="'.$row["Answers"].'"><label for="'.$row["Answers"].'_extern_Bewertung" style="border:none;"> '.$row["Answers"].'</label><br>';}?>';
			}
			else if (Fragentyp_value == "Multiplechoice")
			{
				Bewertungoptionen.style.display="none";
				Multiplechoiceoptionen.style.display="block";
				Rangeoptionen.style.display="none";	
				Multiplechoiceoptionen.innerHTML='<h5>Wähle deine Antworten zur ausgewählten Frage:</h5>\
				<?php $sql = "SELECT Answers FROM multiplechoice_answers WHERE Fragenspezifisch = 0 ORDER BY post_order_no ASC"; $result = mysqli_query($link,$sql); while($row = mysqli_fetch_assoc($result)){echo'<input type="hidden" value="'.$row["Answers"].'_unchecked" name="checkbox[]"><input type="checkbox" style="margin-left:0px;" id="'.$row["Answers"].'_extern_Multiplechoice" name="checkbox[]" value="'.$row["Answers"].'"><label for="'.$row["Answers"].'_extern_Multiplechoice" style="border:none"> '.$row["Answers"].'</label><br>';}?>';
			}
			checkAnswerboxes(id, externinterntyp, Fragentyp_value);	
		}
		
		if(Antworttyp_value == "fragenspezifisch")
		{
			if (Fragentyp_value == "Bewertung")
			{
				getFragenspezifischeAntworten(id, Fragentyp_value, externinterntyp);
				Bewertungoptionen.style.display="block";
				Multiplechoiceoptionen.style.display="none";
				Rangeoptionen.style.display="none";	
			}

			else if (Fragentyp_value == "Multiplechoice")
			{
				getFragenspezifischeAntworten(id, Fragentyp_value, externinterntyp);
				Bewertungoptionen.style.display="none";
				Multiplechoiceoptionen.style.display="block";
				Rangeoptionen.style.display="none";	
			}
			Rangeoptionen.style.display="none";
			//!id = neue Frage
			if(!id)
			{
				Bewertungoptionen.innerHTML = '<?php $sql = "SELECT * FROM bewertung_answers WHERE Fragenspezifisch = 0 ORDER BY post_order_no ASC"; $result = mysqli_query($link,$sql);while($row = mysqli_fetch_assoc($result)){echo'<input type="hidden" value="'.$row["Answers"].'_unchecked" name="checkbox[]"><input type="checkbox" style="margin-left:0px;" id="'.$row["Answers"].'_extern_Bewertung" name="checkbox[]" value="'.$row["Answers"].'"><label for="'.$row["Answers"].'_extern_Bewertung" style="border:none;"> '.$row["Answers"].'</label><br>';}?>';
			}
		}


		if(Fragentyp_value=="Schieberegler")
			{
				Bewertungoptionen.style.display="none";
				Multiplechoiceoptionen.style.display="none";
				Rangeoptionen.style.display="block";
				document.getElementById("vordefiniert").checked=true;
				if(id==0)
				{
					Rangeoptionen.innerHTML = '<h5>Wähle die Konfiguration des Schiebereglers:</h5>\
					<div style="grid-template-columns:2fr 2fr 2fr; display:grid">\
						<label style="margin-bottom:0px">Minimum</label>\
						<label style="margin-bottom:0px">Maximum</label>\
						<label style="margin-bottom:0px"># Balken</label>\
						<div id="SchieberID" style="grid-template-columns:2fr 2fr 2fr; grid-column-start: 1; grid-column-end: -1;display:grid">\
						<input class="center-select" id="Range_Min" name="Range_Min" value="0" style="text-align:center; margin-auto"></input> \
						<input class="center-select" id="Range_Max" name="Range_Max" value="100" style="text-align:center; margin-auto"></input> \
						<input class="center-select" id="Columns" name="Columns" value="5" style="text-align:center; margin-auto"></input> \
						</div>\
					</div>';
					var ID = id;	
				}
			}
		else if(Fragentyp_value=="Text")
			{	
				Bewertungoptionen.style.display="none";
				Multiplechoiceoptionen.style.display="none";
				Rangeoptionen.style.display="none";	
			}	
	}

	// When the user clicks anywhere outside of the modal, close it

	function hide_modal(){
		var modal = document.getElementById("myModal");
		modal.style.display = "none";
	}

	function hide_newUmfragemodal()
	{
		neueUmfragemodal.style.display = "none";
	}

	window.onclick = function(event) {
	if (event.target == modal) {
		modal.style.display = "none";
	}
	}

	function Antwort_löschen(id,typ) {
  	if (confirm("Wollen Sie diese Antwort entfernen? Ihre bestehenden Daten zu dieser Antwort werden ebenfalls entfernt"))
	  {entfernen_antwort(id,typ);
		alert("Die Antwort wurde gelöscht");
		location.reload();}
	;}
	</script>
    <script src="Umfragenjs.js" type="text/javascript"></script>
    </body>
</html>
