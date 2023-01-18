<?php
    require_once "../config.php";
    require_once "session.php";
    $sql_admins = "SELECT COUNT(ID) FROM users WHERE Is_Admin = 1"; 
    $result_admins = mysqli_query($link, $sql_admins);
    $row_admins = mysqli_fetch_array($result_admins);
    $AnzahlAdmins = $row_admins["COUNT(ID)"];
    echo $AnzahlAdmins;
?>