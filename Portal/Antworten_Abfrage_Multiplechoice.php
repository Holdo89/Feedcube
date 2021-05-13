<?php

$sql = "SELECT * FROM multiplechoice_answers ORDER BY post_order_no ASC";
$result = mysqli_query($link, $sql);

while($row = mysqli_fetch_assoc($result)) {
    echo"<form class='form_antworten' data-post-id=".$row["post_id"]." style = 'cursor: grab'>";
    echo"<div class='center_select'>";
    echo "<input type='checkbox' id='Antwort_".$row["ID"]."' value='".$row["Answers"]."' style='float:left; margin-top:13px; margin-left:40%; margin-right:10px;' checked></input>";
    echo "<label for='Antwort_".$row["ID"]."' value='".$row["Answers"]."' onblur='Antwort_speichern(".$row["ID"].")' style='border:none'>".$row["Answers"]."</label>";
    echo"</div>";    
    echo "<button type='button' class='center_button' onclick='Antwort_löschen(".$row["ID"].",\"Multiplechoice\")'><i class='fa fa-trash'></i></button>";    
    echo"</form>";
}

?>