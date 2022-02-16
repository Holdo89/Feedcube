<?php 

// Start the session
session_start();
require_once "../config.php";
if(isset($_COOKIE["feedback_abgeben"])) {
    header("location:Feedback_abgegeben.php");
}

$Umfrage = mysqli_real_escape_string($link, $_SESSION["Umfrage"]);
$Antworten_temp = $_REQUEST["Antworten_array"];
echo $Antworten_temp = $_REQUEST["Antworten_array"];

$Antworten="'".$Umfrage."',".$_REQUEST["Antworten_array"]; //In dieser Variable werden alle ANtowrten zu den Fragen zusammengefasst

echo $Antworten;
$Fragenauswahl = array();
//holt die ID der ausgewählten Leistung
$ID=$_SESSION["Umfrage"];

//alle Spaltennamen außer Datum und ID
$sql = "SELECT ID FROM intern WHERE Umfrage_".$ID." = 1 ORDER BY post_order_no ASC";
$result = mysqli_query($link, $sql) ;

while($row = mysqli_fetch_assoc($result)){
  array_push($Fragenauswahl,"Frage_".$row["ID"]);
}
$Fragenauswahl = implode(",", $Fragenauswahl);
$Spaltennamen="Umfrage, ";
$Spaltennamen = $Spaltennamen.$Fragenauswahl;

// attempt insert query execution
$sql = "INSERT INTO internes_feedback (".$Spaltennamen.") VALUES (".$Antworten.")";
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