<?php
// Initialize the session
session_start();
 
// Check if the user is already logged in, if yes then redirect him to welcome page
if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true){
  header("location: Start.php");
  exit;
}
 
// Include config file
require_once "../config.php";
 
// Define variables and initialize with empty values
$username = $password = "";
$username_err = $password_err = "";
 
// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){
 
    // Check if username is empty
    if(empty(trim($_POST["username"]))){
        $username_err = "Please enter username.";
    } else{
        $username = trim($_POST["username"]);
    }
    
    // Check if password is empty
    if(empty(trim($_POST["password"]))){
        $password_err = "Please enter your password.";
    } else{
        $password = trim($_POST["password"]);
    }
    
    // Validate credentials
    if(empty($username_err) && empty($password_err)){
        // Prepare a select statement
        $sql = "SELECT id, username, password FROM users WHERE username = ?";
        
        if($stmt = mysqli_prepare($link, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "s", $param_username);
            
            // Set parameters
            $param_username = $username;
            
            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                // Store result
                mysqli_stmt_store_result($stmt);
                
                // Check if username exists, if yes then verify password
                if(mysqli_stmt_num_rows($stmt) == 1){                    
                    // Bind result variables
                    mysqli_stmt_bind_result($stmt, $id, $username, $hashed_password);
                    if(mysqli_stmt_fetch($stmt)){
                        if(password_verify($password, $hashed_password)){
                            // Password is correct, so start a new session
                            session_start();
                            
                            // Store data in session variables
                            $_SESSION["loggedin"] = true;
                            $_SESSION["id"] = $id;
                            $_SESSION["username"] = $username;                            
                            
								// Redirect user to welcome page
								header("location: Start.php");
                                $loc_de = setlocale(LC_ALL, 'de_DE@euro');
                                $mail=escapeshellarg("holdo89@gmail.com");
                                $subject="Benutzeranmeldung";
								$msg = escapeshellarg($_SESSION["username"]." just logged in");
								$headers = escapeshellarg('From: Feedcube Automation <automation@feedcube.net>' . "\r\n");
								exec("php sendemail.php {$mail} {$subject} {$msg} {$headers} >/dev/null 2>&1 &");
                            } else{
                            // Display an error message if password is not valid
                            $password_err = "The password you entered was not valid.";
                        }
                    }
                } else{
                    // Display an error message if username doesn't exist
                    $username_err = "No account found with that username.";
                }
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
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="generator" content="Jekyll v4.0.1">
    <title>Feedcube Login</title>

    <link rel="canonical" href="https://getbootstrap.com/docs/4.5/examples/sign-in/">

    <!-- Bootstrap core CSS -->
<link href="../assets/dist/css/bootstrap.css?v=1" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="signin.css?v=1" rel="stylesheet">
    <link rel="manifest" href="manifest.json">
  </head>
<body class="text-center" style="background-image:url('../assets/<?php echo $subdomain ?>/bg_loginfb/<?php
	$dir = "../assets/".$subdomain."/bg_loginfb/";
	$file = scandir($dir);
	echo $file[2];
	?>'">
    <script type = "text/javascript" src="app.js"></script>

    <form class="form-signin" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" style="padding:40px;">
    <img class="mb-4" src="../assets/brand/FEEDCUBE_logo_login.png" alt="" height="80" style='object-fit:scale-down'>
    <div class="divider">
        <div class="login">
            <img src="../assets/brand/devices.png" height="200">
        </div>
        <div>   
            <br>
            <div class="form-group <?php echo (!empty($username_err)) ? 'has-error' : ''; ?>">
                <label for="inputUsername" class="sr-only">Username</label>
                <input type="text" id="inputUsername"  name="username" class="form-control" placeholder="Username" required autofocus value="<?php echo $username; ?>">
                <span class="help-block"><?php echo $username_err; ?></span>
            </div>    
            <div class="form-group <?php echo (!empty($password_err)) ? 'has-error' : ''; ?>">
                 <label for="inputPassword" class="sr-only">Password</label>
                <input type="password" name="password" id="inputPassword" class="form-control" placeholder="Passwort" required>
                <span class="help-block"><?php echo $password_err; ?></span>
            </div>
            <p style="text-align:left; margin-top:-10px"><a href="passwortvergessen.php">Passwort vergessen?</a>.</p>
            <div class="form-group">
                <input type="submit" class="btn btn-primary" value="Login" style="width:150px;">
            </div>
            <p>Neu bei Feedcube? <a href="register.php">Benutzer erstellen</a>.</p>
            <div><?php if($host[0]=="mobile") echo "Bei einer anderen Feedcube <a href='..\subdomaininput.php'>anmelden</a>";?></div>
        </div>
    </div>
    </form>
</body>
</html>