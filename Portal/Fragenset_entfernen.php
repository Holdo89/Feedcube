<?php

require_once "../config.php";
require_once "session.php";

$Id=$_REQUEST["Id"];
$Fragenset=$_REQUEST["Fragenset"];

$sql = "UPDATE leistungen SET Fragenset = '0' WHERE Fragenset = '".$Id."'";
mysqli_query($link,$sql); 

$sql="ALTER TABLE fragen DROP COLUMN Fragenset_".$Id;
$result=mysqli_query($link, $sql);

$sql = "DELETE FROM fragensets WHERE ID = '".$Id."'";
if(mysqli_query($link, $sql)){

} else{
    echo "ERROR: Could not able to execute $sql. " . mysqli_error($link);
}

// close connection
mysqli_close($link);
header("location: Fragen.php");
?>