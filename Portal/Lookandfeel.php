<?php
 require_once "../config.php";
 require_once "session.php";
?>

<!DOCTYPE HTML>
<html>
<?php
 require_once "FEEDCUBE_icon.php"
?><head>
<link class="jsbin" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1/themes/base/jquery-ui.css" rel="stylesheet" type="text/css" />
<script class="jsbin" src="https://ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js"></script>
<script class="jsbin" src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.8.0/jquery-ui.min.js"></script>

    <meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Feedback Auswertung</title>
	<link href="bootstrap.css" rel="stylesheet" type="text/css">
	<link href="charts.css" rel="stylesheet" type="text/css">
	<link href="system_optionen.css" rel="stylesheet" type="text/css">
	<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.3/Chart.min.js"></script>
	<?php
	include "Leistung_speichern.php";
	?>
</head>
<body class="text-center">
 <!-- Load an icon library to show a hamburger menu (bars) on small screens -->
<script src="https://kit.fontawesome.com/9059ff5bc6.js" crossorigin="anonymous"></script>
<link href="navigation.css" rel="stylesheet" type="text/css">
<script type="text/javascript" src="navigation.js"></script>	
    <div class="header">
	<?php
	include "navigation_admin.php";
?>
<script>
	document.getElementById("Lookandfeel").className = "active";
	document.getElementById("System").style.backgroundColor = "lightgrey";
</script>
		<h1 style="font-size:30px; margin-bottom:10px;"><img src="../assets/brand/paintbrush.png" width="50"> Look & Feel </h1>
		<p style="margin-bottom:30px">Hier kann das Erscheinungsbild des Portals gestaltet werden. <br>Definiere dazu ein Farbschema und lade ein Firmenlogo und Hintergrundbilder hoch</p>	</div>
		</div>
	<div class="scroll">
	<style>
	.überschrift{
		background-color: <?php $sql='SELECT farbe FROM system'; $exec=mysqli_query($link,$sql); $result=mysqli_fetch_assoc($exec); echo $result['farbe']?>;
	}
	</style>
	<div class="alert icon-alert with-arrow alert-success form-alter" role="alert" style="display:none;">
		<i class="fa fa-fw fa-check-circle"></i>
		<strong> Erfolgreicher Upload!</strong><span class="success-message"> Deine Dateien wurden erfolgreich hochgeladen</span>
	</div>

	<div id="range_alert" class="alert icon-alert with-arrow alert-danger form-alter" role="alert" style="display:none;">
		<i class="fa fa-fw fa-times-circle"></i>
		<strong> Ungültige Datei!</strong> <span class="warning-message"> Bitte lade nur JPG, JPEG, PNG oder GIF Dateien hoch mit einer maximalen Größe von 5 MB.</span>
	</div>
	<form action="Lookandfeel.php" method="post" enctype="multipart/form-data" style="margin-top:10px;">
	<label class="überschrift">Look & Feel</label><label class="überschrift"></label>
	
	<script>
	function user_abfrage_speichern(id) {
			speichern(id);
	;}
	function user_abfrage_löschen(id) {
  	if (confirm("Wollen Sie diese Leistung entfernen? Ihre bestehenden Antworten zu dieser Leistung werden ebenfalls entfernt"))
	  {entfernen(id);
		alert("Die Leistung wurde gelöscht");
		location.reload();}
	;}

	function readURL(input, filename) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function (e) {
                $(filename)
                    .attr('src', e.target.result)
                    .width(200);
            };

            reader.readAsDataURL(input.files[0]);
        }
    }


	</script>
	<?php
	$url = $_SERVER['HTTP_HOST'].$_SERVER['PHP_SELF'];
	$parsedUrl = parse_url($url);
	$host = explode('.', $url);
	$subdomain = $host[0];
	?>

	<label>Farbschema:</label>
	<input type="color" id="favcolor" name="favcolor" value="<?php $sql="SELECT farbe FROM system"; $exec=mysqli_query($link,$sql); $result=mysqli_fetch_assoc($exec); echo $result['farbe']?>" style="margin:12px; padding:2px; width:90px; height:30px;"></input>
	
	<label> Logo Feedback abgeben:</label>
	<div>
	<input type="file" id="logo" name="logo" accept="image/png,image/gif,image/jpeg" onchange="readURL(this,'#logo_view');"></input>
	<img id="logo_view" src="../assets/<?php echo $subdomain ?>/logo/<?php
	$dir = "../assets/".$subdomain."/logo/";
	$file = scandir($dir);
	echo $file[2]; //notwendig weil 0=.und 1=..
	?>" alt="your image" width="200px" />
	</div>

	<label>Hintergrund Feedback abgeben:</label>
	<div>
	<input type="file" id="bgimage" name="bgimage" accept="image/png,image/gif,image/jpeg" onchange="readURL(this,'#bgimage_view');"></input>
	<img id="bgimage_view" src="../assets/<?php echo $subdomain ?>/bg_givefb/<?php
	$dir = "../assets/".$subdomain."/bg_givefb/";
	$file = scandir($dir);
	echo $file[2];
	?>" alt="your image" width="200px" />
	</div>
	
	<label>Hintergrund Feedcube login:</label>
	<div>
	<input type="file" id="bgimage2" name="bgimage2" accept="image/png,image/gif,image/jpeg" onchange="readURL(this,'#bgimage_view2');"></input>
	<img id="bgimage_view2" src="../assets/<?php echo $subdomain ?>/bg_loginfb/<?php
	$dir = "../assets/".$subdomain."/bg_loginfb/";
	$file = scandir($dir);
	echo $file[2];
