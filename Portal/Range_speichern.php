<?php
require_once "../config.php";
require_once "session.php";

$ID=$_REQUEST["ID"];
$max=$_REQUEST["Range_Max"];
$min=$_REQUEST["Range_Min"];
$Questiontype = $Fragentyp;
$Frage = $_REQUEST["Frage"];

if($Type=="extern")
{
    $columnnames = "";
    $sql="SHOW COLUMNS FROM fragen";
    $query = mysqli_query($link, $sql);

    while($row = mysqli_fetch_assoc($query))
    {
        if(strpos($row["Field"], 'Fragenset_') !== false||strpos($row["Field"], 'Leistung_')!== false)
        $columnnames = $columnnames.$row["Field"]." = 0, ";
    };

    if($columnnames!="")
    {
        $columnnames = substr($columnnames, 0, -2);
        $sql="UPDATE fragen SET ".$columnnames." WHERE ID=".$ID;
        $query = mysqli_query($link, $sql);  
    }

    $Fragenset = "";
    foreach ($_REQUEST['Auswahl_Fragenset'] as $subject)
    {
        $Fragenset=$Fragenset." Fragenset_".$subject."= 1,";
    }

    $Leistungen = "";
    foreach ($_REQUEST['Auswahl_Leistung'] as $subject)
    {
        $Leistungen=$Leistungen." Leistung_".$subject."= 1,";
    }

    if($Fragenset != "" || $Leistungen != "")
    {
        if($Leistungen == "")
        {
            $Fragenset = substr($Fragenset, 0, -1);     
        }
        else{
            $Leistungen = substr($Leistungen, 0, -1);  
        }
        $sql="UPDATE fragen SET ".$Fragenset.$Leistungen." WHERE ID=".$ID;
        $query = mysqli_query($link, $sql);
    }

    $Überschrift = $_REQUEST["Überschrift"];
    
    $sql = "SELECT Überschrift_Übersetzung FROM überschrift WHERE Überschrift = '".$Überschrift."'";
    $query = mysqli_query($link, $sql);
    $row = mysqli_fetch_assoc($query);
    $Überschrift_Englisch = $row["Überschrift_Übersetzung"];
    
    $Frage_Englisch = $_REQUEST["Frage_Übersetzung"];
    $sql = "UPDATE fragen SET Frage_Englisch = '".$Frage_Englisch."' WHERE ID = ".$ID;
    $query = mysqli_query($link, $sql);
    $sql = "UPDATE fragen SET Überschrift_Englisch = '".$Überschrift_Englisch."' WHERE ID = ".$ID;
    $query = mysqli_query($link, $sql);
    $sql = "UPDATE fragen SET Fragen_extern = '".$Frage."' WHERE ID = ".$ID;
    $query = mysqli_query($link, $sql);
    $sql = "UPDATE fragen SET Überschrift = '".$Überschrift."' WHERE ID = ".$ID;
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
        include "Umfragen.php";
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
        $query = "UPDATE rangeslider_answers SET columns = '5' WHERE Frage_ID = '".$ID."'";
        $exec = mysqli_query($link,$query);
    }
    if($Type=="intern"){
        $query = "UPDATE rangeslider_answers SET range_min = '".$min."' WHERE Intern_ID = '".$ID."'";
        $exec = mysqli_query($link,$query);
        $query = "UPDATE rangeslider_answers SET range_max = '".$max."' WHERE Intern_ID = '".$ID."'";
        $exec = mysqli_query($link,$query);
        $query = "UPDATE rangeslider_answers SET columns = '5' WHERE Intern_ID = '".$ID."'";
        $exec = mysqli_query($link,$query);
    }
    
}
?>