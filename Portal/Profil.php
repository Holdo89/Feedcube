<?php
 require_once "../config.php";
 require_once "session.php";

 $sql = "SELECT * FROM users WHERE username ='".$_SESSION["username"]."'";
$exec = mysqli_query($link,$sql);
$row = mysqli_fetch_assoc($exec);
$UserWantsNotification = $row["Notification"];
$Name = $row["name"];
$Email = $row["email"];

?>

<!DOCTYPE HTML>
<html>
<?php
 require_once "FEEDCUBE_icon.php"
?><head>
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css" />
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T"crossorigin="anonymous">
	<link class="jsbin" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1/themes/base/jquery-ui.css" rel="stylesheet" type="text/css" />
	<script class="jsbin" src="https://ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js"></script>
	<script class="jsbin" src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.8.0/jquery-ui.min.js"></script>

    <meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Feedback Auswertung</title>
	<link href="bootstrap.css" rel="stylesheet" type="text/css">
	<link href="charts.css" rel="stylesheet" type="text/css">
	<link href="system_optionen.css" rel="stylesheet" type="text/css">
	<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.3/Chart.min.js"></script>
	<?php
	include "Leistung_speichern.php";
	?>
</head>
<body class="text-center">
 <!-- Load an icon library to show a hamburger menu (bars) on small screens -->
<script src="https://kit.fontawesome.com/9059ff5bc6.js" crossorigin="anonymous"></script>
<link href="navigation.css" rel="stylesheet" type="text/css">
<script type="text/javascript" src="navigation.js"></script>	
    <div class="header">
	<?php
	include "navigation_admin.php";
?>

<h1 style="font-size:30px; margin-bottom:20px;"><img src="../assets/brand/user.png" width="60"> Benutzerprofil</h1>
<p style="margin-bottom:30px; max-width:1000px; margin:auto; text-align:center">Bearbeite dein Benutzerprofil indem du persönliche Daten wartest, dein Passwort änderst oder deine Benachrichtigungen konfigurierst</p>	</div>

	</div>
	<div class="scroll">
	<style>
.bi.bi-eye-slash, .bi-eye{
	display:initial; 
	position:relative; 
	left:90%; 
	top:-23px;
	margin-left: -30px;
	cursor: pointer;
}
		/* The Modal (background) */
.modal {
  display: none; /* Hidden by default */
  position: fixed; /* Stay in place */
  z-index: 1; /* Sit on top */
  padding-top: 100px; /* Location of the box */
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
    width:40%; 
    display:block;
    text-align:left;
    margin:auto;
    max-width:1000px; 
    padding:30px; 
    overflow:auto; 
    border-radius: 15px;
}
	.überschrift{
		background-color: <?php $sql='SELECT farbe FROM system'; $exec=mysqli_query($link,$sql); $result=mysqli_fetch_assoc($exec); echo $result['farbe']?>;
	}
	</style>

<div id="alert" class="alert icon-alert with-arrow alert-success form-alter" role="alert" style="display:none;">
		<i class="fa fa-fw fa-check-circle"></i>
		<strong> Success ! </strong> <span class="success-message">Dein Passwort wurde erfolgreich geändert</span>
	</div>

<form style="background-color:ghostwhite; padding:10px; margin-top:20px; grid-template-columns: auto; border:none;">
	<label style="cursor:pointer" onclick="showUserinfoModal()"><i class="fa fa-user"></i> Persönliche Daten ändern</label>
</form>


		<!-- The Modal -->
		<div id="UserinfoModal" class="modal">
		<form class="modalform" onsubmit="updateProfilDetails();return false;" method="post" style="text-align:left">
		<span class="close">&times;</span>
		<h4>Profildetails bearbeiten</h4>
		<br>
		<p>
			<p>Vor-/Nachname:</p>
			<input type="text" class="form-control" style="width:90%;" name="Name" id="Name" minlength="3" maxlength="100" value="<?php echo $Name;?>"></input>
			<br>
			<p>Email:</p>
			<input type="email" class="form-control" style="width:90%;" name="Email" id="Email" minlength="3" maxlength="100" value="<?php echo $Email;?>"></input>

		</p>
		<input class="btn fa-input"  type="submit" value="speichern" style="font-size: 14px; width:100px; color:white; background-color:<?php $sql='SELECT farbe FROM system'; $exec=mysqli_query($link,$sql); $result=mysqli_fetch_assoc($exec); echo $result['farbe']?>"></input>

        </form>
        </div>

