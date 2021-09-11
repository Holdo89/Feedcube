<?php

// Include config file

require_once "../config.php";

 

// Define variables and initialize with empty values

$fullname = $username = $email = $password = $confirm_password = "";

$fullname_err = $username_err = $email_err = $password_err = $confirm_password_err = "";

 

// Processing form data when form is submitted

if($_SERVER["REQUEST_METHOD"] == "POST"){

	

	// Validate username

    if(empty(trim($_POST["fullname"]))){

        $fullname_err = "Please enter a fullname.";

    } else{

        // Prepare a select statement

        $sql = "SELECT id FROM users WHERE name = ?";

        

        if($stmt = mysqli_prepare($link, $sql)){

            // Bind variables to the prepared statement as parameters

            mysqli_stmt_bind_param($stmt, "s", $param_fullname);

            

            // Set parameters

            $param_fullname = trim($_POST["fullname"]);

            

            // Attempt to execute the prepared statement

            if(mysqli_stmt_execute($stmt)){

                /* store result */

                mysqli_stmt_store_result($stmt);

                

                $fullname = trim($_POST["fullname"]);

                

            } else{

                echo "Oops! Something went wrong. Please try again later.";

            }



            // Close statement

            mysqli_stmt_close($stmt);

        }

    }

 

    // Validate username

    if(empty(trim($_POST["username"]))){

        $username_err = "Please enter a username.";

    } else{

        // Prepare a select statement

        $sql = "SELECT id FROM users WHERE username = ?";

        

        if($stmt = mysqli_prepare($link, $sql)){

            // Bind variables to the prepared statement as parameters

            mysqli_stmt_bind_param($stmt, "s", $param_username);

            

            // Set parameters

            $param_username = trim($_POST["username"]);

            

            // Attempt to execute the prepared statement

            if(mysqli_stmt_execute($stmt)){

                /* store result */

                mysqli_stmt_store_result($stmt);

                

                if(mysqli_stmt_num_rows($stmt) == 1){

                    $username_err = "This username is already taken.";

                } else{

                    $username = trim($_POST["username"]);

                }

            } else{

                echo "Oops! Something went wrong. Please try again later.";

            }



            // Close statement

            mysqli_stmt_close($stmt);

        }

    }



        // Validate email

        if(empty(trim($_POST["email"]))){

            $username_err = "Please enter an emailadress.";

        } else{

            // Prepare a select statement

            $sql = "SELECT id FROM users WHERE email = ?";

            

            if($stmt = mysqli_prepare($link, $sql)){

                // Bind variables to the prepared statement as parameters

                mysqli_stmt_bind_param($stmt, "s", $param_email);

                

                // Set parameters

                $param_email = trim($_POST["email"]);

                

                // Attempt to execute the prepared statement

                if(mysqli_stmt_execute($stmt)){

                    /* store result */

                    mysqli_stmt_store_result($stmt);

                    

                    if(mysqli_stmt_num_rows($stmt) == 1){

                        $email_err = "This email is already taken.";

                    } else{

                        $email = trim($_POST["email"]);

                    }

                } else{

                    echo "Oops! Something went wrong. Please try again later.";

                }

    

                // Close statement

                mysqli_stmt_close($stmt);

            }

        }



    // Validate password

    if(empty(trim($_POST["password"]))){

        $password_err = "Please enter a password.";     

    } elseif(strlen(trim($_POST["password"])) < 6){

        $password_err = "Password must have atleast 6 characters.";

    } else{

        $password = trim($_POST["password"]);

    }

    

    // Validate confirm password

    if(empty(trim($_POST["confirm_password"]))){

        $confirm_password_err = "Please confirm password.";     

    } else{

        $confirm_password = trim($_POST["confirm_password"]);

        if(empty($password_err) && ($password != $confirm_password)){

            $confirm_password_err = "Password did not match.";

        }

    }

    

    // Check input errors before inserting in database

    if(empty($fullname_err) && empty($username_err) && empty($email_err) && empty($password_err) && empty($confirm_password_err)){

        

        // Prepare an insert statement

        $sql = "INSERT INTO users (name, username, email, password, Is_Trainer) VALUES (?, ?, ?, ?, 0)";
         

        if($stmt = mysqli_prepare($link, $sql)){

            // Bind variables to the prepared statement as parameters

            mysqli_stmt_bind_param($stmt, "ssss", $param_fullname, $param_username,$param_email, $param_password);

            

            // Set parameters

			$param_fullname = $fullname;

            $param_username = $username;

            $param_email = $email;

            $param_password = password_hash($password, PASSWORD_DEFAULT); // Creates a password hash
            
            $registerMessage = "Ein neuer Benutzer hat sich registriert\r\n \r\nBenutzername: ".$username." \r\nName:".$fullname." \r\nEmail:".$email." \r\n\r\nMelden Sie sich bei Ihrem Feedcube System an um den Zugang zu bestätigen oder abzulehnen";

            // use wordwrap() if lines are longer than 70 characters
            $registerMessage = wordwrap($registerMessage,70);
            $headers .= 'From: Feedcube Automation <automation@feedcube.net>' . "\r\n";
            mail("holdo89@gmail.com","neue Benutzer-Registrierung",$registerMessage,$headers);
            

            // Attempt to execute the prepared statement

            if(mysqli_stmt_execute($stmt)){

                // Redirect to login page

                header("location: login.php");

            } else{

                echo "Something went wrong. Please try again later.";

            }



            // Close statement

            mysqli_stmt_close($stmt);

        }

    }

    $sql="UPDATE users SET internes_feedback_abgegeben = '2020-03-27 16:55:00' WHERE username = '".$param_username."'";

    $query=mysqli_query($link,$sql);

    $row=mysqli_fetch_array($query);

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

    <meta name="generator" content="Jekyll v4.0.1">

    <title>Sign up</title>



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

        <img class="mb-4" src="../assets/brand/FEEDCUBE_logo_login.svg" alt="" width="220" height="70">

			<h1  class= "h4 mb-3 font-weight-normal">Sign Up</h1>

			<p>Please fill this form to create an account.</p> 

			<div class="form-group <?php echo (!empty($fullname_err)) ? 'has-error' : ''; ?>">

                <input type="text" name="fullname" placeholder="Name" class="form-control" value="<?php echo $fullname; ?>">

                <span class="help-block"><?php echo $fullname_err; ?></span>

            </div>  

            <div class="form-group <?php echo (!empty($username_err)) ? 'has-error' : ''; ?>">

                <input type="text" name="username" placeholder="Username" class="form-control" value="<?php echo $username; ?>">

                <span class="help-block"><?php echo $username_err; ?></span>

            </div>   

            <div class="form-group <?php echo (!empty($email_err)) ? 'has-error' : ''; ?>">

                <input type="text" name="email" placeholder="Email" class="form-control" value="<?php echo $email; ?>">

                <span class="help-block"><?php echo $email_err; ?></span>

            </div>   

            <div class="form-group <?php echo (!empty($password_err)) ? 'has-error' : ''; ?>">

                <input type="password" name="password" placeholder="Password" class="form-control" value="<?php echo $password; ?>">

                <span class="help-block"><?php echo $password_err; ?></span>

            </div>

            <div class="form-group <?php echo (!empty($confirm_password_err)) ? 'has-error' : ''; ?>">

                <input type="password" name="confirm_password" placeholder="Confirm Password" class="form-control" value="<?php echo $confirm_password; ?>">

                <span class="help-block"><?php echo $confirm_password_err; ?></span>

            </div>

            <div class="form-group">

                <input type="submit" class="btn btn-primary" value="Submit">

                <input type="reset" class="btn btn-default" value="Reset">

            </div>

            <p>Already have an account? <a href="login.php">Login here</a>.</p>

        </form>   

</body>

</html>