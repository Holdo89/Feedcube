<?php

 require_once "session.php";

 require_once "config.php";

 $Id=$_REQUEST["Id"];

 $Antwort=$_REQUEST["Antwort"];

//effr

$query = "UPDATE singlechoice_answers SET Answers = '".$Antwort."' WHERE ID = '".$Id."'";

$exec = mysqli_query($link,$query);



?>