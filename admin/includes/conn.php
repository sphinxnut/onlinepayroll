<?php
<<<<<<< HEAD
$conn = new mysqli('localhost', 'root', 'arzelzolina10', 'payrolldb');
=======
	$conn = new mysqli('localhost', 'root', '', 'payrolldb');
>>>>>>> 9fba41005b837c2dae454214f225d7c95f93ee13

if ($conn->connect_error) {
	die("Connection failed: " . $conn->connect_error);
}
