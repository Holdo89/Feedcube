
<script>

var options_answers = [];

function get_options(){
    var xmlhttp_options = new XMLHttpRequest();
     xmlhttp_options.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            options_answers=this.responseText.slice(0, -1).split(",");	//diese Zeile ist notwendig weil ein string array "4,2,1,..." zur���ckgegeben wird und mit split erzeugen wir ein array und der letzte , wird entfernt mit slice
        }
    ;};

    xmlhttp_options.open("GET", "Start_get_answers_options.php", false);
    xmlhttp_options.send();
}


function get_Leistungen(Leistung){
    console.log("Leistung:"+Leistung)
    var xmlhttp_options = new XMLHttpRequest();
     xmlhttp_options.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            options_Leistungen=this.responseText.slice(0, -1).split(",");	//diese Zeile ist notwendig weil ein string array "4,2,1,..." zur���ckgegeben wird und mit split erzeugen wir ein array und der letzte , wird entfernt mit slice
        }
    ;};

    xmlhttp_options.open("GET", "get_Leistungen.php?Leistung="+Leistung, false);
    xmlhttp_options.send();
}

function get_Trainers(Trainer){
    var xmlhttp_options = new XMLHttpRequest();
     xmlhttp_options.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            options_Trainers=this.responseText.slice(0, -1).split(",");	//diese Zeile ist notwendig weil ein string array "4,2,1,..." zur���ckgegeben wird und mit split erzeugen wir ein array und der letzte , wird entfernt mit slice
        }
    ;};

    xmlhttp_options.open("GET", "get_Trainers.php?Trainer="+Trainer, false);
    xmlhttp_options.send();
}



//Zeichnet die Charts mit dem TypColumn oder Piechart

function chartjs(typ,name){
var charts = document.getElementById("charts");
var Trainer = Auswahl_Trainer.value;
var Leistung = Auswahl_Leistung.value;
var AuswahlZeitraum = document.getElementById("AuswahlZeitraum");
var daterange = document.getElementById("zeitraum").value;
	const DateRangeArray = daterange.split("   bis   ");
	var datum_min = DateRangeArray[1];
	var datum_max = DateRangeArray[0];	
	datum_min = new Date(datum_min);
	datum_max = new Date(datum_max);


    datum_min = datum_min.toISOString().split('T')[0];
	datum_max = datum_max.toISOString().split('T')[0];

get_options();

var xmlhttp = new XMLHttpRequest();
xmlhttp.onreadystatechange = function() {
      if (this.readyState == 4 && this.status == 200) {
        console.log("Response Columnchart: "+this.responseText)
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
    }
});
    }
	;};
    xmlhttp.open("GET", "Start_Anzahl_der_Bewertungen.php?datum_min=" + datum_min + "&datum_max=" + datum_max + "&Leistung=" + Leistung + "&Trainer=" + Trainer, false);
    xmlhttp.send();
}


function piechartjs(typ,name){
var charts = document.getElementById("charts");
var Trainer = Auswahl_Trainer.value;
var Leistung = Auswahl_Leistung.value;
var AuswahlZeitraum = document.getElementById("AuswahlZeitraum");
var daterange = document.getElementById("zeitraum").value;
	const DateRangeArray = daterange.split("   bis   ");
	var datum_min = DateRangeArray[1];
	var datum_max = DateRangeArray[0];	
	datum_min = new Date(datum_min);
	datum_max = new Date(datum_max);


    datum_min = datum_min.toISOString().split('T')[0];
	datum_max = datum_max.toISOString().split('T')[0];

get_Leistungen(Leistung);

var xmlhttp = new XMLHttpRequest();
xmlhttp.onreadystatechange = function() {
      if (this.readyState == 4 && this.status == 200) {
        console.log("Response: "+this.responseText)
		var array=this.responseText.split(",");		//diese Zeile ist notwendig weil ein string array "4,2,1,..." zur���ckgegeben wird und mit split erzeugen wir ein array
        var i=false;
        var Fragen_typ = array[0];
        var labeloptions = [];

        labeloptions=options_Leistungen;
        array.shift();
        var colorsteps = -2;
        for(let i=0; i<=array.length;i++)
        {
            if(array[i]!="0")
            {
                colorsteps = colorsteps+1;
            }
            else{
                labeloptions.splice(i,1)
                array.splice(i,1)
                i=i-1;
            }
        }
        console.log("array after: "+array)
        console.log("steps:"+colorsteps);
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
            text: 'Welche Leistungen wurden bewertet?'
        }
        }
    });
    }
	;};
    xmlhttp.open("GET", "Start_Anzahl_der_Bewertungen_nach_Leistungen.php?datum_min=" + datum_min + "&datum_max=" + datum_max + "&Leistung=" + Leistung + "&Trainer=" + Trainer, false);
    xmlhttp.send();
}


