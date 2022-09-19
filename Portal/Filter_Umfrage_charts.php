
<link href="slider-range.css" rel="stylesheet" type="text/css">
<script type="text/javascript" src="https://cdn.jsdelivr.net/jquery/latest/jquery.min.js"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />
<script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/jqueryui/1.11.4/jquery-ui.min.js"></script>
<script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/jqueryui-touch-punch/0.2.3/jquery.ui.touch-punch.min.js"></script>
<div id="FilterCharts" style="overflow:hidden; grid-column: 1 / span 3; max-height:0px">
	<div id="Auswahl" class="grid-container-auswahl">
	<label class="Auswahl" style="margin-top:2px">Umfrage: </label>
			<?php
				include "Auswahlmöglichkeiten_Umfrage.php"
			?>
		<label class="Auswahl" for="zeitraum" style="margin-top:5px">Zeitraum: </label>
		<input id="zeitraum" style="background-color:white; width:300px; border:none" type="text" name="daterange" value="01/01/2018 - 01/15/2018" />
	<div>
</div>
<div>
</div>


	</div>
	<hr>
</div>
<script>

function toggleFilterVisibility(Filterdiv, Filtericon ){
	var filterdiv = document.getElementById(Filterdiv)
	var filtericon = document.getElementById(Filtericon)
	if (filterdiv.style.maxHeight != '0px')
	{
		filterdiv.style.transition = "0.6s ease max-height";
		filterdiv.style.maxHeight = "0px";
		filtericon.className = "fa fa-chevron-right";
	}
	else
	{
		filterdiv.style.transition = "1.4s ease max-height";
		filterdiv.style.maxHeight = "999px";
		filtericon.className = "fa fa-chevron-down";
	}
}
</script>