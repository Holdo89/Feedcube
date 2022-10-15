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
           <link rel="stylesheet" href="https://cdn.datatables.net/1.10.12/css/dataTables.bootstrap.min.css" />  
      </head>  
      <body>  
           <br /><br />  
           <div class="container">  
                <div class="table-responsive">  
                     <table id="employee_data" class="table table-striped table-bordered">  
                          <thead>  
                               <tr>  
                                    <td>Name</td>  
                                    <td>Username</td>  
                                    <td>Email</td>  
                                    <td>Rolle</td>
                                    <td style="min-width:130px"></td>
                               </tr>  
                          </thead>  
                          <?php  
                          while($row = mysqli_fetch_array($result))  
                          {  
                               echo "  
                               <tr>  
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
                                echo'<td><label class="überschrift" onclick = "setVisibility('.$row["id"].')" style="text-align:center;margin-right:10px;"><i class="fa fa-pencil" aria-hidden="true"></i><span class="tooltiptext">Bearbeiten</span></label><label class="überschrift" onclick="display(\''.$row["name"].'\')"><i class="fa fa-link"></i><span class="tooltiptext">Link erstellen</span></label><label class="überschrift" onclick="window.location.href=\'reset-password-admin.php?Id='.$row["id"].'&Name='.$row["name"].'\';"><i class="fa fa-lock"></i><span class="tooltiptext">Passwort ändern</span></label><label class="überschrift" onclick="user_abfrage_löschen('.$row["id"].')" style="text-align:center;margin-right:10px;"><i class="fas fa-trash" aria-hidden="true"></i><span class="tooltiptext">Löschen</span></label></td>';
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