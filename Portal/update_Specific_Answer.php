<?php

// Start the session

require_once "../config.php";
require_once "session.php";

$Answer = $_REQUEST["Answer"];
$AnswerEnglisch = $_REQUEST["AnswerEnglisch"];
$ID = $_REQUEST["ID"];
$Fragentyp = $_REQUEST["Fragentyp"];

if ($Fragentyp=="Bewertung") {
    $sql = "UPDATE bewertung_answers SET Answers = '".$Answer."', Answers_Englisch = '".$AnswerEnglisch."' WHERE ID=".$ID;
}
if ($Fragentyp=="Multiplechoice") {
    $sql = "UPDATE multiplechoice_answers SET Answers = '".$Answer."', Answers_Englisch = '".$AnswerEnglisch."' WHERE ID=".$ID;
}
mysqli_query($link, $sql);
mysqli_close($link);
?>