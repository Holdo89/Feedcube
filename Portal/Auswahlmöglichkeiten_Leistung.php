<?php

 require_once "session.php";

 require_once "config.php";

$sql = "SELECT Is_Admin FROM users WHERE username = '".$_SESSION["username"]."'";
$result = mysqli_query($link, $sql);
$row = mysqli_fetch_assoc($result);
$Message="";

if($row["Is_Admin"]==1){
        $Message ="<div id='Auswahl_Leistung' name='Auswahl_Leistung'> Es wurde noch keine Leistung <a href='Leistungmanagement.php'>hinzugefügt</a></div>";
    }
else{
        $Message ="<div id='Auswahl_Leistung' name='Auswahl_Leistung'> Es wurde noch keine Leistung hinzugefügt, wende dich an einen Feedcube Administrator</div>";
    }

$i=0;
$sql = "SELECT Leistung FROM leistungen";
$result = mysqli_query($link, $sql) ;
while($row = mysqli_fetch_assoc($result)) {
    $i=$i+1;
}
if ($i==0)
{
    echo $Message;
}
else
{
    $result = mysqli_query($link, $sql) ;
    echo'<select class="Auswahl_Select" id="Auswahl_Leistung" name="Auswahl_Leistung" oninput="update()">';
	echo '<option value="%">Alle Leistungen</option>';

    while($row = mysqli_fetch_assoc($result)) {

		echo "<option value='".$row['Leistung']."'>".$row['Leistung']."</option>";

    }  
    echo'</select>';
}	

?>