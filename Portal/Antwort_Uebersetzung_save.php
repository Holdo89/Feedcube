<?php

include "../config.php";
 
$Type = $_REQUEST["Type"];
$Questiontype = $_REQUEST["Questiontype"];
$ID = $_REQUEST["ID_".$Type."_".$Questiontype];
$Answers_Englisch = $_REQUEST["englisch_".$Type."_".$Questiontype];

if($Questiontype=="Singlechoice")
    $sql = "UPDATE singlechoice_answers SET Answers_Englisch = '".$Answers_Englisch."' WHERE ID = ".$ID;
else
    $sql = "UPDATE multiplechoice_answers SET Answers_Englisch = '".$Answers_Englisch."' WHERE ID = ".$ID;
  
$query = mysqli_query($link, $sql);

header("location:Antwortmoeglichkeiten.php");
?>