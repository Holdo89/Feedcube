<script>

var options_answers = [];

function get_options(Frage){
    var xmlhttp_options = new XMLHttpRequest();
     xmlhttp_options.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            options_answers=this.responseText.slice(0, -1).split(",");	//diese Zeile ist notwendig weil ein string array "4,2,1,..." zurückgegeben wird und mit split erzeugen wir ein array und der letzte , wird entfernt mit slice
        }
    ;};

    xmlhttp_options.open("GET", "get_answers_intern.php?Frage="+Frage, true);
    xmlhttp_options.send();
}

//Zeichnet die Charts mit dem TypColumn oder Piechart
function chartjs(typ,name){

var Frage = Auswahl_Frage.value;
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

get_options(Frage);

var xmlhttp = new XMLHttpRequest();
xmlhttp.onreadystatechange = function() {
      if (this.readyState == 4 && this.status == 200) {
		var array=this.responseText.split(",");		//diese Zeile ist notwendig weil ein string array "4,2,1,..." zurückgegeben wird und mit split erzeugen wir ein array
        var i=false;
        var Fragen_typ = array[0];
        var labeloptions = [];
        if (Fragen_typ=="Schieberegler"){
            labeloptions=array[1].split(";");
            array.shift();
        }
        else{
            //get_options(Frage, Fragen_typ);
            labeloptions=options_answers
        }
        var colorsteps = labeloptions.length;
        var chartcolors = [];
        var bordercolors = [];
        if (Fragen_typ=="Singlechoice"){
            var hslnumber = 120;
            var hslnumber_max = 140;
            while(hslnumber >= 0){
                chartcolors.push("hsl("+hslnumber+", 75%, 50%, 0.4)");
                bordercolors.push("hsl("+hslnumber+", 75%, 50%, 1)")
                hslnumber = hslnumber - Math.round(hslnumber_max/colorsteps);
            }
        }
        else if (Fragen_typ=="Multiplechoice"){
            var hslnumber = 160;
            while(hslnumber <= 1000){
                chartcolors.push("hsl("+hslnumber+", 75%, 50%, 0.4)");
                bordercolors.push("hsl("+hslnumber+", 75%, 50%, 1)")
                hslnumber = hslnumber + 50;
            }
        }
        else if (Fragen_typ=="Schieberegler"){
            var hslnumber = 0;
            var hslnumber_max = 120;
            while(hslnumber <= 120){
                chartcolors.push("hsl("+hslnumber+", 70%, 50%, 0.4)");
                bordercolors.push("hsl("+hslnumber+", 70%, 50%, 1)")
                hslnumber = hslnumber + Math.round(hslnumber_max/colorsteps);
            }
        }

        array.shift();
        function isfeedbackgiven(i){ //wurde schon Feedback zu dieser Frage abgegeben wenn kein Feedbackabgegeben wird ist array 0,0,0,0...
            var u=0;  
            while (u<array.length)   
            {
                if (array[u]!=0){
                    i=true;
                }
                u=u+1;
            }
            return i;
        } 
        i=isfeedbackgiven(i);
        var ctx = document.getElementById(name);
        ctx.width=280;
        if (array[0]!="nomultiplechoice" && i==true){
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
        scales: {
            yAxes: [{
                ticks: {
                    beginAtZero: true
                }
            }]
        }
    }
});
    var canvas = document.getElementById("nofeedback");
    canvas.innerHTML="";
    canvas.style.marginTop=0;
      }	
    else{
        var canvas = document.getElementById("nofeedback");
        canvas.innerHTML="Es wurde noch kein Feedback abgegeben";
        canvas.style.marginTop="50px";
    }
    }
	;};
    xmlhttp.open("GET", "intern_Anzahl_der_Bewertungen.php?datum_min=" + datum_min + "&datum_max=" + datum_max + "&Frage=" + Frage, true);
    xmlhttp.send();
}

function statistics(name){

var Frage = Auswahl_Frage.value;
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

	var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function() {
      if (this.readyState == 4 && this.status == 200) {
        var array=this.responseText;
        var ctx = document.getElementById(name);	
        if (array.includes("# Bewertungen: 0"))
        {
            ctx.innerHTML = "";
            ctx.width=1000;
            ctx.style.backgroundImage="none";
        }
        else{
            ctx.innerHTML = array;
            ctx.style.backgroundImage="url(background_statistic.jpg)"
        }
        }
      }

    xmlhttp.open("GET", "Intern_Statistics.php?datum_min=" + datum_min + "&datum_max=" + datum_max + "&Frage=" + Frage, true);
    xmlhttp.send();
}

