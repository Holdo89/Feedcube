<?php

require_once "../config.php";
require_once "session.php";
 $Umfrage=$_REQUEST["Umfrage"];
 $month_sum=$_REQUEST["month_sum"];
 $datum_min=$_REQUEST["datum_min"];
 $datum_max=$_REQUEST["datum_max"];
 $Month=$_REQUEST["Month"];

echo "Anzahl abgegebenes Feedback";

$sql="SELECT COUNT(ID) As Anzahl_Feedback FROM internes_feedback";
$result_feedback=mysqli_query($link,$sql);
$rows_feedback=mysqli_fetch_array($result_feedback);
if ($rows_feedback["Anzahl_Feedback"]!=0) {
	if($month_sum==0)
	{
		echo",0";
	}
    $i=0;
    $u=$Month+1;
    $feedback_year=substr($datum_max, 0, 4);

    while ($i<=$month_sum) {
        if ($u>12) {
            $u=1;
            if (substr($datum_min, 0, 4)!=substr($datum_max, 0, 4)) {
                $feedback_year=$feedback_year+1;
            }
        }

        $query = "SELECT COUNT('ID') AS Number FROM internes_feedback WHERE Datum <= '".$datum_min." 23:59:59' AND Datum >= '".$datum_max." 00:00:00'AND MONTH(Datum) = ".$u." AND YEAR(Datum) = ".$feedback_year." AND Umfrage LIKE '".$Umfrage."'";
        $exec = mysqli_query($link, $query);
        $row=mysqli_fetch_assoc($exec);
        echo ",".$row["Number"];
        $i=$i+1;
        $u=$u+1;
    }
		if($month_sum==0)
	{
		echo",0";
	}
}
else{
	echo"nomultiplechoice";
}

?>