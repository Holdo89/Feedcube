<?php
// Start the session
session_start();
include "../config.php";
  $ID=$_SESSION["Umfrage"];
  if(isset($_COOKIE["Umfrage".$_SESSION["Umfrage"]."_teilgenommen"])) {
    header("location:Feedback_abgegeben.php");
    }
?>

<!doctype html>
<html lang="en">
<?php
 require_once "FEEDCUBE_icon.php"
?>
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Feedback abgeben</title>
  </head>

<body id ='body' style= "background-image: url('../assets/<?php echo $subdomain ?>/bg_givefb/<?php
	$dir = "../assets/".$subdomain."/bg_givefb/";
	$file = scandir($dir);
	echo $file[2];
	?>');">

<link href="css/fancy.css?v=1" rel="stylesheet" type="text/css">
<link href="../Portal/slider-range.css?v=1" rel="stylesheet" type="text/css">
<input id="Bewertungzahl" style="display:none" value=0></input>
<input id="Multiplechoicezahl" style="display:none" value=0></input>
<input id="Schiebereglerzahl" style="display:none" value=1></input>

  <?php 
    include "Frage_aus_Datenbank.php";
  ?>

</body>
</html>