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
	<script type = "text/javascript" src="color_change.js"></script>
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

</head>
<body class="text-center">
 <!-- Load an icon library to show a hamburger menu (bars) on small screens -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<link href="navigation.css" rel="stylesheet" type="text/css">
<script type="text/javascript" src="navigation.js"></script>	
    <div class="header">
				<div class="topnav" id="myTopnav" style="background-color:<?php $sql="SELECT farbe FROM system"; $exec=mysqli_query($link,$sql); $result=mysqli_fetch_assoc($exec); echo $result['farbe']?>">

        <a class="image" style="padding:0px; padding-bottom:5px;"href="Start.php">

			<img src="../assets/brand/FEEDCUBE_logo.png" style="float:left; margin-right:30px; margin-left:15px; margin-top:3px;" width="50" height="50">
        </a>
						<a style="  margin-bottom:20px; visibility: hidden;"></a>
			<div class="dropdown">
			<button class="dropbtn">Auswertung 
      			<i class="fa fa-caret-down"></i>
    		</button>
			<div class="dropdown-content">			
				<a href="feedback_charts.php"><i class="fa fa-bar-chart" aria-hidden="true"></i> Diagramme</a>
				<a href="forms_admin.php"><i class="fa fa-file-text-o" aria-hidden="true"></i> Formulare</a>				
			</div>
			</div>
			<div class="dropdown">
			<button class="dropbtn" style="background-color: #ddd; color: black;">Intern
      			<i class="fa fa-caret-down"></i>
    		</button>
			<div class="dropdown-content">
				<a href="Intern.php" class="active"><i class="fa fa-bullhorn" aria-hidden="true"></i> Feedback</a>
     			<a href="interner_blog.php"><i class="fa fa-comments-o" aria-hidden="true"></i> Blog</a>
			</div>
			</div>
			<div class="dropdown">
			<button class="dropbtn">Optionen 
      			<i class="fa fa-caret-down"></i>
    		</button>
			<div class="dropdown-content">
     				<a href="Fragen.php"><i class="fa fa-question-circle-o" aria-hidden="true"></i> Feedbackfragen</a>

      				<a href="Usermanagement.php"><i class="fa fa-users" aria-hidden="true"></i> Benutzer</a>
					<a href="Leistungmanagement.php"><i class="fa fa-graduation-cap" aria-hidden="true"></i> Leistungen</a>
				</div>
			</div>
			<a href="javascript:void(0);" class="icon" onclick="myFunction()">
			<i class="fa fa-bars"></i>
			</a>
			<div class="dropdown" style="float:right; margin-right:50px;">
			<button class="dropbtn"><i class="fa fa-user"></i> 
    		</button>
			<div class="dropdown-content" style="right:0; margin-right:20px;">
				<a href="reset-password.php"><i class="fa fa-lock" aria-hidden="true"></i> Passwort reset</a>
				<a href="logout.php"><i class="fa fa-sign-out" aria-hidden="true"></i> Abmelden</a>
			</div>
			</div>
			<a style="float:right; margin-right:10px;"href="System.php"><i class="fa fa-cog" aria-hidden="true"></i></a>
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