<?php
// Start the session
$cookie_name = "feedback_abgegeben";
$cookie_value = 1;
setcookie($cookie_name, $cookie_value, time() + (86400), "/"); // 86400 = 1 day
session_start();
$_SESSION["Fragenindex"] = -1;
$_SESSION["Helpindex"] = 1;
$_SESSION["Fragen"] = array();
require_once "../config.php";
?>
<!DOCTYPE html>
<html lang="en">
<?php
 require_once "FEEDCUBE_icon.php"
?>
<head>
<meta charset="UTF-8">
<title>Feedback abgeben</title>
</head>
<link href = "css/fancy.css" type = "text/css" rel = "stylesheet" /> 
<?php
$dir = "../assets/".$subdomain."/bg_givefb/";
$dir_logo = "../assets/".$subdomain."/logo/";
$file = scandir($dir);
$file_logo = scandir($dir_logo);
echo"
<body style=\"background-image:url('../assets/".$subdomain."/bg_givefb/".$file[2]."')\";>
<div style='width:40vw; min-width:900px;'>
    <img class= 'center' src='../assets/".$subdomain."/logo/".$file_logo[2]."' alt='' width='400' height='140'>
    <label style='font-size: 16pt; color:white; padding:10vw; text-align:center;'> 
";
if($_SESSION["Sprache"]=="Deutsch")
{
	$sql = "SELECT Text_nach_Abgabe FROM system";
	$query = mysqli_query($link, $sql);
	$result = mysqli_fetch_array($query);
	echo $result["Text_nach_Abgabe"]."</label>
    ";
}
else if($_SESSION["Sprache"]=="Englisch")
{
	$sql = "SELECT Text_after_Feedback FROM system";
	$query = mysqli_query($link, $sql);
	$result = mysqli_fetch_array($query);
	echo $result["Text_after_Feedback"]."</label>
    ";
}
?>
</div>
</body>
</html>
