<?php
clearstatcache(true);
include "../config.php";
$ID = $_REQUEST["ID"];
$checked_Fragen = "";
$sql = "SELECT Fragen_intern FROM intern WHERE Umfrage_".$ID." = 1";
$result = mysqli_query($link,$sql);
while($row = mysqli_fetch_assoc($result)){
    $checked_Fragen = $checked_Fragen.$row["Fragen_intern"].";.,";
}
echo substr($checked_Fragen,0,-3);
?>