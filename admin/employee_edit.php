<?php
	include 'includes/session.php';

	if(isset($_POST['edit'])){
		$empid = $_POST['id'];
		$firstname = $_POST['firstname'];
		$lastname = $_POST['lastname'];
		$address = $_POST['address'];
		$birthdate = $_POST['birthdate'];
		$contact = $_POST['contact'];
		$gender = $_POST['gender'];
		$position = $_POST['position'];
		$schedule = $_POST['schedule'];
		$SSS = $_POST['SSS'];
		$Pagibig = $_POST['Pagibig'];
		$Philhealth = $_POST['Philhealth'];

		$sql = "SELECT * FROM employees WHERE id = '$empid'";
		$query = $conn->query($sql);

		if($query->num_rows > 0){
			$row = $query->fetch_assoc();
			$schedule_id = $row['schedule_id'];

			// Check if new schedule_id is selected

			if($schedule != $schedule_id){
				$sql = "UPDATE employees SET schedule_id = '$schedule' ,schedule_updated_on = NOW() WHERE id = '$empid'";

				if($conn->query($sql)){
					$_SESSION['success'] = 'Employee updated successfully';
				}
				else{
					$_SESSION['error'] = $conn->error;
				}
			}

			// Proceeds here if schedule_id does not changed

			else{
				$sql = "UPDATE employees SET firstname = '$firstname', lastname = '$lastname', address = '$address', birthdate = '$birthdate', contact_info = '$contact', gender = '$gender', position_id = '$position', schedule_id = '$schedule', SSS = $SSS, Pagibig = $Pagibig, Philhealth = $Philhealth WHERE id = '$empid'";
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
		$_SESSION['error'] = 'Select employee to edit first';
	}

	header('location: employee.php');
?>