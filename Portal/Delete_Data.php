<?php

 require_once "../config.php";
 require_once "session.php";


 $datum_min=$_REQUEST["datum_min"];

 $datum_max=$_REQUEST["datum_max"];

 $Leistung=$_REQUEST["Leistung"];

 $Frage=$_REQUEST["Frage"];

 $Frage_ID=substr($Frage,6);

 $Trainer=$_REQUEST["Trainer"];
  
 $sql = "DELETE FROM externes_feedback WHERE Datum <= '".$datum_min." 23:59:59' AND Datum >= '".$datum_max." 23:59:59'AND Leistung LIKE '".$Leistung."' AND Username LIKE '".$Trainer."'";

mysqli_query($link, $sql);



// close connection

mysqli_close($link);

header("location.reload()");

?>