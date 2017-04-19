<?php

	include 'database.php';
	
	$pdo = Database::connect();
	if($_GET['id']) 
		$sql = "SELECT first_name, last_name FROM Test_Takers WHERE test_taker_id=" . $_GET['id']; 
	else
		$sql = "SELECT first_name, last_name FROM Test_Takers WHERE teacher = 0";
	$students = array();
	foreach ($pdo->query($sql) as $row) {
	
		array_push($students, $row['first_name'] . ", ". $row['last_name']);
		
	}
	Database::disconnect();
	echo '{"Students":' . json_encode($students) . '}';
?>