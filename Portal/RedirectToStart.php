<?php

    $sql = "SELECT Is_Admin FROM users WHERE username ='".$_SESSION["username"]."'";
    $exec = mysqli_query($link,$sql);
    $row = mysqli_fetch_assoc($exec);
    $IsAdmin = $row["Is_Admin"];
    if($IsAdmin != 1)
        header("location:Start.php");
?>