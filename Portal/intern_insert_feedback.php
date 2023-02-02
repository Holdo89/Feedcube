<?php
require_once "../config.php";
require_once "session.php";

$Antworten="";//In dieser Variable werden alle Antowrten zu den Fragen zusammengefasst
$i=1;
while($_REQUEST["intern_input_".$i]){
// Escape user inputs for security
if(gettype($_REQUEST["intern_input_".$i])=="array")
{  
    $Antworten=$Antworten.",'".mysqli_real_escape_string($link,  implode("|",$_REQUEST["intern_input_".$i]))."'"; 
}
else{
    $Antworten=$Antworten.",'".mysqli_real_escape_string($link, $_REQUEST["intern_input_".$i])."'"; 
}
    $i=$i+1;
}
//löscht das erste Komma
$Antworten = substr($Antworten, 1);
//alle Spaltennamen außer Datum und ID
$Spaltennamen="";
$sql_columns = "SELECT * FROM intern ORDER BY post_order_no ASC";
$result_columns = mysqli_query($link, $sql_columns);

while($rowcolumns = mysqli_fetch_assoc($result_columns)){
    $Spaltennamen=$Spaltennamen.mysqli_real_escape_string($link, 'Frage_'.$rowcolumns["ID"]).",";
};

$Spaltennamen = substr($Spaltennamen, 0, -1); //Löscht das letzte Zeichen bei Spaltennamen ','

// attempt insert query execution

$sql = "INSERT INTO umfragenfeedback (".$Spaltennamen.") VALUES (".$Antworten.")";
if(mysqli_query($link, $sql)){
    $sql = "UPDATE users SET umfragenfeedback_abgegeben = NOW() WHERE username = '".$_SESSION['username']."'";
    $result = mysqli_query($link, $sql);
    $rowcolumns = mysqli_fetch_assoc($result);
    header("location: Intern.php");
} 
else{
    echo "ERROR: Could not able to execute $sql. " . mysqli_error($link);
}
// close connection
mysqli_close($link);
?>

</html>