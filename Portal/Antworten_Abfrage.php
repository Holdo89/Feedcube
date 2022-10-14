<?php

$sql = "SELECT * FROM bewertung_answers WHERE Fragenspezifisch=0 ORDER BY post_order_no ASC";
$result = mysqli_query($link, $sql);

while($row = mysqli_fetch_assoc($result)) {
    echo"<form class='form_antworten' data-post-id=".$row["post_id"]." style = 'cursor: grab'>";
    echo "<p name='bars' class='center_select' style='text-align:center; margin:auto;min-width:35px'><i class='fa fa-bars'></i></p>";
    echo"<div class='center_select'>";
    echo "<input type='radio' checked></input>";
    echo "<div class='antworten_text' id='Antwort_Bewertung_".$row["ID"]."')'>".$row["Answers"]."</div>";
    echo"</div>";
    echo "<button type='button' class='center_button' onclick='display(".$row["ID"].", \"answers\", \"Bewertung\");' ><i class='fa fa-pencil'></i><span class='tooltiptext'>Bearbeiten</span></button>";
    echo "<button type='button' class='center_button' onclick='Antwort_löschen(".$row["ID"].",\"Bewertung\")'><i class='fa fa-trash'></i><span class='tooltiptext'>Löschen</span></button>";    
    echo"</form>";
}
?>