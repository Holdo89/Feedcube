<?php
 require_once "../config.php";
 require_once "session.php";
?>

<!DOCTYPE HTML>
<html>
<?php
 require_once "FEEDCUBE_icon.php";
?><head>

           
<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Umfragen</title>
	<link rel = "stylesheet" href = "https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css?v=1">
	<link href="bootstrap.css?v=1" rel="stylesheet" type="text/css">
	<link href="Umfragen_Fragen.css?v=1" rel="stylesheet" type="text/css">
	<link href="tooltip.css?v=1" rel="stylesheet" type="text/css">
	<link href="umfrage_optionen.css?v=1" rel="stylesheet" type="text/css">
	<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.3/Chart.min.js"></script>
<style>
.radio-inline, .checkbox-inline{
	border:none;
}
#element{
  width:250px;
  position: relative;
  margin:auto;
  text-align:center;
  margin-top:10px;
  margin-bottom:30px; 
  cursor:pointer; 
  padding:15px; 
  font-size: 16px; 
  border:none; 
  border-radius:30px; 
  color:white; 
  background-color:<?php $sql='SELECT farbe FROM system'; $exec=mysqli_query($link,$sql); $result=mysqli_fetch_assoc($exec); echo $result['farbe']?>
}

h1{
    margin-top:20%;
    margin-bottom:5%;
}

#element2{
  width:250px;
  position: relative;
  margin:auto;
  text-align:center;
  margin-top:25px;
  cursor:pointer; 
  padding:15px; 
  font-size: 16px; 
  border: 2px --solid; 
  border-radius:30px; 
  background-color:white;
  color:<?php $sql='SELECT farbe FROM system'; $exec=mysqli_query($link,$sql); $result=mysqli_fetch_assoc($exec); echo $result['farbe']?>;
  border-color:<?php $sql='SELECT farbe FROM system'; $exec=mysqli_query($link,$sql); $result=mysqli_fetch_assoc($exec); echo $result['farbe']?>
}

.Inhalt{
    grid-template-columns:auto auto; 
    display:grid; 
    width:50%;
    text-align:center;
    margin:auto;
    margin-top:5%;
}

img{
    margin-top:30px;
}
@media only screen and (max-width: 600px) {

.Inhalt {

    grid-template-columns:auto; 
    margin-left:11%;
}

#startup{
    width:50vw;
}

h1{
    margin-top:30px;
}
img{
    margin-top:-10px;
    margin-left:20%;
}
}
</style>

</head>
<body class="text-center">

<div class="Inhalt">
    <div>
    <img id="startup" src="../assets/brand/giphy.gif" width="300">
</div>
    <div>
    <h1>
        Konfiguration abgeschlossen
    </h1>
    <h4>
        Feedcube kann nun verwendet werden. Bei Fragen oder Unklarheiten besuchen Sie unseren Leitfaden<br><br> www.feedcube.net/getting-started
    </h4>
    <div class="content">
	        <button id="element2" onclick = "zurück()">zurück</button>
            <button id="element" onclick = "weiter()">zur Startseite</button>
    </div>
</div>
</div>

 <!-- Load an icon library to show a hamburger menu (bars) on small screens -->
 <script>

function weiter() {
    window.location.href = "Start.php"
}

function zurück() {
    window.location.href = "Umfragen.php?Step=7"
}

</script>
    </body>
</html>
