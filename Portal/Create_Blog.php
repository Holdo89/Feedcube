<script>

function create_blog(){
	var Trainer = Auswahl_Trainer_Kommentare.value;
	var Frage = Auswahl_Frage_Kommentar.value;
	var Leistung = Auswahl_Leistung_Kommentar.value;
	var value_min = $( "#slider-range2" ).slider( "values", 0 );
	var value_max = $( "#slider-range2" ).slider( "values", 1 );
	var output = document.getElementById("demo2");
	var datum_min = new Date();
	var datum_max = new Date();
	datum_min.setDate(datum_min.getDate() - value_min);
	datum_min = datum_min.toISOString().split('T')[0];
	datum_max.setDate(datum_max.getDate() - value_max);
	datum_max = datum_max.toISOString().split('T')[0];
	output.innerHTML = datum_min + " bis " + datum_max;

		var xmlhttp = new XMLHttpRequest();
		xmlhttp.onreadystatechange = function() {
		if (this.readyState == 4 && this.status == 200) {
			var posts = document.getElementById("blog_posts");
			posts.innerHTML = this.responseText;
			if (this.response=="")
			{
				var canvas = document.getElementById("nofeedback_Kommentar");
				canvas.innerHTML='<p style="margin-top:-25px;"><label>Es wurde noch kein Feedback abgegeben</label></p> <img src="undraw_No_data.svg" alt="" class="undraw_chart_empty">';

			}
			else{
				var canvas = document.getElementById("nofeedback_Kommentar");
				canvas.innerHTML="";
			}
			}

		};

		xmlhttp.open("GET", "Kommentare_Admin.php?datum_min=" + datum_min + "&datum_max=" + datum_max + "&Leistung=" + Leistung + "&Frage=" + Frage + "&Trainer=" + Trainer, true);
		xmlhttp.send();
}

function datum_update_blog(){
	var value_min = $( "#slider-range2" ).slider( "values", 0 );
	var value_max = $( "#slider-range2" ).slider( "values", 1 );
	var output = document.getElementById("demo2");
	var datum_min = new Date();
	var datum_max = new Date();
	datum_min.setDate(datum_min.getDate() - value_min);
	datum_min = datum_min.toISOString().split('T')[0];
	datum_max.setDate(datum_max.getDate() - value_max);
	datum_max = datum_max.toISOString().split('T')[0];
	output.innerHTML = datum_min + " bis " + datum_max;
}

</script>









