<?php
 require_once "../config.php";
 require_once "session.php";
 include "RedirectToStart.php";
 ?>
<!DOCTYPE HTML>
<html>
<?php
  require_once "FEEDCUBE_icon.php"
 ?><head>
    <meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>User</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css?v=1" />  
	<link href="bootstrap.css?v=1" rel="stylesheet" type="text/css">
    <link href="tooltip.css?v=1" rel="stylesheet" type="text/css">
	<link href="charts.css?v=1" rel="stylesheet" type="text/css">
	<link href="User_optionen.css?v=1" rel="stylesheet" type="text/css">
    <script src="https://kit.fontawesome.com/9059ff5bc6.js" crossorigin="anonymous"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.3/Chart.min.js"></script>
    <script src="https://cdn.rawgit.com/davidshimjs/qrcodejs/gh-pages/qrcode.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/0.4.1/html2canvas.js"></script>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css?v=1" />

	<script src="FileSaver.js?v=1"></script>
	<?php
     include "User_speichern.php"
 ?>
</head>
<style>
    .form-control{
        width:90%;
    }
    .bi.bi-eye-slash, .bi-eye{
	display:initial; 
	position:relative; 
	left:85%; 
	top:-10px;
	cursor: pointer;
}
	#element{
  width:250px;
  position: relative;
  margin:auto;
  text-align:center;
  margin-top:25px;
  margin-bottom:30px; 
  cursor:pointer; 
  padding:15px; 
  font-size: 16px; 
  border:none; 
  border-radius:30px; 
  color:white; 
  background-color:<?php $sql='SELECT farbe FROM system';
 $exec=mysqli_query($link, $sql);
 $result=mysqli_fetch_assoc($exec);
 echo $result['farbe']?>
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
    width:90%; 
    display:block;
    text-align:left;
    margin:auto;
    max-width:1000px; 
    padding:30px; 
    overflow:auto; 
    border-radius: 15px;
}

.center_button:hover .tooltiptext {
  visibility: visible;
}

a:hover .tooltiptext {
  visibility: visible;
}
</style>
<body class="text-center">
 <!-- Load an icon library to show a hamburger menu (bars) on small screens -->
<link href="navigation.css?v=1" rel="stylesheet" type="text/css">
<script type="text/javascript" src="navigation.js?v=1"></script>	
<div class="header">
	<?php
 include "navigation_admin.php";
 ?>
<script>
	document.getElementById("Usermanagement").className = "active";
	document.getElementById("optionen").style.backgroundColor = "lightgrey";
