<?php
include "../config.php";
$Antwort = $_POST["checkbox"]; 
$ID = $_REQUEST["ID_intern"];
echo $ID;

for ($i=0; $i<sizeof($Antwort);$i++) { 
    if(!strpos($Antwort[$i],"_unchecked")){
    $query="UPDATE bewertung_answers SET Intern_".$ID." = 1 WHERE Answers = '".$Antwort[$i]. "'";  
    mysqli_query($link,$query); 
    } 
    else{
        $query="UPDATE bewertung_answers SET Intern_".$ID." = 0 WHERE Answers = '".substr($Antwort[$i],0,-10). "'";  
        mysqli_query($link,$query); 
    }
}  
header("location:Fragen.php");
  
?> 
