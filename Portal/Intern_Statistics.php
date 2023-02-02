<?php
require_once "../config.php";
require_once "session.php";

$sql = "SELECT Is_Admin FROM users WHERE username ='".$_SESSION["username"]."'";
$exec = mysqli_query($link,$sql);
$row = mysqli_fetch_assoc($exec);
$IsAdmin = $row["Is_Admin"];
 $datum_min=$_REQUEST["datum_min"];
 $datum_max=$_REQUEST["datum_max"];
 $Frage=$_REQUEST["Frage"];
 $ID = substr($Frage,6);
 $Frage_multi="Intern_".$ID;
 $Antwort = 0;

 
 if($Frage!="undefined"){
	echo "
	<div class='dropdown' style='margin-top:-90px; border-radius:20px;'>
	<button class='dropbtn' style='font-size:25px;'><i class='fa fa-bars'></i></button>
	<div class='dropdown-content'>";
	echo"<a href='javascript:intern_export_data()' style='font-size:15px;'>Export</a>";

	if($IsAdmin==1)
	{
		echo"
		<a href='javascript:intern_delete_data()' style='font-size:15px;'>Löschen</a>				
		";
	}

	echo"
	</div>
	</div>
	<p style='font-size:30px;margin-bottom:50px; margin-top:-40px'>Statistik</p>";

//get type of question
$sql = "SELECT Typ FROM intern WHERE ID = '".$ID."'";
$exec = mysqli_query($link,$sql);
$row = mysqli_fetch_array($exec);
$typ=$row["Typ"]; 

	$query = "SELECT COUNT(".$Frage.") FROM umfragenfeedback WHERE Datum <= '".$datum_min." 23:59:59' AND Datum >= '".$datum_max." 00:00:00'";
	$exec = mysqli_query($link, $query);
	$row=mysqli_fetch_assoc($exec);
	//hole die Anzahl an abgegebenen Feedback
	$sql_get_Anzahl_abgegebenes_feedback = "SELECT COUNT(".$Frage.") FROM umfragenfeedback WHERE Datum <= '".$datum_min." 23:59:59' AND Datum >= '".$datum_max." 00:00:00' AND ".$Frage." != 'NULL'";
	$query_get_Anzahl_abgegebenes_feedback = mysqli_query($link, $sql_get_Anzahl_abgegebenes_feedback);
	$Anzahl_abgegenes_feedback_row=mysqli_fetch_array($query_get_Anzahl_abgegebenes_feedback);
	$Anzahl_abgegenes_feedback = $Anzahl_abgegenes_feedback_row["COUNT(".$Frage.")"];
    $Average = 0;
	$i=1;
	if($typ=="Bewertung"){
		$sql="SELECT Answers FROM bewertung_answers WHERE Intern_".$ID." = 1 ORDER BY post_order_no ASC";
		$exec = mysqli_query($link, $sql);
		while($row=mysqli_fetch_array($exec))
		{
		$sql2 = "SELECT COUNT(".$Frage.") FROM umfragenfeedback WHERE Datum <= '".$datum_min." 23:59:59' AND Datum >= '".$datum_max." 00:00:00'AND ".$Frage." LIKE '%|".$row["Answers"]."|%'";
		$exec2 = mysqli_query($link, $sql2);
		$row2=mysqli_fetch_array($exec2);
		$Average=$Average+($i*intval($row2["COUNT(".$Frage.")"]));
		$i =$i+1;
		}
	}
			if($Anzahl_abgegenes_feedback==0)
		{
			$Average = 0;
		}
		else
		{
			$Average = $Average/$Anzahl_abgegenes_feedback;
		}


	$query = "SELECT ROUND(AVG(".$Frage."),1) FROM umfragenfeedback WHERE Datum <= '".$datum_min." 23:59:59' AND Datum >= '".$datum_max." 00:00:00'";
	$exec = mysqli_query($link,$query);
	$rowx = mysqli_fetch_array($exec);
	$Bewertungsarray = array();

	if($typ=="Bewertung"){
    	echo "<p style='font-size:25px;'>&empty; Total: ".round($Average,1)."</p>";
	}
	
	else if($typ=="Multiplechoice"){
		echo "<p style='color:#99f19e; margin-top:-20px;margin-bottom:20px;'># Bewertungen: ".$Anzahl_abgegenes_feedback."</p>";
		$sql="SELECT Answers FROM multiplechoice_answers WHERE ".$Frage_multi." = 1 ORDER BY post_order_no ASC";
		$exec = mysqli_query($link, $sql);
		while($row=mysqli_fetch_array($exec))
		{
		$sql2 = "SELECT COUNT(".$Frage.") FROM umfragenfeedback WHERE Datum <= '".$datum_min." 23:59:59' AND Datum >= '".$datum_max." 00:00:00' AND ".$Frage." LIKE '%|".$row["Answers"]."|%'";
		$exec2 = mysqli_query($link, $sql2);
		$row2=mysqli_fetch_array($exec2);
		$a=array("Auswahl" => $row["Answers"], "Anzahl" => $row2["COUNT(".$Frage.")"]);
		array_push($Bewertungsarray,$a);
		}
	}
	else{
		echo "<p style='font-size:25px;'>&empty; Total: ".$rowx["ROUND(AVG(".$Frage."),1)"]."</p>";
	}

	//Array mit ANzahl pro AUswahlmöglichkeit nach Anzahl sortieren und ausgeben
	$columns = array_column($Bewertungsarray, 'Anzahl');
	array_multisort($columns, SORT_DESC, $Bewertungsarray);
	$i =0;
	while($i<sizeof($Bewertungsarray)){
		echo "<p>".$Bewertungsarray[$i]['Auswahl'].": ".$Bewertungsarray[$i]['Anzahl']."</p>";
		$i++;
	}

	//last 10

    $Average_10 = 0;
	$i=1;
	if($typ=="Bewertung"){
		$sql_number_of_answers="SELECT COUNT(Answers) FROM bewertung_answers WHERE Intern_".$ID." = 1 ORDER BY post_order_no ASC";
		$exec_number_of_answers = mysqli_query($link, $sql_number_of_answers);
		$number_of_answers = mysqli_fetch_array($exec_number_of_answers);
		$range = intval($number_of_answers[0])*0.1;

		$sql="SELECT Answers FROM bewertung_answers WHERE Intern_".$ID." = 1 ORDER BY post_order_no ASC";
		$exec = mysqli_query($link, $sql);
		while($row=mysqli_fetch_array($exec))
		{
			$sql2 = "SELECT COUNT(case when ".$Frage." = '|".$row["Answers"]."|' then 1 else null end) AS result FROM (SELECT ".$Frage." FROM umfragenfeedback WHERE Datum <= '".$datum_min." 23:59:59' AND Datum >= '".$datum_max." 00:00:00' AND ".$Frage." != 'NULL' ORDER BY Datum DESC LIMIT 10) AS a";
			$exec2 = mysqli_query($link, $sql2);
			$row2=mysqli_fetch_array($exec2);
			$Average_10=$Average_10+($i*intval($row2["result"]));
			$i =$i+1;
		}
	}
	if($typ=="Bewertung" || $typ=="Multiplechoice"){
		if($Anzahl_abgegenes_feedback<10)
		{
			$Average_10 = $Average_10/$Anzahl_abgegenes_feedback;
		}
		else
		{
			$Average_10 = $Average_10/10;
		}
	}
	$query = "SELECT ROUND(AVG(".$Frage."),1) FROM (SELECT * FROM umfragenfeedback WHERE Datum <= '".$datum_min." 23:59:59' AND Datum >= '".$datum_max." 00:00:00' AND ".$Frage." != 'NULL' ORDER BY Datum DESC LIMIT 10) AS a";
	$exec = mysqli_query($link,$query);
	$rows = mysqli_fetch_array($exec);

	if($typ=="Bewertung"){
    	echo "<p>&empty; letzten 10 Bewertungen: ".round($Average_10,1)."</p>";
	}
else if($typ=="Schieberegler"){
		echo "<p>&empty; letzten 10 Bewertungen: ".$rows["ROUND(AVG(".$Frage."),1)"]."</p>";
	}
	if($typ=="Bewertung"){
		$Trend = round($Average_10-$Average,1);
	if($Trend<$range*-1)
    {
        echo"<p style='color:green'>&darr; Trend: ";
        echo $Trend;
        echo" </p>";
    }
	
	else if ($Trend>$range*-1 && $Trend<0){
        echo"<p style='color:lightgreen'>&#x2198; Trend: ";
        echo $Trend;
        echo" </p>";
    }

	else if ($Trend==0){
		echo"<p style='color:lightgreen'>&rarr;  ";
		echo $Trend;
		echo" </p>";
	}

	else if ($Trend<$range && $Trend>0){
        echo"<p style='color:orange'>&#x2197; Trend: +";
        echo $Trend;
        echo" </p>";
    }

    else if ($Trend>=$range){
        echo"<p style='color:red'>&uarr; Trend: +";
        echo $Trend;
        echo" </p>";
    }

	echo "<p style='margin-bottom:-20px;'># Bewertungen: ".$Anzahl_abgegenes_feedback."</p>";
}
else if($typ=="Schieberegler"){
	$sql_range = "SELECT * FROM rangeslider_answers WHERE Intern_ID = '".$ID."'";
	$exec_range = mysqli_query($link,$sql_range);
	$row_range = mysqli_fetch_array($exec_range);
	$range = ($row_range["range_max"]-$row_range["range_min"])*0.1;
	$Trend = $rows["ROUND(AVG(".$Frage."),1)"] - $rowx["ROUND(AVG(".$Frage."),1)"];
	if($Trend<$range*-1)
	{
		echo"<p style='color:red'>&darr;  ";
		echo $Trend;
		echo" </p>";
	}
	
	else if ($Trend>$range*-1 && $Trend<0){
		echo"<p style='color:orange'>&#x2198;  ";
		echo $Trend;
		echo" </p>";
	}

	else if ($Trend<$range && $Trend>0){
		echo"<p style='color:lightgreen'>&#x2197;  +";
		echo $Trend;
		echo" </p>";
	}

	else if ($Trend==0){
		echo"<p style='color:lightgreen'>&rarr;  ";
		echo $Trend;
		echo" </p>";
	}

	else if ($Trend>=$range){
		echo"<p style='color:green'>&uarr;  +";
		echo $Trend;
		echo" </p>";
	}
	echo "<p style='margin-bottom:-20px;'># Bewertungen: ".$Anzahl_abgegenes_feedback."</p>";
}
	//echo'<p style="font-size:13px; margin-top:40px; margin-bottom:-30px;">';
	//include "get_answers_options_label.php";
	echo'</p>';

}
else{
	$exec = mysqli_query($link,$query);
	$row = mysqli_fetch_array($exec);
	echo "<p style='margin-bottom:-20px;'># Bewertungen: ".$row["COUNT(".$Frage.")"]."</p>";
	echo"# Bewertungen: 0";
}

?>