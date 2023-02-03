<?php

require_once "../config.php";
require_once "session.php";

$Id=$_REQUEST["Id"];

$sql = "SELECT Typ FROM fragen WHERE ID = ".$Id;
$result = mysqli_query($link, $sql);
$row = mysqli_fetch_array($result);
$Fragentyp = $row["Typ"];

if($Fragentyp=="Multiplechoice")
{
    $sql="ALTER TABLE multiplechoice_answers DROP COLUMN Frage_".$Id;
    $result=mysqli_query($link, $sql);
    $sql="DELETE FROM multiplechoice_answers WHERE Fragenspezifisch = '".$Id."'";
}
else if($Fragentyp=="Schieberegler")
{
    $sql="DELETE FROM rangeslider_answers WHERE Frage_ID = '".$Id."'";
}
$result=mysqli_query($link, $sql);

$sql="ALTER TABLE kursfeedback DROP COLUMN Frage_".$Id;
$result=mysqli_query($link, $sql);

$sql = "DELETE FROM fragen WHERE ID = '".$Id."'";

if(mysqli_query($link, $sql)){
} 
else{
    echo "ERROR: Could not able to execute $sql. " . mysqli_error($link);
}

$i = 1;
$sql = "SELECT * FROM fragen ORDER BY post_id";
$query= mysqli_query($link,$sql);
while($row = mysqli_fetch_assoc($query))
{
    $sql2 = "UPDATE fragen SET post_id = ".$i." WHERE ID = ".$row["ID"];
    $query2= mysqli_query($link,$sql2);
    $i = $i+1;
}

$sql ="SELECT count(*) FROM information_schema.columns WHERE table_schema = 'feedcube_".$subdomain."' AND table_name = 'kursfeedback';";
$result=mysqli_query($link, $sql);
$row = mysqli_fetch_array($result);
if($row["count(*)"]==5){    
    $sql="DELETE FROM kursfeedback;";
    $result=mysqli_query($link, $sql);
}
// close connection

mysqli_close($link);

header("location: Fragen.php");

?>