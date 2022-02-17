<div class="topnav" id="myTopnav" style="background-color:<?php $sql="SELECT farbe FROM system"; $exec=mysqli_query($link,$sql); $result=mysqli_fetch_assoc($exec); echo $result['farbe']?>">

<a class="image" style="padding:0px; padding-bottom:5px;"href="Start.php">			

                <img src="../assets/brand/FEEDCUBE_logo.png" style="float:left; margin-right:30px; margin-left:15px; margin-top:3px;" width="50" height="50">

</a>
    <a style="  margin-bottom:20px; visibility: hidden;"></a>		
    <a id ="feedback_charts" href="feedback_charts.php"><i class="fa fa-line-chart" aria-hidden="true"></i> Auswertung</a>
    <a id ="forms_admin" href="forms_admin.php"><i class="fa fa-file-text-o" aria-hidden="true"></i> Formulare</a>				
    <div id ="UmfrageMöglichkeiten" class="dropdown">
    <button class="dropbtn"><i class="fa fa-bullhorn" aria-hidden="true"></i> Umfragen </button>
    <div class="dropdown-content">
        <a id ="Umfragen" href="Umfragen.php"><i class="fa fa-cogs" aria-hidden="true"></i> Konfiguration</a>
        <a id ="Intern" href="Intern.php"><i class="fa fa-pie-chart" aria-hidden="true"></i> Auswertung</a>
    </div>
    </div>    <a id ="intern_blog_noadmin" href="interner_blog_noadmin.php"><i class="fa fa-comments-o" aria-hidden="true"></i> Blog</a>


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
    </div>
