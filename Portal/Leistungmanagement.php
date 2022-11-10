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
    <title>Leistungen</title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />  
	<link href="bootstrap.css" rel="stylesheet" type="text/css">
	<link href="charts.css" rel="stylesheet" type="text/css">
	<link href="User_optionen.css" rel="stylesheet" type="text/css">
	<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.3/Chart.min.js"></script>
	<script src="https://cdn.rawgit.com/davidshimjs/qrcodejs/gh-pages/qrcode.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/0.4.1/html2canvas.js"></script>
	<script src="FileSaver.js"></script>


	<?php
	include "Leistung_speichern.php";
	include "Fragenset_speichern.php";
	?>
  <script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
  <script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/jqueryui/1.11.4/jquery-ui.min.js"></script>
  <script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/jqueryui-touch-punch/0.2.3/jquery.ui.touch-punch.min.js"></script>

<style>

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
<link href="tooltip.css" rel="stylesheet" type="text/css">

</head>
<body class="text-center">
 <!-- Load an icon library to show a hamburger menu (bars) on small screens -->
<script src="https://kit.fontawesome.com/9059ff5bc6.js" crossorigin="anonymous"></script>
<link href="navigation.css" rel="stylesheet" type="text/css">
<script type="text/javascript" src="navigation.js"></script>	
    <div class="header">
	<?php
	include "navigation_admin.php";		//Pie and COlumnchart
?>
<script>
	document.getElementById("Leistungmanagement").className = "active";
	document.getElementById("Feedback").style.backgroundColor = "lightgrey";
</script>
		<h1 style="font-size:30px; margin-bottom:10px;"><img src="../assets/brand/graduation-hat.png" width="60"> Leistungen </h1>
		<p style="margin-bottom:10px;text-align:center; max-width:95vw""> Bearbeite hier die Leistungen zu denen du Feedback erhalten möchtest </p>	</div>
		</div>
	<div class="scroll">
	   <?php
	include "Leistungstable.php";
	?>

	</div>
	<button id="element" style="width:250px; background-color:<?php $sql='SELECT farbe FROM system'; $exec=mysqli_query($link,$sql); $result=mysqli_fetch_assoc($exec); echo $result['farbe']?>" onclick = "display(undefined,'Leistung')"><i class="fa fa-graduation-cap" style="font-size:18px" aria-hidden="true"></i> Leistung hinzufügen</button>

	    <!-- The Modal -->
	<div id="myModal" class="modal">
	<form id="Leistung_Form" class = "modalform" action="Leistung_relate_question.php<?php 
	if(isset($_REQUEST["Step"]))
	{
		$Step = $_REQUEST["Step"];
		echo"?Step=".$Step;
	} ?>" method="post">
		<input id="ID" name="ID" style="visibility:hidden; height:0px;"></input>
		<span class="close">&times;</span>
		<div class="Kommentare" style="margin:auto; text-align:left">
		<h4 id="LeistungÜberschrift" style="margin-bottom:30px; text-align:left;">Leistung hinzufügen</h4> 
		<h5>Bezeichnung:</h5>
		<input id="neuer_Leistung" class="center_select" name="neuer_Leistung" required></input>
		<h5>Wähle dein Fragenset zur ausgewählten Leistung:</h5>
		<div>
		<?php
			include "Auswahlmöglichkeiten_Fragenset.php";
		?>
		</div>
		<?php
		$sql = "SELECT Fragen_extern FROM admin ORDER BY post_order_no";
		$result = mysqli_query($link,$sql);
		while($row = mysqli_fetch_assoc($result)){
			echo'
			<input type="hidden" value="'.$row["Fragen_extern"].'_unchecked" name="checkbox[]">
			<input type="checkbox" id="'.$row["Fragen_extern"].'" name="checkbox[]" value="'.$row["Fragen_extern"].'">
			<label for="'.$row["Fragen_extern"].'" style="border:none"> '.$row["Fragen_extern"].'</label><br>';
		}
		?>
		<button type="submit" name = "Submit" style="background-color:white; border-radius:10px; border:1px; margin-bottom:20px;margin-top:10px; font-size:16px;" ><i class='fa fa-save'></i> speichern</button>
		</div>
	</form>
	</div>

			<!-- The Modal -->
	<div id="LinkModal" class="modal">
		<form class="modalform" method="get" style="text-align:left">
			<span class="close">&times;</span>
			<div id="Leistung_Auswahl" name="Leistung_Auswahl">Wähle dein Fragenset zur ausgewählten Leistung</div>
			<?php
			include "Auswahlmöglichkeiten_Trainer_ohne_alle.php"
	?>
			<br>
			<input type="checkbox" id ="Sprache"> Englischer Kurs</input>
			<br><br>
			<label class="radio-inline">
			<input style="margin-top:-1px" type="radio" name="qrvslink" value="Link" checked>Feedback-Link
			</label>
			<label class="radio-inline">
			<input style="margin-top:-1px" type="radio" name="qrvslink" value="QR">QR-Code
			</label>
			<br><br>
			<div id="qrcode-container" style="display:none; width:200px;">
    		<div id="qrcode-2" class="qrcode"></div>
			<button type="button" id="QRSave" onclick="CopyQR()" style="margin-top:20px; padding:7px; border:none; border-radius:2px; color:white; background-color:<?php $sql="SELECT farbe FROM system";
	$exec=mysqli_query($link, $sql);
	$result=mysqli_fetch_assoc($exec);
	echo $result['farbe']?>">QR-Code kopieren</button>
				<button type="button" id="QRSave" onclick="SaveQR()" style="margin-top:20px; padding:7px; border:none; border-radius:2px; color:white; background-color:<?php $sql="SELECT farbe FROM system";
	$exec=mysqli_query($link, $sql);
	$result=mysqli_fetch_assoc($exec);
	echo $result['farbe']?>">Als Bild speichern</button>
	</div>
			<input type="text" id="Link" name="Link" style="margin-top:5px; border:none; width:95%; background-color:rgba(0,0,0,0.03);" readonly="true"></input>
				<button id="copyButton" onclick="copyLink()" style="margin-top:20px; padding:7px; border:none; border-radius:2px; color:white; display:none; background-color:<?php $sql="SELECT farbe FROM system";
	$exec=mysqli_query($link, $sql);
	$result=mysqli_fetch_assoc($exec);
	echo $result['farbe']?>">Link kopieren</button>
		</form>
	</div>

    <script src="Leistungsjs.js" type="text/javascript"></script>
	<?php
    include "Tutorial_Schritt5_Info.php";
