<?php

$sql_überschrift = "SELECT * FROM überschrift"; 
$result_überschrift = mysqli_query($link, $sql_überschrift);

while($row_überschrift = mysqli_fetch_assoc($result_überschrift)) {
    echo "<form style='border-radius:5px 5px 0px 0px;margin-bottom:0px;'>
    <button type='button' id='angle_".$row_überschrift["ID"]."' class='center_button' onclick='showQuestions(".$row_überschrift["ID"].");' ><i class='fa fa-angle-right'></i></button>
    <input class= center_select id='Überschrift_".$row_überschrift["ID"]."' value='".$row_überschrift["Überschrift"]."' onblur='user_abfrage_speichern(".$row_überschrift["ID"].")'></input>
    <button type='button' class='center_button' onclick='showÜberschrift(".$row_überschrift["ID"].")'><i class='fa fa-pencil'></i><span class='tooltiptext'>Bearbeiten</span></button>           
    <button type='button' class='center_button' onclick='user_abfrage_löschen_Überschrift(".$row_überschrift["ID"].")'><i class='fa fa-trash'></i><span class='tooltiptext'>Löschen</span></button>";            
    echo'
	</form>
    <div id="form_'.$row_überschrift["ID"].'" style="display:none; width:100%; text-align:center; margin:auto">
    <div class="externe_Fragen" style="padding:10px;">';
	include "Fragen_Abfrage.php";
	echo'</div>
    <button id="element" style="width:250px; background-color:'; $sql='SELECT farbe FROM system'; $exec=mysqli_query($link,$sql); $result=mysqli_fetch_assoc($exec); echo $result['farbe']; echo'" onclick = "display(undefined,\'extern\',undefined,'.$row_überschrift["ID"].')"><i class="fa fa-question" style="font-size:19px" aria-hidden="true"></i> Frage hinzufügen</button>
    </div>';
}
?>
<script>
function copyLink(id) {
    var copyLink = "https://<?php echo $subdomain ?>.feedcube.net/Software/Überschrift/Vorauswahl.php?Überschrift="+id;
   navigator.clipboard.writeText(copyLink).then(() => {
        alert("Der Link zur Überschrift wurde erfolgreich in die Zwischenablage kopiert");
      })
      .catch(() => {
        alert("Der Link zur Überschrift wurde nicht erfolgreich in die Zwischenablage kopiert");
      });
}

function showQuestions(id)
	{
		var anglebutton = document.getElementById("angle_"+id);
		var form = document.getElementById("form_"+id);
		if(form.style.display=="grid"){
			form.style.display="none";
			anglebutton.innerHTML="<i class='fa fa-angle-right'></i>"
		}
		else
		{
			form.style.display="grid";
			anglebutton.innerHTML="<i class='fa fa-angle-down'></i>"
		}
	}
</script>