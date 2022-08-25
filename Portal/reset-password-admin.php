<?php

// Initialize the session

session_start();

 

// Check if the user is logged in, otherwise redirect to login page

if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){

    header("location: login.php");

    exit;

}

 

// Include config file

require_once "../config.php";

$Id=$_REQUEST["Id"];

$Name=$_REQUEST["Name"];

 

// Define variables and initialize with empty values

$new_password = $confirm_password = "";

$new_password_err = $confirm_password_err = "";

 

// Processing form data when form is submitted

if($_SERVER["REQUEST_METHOD"] == "POST"){

 

    // Validate new password

    if(empty(trim($_POST["new_password"]))){

        $new_password_err = "Please enter the new password.";     

    } elseif(strlen(trim($_POST["new_password"])) < 6){

        $new_password_err = "Password must have atleast 6 characters.";

    } else{

        $new_password = trim($_POST["new_password"]);

    }

    

    // Validate confirm password

    if(empty(trim($_POST["confirm_password"]))){

        $confirm_password_err = "Please confirm the password.";

    } else{

        $confirm_password = trim($_POST["confirm_password"]);

        if(empty($new_password_err) && ($new_password != $confirm_password)){

            $confirm_password_err = "Password did not match.";

        }

    }

        

    // Check input errors before updating the database

    if(empty($new_password_err) && empty($confirm_password_err)){

        // Prepare an update statement

        $sql = "UPDATE users SET password = ? WHERE id = ?";

        

        if($stmt = mysqli_prepare($link, $sql)){

            // Bind variables to the prepared statement as parameters

            mysqli_stmt_bind_param($stmt, "si", $param_password, $param_id);

            

            // Set parameters

            $param_password = password_hash($new_password, PASSWORD_DEFAULT);

            $param_id = $_REQUEST["Id"];

            

            // Attempt to execute the prepared statement

            if(mysqli_stmt_execute($stmt)){

                // Password updated successfully. Destroy the session, and redirect to login page
                if(isset($_REQUEST["Step"]))
                {
                    $Step = $_REQUEST["Step"];
                    header("location: Usermanagement.php?Step=".$Step);
                }
                else{
                    header("location: Usermanagement.php");
                }

                exit();

            } else{

                echo "Oops! Something went wrong. Please try again later.";

            }



            // Close statement

            mysqli_stmt_close($stmt);

        }

    }

    

    // Close connection

    mysqli_close($link);

}

?>

 

<!doctype html>

<html lang="en">
<?php
 require_once "FEEDCUBE_icon.php"
?>

  <head>

    <meta charset="utf-8">

    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <meta name="description" content="">

    <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">

    <meta name="generator" content="Jekyll v4.0.1">

    <title>Signin Template · Bootstrap</title>



    <link rel="canonical" href="https://getbootstrap.com/docs/4.5/examples/sign-in/">



    <!-- Bootstrap core CSS -->

<link href="../assets/dist/css/bootstrap.css" rel="stylesheet">



    <style>

      .bd-placeholder-img {

        font-size: 1.125rem;

        text-anchor: middle;

        -webkit-user-select: none;

        -moz-user-select: none;

        -ms-user-select: none;

        user-select: none;

      }



      @media (min-width: 748px) {

        .bd-placeholder-img-lg {

          font-size: 3.5rem;

        }

      }

    </style>

    <!-- Custom styles for this template -->

    <link href="signin.css" rel="stylesheet">

  </head>

<body class="text-center">

        <form class="form-signin" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">

        <img class="mb-4" src="../assets/brand/FEEDCUBE_logo_login.svg" alt="" width="220" height="70" style='object-fit:scale-down'>

		<h1  class= "h4 mb-3 font-weight-normal">Reset Passwort für <?php echo $Name;?><h1  class= "h4 mb-3 font-weight-normal">

            <div class="form-group <?php echo (!empty($new_password_err)) ? 'has-error' : ''; ?>">

                <label>New Password</label>

                <input type="password" name="new_password" class="form-control" value="<?php echo $new_password; ?>">

                <span class="help-block"><?php echo $new_password_err; ?></span>

            </div>

            <div class="form-group <?php echo (!empty($confirm_password_err)) ? 'has-error' : ''; ?>">

                <label>Confirm Password</label>

                <input type="password" name="confirm_password" class="form-control">

                <span class="help-block"><?php echo $confirm_password_err; ?></span>

            </div>

            <input type="hidden" id="Id" name="Id" value="<?php echo $Id?>">

            <div class="form-group">

                <input type="submit" class="btn btn-primary" value="Submit">

                <a class="btn btn-link" href="login.php">Cancel</a>

            </div> 

        </form> 

</body>

</html>