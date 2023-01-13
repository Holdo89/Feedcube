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
    $Umfrage = $_REQUEST["Umfrage"];


        $sql = "SELECT COUNT(ID) FROM internes_feedback WHERE Datum <= '".$datum_min." 23:59:59' AND Datum >= '".$datum_max." 00:00:00'AND Umfrage LIKE '".$Umfrage."'";
        $query = mysqli_query($link,$sql);
        $row = mysqli_fetch_array($query);
        $Feedback_abgegeben = $row["COUNT(ID)"];
        if($Feedback_abgegeben)
        {
            $sql_date_last = "SELECT * FROM internes_feedback WHERE Datum <= '".$datum_min." 23:59:59' AND Datum >= '".$datum_max." 00:00:00'AND Umfrage LIKE '".$Umfrage."' ORDER BY Datum DESC";
            $query_date_last = mysqli_query($link,$sql_date_last);
            $row_date_last = mysqli_fetch_array($query_date_last);

            $sql_leistung_last = "SELECT Umfrage FROM umfragen WHERE ID = ".$row_date_last["Umfrage"];
            $query_leistung_last = mysqli_query($link,$sql_leistung_last);
            $row_leistung_last = mysqli_fetch_array($query_leistung_last);

            $leistung_last = $row_leistung_last["Umfrage"];
            $date_last = $row_date_last["Datum"];
            $today = date("Y-m-d"); 
            $date1=date_create($date_last);
            $date2=date_create($today);
            $diff=date_diff($date1,$date2);

            echo "
            <div class='dashboard_stats'>
            <div><div style='margin-bottom:20px;'>Anzahl abgegebenes Feedback</div><div style='margin-bottom:20px; font-size:40px'>".$Feedback_abgegeben."</div></div>
            <div><div style='margin-bottom:20px;'>Letztes Feedback vor</div><div style='margin-bottom:20px; font-size:25px;'>". $diff->format("%a Tagen")."</div><div style='margin-bottom:5px;'>abgegeben am: </div><div style='margin-bottom:20px;'>".$date_last."</div></div>
            <div>
            <div style='margin-bottom:5px;'>Kurs:</div><div style='margin-bottom:20px; font-size:18px;'>". $leistung_last."</div></div></div>";
        }
    ?>

<div id = "pdf_Umfragen" style="margin-bottom:60px"> 	
	<div id="charts_Umfragen" class="grid-container-charts" >
			<div class="leftchart"> 
			<canvas id="TrendChart_Umfragen" height=200></canvas>
			</div>
            <div class= "rightchart">
			<canvas id="PieChart_Umfragen" height=220></canvas>
			</div>
			<div class= "leftchart">
			<canvas id="ColumnChart_Umfragen" height=180></canvas>
			</div>
            <div class= "rightchart">
			<canvas id="PieChart_Umfragen_Bewertung" height=220></canvas>
			</div>

	</div>
</div>
    <?php
    
    if($Feedback_abgegeben)
    {   
        include "Fragen_Startseite_Umfragen.php";
        questions_Umfrage("Bewertung", $link, $Umfrage, $datum_min,$datum_max);
        questions_Umfrage("Multiplechoice", $link, $Umfrage,$datum_min,$datum_max);
        questions_Umfrage("Schieberegler", $link, $Umfrage,$datum_min,$datum_max);
    }
    else{
        echo"<div style='text-align:center; grid-column: 1 / span 3;'><p><label style='margin-top:30px'>Es wurde noch kein Feedback abgegeben</label></p> <img src='../assets/brand/empty.png' alt='' class='undraw_chart_empty'></div>";
    }
?>