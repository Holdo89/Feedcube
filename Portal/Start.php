<?php
 require_once "session.php";
 require_once "config.php";
 
 $sql = "SELECT Is_Admin FROM users WHERE username = '".$_SESSION["username"]."'";
 $result = mysqli_query($link, $sql);
 $row = mysqli_fetch_assoc($result);

if($row["Is_Admin"]==0){
	 include "Startseite.php";
	 }
 else{include "Startseite_admin.php";}
?>




