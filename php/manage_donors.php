<?php
include 'connect.php'; 

$donors_result = $conn->query("SELECT * FROM donors");

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Donors</title>
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
    <h2>Donors List</h2>
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Age</th>
                <th>Blood Type</th>
                <th>Gender</th>
                <th>Weight</th>
                <th>Contact</th>
                <th>Email</th>
                <th>Address</th>
                <th>Last Donation Date</th>
            </tr>
        </thead>
        <tbody>
            <?php while ($donor = $donors_result->fetch_assoc()): ?>
                <tr>
                    <td><?php echo $donor['id']; ?></td>
                    <td><?php echo $donor['name']; ?></td>
                    <td><?php echo $donor['age']; ?></td>
                    <td><?php echo $donor['blood_type']; ?></td>
                    <td><?php echo $donor['gender']; ?></td>
                    <td><?php echo $donor['weight']; ?></td>
                    <td><?php echo $donor['contact']; ?></td>
                    <td><?php echo $donor['email']; ?></td>
                    <td><?php echo $donor['address']; ?></td>
                    <td><?php echo $donor['last_donation_date']; ?></td>
                </tr>
            <?php endwhile; ?>
        </tbody>
    </table>
</body>
</html>
