<?php
require_once "../config.php";
require_once "session.php";

$sql = "SELECT Is_Admin,Notification FROM users WHERE username ='".$_SESSION["username"]."'";
$exec = mysqli_query($link,$sql);
$row = mysqli_fetch_assoc($exec);
$UserWantsNotification = $row["Notification"];
$IsAdmin = $row["Is_Admin"];
?>
<link href="tooltip.css" rel="stylesheet" type="text/css">
<style>
    a:hover .tooltiptext {
  visibility: visible;
}
.nav-menu-hidden{
  position:absolute;
  left: 50px;
  display:none;
  overflow:hidden;
}


.sidebar {
  clip-path: inset(0 0 0 0);
  height: 100%;
  width: 70px;
  position: fixed;
  z-index: 1;
  top: 0;
  left: 0;
  background-color: <?php $sql="SELECT farbe FROM system";
  $exec=mysqli_query($link, $sql);
  $result=mysqli_fetch_assoc($exec);
  echo $result['farbe']?>;
  overflow-x: hidden;
  transition: 0.5s;
  padding-top: 20px;
}

.sidebar a {
  padding: 10px 8px 10px 15px;
  text-decoration: none;
  font-size: 16px;
  color: black;
  display: block;
  transition: 0.3s;
  text-align:left
}

/* Style the sidenav links and the dropdown button */
.sidenav a, .dropdown-btn {
  padding: 20px 8px 20px 25px;
  text-decoration: none;
  font-size: 16px;
  color: white;
  display: block;
  border: none;
  background: none;
  width:100%;
  text-align: left;
  cursor: pointer;
  outline: none;
}

/* On mouse-over */
.sidenav a:hover, .dropdown-btn:hover {
  color: lightgrey;
}

/* Main content */
.main {
  margin-left: 200px; /* Same as the width of the sidenav */
  font-size: 20px; /* Increased text to enable scrolling */
  padding: 0px 10px;
  margin-bottom:40px;
}

/* Add an active class to the active dropdown button */
.active {
  background-color: grey;
  color: white;
}

/* Dropdown container (hidden by default). Optional: add a lighter background color and some left padding to change the design of the dropdown content */
.dropdown-container {
  display: none;
  background-color: ghostwhite;
  color:grey;
  padding-left: 8px;
  text-align:left;
}

/* Optional: Style the caret down icon */
.fa-caret-down {
  display:none;
  float: right;
  padding-right: 8px;
}

.sidebar a:hover {
  color: lightgrey;
}

.sidebar .closebtn {
  position: absolute;
  bottom: 0;
  right: 25px;
  font-size: 25px;
  margin-left: 50px;
  color:white;
}

.openbtn {
  display:none;
  position: fixed;
  top: 5px;
  right:15px;
  font-size: 20px;
  cursor: pointer;
  background-color:<?php $sql='SELECT farbe FROM system'; $exec=mysqli_query($link,$sql); $result=mysqli_fetch_assoc($exec); echo $result['farbe']?>;
  color: white;
  padding: 10px 15px;
  border-radius: 50px;
  border:1px ghostwhite;
}

#main {
  transition: margin-left .5s;
  padding: 16px;
}

/* On smaller screens, where height is less than 450px, change the style of the sidenav (less padding and a smaller font size) */
@media screen and (max-height: 450px) {
  .sidebar 
    {
        padding-top: 15px;
        width:0px;
    }
  .sidebar a 
  {font-size: 18px;}
}

@media screen and (max-width: 970px) {
  .sidebar 
    {
        padding-top: 15px;
        width:0px;
    }

  .openbtn{
  display: block;
}
}
</style>
</head>


