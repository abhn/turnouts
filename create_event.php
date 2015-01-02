<?php
	include 'includes.php';
	$title = $_POST['title'];
	$post = $_POST['post'];
	
	// Code returns 104 for "internal server error"
	// Code returns 205 for "successful entry"
	
	if($db = $dbConnection->prepare("INSERT INTO posts (title, post) VALUES (?, ?)")) {	
		$db->bind_param('ss', $title, $post);
		$db->execute();
		echo json_encode(array("successful entry"=>"205"));
	} else {
		echo json_encode(array("internal server error"=>"104"));
	}
?>
