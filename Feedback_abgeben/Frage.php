<?php
// Start the session
session_start();
include "../config.php";
if(isset($_COOKIE["feedback_abgegeben"])) {
  header("location:Feedback_abgegeben.php");
}
  $ID=$_SESSION["Leistung"];

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

<link href="css/fancy.css" rel="stylesheet" type="text/css">
<link href="../Portal/slider-range.css" rel="stylesheet" type="text/css">
<input id="Singlechoicezahl" style="display:none" value=0></input>
<input id="Multiplechoicezahl" style="display:none" value=0></input>
<input id="Schiebereglerzahl" style="display:none" value=1></input>

  <?php 
    include "Frage_aus_Datenbank.php";
  ?>

</body>
</html>