<?php
// Start the session
session_start();
require_once "../config.php";
if(isset($_COOKIE["feedback_abgeben"])) {
    header("location:Feedback_abgegeben.php");
}
if(gettype($_REQUEST['element_1'])=="array")
{  
      array_push($_SESSION["Fragen"], implode("|",$_REQUEST['element_1']));
}
else{
  array_push($_SESSION["Fragen"], $_REQUEST['element_1']);
}
$sql = "SELECT username FROM users WHERE name = '".$_SESSION["Trainer"]."'";
$result = mysqli_query($link, $sql);
$row = mysqli_fetch_assoc($result);

$Leistung = mysqli_real_escape_string($link, $_SESSION["Leistung"]);
$Trainer = mysqli_real_escape_string($link, $_SESSION["Trainer"]);

$Antworten="'".$row['username']."','".$Trainer."','".$Leistung."'"; //In dieser Variable werden alle ANtowrten zu den Fragen zusammengefasst
$index_Frage=0;

while($index_Frage<=$_SESSION["Fragenindex"]-2){//-2 weil index von 0startet und vorher der Fragenindex um 1 zusätzlich erhöht wurde
// Escape user inputs for security
    $Antworten=$Antworten.",'".mysqli_real_escape_string($link, $_SESSION["Fragen"][$index_Frage])."'";
    $index_Frage=$index_Frage+1;
}

//holt die ID der ausgewählten Leistung
$ID=$_SESSION["Leistung"];

//alle Spaltennamen außer Datum und ID
$sql = "SELECT ID FROM admin WHERE Leistung_".$ID." = 1 ORDER BY post_order_no ASC";
$result = mysqli_query($link, $sql) ;

while($row = mysqli_fetch_assoc($result)){
  array_push($_SESSION["Fragen_ID"],"Frage_".$row["ID"]);
}

$Spaltennamen="Username, Trainer, Leistung, ";
$Fragenauswahl = implode(",",$_SESSION["Fragen_ID"]);
$Spaltennamen = $Spaltennamen.$Fragenauswahl;

// attempt insert query execution
$sql = "INSERT INTO externes_feedback (".$Spaltennamen.") VALUES (".$Antworten.")";
$dir = "../assets/".$subdomain."/logo/";
$file = scandir($dir);
if(mysqli_query($link, $sql)){
    header("location:Feedback_abgegeben.php");
} 
else{
    echo "ERROR: Could not able to execute $sql. " . mysqli_error($link);
}
 
// close connection
mysqli_close($link);
?>
</body>
</html>