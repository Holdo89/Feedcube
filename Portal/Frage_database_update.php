<?php
 require_once "../config.php";
 require_once "session.php";

 $Id=$_REQUEST["Id"];
 $Fragentyp=$_REQUEST["Fragentyp"];
 $Frage=$_REQUEST["Frage"];
 $Überschrift=$_REQUEST["Überschrift"];

$query = "UPDATE fragen SET Fragenbeschreibung = '".$Frage."' WHERE ID = '".$Id."'";
$exec = mysqli_query($link,$query);

$query = "UPDATE fragen SET Typ = '".$Fragentyp."' WHERE ID = '".$Id."'";
$exec = mysqli_query($link,$query);

$query = "UPDATE fragen SET Überschrift = '".$Überschrift."' WHERE ID = '".$Id."'";
$exec = mysqli_query($link,$query);

if($Fragentyp=='Schieberegler')
{
    $Fragentyp='INT(11)';
}
else{
    $Fragentyp='TEXT';
}

$query = "ALTER TABLE kursfeedback CHANGE Frage_".$Id." Frage_".$Id." ".$Fragentyp." NULL DEFAULT NULL";
$exec = mysqli_query($link,$query);

?>