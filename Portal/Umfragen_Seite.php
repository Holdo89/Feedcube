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
	<link rel = "stylesheet" href = "https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css?v=1">
	<link href="bootstrap.css?v=1" rel="stylesheet" type="text/css">
	<link href="Umfragen_Fragen.css?v=1" rel="stylesheet" type="text/css">
	<link href="tooltip.css?v=1" rel="stylesheet" type="text/css">
	<link href="umfrage_optionen.css?v=1" rel="stylesheet" type="text/css">
	<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.3/Chart.min.js"></script>
	<script src="https://cdn.rawgit.com/davidshimjs/qrcodejs/gh-pages/qrcode.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/0.4.1/html2canvas.js"></script>
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
	<link rel = "stylesheet" href = "https://cdnjs.cloudflare.com/ajax/libs/bootstrap-multiselect/0.9.15/css/bootstrap-multiselect.css?v=1"/>

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
<script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui-touch-punch/0.2.3/jquery.ui.touch-punch.min.js"></script>
<script src="https://kit.fontawesome.com/9059ff5bc6.js" crossorigin="anonymous"></script>
<script src="touchjquery.js?v=1"></script>
<link href="navigation.css?v=1" rel="stylesheet" type="text/css">
<script type="text/javascript" src="navigation.js?v=1"></script>	
    <div class="header">
	<?php
	include "navigation_admin.php";
 ?>
