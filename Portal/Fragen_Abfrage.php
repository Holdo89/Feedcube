<?php
								
$sql = "SELECT * FROM admin ORDER BY post_order_no ASC"; 
$result = mysqli_query($link, $sql);
//number of rows
$rowCount = mysqli_num_rows($result);

if($rowCount > 0){
    while($row = mysqli_fetch_assoc($result)) {
        $tutorial_id = 	$row['post_id'];
        echo "<form data-post-id=".$row["post_id"]." style = 'cursor: grab'>";
        echo "<div class='center_select' style='text-align:center; margin:auto;min-width:35px'><i class='fa fa-bars'></i></div>";
        echo "<input class='center_select' id='Kapitel_".$row["ID"]."' value='".$row["Kapitel"]."' onblur='user_abfrage_speichern(".$row["ID"].")'></input>";
        echo "<input class='center_select' id='Frage_".$row["ID"]."' value='".$row["Fragen_extern"]."' onblur='user_abfrage_speichern(".$row["ID"].")'></input>";
        echo "<input class='center_select' id='Auswahl_Fragentyp_".$row["ID"]."' value='".$row["Typ"]."' name='Auswahl_Fragentyp' oninput='user_abfrage_speichern(".$row["ID"].")' readonly></input>";
        echo "<button type='button' class='center_button' onclick='user_abfrage_löschen(".$row["ID"].")'><i class='fa fa-trash'></i></button>"; 
        if ($row["Typ"]=="Singlechoice") 
        { 
            echo "<button type='button' class='center_button' onclick='display(".$row["ID"].", \"extern\", \"Singlechoice\");' ><i class='fa fa-pencil'></i></button>";
        }
        else if ($row["Typ"]=="Multiplechoice") 
        {
            echo "<button type='button' class='center_button' onclick='display(".$row["ID"].", \"extern\", \"Multiplechoice\");' ><i class='fa fa-pencil'></i></button>";
        }
        else if ($row["Typ"]=="Schieberegler") 
        {
            echo "<button type='button' class='center_button' onclick='display(".$row["ID"].", \"extern\", \"Schieberegler\");' ><i class='fa fa-pencil'></i></button>";
        }
        else{
            echo "<button type='button' class='center_button'></button>";
        }
        echo "</form>";
    }
}

?>