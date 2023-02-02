<?php

// Start the session

require_once "../config.php";
require_once "session.php";

$Id = $_REQUEST["ID"];
$sql = "SELECT Überschrift FROM überschrift WHERE ID=".$Id;
$result = mysqli_query($link, $sql);
$row = mysqli_fetch_array($result);
$Alte_Überschrift = $row["Überschrift"];

$Überschrift = mysqli_real_escape_string($link, $_REQUEST["Überschrift"]);
$Überschrift_Übersetzung = mysqli_real_escape_string($link, $_REQUEST["Überschrift_Übersetzung"]);

$sql = "UPDATE überschrift SET Überschrift = '$Überschrift', Überschrift_Übersetzung='$Überschrift_Übersetzung' WHERE ID=".$Id;

if(mysqli_query($link, $sql)){

} else{
    echo "ERROR: Could not able to execute $sql. " . mysqli_error($link);
}

$sql = "UPDATE fragen SET Überschrift = '$Überschrift', Überschrift_Englisch='$Überschrift_Übersetzung' WHERE Überschrift='".$Alte_Überschrift."'";

if(mysqli_query($link, $sql)){

} else{
    echo "ERROR: Could not able to execute $sql. " . mysqli_error($link);
}


mysqli_close($link);
$Step = $_REQUEST["Step"];
if ($Step == 2) {
    header("location: Fragen.php?Step=2");
} else {
    header("location: Fragen.php");
}




?>