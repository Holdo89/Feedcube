<?php

$sql = "SELECT * FROM users ORDER BY name"; 
$result = mysqli_query($link, $sql);
$passwort_reset_text="this.innerHTML = Passwort reset";
$StepEnding="";
if(isset($_REQUEST["Step"]))
{
    $Step = $_REQUEST["Step"];
    $StepEnding="&Step=".$Step;
};

while($row = mysqli_fetch_assoc($result)) {
    echo "<input id='User_".$row["id"]."' value='".$row["name"]."' onblur='user_abfrage_speichern(".$row["id"].")'></input>";
    echo "<input id='Username_".$row["id"]."' value='".$row["username"]."' onblur='user_abfrage_speichern(".$row["id"].")'></input>";
    echo "<input id='Email_".$row["id"]."' value='".$row["email"]."' onblur='user_abfrage_speichern(".$row["id"].")'></input>";   
    //echo "<label id='User_".$row["id"]."' value='".$row["created_at"]."'>".$row["created_at"]."</label>";

    if($row["Is_Creator"]!=1){
        if ($row["Is_Admin"]!=0){
            echo "<a type='button' class='center_button' style='background-color:green' href='set_admin.php?Id=".$row["id"]."&Bool=0".$StepEnding."'><i class='fa fa-check' style='color:white'></i></a>";
        }
        else{
            echo "<a type='button' class='center_button' style='background-color:red' href='set_admin.php?Id=".$row["id"]."&Bool=1".$StepEnding."'><i class='fa fa-times' style='color:white'></i></a>";
        }

        if ($row["Is_Trainer"]!=0){
            echo "<a type='button' class='center_button' style='background-color:green' href='set_trainer.php?Id=".$row["id"]."&Bool=0&Url=Usermanagement".$StepEnding."'><i class='fa fa-check' style='color:white'></i></a>";
        }

        else{
            echo "<a type='button' class='center_button' style='background-color:red' href='set_trainer.php?Id=".$row["id"]."&Bool=1&Url=Usermanagement".$StepEnding."'><i class='fa fa-times' style='color:white'></i></a>";
        }
        echo "<button type='button' class='center_button' style='padding-top:0em;'  onclick='display(\"".$row["name"]."\");'><i class='fa fa-link'></i><span class='tooltiptext'>Link erstellen</span></button>";
        echo "<a type='button' class='center_button'  href='reset-password-admin.php?Id=".$row["id"]."&Name=".$row["name"]."'><i class='fa fa-lock'></i><span class='tooltiptext'>neues Passwort</span></a>";
        echo "<a type='button' class='center_button'  href='' onclick='user_abfrage_löschen(".$row["id"].")'><i class='fa fa-trash'></i><span class='tooltiptext'>Löschen</span></a>";        
    }

    else{
            echo "<a type='button' class='center_button' style='background-color:green'><i class='fa fa-check' style='color:white'></i></a>"; 
            if ($row["Is_Trainer"]!=0){
                echo "<a type='button' class='center_button' style='background-color:green' href='set_trainer.php?Id=".$row["id"]."&Bool=0&Url=Usermanagement'><i class='fa fa-check' style='color:white'></i></a>";
            }
            else{    
                echo "<a type='button' class='center_button' style='background-color:red' href='set_trainer.php?Id=".$row["id"]."&Bool=1&Url=Usermanagement'><i class='fa fa-times' style='color:white'></i></a>";
            }
            echo "<button type='button' class='center_button' style='padding-top:0em;' onclick='display(\"".$row["name"]."\");'><i class='fa fa-link'></i><span class='tooltiptext'>Link erstellen</span></button>";
            echo "<a type='button' class='center_button'  href='reset-password-admin.php?Id=".$row["id"]."&Name=".$row["name"].$StepEnding."'><i class='fa fa-lock'></i><span class='tooltiptext'>neues Passwort</span></a>";
            echo "<a type='button' class='center_button'></a>";
    }
}
?>