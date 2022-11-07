<?php

$Message ="";
$i=0;
$sql = "SELECT * FROM leistungen WHERE Fragenset=0";
$result = mysqli_query($link, $sql) ;
while($row = mysqli_fetch_assoc($result)) {
    $i=$i+1;
}
if ($i<1)
{
    echo $Message;
}
else
{
	echo"<script>
	$(document).ready(function() {
		$('#Auswahl_Leistung').multiselect({
		includeSelectAllOption: true,
		enableFiltering: false,
		enableCaseInsensitiveFiltering: false,
		filterPlaceholder:'Hier suchen..'
		});
	});
	</script>";
    
    echo'Zu Leistungen hinzufügen: <select id="Auswahl_Leistung" name="Auswahl_Leistung[]" multiple="multiple">';
	$sql = "SELECT * FROM leistungen WHERE Fragenset=0";
    $result = mysqli_query($link, $sql) ;

	while ($row = mysqli_fetch_assoc($result)) {
		echo "<option id='Leistung_".$row['ID']."' value='".$row['ID']."'>".$row['Leistung']."</option>";
	}
}
    echo'</select>';

?>