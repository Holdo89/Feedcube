<?php 

// Start the session
session_start();
require_once "../config.php";
if(isset($_COOKIE["Umfrage".$_SESSION["Umfrage"]."_teilgenommen"])) {
	header("location:Feedback_abgegeben.php");
  }
$cookie_name = "Umfrage".$_SESSION["Umfrage"]."_teilgenommen";
$sql = "SELECT Intervall FROM umfragen WHERE ID = ".$_SESSION["Umfrage"];
$query = mysqli_query($link, $sql);
$result = mysqli_fetch_array($query);
if($result["Intervall"]==0){
    $result["Intervall"]=3000;
}
$cookie_value = date("Y-m-d H:i", time() + 86400*$result["Intervall"]);
setcookie($cookie_name, $cookie_value, time() + (86400*$result["Intervall"]), "/"); // 86400 = 1 day

date_default_timezone_set("Europe/Berlin");
$Datum = date("Y-m-d H:i:s");
$Umfrage = mysqli_real_escape_string($link, $_SESSION["Umfrage"]);
$Antworten_temp = $_REQUEST["Antworten_array"];
echo $Antworten_temp = $_REQUEST["Antworten_array"];

$Antworten="'".$Datum."','".$Umfrage."',".$_REQUEST["Antworten_array"]; //In dieser Variable werden alle ANtowrten zu den Fragen zusammengefasst

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
$Spaltennamen="Datum, Umfrage, ";
$Spaltennamen = $Spaltennamen.$Fragenauswahl;

// attempt insert query execution
$sql = "INSERT INTO umfragenfeedback (".$Spaltennamen.") VALUES (".$Antworten.")";
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