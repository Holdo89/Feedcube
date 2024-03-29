<?php
 require_once "../config.php";
 require_once "session.php";

 $sql = "SELECT Is_Admin FROM users WHERE username = '".$_SESSION["username"]."'";
 $result = mysqli_query($link, $sql);
 $row = mysqli_fetch_assoc($result);
 ?>

<!DOCTYPE HTML>

<html>
<?php
  require_once "FEEDCUBE_icon.php"
 ?>
<head>

    <meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Feedback Auswertung</title>
	<link href="bootstrap.css?v=1" rel="stylesheet" type="text/css">
	<link href="charts2.css?v=1" rel="stylesheet" type="text/css">
	<script type="text/javascript" src="hidefunction.js?v=1"></script>
	<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.10.1/html2pdf.bundle.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.3.5/jspdf.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/0.4.1/html2canvas.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.3/Chart.min.js"></script>

	<?php
        include "Draw_Charts.php";		//Pie and COlumnchart
 		include "Draw_Trend_Chart.php";
 	?>	
  <script type = "text/javascript" src="export_delete_data.js?v=2"></script>
  <script type="text/javascript" src="rangeslider_jquery.js?v=2"> </script>

</head>
<style>

</style>
<body class="text-center" onload="update()">

 <!-- Load an icon library to show a hamburger menu (bars) on small screens -->

<script src="https://kit.fontawesome.com/9059ff5bc6.js" crossorigin="anonymous"></script>
<link href="navigation.css?v=1" rel="stylesheet" type="text/css">
<script type="text/javascript" src="navigation.js?v=1"></script>	
<div class="header">
<?php
	include "navigation_admin.php";
 ?>
<script>
	document.getElementById("feedback_charts").className = "active";
</script>
		<h1 style="font-size:30px; margin-bottom:20px;"><img src="../assets/brand/bar-chart.png" width="50" style="margin-top:-10px;"> Auswertung </h1>
		<p style="margin:auto; margin-bottom:40px; width:90vw;"> Wähle eine Frage um das Feedback dazu auszuwerten</p>
    </div>
<div id = "test" style="width:83vw; margin:auto;">	

<!--Auswertung von multiple choice Fragen-->


<div id=fullAuswahl class="FragenAuswahl">
<label class="Auswahl">Frage: </label>
			<?php
                 include "Auswahlmöglichkeiten_Fragen.php";
 include "FilterExportDeleteCSV.php";
 //wenn später pdf für charts eingebaut wird
// include "FilterExportDeleteOptions.php";

 ?>	
	</div>
	<hr>
	<?php
    include "Filter.php";
 ?>
<div id = "pdf"> 	
	<div id="undraw_empty" style="display:none; margin-top:48px;"><p><label>Es wurde noch kein Feedback abgegeben</label></p><img src="../assets/brand/empty.png" alt="" class="undraw_chart_empty"></div>


	<div id="loader" style = "display:none"></div>
	<div id="charts" class="grid-container-charts" >
			<div class= "leftchart">
			<canvas id="ColumnChart" height=160></canvas>
			</div>
			<div class= "rightchart">
			<canvas id="PieChart" height=200></canvas>
			</div>
			<div class="leftchart"> 
			<canvas id="TrendChart" height=200></canvas>
			</div>
			<div class="rightchart"> 
			<p id="Statistics" style="overflow:auto; font-size:18px; font-weight: bold;border-radius: 10px 10px; background: linear-gradient(90deg, rgba(46,193,200,1) 0%, rgba(48,23,107,1) 90%);color:white; margin-top:11%; padding-top:20%;height:330px;">
			</p>

			</div>
	</div>
	<div id="Kommentare" class="Kommentare" style="margin:auto">
	<span id="blog_posts" ></span> <!--hier werden die Kommentare eingefügt-->
	<div id="load_data_message"></div>
	</div>
</div>
<div id="elementH"></div>
</body>

</html>
<script>
var limit = 10;
var start = 0;
var action = 'active';
var blog = document.getElementById("blog_posts");

function create_blog_posts(){
	action = 'inactive';
	var Kommentare = document.getElementById("Kommentare");
	Kommentare.style.display="block";
	blog.innerHTML="";
	var charts = document.getElementById("charts");
	charts.style.display="none";
	var undraw_empty= document.getElementById("undraw_empty");
	undraw_empty.style.display="none";

 if(action == 'inactive')
 {
  start=0;
  console.log("inactive")
  action = 'active';
  loadNewData(limit, start);
 }
 
};

