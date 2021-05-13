<script>
	function hide_commentary($x) {
		var x = document.getElementById($x);
		if (x.style.display === "none") {
			x.style.display = "block";
		} else {
			x.style.display = "none";
		}
	}
</script>
<?php
 require_once "session.php";
 require_once "config.php";
 

 $query = "SELECT * FROM interner_blog ORDER BY Timestamp DESC";

$exec = mysqli_query($link,$query);
while($row = mysqli_fetch_array($exec)){
		echo "
		<div class='posts'>
		<p>Beitrag vom ".$row['Timestamp']."</p>
		<p style= 'font-style: italic; font-size: 16px; margin-top: 20px; text-align:center; margin-left:auto;'>".$row['Beitrag']."</p>";
		
		$query_count = "SELECT COUNT(Kommentar) as Number FROM interner_blog_kommentare WHERE ID_von_Blogbeitrag=".$row['ID'];
		$exec_count = mysqli_query($link,$query_count);
		$row_count = mysqli_fetch_array($exec_count);

		echo"<div id='buttons' style='padding-bottom:13px; color:green;'>";
		if($row_count['Number']!=0){
		echo" <p style='float:left;'>".$row_count['Number']; 
		if($row_count['Number']>1)echo" Kommentare "; else echo" Kommentar ";
		echo"<button class='fa fa-angle-down' id='Kommentar_abgeben' style='font-size:16px; background-color:white; border:none;' onclick='hide_commentary(".$row['ID'].")'></button></p>";
		}

		echo"<button class='fa fa-commenting'id='Kommentar_abgeben' style='font-size:20px; color:green; background-color:white; border:none; float:right;margin-top:-5px;' onclick='display(".$row['ID'].")'></button>
		</div>
		<div id='".$row['ID']."' style='margin-top:20px;'>";

		$query_kommentar = "SELECT * FROM interner_blog_kommentare WHERE ID_von_Blogbeitrag = ".$row['ID']." ORDER BY Timestamp DESC";
		$exec_kommentar = mysqli_query($link,$query_kommentar);
		while($row_kommentar = mysqli_fetch_array($exec_kommentar)){
			echo "

			<div class='posts' style= 'background-color:white; color: green; border-width:1px; margin-bottom:0px; margin-top:2px; margin-left:-15px; margin-right:-15px;' >
			<p>Kommentar vom ".$row_kommentar['Timestamp']."</p>
			<p style= 'font-style: italic; font-size: 16px; margin-top: 20px; text-align:center; margin-left:auto;'>".$row_kommentar['Kommentar']."</p>
			</div>";
		}	
		echo"
		</div>
		</div>
		<script>
		hide_commentary(".$row['ID'].");
		</script>";
	}	

?>