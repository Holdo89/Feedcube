<?php
include "../config.php";

$ID = $_REQUEST["ID"]; //ID der Frage
$Fragensetids=array();
$Fragensetnames=array();
$sql = "SELECT * FROM fragensets";
$result = mysqli_query($link,$sql);
while($row=mysqli_fetch_array($result))
{
    array_push($Fragensetids,"Fragenset_".$row["ID"]);
    array_push($Fragensetnames,$row["Fragenset"]);
}

$i=0;
$AnzahlAllerFragensets=count($Fragensetids);
while($i<$AnzahlAllerFragensets)
{
    $sql = "SELECT ".$Fragensetids[$i]." FROM fragen WHERE ID = ".$ID;
    $result = mysqli_query($link,$sql);
    $row = mysqli_fetch_array($result);
    if($row[$Fragensetids[$i]]==1)
    {
        echo "|".str_replace("Fragenset_","",$Fragensetids[$i])."|";
    };
    $i=$i+1;
}

?>