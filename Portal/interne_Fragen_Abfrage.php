<?php

$sql = "SELECT * FROM intern ORDER BY post_order_no ASC";  /*Datum dient hier zu erkenn welcher Eintarg gelöscht wird*/
$result = mysqli_query($link, $sql);
$rowCount = mysqli_num_rows($result);

if($rowCount > 0){
while($row = mysqli_fetch_assoc($result)) {
    $tutorial_id = 	$row['post_id'];
    echo "<form class='form_intern' data-post-id=".$row["post_id"]." style = 'cursor: grab'>";
    echo "<div class='center_select' style='text-align:center; margin:auto'><i class='fa fa-bars'></i></div>";
    echo "<input class='center_select' id='Frage_".$row["ID"]."' value='".$row["Fragen_intern"]."' onblur='user_abfrage_speichern_intern(".$row["ID"].")'></input>";
    echo "<input class='center_select' id='Auswahl_Fragentyp_".$row["ID"]."' name='Auswahl_Fragentyp' value = ".$row["Typ"]." oninput='user_abfrage_speichern_intern(".$row["ID"].")' readonly></input>";
    echo "<button type='button' class='center_button' onclick='user_abfrage_löschen_intern(".$row["ID"].")'><i class='fa fa-trash'></i></button>";          
    if ($row["Typ"]=="Singlechoice") 
    { 
        echo "<button type='button' class='center_button' onclick='display(".$row["ID"].", \"intern\", \"Singlechoice\");' ><i class='fa fa-pencil'></i></button>";
    }
    else if ($row["Typ"]=="Multiplechoice") 
    {
        echo "<button type='button' class='center_button' onclick='display(".$row["ID"].", \"intern\", \"Multiplechoice\");' ><i class='fa fa-pencil'></i></button>";
    }
    else if ($row["Typ"]=="Schieberegler") 
    {
        echo "<button type='button' class='center_button' onclick='display(".$row["ID"].", \"intern\", \"Schieberegler\");' ><i class='fa fa-pencil'></i></button>";
    }
    else{
        echo "<button type='button' class='center_button'></button>";
    }
    echo"</form>";
}
}
?>