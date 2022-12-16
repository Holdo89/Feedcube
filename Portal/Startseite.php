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
    <title>Dashboard</title>
	<link href="bootstrap.css" rel="stylesheet" type="text/css">
	<link href="StartCharts.css" rel="stylesheet" type="text/css">
	<script type="text/javascript" src="hidefunction.js"></script>
	<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.10.1/html2pdf.bundle.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.3.5/jspdf.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/0.4.1/html2canvas.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.3/Chart.min.js"></script>

	<?php
        include "Start_Draw_Charts.php";		//Pie and COlumnchart
 		include "Start_Draw_Trend_Chart.php";
 	?>	
  <script type = "text/javascript" src="export_delete_data.js"></script>
  <script type="text/javascript" src="rangeslider_jquery.js"> </script>
  <link rel="manifest" href="../../manifest.json">

</head>
<style>

</style>
<body class="text-center" onload="update()">

 <!-- Load an icon library to show a hamburger menu (bars) on small screens -->

<script src="https://kit.fontawesome.com/9059ff5bc6.js" crossorigin="anonymous"></script>
<link href="navigation.css" rel="stylesheet" type="text/css">
<script type="text/javascript" src="navigation.js"></script>	
<div class="header">
<?php
	include "navigation_admin.php";
 ?>

<img class="mb-4" src="../assets/brand/dashboard.png" alt="" width="300" style="margin-bottom:30px">
<p style="max-width:90vw; margin:auto">Hier erhältst du einen groben Überblick über die Auswertung des Feedbacks</p><br>

    </div>
<div style="width:83vw; margin:auto; @media only screen and (max-width: 600px){width:100vw; margin:0;}">	

<!--Auswertung von multiple choice Fragen-->


<div id=fullAuswahl class="FragenAuswahl" style="margin:auto;margin-top:20px;justify-items: center;grid-template-columns: auto auto auto; max-width:500px ">
	<div style="text-align:center;font-size:12pt; margin-top:8px;" onclick="toggleFilterVisibility('FilterCharts', 'filtericon')"><i id="filtericon" class="fa fa-filter" style="font-size:15px;" aria-hidden="true"></i> Filter</div>
			<?php
	if($IsAdmin == 1)
	{
		echo'<div style="text-align:left;font-size:12pt; margin-top:8px;" onclick="export_data_admin()"><i id="filtericon" class="fa fa-download" style="font-size:15px;" aria-hidden="true"></i> Export</div>';
		echo'<div style="text-align:left;font-size:12pt; margin-top:8px;" onclick="delete_data()"><i id="filtericon" class="fa fa-trash" style="font-size:15px;" aria-hidden="true"></i> Löschen</div>';
	}
	else{
		echo'<div style="text-align:left;font-size:12pt; margin-top:8px;" onclick="export_data()"><i id="filtericon" class="fa fa-download" style="font-size:15px;" aria-hidden="true"></i> Export</div>';
	}
 ?>	
	</div>
	<hr>
	<?php
    include "Filter.php";
 ?>
 		<script type="text/javascript" src="rangeslider_jquery.js"> </script>
<div id="startdashboard">
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
            filename:     'externes_feedback.pdf',
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



	





