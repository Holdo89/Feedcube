<?php

require_once "../config.php";

date_default_timezone_set("Europe/Berlin");
$now = date("Y-m-d H:i");

$sql = "SELECT * FROM umfragen";
$result = mysqli_query($link, $sql) ;

while($row = mysqli_fetch_assoc($result)) 
{
    if($now>$row['Benachrichtigungsdatum'])
    {
        $date=date_create($row['Benachrichtigungsdatum']);
        date_add($date,date_interval_create_from_date_string($row['Intervall']." days"));
        echo $row['Benachrichtigungsdatum']."<br>";
        echo $date->format('Y-m-d H:i:s');
        $sql_update = "UPDATE umfragen SET Benachrichtigungsdatum = '".$date->format('Y-m-d H:i:s')."' WHERE ID = ".$row['ID'];
        mysqli_query($link, $sql_update);
        
        $Benutzer = $row['Benutzer'];
        $Benutzer = str_replace("||",",",$Benutzer);
        $Benutzer = str_replace("|","",$Benutzer);
        $Benutzerarray = explode(",",$Benutzer);
        for($i = 0; $i<sizeof($Benutzerarray); $i++)
        {
            $sql_email = "SELECT email FROM users WHERE username = '".$Benutzerarray[$i]."'";
            $result_email = mysqli_query($link, $sql_email) ;
            $row_email = mysqli_fetch_assoc($result_email);
            $email = $row_email["email"];
            $msg = "Test";
            $headers = 'From: Feedcube Automation <automation@feedcube.net>' . "\r\n";
            mail($email,$row["Umfrage"],$msg,$headers);
        }
    }
}
?>