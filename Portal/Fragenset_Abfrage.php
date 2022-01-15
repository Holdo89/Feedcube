<?php

$sql = "SELECT * FROM fragensets"; 
$result = mysqli_query($link, $sql);

while($row = mysqli_fetch_assoc($result)) {
    echo "<input class= center_select id='Fragenset_".$row["ID"]."' value='".$row["Fragenset"]."' onblur='fragenset_abfrage_speichern(".$row["ID"].")'></input>";
    echo "<button type='button' class='center_button' onclick='display(".$row["ID"].",\"fragenset\");' ><i class='fa fa-pencil'></i></button>";
    echo "<button type='button' class='center_button' onclick='fragenset_abfrage_löschen(".$row["ID"].")'><i class='fa fa-trash'></i></button>";            
}

?>