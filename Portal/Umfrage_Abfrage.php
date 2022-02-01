<?php

$sql_Umfragen = "SELECT * FROM umfragen"; 
$result_Umfragen = mysqli_query($link, $sql_Umfragen);

while($row_Umfragen = mysqli_fetch_assoc($result_Umfragen)) {
    echo "<form style='border-radius:5px 5px 0px 0px;margin-bottom:0px;'>
    <button type='button' id='angle_".$row_Umfragen["ID"]."' class='center_button' onclick='showQuestions(".$row_Umfragen["ID"].");' ><i class='fa fa-angle-right'></i></button>
    <input class= center_select id='Umfrage_".$row_Umfragen["ID"]."' value='".$row_Umfragen["Umfrage"]."' onblur='user_abfrage_speichern(".$row_Umfragen["ID"].")'></input>
    <button type='button' class='center_button' onclick='user_abfrage_löschen(".$row_Umfragen["ID"].")'><i class='fa fa-play'></i></button>            
    <button type='button' class='center_button' onclick='user_abfrage_löschen(".$row_Umfragen["ID"].")'><i class='fa fa-pencil'></i></button>           
    <button type='button' class='center_button' onclick='user_abfrage_löschen(".$row_Umfragen["ID"].")'><i class='fa fa-trash'></i></button>";            
    echo'
	</form>
    <div id="form_'.$row_Umfragen["ID"].'" style="display:none; width:90%; text-align:center; margin:auto">
    <div class="interne_Fragen" style="padding:10px;">';
	include "interne_Fragen_Abfrage.php";
	echo'</div>
    <button id="element" onclick = "display(undefined,\'intern\',undefined,'.$row_Umfragen["ID"].')"><i class="fa fa-question" style="font-size:19px" aria-hidden="true"></i> Frage hinzufügen</button>
    </div>';
}

?>