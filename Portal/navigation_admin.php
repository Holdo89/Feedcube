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
        <label style="margin-top:10px; text-align:left; border:none; outline:none; padding:3px; margin-bottom:5px;">Konfiguration</label>
        <a id ="Leistungmanagement" href="Leistungmanagement.php"><i class="fa fa-graduation-cap" aria-hidden="true"></i> Leistungen</a>
        <a id ="Fragen" href="Fragen.php"><i class="fa fa-question-circle-o" aria-hidden="true"></i> Fragen</a>
        <a id ="Fragensets" href="Fragenset.php"><i class="fa fa-question-circle" aria-hidden="true"></i> Fragensets</a>
    </div>
    </div>

    <div id ="UmfrageMöglichkeiten" class="dropdown">
    <button class="dropbtn"><i class="fas fa-poll" aria-hidden="true"></i> Umfragen </button>
    <div class="dropdown-content" style="text-align:left; font-size:13px; border:none; outline:none;">
        <label style="margin-top:10px; text-align:left; border:none; outline:none; padding:3px; margin-bottom:5px;">Auswertung</label>
        <a id ="Intern" href="Intern.php"><i class="fa fa-pie-chart" aria-hidden="true"></i> Diagramme</a>
        <a id ="Umfrage_forms" href="Umfrage_forms.php"><i class="fa fa-file-text-o" aria-hidden="true"></i> Formulare</a>	
        <label style="margin-top:10px; text-align:left; border:none; outline:none; padding:3px; margin-bottom:5px;">Konfiguration</label>
        <a id ="Umfragen" href="Umfragen.php"><i class="fa fa-cogs" aria-hidden="true"></i> Umfragen</a>
    </div>
    </div>

    <a id ="Usermanagement" href="Usermanagement.php"><i class="fa fa-users" aria-hidden="true"></i> Benutzer</a>
        
    <div id ="System" class="dropdown">
        <button class="dropbtn"><i class="fas fa-cog" aria-hidden="true"></i> Einstellungen</button>
        <div class="dropdown-content" style="text-align:left; font-size:13px; border:none; outline:none;">
        <a id ="Lookandfeel" href="Lookandfeel.php"><i class="fa-solid fa-paintbrush" aria-hidden="true"></i> Look & Feel</a>
        <a id ="VordefinierteTexte" href="VordefinierteTexte.php"><i class="fa fa-file-text-o" aria-hidden="true"></i>  Vordefinierte Texte</a>	
        <a id ="Antworten" href="Antwortmoeglichkeiten.php"><i class="fa fa-check-circle" aria-hidden="true"></i> Vordefinierte Antworten</a>
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
</div> 