<?php

// Start the session

require_once "../config.php";
require_once "session.php";



$neuer_Leistung = mysqli_real_escape_string($link, $_REQUEST["neuer_Leistung"]);



$sql = "INSERT INTO leistungen (Leistung) VALUES ('$neuer_Leistung')";

if(mysqli_query($link, $sql)){

} else{

    echo "ERROR: Could not able to execute $sql. " . mysqli_error($link);

}

$sql = "SELECT ID FROM leistungen ORDER BY ID DESC LIMIT 1";
$result=mysqli_query($link, $sql);
$row = mysqli_fetch_assoc($result);

$sql= "ALTER TABLE admin ADD Leistung_".$row['ID']." tinyint(1)";
$result=mysqli_query($link, $sql);

mysqli_close($link);
header("location: Tutorial_Leistungen.php");

?>