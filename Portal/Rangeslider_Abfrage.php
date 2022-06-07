<?php
include "../config.php";
$ID=$_REQUEST["ID"];

    $sql = "SELECT * FROM rangeslider_answers WHERE Frage_ID = ".$ID; 

    $result = mysqli_query($link, $sql);
    while($row = mysqli_fetch_assoc($result)) {
        echo "<h5>Minimum:";
        echo "<input type='number' id='Range_Min' name='Range_Min' min='0' value='".$row["range_min"]."'  style='text-align:center;margin:auto; border-left:none; border-right:none; border-top:none'></input></h5>";
        echo "<h5>Maximum:";
        echo "<input type='number' id='Range_Max' name='Range_Max' max='1000' value='".$row["range_max"]."'  style='text-align:center;margin:auto; border-left:none; border-right:none; border-top:none'></input></h5>";
    };
    echo "<input class='center_select' id='ID' name='ID' value='".$ID."' style='text-align:center;margin:auto; display:none;'></input>";
?>  