<?php

require_once "../config.php";
require_once "session.php";



$sql = "SELECT Is_Admin FROM users WHERE username = '".$_SESSION["username"]."'";
$result = mysqli_query($link, $sql);
$row = mysqli_fetch_assoc($result);
$Message="";

if($row["Is_Admin"]==1){
        $Message ="<div id='Auswahl_Frage_Kommentar' name='Auswahl_Frage_Kommentar'> Es wurde noch keine Text-Frage <a href='Fragen.php'>hinzugefügt</a></div>";
    }
else{
        $Message ="<div id='Auswahl_Frage_Kommentar' name='Auswahl_Frage_Kommentar'> Es wurde noch keine Text-Frage hinzugefügt, wende dich an einen Feedcube Administrator</div>";
    }


    $sql = "SELECT ID, Typ, Fragenbeschreibung FROM intern WHERE Fragenbeschreibung !='' AND Typ = 'Text'";

	$i=0;
	$result = mysqli_query($link, $sql) ;
    while($row = mysqli_fetch_assoc($result)) {
		$i=$i+1;
	}

	if ($i==0){
        echo $Message;
	}
	else{
		echo'<select class="Auswahl_Select" id="Auswahl_Frage_Kommentar" name="Auswahl_Frage_Kommentar" oninput="create_blog_posts()">';
		$result = mysqli_query($link, $sql) ;

    	while($row = mysqli_fetch_assoc($result)) {

			if($row['Typ']=='Text'){

				echo "<option value='Frage_".$row['ID']."'>".$row['Fragenbeschreibung']."</option>";

			}
		}
		echo"</select>";
	}

?>

