<?php
 require_once "../config.php";
 require_once "session.php";
?>

<!DOCTYPE HTML>
<html>
<?php
 require_once "FEEDCUBE_icon.php"
?>  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Formulare</title>
	<link href="bootstrap.css" rel="stylesheet" type="text/css">
	<link href="forms.css" rel="stylesheet" type="text/css">
	<link href="charts2.css" rel="stylesheet" type="text/css">
	<script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
	<script type = "text/javascript" src="export_delete_data.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.10.1/html2pdf.bundle.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.3.5/jspdf.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.3/Chart.min.js"></script>
	<script type="text/javascript" src="rangeslider_jquery.js"> </script>
	
  </head>
  <style>
/* The Modal (background) */
.modal {
  display: none; /* Hidden by default */
  position: fixed; /* Stay in place */
  z-index: 1; /* Sit on top */
  padding-top: 50px; /* Location of the box */
  left: 0;
  top: 0;
  width: 100%; /* Full width */
  height: 100%; /* Full height */
  overflow: auto; /* Enable scroll if needed */
  background-color: rgb(0,0,0); /* Fallback color */
  background-color: rgba(0,0,0,0.4); /* Black w/ opacity */
}

/* Modal Content */
.modal-content {
  background-color: #fefefe;
  margin: auto;
  border: 1px solid #888;
  width: 50%;
}

/* The Close Button */
.close {
  color: #aaaaaa;
  float: right;
  font-size: 28px;
  font-weight: bold;
}

.close:hover,
.close:focus {
  color: #000;
  text-decoration: none;
  cursor: pointer;
}

.modalform{
    width:90%; 
    text-align:center;
    margin:auto;
    max-width:1000px; 
    padding:30px; 
    overflow:auto; 
    border-radius: 15px;
}

.center_button:hover .tooltiptext {
  visibility: visible;
}
	/* CSS styling for before/after/avoid. */
.break-before {
    page-break-before: always;
}

.break-after {
    page-break-after: always;
}

.break-avoid {
    page-break-inside: avoid;
}

.fullpage {
    height: 792pt;
}
	</style>

<body class="text-center" onload="update()">
	<script src="https://kit.fontawesome.com/662d1709e3.js" crossorigin="anonymous"></script>
	<link href="navigation.css" rel="stylesheet" type="text/css">
	<script type="text/javascript" src="navigation.js"></script>

	<div class="header">
	<?php
		$sql = "SELECT Is_Admin FROM users WHERE username ='".$_SESSION["username"]."'";
		$exec = mysqli_query($link,$sql);
		$row = mysqli_fetch_assoc($exec);
		$IsAdmin = $row["Is_Admin"];
		if($IsAdmin == 1)
			include "navigation_admin.php";
		else
			include "navigation.php";
	?>
<script>
	document.getElementById("forms_admin").className = "active";
	document.getElementById("Feedback").style.backgroundColor = "lightgrey";
</script>
		<h1 style="font-size:30px; margin-bottom:20px;"><img src="../assets/brand/documents.png" width="50" style="margin-top:-10px;"> Formulare </h1>
		<p style="margin-bottom:30px"> Hier findest du die Auswertung deines Kundenfeedbacks in Form von befüllten Formularen</p>	</div>
		<div id=pdf>
		<div id=fullAuswahl class="forms">
	<?php
		include "FilterExportDeleteOptions.php"
	?>

	</div>
	<hr>
	<?php
	include "Filter.php";
	?>
			<!-- The Modal -->
	<div id="LinkModal" class="modal">
	<div class="modal-content">
	<img id="startup" src="../assets/brand/pdf.png" width="100" style="margin-top:50px; margin-bottom:30px">
		<h3 id="Pageprogress">Pdf wird generiert...</h3>
		<progress class='progressbar' id='progress' max=50 value=0 style="margin-bottom:20px"></progress><br>
	</div>
	</div>
	<div id="auswertungen" style="display:block;">
	</div>
	<div id="load_data_message"></div>
</div>

</body>
</html>

<script>
var scrollcounter = 0;
var limit = 10;
var start = 0;
var action = 'inactive';
var blog = document.getElementById("auswertungen");

function update(){
	var output = document.getElementById("demo");
	blog.innerHTML="";
	if(action == 'inactive')
	{
	start = 0;
	action = 'active';
	load_country_data(limit, start, 0);
	}
};

