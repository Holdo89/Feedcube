<?php

 require_once "session.php";

 require_once "../config.php";


 $datum_min=$_REQUEST["datum_min"];

 $datum_max=$_REQUEST["datum_max"];

$sql = "DELETE FROM internes_feedback WHERE Datum <= '".$datum_min." 23:59:59' AND Datum >= '".$datum_max." 23:59:59'";
   
mysqli_query($link, $sql);

// close connection

mysqli_close($link);

header("location.reload()");
header("location.reload()");

?>