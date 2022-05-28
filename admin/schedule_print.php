<?php
	include 'includes/session.php';
 
	function generateRow($conn,$from, $to){
        // $schedule = $_POST['schedule'];

        if($from && $to){
			$sql = "SELECT *, employees.id AS empid FROM attendance LEFT JOIN employees ON employees.id=attendance.employee_id LEFT JOIN schedules ON schedules.id=employees.schedule_id WHERE attendance.date BETWEEN '$from' AND '$to'ORDER BY employees.updated_on ASC";
		}else{
            $sql = "SELECT *, employees.id AS empid FROM employees LEFT JOIN schedules ON schedules.id=employees.schedule_id";
        }
        
		$contents = '';
        $last = "NOW()";

		$query = $conn->query($sql);
		$total = 0;
        // Updated Added schedule_updated_on for starting date of schedule
		while($row = $query->fetch_assoc()){
			$contents .= "
			<tr>
				<td>".$row['lastname'].", ".$row['firstname']."</td>
				<td>".$row['employee_id']."</td>
				<td>".date('h:i A', strtotime($row['time_in'])).' - '. date('h:i A', strtotime($row['time_out']))."</td>
                <td>".date('M d, Y', strtotime($row['schedule_updated_on']))."</td>
                

			</tr>
			";
		}

		return $contents;
	}

    $range = $_POST['date_range'];
    $ex = explode(' - ', $range);
    $from = date('Y-m-d', strtotime($ex[0]));
    $to = date('Y-m-d', strtotime($ex[1]));

    $from_title = date('M d, Y', strtotime($ex[0]));
	$to_title = date('M d, Y', strtotime($ex[1]));

	require_once('../tcpdf/tcpdf.php');  
    $pdf = new TCPDF('P', PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);  
    $pdf->SetCreator(PDF_CREATOR);  
    $pdf->SetTitle('TechSoft - Employee Schedule');  
    $pdf->SetHeaderData('', '', PDF_HEADER_TITLE, PDF_HEADER_STRING);  
    $pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));  
    $pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));  
    $pdf->SetDefaultMonospacedFont('helvetica');  
    $pdf->SetFooterMargin(PDF_MARGIN_FOOTER);  
    $pdf->SetMargins(PDF_MARGIN_LEFT, '10', PDF_MARGIN_RIGHT);  
    $pdf->setPrintHeader(false);  
    $pdf->setPrintFooter(false);  
    $pdf->SetAutoPageBreak(TRUE, 10);  
    $pdf->SetFont('helvetica', '', 11);  
    $pdf->AddPage();  
    // <p align="center"><small>Issued on: '.date('M d, Y', strtotime($currentDate)).'</small></p>

    $currentDate =  date_create('now')->format('Y-m-d H:i:s');
    $content = '';  
    $content .= '
      	<h2 align="center">Jollibee Sto. Tomas Subic</h2>
        <h4 align="center">'.$from_title." - ".$to_title.'</h4>
      	<h4 align="center">Employee Schedule</h4>

      	<table border="1" cellspacing="0" cellpadding="3">  
           <tr>  
           		<th width="30%" align="center"><b>Employee Name</b></th>
                <th width="25%" align="center"><b>Employee ID</b></th>
				<th width="25%" align="center"><b>Schedule</b></th> 
                <th width="20%" align="center"><b>Date</b></th> 
           </tr>  
      ';  
    $content .= generateRow($conn, $from, $to); 
    $content .= '</table>';  
    $pdf->writeHTML($content);  
    $pdf->Output('schedule.pdf', 'I');

?>