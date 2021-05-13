<?php

// Start the session

require_once "session.php";
require_once "../config.php";

$neues_Fragenset = mysqli_real_escape_string($link, $_REQUEST["neues_Fragenset"]);

$sql = "INSERT INTO fragensets(Fragenset) VALUES ('$neues_Fragenset')";

if(mysqli_query($link, $sql)){

} else{

    echo "ERROR: Could not able to execute $sql. " . mysqli_error($link);

}

$sql = "SELECT ID FROM fragensets ORDER BY ID DESC LIMIT 1";
$result=mysqli_query($link, $sql);
$row = mysqli_fetch_assoc($result);

$sql= "ALTER TABLE admin ADD Fragenset_".$row['ID']." tinyint(1)";
$result=mysqli_query($link, $sql);

mysqli_close($link);
header("location: Leistungmanagement.php");

?>