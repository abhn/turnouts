<?php
	include 'includes.php';
	$post = $_POST['post'];
	$id = $_POST['id'];
	
	// Code returns 104 for "internal server error"
	// Code returns 206 for "successful update"
	
	if($db = $dbConnection->prepare("UPDATE posts SET post = ? WHERE id = ?")) {	
		$db->bind_param('sd', $post, $id);
		$db->execute();
		echo json_encode(array("successful update"=>"206"));
	} else {
		echo json_encode(array("internal server error"=>"104"));
	}
?>
