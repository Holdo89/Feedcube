<?php 

// Start the session
session_start();
require_once "../config.php";
if(isset($_COOKIE["feedback_abgeben"])) {
    header("location:Feedback_abgegeben.php");
}

$sql = "SELECT username FROM users WHERE name = '".$_SESSION["Trainer"]."'";
$result = mysqli_query($link, $sql);
$row = mysqli_fetch_assoc($result);

date_default_timezone_set("Europe/Berlin");
$Datum = date("Y-m-d h:i:s");
$Leistung = mysqli_real_escape_string($link, $_SESSION["Leistung"]);
$Trainer = mysqli_real_escape_string($link, $_SESSION["Trainer"]);
$Antworten_temp = $_REQUEST["Antworten_array"];
echo $Antworten_temp = $_REQUEST["Antworten_array"];

$Antworten="'".$Datum."','".$row['username']."','".$Trainer."','".$Leistung."',".$_REQUEST["Antworten_array"]; //In dieser Variable werden alle ANtowrten zu den Fragen zusammengefasst

echo $Antworten;
$Fragenauswahl = array();
//holt die ID der ausgewählten Leistung
$ID=$_SESSION["Leistung"];

//alle Spaltennamen außer Datum und ID
$sql = "SELECT ID FROM admin WHERE Leistung_".$ID." = 1 ORDER BY post_order_no ASC";
$result = mysqli_query($link, $sql) ;

while($row = mysqli_fetch_assoc($result)){
  array_push($Fragenauswahl,"Frage_".$row["ID"]);
}
$Fragenauswahl = implode(",", $Fragenauswahl);
$Spaltennamen="Datum, Username, Trainer, Leistung, ";
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

?>