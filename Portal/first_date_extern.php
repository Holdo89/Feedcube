<?php
require_once "../config.php";
require_once "session.php";
$Trainer = $_REQUEST["Trainer"];



    $sql="SELECT COUNT(ID) FROM externes_feedback WHERE Username LIKE '".$Trainer."'";
    $exec=mysqli_query($link,$sql);
    $row=mysqli_fetch_array($exec);
    if($row["COUNT(ID)"]!=0)
    {
        $sql="SELECT MIN(Datum)FROM externes_feedback WHERE Username LIKE '".$Trainer."'";
        $exec=mysqli_query($link,$sql);
        $row=mysqli_fetch_array($exec);
        $Mindate = $row['MIN(Datum)'];
        echo $Mindate;
    }
    else
    echo"7";

?>

