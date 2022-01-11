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
	?>
  <script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
  <script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/jqueryui/1.11.4/jquery-ui.min.js"></script>
  <script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/jqueryui-touch-punch/0.2.3/jquery.ui.touch-punch.min.js"></script>

<style>

#element{
  width:250px;
  position: relative;
  margin:auto;
  text-align:center;
  margin-top:25px; 
  cursor:pointer; 
  padding:15px; 
  font-size: 16px; 
  border:none; 
  border-radius:30px; 
  color:white; 
  background-color:<?php $sql='SELECT farbe FROM system'; $exec=mysqli_query($link,$sql); $result=mysqli_fetch_assoc($exec); echo $result['farbe']?>
}

#element2{
      width:250px;
  position: relative;
  margin:auto;
  text-align:center;
  margin-top:25px; 
  margin-left:-50px;
  margin-right:20px;
  cursor:pointer; 
  padding:13px; 
  font-size: 16px; 
  border:3px solid; 
  border-radius:30px; 
  border-color:<?php $sql='SELECT farbe FROM system'; $exec=mysqli_query($link,$sql); $result=mysqli_fetch_assoc($exec); echo $result['farbe']?>;
  color:<?php $sql='SELECT farbe FROM system'; $exec=mysqli_query($link,$sql); $result=mysqli_fetch_assoc($exec); echo $result['farbe']?>; 
  background-color:white
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

.modalform{
    width:95%; 
    text-align:center;
    margin:auto;
    max-width:1000px; 
    padding:30px; 
    overflow:auto; 
    border-radius: 15px;
}
@media only screen and (max-width: 600px){
 #icon{
     width:200px;
     height:70px;
 }  
 
#element2{
    margin:auto;
    margin-left:0px;
    margin-top:60px;
}
#element{
    margin:auto;
    margin-left:0px;
    margin-top:10px;
}
}
</style>

</head>
<body class="text-center">
 <!-- Load an icon library to show a hamburger menu (bars) on small screens -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
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
	<form action="insert_leistung.php" method="post">
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
	<form class = "modalform" action="Tutorial_Leistung_relate_question.php" method="post">
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

	<div id="Fragenset_Modal" class="modal" style="display:block">
	<form class= "modalform" action"#" onsubmit="hideinformation(); return false" method="post">
	    <div></div>
	    <div></div>
		<span class="close">&times;</span>
		<div>		
		<h4 style="font-size:30px; margin-bottom:10px;"><img src="../assets/brand/graduation-hat.png" width="60"> Leistungen </h4>
		<p>
		    Leistungen repräsentieren Themen zu denen Feedback von Teilnehmern abgegeben werden. Beispiele dafür sind Schulungen, Seminare oder andere Dienstleistungen. 
		    Um Fragen zu wählen die bei einer Leistung abgefragt werden klicken Sie <i class="fa fa-pencil" aria-hidden="true"></i>. Fragen können einzeln oder durch
		    ein zuvor definiertes Fragenset gewählt werden.  
		</p>
		    <button id="element" style="font-size:13px; margin-top:20px; width:170px; padding:10px;"><i class="fa fa-check" aria-hidden="true" style="font-size:13px"></i> Alles klar</button>
		</div>

	</form>
	
	</div>

	<div class="content">
	        <button id="element2" onclick = "skipIntro()">zurück</button>
            <button id="element" onclick = "pageRedirect()">weiter</button>
    </div>


    <script src="Leistungsjs.js" type="text/javascript"></script>
    <script>
        function hideinformation(){
            document.getElementById("Fragenset_Modal").style.display="none"
        }
    </script>
    </body>
</html>
