<?php
 require_once "../config.php";
 require_once "session.php";
 $Id=$_REQUEST["Id"];
 $Umfrage=$_REQUEST["Umfrage"];

$query = "UPDATE umfragen SET Umfrage = '".$Umfrage."' WHERE ID = '".$Id."'";
$exec = mysqli_query($link,$query);

?>