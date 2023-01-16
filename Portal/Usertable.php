<?php  
    require_once "../config.php";
    require_once "session.php";
    $sql = "SELECT * FROM users ORDER BY name"; 
    $result = mysqli_query($link, $sql);
    $passwort_reset_text="this.innerHTML = Passwort reset";
$StepEnding="";
if(isset($_REQUEST["Step"]))
{
    $Step = $_REQUEST["Step"];
    $StepEnding="&Step=".$Step;
};

 ?>  
      <head>   
           <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>  
           <script src="https://cdn.datatables.net/1.10.12/js/jquery.dataTables.min.js"></script>  
           <script src="https://cdn.datatables.net/1.10.12/js/dataTables.bootstrap.min.js"></script>            
           <link rel="stylesheet" href="https://cdn.datatables.net/1.10.12/css/dataTables.bootstrap.min.css?v=1" />  
      </head>  
      <body>  
           <br /><br />  
           <div class="container"> 
           <button id="element" style="width:250px; background-color:<?php $sql_farbe='SELECT farbe FROM system';
               $exec_farbe=mysqli_query($link, $sql_farbe);
               $result_farbe=mysqli_fetch_assoc($exec_farbe);
               echo $result_farbe['farbe']?>" onclick = "setVisibility()"><i class="fa fa-user-plus" style="font-size:19px" aria-hidden="true"></i> Benutzer hinzufügen</button> 
          <div class="table-responsive">  
                     <table id="employee_data" class="table table-striped table-bordered">  
                          <thead>  
                               <tr>  
                               <td  style="max-width:20px"></td>  
                              <td>Name</td>  
                                   <td>Username</td>  
                                   <td>Email</td>  
                                   <td>Rolle</td>
                                   <td style="min-width:130px"></td>
                               </tr>  
                          </thead>  
                          <?php  

function getCapitals(string $name): string
{
$capitals = '';
$words = preg_split('/[\s-]+/', $name);
$words = [array_shift($words), array_pop($words)];
foreach ($words as $word) {
     if (ctype_digit($word) && strlen($word) == 1) {
          $capitals .= $word;
     } else {
          $first = substr($word, 0, 1);
          $capitals .= ctype_digit($first) ? '' : $first;
     }
}
return strtoupper($capitals);
}

function getColor(string $name): string
{
// level 600, see: materialuicolors.co
$colors = [
     '#e53935', // red
     '#d81b60', // pink
     '#8e24aa', // purple
     '#5e35b1', // deep-purple
     '#3949ab', // indigo
     '#1e88e5', // blue
     '#039be5', // light-blue
     '#00acc1', // cyan
     '#00897b', // teal
     '#43a047', // green
     '#7cb342', // light-green
     '#c0ca33', // lime
     '#fdd835', // yellow
     '#ffb300', // amber
     '#fb8c00', // orange
     '#f4511e', // deep-orange
     '#6d4c41', // brown
     '#757575', // grey
     '#546e7a', // blue-grey
];
$unique = hexdec(substr(md5($name), -8));
return $colors[$unique % count($colors)];
}

                          while($row = mysqli_fetch_array($result))  
                          {  
                               echo "  
                               <tr>  
                               <td id=avatar_".$row["id"].">";
                               $sql_avatar = "SELECT Avatar from users WHERE id = ".$row["id"]." ORDER BY name";
                              $result_avatar = mysqli_query($link,$sql_avatar);
                              $row_avatar = mysqli_fetch_array($result_avatar);
                              $image_src = $row_avatar['Avatar'];

                              if ($image_src!="") {
                              echo "<img src='".$image_src."' class='avatar' alt='Avatar' style='background-color:grey; object-fit:cover'/>";
                              }
                              else{
                              $Color=getColor($row["name"]);
                              $Initials = getCapitals($row["name"]);	
                                   echo'<div class="initials-avatar large" style="background: '.$Color.';">'.$Initials.'</div>';
                              }                         
                               
                               echo"</td>  
                                    <td id=name_".$row["id"].">".$row["name"]."</td>  
                                    <td id=username_".$row["id"].">".$row["username"]."</td>  
                                    <td id=email_".$row["id"].">".$row["email"]."</td>  
                                    <td id=berechtigung_".$row["id"]." style='width:90px'>";
                                if($row["Is_Admin"]==1){
                                    echo'<label class="überschrift" style="text-align:center;margin-right:10px;"><i class="fas fa-user-cog" aria-hidden="true"></i><span class="tooltiptext">Administrator</span></label>';
                                }
                                if($row["Is_Trainer"]==1){
                                    echo'<label class="überschrift" style="text-align:center;"><i class="fas fa-chalkboard-teacher" aria-hidden="true"></i><span class="tooltiptext">Trainer</span></label>';
                                }
                                echo"</td>";
                                echo'<td><label class="überschrift" onclick = "setVisibility('.$row["id"].')" style="text-align:center;margin-right:10px;"><i class="fa fa-pencil" aria-hidden="true"></i><span class="tooltiptext">Bearbeiten</span></label><label class="überschrift" onclick="display(\''.$row["name"].'\')"><i class="fa fa-link"></i><span class="tooltiptext">Link erstellen</span></label><label class="überschrift" onclick="showPasswordModal('.$row["id"].')"><i class="fa fa-lock"></i><span class="tooltiptext">Passwort ändern</span></label><label class="überschrift" onclick="user_abfrage_löschen('.$row["id"].')" style="text-align:center;margin-right:10px;"><i class="fas fa-trash" aria-hidden="true"></i><span class="tooltiptext">Löschen</span></label></td>';
                                echo"</tr>";  
                          }  
                          ?>  
                     </table>  
                </div>  
           </div>  
      </body>  
 </html>  
 <script>  
 $(document).ready(function(){  
      $('#employee_data').DataTable();  
 });  
 </script>  