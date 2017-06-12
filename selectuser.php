<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "chat";

if (isset($_GET['login']))
{
	$mLogin = $_GET['login'];
	
	$boolVar = false;

	// Create connection
	$conn = new mysqli($servername, $username, $password, $dbname);
	// Check connection
	if ($conn->connect_error) {
		die("Connection failed: " . $conn->connect_error);
	} 
	
	$sql = "SELECT * FROM users WHERE Login = '$mLogin'";
	$result = $conn->query($sql);
	
	while ($obj = $result->fetch_object()) {
		$json = json_encode($obj);
    }
	echo $json;
	$conn->close();
}

?>