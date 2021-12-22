<?php

    define('DB_HOST', 'localhost');
    define('DB_USERNAME', 'root');
    define('DB_PASSWORD', '');
    define('DB_NAME', 'feedcube_'.$_REQUEST["subdomain"]);
     
    /* Attempt to connect to MySQL database */
    $link = mysqli_connect(DB_HOST, DB_USERNAME, DB_PASSWORD, DB_NAME);
    if($link === false){
        header("location: subdomaininput.php?invalid=1");
        exit;
    }
    else{
     $cookie_name = "subdomain";
     $cookie_value = $_REQUEST["subdomain"];
     setcookie($cookie_name, $cookie_value, time() + (86400 * 30), "/"); // 86400 = 1 day
     header("location: Portal/login.php");
}

?>

