<?php
require_once "../config.php";
require_once "session.php";

$ID=$_REQUEST["ID"];
$max=$_REQUEST["Range_Max"];
$min=$_REQUEST["Range_Min"];
$columns=$_REQUEST["Columns"];
$Questiontype = $Fragentyp;
$Frage = $_REQUEST["Frage"];

if($Type=="extern")
{
    $Kapitel = $_REQUEST["Kapitel"];
    $Kapitel_Englisch = $_REQUEST["Kapitel_Übersetzung"];
    $Frage_Englisch = $_REQUEST["Frage_Übersetzung"];
    $sql = "UPDATE admin SET Frage_Englisch = '".$Frage_Englisch."' WHERE ID = ".$ID;
    $query = mysqli_query($link, $sql);
    $sql = "UPDATE admin SET Kapitel_Englisch = '".$Kapitel_Englisch."' WHERE ID = ".$ID;
    $query = mysqli_query($link, $sql);
    $sql = "UPDATE admin SET Fragen_extern = '".$Frage."' WHERE ID = ".$ID;
    $query = mysqli_query($link, $sql);
    $sql = "UPDATE admin SET Kapitel = '".$Kapitel."' WHERE ID = ".$ID;
    $query = mysqli_query($link, $sql);
}
else if($Type=="intern"){
    $sql = "UPDATE intern SET Fragen_intern = '".$Frage."' WHERE ID = ".$ID;
    $query = mysqli_query($link, $sql);
}

if($max <= $min)
{
    if($Type=="extern"){
        include "Fragen.php";
        echo"<script>display(".$ID.", \"extern\", \"Schieberegler\");
        var Schieberoutput = document.getElementById('SchieberID');
        Schieberoutput.innerHTML='<div id=\"range_alert\" class=\"alert icon-alert with-arrow alert-danger form-alter\" role=\"alert\" style=\"display:block;grid-column-end: span 3;\"><i class=\"fa fa-fw fa-times-circle\"></i><strong> Note !</strong> <span class=\"warning-message\"> Die angegebenen Werte waren nicht korrekt </span></div>'+Schieberoutput.innerHTML;
        </script>";
    }
    if($Type=="intern"){
        include "Fragen.php";
        echo"<script>display(".$ID.", \"intern\", \"Schieberegler\");
        var Schieberoutput = document.getElementById('SchieberID');
        Schieberoutput.innerHTML='<div id=\"range_alert\" class=\"alert icon-alert with-arrow alert-danger form-alter\" role=\"alert\" style=\"display:block;grid-column-end: span 3;\"><i class=\"fa fa-fw fa-times-circle\"></i><strong> Note !</strong> <span class=\"warning-message\"> Die angegebenen Werte waren nicht korrekt </span></div>'+Schieberoutput.innerHTML;
        </script>";
    }
}
else{
    if($Type=="extern"){
        $query = "UPDATE rangeslider_answers SET range_min = '".$min."' WHERE Frage_ID = '".$ID."'";
        $exec = mysqli_query($link,$query);
        $query = "UPDATE rangeslider_answers SET range_max = '".$max."' WHERE Frage_ID = '".$ID."'";
        $exec = mysqli_query($link,$query);
        $query = "UPDATE rangeslider_answers SET columns = '".$columns."' WHERE Frage_ID = '".$ID."'";
        $exec = mysqli_query($link,$query);
    }
    if($Type=="intern"){
        $query = "UPDATE rangeslider_answers SET range_min = '".$min."' WHERE Intern_ID = '".$ID."'";
        $exec = mysqli_query($link,$query);
        $query = "UPDATE rangeslider_answers SET range_max = '".$max."' WHERE Intern_ID = '".$ID."'";
        $exec = mysqli_query($link,$query);
        $query = "UPDATE rangeslider_answers SET columns = '".$columns."' WHERE Intern_ID = '".$ID."'";
        $exec = mysqli_query($link,$query);
    }
    
}
?>