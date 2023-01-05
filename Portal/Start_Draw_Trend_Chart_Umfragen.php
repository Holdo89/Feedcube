<script>

//Zeichnet die Charts mit dem TypColumn oder Piechart

function trendchartjs_Umfragen(typ,name){

var Umfrage = Auswahl_Umfrage.value;
var AuswahlZeitraum = document.getElementById("AuswahlZeitraum");
var daterange = document.getElementById("zeitraum_umfragen").value;
	const DateRangeArray = daterange.split("   bis   ");
	var datum_min = DateRangeArray[1];
	var datum_max = DateRangeArray[0];	
	datum_min = new Date(datum_min);
	datum_max = new Date(datum_max);

    var max_date = datum_max;

    datum_min = datum_min.toISOString().split('T')[0];
	datum_max = datum_max.toISOString().split('T')[0];

var diffyear = parseInt(datum_min.substring(0,4))-parseInt(datum_max.substring(0,4))
var month_min = parseInt(datum_min.substring(5,7));
var month_max = parseInt(datum_max.substring(5,7));
var month_sum=0;
if(diffyear>0){
while(diffyear>=1)
{
    month_sum =month_sum + month_min;
    if (diffyear>1){
        month_sum =month_sum + 11
    }
    else{
        month_sum =month_sum + (12-month_max)
    }
    diffyear=diffyear-1;
}
}
else{
    month_sum = month_min-month_max;
}

//var diffmonth = parseInt(datum_min.substring(5,7))-parseInt(datum_max.substring(5,7))


var month = new Array();
  month[0] = 'Jan';
  month[1] = "Feb";
  month[2] = "März";
  month[3] = "Apr";
  month[4] = "Mai";
  month[5] = "Jun";
  month[6] = 'Jul';
  month[7] = "Aug";
  month[8] = "Sept";
  month[9] = "Okt";
  month[10] = "Nov";
  month[11] = "Dez";

var u=month_sum;
var i=max_date.getMonth();
var month_labels = new Array();
if(month_sum==0){
    month_labels.unshift("");
}

var currentYear = new Date().getFullYear();
diffyear = parseInt(datum_min.substring(0,4))-parseInt(datum_max.substring(0,4))
currentYear = parseInt(datum_min.substring(0,4))- diffyear
i=max_date.getMonth();
while (u>=0){

	if (i>11){
		i=i-12;
        currentYear=currentYear+1
	}

	month_labels.push(month[i]+" "+currentYear);
	u=u-1;	
	i=i+1;

}

if(month_sum==0){
    month_labels.push("");
}

	var xmlhttp = new XMLHttpRequest();
	xmlhttp.onreadystatechange = function() {
      if (this.readyState == 4 && this.status == 200) {
        console.log("trendchartdata:"+this.responseText)
        var array=this.responseText.split(",");		//diese Zeile ist notwendig weil ein string array "4,2,1,..." zurückgegeben wird und mit split erzeugen wir ein array
        var i=false;
        var legende = array[0];
        array.shift();

		var ctx = document.getElementById(name);
        if (array[0]!="nomultiplechoice"){
        var autoDisplayLegendPlugin = {
  // Called at start of update.
  beforeUpdate: function(chartInstance) {
    if (chartInstance.options.autoDisplayLegend) {
      var i=0
      var length = chartInstance.data.datasets.length
      while(i<=length){
      var dataset = (chartInstance.data.datasets[i])?chartInstance.data.datasets[i]:"";
      if (dataset.label==="")
      {
        chartInstance.data.datasets.splice(i);
        length = length-1;
      }  

    else{
        chartInstance.options.legend.display = true;
    }
        i=i+1;
    }
    }
  }
};

Chart.pluginService.register(autoDisplayLegendPlugin);

    Trendy = new Chart(ctx, {

type: typ,

data: {

labels: month_labels,

datasets: [{

label: legende,

data: array,

borderColor: [

    'rgba(54, 162, 235, 1)',

]

}]

},

options: {


        responsive: true,
         legend: {
            display: false
         },
         title: {
            display: true,
            text: 'Wann wurde wie häufig bewertet?'
        },

scales: {

yAxes: [{

    ticks: {

        beginAtZero: true,
        stepSize: 1

    }

}]

}

}

}); 
        }		

	}

	;};
    xmlhttp.open("GET", "Start_Trendchart_data_Umfragen.php?datum_min=" + datum_min + "&datum_max=" + datum_max + "&month_sum=" + month_sum + "&Umfrage=" + Umfrage + "&Month=" + max_date.getMonth(), true);

    xmlhttp.send();
}

function drawtrendchart_Umfragen(){

console.log("DrawTrendUmfragen");
trendchartjs_Umfragen('line','TrendChart_Umfragen');

}



</script>









