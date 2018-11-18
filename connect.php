<?php 
	$link = mysqli_connect ('localhost', 'root', '') or die ('Connection error!');
	mysqli_select_db ($link,'old_students') or die ('Select db error!');	
	mysqli_set_charset($link, 'UTF8'); 
?>