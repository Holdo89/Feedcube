<!DOCTYPE HTML>
<html>
<?php
 require_once "FEEDCUBE_icon.php"
?><head>
    <meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Feedback Auswertung</title>
	<link href="bootstrap.css" rel="stylesheet" type="text/css">
	<link href="charts.css" rel="stylesheet" type="text/css">
	<link href="Fragen.css" rel="stylesheet" type="text/css">
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
  margin-right:50px;
  font-size: 28px;
  font-weight: bold;
}

.close:hover,
.close:focus {
  color: #000;
  text-decoration: none;
  cursor: pointer;
}

#externe_Fragen form.ui-state-highlight {
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

#Antworten form.ui-state-highlight {
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
</style>
<script src="https://code.jquery.com/jquery-1.12.4.js"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<body class="text-center">
 <!-- Load an icon library to show a hamburger menu (bars) on small screens -->
<script src="https://kit.fontawesome.com/662d1709e3.js" crossorigin="anonymous"></script>
<link href="navigation.css" rel="stylesheet" type="text/css">

<script type="text/javascript" src="navigation.js"></script>	
    <div class="header">
	<?php
	include "navigation_admin.php";	
?>
<script>
	document.getElementById("Fragen").className = "active";
	document.getElementById("optionen").style.backgroundColor = "lightgrey";
