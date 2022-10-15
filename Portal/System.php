<?php
 require_once "../config.php";
 require_once "session.php";
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
<script src="https://kit.fontawesome.com/9059ff5bc6.js" crossorigin="anonymous"></script>
<link href="navigation.css" rel="stylesheet" type="text/css">
<script type="text/javascript" src="navigation.js"></script>	
    <div class="header">
	<?php
	include "navigation_admin.php";
?>
<script>
	document.getElementById("System").className = "active";
</script> 
		<h1 style="font-size:30px; margin-bottom:10px;">System <i class="fa fa-cog" aria-hidden="true"></i> </h1>
		<p style="margin-bottom:30px"> Systemeinstellungen und Look and Feel </p>	</div>
		</div>
	<div class="scroll">
	<style>
	.überschrift{
		background-color: <?php $sql='SELECT farbe FROM system'; $exec=mysqli_query($link,$sql); $result=mysqli_fetch_assoc($exec); echo $result['farbe']?>;
	}
	</style>
	<!--
	<form>
	<label class="überschrift">Lizenz</label><label class="überschrift"></label>
	<label>Lizenzmodell:</label>
	<div class="system" id="Lizenzmodell" name="Lizemzmodell">Free Version <button>Upgrade</button></div>
	<label>Lizenz gültig bis:</label>
	<div class="system" id="Lizenzdatum" name="Lizenzdatum">Unlimited</div>
	<label>max Anzahl an Benutzern:</label>
	<div class="system" id="max_user" name="max_user">5</div>
	<label>genutzte Anzahl an Benutzern:</label>
	<div class="system" id="used_user" name="used_user">5</div>
	</form>
-->
	<form action="updateText.php" method="post" enctype="multipart/form-data" style="margin-top:10px; grid-template-columns: auto;">
	<label class="überschrift">Feedback Abgabe</label><label class="überschrift"></label>
	<label style="margin-bottom:-13px;">Text vor Feedback Abgabe:</label>
	<textarea name ="Text_vor_Abgabe" rows="3" cols="50" style="border: 0.5px solid rgba(0, 0, 0, 0.2); border-radius:3px; margin:10px;">
<?php
	$sql = "SELECT Text_vor_Abgabe FROM system";
	$query = mysqli_query($link, $sql);
	$result = mysqli_fetch_array($query);
	echo $result["Text_vor_Abgabe"];
?>
	</textarea>
	<label style="margin-bottom:-13px;">Übersetzung:</label>
	<textarea name="Text_before_Feedback" rows="3" cols="50" style="border: 0.5px solid rgba(0, 0, 0, 0.2); border-radius:3px; margin:10px;margin-bottom:10px;">
<?php
	$sql = "SELECT Text_before_Feedback FROM system";
	$query = mysqli_query($link, $sql);
	$result = mysqli_fetch_array($query);
	echo $result["Text_before_Feedback"];
?>
	</textarea>

	<label style="margin-bottom:-13px;">Text nach Feedback Abgabe:</label>
	<textarea name="Text_nach_Abgabe"rows="3" cols="50" style="border: 0.5px solid rgba(0, 0, 0, 0.2); border-radius:3px; margin:10px;">
<?php
	$sql = "SELECT Text_nach_Abgabe FROM system";
	$query = mysqli_query($link, $sql);
	$result = mysqli_fetch_array($query);
	echo $result["Text_nach_Abgabe"];
?>
	</textarea>
	<label style="margin-bottom:-13px;">Übersetzung:</label>
	<textarea name="Text_after_Feedback" rows="3" cols="50" style="border: 0.5px solid rgba(0, 0, 0, 0.2); border-radius:3px; margin:10px;">
<?php
	$sql = "SELECT Text_after_Feedback FROM system";
	$query = mysqli_query($link, $sql);
	$result = mysqli_fetch_array($query);
	echo $result["Text_after_Feedback"];
?>
	</textarea>
	<div></div>
	<input class="btn fa-input"  type="submit" value="&#xf0C7; speichern" style="margin:auto; margin-top:30px; margin-bottom:30px; color:white; background-color:<?php $sql='SELECT farbe FROM system'; $exec=mysqli_query($link,$sql); $result=mysqli_fetch_assoc($exec); echo $result['farbe']?>"></input>
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
	<input type="file" accept="image/*" id="logo" name="logo" onchange="readURL(this,'#logo_view');"></input>
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
	<input class="btn fa-input"  type="submit" value="&#xf0C7; speichern" style="margin:auto; grid-column: 1 / span 2; margin-top:30px; margin-bottom:30px; color:white; background-color:<?php $sql='SELECT farbe FROM system'; $exec=mysqli_query($link,$sql); $result=mysqli_fetch_assoc($exec); echo $result['farbe']?>"></input>
	</form>
	</div>
    </body>
</html>