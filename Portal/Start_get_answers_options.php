<?php
    require_once "../config.php";

    $sql = "SELECT Answers FROM bewertung_answers ORDER BY post_order_no ASC";
    $result=mysqli_query($link,$sql);
    while($row=mysqli_fetch_array($result))
    {
        echo $row["Answers"].",";
    }

?>