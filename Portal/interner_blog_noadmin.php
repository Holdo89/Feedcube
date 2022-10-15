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
    <title>FAQ</title>
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
<script src="https://kit.fontawesome.com/9059ff5bc6.js" crossorigin="anonymous"></script>
<link href="navigation.css" rel="stylesheet" type="text/css">
<script type="text/javascript" src="navigation.js"></script>	
    <div class="header">
	<?php
		include "navigation.php";		//Pie and COlumnchart
	?>
	<script>
		document.getElementById("intern_blog_noadmin").className = "active";
	</script>
	</div> 
		<h1 style="font-size:30px; margin-bottom:20px;"><img src="../assets/brand/chat.png" width="60" style="margin-top:-10px;"> Blog </h1>
    </div>
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