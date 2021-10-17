<?php
 require_once "../config.php";
 require_once "session.php";
?>

<!DOCTYPE HTML>
<html>
<?php
 require_once "FEEDCUBE_icon.php"
?>  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Feedback abgeben</title>
	<link href="bootstrap.css" rel="stylesheet" type="text/css">
	<link href="forms.css" rel="stylesheet" type="text/css">
	<link href="charts2.css" rel="stylesheet" type="text/css">
	<script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
	<script type = "text/javascript" src="export_delete_data.js"></script>

	<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.3/Chart.min.js"></script>
	
  </head>

<body class="text-center" onload="datum_update(), update()">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	<link href="navigation.css" rel="stylesheet" type="text/css">
	<script type="text/javascript" src="navigation.js"></script>

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
	document.getElementById("forms_admin").className = "active";
</script>
		<h1 style="font-size:30px; margin-bottom:10px;">Formulare <i class="fa fa-file-text-o" aria-hidden="true"></i> </h1>
		<p style="margin-bottom:30px"> Hier findest du die Auswertung deines Kundenfeedbacks</p>	</div>
		<div id=fullAuswahl class="forms">
	<div style="text-align:left;font-size:18px; margin-top:8px;" onclick="toggleFilterVisibility('FilterCharts', 'filtericon')"><i id="filtericon" class="fa fa-filter" style="font-size:15px;" aria-hidden="true"></i> Filter</div>
	<?php
	if($IsAdmin == 1)
	{
		echo'<div style="text-align:left;font-size:18px; margin-top:8px;" onclick="export_data_admin()"><i id="filtericon" class="fa fa-download" style="font-size:15px;" aria-hidden="true"></i> Export</div>';
		echo'<div style="text-align:left;font-size:18px; margin-top:8px;" onclick="delete_data()"><i id="filtericon" class="fa fa-trash" style="font-size:15px;" aria-hidden="true"></i> Löschen</div>';
	}
	else{
		echo'<div style="text-align:left;font-size:18px; margin-top:8px;" onclick="export_data()"><i id="filtericon" class="fa fa-download" style="font-size:15px;" aria-hidden="true"></i> Export</div>';
	}
	?>	

	</div>
	<hr>
	<?php
	include "Filter.php";
	?>

	<div id="auswertungen" style="display:grid">
	</div>
	<div id="load_data_message"></div>
	
</body>
</html>

<script>
var limit = 5;
var start = 0;
var action = 'inactive';
var blog = document.getElementById("auswertungen");

function update(){
	var output = document.getElementById("demo");
	blog.innerHTML="";
	if(action == 'inactive')
	{
	start = 0;
	action = 'active';
	load_country_data(limit, start);
	}
};

function load_country_data(limit, start)
 	{
	var Trainer = Auswahl_Trainer.value;
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
	var output = document.getElementById("demo");
	var datum_min = new Date();
	var datum_max = new Date();
	datum_min.setDate(datum_min.getDate() - value_min);
	datum_min = datum_min.toISOString().split('T')[0];
	datum_max.setDate(datum_max.getDate() - value_max);
	datum_max = datum_max.toISOString().split('T')[0];
  	$.ajax({
	<?php
			echo 'url:"formular_admin.php?datum_min=" + datum_min + "&datum_max=" + datum_max + "&Leistung=" + Leistung + "&Zeitraum=" + Zeitraum + "&Trainer=" + Trainer';
	?>,
   method:"POST",
   data:{limit:limit, start:start},
   cache:false,
   success:function(data)
   {
    $('#auswertungen').append(data);
    if(data.length <= 2)
    {
		if(blog.innerHTML.length<=2)
		{	
			blog.innerHTML='<p><label style="margin-top:30px">Es wurde noch kein Feedback abgegeben</label></p> <img src="undraw_empty_xct9.svg" alt="" style="width:20%;" class="undraw_chart_empty">';
			$('#load_data_message').hide();
		}
		else
		{	
			$('#load_data_message').html("<button type='button' class='btn btn-info'>Keine weiteren Kommentare</button>");	
		}
		action="inactive";
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

 $(window).scroll(function(){
  if($(window).scrollTop() + $(window).height() > $("#auswertungen").height() && action == 'inactive')
  {
   action = 'active';
   start = start + limit;
   setTimeout(function(){
    load_country_data(limit, start);
   }, 1000);
  }
 });


function deleteFeedback(id){
		if (confirm("Wollen Sie dieses Feedback wirklich entfernen?"))
	  	{
			var xmlhttp = new XMLHttpRequest();
			xmlhttp.open("GET", "deleteFeedback.php?Id=" + id, true);
			xmlhttp.send();
			location.reload();
	  }
	}
</script>
