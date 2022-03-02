<?php

$sql = "SELECT * FROM multiplechoice_answers ORDER BY post_order_no ASC";
$result = mysqli_query($link, $sql);

while($row = mysqli_fetch_assoc($result)) {
    echo"<form class='form_antworten' data-post-id=".$row["post_id"]." style = 'cursor: grab'>";
    echo"<div class='center_select'>";
    echo "<input type='checkbox' checked></input>";
    echo "<input class='antworten_text' id='Antwort_".$row["ID"]."' value='".$row["Answers"]."' onblur='Antwort_speichern(".$row["ID"].",\"Multiplechoice\")'></input>";
    echo"</div>";    
    echo "<button type='button' class='center_button' onclick='display(".$row["ID"].", \"answers\", \"Multiplechoice\");' ><i class='fa fa-pencil'></i><span class='tooltiptext'>Bearbeiten</span></button>";
    echo "<button type='button' class='center_button' onclick='Antwort_löschen(".$row["ID"].",\"Multiplechoice\")'><i class='fa fa-trash'></i><span class='tooltiptext'>Löschen</span></button>";    
    echo"</form>";
}

?>