<?php

// Start the session

require_once "../config.php";
require_once "session.php";

$neues_Fragenset = mysqli_real_escape_string($link, $_REQUEST["neues_Fragenset"]);

$sql = "INSERT INTO fragensets(Fragenset) VALUES ('$neues_Fragenset')";

if(mysqli_query($link, $sql)){

} else{

    echo "ERROR: Could not able to execute $sql. " . mysqli_error($link);

}

$sql = "SELECT ID FROM fragensets ORDER BY ID DESC LIMIT 1";
$result=mysqli_query($link, $sql);
$row = mysqli_fetch_assoc($result);

$sql= "ALTER TABLE admin ADD Fragenset_".$row['ID']." tinyint(1)";
$result=mysqli_query($link, $sql);

$Frage = $_POST["Fragenset_checkbox"];
 
$sql = "SELECT ID FROM fragensets ORDER BY Datum DESC LIMIT 1";
$result=mysqli_query($link, $sql);
$row = mysqli_fetch_assoc($result);

$ID = $row["ID"];

for ($i=0; $i<sizeof ($Frage);$i++) { 
    if(!strpos($Frage[$i],"_unchecked")){
    $query="UPDATE admin SET Fragenset_".$ID." = 1 WHERE Fragen_extern = '".$Frage[$i]. "'";  
    mysqli_query($link,$query); 
    } 
    else{
        $query="UPDATE admin SET Fragenset_".$ID." = 0 WHERE Fragen_extern = '".substr($Frage[$i],10,-10). "'";  
        mysqli_query($link,$query); 
    }
} 

mysqli_close($link);
$Step = $_REQUEST["Step"];
if($Step == 4)
{
    header("location: Fragenset.php?Step=4");
}

else{
    header("location: Fragenset.php");
}

?>