function load_country_data(limit, start, scrollcounter)
 	{
		console.log(scrollcounter);
	var Scrollcounter = scrollcounter;
	var Trainer = Auswahl_Trainer.value;
	var Leistung = Auswahl_Leistung.value;
    
	var Zeitraum =  document.getElementById("zeitraum").value;
	var AuswahlZeitraum = document.getElementById("AuswahlZeitraum");

	var daterange = document.getElementById("zeitraum").value;
	const DateRangeArray = daterange.split(" - ");
	var datum_min = DateRangeArray[1];
	var datum_max = DateRangeArray[0];	
	datum_min = new Date(datum_min);
	datum_max = new Date(datum_max);
	datum_min.setDate(datum_min.getDate() + 1);
	datum_max.setDate(datum_max.getDate() + 1);
	datum_min = datum_min.toISOString().split('T')[0];
	datum_max = datum_max.toISOString().split('T')[0];

	console.log("mindate: "+datum_min);
	console.log("maxdate: "+datum_max);

  	$.ajax({
	<?php
			echo 'url:"formular_admin.php?datum_max=" + datum_max + "&datum_min=" + datum_min + "&Leistung=" + Leistung + "&Trainer=" + Trainer + "&Scrollcounter=" + Scrollcounter';
	?>,
   method:"POST",
   data:{limit:limit, start:start},
   cache:false,
   success:function(data)
   {
    $('#auswertungen').append(data);
    if(data.length <= 2)
    {
		if(blog.innerHTML.length<=2)
		{	
			blog.innerHTML='<p><label style="margin-top:30px">Es wurde noch kein Feedback abgegeben</label></p> <img src="undraw_empty_xct9.svg" alt="" style="width:20%;" class="undraw_chart_empty">';
			$('#load_data_message').hide();
		}
		else
		{	
			$('#load_data_message').html("<button type='button' class='btn btn-info'>Keine weiteren Kommentare</button>");	
		}
		action="inactive";
	}
    else
    {
		$('#load_data_message').show();
     	$('#load_data_message').html("<button type='button' style='display:none' class='btn btn-warning'>Bitte warten....</button>");
     	action = "inactive";
    }
   }
  });
 }

 $(window).scroll(function(){
  if($(window).scrollTop() + $(window).height() > $("#auswertungen").height() && action == 'inactive')
  {
   scrollcounter = scrollcounter+limit;
   action = 'active';
   start = start + limit;
   setTimeout(function(){
    load_country_data(limit, start, scrollcounter);
   }, 1000);
  }
 });


