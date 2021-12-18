 <!doctype html>

<html lang="en">
<?php
 require_once "FEEDCUBE_icon.php"
?>

  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="generator" content="Jekyll v4.0.1">
    <title>Subdomain</title>
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
    <link rel="manifest" href="../manifest.webmanifest">
    <script src="../index.js" type="module"></script>
  </head>

<body class="text-center">


<form class="form-signin" action="subdomainsession.php" method="post" style="padding:50px">
    <p><img class="mb-4" src="../assets/brand/FEEDCUBE_logo_login.svg" alt="" width="220" height="70"></p>
    <h1 class= "h4 mb-3 font-weight-normal">Subdomain eingeben</h1>
    Gib hier die Subdomain der Feedcube ein, bei der du dich anmelden möchtest<br><br>
    <input id = "subdomain" name="subdomain" class="form-control">
    <p style="text-align:left; margin-top:5px;">.feedcube.net</p>
    <br>
    <input type="submit" style="width:300px" class="btn btn-primary" value="WEITER">
</form>
 