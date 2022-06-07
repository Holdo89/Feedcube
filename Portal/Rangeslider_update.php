<?php

 require_once "../config.php";
 require_once "session.php";

 $ID=$_REQUEST["ID"];
 $max=$_REQUEST["max"];
 $min=$_REQUEST["min"];

//effr

$query = "UPDATE rangeslider_answers SET range_min = '".$min."' WHERE Frage_ID = '".$ID."'";

$exec = mysqli_query($link,$query);

$query = "UPDATE rangeslider_answers SET range_max = '".$max."' WHERE Frage_ID = '".$ID."'";

$exec = mysqli_query($link,$query);

$query = "UPDATE rangeslider_answers SET columns = '5' WHERE Frage_ID = '".$ID."'";

$exec = mysqli_query($link,$query);


?>