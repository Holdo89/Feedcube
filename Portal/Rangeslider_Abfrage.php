<?php
include "../config.php";
$ID=$_REQUEST["ID"];

    $sql = "SELECT * FROM rangeslider_answers WHERE Frage_ID = ".$ID; 

    $result = mysqli_query($link, $sql);
    while($row = mysqli_fetch_assoc($result)) {
        echo "<input type='number' class='center_select' id='Range_Min' name='Range_Min' min='0' value='".$row["range_min"]."'  style='text-align:center;margin:auto'></input>";
        echo "<input type='number' class='center_select' id='Range_Max' name='Range_Max' max='1000' value='".$row["range_max"]."'  style='text-align:center;margin:auto'></input>";
        echo "<input type='number' class='center_select' id='Columns' name='Columns' value='".$row["columns"]."' style='text-align:center;margin:auto'></input>";
    };
    echo "<input class='center_select' id='ID' name='ID' value='".$ID."' style='text-align:center;margin:auto; display:none;'></input>";
?>  