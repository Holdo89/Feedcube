<?php

// Start the session

require_once "../config.php";
require_once "session.php";

$Frage = $_POST["checkbox"]; 
$Auswahl_Fragenset = $_REQUEST["Auswahl_Fragenset"];
$neuer_Leistung = mysqli_real_escape_string($link, $_REQUEST["neuer_Leistung"]);

$sql = "INSERT INTO leistungen (Leistung) VALUES ('$neuer_Leistung')";

if(mysqli_query($link, $sql)){

} else{

    echo "ERROR: Could not able to execute $sql. " . mysqli_error($link);

}

$sql = "SELECT ID FROM leistungen ORDER BY ID DESC LIMIT 1";
$result=mysqli_query($link, $sql);
$row = mysqli_fetch_assoc($result);
$ID = $row['ID'];

$sql= "ALTER TABLE fragen ADD Leistung_".$row['ID']." tinyint(1)";
$result=mysqli_query($link, $sql);

if($Auswahl_Fragenset=="kein_Fragenset")
{
    $sql = "UPDATE leistungen SET Fragenset = '0' WHERE ID = ".$ID;
    mysqli_query($link,$sql); 

    for ($i=0; $i<sizeof ($Frage);$i++) { 
        if(!strpos($Frage[$i],"_unchecked")){
        $query="UPDATE fragen SET Leistung_".$ID." = 1 WHERE Fragen_extern = '".$Frage[$i]. "'";  
        mysqli_query($link,$query); 
        } 
        else{
            $query="UPDATE fragen SET Leistung_".$ID." = 0 WHERE Fragen_extern = '".substr($Frage[$i],0,-10). "'";  
            mysqli_query($link,$query); 
        }
    } 
}
else{
    $sql = "UPDATE leistungen SET Fragenset = '".$Auswahl_Fragenset."' WHERE ID = ".$ID;
    mysqli_query($link,$sql); 

    $sql = "UPDATE fragen SET Leistung_".$ID." = Fragenset_".$Auswahl_Fragenset;
    mysqli_query($link,$sql); 
}


mysqli_close($link);

$Step = $_REQUEST["Step"];
if($Step == 5)
{
    header("location: Leistungmanagement.php?Step=5");
}

else{
    header("location: Leistungmanagement.php");
}


?>