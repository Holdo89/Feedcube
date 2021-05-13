
<?php
require_once "session.php";
require_once "../config.php";

$ID=$_REQUEST["ID"];
$max=$_REQUEST["Range_Max"];
$min=$_REQUEST["Range_Min"];
$columns=$_REQUEST["Columns"];

if($max <= $min)
{
    include "Fragen.php";
    echo"<script>display(".$ID.", \"intern\", \"Schieberegler\");
    var Schieberoutput = document.getElementById('SchieberID_intern');
    Schieberoutput.innerHTML='<div id=\"range_alert\" class=\"alert icon-alert with-arrow alert-danger form-alter\" role=\"alert\" style=\"display:block;grid-column-end: span 3;\"><i class=\"fa fa-fw fa-times-circle\"></i><strong> Note !</strong> <span class=\"warning-message\"> Die angegebenen Werte waren nicht korrekt </span></div>'+Schieberoutput.innerHTML;
    </script>";
}
else{
$query = "UPDATE rangeslider_answers SET range_min = '".$min."' WHERE Intern_ID = '".$ID."'";

$exec = mysqli_query($link,$query);

$query = "UPDATE rangeslider_answers SET range_max = '".$max."' WHERE Intern_ID = '".$ID."'";

$exec = mysqli_query($link,$query);

$query = "UPDATE rangeslider_answers SET columns = '".$columns."' WHERE Intern_ID = '".$ID."'";

$exec = mysqli_query($link,$query);
header("location:Fragen.php");
}
?>