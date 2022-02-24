<?php

 require_once "../config.php";
 require_once "session.php";

$sql = "SELECT Is_Admin FROM users WHERE username = '".$_SESSION["username"]."'";
$result = mysqli_query($link, $sql);
$row = mysqli_fetch_assoc($result);
$Message="";

if($row["Is_Admin"]==1){
        $Message ="<div id='Auswahl_Umfrage' name='Auswahl_Umfrage' class='Auswahlmöglichkeit_Umfrage'> Es wurde noch keine Umfrage <a href='Umfragen.php'>hinzugefügt</a></div>";
    }
else{
        $Message ="<div id='Auswahl_Umfrage' name='Auswahl_Umfrage' class='Auswahlmöglichkeit_Umfrage'> Es wurde noch keine Umfrage hinzugefügt, wende dich an einen Feedcube Administrator</div>";
    }

$i=0;
$sql = "SELECT * FROM umfragen";
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
    echo'<select class="Auswahl_Select" id="Auswahl_Umfrage" name="Auswahl_Umfrage" oninput="updateAuswahlFragen(69)">';
	echo '<option value="%25">Alle Umfragen</option>';

    while($row = mysqli_fetch_assoc($result)) {
		echo "<option value='".$row['ID']."'>".$row['Umfrage']."</option>";
    }  
    echo'</select>';
}	

?>