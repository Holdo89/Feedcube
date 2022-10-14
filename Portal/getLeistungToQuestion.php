<?php
include "../config.php";

$ID = $_REQUEST["ID"]; //ID der Frage
$Leistungids=array();
$Leistungnames=array();
$sql = "SELECT * FROM leistungen WHERE Fragenset=0";
$result = mysqli_query($link,$sql);
while($row=mysqli_fetch_array($result))
{
    array_push($Leistungids,"Leistung_".$row["ID"]);
    array_push($Leistungnames,$row["Leistung"]);
}

$i=0;
$AnzahlAllerLeistungen=count($Leistungids);
while($i<$AnzahlAllerLeistungen)
{
    $sql = "SELECT ".$Leistungids[$i]." FROM admin WHERE ID = ".$ID;
    $result = mysqli_query($link,$sql);
    $row = mysqli_fetch_array($result);
    if($row[$Leistungids[$i]]==1)
    {
        echo "|".$Leistungnames[$i]."|";
    };
    $i=$i+1;
}

?>