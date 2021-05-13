<?php
require_once "config.php";
require_once "session.php";

$sql = "SELECT Is_Admin FROM users WHERE username ='".$_SESSION["username"]."'";
$exec = mysqli_query($link,$sql);
$row = mysqli_fetch_assoc($exec);
$IsAdmin = $row["Is_Admin"];

if($IsAdmin==1)
{
    $Trainer=$_REQUEST["Trainer"];
}
else
    $Trainer=$_SESSION["username"];

?>