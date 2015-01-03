<?php
	// Enter the 'pid' and 'tags' into tags table
	include 'includes.php';
	$tags = $_POST['tags'];
	$pid = $_POST['id'];
	$db = $dbConnection->prepare('INSERT INTO tags (pid, tags) VALUES (?, ?)');
	$db->bind_param('ds', $pid, $tags);
	$db->execute();
	$db->close();
?>
