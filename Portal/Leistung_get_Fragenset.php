<?php
include "../config.php";
$ID = $_REQUEST["ID"];
$checked_Fragen = "";
$sql = "SELECT Fragen_extern FROM admin";
$result = mysqli_query($link,$sql);
while($row = mysqli_fetch_assoc($result)){
    $checked_Fragen = $checked_Fragen.$row["Fragen_extern"].",";
}
echo substr($checked_Fragen,0,-1);
?>