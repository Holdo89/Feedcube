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
</style>
<script src="https://code.jquery.com/jquery-1.12.4.js"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<body class="text-center">
 <!-- Load an icon library to show a hamburger menu (bars) on small screens -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
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
		<h1 style="font-size:30px; margin-bottom:10px;">Feedbackfragen <i class="fa fa-question-circle-o" aria-hidden="true"></i> </h1>
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

	<p style="font-size:13pt; margin-bottom:20px; margin-top:30px;">Fragen an Kunden</p>
	<div id="externe_Fragen" class="scroll" style="padding:20px;">
	<form style="border-radius:5px 5px 0px 0px">
	<label class="überschrift"></label>
	<label class="überschrift">Kapitel</label>
	<label class="überschrift">Frage</label>
	<label class="überschrift">Typ</label>
	<label class="überschrift"></label>
	<label class="überschrift"></label>
	</form>
	
	<?php
		include "Fragen_Abfrage.php";
	?>
	
	<form style="margin-bottom:40px;" action="insert_fragen.php" method="post">
	<div class="überschrift" style="background-color:white;"></div>
	<input class="center_select" id="neues_Kapitel" name="neues_Kapitel" placeholder="Kapitel?"></input>
	<input class="center_select" id="neue_Frage"  name="neue_Frage" placeholder="Eingabe einer neuen Frage" required></input>
	<select class="center_select" id="Auswahl_Fragentyp" name="Auswahl_Fragentyp">
		<option value="Multiplechoice">Multiplechoice</option>
		<option value="Singlechoice">Singlechoice</option>
		<option value="Schieberegler">Schieberegler</option>
		<option value="Text">Text</option>
	</select>
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
	function Antwort_speichern(id) {
		speichern_antwort(id);
	;}

	function Antwort_löschen(id,typ) {
  	if (confirm("Wollen Sie diese Antwort entfernen? Ihre bestehenden Daten zu dieser Antwort werden ebenfalls entfernt"))
	  {entfernen_antwort(id,typ);
		alert("Die Antwort wurde gelöscht");
		location.reload();}
	;}
	</script>

	<input class="center_button" type="submit" value="+"></input>
	<div class="überschrift" style="background-color:white;"></div>
	</div>
	</form>
	<p style="font-size:13pt; margin-bottom:20px;">Fragen an Mitarbeiter</p>
	<div id="interne_Fragen" class="scroll" style="padding:20px;">
	<form class="form_intern" style="border-radius:5px 5px 0px 0px">
	<label class="überschrift"></label>
	<label class="überschrift">Frage</label>
	<label class="überschrift">Typ</label>
	<label class="überschrift"></label>
	<label class="überschrift"></label>
	</form>
	
	<?php
		include "interne_Fragen_Abfrage.php";
	?>
	
	<form class="form_intern" action="intern_insert_fragen.php" method="post" style="margin-bottom:30px">
	<div class="überschrift" style="background-color:white;"></div>
	<input id="neue_Frage" class="center_select" name="neue_Frage" placeholder="Eingabe einer neuen Frage" required></input>
	<select id="Auswahl_Fragentyp" class="center_select" name="Auswahl_Fragentyp">
		<option value="Multiplechoice">Multiplechoice</option>
		<option value="Singlechoice">Singlechoice</option>
		<option value="Schieberegler">Schieberegler</option>
		<option value="Text">Text</option>
	</select>
	<input class="center_button" type="submit" value="+"></input>
	<div class="überschrift" style="background-color:white;"></div>
	</form>
	</div>
	<p style="font-size:13pt; margin-bottom:20px;">Antwortmöglichkeiten</p>
	<form class="form_antworten" style="border-radius:5px 5px 0px 0px">
	<label class="überschrift">Singlechoice</label>
	<label class="überschrift"></label>
	</form>
	<div id="Antworten" class="scroll">
	<?php
		include "Antworten_Abfrage.php";
	?>
	</div>
	<form class="form_antworten" action="insert_antworten.php" method="post" style="margin-bottom:30px">
	<input id="neue_Antwort" class="center_select" name="neue_Antwort" placeholder="Eingabe einer neuen Antwort" style='text-align:center;margin:auto' required></input>
	<input class="center_button" type="submit" value="+"></input>
	</form>

	<form class="form_antworten" style="border-radius:5px 5px 0px 0px;">
	<label class="überschrift">Multiplechoice</label>
	<label class="überschrift"></label>
	</form>
	<div id="Antworten_Multiplechoice" class="scroll">
	<?php
		include "Antworten_Abfrage_Multiplechoice.php";
	?>
	</div>
	<form class="form_antworten" action="insert_antworten_multiplechoice.php" method="post" style="padding-bottom:80px">
	<input id="neue_Antwort" class="center_select" name="neue_Antwort" placeholder="Eingabe einer neuen Antwort" style='text-align:center;margin:auto' required></input>
	<input class="center_button" type="submit" value="+"></input>
	</form>
	<!-- The Modal -->
	<div id="myModal" class="modal">
	<form action="Fragen_relate_antworten.php?Type=extern&Questiontype=Singlechoice" method="post">
		<input id="ID_extern_Singlechoice" name="ID_extern_Singlechoice" style="visibility:hidden"></input>
		<div class="Kommentare" style="margin:auto; text-align:left">
		<span class="close">&times;</span>
		<h4>Wähle dein Fragenset zur ausgewählten Leistung:</h4>
		<?php
		$sql = "SELECT Answers FROM singlechoice_answers ORDER BY post_order_no ASC";
		$result = mysqli_query($link,$sql);
		while($row = mysqli_fetch_assoc($result)){
			echo'
			<input type="hidden" value="'.$row["Answers"].'_unchecked" name="checkbox[]">
			<input type="checkbox" id="'.$row["Answers"].'_extern_Singlechoice" name="checkbox[]" value="'.$row["Answers"].'">
			<label for="'.$row["Answers"].'_extern_Singlechoice" style="border:none"> '.$row["Answers"].'</label><br>';
		}
		?>
		<button type="submit" name = "Submit" style="background-color:white; border-radius:10px; border:1px; margin-bottom:20px;margin-top:10px; font-size:16px;" ><i class='fa fa-save'></i> speichern</button>
		</div>
	</form>
	</div>

	<!-- The Modal -->
	<div id="myModal_multi" class="modal">
	<form action="Fragen_relate_antworten.php?Type=extern&Questiontype=Multiplechoice" method="post">
		<input id="ID_extern_Multiplechoice" name="ID_extern_Multiplechoice" style="visibility:hidden"></input>
		<div class="Kommentare" style="margin:auto; text-align:left">
		<span class="close">&times;</span>
		<h4>Wähle dein Fragenset zur ausgewählten Leistung:</h4>
		<?php
		$sql = "SELECT Answers FROM multiplechoice_answers ORDER BY post_order_no ASC";
		$result = mysqli_query($link,$sql);
		while($row = mysqli_fetch_assoc($result)){
			echo'
			<input type="hidden" value="'.$row["Answers"].'_unchecked" name="checkbox[]">
			<input type="checkbox" id="'.$row["Answers"].'_extern_Multiplechoice" name="checkbox[]" value="'.$row["Answers"].'">
			<label for="'.$row["Answers"].'_extern_Multiplechoice" style="border:none"> '.$row["Answers"].'</label><br>';
		}
		?>
		<button type="submit" name = "Submit" style="background-color:white; border-radius:10px; border:1px; margin-bottom:20px;margin-top:10px; font-size:16px;" ><i class='fa fa-save'></i> speichern</button>
		</div>
	</form>
	</div>

	<div id="myModal_intern" class="modal">
	<form action="Fragen_relate_antworten.php?Type=intern&Questiontype=Singlechoice" method="post">
		<input id="ID_intern_Singlechoice" name="ID_intern_Singlechoice" style="visibility:hidden"></input>
		<div class="Kommentare" style="margin:auto; text-align:left">
		<span class="close">&times;</span>
		<h4>Wähle deine Antworten zur ausgewählten Frage:</h4>
		<?php
		$sql = "SELECT Answers FROM singlechoice_answers ORDER BY post_order_no ASC";
		$result = mysqli_query($link,$sql);
		while($row = mysqli_fetch_assoc($result)){
			echo'
			<input type="hidden" value="'.$row["Answers"].'_unchecked" name="checkbox[]">
			<input type="checkbox" id="'.$row["Answers"].'_intern_Singlechoice" name="checkbox[]" value="'.$row["Answers"].'">
			<label for="'.$row["Answers"].'_intern_Singlechoice" style="border:none"> '.$row["Answers"].'</label><br>';
		}
		?>
		<button type="submit" name = "Submit" style="background-color:white; border-radius:10px; border:1px; margin-bottom:20px;margin-top:10px; font-size:16px;" ><i class='fa fa-save'></i> speichern</button>
		</div>
	</form>
	</div>

	<div id="myModal_intern_multi" class="modal">
	<form action="Fragen_relate_antworten.php?Type=intern&Questiontype=Multiplechoice" method="post">
		<input id="ID_intern_Multiplechoice" name="ID_intern_Multiplechoice" style="visibility:hidden"></input>
		<div class="Kommentare" style="margin:auto; text-align:left">
		<span class="close">&times;</span>
		<h4>Wähle deine Antworten zur ausgewählten Frage:</h4>
		<?php
		$sql = "SELECT Answers FROM multiplechoice_answers ORDER BY post_order_no ASC";
		$result = mysqli_query($link,$sql);
		while($row = mysqli_fetch_assoc($result)){
			echo'
			<input type="hidden" value="'.$row["Answers"].'_unchecked" name="checkbox[]">
			<input type="checkbox" id="'.$row["Answers"].'_intern_Multiplechoice" name="checkbox[]" value="'.$row["Answers"].'">
			<label for="'.$row["Answers"].'_intern_Multiplechoice" style="border:none"> '.$row["Answers"].'</label><br>';
		}
		?>
		<button type="submit" name = "Submit" style="background-color:white; border-radius:10px; border:1px; margin-bottom:20px;margin-top:10px; font-size:16px;" ><i class='fa fa-save'></i> speichern</button>
		</div>
	</form>
	</div>

		<!-- The Modal -->
	<div id="myModal_schieber" class="modal">
	<form id="SchieberID" class="form_schieberegler_antworten" style="padding:30px;" action="Range_speichern.php" method="post">
	<input style="display:none;" id="ID_extern_Schieberegler" name="ID_extern_Schieberegler" ></input>	
	<h4 style="grid-column-start:1;grid-column-end:-2">Wähle die Konfiguration des Schiebereglers:</h4>
    <span class="close" onclick="hide();">&times;</span>
	<script>function hide() {
		document.getElementById("myModal_schieber").style.display="none";
		var Schieberoutput = document.getElementById("SchieberID");
		Schieberoutput.innerHTML='<input style="grid-column-start:1;grid-column-end:-1;display:none;" id="ID_extern_Schieberegler" name="ID_extern_Schieberegler" ></input>\
		<h4 style="grid-column-start:1;grid-column-end:-2">Wähle die Konfiguration des Schiebereglers:</h4>\
    	<span class="close" onclick="hide();">&times;</span>\
    	<label style="margin-bottom:0px">Minimum</label>\
    	<label style="margin-bottom:0px">Maximum</label>\
    	<label style="margin-bottom:0px"># Balken</label>';
	}
	</script>
    <label style="margin-bottom:0px">Minimum</label>
    <label style="margin-bottom:0px">Maximum</label>
    <label style="margin-bottom:0px"># Balken</label>
	</form>
	</div>

			<!-- The Modal -->
	<div id="myModal_schieber_intern" class="modal">
	<form id="SchieberID_intern" class="form_schieberegler_antworten" style="padding:30px;" action="intern_Range_speichern.php" method="post">
	<input style="display:none;" id="ID_intern_Schieberegler" name="ID_intern_Schieberegler" ></input>	
	<h4 style="grid-column-start:1;grid-column-end:-2">Wähle die Konfiguration des Schiebereglers:</h4>
    <span class="close" onclick="hide_intern();">&times;</span>
	<script>function hide_intern() {
		document.getElementById("myModal_schieber_intern").style.display="none";
		var Schieberoutput = document.getElementById("SchieberID_intern");
		Schieberoutput.innerHTML='<input style="grid-column-start:1;grid-column-end:-1;display:none;" id="ID_intern_Schieberegler" name="ID_intern_Schieberegler" ></input>\
		<h4 style="grid-column-start:1;grid-column-end:-2">Wähle die Konfiguration des Schiebereglers:</h4>\
    	<span class="close" onclick="hide_intern();">&times;</span>\
    	<label style="margin-bottom:0px">Minimum</label>\
    	<label style="margin-bottom:0px">Maximum</label>\
    	<label style="margin-bottom:0px"># Balken</label>';
	}
	</script>
    <label style="margin-bottom:0px">Minimum</label>
    <label style="margin-bottom:0px">Maximum</label>
    <label style="margin-bottom:0px"># Balken</label>
	</form>
	</div>

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
	var modal_multi = document.getElementById("myModal_multi");
	var modal_intern_multi = document.getElementById("myModal_intern_multi");
	var modal = document.getElementById("myModal");
	var modal_intern = document.getElementById("myModal_intern");
	var modal_schieber = document.getElementById("myModal_schieber");
	var modal_schieber_intern = document.getElementById("myModal_schieber_intern");
	function display(id, type, questiontype) {

		if(type=='intern')
		{
			if(questiontype=="Singlechoice")
			{
				modal_intern.style.display = "block";
			}
			if(questiontype=="Multiplechoice")
			{
  				modal_intern_multi.style.display = "block";
			}
			if(questiontype=="Schieberegler")
			{
  				modal_schieber_intern.style.display = "block";
			}	
		}
		else if(type=='extern')
		{
			if(questiontype=="Singlechoice")
			{
				modal.style.display = "block";
			}
			if(questiontype=="Multiplechoice")
			{
  				modal_multi.style.display = "block";
			}	
			if(questiontype=="Schieberegler")
			{
  				modal_schieber.style.display = "block";
			}		
		}
		var div_id=document.getElementById("ID_"+type+"_"+questiontype);
  		div_id.value=id;
		console.log(div_id.value);
		if(questiontype=="Schieberegler")
			{
				if(type=='extern')
				{
					var xmlhttp_options = new XMLHttpRequest();
					var ID = ID_extern_Schieberegler.value;
					var Schieberoutput = document.getElementById("SchieberID");
					console.log(ID);
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
					var Schieberoutput = document.getElementById("SchieberID_intern");
					console.log(ID);
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
	// Get the <span> element that closes the modal
	var span = document.getElementsByClassName("close")[0];
	var span_multi = document.getElementsByClassName("close")[1];
	var span_intern = document.getElementsByClassName("close")[2];
	var span_intern_multi = document.getElementsByClassName("close")[3];
	var span_schieber = document.getElementsByClassName("close")[4];

	// When the user clicks on <span> (x), close the modal
	span.onclick = function() {
  		modal.style.display = "none";
	}
	span_multi.onclick = function() {
		modal_multi.style.display = "none"; 
	}
	span_intern.onclick = function() {
  		modal_intern.style.display = "none";
	}
	span_intern_multi.onclick = function() {
		modal_intern_multi.style.display = "none"; 
	}
	span_schieber.onclick = function() {
		modal_schieber.style.display = "none"; 
	}

	// When the user clicks anywhere outside of the modal, close it
	window.onclick = function(event) {
	if (event.target == modal || event.target == modal_intern || event.target == modal_multi || event.target == modal_intern_multi || event.target == modal_schieber) {
		modal.style.display = "none";
		modal_intern.style.display = "none";
		modal_multi.style.display = "none";
		modal_intern_multi.style.display = "none";
		modal_schieber.style.display = "none"; 
		var Schieberoutput = document.getElementById("SchieberID");
		Schieberoutput.innerHTML='<input style="grid-column-start:1;grid-column-end:-1;display:none;" id="ID_extern_Schieberegler" name="ID_extern_Schieberegler" ></input>\
		<h4 style="grid-column-start:1;grid-column-end:-2">Wähle die Konfiguration des Schiebereglers:</h4>\
    	<span class="close">&times;</span>\
    	<label style="margin-bottom:0px">Minimum</label>\
    	<label style="margin-bottom:0px">Maximum</label>\
    	<label style="margin-bottom:0px"># Balken</label>';
	}
	}
	</script>
    </body>
</html>