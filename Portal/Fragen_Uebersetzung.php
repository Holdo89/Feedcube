<?php

require_once "session.php";
require_once "../config.php";

$ID = $_REQUEST["ID"];
$Type = $_REQUEST["Type"];

if($Type=="extern"){
    $sql = "SELECT Frage_Englisch FROM admin WHERE ID = ".$ID;
    $query = mysqli_query($link, $sql);
    $row = mysqli_fetch_array($query);
}
else if($Type=="intern"){
    $sql = "SELECT Frage_Englisch FROM intern WHERE ID = ".$ID;
    $query = mysqli_query($link, $sql);
    $row = mysqli_fetch_array($query);
}
echo $row["Frage_Englisch"];


?>