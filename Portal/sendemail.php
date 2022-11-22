<?php
//file sends emails asynchronously
    $email = $argv[1];
    $subject = $argv[2];
    $msg =  $argv[3];
    $headers =  $argv[4];
    mail($email,$subject,$msg,$headers);

?>