<?php

// Initialize the session

session_start();

// Check if the user is logged in, otherwise redirect to login page

if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true) {
    header("location: login.php");
    exit;
}

// Include config file
require_once "../config.php";

$sql = "SELECT id,password FROM users WHERE username = '".$_SESSION["username"]."'";
$query = mysqli_query($link, $sql);
$row = mysqli_fetch_array($query);

$Id=$row["id"];
$oldPassword=$row["password"];

// Define variables and initialize with empty values

$AltesPasswort = $NeuesPasswort = $WiederholtesPasswort = "";
$AltesPasswort_err = $NeuesPasswort_err = $WiederholtesPasswort_err = "";

if(!password_verify($_REQUEST["AltesPasswort"],$oldPassword))
{
	$AltesPasswort_err = "Passwort falsch";
	echo "1";
}

// Processing form data when form is submitted
// Validate new password

if (empty(trim($_REQUEST["NeuesPasswort"]))) {
    $NeuesPasswort_err = "Please enter the new password.";
} elseif (strlen(trim($_REQUEST["NeuesPasswort"])) < 6) {
    $NeuesPasswort_err = "Password must have atleast 6 characters.";
} else {
    $NeuesPasswort = trim($_REQUEST["NeuesPasswort"]);
}

// Validate confirm password

if (empty(trim($_REQUEST["WiederholtesPasswort"]))) {
    $WiederholtesPasswort_err = "Please confirm the password.";
} else {
    $WiederholtesPasswort = trim($_REQUEST["WiederholtesPasswort"]);

    if (empty($NeuesPasswort_err) && ($NeuesPasswort != $WiederholtesPasswort)) {
        $WiederholtesPasswort_err = "Password did not match.";
		echo"2";
    }
}

// Check input errors before updating the database
if (empty($NeuesPasswort_err) && empty($WiederholtesPasswort_err) && empty($AltesPasswort_err)) {
    // Prepare an update statement

    $sql = "UPDATE users SET password = ? WHERE id = ?";

    if ($stmt = mysqli_prepare($link, $sql)) {
        // Bind variables to the prepared statement as parameters

        mysqli_stmt_bind_param($stmt, "si", $param_password, $param_id);

        // Set parameters

        $param_password = password_hash($NeuesPasswort, PASSWORD_DEFAULT);
        $param_id = $Id;

        // Attempt to execute the prepared statement

        if (mysqli_stmt_execute($stmt)) {
           echo "3";
		   //header("location: Profil.php");

            exit();
        } else {
            echo "Oops! Something went wrong. Please try again later.";
        }

        // Close statement
        mysqli_stmt_close($stmt);
    }
}

// Close connection
mysqli_close($link);
