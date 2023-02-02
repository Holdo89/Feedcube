<?php
include "../config.php";
$ID = $_REQUEST["ID"];
$checked_Fragen = "";
$sql = "SELECT Fragenbeschreibung FROM intern";
$result = mysqli_query($link,$sql);
while($row = mysqli_fetch_assoc($result)){
    $checked_Fragen = $checked_Fragen.$row["Fragenbeschreibung"].";.,";
}
echo substr($checked_Fragen,0,-3);
?>