</script>
		<h1 style="font-size:30px; margin-bottom:20px;"><img src="../assets/brand/group.png" width="60" style="margin-top:-10px;">  Benutzer </h1>
		<p style="margin:auto; text-align:center; max-width:95vw"> Füge neue Benutzer hinzu oder bearbeite die Informationen zu bestehenden Benutzer. Weise Berechtigungen als Trainer oder Administrator zu</p></div>
		
	<div class="scroll">
        
	<script>
	function user_password_reset(id) {
  	if (confirm("Wollen Sie das Passwort zu diesem User ändern?"))
	  {<?php
 // Define variables and initialize with empty values
 $new_password = $confirm_password = "";
 $new_password_err = $confirm_password_err = "";
 ?>
	  alert("Die Änderungen wurden übernommen");
	}
	;}
	function user_abfrage_speichern(id) {
		speichern(id);
	}
	function user_abfrage_löschen(id) {
  	if (confirm("Wollen Sie den gewählten Benutzer unwideruflich entfernen?"))
	  {entfernen(id);
		alert("User wurde gelöscht");
		location.reload();}
	;}
	</script>
    <div id="alert" class="alert icon-alert with-arrow alert-success form-alter" role="alert" style="display:none; margin:auto; text-align:center">
		<i class="fa fa-fw fa-check-circle"></i>
		<strong> Success ! </strong> <span class="success-message">Deine Änderungen wurden erfolgreich gespeichert</span>
	</div>
    <input id="current_id" value="0" style="display:none"></input>
    <?php
        include "Usertable.php";
    ?>
	</div>
		<!-- The Modal -->
	<div id="myModal" class="modal">
	<form class="modalform" method="get" style="text-align:left">
		<span class="close">&times;</span>
		<div id="Trainer_Auswahl" name="Trainer_Auswahl">Wähle dein Fragenset zur ausgewählten Leistung</div>
		<?php
         include "Auswahlmöglichkeiten_Leistung_ohne_alle.php"
 ?>
		<br>
		<input type="checkbox" id ="Sprache"> Englischer Kurs</input>
        <br><br>
			<label class="radio-inline">
			<input style="margin-top:-1px" type="radio" name="qrvslink" value="Link" checked>Feedback-Link
			</label>
			<label class="radio-inline">
			<input style="margin-top:-1px" type="radio" name="qrvslink" value="QR">QR-Code
			</label>
			<br><br>
			<div id="qrcode-container" style="display:none; width:200px;">
    		<div id="qrcode-2" class="qrcode"></div>
			<button type="button" id="QRSave" onclick="CopyQR()" style="margin-top:20px; padding:7px; border:none; border-radius:2px; color:white; background-color:<?php $sql="SELECT farbe FROM system";
	$exec=mysqli_query($link, $sql);
	$result=mysqli_fetch_assoc($exec);
	echo $result['farbe']?>">QR-Code kopieren</button>

	</div>
		<input type="text" id="Link" name="Link" style="margin-top:5px; border:none; width:95%; background-color:rgba(0,0,0,0.03);" readonly="true"></input>
		<button id="copyButton" onclick="copyLink()" style="margin-top:20px; padding:7px; border:none; border-radius:2px; color:white; display:none; background-color:<?php $sql="SELECT farbe FROM system";
        $exec=mysqli_query($link, $sql);
        $result=mysqli_fetch_assoc($exec);
        echo $result['farbe']?>">Link kopieren</button>
        </form>
        </div>

	<div id="newUserModal" class="modal" style="display:none;">
		<form class="form-signin" style="display:block; padding:40px; max-width:1000px" onsubmit="createNewUser();return false;" method="post">
			<span class="close" style="float:right; text-align:right">&times;</span>
			<h4>Registrierung</h4>
			<p>Fülle das Formular vollständig aus um einen neuen Benutzer zu erstellen.</p> 
            <br>
			<div class="form-group">
				<input type="text" id="newname" name="name" placeholder="Vor- und Nachname" class="form-control" value="" minlength="3" maxlength="100" required>
				<span class="help-block" id="name_err" style="color:red; display:none">Fehler beim Namen</span>
			</div>  
			<div class="form-group">
				<input type="text" id="newusername" name="username" placeholder="Benutzername" class="form-control" value="" minlength="3" maxlength="100" required>
				<span class="help-block" id="username_err" style="color:red; display:none">Username existiert bereits</span>
			</div>   
			<div class="form-group">
				<input type="email" id="newemail" name="email" placeholder="Email" class="form-control" value="" minlength="3" maxlength="100" required>
				<span class="help-block" id="email_err" style="color:red; display:none">Email wird bereits verwendet</span>
			</div>   
			<div class="form-group">
				<input type="password" style="margin-bottom:-16px" id="password" name="password" placeholder="Passwort" class="form-control" value="" minlength="6" maxlength="100" required/>
                <i class="bi bi-eye-slash" id="toggleNeuesPasswort"></i>
                <span class="help-block" id="password_err" style="color:red; display:none">Eingegebene Passwörter stimmen nicht überein</span>
			</div>
			<div class="form-group">
				<input type="password" style="margin-bottom:-16px" id="confirm_password" name="confirm_password" placeholder="Passwort bestätigen" class="form-control" value="" minlength="6" maxlength="100" required>
                <i class="bi bi-eye-slash" id="toggleWiederholtesPasswort"></i>
                <span class="help-block" id="confirm_password_err" style="color:red; display:none">Eingegebene Passwörter stimmen nicht überein</span>
			</div>
            <label style="font-weight: normal"><input type="checkbox" id="checkAdmin" name="checkAdmin" value=1> Administrator </label>
            <label style="font-weight: normal"><input type="checkbox" id="checkTrainer" name="checkTrainer" value=1> Trainer </label>
			<div class="form-group" style="text-align:center; margin:auto;">
				<button type="submit" style="width:250px; background-color:<?php $sql='SELECT farbe FROM system';
 $exec=mysqli_query($link, $sql);
 $result=mysqli_fetch_assoc($exec);
 echo $result['farbe']?>" class="btn btn-primary"><i class="fa fa-user-plus" style="font-size:18px" aria-hidden="true"></i> Benutzer hinzufügen</button>
			</div>
		</form>   
	</div>

    <div id="existingUserModal" class="modal" style="display:none;">
		<form id="existingUserForm" class="form-signin" style="display:block; padding:40px; max-width:1000px" onsubmit="updateUserDetails();return false;" method="post">
			<span class="close" style="float:right; text-align:right">&times;</span>
			<h4>Benutzer bearbeiten</h4>
            <br>
			<div class="form-group">
            <p>Vor- und Nachname:</p>
				<input type="text" id="name" name="name" placeholder="Vor- und Nachname" class="form-control" value="<?php echo $fullname; ?>" minlength="3" maxlength="100" required>
				<span class="help-block" id="existing_name_err" style="color:red; display:none">Fehler beim Namen</span>
			</div>  
			<div class="form-group">
            <p>Benutzername:</p>   
				<input type="text" id="username" name="username" placeholder="Benutzername" class="form-control" value="<?php echo $username; ?>" minlength="3" maxlength="100" required>
				<span class="help-block" id="existing_username_err" style="color:red; display:none">Der Username existiert bereits</span>
			</div>   
			<div class="form-group">
            <p>Email:</p> 
				<input type="email" id="email" name="email" placeholder="Email" class="form-control" value="<?php echo $email; ?>" minlength="3" maxlength="100" required>
				<span class="help-block"  id="existing_email_err" style="color:red; display:none">Die Email existiert bereits</span>
			</div> 
            <label style="font-weight: normal"><input type="checkbox" id="checkAdminExist" name="checkAdminExist" value=1> Administrator </label>
            <label style="font-weight: normal"><input type="checkbox" id="checkTrainerExist" name="checkTrainerExist" value=1> Trainer </label>
            <br><br>
            <input class="btn fa-input"  type="submit" value="speichern" style="font-size: 14px; width:100px; color:white; background-color:<?php $sql='SELECT farbe FROM system'; $exec=mysqli_query($link,$sql); $result=mysqli_fetch_assoc($exec); echo $result['farbe']?>"></input>

		</form>   
	</div>

    <!-- The Modal -->
    <div id="PasswordModal" class="modal">
    <form class="modalform" onsubmit="saveNewPassword();return false;" method="post" style="text-align:left">
    <span class="close">&times;</span>
    <h4>Neues Passwort vergeben</h4>
    <br>
    <p>
        <p>Neues Passwort:</p>
        <input type="password" class="form-control" style="width:90%;" name="NeuesPasswortAdmin" id="NeuesPasswortAdmin" minlength="6" maxlength="100" required/>
        <i class="bi bi-eye-slash" style="top:-25px" id="toggleNeuesPasswortAdmin"></i>
        <p id="NeuesPasswortError" style="display:none; color:red">Die eingegebenen Passwörter stimmt nicht überein</p>

        <p>Neues Passwort wiederholen:</p>
        <input type="password" class="form-control" style="width:90%;" name="WiederholtesPasswortAdmin" id="WiederholtesPasswortAdmin" minlength="6" maxlength="100" required/>
        <i class="bi bi-eye-slash" style="top:-25px" id="toggleWiederholtesPasswortAdmin"></i>
        <p id="WiederholtesPasswortError" style="display:none; color:red">Die eingegebenen Passwörter stimmt nicht überein</p>

    </p>
    <input class="btn fa-input"  type="submit" value="speichern" style="font-size: 14px; width:100px; color:white; background-color:<?php $sql='SELECT farbe FROM system'; $exec=mysqli_query($link,$sql); $result=mysqli_fetch_assoc($exec); echo $result['farbe']?>"></input>

    </form>
    </div>

	<script>
	try{
	    error();
	}
	catch{
	    
	};
    
    var span = document.getElementsByClassName("close")[0];
    var closenewusermodal = document.getElementsByClassName("close")[1];
    var closeexistingusermodal = document.getElementsByClassName("close")[2];
    var closepasswordmodal = document.getElementsByClassName("close")[3];
	var modal = document.getElementById("myModal");
	var newUserModal = document.getElementById("newUserModal");
	var existingUserModal = document.getElementById("existingUserModal");
	var PasswordModal = document.getElementById("PasswordModal");
    let qrcodeContainer = document.getElementById("qrcode-2");
    span.onclick = function() {
        modal.style.display = "none";
        copyButton.style.display = "none";
        qrcodeContainer.innerHTML="";
	}    
    closenewusermodal.onclick = function() {
        newUserModal.style.display = "none";
	}    
    closeexistingusermodal.onclick = function() {
        existingUserModal.style.display = "none";
	}
    closepasswordmodal.onclick = function() {
        PasswordModal.style.display = "none";
	}
	var Trainer_element = document.getElementById("Trainer_Auswahl");
	function display(Trainer) {
		modal.style.display = "block";
		Trainer_element.value = Trainer;
		var Auswahl_Leistung = document.getElementById("Auswahl_Leistung");
		Auswahl_Leistung.value = "%";
		Trainer_element.innerHTML= "Erzeuge einen Feedback-Link für den Trainer <b>" + Trainer + "</b><div style='margin-top:20px;margin-bottom:20px'>Leistung die bewertet wird:</div>";
		var Link = document.getElementById("Link");
		Link.value = "";
	}
	// Get the <span> element that closes the modal
	var Auswahl_Leistung = document.getElementById("Auswahl_Leistung");
	var Auswahl_Sprache = document.getElementById("Sprache");
	var Sprache = "Deutsch";
    var QRAuswahl = document.getElementsByName("qrvslink")[1];
	var LinkAuswahl = document.getElementsByName("qrvslink")[0];
	var Link = document.getElementById("Link");
	var copyButton = document.getElementById("copyButton");
	var current_url = window.location.href;
	var index = current_url.indexOf("Portal");
	current_url = current_url.substr(0,index)+"Feedback_abgeben";
    Auswahl_Leistung.onchange = ShowLink;
	QRAuswahl.onchange = ShowLink;
	LinkAuswahl.onchange = ShowLink;


    function createNewUser()
	{
        var Modal = document.getElementById("newUserModal");
		var Name = document.getElementById("newname").value;
        var Username = document.getElementById("newusername").value;
		var Email = document.getElementById("newemail").value;
        var Password = document.getElementById("password").value;
        var Confirm_Password = document.getElementById("confirm_password").value;
        var UsernameError = document.getElementById("username_err");
        UsernameError.style.display="none";
        var EmailError = document.getElementById("email_err");
        EmailError.style.display="none";
        var Confirm_PasswordError = document.getElementById("confirm_password_err");
        Confirm_PasswordError.style.display="none";
        var PasswordError = document.getElementById("password_err");
        PasswordError.style.display="none";
        var checkAdmin = document.getElementById("checkAdmin").checked;
        if(checkAdmin == true)
        {
            checkAdmin = 1
        }
        else{
            checkAdmin = 0
        }
        var checkTrainer = document.getElementById("checkTrainer").checked;
        if(checkTrainer == true)
        {
            checkTrainer = 1
        }
        else{
            checkTrainer = 0
        }
        console.log("CreateNewUser.php?fullname="+Name+"&username="+Username+"&email="+Email+"&password="+Password+"&confirm_password="+Confirm_Password+"&checkAdmin="+checkAdmin+"&checkTrainer="+checkTrainer);

		var xmlhttp = new XMLHttpRequest();
            xmlhttp.onreadystatechange = function() {
                if (this.readyState == 4 && this.status == 200) {
					console.log(this.responseText)
                    if(this.responseText.includes("1"))
					{
                        UsernameError.style.display="block"
					}
                    if(this.responseText.includes("2"))
					{
                        EmailError.style.display="block"
					}
                    if(this.responseText.includes("3"))
					{
                        PasswordError.style.display="block"
                        Confirm_PasswordError.style.display="block"
					}
					if(this.responseText=="4")
					{
						document.getElementById('alert').style.display='block';
                        $('#employee_data').load( "Usermanagement.php #employee_data" );
                        Modal.style.display = "none";
					}
                }
            ;};
		xmlhttp.open("POST", "CreateNewUser.php?fullname="+Name+"&username="+Username+"&email="+Email+"&password="+Password+"&confirm_password="+Confirm_Password+"&checkAdmin="+checkAdmin+"&checkTrainer="+checkTrainer, true);
		xmlhttp.send();
	}

    function updateUserDetails()
	{
        var Modal = document.getElementById("existingUserModal");
		var Name = document.getElementById("name").value;
        var Username = document.getElementById("username").value;
		var Email = document.getElementById("email").value;
        var UsernameError = document.getElementById("existing_username_err");
        UsernameError.style.display="none";
        var EmailError = document.getElementById("existing_email_err");
        EmailError.style.display="none";
        var Id = document.getElementById("current_id").value;
        var checkAdmin = document.getElementById("checkAdminExist").checked;
        if(checkAdmin == true)
        {
            checkAdmin = 1
        }
        else{
            checkAdmin = 0
        }
        var checkTrainer = document.getElementById("checkTrainerExist").checked;
        if(checkTrainer == true)
        {
            checkTrainer = 1
        }
        else{
            checkTrainer = 0
        }

		var xmlhttp = new XMLHttpRequest();
            xmlhttp.onreadystatechange = function() {
                if (this.readyState == 4 && this.status == 200) {
					console.log(this.responseText)
                    if(this.responseText.includes("1"))
					{
                        UsernameError.style.display="block"
					}
                    if(this.responseText.includes("2"))
					{
                        EmailError.style.display="block"
					}
					if(this.responseText=="3")
					{
						document.getElementById('alert').style.display='block';
                        $('#employee_data').load( "Usermanagement.php #employee_data" );
                        Modal.style.display = "none";
					}
                }
            ;};
		xmlhttp.open("POST", "UpdateUserDetails.php?fullname="+Name+"&username="+Username+"&email="+Email+"&Exists="+Id+"&checkAdmin="+checkAdmin+"&checkTrainer="+checkTrainer, true);
		xmlhttp.send();
	}

    function saveNewPassword() {
		var NeuesPasswort = document.getElementById("NeuesPasswortAdmin").value;
		var WiederholtesPasswort = document.getElementById("WiederholtesPasswortAdmin").value;
		var NeuesPasswortError = document.getElementById("NeuesPasswortError");		
		var WiederholtesPasswortError = document.getElementById("WiederholtesPasswortError");
        var Id = document.getElementById("current_id").value;

		var xmlhttp = new XMLHttpRequest();
            xmlhttp.onreadystatechange = function() {
                if (this.readyState == 4 && this.status == 200) {
					console.log(this.responseText)
					if(this.responseText=="2")
					{
						WiederholtesPasswortError.style.display="block";
						NeuesPasswortError.style.display="block";
					}
					if(this.responseText=="3")
					{
						document.getElementById('alert').style.display='block';
						PasswordModal.style.display = "none";
					}
                }
            ;};
            xmlhttp.open("POST", "saveNewPassword_admin.php?NeuesPasswort="+NeuesPasswort+"&WiederholtesPasswort="+WiederholtesPasswort+"&Id="+Id, true);	
            xmlhttp.send();
	}

    function ShowLink(){
		if(Auswahl_Leistung.value!="")
		{
            var xmlhttp = new XMLHttpRequest();
            xmlhttp.onreadystatechange = function() {
                if (this.readyState == 4 && this.status == 200) {
                    if(this.responseText=="")
                    {
                        Trainer_element.innerHTML='<div id="alert" class="alert icon-alert with-arrow alert-danger form-alter" role="alert"><i class="fa fa-fw fa-times-circle"></i><strong> Achtung!</strong> <span class="warning-message">Der Leistung wurden noch keine Fragen hinzugefügt</span></div>'+Trainer_element.innerHTML;
                    }
                    else
                    {
                        document.getElementById("alert").style.display="none";
                    }
                }
            ;};
            xmlhttp.open("GET", "Leistung_get_Fragenset_checked.php?ID=" + Auswahl_Leistung.value, true);	
            xmlhttp.send();
            var Feedbacklink = current_url+"/Vorauswahl.php?Trainer="+Trainer_element.value+"&Sprache="+Sprache+"&Leistung="+Auswahl_Leistung.value;
			Feedbacklink = Feedbacklink.replaceAll(" ","%20");
			Link.value = Feedbacklink;
			copyButton.style.display = "block";
			/*With some styles*/
			let qrcodeContainer2 = document.getElementById("qrcode-2");
			qrcodeContainer2.innerHTML = "";
			new QRCode(qrcodeContainer2, {
			text: Feedbacklink,
			width: 200,
			height: 200,
			correctLevel: QRCode.CorrectLevel.H
			});
			if(document.querySelector('input[name="qrvslink"]:checked').value=="Link")
			{
				document.getElementById("qrcode-container").style.display = "none";
				document.getElementById("Link").style.display = "block";
				document.getElementById("copyButton").style.display = "block";

			}
			else{
			document.getElementById("qrcode-container").style.display = "block";
			document.getElementById("Link").style.display = "none";
			document.getElementById("copyButton").style.display = "none";
			}
		}
    };

	function CopyQR(){
        html2canvas($("#qrcode-2"), {
            onrendered: function(canvas) {
                theCanvas = canvas;
				console.log(canvas);
				canvas.toBlob(function(blob) { 
    const item = new ClipboardItem({ "image/png": blob });
    navigator.clipboard.write([item]); 
	alert("QR-Code wurde als Bild in die Zwischenablage kopiert")
		});
    }
    });
	}

	Auswahl_Sprache.onclick = function(){
		if(Auswahl_Sprache.checked)
		{
			Sprache= "Englisch";
		}
		else{
			Sprache="Deutsch";
		}
		var Feedbacklink = current_url+"/Vorauswahl.php?Trainer="+Trainer_element.value+"&Sprache="+Sprache+"&Leistung="+Auswahl_Leistung.value;
		Feedbacklink = Feedbacklink.replaceAll(" ","%20");
		if(Auswahl_Leistung.value!=""){
		Link.value = Feedbacklink;
		}
		ShowLink();
	};
	// When the user clicks anywhere outside of the modal, close it
	window.onclick = function(event) {
	if (event.target == modal) {
		modal.style.display = "none";
		copyButton.style.display = "none";
	}
	}
	function copyLink() {
		var copyLink = document.getElementById("Link");
		copyLink.select();
		copyLink.setSelectionRange(0, 99999);
		document.execCommand("copy");
        alert("Der Link wurde erfolgreich in die Zwischenablage kopiert");
	}
	function setVisibility(id){
        if(id===undefined)
        {
            document.getElementById("name").value=null;
            document.getElementById("username").value=null;
            document.getElementById("email").value=null;
            if(document.getElementById("newUserModal").style.display == "block")
            {
                document.getElementById("newUserModal").style.display = "none";
            }
            else{
                document.getElementById("newUserModal").style.display = "block";
            }
        }
    else{
        try{
            document.getElementById("name").value=document.getElementById("name_"+id).innerHTML;
            document.getElementById("username").value=document.getElementById("username_"+id).innerHTML;
            document.getElementById("email").value=document.getElementById("email_"+id).innerHTML;
            document.getElementById("current_id").value=id;
            if(document.getElementById("berechtigung_"+id).innerHTML.indexOf("Administrator")!=-1)
            {
				document.getElementById("checkAdminExist").checked = true;
				var xmlhttp = new XMLHttpRequest();
				xmlhttp.onreadystatechange = function() {
					if (this.readyState == 4 && this.status == 200) {
						if(this.responseText=="1")
						{
							document.getElementById("checkAdminExist").checked = true;
							document.getElementById('checkAdminExist').disabled = true;
						}
						else{
							document.getElementById('checkAdminExist').disabled = false;
						}
							}
						;};
				xmlhttp.open("POST", "getAnzahlAdmins.php", true);	
				xmlhttp.send();
            }
            else{
                document.getElementById("checkAdminExist").checked = false;
				document.getElementById('checkAdminExist').disabled = false;
            }
            ;
            if(document.getElementById("berechtigung_"+id).innerHTML.indexOf("Trainer")!=-1)
            {
                document.getElementById("checkTrainerExist").checked = true;
            }
            else{
                document.getElementById("checkTrainerExist").checked = false;
            }
        }
        catch{

        }
		if(document.getElementById("existingUserModal").style.display == "block")
		{
			document.getElementById("existingUserModal").style.display = "none";
		}
		else{
			document.getElementById("existingUserModal").style.display = "block";
		}
	}
}

    function showPasswordModal(id) {
        var PasswordModal = document.getElementById("PasswordModal");
		PasswordModal.style.display = "block";
        document.getElementById("current_id").value=id;
	}	

	togglePasswordVisibility('#toggleNeuesPasswort', '#password');
	togglePasswordVisibility('#toggleWiederholtesPasswort', '#confirm_password');	
    togglePasswordVisibility('#toggleNeuesPasswortAdmin', '#NeuesPasswortAdmin');
	togglePasswordVisibility('#toggleWiederholtesPasswortAdmin', '#WiederholtesPasswortAdmin');

	function togglePasswordVisibility(toggle, pass)
	{
		const togglePassword = document.querySelector(toggle);
		const password = document.querySelector(pass);
        console.log("test"+toggle) 
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
    	<?php
 include "Tutorial_Schritt6_Info.php";
 if (isset($_REQUEST["Step"])) {
     echo'
    <script>
	    document.getElementById("myTopnav").style.display="none";
    </script>
	<div class="content" style="text-align:center">
	        <button class="TutorialNavi" onclick = "zurück()"><i class="fa fa-arrow-left"></i><br>zurück</button>
			<progress id="progress" value="5" max="6" style="font-size:25px"></progress>
            <button class="TutorialNavi" onclick = "weiter()"><i class="fa fa-arrow-right"></i><br>weiter</button>
			<progress id="progressmobile" value="5" max="6" style="font-size:25px;"></progress>
    </div>';

     $Step=$_REQUEST["Step"];
 }
 ?>
    <link href="Tutorialstyle.css?v=1" rel="stylesheet" type="text/css">
    <script src="Cookiefunctions.js?v=1" type="text/javascript"></script>

    <script>
				checkCookie("UserInformationChecked", "UserInfo_Modal")
				function weiter() {
					window.location.href = "Umfragen.php?Step=7"
				}

				function zurück() {
					window.location.href = "Leistungmanagement.php?Step=5"
				}
				
				function hideinformation(){
					document.getElementById("UserInfo_Modal").style.display="none"
					document.cookie = "UserInformationChecked=1; expires=Fri, 27 Mar 2122 12:00:00 UTC";
				}

        function hideinformationWithoutremembering(){
            document.getElementById("UserInfo_Modal").style.display="none"
        }

    </script>

    </body>
</html>