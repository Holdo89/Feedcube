<?php

require_once "../config.php";
require_once "session.php";

$sql = "SELECT MAX(post_order_no) FROM multiplechoice_answers";
$query = mysqli_query($link, $sql);
$row = mysqli_fetch_array($query);
$last_order = $row["MAX(post_order_no)"]+1; //die letzte Frage fürdieReihenfolge von Drag and Drop

$Answers_Englisch = $_REQUEST["englisch_answers_Multiplechoice"];
$neue_Antwort = mysqli_real_escape_string($link, $_REQUEST["neue_Antwort"]);

$sql = "INSERT INTO multiplechoice_answers (Answers, Answers_Englisch, post_order_no, post_id) VALUES ('$neue_Antwort','$Answers_Englisch','$last_order','$last_order')";
mysqli_query($link, $sql);

// close connection
mysqli_close($link);

$Step = $_REQUEST["Step"];
if($Step == 2)
{
    header("location: Antwortmoeglichkeiten.php?Step=2");
}

else{
    header("location: Antwortmoeglichkeiten.php");
}


?>