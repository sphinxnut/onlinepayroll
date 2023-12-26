<<<<<<< HEAD
<?php
include 'includes/session.php';

$id = $_POST['id'];
$sql = "SELECT *, TIMEDIFF(time_out, time_in) AS total_hours FROM attendance INNER JOIN employees ON employees.id=attendance.employee_id WHERE attendance.employee_id = '$id'";
$query = $conn->query($sql);
$row = $query->fetch_assoc();

// date picker
$from = date('Y-m-d', strtotime($_POST['from']));
$to = date('Y-m-d', strtotime($_POST['to']));

$html_table = '
=======
<?php 
	include 'includes/session.php';

	$id = $_POST['id'];
	$sql = "SELECT *, TIMEDIFF(time_out, time_in) AS total_hours FROM attendance INNER JOIN employees ON employees.id=attendance.employee_id WHERE attendance.employee_id = '$id'";
	$query = $conn->query($sql);
	$row = $query->fetch_assoc();

	// date picker
	$from = date('Y-m-d', strtotime($_POST['from']));
	$to = date('Y-m-d', strtotime($_POST['to']));

	$html_table = '
>>>>>>> 9fba41005b837c2dae454214f225d7c95f93ee13

		<h4 class="text-center">' . $row['firstname'] . ' ' . $row['lastname'] . '</h4>
		<table class="table table-bordered">
			<thead>
				<th>Date</th>
				<th>Time In</th>
				<th>Time Out</th>
				<th>Total Hours</th>
			</thead>
			<tbody>
	';

<<<<<<< HEAD
foreach ($query as $row) {
    $status = ($row['status']) ? '<span class="label label-warning pull-right">ontime</span>' : '<span class="label label-danger pull-right">late</span>';
    $html_table .= '
=======
	foreach ($query as $row) {
		$status = ($row['status']) ? '<span class="label label-warning pull-right">ontime</span>' : '<span class="label label-danger pull-right">late</span>';
		$html_table .= '
>>>>>>> 9fba41005b837c2dae454214f225d7c95f93ee13
			<tr>
				<td>' . date('M d, Y', strtotime($row['date'])) . '</td>
				<td>' . date('h:i A', strtotime($row['time_in'])) . '</td>
				<td>' . date('h:i A', strtotime($row['time_out'])) . '</td>
				<td>' . $row['total_hours'] . '</td>
			</tr>
		';
<<<<<<< HEAD
}

$html_table .= '
			</tbody>
		</table>
	';

echo $html_table;
=======
	}
				

	$html_table .= '
			</tbody>
		</table>
	';
	
	echo $html_table;
>>>>>>> 9fba41005b837c2dae454214f225d7c95f93ee13
