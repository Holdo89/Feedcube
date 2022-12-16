<?php
    require_once "../config.php";

    $Leistung = $_REQUEST["Leistung"];

    $sql="SELECT Leistung FROM leistungen WHERE ID LIKE '".$Leistung."' ORDER BY ID";
    $result=mysqli_query($link,$sql);
    while($row=mysqli_fetch_array($result))
    {
        echo $row["Leistung"].",";
    }

?>