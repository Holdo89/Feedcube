<?php

require_once "../config.php";
require_once "session.php";


$sql = "SELECT Notification FROM users WHERE username ='".$_SESSION["username"]."'";
$exec = mysqli_query($link,$sql);
$row = mysqli_fetch_assoc ($exec);
if($row["Notification"]=='1')
{
    $sql = "UPDATE users SET Notification = 0 WHERE username ='".$_SESSION["username"]."'";
    echo"0";
}
else
{
    $sql = "UPDATE users SET Notification = 1 WHERE username ='".$_SESSION["username"]."'";
    echo"1";
}
$exec = mysqli_query($link,$sql);

?>