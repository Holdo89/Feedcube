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

$sql = "SELECT id,name,email FROM users WHERE username = '".$_SESSION["username"]."'";
$query = mysqli_query($link, $sql);
$row = mysqli_fetch_array($query);

$Id=$row["id"];

// Define variables and initialize with empty values


// Processing form data when form is submitted
// Validate new password
$NeuerName=$NeueEmail="";
$NeuerName_err=$NeueEmail_err="";

if (empty(trim($_REQUEST["Name"]))) {
    $NeuerName_err = "Please enter your Name";
}  
else {
    $NeuerName = trim($_REQUEST["Name"]);
}

if (empty(trim($_REQUEST["Email"]))) {
    $NeueEmail_err = "Please enter your Email";
}  
else {
    $NeueEmail = trim($_REQUEST["Email"]);
}



// Check input errors before updating the database
if (empty($NeuerName_err) && empty($NeueEmail_err)) {
    // Prepare an update statement

    $sql = "UPDATE users SET name = ?, email = ? WHERE id = ?";

    if ($stmt = mysqli_prepare($link, $sql)) {
        // Bind variables to the prepared statement as parameters

        mysqli_stmt_bind_param($stmt, "sss", $param_name, $param_email, $param_id);

        // Set parameters

        $param_name = $NeuerName;
        $param_email = $NeueEmail;
        $param_id = $Id;

        // Attempt to execute the prepared statement

        if (mysqli_stmt_execute($stmt)) {
           echo "1";
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
