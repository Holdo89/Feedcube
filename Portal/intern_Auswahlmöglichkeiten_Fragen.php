<?php

require_once "session.php";

require_once "config.php";



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


    $sql = "SELECT ID, Typ, Fragen_intern FROM intern WHERE Fragen_intern !=''AND Typ != 'Text'";

	$i=0;
	$result = mysqli_query($link, $sql) ;
    while($row = mysqli_fetch_assoc($result)) {
		$i=$i+1;
	}

	if ($i==0){
        echo $Message;
	}
	else{
		echo'<select class="Auswahl_Select" id="Auswahl_Frage" name="Auswahl_Frage" oninput="update()">';
		$result = mysqli_query($link, $sql) ;

    	while($row = mysqli_fetch_assoc($result)) {

			if($row['Typ']!='Text'){

				echo "<option value='Frage_".$row['ID']."'>".$row['Fragen_intern']."</option>";

			}
		}
		echo"</select>";
	}

?>

