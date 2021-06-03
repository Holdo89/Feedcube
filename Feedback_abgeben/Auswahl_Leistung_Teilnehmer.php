<?php

    $sql = "SELECT * FROM leistungen GROUP BY Leistung";
    $result = mysqli_query($link, $sql) ;
    while($row = mysqli_fetch_assoc($result)) {
    if($row['Leistung']!=""){
		echo "<option value='".$row['ID']."'>".$row['Leistung']."</option> ";}

}