function deleteFeedback(id){
		if (confirm("Wollen Sie dieses Feedback wirklich entfernen?"))
	  	{
			var xmlhttp = new XMLHttpRequest();
			xmlhttp.open("GET", "deleteFeedback.php?Id=" + id, false);
			xmlhttp.send();
			location.reload();
	  }
	}

	function createPdf(){ 
		var modal = document.getElementById("LinkModal");
		var progress = document.getElementById("progress");
		var Pageprogress = document.getElementById("Pageprogress");
		var maxnumberofexportedpages = 50;
		modal.style.display = "block"; 
		var opt = {
            html2canvas:  { scale: 2, scrollY: 0, scrollX: 0},
            filename:     'externes_feedback.pdf',
            jsPDF:        { unit: 'pt', format: 'a3', orientation: 'portrait' }
        };
    
		i=0;
        var fullsource = "<div style='width:900px; text-align:center; margin:auto;margin-top:50px'>";
        var fullsourceheight = 0;
		var pagenumber = 0;
		var source = window.document.getElementsByName("pdf");

		//calculate how many pages in total
		while(i<source.length && pagenumber <= maxnumberofexportedpages)
        {
            if(fullsourceheight>1200)
            {
                fullsource=smallimage+fullsource+"</div><p></p>";
                fullsourceheight =0;
                fullsource = "<div style='width:900px; text-align:center; margin:auto;border-top: 1px solid; margin-top:70px'>";
                pagenumber = pagenumber+1;
            }
            fullsource = fullsource + source[i].innerHTML;
            fullsourceheight = fullsourceheight + source[i].getBoundingClientRect().height;
            i=i+1;
        }
		var totalnumberofpages=pagenumber-1;
		progress.max=totalnumberofpages;

		console.log(pagenumber);

		//create pdf
		i=0;
        fullsource = "<div style='width:900px; text-align:center; margin:auto;margin-top:50px'>";
        fullsourceheight = 0;
		<?php
		$dir = "../assets/".$subdomain."/logo/logo.png";
		$imagedata = base64_encode(file_get_contents($dir));
		?>
		//Erste Seite
		var Trainer = Auswahl_Trainer.value;
		if(Trainer=="%25"){
			Trainer="Alle Trainer"
		}
		var Leistung = Auswahl_Leistung.value;
		if(Leistung=="%25"){
			Leistung="Alle Leistungen"
		}
		var Zeitraum =  document.getElementById("zeitraum").value;
		var AuswahlZeitraum = document.getElementById("AuswahlZeitraum");
		var daterange = document.getElementById("zeitraum").value;
		const DateRangeArray = daterange.split(" - ");
		var datum_min = DateRangeArray[1];
		var datum_max = DateRangeArray[0];	
		datum_min = new Date(datum_min);
		datum_max = new Date(datum_max);
		datum_min.setDate(datum_min.getDate() + 1);
		datum_max.setDate(datum_max.getDate() + 1);
		datum_min = datum_min.toISOString().split('T')[0];
		datum_max = datum_max.toISOString().split('T')[0];

		var Datenow = new Date();
		Datenow = Datenow.toISOString().split('T')[0];

		var Datumvonbis = "<p id='Datumvonbis'><b>von: </b> "+datum_max+" <b>bis: </b>"+datum_min+"</p>";

		var Filter = "<div style='max-width:600px; line-height:200%; font-size:18px; text-align:left; margin:auto; margin-top:70px'><p><b>Trainer:</b> "+Trainer+"</p><p><b>Leistung:</b> "+Leistung+"</p>"+Datumvonbis+"<br><br><p>erstellt am: "+Datenow+"</p><p>erstellt von: <?php echo $_SESSION["username"];?><p style='margin-top:200px; font-size:12px;'><i class='fa fa-info' aria-hidden='true'></i> Dieses Dokument beinhaltet unter Umständen nicht alle Bewertungen zu den oben genannten Angaben, da in einer Auswertung maximal "+maxnumberofexportedpages.toString()+" Seiten exportiert werden. Um ältere Bewertungen zu exportieren verwenden Sie bitte einen detailierteren Filter</p></div>";
		var imagedata = "data:image/png;base64,<?php echo $imagedata ?>"; 
		var smallimage = '<img src="' + imagedata + '"/ height="50" style="float:right; margin:15px; margin-right:25px;"><br>';
		var largeimage = '<img src="' + imagedata + '"/ height="200" style="margin-top: 80px"><br><h1 style="margin-top:130px">Feedbackauswertung</h1>'+Filter;
        let worker = html2pdf()
        .set(opt)
        .from(smallimage)
        worker = worker.toPdf(); 
		worker = worker
                .get('pdf')
                .from(largeimage)
                .toContainer()
                .toCanvas()
                .toPdf()
        pagenumber = 1;

		if(totalnumberofpages==-1)
		{
			worker = worker
			.get('pdf')
			.then(pdf => {
				pdf.addPage();
				modal.style.display="none";
				update();
			})
		}

        while(i<source.length && pagenumber <= maxnumberofexportedpages)
        {
            if(fullsourceheight>1200)
            {
                fullsource=smallimage+fullsource+"</div><p></p>";
                fullsourceheight =0;
                worker = worker
                .get('pdf')
                .then(pdf => {
                pdf.addPage();
				progress.value=progress.value+1;
				Pageprogress.innerHTML="Seite "+progress.value.toString()+" von "+progress.max.toString()+" wurde hinzugefügt.";
				if(progress.value>=totalnumberofpages)
				{
					modal.style.display="none";
					update();
				}
				})
                .from(fullsource)
                .toContainer()
                .toCanvas()
                .toPdf()
                fullsource = "<div style='width:900px; text-align:center; margin:auto;border-top: 1px solid; margin-top:70px'>";
                pagenumber = pagenumber+1;
            }
            fullsource = fullsource + source[i].innerHTML;
            fullsourceheight = fullsourceheight + source[i].getBoundingClientRect().height;
            i=i+1;
        }

		fullsource=smallimage+fullsource+"</div><p></p>";
			fullsourceheight =0;
			worker = worker
			.get('pdf')
			.from(fullsource)
			.toContainer()
			.toCanvas()
			.toPdf()
			
        worker.save();
		progress.value=0;
	}

	async function createPdfeinzeln(x){  
        var opt = {
            html2canvas:  { scale: 2, scrollY: 0, scrollX: 0},
            filename:     'externes_feedback.pdf',
            jsPDF:        { unit: 'pt', format: 'a3', orientation: 'portrait' }
        };
    
        var i=0;
        var source = document.getElementById("feedback_"+x).querySelectorAll('[name=pdf]');
        var fullsource = "<div style='width:900px; text-align:center; margin:auto;'>";
        var fullsourceheight = 0;
		<?php
		$dir = "../assets/".$subdomain."/logo/logo.png";
		$imagedata = base64_encode(file_get_contents($dir));
		?>
		var imagedata = "data:image/png;base64,<?php echo $imagedata ?>"; 
		var smallimage = '<img src="' + imagedata + '"/ height="50" style="float:right; margin:15px; margin-right:25px;"><br>';
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
        var pagenumber = 1;

        while(i<source.length)
        {
            if(fullsourceheight>1300)
            {
                fullsource=smallimage+fullsource+"</div><p></p>";
                fullsourceheight =0;
                worker = worker
                .get('pdf')
                .then(pdf => {
                pdf.addPage()
                })
                .from(fullsource)
                .toContainer()
                .toCanvas()
                .toPdf()
                fullsource = "<div style='width:900px; text-align:center; margin:auto;border-top: 1px solid; margin-top:20px'>";
                pagenumber = pagenumber+1;
            }
            fullsource = fullsource + source[i].innerHTML;
            fullsourceheight = fullsourceheight + source[i].getBoundingClientRect().height;
            i=i+1;
        }

		fullsource=smallimage+fullsource+"</div><p></p>";
			fullsourceheight =0;
			worker = worker
			.get('pdf')
			.from(fullsource)
			.toContainer()
			.toCanvas()
			.toPdf()

        worker.save();
	setTimeout(() => {
		update();
	}, 1000);}
//TODO timeout unschön besser durch async}


</script>



