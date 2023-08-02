<?php
$conn = new mysqli('localhost', 'root', 'arzelzolina10', 'payrolldb');

if ($conn->connect_error) {
	die("Connection failed: " . $conn->connect_error);
}
