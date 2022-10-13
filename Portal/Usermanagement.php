<?php
 require_once "../config.php";
 require_once "session.php";
 include "RedirectToStart.php";

 if(isset($_REQUEST["checkAdmin"])){
    $IsAdmin=$_REQUEST["checkAdmin"];
 }
 else{
    $IsAdmin=0;
 }
 if(isset($_REQUEST["checkTrainer"])){
    $IsTrainer=$_REQUEST["checkTrainer"];
 }
 else{
    $IsTrainer=0;
 }

 if (isset($_REQUEST["Exists"])) {
     $Exists=$_REQUEST["Exists"];
     // Define variables and initialize with empty values
     $fullname = $username = $email="";
     $fullname_err = $username_err = $email_err="";
     // Processing form data when form is submitted
     if ($_SERVER["REQUEST_METHOD"] == "POST") {
         // Validate username
         if (empty(trim($_POST["fullname"]))) {
             $fullname_err = "Bitte gib deinen vollen Namen ein.";
         } else {
             // Prepare a select statement
             $sql = "SELECT id FROM users WHERE name = ? AND id != ".$_REQUEST["Exists"];
             if ($stmt = mysqli_prepare($link, $sql)) {
                 // Bind variables to the prepared statement as parameters
                 mysqli_stmt_bind_param($stmt, "s", $param_fullname);
                 // Set parameters
                 $param_fullname = trim($_POST["fullname"]);
                 // Attempt to execute the prepared statement
                 if (mysqli_stmt_execute($stmt)) {
                     /* store result */
                     mysqli_stmt_store_result($stmt);
                     $fullname = trim($_POST["fullname"]);
                 } else {
                     echo "Oops! Something went wrong. Please try again later.";
                 }
                 // Close statement
                 mysqli_stmt_close($stmt);
             }
         }
         // Validate username
         if (empty(trim($_POST["username"]))) {
             $username_err = "Bitte gib einen Usernamen ein.";
         } else {
             // Prepare a select statement
             $sql = "SELECT id FROM users WHERE username = ? AND id != ".$_REQUEST["Exists"];
             if ($stmt = mysqli_prepare($link, $sql)) {
                 // Bind variables to the prepared statement as parameters
                 mysqli_stmt_bind_param($stmt, "s", $param_username);
                 // Set parameters
                 $param_username = trim($_POST["username"]);
                 // Attempt to execute the prepared statement
                 if (mysqli_stmt_execute($stmt)) {
                     /* store result */
                     mysqli_stmt_store_result($stmt);
                     if (mysqli_stmt_num_rows($stmt) == 1) {
                         $username_err = "Dieser Username wird bereits verwendet.";
                     } else {
                         $username = trim($_POST["username"]);
                     }
                 } else {
                     echo "Oops! Something went wrong. Please try again later.";
                 }
                 // Close statement
                 mysqli_stmt_close($stmt);
             }
         }
         // Validate email
         if (empty(trim($_POST["email"]))) {
             $username_err = "Bitte eine Email Adresse eingeben.";
         } else {
             // Prepare a select statement
             $sql = "SELECT id FROM users WHERE email = ? AND id != ".$_REQUEST["Exists"];
             if ($stmt = mysqli_prepare($link, $sql)) {
                 // Bind variables to the prepared statement as parameters
                 mysqli_stmt_bind_param($stmt, "s", $param_email);
                 // Set parameters
                 $param_email = trim($_POST["email"]);
                
                 // Attempt to execute the prepared statement
                 if (mysqli_stmt_execute($stmt)) {
                     /* store result */
                     mysqli_stmt_store_result($stmt);
                    
                     if (mysqli_stmt_num_rows($stmt) == 1) {
                         $email_err = "Diese Email ist bereits vergeben.";
                     } else {
                         $email = trim($_POST["email"]);
                     }
                 } else {
                     echo "Oops! Something went wrong. Please try again later.";
                 }
    
                 // Close statement
                 mysqli_stmt_close($stmt);
             }
         }
    
         // Check input errors before inserting in database
         if (empty($fullname_err) && empty($username_err) && empty($email_err)) {
             // Prepare an insert statement
             $sql = "UPDATE users SET name=?, username=?, email=?, Is_Admin=?, Is_Trainer=? WHERE users.id = ".$Exists;
         
             if ($stmt = mysqli_prepare($link, $sql)) {
                 // Bind variables to the prepared statement as parameters
                 mysqli_stmt_bind_param($stmt, "sssss", $param_fullname, $param_username, $param_email, $IsAdmin, $IsTrainer);
            
                 // Set parameters
                 $param_fullname = $fullname;
                 $param_username = $username;
                 $param_email = $email;
            
                 $registerMessage = "Ein Benutzer wurde bearbeitet\r\n \r\nBenutzername: ".$username." \r\nName: ".$fullname." \r\nEmail: ".$email." \r\n\r\nMelden Sie sich bei Ihrem Feedcube System an um den Zugang zu bestätigen oder abzulehnen\r\nhttps://".$subdomain.".feedcube.net";
                 $headers .= 'From: Feedcube Automation <automation@feedcube.net>' . "\r\n";
                 $sql = "SELECT email FROM users WHERE Is_Admin = 1";
                 $exec = mysqli_query($link, $sql);
                 while ($row=mysqli_fetch_array($exec)) {
                     mail($row["email"], "neue Benutzerregistrierung", $registerMessage, $headers);
                 }
            
                 // Attempt to execute the prepared statement
                 if (mysqli_stmt_execute($stmt)) {
                     // Redirect to login page
                     if (isset($_REQUEST["Step"])) {
                         $Step = $_REQUEST["Step"];
                         header("location: Usermanagement.php?Step=".$Step);
                     } else {
                         header("location: Usermanagement.php");
                     }
                 } else {
                     echo "Something went wrong. Please try again later.";
                 }
                 // Close statement
                 mysqli_stmt_close($stmt);
             }
             $sql="UPDATE users SET internes_feedback_abgegeben = '2020-03-27 16:55:00' WHERE username = '".$param_username."'";
             $query=mysqli_query($link, $sql);
             $sql="UPDATE users SET Confirmed = 1 WHERE username = '".$param_username."'";
             $query=mysqli_query($link, $sql);
             // Close connection
             mysqli_close($link);
         } else {
             echo"<script>function error(){setVisibility(".$_REQUEST["Exists"].")}</script>";
         }
     }
 } else {
     // Define variables and initialize with empty values
     $fullname = $username = $email = $password = $confirm_password = "";
     $fullname_err = $username_err = $email_err = $password_err = $confirm_password_err = "";
     // Processing form data when form is submitted
     if ($_SERVER["REQUEST_METHOD"] == "POST") {
         // Validate username
         if (empty(trim($_POST["fullname"]))) {
             $fullname_err = "Bitte gib deinen vollen Namen ein.";
         } else {
             // Prepare a select statement
             $sql = "SELECT id FROM users WHERE name = ?";
             if ($stmt = mysqli_prepare($link, $sql)) {
                 // Bind variables to the prepared statement as parameters
                 mysqli_stmt_bind_param($stmt, "s", $param_fullname);
                 // Set parameters
                 $param_fullname = trim($_POST["fullname"]);
                 // Attempt to execute the prepared statement
                 if (mysqli_stmt_execute($stmt)) {
                     /* store result */
                     mysqli_stmt_store_result($stmt);
                     $fullname = trim($_POST["fullname"]);
                 } else {
                     echo "Oops! Something went wrong. Please try again later.";
                 }
                 // Close statement
                 mysqli_stmt_close($stmt);
             }
         }
         // Validate username
         if (empty(trim($_POST["username"]))) {
             $username_err = "Bitte gib einen Usernamen ein.";
         } else {
             // Prepare a select statement
             $sql = "SELECT id FROM users WHERE username = ?";
             if ($stmt = mysqli_prepare($link, $sql)) {
                 // Bind variables to the prepared statement as parameters
                 mysqli_stmt_bind_param($stmt, "s", $param_username);
                 // Set parameters
                 $param_username = trim($_POST["username"]);
                 // Attempt to execute the prepared statement
                 if (mysqli_stmt_execute($stmt)) {
                     /* store result */
                     mysqli_stmt_store_result($stmt);
                     if (mysqli_stmt_num_rows($stmt) == 1) {
                         $username_err = "Dieser Username wird bereits verwendet.";
                     } else {
                         $username = trim($_POST["username"]);
                     }
                 } else {
                     echo "Oops! Something went wrong. Please try again later.";
                 }
                 // Close statement
                 mysqli_stmt_close($stmt);
             }
         }
         // Validate email
         if (empty(trim($_POST["email"]))) {
             $username_err = "Bitte eine Email Adresse eingeben.";
         } else {
             // Prepare a select statement
             $sql = "SELECT id FROM users WHERE email = ?";
             if ($stmt = mysqli_prepare($link, $sql)) {
                 // Bind variables to the prepared statement as parameters
                 mysqli_stmt_bind_param($stmt, "s", $param_email);
                 // Set parameters
                 $param_email = trim($_POST["email"]);
                
                 // Attempt to execute the prepared statement
                 if (mysqli_stmt_execute($stmt)) {
                     /* store result */
                     mysqli_stmt_store_result($stmt);
                    
                     if (mysqli_stmt_num_rows($stmt) == 1) {
                         $email_err = "Diese Email ist bereits vergeben.";
                     } else {
                         $email = trim($_POST["email"]);
                     }
                 } else {
                     echo "Oops! Something went wrong. Please try again later.";
                 }
    
                 // Close statement
                 mysqli_stmt_close($stmt);
             }
         }
         // Validate password
         if (empty(trim($_POST["password"]))) {
             $password_err = "Bitte Passwort eingeben.";
         } elseif (strlen(trim($_POST["password"])) < 6) {
             $password_err = "Passwort muss mindestens 6 Zeichen beinhalten.";
         } else {
             $password = trim($_POST["password"]);
         }
    
         // Validate confirm password
         if (empty(trim($_POST["confirm_password"]))) {
             $confirm_password_err = "Bitte bestätige das Passwort.";
         } else {
             $confirm_password = trim($_POST["confirm_password"]);
             if (empty($password_err) && ($password != $confirm_password)) {
                 $confirm_password_err = "Passwörter stimmen nicht überein.";
             }
         }
    
         // Check input errors before inserting in database
         if (empty($fullname_err) && empty($username_err) && empty($email_err) && empty($password_err) && empty($confirm_password_err)) {
             // Prepare an insert statement
             $sql = "INSERT INTO users (name, username, email, password, Is_Admin, Is_Trainer) VALUES (?, ?, ?, ?, ?, ?)";
         
             if ($stmt = mysqli_prepare($link, $sql)) {
                 // Bind variables to the prepared statement as parameters
                 mysqli_stmt_bind_param($stmt, "ssssss", $param_fullname, $param_username, $param_email, $param_password, $IsAdmin, $IsTrainer);
            
                 // Set parameters
                 $param_fullname = $fullname;
                 $param_username = $username;
                 $param_email = $email;
                 $param_password = password_hash($password, PASSWORD_DEFAULT); // Creates a password hash
            
                 $registerMessage = "Ein neuer Benutzer hat sich registriert\r\n \r\nBenutzername: ".$username." \r\nName: ".$fullname." \r\nEmail: ".$email." \r\n\r\nMelden Sie sich bei Ihrem Feedcube System an um den Zugang zu bestätigen oder abzulehnen\r\nhttps://".$subdomain.".feedcube.net";
                 $headers .= 'From: Feedcube Automation <automation@feedcube.net>' . "\r\n";
                 $sql = "SELECT email FROM users WHERE Is_Admin = 1";
                 $exec = mysqli_query($link, $sql);
                 while ($row=mysqli_fetch_array($exec)) {
                     mail($row["email"], "neue Benutzerregistrierung", $registerMessage, $headers);
                 }
            
                 // Attempt to execute the prepared statement
                 if (mysqli_stmt_execute($stmt)) {
                     // Redirect to login page
                     if (isset($_REQUEST["Step"])) {
                         $Step = $_REQUEST["Step"];
                         header("location: Usermanagement.php?Step=".$Step);
                     } else {
                         header("location: Usermanagement.php");
                     }
                 } else {
                     echo "Something went wrong. Please try again later.";
                 }
                 // Close statement
                 mysqli_stmt_close($stmt);
             }
             $sql="UPDATE users SET internes_feedback_abgegeben = '2020-03-27 16:55:00' WHERE username = '".$param_username."'";
             $query=mysqli_query($link, $sql);
             $sql="UPDATE users SET Confirmed = 1 WHERE username = '".$param_username."'";
             $query=mysqli_query($link, $sql);
             // Close connection
             mysqli_close($link);
         } else {
             echo"<script>function error(){document.getElementById('newUserModal').style.display = 'block'}</script>";
         }
     }
 }

 ?>
