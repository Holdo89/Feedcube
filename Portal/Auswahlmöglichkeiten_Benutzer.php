<?php
$sql = "SELECT Is_Admin FROM users WHERE username = '".$_SESSION["username"]."'";
$result = mysqli_query($link, $sql);
$row = mysqli_fetch_assoc($result);
$Message="";
$IsAdmin = $row["Is_Admin"];

if($row["Is_Admin"]==1){
        $Message ="<div id='Auswahl_Trainer' name='Auswahl_Trainer' class='Auswahlmöglichkeit'> Es wurde noch kein Trainer <a href='register.php'>hinzugefügt</a></div>";
    }
else{
        $Message ="<div id='Auswahl_Trainer' name='Auswahl_Trainer' class='Auswahlmöglichkeit'> Es wurde noch kein Trainer hinzugefügt, wende dich an einen Feedcube Administrator</div>";
    }

$i=0;
$sql = "SELECT name, Is_Trainer FROM users";
$result = mysqli_query($link, $sql) ;
while($row = mysqli_fetch_assoc($result)) {
    $i=$i+1;
}
if ($i<1)
{
    echo $Message;
}
else
{
    echo' <select id="Auswahl_Trainer" name="Auswahl_Trainer[]" multiple="multiple">';
    $sql = "SELECT name, username, Is_Trainer FROM users ORDER BY name ASC" ;

    $result = mysqli_query($link, $sql) ;

    while($row = mysqli_fetch_assoc($result)) {
        if($IsAdmin==1){
            echo "<option id='".$row['username']."' value='".$row['username']."'>".$row['name']."</option>";
        }
        else{
            if($_SESSION["username"]==$row['username'])
            {
                echo "<option id='".$row['username']."' value='".$row['username']."'>".$row['name']."</option>";
            }
        }

    }
    echo'</select>';
}	

?>