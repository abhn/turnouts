<?php
	// [Almost] final code.
	
	$dbConnection = mysqli_connect('127.0.0.1', 'root', 'password', 'turnouts');
	$username = $_POST['username'];
	$password = $_POST['password'];
	$dbTest = $dbConnection->prepare("SELECT password FROM users WHERE username = ?");
	$dbTest->bind_param('s', $username);
	$dbTest->execute();
	$dbTest->bind_result($lolwa);
	$dbTest->fetch();
	$password = crypt($password, $lolwa);
	$dbTest->close();
	
	// code returns ["application_id"] for "successful login"
	// code returns 104 for "internal server error"
	// code returns 107 for "incorrect username or password"
	
	if($password == $lolwa) {
		if($db = $dbConnection->prepare("SELECT application_id FROM users WHERE username = ? AND password = ?")) {
			$db->bind_param('ss', $username, $password);				
			$db->execute();			
			$db->bind_result($name);		
			$db->fetch();			
			$name = json_encode($name);
			echo $name;
		} else {
			echo json_encode(array("104"));
		}
	} else {
		echo json_encode(array("107"));
	}
?>
