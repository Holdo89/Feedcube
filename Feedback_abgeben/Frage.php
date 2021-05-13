<?php
// Start the session
session_start();
include "../Portal/config.php";
if(isset($_COOKIE["feedback_abgegeben"])) {
  header("location:Feedback_abgegeben.php");
}

$questionmarkpos = strpos($_SERVER['REQUEST_URI'],"?");
$backindex = intval(substr($_SERVER['REQUEST_URI'],$questionmarkpos+1))+1;

while($_SESSION["Fragenindex"]>$backindex){
  $_SESSION["Backbutton"]=true;
  $_SESSION["Fragenindex"] = $_SESSION["Fragenindex"]-1;
}

if($_SESSION["Helpindex"]){
    $_SESSION["Trainer"] = $_REQUEST["Auswahl_Trainer"];
    $_SESSION["Leistung"] = $_REQUEST["Auswahl_Leistung"];
    $_SESSION["Helpindex"]=false;
  }

else{
    if($_SESSION["Backbutton"]==false)
    {
      if(gettype($_REQUEST['element_1'])=="array")
      {  
            array_push($_SESSION["Fragen"], implode("|",$_REQUEST['element_1']));
      }
      else{
        array_push($_SESSION["Fragen"], $_REQUEST['element_1']);
      }
    }
    else{
      $_SESSION["Backbutton"]=false;
    }
}

//holt die ID der ausgewählten Leistung
  $sql = "SELECT ID FROM leistungen WHERE Leistung = '".$_SESSION["Leistung"]."'";
  $result = mysqli_query($link,$sql);
  $rows = mysqli_fetch_assoc($result);
  $ID=$rows["ID"];

?>

<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Feedback abgeben</title>
  </head>

<body style= "background-image: url('../assets/<?php echo $subdomain ?>/bg_givefb/<?php
	$dir = "../assets/".$subdomain."/bg_givefb/";
	$file = scandir($dir);
	echo $file[2];
	?>');">

<link href="css/fancy.css" rel="stylesheet" type="text/css">
<link href="../Feedcube/slider-range.css" rel="stylesheet" type="text/css">

  <?php 
    include "Frage_aus_Datenbank.php";
  ?>

</body>
</html>