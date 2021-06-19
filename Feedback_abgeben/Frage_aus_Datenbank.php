<?php

require_once "../config.php";

$Buttontext = "WEITER";
$Buttontext_send_feedback = "Feedback abschicken";
if($_SESSION["Sprache"]=="Englisch") 
{
    $Buttontext = "NEXT";
    $Buttontext_send_feedback = "Send feedback";
}
//Gibt die Anzahl aller Fragen an diebei dieser Leistung abgefragt werden

$sql_rownumber = "SELECT COUNT(Fragen_extern) AS 'Anzahl_Fragen' FROM admin WHERE Leistung_".$ID." = 1";
$result_rownumber = mysqli_query($link, $sql_rownumber) ;
$rownumber = mysqli_fetch_assoc($result_rownumber);
$Anzahl_Fragen = $rownumber["Anzahl_Fragen"];

if($Anzahl_Fragen==0)
    echo"<label>Es wurde noch keine Frage hinzugefügt</label>";

else{

$sql = "SELECT * FROM admin WHERE Leistung_".$ID." = 1 ORDER BY post_order_no ASC";
$result = mysqli_query($link, $sql) ;
$index=0;

$Fragen_array = array();
$Kapitel_array = array();
$Fragentyp_array = array();
$Fragenid_array = array();
$Default_Schieberegler_array = array();
$Max_Schieberegler_array = array();
$Min_Schieberegler_array = array();
$Singlechoice_array_value = array();
$Singlechoice_array = array();
$Multiplechoice_array_value = array();
$Multiplechoice_array = array();
$abgegebenes_feedback_array = array();

while($index<=$Anzahl_Fragen) {
    $row = mysqli_fetch_assoc($result);
    if($_SESSION["Sprache"]=="Deutsch"){
        array_push($Fragen_array,$row["Fragen_extern"]);
        array_push($Kapitel_array,$row["Kapitel"]);
    }
    else if($_SESSION["Sprache"]=="Englisch"){
        array_push($Fragen_array,$row["Frage_Englisch"]);
        array_push($Kapitel_array,$row["Kapitel_Englisch"]);
    }
    array_push($Fragentyp_array,$row["Typ"]);
    array_push($Fragenid_array,$row["ID"]);

    $index=$index+1;

    if ($row['Typ']=='Schieberegler'){
        $sql_range = "SELECT * FROM rangeslider_answers WHERE Frage_ID = ".$row["ID"];
        $result_range = mysqli_query($link, $sql_range);
        $row_range = mysqli_fetch_assoc($result_range);
        $max = $row_range["range_max"];
        $min = $row_range["range_min"];
        $default = ($max-$min)/2+$min;
        array_push($Default_Schieberegler_array, $default);
        array_push($Max_Schieberegler_array, $max);
        array_push($Min_Schieberegler_array, $min);
    }
    else if ($row['Typ']=='Singlechoice'){
        $Singlechoice = array();
        $Singlechoice_value = array(); //Singlechoicemöglichkeiten der einzelnen Frage
        $sql_answers = "SELECT * FROM singlechoice_answers ORDER BY post_order_no ASC";
        $result_answers = mysqli_query($link, $sql_answers) ;
        while($row_answers=mysqli_fetch_array($result_answers)){
            if ($row_answers["Frage_".$row["ID"]] == 1){
                array_push($Singlechoice_value, $row_answers['Answers']);
                if($_SESSION["Sprache"]=="Deutsch"){
                    array_push($Singlechoice, $row_answers['Answers']);
                }
                else if($_SESSION["Sprache"]=="Englisch"){
                    array_push($Singlechoice,$row_answers['Answers_Englisch']);
                }
            }
        }
        array_push($Singlechoice_array_value,$Singlechoice_value);
        array_push($Singlechoice_array,$Singlechoice);
    }
    else if ($row['Typ']=='Multiplechoice')
    {
        $Multiplechoice = array(); //Multiplechoicemöglichkeiten der einzelnen Frage
        $Multiplechoice_value = array();
        $sql_answers = "SELECT * FROM multiplechoice_answers ORDER BY post_order_no ASC";
        $result_answers = mysqli_query($link, $sql_answers) ;
        while($row_answers=mysqli_fetch_array($result_answers)){
            if ($row_answers["Frage_".$row["ID"]] == 1){
                array_push($Multiplechoice_value, $row_answers['Answers']);
                if($_SESSION["Sprache"]=="Deutsch"){
                    array_push($Multiplechoice,$row_answers['Answers']);
                }
                else if($_SESSION["Sprache"]=="Englisch"){
                    array_push($Multiplechoice,$row_answers['Answers_Englisch']);
                }
            }
        }
        array_push($Multiplechoice_array_value,$Multiplechoice_value);
        array_push($Multiplechoice_array,$Multiplechoice);

    }
}

    echo"<form id='Frage_form'>";}

	$dir = '../assets/'.$subdomain.'/logo/';
	$file = scandir($dir);

    echo"
        <img class='center' src='../assets/".$subdomain."/logo/".$file[2]."' alt='' width='150' height='70'>
        <div class='container'>
        <div class='chapter' id='chapter'>".$Kapitel_array[0]."</div>
        <div class='frage' id='frage'>".$Fragen_array[0]."</div>
        <div id='Antwortmöglichkeiten'>";  
        
    $Antwort_index=0;

    if ($Fragentyp_array[0]=='Singlechoice'){
        while($Antwort_index<count($Singlechoice_array_value[0])){
            echo"<div><input id='element_1' name='element_1' type='radio' value='|".$Singlechoice_array_value[0][$Antwort_index]."|'
            class='choice' for='element_1' required>".$Singlechoice_array[0][$Antwort_index]."</div>";
            $Antwort_index=$Antwort_index+1;
        }
    }

    else if ($row['Typ']=='Multiplechoice'){
        while($Antwort_index<count($Multiplechoice_array_value[0])){
            echo"<div><input id='element_1' name='element_1[]' type='checkbox' value='|".$Multiplechoice_array_value[0][$Antwort_index]."|'
            class='choice' for='element_1' required>".$Multiplechoice_array[0][$Antwort_index]."</div>";
            $Antwort_index=$Antwort_index+1;
        }
    }

    else if($row['Typ']=='Schieberegler'){
        echo"
        <div style='text-align:center'>
        <p style='margin-bottom:20px;'>Bewertung: <span id='output' style='font-size:15px;'>".$Default_Schieberegler_array[0]."</span></p>
        <input type='range' style='width:80%; margin-left:10px;' min='".$Min_Schieberegler_array[0]."' max='".$Max_Schieberegler_array[0]."' value='".$Default_Schieberegler_array[0]."' name='element_1' id='element_1' ontouchend='input_update()' oninput='input_update(), color()'>
        </div>
        ";
        }

    else{
        echo"
        <div><textarea class = 'frage_text' name='element_1' cols='50' rows='4' maxlength='1000' wrap='soft'></textarea></div>";
    }
    echo"
    </div>
    </div><input class='center_button' type='button' id ='button' value='".$Buttontext."' onclick='get_next_question()'>
    <label class='label_progress' id='label_progress'>Frage 1 von ".$Anzahl_Fragen."</label>
    <progress class='progressbar' id='progress' value='1' max='".$Anzahl_Fragen."'></progress>
    </form>";

