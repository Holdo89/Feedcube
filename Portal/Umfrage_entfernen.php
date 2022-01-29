<?php

require_once "../config.php";
require_once "session.php";

$Id=$_REQUEST["Id"];

$Umfrage=$_REQUEST["Umfrage"];

$sql="ALTER TABLE intern DROP COLUMN Umfrage_".$Id;
$result=mysqli_query($link, $sql);

$sql="DELETE FROM internes_feedback WHERE Umfrage = '".$Umfrage."'";
$result=mysqli_query($link, $sql);

$sql = "DELETE FROM umfragen WHERE ID = '".$Id."'";
$result=mysqli_query($link, $sql);

// close connection
mysqli_close($link);
header("location: Umfragen.php");
?>