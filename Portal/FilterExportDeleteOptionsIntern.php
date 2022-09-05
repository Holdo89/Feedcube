<div style="text-align:left;font-size:12pt; margin-top:8px;cursor: pointer" onclick="toggleFilterVisibility('FilterCharts', 'filtericon')"><i id="filtericon" class="fa fa-filter" style="font-size:15px;" aria-hidden="true"></i> Filter</div>
<div id ="UmfrageMöglichkeiten" class="dropdown">
		<button style="color:black; padding-top:8px; background:none; border:none"><i class="fas fa-download" aria-hidden="true"></i> Export </button>
		<div class="dropdown-content" style="text-align:left; font-size:13px; border:none; outline:none; color:black">
		<div style="text-align:left;font-size:12pt; margin-top:8px;cursor: pointer;" onclick="createPdf()"><i id="filtericon" class="fa fa-file-pdf" style="font-size:15px;" aria-hidden="true"></i> PDF</div>
		<div style="text-align:left;font-size:12pt; margin-top:8px;cursor: pointer;" onclick="intern_export_data()"><i id="filtericon" class="fa fa-file-csv" style="font-size:15px;" aria-hidden="true"></i> CSV</div>
		</div>
		</div>
<?php
	if($IsAdmin == 1)
	{
		echo'<div style="text-align:left;font-size:12pt; margin-top:8px;cursor: pointer;" onclick="intern_delete_data()"><i id="filtericon" class="fa fa-trash" style="font-size:15px;" aria-hidden="true"></i> Löschen</div>';
	}
	?>