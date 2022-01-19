<?php

// Start the session

require_once "../config.php";
require_once "session.php";

$sql = "SELECT MAX(post_order_no) FROM admin";
$query = mysqli_query($link, $sql);
$row = mysqli_fetch_array($query);
$last_order = $row["MAX(post_order_no)"]+1; //die letzte Frage fürdieReihenfolge von Drag and Drop

$neues_Kapitel = mysqli_real_escape_string($link, $_REQUEST["Kapitel"]);
$neue_Frage = mysqli_real_escape_string($link, $_REQUEST["Frage"]);
$Fragentyp = mysqli_real_escape_string($link, $_REQUEST["Auswahl_Fragentyp"]);
$Antworttyp = mysqli_real_escape_string($link, $_REQUEST["Auswahl_Antworttyp"]);

$Antwort = $_POST["checkbox"]; 
$Frage_Englisch = $_REQUEST["Frage_Übersetzung"];
$Kapitel_Englisch = $_REQUEST["Kapitel_Übersetzung"];

$sql = "INSERT INTO admin (Kapitel, Kapitel_Englisch, Typ, Fragen_extern, Frage_Englisch, Antworttyp, post_order_no, post_id) VALUES ('$neues_Kapitel', '$Kapitel_Englisch', '$Fragentyp', '$neue_Frage', '$Frage_Englisch', '$Antworttyp', '$last_order','$last_order')";

if(mysqli_query($link, $sql)){

} else{
    echo "ERROR: Could not able to execute $sql. " . mysqli_error($link);
}

$sql = "SELECT ID FROM admin ORDER BY ID DESC LIMIT 1";
$result=mysqli_query($link, $sql);
$row = mysqli_fetch_assoc($result);
$ID = $row['ID'];

$sql= "ALTER TABLE bewertung_answers ADD Frage_".$row['ID']." tinyint(1)";
mysqli_query($link, $sql);

$sql= "ALTER TABLE externes_feedback ADD Frage_".$row['ID']." TEXT";
mysqli_query($link, $sql);

//Fragen_relate_antworten.php
for ($i=0; $i<sizeof($Antwort);$i++) { 
    if(!strpos($Antwort[$i],"_unchecked"))
    {
        $query="UPDATE bewertung_answers SET Frage_".$ID." = 1 WHERE Answers = '".$Antwort[$i]. "'";  
        mysqli_query($link,$query); 
    } 
} 

mysqli_close($link);

$Step = $_REQUEST["Step"];
if($Step == 1)
{
    header("location: Tutorial_Fragen.php");
}

else{
    header("location: Fragen.php");
}
?>