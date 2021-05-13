<?php

require_once "session.php";
require_once "config.php";


$sql = "SELECT MAX(post_order_no) FROM singlechoice_answers";
$query = mysqli_query($link, $sql);
$row = mysqli_fetch_array($query);
$last_order = $row["MAX(post_order_no)"]+1; //die letzte Frage fürdieReihenfolge von Drag and Drop

$neue_Antwort = mysqli_real_escape_string($link, $_REQUEST["neue_Antwort"]);

$sql = "INSERT INTO singlechoice_answers (Answers, post_order_no, post_id) VALUES ('$neue_Antwort','$last_order','$last_order')";
mysqli_query($link, $sql);

// close connection
mysqli_close($link);
header("location: Fragen.php");

?>