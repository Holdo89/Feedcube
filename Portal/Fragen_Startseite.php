<?php
include "Statistics_Startseite.php";
function questions($Fragentyp, $link, $Trainer, $Leistung,$datum_min,$datum_max){
		$sql = "SELECT Is_Admin FROM users WHERE username = '".$_SESSION["username"]."'";
		$result = mysqli_query($link, $sql);
		$row = mysqli_fetch_assoc($result);
		$Message="";

		if($row["Is_Admin"]==1){
				$Message ="<div id='Auswahl_Frage' name='Auswahl_Frage' style='grid-column-start:1;grid-column-end:-1;margin-bottom:20px;'><a href='Fragen.php'>".$Fragentyp." hinzufügen</a></div>";
			}
		else{
				$Message ="<div id='Auswahl_Frage' name='Auswahl_Frage' style='grid-column-start:1;grid-column-end:-1; margin-bottom:20px;'> Es wurde noch keine ".$Fragentyp." Frage hinzugefügt</div>";
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
	            echo"<hr style='grid-column-end:span 3; margin-bottom:10px; margin-top:4px;'>";
				if($row['Typ']==$Fragentyp){
					echo "<div id='Frage_".$row['ID']."'>".$row['Fragen_extern']."</div>";
					Statistik("Frage_".$row['ID'], $link, $Trainer,$Leistung,$datum_min,$datum_max);
				}
			}
				            echo"<hr style='grid-column-end:span 3; margin-bottom:30px; margin-top:4px;'>";
		}	
	}

?>

