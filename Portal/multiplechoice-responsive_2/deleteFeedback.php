<?php

require_once "../session.php";

require_once "../config.php";

$Id=$_REQUEST["Id"];


$sql = "DELETE FROM externes_feedback WHERE ID = '".$Id."'";

mysqli_query($link, $sql);



// close connection

mysqli_close($link);

header("location: tester_admin.php");

?>