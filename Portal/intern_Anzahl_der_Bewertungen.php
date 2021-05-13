<?php

require_once "session.php";
require_once "../config.php";

$datum_min=$_REQUEST["datum_min"];
$datum_max=$_REQUEST["datum_max"];
$Frage=$_REQUEST["Frage"];
$Frage_ID=substr($Frage,6);

 if($Frage !="undefined"){ //falls noch keine multiplechoice Frage geschrieben wurde
	$query = "SELECT Typ FROM intern WHERE ID=".$Frage_ID;
	$exec = mysqli_query($link,$query);
	$row = mysqli_fetch_array($exec);
	
	if($row["Typ"]=="Singlechoice")
	{
		echo'Singlechoice,';
		$sql="SELECT COUNT(Answers) As Anzahl_Antworten FROM singlechoice_answers WHERE Intern_".$Frage_ID." = 1";
		$result=mysqli_query($link,$sql);
		$rows=mysqli_fetch_array($result);

		$sql_answers="SELECT Answers FROM singlechoice_answers WHERE Intern_".$Frage_ID." = 1 ORDER BY post_order_no ASC";
		$result_answers=mysqli_query($link,$sql_answers);

		$i=1; //Bewertungsmöglichkeiten 1,...,6

 		while($i<=intval($rows["Anzahl_Antworten"])){
			$rows_answers=mysqli_fetch_array($result_answers);
			$query = "SELECT COUNT(".$Frage.") FROM internes_feedback WHERE Datum <= '".$datum_min." 23:59:59' AND Datum >= '".$datum_max." 23:59:59' AND ".$Frage." = '".$rows_answers["Answers"]."'";
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
		$sql="SELECT COUNT(Answers) As Anzahl_Antworten FROM multiplechoice_answers WHERE Intern_".$Frage_ID." = 1";
		$result=mysqli_query($link,$sql);
		$rows=mysqli_fetch_array($result);

		$sql_answers="SELECT Answers FROM multiplechoice_answers WHERE Intern_".$Frage_ID." = 1 ORDER BY post_order_no ASC";
		$result_answers=mysqli_query($link,$sql_answers);

		$i=1; //Bewertungsmöglichkeiten 1,...,6

 		while($i<=intval($rows["Anzahl_Antworten"])){
			$rows_answers=mysqli_fetch_array($result_answers);
			$query = "SELECT COUNT(".$Frage.") FROM internes_feedback WHERE Datum <= '".$datum_min." 23:59:59' AND Datum >= '".$datum_max." 23:59:59' AND ".$Frage." LIKE '%|".$rows_answers["Answers"]."|%'";
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
		$query = "SELECT * FROM rangeslider_answers WHERE Intern_ID = ".$Frage_ID;
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
 		$query = "SELECT * FROM rangeslider_answers WHERE Intern_ID = ".$Frage_ID;
		$exec = mysqli_query($link,$query);
		$rowy = mysqli_fetch_array($exec);
 		while($i<=$rowy["columns"]){
			$query = "SELECT COUNT(".$Frage.") FROM internes_feedback WHERE Datum <= '".$datum_min." 23:59:59' AND Datum >= '".$datum_max." 23:59:59'AND ".$Frage." < ".$feedback_range[$i]." AND ".$Frage." >= ".$feedback_range[$i-1]."";
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