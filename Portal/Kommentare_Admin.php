<?php

 require_once "session.php";

 require_once "../config.php";

 

 $Trainer=$_REQUEST["Trainer"];

 $datum_min=$_REQUEST["datum_min"];

 $datum_max=$_REQUEST["datum_max"];

 $Leistung=$_REQUEST["Leistung"];

 $Frage=$_REQUEST["Frage"];



if($Leistung && $Frage !="undefined"){

 

if($Trainer=='externes_feedback'){

	$query = "SELECT ".$Frage.", Datum, Leistung FROM externes_feedback WHERE Datum <= '".$datum_min." 23:59:59' AND Datum >= '".$datum_max." 23:59:59'AND ".$Frage." != '' AND Leistung LIKE '".$Leistung."' ORDER BY Datum DESC";

}

else{

	$query = "SELECT ".$Frage.", Datum, Leistung FROM externes_feedback WHERE Datum <= '".$datum_min." 23:59:59' AND Datum >= '".$datum_max." 23:59:59'AND ".$Frage." != '' AND Username='".$Trainer."' AND Leistung LIKE '".$Leistung."' ORDER BY Datum DESC";

}

$exec = mysqli_query($link,$query);

while($row = mysqli_fetch_array($exec)){

		echo "

		<div class='posts'>

		<p>".$row['Datum'].",  ".$row['Leistung']."</p>

		<p style= 'font-style: italic; font-size: 18px; margin-top: 20px'>".$row[$Frage]."</p>

		</div>";

	}

}

?>