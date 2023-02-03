<?php
include "../config.php";
$ID = $_REQUEST["ID"];
$Type = $_REQUEST["Type"];

if ($Type == "Bewertung")
{
    $checked_Fragen = "";
    $sql = "SELECT Answers FROM bewertung_answers ORDER BY post_order_no ASC";
    $result = mysqli_query($link,$sql);
    while($row = mysqli_fetch_assoc($result)){
        $checked_Fragen = $checked_Fragen.$row["Answers"].",";
    }
    echo substr($checked_Fragen,0,-1);
}
if ($Type == "Multiplechoice")
{
    $checked_Fragen = "";
    $sql = "SELECT Answers FROM multiplechoice_answers WHERE Intern_".$ID." = 1 ORDER BY post_order_no ASC";
    $result = mysqli_query($link,$sql);
    while($row = mysqli_fetch_assoc($result)){
        $checked_Fragen = $checked_Fragen.$row["Answers"].",";
    }
    echo substr($checked_Fragen,0,-1);
}
?>