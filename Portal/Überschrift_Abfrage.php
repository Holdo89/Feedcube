<?php

$sql_überschrift = "SELECT * FROM überschrift ORDER BY post_order_no ASC"; 
$result_überschrift = mysqli_query($link, $sql_überschrift);

echo '<div class="Überschriften" style="padding:10px;">';

while($row_überschrift = mysqli_fetch_assoc($result_überschrift)) {
    echo "<form data-post-ud=".$row_überschrift["post_id"]." style='border-radius:5px 5px 0px 0px;margin-bottom:0px;'>
    <p style='margin-top:7px; margin-bottom:0px;' type='button' id='angle_".$row_überschrift["ID"]."' class='center_button' onclick='showQuestions(".$row_überschrift["ID"].");' ><i class='fa fa-angle-right'></i></p>
    <div onclick='showQuestions(".$row_überschrift["ID"].");' class= center_select id='Überschrift_".$row_überschrift["ID"]."' style = 'cursor: grab'>".$row_überschrift["Überschrift"]."</div>
    <button type='button' class='center_button' onclick='showÜberschrift(".$row_überschrift["ID"].")'><i class='fa fa-pencil'></i><span class='tooltiptext'>Bearbeiten</span></button>           
    <button type='button' class='center_button' onclick='user_abfrage_löschen_Überschrift(".$row_überschrift["ID"].")'><i class='fa fa-trash'></i><span class='tooltiptext'>Löschen</span></button>";            
    echo'
    <div id="form_'.$row_überschrift["ID"].'" style="background-color:ghostwhite; display:none; width:100%; text-align:center; margin:auto; grid-column: 1 / span 4;">
    <div class="externe_Fragen">';
	include "Fragen_Abfrage.php";
	echo'</div>
    </form>
    <button type="button" id="element" style="width:250px; background-color:white; border: 2px solid '; $sql='SELECT farbe FROM system'; $exec=mysqli_query($link,$sql); $result=mysqli_fetch_assoc($exec); echo $result['farbe']; echo'; color:'; $sql='SELECT farbe FROM system'; $exec=mysqli_query($link,$sql); $result=mysqli_fetch_assoc($exec); echo $result['farbe']; echo'" onclick = "display_new('.$row_überschrift["ID"].')"><i class="fa fa-question" style="font-size:19px" aria-hidden="true"></i> Frage hinzufügen</button>
    </div>';
}
echo'</div>';
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