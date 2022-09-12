
<div id=fullAuswahl class="FragenAuswahl">

<label class="Auswahl">Frage: </label>
	<?php
		include "intern_Auswahlmöglichkeiten_Fragen.php"
	?>
	<div style="text-align:left;font-size:16px; margin-top:8px;cursor: pointer;" onclick="toggleFilterVisibility('FilterCharts', 'filtericon')"><i id="filtericon" class="fa fa-filter" style="font-size:15px;" aria-hidden="true"></i> Filter</div>
	<?php
	if($IsAdmin == 1)
	{
		echo'<div style="text-align:left;font-size:16px; margin-top:8px;cursor: pointer;" onclick="intern_export_data()"><i id="filtericon" class="fa fa-download" style="font-size:15px;" aria-hidden="true"></i> Export</div>';
		echo'<div style="text-align:left;font-size:16px; margin-top:8px;cursor: pointer;" onclick="intern_delete_data()"><i id="filtericon" class="fa fa-trash" style="font-size:15px;" aria-hidden="true"></i> Löschen</div>';
	}
	else{
		echo'<div style="text-align:left;font-size:18px; margin-top:8px;cursor: pointer;" onclick="export_data()"><i id="filtericon" class="fa fa-download" style="font-size:15px;" aria-hidden="true"></i> Export</div>';
	}
	?>	

	</div>
	<hr>
	<?php
	include "Filter_Umfrage_charts.php";
	?>

	<div id="undraw_empty" style="display:none; margin-top:48px;"><p><label>Es wurde noch kein Feedback abgegeben</label></p><img src="undraw_empty_xct9.svg" alt="" class="undraw_chart_empty"></div>


	<div id="loader" style = "display:none"></div>
	<div id="charts" class="grid-container-charts" >
			<div class= "leftchart">
			<canvas id="ColumnChart" height=160></canvas>
			</div>
			<div class= "rightchart">
			<canvas id="PieChart" height=200></canvas>
			</div>
			<div class="leftchart"> 
			<canvas id="TrendChart" height=200></canvas>
			</div>
			<div class="rightchart"> 
			<p id="Statistics" style="overflow:auto; font-size:18px; font-weight: bold;border-radius: 10px 10px; background: linear-gradient(90deg, rgba(46,193,200,1) 0%, rgba(48,23,107,1) 90%);color:white; margin-top:11%; padding-top:20%;height:330px;">
			</p>

			</div>
	</div>
	<div id="Kommentare" class="Kommentare" style="margin:auto">
	<span id="blog_posts" ></span> <!--hier werden die Kommentare eingefügt-->
	<div id="load_data_message"></div>
	</div>






