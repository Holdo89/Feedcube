<?php
include "../config.php";
$Frage = $_POST["Fragenset_checkbox"]; 
$ID = $_REQUEST["Fragenset_ID"];
$neues_Fragenset = mysqli_real_escape_string($link, $_REQUEST["neues_Fragenset"]);

for ($i=0; $i<sizeof ($Frage);$i++) { 
    if(!strpos($Frage[$i],"_unchecked")){
    $query="UPDATE admin SET Fragenset_".$ID." = 1 WHERE Fragen_extern = '".$Frage[$i]. "'";  
    mysqli_query($link,$query); 
    } 
    else{
        $query="UPDATE admin SET Fragenset_".$ID." = 0 WHERE Fragen_extern = '".substr($Frage[$i],10,-10). "'";  
        mysqli_query($link,$query); 
    }
} 
$query="UPDATE fragensets SET Fragenset = '".$neues_Fragenset."' WHERE ID = ".$ID;  
mysqli_query($link,$query); 


$Step = $_REQUEST["Step"];
if($Step == 4)
{
    header("location: Fragenset.php?Step=4");
}

else{
    header("location: Fragenset.php");
}
  
?> 
