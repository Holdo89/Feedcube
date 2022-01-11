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
    <title>Feedback Auswertung</title>
	<link href="bootstrap.css" rel="stylesheet" type="text/css">
	<link href="charts2.css" rel="stylesheet" type="text/css">
	<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.3.5/jspdf.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/0.4.1/html2canvas.js"></script>
	<script type="text/javascript" src="hidefunction.js"></script>
	<script type="text/javascript" src="createPdf.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.3/Chart.min.js"></script>

				<?php
				include "Draw_Charts.php";		//Pie and COlumnchart
				include "Draw_Trend_Chart.php";		
			?>	
  <script type = "text/javascript" src="export_delete_data.js"></script>

</head>
<style>

</style>
<body class="text-center" onload="update()">

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
		<h1 style="font-size:30px; margin-bottom:20px;"><img src="../assets/brand/bar-chart.png" width="50" style="margin-top:-10px;"> Auswertung </h1>
		<p style="margin:auto; margin-bottom:40px; width:90vw;"> Wähle eine Frage um das Feedback dazu auszuwerten</p>
    </div>
<div id = "pdfExporterDiv" style="width:83vw; margin:auto;">	

<!--Auswertung von multiple choice Fragen-->


<div id=fullAuswahl class="FragenAuswahl">
<label class="Auswahl">Frage: </label>
			<?php
				include "Auswahlmöglichkeiten_Fragen.php";
				include "FilterExportDeleteOptions.php";
			?>	
	</div>
	<hr>
	<?php
	include "Filter.php";
	?>

	<div id="undraw_empty" style="display:none; margin-top:48px;"><p><label>Es wurde noch kein Feedback abgegeben</label></p><img src="undraw_empty_xct9.svg" alt="" class="undraw_chart_empty"></div>


	<div id="loader" style = "display:none"></div>
	<div id="charts" class="grid-container-charts" >
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
	<div id="Kommentare" class="Kommentare" style="margin:auto">
	<span id="blog_posts" ></span> <!--hier werden die Kommentare eingefügt-->
	<div id="load_data_message"></div>
	</div>
</div>
<div id="elementH"></div>
</body>

</html>
<script>
var limit = 5;
var start = 0;
var action = 'active';
var blog = document.getElementById("blog_posts");

function create_blog_posts(){
	action = 'inactive';
	var Kommentare = document.getElementById("Kommentare");
	Kommentare.style.display="block";
	blog.innerHTML="";
	var charts = document.getElementById("charts");
	charts.style.display="none";
	var undraw_empty= document.getElementById("undraw_empty");
	undraw_empty.style.display="none";

 if(action == 'inactive')
 {
  start=0;
  console.log("inactive")
  action = 'active';
  loadNewData(limit, start);
 }
 
};

function loadNewData(limit, start)
 	{
	var Trainer = Auswahl_Trainer.value;
	var Frage = Auswahl_Frage.value;
	var Leistung = Auswahl_Leistung.value;
	var Zeitraum =  document.getElementById("zeitraum").value;
    var AuswahlZeitraum = document.getElementById("AuswahlZeitraum");
    if(Zeitraum=="Benutzerdefiniert")
	{
		AuswahlZeitraum.style.visibility="visible"; 
	}
	else
	{
		AuswahlZeitraum.style.visibility="hidden"; 
	}
	var value_min = $( "#slider-range" ).slider( "values", 0 );
	var value_max = $( "#slider-range" ).slider( "values", 1 );
	var output = document.getElementById("slider-range");
	var datum_min = new Date();
	var datum_max = new Date();
	datum_min.setDate(datum_min.getDate() - value_min);
	datum_min = datum_min.toISOString().split('T')[0];
	datum_max.setDate(datum_max.getDate() - value_max);
	datum_max = datum_max.toISOString().split('T')[0];

  	$.ajax({
   url:"Create_Blog.php?datum_min=" + datum_min + "&datum_max=" + datum_max + "&Leistung=" + Leistung + "&Zeitraum=" + Zeitraum + "&Frage=" + Frage + "&Trainer=" + Trainer,
   method:"POST",
   data:{limit:limit, start:start},
   cache:false,
   success:function(data)
   {
    $('#blog_posts').append(data);
    if(data.length < 3)
    {
		if(blog.innerHTML=="")
		{	
			undraw_empty.style.display="block";
			$('#load_data_message').hide();
		}
		else
		{	
			$('#load_data_message').html("<button type='button' class='btn btn-info'>Keine weiteren Kommentare</button>");	
		}
		action = "inactive";
	}
    else
    {
		$('#load_data_message').show();
		console.log("action"+start);
     	$('#load_data_message').html("<button type='button' class='btn btn-warning'>Bitte warten....</button>");
     	action = "inactive";
    }
   }
  });
 }

 $(window).scroll(function(){
  if($(window).scrollTop() + $(window).height() > $("#Kommentare").height() && action == 'inactive')
  {
   action = 'active';
   console.log("active"+start);
   start = start + limit;
   setTimeout(function(){
    loadNewData(limit, start);
   }, 500);
  }
 });
</script>



	





