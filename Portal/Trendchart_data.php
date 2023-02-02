<?php

require_once "../config.php";
require_once "session.php";
 $Trainer=$_REQUEST["Trainer"];
 $month_sum=$_REQUEST["month_sum"];
 $datum_min=$_REQUEST["datum_min"];
 $datum_max=$_REQUEST["datum_max"];
 $Leistung=$_REQUEST["Leistung"];

 $Frage=$_REQUEST["Frage"];
 $ID = substr($Frage,6);
 $Month=$_REQUEST["Month"];
 $Frage_ID=substr($Frage,6);

 $query_typ = "SELECT * FROM fragen WHERE ID=".$Frage_ID;
 $exec_typ = mysqli_query($link,$query_typ);
 $row_typ = mysqli_fetch_array($exec_typ);

 $query_max = "SELECT range_max FROM rangeslider_answers WHERE Frage_ID = ".$Frage_ID;
 $exec_max = mysqli_query($link,$query_max);
 $row_max = mysqli_fetch_array($exec_max);

 $sql="SELECT COUNT(".$Frage.") As Anzahl_Feedback FROM kursfeedback WHERE Username LIKE '".$Trainer."'";
 $result_feedback=mysqli_query($link,$sql);
 $rows_feedback=mysqli_fetch_array($result_feedback);

 if($row_typ["Typ"]=="Bewertung")
 {
	 $Typ="bewertung";
 }
 else
 {
	 $Typ="multiplechoice";
 }

 if($rows_feedback["Anzahl_Feedback"]!=0){
	if($row_typ["Typ"]=="Bewertung" || $row_typ["Typ"]=="Multiplechoice"){
		if($row_typ["Typ"]=="Bewertung")
        {
			$sql="SELECT COUNT(Answers) As Anzahl_Antworten FROM ".$Typ."_answers";
        }
        else if($row_typ["Typ"]=="Multiplechoice")
		{
			$sql="SELECT COUNT(Answers) As Anzahl_Antworten FROM ".$Typ."_answers WHERE Fragenspezifisch =  ".$row_typ['ID']." AND ".$Frage." = 1";
        }
		$result_multi=mysqli_query($link,$sql);
		$rows_multi=mysqli_fetch_array($result_multi);
	}

 if($Leistung && $Frage !="undefined"){ //falls noch keine multiplechoice Frage geschrieben wurde
	if($row_typ["Typ"]=="Bewertung" || $row_typ["Typ"]=="Multiplechoice"){
		if($row_typ["Typ"]=="Bewertung")
        {
			$sql="SELECT * FROM ".$Typ."_answers ORDER BY post_order_no ASC";
		}
		if($row_typ["Typ"]=="Multiplechoice")
        {
			$sql="SELECT * FROM ".$Typ."_answers WHERE Fragenspezifisch = ".$row_typ['ID']." AND ".$Frage." = 1 ORDER BY post_order_no ASC";
		}
		$i=1;
		$result=mysqli_query($link,$sql);
		while($row=mysqli_fetch_array($result))
		{
			if($row_typ["Typ"]=="Bewertung")
			echo $i."=".$row["Answers"]."  |  ";
			else
			echo $row["Answers"]."  |  ";
			$i=$i+1;
		}
		echo",";
		echo $row_typ["Typ"].",".$rows_multi["Anzahl_Antworten"].",";
	}

	else if($row_typ["Typ"]=="Schieberegler")
		echo"Mittelwert der Bewertungen,Schieberegler,".$row_max["range_max"].",";
$i=0;
$u=$Month+1;
$feedback_year=substr($datum_max,0,4);

 while ($i<=$month_sum){
	 if($u>12){
		 $u=1;
		 if(substr($datum_min,0,4)!=substr($datum_max,0,4))
		 $feedback_year=$feedback_year+1;
	 } 
	
	if($row_typ["Typ"]=="Bewertung")
	{
		$query = "SELECT COUNT(".$Frage.") FROM kursfeedback WHERE Datum <= '".$datum_min." 23:59:59' AND Datum >= '".$datum_max." 00:00:00'AND MONTH(Datum) = ".$u." AND YEAR(Datum) = ".$feedback_year." AND Leistung LIKE '".$Leistung."' AND Username LIKE '".$Trainer."'";
		$exec = mysqli_query($link, $query);
		$row=mysqli_fetch_assoc($exec);
		$Anzahl_abgegenes_feedback=0;
		$Average = 0;
		$g=1;
        $sql = "SELECT * FROM bewertung_answers ORDER BY post_order_no ASC";

		$exec = mysqli_query($link, $sql);
		while($row=mysqli_fetch_array($exec))
		{
			$sql2 = "SELECT COUNT(".$Frage.") FROM kursfeedback WHERE Datum <= '".$datum_min." 23:59:59' AND Datum >= '".$datum_max." 00:00:00' AND MONTH(Datum) = ".$u." AND YEAR(Datum) = ".$feedback_year." AND Leistung LIKE '".$Leistung."' AND ".$Frage." LIKE '%|".$row["Answers"]."|%' AND Username LIKE '".$Trainer."'";
			$exec2 = mysqli_query($link, $sql2);
			$row2=mysqli_fetch_array($exec2);
			$Anzahl_abgegenes_feedback=$Anzahl_abgegenes_feedback+$row2["COUNT(".$Frage.")"];
			$Average=$Average+($g*intval($row2["COUNT(".$Frage.")"]));
			$g =$g+1;
		}
		
		if($Anzahl_abgegenes_feedback==0)
		{
			$Average = 0;
		}
		else
		{
			$Average = $Average/$Anzahl_abgegenes_feedback;
		}
		$exec = mysqli_query($link,$sql2);

		while($row = mysqli_fetch_array($exec)){
			if($month_sum==0){
				echo",";
			}
			echo round($Average,2).",";
			if($month_sum==0){
					echo",";
			}
		}
	}

	else if($row_typ["Typ"]=="Multiplechoice")
	{
		$query = "SELECT COUNT(".$Frage.") FROM kursfeedback WHERE Datum <= '".$datum_min." 23:59:59' AND Datum >= '".$datum_max." 00:00:00'AND MONTH(Datum) = ".$u." AND YEAR(Datum) = ".$feedback_year." AND Leistung LIKE '".$Leistung."' AND Username LIKE '".$Trainer."'";	
		$exec = mysqli_query($link, $query);
		$row=mysqli_fetch_assoc($exec);
		$Anzahl_abgegenes_feedback=0;
		$Average = array();
		$g=1;
        $sql = "SELECT * FROM multiplechoice_answers WHERE Fragenspezifisch = ".$row_typ['ID']." AND ".$Frage." = '1' ORDER BY post_order_no ASC";	
		$exec = mysqli_query($link, $sql);
		while($row=mysqli_fetch_array($exec))
		{
			$sql2 = "SELECT COUNT(".$Frage.") FROM kursfeedback WHERE Datum <= '".$datum_min." 23:59:59' AND Datum >= '".$datum_max." 00:00:00' AND MONTH(Datum) = ".$u." AND YEAR(Datum) = ".$feedback_year." AND Leistung LIKE '".$Leistung."' AND ".$Frage." LIKE '%|".$row["Answers"]."|%' AND Username LIKE '".$Trainer."'";
			$exec2 = mysqli_query($link, $sql2);
			$row2=mysqli_fetch_array($exec2);
			$Anzahl_abgegenes_feedback=$Anzahl_abgegenes_feedback+$row2["COUNT(".$Frage.")"];
			array_push($Average,$row2["COUNT(".$Frage.")"]);
			$g =$g+1;
		}
		
		$exec = mysqli_query($link,$sql2);
		$x=0;
		do{
				if($month_sum==0){
					echo",";
				}
				echo $Average[$x].",";
				if($month_sum==0){
						echo",;,";
				}
			$x = $x+1;
		}while($x<$g-1);
		echo";,";
	}

	else
	{
	$query = "SELECT AVG(".$Frage.") FROM kursfeedback WHERE Datum <= '".$datum_min." 23:59:59' AND Datum >= '".$datum_max." 00:00:00' AND MONTH(Datum) = ".$u." AND YEAR(Datum) = ".$feedback_year." AND Leistung LIKE '".$Leistung."' AND Username LIKE '".$Trainer."'";
	$exec = mysqli_query($link,$query);

	while($row = mysqli_fetch_array($exec)){
		if($month_sum==0){
			echo",";
		}
		echo $row["AVG(".$Frage.")"].",";
		if($month_sum==0){
				echo",";
		}

	}
	}
	$i=$i+1;
	$u=$u+1;
}
} 
 }
else{
	echo"nomultiplechoice";
}
	

?>