<?php

// Start the session

require_once "../config.php";
require_once "session.php";

$sql = "SELECT MAX(post_order_no) FROM intern";
$query = mysqli_query($link, $sql);
$row = mysqli_fetch_array($query);
$last_order = $row["MAX(post_order_no)"]+1; //die letzte Frage fürdieReihenfolge von Drag and Drop

$neue_Frage = mysqli_real_escape_string($link, $_REQUEST["Frage"]);
$Fragentyp = mysqli_real_escape_string($link, $_REQUEST["Auswahl_Fragentyp"]);
$Antworttyp = mysqli_real_escape_string($link, $_REQUEST["Auswahl_Antworttyp"]);


$Antwort = $_POST["checkbox"]; 

$sql = "INSERT INTO intern (Typ, Fragen_intern, Antworttyp, post_order_no, post_id) VALUES ('$Fragentyp', '$neue_Frage', '$Antworttyp', '$last_order','$last_order')";

if(mysqli_query($link, $sql)){

} else{
    echo "ERROR: Could not able to execute $sql. " . mysqli_error($link);
}

$sql = "SELECT ID FROM intern ORDER BY ID DESC LIMIT 1";
$result=mysqli_query($link, $sql);
$row = mysqli_fetch_assoc($result);
$ID = $row['ID'];

if($Fragentyp=='Bewertung'){
    $sql= "ALTER TABLE bewertung_answers ADD Intern_".$row['ID']." tinyint(1)";
}
else if($Fragentyp=='Multiplechoice'){
    $sql= "ALTER TABLE multiplechoice_answers ADD Intern_".$row['ID']." tinyint(1)";
}
else if($Fragentyp=='Schieberegler'){
    $sql = "INSERT INTO rangeslider_answers (range_max, range_min, columns, Frage_ID) VALUES (100, 0, 5, ".$row['ID'].")";
}
mysqli_query($link, $sql);

if($Fragentyp=='Text'){
$sql= "ALTER TABLE internes_feedback ADD Frage_".$row['ID']." TEXT";}

elseif($Fragentyp=='Bewertung' || $Fragentyp=='Multiplechoice'){
$sql= "ALTER TABLE internes_feedback ADD Frage_".$row['ID']." TEXT";}

elseif($Fragentyp=='Schieberegler'){
$sql= "ALTER TABLE internes_feedback ADD Frage_".$row['ID']." INT(11)";}

//Fragen_relate_antworten.php

if($Fragentyp!="Text" && $Fragentyp!="Schieberegler")
{
        for ($i=0; $i<sizeof($Antwort);$i++) { 
            if(!strpos($Antwort[$i],"_unchecked")){
                if($Fragentyp=="Bewertung")
                {
                    $query="UPDATE bewertung_answers SET Intern_".$ID." = 1 WHERE Answers = '".$Antwort[$i]. "'";  
                }
                else if($Fragentyp=="Multiplechoice")
                {
                    $query="UPDATE multiplechoice_answers SET Intern_".$ID." = 1 WHERE Answers = '".$Antwort[$i]. "'";  
                }
                mysqli_query($link,$query); 
            } 
            else{
                if($Fragentyp=="Bewertung")
                {
                    $query="UPDATE bewertung_answers SET Intern_".$ID." = 0 WHERE Answers = '".substr($Antwort[$i],0,-10). "'";  
                }
                else if($Fragentyp =="Multiplechoice")
                {
                    $query="UPDATE multiplechoice_answers SET Intern_".$ID." = 0 WHERE Answers = '".substr($Antwort[$i],0,-10). "'";  
                }    
                mysqli_query($link,$query); 
            }
        } 
}

else{
    $max=$_REQUEST["Range_Max"];
    $min=$_REQUEST["Range_Min"];
    $columns=$_REQUEST["Columns"];

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
        $query = "UPDATE rangeslider_answers SET range_min = '".$min."' WHERE Frage_ID = '".$ID."'";
        $exec = mysqli_query($link, $query);
        $query = "UPDATE rangeslider_answers SET range_max = '".$max."' WHERE Frage_ID = '".$ID."'";
        $exec = mysqli_query($link, $query);
        $query = "UPDATE rangeslider_answers SET columns = '".$columns."' WHERE Frage_ID = '".$ID."'";
        $exec = mysqli_query($link, $query);
    }

}

mysqli_query($link, $sql);

mysqli_close($link);

$Step = $_REQUEST["Step"];
if($Step == 1)
{
    header("location: Tutorial_Fragen.php");
}

else{
    header("location: Fragen.php");
}
?>