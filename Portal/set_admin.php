<?php
require_once "../config.php";
require_once "session.php";
$Id=$_REQUEST["Id"];
$Bool=$_REQUEST["Bool"];

$sql = "UPDATE users SET Is_Admin = ".$Bool." WHERE id = '".$Id."'";
if(mysqli_query($link, $sql)){
} else{
    echo "ERROR: Could not able to execute $sql. " . mysqli_error($link);
}

// close connection
mysqli_close($link);
if(isset($_REQUEST["Step"]))
{
    $Step = $_REQUEST["Step"];
    header("location: Usermanagement.php?Step=".$Step);
}
else{
    header("location: Usermanagement.php");
}
?>
