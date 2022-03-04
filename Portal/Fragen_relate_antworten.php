<?php
include "../config.php";
$Antwort = $_POST["checkbox"]; 
$Type = $_REQUEST["Type"];
$Antworttyp = $_REQUEST["Auswahl_Antworttyp"];
$Questiontype = $_REQUEST["Questiontype"];
$ID = $_REQUEST["Id"];
$Frage = $_REQUEST["Frage"];
$Kapitel = $_REQUEST["Kapitel"];
$Frage_Englisch = $_REQUEST["Frage_Übersetzung"];
$Kapitel_Englisch = $_REQUEST["Kapitel_Übersetzung"];

if($Antworttyp == "fragenspezifisch")
{
    $Fragenspezifisch = $ID;
}
else
{
    $Fragenspezifisch = 0;
}

if($Type=="extern"){
    $sql = "UPDATE admin SET Fragen_extern = '".$Frage."' WHERE ID = ".$ID;
    $query = mysqli_query($link, $sql);

    $sql = "UPDATE admin SET Frage_Englisch = '".$Frage_Englisch."' WHERE ID = ".$ID;
    $query = mysqli_query($link, $sql);

    $sql = "UPDATE admin SET Kapitel = '".$Kapitel."' WHERE ID = ".$ID;
    $query = mysqli_query($link, $sql);

    $sql = "UPDATE admin SET Kapitel_Englisch = '".$Kapitel_Englisch."' WHERE ID = ".$ID;
    $query = mysqli_query($link, $sql);

    $sql = "UPDATE admin SET Antworttyp = '".$Antworttyp."' WHERE ID = ".$ID;
    $query = mysqli_query($link, $sql);
}
else if($Type=="intern"){
    $sql = "UPDATE intern SET Fragen_intern = '".$Frage."' WHERE ID = ".$ID;
    $query = mysqli_query($link, $sql);

    $sql = "UPDATE intern SET Antworttyp = '".$Antworttyp."' WHERE ID = ".$ID;
    $query = mysqli_query($link, $sql);
}

if($Questiontype!="Text")
{
    if ($Type == "extern"){
        for ($i=0; $i<sizeof($Antwort);$i++) { 
            if(!strpos($Antwort[$i],"_unchecked")){
                if($Questiontype=="Bewertung")
                {
                    $query="UPDATE bewertung_answers SET Frage_".$ID." = 1 WHERE Answers = '".$Antwort[$i]. "' AND Fragenspezifisch = '".$Fragenspezifisch."'";  
                }
                else if($Questiontype=="Multiplechoice")
                {
                    $query="UPDATE multiplechoice_answers SET Frage_".$ID." = 1 WHERE Answers = '".$Antwort[$i]. "' AND Fragenspezifisch = '".$Fragenspezifisch."'";  
                }
                mysqli_query($link,$query); 
            } 
            else{
                if($Questiontype=="Bewertung")
                {
                    $query="UPDATE bewertung_answers SET Frage_".$ID." = 0 WHERE Answers = '".substr($Antwort[$i],0,-10). "' AND Fragenspezifisch = '".$Fragenspezifisch."'";  
                }
                else if($Questiontype =="Multiplechoice")
                {
                    $query="UPDATE multiplechoice_answers SET Frage_".$ID." = 0 WHERE Answers = '".substr($Antwort[$i],0,-10). "' AND Fragenspezifisch = '".$Fragenspezifisch."'";  
                }    
                mysqli_query($link,$query); 
            }
        } 
    } 
    
    if ($Type == "intern"){
        for ($i=0; $i<sizeof($Antwort);$i++) { 
            if(!strpos($Antwort[$i],"_unchecked")){
                if($Questiontype=="Bewertung")
                {
                    $query="UPDATE bewertung_answers SET Intern_".$ID." = 1 WHERE Answers = '".$Antwort[$i]. "' AND Fragenspezifisch = '".$Fragenspezifisch."'";  
                }
                else if($Questiontype=="Multiplechoice")
                {
                    $query="UPDATE multiplechoice_answers SET Intern_".$ID." = 1 WHERE Answers = '".$Antwort[$i]. "' AND Fragenspezifisch = '".$Fragenspezifisch."'";  
                }
                mysqli_query($link,$query); 
            } 
            else{
                if($Questiontype=="Bewertung")
                {
                    $query="UPDATE bewertung_answers SET Intern_".$ID." = 0 WHERE Answers = '".substr($Antwort[$i],0,-10). "' AND Fragenspezifisch = '".$Fragenspezifisch."'";  
                }
                else if($Questiontype =="Multiplechoice")
                {
                    $query="UPDATE multiplechoice_answers SET Intern_".$ID." = 0 WHERE Answers = '".substr($Antwort[$i],0,-10). "' AND Fragenspezifisch = '".$Fragenspezifisch."'";  
                }    
                mysqli_query($link,$query); 
            }
        } 
    } 

}

$Step = $_REQUEST["Step"];
if($Step == 1)
{
    header("location: Fragen.php?Step=1");
}

else{
    if($Type=="intern")
    {
        header("location: Umfragen.php");

    }
    else{
        header("location: Fragen.php");
    }
}
  
?> 
