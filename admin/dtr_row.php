<?php 

include 'includes/session.php';

$id = $_POST['id'];

$sql = "SELECT *, TIMEDIFF(time_out, time_in) AS numhrs FROM attendance INNER JOIN employees ON employees.id=attendance.employee_id WHERE attendance.employee_id = '$id'";
$query = $conn->query($sql);
$row = $query->fetch_assoc();

$html_table = '
<h1>' . $row['firstname'] . ' ' . $row['lastname'] . '</h1>
<table class="table table-bordered table-striped">
	<thead>
		<th>Date</th>
		<th>Time In</th>
		<th>Time Out</th>
		<th>Total Hours</th>
	</thead>
	<tbody>';
	foreach ($query as $row) {
		$html_table .= '<tr>
			<td>' . date('M d, Y', strtotime($row['date'])) . '</td>
			<td>' . date('h:i A', strtotime($row['time_in'])) . '</td>
			<td>' . date('h:i A', strtotime($row['time_out'])) . '</td>
			<td>' . $row['numhrs'] . '</td>
		</tr>';
	}
$html_table .= '</tbody></table>';

echo $html_table;

