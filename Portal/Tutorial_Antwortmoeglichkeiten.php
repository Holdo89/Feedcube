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
    <title>Feedback Auswertung</title>
	<link href="bootstrap.css" rel="stylesheet" type="text/css">
	<link href="charts.css" rel="stylesheet" type="text/css">
	<link href="Fragen.css" rel="stylesheet" type="text/css">
	<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.3/Chart.min.js"></script>
	
	<?php
	include "Frage_speichern.php";
	include "Tutorialstyle.php"
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
<body class="text-center">
 <!-- Load an icon library to show a hamburger menu (bars) on small screens -->
<script src="https://kit.fontawesome.com/662d1709e3.js" crossorigin="anonymous"></script>
<link href="navigation.css" rel="stylesheet" type="text/css">
<script type="text/javascript" src="navigation.js"></script>	
    <div class="header" style="padding-top:50px">
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
	<label class="überschrift">Singlechoice</label>
	<label class="überschrift"></label>
	<label class="überschrift"></label>
	</form>
	<div id="Antworten" class="scroll">
	<?php
		include "Antworten_Abfrage.php";
	?>
	</div>
	<form class="form_antworten" action="insert_antworten.php?Step=2" method="post" style="margin-bottom:30px">
	<input id="neue_Antwort" class="center_select" name="neue_Antwort" placeholder="Eingabe einer neuen Antwort" style='text-align:center;margin:auto' required></input>
	<input class="center_button" type="submit" value="+"></input>
	</form>

	<form class="form_antworten" style="border-radius:5px 5px 0px 0px;">
	<label class="überschrift">Multiplechoice</label>
	<label class="überschrift"></label>
	<label class="überschrift"></label>
	</form>
	<div id="Antworten_Multiplechoice" class="scroll">
	<?php
		include "Antworten_Abfrage_Multiplechoice.php";
	?>
	</div>
	<form class="form_antworten" action="insert_antworten_multiplechoice.php?Step=2" method="post" style="padding-bottom:80px">
	<input id="neue_Antwort" class="center_select" name="neue_Antwort" placeholder="Eingabe einer neuen Antwort" style='text-align:center;margin:auto' required></input>
	<input class="center_button" type="submit" value="+"></input>
	</form>

	<!-- The Modal -->
	<div id="myModal" class="modal">
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

	function display(id, type, questiontype) {
		if(type=='intern')
		{
			if(questiontype=="Singlechoice")
			{
				modal.innerHTML = '<form class="modalform" action="Fragen_relate_antworten.php?Type=intern&Questiontype=Singlechoice" method="post"><input id="ID_intern_Singlechoice" name="ID_intern_Singlechoice" style="visibility:hidden"></input><div class="Kommentare" style="margin:auto; text-align:left"><span class="close" onclick="hide_modal();">&times;</span><div name="uebersetzung"><h4>Übersetzung</h4><h5>Frage: </h5><input class="center_select" id="frage_englisch_intern_Singlechoice" name ="frage_englisch_intern_Singlechoice" style="display:inline-block ;width:500px; max-width:80%; height:30px;"></input></div><h4>Wähle deine Antworten zur ausgewählten Frage:</h4><?php $sql = "SELECT Answers FROM singlechoice_answers ORDER BY post_order_no ASC";$result = mysqli_query($link,$sql);while($row = mysqli_fetch_assoc($result)){echo'<input type="hidden" value="'.$row["Answers"].'_unchecked" name="checkbox[]"><input type="checkbox" style="margin-left:0px;" id="'.$row["Answers"].'_intern_Singlechoice" name="checkbox[]" value="'.$row["Answers"].'"><label for="'.$row["Answers"].'_intern_Singlechoice" style="border:none"> '.$row["Answers"].'</label><br>';}?><button type="submit" name = "Submit" style="background-color:white; border-radius:10px; border:1px; margin-bottom:20px;margin-top:10px; font-size:16px;" ><i class="fa fa-save"></i> speichern</button></div></form>';
			}
			if(questiontype=="Multiplechoice")
			{
  				modal.innerHTML = '<form class="modalform"action="Fragen_relate_antworten.php?Type=intern&Questiontype=Multiplechoice" method="post"><input id="ID_intern_Multiplechoice" name="ID_intern_Multiplechoice" style="visibility:hidden"></input><div class="Kommentare" style="margin:auto; text-align:left"><span class="close" onclick="hide_modal();">&times;</span><div name="uebersetzung"><h4>Übersetzung</h4><h5>Frage: </h5><input class="center_select" id="frage_englisch_intern_Multiplechoice" name ="frage_englisch_intern_Multiplechoice" style="display:inline-block ;width:500px; max-width:80%; height:30px;"></input></div><h4>Wähle deine Antworten zur ausgewählten Frage:</h4><?php $sql = "SELECT Answers FROM multiplechoice_answers ORDER BY post_order_no ASC";$result = mysqli_query($link,$sql);while($row = mysqli_fetch_assoc($result)){echo'<input type="hidden" value="'.$row["Answers"].'_unchecked" name="checkbox[]"><input type="checkbox" style="margin-left:0px;" id="'.$row["Answers"].'_intern_Multiplechoice" name="checkbox[]" value="'.$row["Answers"].'"><label for="'.$row["Answers"].'_intern_Multiplechoice" style="border:none"> '.$row["Answers"].'</label><br>';}?><button type="submit" name = "Submit" style="background-color:white; border-radius:10px; border:1px; margin-bottom:20px;margin-top:10px; font-size:16px;" ><i class="fa fa-save"></i> speichern</button></div></form>';
			}
			if(questiontype=="Schieberegler")
			{
				modal.innerHTML = '<form class="form_schieberegler_antworten" style="padding:30px;" action="Range_speichern.php?Type=intern&Questiontype=Schieberegler" method="post"><input style="display:none;" id="ID_intern_Schieberegler" name="ID_intern_Schieberegler" ></input><span class="close" style="grid-column-start:1;grid-column-end:-1; text-align:right" onclick="hide_modal();">&times;</span><div name="uebersetzung" style="grid-column-start:1;grid-column-end:-1;text-align:left"><h4>Übersetzung</h4><h5>Frage: </h5><input class="center_select" id="frage_englisch_intern_Schieberegler" name ="frage_englisch_intern_Schieberegler" style="display:inline-block ;width:500px; max-width:80%; height:30px;"><h4 style="grid-column-start:1;grid-column-end:-2">Wähle die Konfiguration des Schiebereglers:</h4></input></div><label style="margin-bottom:0px">Minimum</label><label style="margin-bottom:0px">Maximum</label><label style="margin-bottom:0px"># Balken</label><div id="SchieberID" style="grid-template-columns:2fr 2fr 2fr; grid-column-start: 1; grid-column-end: -1;display:grid"></div></form>';
				var ID = ID_intern_Schieberegler.value;
			}
			else if(questiontype=="Text")
			{	
				modal.innerHTML='<form class="modalform" action="Fragen_relate_antworten.php?Type=intern&Questiontype=Text" method="post"><input id="ID_intern_Text" name="ID_intern_Text" style="visibility:hidden"></input><div class="Kommentare" style="margin:auto; text-align:left"><span class="close" onclick="hide_modal();">&times;</span><div name="uebersetzung"><h4>Übersetzung</h4><h5>Kapitel: </h5><input class="center_select" id="kapitel_englisch_intern_Text" name ="kapitel_englisch_intern_Text" style="display:inline-block ;width:500px; max-width:80%; height:30px;"></input><h5>Frage: </h5><input class="center_select" id="frage_englisch_intern_Text" name ="frage_englisch_intern_Text" style="display:inline-block ;width:500px; max-width:80%; height:30px;"></input></div><button type="submit" name = "Submit" style="background-color:white; border-radius:10px; border:1px; margin-bottom:20px;margin-top:10px; font-size:16px;" ><i class="fa fa-save"></i> speichern</button></div></form>'
			}	
		}
		else if(type=='extern')
		{
			if(questiontype=="Singlechoice")
			{	
				modal.innerHTML='<form class="modalform" action="Fragen_relate_antworten.php?Type=extern&Questiontype=Singlechoice" method="post"><input id="ID_extern_Singlechoice" name="ID_extern_Singlechoice" style="visibility:hidden"></input><div class="Kommentare" style="margin:auto; text-align:left"><span class="close" onclick="hide_modal()">&times;</span><div name="uebersetzung"><h4>Übersetzung</h4><h5>Kapitel: </h5><input class="center_select" id="kapitel_englisch_extern_Singlechoice" name ="kapitel_englisch_extern_Singlechoice" style="display:inline-block ;width:500px; max-width:80%; height:30px;"></input><h5>Frage: </h5><input class="center_select" id="frage_englisch_extern_Singlechoice" name ="frage_englisch_extern_Singlechoice" style="display:inline-block ;width:500px; max-width:80%; height:30px;"></input></div><h4>Wähle deine Antworten zur ausgewählten Frage:</h4><?php $sql = "SELECT Answers FROM singlechoice_answers ORDER BY post_order_no ASC"; $result = mysqli_query($link,$sql);while($row = mysqli_fetch_assoc($result)){echo'<input type="hidden" value="'.$row["Answers"].'_unchecked" name="checkbox[]"><input type="checkbox" style="margin-left:0px;" id="'.$row["Answers"].'_extern_Singlechoice" name="checkbox[]" value="'.$row["Answers"].'"><label for="'.$row["Answers"].'_extern_Singlechoice" style="border:none"> '.$row["Answers"].'</label><br>';}?><button type="submit" name = "Submit" style="background-color:white; border-radius:10px; border:1px; margin-bottom:20px;margin-top:10px; font-size:16px;" ><i class="fa fa-save"></i> speichern</button></div></form>';
			}
			else if(questiontype=="Multiplechoice")
			{	
				modal.innerHTML='<form class="modalform" action="Fragen_relate_antworten.php?Type=extern&Questiontype=Multiplechoice" method="post"><input id="ID_extern_Multiplechoice" name="ID_extern_Multiplechoice" style="visibility:hidden"></input><div class="Kommentare" style="margin:auto; text-align:left"><span class="close" onclick="hide_modal();">&times;</span><div name="uebersetzung"><h4>Übersetzung</h4><h5>Kapitel: </h5><input class="center_select" id="kapitel_englisch_extern_Multiplechoice" name ="kapitel_englisch_extern_Multiplechoice" style="display:inline-block ;width:500px; max-width:80%; height:30px;"></input><h5>Frage: </h5><input class="center_select" id="frage_englisch_extern_Multiplechoice" name ="frage_englisch_extern_Multiplechoice" style="display:inline-block ;width:500px; max-width:80%; height:30px;"></input></div><h4>Wähle deine Antworten zur ausgewählten Frage:</h4><?php $sql = "SELECT Answers FROM multiplechoice_answers ORDER BY post_order_no ASC"; $result = mysqli_query($link,$sql); while($row = mysqli_fetch_assoc($result)){echo'<input type="hidden" value="'.$row["Answers"].'_unchecked" name="checkbox[]"><input type="checkbox" style="margin-left:0px;" id="'.$row["Answers"].'_extern_Multiplechoice" name="checkbox[]" value="'.$row["Answers"].'"><label for="'.$row["Answers"].'_extern_Multiplechoice" style="border:none"> '.$row["Answers"].'</label><br>';}?><button type="submit" name = "Submit" style="background-color:white; border-radius:10px; border:1px; margin-bottom:20px;margin-top:10px; font-size:16px;" ><i class="fa fa-save"></i> speichern</button></div></form>'
			}	
			else if(questiontype=="Schieberegler")
			{
  				modal.innerHTML = '<form class="form_schieberegler_antworten" style="padding:30px;" action="Range_speichern.php?Type=extern&Questiontype=Schieberegler" method="post"><input style="display:none;" id="ID_extern_Schieberegler" name="ID_extern_Schieberegler" ></input><span class="close" style="grid-column-start:1;grid-column-end:-1; text-align:right" onclick="hide_modal();">&times;</span><div name="uebersetzung" style="grid-column-start:1;grid-column-end:-1;text-align:left"><h4>Übersetzung</h4><h5>Kapitel: </h5><input class="center_select" id="kapitel_englisch_extern_Schieberegler" name ="kapitel_englisch_extern_Schieberegler" style="display:inline-block ;width:500px; max-width:80%; height:30px;"></input><h5>Frage: </h5><input class="center_select" id="frage_englisch_extern_Schieberegler" name ="frage_englisch_extern_Schieberegler" style="display:inline-block ;width:500px; max-width:80%; height:30px;"><h4 style="grid-column-start:1;grid-column-end:-2">Wähle die Konfiguration des Schiebereglers:</h4></input></div><label style="margin-bottom:0px">Minimum</label><label style="margin-bottom:0px">Maximum</label><label style="margin-bottom:0px"># Balken</label><div id="SchieberID" style="grid-template-columns:2fr 2fr 2fr; grid-column-start: 1; grid-column-end: -1;display:grid"></div></form>';
				var ID = ID_extern_Schieberegler.value;
			}
			else if(questiontype=="Text")
			{	
				modal.innerHTML='<form class="modalform" action="Fragen_relate_antworten.php?Type=extern&Questiontype=Text" method="post"><input id="ID_extern_Text" name="ID_extern_Text" style="visibility:hidden"></input><div class="Kommentare" style="margin:auto; text-align:left"><span class="close" onclick="hide_modal();">&times;</span><div name="uebersetzung"><h4>Übersetzung</h4><h5>Kapitel: </h5><input class="center_select" id="kapitel_englisch_extern_Text" name ="kapitel_englisch_extern_Text" style="display:inline-block ;width:500px; max-width:80%; height:30px;"></input><h5>Frage: </h5><input class="center_select" id="frage_englisch_extern_Text" name ="frage_englisch_extern_Text" style="display:inline-block ;width:500px; max-width:80%; height:30px;"></input></div><button type="submit" name = "Submit" style="background-color:white; border-radius:10px; border:1px; margin-bottom:20px;margin-top:10px; font-size:16px;" ><i class="fa fa-save"></i> speichern</button></div></form>'
			}			
		}
		else{
			if(questiontype=="Singlechoice")
			{
				modal.innerHTML = '<form class="modalform" action="Antwort_Uebersetzung_save.php?Step=2&Type=answers&Questiontype=Singlechoice" method="post"><input id="ID_answers_Singlechoice" name="ID_answers_Singlechoice" style="visibility:hidden"></input><div class="Kommentare" style="margin:auto; text-align:left"><span class="close" onclick="hide_modal();">&times;</span><div name="uebersetzung"><h4>Übersetzung</h4><h5>Antwort: </h5><input class="center_select" id="englisch_answers_Singlechoice" name ="englisch_answers_Singlechoice" style="display:inline-block ;width:500px; max-width:80%; width:80%; height:30px;"></input></div><h4><button type="submit" name = "Submit" style="background-color:white; border-radius:10px; border:1px; margin-bottom:20px;margin-top:10px; font-size:16px;" ><i class="fa fa-save"></i> speichern</button></div></form>';
			}
			if(questiontype=="Multiplechoice")
			{
  				modal.innerHTML = '<form class="modalform" action="Antwort_Uebersetzung_save.php?Step=2&Type=answers&Questiontype=Multiplechoice" method="post"><input id="ID_answers_Multiplechoice" name="ID_answers_Multiplechoice" style="visibility:hidden"></input><div class="Kommentare" style="margin:auto; text-align:left"><span class="close" onclick="hide_modal();">&times;</span><div name="uebersetzung"><h4>Übersetzung</h4><h5>Antwort: </h5><input class="center_select" id="englisch_answers_Multiplechoice" name ="englisch_answers_Multiplechoice" style="display:inline-block ;width:500px; max-width:80%; width:80%; height:30px;"></input></div><h4><button type="submit" name = "Submit" style="background-color:white; border-radius:10px; border:1px; margin-bottom:20px;margin-top:10px; font-size:16px;" ><i class="fa fa-save"></i> speichern</button></div></form>';
			}

		}
		modal.style.display = "block";
		var div_id=document.getElementById("ID_"+type+"_"+questiontype);
  		div_id.value=id;
		var xmlhttp_options = new XMLHttpRequest();

		if(type!="answers")
		{
			var frage_englisch = document.getElementById("frage_englisch_"+type+"_"+questiontype);     
			xmlhttp_options.onreadystatechange = function() {
				if (this.readyState == 4 && this.status == 200) {
					frage_englisch.value=this.responseText;
				}
			;};
			xmlhttp_options.open("GET", "Fragen_Uebersetzung.php?ID=" + id + "&Type=" +type, false);
			xmlhttp_options.send();
			if(type!="intern"){
				var kapitel_englisch = document.getElementById("kapitel_englisch_"+type+"_"+questiontype);            
				xmlhttp_options.onreadystatechange = function() {
					if (this.readyState == 4 && this.status == 200) {
						kapitel_englisch.value=this.responseText;
					}
				;};
				xmlhttp_options.open("GET", "Kapitel_Uebersetzung.php?ID=" + id, true);
				xmlhttp_options.send();
			}
			if(questiontype=="Schieberegler")
				{
					var Schieberoutput = document.getElementById("SchieberID");
					if(type=='extern')
					{
						var xmlhttp_options = new XMLHttpRequest();
						var ID = ID_extern_Schieberegler.value;
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
						var ID = ID_intern_Schieberegler.value;
						xmlhttp_options.onreadystatechange = function() {
							if (this.readyState == 4 && this.status == 200) {
								Schieberoutput.innerHTML=Schieberoutput.innerHTML+this.responseText;
							}
						;};
						xmlhttp_options.open("GET", "intern_Rangeslider_Abfrage.php?ID=" + ID, true);
						xmlhttp_options.send();
					}
				}	
			else{
			var xmlhttp1 = new XMLHttpRequest();

			xmlhttp1.onreadystatechange = function() {

			if (this.readyState == 4 && this.status == 200) {
				var checked_sets = this.response.split(",");
				var i=0;
				while (i<checked_sets.length){
					var checkbox = document.getElementById(checked_sets[i]+'_'+type+"_"+questiontype);
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
						checkbox.checked=true;	
						i=i+1;		
					}
				}
				};
				xmlhttp.open("GET", "Fragen_get_Antwortenset_checked_"+type+".php?ID=" + id + "&Type="+questiontype, false);
				xmlhttp.send();
			}
			};
			xmlhttp1.open("GET", "Fragen_get_Antwortenset.php?ID=" + id  + "&Type="+questiontype, false);
			xmlhttp1.send();

		}
	}
	else
	{
			var antwort_englisch = document.getElementById("englisch_"+type+"_"+questiontype);     
			xmlhttp_options.onreadystatechange = function() {
				if (this.readyState == 4 && this.status == 200) {
					antwort_englisch.value=this.responseText;
				}
			;};
			xmlhttp_options.open("GET", "Antwort_Uebersetzung.php?ID=" + id+"&Questiontype="+questiontype, false);
			xmlhttp_options.send();
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
<div id="AntwortenInfo_Modal" class="modal" style="display:none;">
	<form class= "modalform" style="grid-template-columns: auto" action"#" onsubmit="hideinformation(); return false" method="post">
	    <div></div>
		<span class="close" onclick="hideinformationWithoutremembering()" style="float:right; text-align:right">&times;</span>
		<div>		
		<h4 style="font-size:30px; margin-bottom:10px;">Schritt 2: <img src="../assets/brand/check-mark.png" width="60"> Antworten </h4>
		<p style="text-align:left">
		    Antworten werden von Fragen abgekoppelt behandelt, wodurch eine Wiederverwendbarkeit für mehrere Fragen erleichtert wird. Antwortmöglichkeiten werden in 2 verschiedene Arten kategorisiert:    
        </p>
        <p style="text-align:left">
        <b>Singlechoice</b> - Antworten bei denen genau eine Option gewählt wird. Beispiel dafür: </p>
			<label class="radio-inline">
			<input type="radio" name="optradio">Option 1
			</label>
			<label class="radio-inline">
			<input type="radio" name="optradio">Option 2
			</label>
			<label class="radio-inline">
			<input type="radio" name="optradio">Option 3
			</label>
		<br><br>
  		<p style="text-align:left">
        <b>Multiplechoice</b> - Antworten bei denen mehrere oder keine Option gewählt wird. Beispiel dafür</p>
			<label class="checkbox-inline">
			<input type="checkbox" name="optradio">Option 1
			</label>
			<label class="checkbox-inline">
			<input type="checkbox" name="optradio">Option 2
			</label>
			<label class="checkbox-inline">
			<input type="checkbox" name="optradio">Option 3
			</label>
		<br><br>
		<p style="text-align:left">
        Um eine Übersetzung zu denen einzelnen Antworten einzutragen klicke <i class="fa fa-pencil" aria-hidden="true"></i>.     
		</p>
		    <button id="element" style="font-size:13px; margin-top:20px; width:170px; padding:10px;"><i class="fa fa-check" aria-hidden="true" style="font-size:13px"></i> Alles klar</button>
		</div>

	</form>
	
	</div>
    
	<div class="content">
	        <button id="element2" onclick = "zurück()">zurück</button>
            <button id="element" onclick = "weiter()">weiter</button>
    </div>

    <script src="Cookiefunctions.js" type="text/javascript"></script>

    <script>
        checkCookie("AntwortenInformationChecked", "AntwortenInfo_Modal")

        function weiter() {
            window.location.href = "Tutorial_Fragen.php?Step=3";
        }

        function zurück() {
            window.location.href = "Tutorial_Fragen.php";
        }

        function hideinformation(){
            document.getElementById("AntwortenInfo_Modal").style.display="none"
            document.cookie = "AntwortenInformationChecked=1";
        }

        function hideinformationWithoutremembering(){
            document.getElementById("AntwortenInfo_Modal").style.display="none"
        }
    </script>
    </body>
</html>