<?php

// Start the session

require_once "../config.php";
require_once "session.php";

if($Type=="extern")
{
    $sql = "SELECT MAX(post_order_no) FROM fragen";
    $neues_Überschrift = mysqli_real_escape_string($link, $_REQUEST["Überschrift"]);

}
else
{
    $sql = "SELECT MAX(post_order_no) FROM intern";
}
$query = mysqli_query($link, $sql);
$row = mysqli_fetch_array($query);
$last_order = $row["MAX(post_order_no)"]+1; //die letzte Frage fürdieReihenfolge von Drag and Drop

$neue_Frage = mysqli_real_escape_string($link, $_REQUEST["Frage"]);
$Fragentyp = mysqli_real_escape_string($link, $_REQUEST["Auswahl_Fragentyp"]);
$Antworttyp = mysqli_real_escape_string($link, $_REQUEST["Auswahl_Antworttyp"]);


$Antwort = $_POST["checkbox"]; 

if($Type=="extern")
{
    $AntwortEnglisch = $_POST["checkboxenglisch"]; 

    $Frage_Englisch = $_REQUEST["Frage_Übersetzung"];
    $sql = "SELECT Überschrift_Übersetzung FROM überschrift WHERE Überschrift = '".$neues_Überschrift."'";
    $query = mysqli_query($link, $sql);
    $row = mysqli_fetch_assoc($query);
    $Überschrift_Englisch = $row["Überschrift_Übersetzung"];

    $sql = "INSERT INTO fragen (Überschrift, Überschrift_Englisch, Typ, Fragenbeschreibung, Frage_Englisch, Antworttyp, post_order_no, post_id) VALUES ('$neues_Überschrift', '$Überschrift_Englisch', '$Fragentyp', '$neue_Frage', '$Frage_Englisch', '$Antworttyp', '$last_order','$last_order')";
}
else
{
    $sql = "INSERT INTO intern (Typ, Fragenbeschreibung, Antworttyp, Umfrage_".$Umfragenid.", post_order_no, post_id) VALUES ('$Fragentyp', '$neue_Frage', '$Antworttyp', '1', '$last_order','$last_order')";
}

mysqli_query($link, $sql);

if($Type=="extern")
{
    $sql = "SELECT ID FROM fragen ORDER BY ID DESC LIMIT 1";
}
else
{
    $sql = "SELECT ID FROM intern ORDER BY ID DESC LIMIT 1";
}

$result=mysqli_query($link, $sql);
$row = mysqli_fetch_assoc($result);
$ID = $row['ID'];

if ($Type=="extern") 
{
    $sql= "ALTER TABLE multiplechoice_answers ADD Frage_".$row['ID']." tinyint(1)";
    mysqli_query($link, $sql);

    $sql= "ALTER TABLE kursfeedback ADD Frage_".$row['ID']." TEXT";
    mysqli_query($link, $sql);
}
else{
    $sql= "ALTER TABLE multiplechoice_answers ADD Intern_".$row['ID']." tinyint(1)";
    mysqli_query($link, $sql);

    $sql= "ALTER TABLE umfragenfeedback ADD Frage_".$row['ID']." TEXT";
    mysqli_query($link, $sql);
}


//Fragen_relate_antworten.php
for ($i=0; $i<sizeof($Antwort);$i++) 
{ 
    if(!strpos($Antwort[$i],"_unchecked"))
    {

        $sql = "INSERT INTO multiplechoice_answers (Answers, Answers_Englisch, Fragenspezifisch, post_order_no, post_id) VALUES ('".$Antwort[$i]. "','".$AntwortEnglisch[$i]. "','$ID', '$last_order','$last_order')";    
        mysqli_query($link, $sql);

        if($Type=="extern")
            {
                $query="UPDATE multiplechoice_answers SET Frage_".$ID." = 1 WHERE Answers = '".$Antwort[$i]. "' AND Fragenspezifisch = '".$ID."'";   
            }
            else
            {
                $query="UPDATE multiplechoice_answers SET Intern_".$ID." = 1 WHERE Answers = '".$Antwort[$i]. "' AND Fragenspezifisch = '".$ID."'";  
            }
        mysqli_query($link,$query); 
    } 
} 

if ($Type=="extern") {
    $columnnames = "";
    $sql="SHOW COLUMNS FROM fragen";


    $query = mysqli_query($link, $sql);

    while ($row = mysqli_fetch_assoc($query)) {
        if (strpos($row["Field"], 'Fragenset_') !== false||strpos($row["Field"], 'Leistung_')!== false) {
            $columnnames = $columnnames.$row["Field"]." = 0, ";
        }
    };

    if ($columnnames!="") {
        $columnnames = substr($columnnames, 0, -2);
        $sql="UPDATE fragen SET ".$columnnames." WHERE ID=".$ID;
        $query = mysqli_query($link, $sql);
    }

    $Fragenset = "";
    foreach ($_REQUEST['Auswahl_Fragenset'] as $subject) {
        $Fragenset=$Fragenset." Fragenset_".$subject."= 1,";
    }

    $Leistungen = "";
    foreach ($_REQUEST['Auswahl_Leistung'] as $subject) {
        $Leistungen=$Leistungen." Leistung_".$subject."= 1,";
    }

    if ($Fragenset != "" || $Leistungen != "") {
        if ($Leistungen == "") {
            $Fragenset = substr($Fragenset, 0, -1);
        } else {
            $Leistungen = substr($Leistungen, 0, -1);
        }
        $sql="UPDATE fragen SET ".$Fragenset.$Leistungen." WHERE ID=".$ID;
        $query = mysqli_query($link, $sql);
    }
}

mysqli_close($link);

$Step = $_REQUEST["Step"];
if($Step == 3)
{
    header("location: Fragen.php?Step=3");
}

elseif($Step==7)
{
    header("location: Umfragen.php?Step=7");  
}

else{
    if($Type=="extern")
        header("location: Fragen.php");
    else{
        header("location: Umfragen.php");
    }
    
}
?>