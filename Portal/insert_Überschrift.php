<?php

// Start the session

require_once "../config.php";
require_once "session.php";

$Überschrift = mysqli_real_escape_string($link, $_REQUEST["Überschrift"]);
$Überschrift_Übersetzung = mysqli_real_escape_string($link, $_REQUEST["Überschrift_Übersetzung"]);
$sql = "SELECT MAX(post_order_no) FROM überschrift";
$query = mysqli_query($link, $sql);
$row = mysqli_fetch_array($query);
$last_order = $row["MAX(post_order_no)"]+1;

$sql = "INSERT INTO überschrift (Überschrift, Überschrift_Übersetzung, post_order_no, post_id) VALUES ('$Überschrift','$Überschrift_Übersetzung', '$last_order','$last_order')";

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