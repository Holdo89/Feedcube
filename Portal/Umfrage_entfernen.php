<?php

require_once "../config.php";
require_once "session.php";

$Id=$_REQUEST["Id"];
$Umfrage=$_REQUEST["Umfrage"];

//Fragen entfernen
$sql_Frage="SELECT * FROM intern WHERE Umfrage_".$Id." = 1" ;
$result_Frage=mysqli_query($link, $sql_Frage);
while($row_Frage = mysqli_fetch_assoc($result_Frage))
{

    $Id_Frage=$row_Frage["ID"];

    $sql = "SELECT Typ FROM intern WHERE ID = ".$Id_Frage;
    $result = mysqli_query($link, $sql);
    $row = mysqli_fetch_array($result);
    $Fragentyp = $row["Typ"];

    if($Fragentyp=="Multiplechoice")
    {
        $sql="ALTER TABLE multiplechoice_answers DROP COLUMN Intern_".$Id_Frage;
        $result=mysqli_query($link, $sql);
        $sql="DELETE FROM multiplechoice_answers WHERE Fragenspezifisch = '".$Id_Frage."'";
    }
    else if($Fragentyp=="Schieberegler")
    {
        $sql="DELETE FROM rangeslider_answers WHERE Intern_ID = '".$Id_Frage."'";
    }
    $result=mysqli_query($link, $sql);

    $sql="ALTER TABLE internes_feedback DROP COLUMN Frage_".$Id_Frage;
    $result=mysqli_query($link, $sql);

    $sql = "DELETE FROM intern WHERE ID = '".$Id_Frage."'";

    if(mysqli_query($link, $sql)){
    } 
    else{
        echo "ERROR: Could not able to execute $sql. " . mysqli_error($link);
    }

    $i = 1;
    $sql = "SELECT * FROM intern ORDER BY post_id";
    $query= mysqli_query($link,$sql);
    while($row = mysqli_fetch_assoc($query))
    {
        $sql2 = "UPDATE admin SET post_id = ".$i." WHERE ID = ".$row["ID"];
        $query2= mysqli_query($link,$sql2);
        $i = $i+1;
    }

    $sql ="SELECT count(*) FROM information_schema.columns WHERE table_schema = 'feedcube_".$subdomain."' AND table_name = 'internes_feedback';";
    $result=mysqli_query($link, $sql);
    $row = mysqli_fetch_array($result);
    if($row["count(*)"]==5){    
        $sql="DELETE FROM internes_feedback;";
        $result=mysqli_query($link, $sql);
    }
// close connection
}

//Umfrage entfernen

$sql="ALTER TABLE intern DROP COLUMN Umfrage_".$Id;
$result=mysqli_query($link, $sql);

$sql="DELETE FROM internes_feedback WHERE Umfrage = '".$Umfrage."'";
$result=mysqli_query($link, $sql);

$sql = "DELETE FROM umfragen WHERE ID = '".$Id."'";
$result=mysqli_query($link, $sql);

mysqli_close($link);

header("location: Umfragen.php");

?>