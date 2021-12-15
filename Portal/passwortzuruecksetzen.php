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

<?php
require_once "../config.php";
$pdo = new PDO('mysql:host='.DB_HOST.';dbname='.DB_NAME,DB_USERNAME,DB_PASSWORD);
 
if(!isset($_GET['id']) || !isset($_GET['code'])) {
 die("Leider wurde beim Aufruf dieser Website kein Code zum Zurücksetzen deines Passworts übermittelt");
}
 
$id = $_GET['id'];
$code = $_GET['code'];

?>

<form action="?send=1&amp;id=<?php echo htmlentities($id); ?>&amp;code=<?php echo htmlentities($code); ?>" method="post" style="padding:50px">
        <p><img class="mb-4" src="../assets/brand/FEEDCUBE_logo_login.svg" alt="" width="220" height="70"></p>

<?php
//Abfrage des Nutzers
$statement = $pdo->prepare("SELECT * FROM users WHERE id = :id");
$result = $statement->execute(array('id' => $id));
$user = $statement->fetch();
 
//Überprüfe dass ein Nutzer gefunden wurde und dieser auch ein Passwortcode hat
if($user === null || $user['passwortcode'] === null) {
 die("Es wurde kein passender Benutzer gefunden");
}
 
if($user['passwortcode_time'] === null || strtotime($user['passwortcode_time']) < (time()-24*3600) ) {
 die("Dein Code ist leider abgelaufen");
}
 
 
//Überprüfe den Passwortcode
if(sha1($code) != $user['passwortcode']) {
 die("Der übergebene Code war ungültig. Stell sicher, dass du den genauen Link in der URL aufgerufen hast.");
}
 
//Der Code war korrekt, der Nutzer darf ein neues Passwort eingeben
 
if(isset($_GET['send'])) {
 $passwort = $_POST['passwort'];
 $passwort2 = $_POST['passwort2'];
 
 if($passwort != $passwort2) {
 echo "Bitte identische Passwörter eingeben";
 } else { //Speichere neues Passwort und lösche den Code
 $passworthash = password_hash($passwort, PASSWORD_DEFAULT);
 $statement = $pdo->prepare("UPDATE users SET password = :passworthash, passwortcode = NULL, passwortcode_time = NULL WHERE id = :id");
 $result = $statement->execute(array('passworthash' => $passworthash, 'id'=> $id ));
 
 if($result) {
 die('Dein Passwort wurde erfolgreich geändert<br><br><input type="button" value="zum Login" class="btn btn-primary" onclick="location.href = \'https://'.$subdomain.'.feedcube.net\';"></input>');
 }
 }
}
?>
 
<h4 style="margin:40px">Neues Passwort vergeben</h4>
<form action="?send=1&amp;id=<?php echo htmlentities($id); ?>&amp;code=<?php echo htmlentities($code); ?>" method="post">
Bitte gib ein neues Passwort ein:<br>
<input type="password" name="passwort" class="form-control"><br>
Passwort erneut eingeben:<br>
<input type="password" name="passwort2" class="form-control"><br>
 
<input type="submit" class="btn btn-primary" value="Passwort speichern">
</form>