</script>
		<h1 style="font-size:30px; margin-bottom:10px;"><img src="../assets/brand/questionmark.png" width="60" style="margin-top:-10px;"> Fragen </h1>
		Hier kannst du Fragen, die beim Feedback gestellt werden, bearbeiten
	</div>
	<style>
	.überschrift{
		background-color: <?php $sql='SELECT farbe FROM system'; $exec=mysqli_query($link,$sql); $result=mysqli_fetch_assoc($exec); echo $result['farbe']?>;
	}
	</style>
	<div class="alert icon-alert with-arrow alert-success form-alter" role="alert" style="display:none;">
		<i class="fa fa-fw fa-check-circle"></i>
		<strong> Success ! </strong> <span class="success-message"> Die Reihenfolge der Fragen wurde erfolgreich bearbeitet </span>
	</div>
	<div class="alert icon-alert with-arrow alert-danger form-alter" role="alert" style="display:none;">
		<i class="fa fa-fw fa-times-circle"></i>
		<strong> Note !</strong> <span class="warning-message"> Eine leere Liste kann nicht sortiert werden </span>
	</div>
	<div id="range_alert" class="alert icon-alert with-arrow alert-danger form-alter" role="alert" style="display:none;">
		<i class="fa fa-fw fa-times-circle"></i>
		<strong> Note !</strong> <span class="warning-message"> Die angegebenen Werte waren nicht korrekt </span>
	</div>

	<p style="font-size:13pt; margin-bottom:10px; margin-top:50px;">Fragen an Kunden</p>
	<hr style='max-width:90vw; margin:auto;'>
	<form style="border-radius:5px 5px 0px 0px">
	<label class="überschrift"></label>
	<label class="überschrift">Kapitel</label>
	<label class="überschrift">Frage</label>
	<label class="überschrift">Typ</label>
	<label class="überschrift"></label>
	<label class="überschrift"></label>
	</form>
	<div id="externe_Fragen" class="scroll" style="padding:10px;">
	<?php
		//div externe_Fragen kennzeichnet den Bereich der per drag and drop verschoben werden kann
		include "Fragen_Abfrage.php";
	?>
	</div>
	<button id="element" onclick = "display(undefined,'extern')"><i class="fa fa-question" style="font-size:19px" aria-hidden="true"></i> Frage hinzufügen</button>

	<script>
	function user_abfrage_speichern(id) {
			speichern(id);
	;}
	function user_abfrage_löschen(id) {
  	if (confirm("Wollen Sie diese Frage entfernen? Ihre bestehenden Antworten zu dieser Frage werden ebenfalls entfernt"))
	  {entfernen(id);
		alert("Die Frage wurde gelöscht");
		location.reload();}
	;}
	function user_abfrage_speichern_intern(id) {
		speichern_intern(id);
	;}
	function user_abfrage_löschen_intern(id) {
  	if (confirm("Wollen Sie diese Frage entfernen? Ihre bestehenden Antworten zu dieser Frage werden ebenfalls entfernt"))
	  {entfernen_intern(id);
		alert("Die Frage wurde gelöscht");
		location.reload();}
	;}
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


	<!-- The Modal -->
	<div id="myModal" class="modal">
	<form class="modalform" id="Modalform" style="margin-bottom:40px; display:block; margin-top:-20px" action="<?php echo $_SERVER["PHP_SELF"]; ?>" method="post">
		<span class="close" style="text-align:right" onclick="hide_modal()">&times;</span>
		<div style="text-align:left">
		<h4>Neue Frage hinzufügen</h4>
		<hr style="margin-bottom:30px; margin-top:-5px;">
				<div id="Kapitel_Container">
					<h5>Kapitel: </h5>
					<input class="center_select" id="Kapitel" name="Kapitel" placeholder="Eingabe eines neuen Kapitels"></input>
					<h5 id="Kapitelübersetzung_Label">Kapitelübersetzung: </h5>
					<input class="center_select" id="Kapitel_Übersetzung" name ="Kapitel_Übersetzung" placeholder="Eingabe der Kapitelübersetzung"></input>
				</div>
				<br>
				<h5>Frage: </h5>
				<input class="center_select" id="Frage"  name="Frage" placeholder="Eingabe einer neuen Frage" required></input>
				<h5 id="Frageübersetzung_Label">Fragenübersetzung: </h5>
				<input class="center_select" id="Frage_Übersetzung" name ="Frage_Übersetzung" placeholder="Eingabe der Fragenübersetzung"></input>
				<br>
				<div class="container">
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
				</form>
	  </div>


	<script>
	
	$(document).ready(function(){
		$( "#externe_Fragen" ).sortable({
			placeholder : "ui-state-highlight",
			update  : function(event, ui)
			{	
				var post_order_ids = new Array();
				$('#externe_Fragen form').each(function(){
					post_order_ids.push($(this).data("post-id"));
				});
				$.ajax({
					url:"ajax_upload.php",
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
		$( "#interne_Fragen" ).sortable({
			placeholder : "ui-state-highlight",
			update  : function(event, ui)
			{	
				var post_order_ids = new Array();
				$('#interne_Fragen form').each(function(){
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
		$( "#Antworten" ).sortable({
			placeholder : "ui-state-highlight",
			update  : function(event, ui)
			{	
				var post_order_ids = new Array();
				$('#Antworten form').each(function(){
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
	var Bewertungoptionen = document.getElementById("Bewertungoptionen");
	var Multiplechoiceoptionen = document.getElementById("Multiplechoiceoptionen");
	var Rangeoptionen = document.getElementById("Rangeoptionen");
	var Modalform = document.getElementById("Modalform");

	function addSpecificAnswer(Fragentyp, id){
		console.log("ID="+id)
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

	function getFragenUebersetzung(id, type){
		var xmlhttp_options = new XMLHttpRequest();
		var frage_englisch = document.getElementById("Frage_Übersetzung");     
		xmlhttp_options.onreadystatechange = function() {
			if (this.readyState == 4 && this.status == 200) {
				frage_englisch.value=this.responseText;
			}
		;};
		xmlhttp_options.open("GET", "Fragen_Uebersetzung.php?ID=" + id + "&Type=" +type, false);
		xmlhttp_options.send();
	}

	function getKapitelUebersetzung(id){
		var xmlhttp_options = new XMLHttpRequest();
		var kapitel = document.getElementById("Kapitel");   
		xmlhttp_options.onreadystatechange = function() {
			if (this.readyState == 4 && this.status == 200) {
				kapitel.value=this.responseText;
			}
		;};
		xmlhttp_options.open("GET", "Kapitel_Beschreibung.php?ID=" + id, false);
		xmlhttp_options.send();

		var kapitel_englisch = document.getElementById("Kapitel_Übersetzung");            
		xmlhttp_options.onreadystatechange = function() {
			if (this.readyState == 4 && this.status == 200) {
				kapitel_englisch.value=this.responseText;
			}
		;};
		xmlhttp_options.open("GET", "Kapitel_Uebersetzung.php?ID=" + id, true);
		xmlhttp_options.send();
	}

	function Rangesliderabfrage(id, type){
		var xmlhttp_options = new XMLHttpRequest();
		var Schieberoutput = document.getElementById("SchieberID");
		if(type=='extern')
		{
			var xmlhttp_options = new XMLHttpRequest();
			var ID = id;
			xmlhttp_options.onreadystatechange = function() {
				if (this.readyState == 4 && this.status == 200) {
					Schieberoutput.innerHTML=Schieberoutput.innerHTML+this.responseText;
				}
			;};
			xmlhttp_options.open("GET", "Rangeslider_Abfrage.php?ID=" + ID, true);
			xmlhttp_options.send();
		}
		else if(type=='intern')
		{
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
		console.log("Typ="+type)
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
				if(type=="extern")
				{
					if(questiontype=="Bewertung"){
						Bewertungoptionen.innerHTML='<h5>Wähle deine Antworten zur ausgewählten Frage:</h5>\
						<?php $sql = "SELECT Answers FROM bewertung_answers WHERE Fragenspezifisch = 0 ORDER BY post_order_no ASC"; $result = mysqli_query($link,$sql);while($row = mysqli_fetch_assoc($result)){echo'<input type="hidden" value="'.$row["Answers"].'_unchecked" name="checkbox[]"><input type="checkbox" style="margin-left:0px;" id="'.$row["Answers"].'_extern_Bewertung" name="checkbox[]" value="'.$row["Answers"].'"><label for="'.$row["Answers"].'_extern_Bewertung" style="border:none"> '.$row["Answers"].'</label><br>';}?>';
					}
					else{
						Multiplechoiceoptionen.innerHTML='<h5>Wähle deine Antworten zur ausgewählten Frage:</h5>\
						<?php $sql = "SELECT Answers FROM multiplechoice_answers WHERE Fragenspezifisch = 0 ORDER BY post_order_no ASC"; $result = mysqli_query($link,$sql);while($row = mysqli_fetch_assoc($result)){echo'<input type="hidden" value="'.$row["Answers"].'_unchecked" name="checkbox[]"><input type="checkbox" style="margin-left:0px;" id="'.$row["Answers"].'_extern_Multiplechoice" name="checkbox[]" value="'.$row["Answers"].'"><label for="'.$row["Answers"].'_extern_Multiplechoice" style="border:none"> '.$row["Answers"].'</label><br>';}?>';
					}
				}
				if(type=="intern")
				{
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

	function display(id, type, questiontype) 
	{	
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
			getFragenUebersetzung(id, type);

			if(type=='intern')
			{
				document.getElementById("Kapitel_Container").style.display="none";
				document.getElementById("Frageübersetzung_Label").style.display="none";
				document.getElementById("Frage_Übersetzung").style.display="none";


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
			else if(type=='extern')
			{
				document.getElementById("Kapitel_Container").style.display="block";
				document.getElementById("Frageübersetzung_Label").style.display="block";
				document.getElementById("Frage_Übersetzung").style.display="block";

				getKapitelUebersetzung(id);

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
				else if(questiontype=="Schieberegler")
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
					document.getElementById("Text").checked=true;
					Modalform.action="Fragen_relate_antworten.php?Id="+id+"&Type=extern&Questiontype=Text";
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
				console.log("display");
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
			Modalform.action="Fragen.php";
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
			document.getElementById("Kapitel").value="";
			document.getElementById("Kapitel_Übersetzung").value="";
			document.getElementById("Frage").value="";
			document.getElementById("Frage_Übersetzung").value="";
			if(type=="intern")
			{
				document.getElementById("Kapitel_Container").style.display="none";
				document.getElementById("Frageübersetzung_Label").style.display="none";
				document.getElementById("Frage_Übersetzung").style.display="none";
			}
			else{
				document.getElementById("Kapitel_Container").style.display="block";
				document.getElementById("Frageübersetzung_Label").style.display="block";
				document.getElementById("Frage_Übersetzung").style.display="block";		
			}

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

	window.onclick = function(event) {
	if (event.target == modal) {
		modal.style.display = "none";
	}
	}
	</script>
    </body>
</html>