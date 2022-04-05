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
	<link href="bootstrap.css" rel="stylesheet" type="text/css">
	<link href="charts.css" rel="stylesheet" type="text/css">
	<link href="leistung_optionen.css" rel="stylesheet" type="text/css">
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

.center_button:hover .tooltiptext {
  visibility: visible;
}
</style>
<link href="tooltip.css" rel="stylesheet" type="text/css">

</head>
<body class="text-center">
 <!-- Load an icon library to show a hamburger menu (bars) on small screens -->
<script src="https://kit.fontawesome.com/662d1709e3.js" crossorigin="anonymous"></script>
<link href="navigation.css" rel="stylesheet" type="text/css">
<script type="text/javascript" src="navigation.js"></script>	
    <div class="header">
	<?php
	include "navigation_admin.php";		//Pie and COlumnchart
?>
<script>
	document.getElementById("Leistungmanagement").className = "active";
	document.getElementById("optionen").style.backgroundColor = "lightgrey";
</script>
		<h1 style="font-size:30px; margin-bottom:10px;"><img src="../assets/brand/graduation-hat.png" width="60"> Leistungen </h1>
		<p style="margin-bottom:30px"> Bearbeite hier die Leistungen zu denen du Feedback erhalten möchtest </p>	</div>
		</div>
	<div class="scroll">
	<style>
	.überschrift{
		background-color: <?php $sql='SELECT farbe FROM system'; $exec=mysqli_query($link,$sql); $result=mysqli_fetch_assoc($exec); echo $result['farbe']?>;
	}
	</style>
	<form action="insert_leistung.php<?php 
	if(isset($_REQUEST["Step"]))
	{
		$Step = $_REQUEST["Step"];
		echo"?Step=".$Step;
	} ?>" method="post">
	<label class="überschrift">Leistungen</label><label class="überschrift"></label><label class="überschrift"></label>
	<?php
		include "Leistung_Abfrage.php";
	?>
	</form>
	</div>
	<button id="element" style="width:250px; background-color:<?php $sql='SELECT farbe FROM system'; $exec=mysqli_query($link,$sql); $result=mysqli_fetch_assoc($exec); echo $result['farbe']?>" onclick = "display(undefined,'Leistung')"> Leistung hinzufügen</button>

	    <!-- The Modal -->
	<div id="myModal" class="modal">
	<form id="Leistung_Form" class = "modalform" action="Leistung_relate_question.php<?php 
	if(isset($_REQUEST["Step"]))
	{
		$Step = $_REQUEST["Step"];
		echo"?Step=".$Step;
	} ?>" method="post">
		<input id="ID" name="ID" style="visibility:hidden"></input>
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

    <script src="Leistungsjs.js" type="text/javascript"></script>
	<?php
    include "Tutorial_Schritt5_Info.php";
if (isset($_REQUEST["Step"])) {
    echo'
    <script>
	    document.getElementById("myTopnav").style.display="none";
    </script>
	<div class="content">
	        <button id="element2" onclick = "zurück()">zurück</button>
            <button id="element" onclick = "weiter()">weiter</button>
    </div>';

    $Step=$_REQUEST["Step"];
}
?>
    <link href="Tutorialstyle.css" rel="stylesheet" type="text/css">
    <script src="Cookiefunctions.js" type="text/javascript"></script>

    <script>
				checkCookie("LeistungInformationChecked", "LeistungInfo_Modal")
				function weiter() {
					window.location.href = "Usermanagement.php?Step=6"
				}

				function zurück() {
					window.location.href = "Fragenset.php?Step=4"
				}
				
				function hideinformation(){
					document.getElementById("LeistungInfo_Modal").style.display="none"
					document.cookie = "LeistungInformationChecked=1";
				}

        function hideinformationWithoutremembering(){
            document.getElementById("LeistungInfo_Modal").style.display="none"
        }

    </script>

    </body>
</html>
