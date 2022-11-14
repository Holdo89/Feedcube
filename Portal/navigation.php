<?php
require_once "../config.php";
require_once "session.php";

$sql = "SELECT Notification FROM users WHERE username ='".$_SESSION["username"]."'";
$exec = mysqli_query($link,$sql);
$row = mysqli_fetch_assoc($exec);
$UserWantsNotification = $row["Notification"];
?>

<link href="tooltip.css" rel="stylesheet" type="text/css">
<style>
a:hover .tooltiptext {
  visibility: visible;
}
</style>
<div class="topnav" id="myTopnav" style="background-color:<?php $sql="SELECT farbe FROM system"; $exec=mysqli_query($link,$sql); $result=mysqli_fetch_assoc($exec); echo $result['farbe']?>">

<a class="image" style="padding:0px; padding-bottom:5px;"href="Start.php">			

                <img src="../assets/brand/FEEDCUBE_logo.png" style="float:left; margin-right:30px; margin-left:15px; margin-top:3px;" width="50" height="50">

</a>
    <a style="  margin-bottom:20px; visibility: hidden;"></a>		
    
    <div id ="Feedback" class="dropdown">
    <button class="dropbtn"><i class="fa fa-bullhorn" aria-hidden="true"></i> Feedback </button>
    <div class="dropdown-content" style="text-align:left; font-size:13px; border:none; outline:none;">
        <label style="margin-top:10px; text-align:left; border:none; outline:none; padding:3px; margin-bottom:5px;">Auswertung</label>
        <a id ="feedback_charts" href="feedback_charts.php"><i class="fa fa-line-chart" aria-hidden="true"></i> Diagramme</a>
        <a id ="forms_admin" href="forms_admin.php"><i class="fa fa-file-text-o" aria-hidden="true"></i> Formulare</a>	
    </div>
    </div>

    <div id ="UmfrageMöglichkeiten" class="dropdown">
    <button class="dropbtn"><i class="fas fa-poll" aria-hidden="true"></i> Umfragen </button>
    <div class="dropdown-content" style="text-align:left; font-size:13px; border:none; outline:none;">
        <label style="margin-top:10px; text-align:left; border:none; outline:none; padding:3px; margin-bottom:5px;">Auswertung</label>
        <a id ="Intern" href="Intern.php"><i class="fa fa-pie-chart" aria-hidden="true"></i> Diagramme</a>
        <a id ="Umfrage_forms" href="Umfrage_forms.php"><i class="fa fa-file-text-o" aria-hidden="true"></i> Formulare</a>	
    </div>
    </div>

    <a href="javascript:void(0);" class="icon" onclick="myFunction()">
    <i class="fa fa-bars"></i>
    </a>
    <div class="dropdown" style="float:right; margin-right:50px;">
    <button class="dropbtn"><i class="fa fa-user"></i> 
    </button>
    <div class="dropdown-content" style="right:0; margin-right:20px;">
        <a href="reset-password.php"><i class="fa fa-lock" aria-hidden="true"></i> Passwort reset</a>
        <a href="logout.php"><i class="fa fa-sign-out" aria-hidden="true"></i> Abmelden</a>
    </div>
    </div>
    <?php
    if($UserWantsNotification)
    {
        echo'<a id="notification" onclick="setNotification()" style="float:right;"><span class="tooltiptext" style="width:200px; margin-top:40px">Feedback-Benachrichtigung deaktivieren</span><i class="fa fa-bell" aria-hidden="true"></i></a>';
    }
    else{
        echo'<a id="notification" onclick="setNotification()" style="float:right;"><span class="tooltiptext" style="width:200px; margin-top:40px">Feedback-Benachrichtigung aktivieren</span><i class="fa fa-bell-slash" aria-hidden="true"></i></a>';  
    }
    ?>
    <script>
        function setNotification()
        {
            var notification = document.getElementById("notification");
            var xmlhttp = new XMLHttpRequest();
            xmlhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                    if(this.responseText==1)
                    {
                        notification.innerHTML='<span class="tooltiptext" style="width:200px; margin-top:40px">Feedback-Benachrichtigung deaktivieren</span><i class="fa fa-bell" aria-hidden="true"></i>';
                    }
                    else{
                        notification.innerHTML='<span class="tooltiptext" style="width:200px; margin-top:40px">Feedback-Benachrichtigung aktivieren</span><i class="fa fa-bell-slash" aria-hidden="true"></i>'   
                    }
                }
            ;};
            xmlhttp.open("GET", "setNotification.php", false);	
            xmlhttp.send();
        }
    </script>
    </div>
