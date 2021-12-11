<div style="text-align:left;font-size:12pt; margin-top:8px;cursor: pointer" onclick="toggleFilterVisibility('FilterCharts', 'filtericon')"><i id="filtericon" class="fa fa-filter" style="font-size:15px;" aria-hidden="true"></i> Filter</div>
	<?php
	if($IsAdmin == 1)
	{
		echo'<div style="text-align:left;font-size:12pt; margin-top:8px;cursor: pointer;" onclick="export_data_admin()"><i id="filtericon" class="fa fa-download" style="font-size:15px;" aria-hidden="true"></i> Export</div>';
		echo'<div style="text-align:left;font-size:12pt; margin-top:8px;cursor: pointer;" onclick="delete_data()"><i id="filtericon" class="fa fa-trash" style="font-size:15px;" aria-hidden="true"></i> Löschen</div>';
	}
	else{
		echo'<div style="text-align:left;font-size:12pt; margin-top:8px;cursor: pointer;" onclick="export_data()"><i id="filtericon" class="fa fa-download" style="font-size:15px;" aria-hidden="true"></i> Export</div>';
	}
	?>	