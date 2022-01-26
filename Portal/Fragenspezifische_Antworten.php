<?php

require_once "../config.php";
require_once "session.php";

$ID = $_REQUEST["ID"];
$Fragentyp = $_REQUEST["Fragentyp"];

if ($Fragentyp=="Bewertung") 
{
    $sql = "SELECT Answers FROM bewertung_answers WHERE Fragenspezifisch = ".$ID." ORDER BY post_order_no ASC";
}
else if($Fragentyp=="Multiplechoice")
{
    $sql = "SELECT Answers FROM multiplechoice_answers WHERE Fragenspezifisch = ".$ID." ORDER BY post_order_no ASC";
} 
$result = mysqli_query($link,$sql);
echo'<h5>Erstelle eine neue Antwort für diese Frage:</h5>
<input style="margin-left:0px; width:60%; min-width:220px;" id="'.$Fragentyp.'newanswer" name="newanswer"></input>
<input type="button" onclick="addSpecificAnswer('.$Fragentyp.','.$ID.')" value="hinzufügen"></input><br>
<h5>Wähle Antworten für diese Frage:</h5>';
while($row = mysqli_fetch_assoc($result))
{
	echo'<input type="hidden" value="'.$row["Answers"].'_unchecked" name="checkbox[]"><input type="checkbox" style="margin-left:0px;" id="'.$row["Answers"].'_extern_'.$Fragentyp.'" name="checkbox[]" value="'.$row["Answers"].'" onclick="return false" checked><label for="'.$row["Answers"].'_extern_'.$Fragentyp.'" style="border:none;"> '.$row["Answers"].'</label><br>';
}
?>