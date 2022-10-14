<?php

$sql_Umfragen = "SELECT * FROM umfragen"; 
$result_Umfragen = mysqli_query($link, $sql_Umfragen);

while($row_Umfragen = mysqli_fetch_assoc($result_Umfragen)) {
    echo "<form style='border-radius:5px 5px 0px 0px;margin-bottom:0px;'>
    <button type='button' onclick='showQuestions(".$row_Umfragen["ID"].");' id='angle_".$row_Umfragen["ID"]."' class='center_button' ><i class='fa fa-angle-right'></i></button>
    <button type='button' onclick='showQuestions(".$row_Umfragen["ID"].");' class= center_select id='Umfrage_".$row_Umfragen["ID"]."'>".$row_Umfragen["Umfrage"]."</button>
    <button type='button' class='center_button' onclick='copyLink(".$row_Umfragen["ID"].")';\"><i class='fa fa-link'></i><span class='tooltiptext'>Link kopieren</span></button>    
    <button type='button' class='center_button' onclick='showUmfrage(".$row_Umfragen["ID"].")'><i class='fa fa-pencil'></i><span class='tooltiptext'>Bearbeiten</span></button>           
    <button type='button' class='center_button' onclick='user_abfrage_löschen(".$row_Umfragen["ID"].")'><i class='fa fa-trash'></i><span class='tooltiptext'>Löschen</span></button>";            
    echo'
	</form>
    <div id="form_'.$row_Umfragen["ID"].'" style="display:none; width:100%; text-align:center; margin:auto">
    <div class="interne_Fragen" style="padding:10px;">';
	include "interne_Fragen_Abfrage.php";
	echo'</div>
    <button id="element" style="width:250px; background-color:white; border: 2px solid '; $sql='SELECT farbe FROM system'; $exec=mysqli_query($link,$sql); $result=mysqli_fetch_assoc($exec); echo $result['farbe']; echo'; color:'; $sql='SELECT farbe FROM system'; $exec=mysqli_query($link,$sql); $result=mysqli_fetch_assoc($exec); echo $result['farbe']; echo'" onclick = "display(undefined,\'intern\',undefined,'.$row_Umfragen["ID"].')"><i class="fa fa-question" style="font-size:19px" aria-hidden="true"></i> Frage hinzufügen</button>
    </div>';
}
?>
<script>
function copyLink(id) {
    var copyLink = "https://<?php echo $subdomain ?>.feedcube.net/Software/Umfrage/Vorauswahl.php?Umfrage="+id;
   navigator.clipboard.writeText(copyLink).then(() => {
        alert("Der Link zur Umfrage wurde erfolgreich in die Zwischenablage kopiert");
      })
      .catch(() => {
        alert("Der Link zur Umfrage wurde nicht erfolgreich in die Zwischenablage kopiert");
      });
}
</script>