<?php
$hostname = 'localhost';
$username = 'root';
$password = '';
$database = 'chotik';

$conn =  new mysqli($hostname, $username, $password, $database);
if ($conn->connect_error){
	die("Connection Failed : ".$conn->connect_error);
}
$conn->set_charset("utf8");
?>
