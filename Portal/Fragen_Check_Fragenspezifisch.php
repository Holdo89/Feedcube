<?php

require_once "../config.php";
require_once "session.php";

$ID = $_REQUEST["ID"];
$Type = $_REQUEST["Type"];

if($Type=="extern"){
    $sql = "SELECT Antworttyp FROM fragen WHERE ID = ".$ID;
    $query = mysqli_query($link, $sql);
    $row = mysqli_fetch_array($query);
}
else if($Type=="intern"){
    $sql = "SELECT Antworttyp FROM intern WHERE ID = ".$ID;
    $query = mysqli_query($link, $sql);
    $row = mysqli_fetch_array($query);
}
echo $row["Antworttyp"];


?>