<?php
include "../config.php";
$sql = "SELECT ID FROM multiplechoice_answers ORDER BY ID DESC LIMIT 1";
$result = mysqli_query($link,$sql);
$row = mysqli_fetch_assoc($result);
echo $row["ID"];

?>