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
	<link href="charts2.css" rel="stylesheet" type="text/css">
	<script type="text/javascript" src="hidefunction.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.3/Chart.min.js"></script>	
  	<script type = "text/javascript" src="export_delete_data.js"></script>
  	<link rel="manifest" href="../../manifest.json">

</head>
<style>

</style>
<body class="text-center" onload="update()">

 <!-- Load an icon library to show a hamburger menu (bars) on small screens -->

<script src="https://kit.fontawesome.com/662d1709e3.js" crossorigin="anonymous"></script>
<link href="navigation.css" rel="stylesheet" type="text/css">
<script type="text/javascript" src="navigation.js"></script>	
<script type = "text/javascript" src="export_delete_data.js"></script>
<div class="header">
<?php

	$sql = "SELECT Is_Admin FROM users WHERE username ='".$_SESSION["username"]."'";
	$exec = mysqli_query($link,$sql);
	$row = mysqli_fetch_assoc($exec);
	$IsAdmin = $row["Is_Admin"];
	if($IsAdmin == 1)
		include "navigation_admin.php";
	else
		include "navigation.php";
?>

<img class="mb-4" src="../assets/brand/DASHBOARD.svg" alt="" width="300" height="120" style="margin-top:-20px">
<p style="max-width:90vw; margin:auto">Hier erhältst du einen groben Überblick über die Auswertung des Feedbacks</p><br>

    </div>
<div style="width:83vw; margin:auto; @media only screen and (max-width: 600px){width:100vw; margin:0;}">	

<!--Auswertung von multiple choice Fragen-->


<div id=fullAuswahl class="FragenAuswahl" style="margin:auto;margin-top:20px;justify-items: center;grid-template-columns: auto auto auto; max-width:500px ">
	<div style="text-align:center;font-size:12pt; margin-top:8px;" onclick="toggleFilterVisibility('FilterCharts', 'filtericon')"><i id="filtericon" class="fa fa-filter" style="font-size:15px;" aria-hidden="true"></i> Filter</div>
	<?php
	if($IsAdmin == 1)
	{
		echo'<div style="text-align:left;font-size:12pt; margin-top:8px;" onclick="export_data_admin()"><i id="filtericon" class="fa fa-download" style="font-size:15px;" aria-hidden="true"></i> Export</div>';
		echo'<div style="text-align:left;font-size:12pt; margin-top:8px;" onclick="delete_data()"><i id="filtericon" class="fa fa-trash" style="font-size:15px;" aria-hidden="true"></i> Löschen</div>';
	}
	else{
		echo'<div style="text-align:left;font-size:12pt; margin-top:8px;" onclick="export_data()"><i id="filtericon" class="fa fa-download" style="font-size:15px;" aria-hidden="true"></i> Export</div>';
	}
	?>	

	</div>
	<hr>
	<?php
	include "Filter.php";
	?>
		<script type="text/javascript" src="rangeslider_jquery.js"> </script>
<div id="startdashboard">
</div>
</div>

<script>
	function update(){
	var Trainer = Auswahl_Trainer.value;
    var Leistung = Auswahl_Leistung.value;
    var AuswahlZeitraum = document.getElementById("AuswahlZeitraum");
	var daterange = document.getElementById("zeitraum").value;
	const DateRangeArray = daterange.split("   bis   ");
	var datum_min = DateRangeArray[1];
	var datum_max = DateRangeArray[0];	
	datum_min = new Date(datum_min);
	datum_max = new Date(datum_max);


    datum_min = datum_min.toISOString().split('T')[0];
	datum_max = datum_max.toISOString().split('T')[0];
		var dashboard = document.getElementById("startdashboard");
		var xmlhttp_options = new XMLHttpRequest();
     	xmlhttp_options.onreadystatechange = function() {
			if (this.readyState == 4 && this.status == 200) {
				dashboard.innerHTML=this.responseText;
			}
    	;};
    	xmlhttp_options.open("GET", "Start_Dashboard.php?datum_min=" + datum_min + "&datum_max=" + datum_max + "&Leistung=" + Leistung + "&Trainer=" + Trainer, false);
    	xmlhttp_options.send();
	}
</script>
</body>
</html>





