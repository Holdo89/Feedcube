
<script>

var options_answers = [];

function get_options(Frage, Trainer){
    var xmlhttp_options = new XMLHttpRequest();
     xmlhttp_options.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            options_answers=this.responseText.slice(0, -1).split(",");	//diese Zeile ist notwendig weil ein string array "4,2,1,..." zur���ckgegeben wird und mit split erzeugen wir ein array und der letzte , wird entfernt mit slice
        }
    ;};

    xmlhttp_options.open("GET", "get_answers_options.php?Frage="+Frage + "&Trainer=" + Trainer, false);
    xmlhttp_options.send();
}



//Zeichnet die Charts mit dem TypColumn oder Piechart

function chartjs(typ,name){

<?php 
include "IsAdmin.php";
?>

var Frage = Auswahl_Frage.value;
var Leistung = Auswahl_Leistung.value;
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

get_options(Frage, Trainer);

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
        console.log(labeloptions);
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
        console.log(array);
        if (array[0]!="nomultiplechoice" && i==true){
		window[name] = new Chart(ctx, {
			type: typ,
			data: {
			labels: labeloptions,
			datasets: [{
            label: '# der Bewertungen',
            data: array,
            backgroundColor: [
                'rgba(255, 99, 132, 0.2)',
                'rgba(54, 162, 235, 0.2)',
                'rgba(255, 206, 86, 0.2)',
                'rgba(75, 192, 192, 0.2)',
                'rgba(153, 102, 255, 0.2)',
                'rgba(255, 159, 64, 0.2)',
                'rgba(155, 206, 86, 0.2)',
                'rgba(175, 192, 192, 0.2)',
                'rgba(153, 202, 255, 0.2)',
                'rgba(155, 159, 64, 0.2)'
            ],
            borderColor: [
                'rgba(255, 99, 132, 1)',
                'rgba(54, 162, 235, 1)',
                'rgba(255, 206, 86, 1)',
                'rgba(75, 192, 192, 1)',
                'rgba(153, 102, 255, 1)',
                'rgba(255, 159, 64, 1)',
                'rgba(155, 206, 86, 1)',
                'rgba(175, 192, 192, 1)',
                'rgba(153, 202, 255, 1)',
                'rgba(155, 159, 64, 1)'
            ],

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
    xmlhttp.open("GET", "Anzahl_der_Bewertungen.php?datum_min=" + datum_min + "&datum_max=" + datum_max + "&Leistung=" + Leistung + "&Frage=" + Frage + "&Trainer=" + Trainer, true);
    xmlhttp.send();
}

function statistics(name){
<?php 
    include "IsAdmin.php";
?>
var Frage = Auswahl_Frage.value;
var Leistung = Auswahl_Leistung.value;
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

    xmlhttp.open("GET", "Statistics.php?datum_min=" + datum_min + "&datum_max=" + datum_max + "&Leistung=" + Leistung + "&Frage=" + Frage + "&Trainer=" + Trainer, true);
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


    <?php 
    include "IsAdmin.php";
    ?>
    var Frage = Auswahl_Frage.value;
    var Leistung = Auswahl_Leistung.value;
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
    
    get_options(Frage, Trainer);
    
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
            addData(ColumnChart, array, labeloptions);
            addData(PieChart, array, labeloptions);
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
    xmlhttp.open("GET", "Anzahl_der_Bewertungen.php?datum_min=" + datum_min + "&datum_max=" + datum_max + "&Leistung=" + Leistung + "&Frage=" + Frage + "&Trainer=" + Trainer, true);
    xmlhttp.send();
    
    function addData(chart, data, label){
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









