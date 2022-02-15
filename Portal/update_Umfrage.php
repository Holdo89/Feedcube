<?php

// Start the session

require_once "../config.php";
require_once "session.php";

$Id = mysqli_real_escape_string($link, $_REQUEST["Id"]);
$neue_Umfrage = mysqli_real_escape_string($link, $_REQUEST["Umfrage"]);
$Benachrichtigung = mysqli_real_escape_string($link, $_REQUEST["Auswahl_Umfragentyp"]);
$Intervall = mysqli_real_escape_string($link, $_REQUEST["Benachrichtigungsintervall"]);
$UmfrageDatum = mysqli_real_escape_string($link, $_REQUEST["UmfrageDatum"]);
$Quantity = mysqli_real_escape_string($link, $_REQUEST["quantity"]);
if ($Quantity != "")
{
    $Intervall = $Quantity;
}

$Benutzer = "";
foreach ($_REQUEST['Auswahl_Trainer'] as $subject)
                $Benutzer=$Benutzer."|".$subject."|";

$sql = "UPDATE umfragen SET Umfrage = '$neue_Umfrage', Benachrichtigung = '$Benachrichtigung', Intervall = '$Intervall', Benutzer = '$Benutzer', Benachrichtigungsdatum = '$UmfrageDatum' WHERE ID = $Id";

if(mysqli_query($link, $sql)){

} else{
    echo "ERROR: Could not able to execute $sql. " . mysqli_error($link);
}

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