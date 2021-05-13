<?php

 require_once "session.php";
 require_once "../config.php";

 $Id=$_REQUEST["Id"];
 $Fragenset=$_REQUEST["Fragenset"];
$query = "UPDATE fragensets SET Fragenset = '".$Fragenset."' WHERE ID = '".$Id."'";
$exec = mysqli_query($link,$query);

?>