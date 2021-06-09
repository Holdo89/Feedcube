<script>
/*function range_speichern(input) {
var ID = document.getElementById("ID_extern_Schieberegler").value;
var range_min = document.getElementById("Range_Min").value;
var range_max = document.getElementById("Range_Max").value;
var columns = document.getElementById("Columns").value;
var value_min = Number(range_min);
var value_max = Number(range_max);
var value_columns = Number(columns);
var range_min_is_valid = false;
var range_max_is_valid = false;
var columns_is_valid = false;


    if(range_min < 0 || isNaN(Number(range_min))){
        if(input==1)
        alert("kein gültiger Wert");
        document.getElementById("Range_Min").style.borderColor = "red";
    }
    else{
        document.getElementById("Range_Min").style.borderColor = "lightgrey";
        range_min_is_valid = true;
    }


    if(isNaN(Number(range_max))){
        if(input==2)
        alert("kein gültiger Wert");
        document.getElementById("Range_Max").style.borderColor = "red";
    }
    else{
        document.getElementById("Range_Max").style.borderColor = "lightgrey";
        range_max_is_valid = true;
    }

if(range_max <= range_min){
    alert("Der maximale Wert kann nicht kleiner als der minimale Wert sein");
    document.getElementById("Range_Min").style.borderColor = "red";
    document.getElementById("Range_Max").style.borderColor = "red";
    range_min_is_valid = false;
    range_max_is_valid = false;
}	
else{
    if(range_min_is_valid == true)
    document.getElementById("Range_Min").style.borderColor = "lightgrey";
    if(range_max_is_valid == true)
    document.getElementById("Range_Max").style.borderColor = "lightgrey";
}

if(value_columns < 0 ||value_columns > 10|| isNaN(Number(columns)) ){
    if(input==3){
        if(value_columns > 10){
            alert("Der Wert für Balken kann nicht größer als 10 sein");
        }
        else
            alert("kein gültiger Wert");}
        document.getElementById("Columns").style.borderColor = "red";
    }
    else{
        document.getElementById("Columns").style.borderColor = "lightgrey";
        columns_is_valid = true;
    }

if(range_min_is_valid == true && range_max_is_valid == true && columns_is_valid == true)
{
    speichern_range()
}
//speichern_antwort(id);
;}
*/
</script>
<?php
require_once "session.php";
require_once "../config.php";

$ID=$_REQUEST["ID"];
$max=$_REQUEST["Range_Max"];
$min=$_REQUEST["Range_Min"];
$columns=$_REQUEST["Columns"];
$Type = $_REQUEST["Type"];
$Questiontype = $_REQUEST["Questiontype"];
$Frage_Englisch = $_REQUEST["frage_englisch_".$Type."_".$Questiontype];
$Kapitel_Englisch = $_REQUEST["kapitel_englisch_".$Type."_".$Questiontype];

if($Type=="extern"){
    $Kapitel_Englisch = $_REQUEST["kapitel_englisch_".$Type."_".$Questiontype];
    $sql = "UPDATE admin SET Frage_Englisch = '".$Frage_Englisch."' WHERE ID = ".$ID;
    $query = mysqli_query($link, $sql);

    $sql = "UPDATE admin SET Kapitel_Englisch = '".$Kapitel_Englisch."' WHERE ID = ".$ID;
    $query = mysqli_query($link, $sql);
}
else if($Type=="intern"){
    echo "intern";
    $sql = "UPDATE intern SET Frage_Englisch = '".$Frage_Englisch."' WHERE ID = ".$ID;
    $query = mysqli_query($link, $sql);
}

if($max <= $min)
{
    include "Fragen.php";
    echo"<script>display(".$ID.", \"extern\", \"Schieberegler\");
    var Schieberoutput = document.getElementById('SchieberID');
    Schieberoutput.innerHTML='<div id=\"range_alert\" class=\"alert icon-alert with-arrow alert-danger form-alter\" role=\"alert\" style=\"display:block;grid-column-end: span 3;\"><i class=\"fa fa-fw fa-times-circle\"></i><strong> Note !</strong> <span class=\"warning-message\"> Die angegebenen Werte waren nicht korrekt </span></div>'+Schieberoutput.innerHTML;
    </script>";
}
else{
$query = "UPDATE rangeslider_answers SET range_min = '".$min."' WHERE Frage_ID = '".$ID."'";

$exec = mysqli_query($link,$query);

$query = "UPDATE rangeslider_answers SET range_max = '".$max."' WHERE Frage_ID = '".$ID."'";

$exec = mysqli_query($link,$query);

$query = "UPDATE rangeslider_answers SET columns = '".$columns."' WHERE Frage_ID = '".$ID."'";

$exec = mysqli_query($link,$query);
header("location:Fragen.php");
}
?>