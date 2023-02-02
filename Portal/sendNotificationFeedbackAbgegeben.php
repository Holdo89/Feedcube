<?php

function sendNotification($subdomain)
{
    define('DB_HOST', 'localhost');
    define('DB_USERNAME', 'feedcube');
    define('DB_PASSWORD', 'r3T@nd&3r3T@nd&3');
    define('DB_NAME', 'feedcube_'.$subdomain);

    /* Attempt to connect to MySQL database */
    $link = mysqli_connect(DB_HOST, DB_USERNAME, DB_PASSWORD, 'feedcube_'.$subdomain);
    $link->set_charset("utf8");

    date_default_timezone_set("Europe/Berlin");
    $now = date("Y-m-d H:i");

    $sql_users = "SELECT username,name,Is_Admin,Notification FROM users";
    $result_users = mysqli_query($link, $sql_users);
    while($row_users = mysqli_fetch_array($result_users)){
    if ($row_users["Notification"]==1) {
        if ($row_users["Is_Admin"]==1) {
                $sql = "SELECT COUNT(ID), Leistung FROM kursfeedback WHERE Datum > now() - INTERVAL 24 HOUR";
            } else {
                $sql = "SELECT COUNT(ID), Leistung FROM kursfeedback WHERE username = '".$row_users["username"]."' AND Datum > now() - INTERVAL 24 HOUR";
            }
            $result = mysqli_query($link, $sql) ;
            $row = mysqli_fetch_array($result);
            if ($row["COUNT(ID)"]!="0") {
                if ($row["COUNT(ID)"]=="1") {
                    $TextAnzahl = "wurde 1 neue Bewertung";
                } else {
                    $TextAnzahl = "wurden ".$row["COUNT(ID)"]." neue Bewertungen";
                }
                $sql_email = "SELECT email FROM users WHERE username = '".$row_users["username"]."'";
                $result_email = mysqli_query($link, $sql_email) ;
                $row_email = mysqli_fetch_assoc($result_email);
                $email = $row_email["email"];
                $msg = "Hallo ".$row_users["name"].",
                
                    In den letzten 24 Stunden ".$TextAnzahl." abgegeben. Um deine Bewertungen auszuwerten besuche das Feedcube Portal unter folgendem Link:

                    https://".$subdomain.".feedcube.net

                    Dein Feedcube Team";
                $headers = 'From: Feedcube Automation <automation@feedcube.net>' . "\r\n";
                mail($email, "Neues Feedback wurde abgegeben", $msg, $headers);
            }
        }      
    }
    mysqli_close($link);
}
//sendNotification("swql");
sendNotification("test");

?><?php sendNotification('demo');?>