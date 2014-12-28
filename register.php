<?php	
	$username = $_POST['username'];
	$password = $_POST['password'];
	$email = $_POST['email'];
	$password = crypt($password);
	$application_id = substr(str_shuffle(MD5(microtime())), 0, 32);	
	$dbConnection = new mysqli("127.0.0.1", "root", "iamthedon", "turnouts");
	
	// Find duplicate username
	$dbTest = $dbConnection->prepare("SELECT username FROM users WHERE username = ?");
	$dbTest->bind_param('s', $username);
	$dbTest->execute();
	$dbTest->bind_result($user);
	$dbTest->fetch();
	$dbTest->close();
	
	// Find duplicate password
	$dbTest = $dbConnection->prepare("SELECT email FROM users WHERE email = ?");
	$dbTest->bind_param('s', $email);
	$dbTest->execute();
	$dbTest->bind_result($email_check);
	$dbTest->fetch();
	$dbTest->close();
	
	// Code returns 101 for "username already exists"
	// Code returns 102 for "email already exists"
	// Code returns 104 for "internal server error"
	// Code returns 202 for "user created successfully"
	
	if ($user) {
		echo json_encode("101");
	} elseif ($email_check) {
		echo json_encode("102");
	} else {
		if($db = $dbConnection->prepare("INSERT INTO users (username, password, email, application_id) VALUES (?, ?, ?, ?)")) {
			$db->bind_param('ssss', $username, $password, $email, $application_id);	
			$db->execute();	
			$db->close();	
			echo json_encode("202");
		} else {
			echo json_encode("104");
		}
	}
?>
