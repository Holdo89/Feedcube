<?php

require_once "../config.php";
require_once "session.php";
$sql = "SELECT * FROM fragensets";
		echo'<select class="Auswahl_Select" id="Auswahl_Fragenset" name="Auswahl_Fragenset" oninput="display_leistung()" required>';
		echo "<option value='kein_Fragenset' selected>freie Auswahl</option>";
		$result = mysqli_query($link, $sql) ;

    	while($row = mysqli_fetch_assoc($result)) {

			echo "<option value='".$row['ID']."'>".$row['Fragenset']."</option>";

		}
		echo"</select>";

?>

