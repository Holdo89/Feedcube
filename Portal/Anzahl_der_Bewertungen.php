<?php

include "IsAdmincheck.php";

 $datum_min=$_REQUEST["datum_min"];
 $datum_max=$_REQUEST["datum_max"];
 $Leistung=$_REQUEST["Leistung"];
 $Frage=$_REQUEST["Frage"];
 $Frage_ID=substr($Frage,6);

 if($Leistung && $Frage !="undefined"){ //falls noch keine multiplechoice Frage geschrieben wurde
	$query = "SELECT Typ FROM admin WHERE ID=".$Frage_ID;
	$exec = mysqli_query($link,$query);
	$row = mysqli_fetch_array($exec);
	
	if($row["Typ"]=="Singlechoice")
	{
		echo'Singlechoice,';
		$sql="SELECT COUNT(Answers) As Anzahl_Antworten FROM singlechoice_answers WHERE ".$Frage." = 1";
		$result=mysqli_query($link,$sql);
		$rows=mysqli_fetch_array($result);

		$sql_answers="SELECT Answers FROM singlechoice_answers WHERE ".$Frage." = 1 ORDER BY post_order_no ASC";
		$result_answers=mysqli_query($link,$sql_answers);

		$i=1; //Bewertungsmöglichkeiten 1,...,6

 		while($i<=intval($rows["Anzahl_Antworten"])){
			$rows_answers=mysqli_fetch_array($result_answers);
			if($Trainer=='externes_feedback')

			{
				$query = "SELECT COUNT(".$Frage.") FROM externes_feedback WHERE Datum <= '".$datum_min." 23:59:59' AND Datum >= '".$datum_max." 23:59:59'AND Leistung LIKE '".$Leistung."' AND ".$Frage." LIKE '%|".$rows_answers["Answers"]."|%'";
			}

			else{
				$query = "SELECT COUNT(".$Frage.") FROM externes_feedback WHERE Datum <= '".$datum_min." 23:59:59' AND Datum >= '".$datum_max." 23:59:59'AND Leistung LIKE '".$Leistung."' AND ".$Frage." LIKE '%|".$rows_answers["Answers"]."|%' AND Username = '".$Trainer."'";
			}
			$exec = mysqli_query($link,$query);

			while($row = mysqli_fetch_array($exec)){

				echo $row["COUNT(".$Frage.")"].",";
			}

			$i=$i+1;
 		}
	}

	else if($row["Typ"]=="Multiplechoice")
	{
		echo'Multiplechoice,';
		$sql="SELECT COUNT(Answers) As Anzahl_Antworten FROM multiplechoice_answers WHERE ".$Frage." = 1";
		$result=mysqli_query($link,$sql);
		$rows=mysqli_fetch_array($result);

		$sql_answers="SELECT Answers FROM multiplechoice_answers WHERE ".$Frage." = 1 ORDER BY post_order_no ASC";
		$result_answers=mysqli_query($link,$sql_answers);

		$i=1; //Bewertungsmöglichkeiten 1,...,6

 		while($i<=intval($rows["Anzahl_Antworten"])){
			$rows_answers=mysqli_fetch_array($result_answers);
			if($Trainer=='externes_feedback')

			{
				$query = "SELECT COUNT(".$Frage.") FROM externes_feedback WHERE Datum <= '".$datum_min." 23:59:59' AND Datum >= '".$datum_max." 23:59:59'AND Leistung LIKE '".$Leistung."' AND ".$Frage." LIKE '%|".$rows_answers["Answers"]."|%'";
			}

			else{
				$query = "SELECT COUNT(".$Frage.") FROM externes_feedback WHERE Datum <= '".$datum_min." 23:59:59' AND Datum >= '".$datum_max." 23:59:59'AND Leistung LIKE '".$Leistung."' AND ".$Frage." LIKE '%|".$rows_answers["Answers"]."|%' AND Username = '".$Trainer."'";
			}
			$exec = mysqli_query($link,$query);

			while($row = mysqli_fetch_array($exec)){

				echo $row["COUNT(".$Frage.")"].",";
			}

			$i=$i+1;
 		}
	}

	else if($row["Typ"]=="Schieberegler")
 	{
		echo'Schieberegler,';
		$query = "SELECT * FROM rangeslider_answers WHERE Frage_ID = ".$Frage_ID;
		$exec = mysqli_query($link,$query);
		$row = mysqli_fetch_array($exec);
		$i=0;
		$feedback_range=array();
		while($i<=$row["columns"]){
			 $feedback_range[$i]=$i*$row["range_max"]/$row["columns"];
			 if($i!=0 && $i!=$row["columns"]){
			 	$feedbackrange2=$feedback_range[$i]-1;
			 	echo $feedback_range[$i-1]."-".$feedbackrange2.";";
			 }
			 else if($i==$row["columns"]){
			 	echo $feedback_range[$i-1]."-".$feedback_range[$i].",";
				 $feedback_range[$i]=$feedback_range[$i]+1;
			 }
			 $i=$i+1;
		}
 		$i=1; //Bewertungsmöglichkeiten 0,...,4
 		$query = "SELECT * FROM rangeslider_answers WHERE Frage_ID = ".$Frage_ID;
		$exec = mysqli_query($link,$query);
		$rowy = mysqli_fetch_array($exec);
 		while($i<=$rowy["columns"]){
			if($Trainer=='externes_feedback')
			{	
				$query = "SELECT COUNT(".$Frage.") FROM externes_feedback WHERE Datum <= '".$datum_min." 23:59:59' AND Datum >= '".$datum_max." 23:59:59' AND Leistung LIKE '".$Leistung."' AND ".$Frage." < ".$feedback_range[$i]." AND ".$Frage." >= ".$feedback_range[$i-1]."";
			}
			else
			{
				$query = "SELECT COUNT(".$Frage.") FROM externes_feedback WHERE Datum <= '".$datum_min." 23:59:59' AND Datum >= '".$datum_max." 23:59:59' AND Leistung LIKE '".$Leistung."' AND ".$Frage." < ".$feedback_range[$i]." AND ".$Frage." >= ".$feedback_range[$i-1]." AND Username = '".$Trainer."'";
			}
			$exec = mysqli_query($link,$query);

			while($row = mysqli_fetch_array($exec))
			{
				echo $row["COUNT(".$Frage.")"].",";
			}
				$i=$i+1;
		}

 }
 } 
else{
	echo"nomultiplechoice";
}
?>