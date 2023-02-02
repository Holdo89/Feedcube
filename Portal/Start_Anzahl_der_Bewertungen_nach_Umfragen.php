<?php

include "../config.php";

 $datum_min=$_REQUEST["datum_min"];
 $datum_max=$_REQUEST["datum_max"];
 $Umfrage=$_REQUEST["Umfrage"];
 echo"Test,";

 if($Umfrage !="undefined"){
	$query = "SELECT * FROM umfragen WHERE ID LIKE '".$Umfrage."' ORDER BY Umfrage";
	$exec = mysqli_query($link,$query);
	while($row = mysqli_fetch_array($exec))
	{
		$sql_leistungen = "SELECT COUNT(ID) AS Anzahl FROM umfragenfeedback WHERE Datum <= '".$datum_min." 23:59:59' AND Datum >= '".$datum_max." 00:00:00' AND Umfrage LIKE '".$row["ID"]."'";
		$exec_leistungen = mysqli_query($link,$sql_leistungen);
		$row_leistungen = mysqli_fetch_array($exec_leistungen);
		echo $row_leistungen["Anzahl"].",";
	}
 } 
else{
	echo"nomultiplechoice";
}
?>