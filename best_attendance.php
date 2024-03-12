<!DOCTYPE html>
<html>

<head>
    <title>Best Attendance of the Month</title>
    <!-- Include Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">

    <style>
        body {
            background-color: #141414;
        }

        th,
        table,
        td,
        h2 {
            color: white;
            font-family: sans-serif;
        }

        h1 {
            color: white !important;
            text-align: center !important;
            margin-bottom: 50px;
            font-size: bold;
        }
    </style>
</head>

<body>
    <div class="container mt-5">
        <h1>CAFE CERVEZA ATTENDANCE AND PAYROLL SYSTEM</h1>
        <h2>Best Attendance of the Month</h2>
        <table class="table">
            <thead>
                <tr>
                    <th colspan="5">Best Attendance for <?php echo date('F Y'); ?></th>
                </tr>
                <tr>
                    <th>Rank</th>
                    <th>Employee ID</th>
                    <th>First Name</th>
                    <th>Last Name</th>
                    <th>Attendance Count</th>
                </tr>
            </thead>
            <tbody>
                <?php
                // Establish database connection
                include 'conn.php';

                $sql = "SELECT 
                            e.employee_id,
                            e.firstname,
                            e.lastname,
                            COUNT(a.id) AS attendance_count
                        FROM 
                            employees e
                        LEFT JOIN
                            attendance a ON e.id = a.employee_id 
                            AND MONTH(a.date) = MONTH(CURRENT_DATE()) 
                            AND YEAR(a.date) = YEAR(CURRENT_DATE()) 
                            AND a.status = 1
                        GROUP BY 
                            e.employee_id
                        ORDER BY 
                            attendance_count DESC
                        LIMIT 3";
                $result = $conn->query($sql);

                if ($result->num_rows > 0) {
                    $rank = 1;
                    // Output data of each row
                    while ($row = $result->fetch_assoc()) {
                        echo "<tr>";
                        echo "<td>" . $rank . "</td>";
                        echo "<td>" . $row["employee_id"] . "</td>";
                        echo "<td>" . $row["firstname"] . "</td>";
                        echo "<td>" . $row["lastname"] . "</td>";
                        echo "<td>" . $row["attendance_count"] . "</td>";
                        echo "</tr>";
                        $rank++;
                    }
                } else {
                    echo "<tr><td colspan='4'>No data found</td></tr>";
                }
                $conn->close();
                ?>
            </tbody>
        </table>
    </div>
</body>

</html>