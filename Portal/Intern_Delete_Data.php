<?php

 require_once "../config.php";
 require_once "session.php";


 $datum_min=$_REQUEST["datum_min"];

 $datum_max=$_REQUEST["datum_max"];
 $Zeitraum = $_REQUEST["Zeitraum"];
 if($Zeitraum != "Benutzerdefiniert")
 {
	 $datum_min = date("Y-m-d");
	 $datum_max = date('Y-m-d', strtotime("-".$Zeitraum));
 }

$sql = "DELETE FROM internes_feedback WHERE Datum <= '".$datum_min." 23:59:59' AND Datum >= '".$datum_max." 23:59:59'";
   
mysqli_query($link, $sql);

// close connection

mysqli_close($link);

header("location.reload()");
header("location.reload()");

?>