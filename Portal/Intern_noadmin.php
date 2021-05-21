<?php
 require_once "session.php";
 require_once "../config.php";
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
	<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.3/Chart.min.js"></script>
	<?php
				include "intern_Draw_Charts.php";		//Pie and COlumnchart
				include "intern_Draw_Trend_Chart.php";
				include "intern_Create_Blog.php";
			?>
  <script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
  <script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/jqueryui/1.11.4/jquery-ui.min.js"></script>
  <script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/jqueryui-touch-punch/0.2.3/jquery.ui.touch-punch.min.js"></script>
  <script type="text/javascript" src="rangeslider_jquery_intern.js"> </script>
  <script type = "text/javascript" src="export_delete_data.js"></script>
  <script type = "text/javascript" src="color_change.js"></script>

</head>
<body class="text-center">
 <!-- Load an icon library to show a hamburger menu (bars) on small screens -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<link href="navigation.css" rel="stylesheet" type="text/css">
<script type="text/javascript" src="navigation.js"></script>	
    <div class="header">
	<?php
		include "navigation.php";		//Pie and COlumnchart
	?>
</div> 
	<script>
		document.getElementById("Intern_noadmin").className = "active";
	</script>
		</div> 
		<h1 style="font-size:30px; margin-bottom:10px;">Internes Feedback <i class="fa fa-bullhorn" aria-hidden="true"></i> </h1>
	</div>
	<div style="width:90vw; margin:auto; @media only screen and (max-width: 600px){width:100vw}">	

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