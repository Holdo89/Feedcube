<?php

require_once "../config.php";
require_once "session.php";

$ID = $_REQUEST["ID"];
$Fragentyp = $_REQUEST["Fragentyp"];
$Typ = $_REQUEST["Typ"];

if ($Fragentyp=="Bewertung") 
{
    $sql = "SELECT * FROM bewertung_answers WHERE Fragenspezifisch = ".$ID." ORDER BY post_order_no ASC";
}
else if($Fragentyp=="Multiplechoice")
{
    $sql = "SELECT * FROM multiplechoice_answers WHERE Fragenspezifisch = ".$ID." ORDER BY post_order_no ASC";
} 
$result = mysqli_query($link,$sql);
echo'<h5>Erstelle eine neue Antwort für diese Frage:</h5>
<input style="margin-left:0px; width:60%; min-width:220px;" id="'.$Fragentyp.'newanswer" name="newanswer"></input>
<h5>Übersetzung:</h5>
<input style="margin-left:0px; width:60%; min-width:220px;" id="'.$Fragentyp.'newanswerEnglisch" name="newanswerEnglisch"></input>
<br>
<input id = "element" type="button" onclick="addSpecificAnswer('.$Fragentyp.','.$ID.')" style="height: 40px; width:200px; padding: 4px; background-color:white; border: 2px solid; color:';
$sql='SELECT farbe FROM system';
$exec=mysqli_query($link, $sql);
$result_color=mysqli_fetch_assoc($exec);
echo $result_color['farbe'].'" value="Hinzufügen"></input><br><br>
<h5>Wähle Antworten für diese Frage:</h5>';
while($row = mysqli_fetch_assoc($result))
{
	echo'<p><input type="hidden" value="'.$row["Answers"].'_unchecked" name="checkbox[]"><input type="checkbox" style="margin-left:0px;" id="'.$row["Answers"].'_'.$Typ.'_'.$Fragentyp.'" name="checkbox[]" value="'.$row["Answers"].'" onclick="return false" checked><label for="'.$row["Answers"].'_'.$Typ.'_'.$Fragentyp.'" style="border:none;"> '.$row["Answers"].'</label>';
    echo "<button type='button' style='border:none; background:white; margin-left:10px;' onclick='Antwort_löschen(".$row["ID"].",\"".$Fragentyp."\")'><i class='fa fa-trash'></i></button></p>";    
}
?>