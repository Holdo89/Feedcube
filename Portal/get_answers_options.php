<?php
    require_once "../config.php";

    $Frage=$_REQUEST["Frage"];
    if($Frage!="undefined"){
    $Frage_ID=substr($Frage,6);
    $sql="SELECT Typ FROM admin WHERE ID = ".$Frage_ID." = '1'";
    $result=mysqli_query($link,$sql);
    $row=mysqli_fetch_array($result);
    $Fragentyp = $row["Typ"];

    $Frage=$_REQUEST["Frage"];
    $Frage_ID=substr($Frage,6);
    if ($Fragentyp=="Multiplechoice")
        $sql="SELECT * FROM multiplechoice_answers WHERE Frage_".$Frage_ID." = '1' ORDER BY post_order_no ASC";
    else
        $sql="SELECT * FROM singlechoice_answers WHERE Frage_".$Frage_ID." = '1' ORDER BY post_order_no ASC"; 
    $result=mysqli_query($link,$sql);
    while($row=mysqli_fetch_array($result))
    {
        echo $row["Answers"].",";
    }
}
?>