<?php

$sql = "SELECT * FROM intern WHERE Umfrage_".$row_Umfragen["ID"]." = 1 ORDER BY post_order_no ASC"; 
$result = mysqli_query($link, $sql);
$rowCount = mysqli_num_rows($result);

if($rowCount > 0){
while($row = mysqli_fetch_assoc($result)) {
    $tutorial_id = 	$row['post_id'];
    echo "<form class='form_intern' data-post-id=".$row["post_id"]." style = 'cursor: grab'>";
    echo "<div class='center_select' style='text-align:center; margin:auto; min-width:35px'><i class='fa fa-bars'></i></div>";
    echo "<input class='center_select' id='Frage_".$row["ID"]."' value='".$row["Fragen_intern"]."' onblur='user_abfrage_speichern_intern(".$row["ID"].")'></input>";
    if ($row["Typ"]=="Bewertung") 
    { 
        echo "<button type='button' class='center_button' onclick='display(".$row["ID"].", \"intern\", \"Bewertung\");' ><i class='fa fa-pencil'></i></button>";
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
    echo "<button type='button' class='center_button' onclick='user_abfrage_löschen_intern(".$row["ID"].")'><i class='fa fa-trash'></i></button>";          

    echo"</form>";
}
}
?>