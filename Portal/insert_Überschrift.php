<?php

// Start the session

require_once "../config.php";
require_once "session.php";

$Überschrift = mysqli_real_escape_string($link, $_REQUEST["Überschrift"]);
$Überschrift_Übersetzung = mysqli_real_escape_string($link, $_REQUEST["Überschrift_Übersetzung"]);

$sql = "INSERT INTO überschrift (Überschrift, Überschrift_Übersetzung) VALUES ('$Überschrift','$Überschrift_Übersetzung')";

if(mysqli_query($link, $sql)){

} else{
    echo "ERROR: Could not able to execute $sql. " . mysqli_error($link);
}


mysqli_close($link);

$Step = $_REQUEST["Step"];
if($Step == 7)
{
    header("location: Fragen.php?Step=2");
}
else{
    header("location: Fragen.php");
}


?>