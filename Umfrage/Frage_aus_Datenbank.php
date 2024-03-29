<?php

require_once "../config.php";

$Buttontext = "WEITER";
$Buttontext_send_feedback = "SENDEN";
$Buttontext_back = "ZURÜCK";

$sql_rownumber = "SELECT COUNT(Fragenbeschreibung) AS 'Anzahl_Fragen' FROM intern WHERE Umfrage_".$ID." = 1";

//Gibt die Anzahl aller Fragen an diebei dieser Umfrage abgefragt werden
$result_rownumber = mysqli_query($link, $sql_rownumber) ;
$rownumber = mysqli_fetch_assoc($result_rownumber);
$Anzahl_Fragen = $rownumber["Anzahl_Fragen"];

if($Anzahl_Fragen==0)
echo "<h2 style='text-align:center; margin:auto; margin-top:10%; margin-bottom:5%; '>Es wurde noch keine Frage hinzugefügt</h2>";

else{

    $sql = "SELECT * FROM intern WHERE Umfrage_".$ID." = 1 ORDER BY post_order_no ASC";
    $result = mysqli_query($link, $sql) ;
    $index=0;
    
    $Fragen_array = array();
    $Fragentyp_array = array();
    $Fragenid_array = array();
    $Default_Schieberegler_array = array();
    $Max_Schieberegler_array = array();
    $Min_Schieberegler_array = array();
    $Bewertung_array_value = array();
    $Bewertung_array = array();
    $Multiplechoice_array_value = array();
    $Multiplechoice_array = array();
    $abgegebenes_feedback_array = array();

    while($index<$Anzahl_Fragen) {
        $row = mysqli_fetch_assoc($result);
        array_push($Fragen_array,$row["Fragenbeschreibung"]);
        array_push($Fragentyp_array,$row["Typ"]);
        array_push($Fragenid_array,$row["ID"]);

        $index=$index+1;

        if ($row['Typ']=='Schieberegler'){
            $sql_range = "SELECT * FROM rangeslider_answers WHERE Intern_ID = ".$row["ID"];
            $result_range = mysqli_query($link, $sql_range);
            $row_range = mysqli_fetch_assoc($result_range);
            $max = $row_range["range_max"];
            $min = $row_range["range_min"];
            $default = ($max-$min)/2+$min;
            array_push($Default_Schieberegler_array, $default);
            array_push($Max_Schieberegler_array, $max);
            array_push($Min_Schieberegler_array, $min);
        }
        else if ($row['Typ']=='Bewertung'){
            $Bewertung = array();
            $Bewertung_value = array(); //Bewertungmöglichkeiten der einzelnen Frage
            $sql_answers = "SELECT * FROM bewertung_answers ORDER BY post_order_no ASC";
            $result_answers = mysqli_query($link, $sql_answers) ;
            while($row_answers=mysqli_fetch_array($result_answers)){
                    array_push($Bewertung_value, $row_answers['Answers']);
                    array_push($Bewertung, $row_answers['Answers']);
            }
            array_push($Bewertung_array_value,$Bewertung_value);
            array_push($Bewertung_array,$Bewertung);
        }
        else if ($row['Typ']=='Multiplechoice')
        {
            $Multiplechoice = array(); //Multiplechoicemöglichkeiten der einzelnen Frage
            $Multiplechoice_value = array();
            $sql_answers = "SELECT * FROM multiplechoice_answers WHERE Fragenspezifisch = ".$row['ID']." ORDER BY post_order_no ASC";
            $result_answers = mysqli_query($link, $sql_answers) ;
            while($row_answers=mysqli_fetch_array($result_answers)){
                if ($row_answers["Intern_".$row["ID"]] == 1){
                    array_push($Multiplechoice_value, $row_answers['Answers']);
                    array_push($Multiplechoice,$row_answers['Answers']);
                }
            }
            array_push($Multiplechoice_array_value,$Multiplechoice_value);
            array_push($Multiplechoice_array,$Multiplechoice);

        }
    }

        echo"<form id='Frage_form' style='margin:30px;min-height:600px;'>";
}
	$dir = '../assets/'.$subdomain.'/logo/';
	$file = scandir($dir);

    echo"
        <img class='center' src='../assets/".$subdomain."/logo/".$file[2]."' alt='' width='150' height='70' style='object-fit:scale-down'>
        <div class='container' id = 'container'>";
    $i=0; //welche Frage ist gerade dran Submit Button ist notwendig fürvlidierung der leeren Bewertung antworten
    echo"
    </div>
    </div>
    <input id='submitbutton' type='submit' style='visibility:hidden'></input>
    </form>
    <input id='Fragenzahl' style='display:none' value=".$i."></input>";
