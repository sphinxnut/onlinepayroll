<?php
	include 'includes/session.php';

	if(isset($_POST['edit'])){
		$id = $_POST['id'];
		$title = $_POST['title'];
		$additonal_deduction_rate = $_POST['additonal_deduction_rate'];
		$rate = $_POST['rate'];

		$sql = "UPDATE position SET description = '$title', additonal_deduction_rate='$additonal_deduction_rate', rate = '$rate' WHERE id = '$id'";
		if($conn->query($sql)){
			$_SESSION['success'] = 'Position updated successfully';
		}
		else{
			$_SESSION['error'] = $conn->error;
		}
	}
	else{
		$_SESSION['error'] = 'Fill up edit form first';
	}

	header('location:position.php');

?>