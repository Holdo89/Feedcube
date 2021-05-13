<?php

 require_once "session.php";

 require_once "config.php";


 $datum_min=$_REQUEST["datum_min"];
 $datum_max=$_REQUEST["datum_max"];
 $Leistung=$_REQUEST["Leistung"];
 $Frage=$_REQUEST["Frage"];
 $Frage_ID=substr($Frage,6);
 $Trainer=$_SESSION["username"];

 $Id=[];
 $i=0;
 echo"Datum;Trainer;Leistung;";
 $sql="SELECT * FROM admin ORDER BY post_order_no ASC";
 $result=mysqli_query($link,$sql);
 while($rows=mysqli_fetch_array($result)){
    echo $rows["Fragen_extern"].";";
    $Id[$i]="Frage_".$rows["ID"];
    $i=$i+1;
 }
 echo"\n";
   
    $sql = "SELECT * FROM externes_feedback WHERE Datum <= '".$datum_min." 23:59:59' AND Datum >= '".$datum_max." 23:59:59'AND Leistung LIKE '".$Leistung."' AND Username = '".$Trainer."' ORDER BY Datum DESC";
    $result=mysqli_query($link,$sql);

// close connection

while($rows=mysqli_fetch_array($result)){
    $u=0;
    echo $rows["Datum"].";".$rows["Trainer"].";".$rows["Leistung"].";";
    while($u<=$i-1){
        echo $rows[$Id[$u]].";";
        $u=$u+1;
    }
    echo"\n";
}
mysqli_close($link);
header("location.reload()");

?>