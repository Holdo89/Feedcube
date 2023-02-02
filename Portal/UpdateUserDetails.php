<?php
 require_once "../config.php";
 require_once "session.php";
 include "RedirectToStart.php";

// Check if the user is logged in, otherwise redirect to login page

if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true) {
    header("location: login.php");
    exit;
}

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

     $Exists=$_REQUEST["Exists"];
     // Define variables and initialize with empty values
     $fullname = $username = $email="";
     $fullname_err = $username_err = $email_err="";
     // Processing form data when form is submitted
     if ($_SERVER["REQUEST_METHOD"] == "POST") {
         // Validate username
         if (empty(trim($_REQUEST["fullname"]))) {
             $fullname_err = "Bitte gib deinen vollen Namen ein.";
         } else {
             // Prepare a select statement
             $sql = "SELECT id FROM users WHERE name = ? AND id != ".$_REQUEST["Exists"];
             if ($stmt = mysqli_prepare($link, $sql)) {
                 // Bind variables to the prepared statement as parameters
                 mysqli_stmt_bind_param($stmt, "s", $param_fullname);
                 // Set parameters
                 $param_fullname = trim($_REQUEST["fullname"]);
                 // Attempt to execute the prepared statement
                 if (mysqli_stmt_execute($stmt)) {
                     /* store result */
                     mysqli_stmt_store_result($stmt);
                     $fullname = trim($_REQUEST["fullname"]);
                 } else {
                     echo "Oops! Something went wrong. Please try again later.";
                 }
                 // Close statement
                 mysqli_stmt_close($stmt);
             }
         }
         // Validate username
         if (empty(trim($_REQUEST["username"]))) {
             $username_err = "Bitte gib einen Usernamen ein.";
         } else {
             // Prepare a select statement
             $sql = "SELECT id FROM users WHERE username = ? AND id != ".$_REQUEST["Exists"];
             if ($stmt = mysqli_prepare($link, $sql)) {
                 // Bind variables to the prepared statement as parameters
                 mysqli_stmt_bind_param($stmt, "s", $param_username);
                 // Set parameters
                 $param_username = trim($_REQUEST["username"]);
                 // Attempt to execute the prepared statement
                 if (mysqli_stmt_execute($stmt)) {
                     /* store result */
                     mysqli_stmt_store_result($stmt);
                     if (mysqli_stmt_num_rows($stmt) == 1) {
                         $username_err = "Dieser Username wird bereits verwendet.";
                         echo"1";
                     } else {
                         $username = trim($_REQUEST["username"]);
                     }
                 } else {
                     echo "Oops! Something went wrong. Please try again later.";
                 }
                 // Close statement
                 mysqli_stmt_close($stmt);
             }
         }
         // Validate email
         if (empty(trim($_REQUEST["email"]))) {
             $username_err = "Bitte eine Email Adresse eingeben.";
         } else {
             // Prepare a select statement
             $sql = "SELECT id FROM users WHERE email = ? AND id != ".$_REQUEST["Exists"];
             if ($stmt = mysqli_prepare($link, $sql)) {
                 // Bind variables to the prepared statement as parameters
                 mysqli_stmt_bind_param($stmt, "s", $param_email);
                 // Set parameters
                 $param_email = trim($_REQUEST["email"]);
                
                 // Attempt to execute the prepared statement
                 if (mysqli_stmt_execute($stmt)) {
                     /* store result */
                     mysqli_stmt_store_result($stmt);
                    
                     if (mysqli_stmt_num_rows($stmt) > 0) {
                         $email_err = "Diese Email ist bereits vergeben.";
                         echo"2";
                     } else {
                         $email = trim($_REQUEST["email"]);
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
                 $loc_de = setlocale(LC_ALL, 'de_DE@euro');
                 $subject = escapeshellarg("neue Benutzerregistrierung");
                 $msg = escapeshellarg("Ein Benutzer wurde bearbeitet\r\n \r\nBenutzername: ".$username." \r\nName: ".$fullname." \r\nEmail: ".$email." \r\n\r\nMelden Sie sich bei Ihrem Feedcube System an um den Zugang zu bestätigen oder abzulehnen\r\nhttps://".$subdomain.".feedcube.net");
                 $headers = escapeshellarg('From: Feedcube Automation <automation@feedcube.net>' . "\r\n");
                 $sql = "SELECT email FROM users WHERE Is_Admin = 1";
                 $exec = mysqli_query($link,$sql);
                 while($row=mysqli_fetch_array($exec))
                 {
                     $mail=escapeshellarg($row["email"]);
                     //exec("php sendemail.php {$mail} {$subject} {$msg} {$headers} >/dev/null 2>&1 &");
                     //mail($row["email"],"neue Benutzerregistrierung",$registerMessage,$headers);
                 }
            
                 // Attempt to execute the prepared statement
                 if (mysqli_stmt_execute($stmt)) {
                    echo"3";
                 } else {
                     echo "Something went wrong. Please try again later.";
                 }
                 // Close statement
                 mysqli_stmt_close($stmt);
             }
             $sql="UPDATE users SET umfragenfeedback_abgegeben = '2020-03-27 16:55:00' WHERE username = '".$param_username."'";
             $query=mysqli_query($link, $sql);
             $sql="UPDATE users SET Confirmed = 1 WHERE username = '".$param_username."'";
             $query=mysqli_query($link, $sql);
             // Close connection
             mysqli_close($link);
         }
     }