?>" alt="your image" width="200px" />
	</div>
	<button class="btn fa-input" type="submit" name = "Submit" style="margin:auto; grid-column: 1 / span 2; margin-top:30px; margin-bottom:30px; color:white; background-color:<?php $sql='SELECT farbe FROM system'; $exec=mysqli_query($link,$sql); $result=mysqli_fetch_assoc($exec); echo $result['farbe']?>"><i class="fa fa-save"></i> Speichern</button>
	</form>
	</div>
    </body>
</html>
<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    function delete_files($directory)
    {
        $files = glob($directory.'*'); // get all file names
        foreach($files as $file){ // iterate files
            if(is_file($file))
            {
                unlink($file); // delete file
            }
        }
    }

    function checkfile($filename, &$uploadOk)
    {
        // Check if image file is a actual image or fake image
        if (isset($_POST["submit"])) {
            $check = getimagesize($_FILES[$filename]["tmp_name"]);
            if ($check !== false) {
                echo "File is an image - " . $check["mime"] . ".";
                $uploadOk = 1;
            } else {
                echo "File is not an image.";
                $uploadOk = 0;
            }
        }
    }

    // Allow certain file formats
    function checkimagetype($imageFileType, &$uploadOk)
    {
        if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
        && $imageFileType != "gif") {
            $uploadOk = 0;
        }
    }

    // Check if file already exists
    function check_exists($file, &$uploadOk)
    {
        if (file_exists($file)) {
            $uploadOk = 0;
        }
    }

    // Check file size
    function check_filesize($file, &$uploadOk)
    {
        if ($_FILES[$file]["size"] > 5000000) {
            echo "<script type='text/javascript'>$(\".alert-danger\").show();$(\".alert-success\").hide();</script>";
            $uploadOk = 0;
        }
    }

    $color = $_REQUEST["favcolor"];
    $sql = "UPDATE system SET farbe = '".$color."';";
    $exec = mysqli_query($link, $sql);


    $url = $_SERVER['HTTP_HOST'].$_SERVER['PHP_SELF'];
    $parsedUrl = parse_url($url);
    $host = explode('.', $url);
    $subdomain = $host[0];
	$logo_dir = "../assets/".$subdomain."/logo/";
	$bg_givefb_dir = "../assets/".$subdomain."/bg_givefb/";
	$bg_loginfb_dir = "../assets/".$subdomain."/bg_loginfb/";

	function upload_file($filename, $filename_new, &$uploadOk)
    {
		$url = $_SERVER['HTTP_HOST'].$_SERVER['PHP_SELF'];
		$parsedUrl = parse_url($url);
		$host = explode('.', $url);
		$subdomain = $host[0];
		$logo_dir = "../assets/".$subdomain."/logo/";
		$bg_givefb_dir = "../assets/".$subdomain."/bg_givefb/";
		$bg_loginfb_dir = "../assets/".$subdomain."/bg_loginfb/";
	
        // Check if $uploadOk is set to 0 by an error
        if ($uploadOk == 0) {
            echo "<script type='text/javascript'>$(\".alert-danger\").show();$(\".alert-success\").hide();</script>";
        // if everything is ok, try to upload file
        } else {
            if (move_uploaded_file($_FILES[$filename]["tmp_name"], $filename_new)) {
				echo "<script type='text/javascript'>$(\".alert-danger\").hide();$(\".alert-success\").show();</script>";
            }
        }
    }

    if ($_FILES["logo"]["name"]!="") {
        $logo_file = $logo_dir . basename($_FILES["logo"]["name"]);
    } else {
        $file = scandir($logo_dir);
        $logo_file = $logo_dir .$file[2];
    }

    if ($_FILES["bgimage"]["name"]!="") {
        $bggivefb_file = $bg_givefb_dir . basename($_FILES["bgimage"]["name"]);
    } else {
        $file = scandir($bg_givefb_dir);
        $bggivefb_file = $bg_givefb_dir .$file[2];
    }

    if ($_FILES["bgimage2"]["name"]!="") {
        $bgloginfb_file = $bg_loginfb_dir . basename($_FILES["bgimage2"]["name"]);
    } else {
        $file = scandir($bg_loginfb_dir);
        $bgloginfb_file = $bg_loginfb_dir .$file[2];
    }

    $logoFileType = strtolower(pathinfo($logo_file, PATHINFO_EXTENSION));
    $bggivefbFileType = strtolower(pathinfo($bggivefb_file, PATHINFO_EXTENSION));
    $bgloginfbFileType = strtolower(pathinfo($bgloginfb_file, PATHINFO_EXTENSION));

    $logo_file_new = $logo_dir ."logo.".$logoFileType;
    $bggivefb_file_new = $bg_givefb_dir ."bgimage.".$bggivefbFileType;
    $bgloginfb_file_new = $bg_loginfb_dir ."bgimage2.".$bgloginfbFileType;

    $uploadOk = 1;

    checkfile("logo", $uploadOk);
    checkfile("bgimage", $uploadOk);
    checkfile("bgimage2", $uploadOk);

    checkimagetype($logoFileType, $uploadOk);
    checkimagetype($bggivefbFileType, $uploadOk);
    checkimagetype($bgloginfbFileType, $uploadOk);

    check_filesize("logo", $uploadOk);
    check_filesize("bgimage", $uploadOk);
    check_filesize("bgimage2", $uploadOk);
	
	if ($_FILES["logo"]["name"]!="" && $uploadOk ==1) {
		delete_files($logo_dir);
	}
	if ($_FILES["bgimage"]["name"]!="" && $uploadOk ==1) {
		delete_files($bg_givefb_dir);
	}
	if ($_FILES["bgimage2"]["name"]!="" && $uploadOk ==1) {
		delete_files($bg_loginfb_dir);
	}
    upload_file("logo", $logo_file_new, $uploadOk);
    upload_file("bgimage", $bggivefb_file_new, $uploadOk);
    upload_file("bgimage2", $bgloginfb_file_new, $uploadOk);
}

?>