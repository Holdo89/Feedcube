<?php

require_once "session.php";

require_once "config.php";

$Id=$_REQUEST["Id"];

$Bool=$_REQUEST["Bool"];



$sql = "UPDATE users SET Is_Trainer = ".$Bool." WHERE id = '".$Id."'";

if(mysqli_query($link, $sql)){

} else{

    echo "ERROR: Could not able to execute $sql. " . mysqli_error($link);

}



// close connection

mysqli_close($link);

header("location: Usermanagement.php");

?>

