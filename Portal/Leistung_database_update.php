<?php
 require_once "../config.php";
 require_once "session.php";
 $Id=$_REQUEST["Id"];
 $Leistung=$_REQUEST["Leistung"];

$query = "UPDATE leistungen SET Leistung = '".$Leistung."' WHERE ID = '".$Id."'";
$exec = mysqli_query($link,$query);

?>