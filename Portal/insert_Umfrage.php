<?php

// Start the session

require_once "../config.php";
require_once "session.php";

$neue_Umfrage = mysqli_real_escape_string($link, $_REQUEST["Umfrage"]);
$sql = "INSERT INTO umfragen (Umfrage) VALUES ('$neue_Umfrage')";

if(mysqli_query($link, $sql)){

} else{
    echo "ERROR: Could not able to execute $sql. " . mysqli_error($link);
}

$sql = "SELECT ID FROM umfragen ORDER BY ID DESC LIMIT 1";
$result=mysqli_query($link, $sql);
$row = mysqli_fetch_assoc($result);

$sql= "ALTER TABLE intern ADD Umfrage_".$row['ID']." tinyint(1)";
$result=mysqli_query($link, $sql);

mysqli_close($link);

$Step = $_REQUEST["Step"];
if($Step == 5)
{
    header("location: Tutorial_Umfragen.php");
}
else{
    header("location: Umfragen.php");
}


?>