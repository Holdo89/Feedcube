<?php

// Start the session
require_once "session.php";
require_once "../config.php";

$sql = "SELECT MAX(post_order_no) FROM intern";
$query = mysqli_query($link, $sql);
$row = mysqli_fetch_array($query);
$last_order = $row["MAX(post_order_no)"]+1; //die letzte Frage fürdieReihenfolge von Drag and Drop

$neue_Frage = mysqli_real_escape_string($link, $_REQUEST["neue_Frage"]);
$Fragentyp = mysqli_real_escape_string($link, $_REQUEST["Auswahl_Fragentyp"]);

$sql = "INSERT INTO intern (Typ, Fragen_intern, post_order_no, post_id) VALUES ('$Fragentyp', '$neue_Frage','$last_order','$last_order')";
if(mysqli_query($link, $sql)){
} else{
    echo "ERROR: Could not able to execute $sql. " . mysqli_error($link);
}

$sql = "SELECT ID FROM intern ORDER BY ID DESC LIMIT 1";
$result=mysqli_query($link, $sql);
$row = mysqli_fetch_assoc($result);
if($Fragentyp=='Singlechoice')
{
    $sql= "ALTER TABLE singlechoice_answers ADD Intern_".$row['ID']." tinyint(1)";
}
else if($Fragentyp=='Multiplechoice')
{
    $sql= "ALTER TABLE multiplechoice_answers ADD Intern_".$row['ID']." tinyint(1)";
}
else if($Fragentyp=='Schieberegler'){
    $sql = "INSERT INTO rangeslider_answers (range_max, range_min, columns, Intern_ID) VALUES (100, 0, 5, ".$row['ID'].")";
}
mysqli_query($link, $sql);

if($Fragentyp=='Text' || $Fragentyp=='Singlechoice'|| $Fragentyp=='Multiplechoice'){
    $sql= "ALTER TABLE internes_feedback ADD Frage_".$row['ID']." TEXT";}

elseif($Fragentyp=='Schieberegler'){
    $sql= "ALTER TABLE internes_feedback ADD Frage_".$row['ID']." INT(11)";}

mysqli_query($link, $sql);

// close connection
mysqli_close($link);
header("location: Fragen.php");
?>