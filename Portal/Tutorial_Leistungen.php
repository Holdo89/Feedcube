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
	<link href="charts2.css" rel="stylesheet" type="text/css">
	<link href="leistung_optionen.css" rel="stylesheet" type="text/css">
	<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.3/Chart.min.js"></script>
	<?php
	include "Leistung_speichern.php";
	include "Fragenset_speichern.php";
  include "Tutorialstyle.php"
	?>
  <script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
  <script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/jqueryui/1.11.4/jquery-ui.min.js"></script>
  <script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/jqueryui-touch-punch/0.2.3/jquery.ui.touch-punch.min.js"></script>


</head>
<body class="text-center">
 <!-- Load an icon library to show a hamburger menu (bars) on small screens -->
<script src="https://kit.fontawesome.com/662d1709e3.js" crossorigin="anonymous"></script>
<link href="navigation.css" rel="stylesheet" type="text/css">
<script type="text/javascript" src="navigation.js"></script>	
    <div class="header" style="margin-top:100px">

		<h1 style="font-size:30px; margin-bottom:10px;"><img src="../assets/brand/graduation-hat.png" width="60"> Leistungen </h1>
		<p style="margin:auto; text-align:center; margin-bottom:30px; max-width: 1000px">Bearbeite hier die Leistungen zu denen du Feedback erhalten möchtest</p>	</div>
		</div>
	<div class="scroll" style="max-width:95vw; margin:auto; text-align:center">
	<style>
	.überschrift{
		background-color: <?php $sql='SELECT farbe FROM system'; $exec=mysqli_query($link,$sql); $result=mysqli_fetch_assoc($exec); echo $result['farbe']?>;
	}
	</style>
	<form action="insert_leistung.php?Step=5" method="post">
	<label class="überschrift">Leistungen</label><label class="überschrift"></label><label class="überschrift"></label>
	<?php
		include "Leistung_Abfrage.php";
	?>
	<input id="neuer_Leistung" class="center_select" name="neuer_Leistung" placeholder="Eingabe einer neuen Leistung" required></input>
	<input class="center_button" type="submit" value="+"></input>
	</form>
	</div>
	
	    <!-- The Modal -->
	<div id="myModal" class="modal">
	<form class = "modalform" action="Leistung_relate_question.php?Step=5" method="post">
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

	<div id="Fragenset_Modal" class="modal" style="display:none">
	<form class= "modalform" style="grid-template-columns: auto" action"#" onsubmit="hideinformation(); return false" method="post">
	    <div></div>
	    <div></div>
		<span class="close" style="text-align:right">&times;</span>
		<div>		
		<h4 style="font-size:30px; margin-bottom:10px;">Schritt 5: <img src="../assets/brand/graduation-hat.png" width="60"> Leistungen </h4>
		<p style="text-align:left">
		    Leistungen repräsentieren Dienstleistungen zu denen Feedback von Teilnehmern abgegeben werden. Beispiele dafür sind Schulungen, Seminare, oder auch Beratungen. 
		    Um Fragen zu wählen die bei einer Leistung abgefragt werden klicken Sie <i class="fa fa-pencil" aria-hidden="true"></i>. Fragen können einzeln oder durch
		    ein zuvor definiertes Fragenset gewählt werden.  
		</p>
		    <button id="element" style="font-size:13px; margin-top:20px; width:170px; padding:10px;"><i class="fa fa-check" aria-hidden="true" style="font-size:13px"></i> Alles klar</button>
		</div>

	</form>
	
	</div>

	<div class="content">
	        <button id="element2" onclick = "zurück()">zurück</button>
            <button id="element" onclick = "weiter()">weiter</button>
    </div>


    <script src="Leistungsjs.js" type="text/javascript"></script>
    <script src="Cookiefunctions.js" type="text/javascript"></script>

    <script>
        checkCookie("LeistungInformationChecked", "Fragenset_Modal")

        function weiter() {
            window.location.href = "Tutorial_Usermanagement.php";
        }

        function zurück() {
            window.location.href = "Tutorial_Fragenset.php";
        }

        function hideinformation(){
            document.getElementById("Fragenset_Modal").style.display="none"
            document.cookie = "LeistungInformationChecked=1";
        }
    </script>
    </body>
</html>
