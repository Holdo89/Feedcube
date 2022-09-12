<?php

require_once "../config.php";
require_once "session.php";

$Id=$_REQUEST["Id"];

$sql="ALTER TABLE admin DROP COLUMN Leistung_".$Id;
$result=mysqli_query($link, $sql);

$sql="DELETE FROM externes_feedback WHERE Leistung = '".$Id."'";
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