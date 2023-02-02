<?php

require_once "../config.php";
require_once "session.php";

$sql = "SELECT Is_Admin FROM users WHERE username ='".$_SESSION["username"]."'";
$exec = mysqli_query($link,$sql);
$row = mysqli_fetch_assoc($exec);
$IsAdmin = $row["Is_Admin"];
$Scrollcounter = intval($_REQUEST["Scrollcounter"]);

 $Umfrage=$_REQUEST["Umfrage"];
 $datum_min=$_REQUEST["datum_min"];
 $datum_max=$_REQUEST["datum_max"];
 $start=$_REQUEST["start"];
 $limit=$_REQUEST["limit"];


$query = "SELECT * FROM internes_feedback WHERE Datum <= '".$datum_min." 23:59:59' AND Datum >= '".$datum_max." 00:00:00' AND Umfrage LIKE '".$Umfrage."' ORDER BY Datum DESC LIMIT ".$start.", ".$limit."";

 $exec = mysqli_query($link,$query);
 $i=0;
 $feedback_index = 1; //welches feedback ist gerade dran
while($row = mysqli_fetch_array($exec)){
	echo'<div id="feedback_'.$feedback_index.'" style="padding:5px; border:none; padding-bottom:15px; margin:auto; margin-top:10px; margin-bottom:15px; width:95%;">';
	$sql_test = "SELECT Umfrage from umfragen WHERE ID = ".$row['Umfrage'];
	$exec_test = mysqli_query($link,$sql_test);
	$leistung_titel = mysqli_fetch_array($exec_test); 

	 if($IsAdmin==1)
	 {
		echo ' <i class="fa fa-trash" onclick="deleteFeedback('.$row['ID'].')" style="cursor:pointer; float:right; font-size:20px"></i>
	           <i class="fa fa-file-pdf" onclick="createPdfeinzeln(\''.$feedback_index.'\')" style="cursor:pointer; float:right; margin-right:10px; color:#ad0b00; font-size:20px"></i>';
	}
	 echo "</p>";
	 $chapter = "";

	//Hole zuerst die ID der Umfrage die beurteilt wurde
	$row_ID = $row['Umfrage'];

	$query = "SELECT * FROM intern WHERE Umfrage_".$row_ID." = 1 ORDER BY post_order_no ASC";	

 	$execute = mysqli_query($link,$query);
 	$execute_chapter = mysqli_query($link,$query);
 	$chapter="";
	$fragen_index = 1; //welche Frage im Feedback ist dran

	while($row_questions = mysqli_fetch_array($execute)){
		echo'<div name="pdf">';
		if($fragen_index==1){
			echo "<p style='margin-top:20px'>".$leistung_titel['Umfrage']."</p><p>";
			echo $row['Datum'];
			echo "</p>";
		}
		echo'<div id="formular_div_'.$Scrollcounter."_".$feedback_index."_".$fragen_index."_".$start.'" class="grid-container" style="padding:0px; margin:0px; overflow:auto;';
		if ($fragen_index==1) {
			echo'border-top:1px solid black">';
		}
		else
		{
			echo'">';
		}


		if ($row_questions["Typ"]=="Bewertung"){

			$sql="SELECT Answers FROM bewertung_answers ORDER BY post_order_no ASC";		
			$result = mysqli_query($link,$sql);
			$gridcolumns = "25% 2fr ";
			$exec_answers=mysqli_query($link,$sql);

			echo'
			<div class="frage" style="grid-row-end: span 2">'.$row_questions["Fragen_intern"].'</div>';
			while($row_answers=mysqli_fetch_array($result)){
				echo"<script>document.getElementById('formular_div_".$Scrollcounter."_".$feedback_index."_".$fragen_index."_".$start."').style.gridTemplateColumns = '".$gridcolumns."'</script>";
				echo'
				<div class="choice" style="border-bottom:none; margin-bottom:-10px" for="element_'.$Scrollcounter.'_'.$i.'">'.$row_answers["Answers"].'</div>';
				$gridcolumns = $gridcolumns." 2fr";
			 }
			while($rows_answers = mysqli_fetch_assoc($exec_answers)){
					echo'
					<div class="choice"><input name="element_'.$Scrollcounter.'_'.$i.'" type="radio"'; 
					if($row["Frage_".$row_questions["ID"]]=="|".$rows_answers["Answers"]."|")
						{echo 'checked';}
					echo'></div>';	
			}
			$i=$i+1;
		}

		else if ($row_questions["Typ"]=="Multiplechoice"){
			$sql="SELECT Answers FROM multiplechoice_answers WHERE Intern_".$row_questions["ID"]." = 1 AND Fragenspezifisch = ".$row_questions["ID"]." ORDER BY post_order_no ASC";
			$option_index=1;
			$result = mysqli_query($link,$sql);
			$gridcolumns = "25% 2fr ";
			$exec_answers=mysqli_query($link,$sql);
			echo'
			<div class="frage" style="grid-row-end: span 2">'.$row_questions["Fragen_intern"].'</div>';
			while($row_answers=mysqli_fetch_array($result)){
				echo"<script>document.getElementById('formular_div_".$Scrollcounter."_".$feedback_index."_".$fragen_index."_".$start."').style.gridTemplateColumns = '".$gridcolumns."'</script>";
				echo'
				<div class="choice" style="border-bottom:none; margin-bottom:-20px" for="element_1_'.$option_index.'">'.$row_answers["Answers"].'</div>';
				$gridcolumns = $gridcolumns." 2fr";
				$option_index=$option_index+1;
			 }
			while($rows_answers = mysqli_fetch_assoc($exec_answers)){
					echo'
					<div class="choice" style="background: rgba(1, 1, 1, 0)"><input name="element[]" type="checkbox" value="'.$option_index.'"'; 
					if(strpos($row["Frage_".$row_questions["ID"]],"|".$rows_answers["Answers"]."|")!==false)
						{echo 'checked';}
					echo'></div>';

				$option_index=$option_index+1;
			}
			//if($rows_answers["Answers"]=='NULL')
			//{
				//echo"<script>var elem = document.getElementById('formular_div_".$feedback_index.$fragen_index.$start."'); elem.remove();</script>";
			//}
			$i=$i+1;
		}

	else if($row_questions["Typ"]=="Schieberegler"){
		$sql_range="SELECT * FROM rangeslider_answers WHERE Intern_ID = ".$row_questions["ID"];
		$result_range = mysqli_query($link,$sql_range);
		$row_range=mysqli_fetch_array($result_range);
		echo"<script>document.getElementById('formular_div_".$Scrollcounter."_".$feedback_index."_".$fragen_index."_".$start."').style.gridTemplateColumns = '25% 4fr'</script>";
		echo
		'<div class="frage"><p>'.$row_questions["Fragen_intern"].'</div>
		<div style="border: 1px solid #000; border-top: none; border-left:none; grid-column-start: 2; grid-column-end: -1; display: grid; grid-template-columns: auto auto auto auto auto;">
		<div style="margin:auto;">Bewertung: '.$row["Frage_".$row_questions["ID"]].'</div>
		<input type="range" id="range_'.$Scrollcounter.'_'.$feedback_index.'_'.$row_range["ID"].'" style="width:80%; grid-column-start: 2; grid-column-end: -1; margin:auto;" value='.$row["Frage_".$row_questions["ID"]].' min='.$row_range['range_min'].' max='.$row_range['range_max'].' name="element_1" wrap="soft"></input>
		</div>
		<script>function color(scroll,u,i) 
		{ 
			var slider = document.getElementById("range_"+scroll+"_"+u+"_"+i)
			var value = (slider.value-slider.min)/(slider.max-slider.min)*100
			var value2 = value-10
			var temp =  (slider.value-slider.min)*(100/(slider.max-slider.min));
			var color =  "hsl("+temp+", 100%, 50%) ";
			var color2 =  "#82CFD0 ";
			slider.style.background = "linear-gradient(to right, "+color+"0%, "+color + value2 + "%, "+color+value2+"%, "+color2 + value + "%, #fff " + value + "%, white 100%)"
		}
		color('.$Scrollcounter.','.$feedback_index.','.$row_range["ID"].');
		</script>';
		if($row["Frage_".$row_questions["ID"]]==NULL)
		{
			echo"<script>var elem = document.getElementById('formular_div_".$Scrollcounter."_".$feedback_index."_".$fragen_index."_".$start."'); elem.remove();</script>";
		}

	}

	else{
		echo"<script>document.getElementById('formular_div_".$Scrollcounter."_".$feedback_index."_".$fragen_index."_".$start."').style.gridTemplateColumns = '25% 4fr'</script>";
		echo	
		'<div class="frage"><p>'.$row_questions["Fragen_intern"].'</div>
		<div class="frage_text" style="font-style:italic" name="element_1">'.$row["Frage_".$row_questions["ID"]].'</div>';
		if($row["Frage_".$row_questions["ID"]]=='NULL')
		{
			echo"<script>var elem = document.getElementById('formular_div_".$Scrollcounter."_".$feedback_index."_".$fragen_index."_".$start."'); elem.remove();</script>";
		}
	}
//wird benötigt um das vorherige Überschrift zu bestimmen um dann nur Überschrift zu schreiben wenn das vorige nicht das jetzige Überschrift ist

echo"</div></div>";
$fragen_index=$fragen_index+1;
 }
echo '</div>
</div>
<hr style="margin-bottom:0px">';
$i=$i+1;
$feedback_index = $feedback_index+1;
}

?>
