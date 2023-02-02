<?php
 require_once "../config.php";
 require_once "session.php";

 $datum_min=$_REQUEST["datum_min"];
 $datum_max=$_REQUEST["datum_max"];
 $Leistung=$_REQUEST["Leistung"];
 $Frage=$_REQUEST["Frage"];
 $Frage_ID=substr($Frage,6);
 $Trainer=$_REQUEST["Trainer"];

 $Id=[];
 $i=0;
 echo"Datum;Trainer;Leistung;";
 $sql="SELECT * FROM fragen ORDER BY post_order_no ASC";
 $result=mysqli_query($link,$sql);
 while($rows=mysqli_fetch_array($result)){
    echo '"'.$rows["Fragenbeschreibung"].'";';
    $Id[$i]="Frage_".$rows["ID"];
    $i=$i+1;
 }
 echo"\n";
   
    $sql = "SELECT * FROM kursfeedback WHERE Datum <= '".$datum_min." 23:59:59' AND Datum >= '".$datum_max." 00:00:00'AND Leistung LIKE '".$Leistung."' AND Username LIKE '".$Trainer."' ORDER BY Datum DESC";
    $result=mysqli_query($link,$sql);

while($rows=mysqli_fetch_array($result)){
    $sql_test = "SELECT Leistung from leistungen WHERE ID = ".$rows['Leistung'];
    $exec_test = mysqli_query($link,$sql_test);
    $leistung_titel = mysqli_fetch_array($exec_test); 
   
    $u=0;
    echo $rows["Datum"].";".$rows["Trainer"].";".$leistung_titel["Leistung"].";";
    while($u<=$i-1){
        echo '"'.$rows[$Id[$u]].'";';
        $u=$u+1;
    }
    echo"\n";
}
// close connection
mysqli_close($link);

?>