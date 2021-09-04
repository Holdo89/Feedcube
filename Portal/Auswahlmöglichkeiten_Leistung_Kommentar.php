<?php
 require_once "../config.php";
 require_once "session.php";

$sql = "SELECT Is_Admin FROM users WHERE username = '".$_SESSION["username"]."'";
$result = mysqli_query($link, $sql);
$row = mysqli_fetch_assoc($result);
$Message="";

if($row["Is_Admin"]==1){
        $Message ="<div id='Auswahl_Leistung_Kommentar' name='Auswahl_Leistung_Kommentar'> Es wurde noch keine Leistung <a href='Leistungmanagement.php'>hinzugefügt</a></div>";
    }
else{
        $Message ="<div id='Auswahl_Leistung_Kommentar' name='Auswahl_Leistung_Kommentar'> Es wurde noch keine Leistung hinzugefügt, Wende dich an einen Feedcube Administrator </div>";
    }

$i=0;
$sql = "SELECT * FROM leistungen";
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
    echo'<select class="Auswahl_Select" id="Auswahl_Leistung_Kommentar" name="Auswahl_Leistung_Kommentar" oninput="create_blog_posts()">';
	echo '<option value="%25">Alle Leistungen</option>';

    while($row = mysqli_fetch_assoc($result)) {

		echo "<option value='".$row['ID']."'>".$row['Leistung']."</option>";

    }  
    echo'</select>';
}	

?>