<?php
include "../config.php";
$ID = $_REQUEST["ID"];
$sql = "SELECT Fragenset FROM umfragen WHERE ID = ".$ID;
$result = mysqli_query($link,$sql);
while($row = mysqli_fetch_assoc($result)){
    echo $row["Fragenset"];
}

?>