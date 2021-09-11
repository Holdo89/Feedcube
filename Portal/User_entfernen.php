<?php

require_once "../config.php";
require_once "session.php";

$Id=$_REQUEST["Id"];
$Username=$_REQUEST["Username"];


$sql="DELETE FROM externes_feedback WHERE Username = '".$Username."'";

$result=mysqli_query($link, $sql);

$sql = "DELETE FROM users WHERE id = '".$Id."'";

if(mysqli_query($link, $sql)){

} else{

    echo "ERROR: Could not able to execute $sql. " . mysqli_error($link);

}



// close connection

mysqli_close($link);

header("location: Start.php");

?>