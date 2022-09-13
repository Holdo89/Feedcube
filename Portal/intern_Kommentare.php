<?php
 require_once "../config.php";
 require_once "session.php";
 
 $datum_min=$_REQUEST["datum_min"];
 $datum_max=$_REQUEST["datum_max"];
 $Frage=$_REQUEST["Frage"];

 
 if($Frage){
$query = "SELECT ".$Frage.", Datum FROM internes_feedback WHERE Datum <= '".$datum_min." 23:59:59' AND Datum >= '".$datum_max." 00:00:00'AND ".$Frage." != '' ORDER BY Datum DESC LIMIT ".$_POST["start"].", ".$_POST["limit"]."";

$exec = mysqli_query($link,$query);
while($row = mysqli_fetch_array($exec)){
		echo "
		<div class='posts'>
		<p>".$row['Datum']."</p>
		<p style= 'font-style: italic; font-size: 18px; margin-top: 20px'>".$row[$Frage]."</p>
		</div>";
	}
 }	
?>