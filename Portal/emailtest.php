<?php
    $loc_de = setlocale(LC_ALL, 'de_DE@euro');
    echo "Preferred locale for german on this system is '$loc_de'";
    $mail="holdo89@gmail.com";
    $subject=escapeshellarg("local öäü");
    $msg = escapeshellarg($_SESSION["username"]." just lögged in äüö");
    $headers = escapeshellarg('From: Feedcube Automation <automation@feedcube.net>' . "\r\n");
    exec("php sendemail.php {$mail} {$subject} {$msg} {$headers} >/dev/null 2>&1 &");
?>