<form style="background-color:ghostwhite; padding:10px; margin-top:20px; grid-template-columns: auto; border:none">
		<label style="cursor:pointer" onclick="showPasswordModal()"><i class="fa fa-lock"></i> Persönliches Passwort ändern</label>
	</form>

<form style="background-color:ghostwhite; padding:10px; margin-top:20px; border:none; display:block">
<?php
    if ($UserWantsNotification) {
        echo'<label id="notification" style="margin-bottom:-5px;"><i class="fa fa-bell" aria-hidden="true"></i><span> Email Benachrichtigung aktiviert</span></label><br>';
		include "toggle.php";
		echo'
		<p id="Zusatzinformation" style="margin-top:10px">Wurde innerhalb der letzten 24 Stunden Feedback für dich abgegeben, wird um 00:00 Uhr eine Benachrichtigung an deine Emailadresse gesendet</p>
		<script> document.getElementById("toggle").checked=true;</script>';
	} else {
        echo'<label id="notification" style="margin-bottom:-5px;"><i class="fa fa-bell-slash" aria-hidden="true"></i><span> Benachrichtigung deaktiviert </span></label><br>';
		include "toggle.php";
		echo'<p id="Zusatzinformation" style="margin-top:10px">Es werden keine Benachrichtgungen gesendet wenn Feedback abgegeben wurde</p>';
	}

