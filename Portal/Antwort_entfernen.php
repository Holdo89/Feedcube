<?php
require_once "../config.php";
require_once "session.php";

$Typ=$_REQUEST["Typ"];
$Id=$_REQUEST["Id"];
$Antwort=$_REQUEST["Antwort"];

if($Typ == "Bewertung")
{
    $sql = "DELETE FROM bewertung_answers WHERE ID = '".$Id."'";
    mysqli_query($link, $sql);

    $i = 1;
    $sql = "SELECT * FROM bewertung_answers ORDER BY post_id";
    $query= mysqli_query($link,$sql);
    while($row = mysqli_fetch_assoc($query))
    {
        $sql2 = "UPDATE bewertung_answers SET post_id = ".$i." WHERE ID = ".$row["ID"];
        $query2= mysqli_query($link,$sql2);
        $i = $i+1;
    }
}
else if($Typ == "Multiplechoice")
{
    $sql = "DELETE FROM multiplechoice_answers WHERE ID = '".$Id."'";
    mysqli_query($link, $sql);

    $i = 1;
    $sql = "SELECT * FROM multiplechoice_answers ORDER BY post_id";
    $query= mysqli_query($link,$sql);
    while($row = mysqli_fetch_assoc($query))
    {
        $sql2 = "UPDATE multiplechoice_answers SET post_id = ".$i." WHERE ID = ".$row["ID"];
        $query2= mysqli_query($link,$sql2);
        $i = $i+1;
    }
}
// close connection
mysqli_close($link);
header("location: Fragen.php");
//weitermachen bei multiplechoice hinzufügen
?>