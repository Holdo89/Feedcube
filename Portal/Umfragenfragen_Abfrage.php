<?php

$sql = "SELECT * FROM intern WHERE Umfrage_".$row_Umfragen["ID"]." = 1 ORDER BY post_order_no ASC";
$result = mysqli_query($link, $sql);
$rowCount = mysqli_num_rows($result);

if ($rowCount > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
        $tutorial_id = 	$row['post_id'];
        echo "<form class='form_intern' data-post-id=".$row["post_id"]." style = 'cursor: grab'>";
        echo "<p class='center_select' style='text-align:center; margin:auto; min-width:35px'><i class='fa fa-bars'></i></p>";
        echo "<div class='center_select' id='Frage_".$row["ID"]."'>".$row["Fragenbeschreibung"]."</div>";
        if ($row["Typ"]=="Bewertung") {
            echo "<button type='button' class='center_button' onclick='display(".$row["ID"].", \"Bewertung\");' ><i class='fa fa-pencil'></i></button>";
        } elseif ($row["Typ"]=="Multiplechoice") {
            echo "<button type='button' class='center_button' onclick='display(".$row["ID"].", \"Multiplechoice\");' ><i class='fa fa-pencil'></i></button>";
        } elseif ($row["Typ"]=="Schieberegler") {
            echo "<button type='button' class='center_button' onclick='display(".$row["ID"].", \"Schieberegler\");' ><i class='fa fa-pencil'></i></button>";
        } else {
            echo "<button type='button' class='center_button' onclick='display(".$row["ID"].", \"Text\");' ><i class='fa fa-pencil'></i></button>";
        }
        echo "<button type='button' class='center_button' onclick='user_abfrage_löschen_intern(".$row["ID"].")'><i class='fa fa-trash'></i></button>";

        echo"</form>";
    }
}
