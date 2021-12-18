<?php
/* Database credentials. Assuming you are running MySQL
server with default setting (user 'root' with no password) */

$url = $_SERVER['HTTP_HOST'].$_SERVER['PHP_SELF'];
$parsedUrl = parse_url($url);
$host = explode('.', $url);
$subdomain = $host[0];

if($subdomain == "mobile")
{
    if(!isset($_COOKIE["subdomain"])){
        header("location: subdomaininput.php");
        exit;
    }
    $subdomain = $_COOKIE["subdomain"];
}
    define('DB_HOST', 'localhost');
    define('DB_USERNAME', 'root');
    define('DB_PASSWORD', '');
    define('DB_NAME', 'feedcube_'.$subdomain);
     
    /* Attempt to connect to MySQL database */
    $link = mysqli_connect(DB_HOST, DB_USERNAME, DB_PASSWORD, DB_NAME);
     
    // Check connection
    if($link === false){
        header("location: subdomain_not_found.php");
        exit;
        //die("ERROR: Could not connect. " . mysqli_connect_error());
    }
?>
