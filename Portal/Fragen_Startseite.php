<?php
include "Statistics_Startseite.php";
function questions($Fragentyp, $link, $Trainer){
		$sql = "SELECT Is_Admin FROM users WHERE username = '".$_SESSION["username"]."'";
		$result = mysqli_query($link, $sql);
		$row = mysqli_fetch_assoc($result);
		$Message="";

		if($row["Is_Admin"]==1){
				$Message ="<div id='Auswahl_Frage' name='Auswahl_Frage' style='grid-column-start:1;grid-column-end:-1;margin-bottom:20px;'> Es wurde noch keine ".$Fragentyp." Frage <a href='Fragen.php'>hinzugefügt</a></div>";
			}
		else{
				$Message ="<div id='Auswahl_Frage' name='Auswahl_Frage' style='grid-column-start:1;grid-column-end:-1; margin-bottom:20px;'> Es wurde noch keine ".$Fragentyp." Frage hinzugefügt, wende dich an einen Feedcube Administrator</div>";
			}
		$sql = "SELECT ID, Typ, Fragen_extern FROM admin WHERE Fragen_extern !=''AND Typ = '".$Fragentyp."'";
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
					echo "<div style='margin-bottom:10px;' id='Frage_".$row['ID']."'>".$row['Fragen_extern']."</div>";
					Statistik("Frage_".$row['ID'], $link, $Trainer);
				}
			}
		}	
	}

?>

