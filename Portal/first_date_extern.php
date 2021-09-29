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
        $sql="SELECT DATEDIFF(CURRENT_DATE, '".$Mindate."') AS Datediff";
        $exec=mysqli_query($link,$sql);
        $rows=mysqli_fetch_array($exec);
        echo $rows['Datediff'];
    }
    else
    echo"7";

?>

