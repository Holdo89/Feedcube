<?php

$sql = "SELECT * FROM admin WHERE Kapitel = '".$row_überschrift["Überschrift"]."' ORDER BY post_order_no ASC";
$result = mysqli_query($link, $sql);
$rowCount = mysqli_num_rows($result);

if ($rowCount > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
        $tutorial_id = 	$row['post_id'];
        echo "<form  class='form_intern' data-post-id=".$row["post_id"]." style = 'cursor: grab'>";
        echo "<div class='center_select' style='text-align:center; margin:auto;min-width:35px'><i class='fa fa-bars'></i></div>";
        echo "<input class='center_select' id='Frage_".$row["ID"]."' value='".$row["Fragen_extern"]."' onblur='user_abfrage_speichern(".$row["ID"].")'></input>";
        if ($row["Typ"]=="Bewertung") {
            echo "<button type='button' class='center_button' onclick='display(".$row["ID"].", \"extern\", \"Bewertung\");' ><i class='fa fa-pencil'></i><span class='tooltiptext'>Bearbeiten</span></button>";
        } elseif ($row["Typ"]=="Multiplechoice") {
            echo "<button type='button' class='center_button' onclick='display(".$row["ID"].", \"extern\", \"Multiplechoice\");' ><i class='fa fa-pencil'></i><span class='tooltiptext'>Bearbeiten</span></button>";
        } elseif ($row["Typ"]=="Schieberegler") {
            echo "<button type='button' class='center_button' onclick='display(".$row["ID"].", \"extern\", \"Schieberegler\");' ><i class='fa fa-pencil'></i><span class='tooltiptext'>Bearbeiten</span></button>";
        } elseif ($row["Typ"]=="Text") {
            echo "<button type='button' class='center_button' onclick='display(".$row["ID"].", \"extern\", \"Text\");' ><i class='fa fa-pencil'></i><span class='tooltiptext'>Bearbeiten</span></button>";
        } else {
            echo "<button type='button' class='center_button'></button>";
        }
        echo "<button type='button' class='center_button' onclick='user_abfrage_löschen(".$row["ID"].")'><i class='fa fa-trash'></i><span class='tooltiptext'>Löschen</span></button>";

        echo "</form>";
    }
}
