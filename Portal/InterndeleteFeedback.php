<?php

require_once "../config.php";
require_once "session.php";

$Id=$_REQUEST["Id"];


$sql = "DELETE FROM umfragenfeedback WHERE ID = '".$Id."'";

mysqli_query($link, $sql);



// close connection

mysqli_close($link);

header("location: forms_admin.php");

?>