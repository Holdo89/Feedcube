<?php  
    require_once "../config.php";
    require_once "session.php";
    $sql = "SELECT * FROM leistungen ORDER BY Leistung"; 
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
                                    <td>Leistung</td>   
                                    <td></td>
                               </tr>  
                          </thead>  
                          <?php  
                          while($row = mysqli_fetch_array($result))  
                          {  
                               echo "  
                               <tr>  
                                    <td id=Leistung_".$row["ID"].">".$row["Leistung"]."</td>";
                                echo'<td style="width:100px"><label class="überschrift" onclick = "display('.$row["ID"].', \'Leistung\')" style="text-align:center;margin-right:10px;"><i class="fa fa-pencil" aria-hidden="true"></i><span class="tooltiptext">Bearbeiten</span></label><label class="überschrift" onclick="createLink(\''.$row["ID"].'\',\''.$row["Leistung"].'\')"><i class="fa fa-link"></i><span class="tooltiptext">Link erstellen</span></label><label class="überschrift" onclick="user_abfrage_löschen('.$row["ID"].')" style="text-align:center;margin-right:10px;"><i class="fas fa-trash" aria-hidden="true"></i><span class="tooltiptext">Löschen</span></label></td>';
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