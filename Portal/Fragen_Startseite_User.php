<?php
require_once "../config.php";
require_once "session.php";
questions("Singlechoice", $link);
questions("Multiplechoice", $link);
questions("Schieberegler", $link);
questions("Text", $link);
function questions($Fragentyp, $link){
		$sql = "SELECT Is_Admin FROM users WHERE username = '".$_SESSION["username"]."'";
		$result = mysqli_query($link, $sql);
		$row = mysqli_fetch_assoc($result);
		$Message="";

		if($row["Is_Admin"]==1){
				$Message ="<div id='Auswahl_Frage' name='Auswahl_Frage'> Es wurde noch keine Metriken-Frage <a href='Fragen.php'>hinzugefügt</a></div>";
			}
		else{
				$Message ="<div id='Auswahl_Frage' name='Auswahl_Frage'> Es wurde noch keine Metriken-Frage hinzugefügt, wende dich an einen Feedcube Administrator</div>";
			}

		echo"<p><b>".$Fragentyp."</b></p>";
		$sql = "SELECT ID, Typ, Fragen_extern FROM admin WHERE Fragen_extern !=''AND Typ != 'Text'";
		$i=0;
		$result = mysqli_query($link, $sql) ;
		while($row = mysqli_fetch_assoc($result)) {
			$i=$i+1;
		}
	
		if ($i==0){
			echo $Message;
		}
		else{
			$result = mysqli_query($link, $sql) ;
	
			while($row = mysqli_fetch_assoc($result)) {
	
				if($row['Typ']==$Fragentyp){
	
					echo "<div style='margin-bottom:20px;' id='Frage_".$row['ID']."'>".$row['Fragen_extern']."</div>";
	
				}
			}
		}	
	}

?>

