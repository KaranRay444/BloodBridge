<?php
include 'connect.php';

// Retrieve requests for the logged-in patient
$patient_id = 1; // Replace with session value
$requests_result = $conn->query("SELECT * FROM need_blood WHERE patient_id = '$patient_id'");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Requests</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
        }
        .container {
            display: flex;
        }
        .sidebar {
            width: 250px;
            height: 100vh;
            background-color: #0a1330;
            color: #ffffff;
            position: fixed;
            padding-top: 20px;
        }
        .sidebar h2 {
            text-align: center;
            margin-bottom: 20px;
            color: #cf1b2b;
        }
        .sidebar ul {
            list-style-type: none;
            padding: 0;
        }
        .sidebar ul li {
            padding: 15px;
            text-align: center;
        }
        .sidebar ul li a {
            color: white;
            text-decoration: none;
            display: block;
            font-size: 16px;
        }
        .sidebar ul li a:hover {
            background-color: #0b1739;
        }
        .main-content {
            margin-left: 250px;
            padding: 20px;
            width: calc(100% - 250px);
            background-color: #ffffff;
            color: #333;
        }
        .main-content h1 {
            color: #ff5a65;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        th, td {
            padding: 10px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }
        th {
            background-color: #0b1739;
            color: #ffffff;
        }
        tr:hover {
            background-color: #f1f1f1;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="sidebar">
            <h2>Patient Panel</h2>
            <ul>
                <li><a href="p_dash.php">Dashboard</a></li>
                <li><a href="request.php">Request Blood</a></li>
                <li><a href="myrequests.php">My Requests</a></li>
                <li><a href="logout.php">Logout</a></li>
            </ul>
        </div>

        <div class="main-content">
            <h1>My Requests</h1>
            <table>
                <tr>
                    <th>ID</th>
                    <th>Blood Group</th>
                    <th>Quantity</th>
                    <th>Disease</th>
                    <th>Status</th>
                </tr>
                <?php while ($row = $requests_result->fetch_assoc()) { ?>
                    <tr>
                        <td><?php echo $row['id']; ?></td>
                        <td><?php echo $row['blood_group']; ?></td>
                        <td><?php echo $row['no_of_units']; ?></td>
                        <td><?php echo $row['disease']; ?></td>
                        <td><?php echo $row['status']; ?></td>
                    </tr>
                <?php } ?>
            </table>
        </div>
    </div>
</body>
</html>
