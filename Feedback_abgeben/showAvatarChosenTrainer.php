<?php

$Trainer=$_SESSION["Trainer"];
$sql_avatar = "SELECT name,Avatar from users WHERE name ='".$Trainer."'";
$result_avatar = mysqli_query($link,$sql_avatar);
$row_avatar = mysqli_fetch_array($result_avatar);
$image_src = $row_avatar['Avatar'];
$Name = $row_avatar['name'];


if ($image_src!="") {
    echo "<img id='avatar' src='".$image_src."' class='avatar' alt='Avatar' style='background-color:grey; object-fit:cover' />";
}

?>