<script>
	document.getElementById("Umfragen").className = "active";
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
					<div style="margin-bottom:20px">
					<br>
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
					<div id="Antworttyp_container" style="display:none; margin-bottom:20px;">
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
					<input id="Umfragenid" name="Umfragenid" style="font-size:12px; display:none;" value = 0>
					</input>
					<input id="Fragenid" name="Fragenid" style="font-size:12px; display:none;" value = 0>
					</input>
					<input id="externinterntyp" name="externinterntyp" style="font-size:12px; display:none;">
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
					<button type="submit" name = "Submit" style="background-color:white; border-radius:10px; border:1px; margin-bottom:20px;margin-top:10px; font-size:16px;" ><i class="fa fa-save"></i> speichern</button>
			</div>
		</form>
	</div>

	<div id="LinkModal" class="modal">
		<form class="modalform" method="get" style="text-align:left">
			<span class="close" onclick="hide_LinkModal()">&times;</span>
			<div id="Umfrage_Auswahl" name="Umfrage_Auswahl"></div>
			<br>
			<label class="radio-inline">
			<input style="margin-top: 8px" type="radio" id="qrvslink" name="qrvslink" value="Link" checked>Feedback-Link
			</label>
			<label class="radio-inline">
			<input style="margin-top: 8px" type="radio" name="qrvslink" value="QR">QR-Code
			</label>
			<br><br>
			<div id="qrcode-container" style="display:none; width:200px;">
    		<div id="qrcode-2" class="qrcode"></div>
			<button type="button" id="QRSave" onclick="CopyQR()" style="margin-top:20px; padding:7px; border:none; border-radius:2px; color:white; background-color:<?php $sql="SELECT farbe FROM system";
	$exec=mysqli_query($link, $sql);
	$result=mysqli_fetch_assoc($exec);
	echo $result['farbe']?>">QR-Code kopieren</button>
	</div>
			<input type="text" id="Link" name="Link" style="margin-top:5px; border:none; width:95%; background-color:rgba(0,0,0,0.03);" readonly="true"></input>
				<button id="copyButton" onclick="copyLink()" style="margin-top:20px; padding:7px; border:none; border-radius:2px; color:white; display:none; background-color:<?php $sql="SELECT farbe FROM system";
	$exec=mysqli_query($link, $sql);
	$result=mysqli_fetch_assoc($exec);
	echo $result['farbe']?>">Link kopieren</button>
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

	function updateInput(wert, element){
		console.log(element);
		console.log(wert);
		document.getElementById(element).value = wert;
		document.getElementById(element).setAttribute("value", wert);
	}

	var QRAuswahl = document.getElementsByName("qrvslink")[1];
	var LinkAuswahl = document.getElementsByName("qrvslink")[0];
	QRAuswahl.onchange = showLink;
	LinkAuswahl.onchange = showLink;

	function createLink(Umfrage_ID) {	
		var Umfrage = document.getElementById("Umfrage_"+Umfrage_ID).innerHTML;
		document.getElementById("Umfrage_Auswahl").innerHTML="Kopiere den Link zur Umfrage <b>"+Umfrage+"</b> oder erstelle einen QR Code"
		var current_url = window.location.href;
		var index = current_url.indexOf("Portal");
		current_url = current_url.substr(0,index)+"Umfrage";
		document.getElementById("LinkModal").style.display = "block";
		var Link = document.getElementById("Link");
		var Feedbacklink = current_url+"/Vorauswahl.php?Umfrage="+Umfrage_ID;
		Link.value = Feedbacklink;
		copyButton.style.display = "block";
			/*With some styles*/
			let qrcodeContainer2 = document.getElementById("qrcode-2");
			qrcodeContainer2.innerHTML = "";
			new QRCode(qrcodeContainer2, {
			text: Feedbacklink,
			width: 200,
			height: 200,
			correctLevel: QRCode.CorrectLevel.H
			});
			document.getElementById("qrvslink").checked = true;

			showLink();
	}

	function showLink(){
		if(document.querySelector('input[name="qrvslink"]:checked').value=="Link")
			{
				document.getElementById("qrcode-container").style.display = "none";
				document.getElementById("Link").style.display = "block";
				document.getElementById("copyButton").style.display = "block";

			}
			else{
			document.getElementById("qrcode-container").style.display = "block";
			document.getElementById("Link").style.display = "none";
			document.getElementById("copyButton").style.display = "none";
			}
	}
	function copyLink() {
		var copyLink = document.getElementById("Link");
		copyLink.select();
		copyLink.setSelectionRange(0, 99999);
		document.execCommand("copy");
        alert("Der Link wurde erfolgreich in die Zwischenablage kopiert");
	}

	function CopyQR(){
        html2canvas($("#qrcode-2"), {
            onrendered: function(canvas) {
                theCanvas = canvas;
				console.log(canvas);
				canvas.toBlob(function(blob) { 
    const item = new ClipboardItem({ "image/png": blob });
    navigator.clipboard.write([item]); 
	alert("QR-Code wurde als Bild in die Zwischenablage kopiert")
		});
    }
    });
	}

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

		var Type = document.getElementById("externinterntyp").value;
		if (Fragentyp.value == "Multiplechoice")
		{
			var inputtext='\
			<div style="background-color:ghostwhite; margin-bottom:10px; padding: 5px;">\
				<input type="hidden" value="'+tempid+'_unchecked" name="checkbox[]">\
					<input type="checkbox" style="margin-left:0px;" id="'+ tempid +'_intern_Multiplechoice" name="checkbox[]" value="'+ Answer +'" checked>\
				<input type="hidden" value="'+tempid+'_unchecked_englisch" name="checkboxenglisch[]">\
					<input type="checkbox" style="margin-left:0px; display:none" id="'+tempid+'_intern_Multiplechoice_englisch" name="checkboxenglisch[]" value="'+AnswerEnglisch+'" onclick="return false" checked>\
						<label id="label_'+tempid+'" for="'+ tempid +'_intern_Multiplechoice" style="border:none;"> '+ Answer +'</label>\
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
	

function bearbeiteFragenspezifischeAntwort(id, Fragentyp){

var FragenspezifischeAntwort = document.getElementById("Fragenspezifisch_"+Fragentyp+"_"+id).value; 
var FragenspezifischeAntwortEnglisch = document.getElementById("FragenspezifischEnglisch_"+Fragentyp+"_"+id).value; 

document.getElementById("label_"+id).innerHTML=FragenspezifischeAntwort;
document.getElementById(id +'_intern_Multiplechoice').value=FragenspezifischeAntwort;
console.log("Amtwort:"+FragenspezifischeAntwort)
console.log("AmtwortEnglisch:"+FragenspezifischeAntwortEnglisch)

document.getElementById(id +'_intern_Multiplechoice_englisch').value=FragenspezifischeAntwortEnglisch;
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
				xmlhttp_options.open("GET", "Umfragen_Fragenspezifische_Antworten.php?ID=" + id + "&Fragentyp="+questiontype+"&Typ="+type, false);
				xmlhttp_options.send();					
			}
			else{
				if(questiontype=="Bewertung"){
					Bewertungoptionen.innerHTML='<h5>Vorschau:</h5>\
					<?php $sql = "SELECT Answers FROM bewertung_answers ORDER BY post_order_no ASC";
					$result = mysqli_query($link, $sql);
					while ($row = mysqli_fetch_assoc($result)) {
						echo'<input type="radio" name="bewertungTextOption" style="margin-left:0px; margin-top:0px;"><p for="'.$row["Answers"].'_intern_Bewertung" style="border:none;"> '.$row["Answers"].'</p></input><br>';
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
		//resetRadio();
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
				<?php
				if (isset($_REQUEST["Step"])) {
					$Step=$_REQUEST["Step"];
					echo'Modalform.action="Umfragen.php?Step='.$Step.'";';
				} else {
					echo'Modalform.action="Umfragen.php";';
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
				Modalform.action="Fragen_relate_antworten.php?Id="+id+"&Type=intern&Questiontype=Text";
				Bewertungoptionen.innerHTML='';	
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
			document.getElementById("Emoticons").checked=false;
			document.getElementById("Sterne").checked=false;
			document.getElementById("vordefiniert").checked=false;
			document.getElementById("Bewertungoptionen").style.display="none";
			document.getElementById("Multiplechoiceoptionen").style.display="none";
			document.getElementById("Rangeoptionen").style.display="none";
			document.getElementById("Frage").value="";

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
				    echo'<input type="radio" name="bewertungTextOption" style="margin-left:0px; margin-top:0px;"><p for="'.$row["Answers"].'_intern_Bewertung" style="border:none;"> '.$row["Answers"].'</p></input><br>';
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

	// When the user clicks anywhere outside of the modal, close it

	function hide_modal(){
		var modal = document.getElementById("myModal");
		modal.style.display = "none";
	}

	function hide_newUmfragemodal()
	{
		neueUmfragemodal.style.display = "none";
	}

	function hide_LinkModal()
	{
		document.getElementById("LinkModal").style.display = "none";
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
    <script src="Umfragenjs.js?v=1" type="text/javascript"></script>
    </body>
</html>
