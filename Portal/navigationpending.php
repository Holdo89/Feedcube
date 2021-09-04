<div class="topnav" id="myTopnav" style="background-color:<?php $sql="SELECT farbe FROM system"; $exec=mysqli_query($link,$sql); $result=mysqli_fetch_assoc($exec); echo $result['farbe']?>">

<a class="image" style="padding:0px; padding-bottom:5px;"href="Start.php">			

                <img src="../assets/brand/FEEDCUBE_logo.png" style="float:left; margin-right:30px; margin-left:15px; margin-top:3px;" width="50" height="50">

</a>

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
