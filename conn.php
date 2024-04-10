<?php
$conn = new mysqli('localhost', 'root', '', 'payrolldb');

if ($conn->connect_error) {
	die("Connection failed: " . $conn->connect_error);
}
