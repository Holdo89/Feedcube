<?php

require_once "../config.php";
require_once "session.php";

$ID = $_REQUEST["ID"];
$Fragentyp = $_REQUEST["Fragentyp"];
$Typ = $_REQUEST["Typ"];

if ($Fragentyp=="Bewertung") 
{
    $sql = "SELECT * FROM bewertung_answers WHERE Fragenspezifisch = ".$ID." AND Frage_".$ID." = 1 OR Frage_".$ID." = 0 ORDER BY post_order_no ASC";
}
else if($Fragentyp=="Multiplechoice")
{
    $sql = "SELECT * FROM multiplechoice_answers WHERE Fragenspezifisch = ".$ID." AND Frage_".$ID." = 1 OR Frage_".$ID." = 0 ORDER BY post_order_no ASC";
} 
$result = mysqli_query($link,$sql);
echo'<h5>Erstelle eine neue Antwort für diese Frage:</h5>
<input style="margin-left:0px; width:60%; min-width:220px;" id="'.$Fragentyp.'newanswer" name="newanswer"></input>
<h5>Übersetzung:</h5>
<input style="margin-left:0px; width:60%; min-width:220px;" id="'.$Fragentyp.'newanswerEnglisch" name="newanswerEnglisch"></input>
<br>
<input id = "element2" style="margin-left:10px; width:150px; padding:2px; margin-top:10px; font-size:13px" type="button" onclick="addSpecificAnswer('.$Fragentyp.','.$ID.')" value="Hinzufügen"></input><br><br>
<h5>Wähle Antworten für diese Frage:</h5>';
while($row = mysqli_fetch_assoc($result))
{
	echo'<div style="background-color:ghostwhite; margin-bottom:10px; padding: 5px;"><input type="hidden" value="'.$row["Answers"].'_unchecked" name="checkbox[]"><input type="checkbox" style="margin-left:0px;" id="'.$row["Answers"].'_'.$Typ.'_'.$Fragentyp.'" name="checkbox[]" value="'.$row["Answers"].'" ';
    if($row["Frage_".$ID]==1)
    {
        echo'checked';
    }
    echo"><label for='".$row["Answers"]."_".$Typ."_".$Fragentyp."' style='border:none;'> ".$row["Answers"]."</label><button type='button' style='border:none; background:white; margin-left:10px;' onclick='ShowFragenspezifischeDetails(".$row["ID"].",\"".$Fragentyp."\")'><i class='fa fa-pencil'></i></button><button type='button' style='border:none; background:white; margin-left:10px;' onclick='Antwort_löschen(".$row["ID"].",\"".$Fragentyp."\")'><i class='fa fa-trash'></i></button>";
    echo"<div id='Container_".$Fragentyp."_".$row["ID"]."' style='grid-template-columns:auto auto; display:none'><div>Bezeichnung:</div><div>Englische Übersetzung:</div>";
    echo"<div><input id='Fragenspezifisch_".$Fragentyp."_".$row["ID"]."' style='width:90%' value='".$row["Answers"]."'></div><div><input id='FragenspezifischEnglisch_".$Fragentyp."_".$row["ID"]."' style='width:90%' value='".$row["Answers_Englisch"]."'></div><div><input id='element2' type='button' value='Speichern' style='width:150px; padding:2px; margin-left:10px; margin-top:20px; margin-bottom:10px; font-size:13px' onclick='bearbeiteFragenspezifischeAntwort(".$row["ID"].",\"".$Fragentyp."\")'</input></div></div></div></div>";
}
?>