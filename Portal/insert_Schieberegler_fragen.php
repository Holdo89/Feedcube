<?php

// Start the session

require_once "../config.php";
require_once "session.php";

if($Type=="extern")
{
    $sql = "SELECT MAX(post_order_no) FROM admin";
}
else
{
    $sql = "SELECT MAX(post_order_no) FROM intern";
}
$query = mysqli_query($link, $sql);
$row = mysqli_fetch_array($query);
$last_order = $row["MAX(post_order_no)"]+1; //die letzte Frage fürdieReihenfolge von Drag and Drop

$neues_Überschrift = mysqli_real_escape_string($link, $_REQUEST["Überschrift"]);
$neue_Frage = mysqli_real_escape_string($link, $_REQUEST["Frage"]);
$Fragentyp = mysqli_real_escape_string($link, $_REQUEST["Auswahl_Fragentyp"]);
$Antworttyp = mysqli_real_escape_string($link, $_REQUEST["Auswahl_Antworttyp"]);
$Frage_Englisch = $_REQUEST["Frage_Übersetzung"];
    $sql = "SELECT Überschrift_Übersetzung FROM überschrift WHERE Überschrift = '".$neues_Überschrift."'";
    $query = mysqli_query($link, $sql);
    $row = mysqli_fetch_assoc($query);
    $Überschrift_Englisch = $row["Überschrift_Übersetzung"];

if($Type=="extern")
{
    $sql = "INSERT INTO admin (Überschrift, Überschrift_Englisch, Typ, Fragen_extern, Frage_Englisch, Antworttyp, post_order_no, post_id) VALUES ('$neues_Überschrift', '$Überschrift_Englisch', '$Fragentyp', '$neue_Frage', '$Frage_Englisch', '$Antworttyp', '$last_order','$last_order')";
}
else
{
    $sql = "INSERT INTO intern (Typ, Fragen_intern, Antworttyp, Umfrage_".$Umfragenid.", post_order_no, post_id) VALUES ('$Fragentyp', '$neue_Frage', '$Antworttyp', '1', '$last_order','$last_order')";
}
mysqli_query($link, $sql);

if($Type=="extern")
{
    $sql = "SELECT ID FROM admin ORDER BY ID DESC LIMIT 1";
}
else
{
    $sql = "SELECT ID FROM intern ORDER BY ID DESC LIMIT 1";
}
$result=mysqli_query($link, $sql);
$row = mysqli_fetch_assoc($result);
$ID = $row['ID'];

if($Type=="extern")
{
    $sql = "INSERT INTO rangeslider_answers (range_max, range_min, columns, Frage_ID) VALUES (".$max.", ".$min.", 5, ".$row['ID'].")";
}
else
{
    $sql = "INSERT INTO rangeslider_answers (range_max, range_min, columns, Intern_ID) VALUES (".$max.", ".$min.", 5, ".$row['ID'].")";
}
mysqli_query($link, $sql);

$sql= "ALTER TABLE  ".$Type."es_feedback ADD Frage_".$row['ID']." INT(11)";
mysqli_query($link, $sql);


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