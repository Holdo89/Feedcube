<?php

 require_once "../config.php";
 require_once "session.php";

 $Id=$_REQUEST["Id"];

 $Fragentyp=$_REQUEST["Fragentyp"];

 $Frage=$_REQUEST["Frage"];


$query = "UPDATE intern SET Fragen_intern = '".$Frage."' WHERE ID = '".$Id."'";

$exec = mysqli_query($link,$query);

$query = "UPDATE intern SET Typ = '".$Fragentyp."' WHERE ID = '".$Id."'";

$exec = mysqli_query($link,$query);



if($Fragentyp=='Text')

{$Fragentyp='TEXT';}

else{$Fragentyp='INT(11)';}

$query = "ALTER TABLE umfragenfeedback CHANGE Frage_".$Id." Frage_".$Id." ".$Fragentyp." NULL DEFAULT NULL";

$exec = mysqli_query($link,$query);



?>