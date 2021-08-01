<?php
 require_once "session.php";
 require_once "../config.php";
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
	<link href="charts.css" rel="stylesheet" type="text/css">
	<script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>

	<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.3/Chart.min.js"></script>
	
  </head>

<body class="text-center">
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
	<div id="Auswahl_Admin" class="grid-container-auswahl" style="width:78vw; margin:auto;">
	<?php
		if($IsAdmin == 1){
			echo '	<label class="Auswahl" style="text-align:center; padding:0"> Wähle einen Berater: </label>';
			include "Auswahlmöglichkeiten_Trainer.php";
		}
	?>
		<label class="Auswahl" style="text-align:center; padding:0"> Wähle eine Leistung: </label>
			<?php
				include "Auswahlmöglichkeiten_Leistung.php"
			?>
	</div>
	<script>
	<?php
		if($IsAdmin == 1){
			echo 'document.getElementById("Auswahl_Trainer").oninput = function(){create_formular()};';
		}
	?>
	document.getElementById("Auswahl_Leistung").oninput = function(){create_formular()};
	</script>
	<div id="auswertungen" style="display:grid; margin:10px;">
	</div>
	<div id="load_data_message"></div>
	
</body>
</html>

<script>

function create_formular(){
	var blog = document.getElementById("auswertungen");
	blog.innerHTML="";
	var limit = 5;
	var start = 0;
	var action = 'inactive';
	function load_country_data(limit, start)
 	{
	<?php
		if($IsAdmin == 1){
			echo 'var Trainer = Auswahl_Trainer.value;';
		}
	?>
	var Leistung = Auswahl_Leistung.value;
  	$.ajax({
	<?php
		if($IsAdmin == 1){
			echo 'url:"formular_admin.php?Leistung=" + Leistung + "&Trainer=" + Trainer';
		}
		else{
			echo'url:"formular_admin.php?Leistung=" + Leistung';
		}
	?>,
   method:"POST",
   data:{limit:limit, start:start},
   cache:false,
   success:function(data)
   {
    $('#auswertungen').append(data);
    if(data == '')
    {
     $('#load_data_message').html("<button type='button' class='btn btn-info'>Keine weiteren Kommentare</button>");
     action = 'active';
    }
    else
    {
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
  if($(window).scrollTop() + $(window).height() > $("#auswertungen").height() && action == 'inactive')
  {
   action = 'active';
   start = start + limit;
   setTimeout(function(){
    load_country_data(limit, start);
   }, 1000);
  }
 });
 
};
create_formular();
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
