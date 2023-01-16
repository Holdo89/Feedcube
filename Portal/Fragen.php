<?php
 require_once "../config.php";
 require_once "session.php";
 include "RedirectToStart.php";

$Schieberegler_err="";


 if ($_SERVER["REQUEST_METHOD"] == "POST") 
 {
    $ID=$_REQUEST["Fragenid"];
    $Type = "extern";
    $Fragentyp = $_REQUEST["Auswahl_Fragentyp"];

    if ($Fragentyp=="Schieberegler") 
    {
        $max=$_REQUEST["Range_Max"];
        $min=$_REQUEST["Range_Min"];

        if ($max <= $min) 
        {
            $Schieberegler_err="Der Maximalwert kann nicht niedriger als das Minimum sein";
        } 
        else 
        {
            if ($ID) 
            {
                include "Range_speichern.php";
            } 
            else 
            {
                include "insert_".$Fragentyp."_fragen.php";
            }
        }
    } 
    else 
    {
        $Antworttyp = $_REQUEST["Auswahl_Antworttyp"];
        include "insert_".$Fragentyp."_fragen.php";
    }
 }
include "Fragen_Seite.php";
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if ($Fragentyp=="Schieberegler") {
        if ($max <= $min) {
            $neues_Überschrift = $_REQUEST["Überschrift"];
            $neue_Frage = $_REQUEST["Frage"];
            $Antworttyp = $_REQUEST["Auswahl_Antworttyp"];
            $Frage_Englisch = $_REQUEST["Frage_Übersetzung"];
            
            echo"<script>
            document.getElementById('Überschrift').value = '".$neues_Überschrift."';
            document.getElementById('Überschrift_Übersetzung').value = '".$Überschrift_Englisch."';
            document.getElementById('Frage').value = '".$neue_Frage."';
            document.getElementById('Frage_Übersetzung').value = '".$Frage_Englisch."';
            document.getElementById('Schieberegler').checked = true;
            document.getElementById('Rangeoptionen').innerHTML = '<h5>Wähle die Konfiguration des Schiebereglers:</h5>\
            <div style=\"grid-template-columns:2fr 2fr; display:grid\">\
                <label style=\"margin-bottom:0px\">Minimum</label>\
                <label style=\"margin-bottom:0px\">Maximum</label>\
                <div id=\"SchieberID\" style=\"grid-template-columns:2fr 2fr; grid-column-start: 1; grid-column-end: -1;display:grid\">\
                <input type=\"number\" class=\"center-select\" id=\"Range_Min\" name=\"Range_Min\" min=\"0\" value=\"".$min."\" style=\"text-align:center; margin:auto\"></input> \
                <input type=\"number\" class=\"center-select\" id=\"Range_Max\" name=\"Range_Max\" max=\"1000\" value=\"".$max."\" style=\"text-align:center; margin:auto\"></input> \
                </div>\
            </div>';
            document.getElementById('Rangeoptionen').style.display='block';
            display(".$ID.", \"".$Type."\", \"Schieberegler\");
            document.getElementById('alert').style.display='block';
            </script>";
        }
    }
}
if (isset($_REQUEST["Step"])) {
    echo'
    <script>
	    document.getElementById("myTopnav").style.display="none";
    </script>
	<div class="content">
	        <button class="TutorialNavi" onclick = "zurück()"><i class="fa fa-arrow-left"></i><br>zurück</button>
			<progress id="progress" value="2" max="6" style="font-size:25px"></progress>
            <button class="TutorialNavi" onclick = "weiter()"><i class="fa fa-arrow-right"></i><br>weiter</button>
			<progress id="progressmobile" value="2" max="6" style="font-size:25px;"></progress>
    </div>';


    $Step=$_REQUEST["Step"];
}
include "Tutorial_Schritt3_Info.php";

?>
    <link href="Tutorialstyle.css?v=1" rel="stylesheet" type="text/css">
    <script src="Cookiefunctions.js?v=1" type="text/javascript"></script>

    <script>
        checkCookie("FragenInformationChecked", "FragenInfo_Modal")
        function weiter() {
            window.location.href = "Fragenset.php?Step=4"
        }

        function zurück() {
            window.location.href = "Antwortmoeglichkeiten.php?Step=2"
        }
        
        function hideinformation(){
            document.getElementById("FragenInfo_Modal").style.display="none"
            document.cookie = "FragenInformationChecked=1; expires=Fri, 27 Mar 2122 12:00:00 UTC";
        }

        function hideinformationWithoutremembering(){
            document.getElementById("FragenInfo_Modal").style.display="none"
        }

    </script>

