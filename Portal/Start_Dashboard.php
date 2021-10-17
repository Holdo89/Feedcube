<?php
require_once "../config.php";
require_once "session.php";

    $sql = "SELECT Is_Admin FROM users WHERE username = '".$_SESSION["username"]."'";
    $result = mysqli_query($link, $sql);
    $row = mysqli_fetch_assoc($result);
    $Is_admin=false;

    if($row["Is_Admin"]==1){
        $Is_admin = true;
    }
    $datum_min=$_REQUEST["datum_min"];
    $datum_max=$_REQUEST["datum_max"];
    $Trainer = $_REQUEST["Trainer"];
    $Leistung=$_REQUEST["Leistung"];
    $Trainer=$_REQUEST["Trainer"];
    $Zeitraum = $_REQUEST["Zeitraum"];
    if($Zeitraum != "Benutzerdefiniert")
    {
        $datum_min = date("Y-m-d");
        $datum_max = date('Y-m-d', strtotime("-".$Zeitraum));
    }

        $sql = "SELECT COUNT(ID) FROM externes_feedback WHERE Datum <= '".$datum_min." 23:59:59' AND Datum >= '".$datum_max." 23:59:59'AND Leistung LIKE '".$Leistung."' AND Username LIKE '".$Trainer."'";
        $query = mysqli_query($link,$sql);
        $row = mysqli_fetch_array($query);
        $Feedback_abgegeben = $row["COUNT(ID)"];
        if($Feedback_abgegeben)
        {
            $sql_date_last = "SELECT Datum, Trainer, Leistung FROM externes_feedback WHERE Datum <= '".$datum_min." 23:59:59' AND Datum >= '".$datum_max." 23:59:59'AND Leistung LIKE '".$Leistung."' AND Username LIKE '".$Trainer."'  ORDER BY Datum DESC";
            $query_date_last = mysqli_query($link,$sql_date_last);
            $row_date_last = mysqli_fetch_array($query_date_last);

            $sql_leistung_last = "SELECT Leistung FROM leistungen WHERE ID = ".$row_date_last["Leistung"];
            $query_leistung_last = mysqli_query($link,$sql_leistung_last);
            $row_leistung_last = mysqli_fetch_array($query_leistung_last);

            $leistung_last = $row_leistung_last["Leistung"];
            $date_last = $row_date_last["Datum"];
            $today = date("Y-m-d"); 
            $trainer_last = $row_date_last["Trainer"];
            $date1=date_create($date_last);
            $date2=date_create($today);
            $diff=date_diff($date1,$date2);

            echo "
            <div class='dashboard_stats'><div><div style='margin-bottom:20px;'>Anzahl abgegebenes Feedback</div><div style='margin-bottom:20px; font-size:40px'>".$Feedback_abgegeben."</div></div>
            <div><div style='margin-bottom:20px;'>Letztes Feedback vor</div><div style='margin-bottom:20px; font-size:25px;'>". $diff->format("%a Tagen")."</div><div style='margin-bottom:5px;'>abgegeben am: </div><div style='margin-bottom:20px;'>".$date_last."</div></div>
            <div>";
            if ($Is_admin){
                echo"<div style='margin-bottom:5px;'>Trainer:</div><div style='margin-bottom:15px; font-size:18px;'>". $trainer_last."</div>";
            }
            echo"<div style='margin-bottom:5px;'>Leistung:</div><div style='margin-bottom:20px; font-size:18px;'>". $leistung_last."</div></div></div>";
        }
    
    if($Feedback_abgegeben)
    {   
        echo"<h3 style='margin:auto; font-size:20px; margin-top:50px; grid-column-end:span 3; text-align:center; display:grid;'>Fragenauswertung</h3>";
        echo"<hr style='grid-column-end:span 3;'>";
        echo"<div style='grid-column-end:span 3;' class='startdashboard'>";
        echo'<div class="überschrift_start"><b>Singlechoice</b> </div> <div class="überschrift_start"><b>Total</b></div> <div class="überschrift_start"><b>Trend</b> </div>';
        include "Fragen_Startseite.php";
        questions("Singlechoice", $link, $Trainer,$Leistung,$datum_min,$datum_max);
        echo'<div class="überschrift_start"><b>Multiplechoice</b></div><div class="überschrift_start"><b>Häufigste</b></div> <div class="überschrift_start"><b>Seltenste</b> </div>';
        questions("Multiplechoice", $link, $Trainer,$Leistung,$datum_min,$datum_max);
        echo'<div class="überschrift_start"><b>Schieberegler</b> </div> <div class="überschrift_start"><b>Total</b></div> <div class="überschrift_start"><b>Trend</b> </div>';
        questions("Schieberegler", $link, $Trainer,$Leistung,$datum_min,$datum_max);
        echo"</div>";
    }
    else{
        echo"<div style='text-align:center; grid-column: 1 / span 3;'><p><label style='margin-top:30px'>Es wurde noch kein Feedback abgegeben</label></p> <img src='undraw_empty_xct9.svg' alt='' class='undraw_chart_empty'></div>";
    }
?>