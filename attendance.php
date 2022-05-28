<?php

	
$output = array('error'=>false);
	// Checking for uploading image
	if($_POST['image'] && $output['error'] == false){
		if(isset($_POST['employee'])){
			
	
			include 'conn.php';
			include 'timezone.php';
	
			$employee = $_POST['employee'];
			$status = $_POST['status'];
	
			$sql = "SELECT * FROM employees WHERE employee_id = '$employee'";
			$query = $conn->query($sql);
	
	
			if($query->num_rows > 0){
				$row = $query->fetch_assoc();
				$id = $row['id'];
	
				$date_now = date('Y-m-d');
	

				switch ($status) {
					case 'in':
							$sql = "SELECT * FROM attendance WHERE employee_id = '$id' AND date = '$date_now' AND time_in IS NOT NULL";
							$query = $conn->query($sql);
							if($query->num_rows > 0){
								$output['error'] = true;
								$output['message'] = 'You have timed in for today';
							}
							else{
								//updates
								$sched = $row['schedule_id'];
								$lognow = date('H:i:s');
								$sql = "SELECT * FROM schedules WHERE id = '$sched'";
								$squery = $conn->query($sql);
								$srow = $squery->fetch_assoc();
								// $logstatus = ($lognow > $srow['time_in']) ? 0 : 1;
								//
								

								$sql = "INSERT INTO attendance (employee_id, date, time_in, status) VALUES ('$id', '$date_now', NOW(), '1')";
								if($conn->query($sql)){
									// Upload image if database successfully updated
									include 'saveUploadImg.php';

									$output['message'] = 'Time in: '.$row['firstname'].' '.$row['lastname'];
								}
								else{
									$output['error'] = true;
									$output['message'] = $conn->error;
								}
							}
						break;
					case 'brout':
							$sql = "SELECT *, attendance.id AS uid FROM attendance LEFT JOIN employees ON employees.id=attendance.employee_id WHERE attendance.employee_id = '$id' AND date = '$date_now'";
							$query = $conn->query($sql);
							if($query->num_rows < 1){
								$output['error'] = true;
								$output['message'] = 'Cannot Break Out. No time in.';
							}
							else{
								$row = $query->fetch_assoc();
								if($row['break_out'] != '00:00:00'){
									$output['error'] = true;
									$output['message'] = 'You have broken out for today';
								}
								else{
									
									$sql = "UPDATE attendance SET break_out = NOW(), status='0' WHERE id = '".$row['uid']."'";
									$output['message'] = 'Break out: '.$row['firstname'].' '.$row['lastname'];
									if($conn->query($sql)){

										// Upload image if database successfully updated
										include 'saveUploadImg.php';

										$output['message'] = 'Break Out: '.$row['firstname'].' '.$row['lastname'];
										// $output['message'] = 'Break out: '.$row['firstname'].' '.$row['lastname'];
			
										// $sql = "SELECT * FROM attendance WHERE id = '".$row['uid']."'";
										// $query = $conn->query($sql);
										// $urow = $query->fetch_assoc();
			
										// $time_in = $urow['time_in'];
										// $break_out = $urow['break_out'];
										// $break_in = $urow['break_in'];
										// $time_out = $urow['time_out'];
			
										// $sql = "SELECT * FROM employees LEFT JOIN schedules ON schedules.id=employees.schedule_id WHERE employees.id = '$id'";
										// $query = $conn->query($sql);
										// $srow = $query->fetch_assoc();
			
										// if($srow['time_in'] > $urow['time_in']){
										// 	$time_in = $srow['time_in'];
										// }
			
										// if($srow['break_out'] > $urow['break_out']){
										// 	$break_out = $srow['break_out'];
										// }
			
										// if($srow['break_in'] > $urow['break_in']){
										// 	$break_in = $srow['break_in'];
										// }
			
										// if($srow['time_out'] < $urow['time_in']){
										// 	$time_out = $srow['time_out'];
										// }
			
										// $time_in = new DateTime($time_in);
										// $break_out = new DateTime($break_out);
										// $break_in = new DateTime($break_in);
										// $time_out = new DateTime($time_out);
										// $interval = $time_in->diff($time_out);
										// $hrs = $interval->format('%h');
										// $mins = $interval->format('%i');
										// $mins = $mins/60;
										// $int = $hrs + $mins;
										// if($int > 4){
										// 	$int = $int - 1;
										// }
			
										// $sql = "UPDATE attendance SET num_hr = '$int' WHERE id = '".$row['uid']."'";
										// $conn->query($sql);

									
									}
									else{
										$output['error'] = true;
										$output['message'] = $conn->error;
									}
								}
								
							}
					  break;

					case 'brin':
							$sql = "SELECT *, attendance.id AS uid FROM attendance LEFT JOIN employees ON employees.id=attendance.employee_id WHERE attendance.employee_id = '$id' AND date = '$date_now' AND break_out != '00:00:00'";
							$query = $conn->query($sql);
							if($query->num_rows < 1){
								$output['error'] = true;
								$output['message'] = 'Cannot Break In. No Break Out.';
							}
							else{
								$row = $query->fetch_assoc();
								if($row['break_in'] != '00:00:00'){
									$output['error'] = true;
									$output['message'] = 'You have broken in for today';
								}
								else{
									
									$sql = "UPDATE attendance SET break_in = NOW(), status='1' WHERE id = '".$row['uid']."'";
									if($conn->query($sql)){
										
										// Upload image if database successfully updated
										include 'saveUploadImg.php';

										$output['message'] = 'Break in: '.$row['firstname'].' '.$row['lastname'];
			
										// $sql = "SELECT * FROM attendance WHERE id = '".$row['uid']."'";
										// $query = $conn->query($sql);
										// $urow = $query->fetch_assoc();
			
										// $time_in = $urow['time_in'];
										// $break_out = $urow['break_out'];
										// $break_in = $urow['break_in'];
										// $time_out = $urow['time_out'];
			
										// $sql = "SELECT * FROM employees LEFT JOIN schedules ON schedules.id=employees.schedule_id WHERE employees.id = '$id'";
										// $query = $conn->query($sql);
										// $srow = $query->fetch_assoc();
			
									
			
										// if($srow['time_in'] > $urow['time_in']){
										// 	$time_in = $srow['time_in'];
										// }
			
										// if($srow['break_out'] > $urow['break_out']){
										// 	$break_out = $srow['break_out'];
										// }
			
										// if($srow['break_in'] > $urow['break_in']){
										// 	$break_in = $srow['break_in'];
										// }
			
										// if($srow['time_out'] < $urow['time_in']){
										// 	$time_out = $srow['time_out'];
										// }
			
										// $time_in = new DateTime($time_in);
										// $break_out = new DateTime($break_out);
										// $break_in = new DateTime($break_in);
										// $time_out = new DateTime($time_out);
										// $interval = $time_in->diff($time_out);
										// $hrs = $interval->format('%h');
										// $mins = $interval->format('%i');
										// $mins = $mins/60;
										// $int = $hrs + $mins;
										// if($int > 4){
										// 	$int = $int - 1;
										// }
			
										// $sql = "UPDATE attendance SET num_hr = '$int' WHERE id = '".$row['uid']."'";
										// $conn->query($sql);
										// $output['message'] = 'Break In: '.$row['firstname'].' '.$row['lastname'];
									}
									else{
										$output['error'] = true;
										$output['message'] = $conn->error;
									}
								}
								
							}
					  break;
					 
					default:
						$sql = "SELECT *, attendance.id AS uid FROM attendance LEFT JOIN employees ON employees.id=attendance.employee_id WHERE attendance.employee_id = '$id' AND date = '$date_now' AND break_in != '00:00:00'";
						$query = $conn->query($sql);
						if($query->num_rows < 1){
							$output['error'] = true;
							$output['message'] = 'Cannot Timeout. No break in.';
						}
						else{
							$row = $query->fetch_assoc();
							if($row['time_out'] != '00:00:00'){
								$output['error'] = true;
								$output['message'] = 'You have timed out for today';
							}
							else{
								
								$sql = "UPDATE attendance SET time_out = NOW(), status='0' WHERE id = '".$row['uid']."'";
								if($conn->query($sql)){
		
									$date_now = date('Y-m-d');
		
									$sql = "SELECT * FROM attendance WHERE id = '".$row['uid']."' AND date = '$date_now'";
									$query = $conn->query($sql);
									$urow = $query->fetch_assoc();
		
									$time_in = $urow['time_in'];
									$break_out = $urow['break_out'];
									$break_in = $urow['break_in'];
									$time_out = $urow['time_out'];
		
									
									// $break_hours = (strtotime($break_in) - strtotime($break_out)) / 3600;
		
									// $time_hours = (strtotime($time_out) - strtotime($time_in)) / 3600;
		
									// $num_hr = $time_hours - $break_hours;
									
									// $sql = "SELECT * FROM employees INNER JOIN schedules ON schedules.id=employees.schedule_id WHERE employees.id = '$id'";
									// $query = $conn->query($sql);
									// $srow = $query->fetch_assoc();
		
									// print_r($sql);
		
									// // print_r($srow);
		
									// if($srow['time_in'] > $urow['time_in']){
									// 	$time_in = $srow['time_in'];
									// }
		
									// if($srow['break_out'] > $urow['break_out']){
									// 	$break_out = $srow['break_out'];
									// }
		
									// if($srow['break_in'] > $urow['break_in']){
									// 	$break_in = $srow['break_in'];
									// }
		
									// if($srow['time_out'] < $urow['time_in']){
									// 	$time_out = $srow['time_out'];
									// }
		
									$time_in = new DateTime($time_in);
									$break_out = new DateTime($break_out);
									$break_in = new DateTime($break_in);
									$time_out = new DateTime($time_out);
									$interval = $time_in->diff($time_out);

									$interval2 = $break_out->diff($break_in);

									$hrs = $interval->format('%h');
									$mins = $interval->format('%i');
									$mins = $mins;

									$hrs2 = $interval2->format('%h');
									$mins2 = $interval2->format('%i');
									$mins2 = $mins2;

									

									$hours = $hrs - $hrs2;

									// echo '<script>alert('.$hours.')</script>';

									$minutes = ($mins - $mins2)/60;
									// echo '<script>alert('.$minutes.')</script>';

									$int = ($hours + $minutes);
									
									// if(	$interval> '')
									// if($int > 4){
									// 	$int = $int - 1;
									// }

									$ot = $int - 8;

									$date_now = date('Y-m-d');

									if($ot > 0){

										$sql = "SELECT rate FROM position WHERE id = '$id'";
						
										$query = $conn->query($sql);
										$row1 = $query->fetch_assoc();

										// echo $row['rate'];
										$rate = $row1['rate'];
										
										$sql = "INSERT INTO overtime (employee_id, hours, rate, date_overtime) VALUES ('$id', '$ot', $rate, '$date_now')";
										if($conn->query($sql)){
											// Upload image if database successfully updated
											// include 'saveUploadImg.php';
		
											// $output['message'] = 'Time in: '.$row['firstname'].' '.$row['lastname'];
										}
										else{
											// $output['error'] = true;
											// $output['message'] = $conn->error;
										}
									}else{
										$ot = 0;
									}
		
									$sql = "UPDATE attendance SET num_hr = '$int', ot_hr = '$ot' WHERE id = '".$row['uid']."'";
									if($conn->query($sql)){

											// Upload image if database successfully updated
											include 'saveUploadImg.php';

											$output['message'] = 'Time Out: '.$row['firstname'].' '.$row['lastname'];
										}
										else{
											$output['error'] = true;
											$output['message'] = $conn->error;
										}
								}
								else{
									$output['error'] = true;
									$output['message'] = $conn->error;
								}
							}
							
						}
					}
				}
			else{
				$output['error'] = true;
				$output['message'] = 'Employee ID not found';
			}
			
		}
	}else{
		$output['error'] = true;
		$output['message'] = 'Take Snapshot First';
	}
	
	echo json_encode($output);

?>