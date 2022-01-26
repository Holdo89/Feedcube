<?php
include "../config.php";
$ID = $_REQUEST["ID"];
$Type = $_REQUEST["Type"];
$fragenspezifisch = $_REQUEST["fragenspezifisch"];

if ($Type == "Bewertung")
{
    $checked_Fragen = "";
    if ($fragenspezifisch=="false") {
        $sql = "SELECT Answers FROM bewertung_answers WHERE Fragenspezifisch = 0 ORDER BY post_order_no ASC";
    }
    else{
        $sql = "SELECT Answers FROM bewertung_answers WHERE Fragenspezifisch = ".$ID." ORDER BY post_order_no ASC";
    }
    $result = mysqli_query($link,$sql);
    while($row = mysqli_fetch_assoc($result)){
        $checked_Fragen = $checked_Fragen.$row["Answers"].",";
    }
    echo substr($checked_Fragen,0,-1);
}
else if($Type == "Multiplechoice")
{
    $checked_Fragen = "";
    if ($fragenspezifisch=="false") {
        $sql = "SELECT Answers FROM multiplechoice_answers WHERE Fragenspezifisch = 0 ORDER BY post_order_no ASC";
    }
    else{
        $sql = "SELECT Answers FROM multiplechoice_answers WHERE Fragenspezifisch = ".$ID." ORDER BY post_order_no ASC";
    }
    $result = mysqli_query($link,$sql);
    while($row = mysqli_fetch_assoc($result)){
        $checked_Fragen = $checked_Fragen.$row["Answers"].",";
    }
    echo substr($checked_Fragen,0,-1);
}
?>