?>

<script>
var abgegebenes_feedback_array = [];
var current_html = [];
var Anzahl_Fragen = <?php echo $Anzahl_Fragen;?>; //gesamte Anzahl der Fragen
var Fragen_array = [<?php foreach($Fragen_array as $Frage){echo"'".$Frage."',";}?>];
var Fragentyp_array = [<?php foreach($Fragentyp_array as $Fragentyp){echo"'".$Fragentyp."',";}?>];
var Default_Schieberegler_array = [<?php foreach($Default_Schieberegler_array as $Default_Schieberegler){echo"'".$Default_Schieberegler."',";}?>];
var Max_Schieberegler_array = [<?php foreach($Max_Schieberegler_array as $Max_Schieberegler){echo"'".$Max_Schieberegler."',";}?>];
var Min_Schieberegler_array = [<?php foreach($Min_Schieberegler_array as $Min_Schieberegler){echo"'".$Min_Schieberegler."',";}?>];
get_next_question();
var i =0;

function push_all_Answers(){
    current_html.push(document.getElementById("body").innerHTML)
    var Fragenzahl = parseInt(document.getElementById("Fragenzahl").value); //Frage die gerade dran ist
    while(i<Fragenzahl)
    {
        try{
            if (Fragentyp_array[i]=="Bewertung" || Fragentyp_array[i] == "Multiplechoice")
                {
                    var Antwortmöglichkeit = document.getElementsByName("element_1_"+i);
                    var u = 0;
                    var checked = false;
                    if (Fragentyp_array[i]=="Multiplechoice")
                    {
                        var Multiplechoice_Antworten ="";
                        while(u < Antwortmöglichkeit.length) {
                            if (Antwortmöglichkeit[u].checked) {
                                Multiplechoice_Antworten=Multiplechoice_Antworten+Antwortmöglichkeit[u].value;
                            }
                            u=u+1;
                        }  
                        checked = true;
                        //if (Multiplechoice_Antworten!="")
                            abgegebenes_feedback_array.push("'"+Multiplechoice_Antworten+"'");
                        /*else  
                            abgegebenes_feedback_array.push('NULL');*/             
                    }
                    else if (Fragentyp_array[i]=="Bewertung"){
                        while(u < Antwortmöglichkeit.length) {
                            if (Antwortmöglichkeit[u].checked) {
                                abgegebenes_feedback_array.push("'"+Antwortmöglichkeit[u].value + "'");
                                checked = true;
                            }
                            u=u+1;
                        }
                    }
                    if (checked == false){
                        current_html.pop();
                        document.getElementById("submitbutton").click();
                        return false;
                        //throw new Error("Something went badly wrong!");
                    }  
                }

                else if (Fragentyp_array[i]=="Text" || Fragentyp_array[i] == "Schieberegler")
                {
                    var Antwort_abgegeben = document.getElementById("element_1_"+i).value.replaceAll("'", '"');
                    var Antwort = "'" + Antwort_abgegeben +"'";
                    abgegebenes_feedback_array.push(Antwort);
                }  
        }
        catch(err){
            console.log("Test"+Fragenzahl);
        }
        i=i+1;
    }
    if(Fragenzahl == Anzahl_Fragen){
        const xhttp = new XMLHttpRequest();
        //replace & in url weil sonst insert nicht funktioniert
        var g = 0;
        while(g<abgegebenes_feedback_array.length)
        {
            abgegebenes_feedback_array[g]=abgegebenes_feedback_array[g].replaceAll("&","%26");
            g=g+1;
        }
        xhttp.open("GET", "insert.php?Antworten_array="+abgegebenes_feedback_array);
        xhttp.send();
        document.getElementById("Frage_form").innerHTML=<?php echo"\"<img class='center' src='../assets/".$subdomain."/logo/".$file[2]."' alt='' width='150' height='70' style='object-fit:scale-down'> <p style='text-align:center'>Vielen Dank für die Teilnahme an der Umfrage.";
    $sql = "SELECT Intervall FROM umfragen WHERE ID = ".$_SESSION["Umfrage"];
    $query = mysqli_query($link, $sql);
    $result = mysqli_fetch_array($query);
    $cookie_value = date("Y-m-d H:i", time() + 86400*$result["Intervall"]);
    if ($result["Intervall"]!=0) {
        echo "Du kannst erneut an der Umfrage teilnehmen am: <br><br>".$cookie_value;
    }
    echo  " <br><br>Um die Auswertung der Umfrage zu sehen kehre zurück ins Portal </p>";
    echo "<img class='center' src='../assets/brand/upload.png' alt='' style='margin-top:10vh; width:50%;'> <input class='center_button' type='button' style='background-color:#084f6e; color:white' onclick=\\\"location.href='../Portal/Umfragen.php'\\\" value='zurück zum Portal'></input> \" ";
    ?>;
    }
    else
    get_next_question();
}

