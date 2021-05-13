<?php
include "config.php";
$Antwort = $_POST["checkbox"]; 
$Type = $_REQUEST["Type"];
$Questiontype = $_REQUEST["Questiontype"];
$ID = $_REQUEST["ID_".$Type."_".$Questiontype];

if ($Type == "extern"){
    for ($i=0; $i<sizeof($Antwort);$i++) { 
        if(!strpos($Antwort[$i],"_unchecked")){
            if($Questiontype=="Singlechoice")
            {
                $query="UPDATE singlechoice_answers SET Frage_".$ID." = 1 WHERE Answers = '".$Antwort[$i]. "'";  
            }
            else if($Questiontype=="Multiplechoice")
            {
                $query="UPDATE multiplechoice_answers SET Frage_".$ID." = 1 WHERE Answers = '".$Antwort[$i]. "'";  
            }
            mysqli_query($link,$query); 
        } 
        else{
            if($Questiontype=="Singlechoice")
            {
                $query="UPDATE singlechoice_answers SET Frage_".$ID." = 0 WHERE Answers = '".substr($Antwort[$i],0,-10). "'";  
            }
            else if($Questiontype =="Multiplechoice")
            {
                $query="UPDATE multiplechoice_answers SET Frage_".$ID." = 0 WHERE Answers = '".substr($Antwort[$i],0,-10). "'";  
            }    
            mysqli_query($link,$query); 
        }
    } 
} 

if ($Type == "intern"){
    for ($i=0; $i<sizeof($Antwort);$i++) { 
        if(!strpos($Antwort[$i],"_unchecked")){
            if($Questiontype=="Singlechoice")
            {
                $query="UPDATE singlechoice_answers SET Intern_".$ID." = 1 WHERE Answers = '".$Antwort[$i]. "'";  
            }
            else if($Questiontype=="Multiplechoice")
            {
                $query="UPDATE multiplechoice_answers SET Intern_".$ID." = 1 WHERE Answers = '".$Antwort[$i]. "'";  
            }
            mysqli_query($link,$query); 
        } 
        else{
            if($Questiontype=="Singlechoice")
            {
                $query="UPDATE singlechoice_answers SET Intern_".$ID." = 0 WHERE Answers = '".substr($Antwort[$i],0,-10). "'";  
            }
            else if($Questiontype =="Multiplechoice")
            {
                $query="UPDATE multiplechoice_answers SET Intern_".$ID." = 0 WHERE Answers = '".substr($Antwort[$i],0,-10). "'";  
            }    
            mysqli_query($link,$query); 
        }
    } 
} 
header("location:Fragen.php");
  
?> 