?>
</form>

		<!-- The Modal -->
		<div id="PasswordModal" class="modal">
		<form class="modalform" onsubmit="saveNewPassword();return false;" method="post" style="text-align:left">
		<span class="close">&times;</span>
		<h4>Neues Passwort vergeben</h4>
		<br>
		<p>
			<p>Aktuelles Passwort:</p>
			<input type="password" class="form-control" style="width:90%;" name="AltesPasswort" id="AltesPasswort" minlength="6" maxlength="100" required/>
			<i class="bi bi-eye-slash" id="toggleAltesPasswort"></i>
			<p id="AltesPasswortError" style="display:none; color:red">Das eingegebene Passwort stimmt nicht mit dem aktuellen Passwort überein</p>

			<p>Neues Passwort:</p>
			<input type="password" class="form-control" style="width:90%;" name="NeuesPasswort" id="NeuesPasswort" minlength="6" maxlength="100" required/>
			<i class="bi bi-eye-slash" id="toggleNeuesPasswort"></i>
			<p id="NeuesPasswortError" style="display:none; color:red">Die eingegebenen Passwörter stimmt nicht überein</p>

			<p>Neues Passwort wiederholen:</p>
			<input type="password" class="form-control" style="width:90%;" name="WiederholtesPasswort" id="WiederholtesPasswort" minlength="6" maxlength="100" required/>
			<i class="bi bi-eye-slash" id="toggleWiederholtesPasswort"></i>
			<p id="WiederholtesPasswortError" style="display:none; color:red">Die eingegebenen Passwörter stimmt nicht überein</p>

		</p>
		<input class="btn fa-input"  type="submit" value="speichern" style="font-size: 14px; width:100px; color:white; background-color:<?php $sql='SELECT farbe FROM system'; $exec=mysqli_query($link,$sql); $result=mysqli_fetch_assoc($exec); echo $result['farbe']?>"></input>

        </form>
        </div>

	<script>
    var spanuser = document.getElementsByClassName("close")[0];
	var span = document.getElementsByClassName("close")[1];
	var modal = document.getElementById("PasswordModal");
	var Userinfomodal = document.getElementById("UserinfoModal");
    spanuser.onclick = function() {
        Userinfomodal.style.display = "none";
	}
	span.onclick = function() {
        modal.style.display = "none";
	}

	function updateProfilDetails()
	{
		var Name = document.getElementById("Name").value;
		var Email = document.getElementById("Email").value;
		var xmlhttp = new XMLHttpRequest();
            xmlhttp.onreadystatechange = function() {
                if (this.readyState == 4 && this.status == 200) {
					console.log(this.responseText)
					if(this.responseText=="1")
					{
						document.getElementById('alert').style.display='block';
						Userinfomodal.style.display = "none";
					}
                }
            ;};
		xmlhttp.open("POST", "updateProfilDetails.php?Name="+Name+"&Email="+Email, true);
		xmlhttp.send();
	}

	function saveNewPassword() {
		var AltesPasswort = document.getElementById("AltesPasswort").value;
		var NeuesPasswort = document.getElementById("NeuesPasswort").value;
		var WiederholtesPasswort = document.getElementById("WiederholtesPasswort").value;
		var AltesPasswortError = document.getElementById("AltesPasswortError");		
		var NeuesPasswortError = document.getElementById("NeuesPasswortError");		
		var WiederholtesPasswortError = document.getElementById("WiederholtesPasswortError");

		var xmlhttp = new XMLHttpRequest();
            xmlhttp.onreadystatechange = function() {
                if (this.readyState == 4 && this.status == 200) {
					console.log(this.responseText)
					if(this.responseText=="1")
					{
						AltesPasswortError.style.display="block";
					}
					if(this.responseText=="2")
					{
						WiederholtesPasswortError.style.display="block";
						NeuesPasswortError.style.display="block";
					}
					if(this.responseText=="3")
					{
						document.getElementById('alert').style.display='block';
						modal.style.display = "none";
					}
                }
            ;};
            xmlhttp.open("POST", "saveNewPassword.php?AltesPasswort="+AltesPasswort+"&NeuesPasswort="+NeuesPasswort+"&WiederholtesPasswort="+WiederholtesPasswort, true);	
            xmlhttp.send();
	}

	function showPasswordModal() {
		modal.style.display = "block";
	}	
	
	function showUserinfoModal() {
		Userinfomodal.style.display = "block";
	}

	function shownotifications()
	{
		var notification = document.getElementById("notification");
		var xmlhttp = new XMLHttpRequest();
		xmlhttp.onreadystatechange = function() {
		if (this.readyState == 4 && this.status == 200) {
				if(this.responseText==1)
				{
					notification.innerHTML='<i class="fa fa-bell" aria-hidden="true"></i><span> Email Benachrichtigung aktiviert</span>';
					document.getElementById("Zusatzinformation").innerHTML="Wurde innerhalb der letzten 24 Stunden Feedback für dich abgegeben, wird um 00:00 Uhr eine Benachrichtigung an deine Emailadresse gesendet"
				}
				else{
					notification.innerHTML='<i class="fa fa-bell-slash" aria-hidden="true"></i><span>Email Benachrichtigung deaktiviert </span>'   
					document.getElementById("Zusatzinformation").innerHTML="Es werden keine Benachrichtgungen gesendet wenn Feedback abgegeben wurde"
				}
			}
		;};
		xmlhttp.open("GET", "setNotification.php", false);	
		xmlhttp.send();
	}

	//Toggle Password Visibility
	togglePasswordVisibility('#toggleAltesPasswort', '#AltesPasswort');
	togglePasswordVisibility('#toggleNeuesPasswort', '#NeuesPasswort');
	togglePasswordVisibility('#toggleWiederholtesPasswort', '#WiederholtesPasswort');

		
	function togglePasswordVisibility(toggle, pass)
	{
		const togglePassword = document.querySelector(toggle);
		const password = document.querySelector(pass);
        togglePassword.addEventListener('click', () => {
  
            // Toggle the type attribute using
            const type = password
                .getAttribute('type') === 'password' ?
                'text' : 'password';
                  
            password.setAttribute('type', type);
  
            // Toggle the eye and bi-eye icon
			if (togglePassword.getAttribute("class")=="bi bi-eye-slash") 
			{
				togglePassword.setAttribute("class", "bi-eye");
			}
			else{
				togglePassword.setAttribute("class", "bi bi-eye-slash"); 
			}
        });
	}
    </script>

	<div></div>
	</div>
    </body>
</html>