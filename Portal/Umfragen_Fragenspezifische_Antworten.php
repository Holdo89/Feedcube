<?php

require_once "../config.php";
require_once "session.php";

$ID = $_REQUEST["ID"];
$Fragentyp = $_REQUEST["Fragentyp"];

if($Fragentyp=="Multiplechoice")
{
    $sql = "SELECT * FROM multiplechoice_answers WHERE Fragenspezifisch = ".$ID." AND Intern_".$ID." = 1 OR Intern_".$ID." = 0 ORDER BY post_order_no ASC";
} 
$result = mysqli_query($link,$sql);
echo'<h5>Erstelle eine neue Antwort für diese Frage:</h5>
<input style="margin-left:0px; width:60%; min-width:220px;" id="'.$Fragentyp.'newanswer" name="newanswer"></input>
<h5 style="display:none">Übersetzung:</h5>
<input style="display:none; margin-left:0px; width:60%; min-width:220px;" id="'.$Fragentyp.'newanswerEnglisch" name="newanswerEnglisch"></input>
<br>
<input id = "element" type="button" onclick="addSpecificAnswer('.$Fragentyp.','.$ID.')" style="height: 40px; width:200px; padding: 4px; background-color:white; border: 2px solid; color:';
$sql='SELECT farbe FROM system';
$exec=mysqli_query($link, $sql);
$result_color=mysqli_fetch_assoc($exec);
echo $result_color['farbe'].'" value="Hinzufügen"></input><br><br>
<h5>Wähle Antworten für diese Frage:</h5>';
while($row = mysqli_fetch_assoc($result))
{
    echo'<div style="background-color:ghostwhite; margin-bottom:10px; padding: 5px;"><input type="hidden" value="'.$row["Answers"].'_unchecked" name="checkbox[]"><input type="checkbox" style="margin-left:0px;" id="'.$row["ID"].'_'.$Fragentyp.'" name="checkbox[]" value="'.$row["Answers"].'" ';
    if($row["Intern_".$ID]==1)
    {
        echo'checked';
    }
    echo"><input type='hidden' value='".$row["ID"]."_unchecked_englisch' name='checkboxenglisch[]'>
    <input type='checkbox' style='margin-left:0px; display:none' id='".$row["ID"]."_intern_Multiplechoice_englisch' name='checkboxenglisch[]' value='".$row["Answers_Englisch"]."' onclick='return false' checked>
    <label id='label_".$row["ID"]."' for='".$row["ID"]."_".$Fragentyp."' style='border:none;'> ".$row["Answers"]."</label><button type='button' style='border:none; background:white; margin-left:10px;' onclick='ShowFragenspezifischeDetails(".$row["ID"].",\"".$Fragentyp."\")'><i class='fa fa-pencil'></i></button><button type='button' style='border:none; background:white; margin-left:10px;' onclick='Antwort_löschen(".$row["ID"].",\"".$Fragentyp."\")'><i class='fa fa-trash'></i></button>";
    echo"<div id='Container_".$Fragentyp."_".$row["ID"]."' style='grid-template-columns:auto auto; display:none'><div>Bezeichnung:</div><div>Englische Übersetzung:</div>";
    echo"<div><input id='Fragenspezifisch_".$Fragentyp."_".$row["ID"]."' onchange='updateInput(this.value, \"Fragenspezifisch_Multiplechoice_".$row["ID"]."\")' style='width:90%' value='".$row["Answers"]."'></div><div><input id='FragenspezifischEnglisch_".$Fragentyp."_".$row["ID"]."' onchange='updateInput(this.value, \"FragenspezifischEnglisch_Multiplechoice_".$row["ID"]."\")' style='width:90%' value='".$row["Answers_Englisch"]."'></div><div><input id='element2' type='button' value='speichern' style='width:150px; padding:2px; margin-left:10px; margin-top:20px; margin-bottom:10px; font-size:13px' onclick='bearbeiteFragenspezifischeAntwort(".$row["ID"].",\"".$Fragentyp."\")'</input></div></div></div></div>";
}
?>