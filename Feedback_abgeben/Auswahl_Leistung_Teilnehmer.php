<?php

    $sql = "SELECT Leistung FROM leistungen GROUP BY Leistung";
    $result = mysqli_query($link, $sql) ;
    while($row = mysqli_fetch_assoc($result)) {
    if($row['Leistung']!=""){
		echo "<option value='".$row['Leistung']."'>".$row['Leistung']."</option> ";}

}