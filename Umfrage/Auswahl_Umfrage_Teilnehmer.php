<?php

    $sql = "SELECT * FROM umfragen GROUP BY Umfrage";
    $result = mysqli_query($link, $sql) ;
    while($row = mysqli_fetch_assoc($result)) {
    if($row['Umfrage']!=""){
		echo "<option value='".$row['ID']."'>".$row['Umfrage']."</option> ";}

}