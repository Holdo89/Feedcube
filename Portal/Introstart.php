<?php
 require_once "../config.php";
 require_once "session.php";
?>

<!DOCTYPE html>
<html>
<?php
  require_once "FEEDCUBE_icon.php"
?>

<head>

    <title>Feedcube Intro</title>

    <meta name="viewport" content="width=device-width, initial-scale=1">

    <style>
    body {

        margin: 0;

    }



    #myVideo {

        position: fixed;

        right: 0;

        bottom: 0;

        min-width: 100%;

        min-height: 100%;

    }



    #element {

        width: 250px;

        position: relative;

        margin: auto;

        margin-left: -55px;

        margin-right: 20px;

        text-align: center;

        margin-top: 25px;

        cursor: pointer;

        padding: 15px;

        font-size: 20px;

        border: none;

        border-radius: 30px;

        color: white;

        background-color: <?php $sql='SELECT farbe FROM system';
        $exec=mysqli_query($link, $sql);
        $result=mysqli_fetch_assoc($exec);
        echo $result['farbe']?>
    }



    #element2 {

        width: 250px;

        position: relative;

        margin: auto;

        text-align: center;

        margin-top: 25px;

        cursor: pointer;

        padding: 13px;

        font-size: 20px;

        border: 3px solid;

        border-radius: 30px;

        border-color: <?php $sql='SELECT farbe FROM system';
        $exec=mysqli_query($link, $sql);
        $result=mysqli_fetch_assoc($exec);
        echo $result['farbe']?>;

        color: <?php $sql='SELECT farbe FROM system';
        $exec=mysqli_query($link, $sql);
        $result=mysqli_fetch_assoc($exec);
        echo $result['farbe']?>;

        background-color: white
    }



    .content {

        position: fixed;

        bottom: 20%;

        left: 35%;

        padding: 20px;

    }



    .btn {

        margin-top: -300px;

        display: none;

    }



    #element,
    #element2 {

        -webkit-animation: 4.5s ease 0s normal forwards 1 fadein;

        animation: 4.5. ease 0s normal forwards 1 fadein;

    }



    #icon {

        -webkit-animation: 4s ease 0s normal forwards 1 fadein;

        animation: 4. ease 0s normal forwards 1 fadein;

    }





    @keyframes fadein {

        0% {
            opacity: 0;
        }

        66% {
            opacity: 0;
        }

        100% {
            opacity: 1;
        }

    }



    @-webkit-keyframes fadein {

        0% {
            opacity: 0;
        }

        66% {
            opacity: 0;
        }

        100% {
            opacity: 1;
        }

    }



    @media only screen and (max-width: 600px) {



        .content {

            position: fixed;

            bottom: 20%;

            left: 10%;

            padding: 20px;

        }



        #element {

            margin: auto;

            margin-left: 0px;

        }



        .btn {

            display: block;

        }

    }
    </style>

    <link href="charts2.css" rel="stylesheet" type="text/css">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

</head>



<body>



    <video autoplay muted loop id="myVideo">

        <source src="Logo_Intro.mp4" type="video/mp4">

        Your browser does not support HTML5 video.

    </video>



    <div class="content">

        <div>
            <?php if ($host[0]=="test") {
            echo '<img id="icon" class="btn" src="../assets/brand/FEEDCUBE_logo_login.svg" alt="" width="270" height="90" style="margin-bottom:20%">';
        }?>
        </div>

        <button id="element" onclick="pageRedirect()"><i class="fa fa-cogs" aria-hidden="true"
                style="font-size:25px"></i><br>Erste Konfiguration</button>

        <button id="element2" onclick="skipIntro()"><i class="fa fa-forward" aria-hidden="true"
                style="font-size:25px"></i><br>Überspringen</button>

    </div>



    <script>
    function pageRedirect() {
        window.location.href = "Tutorial_Fragen.php";
    }

    function skipIntro() {
        <?php
            $cookie_name = "SkipIntro";
            $cookie_value = 1;
            setcookie($cookie_name, $cookie_value, time() + (86400 * 30), "/"); // 86400 = 1 day
        ?>
        window.location.href = "Start.php";
    }
    </script>

</body>

</html>