<?php
 require_once "session.php";
 require_once "../config.php";
?>

<!DOCTYPE HTML>
<html>
<?php
 require_once "FEEDCUBE_icon.php"
?><head>
<link class="jsbin" href="http://ajax.googleapis.com/ajax/libs/jqueryui/1/themes/base/jquery-ui.css" rel="stylesheet" type="text/css" />
<script class="jsbin" src="http://ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js"></script>
<script class="jsbin" src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8.0/jquery-ui.min.js"></script>

    <meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Feedback Auswertung</title>
	<link href="bootstrap.css" rel="stylesheet" type="text/css">
	<link href="charts.css" rel="stylesheet" type="text/css">
	<link href="system_optionen.css" rel="stylesheet" type="text/css">
	<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.3/Chart.min.js"></script>
	<?php
	include "Leistung_speichern.php";
	?>
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
			<a href="forms_admin.php"><i class="fa fa-file-text-o" aria-hidden="true"></i> Formulare</a>				</div>
			</div>
			<div class="dropdown">
			<button class="dropbtn">Intern
      			<i class="fa fa-caret-down"></i>
    		</button>
			<div class="dropdown-content">
				<a href="Intern.php"><i class="fa fa-bullhorn" aria-hidden="true"></i> Feedback</a>
     			<a href="interner_blog.php"><i class="fa fa-comments-o" aria-hidden="true"></i> Blog</a>
			</div>
			</div>
			<div class="dropdown">
			<button class="dropbtn" style="background-color: #ddd; color: white;">Optionen 
      			<i class="fa fa-caret-down"></i>
    		</button>
			<div class="dropdown-content">
			<a href="Fragen.php"><i class="fa fa-question-circle-o" aria-hidden="true"></i> Feedbackfragen</a>
      				<a href="Usermanagement.php"><i class="fa fa-users" aria-hidden="true"></i> Benutzer</a>
					<a href="Leistungmanagement.php" class="active"><i class="fa fa-graduation-cap" aria-hidden="true"></i> Leistungen</a>
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
		<h1 style="font-size:30px; margin-bottom:10px;">System <i class="fa fa-cog" aria-hidden="true"></i> </h1>
		<p style="margin-bottom:30px"> Systemeinstellungen und Look and Feel </p>	</div>
		</div>
	<div class="scroll">
	<style>
	.überschrift{
		background-color: <?php $sql='SELECT farbe FROM system'; $exec=mysqli_query($link,$sql); $result=mysqli_fetch_assoc($exec); echo $result['farbe']?>;
	}
	</style>
	<form>
	<label class="überschrift">Lizenz</label><label class="überschrift"></label>
	<label>Lizenzmodell:</label>
	<div class="system" id="Lizenzmodell" name="Lizemzmodell">Freepeak <button>Upgrade</button></div>
	<label>Lizenz gültig bis:</label>
	<div class="system" id="Lizenzdatum" name="Lizenzdatum">Unlimited</div>
	<label>max Anzahl an Benutzern:</label>
	<div class="system" id="max_user" name="max_user">3</div>
	<label>genutzte Anzahl an Benutzern:</label>
	<div class="system" id="used_user" name="used_user">3</div>
	</form>

	<form action="upload.php" method="post" enctype="multipart/form-data" style="margin-top:10px;">
	<label class="überschrift">Look & Feel</label><label class="überschrift"></label>
	
	<script>
	function user_abfrage_speichern(id) {
			speichern(id);
	;}
	function user_abfrage_löschen(id) {
  	if (confirm("Wollen Sie diese Leistung entfernen? Ihre bestehenden Antworten zu dieser Leistung werden ebenfalls entfernt"))
	  {entfernen(id);
		alert("Die Leistung wurde gelöscht");
		location.reload();}
	;}

	function readURL(input, filename) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function (e) {
                $(filename)
                    .attr('src', e.target.result)
                    .width(150)
                    .height(80);
            };

            reader.readAsDataURL(input.files[0]);
        }
    }


	</script>
	<?php
	$url = $_SERVER['HTTP_HOST'].$_SERVER['PHP_SELF'];
	$parsedUrl = parse_url($url);
	$host = explode('.', $url);
	$subdomain = $host[0];
	?>

	<label>Farbschema:</label>
	<input type="color" id="favcolor" name="favcolor" value="<?php $sql="SELECT farbe FROM system"; $exec=mysqli_query($link,$sql); $result=mysqli_fetch_assoc($exec); echo $result['farbe']?>" style="margin:12px; padding:2px; width:90px; height:30px;"></input>
	
	<label> Logo Feedback abgeben:</label>
	<div>
	<input type="file" id="logo" name="logo" onchange="readURL(this,'#logo_view');"></input>
	<img id="logo_view" src="../assets/<?php echo $subdomain ?>/logo/<?php
	$dir = "../assets/".$subdomain."/logo/";
	$file = scandir($dir);
	echo $file[2]; //notwendig weil 0=.und 1=..
	?>" alt="your image" width="100px" />
	</div>

	<label>Hintergrund Feedback abgeben:</label>
	<div>
	<input type="file" id="bgimage" name="bgimage" onchange="readURL(this,'#bgimage_view');"></input>
	<img id="bgimage_view" src="../assets/<?php echo $subdomain ?>/bg_givefb/<?php
	$dir = "../assets/".$subdomain."/bg_givefb/";
	$file = scandir($dir);
	echo $file[2];
	?>" alt="your image" width="100px" />
	</div>
	
	<label>Hintergrund Feedcube login:</label>
	<div>
	<input type="file" id="bgimage2" name="bgimage2" onchange="readURL(this,'#bgimage_view2');"></input>
	<img id="bgimage_view2" src="../assets/<?php echo $subdomain ?>/bg_loginfb/<?php
	$dir = "../assets/".$subdomain."/bg_loginfb/";
	$file = scandir($dir);
	echo $file[2];
?>" alt="your image" width="100px" />
	</div>
	<label></label>
	<input class="btn fa-input"  type="submit" value="&#xf0C7; speichern" style="margin-top:30px; margin-bottom:30px;"></input>
	</form>
	</div>
    </body>
</html>