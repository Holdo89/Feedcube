<?php
include "../config.php";
$ID=$_REQUEST["ID"];

    $sql = "SELECT Überschrift FROM fragen WHERE ID = ".$ID; 
    $result = mysqli_query($link, $sql);
    $row = mysqli_fetch_assoc($result);
    echo $row["Überschrift"];
 ?>  