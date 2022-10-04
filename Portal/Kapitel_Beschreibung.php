<?php

require_once "../config.php";
require_once "session.php";

$ID = $_REQUEST["ID"];

$sql = "SELECT Überschrift FROM admin WHERE ID = ".$ID;
$query = mysqli_query($link, $sql);
$row = mysqli_fetch_array($query);

echo $row["Überschrift"];


?>