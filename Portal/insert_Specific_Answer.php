<?php

// Start the session

require_once "../config.php";
require_once "session.php";

$Answer = $_REQUEST["Answer"];
$ID = $_REQUEST["ID"];
$Fragentyp = $_REQUEST["Fragentyp"];
$Type = $_REQUEST["Externinterntyp"];

if ($Fragentyp=="Bewertung")
{
    $sql = "SELECT MAX(post_order_no) FROM bewertung_answers";
}
else
{
    $sql = "SELECT MAX(post_order_no) FROM multiplechoice_answers";
}
$query = mysqli_query($link, $sql);
$row = mysqli_fetch_array($query);
$last_order = $row["MAX(post_order_no)"]+1; //die letzte Frage fürdieReihenfolge von Drag and Drop

if ($Fragentyp=="Bewertung") {
    $sql = "INSERT INTO bewertung_answers (Answers, Fragenspezifisch, post_order_no, post_id) VALUES ('".$Answer. "','$ID', '$last_order','$last_order')";
}
if ($Fragentyp=="Multiplechoice") {
    $sql = "INSERT INTO multiplechoice_answers (Answers, Fragenspezifisch, post_order_no, post_id) VALUES ('".$Answer. "','$ID', '$last_order','$last_order')";
}
mysqli_query($link, $sql);
mysqli_close($link);
?>