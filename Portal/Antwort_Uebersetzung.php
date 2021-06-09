<?php

require_once "session.php";
require_once "../config.php";

$ID = $_REQUEST["ID"];
$Questiontype = $_REQUEST["Questiontype"];

if($Questiontype=="Singlechoice")
    $sql = "SELECT Answers_Englisch FROM singlechoice_answers WHERE ID = ".$ID;
else
    $sql = "SELECT Answers_Englisch FROM multiplechoice_answers WHERE ID = ".$ID;
$query = mysqli_query($link, $sql);
$row = mysqli_fetch_array($query);



echo $row["Answers_Englisch"];


?>