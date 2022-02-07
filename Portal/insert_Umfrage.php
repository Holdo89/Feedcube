<?php

// Start the session

require_once "../config.php";
require_once "session.php";

$neue_Umfrage = mysqli_real_escape_string($link, $_REQUEST["Umfrage"]);
$Benachrichtigung = mysqli_real_escape_string($link, $_REQUEST["Auswahl_Umfragentyp"]);
$Intervall = mysqli_real_escape_string($link, $_REQUEST["Benachrichtigungsintervall"]);
$UmfrageDatum = mysqli_real_escape_string($link, $_REQUEST["UmfrageDatum"]);

date_default_timezone_set("Europe/Berlin");

$to_time = strtotime($UmfrageDatum);
$from_time = strtotime(date("Y-m-dTH:i"));
$timeToWait = round(abs($to_time - $from_time) / 60,2);

sleep($timeToWait);
$msg = "Erinnerung wegen der Umfrage";
$headers = 'From: Feedcube Automation <automation@feedcube.net>' . "\r\n";
mail("holdo89@gmail.com","Erinnerung",$msg,$headers);


/*
$Benutzer = "";
foreach ($_REQUEST['Auswahl_Trainer'] as $subject)
                $Benutzer=$Benutzer."|".$subject."|";

$sql = "INSERT INTO umfragen (Umfrage, Benachrichtigung, Intervall, Benutzer, Benachrichtigungsdatum) VALUES ('$neue_Umfrage','$Benachrichtigung','$Intervall','$Benutzer','$UmfrageDatum')";

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
}*/


?>