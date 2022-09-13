<script>

var options_answers = [];

function get_options(Frage){
    var xmlhttp_options = new XMLHttpRequest();
     xmlhttp_options.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            options_answers=this.responseText.slice(0, -1).split(",");	//diese Zeile ist notwendig weil ein string array "4,2,1,..." zurückgegeben wird und mit split erzeugen wir ein array und der letzte , wird entfernt mit slice
        }
    ;};

    xmlhttp_options.open("GET", "get_answers_intern.php?Frage="+Frage, false);
    xmlhttp_options.send();
}

//Zeichnet die Charts mit dem TypColumn oder Piechart
function chartjs(typ,name){
var charts = document.getElementById("charts");
var Frage = Auswahl_Frage.value;
var AuswahlZeitraum = document.getElementById("AuswahlZeitraum");
var daterange = document.getElementById("zeitraum").value;
console.log("Datum"+daterange);
const DateRangeArray = daterange.split("   bis   ");
var datum_min = DateRangeArray[1];
var datum_max = DateRangeArray[0];
console.log("Datum"+datum_min);	
datum_min = new Date(datum_min);
datum_max = new Date(datum_max);

console.log("Datum"+datum_min);

datum_min = datum_min.toISOString().split('T')[0];
datum_max = datum_max.toISOString().split('T')[0];

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
        if (Fragen_typ=="Bewertung"){
            var hslnumber = 120;
            var hslnumber_max = 140;
            while(hslnumber >= 0){
                chartcolors.push("hsl("+hslnumber+", 75%, 50%, 0.4)");
                bordercolors.push("hsl("+hslnumber+", 75%, 50%, 1)")
                hslnumber = hslnumber - Math.round(hslnumber_max/colorsteps);
            }
        }
        else if (Fragen_typ=="Multiplechoice"){
            var hslnumber = 0;
            while(hslnumber <= 360){
                chartcolors.push("hsl("+hslnumber+", 75%, 50%, 0.4)");
                bordercolors.push("hsl("+hslnumber+", 75%, 50%, 1)")
                hslnumber = hslnumber + 360/colorsteps;
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
    }
});
undraw_empty.style.display="none";
      }	
    else{
        undraw_empty.style.display="block";
        }
    }
	;};
    xmlhttp.open("GET", "intern_Anzahl_der_Bewertungen.php?datum_min=" + datum_min + "&datum_max=" + datum_max + "&Frage=" + Frage, true);
    xmlhttp.send();
}

function statistics(name){

var Frage = Auswahl_Frage.value;
var AuswahlZeitraum = document.getElementById("AuswahlZeitraum");
var daterange = document.getElementById("zeitraum").value;
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
        var array=this.responseText;
        var ctx = document.getElementById(name);	
        if (array.includes("# Bewertungen: 0"))
        {
            ctx.innerHTML = "";
            ctx.width=1000;
            ctx.style.display="none";
        }
        else{
            ctx.innerHTML = array;
            ctx.style.display="block";
        }
        }
      }

    xmlhttp.open("GET", "Intern_Statistics.php?datum_min=" + datum_min + "&datum_max=" + datum_max + "&Frage=" + Frage, true);
    xmlhttp.send();
}

function drawcharts(){
    chartjs('bar','ColumnChart');
    chartjs('doughnut','PieChart');
    statistics('Statistics');
}
//
//
function update(){
    try{
    console.log("Test")
    var array="";
    var Fragen_Typ="";
    var xmlhttp = new XMLHttpRequest();
    var i = true;
    var Frage = Auswahl_Frage.value;
    var AuswahlZeitraum = document.getElementById("AuswahlZeitraum");
    var daterange = document.getElementById("zeitraum").value;
	const DateRangeArray = daterange.split("   bis   ");
	var datum_min = DateRangeArray[1];
	var datum_max = DateRangeArray[0];	
	datum_min = new Date(datum_min);
	datum_max = new Date(datum_max);


    datum_min = datum_min.toISOString().split('T')[0];
	datum_max = datum_max.toISOString().split('T')[0];

    get_options(Frage);    
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function() {
      if (this.readyState == 4 && this.status == 200) {
        console.log("Response: "+this.responseText)

		array=this.responseText.split(",");		//diese Zeile ist notwendig weil ein string array "4,2,1,..." zur���ckgegeben wird und mit split erzeugen wir ein array
        i=false;
        Fragen_typ = array[0];
    }
	;};
    xmlhttp.open("GET", "intern_Anzahl_der_Bewertungen.php?datum_min=" + datum_min + "&datum_max=" + datum_max + "&Frage=" + Frage, false);
    xmlhttp.send();
    var undraw_empty= document.getElementById("undraw_empty");
	undraw_empty.style.display="none";
	var blog = document.getElementById("Kommentare");
    var charts = document.getElementById("charts");
    var ctx = document.getElementById("ColumnChart");
    var trendctx = document.getElementById("TrendChart");
    trendctx.style.display="block";
    var undraw_empty = document.getElementById("undraw_empty");
    get_options(Frage);
    console.log("Fragentyp: "+Fragen_Typ)
        if(Fragen_typ!="")
        {
        blog.style.display="none";
        charts.style.display="grid";
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
        if (Fragen_typ=="Bewertung"){
            var hslnumber = 120;
            var hslnumber_max = 140;
            while(hslnumber >= 0){
                chartcolors.push("hsl("+hslnumber+", 75%, 50%, 0.4)");
                bordercolors.push("hsl("+hslnumber+", 75%, 50%, 1)")
                hslnumber = hslnumber - Math.round(hslnumber_max/colorsteps);
            }
        }
        else if (Fragen_typ=="Multiplechoice"){
            var hslnumber = 0;
            while(hslnumber <= 360){
                chartcolors.push("hsl("+hslnumber+", 75%, 50%, 0.4)");
                bordercolors.push("hsl("+hslnumber+", 75%, 50%, 1)")
                hslnumber = hslnumber + 360/colorsteps;
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
            try{
            ColumnChart.destroy();
            PieChart.destroy();
             }
             catch{
                 "Columnchart was created first time"
             }
            trendctx.style.display="none";
            undraw_empty.style.display="block";           
        }
        }
        else
        create_blog_posts();
    
    function addData(chart, data, label, chartcolors, bordercolors){
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
            });
            u=u+1;
        }
        chart.data.datasets[0].backgroundColor= chartcolors;  
        chart.data.datasets[0].borderColor= bordercolors;
        chart.update();
    } 
    statistics('Statistics'); 
    try{
    TrendChart.destroy()
    }
    catch{
        console.log("Chart was created first time")
    }
    drawtrendchart();
    }
    catch{
    update_initiate();
    }
}

function updateAuswahlFragen(){
    var id = document.getElementById("Auswahl_Umfrage").value;
    console.log(id);
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            document.getElementById("Auswahl_Frage").innerHTML=this.responseText;
        }
    }
    xmlhttp.open("GET", "update_intern_Auswahlmoeglichkeiten_Fragen.php?ID="+id, false);
    xmlhttp.send();
    update();
}

function update_initiate(){
    console.log("Testinit")
    try{
    ColumnChart.destroy();
    PieChart.destroy();
    //TrendChart.destroy();
        }
    catch{
        console.log("Chart was created first time");
    }
    drawcharts();
    drawtrendchart();
}


</script>









