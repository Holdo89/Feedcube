<?php
    require_once "../config.php";

    $Umfrage = $_REQUEST["Umfrage"];

    $sql="SELECT Umfrage FROM umfragen WHERE ID LIKE '".$Umfrage."' ORDER BY ID";
    $result=mysqli_query($link,$sql);
    while($row=mysqli_fetch_array($result))
    {
        echo $row["Umfrage"].",";
    }

?>