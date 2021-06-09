<script>

//Zeichnet die Charts mit dem TypColumn oder Piechart

function trendchartjs(typ,name){

var Trainer = Auswahl_Trainer.value;
var Frage = Auswahl_Frage.value;
var Leistung = Auswahl_Leistung.value;
var value_min = $( "#slider-range" ).slider( "values", 0 );
var value_max = $( "#slider-range" ).slider( "values", 1 );
var output = document.getElementById("demo");
var datum_min = new Date();
var datum_max = new Date();
datum_min.setDate(datum_min.getDate() - value_min);
var d = datum_min;
datum_min = datum_min.toISOString().split('T')[0];
datum_max.setDate(datum_max.getDate() - value_max);
var max_date =datum_max;

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

output.innerHTML = datum_min + " bis " + datum_max;

var month = new Array();
  month[0] = 'Januar';
  month[1] = "Februar";
  month[2] = "März";
  month[3] = "April";
  month[4] = "Mai";
  month[5] = "Juni";
  month[6] = 'Juli';
  month[7] = "August";
  month[8] = "September";
  month[9] = "Oktober";
  month[10] = "November";
  month[11] = "Dezember";

var u=month_sum;
var i=max_date.getMonth();
var month_labels = new Array();
if(month_sum==0){
    month_labels.unshift("");
}

i=max_date.getMonth();
while (u>=0){

	if (i>11){
		i=i-12;
	}

	month_labels.push(month[i]);
	u=u-1;	
	i=i+1;

}

if(month_sum==0){
    month_labels.push("");
}

	var xmlhttp = new XMLHttpRequest();
	xmlhttp.onreadystatechange = function() {
      if (this.readyState == 4 && this.status == 200) {
        var array=this.responseText.split(",");		//diese Zeile ist notwendig weil ein string array "4,2,1,..." zurückgegeben wird und mit split erzeugen wir ein array
        var i=false;
        var Fragen_typ = array[1];
        if(Fragen_typ=="Multiplechoice")
            var legende = array[0].split("|");
        else
            var legende = array[0];
        var max = array[2];
        array.shift();
        array.shift();
        array.shift();
        if(Fragen_typ=="Multiplechoice"){
        var index = 0;
        var index2 =0;
        var found = false;
        var array2 = [];
        if(month_sum==0)
        {
            while(index<=array.length )
            {
                array2[index2]=[];
                while(array[index]!=";"&&index<=array.length)
                {   
                    array2[index2].push(array[index]);
                    index = index+1;
                } 
                index=index+1;
                index2=index2+1;
            }
        }
        else{
            while(index<=array.length )
            {
                index2=0;
                while(array[index]!==";" && index<=array.length)
                {
                    if(found===false)//zum definieren der arrays nötig
                    {
                        array2[index2]=[];
                    }
                    console.log("Array");
                    console.log(array);
                    array2[index2].push(array[index]);
                    index = index+1;
                    index2 = index2+1;
                } 
                found=true;
                index = index+1;
            }
        }
    }
        function isfeedbackgiven(i){ //wurde schon Feedback zu dieser Frage abgegeben wenn kein Feedbackabgegeben wird ist array 0,0,0,0...
            var u=0;  
            while (u<array.length)   
            {
                if (array[u]!=""){
                    i=true;
                }
                u=u+1;
            }
            return i;
        } 
        i=isfeedbackgiven(i);
		var ctx = document.getElementById(name);
        if (array[0]!="nomultiplechoice" && i==true){
        var autoDisplayLegendPlugin = {
  // Called at start of update.
  beforeUpdate: function(chartInstance) {
    if (chartInstance.options.autoDisplayLegend) {
      var i=0
      var length = chartInstance.data.datasets.length
      console.log("Length" + length)
      while(i<=length){
      var dataset = (chartInstance.data.datasets[i])?chartInstance.data.datasets[i]:"";
      console.log("dataset "+i+" : "+dataset.label)
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

if(Fragen_typ=="Multiplechoice"){
		window[name] = new Chart(ctx, {

			type: typ,
			data: {
			labels: month_labels,
			datasets: [
            <?php
            $sql="SELECT COUNT(Answers) As Anzahl_Antworten FROM multiplechoice_answers ORDER BY post_order_no ASC";
            $result_multi=mysqli_query($link,$sql);
            $rows_multi=mysqli_fetch_array($result_multi);

            $i=0;
            $color = ['rgba(255, 99, 132, 1)',
            'rgba(54, 162, 235, 1)',
            'rgba(255, 206, 86, 1)',
            'rgba(75, 192, 192, 1)',
            'rgba(153, 102, 255, 1)',
            'rgba(255, 159, 64, 1)',
            'rgba(155, 206, 86, 1)',
            'rgba(175, 192, 192, 1)',
            'rgba(153, 202, 255, 1)',
            'rgba(155, 159, 64, 1)'];
            
            while($i<=$rows_multi["Anzahl_Antworten"])
            {
                echo"{
                    label: legende[".$i."],
                    data: array2[".$i."],
                    borderColor: [
                        '".$color[$i]."',
                    ]
                },";
                $i = $i+1;
            }  
            ?>    
        ]
    },

    options: {
        autoDisplayLegend: true,
        scales: {
            yAxes: [{

                ticks: {

                    beginAtZero: true,

					suggestedMax: max,

                    stepSize: 1

                }

            }]

        }

    }

});}
else{
    window[name] = new Chart(ctx, {

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

scales: {

yAxes: [{

    ticks: {

        beginAtZero: true,

        suggestedMax: max,

        stepSize: 1

    }

}]

}

}

}); 
}

        }		

	}

	;};
    xmlhttp.open("GET", "Trendchart_data.php?datum_min=" + datum_min + "&datum_max=" + datum_max + "&month_sum=" + month_sum + "&Leistung=" + Leistung + "&Frage=" + Frage + "&Trainer=" + Trainer + "&Month=" + max_date.getMonth(), true);

    xmlhttp.send();

}



function drawtrendchart(){

trendchartjs('line','TrendChart');

	

}



</script>









