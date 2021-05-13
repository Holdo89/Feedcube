
<?php
require_once "../config.php";
$Blogbeitrag = $_REQUEST['Blogbeitrag'];

// attempt insert query execution
$sql = "INSERT INTO interner_blog (Beitrag) VALUES ('".$Blogbeitrag."')";
mysqli_query($link, $sql);
 
// close connection
mysqli_close($link);
header("location: interner_blog.php");
?>
</html>