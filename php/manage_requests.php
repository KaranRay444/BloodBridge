<?php
include 'connect.php'; 

$requests_result = $conn->query("SELECT * FROM need_blood");

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Blood Requests</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
        }
        h2 {
            color: #333;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }
        table, th, td {
            border: 1px solid #ccc;
        }
        th, td {
            padding: 10px;
            text-align: left;
        }
        th {
            background-color: #f4f4f4;
        }
    </style>
</head>
<body>
    <h2>Blood Requests List</h2>
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Patient Name</th>
                <th>Blood Type</th>
                <th>Hospital Name</th>
                <th>Doctor Name</th>
                <th>Contact</th>
                <th>Required Date</th>
            </tr>
        </thead>
        <tbody>
            <?php while ($request = $requests_result->fetch_assoc()): ?>
                <tr>
                    <td><?php echo $request['id']; ?></td>
                    <td><?php echo $request['patient_name']; ?></td>
                    <td><?php echo $request['blood_type']; ?></td>
                    <td><?php echo $request['hospital_name']; ?></td>
                    <td><?php echo $request['doctor_name']; ?></td>
                    <td><?php echo $request['contact']; ?></td>
                    <td><?php echo $request['required_date']; ?></td>
                </tr>
            <?php endwhile; ?>
        </tbody>
    </table>
</body>
</html>
