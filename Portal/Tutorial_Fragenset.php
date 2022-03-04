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
    <title>Fragensets</title>
	<link href="bootstrap.css" rel="stylesheet" type="text/css">
	<link href="charts.css" rel="stylesheet" type="text/css">
	<link href="leistung_optionen.css" rel="stylesheet" type="text/css">
	<link href="Tutorialstyle.css" rel="stylesheet" type="text/css">
	<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.3/Chart.min.js"></script>
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
</style>

</head>
<body class="text-center">
 <!-- Load an icon library to show a hamburger menu (bars) on small screens -->
<script src="https://kit.fontawesome.com/662d1709e3.js" crossorigin="anonymous"></script>
<link href="navigation.css" rel="stylesheet" type="text/css">
<script type="text/javascript" src="navigation.js"></script>	
    <div class="header" style="padding-top:50px">
		<h1 style="font-size:30px; margin-bottom:10px;"><img src="../assets/brand/questionset.png" width="70" style="margin-top:-10px;">  Fragensets </h1>
		<p style="margin-bottom:30px"> Erstelle und bearbeite hier deine Fragensets, um sie anschließend bei den entsprechenden Leistungen anzuwenden</p>	</div>
		</div>
	<div class="scroll">
	<style>
	.überschrift{
		background-color: <?php $sql='SELECT farbe FROM system'; $exec=mysqli_query($link,$sql); $result=mysqli_fetch_assoc($exec); echo $result['farbe']?>;
	}
	</style>

	<div class="scroll" style="margin-top:20px;">
	<form action="insert_fragenset.php?Step=4" method="post">
	<label class="überschrift">Fragensets</label><label class="überschrift"></label><label class="überschrift"></label>
	<?php
		include "Fragenset_Abfrage.php";
	?>
	<input id="neues_Fragenset" class="center_select" name="neues_Fragenset" placeholder="Eingabe eines neuen Fragensets" required></input>
	<input class="center_button" type="submit" value="+"></input>
	</form>
	</div>
	    <!-- The Modal -->
	<div id="myModal" class="modal">
	<form class = "modalform" action="Leistung_relate_question.php?Step=4" method="post">
		<input id="ID" name="ID" style="visibility:hidden"></input>
		<div class="Kommentare" style="margin:auto; text-align:left">
		<span class="close">&times;</span>
		<h4>Wähle dein Fragenset zur ausgewählten Leistung:</h4>
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
	<div id="Fragenset_Modal" class="modal">
	<form class= "modalform" action="Fragenset_relate_question.php?Step=4" method="post">
		<input id="Fragenset_ID" name="Fragenset_ID" style="visibility:hidden"></input>
		<div class="Kommentare" style="margin:auto; text-align:left">
		<span class="close">&times;</span>
		<h4>Wähle deine Fragen zum ausgewählten Fragenset:</h4>
		<?php
		$sql = "SELECT Fragen_extern FROM admin ORDER BY post_order_no";
		$result = mysqli_query($link,$sql);
		while($row = mysqli_fetch_assoc($result)){
			echo'
			<input type="hidden" value="Fragenset_'.$row["Fragen_extern"].'_unchecked" name="Fragenset_checkbox[]">
			<input type="checkbox" id="Fragenset_'.$row["Fragen_extern"].'" name="Fragenset_checkbox[]" value="'.$row["Fragen_extern"].'">
			<label for="Fragenset_'.$row["Fragen_extern"].'" style="border:none"> '.$row["Fragen_extern"].'</label><br>';
		}
		?>
		<button type="submit" name = "Submit" style="background-color:white; border-radius:10px; border:1px; margin-bottom:20px;margin-top:10px; font-size:16px;" ><i class='fa fa-save'></i> speichern</button>
		</div>
	</form>
	</div>
    <script src="Leistungsjs.js" type="text/javascript"></script>
    <div id="FragensetInfo_Modal" class="modal" style="display:none;">
	<form class= "modalform" style="grid-template-columns: auto" action"#" onsubmit="hideinformation(); return false" method="post">
	    <div></div>
		<span class="close" onclick="hideinformationWithoutremembering()" style="float:right; text-align:right">&times;</span>
		<div>		
		<h4 style="font-size:30px; margin-bottom:10px;">Schritt 4: <img src="../assets/brand/questionset.png" width="70"> Fragensets </h4>
		<p style="text-align:left">
		    Werden für unterschiedliche Leistungen immer die selben Fragen verwendet, bietet sich der Einsatz von Fragensets an. Ein Fragenset stellt eine Sammlung an Fragen dar, welche im nächsten Schritt den Leistungen zugeordnet werden können. Änderungen an den Fragensets werden automatisch für alle Leistungen übernommen die dieses Fragenset zugeordnet haben. <br><br>Um die Fragen für ein Fragenset festzulegen klicke <i class="fa fa-pencil" aria-hidden="true"></i>.     
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
        checkCookie("FragensetInformationChecked", "FragensetInfo_Modal")

        function weiter() {
            window.location.href = "Tutorial_Leistungen.php";
        }

        function zurück() {
            window.location.href = "Fragen.php?Step=3";
        }

        function hideinformation(){
            document.getElementById("FragensetInfo_Modal").style.display="none"
            document.cookie = "FragensetInformationChecked=1";
        }

        function hideinformationWithoutremembering(){
            document.getElementById("FragensetInfo_Modal").style.display="none"
        }
    </script>
    </body>
</html>
