<?php

require_once "../config.php";
require_once "session.php";

$sql = "SELECT Is_Admin FROM users WHERE username = '".$_SESSION["username"]."'";
$result = mysqli_query($link, $sql);
$row = mysqli_fetch_assoc($result);
$ID = $_REQUEST["ID"];
$Message="";

echo"<script>console.log('".$ID."')</script>";

$Message ="<option id='Auswahl_Frage' name='Auswahl_Frage' class = 'Auswahlmöglichkeit'> Bei dieser Umfrage wurde noch keine Frage hinzugefügt</option>";


if($ID=="%")
{
	$sql = "SELECT ID, Typ, Fragen_intern FROM intern WHERE Fragen_intern !='' ORDER BY post_order_no ASC";

}
else{
	$sql = "SELECT ID, Typ, Fragen_intern FROM intern WHERE Fragen_intern !='' AND Umfrage_".$ID." = 1 ORDER BY post_order_no ASC";
}

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
		echo "<option value='Frage_".$row['ID']."'>".$row['Fragen_intern']."</option>";
	}
	echo"</select>";
}
?>

