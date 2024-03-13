<?php
session_start();
include 'includes/conn.php';

if (isset($_POST['login'])) {
	$username = $_POST['username'];
	$password = $_POST['password'];

	$sql = "SELECT * FROM admin WHERE username = '$username' AND password = '$password'";
	$query = $conn->query($sql);

	if ($query->num_rows > 0) {
		$row = $query->fetch_assoc();
		$_SESSION['admin'] = $row['id'];
	} else {
		$_SESSION['error'] = 'Invalid username or password';
	}
} else {
	$_SESSION['error'] = 'Input admin credentials first';
}

header('location: index.php');
