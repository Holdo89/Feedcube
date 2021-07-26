<?php
 require_once "session.php";
 require_once "../config.php";
?>

<!DOCTYPE HTML>
<html>
<?php
 require_once "FEEDCUBE_icon.php"
?>  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Feedback abgeben</title>
	<link href="bootstrap.css" rel="stylesheet" type="text/css">
	<link href="forms.css" rel="stylesheet" type="text/css">
	<link href="charts.css" rel="stylesheet" type="text/css">
	<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.3/Chart.min.js"></script>
	
  </head>

<body class="text-center">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	<link href="navigation.css" rel="stylesheet" type="text/css">
	<script type="text/javascript" src="navigation.js"></script>

	<div class="header">
	<?php
		include "navigation.php";		//Pie and COlumnchart
	?>
	<script>
		document.getElementById("forms").className = "active";
	</script>
	</div> 
		<h1 style="font-size:30px; margin-bottom:10px;">Formulare <i class="fa fa-file-text-o" aria-hidden="true"></i> </h1>
		<p style="margin-bottom:30px"> Hier findest du die Auswertung deines Kundenfeedbacks</p>	</div>

	<div id="auswertungen" style="display:grid; margin:10px;">
	</div>
	<script>
	function formular(){
	//var Trainer = Auswahl_Trainer.value;
	var xmlhttp = new XMLHttpRequest();
	xmlhttp.onreadystatechange = function() {
  	if (this.readyState == 4 && this.status == 200) {
		if (this.response.length==2) //Wenn kein response kommt dann haben wir eine Länge von 2
		{
        	var canvas = document.getElementById("auswertungen");
            canvas.innerHTML='<p><label style="margin-top:30px">Es wurde noch kein Feedback abgegeben</label></p> <img src="undraw_No_data.svg" alt="" class="undraw_chart_empty">';
		}
		else{
			document.getElementById("auswertungen").innerHTML=this.responseText;
			var MyDiv=document.getElementById("auswertungen");
			var arr = MyDiv.getElementsByTagName('script');
			for (var n = 0; n < arr.length; n++)
			eval(arr[n].innerHTML);
		}
	}
	;};

	xmlhttp.open("GET", "formular_admin.php", true);
	xmlhttp.send();
	}
	formular()
	function deleteFeedback(id){
		if (confirm("Wollen Sie dieses Feedback wirklich entfernen?"))
	  	{
			var xmlhttp = new XMLHttpRequest();
			xmlhttp.open("GET", "deleteFeedback.php?Id=" + id, true);
			xmlhttp.send();
			location.reload();
	  }
	}

</script>
</body>
</html>