<?php

include "IsAdmincheck.php";

 $datum_min=$_REQUEST["datum_min"];
 $datum_max=$_REQUEST["datum_max"];
 $Leistung=$_REQUEST["Leistung"];
 $Trainer=$_REQUEST["Trainer"];


 if($Leistung!="undefined"){ //falls noch keine multiplechoice Frage geschrieben wurde
		echo"Bewertung,";
		$sql="SELECT COUNT(Answers) As Anzahl_Antworten FROM bewertung_answers";
		$result=mysqli_query($link,$sql);
		$rows=mysqli_fetch_array($result);
		
		$sql_answers = "SELECT * FROM bewertung_answers ORDER BY post_order_no ASC";
		$i=0;
		$SummeZuAntwortmöglichkeit = array();
		while ($i<intval($rows["Anzahl_Antworten"])) 
		{
			array_push($SummeZuAntwortmöglichkeit,0);
			$i=$i+1;
		}
		$i=0;
		$sql_fragenid="SELECT ID FROM admin WHERE Typ = 'Bewertung'";
		$result_fragenid=mysqli_query($link,$sql_fragenid);
		while ($rows_fragenid=mysqli_fetch_array($result_fragenid)) 
		{
			$result_answers=mysqli_query($link,$sql_answers);
			$i=0;
			while ($i<intval($rows["Anzahl_Antworten"])) {
				$rows_answers=mysqli_fetch_array($result_answers);
				$query = "SELECT COUNT(Frage_".$rows_fragenid["ID"].") FROM externes_feedback WHERE Datum <= '".$datum_min." 23:59:59' AND Datum >= '".$datum_max." 00:00:00'AND Leistung LIKE '".$Leistung."' AND Frage_".$rows_fragenid["ID"]." LIKE '%|".$rows_answers["Answers"]."|%' AND Username LIKE '".$Trainer."'";
				$exec = mysqli_query($link, $query);

				while ($row = mysqli_fetch_array($exec)) {
					$SummeZuAntwortmöglichkeit[$i]=$SummeZuAntwortmöglichkeit[$i]+intval($row["COUNT(Frage_".$rows_fragenid["ID"].")"]);
				}

				$i=$i+1;
			}
		}
		foreach($SummeZuAntwortmöglichkeit as $value){
			echo $value.",";
		}
	}
else{
	echo"nomultiplechoice";
}
?>