<?php

require_once "session.php";
require_once "../config.php";

$ID = $_REQUEST["ID"];

$sql = "SELECT Kapitel_Englisch FROM admin WHERE ID = ".$ID;
$query = mysqli_query($link, $sql);
$row = mysqli_fetch_array($query);

echo $row["Kapitel_Englisch"];


?>