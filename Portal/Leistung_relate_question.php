<?php
include "../config.php";
$Frage = $_POST["checkbox"]; 
$ID = $_REQUEST["ID"];
$Auswahl_Fragenset = $_REQUEST["Auswahl_Fragenset"];

if($Auswahl_Fragenset=="kein_Fragenset")
{
    $sql = "UPDATE leistungen SET Fragenset = '0' WHERE ID = ".$ID;
    mysqli_query($link,$sql); 

    for ($i=0; $i<sizeof ($Frage);$i++) { 
        if(!strpos($Frage[$i],"_unchecked")){
        $query="UPDATE admin SET Leistung_".$ID." = 1 WHERE Fragen_extern = '".$Frage[$i]. "'";  
        mysqli_query($link,$query); 
        } 
        else{
            $query="UPDATE admin SET Leistung_".$ID." = 0 WHERE Fragen_extern = '".substr($Frage[$i],0,-10). "'";  
            mysqli_query($link,$query); 
        }
    } 
}
else{
    $sql = "UPDATE leistungen SET Fragenset = '".$Auswahl_Fragenset."' WHERE ID = ".$ID;
    mysqli_query($link,$sql); 

    $sql = "UPDATE admin SET Leistung_".$ID." = Fragenset_".$Auswahl_Fragenset;
    mysqli_query($link,$sql); 
}


$Step = $_REQUEST["Step"];
if($Step == 5)
{
    header("location: Leistungmanagement.php?Step=5");
}

else{
    header("location: Leistungmanagement.php");
}
exit();
  
?> 
