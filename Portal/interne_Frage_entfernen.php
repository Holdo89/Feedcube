<?php

require_once "../config.php";
require_once "session.php";

$Id=$_REQUEST["Id"];

$sql = "SELECT Typ FROM intern WHERE ID = ".$Id;
$result = mysqli_query($link, $sql);
$row = mysqli_fetch_array($result);
$Fragentyp = $row["Typ"];

if($Fragentyp=="Multiplechoice")
{
    $sql="ALTER TABLE multiplechoice_answers DROP COLUMN Intern_".$Id;
    $result=mysqli_query($link, $sql);
    $sql="DELETE FROM multiplechoice_answers WHERE Fragenspezifisch = '".$Id."'";
}
else if($Fragentyp=="Schieberegler")
{
    $sql="DELETE FROM rangeslider_answers WHERE Intern_ID = '".$Id."'";
}
$result=mysqli_query($link, $sql);


$sql="ALTER TABLE umfragenfeedback DROP COLUMN Frage_".$Id;
$result=mysqli_query($link, $sql);

$sql = "DELETE FROM intern WHERE ID = '".$Id."'";
if(mysqli_query($link, $sql)){

} else{

    echo "ERROR: Could not able to execute $sql. " . mysqli_error($link);
}

$i = 1;
$sql = "SELECT * FROM intern ORDER BY post_id";
$query= mysqli_query($link,$sql);
while($row = mysqli_fetch_assoc($query))
{
    $sql2 = "UPDATE intern SET post_id = ".$i." WHERE ID = ".$row["ID"];
    $query2= mysqli_query($link,$sql2);
    $i = $i+1;
}

// close connection
mysqli_close($link);
//header("location: Fragen.php");

?>