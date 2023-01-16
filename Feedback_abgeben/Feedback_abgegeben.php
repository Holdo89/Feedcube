<?php
// Start the session
require_once "../config.php";
$cookie_name = "feedback_abgegeben";
$cookie_value = 1;
setcookie($cookie_name, $cookie_value, time() + (86400), "/"); // 86400 = 1 day
session_start();
$_SESSION["Fragenindex"] = -1;
$_SESSION["Helpindex"] = 1;
$_SESSION["Fragen"] = array();
$dir = '../assets/'.$subdomain.'/logo/';
$file = scandir($dir);
?>
<!DOCTYPE html>
<html lang="en">
<?php
 require_once "FEEDCUBE_icon.php"
?>
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Feedback abgeben</title>
</head>
<link href = "css/fancy.css?v=1" type = "text/css" rel = "stylesheet" /> 
<body id ='body' style= "background-image: url('../assets/<?php echo $subdomain ?>/bg_givefb/<?php $dir = "../assets/".$subdomain."/bg_givefb/";$file_background = scandir($dir);echo $file_background[2];?>');">
<form id='Frage_form' style='margin:30px;min-height:600px;'>
</form>
</div>
</body>
<script>
document.getElementById("Frage_form").innerHTML=<?php echo"\"<img class='center' src='../assets/".$subdomain."/logo/".$file[2]."' alt='' width='150' height='70' style='object-fit:scale-down'> <p style='text-align:center'>"; 
        if($_SESSION["Sprache"]=="Deutsch")
        {
            $sql = "SELECT Text_nach_Abgabe FROM system";
            $query = mysqli_query($link, $sql);
            $result = mysqli_fetch_array($query);
            echo $result["Text_nach_Abgabe"]."</p>";
        }
        else if($_SESSION["Sprache"]=="Englisch")
        {
            $sql = "SELECT Text_after_Feedback FROM system";
            $query = mysqli_query($link, $sql);
            $result = mysqli_fetch_array($query);
            echo $result["Text_after_Feedback"]."</p>";
        }
        echo "<img class='center' src='../assets/brand/upload.png' alt='' width='300' style='margin-top:10vh;'> <p style='text-align:center; font-size:13px;'>Powered by <a href='https://feedcube.net'>Feedcube.net</a></p> \" ";
        ?>;
</script>
</html>

