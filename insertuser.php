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

	$sql = "SELECT idUsers, Login FROM users";
	$result = $conn->query($sql);

	if ($result->num_rows > 0) {
		// output data of each row
		while($row = $result->fetch_assoc()) {
			//echo "id: " . $row["idUsers"]. " - Login: " . $row["Login"]. " ". "<br>";
			if( $mLogin == $row["Login"] ) {
				echo "User with that login already exist";
				$boolVar = true;
			}
		}
	} else {
		echo "0 results";
	}
	if(!$boolVar) {
		$sqlinsert = "INSERT INTO users (Name, Surname, Login, PhoneNumber, Email, Password) 
			VALUES ('$mName', '$mSurname', '$mLogin', '$mPhone', '$mEmail', '$mPassword')";
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