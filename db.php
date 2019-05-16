<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "sam";

// Create connection
$con = new mysqli($servername, $username, $password,$dbname);

// Check connection
if ($con->connect_error) {
    die("Connection failed: " . $con->connect_error);
}else{ 
	echo "Connected successfully";
}
//$con->close();
?>
