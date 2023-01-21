<?php
include "../config.php";
include "session.php";
if (isset($_REQUEST["chosenUsername"]))
$sql_avatar = "UPDATE users SET Avatar = '' WHERE username ='".$_REQUEST["chosenUsername"]."'";
else
$sql_avatar = "UPDATE users SET Avatar = '' WHERE username ='".$_SESSION["username"]."'";
$result_avatar = mysqli_query($link,$sql_avatar);
if (isset($_REQUEST["chosenUsername"]))
header("location: Usermanagement.php");
else
header("location: Profil.php");



?>