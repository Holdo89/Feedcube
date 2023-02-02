<?php

require_once "../config.php";
require_once "session.php";

$Id=$_REQUEST["Id"];

$sql="ALTER TABLE fragen DROP COLUMN Leistung_".$Id;
$result=mysqli_query($link, $sql);

$sql="DELETE FROM kursfeedback WHERE Leistung = '".$Id."'";
$result=mysqli_query($link, $sql);

$sql = "DELETE FROM leistungen WHERE ID = '".$Id."'";
if(mysqli_query($link, $sql)){

} else{
    echo "ERROR: Could not able to execute $sql. " . mysqli_error($link);
}

// close connection
mysqli_close($link);
header("location: Fragen.php");
?>