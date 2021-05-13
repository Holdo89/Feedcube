<?php

require_once "config.php";
require_once "session.php";

$sql = "SELECT Is_Admin FROM users WHERE username = '".$_SESSION["username"]."'";
$result = mysqli_query($link, $sql);
$row = mysqli_fetch_assoc($result);
$Message="";

if($row["Is_Admin"]==1){
        $Message ="<div id='Auswahl_Frage' name='Auswahl_Frage'> Es wurde noch keine interne Feedback Frage <a href='Fragen.php'>hinzugefügt</a></div>";
    }
else{
        $Message ="<div id='Auswahl_Frage' name='Auswahl_Frage'> Es wurde noch keine interne Feedback Frage hinzugefügt, wende dich an einen Feedcube Administrator</div>";
    }

$sql = "SELECT COUNT(ID) FROM intern";
$result = mysqli_query($link, $sql);
$row = mysqli_fetch_assoc($result);
if($row["COUNT(ID)"]!=0)
{


$sql = "SELECT * FROM intern ORDER BY post_order_no ASC";

$result = mysqli_query($link, $sql);

$i=1;

echo"<form action='intern_insert_feedback.php' method='post'>";

while($row = mysqli_fetch_assoc($result)){
    if($row["Typ"]=="Schieberegler")
    {
        $sql_range = "SELECT * FROM rangeslider_answers WHERE Intern_ID = ".$row["ID"];
        $result_range = mysqli_query($link, $sql_range);
        $row_range = mysqli_fetch_assoc($result_range);
        $max = $row_range["range_max"];
        $min = $row_range["range_min"];
        $default = $max/2;
    }
    echo"

    <div class='frage'>".$row['Fragen_intern']."</div>";



    if ($row['Typ']=='Schieberegler'){

    echo"

    <div class='slidecontainer'>
    <input id = 'ident_".$i."' name='ident_".$i."' value = 'Schieberegler' style='height:0px; margin:0px; visibility:hidden'></input>
    <p style='margin-bottom:20px'>Bewertung: <span id='output_".$i."' >".$default."</span></p>
    <input type='range' min='".$min."' max='".$max."' value='".$default."' name='intern_input_".$i."' id='myRange_".$i."' ontouchend='input_update(".$i.")' oninput='input_update(".$i."), color(".$i.")'>
    </div>
    ";

    }

    else if ($row['Typ']=='Singlechoice'){
        echo"<div class='multi'>";
        echo"<input id = 'ident_".$i."' name='ident_".$i."' value = 'Singlechoice' style='height:0px; margin:0px; visibility:hidden'></input>";
        $Antwort_index=1;
        $sql_answers = "SELECT * FROM singlechoice_answers WHERE Intern_".$row['ID']." = 1 ORDER BY post_order_no ASC";
        $result_answers = mysqli_query($link, $sql_answers) ;
        while($row_answers=mysqli_fetch_array($result_answers)){

            echo"<div><input id='element_1_".$Antwort_index."' name='intern_input_".$i."' type='radio' value='".$row_answers['Answers']."'
            style='margin:10px; ' for='element_1_".$Antwort_index."'>".$row_answers['Answers']."</div>";

            $Antwort_index=$Antwort_index+1;

        }
        echo"</div>";

    }

    else if ($row['Typ']=='Multiplechoice'){
        echo"<div class='multi' id = 'ident_".$i."' name='ident_".$i."' value = 'Multiplechoice'>";
        echo"<input id = 'ident_".$i."' name='ident_".$i."' value = 'Multiplechoice' style='height:0px; margin:0px; visibility:hidden'></input>";
        $Antwort_index=1;
        $sql_answers = "SELECT * FROM multiplechoice_answers WHERE Intern_".$row['ID']." = 1 ORDER BY post_order_no ASC";
        $result_answers = mysqli_query($link, $sql_answers) ;
        while($row_answers=mysqli_fetch_array($result_answers)){

            echo"<div><input id='element_1_".$Antwort_index."' name='intern_input_".$i."[]' type='checkbox' value='|".$row_answers['Answers']."|'
            style='margin:10px; ' for='element_1_".$Antwort_index."'>".$row_answers['Answers']."</div>";

            $Antwort_index=$Antwort_index+1;

        }
        echo"</div>";

    }

    else{
        echo"<input id = 'ident_".$i."' name='ident_".$i."' value = 'Text' style='height:0px; margin:0px; visibility:hidden'></input>";

        echo"<div><textarea class = 'frage_text' name='intern_input_".$i."' cols='50' rows='6' maxlength='1000' wrap='soft'></textarea></div>";
    }

    $i=$i+1;

}

echo"

<input class='center_button' type='submit' value='Feedback abgeben'>

</form>";
}
else
echo $Message;

?>





<script>
function input_update(i)
{
    var value = document.getElementById("myRange_"+i).value;
    var output = document.getElementById("output_"+i);

    output.innerHTML = value;
}
function color(i) 
{ 
    var slider = document.getElementById("myRange_"+i)
    var value = (slider.value-slider.min)/(slider.max-slider.min)*100
    var value2 = value-10
    var temp =  slider.value*(100/(slider.max-slider.min));
    var color =  "hsl("+temp+", 100%, 50%) ";
    var color2 =  "#82CFD0 ";

    slider.style.background = 'linear-gradient(to right, '+color+'0%, '+color + value2 + '%, '+color+value2+'%, '+color2 + value + '%, #fff ' + value + '%, white 100%)'
}
</script>