<?php
// Start the session
require_once "../config.php";

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
    document.getElementById("Frage_form").innerHTML=<?php echo"\"<img class='center' src='../assets/".$subdomain."/logo/".$file[2]."' alt='' width='150' height='70' style='object-fit:scale-down'> <p style='text-align:center'>Vielen Dank für die Teilnahme an der Umfrage.";
    
    if(isset($_COOKIE["Umfrage".$_SESSION["Umfrage"]."_teilgenommen"])) {
        $sql = "SELECT Intervall FROM umfragen WHERE ID = ".$_SESSION["Umfrage"];
        $query = mysqli_query($link, $sql);
        $result = mysqli_fetch_array($query);
        if ($result["Intervall"]!=0) {
            echo "Du kannst erneut an der Umfrage teilnehmen am: <br><br>".$_COOKIE["Umfrage".$_SESSION["Umfrage"]."_teilgenommen"];
        }
    }
    echo  " <br><br>Um die Auswertung der Umfrage zu sehen kehre zurück ins Portal </p>";
    echo "<img class='center' src='../assets/brand/upload.png' alt='' style='margin-top:10vh; width:50%;'> <input class='center_button' type='button' style='background-color:#084f6e; color:white' onclick=\\\"location.href='../Portal/Umfragen.php'\\\" value='zurück zum Portal'></input> \" ";?>
</script>
</html>

