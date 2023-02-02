<?php
    require_once "../config.php";

    $sql="SELECT COUNT(ID) FROM umfragenfeedback";
    $exec=mysqli_query($link, $sql);
    $row=mysqli_fetch_array($exec);


    if ($row["COUNT(ID)"]!=0) 
    {
        $sql="SELECT MIN(Datum)FROM umfragenfeedback";
        $exec=mysqli_query($link, $sql);
        $row=mysqli_fetch_array($exec);
        $Mindate = $row['MIN(Datum)'];
        echo $Mindate;
    } 
    else 
    {
        echo"2022-09-01";
    }

    ?>