<!DOCTYPE HTML>
<html>
<?php
  require_once "FEEDCUBE_icon.php"
 ?><head>
    <meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>User</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />  
	<link href="bootstrap.css" rel="stylesheet" type="text/css">
    <link href="tooltip.css" rel="stylesheet" type="text/css">
	<link href="charts.css" rel="stylesheet" type="text/css">
	<link href="User_optionen.css" rel="stylesheet" type="text/css">
    <script src="https://kit.fontawesome.com/9059ff5bc6.js" crossorigin="anonymous"></script>
	
	<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.3/Chart.min.js"></script>
	<?php
     include "User_speichern.php"
 ?>
</head>
<style>
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
<link href="navigation.css" rel="stylesheet" type="text/css">
<script type="text/javascript" src="navigation.js"></script>	
<div class="header">
	<?php
 include "navigation_admin.php";
 ?>
<script>
	document.getElementById("Usermanagement").className = "active";
	document.getElementById("optionen").style.backgroundColor = "lightgrey";
</script>
		<h1 style="font-size:30px; margin-bottom:20px;"><img src="../assets/brand/group.png" width="60" style="margin-top:-10px;">  Benutzer </h1>
		<p style="margin:auto; margin-bottom:10px; text-align:center; max-width:95vw"> Bearbeite hier Benutzer und weise Berechtigungen als Trainer oder Administrator zu</p></div>
		
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
		<p style="margin-top:20px;">Feedback-Link: </p>
		<input type="text" id="Link" name="Link" style="margin-top:5px; border:none; width:95%; background-color:rgba(0,0,0,0.03);" readonly="true"></input>
		<button id="copyButton" onclick="copyLink()" style="margin-top:20px; padding:7px; border:none; border-radius:2px; color:white; display:none; background-color:<?php $sql="SELECT farbe FROM system";
 $exec=mysqli_query($link, $sql);
 $result=mysqli_fetch_assoc($exec);
 echo $result['farbe']?>">Link kopieren</button>
    </form>
	</div>

	<div id="newUserModal" class="modal" style="display:none;">
		<form class="form-signin" style="display:block; padding:40px; max-width:1000px" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);
 if (isset($_REQUEST["Step"])) {
     $Step = $_REQUEST["Step"];
     echo"?Step=".$Step;
 } ?>" method="post">
			<span class="close" onclick = "setVisibility(-1)" style="float:right; text-align:right">&times;</span>
			<h1  class= "h4 mb-3 font-weight-normal">Registrierung</h1>
			<p>Fülle das Formular vollständig aus um einen neuen Benutzer zu erstellen.</p> 
			<div class="form-group <?php echo (!empty($fullname_err)) ? 'has-error' : ''; ?>">
				<input type="text" name="fullname" placeholder="Vor- und Nachname" class="form-control" value="<?php echo $fullname; ?>" required>
				<span class="help-block"><?php echo $fullname_err; ?></span>
			</div>  
			<div class="form-group <?php echo (!empty($username_err)) ? 'has-error' : ''; ?>">
				<input type="text" name="username" placeholder="Benutzername" class="form-control" value="<?php echo $username; ?>" required>
				<span class="help-block"><?php echo $username_err; ?></span>
			</div>   
			<div class="form-group <?php echo (!empty($email_err)) ? 'has-error' : ''; ?>">
				<input type="text" name="email" placeholder="Email" class="form-control" value="<?php echo $email; ?>" required>
				<span class="help-block"><?php echo $email_err; ?></span>
			</div>   
			<div class="form-group <?php echo (!empty($password_err)) ? 'has-error' : ''; ?>">
				<input type="password" name="password" placeholder="Passwort" class="form-control" value="<?php echo $password; ?>" required>
				<span class="help-block"><?php echo $password_err; ?></span>
			</div>
			<div class="form-group <?php echo (!empty($confirm_password_err)) ? 'has-error' : ''; ?>">
				<input type="password" name="confirm_password" placeholder="Passwort bestätigen" class="form-control" value="<?php echo $confirm_password; ?>" required>
				<span class="help-block"><?php echo $confirm_password_err; ?></span>
			</div>
            <label style="font-weight: normal"><input type="checkbox" id="checkAdmin" name="checkAdmin" value=1> Administrator </label>
            <label style="font-weight: normal"><input type="checkbox" name="checkTrainer" name="checkTrainer" value=1> Trainer </label>
			<div class="form-group" style="text-align:center; margin:auto;">
				<button type="submit" style="width:250px; background-color:<?php $sql='SELECT farbe FROM system';
 $exec=mysqli_query($link, $sql);
 $result=mysqli_fetch_assoc($exec);
 echo $result['farbe']?>" class="btn btn-primary"><i class="fa fa-user-plus" style="font-size:18px" aria-hidden="true"></i> Benutzer hinzufügen</button>
			</div>
		</form>   
	</div>

    <div id="existingUserModal" class="modal" style="display:none;">
		<form id="existingUserForm" class="form-signin" style="display:block; padding:40px; max-width:1000px" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"])."?Exists=1";
 if (isset($_REQUEST["Step"])) {
     $Step = $_REQUEST["Step"];
     echo"&Step=".$Step;
 } ?>" method="post">
			<span class="close" onclick = "setVisibility(-1)" style="float:right; text-align:right">&times;</span>
			<h1  class= "h4 mb-3 font-weight-normal">Benutzer bearbeiten</h1>
			<p>Fülle das Formular vollständig aus um einen neuen Benutzer zu erstellen.</p> 
			<div class="form-group <?php echo (!empty($fullname_err)) ? 'has-error' : ''; ?>">
				<input type="text" id="name" name="fullname" placeholder="Vor- und Nachname" class="form-control" value="<?php echo $fullname; ?>" required>
				<span class="help-block"><?php echo $fullname_err; ?></span>
			</div>  
			<div class="form-group <?php echo (!empty($username_err)) ? 'has-error' : ''; ?>">
				<input type="text" id="username" name="username" placeholder="Benutzername" class="form-control" value="<?php echo $username; ?>" required>
				<span class="help-block"><?php echo $username_err; ?></span>
			</div>   
			<div class="form-group <?php echo (!empty($email_err)) ? 'has-error' : ''; ?>">
				<input type="text" id="email" name="email" placeholder="Email" class="form-control" value="<?php echo $email; ?>" required>
				<span class="help-block"><?php echo $email_err; ?></span>
			</div> 
            <label style="font-weight: normal"><input type="checkbox" id="checkAdminExist" name="checkAdmin" value=1> Administrator </label>
            <label style="font-weight: normal"><input type="checkbox" id="checkTrainerExist" name="checkTrainer" value=1> Trainer </label>
			<div class="form-group" style="text-align:center; margin:auto;">
				<button type="submit" style="width:250px; background-color:<?php $sql='SELECT farbe FROM system';
 $exec=mysqli_query($link, $sql);
 $result=mysqli_fetch_assoc($exec);
 echo $result['farbe']?>" class="btn btn-primary"><i class="fa fa-save" style="font-size:18px" aria-hidden="true"></i> Speichern</button>
			</div>
		</form>   
	</div>
	<button id="element" style="width:250px; background-color:<?php $sql='SELECT farbe FROM system';
 $exec=mysqli_query($link, $sql);
 $result=mysqli_fetch_assoc($exec);
 echo $result['farbe']?>" onclick = "setVisibility()"><i class="fa fa-user-plus" style="font-size:19px" aria-hidden="true"></i> Benutzer hinzufügen</button>
	<script>
	try{
	    error();
	}
	catch{
	    
	};
	var modal = document.getElementById("myModal");
	var Trainer_element = document.getElementById("Trainer_Auswahl");
	function display(Trainer) {
		modal.style.display = "block";
		Trainer_element.value = Trainer;
		var Auswahl_Leistung = document.getElementById("Auswahl_Leistung");
		Auswahl_Leistung.value = "%"
		Trainer_element.innerHTML= "Erzeuge einen Feedback-Link für den Trainer <b>" + Trainer + "</b><div style='margin-top:20px;margin-bottom:20px'>Leistung die bewertet wird:</div>";
		var Link = document.getElementById("Link");
		Link.value = "";
	}
	// Get the <span> element that closes the modal
	var span = document.getElementsByClassName("close")[0];
	var Auswahl_Leistung = document.getElementById("Auswahl_Leistung");
	var Auswahl_Sprache = document.getElementById("Sprache");
	var Sprache = "Deutsch";
	var Link = document.getElementById("Link");
	var copyButton = document.getElementById("copyButton");
	var current_url = window.location.href;
	var index = current_url.indexOf("Portal");
	current_url = current_url.substr(0,index)+"Feedback_abgeben";
	Auswahl_Leistung.onchange = function(){
		var prefix = "Feedback-Link:<div style='font-size:13px;'> ";
		var Feedbacklink = current_url+"/Vorauswahl.php?Trainer="+Trainer_element.value+"&Sprache="+Sprache+"&Leistung="+Auswahl_Leistung.value;
		Feedbacklink = Feedbacklink.replaceAll(" ","%20");
		Link.value = Feedbacklink;
		copyButton.style.display = "block";
	};
	Auswahl_Sprache.onclick = function(){
		var prefix = "Feedback-Link:<div style='font-size:13px;'> ";
		if(Auswahl_Sprache.checked)
		{
			Sprache= "Englisch";
		}
		else{
			Sprache="Deutsch";
		}
		var Feedbacklink = current_url+"/Vorauswahl.php?Trainer="+Trainer_element.value+"&Sprache="+Sprache+"&Leistung="+Auswahl_Leistung.value;
		Feedbacklink = Feedbacklink.replaceAll(" ","%20");
		Link.value = Feedbacklink;
		copyButton.style.display = "block";
	};
	// When the user clicks on <span> (x), close the modal
	span.onclick = function() {
  		modal.style.display = "none";
		copyButton.style.display = "none";
	}
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
    else if(id==-1)
    {
        window.location = window.location.pathname 
    <?php
        if (isset($_REQUEST["Step"])) {
            echo'+"?Step=6"';
    }
    ?>
    }
    else{
        try{
            document.getElementById("name").value=document.getElementById("name_"+id).innerHTML;
            document.getElementById("username").value=document.getElementById("username_"+id).innerHTML;
            document.getElementById("email").value=document.getElementById("email_"+id).innerHTML;
            if(document.getElementById("berechtigung_"+id).innerHTML.indexOf("Administrator")!=-1)
            {
                document.getElementById("checkAdminExist").checked = true;
            }
            else{
                document.getElementById("checkAdminExist").checked = false;
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
        document.getElementById("existingUserForm").action = "Usermanagement.php?Exists="+id+"<?php
     if (isset($_REQUEST["Step"])) {
         $Step = $_REQUEST["Step"];
         echo"&Step=".$Step;
     } ?>";
	}
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
    <link href="Tutorialstyle.css" rel="stylesheet" type="text/css">
    <script src="Cookiefunctions.js" type="text/javascript"></script>

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
					document.cookie = "UserInformationChecked=1";
				}

        function hideinformationWithoutremembering(){
            document.getElementById("UserInfo_Modal").style.display="none"
        }

    </script>

    </body>
</html>