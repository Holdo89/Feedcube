
<link href="slider-range.css" rel="stylesheet" type="text/css">
<script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
<script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/jqueryui/1.11.4/jquery-ui.min.js"></script>
<script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/jqueryui-touch-punch/0.2.3/jquery.ui.touch-punch.min.js"></script>
<script type="text/javascript" src="rangeslider_jquery_intern.js"> </script>
<script type = "text/javascript" src="color_change.js"></script>
<div id="FilterCharts" style="overflow:hidden; max-height:0px">
	<div id="Auswahl" class="grid-container-auswahl" style="grid-template-columns: 1fr 2fr 5fr;">

	<label class="Auswahl" for="zeitraum" style="margin-top: 14px">Bewertungszeitraum: </label>
		<select class = "Auswahl_Select" name="zeitraum" id="zeitraum" oninput="update()" style="text-align:top; ">
		<option value="Benutzerdefiniert"> Benutzerdefiniert</option>
		<option value="24 hours">Heute</option>
		<option value="3 days">letzten 3 Tage</option>
		<option value="7 days">letzten 7 Tage</option>
		<option value="30 days">letzten 30 Tage</option>
		</select>
	<div id ="AuswahlZeitraum" style="grid-column:3/ span 2; width:700px;">
	<div class="Auswahl_Slider">
	<div id="slider-range" onmousemove="datum_update()"></div>
	</div>
	<div></div>
	<div></div>
	<div></div>
	<p>Bewertungen von: <span id="demo" ></span></p>
	</div>
	</div>
	<hr>
</div>
<script>
function datum_update(){
	var value_min = $( "#slider-range" ).slider( "values", 0 );
	var value_max = $( "#slider-range" ).slider( "values", 1 );
	var output = document.getElementById("demo");
	var datum_min = new Date();
	var datum_max = new Date();
	datum_min.setDate(datum_min.getDate() - value_min);
	datum_min = datum_min.toISOString().split('T')[0];
	datum_max.setDate(datum_max.getDate() - value_max);
	datum_max = datum_max.toISOString().split('T')[0];
	output.innerHTML = datum_min + " bis " + datum_max;
}

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