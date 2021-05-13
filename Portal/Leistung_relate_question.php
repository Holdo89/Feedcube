<?php
include "../config.php";
$Frage = $_POST["checkbox"]; 
$ID = $_REQUEST["ID"];

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
header("location:Leistungmanagement.php");
exit();
  
?> 