?>

<script>
var abgegebenes_feedback_array = [];
var Anzahl_Fragen = <?php echo $Anzahl_Fragen;?>; //gesamte Anzahl der Fragen
var Kapitel_array = [<?php foreach($Kapitel_array as $Kapitel){echo"'".$Kapitel."',";}?>];
var Fragen_array = [<?php foreach($Fragen_array as $Frage){echo"'".$Frage."',";}?>];
var Fragentyp_array = [<?php foreach($Fragentyp_array as $Fragentyp){echo"'".$Fragentyp."',";}?>];
var Default_Schieberegler_array = [<?php foreach($Default_Schieberegler_array as $Default_Schieberegler){echo"'".$Default_Schieberegler."',";}?>];
var Max_Schieberegler_array = [<?php foreach($Max_Schieberegler_array as $Max_Schieberegler){echo"'".$Max_Schieberegler."',";}?>];
var Min_Schieberegler_array = [<?php foreach($Min_Schieberegler_array as $Min_Schieberegler){echo"'".$Min_Schieberegler."',";}?>];

function get_next_question()
{
    var Fragenzahl = parseInt(document.getElementById("Fragenzahl").value); //Frage die gerade dran ist
    document.getElementById("Fragenzahl").value=parseInt(document.getElementById("Fragenzahl").value)+1;
    document.getElementById("label_progress").innerHTML = "Frage " + parseInt(Fragenzahl+1) + " von " + Anzahl_Fragen;
        if (Fragentyp_array[Fragenzahl-1]=="Singlechoice" || Fragentyp_array[Fragenzahl-1] == "Multiplechoice")
        {
            push_SingleorMulti();
            console.log(abgegebenes_feedback_array)
        }

        else
        {
            push_Antwort();
            console.log(abgegebenes_feedback_array)
        }

        var Kapitel = document.getElementById("chapter");
        Kapitel.innerHTML = Kapitel_array[Fragenzahl];

        var Frage = document.getElementById("frage");
        Frage.innerHTML = Fragen_array[Fragenzahl];

        if (Fragentyp_array[Fragenzahl]=="Singlechoice")
        { 
            var i=0;
            var Singlechoicezahl = parseInt(document.getElementById("Singlechoicezahl").value);
            document.getElementById("Singlechoicezahl").value=parseInt(document.getElementById("Singlechoicezahl").value)+1;
            var Singlechoice_array_value = [<?php foreach($Singlechoice_array_value as $Singlechoice){echo"["; foreach($Singlechoice as $Single){echo"'".$Single."',";}echo"],";}?>];
            var Singlechoice_array = [<?php foreach($Singlechoice_array as $Singlechoice_show){echo"["; foreach($Singlechoice_show as $Single_show){echo"'".$Single_show."',";}echo"],";}?>];
            document.getElementById("Antwortmöglichkeiten").innerHTML="";
            while(i<=Singlechoice_array_value[Singlechoicezahl].length)
            {
                document.getElementById("Antwortmöglichkeiten").innerHTML += "<div><input id='element_1' name='element_1' type='radio' value='|"+Singlechoice_array_value[Singlechoicezahl][i]+"|'class='choice' for='element_1' required>"+Singlechoice_array[Singlechoicezahl][i]+"</div>"
                i++;
            }
        }

        else if (Fragentyp_array[Fragenzahl]=="Multiplechoice")
        {
            var i=0;
            var Multiplechoicezahl = parseInt(document.getElementById("Multiplechoicezahl").value);
            document.getElementById("Multiplechoicezahl").value=parseInt(document.getElementById("Multiplechoicezahl").value)+1;
            var Multiplechoice_array_value = [<?php foreach($Multiplechoice_array_value as $Multiplechoice){echo"["; foreach($Multiplechoice as $Multiple){echo"'".$Multiple."',";}echo"],";}?>];
            var Multiplechoice_array = [<?php foreach($Multiplechoice_array as $Multiplechoice_show){echo"["; foreach($Multiplechoice_show as $Multiple_show){echo"'".$Multiple_show."',";}echo"],";}?>];
            document.getElementById("Antwortmöglichkeiten").innerHTML="";
            while(i<Multiplechoice_array_value[Multiplechoicezahl].length)
            {
                document.getElementById("Antwortmöglichkeiten").innerHTML += "<div><input id='element_1' name='element_1[]' type='checkbox' value='|"+Multiplechoice_array_value[Multiplechoicezahl][i]+"|'class='choice' for='element_1'>"+Multiplechoice_array[Multiplechoicezahl][i]+"</div>"
                i++;
            }
        }

        else if (Fragentyp_array[Fragenzahl]=="Schieberegler")
        {
            var Schiebereglerzahl = parseInt(document.getElementById("Schiebereglerzahl").value);
            document.getElementById("Schiebereglerzahl").value=parseInt(document.getElementById("Schiebereglerzahl").value)+1;
            var Default_Schieberegler_array = [<?php foreach($Default_Schieberegler_array as $Default_Schieberegler){echo $Default_Schieberegler.",";};?>];
            var Max_Schieberegler_array = [<?php foreach($Max_Schieberegler_array as $Max_Schieberegler){echo $Max_Schieberegler.",";};?>];
            var Min_Schieberegler_array = [<?php foreach($Min_Schieberegler_array as $Min_Schieberegler){echo $Min_Schieberegler.",";};?>];
            document.getElementById("Antwortmöglichkeiten").innerHTML="<div style='text-align:center'><p style='margin-bottom:20px;'>Bewertung: <span id='output' style='font-size:15px;'>"+ Default_Schieberegler_array[0] + "</span></p><input type='range' style='width:80%; margin-left:10px;' min='"+ Min_Schieberegler_array[0] +"' max='" + Max_Schieberegler_array[0]+"' value='" + Default_Schieberegler_array[0] + "' name='element_1' id='element_1' ontouchend='input_update()' oninput='input_update(), color()'></div>";
        }

        else
            document.getElementById("Antwortmöglichkeiten").innerHTML="<div><textarea class = 'frage_text' name='element_1' id='element_1' cols='50' rows='4' maxlength='1000' wrap='soft'></textarea></div>";
        
        function push_SingleorMulti(){
            var Antwortmöglichkeit = document.forms[0];
            var Antwort_checked = "";
            var i;
            for (i = 0; i < Antwortmöglichkeit.length; i++) {
                if (Antwortmöglichkeit[i].checked) {
                    Antwort_checked = Antwort_checked + "'" + Antwortmöglichkeit[i].value + "'";
                }
            }
            if (Antwort_checked == ""){
                Antwort_checked = Antwort_checked + "''";
            }
            abgegebenes_feedback_array.push(Antwort_checked)
        }
        function push_Antwort(){
            var Antwort_abgegeben = document.getElementById("element_1").value.replaceAll("'", '"');
            var Antwort = "'" + Antwort_abgegeben +"'";
            abgegebenes_feedback_array.push(Antwort);
        }

        if (Fragenzahl+1==Anzahl_Fragen){
            document.getElementById("button").value=<?php echo"'".$Buttontext_send_feedback."'";?>;
            document.getElementById("button").onclick=send_feedback;
        }
function send_feedback() //wenn alle Fragen beantwortet wurden und die Antworten übergeben werden 
    {
        if (Fragentyp_array[Fragenzahl-1]=="Singlechoice" || Fragentyp_array[Fragenzahl-1] == "Multiplechoice")
        {
            push_SingleorMulti();
            console.log(abgegebenes_feedback_array)
        }

        else
        {
            push_Antwort();
            console.log(abgegebenes_feedback_array)
        }
        document.getElementById("Frage_form").innerHTML=<?php echo"\"<img class='center' src='../assets/".$subdomain."/logo/".$file[2]."' alt='' width='150' height='70'> <p style='text-align:center'>Vielen Dank für ihr Feedback</p>\" ";?>;
        const xhttp = new XMLHttpRequest();
        xhttp.open("GET", "insert.php?Antworten_array="+abgegebenes_feedback_array);
        xhttp.send();
    }
}
function input_update()
{
    var value = document.getElementById("element_1").value;
    var output = document.getElementById("output");
    output.innerHTML = value;
}
function color() 
{ 
    var slider = document.getElementById("element_1")
    var value = (slider.value-slider.min)/(slider.max-slider.min)*100
    var value2 = value-10
    var temp =  (slider.value-slider.min)*(100/(slider.max-slider.min));
    var color =  "hsl("+temp+", 100%, 50%) ";
    var color2 =  "#82CFD0 ";
    slider.style.background = 'linear-gradient(to right, '+color+'0%, '+color + value2 + '%, '+color+value2+'%, '+color2 + value + '%, #fff ' + value + '%, white 100%)'
}
</script>


