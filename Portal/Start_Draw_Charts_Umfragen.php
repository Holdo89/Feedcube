
<script>

var options_Umfrage = [];


function get_Umfragen(){
    var Umfrage = Auswahl_Umfrage.value;
    var xmlhttp_options = new XMLHttpRequest();
     xmlhttp_options.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            options_Umfrage=this.responseText.slice(0, -1).split(",");	//diese Zeile ist notwendig weil ein string array "4,2,1,..." zur���ckgegeben wird und mit split erzeugen wir ein array und der letzte , wird entfernt mit slice
            chartjs_Umfragen('bar','ColumnChart_Umfragen');
            piechartjs_Umfragen('doughnut','PieChart_Umfragen');
            chartjs_Umfragen('doughnut','PieChart_Umfragen_Bewertung');
            trendchartjs_Umfragen('line','TrendChart_Umfragen');
        }
    ;};

    xmlhttp_options.open("GET", "get_Umfragen.php?Umfrage="+Umfrage, true);
    xmlhttp_options.send();
}

//Zeichnet die Charts mit dem TypColumn oder Piechart

function chartjs_Umfragen(typ,name){
var charts_Umfragen = document.getElementById("charts_Umfragen");
var Umfrage = Auswahl_Umfrage.value;
var daterange = document.getElementById("zeitraum_umfragen").value;
	const DateRangeArray = daterange.split("   bis   ");
	var datum_min = DateRangeArray[1];
	var datum_max = DateRangeArray[0];	
	datum_min = new Date(datum_min);
	datum_max = new Date(datum_max);


    datum_min = datum_min.toISOString().split('T')[0];
	datum_max = datum_max.toISOString().split('T')[0];

var xmlhttp = new XMLHttpRequest();
xmlhttp.onreadystatechange = function() {
      if (this.readyState == 4 && this.status == 200) {
        document.getElementById("loader").style.display="none"
        console.log("Response Columnchart Umfrage: "+this.responseText)
		var array=this.responseText.split(",");		//diese Zeile ist notwendig weil ein string array "4,2,1,..." zur���ckgegeben wird und mit split erzeugen wir ein array
        var i=false;
        var Fragen_typ = array[0];
        var labeloptions = [];
        labeloptions=options_answers;
        var colorsteps = labeloptions.length;
        var chartcolors = [];
        var bordercolors = [];
        var hslnumber = 120;
        var hslnumber_max = 140;
        while(hslnumber >= 0){
            chartcolors.push("hsl("+hslnumber+", 75%, 50%, 0.4)");
            bordercolors.push("hsl("+hslnumber+", 75%, 50%, 1)")
            hslnumber = hslnumber - Math.round(hslnumber_max/colorsteps);
        }
        
        array.shift();
        var ctx = document.getElementById(name);
        ctx.width=280;
		window[name] = new Chart(ctx, {
			type: typ,
			data: {
			labels: labeloptions,
			datasets: [{
            label: '# der Bewertungen',
            data: array,
            backgroundColor: chartcolors,
            borderColor: bordercolors,

            borderWidth: 1
        }]
    },

    options: {
        responsive: true,
         legend: {
            display: false
         },
         title: {
            display: true,
            text: 'Wie wurde insgesamt bewertet?'
        }
        }
});
    }
	;};
    xmlhttp.open("GET", "Start_Anzahl_der_Bewertungen_Umfragen.php?datum_min=" + datum_min + "&datum_max=" + datum_max + "&Umfrage=" + Umfrage, false);
    xmlhttp.send();
}


function piechartjs_Umfragen(typ,name){
    var charts = document.getElementById("charts_Umfragen");
    var Umfrage = Auswahl_Umfrage.value;
    var daterange = document.getElementById("zeitraum_umfragen").value;
	const DateRangeArray = daterange.split("   bis   ");
	var datum_min = DateRangeArray[1];
	var datum_max = DateRangeArray[0];	
	datum_min = new Date(datum_min);
	datum_max = new Date(datum_max);


    datum_min = datum_min.toISOString().split('T')[0];
	datum_max = datum_max.toISOString().split('T')[0];

    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function() {
      if (this.readyState == 4 && this.status == 200) {
        console.log("Piechart Responsetest: "+this.responseText)
		var array=this.responseText.split(",");		//diese Zeile ist notwendig weil ein string array "4,2,1,..." zur���ckgegeben wird und mit split erzeugen wir ein array
        var i=false;
        var Fragen_typ = array[0];
        var labeloptions = [];

        labeloptions=options_Umfrage;
        array.shift();
        var colorsteps = -2;
        for(let i=0; i<=array.length;i++)
        {
            if(array[i]!="0")
            {
                colorsteps = colorsteps+1;
            }
            else{
                array.splice(i,1)
                i=i-1;
            }
        }

        var chartcolors = [];
        var bordercolors = [];
            var hslnumber = 0;
            while(hslnumber <= 360){
                chartcolors.push("hsl("+hslnumber+", 75%, 50%, 0.4)");
                bordercolors.push("hsl("+hslnumber+", 75%, 50%, 1)")
                hslnumber = hslnumber + 360/colorsteps;
            }

        var ctx = document.getElementById(name);
        ctx.width=280;
		window[name] = new Chart(ctx, {
			type: typ,
			data: {
			labels: labeloptions,
			datasets: [{
            data: array,
            backgroundColor: chartcolors,
            borderColor: bordercolors,
            borderWidth: 1
        }]
    },

    options: {
        responsive: true,
         legend: {
            display: false
         },
         title: {
            display: true,
            text: 'Welche Umfragen wurden bewertet?'
        }
        }
    });
    }
	;};
    xmlhttp.open("GET", "Start_Anzahl_der_Bewertungen_nach_Umfragen.php?datum_min=" + datum_min + "&datum_max=" + datum_max + "&Umfrage=" + Umfrage, false);
    xmlhttp.send();
}


function drawcharts_Umfragen(){  
get_Umfragen();

}

function update_umfragen(){
    document.getElementById("loader").style.display="block"
    var Umfrage = Auswahl_Umfrage.value;
    var AuswahlZeitraum = document.getElementById("AuswahlZeitraum");
	var daterange = document.getElementById("zeitraum_umfragen").value;
	const DateRangeArray = daterange.split("   bis   ");
	var datum_min = DateRangeArray[1];
	var datum_max = DateRangeArray[0];	
	datum_min = new Date(datum_min);
	datum_max = new Date(datum_max);


    datum_min = datum_min.toISOString().split('T')[0];
	datum_max = datum_max.toISOString().split('T')[0];
		var dashboard = document.getElementById("startdashboard_umfragen");
		var xmlhttp_options = new XMLHttpRequest();
     	xmlhttp_options.onreadystatechange = function() {
			if (this.readyState == 4 && this.status == 200) {
				dashboard.innerHTML=this.responseText;
                if(this.responseText.indexOf("Es wurde noch kein Feedback abgegeben")!=-1)
                {
                    document.getElementById("pdf_Umfragen").style.display="none";
                }
			}
    	;};
    	xmlhttp_options.open("GET", "Start_Dashboard_Umfragen.php?datum_min=" + datum_min + "&datum_max=" + datum_max + "&Umfrage=" + Umfrage, false);
    	xmlhttp_options.send();

    update_initiate_umfragen();
}


function update_initiate_umfragen(){

    drawcharts_Umfragen();
}

function updateAuswahlFragen(){
    update_umfragen();
}


</script>









