<?php
include "../config.php";
include "session.php";
$sql_avatar = "UPDATE users SET Avatar = '' WHERE username ='".$_SESSION["username"]."'";
$result_avatar = mysqli_query($link,$sql_avatar);
header("location: Profil.php");

?>