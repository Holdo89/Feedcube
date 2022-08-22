<?php

    require_once "../config.php";
    require_once "session.php";
    //fetch table rows from mysql db
    $sql = "select * from users";
    $result = mysqli_query($link, $sql) or die("Error in Selecting " . mysqli_error($connection));

    //create an array
    $emparray = array();
    while($row =mysqli_fetch_assoc($result))
    {
        $emparray[] = $row;
    }

    $myfile = fopen("Userjson.json", "w") or die("Unable to open file!");
    $json = json_encode($emparray);
    fwrite($myfile, $json);
    fclose($myfile);

    //close the db connection
    mysqli_close($link);
?>