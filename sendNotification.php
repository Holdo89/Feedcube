<?php

function sendNotification($subdomain)
{   
    define('DB_HOST', 'localhost');
    define('DB_USERNAME', 'feedcube');
    define('DB_PASSWORD', 'r3T@nd&3r3T@nd&3');
    define('DB_NAME', 'feedcube_'.$subdomain);
    
    /* Attempt to connect to MySQL database */
    $link = mysqli_connect(DB_HOST, DB_USERNAME, DB_PASSWORD, DB_NAME);
    $link->set_charset("utf8");

    date_default_timezone_set("Europe/Berlin");
    $now = date("Y-m-d H:i");

    $sql = "SELECT * FROM umfragen";
    $result = mysqli_query($link, $sql) ;

    while($row = mysqli_fetch_assoc($result)) 
    {
        if($now>$row['Benachrichtigungsdatum'] && $row['Benachrichtigung']!="niemals" )
        {
            $date=date_create($row['Benachrichtigungsdatum']);
            date_add($date,date_interval_create_from_date_string($row['Intervall']." days"));
            echo $row['Benachrichtigungsdatum']."<br>";
            echo $date->format('Y-m-d H:i:s');
            if($row['Benachrichtigung']=="wiederkehrend")
            {
                $sql_update = "UPDATE umfragen SET Benachrichtigungsdatum = '".$date->format('Y-m-d H:i:s')."' WHERE ID = ".$row['ID'];
                mysqli_query($link, $sql_update);
            }
            
            $Benutzer = $row['Benutzer'];
            $Benutzer = str_replace("||",",",$Benutzer);
            $Benutzer = str_replace("|","",$Benutzer);
            $Benutzerarray = explode(",",$Benutzer);
            for($i = 0; $i<sizeof($Benutzerarray); $i++)
            {
                $sql_emailsent="SELECT ersteBenachrichtigungGesendet FROM umfragen WHERE ID = ".$row['ID'];
                $result_emailsent = mysqli_query($link, $sql_emailsent) ;
                $row_emailsent = mysqli_fetch_assoc($result_emailsent);
                if (($row['Benachrichtigung']=="einmalig" && $row_emailsent['ersteBenachrichtigungGesendet']==0)||$row['Benachrichtigung']=="wiederkehrend") {
                    $sql_email = "SELECT email FROM users WHERE username = '".$Benutzerarray[$i]."'";
                    $result_email = mysqli_query($link, $sql_email) ;
                    $row_email = mysqli_fetch_assoc($result_email);
                    $email = $row_email["email"];
                    echo $email;
                    $msg = "Hallo ".$Benutzerarray[$i].",
                    
Du kannst jetzt an der Umfrage \"".$row["Umfrage"]."\" teilnehmen. 
Folge dazu dem untenstehenden Link:
https://".$subdomain.".feedcube.net/Software/Umfrage/Vorauswahl.php?Umfrage=".$row['ID']."
                    
Dein Feedcube Team";
                    $headers = 'From: Feedcube Automation <automation@feedcube.net>' . "\r\n";
                    mail($email, "Benachrichtigung zu Umfrage \"".$row["Umfrage"]."\"", $msg, $headers);
                }
            }

            $sql_update = "UPDATE umfragen SET ersteBenachrichtigungGesendet = 1 WHERE ID = ".$row['ID'];
            mysqli_query($link, $sql_update);
        }
    }
}
sendNotification("swql");
sendNotification("test");

?>