<?php
include "config.php";
$ID=$_REQUEST["ID"];

    $sql = "SELECT * FROM rangeslider_answers WHERE Frage_ID = ".$ID; 

    $result = mysqli_query($link, $sql);
    while($row = mysqli_fetch_assoc($result)) {
        echo "<input class='center_select' id='Range_Min' name='Range_Min' value='".$row["range_min"]."'  style='text-align:center;margin:auto'></input>";
        echo "<input class='center_select' id='Range_Max' name='Range_Max' value='".$row["range_max"]."'  style='text-align:center;margin:auto'></input>";
        echo "<input class='center_select' id='Columns' name='Columns' value='".$row["columns"]."' style='text-align:center;margin:auto'></input>";
    };
    echo "<input class='center_select' id='ID' name='ID' value='".$ID."' style='text-align:center;margin:auto; display:none;'></input>";

    echo'<button type="submit" name = "Submit" style="background-color:white; border-radius:10px; border:1px; margin-bottom:20px;margin-top:10px; font-size:16px;" ><i class="fa fa-save"></i> speichern</button>';

?>  