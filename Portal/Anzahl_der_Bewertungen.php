<?php

include "IsAdmincheck.php";

 $datum_min=$_REQUEST["datum_min"];
 $datum_max=$_REQUEST["datum_max"];
 $Leistung=$_REQUEST["Leistung"];
 $Frage=$_REQUEST["Frage"];
 $Frage_ID=substr($Frage,6);
 $Trainer=$_REQUEST["Trainer"];


 if($Leistung && $Frage !="undefined"){ //falls noch keine multiplechoice Frage geschrieben wurde
	$query = "SELECT * FROM fragen WHERE ID=".$Frage_ID;
	$exec = mysqli_query($link,$query);
	$row = mysqli_fetch_array($exec);
	
	if($row["Typ"]=="Bewertung" || $row["Typ"]=="Multiplechoice")
	{
		if($row["Typ"]=="Bewertung")
		{
			$Typ="bewertung";
			$sql="SELECT COUNT(Answers) As Anzahl_Antworten FROM ".$Typ."_answers WHERE ".$Frage." = 1";
		}
		else
		{
			$Typ="multiplechoice";
			$sql="SELECT COUNT(Answers) As Anzahl_Antworten FROM ".$Typ."_answers WHERE Fragenspezifisch =  ".$row['ID']." AND ".$Frage." = 1";
		}
		echo $row["Typ"].',';
	
		$result=mysqli_query($link,$sql);
		$rows=mysqli_fetch_array($result);

		if($row["Typ"]=="Bewertung")
        {
            $sql_answers = "SELECT * FROM ".$Typ."_answers ORDER BY post_order_no ASC";
        }
        else{
            $sql_answers = "SELECT * FROM ".$Typ."_answers WHERE Fragenspezifisch = ".$row['ID']." AND Frage_".$Frage_ID." = '1' ORDER BY post_order_no ASC";
        }		
		$result_answers=mysqli_query($link,$sql_answers);

		$i=1; //Bewertungsmöglichkeiten 1,...,6

 		while($i<=intval($rows["Anzahl_Antworten"])){
			$rows_answers=mysqli_fetch_array($result_answers);
				$query = "SELECT COUNT(".$Frage.") FROM kursfeedback WHERE Datum <= '".$datum_min." 23:59:59' AND Datum >= '".$datum_max." 00:00:00'AND Leistung LIKE '".$Leistung."' AND ".$Frage." LIKE '%|".$rows_answers["Answers"]."|%' AND Username LIKE '".$Trainer."'";
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
				$query = "SELECT COUNT(".$Frage.") FROM kursfeedback WHERE Datum <= '".$datum_min." 23:59:59' AND Datum >= '".$datum_max." 00:00:00' AND Leistung LIKE '".$Leistung."' AND ".$Frage." < ".$feedback_range[$i]." AND ".$Frage." >= ".$feedback_range[$i-1]." AND Username LIKE '".$Trainer."'";
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