if (isset($_REQUEST["Step"])) {
    echo'
    <script>
	    document.getElementById("myTopnav").style.display="none";
    </script>
	<div class="content" style="text-align:center">
	        <button class="TutorialNavi" onclick = "zurück()"><i class="fa fa-arrow-left"></i><br>zurück</button>
			<progress id="progress" value="4" max="6" style="font-size:25px"></progress>
            <button class="TutorialNavi" onclick = "weiter()"><i class="fa fa-arrow-right"></i><br>weiter</button>
			<progress id="progressmobile" value="4" max="6" style="font-size:25px;"></progress>
    </div>';


    $Step=$_REQUEST["Step"];
}
?>
    <link href="Tutorialstyle.css" rel="stylesheet" type="text/css">
    <script src="Cookiefunctions.js" type="text/javascript"></script>

    <script>
		var span = document.getElementsByClassName("close")[1];
		var linkmodal = document.getElementById("LinkModal");
		let qrcodeContainer = document.getElementById("qrcode-2");
		span.onclick = function() {
  		linkmodal.style.display = "none";
		copyButton.style.display = "none";
		qrcodeContainer.innerHTML="";
	}
	var Leistung_Element = document.getElementById("Leistung_Auswahl");

	function createLink(Leistung_ID, Leistung) {
		linkmodal.style.display = "block";
		Leistung_Element.value = Leistung_ID;
		var Auswahl_Leistung = document.getElementById("Auswahl_Trainer");
		Auswahl_Leistung.value = "%"
		Leistung_Element.innerHTML= "Erzeuge einen Feedback-Link für die Leistung <b>" + Leistung + "</b><div style='margin-top:20px;margin-bottom:20px'>Trainer für die Leistung:</div>";
		var Link = document.getElementById("Link");
		Link.value = "";
	}

	var Auswahl_Leistung = document.getElementById("Auswahl_Trainer");
	var Auswahl_Sprache = document.getElementById("Sprache");
	var QRAuswahl = document.getElementsByName("qrvslink")[1];
	var LinkAuswahl = document.getElementsByName("qrvslink")[0];

	var Sprache = "Deutsch";
	var Link = document.getElementById("Link");
	var copyButton = document.getElementById("copyButton");
	var current_url = window.location.href;
	var index = current_url.indexOf("Portal");
	current_url = current_url.substr(0,index)+"Feedback_abgeben";
	Auswahl_Leistung.onchange = ShowLink;
	QRAuswahl.onchange = ShowLink;
	LinkAuswahl.onchange = ShowLink;

	function ShowLink(){
		if(Auswahl_Leistung.value!="")
		{
			var Feedbacklink = current_url+"/Vorauswahl.php?Trainer="+Auswahl_Leistung.options[Auswahl_Leistung.selectedIndex].text+"&Sprache="+Sprache+"&Leistung="+Leistung_Element.value;
			Feedbacklink = Feedbacklink.replaceAll(" ","%20");
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
    };

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

	function SaveQR(){
        html2canvas($("#qrcode-2"), {
            onrendered: function(canvas) {
                theCanvas = canvas;
				console.log(canvas);
                canvas.toBlob(function(blob) {
                    saveAs(blob,"QRCode_"+Auswahl_Leistung.value+".png"); 
                });
            }
        });
	}
	
	Auswahl_Sprache.onclick = function(){
		if(Auswahl_Sprache.checked)
		{
			Sprache= "Englisch";
		}
		else{
			Sprache="Deutsch";
		}
		var Feedbacklink = current_url+"/Vorauswahl.php?Leistung_ID="+Auswahl_Leistung.value+"&Sprache="+Sprache+"&Leistung="+Leistung_Element.value;
		Feedbacklink = Feedbacklink.replaceAll(" ","%20");
		if(Auswahl_Leistung.value!=""){
		Link.value = Feedbacklink;
		}
		ShowLink();
	};

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
        alert("Der Link wurde erfolgreich in die Zwischenablage kopiert");
	}

				checkCookie("LeistungInformationChecked", "LeistungInfo_Modal")
				function weiter() {
					window.location.href = "Usermanagement.php?Step=6"
				}

				function zurück() {
					window.location.href = "Fragenset.php?Step=4"
				}
				
				function hideinformation(){
					document.getElementById("LeistungInfo_Modal").style.display="none"
					document.cookie = "LeistungInformationChecked=1; expires=Fri, 27 Mar 2122 12:00:00 UTC";
				}

        function hideinformationWithoutremembering(){
            document.getElementById("LeistungInfo_Modal").style.display="none"
        }

    </script>

    </body>
</html>
