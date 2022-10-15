<?php

$sql = "SELECT * FROM fragensets"; 
$result = mysqli_query($link, $sql);

while($row = mysqli_fetch_assoc($result)) {
    echo "<div class= center_select style='height:30px; margin-top:10px; padding-left:15px;' id='Fragenset_".$row["ID"]."'>".$row["Fragenset"]."</div>";
    echo "<button type='button' class='center_button' onclick='display(".$row["ID"].",\"fragenset\");' ><i class='fa fa-pencil'></i><span class='tooltiptext'>Bearbeiten</span></button>";
    echo "<button type='button' class='center_button' onclick='fragenset_abfrage_löschen(".$row["ID"].")'><i class='fa fa-trash'></i><span class='tooltiptext'>Löschen</span></button>";            
}

?>