<div id="mySidebar" class="sidebar">
  <a href="Start.php" style="margin-left:-7px;margin-top:7px; margin-bottom:20px;">
  <img  style="margin-top:-7px; margin-left:10px" src="../assets/brand/FEEDCUBE_logo.png" height="35">
  <span class="nav-menu-hidden" style="color:white; font-size: 18px; margin-left:10px; margin-top:3px">Dashboard</span></a>

  <button class="dropdown-btn" onclick="openNav()"><i class="fa fa-bullhorn" aria-hidden="true"></i><span class="nav-menu-hidden">Feedback</span><i class="fa fa-caret-down"></i>
  </button>
  <div class="dropdown-container">
  <label style="font-size:10pt; margin-top:10px; text-align:left; border:none; outline:none; padding:3px; margin-bottom:5px;">Auswertung</label>
    <a id ="feedback_charts" href="feedback_charts.php"><i class="fa fa-line-chart" aria-hidden="true"></i><span class="nav-menu-hidden">Diagramme</span></a>
    <a id ="forms_admin" href="forms_admin.php"><i class="fa fa-file-text-o" aria-hidden="true"></i><span class="nav-menu-hidden">Formulare</span></a>
    <?php	
    if ($IsAdmin) {
        echo'
        <label style="font-size:10pt; margin-top:10px; text-align:left; border:none; outline:none; padding:3px; margin-bottom:5px;">Konfiguration</label>
        <a id ="Leistungmanagement" href="Leistungmanagement.php"><i class="fa fa-graduation-cap" aria-hidden="true"></i><span class="nav-menu-hidden">Kursliste</span></a>
        <a id ="Fragen" href="Fragen.php"><i class="fa fa-question-circle-o" aria-hidden="true"></i><span class="nav-menu-hidden">Fragen</span></a>
        <a id ="Fragensets" href="Fragenset.php"><i class="fa fa-question-circle" aria-hidden="true"></i><span class="nav-menu-hidden">Fragensets</span></a>';
    }?>
  </div>

  <button class="dropdown-btn" onclick="openNav()"><i class="fas fa-poll" aria-hidden="true"></i><span class="nav-menu-hidden">Umfragen</span><i class="fa fa-caret-down"></i>
  </button>
  <div class="dropdown-container">
  <label style="font-size:10pt; margin-top:10px; text-align:left; border:none; outline:none; padding:3px; margin-bottom:5px;">Auswertung</label>
    <a id ="Intern" href="Intern.php"><i class="fa fa-pie-chart" aria-hidden="true"></i> <span class="nav-menu-hidden">Diagramme</span></a>
    <a id ="Umfrage_forms" href="Umfrage_forms.php"><i class="fa fa-file-text-o" aria-hidden="true"></i> <span class="nav-menu-hidden">Formulare</span></a>	
    <?php	
    if ($IsAdmin) {
      echo'
      <label style="font-size:10pt; margin-top:10px; text-align:left; border:none; outline:none; padding:3px; margin-bottom:5px;">Konfiguration</label>
      <a id ="Umfragen" href="Umfragen.php"><i class="fa fa-cogs" aria-hidden="true"></i><span class="nav-menu-hidden">Umfragen</span></a>';
    }?>
    </div>
    <?php	
    if ($IsAdmin) {
      echo'
      <a id ="Usermanagement" href="Usermanagement.php" style="color:white; padding: 20px 8px 20px 25px;"><i class="fa fa-users" aria-hidden="true"></i><span class="nav-menu-hidden">Benutzer</span></a>

      <button class="dropdown-btn" onclick="openNav()"><i class="fas fa-cog" aria-hidden="true"></i><span class="nav-menu-hidden">Einstellungen</span><i class="fa fa-caret-down"></i>
      </button>
      <div class="dropdown-container">
        <a id ="Lookandfeel" href="Lookandfeel.php"><i class="fa-solid fa-paintbrush" aria-hidden="true"></i><span class="nav-menu-hidden">Look & Feel</span></a>
        <a id ="VordefinierteTexte" href="VordefinierteTexte.php"><i class="fa fa-file-text-o" aria-hidden="true"></i><span class="nav-menu-hidden">Textvorlagen</span></a>	
        <a id ="Antworten" href="Antwortmoeglichkeiten.php"><i class="fa fa-check-circle" aria-hidden="true"></i><span class="nav-menu-hidden">Antworten</span></a>
      </div>';
    }?>
      <a id ="Profil" href="Profil.php" style="color:white; padding: 20px 8px 20px 25px;"><i class="fa fa-user" aria-hidden="true"></i><span class="nav-menu-hidden">Profil</span></a>
<a href="logout.php" style="color:white; padding: 20px 8px 20px 25px;"><i class="fa fa-sign-out" aria-hidden="true"></i><span class="nav-menu-hidden"> Abmelden</span></a>
<a href="javascript:void(0)" id="showhidebtn" class="closebtn" onclick="openNav()"><i class="fa fa-angle-right" aria-hidden="true"></i></a>

</div>

<div id="main">
  <button id="openbtn" class="openbtn" onclick="openNav()">☰</button>  
 </div>
<script>
    //* Loop through all dropdown buttons to toggle between hiding and showing its dropdown content - This allows the user to have multiple dropdowns without any conflict */
var dropdown = document.getElementsByClassName("dropdown-btn");
var labels = document.getElementsByClassName("nav-menu-hidden");
var dropdownicons = document.getElementsByClassName("fa fa-caret-down");



var i=0;

for (i = 0; i < dropdown.length; i++) {
  dropdown[i].addEventListener("click", function() {
    this.classList.toggle("active");
    var dropdownContent = this.nextElementSibling;
    if (dropdownContent.style.display === "block") {
      dropdownContent.style.display = "none";
    } else {
      dropdownContent.style.display = "block";
    }
  });
}

function openNav() {
  for (i = 0; i < labels.length; i++) {
    console.log(labels[i]);
  }
  document.getElementById("mySidebar").style.width = "220px";
  document.getElementById("main").style.marginLeft = "220px";
  var i = 0;
  for (i = 0; i < labels.length; i++) {
    labels[i].style.display="inline-flex";
  }

  for (i = 0; i < dropdownicons.length; i++) {
    dropdownicons[i].style.display="inline-flex";
  }

  document.getElementById('openbtn').setAttribute( "onClick", "closeNav()" );
  document.getElementById('openbtn').innerHTML="x";

  document.getElementById('showhidebtn').setAttribute( "onClick", "closeNav()" );
  document.getElementById('showhidebtn').innerHTML="<i class='fa fa-angle-left' aria-hidden='true'></i>";

}

function closeNav() {
    var dropdowncontainer = document.getElementsByClassName("dropdown-container");

    if ($(window).width() < 960) {
        var sidebarwidth="0px"
    }
    else {
        var sidebarwidth="70px"
    }
  document.getElementById("mySidebar").style.width = sidebarwidth;
  document.getElementById("main").style.marginLeft= sidebarwidth;
  var i = 0;
  for (i = 0; i < dropdowncontainer.length; i++) {
    dropdowncontainer[i].style.display = "none";
  }


  for (i = 0; i < dropdown.length; i++) {
    dropdown[i].setAttribute("class", "dropdown-btn");
  }


  for (i = 0; i < labels.length; i++) {
    labels[i].style.display="none";
  }

  for (i = 0; i < dropdownicons.length; i++) {
    dropdownicons[i].style.display="none";
  }
  document.getElementById('openbtn').setAttribute( "onClick", "openNav()" );
  document.getElementById('openbtn').innerHTML="☰";

  document.getElementById('showhidebtn').setAttribute( "onClick", "openNav()" );
  document.getElementById('showhidebtn').innerHTML="<i class='fa fa-angle-right' aria-hidden='true'></i>";

}
</script>