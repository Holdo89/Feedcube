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
	<link href="bootstrap.css?v=1" rel="stylesheet" type="text/css">
	<link href="charts2.css?v=1" rel="stylesheet" type="text/css">
	<script type="text/javascript" src="hidefunction.js"></script>
	<script type="text/javascript" src="createPdf.js"></script>
	<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.3.5/jspdf.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/0.4.1/html2canvas.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.3/Chart.min.js"></script>
	<script type="text/javascript" src="rangeslider_jquery_intern.js"> </script>
	<?php
				include "intern_Draw_Charts.php";		//Pie and COlumnchart
				include "intern_Draw_Trend_Chart.php";
	?>
		<script type="text/javascript" src="export_delete_data.js"></script>

    <script type="text/javascript" src="rangeslider_jquery_intern.js"> </script>

</head>
<body class="text-center" onload="update();">
 <!-- Load an icon library to show a hamburger menu (bars) on small screens -->
<script src="https://kit.fontawesome.com/9059ff5bc6.js" crossorigin="anonymous"></script>
<link href="navigation.css?v=1" rel="stylesheet" type="text/css">
<script type="text/javascript" src="navigation.js"></script>	
    <div class="header">
	<?php
	include "navigation_admin.php";
 ?>
<script>
	document.getElementById("Intern").className = "active";
	document.getElementById("UmfrageMöglichkeiten").style.backgroundColor = "lightgrey";
</script>
		<h1 style="font-size:30px; margin-bottom:20px;"><img src="../assets/brand/graph.png" width="60" style="margin-top:-10px;"> Auswertung </h1>
		</div>
	<div style="width:85vw; margin:auto; font-size:16px">	
	<p style='margin-bottom:50px'>Hier findest du die Auswertung des Feedbacks zu internen Umfragen</p>
	<?php
			include "intern_feedback_charts.php";
	?>
	</div>
    </body>
</html>
<script>
var limit = 10;
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
	var Frage = Auswahl_Frage.value;
    var AuswahlZeitraum = document.getElementById("AuswahlZeitraum");
	var daterange = document.getElementById("zeitraum").value;
	const DateRangeArray = daterange.split("   bis   ");
	var datum_min = DateRangeArray[1];
	var datum_max = DateRangeArray[0];	
	datum_min = new Date(datum_min);
	datum_max = new Date(datum_max);


	datum_min = datum_min.toISOString().split('T')[0];
	datum_max = datum_max.toISOString().split('T')[0];


  	$.ajax({
   url:"intern_Kommentare.php?datum_min=" + datum_min + "&datum_max=" + datum_max + "&Frage=" + Frage,
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
			$('#load_data_message').html("<button type='button' class='btn btn-info'>Keine weiteren Bewertungen</button>");	
		}
		action = "inactive";
	}
    else
    {
		$('#load_data_message').show();
		console.log("action"+start);
     	$('#load_data_message').html("<button type='button' style='display:none' class='btn btn-warning'>Bitte warten....</button>");
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



	
