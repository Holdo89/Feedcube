<?php
 require_once "../config.php";
 require_once "session.php";

 $sql_skipintro = "SELECT SkipIntro FROM system";
 $exec_skipintro = mysqli_query($link,$sql_skipintro);
 $row_skipintro = mysqli_fetch_assoc($exec_skipintro);
 $skipintro = $row_skipintro["SkipIntro"];

$sql = "SELECT Is_Admin, Is_Trainer FROM users WHERE username ='".$_SESSION["username"]."'";
$exec = mysqli_query($link,$sql);
$row = mysqli_fetch_assoc($exec);
$IsAdmin = $row["Is_Admin"];
$IsTrainer = $row["Is_Trainer"];
if($IsTrainer || $IsAdmin)
{
    if($IsAdmin){
        if($skipintro==0) {
            header("location: Introstart.php");
        }
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




