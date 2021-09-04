<?php
 require_once "../config.php";
 require_once "session.php";
?>

<?php

function delete_files($directory){
    $files = glob($directory.'*'); // get all file names
    foreach($files as $file){ // iterate files
        if(is_file($file)) 
        {
            unlink($file); // delete file
        }
    }
}

function checkfile($filename, &$uploadOk){
    // Check if image file is a actual image or fake image
    if(isset($_POST["submit"])) {
        $check = getimagesize($_FILES[$filename]["tmp_name"]);
        if($check !== false) {
            echo "File is an image - " . $check["mime"] . ".";
            $uploadOk = 1;
        } 
        else {
            echo "File is not an image.";
            $uploadOk = 0;
        }
    }
}

// Allow certain file formats
function checkimagetype($imageFileType, &$uploadOk){
    if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
    && $imageFileType != "gif" && $imageFileType != "svg") {
    echo "Sorry, only JPG, JPEG, SVG, PNG & GIF files are allowed.";
    $uploadOk = 0;
    }
}

// Check if file already exists
function check_exists($file, &$uploadOk)  {  
    if (file_exists($file)) {
        echo "Sorry, file already exists.";
        $uploadOk = 0;
    }
}

// Check file size
function check_filesize($file,&$uploadOk){
    if ($_FILES[$file]["size"] > 500000) {
        echo "Sorry, your file is too large.";
        $uploadOk = 0;
    }
}

function upload_file($filename, $filename_new,&$uploadOk){
    // Check if $uploadOk is set to 0 by an error
    if ($uploadOk == 0) {
        $message = "Es gab einen unbekannten Fehler beim Hochladen deiner Dateien";
        echo "<script type='text/javascript'>alert('$message');</script>";
    // if everything is ok, try to upload file
    } else {
        if (move_uploaded_file($_FILES[$filename]["tmp_name"], $filename_new)) {
            $message = "The file ". htmlspecialchars( basename( $_FILES["logo"]["name"])). " has been uploaded.";
            echo "<script type='text/javascript'>alert('$message');</script>";
        } 
        /*
        else {
            $message = "Sorry, there was an error uploading your file.";
            echo "<script type='text/javascript'>alert('$message');</script>";
        }
        */
    }
}

$color = $_REQUEST["favcolor"];
$sql = "UPDATE system SET farbe = '".$color."';";
$exec = mysqli_query($link,$sql);


$url = $_SERVER['HTTP_HOST'].$_SERVER['PHP_SELF'];
$parsedUrl = parse_url($url);
$host = explode('.', $url);
$subdomain = $host[0];

$logo_dir = "../assets/".$subdomain."/logo/";
$bg_givefb_dir = "../assets/".$subdomain."/bg_givefb/";
$bg_loginfb_dir = "../assets/".$subdomain."/bg_loginfb/";

echo "<script type='text/javascript'>window.location.href='System.php';</script>";

if($_FILES["logo"]["name"]!=""){
    $logo_file = $logo_dir . basename($_FILES["logo"]["name"]);
    delete_files($logo_dir);
}
else{
	$file = scandir($logo_dir);
    $logo_file = $logo_dir .$file[2]; 
}

if($_FILES["bgimage"]["name"]!=""){
    $bggivefb_file = $bg_givefb_dir . basename($_FILES["bgimage"]["name"]);
    delete_files($bg_givefb_dir);
}
else{
	$file = scandir($bg_givefb_dir);
    $bggivefb_file = $bg_givefb_dir .$file[2]; 
}

if($_FILES["bgimage2"]["name"]!=""){
    $bgloginfb_file = $bg_loginfb_dir . basename($_FILES["bgimage2"]["name"]);
    delete_files($bg_loginfb_dir);
}
else{
    $file = scandir($bg_loginfb_dir);
    $bgloginfb_file = $bg_loginfb_dir .$file[2]; 
}

$logoFileType = strtolower(pathinfo($logo_file,PATHINFO_EXTENSION));
$bggivefbFileType = strtolower(pathinfo($bggivefb_file,PATHINFO_EXTENSION));
$bgloginfbFileType = strtolower(pathinfo($bgloginfb_file,PATHINFO_EXTENSION));

$logo_file_new = $logo_dir ."logo.".$logoFileType;
$bggivefb_file_new = $bg_givefb_dir ."bgimage.".$bggivefbFileType;
$bgloginfb_file_new = $bg_loginfb_dir ."bgimage2.".$bgloginfbFileType;

$uploadOk = 1;

checkfile("logo",$uploadOk);
checkfile("bgimage",$uploadOk);
checkfile("bgimage2",$uploadOk);

checkimagetype($logoFileType,$uploadOk);
checkimagetype($bggivefbFileType,$uploadOk);
checkimagetype($bgloginfbFileType,$uploadOk);

/*check_exists($logo_file,$uploadOk);
check_exists($bggivefb_file,$uploadOk);
check_exists($bgloginfb_file,$uploadOk);
*/

check_filesize("logo",$uploadOk);
check_filesize("bgimage",$uploadOk);
check_filesize("bgimage2",$uploadOk);

upload_file("logo", $logo_file_new, $uploadOk);
upload_file("bgimage", $bggivefb_file_new, $uploadOk);
upload_file("bgimage2", $bgloginfb_file_new, $uploadOk);

?>