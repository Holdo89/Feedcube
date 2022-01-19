<?php
 require_once "../config.php";
 require_once "session.php";
 include "Tutorialstyle.php";

$Schieberegler_err="";

 if($_SERVER["REQUEST_METHOD"] == "POST"){
    $Type = $_REQUEST["externinterntyp"];
	$Fragentyp = $_REQUEST["Auswahl_Fragentyp"];
	$Antworttyp = $_REQUEST["Auswahl_Antworttyp"];
    echo "<script>console.log('".$Fragentyp."')</script>";
    if ($Fragentyp=="Schieberegler") {
        $max=$_REQUEST["Range_Max"];
        $min=$_REQUEST["Range_Min"];
        $columns=$_REQUEST["Columns"];

        if ($max <= $min) {
            $Schieberegler_err="Der Maximalwert kann nicht niedriger als das Minimum sein";
        }
		else{
			include "Range_speichern.php";
		}
    }
	else{
        include "insert_".$Fragentyp."_fragen.php";
    }
 }
include "Fragen_Seite.php";
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if ($Fragentyp=="Schieberegler") {
        if ($max <= $min) {
            $neues_Kapitel = $_REQUEST["Kapitel"];
            $neue_Frage = $_REQUEST["Frage"];
            $Antworttyp = $_REQUEST["Auswahl_Antworttyp"];
            $Frage_Englisch = $_REQUEST["Frage_Übersetzung"];
            $Kapitel_Englisch = $_REQUEST["Kapitel_Übersetzung"];

            echo"<script>
            document.getElementById('Kapitel').value = '".$neues_Kapitel."';
            document.getElementById('Kapitel_Übersetzung').value = '".$Kapitel_Englisch."';
            document.getElementById('Frage').value = '".$neue_Frage."';
            document.getElementById('Frage_Übersetzung').value = '".$Frage_Englisch."';
            document.getElementById('Schieberegler').checked = true;
            document.getElementById('Rangeoptionen').innerHTML = '<h5>Wähle die Konfiguration des Schiebereglers:</h5>\
            <div style=\"grid-template-columns:2fr 2fr 2fr; display:grid\">\
                <label style=\"margin-bottom:0px\">Minimum</label>\
                <label style=\"margin-bottom:0px\">Maximum</label>\
                <label style=\"margin-bottom:0px\"># Balken</label>\
                <div id=\"SchieberID\" style=\"grid-template-columns:2fr 2fr 2fr; grid-column-start: 1; grid-column-end: -1;display:grid\">\
                <input class=\"center-select\" id=\"Range_Min\" name=\"Range_Min\" value=\"".$min."\" style=\"text-align:center; margin-auto\"></input> \
                <input class=\"center-select\" id=\"Range_Max\" name=\"Range_Max\" value=\"".$max."\" style=\"text-align:center; margin-auto\"></input> \
                <input class=\"center-select\" id=\"Columns\" name=\"Columns\" value=\"".$columns."\" style=\"text-align:center; margin-auto\"></input> \
                </div>\
            </div>';
            document.getElementById('Rangeoptionen').style.display='block';
            display(0, \"extern\", \"Schieberegler\");
            </script>";
        }
    }
}
?>

