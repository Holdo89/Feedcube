<?php
 require_once "../config.php";
 require_once "session.php";

if(!isset($_COOKIE["SkipIntro"])) {
     header("location: offline.php");
}


$sql = "SELECT Is_Admin, Is_Trainer FROM users WHERE username ='".$_SESSION["username"]."'";
$exec = mysqli_query($link,$sql);
$row = mysqli_fetch_assoc($exec);
$IsAdmin = $row["Is_Admin"];
$IsTrainer = $row["Is_Trainer"];
if($IsTrainer || $IsAdmin)
{
    if($IsAdmin){
        $sql = "SELECT COUNT(id) FROM users WHERE Confirmed = 0";
        $exec = mysqli_query($link,$sql);
        $row = mysqli_fetch_assoc($exec);
        if($row["COUNT(id)"]>0 && !isset($_SESSION["suspendConfirmation"]))
        {
            include "confirmation.php";
        }
        else
        {
            include "Startseite.php";
        }
    }
    else
    {
        include "Startseite.php";
    }
}
else 
{
    include "pending.php";
}
?>




