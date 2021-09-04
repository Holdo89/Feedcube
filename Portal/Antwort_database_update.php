<?php

 require_once "../config.php";
 require_once "session.php";

 $Id=$_REQUEST["Id"];
 $Antwort=$_REQUEST["Antwort"];
 $typ = $_REQUEST["Typ"]; 

 if($typ == "Singlechoice")
 {
    $query = "UPDATE singlechoice_answers SET Answers = '".$Antwort."' WHERE ID = '".$Id."'";
    
 }
 else{
    $query = "UPDATE multiplechoice_answers SET Answers = '".$Antwort."' WHERE ID = '".$Id."'";
 }
$exec = mysqli_query($link,$query);



?>