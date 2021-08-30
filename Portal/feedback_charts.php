<?php
 require_once "session.php";
 require_once "../config.php";
 
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
    <title>Feedback Auswertung</title>
	<link href="bootstrap.css" rel="stylesheet" type="text/css">
	<link href="charts.css" rel="stylesheet" type="text/css">
	<link href="slider-range.css" rel="stylesheet" type="text/css">
	<script type="text/javascript" src="hidefunction.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.3/Chart.min.js"></script>

				<?php
				include "Draw_Charts.php";		//Pie and COlumnchart
				include "Draw_Trend_Chart.php";		
			?>	

  <script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
  <script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/jqueryui/1.11.4/jquery-ui.min.js"></script>
  <script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/jqueryui-touch-punch/0.2.3/jquery.ui.touch-punch.min.js"></script>
  <script type="text/javascript" src="rangeslider_jquery.js"> </script>
  <script type = "text/javascript" src="export_delete_data.js"></script>

</head>
<style>

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

	$sql = "SELECT Is_Admin FROM users WHERE username ='".$_SESSION["username"]."'";
	$exec = mysqli_query($link,$sql);
	$row = mysqli_fetch_assoc($exec);
	$IsAdmin = $row["Is_Admin"];
	if($IsAdmin == 1)
		include "navigation_admin.php";
	else
		include "navigation.php";
?>
<script>
	document.getElementById("feedback_charts").className = "active";
</script>

		<h1 style="font-size:30px; margin-bottom:10px;">Auswertung <i class="fa fa-line-chart" aria-hidden="true"></i> </h1>
		<p style="margin-bottom:40px;"> Wähle Diagramme oder Kommentare um dein Feedback auszuwerten</p>
    </div>
<div style="width:83vw; margin:auto; @media only screen and (max-width: 600px){width:100vw; margin:0;}">	

<!--Auswertung von multiple choice Fragen-->

<div class="container">
  <div class="btn-group">
    <button type="button" id="metriken_button" class="btn btn-primary" onclick="change_color('metriken_button','text_button','<?php $sql='SELECT farbe FROM system'; $exec=mysqli_query($link,$sql); $result=mysqli_fetch_assoc($exec); echo $result['farbe']?>'); hide('fullAuswahl','blog'); hide('charts','blog');get_new_datediff('Diagramme');update();"><i class="fa fa-bar-chart" aria-hidden="true"></i> <span class="buttontext">Diagramme<span></button>
    <button type="button" id="text_button" class="btn btn-primary" onclick="change_color('text_button','metriken_button','<?php $sql='SELECT farbe FROM system'; $exec=mysqli_query($link,$sql); $result=mysqli_fetch_assoc($exec); echo $result['farbe']?>'); hide('fullAuswahl','charts');hide('blog','fullAuswahl');get_new_datediff('Kommentare');create_blog_posts();"><i class="fa fa-commenting" aria-hidden="true"></i> <span class="buttontext">Kommentare</span></button>
  </div>

</div>
<div id=Hinweis style="margin-top:30px;">
<img src="charts_undraw.svg" alt="" class="undraw_charts">
<div class="undraw_seperator"></div>
<img src="chat_undraw.svg" alt="" class="undraw_charts">
</div>
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
	<div id="undraw_empty" style="display:none; margin-top:48px;"><p><label>Es wurde noch kein Feedback abgegeben</label></p><img src="undraw_empty_xct9.svg" alt="" class="undraw_chart_empty"></div>
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
			<p id="Statistics" style="overflow:auto; font-size:18px; font-weight: bold;border-radius: 10px 10px; background: linear-gradient(90deg, rgba(46,193,200,1) 0%, rgba(48,23,107,1) 90%);color:white; margin-top:11%; padding-top:20%;height:330px;">
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
	<div id="load_data_message"></div>
	<div id="undraw_empty_2" style="display:none"><p><label style="font-size:16px;">Es wurde noch kein Feedback abgegeben</label></p><img src="undraw_empty_xct9.svg" alt="" class="undraw_chart_empty"></div>
</div> 
</div>
</body>

</html>
<script>

function create_blog_posts(){
	var blog = document.getElementById("blog_posts");
	var undraw_empty = document.getElementById("undraw_empty_2");
	undraw_empty.style.display="none";
	blog.innerHTML="";
	var limit = 5;
	var start = 0;
	var action = 'inactive';
	function load_country_data(limit, start)
 	{
	var Trainer = Auswahl_Trainer_Kommentare.value;
	var Frage = Auswahl_Frage_Kommentar.value;
	var Leistung = Auswahl_Leistung_Kommentar.value;
	var value_min = $( "#slider-range2" ).slider( "values", 0 );
	var value_max = $( "#slider-range2" ).slider( "values", 1 );
	var output = document.getElementById("demo2");
	var datum_min = new Date();
	var datum_max = new Date();
	datum_min.setDate(datum_min.getDate() - value_min);
	datum_min = datum_min.toISOString().split('T')[0];
	datum_max.setDate(datum_max.getDate() - value_max);
	datum_max = datum_max.toISOString().split('T')[0];
	output.innerHTML = datum_min + " bis " + datum_max;
  	$.ajax({
   url:"Create_Blog.php?datum_min=" + datum_min + "&datum_max=" + datum_max + "&Leistung=" + Leistung + "&Frage=" + Frage + "&Trainer=" + Trainer,
   method:"POST",
   data:{limit:limit, start:start},
   cache:false,
   success:function(data)
   {
    $('#blog_posts').append(data);
    if(data == '')
    {
		if(blog.innerHTML=="")
		{	
			undraw_empty.style.display="block";
			$('#load_data_message').hide();
		}
		else
		{	
			$('#load_data_message').html("<button type='button' class='btn btn-info'>Keine weiteren Kommentare</button>");
			action = 'active';	
		}
	}
    else
    {
		$('#load_data_message').show();
     	$('#load_data_message').html("<button type='button' class='btn btn-warning'>Bitte warten....</button>");
     	action = "inactive";
    }
   }
  });
 }

 if(action == 'inactive')
 {
  action = 'active';
  load_country_data(limit, start);
 }
 $(window).scroll(function(){
  if($(window).scrollTop() + $(window).height() > $("#blog_posts").height() && action == 'inactive')
  {
   action = 'active';
   start = start + limit;
   setTimeout(function(){
    load_country_data(limit, start);
   }, 1000);
  }
 });
 
};
function datum_update_blog(){
	var value_min = $( "#slider-range2" ).slider( "values", 0 );
	var value_max = $( "#slider-range2" ).slider( "values", 1 );
	var output = document.getElementById("demo2");
	var datum_min = new Date();
	var datum_max = new Date();
	datum_min.setDate(datum_min.getDate() - value_min);
	datum_min = datum_min.toISOString().split('T')[0];
	datum_max.setDate(datum_max.getDate() - value_max);
	datum_max = datum_max.toISOString().split('T')[0];
	output.innerHTML = datum_min + " bis " + datum_max;
}

</script>



	