function loadNewData(limit, start)
 	{
	var Trainer = Auswahl_Trainer.value;
	var Frage = Auswahl_Frage.value;
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

  	$.ajax({
   url:"Create_Blog.php?datum_min=" + datum_min + "&datum_max=" + datum_max + "&Leistung=" + Leistung + "&Frage=" + Frage + "&Trainer=" + Trainer,
   method:"POST",
   data:{limit:limit, start:start},
   cache:false,
   success:function(data)
   {
    $('#blog_posts').append(data);
    if(data.length < 3)
    {
		if(blog.innerHTML=="")
		{	
			undraw_empty.style.display="block";
			$('#load_data_message').hide();
		}
		else
		{	
			$('#load_data_message').html("<button type='button' class='btn btn-info'>Keine weiteren Bewertungen</button>");	
		}
		action = "inactive";
	}
    else
    {
		$('#load_data_message').show();
		console.log("action"+start);
     	$('#load_data_message').html("<button type='button' style='display:none' class='btn btn-warning'>Bitte warten....</button>");
     	action = "inactive";
    }
   }
  });
 }

 $(window).scroll(function(){
  if($(window).scrollTop() + $(window).height() > $("#Kommentare").height() && action == 'inactive')
  {
   action = 'active';
   console.log("active"+start);
   start = start + limit;
   setTimeout(function(){
    loadNewData(limit, start);
   }, 500);
  }
 });





 
 async function createPdf(){  
        var opt = {
            html2canvas:  { scale: 2, scrollY: 0, scrollX: 0},
            filename:     'kursfeedback.pdf',
            jsPDF:        { unit: 'pt', format: 'a3', orientation: 'portrait' }
        };

		var reportPageHeight = $('#pdf').innerHeight()*1.6;
		var reportPageWidth = $('#pdf').innerWidth();

		// create a new canvas object that we will populate with all other canvas objects
		var pdfCanvas = $('<canvas />').attr({
			id: "canvaspdf",
			width: reportPageWidth,
			height: reportPageHeight
		});

		// keep track canvas position
		var pdfctx = $(pdfCanvas)[0].getContext('2d');
		var pdfctxX = 50;
		var pdfctxY = 50;
		var buffer = 50;

		// for each chart.js chart
		$("canvas").each(function(index) {
			// get the chart height/width
			var canvasHeight = $(this).innerHeight()*0.9;
			var canvasWidth = $(this).innerWidth()*0.9;

			// draw the chart into the new canvas
			pdfctx.drawImage($(this)[0], pdfctxX, pdfctxY, canvasWidth, canvasHeight);
			pdfctxX += canvasWidth + buffer;

			// our report page is in a grid pattern so replicate that in the new canvas
		if (index % 2 === 1) {
			pdfctxX = 50;
			pdfctxY += canvasHeight + buffer;
		}
		});

		console.log($(pdfCanvas)[0]);
    
        var i=0;
        var fullsource = "Test";
		var imagedata = pdfCanvas; 
		var smallimage = $(pdfCanvas)[0];
        let worker = html2pdf()
        .set(opt)
        .from(smallimage)
        worker = worker.toPdf(); 
		worker = worker
                .get('pdf')
                .from(smallimage)
                .toContainer()
                .toCanvas()
                .toPdf()
        worker.save();
		setTimeout(() => {
		update();
	}, 1000);}







async function createPdfde(){  
  var reportPageHeight = $('#pdf').innerHeight()*1.6;
  var reportPageWidth = $('#pdf').innerWidth();

  // create a new canvas object that we will populate with all other canvas objects
  var pdfCanvas = $('<canvas />').attr({
    id: "canvaspdf",
    width: reportPageWidth,
    height: reportPageHeight
  });

  // keep track canvas position
  var pdfctx = $(pdfCanvas)[0].getContext('2d');
  var pdfctxX = 50;
  var pdfctxY = 50;
  var buffer = 50;

  // for each chart.js chart
  $("canvas").each(function(index) {
    // get the chart height/width
    var canvasHeight = $(this).innerHeight()*0.9;
    var canvasWidth = $(this).innerWidth()*0.9;

    // draw the chart into the new canvas
    pdfctx.drawImage($(this)[0], pdfctxX, pdfctxY, canvasWidth, canvasHeight);
    pdfctxX += canvasWidth + buffer;

    // our report page is in a grid pattern so replicate that in the new canvas
if (index % 2 === 1) {
      pdfctxX = 50;
      pdfctxY += canvasHeight + buffer;
}
  });

  // create new pdf and add our new canvas as an image
  var pdf = new jsPDF('p', 'pt', 'a3');
  var Statistics = document.getElementById("Statistics").innerHTML;
  html2canvas($(pdfCanvas), {
			scale: 5,
            onrendered: function(canvas) {                      
                var doc = new jsPDF('p', 'mm');
				pdf.addImage($(pdfCanvas)[0], 'PNG', 0, 0);
                pdf.save('sample-file.pdf');
            }
        });

  // download the pdf
  pdf.save('filename.pdf');}
</script>



	





