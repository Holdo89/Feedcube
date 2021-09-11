<?php
 require_once "session.php";
$_SESSION["suspendConfirmation"] = 1;
header("location:Start.php");
?>


