<?php
$cookie_name = "subdomain";
$cookie_value = $_REQUEST["subdomain"];
setcookie($cookie_name, $cookie_value, time() + (86400 * 30), "/"); // 86400 = 1 day
header("location: login.php");
?>