<!DOCTYPE HTML>
<html>
<?php
 require_once "FEEDCUBE_icon.php"
?><head>
    <meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Fragen</title>
	<link href="bootstrap.css?v=1" rel="stylesheet" type="text/css">
	<link href="charts.css?v=1" rel="stylesheet" type="text/css">
	<link href="Umfragen_Fragen.css?v=1" rel="stylesheet" type="text/css">
	<link href="tooltip.css?v=1" rel="stylesheet" type="text/css">
	<link href="Fragen.css?v=1" rel="stylesheet" type="text/css">
	<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.3/Chart.min.js"></script>
	<?php
    include "Frage_speichern.php";
?>
	<script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
	<script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/jqueryui/1.11.4/jquery-ui.min.js"></script>
	<script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/jqueryui-touch-punch/0.2.3/jquery.ui.touch-punch.min.js"></script>
	<script src = "https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
	<script src = "https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
	<script src = "https://cdnjs.cloudflare.com/ajax/libs/bootstrap-multiselect/0.9.15/js/bootstrap-multiselect.min.js"></script>
	<link rel = "stylesheet" href = "https://cdnjs.cloudflare.com/ajax/libs/bootstrap-multiselect/0.9.15/css/bootstrap-multiselect.css?v=1"/>

</head>

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
  background-color:<?php $sql='SELECT farbe FROM system';
  $exec=mysqli_query($link, $sql);
  $result=mysqli_fetch_assoc($exec);
  echo $result['farbe']?>
}
#element2{
  width:200px;
  position: relative;
  margin:auto;
  margin-left:30px;
  margin-right:30px;
  text-align:center;
  margin-top:25px;
  margin-bottom:30px; 
  cursor:pointer; 
  padding:10px; 
  font-size: 16px; 
  border-radius:30px; 
  background-color:white; 
  border-color:<?php $sql='SELECT farbe FROM system';
  $exec=mysqli_query($link, $sql);
  $result=mysqli_fetch_assoc($exec);
  echo $result['farbe']?>;
  color:<?php $sql='SELECT farbe FROM system';
  $exec=mysqli_query($link, $sql);
  $result=mysqli_fetch_assoc($exec);
  echo $result['farbe']?>
}
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
    text-align:center;
    margin:auto;
    max-width:100px; 
    padding:30px; 
    overflow:auto; 
    border-radius: 15px;
}

.center_button:hover .tooltiptext {
  visibility: visible;
}
</style>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui-touch-punch/0.2.3/jquery.ui.touch-punch.min.js"></script>
<script src="touchjquery.js?v=1"></script>
<body class="text-center" onload=SortiereFragen()>
 <!-- Load an icon library to show a hamburger menu (bars) on small screens -->
<script src="https://kit.fontawesome.com/9059ff5bc6.js" crossorigin="anonymous"></script>
<link href="navigation.css?v=1" rel="stylesheet" type="text/css">

<script type="text/javascript" src="navigation.js?v=1"></script>	
    <div class="header">
	<?php
include "navigation_admin.php";
?>
<script>
	document.getElementById("Fragen").className = "active";
