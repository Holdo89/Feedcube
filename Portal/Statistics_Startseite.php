<?php
function Statistik($Frage,$link,$Trainer){
	$ID = substr($Frage,6);
	if($Frage!="undefined"){

	//get type of question
	$sql = "SELECT Typ FROM admin WHERE ID = '".$ID."'";
	$exec = mysqli_query($link,$sql);
	$row = mysqli_fetch_array($exec);
	$typ=$row["Typ"]; 

		if($Trainer=='externes_feedback')
		{
			$query = "SELECT COUNT(".$Frage.") FROM externes_feedback ";
		}
	
		else{
			$query = "SELECT COUNT(".$Frage.") FROM externes_feedback WHERE Username = '".$Trainer."'";
		}
		$exec = mysqli_query($link, $query);
		$row=mysqli_fetch_assoc($exec);


		if($Trainer=='externes_feedback')
		{
			$sql_get_Anzahl_abgegebenes_feedback = "SELECT COUNT(".$Frage.") FROM externes_feedback  WHERE ".$Frage." != 'NULL'";
		}
	
		else{
			$sql_get_Anzahl_abgegebenes_feedback = "SELECT COUNT(".$Frage.") FROM externes_feedback  WHERE ".$Frage." != 'NULL' AND Username = '".$Trainer."'";
		}

		$query_get_Anzahl_abgegebenes_feedback = mysqli_query($link, $sql_get_Anzahl_abgegebenes_feedback);
		$Anzahl_abgegenes_feedback_row=mysqli_fetch_array($query_get_Anzahl_abgegebenes_feedback);
		$Anzahl_abgegenes_feedback = $Anzahl_abgegenes_feedback_row["COUNT(".$Frage.")"];
		$Average = 0;
		$i=1;
		if($typ=="Singlechoice"){
			$sql="SELECT Answers FROM singlechoice_answers WHERE ".$Frage." = 1 ORDER BY post_order_no ASC";
			$exec = mysqli_query($link, $sql);
			while($row=mysqli_fetch_array($exec))
			{
			
				if($Trainer=='externes_feedback')
				{
					$sql2 = "SELECT COUNT(".$Frage.") FROM externes_feedback  WHERE ".$Frage." LIKE '%|".$row["Answers"]."|%'";
				}
			
				else{
					$sql2 = "SELECT COUNT(".$Frage.") FROM externes_feedback  WHERE ".$Frage." LIKE '%|".$row["Answers"]."|%' AND Username = '".$Trainer."'";
				}
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


		if($Trainer=='externes_feedback')
		{
			$query = "SELECT ROUND(AVG(".$Frage."),1) FROM externes_feedback ";
		}

		else{
			$query = "SELECT ROUND(AVG(".$Frage."),1) FROM externes_feedback  WHERE Username = '".$Trainer."'";
		}

		$exec = mysqli_query($link,$query);
		$rowx = mysqli_fetch_array($exec);
		$Bewertungsarray = array();

		if($typ=="Singlechoice"){
			echo "<p>".round($Average,1)."</p>";
		}
		else if($typ=="Multiplechoice"){
			$sql="SELECT Answers FROM multiplechoice_answers WHERE ".$Frage." = 1 ORDER BY post_order_no ASC";
			$exec = mysqli_query($link, $sql);
			while($row=mysqli_fetch_array($exec))
			{
			
				if($Trainer=='externes_feedback')
				{
					$sql2 = "SELECT COUNT(".$Frage.") FROM externes_feedback WHERE ".$Frage." LIKE '%|".$row["Answers"]."|%'";
				}
			
				else{
					$sql2 = "SELECT COUNT(".$Frage.") FROM externes_feedback WHERE ".$Frage." LIKE '%|".$row["Answers"]."|%' AND Username = '".$Trainer."'";
				}
			$exec2 = mysqli_query($link, $sql2);
			$row2=mysqli_fetch_array($exec2);
			$a=array("Auswahl" => $row["Answers"], "Anzahl" => $row2["COUNT(".$Frage.")"]);
			array_push($Bewertungsarray,$a);
			}
		}
		else{
			echo "<p>".$rowx["ROUND(AVG(".$Frage."),1)"]."</p>";
		}
	
		//Array mit ANzahl pro AUswahlmöglichkeit nach Anzahl sortieren und ausgeben
		$columns = array_column($Bewertungsarray, 'Anzahl');
		array_multisort($columns, SORT_DESC, $Bewertungsarray);
		$i =0;
		while($i<sizeof($Bewertungsarray)&&$i<1){
			echo "<p>".$Bewertungsarray[0]['Auswahl'].": ".$Bewertungsarray[0]['Anzahl']."</p>";
			echo "<p>".$Bewertungsarray[sizeof($Bewertungsarray)-1]['Auswahl'].": ".$Bewertungsarray[sizeof($Bewertungsarray)-1]['Anzahl']."</p>";
			$i++;
		}
		//last 10

		$Average_10 = 0;
		$i=1;
		if($typ=="Singlechoice"){

			$sql_number_of_answers="SELECT COUNT(Answers) FROM singlechoice_answers WHERE ".$Frage." = 1 ORDER BY post_order_no ASC";
			$exec_number_of_answers = mysqli_query($link, $sql_number_of_answers);
			$number_of_answers = mysqli_fetch_array($exec_number_of_answers);
			$range = intval($number_of_answers[0])*0.1;

			$sql="SELECT Answers FROM singlechoice_answers WHERE ".$Frage." = 1 ORDER BY post_order_no ASC";
			$exec = mysqli_query($link, $sql);
			while($row=mysqli_fetch_array($exec))
			{
				if($Trainer=='externes_feedback')
				{
					$sql2 = "SELECT COUNT(".$Frage.") FROM (SELECT * FROM externes_feedback  WHERE ".$Frage." LIKE '%|".$row["Answers"]."|%' ORDER BY Datum DESC LIMIT 10) AS a";
				}
			
				else{
					$sql2 = "SELECT COUNT(".$Frage.") FROM (SELECT * FROM externes_feedback  WHERE ".$Frage." LIKE '%|".$row["Answers"]."|%' AND Username = '".$Trainer."' ORDER BY Datum DESC LIMIT 10) AS a";
				}
			$exec2 = mysqli_query($link, $sql2);
			$row2=mysqli_fetch_array($exec2);
			$Average_10=$Average_10+($i*intval($row2["COUNT(".$Frage.")"]));
			$i =$i+1;
			}
		}
		if($typ=="Singlechoice"||$typ=="Multiplechoice"){
			if($Anzahl_abgegenes_feedback<10 && $Anzahl_abgegenes_feedback>0)
			{
				$Average_10 = $Average_10/$Anzahl_abgegenes_feedback;
			}
			else
			{
				$Average_10 = $Average_10/10;
			}
		}
		if($Trainer=='externes_feedback')
		{
			$query = "SELECT ROUND(AVG(".$Frage."),1) FROM (SELECT * FROM externes_feedback  WHERE ".$Frage." != 'NULL' ORDER BY Datum DESC LIMIT 10) AS a";
		}

		else{
			$query = "SELECT ROUND(AVG(".$Frage."),1) FROM (SELECT * FROM externes_feedback  WHERE Username = '".$Trainer."' AND ".$Frage." != 'NULL' ORDER BY Datum DESC LIMIT 10) AS a";
		}


		$exec = mysqli_query($link,$query);
		$rows = mysqli_fetch_array($exec);

		if($typ=="Singlechoice"){
			$Trend = round($Average_10-$Average,1);
		if($Trend<$range*-1)
		{
			echo"<p style='color:green'>&darr;  ";
			echo $Trend;
			echo" </p>";
		}
		
		else if ($Trend>$range*-1 && $Trend<0){
			echo"<p style='color:lightgreen'>&#x2198;  ";
			echo $Trend;
			echo" </p>";
		}

		else if ($Trend<$range && $Trend>0){
			echo"<p style='color:orange'>&#x2197;  +";
			echo $Trend;
			echo" </p>";
		}

		else if ($Trend==0){
			echo"<p style='color:lightgreen'>&rarr;  ";
			echo $Trend;
			echo" </p>";
		}

		else if ($Trend>=$range){
			echo"<p style='color:red'>&uarr;  +";
			echo $Trend;
			echo" </p>";
		}
	}
	else if($typ=="Schieberegler"){
		$sql_range = "SELECT * FROM rangeslider_answers WHERE Frage_ID = '".$ID."'";
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
	}

	}
	else{
		include "IsAdmincheck.php";
		$exec = mysqli_query($link,$query);
		$row = mysqli_fetch_array($exec);
		echo "<p style='margin-bottom:-20px;'># Bewertungen: ".$row["COUNT(".$Frage.")"]."</p>";
		echo"# Bewertungen: 0";
	}
}
?>