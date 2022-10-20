<?php
include "../config.php";


$Antwort = $_POST["checkbox"]; 
$Type = $_REQUEST["Type"];
$Antworttyp = $_REQUEST["Auswahl_Antworttyp"];
$Questiontype = $_REQUEST["Questiontype"];
$ID = $_REQUEST["Id"];


$columnnames = "";
$sql="SHOW COLUMNS FROM admin";
$query = mysqli_query($link, $sql);

while($row = mysqli_fetch_assoc($query))
{
    if(strpos($row["Field"], 'Fragenset_') !== false||strpos($row["Field"], 'Leistung_')!== false)
    $columnnames = $columnnames.$row["Field"]." = 0, ";
};

if($columnnames!="")
{
    $columnnames = substr($columnnames, 0, -2);
    $sql="UPDATE admin SET ".$columnnames." WHERE ID=".$ID;
    $query = mysqli_query($link, $sql);  
}

$Fragenset = "";
foreach ($_REQUEST['Auswahl_Fragenset'] as $subject)
{
    $Fragenset=$Fragenset." Fragenset_".$subject."= 1,";
}

$Leistungen = "";
foreach ($_REQUEST['Auswahl_Leistung'] as $subject)
{
    $Leistungen=$Leistungen." Leistung_".$subject."= 1,";
}

if($Fragenset != "" || $Leistungen != "")
{
    if($Leistungen == "")
    {
        $Fragenset = substr($Fragenset, 0, -1);     
    }
    else{
        $Leistungen = substr($Leistungen, 0, -1);  
    }
    $sql="UPDATE admin SET ".$Fragenset.$Leistungen." WHERE ID=".$ID;
    $query = mysqli_query($link, $sql);
}

$Frage = $_REQUEST["Frage"];
$Überschrift = $_REQUEST["Überschrift"];
$Frage_Englisch = $_REQUEST["Frage_Übersetzung"];
    $sql = "SELECT Überschrift_Übersetzung FROM überschrift WHERE Überschrift = '".$Überschrift."'";
    $query = mysqli_query($link, $sql);
    $row = mysqli_fetch_assoc($query);
    $Überschrift_Englisch = $row["Überschrift_Übersetzung"];

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

    $sql = "UPDATE admin SET Überschrift = '".$Überschrift."' WHERE ID = ".$ID;
    $query = mysqli_query($link, $sql);

    $sql = "UPDATE admin SET Überschrift_Englisch = '".$Überschrift_Englisch."' WHERE ID = ".$ID;
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


if(isset($_REQUEST["Step"]))
{
    $Step = $_REQUEST["Step"];
    header("location: Fragen.php?Step=".$Step);
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
