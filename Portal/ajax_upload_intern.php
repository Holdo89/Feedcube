<?php
require_once('config.php');

$post_order = isset($_POST["post_order_ids"]) ? $_POST["post_order_ids"] : [];

if(count($post_order)>0){
	for($order_no= 0; $order_no < count($post_order); $order_no++)
	{
	 $query = "UPDATE intern SET post_order_no = ".($order_no+1)." WHERE post_id = ".$post_order[$order_no]."";
	 mysqli_query($link, $query);
	}
	echo true; 
}else{
	echo false; 
}

?>