<?php

 require_once "IsAdmincheck.php";
 $Leistung=$_REQUEST["Leistung"];

 if($Trainer=='externes_feedback'){
 		$query = "SELECT * FROM externes_feedback WHERE Leistung LIKE '".$Leistung."' ORDER BY Datum DESC";
 }

 else{
		$query = "SELECT * FROM externes_feedback WHERE Username = '".$Trainer."' AND Leistung LIKE '".$Leistung."' ORDER BY Datum DESC";
 }	

 $exec = mysqli_query($link,$query);
 $i=0;
 $feedback_index = 1; //welches feedback ist gerade dran
while($row = mysqli_fetch_array($exec)){
	$sql_test = "SELECT Leistung from leistungen WHERE ID = ".$row['Leistung'];
	$exec_test = mysqli_query($link,$sql_test);
	$leistung_titel = mysqli_fetch_array($exec_test); 
	 echo $leistung_titel['Leistung']."  ";
	 echo $row['Datum'];
	 if($IsAdmin==1)
	 {
	 	echo '<i class="fa fa-trash" onclick="deleteFeedback('.$row['ID'].')" style="cursor:pointer;"></i>';
	 }
	 $chapter = "";
	 echo'<form style="padding:10px; padding-bottom:15px;">';

	//Hole zuerst die ID der Leistung die beurteilt wurde
	$row_ID = $row['Leistung'];
	//Finde heraus welche Fragen zu dieser Leistung gestellt wurden
	$query = "SELECT * FROM admin WHERE Leistung_".$row_ID." = 1 ORDER BY post_order_no ASC";	
 	$execute = mysqli_query($link,$query);
 	$execute_chapter = mysqli_query($link,$query);
 	$chapter="";
	$fragen_index = 1; //welche Frage im Feedback ist dran

	while($row_questions = mysqli_fetch_array($execute)){
		echo'<div id="formular_div_'.$feedback_index.$fragen_index.'" class="grid-container" style="padding:0px; margin:0px;">';
		if ($chapter != $row_questions["Kapitel"]){
 			echo'<div class="leer"></div>
			<div class="chapter" style="grid-column-start: 1; grid-column-end: -1;">'.$row_questions["Kapitel"].'</div>';
		}


		if ($row_questions["Typ"]=="Singlechoice"){
			$option_index=1;
			$sql="SELECT * FROM singlechoice_answers WHERE Frage_".$row_questions["ID"]." = 1 ORDER BY post_order_no ASC";
			$result = mysqli_query($link,$sql);
			$gridcolumns = "25% 2fr ";
			$sql_answers="SELECT Answers FROM singlechoice_answers WHERE Frage_".$row_questions["ID"]." = 1 ORDER BY post_order_no ASC";
			$exec_answers=mysqli_query($link,$sql_answers);
			$option_index=1;
			echo'
			<div class="frage" style="grid-row-end: span 2">'.$row_questions["Fragen_extern"].'</div>';
			while($row_answers=mysqli_fetch_array($result)){
				echo"<script>document.getElementById('formular_div_".$feedback_index.$fragen_index."').style.gridTemplateColumns = '".$gridcolumns."'</script>";
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
			if($rows_answers["Answers"]=='NULL')
			{
				echo"<script>var elem = document.getElementById('formular_div_".$feedback_index.$fragen_index."'); elem.remove();</script>";
			}
			$i=$i+1;
		}

		else if ($row_questions["Typ"]=="Multiplechoice"){
			$option_index=1;
			$sql="SELECT * FROM multiplechoice_answers WHERE Frage_".$row_questions["ID"]." = 1 ORDER BY post_order_no ASC";
			$result = mysqli_query($link,$sql);
			$gridcolumns = "25% 2fr ";
			$sql_answers="SELECT Answers FROM multiplechoice_answers WHERE Frage_".$row_questions["ID"]." = 1 ORDER BY post_order_no ASC";
			$exec_answers=mysqli_query($link,$sql_answers);
			$option_index=1;
			echo'
			<div class="frage" style="grid-row-end: span 2">'.$row_questions["Fragen_extern"].'</div>';
			while($row_answers=mysqli_fetch_array($result)){
				echo"<script>document.getElementById('formular_div_".$feedback_index.$fragen_index."').style.gridTemplateColumns = '".$gridcolumns."'</script>";
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
			if($rows_answers["Answers"]=='NULL')
			{
				echo"<script>var elem = document.getElementById('formular_div_".$feedback_index.$fragen_index."'); elem.remove();</script>";
			}
			$i=$i+1;
		}

	else if($row_questions["Typ"]=="Schieberegler"){
		echo"<script>document.getElementById('formular_div_".$feedback_index.$fragen_index."').style.gridTemplateColumns = '25% 4fr'</script>";
		echo
		'<div class="frage"><p>'.$row_questions["Fragen_extern"].'</div>
		<div style="border: 1px solid #000; grid-column-start: 2; grid-column-end: -1; display: grid; grid-template-columns: auto auto auto auto auto;">
		<div style="margin:auto;">Bewertung: '.$row["Frage_".$row_questions["ID"]].'</div>
		<input type="range" style="width:80%; grid-column-start: 2; grid-column-end: -1; margin:auto;" value='.$row["Frage_".$row_questions["ID"]].' name="element_1" wrap="soft"></input>
		</div>';
		if($row["Frage_".$row_questions["ID"]]==NULL)
		{
			echo"<script>var elem = document.getElementById('formular_div_".$feedback_index.$fragen_index."'); elem.remove();</script>";
		}

	}

	else{
		echo"<script>document.getElementById('formular_div_".$feedback_index.$fragen_index."').style.gridTemplateColumns = '25% 4fr'</script>";
		echo	
		'<div class="frage"><p>'.$row_questions["Fragen_extern"].'</div>
		<textarea class="frage_text" name="element_1" cols="50" rows="3" maxlength="1000" wrap="soft">'.$row["Frage_".$row_questions["ID"]].'</textarea>';
		if($row["Frage_".$row_questions["ID"]]=='NULL')
		{
			echo"<script>var elem = document.getElementById('formular_div_".$feedback_index.$fragen_index."'); elem.remove();</script>";
		}
	}
//wird benötigt um das vorherige Kapitel zu bestimmen um dann nur Kapitel zu schreiben wenn das vorige nicht das jetzige Kapitel ist

$row_previous_chapter = mysqli_fetch_array($execute_chapter);
$chapter=$row_previous_chapter["Kapitel"];
echo"</div>";
$fragen_index=$fragen_index+1;
 }
echo '</div>
</form>';
$i=$i+1;
$feedback_index = $feedback_index+1;
}

?>

