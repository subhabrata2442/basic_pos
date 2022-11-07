<?php
session_start();
$pageURL =$_SERVER['REQUEST_URI'];//$_SERVER["SERVER_NAME"].$_SERVER["REQUEST_URI"]; 
$ssl=explode('/',$_SERVER['HTTP_HOST']);
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "pos_new";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
	//die("Connection failed: " . $conn->connect_error);
}

//date_default_timezone_set('America/Los_Angeles');

?>