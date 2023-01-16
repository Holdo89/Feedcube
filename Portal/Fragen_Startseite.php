<?php
include "Statistics_Startseite.php";
function questions($Fragentyp, $link, $Trainer, $Leistung, $datum_min, $datum_max)
{
    $sql = "SELECT * FROM users ORDER BY name";
    $result = mysqli_query($link, $sql);
    $passwort_reset_text="this.innerHTML = Passwort reset";
    $StepEnding="";
    if (isset($_REQUEST["Step"])) {
        $Step = $_REQUEST["Step"];
        $StepEnding="&Step=".$Step;
    };

    echo'  
	<style>
	.table-responsive{
		font-size:14px;
		width:95%;
		margin-top:20px;
	}
	@media only screen and (max-width: 600px) {
		.table-responsive{
			font-size:11px;
			width:100%;
		}
	}
	</style>
      <head>   
           <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>  
           <script src="https://cdn.datatables.net/1.10.12/js/jquery.dataTables.min.js"></script>  
           <script src="https://cdn.datatables.net/1.10.12/js/dataTables.bootstrap.min.js"></script>            
           <link rel="stylesheet" href="https://cdn.datatables.net/1.10.12/css/dataTables.bootstrap.min.css?v=1" />  
      </head> 
	  <p style="margin:auto; font-size:16px; margin-top:20px;">'.$Fragentyp.'</p>
 
		  <div class="table-responsive">  
                     <table class="table table-striped table-bordered">  
                          <thead>
                               <tr>  
                                    <td>Frage</td> 
									';
									if($Fragentyp=="Bewertung"||$Fragentyp=="Schieberegler")
									{
									echo' 
                                    <td>Durchschnitt aller Bewertungen</td>
									<td>Trend der letzten 10 Bewertungen</td> 
									<td>Trend der letzten 100 Bewertungen</td> 
									';
									}
									else
									{
    								echo' 
                                    <td>am häufigsten gewählt</td>
									<td>am seltensten gewählt</td>
									';
									}
									echo'
                               </tr>  
                          </thead>';

    $sql = "SELECT ID, Typ, Fragen_extern FROM admin WHERE Fragen_extern !=''AND Typ = '".$Fragentyp."'";
    $i=0;
    $result = mysqli_query($link, $sql) ;
    $row = mysqli_fetch_assoc($result);
    $result = mysqli_query($link, $sql) ;
    while ($row = mysqli_fetch_assoc($result)) {
        echo"<tr>";
        if ($row['Typ']==$Fragentyp) {
            echo "<td style='text-align:left' id='Frage_".$row['ID']."'>".$row['Fragen_extern']."</td>";
            Statistik("Frage_".$row['ID'], $link, $Trainer, $Leistung, $datum_min, $datum_max);
        }
    }
    echo"</tr>";
    echo'
                     </table>  
                </div>  
      </body>  
 </html>  
';
}

?>

