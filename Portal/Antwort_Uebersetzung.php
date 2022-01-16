<?php

require_once "../config.php";
require_once "session.php";

$ID = $_REQUEST["ID"];
$Questiontype = $_REQUEST["Questiontype"];

if($Questiontype=="Bewertung")
    $sql = "SELECT Answers_Englisch FROM bewertung_answers WHERE ID = ".$ID;
else
    $sql = "SELECT Answers_Englisch FROM multiplechoice_answers WHERE ID = ".$ID;
$query = mysqli_query($link, $sql);
$row = mysqli_fetch_array($query);



echo $row["Answers_Englisch"];


?>