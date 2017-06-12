<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "chat";

if (isset($_GET['login']) && isset($_GET['password']))
{
	$mLogin = $_GET['login'];
	$mPassword = $_GET['password'];
	$mName = $_GET['name'];
	$mSurname = $_GET['surname'];
	$mPhone = $_GET['phone'];
	$mEmail = $_GET['email'];
	
	$boolVar = false;

	// Create connection
	$conn = new mysqli($servername, $username, $password, $dbname);
	// Check connection
	if ($conn->connect_error) {
		die("Connection failed: " . $conn->connect_error);
	} 
	
	if(!$boolVar) {
		$sqlinsert = "UPDATE users SET Name='$mName', Surname='$mSurname', PhoneNumber='$mPhone', Email='$mEmail', Password='$mPassword' WHERE Login='$mLogin'"; 
		//$parameters = array($mLogin, $mPassword);
		if($conn->query($sqlinsert) == TRUE) {
		    echo "SUCCESS";
		} else {
			echo "Error: " . $sql . "<br>" . $conn->error;
		}
	}
	$conn->close();
}

?>