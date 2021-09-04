<?php
 require_once "session.php";
 require_once "../config.php";

$sql = "SELECT Is_Admin, Is_Trainer FROM users WHERE username ='".$_SESSION["username"]."'";
$exec = mysqli_query($link,$sql);
$row = mysqli_fetch_assoc($exec);
$IsAdmin = $row["Is_Admin"];
$IsTrainer = $row["Is_Trainer"];
if($IsTrainer || $IsAdmin)
{
 include "Startseite.php";
}
else 
{
    include "StartseiteNotAcknowledged.php";
}
?>




