
<script>

options_answers=[]
options_Leistungen=[]
options_Trainers=[]
function get_options(){
    var xmlhttp_options = new XMLHttpRequest();
     xmlhttp_options.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            options_answers=this.responseText.slice(0, -1).split(",");	//diese Zeile ist notwendig weil ein string array "4,2,1,..." zur���ckgegeben wird und mit split erzeugen wir ein array und der letzte , wird entfernt mit slice
            chartjs('bar','ColumnChart');
        }
    ;};

    xmlhttp_options.open("GET", "Start_get_answers_options.php", true);
    xmlhttp_options.send();
}


function get_Leistungen(){
    var Leistung = Auswahl_Leistung.value;
    console.log("Kurs:"+Leistung)
    var xmlhttp_options = new XMLHttpRequest();
     xmlhttp_options.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            options_Leistungen=this.responseText.slice(0, -1).split(",");	//diese Zeile ist notwendig weil ein string array "4,2,1,..." zur���ckgegeben wird und mit split erzeugen wir ein array und der letzte , wird entfernt mit slice
            piechartjs('doughnut','PieChart');
        }
    ;};

    xmlhttp_options.open("GET", "get_Leistungen.php?Leistung="+Leistung, true);
    xmlhttp_options.send();
}

function get_Trainers(){
    var Trainer = Auswahl_Trainer.value;
    var xmlhttp_options = new XMLHttpRequest();
     xmlhttp_options.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            options_Trainers=this.responseText.slice(0, -1).split(",");	//diese Zeile ist notwendig weil ein string array "4,2,1,..." zur���ckgegeben wird und mit split erzeugen wir ein array und der letzte , wird entfernt mit slice
            piecharttrainerjs('doughnut','PieChartTrainer');
            trendchartjs('line','TrendChart');
        }
    ;};

    xmlhttp_options.open("GET", "get_Trainers.php?Trainer="+Trainer, true);
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
    xmlhttp.open("GET", "Start_Anzahl_der_Bewertungen.php?datum_min=" + datum_min + "&datum_max=" + datum_max + "&Leistung=" + Leistung + "&Trainer=" + Trainer, true);
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
    xmlhttp.open("GET", "Start_Anzahl_der_Bewertungen_nach_Leistungen.php?datum_min=" + datum_min + "&datum_max=" + datum_max + "&Leistung=" + Leistung + "&Trainer=" + Trainer, true);
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

var xmlhttp = new XMLHttpRequest();
xmlhttp.onreadystatechange = function() {
      if (this.readyState == 4 && this.status == 200) {
        document.getElementById("loader").style.display="none"
        document.getElementById("startdashboard").style.display="block"
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
    xmlhttp.open("GET", "Start_Anzahl_der_Bewertungen_nach_Trainer.php?datum_min=" + datum_min + "&datum_max=" + datum_max + "&Leistung=" + Leistung + "&Trainer=" + Trainer, true);
    xmlhttp.send();
}


function drawcharts(){  
    get_options();
    get_Leistungen();
    get_Trainers();
}

function update(){
    document.getElementById("loader").style.display="block"
    document.getElementById("startdashboard").style.display="none"
	var Trainer = Auswahl_Trainer.value;
    var Avatar = document.getElementById("avatarselect");
    if(Trainer!="" && Trainer!="%25")
    {
    var xmlhttp_avatar = new XMLHttpRequest();
     	xmlhttp_avatar.onreadystatechange = function() {
			if (this.readyState == 4 && this.status == 200) {
                Avatar.innerHTML=this.responseText;
			}
    	;};
    	xmlhttp_avatar.open("GET", "showAvatarChosenTrainer.php?Trainer=" + Trainer, true);
    	xmlhttp_avatar.send();
    }
    else{
        Avatar.innerHTML="";
    }
    var Leistung = Auswahl_Leistung.value;
    var AuswahlZeitraum = document.getElementById("AuswahlZeitraum");
	var daterange = document.getElementById("zeitraum").value;
    console.log("date:"+daterange)
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
				dashboard.innerHTML=this.responseText;
                if(this.responseText.indexOf("Es wurde noch kein Feedback abgegeben")!=-1)
                {
                    document.getElementById("pdf").style.display="none";
                }
			}
    	;};
    	xmlhttp_options.open("GET", "Start_Dashboard.php?datum_min=" + datum_min + "&datum_max=" + datum_max + "&Leistung=" + Leistung + "&Trainer=" + Trainer, true);
    	xmlhttp_options.send();
        update_initiate();
}


function update_initiate(){
    drawcharts();
}


</script>









