
<?php
require_once "config.php";
$Blogbeitrag = $_REQUEST['Blogbeitrag'];
$ID_von_Blogbeitrag = $_REQUEST['ID'];

// attempt insert query execution
$sql = "INSERT INTO interner_blog_kommentare (ID_von_Blogbeitrag,Kommentar) VALUES ('".$ID_von_Blogbeitrag."','".$Blogbeitrag."')";
mysqli_query($link, $sql);
 
// close connection
mysqli_close($link);
header("location: interner_blog.php");
?>
</html>