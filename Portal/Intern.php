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
	<link href="charts.css" rel="stylesheet" type="text/css">
	<link href="intern_daterangeslider.css" rel="stylesheet" type="text/css">
	<link href="slider-range.css" rel="stylesheet" type="text/css">
	<script type="text/javascript" src="hidefunction.js"></script>
	<script type = "text/javascript" src="color_change.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.3/Chart.min.js"></script>
	<?php
				include "intern_Draw_Charts.php";		//Pie and COlumnchart
				include "intern_Draw_Trend_Chart.php";
	?>
  <script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
  <script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/jqueryui/1.11.4/jquery-ui.min.js"></script>
  <script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/jqueryui-touch-punch/0.2.3/jquery.ui.touch-punch.min.js"></script>
  <script type="text/javascript" src="rangeslider_jquery_intern.js"> </script>
  <script type = "text/javascript" src="export_delete_data.js"></script>

</head>
<body class="text-center">
 <!-- Load an icon library to show a hamburger menu (bars) on small screens -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<link href="navigation.css" rel="stylesheet" type="text/css">
<script type="text/javascript" src="navigation.js"></script>	
    <div class="header">
<?php
	$sql = "SELECT Is_Admin FROM users WHERE username ='".$_SESSION["username"]."'";
	$exec = mysqli_query($link,$sql);
	$row = mysqli_fetch_assoc($exec);
	$IsAdmin = $row["Is_Admin"];

	if($IsAdmin==1)
	{
    	include "navigation_admin.php";
	}
	else
	{
		include "navigation.php";
	}
			
?>
<script>
	document.getElementById("Intern").className = "active";
</script>
		<h1 style="font-size:30px; margin-bottom:10px;">Internes Feedback <i class="fa fa-bullhorn" aria-hidden="true"></i> </h1>
		</div>
	<div style="width:83vw; margin:auto; @media only screen and (max-width: 600px){width:100vw}">	

	<?php
		$sql = "SELECT name, internes_feedback_abgegeben FROM users WHERE username = '".$_SESSION['username']."'";
		$result = mysqli_query($link, $sql);
		$row = mysqli_fetch_assoc($result);
		$today= strtotime("now");
		$today= date('Y-m-d',$today); 
		$new_feedback_date = date('Y-m-d', strtotime($row["internes_feedback_abgegeben"] . ' +1 weeks'));//nur einmalpro Woche ist es möglich Feedback abzugeben
		if ($today<=$new_feedback_date){
			echo"<p>Vielen Dank für dein Feedback, 7 Tage nach Abgabe kannst du erneut Feedback abgeben.</p> Erneutes Feedback möglich am: ".$new_feedback_date;
			include "intern_feedback_charts.php";
		}
		else{
			echo'<link href="Intern.css" rel="stylesheet" type="text/css">';
			echo"<p style='margin-bottom:50px'> Hier kannst du anonymes Feedback abgeben, es werden keinerlei Userdaten gespeichert.</p>";
			include "interne_Fragen.php";
		}
	?>
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
	var Frage = Auswahl_Frage_Kommentar.value;
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
   url:"intern_Kommentare.php?datum_min=" + datum_min + "&datum_max=" + datum_max + "&Frage=" + Frage,
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



	