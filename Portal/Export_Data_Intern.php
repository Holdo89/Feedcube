<?php

 require_once "session.php";

 require_once "config.php";


 $datum_min=$_REQUEST["datum_min"];
 $datum_max=$_REQUEST["datum_max"];
 $Frage=$_REQUEST["Frage"];
 $Frage_ID=substr($Frage,6);
 

 $Id=[];
 $i=0;
 echo"Datum;";
 $sql="SELECT * FROM intern";
 $result=mysqli_query($link,$sql);
 while($rows=mysqli_fetch_array($result)){
    echo $rows["Fragen_intern"].";";
    $Id[$i]="Frage_".$rows["ID"];
    $i=$i+1;
 }
 echo"\n";
   
    $sql = "SELECT * FROM internes_feedback WHERE Datum <= '".$datum_min." 23:59:59' AND Datum >= '".$datum_max." 23:59:59' ORDER BY Datum DESC";
    $result=mysqli_query($link,$sql);

// close connection

while($rows=mysqli_fetch_array($result)){
    $u=0;
    echo $rows["Datum"].";";
    while($u<=$i-1){
        echo $rows[$Id[$u]].";";
        $u=$u+1;
    }
    echo"\n";
}
mysqli_close($link);
header("location.reload()");

?>