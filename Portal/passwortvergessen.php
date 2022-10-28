 <!doctype html>

<html lang="en">
<?php
 require_once "FEEDCUBE_icon.php"
?>

  <head>

    <meta charset="utf-8">

    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <meta name="generator" content="Jekyll v4.0.1">

    <title>Registrierung</title>



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


<form class="form-signin" action="?send=1" method="post" style="padding:50px">
        <p><img class="mb-4" src="../assets/brand/FEEDCUBE_logo_login.png" alt="" height="70" style='object-fit:scale-down'></p>

        <?php 
require_once "../config.php";
$pdo = new PDO('mysql:host='.DB_HOST.';dbname='.DB_NAME,DB_USERNAME,DB_PASSWORD);
 
function random_string() {
 if(function_exists('random_bytes')) {
 $bytes = random_bytes(16);
 $str = bin2hex($bytes); 
 } else if(function_exists('openssl_random_pseudo_bytes')) {
 $bytes = openssl_random_pseudo_bytes(16);
 $str = bin2hex($bytes); 
 } else if(function_exists('mcrypt_create_iv')) {
 $bytes = mcrypt_create_iv(16, MCRYPT_DEV_URANDOM);
 $str = bin2hex($bytes); 
 } else {
 //Bitte euer_geheim_string durch einen zufälligen String mit >12 Zeichen austauschen
 $str = md5(uniqid('euer_geheimer_string', true));
 } 
 return $str;
}
 
 
$showForm = true;
 
if(isset($_GET['send']) ) {
 if(!isset($_POST['email']) || empty($_POST['email'])) {
 $error = "<b>Bitte eine E-Mail-Adresse eintragen</b>";
 } else {
 $statement = $pdo->prepare("SELECT * FROM users WHERE email = :email");
 $result = $statement->execute(array('email' => $_POST['email']));
 $user = $statement->fetch(); 
 
 if($user === false) {
 $error = "<b>Kein Benutzer gefunden</b>";
 } else {
 //Überprüfe, ob der User schon einen Passwortcode hat oder ob dieser abgelaufen ist 
 $passwortcode = random_string();
 $statement = $pdo->prepare("UPDATE users SET passwortcode = :passwortcode, passwortcode_time = NOW() WHERE id = :userid");
 $result = $statement->execute(array('passwortcode' => sha1($passwortcode), 'userid' => $user['id']));
 
 $empfaenger = $user['email'];
 $betreff = "Passwortreset"; 

 //$from = "From: Feedcube <d.holzweber@hotmail.com>"; Loclahost Test
 $from = "From: Feedcube Automation <automation@feedcube.net>";
 //$url_passwortcode = 'https://'.$subdomain.'.localhost/Feedcube/Portal/passwortzuruecksetzen.php?id='.$user['id'].'&code='.$passwortcode; //Loclahost Test
 $url_passwortcode = 'https://'.$subdomain.'.feedcube.net/Software/Portal/passwortzuruecksetzen.php?id='.$user['id'].'&code='.$passwortcode; 

 $text = 'Hallo '.$user['name'].',
für deinen Account auf '.$subdomain.'.feedcube.net wurde nach einem neuen Passwort gefragt. Um ein neues Passwort zu vergeben, rufe innerhalb der nächsten 24 Stunden die folgende Website auf:
'.$url_passwortcode.'
 
Sollte dir dein Passwort wieder eingefallen sein oder hast du dies nicht angefordert, so bitte ignoriere diese E-Mail.
 
Viele Grüße,
dein Feedcube-Team';
 
 mail($empfaenger, $betreff, $text, $from);
 
 echo "Ein Link um dein Passwort zurückzusetzen wurde an deine E-Mail-Adresse gesendet."; 
 $showForm = false;
 }
 }
}
 
if($showForm):
?>
 
 
<?php
if(isset($error) && !empty($error)) {
 echo $error;
}
?>


            <h1 class= "h4 mb-3 font-weight-normal">Passwort vergessen</h1>
Gib hier deine E-Mail-Adresse ein, um ein neues Passwort anzufordern.<br><br>

E-Mail:<br>
<input type="email" name="email" class="form-control" value="<?php echo isset($_POST['email']) ? htmlentities($_POST['email']) : ''; ?>"><br>
<input type="submit" class="btn btn-primary" value="Neues Passwort">
</form>
 
<?php
endif; //Endif von if($showForm)
?>