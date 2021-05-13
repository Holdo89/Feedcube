<?php
require_once "config.php";
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

	$query = "SELECT COUNT(".$Frage.") FROM internes_feedback WHERE Datum <= '".$datum_min." 23:59:59' AND Datum >= '".$datum_max." 23:59:59'";
	$exec = mysqli_query($link, $query);
	$row=mysqli_fetch_assoc($exec);
	//hole die Anzahl an abgegebenen Feedback
	$sql_get_Anzahl_abgegebenes_feedback = "SELECT COUNT(".$Frage.") FROM internes_feedback WHERE Datum <= '".$datum_min." 23:59:59' AND Datum >= '".$datum_max." 23:59:59' AND ".$Frage." != 'NULL'";
	$query_get_Anzahl_abgegebenes_feedback = mysqli_query($link, $sql_get_Anzahl_abgegebenes_feedback);
	$Anzahl_abgegenes_feedback_row=mysqli_fetch_array($query_get_Anzahl_abgegebenes_feedback);
	$Anzahl_abgegenes_feedback = $Anzahl_abgegenes_feedback_row["COUNT(".$Frage.")"];
    $Average = 0;
	$i=1;
	if($typ=="Singlechoice"){
		$sql="SELECT Answers FROM singlechoice_answers WHERE Intern_".$ID." = 1 ORDER BY post_order_no ASC";
		$exec = mysqli_query($link, $sql);
		while($row=mysqli_fetch_array($exec))
		{
		$sql2 = "SELECT COUNT(".$Frage.") FROM internes_feedback WHERE Datum <= '".$datum_min." 23:59:59' AND Datum >= '".$datum_max." 23:59:59' AND ".$Frage." = '".$row["Answers"]."'";
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


	$query = "SELECT ROUND(AVG(".$Frage."),1) FROM internes_feedback WHERE Datum <= '".$datum_min." 23:59:59' AND Datum >= '".$datum_max." 23:59:59'";
	$exec = mysqli_query($link,$query);
	$rowx = mysqli_fetch_array($exec);

	if($typ=="Singlechoice"){
    	echo "<p style='font-size:25px;'>&empty; Total: ".round($Average,1)."</p>";
	}
	else if($typ=="Multiplechoice"){
		echo "<p style='color:#99f19e; margin-top:-20px;margin-bottom:20px;'># Bewertungen: ".$Anzahl_abgegenes_feedback."</p>";
		$sql="SELECT Answers FROM multiplechoice_answers WHERE ".$Frage_multi." = 1 ORDER BY post_order_no ASC";
		$exec = mysqli_query($link, $sql);
		while($row=mysqli_fetch_array($exec))
		{
		$sql2 = "SELECT COUNT(".$Frage.") FROM internes_feedback WHERE Datum <= '".$datum_min." 23:59:59' AND Datum >= '".$datum_max." 23:59:59' AND ".$Frage." LIKE '%|".$row["Answers"]."|%'";
		$exec2 = mysqli_query($link, $sql2);
		$row2=mysqli_fetch_array($exec2);
		echo "<p>".$row["Answers"].": ".$row2["COUNT(".$Frage.")"]."</p>";
		}
	}
	else{
		echo "<p style='font-size:25px;'>&empty; Total: ".$rowx["ROUND(AVG(".$Frage."),1)"]."</p>";
	}

	//last 10

    $Average_10 = 0;
	$i=1;
	if($typ=="Singlechoice"){
		$sql="SELECT Answers FROM singlechoice_answers WHERE Intern_".$ID." = 1 ORDER BY post_order_no ASC";
		$exec = mysqli_query($link, $sql);
		while($row=mysqli_fetch_array($exec))
		{
		$sql2 = "SELECT COUNT(".$Frage.") FROM (SELECT * FROM internes_feedback LIMIT 10) AS a WHERE Datum <= '".$datum_min." 23:59:59' AND Datum >= '".$datum_max." 23:59:59' AND ".$Frage." = '".$row["Answers"]."'";
		$exec2 = mysqli_query($link, $sql2);
		$row2=mysqli_fetch_array($exec2);
		$Average_10=$Average_10+($i*intval($row2["COUNT(".$Frage.")"]));
		$i =$i+1;
		}
	}
	if($typ=="Singlechoice" || $typ=="Multiplechoice"){
		if($Anzahl_abgegenes_feedback<10)
		{
			$Average_10 = $Average_10/$Anzahl_abgegenes_feedback;
		}
		else
		{
			$Average_10 = $Average_10/10;
		}
	}
	$query = "SELECT ROUND(AVG(".$Frage."),1) FROM internes_feedback WHERE Datum <= '".$datum_min." 23:59:59' AND Datum >= '".$datum_max." 23:59:59'";
	$exec = mysqli_query($link,$query);
	$rows = mysqli_fetch_array($exec);

	if($typ=="Singlechoice"){
    	echo "<p>&empty; letzten 10 Bewertungen: ".round($Average_10,1)."</p>";
	}
else if($typ=="Schieberegler"){
		echo "<p>&empty; letzten 10 Bewertungen: ".$rows["ROUND(AVG(".$Frage."),1)"]."</p>";
	}
	if($typ=="Singlechoice"){
		$Trend = round($Average_10-$Average,1);
	if ($Trend==0){
        echo"<p style='color:#99f19e'>&rarr; Trend: ";
        echo $Trend;
        echo" </p>";
    }

    else if ($Trend>0){
        echo"<p style='color:#99f19e'>&#x2197; Trend: +";
        echo $Trend;
        echo" </p>";
    }

    else
    {
        echo"<p style='color:#f12202'>&#x2198; Trend: ";
        echo $Trend;
        echo" </p>";
    }
	echo "<p style='margin-bottom:-20px;'># Bewertungen: ".$Anzahl_abgegenes_feedback."</p>";
}
else if($typ=="Schieberegler"){
    if ($rowx["ROUND(AVG(".$Frage."),1)"]-$rows["ROUND(AVG(".$Frage."),1)"]==0){
        echo"<p style='color:#99f19e'>&rarr; Trend: ";
        echo $rowx["ROUND(AVG(".$Frage."),1)"]-$rows["ROUND(AVG(".$Frage."),1)"];
        echo" </p>";
    }

    else if (($rows["ROUND(AVG(".$Frage."),1)"]-$rowx["ROUND(AVG(".$Frage."),1)"])>0){
        echo"<p style='color:#99f19e'>&#x2197; Trend: +";
        echo $rows["ROUND(AVG(".$Frage."),1)"]-$rowx["ROUND(AVG(".$Frage."),1)"];
        echo" </p>";
    }

    else
    {
        echo"<p style='color:#f12202'>&#x2198; Trend: ";
        echo $rowx["ROUND(AVG(".$Frage."),1)"]-$rows["ROUND(AVG(".$Frage."),1)"];
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