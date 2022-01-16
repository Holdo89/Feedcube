<?php

// Start the session

require_once "../config.php";
require_once "session.php";

$sql = "SELECT MAX(post_order_no) FROM admin";
$query = mysqli_query($link, $sql);
$row = mysqli_fetch_array($query);
$last_order = $row["MAX(post_order_no)"]+1; //die letzte Frage fürdieReihenfolge von Drag and Drop

$neues_Kapitel = mysqli_real_escape_string($link, $_REQUEST["neues_Kapitel"]);
$neue_Frage = mysqli_real_escape_string($link, $_REQUEST["neue_Frage"]);
$Fragentyp = mysqli_real_escape_string($link, $_REQUEST["Auswahl_Fragentyp"]);

$sql = "INSERT INTO admin (Kapitel, Typ, Fragen_extern, post_order_no, post_id) VALUES ('$neues_Kapitel', '$Fragentyp', '$neue_Frage','$last_order','$last_order')";

if(mysqli_query($link, $sql)){

} else{
    echo "ERROR: Could not able to execute $sql. " . mysqli_error($link);
}

$sql = "SELECT ID FROM admin ORDER BY ID DESC LIMIT 1";
$result=mysqli_query($link, $sql);
$row = mysqli_fetch_assoc($result);

if($Fragentyp=='Bewertung'){
    $sql= "ALTER TABLE bewertung_answers ADD Frage_".$row['ID']." tinyint(1)";
}
else if($Fragentyp=='Multiplechoice'){
    $sql= "ALTER TABLE multiplechoice_answers ADD Frage_".$row['ID']." tinyint(1)";
}
else if($Fragentyp=='Schieberegler'){
    $sql = "INSERT INTO rangeslider_answers (range_max, range_min, columns, Frage_ID) VALUES (100, 0, 5, ".$row['ID'].")";
}
mysqli_query($link, $sql);

if($Fragentyp=='Text'){
$sql= "ALTER TABLE externes_feedback ADD Frage_".$row['ID']." TEXT";}

elseif($Fragentyp=='Bewertung' || $Fragentyp=='Multiplechoice'){
$sql= "ALTER TABLE externes_feedback ADD Frage_".$row['ID']." TEXT";}

elseif($Fragentyp=='Schieberegler'){
$sql= "ALTER TABLE externes_feedback ADD Frage_".$row['ID']." INT(11)";}

mysqli_query($link, $sql);



// close connection

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