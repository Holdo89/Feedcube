<?php

$sql = "SELECT * FROM users ORDER BY name"; 
$result = mysqli_query($link, $sql);
$passwort_reset_text="this.innerHTML = Passwort reset";

while($row = mysqli_fetch_assoc($result)) {
    if($row["username"]!="externes_feedback"){
    echo "<input id='User_".$row["id"]."' value='".$row["name"]."' onblur='user_abfrage_speichern(".$row["id"].")'></input>";
    echo "<input id='Username_".$row["id"]."' value='".$row["username"]."' onblur='user_abfrage_speichern(".$row["id"].")'></input>";
    echo "<input id='Email_".$row["id"]."' value='".$row["email"]."' onblur='user_abfrage_speichern(".$row["id"].")'></input>";   
    //echo "<label id='User_".$row["id"]."' value='".$row["created_at"]."'>".$row["created_at"]."</label>";

    if($row["Is_Creator"]!=1){
        if ($row["Is_Admin"]!=0){
            echo "<a type='button' class='center_button'  href='set_admin.php?Id=".$row["id"]."&Bool=0'><i class='fa fa-check'></i></a>";
        }
        else{
            echo "<a type='button' class='center_button'  href='set_admin.php?Id=".$row["id"]."&Bool=1'><i class='fa fa-times'></i></a>";
        }

        if ($row["Is_Trainer"]!=0){
            echo "<a type='button' class='center_button'  href='set_trainer.php?Id=".$row["id"]."&Bool=0'><i class='fa fa-check'></i></a>";
        }

        else{
            echo "<a type='button' class='center_button'  href='set_trainer.php?Id=".$row["id"]."&Bool=1'><i class='fa fa-times'></i></a>";
        }
        echo "<button type='button' class='center_button'  onclick='display(\"".$row["name"]."\");'><i class='fa fa-link'></i></button>";
        echo "<a type='button' class='center_button'  href='reset-password-admin.php?Id=".$row["id"]."&Name=".$row["name"]."'><i class='fa fa-lock'></i></a>";
        echo "<a type='button' class='center_button'  href='' onclick='user_abfrage_löschen(".$row["id"].")'><i class='fa fa-trash'></i></a>";        
    }

    else{
            echo "<a type='button' class='center_button'><i class='fa fa-check'></i></a>"; 
            if ($row["Is_Trainer"]!=0){
                echo "<a type='button' class='center_button'  href='set_trainer.php?Id=".$row["id"]."&Bool=0'><i class='fa fa-check'></i></a>";
            }
            else{    
                echo "<a type='button' class='center_button'  href='set_trainer.php?Id=".$row["id"]."&Bool=1'><i class='fa fa-times'></i></a>";
            }
            echo "<button type='button' class='center_button'  onclick='display(\"".$row["name"]."\");'><i class='fa fa-link'></i></button>";
            echo "<a type='button' class='center_button'  href='reset-password-admin.php?Id=".$row["id"]."&Name=".$row["name"]."'><i class='fa fa-lock'></i></a>";
            echo "<a type='button' class='center_button'></a>";
    }
}
}
?>