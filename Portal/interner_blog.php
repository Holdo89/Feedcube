<?php
 require_once "session.php";
 require_once "config.php";
?>

<!DOCTYPE HTML>
<html>
<head>
    <meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Feedback Auswertung</title>
	<link href="bootstrap.css" rel="stylesheet" type="text/css">
	<link href="charts.css" rel="stylesheet" type="text/css">
	<link href="interner_blog.css" rel="stylesheet" type="text/css">
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


  <style>

/* The Modal (background) */
.modal {
  display: none; /* Hidden by default */
  position: fixed; /* Stay in place */
  z-index: 1; /* Sit on top */
  padding-top: 100px; /* Location of the box */
  left: 0;
  top: 0;
  width: 100%; /* Full width */
  height: 100%; /* Full height */
  overflow: auto; /* Enable scroll if needed */
  background-color: rgb(0,0,0); /* Fallback color */
  background-color: rgba(0,0,0,0.4); /* Black w/ opacity */
}

/* Modal Content */
.modal-content {
  background-color: #fefefe;
  margin: auto;
  border: 1px solid #888;
  width: 60%;
}

/* The Close Button */
.close {
  color: #aaaaaa;
  float: right;
  font-size: 28px;
  font-weight: bold;
}

.close:hover,
.close:focus {
  color: #000;
  text-decoration: none;
  cursor: pointer;
}
</style>


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
			<div class="dropdown-content">			<a href="feedback_charts.php"><i class="fa fa-bar-chart" aria-hidden="true"></i> Diagramme</a>
			<a href="multiplechoice-responsive_2\tester_admin.php"><i class="fa fa-file-text-o" aria-hidden="true"></i> Formulare</a>				</div>
			</div>
			<div class="dropdown">
			<button class="dropbtn" style="background-color: #ddd; color: black;">Intern
      			<i class="fa fa-caret-down"></i>
    		</button>
			<div class="dropdown-content">
				<a href="Intern.php"><i class="fa fa-bullhorn" aria-hidden="true"></i> Feedback</a>
     			<a href="interner_blog.php" class="active"><i class="fa fa-comments-o" aria-hidden="true"></i> Blog</a>
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
		<h1>Interner Blog <i class="fa fa-comments-o" aria-hidden="true"></i></h1>    </div>
	<div style="width:90vw; margin:auto; @media only screen and (max-width: 600px){width:100vw}">
	<p>Hier kannst du anonym Kommentare und Beiträge erstellen und kommentieren </p> <p>Es werden keinerlei Userdaten gespeichert</p> 
	<form action="insert_blog.php">
	<div class="Kommentare" style="margin:auto; text-align:left">
	<div class="posts" style="padding:2px;"><textarea class = 'frage_text_blog' style="border:none;" id="Blogbeitrag" name='Blogbeitrag' cols='50' rows='4' maxlength='5000' wrap='soft' placeholder="verfasse hier deinen neuen Beitrag"></textarea>
	<button type="submit" class='fa fa-paper-plane' style="border:none; background-color:white; color:green; font-size: 13pt;margin-bottom:8px;"></button></div>
	</div>
	</form>
	<div class="Kommentare" style="margin:auto; text-align:left;">
	<span id="blog_abfrage" >
		<?php require_once "Blog_Abfrage.php"; ?>
	</span> <!--hier werden die Kommentare eingefügt-->
	</div>	
	</div>
	<!-- The Modal -->
	<div id="myModal" class="modal">
		<form action="insert_blog_kommentar.php">
		<input id="ID" name="ID" style="visibility:hidden"></input>
		<div class="Kommentare" style="margin:auto; text-align:left">
		<div class="posts" style="padding:2px;"><textarea class ='frage_text_blog' style="border:none;" id="Blogbeitrag" name='Blogbeitrag' cols='50' rows='6' maxlength='5000' wrap='soft' placeholder="verfasse hier dein Kommentar"></textarea>
		<span class="close">&times;</span>
		<button type="submit" class='fa fa-paper-plane' style="border:none; background-color:white; color:green; font-size: 13pt;margin-bottom:8px;"></button></div>
	</div>
	</form>
		</div>
	</div>

	<script>
// Get the modal

var modal = document.getElementById("myModal");

// Get the button that opens the modal
var btn = document.getElementById("Kommentar_abgeben");

// Get the <span> element that closes the modal
var span = document.getElementsByClassName("close")[0];

// When the user clicks the button, open the modal 
function display(id) {
  modal.style.display = "block";
  var div_id=document.getElementById("ID");
  div_id.value=id;
}

// When the user clicks on <span> (x), close the modal
span.onclick = function() {
  modal.style.display = "none";
}

// When the user clicks anywhere outside of the modal, close it
window.onclick = function(event) {
  if (event.target == modal) {
    modal.style.display = "none";
  }
}
</script>

	</body>
</html>