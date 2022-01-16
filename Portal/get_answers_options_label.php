<?php

    require_once "../config.php";

    $sql="SELECT * FROM bewertung_answers ORDER BY post_order_no ASC";

    $i=1;

    $result=mysqli_query($link,$sql);

    while($row=mysqli_fetch_array($result))

    {

        echo $i."=".$row["Answers"]."   ";

        $i=$i+1;

    }

?>