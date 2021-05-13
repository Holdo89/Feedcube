<?php

require_once "../config.php";

//Gibt die Anzahl aller gespeicherten Fragen an

$sql_rownumber = "SELECT COUNT(Fragen_extern) AS 'Anzahl_Fragen' FROM admin WHERE Leistung_".$ID." = 1";
$result_rownumber = mysqli_query($link, $sql_rownumber) ;
$rownumber = mysqli_fetch_assoc($result_rownumber);

if($rownumber["Anzahl_Fragen"]==0)
echo"<label>Es wurde noch keine Frage hinzugefügt</label>";

else{

$sql = "SELECT * FROM admin WHERE Leistung_".$ID." = 1 ORDER BY post_order_no ASC";

$result = mysqli_query($link, $sql) ;

$index=1;

//welche Frage ist dran
while($index<=$backindex) {
    $row = mysqli_fetch_assoc($result);
    $index=$index+1;
}

$sql_range = "SELECT * FROM rangeslider_answers WHERE Frage_ID = ".$row["ID"];
$result_range = mysqli_query($link, $sql_range);
$row_range = mysqli_fetch_assoc($result_range);
$max = $row_range["range_max"];
$min = $row_range["range_min"];
$default = $max/2;

//holt die Antwortmöglichkeiten
if ($row['Typ']=='Singlechoice'){
    $sql_answers = "SELECT * FROM singlechoice_answers ORDER BY post_order_no ASC";
    $result_answers = mysqli_query($link, $sql_answers) ;
}

else if ($row['Typ']=='Multiplechoice')
{
    $sql_answers = "SELECT * FROM multiplechoice_answers ORDER BY post_order_no ASC";
    $result_answers = mysqli_query($link, $sql_answers) ;
}
if ($backindex==$rownumber['Anzahl_Fragen']){

    echo"<form action='insert.php' method='post'>";}

else{

    echo"<form action='Frage.php?".$_SESSION["Fragenindex"]."' method='post'>";}

	$dir = '../assets/'.$subdomain.'/logo/';
	$file = scandir($dir);

    echo"
    <img class='center' src='../assets/".$subdomain."/logo/".$file[2]."' alt='' width='150' height='70'>
    <div class='container'> 
    <div class='chapter'>".$row['Kapitel']."</div>
    <div class='frage'>".$row['Fragen_extern']."</div>";

    $Antwort_index=1;

    if ($row['Typ']=='Singlechoice'){
        while($row_answers=mysqli_fetch_array($result_answers)){
            if ($row_answers["Frage_".$row["ID"]] == 1){
            echo"<div><input id='element_1_".$Antwort_index."' name='element_1' type='radio' value='|".$row_answers["Answers"]."|'
            class='choice' for='element_1_".$Antwort_index."' required>".$row_answers['Answers']."</div>";
            }
            $Antwort_index=$Antwort_index+1;
        }
    }

    else if ($row['Typ']=='Multiplechoice'){
        while($row_answers=mysqli_fetch_array($result_answers)){
            if ($row_answers["Frage_".$row["ID"]] == 1){
            echo"<div><input id='element_1_".$Antwort_index."' name='element_1[]' type='checkbox' value='|".$row_answers["Answers"]."|'
            class='choice' for='element_1_".$Antwort_index."'>".$row_answers['Answers']."</div>";
            }
            $Antwort_index=$Antwort_index+1;
        }
    }

    else if($row['Typ']=='Schieberegler'){
        echo"
        <div style='text-align:center'>
        <p style='margin-bottom:20px;'>Bewertung: <span id='output' style='font-size:15px;'>".$default."</span></p>
        <input type='range' style='width:80%; margin-left:10px;' min='".$min."' max='".$max."' value='".$default."' name='element_1' id='myRange' ontouchend='input_update()' oninput='input_update(), color()'>
        </div>
        ";
        }

    else{
        echo"	<div><textarea class = 'frage_text' name='element_1' cols='50' rows='4' maxlength='1000' wrap='soft'></textarea></div>";
    }
    echo"</div>
    <input class='center_button' type='submit' value='WEITER'>
    <label class='label_progress'>Frage ".$backindex." von ".$rownumber['Anzahl_Fragen']."</label>
    <progress class='progressbar' id='progress' value='".$backindex."' max='".$rownumber['Anzahl_Fragen']."'></progress>
    </form>";

    $_SESSION["Fragenindex"]=$_SESSION["Fragenindex"]+1;
    }

?>

<script>
function input_update()
{
    var value = document.getElementById("myRange").value;
    var output = document.getElementById("output");
    output.innerHTML = value;
}
function color() 
{ 
    var slider = document.getElementById("myRange")
    var value = (slider.value-slider.min)/(slider.max-slider.min)*100
    var value2 = value-10
    var temp =  slider.value*(100/(slider.max-slider.min));
    var color =  "hsl("+temp+", 100%, 50%) ";
    var color2 =  "#82CFD0 ";
    slider.style.background = 'linear-gradient(to right, '+color+'0%, '+color + value2 + '%, '+color+value2+'%, '+color2 + value + '%, #fff ' + value + '%, white 100%)'
}
</script>


