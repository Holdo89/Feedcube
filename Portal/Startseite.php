<?php
 require_once "../config.php";
 require_once "session.php";

 $sql = "SELECT Is_Admin FROM users WHERE username = '".$_SESSION["username"]."'";
 $result = mysqli_query($link, $sql);
 $row = mysqli_fetch_assoc($result);
 ?>

<!DOCTYPE HTML>

<html>
<?php
  require_once "FEEDCUBE_icon.php"
 ?>
<head>

    <meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Dashboard</title>
	<link href="bootstrap.css" rel="stylesheet" type="text/css">
	<link href="StartCharts.css" rel="stylesheet" type="text/css">
	<script type="text/javascript" src="hidefunction.js"></script>
	<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.10.1/html2pdf.bundle.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.3.5/jspdf.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/0.4.1/html2canvas.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.3/Chart.min.js"></script>

	<?php
        include "Start_Draw_Charts.php";		//Pie and COlumnchart
 		include "Start_Draw_Trend_Chart.php";
		include "Start_Draw_Charts_Umfragen.php";
		include "Start_Draw_Trend_Chart_Umfragen.php";
 	?>	
  <script type = "text/javascript" src="export_delete_data.js"></script>
  <script type="text/javascript" src="rangeslider_jquery.js"> </script>
  <script type="text/javascript" src="start_rangeslider_jquery_intern.js"> </script>
  <link rel="manifest" href="../../manifest.json">

</head>
<style>
.btn-light{
	background-color:<?php $sql='SELECT farbe FROM system'; $exec=mysqli_query($link,$sql); $result=mysqli_fetch_assoc($exec); echo $result['farbe']?>;
	color:white;
}
.btn-secondary{
	background-color:ghostwhite;
}
.auswertung{
	width:83vw; 
	margin:auto;
}
@media only screen and (max-width: 800px){
	.auswertung{
		width:90vw; 
	}
	.btn-group{
		grid-column-start: 1;
		grid-column-end: -1;
		margin-bottom:20px;
	}
}
</style>

<body class="text-center" onload="update()">

 <!-- Load an icon library to show a hamburger menu (bars) on small screens -->

<script src="https://kit.fontawesome.com/9059ff5bc6.js" crossorigin="anonymous"></script>
<link href="navigation.css" rel="stylesheet" type="text/css">
<script type="text/javascript" src="navigation.js"></script>	
<div class="header">
<?php
	include "navigation_admin.php";
 ?>

<img class="mb-4" src="../assets/brand/dashboard.png" alt="" width="300" style="margin-bottom:30px">
<p style="max-width:90vw; margin:auto">Hier erhältst du einen Überblick über die Auswertung des Feedbacks zu Kursen und Umfragen</p><br>
</div>
<div class="auswertung" style="margin-top:30px; text-align:left">

<!--Auswertung von multiple choice Fragen-->
<div id=fullAuswahl class="FragenAuswahl">		
<div class='btn-group' role='group'>
	<button type='button' onclick="toggleKursfeedback()" id="Kursfeedback" class='btn btn-light'><i class="fa fa-graduation-cap" style="font-size:15px;" aria-hidden="true"></i> Kursfeedback</button>
	<button type='button' onclick="toggleUmfragen()" id="Umfragenneu" class='btn btn-secondary'><i class="fa fa-poll" style="font-size:15px;" aria-hidden="true"></i> Umfragen</button>
</div>
<div style="font-size:12pt; margin-top:8px;" onclick="toggleFilterVisibility('FilterCharts', 'filtericon')"><i id="filtericon" class="fa fa-filter" style="font-size:15px;" aria-hidden="true"></i> Filter</div>
			<?php
	if($IsAdmin == 1)
	{
		echo'<div id="export" style="text-align:left;font-size:12pt; margin-top:8px;" onclick="export_data_admin()"><i id="filtericon" class="fa fa-download" style="font-size:15px;" aria-hidden="true"></i> Export</div>';
		echo'<div id="delete" style="text-align:left;font-size:12pt; margin-top:8px;" onclick="delete_data()"><i id="filtericon" class="fa fa-trash" style="font-size:15px;" aria-hidden="true"></i> Löschen</div>';
	}
	else{
		echo'<div id="export" style="text-align:left;font-size:12pt; margin-top:8px;" onclick="export_data()"><i id="filtericon" class="fa fa-download" style="font-size:15px;" aria-hidden="true"></i> Export</div>';
	}
 ?>	
	</div>
	<hr>
<?php
    include "Start_Filter.php";
?>
<div id="loader" class="loader"></div>

 <script>
	function toggleKursfeedback()
	{
		var export_action = "export_data()";
		if(document.getElementById("delete"))
		{
			export_action = "export_data_admin()";
		}
		document.getElementById("export").setAttribute("onClick", export_action);
		document.getElementById("delete").setAttribute("onClick", "delete_data()");
		document.getElementById("Auswahl_Kursfeedback").style.visibility="visible";
		document.getElementById("Auswahl_Kursfeedback").style.maxHeight="300px";
		document.getElementById("Auswahl_Umfragen").style.visibility="hidden";
		document.getElementById("Auswahl_Umfragen").style.maxHeight="0px";
		document.getElementById("Kursfeedback").setAttribute("class", "btn btn-light");
		document.getElementById("Umfragenneu").setAttribute("class", "btn btn-secondary");
		document.getElementById("Umfragenneu").style.color="black";
		document.getElementById("Kursfeedback").style.color="white";
		update();

	}
	function toggleUmfragen()
	{
		document.getElementById("export").setAttribute("onClick", "intern_export_data()");
		document.getElementById("delete").setAttribute("onClick", "intern_delete_data()");
		document.getElementById("Auswahl_Kursfeedback").style.visibility="hidden";		
		document.getElementById("Auswahl_Kursfeedback").style.maxHeight="0px";
		document.getElementById("Auswahl_Umfragen").style.visibility="visible";
		document.getElementById("Auswahl_Umfragen").style.maxHeight="300px";
		document.getElementById("Kursfeedback").setAttribute("class", "btn btn-secondary");
		document.getElementById("Umfragenneu").setAttribute("class", "btn btn-light");
		document.getElementById("Umfragenneu").style.color="white";
		document.getElementById("Kursfeedback").style.color="black";
		update_umfragen()
	}
</script>
<div id="startdashboard">
</div>
<div id="elementH"></div>
</body>

</html>




	





