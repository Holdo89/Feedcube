<?php

require_once "../config.php";
require_once "session.php";

$Id=$_REQUEST["Id"];

$sql = "SELECT * FROM überschrift WHERE ID = ".$Id;
$result = mysqli_query($link, $sql);
$row = mysqli_fetch_array($result);

$sql = "DELETE FROM überschrift WHERE ID = '".$Id."'";
if(mysqli_query($link, $sql)){

} else{

    echo "ERROR: Could not able to execute $sql. " . mysqli_error($link);
}

// close connection
mysqli_close($link);
//header("location: Fragen.php");

?>