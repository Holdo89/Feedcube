<?php
    echo "Email successfully sent";
    $mail="holdo89@gmail.com";
    $subject=escapeshellarg("local öäü");
    $msg = escapeshellarg($_SESSION["username"]." just lögged in äüö");
    $headers = escapeshellarg('From: Feedcube Automation <automation@feedcube.net>' . "\r\n");
    mail($mail,$subject,$msg,$headers);
?>