function piecharttrainerjs(typ,name){
var charts = document.getElementById("charts");
var Trainer = Auswahl_Trainer.value;
var Leistung = Auswahl_Leistung.value;
var AuswahlZeitraum = document.getElementById("AuswahlZeitraum");
var daterange = document.getElementById("zeitraum").value;
	const DateRangeArray = daterange.split("   bis   ");
	var datum_min = DateRangeArray[1];
	var datum_max = DateRangeArray[0];	
	datum_min = new Date(datum_min);
	datum_max = new Date(datum_max);


    datum_min = datum_min.toISOString().split('T')[0];
	datum_max = datum_max.toISOString().split('T')[0];

get_Trainers(Trainer);

var xmlhttp = new XMLHttpRequest();
xmlhttp.onreadystatechange = function() {
      if (this.readyState == 4 && this.status == 200) {
        console.log("ResponseTrainers: "+this.responseText)
		var array=this.responseText.split(",");		//diese Zeile ist notwendig weil ein string array "4,2,1,..." zur���ckgegeben wird und mit split erzeugen wir ein array
        console.log("array: "+array)
        var i=false;
        var Fragen_typ = array[0];
        var labeloptions = [];
        labeloptions=options_Trainers;
        array.shift();
        var colorsteps = -2; //Auf Grund von NUll am Ende und am Anfang
        for(let i=0; i<=array.length;i++)
        {
            if(array[i]!="0")
            {
                colorsteps = colorsteps+1;
            }
            else{
                labeloptions.splice(i,1)
                array.splice(i,1)
                i=i-1;
            }
        }
        console.log("array after: "+array)

        console.log("stepsTrainer:"+colorsteps);
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
            text: 'Welche Trainer wurden bewertet?'
        }
        }
    });
    }
	;};
    xmlhttp.open("GET", "Start_Anzahl_der_Bewertungen_nach_Trainer.php?datum_min=" + datum_min + "&datum_max=" + datum_max + "&Leistung=" + Leistung + "&Trainer=" + Trainer, false);
    xmlhttp.send();
}


function drawcharts(){  
    chartjs('bar','ColumnChart');
    piechartjs('doughnut','PieChart');
    piecharttrainerjs('doughnut','PieChartTrainer');
}

function update(){
	var Trainer = Auswahl_Trainer.value;
    var Leistung = Auswahl_Leistung.value;
    var AuswahlZeitraum = document.getElementById("AuswahlZeitraum");
	var daterange = document.getElementById("zeitraum").value;
	const DateRangeArray = daterange.split("   bis   ");
	var datum_min = DateRangeArray[1];
	var datum_max = DateRangeArray[0];	
	datum_min = new Date(datum_min);
	datum_max = new Date(datum_max);


    datum_min = datum_min.toISOString().split('T')[0];
	datum_max = datum_max.toISOString().split('T')[0];
		var dashboard = document.getElementById("startdashboard");
		var xmlhttp_options = new XMLHttpRequest();
     	xmlhttp_options.onreadystatechange = function() {
			if (this.readyState == 4 && this.status == 200) {
                console.log(this.responseText)
				dashboard.innerHTML=this.responseText;
                if(this.responseText.indexOf("Es wurde noch kein Feedback abgegeben")!=-1)
                {
                    document.getElementById("pdf").style.display="none";
                }
			}
    	;};
    	xmlhttp_options.open("GET", "Start_Dashboard.php?datum_min=" + datum_min + "&datum_max=" + datum_max + "&Leistung=" + Leistung + "&Trainer=" + Trainer, false);
    	xmlhttp_options.send();

	//get_datediff();
    try{
        update_initiate();
    }
    catch{
        console.log("catched");
    update_initiate();
    }
}


function update_initiate(){
    try{
    //ColumnChart.destroy();
    //PieChart.destroy();
    //TrendChart.destroy();
        }
    catch{
        console.log("Chart was created first time");
    }
    drawcharts();
    drawtrendchart();
}


</script>









