<?php
include "../config.php";
$Frage = $_POST["checkbox"]; 
$ID = $_REQUEST["ID"];
$Auswahl_Fragenset = $_REQUEST["Auswahl_Fragenset"];

if($Auswahl_Fragenset=="kein_Fragenset")
{
    $sql = "UPDATE umfragen SET Fragenset = '0' WHERE ID = ".$ID;
    mysqli_query($link,$sql); 

    for ($i=0; $i<sizeof ($Frage);$i++) { 
        if(!strpos($Frage[$i],"_unchecked")){
        $query="UPDATE intern SET Umfrage_".$ID." = 1 WHERE Fragenbeschreibung = '".$Frage[$i]. "'";  
        mysqli_query($link,$query); 
        } 
        else{
            $query="UPDATE intern SET Umfrage_".$ID." = 0 WHERE Fragenbeschreibung = '".substr($Frage[$i],0,-10). "'";  
            mysqli_query($link,$query); 
        }
    } 
}
else{
    $sql = "UPDATE umfragen SET Fragenset = '".$Auswahl_Fragenset."' WHERE ID = ".$ID;
    mysqli_query($link,$sql); 

    $sql = "UPDATE intern SET Umfrage_".$ID." = Fragenset_".$Auswahl_Fragenset;
    mysqli_query($link,$sql); 
}


$Step = $_REQUEST["Step"];
if($Step == 5)
{
    header("location: Umfragen.php?Step=7");
}

else{
    header("location: Umfragen.php");
}
exit();
  
?> 
