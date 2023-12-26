<<<<<<< HEAD
<?php
=======
<?php 
>>>>>>> 9fba41005b837c2dae454214f225d7c95f93ee13

include 'includes/session.php';

$id = $_POST['id'];

$sql = "SELECT *, TIMEDIFF(time_out, time_in) AS numhrs FROM attendance INNER JOIN employees ON employees.id=attendance.employee_id WHERE attendance.employee_id = '$id'";
$query = $conn->query($sql);
$row = $query->fetch_assoc();

$html_table = '
<<<<<<< HEAD
<table class="table table-bordered table-striped">
	<thead>
        <th>Name</th>
        <th>Employee Id</>
=======
<h1>' . $row['firstname'] . ' ' . $row['lastname'] . '</h1>
<table class="table table-bordered table-striped">
	<thead>
>>>>>>> 9fba41005b837c2dae454214f225d7c95f93ee13
		<th>Date</th>
		<th>Time In</th>
		<th>Time Out</th>
		<th>Total Hours</th>
	</thead>
	<tbody>';
<<<<<<< HEAD
foreach ($query as $row) {
	$status = ($row['status']) ? '<span class="label label-warning pull-right">ontime</span>' : '<span class="label label-danger pull-right">late</span>';
	$html_table .= '<tr>
            <td>' . $row['firstname'] . ' ' . $row['lastname'] . '</td>
             <td>' . $row['employee_id'] . '</td>
			<td>' . date('M d, Y', strtotime($row['date'])) . '</td>
			<td>' . date('h:i A', strtotime($row['time_in'])) . $status . '</td>
			<td>' . date('h:i A', strtotime($row['time_out'])) . '</td>
			<td>' . $row['num_hr'] . " " . "Hours" . '</td>
		</tr>';
}
$html_table .= '</tbody></table>';

echo $html_table;
=======
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

>>>>>>> 9fba41005b837c2dae454214f225d7c95f93ee13
