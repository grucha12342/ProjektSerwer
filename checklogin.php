<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "chat";

if (isset($_GET['login']) && isset($_GET['password']))
{
	$mLogin = $_GET['login'];
	$mPassword = $_GET['password'];
	//echo "Fajnie" . $mLogin;

	// Create connection
	$conn = new mysqli($servername, $username, $password, $dbname);
	// Check connection
	if ($conn->connect_error) {
		die("Connection failed: " . $conn->connect_error);
	} 

	$sql = "SELECT idUsers, Login, Password FROM users";
	$result = $conn->query($sql);

	if ($result->num_rows > 0) {
		// output data of each row
		while($row = $result->fetch_assoc()) {
			//echo "id: " . $row["idUsers"]. " - Name: " . $row["Login"]. " " . $row["Password"]. "<br>";
			if($mLogin == $row["Login"] && $mPassword == $row["Password"])
				echo "SUCCESS";
		}
	} else {
		echo "FAIL";
	}
	
	$conn->close();
}

?>