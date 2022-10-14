<?php

$Message ="<div id='Auswahl_Fragenset' name='Auswahl_Fragenset' class='Auswahlmöglichkeit'> Es wurde noch kein Fragenset <a href='Fragenset.php'>hinzugefügt</a></div>";
$i=0;
$sql = "SELECT Fragenset FROM fragensets";
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
		$('#Auswahl_Fragenset').multiselect({
		includeSelectAllOption: true,
		enableFiltering: false,
		enableCaseInsensitiveFiltering: false,
		filterPlaceholder:'Hier suchen..'
		});
	});
	</script>";

    echo'Zu folgenden Fragensets hinzufügen: <select id="Auswahl_Fragenset" name="Auswahl_Fragenset[]" multiple="multiple">';
    $sql = "SELECT Fragenset FROM fragensets" ;

    $result = mysqli_query($link, $sql) ;

    while ($row = mysqli_fetch_assoc($result)) {
            echo "<option id='".$row['Fragenset']."' value='".$row['Fragenset']."'>".$row['Fragenset']."</option>";
    }
    echo'</select>';
}	

?>