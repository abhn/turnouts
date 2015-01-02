<?php
	include 'includes.php';
	$title = $_POST['title'];
	$id = $_POST['id'];
	
	// Code returns 104 for "internal server error"
	// Code returns 206 for "successful update"
	
	if($db = $dbConnection->prepare("UPDATE posts SET title = ? WHERE id = ?")) {	
		$db->bind_param('sd', $title, $id);
		$db->execute();
		echo json_encode(array("successful update"=>"206"));
	} else {
		echo json_encode(array("internal server error"=>"104"));
	}
?>
