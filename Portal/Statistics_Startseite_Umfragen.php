<?php
function Statistik_Umfrage($Frage,$link,$Umfrage,$datum_min,$datum_max){
	$ID = substr($Frage,6);
	if($Frage!="undefined"){

	//get type of question
	$sql = "SELECT Typ FROM intern WHERE ID = '".$ID."'";
	$exec = mysqli_query($link,$sql);
	$row = mysqli_fetch_array($exec);
	$typ=$row["Typ"]; 

		$query = "SELECT COUNT(".$Frage.") FROM umfragenfeedback WHERE Datum <= '".$datum_min." 23:59:59' AND Datum >= '".$datum_max." 00:00:00'AND Umfrage LIKE '".$Umfrage."'";
		$exec = mysqli_query($link, $query);
		$row=mysqli_fetch_assoc($exec);

		$sql_get_Anzahl_abgegebenes_feedback = "SELECT COUNT(".$Frage.") FROM umfragenfeedback  WHERE ".$Frage." != 'NULL' AND Datum <= '".$datum_min." 23:59:59' AND Datum >= '".$datum_max." 00:00:00'AND Umfrage LIKE '".$Umfrage."'";
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
				$sql2 = "SELECT COUNT(".$Frage.") FROM umfragenfeedback  WHERE ".$Frage." LIKE '%|".$row["Answers"]."|%' AND Datum <= '".$datum_min." 23:59:59' AND Datum >= '".$datum_max." 00:00:00'AND Umfrage LIKE '".$Umfrage."'";
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

		$query = "SELECT ROUND(AVG(".$Frage."),1) FROM umfragenfeedback  WHERE Datum <= '".$datum_min." 23:59:59' AND Datum >= '".$datum_max." 00:00:00'AND Umfrage LIKE '".$Umfrage."'";
		$exec = mysqli_query($link,$query);
		$rowx = mysqli_fetch_array($exec);
		$Bewertungsarray = array();

		if($typ=="Bewertung"){
			echo "<td>".round($Average,1)."</td>";
		}
		else if($typ=="Multiplechoice"){
			$sql="SELECT Answers FROM multiplechoice_answers WHERE Intern_".$ID." = 1 ORDER BY post_order_no ASC";
			$exec = mysqli_query($link, $sql);
			while($row=mysqli_fetch_array($exec))
			{
				$sql2 = "SELECT COUNT(".$Frage.") FROM umfragenfeedback WHERE ".$Frage." LIKE '%|".$row["Answers"]."|%' AND Datum <= '".$datum_min." 23:59:59' AND Datum >= '".$datum_max." 00:00:00'AND Umfrage LIKE '".$Umfrage."'";
				$exec2 = mysqli_query($link, $sql2);
				$row2=mysqli_fetch_array($exec2);
				$a=array("Auswahl" => $row["Answers"], "Anzahl" => $row2["COUNT(".$Frage.")"]);
				array_push($Bewertungsarray,$a);
			}
		}
		else{
			echo "<td>".$rowx["ROUND(AVG(".$Frage."),1)"]."</td>";
		}
	
		//Array mit ANzahl pro AUswahlmöglichkeit nach Anzahl sortieren und ausgeben
		$columns = array_column($Bewertungsarray, 'Anzahl');
		array_multisort($columns, SORT_DESC, $Bewertungsarray);
		$i =0;
		while($i<sizeof($Bewertungsarray)&&$i<1){
			echo "<td>".$Bewertungsarray[0]['Auswahl'].": ".$Bewertungsarray[0]['Anzahl']."</td>";
			echo "<td>".$Bewertungsarray[sizeof($Bewertungsarray)-1]['Auswahl'].": ".$Bewertungsarray[sizeof($Bewertungsarray)-1]['Anzahl']."</td>";
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
				$sql2 = "SELECT COUNT(case when ".$Frage." = '|".$row["Answers"]."|' then 1 else null end) AS result FROM (SELECT ".$Frage." FROM umfragenfeedback WHERE ".$Frage." != 'NULL' AND Datum <= '".$datum_min." 23:59:59' AND Datum >= '".$datum_max." 00:00:00'AND Umfrage LIKE '".$Umfrage."' ORDER BY Datum DESC LIMIT 10) AS a";
				$exec2 = mysqli_query($link, $sql2);
				$row2=mysqli_fetch_array($exec2);
				$Average_10=$Average_10+($i*intval($row2["result"]));
				$i =$i+1;
			}
		}
		if($typ=="Bewertung"||$typ=="Multiplechoice"){
			if($Anzahl_abgegenes_feedback<10 && $Anzahl_abgegenes_feedback>0)
			{
				$Average_10 = $Average_10/$Anzahl_abgegenes_feedback;
			}
			else
			{
				$Average_10 = $Average_10/10;
			}
		}

		$query = "SELECT ROUND(AVG(".$Frage."),1) FROM (SELECT * FROM umfragenfeedback  WHERE ".$Frage." != 'NULL' AND Datum <= '".$datum_min." 23:59:59' AND Datum >= '".$datum_max." 00:00:00'AND Umfrage LIKE '".$Umfrage."' ORDER BY Datum DESC LIMIT 10) AS a";
		$exec = mysqli_query($link,$query);
		$rows = mysqli_fetch_array($exec);

		if($typ=="Bewertung"){
			$Trend = round($Average_10-$Average,1);
		if($Trend<=$range*-1)
		{
			echo"<td style='color:green'>&darr;  ";
			echo $Trend;
			echo" </td>";
		}
		
		else if ($Trend>$range*-1 && $Trend<0){
			echo"<td style='color:lightgreen'>&#x2198;  ";
			echo $Trend;
			echo" </td>";
		}

		else if ($Trend<$range && $Trend>0){
			echo"<td style='color:orange'>&#x2197;  +";
			echo $Trend;
			echo" </td>";
		}

		else if ($Trend==0){
			echo"<td style='color:lightgreen'>&rarr;  ";
			echo $Trend;
			echo" </td>";
		}

		else if ($Trend>=$range){
			echo"<td style='color:red'>&uarr;  +";
			echo $Trend;
			echo" </td>";
		}
	}
	else if($typ=="Schieberegler"){
		$sql_range = "SELECT * FROM rangeslider_answers WHERE Intern_ID = '".$ID."'";
		$exec_range = mysqli_query($link,$sql_range);
		$row_range = mysqli_fetch_array($exec_range);
		$range = ($row_range["range_max"]-$row_range["range_min"])*0.1;
		$Trend = $rows["ROUND(AVG(".$Frage."),1)"] - $rowx["ROUND(AVG(".$Frage."),1)"];
		if($Trend<=$range*-1)
		{
			echo"<td style='color:red'>&darr;  ";
			echo $Trend;
			echo" </td>";
		}
		
		else if ($Trend>$range*-1 && $Trend<0){
			echo"<td style='color:orange'>&#x2198;  ";
			echo $Trend;
			echo" </td>";
		}

		else if ($Trend<$range && $Trend>0){
			echo"<td style='color:lightgreen'>&#x2197;  +";
			echo $Trend;
			echo" </td>";
		}

		else if ($Trend==0){
			echo"<td style='color:lightgreen'>&rarr;  ";
			echo $Trend;
			echo" </td>";
		}

		else if ($Trend>=$range){
			echo"<td style='color:green'>&uarr;  +";
			echo $Trend;
			echo" </td>";
		}
	}



	//last 1000

	$Average_100 = 0;
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
			$sql2 = "SELECT COUNT(case when ".$Frage." = '|".$row["Answers"]."|' then 1 else null end) AS result FROM (SELECT ".$Frage." FROM umfragenfeedback WHERE ".$Frage." != 'NULL' AND Datum <= '".$datum_min." 23:59:59' AND Datum >= '".$datum_max." 00:00:00'AND Umfrage LIKE '".$Umfrage."' ORDER BY Datum DESC LIMIT 100) AS a";
			$exec2 = mysqli_query($link, $sql2);
			$row2=mysqli_fetch_array($exec2);
			$Average_100=$Average_100+($i*intval($row2["result"]));
			$i =$i+1;
		}
	}
	if($typ=="Bewertung"||$typ=="Multiplechoice"){
		if($Anzahl_abgegenes_feedback<100 && $Anzahl_abgegenes_feedback>0)
		{
			$Average_100 = $Average_100/$Anzahl_abgegenes_feedback;
		}
		else
		{
			$Average_100 = $Average_100/100;
		}
	}

	$query = "SELECT ROUND(AVG(".$Frage."),1) FROM (SELECT * FROM umfragenfeedback  WHERE ".$Frage." != 'NULL' AND Datum <= '".$datum_min." 23:59:59' AND Datum >= '".$datum_max." 00:00:00'AND Umfrage LIKE '".$Umfrage."' ORDER BY Datum DESC LIMIT 100) AS a";
	$exec = mysqli_query($link,$query);
	$rows = mysqli_fetch_array($exec);

	if($typ=="Bewertung"){
		$Trend = round($Average_100-$Average,1);
	if($Trend<=$range*-1)
	{
		echo"<td style='color:green'>&darr;  ";
		echo $Trend;
		echo" </td>";
	}
	
	else if ($Trend>$range*-1 && $Trend<0){
		echo"<td style='color:lightgreen'>&#x2198;  ";
		echo $Trend;
		echo" </td>";
	}

	else if ($Trend<$range && $Trend>0){
		echo"<td style='color:orange'>&#x2197;  +";
		echo $Trend;
		echo" </td>";
	}

	else if ($Trend==0){
		echo"<td style='color:lightgreen'>&rarr;  ";
		echo $Trend;
		echo" </td>";
	}

	else if ($Trend>=$range){
		echo"<td style='color:red'>&uarr;  +";
		echo $Trend;
		echo" </td>";
	}
}
else if($typ=="Schieberegler"){
	$sql_range = "SELECT * FROM rangeslider_answers WHERE Intern_ID = '".$ID."'";
	$exec_range = mysqli_query($link,$sql_range);
	$row_range = mysqli_fetch_array($exec_range);
	$range = ($row_range["range_max"]-$row_range["range_min"])*0.1;
	$Trend = $rows["ROUND(AVG(".$Frage."),1)"] - $rowx["ROUND(AVG(".$Frage."),1)"];
	if($Trend<=$range*-1)
	{
		echo"<td style='color:red'>&darr;  ";
		echo $Trend;
		echo" </td>";
	}
	
	else if ($Trend>$range*-1 && $Trend<0){
		echo"<td style='color:orange'>&#x2198;  ";
		echo $Trend;
		echo" </td>";
	}

	else if ($Trend<$range && $Trend>0){
		echo"<td style='color:lightgreen'>&#x2197;  +";
		echo $Trend;
		echo" </td>";
	}

	else if ($Trend==0){
		echo"<td style='color:lightgreen'>&rarr;  ";
		echo $Trend;
		echo" </td>";
	}

	else if ($Trend>=$range){
		echo"<td style='color:green'>&uarr;  +";
		echo $Trend;
		echo" </td>";
	}
}


	}
	else{
		include "IsAdmincheck.php";
		$exec = mysqli_query($link,$query);
		$row = mysqli_fetch_array($exec);
		echo "<td># Bewertungen: ".$row["COUNT(".$Frage.")"]."</td>";
		echo"# Bewertungen: 0";
	}
}
?>