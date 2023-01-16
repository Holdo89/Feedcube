<?php

include "IsAdmincheck.php";

 $datum_min=$_REQUEST["datum_min"];
 $datum_max=$_REQUEST["datum_max"];
 $Leistung=$_REQUEST["Leistung"];
 $Trainer=$_REQUEST["Trainer"];

 echo"Test,";

 if($Trainer !="undefined"){
	$query = "SELECT * FROM users WHERE username LIKE '".$Trainer."' AND Is_Trainer = 1 ORDER BY name";
	$exec = mysqli_query($link,$query);
	while($row = mysqli_fetch_array($exec))
	{
		$sql_leistungen = "SELECT COUNT(ID) AS Anzahl FROM externes_feedback WHERE Datum <= '".$datum_min." 23:59:59' AND Datum >= '".$datum_max." 00:00:00' AND Username LIKE '".$row["username"]."' AND Leistung LIKE '".$Leistung."'";
		$exec_leistungen = mysqli_query($link,$sql_leistungen);
		$row_leistungen = mysqli_fetch_array($exec_leistungen);
		echo $row_leistungen["Anzahl"].",";
	}
 } 
else{
	echo"nomultiplechoice";
}
?>