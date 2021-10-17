<?php

require_once "../config.php";
require_once "session.php"; 

 $Trainer=$_REQUEST["Trainer"];
 $datum_min=$_REQUEST["datum_min"];
 $datum_max=$_REQUEST["datum_max"];
 $Leistung=$_REQUEST["Leistung"];
 $Frage=$_REQUEST["Frage"];
 $Zeitraum = $_REQUEST["Zeitraum"];
 if($Zeitraum != "Benutzerdefiniert")
 {
	 $datum_min = date("Y-m-d");
	 $datum_max = date('Y-m-d', strtotime("-".$Zeitraum));
 }
 
if($Leistung && $Frage !="undefined"){

		$query = "SELECT ".$Frage.", Datum, Leistung FROM externes_feedback WHERE Datum <= '".$datum_min." 23:59:59' AND Datum >= '".$datum_max." 23:59:59'AND ".$Frage." != '' AND Username LIKE '".$Trainer."' AND Leistung LIKE '".$Leistung."' ORDER BY Datum DESC LIMIT ".$_POST["start"].", ".$_POST["limit"]."";

	$exec = mysqli_query($link,$query);
	while($row = mysqli_fetch_array($exec)){
		$sql_leistung = "SELECT Leistung FROM leistungen WHERE ID = ".$row['Leistung'];
		$query_leistung = mysqli_query($link, $sql_leistung);
		$row_Leistung = mysqli_fetch_array($query_leistung);
		$Leistung = $row_Leistung["Leistung"];
		echo "
		<div class='posts'>
		<p style= 'font-style: italic; font-size: 13px'>".$row['Datum'].",  ".$Leistung."</p>
		<p style= 'font-style: italic; font-size: 18px; margin-top: 20px'>".$row[$Frage]."</p>
		</div>";
	}
}

?>
