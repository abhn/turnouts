<?php
	// Enter 'pid' of event to get tags
	include 'includes.php';
	$pid = $_POST['pid'];
	$db = $dbConnection->prepare('SELECT tags FROM tags WHERE pid = ?');
	$db->bind_param('d', $pid);
	$db->execute();
	$db->bind_result($tags);
	$db->fetch();
	$db->close();
	$tags = explode(",", $tags);
	echo json_encode($tags);
?>
