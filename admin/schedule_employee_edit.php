<?php
	include 'includes/session.php';

	if(isset($_POST['edit'])){
		$empid = $_POST['id'];
		$newsched_id = $_POST['schedule'];
		

		$sql = "SELECT * FROM employees WHERE id = '$empid'";
		$query = $conn->query($sql);

		if($query->num_rows > 0){
			$row = $query->fetch_assoc();
			$oldsched_id = $row['schedule_id'];

			if($newsched_id != $oldsched_id){
				$sql = "UPDATE employees SET schedule_id = '$newsched_id' ,schedule_updated_on = NOW() WHERE id = '$empid'";

				if($conn->query($sql)){
					$_SESSION['success'] = 'Employee updated successfully';
				}
				else{
					$_SESSION['error'] = $conn->error;
				}
			}
		}

	}
	else{
		$_SESSION['error'] = 'Select schedule to edit first';
	}

	header('location: schedule_employee.php');
?>