function drawcharts(){
    chartjs('bar','ColumnChart');
    chartjs('pie','PieChart');
    statistics('Statistics');
}

function update(){
    var ctx = document.getElementById("ColumnChart");
    var trendctx = document.getElementById("TrendChart");
    trendctx.style.display="block";
    if(ctx.getAttribute("height")!=160){ //check if chart was already created
    var Frage = Auswahl_Frage.value;
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
    
    get_options(Frage);
    
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function() {
      if (this.readyState == 4 && this.status == 200) {
		var array=this.responseText.split(",");		//diese Zeile ist notwendig weil ein string array "4,2,1,..." zur���ckgegeben wird und mit split erzeugen wir ein array
        var i=false;
        var Fragen_typ = array[0];
        var labeloptions = [];
        if (Fragen_typ=="Schieberegler"){
            labeloptions=array[1].split(";");
            array.shift();
        }
        else{
            labeloptions=options_answers
        }
        var colorsteps = labeloptions.length;
        var chartcolors = [];
        var bordercolors = [];
        if (Fragen_typ=="Singlechoice"){
            var hslnumber = 120;
            var hslnumber_max = 140;
            while(hslnumber >= 0){
                chartcolors.push("hsl("+hslnumber+", 75%, 50%, 0.4)");
                bordercolors.push("hsl("+hslnumber+", 75%, 50%, 1)")
                hslnumber = hslnumber - Math.round(hslnumber_max/colorsteps);
            }
        }
        else if (Fragen_typ=="Multiplechoice"){
            var hslnumber = 160;
            while(hslnumber <= 1000){
                chartcolors.push("hsl("+hslnumber+", 75%, 50%, 0.4)");
                bordercolors.push("hsl("+hslnumber+", 75%, 50%, 1)")
                hslnumber = hslnumber + 50;
            }
        }
        else if (Fragen_typ=="Schieberegler"){
            var hslnumber = 0;
            var hslnumber_max = 120;
            while(hslnumber <= 120){
                chartcolors.push("hsl("+hslnumber+", 70%, 50%, 0.4)");
                bordercolors.push("hsl("+hslnumber+", 70%, 50%, 1)")
                hslnumber = hslnumber + Math.round(hslnumber_max/colorsteps);
            }
        }
        array.shift();
        function isfeedbackgiven(i){ //wurde schon Feedback zu dieser Frage abgegeben wenn kein Feedbackabgegeben wird ist array 0,0,0,0...
            var u=0;  
            while (u<array.length)   
            {
                if (array[u]!=0){
                    i=true;
                }
                u=u+1;
            }
            return i;
        } 
        i=isfeedbackgiven(i);
         if (array[0]!="nomultiplechoice" && i==true){
            addData(ColumnChart, array, labeloptions, chartcolors, bordercolors);
            addData(PieChart, array, labeloptions, chartcolors, bordercolors);
         }
         else{
            ColumnChart.destroy();
            PieChart.destroy();
            trendctx.style.display="none";
            var canvas = document.getElementById("nofeedback");
            canvas.innerHTML="Es wurde noch kein Feedback abgegeben";
            canvas.style.marginTop="50px";  
         }
    }
	;};
    xmlhttp.open("GET", "intern_Anzahl_der_Bewertungen.php?datum_min=" + datum_min + "&datum_max=" + datum_max + "&Frage=" + Frage, true);
    xmlhttp.send();
    
    function addData(chart, data, label, chartcolors, bordercolors){
        console.log("labels")
        console.log(label);
        var u=0;
      
        while(u<100)
        {
            chart.data.labels.pop();
            chart.data.datasets.forEach((dataset) => {
            dataset.data.pop();
            });
            u=u+1;
        }
        chart.update();

        var u=0;
        while(u<data.length-1)
        {
            chart.data.datasets.forEach((dataset) => {
            chart.data.labels.push(label[u]);
            dataset.data.push(data[u]);
            console.log(data);
            });
            u=u+1;
        }
        chart.data.datasets[0].backgroundColor= chartcolors;  
        chart.data.datasets[0].borderColor= bordercolors;
        chart.update();
    } 
    statistics('Statistics'); 
    TrendChart.destroy()
    drawtrendchart();
    }
    else{
	drawcharts();
    drawtrendchart();
}
}



function update_initiate(){
	drawcharts();
    drawtrendchart();
}

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

</script>









