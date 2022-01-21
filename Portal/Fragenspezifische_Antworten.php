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
while($row = mysqli_fetch_assoc($result))
{
	echo'<input type="hidden" value="'.$row["Answers"].'_unchecked" name="checkbox[]"><input type="checkbox" style="margin-left:0px;" id="'.$row["Answers"].'_extern_Bewertung" name="checkbox[]" value="'.$row["Answers"].'"><label for="'.$row["Answers"].'_extern_Bewertung" style="border:none;"> '.$row["Answers"].'</label>';
}
?>