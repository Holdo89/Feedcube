<?php
include "../config.php";
$Username=$_REQUEST["Username"];

    $sql = "SELECT name FROM users WHERE username = '".$Username."'"; 
    $result = mysqli_query($link, $sql);
    $row = mysqli_fetch_assoc($result);
    echo $row["name"];
 ?>  