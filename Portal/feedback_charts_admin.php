<!DOCTYPE HTML>

<html>
<?php
 require_once "FEEDCUBE_icon.php"
?>
<head>

    <meta charset="UTF-8">

	<meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Feedback Auswertung</title>

	<link href="bootstrap.css" rel="stylesheet" type="text/css">

	<link href="charts.css" rel="stylesheet" type="text/css">

	<link href="slider-range.css" rel="stylesheet" type="text/css">

	<script type="text/javascript" src="hidefunction.js"></script>

	<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.3/Chart.min.js"></script>

	

				<?php

				include "Draw_Charts.php";		//Pie and COlumnchart

				include "Draw_Trend_Chart.php";		

				include "Create_Blog_Admin.php";

			?>	



  <script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>

  <script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/jqueryui/1.11.4/jquery-ui.min.js"></script>

  <script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/jqueryui-touch-punch/0.2.3/jquery.ui.touch-punch.min.js"></script>

  <script type="text/javascript" src="rangeslider_jquery.js"> </script>

  <script type = "text/javascript" src="export_delete_data.js"></script>



</head>

<style>

/* Center the loader */

#loader {

  position: absolute;

  left: 50%;

  top: 50%;

  z-index: 1;

  width: 120px;

  height: 120px;

  margin: -76px 0 0 -76px;

  border: 16px solid #f3f3f3;

  border-radius: 50%;

  border-top: 16px solid #3498db;

  -webkit-animation: spin 2s linear infinite;

  animation: spin 2s linear infinite;

}



@-webkit-keyframes spin {

  0% { -webkit-transform: rotate(0deg); }

  100% { -webkit-transform: rotate(360deg); }

}



</style>

<body class="text-center">

 <!-- Load an icon library to show a hamburger menu (bars) on small screens -->

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

<link href="navigation.css" rel="stylesheet" type="text/css">

<script type="text/javascript" src="navigation.js"></script>	

<script type = "text/javascript" src="export_delete_data.js"></script>

<script type = "text/javascript" src="color_change.js"></script>

<div class="header">

<?php
	include "navigation_admin.php";		//Pie and COlumnchart
?>
<script>
	document.getElementById("feedback_charts").className = "active";
</script>

		<h1 style="font-size:30px; margin-bottom:10px;">Diagramme <i class="fa fa-bar-chart" aria-hidden="true"></i> </h1>

		<p style="margin-bottom:40px;"> Hier findest du die Auswertung deines Kundenfeedbacks</p>

    </div>



<div style="width:90vw; margin:auto; @media only screen and (max-width: 600px){width:100vw; margin:0;}">	





<!--Auswertung von multiple choice Fragen-->



<div class="container">

  <div class="btn-group">

    <button type="button" id="metriken_button" class="btn btn-primary" onclick="change_color('metriken_button','text_button','<?php $sql='SELECT farbe FROM system'; $exec=mysqli_query($link,$sql); $result=mysqli_fetch_assoc($exec); echo $result['farbe']?>'); hide('fullAuswahl','blog'); hide('charts','blog');update();">Metriken</button>

    <button type="button" id="text_button" class="btn btn-primary" onclick="change_color('text_button','metriken_button','<?php $sql='SELECT farbe FROM system'; $exec=mysqli_query($link,$sql); $result=mysqli_fetch_assoc($exec); echo $result['farbe']?>'); hide('fullAuswahl','charts');hide('blog','fullAuswahl');create_blog();">Kommentare</button>

  </div>

</div>

<div id=Hinweis style="margin-top:50px;"><p><label>Wähle Metriken oder Kommentare um dein Feedback auszuwerten</label></p></div>



	<div id=fullAuswahl style='display:none'>

	<div id="Auswahl" class="grid-container-auswahl">

	<label class="Auswahl"> Wähle einen Berater: </label>

			<?php

				include "Auswahlmöglichkeiten_Trainer.php"

			?>	

	<label class="Auswahl"> Wähle eine Frage: </label>

			<?php

				include "Auswahlmöglichkeiten_Fragen.php"

			?>

	<label class="Auswahl"> Wähle einen Leistung: </label>

			<?php

				include "Auswahlmöglichkeiten_Leistung.php"

			?>

	<label class="Auswahl"> Wähle einen Zeitraum: </label>	

	<div class="Auswahl_Slider">

	<div id="slider-range" onmousemove="datum_update()"></div>

		<p style="margin-top:0.5em">Bewertungen von: <span id="demo" ></span></p>

	</div>

	</div>

	<label class="Auswahl" id="nofeedback" name="nofeedback" style="text-align:center; margin-top:5rem"></label>

	</div>

	<div id="loader" style = "display:none"></div>

	<div id="charts" class="grid-container-charts" style='display:none;'>

			<div class= "leftchart">

			<canvas id="ColumnChart" height=160></canvas>

			</div>

			<div class= "rightchart">

			<canvas id="PieChart" height=200></canvas>

			</div>

			<div class="leftchart"> 

			<canvas id="TrendChart" height=200></canvas>

			</div>

			<div class="rightchart"> 

			<p id="Statistics" style="overflow:auto; font-size:18px; font-weight: bold;border-radius: 10px 10px; background-image: url('background_statistic.jpg'); background-size: cover; color:white; margin-top:11%; padding-top:20%;height:330px;">

			</p>

			</div>

	</div>

	<div id="blog" style='display:none'>		

	<div id="blog2" class="grid-container-auswahl">

	<label class="Auswahl" style="font-size: 12pt"> Wähle einen Berater: </label>

			<?php

				include "Auswahlmöglichkeiten_Trainer_Kommentare.php"

			?>

	<label class="Auswahl"> Wähle eine Frage: </label>

			<?php

				include "Auswahlmöglichkeiten_Fragen_Kommentare.php"

			?>

	<label class="Auswahl"> Wähle einen Leistung: </label>

			<?php

				include "Auswahlmöglichkeiten_Leistung_Kommentar.php"

			?>

	<label class="Auswahl"> Wähle einen Zeitraum: </label>	

	<div class="Auswahl_Slider">

	<div id="slider-range2" onmousemove="datum_update_blog()"></div>

		<p style="margin-top:0.5em">Bewertungen von: <span id="demo2" ></span></p>

	</div>

	<div class="Kommentare">

	<span id="blog_posts" ></span> <!--hier werden die Kommentare eingefügt-->

	</div>

	</div>

	<label class="Auswahl" id="nofeedback_Kommentar" name="nofeedback_Kommentar" style="text-align:center; margin-top:1rem"></label>	

	</div> 

</div>





</body>

</html>

	





