<?php
 require_once "../config.php";
 require_once "session.php";
?>

<?php

$Text_vor_Abgabe = $_REQUEST["Text_vor_Abgabe"];
$sql = "UPDATE system SET Text_vor_Abgabe = '".$Text_vor_Abgabe."';";
$query = mysqli_query($link, $sql);


$Text_before_Feedback = $_REQUEST["Text_before_Feedback"];
$sql = "UPDATE system SET Text_before_Feedback = '".$Text_before_Feedback."';";
$query = mysqli_query($link, $sql);

$Text_nach_Abgabe = $_REQUEST["Text_nach_Abgabe"];
$sql = "UPDATE system SET Text_nach_Abgabe = '".$Text_nach_Abgabe."';";
$query = mysqli_query($link, $sql);

$Text_after_Feedback = $_REQUEST["Text_after_Feedback"];
$sql = "UPDATE system SET Text_after_Feedback = '".$Text_after_Feedback."';";
$query = mysqli_query($link, $sql);

header("Location:VordefinierteTexte.php")

?>