function get_next_question()
{
    var Schiebereglerindex=0; 
    document.documentElement.scrollTop = 0; 
    var Fragenzahl = parseInt(document.getElementById("Fragenzahl").value); //Frage die gerade dran ist
    
    document.getElementById("container").innerHTML="";

        do{
        document.getElementById("container").innerHTML=document.getElementById("container").innerHTML+"<div class='frage' id='frage_"+Fragenzahl+"'>"+Fragen_array[Fragenzahl]+"</div><div id='Antwortmöglichkeiten_"+Fragenzahl+"'>";

        Antwort_index=0;
        var Frage = document.getElementById("frage_"+Fragenzahl);
        Frage.innerHTML = Fragen_array[Fragenzahl];
        
        if (Fragentyp_array[Fragenzahl]=="Bewertung")
        { 
            var i=0;
            var Bewertungzahl = parseInt(document.getElementById("Bewertungzahl").value);
            document.getElementById("Bewertungzahl").value=parseInt(document.getElementById("Bewertungzahl").value)+1;
            var Bewertung_array_value = [<?php foreach($Bewertung_array_value as $Bewertung){echo"["; foreach($Bewertung as $Single){echo"'".$Single."',";}echo"],";}?>];
            var Bewertung_array = [<?php foreach($Bewertung_array as $Bewertung_show){echo"["; foreach($Bewertung_show as $Single_show){echo"'".$Single_show."',";}echo"],";}?>];
            document.getElementById("Antwortmöglichkeiten_"+Fragenzahl).innerHTML="";
            while(i<Bewertung_array_value[Bewertungzahl].length)
            {
                document.getElementById("Antwortmöglichkeiten_"+Fragenzahl).innerHTML += "<div><input id='element_1_"+Fragenzahl+i+"' name='element_1_"+Fragenzahl+"' type='radio' value='|"+Bewertung_array_value[Bewertungzahl][i]+"|'class='choice' for='element_1_"+Fragenzahl+i+"' required>"+Bewertung_array[Bewertungzahl][i]+"</div>"
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
            document.getElementById("Antwortmöglichkeiten_"+Fragenzahl).innerHTML="";
            while(i<Multiplechoice_array_value[Multiplechoicezahl].length)
            {
                document.getElementById("Antwortmöglichkeiten_"+Fragenzahl).innerHTML += "<div><input id='element_1_"+Fragenzahl+i+"' name='element_1_"+Fragenzahl+"' type='checkbox' value='|"+Multiplechoice_array_value[Multiplechoicezahl][i]+"|'class='choice' for='element_1_"+Fragenzahl+i+"'>"+Multiplechoice_array[Multiplechoicezahl][i]+"</div>"
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
            document.getElementById("Antwortmöglichkeiten_"+Fragenzahl).innerHTML="<div style='text-align:center'><p style='margin-bottom:20px;'>Bewertung: <span id='output_"+Fragenzahl+"' style='font-size:15px;'>"+ Default_Schieberegler_array[Schiebereglerindex] + "</span></p><input type='range' style='width:80%; margin-left:10px;' min='"+ Min_Schieberegler_array[Schiebereglerindex] +"' max='" + Max_Schieberegler_array[Schiebereglerindex]+"' value='" + Default_Schieberegler_array[Schiebereglerindex] + "' name='element_1_"+Fragenzahl+"' id='element_1_"+Fragenzahl+"' ontouchend='input_update("+Fragenzahl+")' oninput='input_update("+Fragenzahl+"), color("+Fragenzahl+")'></div>";
            Schiebereglerindex=Schiebereglerindex+1;
        }

        else
            document.getElementById("Antwortmöglichkeiten_"+Fragenzahl).innerHTML="<div><textarea class = 'frage_text' name='element_1_"+Fragenzahl+"' id='element_1_"+Fragenzahl+"' cols='50' rows='4' maxlength='1000' wrap='soft'></textarea></div>";      
            Fragenzahl = Fragenzahl +1 
        }while(Fragenzahl< <?php echo $Anzahl_Fragen?> )
        
        //weiter und zurück button hinzufügen
        document.getElementById("Fragenzahl").value=Fragenzahl;
        if (abgegebenes_feedback_array.length>0){
            document.getElementById("container").innerHTML=document.getElementById("container").innerHTML+ <?php echo"\"</div></div><input class='center_button' type='button' id ='button2' value='".$Buttontext_back."' onclick='previous_question()' style='display:inline; width:40%; margin:8%; margin-right:2%; margin-bottom:2%; margin-top:15%'>\""?>;
            document.getElementById("container").innerHTML=document.getElementById("container").innerHTML+ <?php echo"\"<input class='center_button' type='button' id ='button' value='".$Buttontext."' onclick='push_all_Answers()' style='display:inline; width:40%'></form>\""?>;    
        }
        else
            document.getElementById("container").innerHTML=document.getElementById("container").innerHTML+ <?php echo"\"<input class='center_button' type='button' id ='button' value='".$Buttontext."' onclick='push_all_Answers()'></form>\""?>;    

        if (Fragenzahl==Anzahl_Fragen){
            document.getElementById("button").value=<?php echo"'".$Buttontext_send_feedback."'";?>;
        }
}

function previous_question(){


}
function input_update(i)
{
    var value = document.getElementById("element_1_"+i).value;
    var output = document.getElementById("output_"+i);
    output.innerHTML = value;
}
function color(i) 
{ 
    var slider = document.getElementById("element_1_"+i)
    var value = (slider.value-slider.min)/(slider.max-slider.min)*100
    var value2 = value-10
    var temp =  (slider.value-slider.min)*(100/(slider.max-slider.min));
    var color =  "hsl("+temp+", 100%, 50%) ";
    var color2 =  "#82CFD0 ";
    slider.style.background = 'linear-gradient(to right, '+color+'0%, '+color + value2 + '%, '+color+value2+'%, '+color2 + value + '%, #fff ' + value + '%, white 100%)'
}
</script>


