
<div class="container" style="margin-top:30px">

	<div class="btn-group">
  	<button type="button" id="metriken_button" class="btn btn-primary" onclick="change_color('metriken_button','text_button','<?php $sql='SELECT farbe FROM system'; $exec=mysqli_query($link,$sql); $result=mysqli_fetch_assoc($exec); echo $result['farbe']?>'); hide('fullAuswahl','blog'); hide('charts','blog');update();"><i class="fa fa-bar-chart" aria-hidden="true"></i> <span class="buttontext">Diagramme<span></button>
	<button type="button" id="text_button" class="btn btn-primary" onclick="change_color('text_button','metriken_button','<?php $sql='SELECT farbe FROM system'; $exec=mysqli_query($link,$sql); $result=mysqli_fetch_assoc($exec); echo $result['farbe']?>'); hide('fullAuswahl','charts');hide('blog','fullAuswahl');create_blog();"><i class="fa fa-commenting" aria-hidden="true"></i> <span class="buttontext">Kommentare</span></button>
</div>
</div>
<div id=Hinweis style="margin-top:50px;"><p><label>Wähle Diagramme oder Kommentare um dein Feedback auszuwerten</label></p></div>

<div id="fullAuswahl"  style='display:none; width: 83vw; margin:auto;'>
	<div id="Auswahl" class="grid-container-auswahl">
	<label class="Auswahl"> Wähle eine Frage: </label>
	<?php
		include "intern_Auswahlmöglichkeiten_Fragen.php"
	?>

	<label class="Auswahl"> Wähle einen Zeitraum: </label>	
	<div class="Auswahl_Slider">
	<div id="slider-range" onmousemove="datum_update_blog()"></div>
	<p style="margin-top:0.5em">Bewertungen von: <span id="demo"></span></p>
	</div>
	</div>
	<label class="Auswahl" id="nofeedback" name="nofeedback" style="text-align:center; margin-top:5rem"></label>
</div>
	<div id="charts" class="grid-container-charts"  style='display:none'>
			<div class= "leftchart">
			<canvas id="ColumnChart"height=160></canvas>
			</div>
			<div class= "rightchart" style="margin-top:38px">
			<canvas id="PieChart" height=190></canvas>
			</div>
			<div class="leftchart"> 
			<canvas id="TrendChart" height=200></canvas>
			</div>
			<div class="rightchart"> 
			<p id="Statistics" style="overflow:auto; font-size:18px; font-weight: bold;border-radius: 10px 10px; background-image: url('background_statistic.jpg'); background-size: cover; color:white; margin-top:11%; padding-top:20%;height:330px;">
			</div>
	</div>
	<div id="blog"  style='display:none'>		
	<div id="blog2" class="grid-container-auswahl" style='width: 83vw; margin:auto;'>
	<label class="Auswahl"> Wähle eine Frage: </label>
	<?php
		include "intern_Auswahlmöglichkeiten_Fragen_Kommentare.php"
	?>
	<label class="Auswahl"> Wähle einen Zeitraum: </label>	
	<div class="Auswahl_Slider">
	<div id="slider-range2"  onmousemove="datum_update(), datum_update_blog()"></div>
	<p style="margin-top:0.5em">Bewertungen von: <span id="demo2" ></span></p>
	</div>
	<div class="Kommentare">
	<span id="blog_posts" ></span> <!--hier werden die Kommentare eingefügt-->
	</div>
	</div>	
	<label class="Auswahl" id="nofeedback_Kommentar" name="nofeedback_Kommentar" style="text-align:center; margin-top:1rem"></label>	
	</div> 





