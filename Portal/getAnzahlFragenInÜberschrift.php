<?php
include "../config.php";
$ID=$_REQUEST["ID"];

    $sql = "SELECT Überschrift FROM überschrift WHERE ID = ".$ID; 
    $result = mysqli_query($link, $sql);
    $row = mysqli_fetch_assoc($result);
    $Überschrift = $row["Überschrift"];
    
    $sql = "SELECT COUNT(Überschrift) as Anzahl FROM admin WHERE Überschrift = '".$Überschrift."'"; 
    $result = mysqli_query($link, $sql);
    $row = mysqli_fetch_assoc($result);
    echo $row["Anzahl"];

 ?>  