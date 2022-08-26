<?php

require_once "../config.php";
require_once "session.php";

$sql = "SELECT Is_Admin FROM users WHERE username ='".$_SESSION["username"]."'";
$exec = mysqli_query($link,$sql);
$row = mysqli_fetch_assoc($exec);
$IsAdmin = $row["Is_Admin"];

 $Umfrage=$_REQUEST["Umfrage"];
 $datum_min=$_REQUEST["datum_min"];
 $datum_max=$_REQUEST["datum_max"];
 $Zeitraum = $_REQUEST["Zeitraum"];
 if($Zeitraum != "Benutzerdefiniert")
 {
	 $datum_min = date("Y-m-d");
	 $datum_max = date('Y-m-d', strtotime("-".$Zeitraum));
 }

$query = "SELECT * FROM internes_feedback WHERE Datum <= '".$datum_min." 23:59:59' AND Datum >= '".$datum_max." 23:59:59' AND Umfrage LIKE '".$Umfrage."' ORDER BY Datum DESC LIMIT ".$_POST["start"].", ".$_POST["limit"]."";

 $exec = mysqli_query($link,$query);
 $i=0;
 $feedback_index = 1; //welches feedback ist gerade dran
while($row = mysqli_fetch_array($exec)){
	$sql_test = "SELECT Umfrage from umfragen WHERE ID = ".$row['Umfrage'];
	$exec_test = mysqli_query($link,$sql_test);
	$leistung_titel = mysqli_fetch_array($exec_test); 
	 echo $leistung_titel['Umfrage']."  ";
	 echo $row['Datum'];
	 if($IsAdmin==1)
	 {
	 	echo '<i class="fa fa-trash" onclick="deleteFeedback('.$row['ID'].')" style="cursor:pointer;"></i>';
	 }
	 $chapter = "";
	 echo'<form style="padding:5px; padding-bottom:15px; margin-top:40px; margin-bottom:40px;">';

	//Hole zuerst die ID der Umfrage die beurteilt wurde
	$row_ID = $row['Umfrage'];

	$query = "SELECT * FROM intern WHERE Umfrage_".$row_ID." = 1 ORDER BY post_order_no ASC";	

 	$execute = mysqli_query($link,$query);
 	$execute_chapter = mysqli_query($link,$query);
 	$chapter="";
	$fragen_index = 1; //welche Frage im Feedback ist dran

	while($row_questions = mysqli_fetch_array($execute)){
		echo'<div id="formular_div_'.$feedback_index.$fragen_index.$_POST["start"].'" class="grid-container" style="padding:0px; margin:0px;">';

		if ($row_questions["Typ"]=="Bewertung"){
			$option_index=1;
			$sql="SELECT * FROM bewertung_answers WHERE Intern_".$row_questions["ID"]." = 1 ORDER BY post_order_no ASC";
			$result = mysqli_query($link,$sql);
			$gridcolumns = "25% 2fr ";
			$sql_answers="SELECT Answers FROM bewertung_answers WHERE Intern_".$row_questions["ID"]." = 1 ORDER BY post_order_no ASC";
			$exec_answers=mysqli_query($link,$sql_answers);
			$option_index=1;
			echo'
			<div class="frage" style="grid-row-end: span 2">'.$row_questions["Fragen_intern"].'</div>';
			while($row_answers=mysqli_fetch_array($result)){
				echo"<script>document.getElementById('formular_div_".$feedback_index.$fragen_index.$_POST["start"]."').style.gridTemplateColumns = '".$gridcolumns."'</script>";
				echo'
				<div class="choice" for="element_1_'.$option_index.'">'.$row_answers["Answers"].'</div>';
				$gridcolumns = $gridcolumns." 2fr";
				$option_index=$option_index+1;
			 }
			while($rows_answers = mysqli_fetch_assoc($exec_answers)){
					echo'
					<div class="choice"><input id="element_1_'.$option_index.'" name="element_'.$i.'" type="radio" value="'.$option_index.'"'; 
					if($row["Frage_".$row_questions["ID"]]=="|".$rows_answers["Answers"]."|")
						{echo 'checked';}
					echo'></div>';	
				$option_index=$option_index+1;
			}
			//if($rows_answers["Answers"]=='NULL')
			//{
				//echo"<script>var elem = document.getElementById('formular_div_".$feedback_index.$fragen_index.$_POST["start"]."'); elem.remove();</script>";
			//}
			$i=$i+1;
		}

		else if ($row_questions["Typ"]=="Multiplechoice"){
			$option_index=1;
			$sql="SELECT * FROM multiplechoice_answers WHERE Intern_".$row_questions["ID"]." = 1 ORDER BY post_order_no ASC";
			$result = mysqli_query($link,$sql);
			$gridcolumns = "25% 2fr ";
			$sql_answers="SELECT Answers FROM multiplechoice_answers WHERE Intern_".$row_questions["ID"]." = 1 ORDER BY post_order_no ASC";
			$exec_answers=mysqli_query($link,$sql_answers);
			$option_index=1;
			echo'
			<div class="frage" style="grid-row-end: span 2">'.$row_questions["Fragen_intern"].'</div>';
			while($row_answers=mysqli_fetch_array($result)){
				echo"<script>document.getElementById('formular_div_".$feedback_index.$fragen_index.$_POST["start"]."').style.gridTemplateColumns = '".$gridcolumns."'</script>";
				echo'
				<div class="choice" for="element_1_'.$option_index.'">'.$row_answers["Answers"].'</div>';
				$gridcolumns = $gridcolumns." 2fr";
				$option_index=$option_index+1;
			 }
			while($rows_answers = mysqli_fetch_assoc($exec_answers)){
					echo'
					<div class="choice"><input name="element[]" type="checkbox" value="'.$option_index.'"'; 
					if(strpos($row["Frage_".$row_questions["ID"]],"|".$rows_answers["Answers"]."|")!==false)
						{echo 'checked';}
					echo'></div>';

				$option_index=$option_index+1;
			}
			//if($rows_answers["Answers"]=='NULL')
			//{
				//echo"<script>var elem = document.getElementById('formular_div_".$feedback_index.$fragen_index.$_POST["start"]."'); elem.remove();</script>";
			//}
			$i=$i+1;
		}

	else if($row_questions["Typ"]=="Schieberegler"){
		$sql_range="SELECT * FROM rangeslider_answers WHERE Intern_ID = ".$row_questions["ID"];
		$result_range = mysqli_query($link,$sql_range);
		$row_range=mysqli_fetch_array($result_range);
		echo"<script>document.getElementById('formular_div_".$feedback_index.$fragen_index.$_POST["start"]."').style.gridTemplateColumns = '25% 4fr'</script>";
		echo
		'<div class="frage"><p>'.$row_questions["Fragen_intern"].'</div>
		<div style="border: 1px solid #000; grid-column-start: 2; grid-column-end: -1; display: grid; grid-template-columns: auto auto auto auto auto;">
		<div style="margin:auto;">Bewertung: '.$row["Frage_".$row_questions["ID"]].'</div>
		<input type="range" id="range_'.$row["ID"].'" style="width:80%; grid-column-start: 2; grid-column-end: -1; margin:auto;" value='.$row["Frage_".$row_questions["ID"]].' min='.$row_range['range_min'].' max='.$row_range['range_max'].' name="element_1" wrap="soft"></input>
		</div>
		<script>function color(i) 
		{ 
			var slider = document.getElementById("range_"+i)
			var value = (slider.value-slider.min)/(slider.max-slider.min)*100
			var value2 = value-10
			var temp =  (slider.value-slider.min)*(100/(slider.max-slider.min));
			var color =  "hsl("+temp+", 100%, 50%) ";
			var color2 =  "#82CFD0 ";
			slider.style.background = "linear-gradient(to right, "+color+"0%, "+color + value2 + "%, "+color+value2+"%, "+color2 + value + "%, #fff " + value + "%, white 100%)"
		}
		color('.$row["ID"].');
		</script>';
		if($row["Frage_".$row_questions["ID"]]==NULL)
		{
			echo"<script>var elem = document.getElementById('formular_div_".$feedback_index.$fragen_index.$_POST["start"]."'); elem.remove();</script>";
		}

	}

	else{
		echo"<script>document.getElementById('formular_div_".$feedback_index.$fragen_index.$_POST["start"]."').style.gridTemplateColumns = '25% 4fr'</script>";
		echo	
		'<div class="frage"><p>'.$row_questions["Fragen_intern"].'</div>
		<textarea class="frage_text" name="element_1" cols="50" rows="3" maxlength="1000" wrap="soft">'.$row["Frage_".$row_questions["ID"]].'</textarea>';
		if($row["Frage_".$row_questions["ID"]]=='NULL')
		{
			echo"<script>var elem = document.getElementById('formular_div_".$feedback_index.$fragen_index.$_POST["start"]."'); elem.remove();</script>";
		}
	}
//wird benötigt um das vorherige Kapitel zu bestimmen um dann nur Kapitel zu schreiben wenn das vorige nicht das jetzige Kapitel ist

echo"</div>";
$fragen_index=$fragen_index+1;
 }
echo '</div>
</form>
<hr>';
$i=$i+1;
$feedback_index = $feedback_index+1;
}

?>