</script>
		<h1 style="font-size:30px; margin-bottom:10px;"><img src="../assets/brand/questionmark.png" width="60" style="margin-top:-10px;"> Fragen </h1>
		Hier kannst du Fragen, die beim Feedback gestellt werden, bearbeiten
	</div>
	<style>
	.überschrift{
		background-color: <?php $sql='SELECT farbe FROM system';
		$exec=mysqli_query($link, $sql);
		$result=mysqli_fetch_assoc($exec);
		echo $result['farbe']?>;
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

	<p style="font-size:13pt; margin-bottom:10px; margin-top:50px;"></p>
	<style>
	.überschrift{
		background-color: <?php $sql='SELECT farbe FROM system';
		$exec=mysqli_query($link, $sql);
		$result=mysqli_fetch_assoc($exec);
		echo $result['farbe']?>;
	}
	</style>
	<div id="externe_Fragen" class="scroll">
	<form style=" border-radius:5px 5px 0px 0px;">
	<label style ="grid-column: 1 / span 5; padding-left:10px" class="überschrift">Überschrift</label>
	</form>
	<?php
        include "Überschrift_Abfrage.php";
?>
	</div>
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
	function user_abfrage_löschen_Überschrift(id) {
		var Anzahl = "";
    var xmlhttp_options = new XMLHttpRequest();
			var ID = id;
			xmlhttp_options.onreadystatechange = function() {
				if (this.readyState == 4 && this.status == 200) {
					Anzahl=this.responseText;
                    console.log(Anzahl)
				}
			;};
			xmlhttp_options.open("GET", "getAnzahlFragenInÜberschrift.php?ID=" + ID, false);
			xmlhttp_options.send();
	if(Anzahl!=0)
	{
		alert("Um die Überschrift zu löschen, verschiebe davor alle bestehenden Fragen zu einer anderen Überschrift")
	} 
	else{
		Überschrift_entfernen(id);
		location.reload();
	}
	}
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

	<div id="ÜberschriftModal" class="modal">
	<form class="modalform" id="ÜberschriftModalform" action="insert_Überschrift" method="post">
	<span class="close" style="text-align:right" onclick="hide_modal()">&times;</span>
	<div style="text-align:left">
		<h4 id="ÜberschriftÜberschrift" style="margin-bottom:30px;">Neue Überschrift hinzufügen</h4>
		<div id="Überschrift_Container">
			<h5>Überschrift: </h5>
			<input class="center_select" id="Überschrift" name="Überschrift" placeholder="Eingabe einer neuen Überschrift"></input>
			<h5>Englische Übersetzung: </h5>
			<input class="center_select" id="Überschrift_Übersetzung" name ="Überschrift_Übersetzung" placeholder="Eingabe der Übersetzung"></input>
		</div>
		<button id="element" type="submit" name = "Submit" style="margin-bottom:20px;margin-top:10px; font-size:16px;" ><i class="fa fa-save"></i> speichern</button>
	  </div>
	  </form>
	  </div>
	



	<!-- The Modal -->
	<div id="myModal" class="modal">
	<form class="modalform" id="Modalform" action="
	<?php
echo $_SERVER["PHP_SELF"];
if (isset($_REQUEST["Step"])) {
    $Step = $_REQUEST["Step"];
    echo"?Step=".$Step;
} ?>" method="post">
		<span class="close" style="text-align:right" onclick="hide_modal()">&times;</span>
		<div style="text-align:left">
		<h4 id="FragenÜberschrift" style="margin-bottom:30px;">Neue Frage hinzufügen</h4>
				<div id="Überschrift_Container">
				<h5>Überschrift: </h5>
				<select class="center_select" id="Überschrift_Fragen" name="Überschrift">
				<?php
					$sql = "SELECT Überschrift FROM überschrift";
					$result = mysqli_query($link, $sql) ;
					while ($row = mysqli_fetch_assoc($result)) {
						echo'<option value="'.$row["Überschrift"].'">'.$row["Überschrift"].'</option>';
					}
				?>
				</select>
				</div>
				<br>
				<h5>Frage: </h5>
				<input class="center_select" id="Frage"  name="Frage" placeholder="Eingabe einer neuen Frage" required></input>
				<br>
				<h5 id="Frageübersetzung_Label">Fragenübersetzung: </h5>
				<input class="center_select" id="Frage_Übersetzung" name ="Frage_Übersetzung" placeholder="Eingabe der Fragenübersetzung"></input>
				<br>
				<br>
				<p>
					<?php
						include "Auswahlmöglichkeiten_Fragensets.php";
					?>
				</p>
				<br>
				<p>
					<?php
						include "Auswahlmöglichkeiten_LeistungenOhneFragenset.php";
					?>
				</p>
				<div class="container" style="margin-bottom:20px;">
				<h5>Fragentyp:</h5>
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
				<div id="Antworttyp_container" class="container" style="display:none; margin-bottom:20px;">
				<p>Antworttyp:</p>
					<label class="radio-inline">
					<input type="radio" name="Auswahl_Antworttyp" id="vordefiniert" value="vordefiniert" style="margin-top:10px;" oninput="showoptions()">Vordefiniert
					</label>
					<label class="radio-inline">
					<input type="radio" name="Auswahl_Antworttyp" id="Emoticons" value="Emoticons" style="margin-top:10px;" oninput="showoptions()">Emoticons
					</label>					
					<label class="radio-inline">
					<input type="radio" name="Auswahl_Antworttyp" id="Sterne" value="Sterne" style="margin-top:10px;" oninput="showoptions()">Sterne
					</label>
				</div>
				<div id="Multiplechoicetyp_container" class="container" style="display:none; margin-bottom:20px;">
				<p>Antworttyp:</p>
					<label class="radio-inline">
					<input type="radio" name="Auswahl_Multiplechoicetyp" id="Checkboxtyp" value="Checkboxtyp" style="margin-top:10px;">Checkbox
					</label>
					<label class="radio-inline">
					<input type="radio" name="Auswahl_Multiplechoicetyp" id="Radiotyp" value="Radiotyp" style="margin-top:10px;">Radiobutton
					</label>					
				</div>
				<input id="Fragenid" name="Fragenid" style="font-size:12px; display:none;" value = 0>
	 			</input>
				<div id="Bewertungoptionen" style="display:none;">
				</div>
				<div id="Multiplechoiceoptionen" style="font-size:12px; display:none;">
				</div>
				<span id="alert" class="alert icon-alert with-arrow alert-danger form-alter" role="alert" style="display:none;" ><?php echo $Schieberegler_err; ?></span>
				<div id="Rangeoptionen" style="font-size:12px; display:none;">
				</div>
				<div id="Rangeoptionen_fragenspezifisch" style="font-size:12px; display:none;">
				</div>
				<button id = "element" type="submit" name = "Submit" style="margin-bottom:20px;margin-top:10px; font-size:16px;" ><i class="fa fa-save"></i> speichern</button>
				</form>
	  </div>
	  </div>

	<script>

	function SortiereFragen()
	{
		var post_order_ids = new Array();
		$('.externe_Fragen form').each(function(){
			post_order_ids.push($(this).data("post-id"));
		});
		$.ajax({
			url:"ajax_upload.php",
			method:"POST",
			data:{post_order_ids:post_order_ids}
		});
	}
	$(document).ready(function(){
		$( ".externe_Fragen" ).sortable({
			placeholder : "ui-state-highlight",
			update  : function(event, ui)
			{	
				var post_order_ids = new Array();
				$('.externe_Fragen form').each(function(){
					post_order_ids.push($(this).data("post-id"));
					for (let index = 0; index < post_order_ids.length; ++index) {
						const element = post_order_ids[index];
						if(element == undefined)
						{
							post_order_ids.splice(index, 1);
						}
					}
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

		$( ".Überschriften" ).sortable({
			placeholder : "ui-state-highlight",
			update  : function(event, ui)
			{	
				var post_order_ids = new Array();
				$('.Überschriften form').each(function(){
					post_order_ids.push($(this).data("post-ud"));
					console.log(post_order_ids)
					for (let index = 0; index < post_order_ids.length; ++index) {
						const element = post_order_ids[index];
						if(element == undefined)
						{
							post_order_ids.splice(index, 1);
						}
					}
				});
				$.ajax({
					url:"ajax_upload_überschrift.php",
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
				SortiereFragen();
			}
		});
	});


	function updateInput(wert, element){
		console.log(element);
		console.log(wert);
		document.getElementById(element).value = wert;
		document.getElementById(element).setAttribute("value", wert);
	}

	var modal = document.getElementById("myModal");
	var Bewertungoptionen = document.getElementById("Bewertungoptionen");
	var Multiplechoiceoptionen = document.getElementById("Multiplechoiceoptionen");
	var Rangeoptionen = document.getElementById("Rangeoptionen");
	var Modalform = document.getElementById("Modalform");
	var addedquestions=0

	function addSpecificAnswer(Fragentyp, id){
		var tempid=0;
		var xmlhttp_options = new XMLHttpRequest();
			xmlhttp_options.onreadystatechange = function() 
			{
				tempid=parseInt(this.responseText)+1+addedquestions;
				addedquestions=addedquestions+1;
			;};
		xmlhttp_options.open("GET", "getLastMultiplechoiceId.php", false);
		xmlhttp_options.send();
		
		var Answer = document.getElementById(Fragentyp.value+"newanswer").value;
		var AnswerEnglisch = document.getElementById(Fragentyp.value+"newanswerEnglisch").value;

		var Type = "extern";
	
		if (Fragentyp.value == "Multiplechoice")
		{
			var inputtext='\
			<div style="background-color:ghostwhite; margin-bottom:10px; padding: 5px;">\
				<input type="hidden" value="'+tempid+'_unchecked" name="checkbox[]">\
					<input type="checkbox" style="margin-left:0px;" id="'+ tempid +'_extern_Multiplechoice" name="checkbox[]" value="'+ Answer +'" checked>\
				<input type="hidden" value="'+tempid+'_unchecked_englisch" name="checkboxenglisch[]">\
					<input type="checkbox" style="margin-left:0px; display:none" id="'+tempid+'_extern_Multiplechoice_englisch" name="checkboxenglisch[]" value="'+AnswerEnglisch+'" onclick="return false" checked>\
						<label id="label_'+tempid+'" for="'+ tempid +'_extern_Multiplechoice" style="border:none;"> '+ Answer +'</label>\
						<button type="button" style="border:none; background:white; margin-left:10px;" onclick="ShowFragenspezifischeDetails('+ tempid +',\'Multiplechoice\')"><i class="fa fa-pencil"></i></button>\
						<button type="button" style="border:none; background:white; margin-left:10px;" onclick="Antwort_löschen('+ tempid +',\'Multiplechoice\')"><i class="fa fa-trash"></i></button>\
			<div id="Container_Multiplechoice_'+tempid+'" style="grid-template-columns:auto auto; display:none"><div>Bezeichnung:</div><div>Englische Übersetzung:</div>\
    		<div><input id="Fragenspezifisch_Multiplechoice_'+ tempid +'" onchange="updateInput(this.value, \'Fragenspezifisch_Multiplechoice_'+ tempid +'\')" style="width:90%" value="'+ Answer +'"></div><div><input id="FragenspezifischEnglisch_Multiplechoice_'+ tempid +'" onchange="updateInput(this.value, \'FragenspezifischEnglisch_Multiplechoice_'+ tempid +'\')" style="width:90%" value="'+AnswerEnglisch+'"></div><div><input id="element2" type="button" value="speichern" style="width:150px; padding:2px; margin-left:10px; margin-top:20px; margin-bottom:10px; font-size:13px" onclick="bearbeiteFragenspezifischeAntwort('+tempid+',\'Multiplechoice\')"</input></div></div></div></div>'
			Multiplechoiceoptionen.innerHTML = Multiplechoiceoptionen.innerHTML + inputtext
		}
		//Wenn die Id nicht 0 ist also eine bestehende Frage bearbeitet wird dann schreib die neue Antwort in die Datenbank sofort wenn sie hinzugefügt wird
		if(id!=0 && id!=undefined)
		{
			var xmlhttp_options = new XMLHttpRequest();
			xmlhttp_options.onreadystatechange = function() 
			{
				console.log("Response:"+this.responseText);
			;};
			xmlhttp_options.open("GET", "insert_Specific_Answer.php?ID=" + id + "&Answer=" +Answer+ "&AnswerEnglisch=" +AnswerEnglisch+"&Fragentyp="+Fragentyp.value+"&Externinterntyp="+Type, false);
			xmlhttp_options.send();
		}
	}

	function bearbeiteFragenspezifischeAntwort(id, Fragentyp){

		var FragenspezifischeAntwort = document.getElementById("Fragenspezifisch_"+Fragentyp+"_"+id).value; 
		var FragenspezifischeAntwortEnglisch = document.getElementById("FragenspezifischEnglisch_"+Fragentyp+"_"+id).value; 

		document.getElementById("label_"+id).innerHTML=FragenspezifischeAntwort;
		document.getElementById(id +'_extern_Multiplechoice').value=FragenspezifischeAntwort;
		console.log("Amtwort:"+FragenspezifischeAntwort)
		console.log("AmtwortEnglisch:"+FragenspezifischeAntwortEnglisch)

		document.getElementById(id +'_extern_Multiplechoice_englisch').value=FragenspezifischeAntwortEnglisch;
		//Wenn die Id nicht 0 ist also eine bestehende Frage bearbeitet wird dann schreib die neue Antwort in die Datenbank sofort wenn sie hinzugefügt wird
		if(id!=0 && id!=undefined)
		{
			var xmlhttp_options = new XMLHttpRequest();
			xmlhttp_options.onreadystatechange = function() 
			{
				console.log("Response:"+this.responseText);
			;};
			FragenspezifischeAntwort=FragenspezifischeAntwort.replaceAll("&", "%26");
			FragenspezifischeAntwortEnglisch=FragenspezifischeAntwortEnglisch.replaceAll("&", "%26");
			xmlhttp_options.open("GET", "update_Specific_Answer.php?ID=" + id + "&Answer=" +FragenspezifischeAntwort+ "&AnswerEnglisch=" +FragenspezifischeAntwortEnglisch+"&Fragentyp="+Fragentyp, true);
			xmlhttp_options.send();				
		}
	}	
	
	function ShowFragenspezifischeDetails(id, Fragentyp){
		console.log("ID="+id)
		var Container = document.getElementById("Container_"+Fragentyp+"_"+id);
		if(Container.style.display === "grid")
		{
			Container.style.display = "none"
		}
		else
		Container.style.display = "grid"
		
	}

	function getCheckedAntworttyp(id, type){

		var xmlhttp_options = new XMLHttpRequest();
		var frage = document.getElementById("Frage");     

		var vordefiniert = document.getElementById("vordefiniert"); 
		var Emoticons = document.getElementById("Emoticons"); 
		var Sterne = document.getElementById("Sterne"); 
		xmlhttp_options.onreadystatechange = function() {
			if (this.readyState == 4 && this.status == 200) {
				if(this.response=="vordefiniert")
				{
					vordefiniert.checked=true;
				}
				else
				{
					Emoticons.checked=true;
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

	function getÜberschriftUebersetzung(id){
		var xmlhttp_options = new XMLHttpRequest();
		var kapitel_englisch = document.getElementById("Überschrift_Übersetzung");
		xmlhttp_options.onreadystatechange = function() {
			if (this.readyState == 4 && this.status == 200) {
				kapitel_englisch.value=this.responseText;
			}
		;};
		xmlhttp_options.open("GET", "Überschrift_Uebersetzung.php?ID=" + id, true);
		xmlhttp_options.send();
	}

	function getLeistung(id){
		var u = 0;
		var selectbox=document.getElementsByClassName("multiselect-selected-text")[1];
		var selectbutton=document.getElementsByClassName("multiselect dropdown-toggle btn btn-default")[1];

		var checkboxes = document.querySelectorAll('input[type="checkbox"]');
		var xmlhttp_options = new XMLHttpRequest();
		xmlhttp_options.onreadystatechange = function() {
			if (this.readyState == 4 && this.status == 200) {
				console.log(this.responseText)
				for (var i = 0; i < checkboxes.length; i++) {
					if(checkboxes[i].value!="toggle")
					{
						if(this.responseText.includes("|"+checkboxes[i].value+"|"))
						{
							console.log(checkboxes[i].value)
							document.getElementById("Leistung_"+checkboxes[i].value).selected=true
							checkboxes[i].checked = true;
							var listitem = checkboxes[i].closest("li");
							listitem.className = "active";
							u=u+1;
							if(u>1)
							selectbox.innerHTML = u+" Leistungen gewählt";
							else
							selectbox.innerHTML = u+" Leistung gewählt";
						}
					}
				}
				selectbox.style.fontSize="15px";
				selectbutton.style.border="none";
				selectbutton.style.overflow="hidden";
				selectbutton.style.maxWidth="300px";

			}
		;};
		xmlhttp_options.open("GET", "getLeistungToQuestion.php?ID=" + id, true);
		xmlhttp_options.send();		
	}

	function getFragenset(id){
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
							document.getElementById("Fragenset_"+checkboxes[i].value).selected=false
						}
							checkboxes[i].checked = false;
							var listitem = checkboxes[i].closest("li");
							listitem.className = "false";

							
						if(this.responseText.includes("|"+checkboxes[i].value+"|"))
						{
							console.log("Value: |"+checkboxes[i].value+"|");
							document.getElementById("Fragenset_"+checkboxes[i].value).selected=true
							checkboxes[i].checked = true;
							var listitem = checkboxes[i].closest("li");
							listitem.className = "active";
							u=u+1;
							if(u>1)
							selectbox.innerHTML = u+" Fragensets gewählt";
							else
							selectbox.innerHTML = u+" Fragenset gewählt";
						}
					}
				}
				selectbox.style.fontSize="15px";
				selectbutton.style.border="none";
				selectbutton.style.overflow="hidden";
				selectbutton.style.maxWidth="300px";

			}
		;};
		xmlhttp_options.open("GET", "getFragensetToQuestion.php?ID=" + id, true);
		xmlhttp_options.send();		
	}

	function resetRadio()
	{
		var selectbox=document.getElementsByClassName("multiselect-selected-text")[0];
		var selectbutton=document.getElementsByClassName("multiselect dropdown-toggle btn btn-default")[0];

		if(selectbox)
		{
			selectbox.style.fontSize="15px";
			selectbutton.style.border="none";
			selectbutton.style.overflow="hidden";
			selectbutton.style.maxWidth="300px";
			selectbox.innerHTML = "Kein Fragenset gewählt";
		}
		var checkboxes = document.querySelectorAll('input[type="checkbox"]');

		for (var i = 0; i < checkboxes.length; i++) {
			if(checkboxes[i].value!="toggle")
			{
				if(checkboxes[i].value!="multiselect-all")
				{	try{
					console.log(checkboxes[i].value)
					document.getElementById("Fragenset_"+checkboxes[i].value).selected=false
					}
				catch(e)
				{
					console.log("No item found in Fragenset")
				}
				}
				checkboxes[i].checked = false;
				try{
				var listitem = checkboxes[i].closest("li");
				listitem.className = "false";
				}
				catch(e)
				{}
			}
		}
	}

	
	function resetLeistungen()
	{
		var selectbox=document.getElementsByClassName("multiselect-selected-text")[1];
		var selectbutton=document.getElementsByClassName("multiselect dropdown-toggle btn btn-default")[1];

		if(selectbox)
		{
			selectbox.style.fontSize="15px";
			selectbutton.style.border="none";
			selectbutton.style.overflow="hidden";
			selectbutton.style.maxWidth="300px";
			selectbox.innerHTML = "keine Leistung gewählt";
		}

		var checkboxes = document.querySelectorAll('input[type="checkbox"]');

		for (var i = 0; i < checkboxes.length; i++) {
			if(checkboxes[i].value!="toggle")
			{
				if(checkboxes[i].value!="multiselect-all")
				{	try{
					console.log(checkboxes[i].value)
					document.getElementById("Leistung_"+checkboxes[i].value).selected=false
					}
				catch(e)
				{
					console.log("No item found in Fragenset")
				}
				}
				checkboxes[i].checked = false;
				try{
				var listitem = checkboxes[i].closest("li");
				listitem.className = "false";
				}
				catch(e)
				{}
			}
		}
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
			xmlhttp_options.open("GET", "Rangeslider_Abfrage.php?ID=" + ID, true);
			xmlhttp_options.send();
	}

	function checkAnswerboxes(id, type, questiontype){

		if(id!=0)
		{
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
			xmlhttp1.open("GET", "Fragen_get_Antwortenset.php?ID=" + id  + "&Type="+questiontype, false);
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
			document.getElementById(questiontype).checked=true;
			Modalform.action = "Fragen_relate_antworten.php?Id="+id+"&Type="+type+"&Questiontype="+questiontype
			<?php
                if (isset($_REQUEST["Step"])) {
                    $Step = $_REQUEST["Step"];
                    echo'+"&Step='.$Step.'"';
                };
?>;
			if(questiontype=="Multiplechoice")
			{
				var xmlhttp_options = new XMLHttpRequest();
				xmlhttp_options.onreadystatechange = function() {
					if (this.readyState == 4 && this.status == 200) {
							Multiplechoiceoptionen.innerHTML=this.responseText;
						}
				;};
				xmlhttp_options.open("GET", "Fragenspezifische_Antworten.php?ID=" + id + "&Fragentyp="+questiontype+"&Typ="+type, false);
				xmlhttp_options.send();					
			}
			else{
				if(questiontype=="Bewertung"){
					Bewertungoptionen.innerHTML='<h5>Vorschau:</h5>\
					<?php $sql = "SELECT Answers FROM bewertung_answers ORDER BY post_order_no ASC";
					$result = mysqli_query($link, $sql);
					while ($row = mysqli_fetch_assoc($result)) {
						echo'<input type="radio" name="bewertungTextOption" style="margin-left:0px; margin-top:0px;"><p for="'.$row["Answers"].'_extern_Bewertung" style="border:none;"> '.$row["Answers"].'</p></input><br>';
					}?>';
				}
			}
		}
		else{
			var HinzufügenSpecific ='<br><input id = "element" type="button" onclick="addSpecificAnswer('+questiontype+')" style="height: 40px; width:200px; padding: 4px; background-color:white; border: 2px solid; color:<?php
			$sql='SELECT farbe FROM system';
			$exec=mysqli_query($link, $sql);
			$result_color=mysqli_fetch_assoc($exec);
			echo $result_color['farbe']?>" value="Hinzufügen"></input><br><br><h5>Wähle Antworten für diese Frage:</h5>';

			Multiplechoiceoptionen.innerHTML='<h5>Erstelle eine neue Antwort für diese Frage:</h5>\
			<input style="margin-left:0px; width:60%; min-width:220px;" id="'+questiontype+'newanswer" name="newanswer"></input><br>\
			<h5>Übersetzung:</h5>\
			<input style="margin-left:0px; width:60%; min-width:220px;" id="'+questiontype+'newanswerEnglisch" name="newanswerEnglisch"></input>\
			'+HinzufügenSpecific;

		}
	}

	function display(id, type, questiontype) 
	{	
		resetLeistungen();
		resetRadio();
		getFragenset(id);
		getLeistung(id);
		document.getElementById('alert').style.display='none';

		if (questiontype == "Bewertung")
		{
			document.getElementById('Antworttyp_container').style.display="block";
			document.getElementById('Multiplechoicetyp_container').style.display="none";
		}
		else if (questiontype == "Multiplechoice")
		{
			document.getElementById('Antworttyp_container').style.display="none";
			document.getElementById('Multiplechoicetyp_container').style.display="block";
		}
		else{
			document.getElementById('Antworttyp_container').style.display="none";
			document.getElementById('Multiplechoicetyp_container').style.display="none";	
		}
		if(id && id!=0)
		{
			document.getElementById("FragenÜberschrift").innerHTML="Frage bearbeiten";
			document.getElementById("Fragenid").value = id;
			document.getElementById("Bewertung").disabled=true;
			document.getElementById("Multiplechoice").disabled=true;
			document.getElementById("Schieberegler").disabled=true;
			document.getElementById("Text").disabled=true;
			document.getElementById(questiontype).disabled=false;
			modal.style.display = "block";
			var Modalform = document.getElementById("Modalform");


			getFragenBeschreibung(id,type);
			getCheckedAntworttyp(id, type);
			getFragenUebersetzung(id, type);


				document.getElementById("Überschrift_Container").style.display="block";
				document.getElementById("Frageübersetzung_Label").style.display="block";
				document.getElementById("Frage_Übersetzung").style.display="block";
				
				getÜberschriftUebersetzung(id);
				getFragenÜberschrift(id);
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
					<?php
					if (isset($_REQUEST["Step"])) {
						$Step=$_REQUEST["Step"];
						echo'Modalform.action="Fragen.php?Step='.$Step.'";';
					} else {
						echo'Modalform.action="Fragen.php";';
					}
					?>
					document.getElementById("Schieberegler").checked=true;
					Rangeoptionen.innerHTML = '<h5>Wähle die Konfiguration des Schiebereglers:</h5><div id="SchieberID"></div>';
					var ID = id;
					Bewertungoptionen.style.display="none";
					Multiplechoiceoptionen.style.display="none";
					Rangeoptionen.style.display="block";	
				}
				else if(questiontype=="Text")
				{						
					document.getElementById("Text").checked=true;
					Modalform.action="Fragen_relate_antworten.php?Id="+id+"&Type=extern&Questiontype=Text<?php
					if (isset($_REQUEST["Step"])) {
						$Step = $_REQUEST["Step"];
						echo'&Step='.$Step;
					};
					?>";
					Bewertungoptionen.style.display="none";
					Multiplechoiceoptionen.style.display="none";
					Rangeoptionen.style.display="none";	
				}			
			
			if(questiontype=="Schieberegler")
			{
				Rangesliderabfrage(id, type);	
			}	
				checkAnswerboxes(id, type, questiontype);	
		}
		else if(id==0)
		{
			console.log("ID = 0")
			document.getElementById("FragenÜberschrift").innerHTML="Neue Frage hinzufügen";
			modal.style.display ="block";
			document.getElementById('alert').style.display='block';
		}
		else{
			var Modalform = document.getElementById("Modalform");
			<?php
            if (isset($_REQUEST["Step"])) {
                $Step=$_REQUEST["Step"];
                echo'Modalform.action="Fragen.php?Step='.$Step.'";';
            } else {
                echo'Modalform.action="Fragen.php";';
            }
			?>
			document.getElementById("Bewertung").disabled=false;
			document.getElementById("Multiplechoice").disabled=false;
			document.getElementById("Schieberegler").disabled=false;
			document.getElementById("Text").disabled=false;
			document.getElementById("Bewertung").checked=false;
			document.getElementById("Multiplechoice").checked=false;
			document.getElementById("Schieberegler").checked=false;
			document.getElementById("Text").checked=false;
			document.getElementById("Emoticon").checked=false;
			document.getElementById("Sterne").checked=false;
			document.getElementById("vordefiniert").checked=false;
			document.getElementById("Bewertungoptionen").style.display="none";
			document.getElementById("Multiplechoiceoptionen").style.display="none";
			document.getElementById("Rangeoptionen").style.display="none";
			document.getElementById("Frage").value="";
			document.getElementById("Frage_Übersetzung").value="";
			document.getElementById("Frageübersetzung_Label").style.display="block";
			document.getElementById("Frage_Übersetzung").style.display="block";		

			modal.style.display ="block";
			document.getElementById("Fragenid").value = 0;
		}
	}

	function display_new(Überschriftid)
	{	
		document.getElementById('Multiplechoicetyp_container').style.display="none";
			document.getElementById('Antworttyp_container').style.display="none";
			getÜberschrift(Überschriftid)
			document.getElementById("FragenÜberschrift").innerHTML="Neue Frage hinzufügen";
			var Modalform = document.getElementById("Modalform");
			<?php
            if (isset($_REQUEST["Step"])) {
                $Step=$_REQUEST["Step"];
                echo'Modalform.action="Fragen.php?Step='.$Step.'";';
            } else {
                echo'Modalform.action="Fragen.php";';
            }
?>
			document.getElementById("Bewertung").disabled=false;
			document.getElementById("Multiplechoice").disabled=false;
			document.getElementById("Schieberegler").disabled=false;
			document.getElementById("Text").disabled=false;
			document.getElementById("Bewertung").checked=false;
			document.getElementById("Multiplechoice").checked=false;
			document.getElementById("Schieberegler").checked=false;
			document.getElementById("Text").checked=false;
			document.getElementById("Emoticons").checked=false;
			document.getElementById("Sterne").checked=false;
			document.getElementById("vordefiniert").checked=false;
			document.getElementById("Bewertungoptionen").style.display="none";
			document.getElementById("Multiplechoiceoptionen").style.display="none";
			document.getElementById("Rangeoptionen").style.display="none";
			document.getElementById("Frage").value="";
			document.getElementById("Frage_Übersetzung").value="";
			document.getElementById("Frageübersetzung_Label").style.display="block";
			document.getElementById("Frage_Übersetzung").style.display="block";		
			modal.style.display ="block";
			document.getElementById("Fragenid").value = 0;	
			resetLeistungen();
			resetRadio();
		}

	function showoptions()
	{
		var xmlhttp_options = new XMLHttpRequest();

		document.getElementById('alert').style.display='none';
		var externinterntyp = "extern";

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
		if (Fragentyp_value == "Bewertung")
		{
			document.getElementById('Antworttyp_container').style.display="block";
			document.getElementById('Multiplechoicetyp_container').style.display="none";
			document.getElementById('vordefiniert').required=true;
			document.getElementById('Emoticons').required=true;
			document.getElementById('Sterne').required=true;
			document.getElementById('Checkboxtyp').required=false;
			document.getElementById('Radiotyp').required=false;

		}
		else if (Fragentyp_value == "Multiplechoice")
		{
			document.getElementById('Antworttyp_container').style.display="none";
			document.getElementById('Multiplechoicetyp_container').style.display="block";
			document.getElementById('vordefiniert').required=false;
			document.getElementById('Emoticons').required=false;
			document.getElementById('Sterne').required=false;
			document.getElementById('Checkboxtyp').required=true;
			document.getElementById('Radiotyp').required=true;
		}
		else{
			document.getElementById('Multiplechoicetyp_container').style.display="none";
			document.getElementById('Antworttyp_container').style.display="none";
			document.getElementById('vordefiniert').required=false;
			document.getElementById('Emoticons').required=false;
			document.getElementById('Sterne').required=false;
			document.getElementById('Checkboxtyp').required=false;
			document.getElementById('Radiotyp').required=false;
		}
		var Bewertungoptionen = document.getElementById("Bewertungoptionen");
		var Multiplechoiceoptionen = document.getElementById("Multiplechoiceoptionen");
		var Rangeoptionen = document.getElementById("Rangeoptionen");
		var Rangeoptionen_fragenspezifisch = document.getElementById("Rangeoptionen_fragenspezifisch");

		if(Fragentyp_value == "Bewertung")
		{
			Rangeoptionen_fragenspezifisch.style.display="none";
				Bewertungoptionen.style.display="block";
				Multiplechoiceoptionen.style.display="none";
				Rangeoptionen.style.display="none";
				Bewertungoptionen.innerHTML = '<h5 style="margin-bottom:20px">Vorschau:</h5>\
				<?php $sql = "SELECT Answers FROM bewertung_answers ORDER BY post_order_no ASC";
				$result = mysqli_query($link, $sql);
				while ($row = mysqli_fetch_assoc($result)) {
				    echo'<input type="radio" name="bewertungTextOption" style="margin-left:0px; margin-top:0px;"><p for="'.$row["Answers"].'_extern_Bewertung" style="border:none;"> '.$row["Answers"].'</p></input><br>';
				}?>';
			}
			checkAnswerboxes(id, externinterntyp, Fragentyp_value);	
		
		
		if(Fragentyp_value == "Multiplechoice")
		{
				getFragenspezifischeAntworten(id, Fragentyp_value, externinterntyp);
				Bewertungoptionen.style.display="none";
				Multiplechoiceoptionen.style.display="block";
				Rangeoptionen.style.display="none";
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
						<div id="SchieberID">\
						<h5>Minimum:\
						<input type="number" id="Range_Min" name="Range_Min" min="0" value="0"  style="text-align:center;margin:auto; border-left:none; border-right:none; border-top:none; width: 65px;"></input></h5>\
						<h5>Maximum:\
						<input type="number" class="center-select" id="Range_Max" name="Range_Max" max="1000" value="100"  style="text-align:center;margin:auto; border-left:none; border-right:none; border-top:none; width: 65px;"></input></h5>\
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

	function showNewÜberschriftModal(){
		resetÜberschrift();
		var neueÜberschriftmodal=document.getElementById("ÜberschriftModal");
		var neueÜberschriftmodalform=document.getElementById("ÜberschriftModalform");
		document.getElementById("ÜberschriftÜberschrift").innerHTML = "Neue Überschrift hinzufügen";
		neueÜberschriftmodal.style.display="block";
		neueÜberschriftmodalform.action = "insert_Überschrift.php<?php 
	if(isset($_REQUEST["Step"]))
		{
			$Step = $_REQUEST["Step"];
			echo"?Step=".$Step;
		} ?>";
	}

	function getÜberschrift(id){
		var Überschrift = document.getElementById('Überschrift');
		var xmlhttp_options = new XMLHttpRequest();
		xmlhttp_options.onreadystatechange = function() {
			if (this.readyState == 4 && this.status == 200) {
				Überschrift.value = this.responseText.slice(0,-2);
				console.log("Überschrift: "+id);
				console.log("Überschrift: "+this.responseText);
				Überschrift = document.getElementById('Überschrift_Fragen');
				Überschrift.value = this.responseText.slice(0,-2);
			;}
		;};
		xmlhttp_options.open("GET", "getÜberschrift.php?ID=" + id, false);
		xmlhttp_options.send();
	}

	function getFragenÜberschrift(id){
		var Überschrift = document.getElementById('Überschrift_Fragen');
		var xmlhttp_options = new XMLHttpRequest();
		xmlhttp_options.onreadystatechange = function() {
			if (this.readyState == 4 && this.status == 200) {
				console.log("Überschrift:"+this.responseText.slice(0,-2))
				Überschrift.value = this.responseText.slice(0,-2);
			;}
		;};
		xmlhttp_options.open("GET", "getFragenÜberschrift.php?ID=" + id, false);
		xmlhttp_options.send();
	}

	function getÜberschriftÜbersetzung(id){
		var Überschrift = document.getElementById('Überschrift_Übersetzung');
		var xmlhttp_options = new XMLHttpRequest();
		xmlhttp_options.onreadystatechange = function() {
			if (this.readyState == 4 && this.status == 200) {
				var Überschrift = document.getElementById('Überschrift_Übersetzung');
				console.log("Überschrift_Übersetzung: "+this.responseText);
				Überschrift.value = this.responseText.slice(0,-2);
			;}
		;};
		xmlhttp_options.open("GET", "getÜberschrift_Übersetzung.php?ID=" + id, false);
		xmlhttp_options.send();
	}

	function resetÜberschrift(){
		document.getElementById('Überschrift').value = "";
		document.getElementById('Überschrift_Übersetzung').value = "";
	}

	function showÜberschrift(id){
		var neueÜberschriftmodal=document.getElementById("ÜberschriftModal");
		var neueÜberschriftmodalform=document.getElementById("ÜberschriftModalform");
		console.log("Überschrift: "+id)
		getÜberschrift(id);
		getÜberschriftÜbersetzung(id);
		document.getElementById("ÜberschriftÜberschrift").innerHTML = "Überschrift bearbeiten";
		neueÜberschriftmodal.style.display="block";
		neueÜberschriftmodalform.action = "update_Überschrift.php?ID="+id+"<?php 
		if(isset($_REQUEST["Step"]))
			{
				$Step = $_REQUEST["Step"];
				echo"?Step=".$Step;
			} ?>";
		}
	// When the user clicks anywhere outside of the modal, close it

	function hide_modal(){
		var modal = document.getElementById("myModal");
		var neueÜberschriftmodal=document.getElementById("ÜberschriftModal");
		modal.style.display = "none";
		neueÜberschriftmodal.style.display = "none";

	}

	window.onclick = function(event) {
	if (event.target == modal) {
		modal.style.display = "none";
	}
	}
	</script>
    </body>
</html>