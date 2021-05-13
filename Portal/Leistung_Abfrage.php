<?php

$sql = "SELECT * FROM leistungen"; 
$result = mysqli_query($link, $sql);

while($row = mysqli_fetch_assoc($result)) {
    echo "<input class= center_select id='Leistung_".$row["ID"]."' value='".$row["Leistung"]."' onblur='user_abfrage_speichern(".$row["ID"].")'></input>";
    echo "<button type='button' class='center_button' onclick='user_abfrage_löschen(".$row["ID"].")'><i class='fa fa-trash'></i></button>";            
    echo"
	<button type='button' class='center_button' onclick='display(".$row["ID"].",\"Leistung\");' ><i class='fa fa-pencil'></i></button>";

}

?>