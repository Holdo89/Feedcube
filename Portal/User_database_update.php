<?php
 require_once "session.php";
 require_once "../config.php";
 $Id=$_REQUEST["Id"];
 $User=$_REQUEST["User"];
 $Username=$_REQUEST["Username"];
 $Email=$_REQUEST["Email"];

$query = "UPDATE users SET name = '".$User."' WHERE ID = '".$Id."'";
$exec = mysqli_query($link,$query);
$query = "UPDATE users SET username = '".$Username."' WHERE ID = '".$Id."'";
$exec = mysqli_query($link,$query);
$query = "UPDATE users SET email = '".$Email."' WHERE ID = '".$Id."'";
$exec = mysqli_query($link,$query);

?>