<?php
include 'connect.php';

// Example data for demonstration; replace with actual patient data
$patient_id = 1; // Replace with session value
$patient_result = $conn->query("SELECT * FROM patients WHERE id = '$patient_id'");
$patient = $patient_result->fetch_assoc();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Patient Dashboard</title>
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
        .info-card {
            background-color: #e2e2e2;
            border-radius: 5px;
            padding: 20px;
            margin: 10px 0;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
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
            <h1>Welcome, <?php echo $patient['patient_name']; ?>!</h1>
            <div class="info-card">
                <h2>Your Information</h2>
                <p><strong>Patient ID:</strong> <?php echo $patient['id']; ?></p>
                <p><strong>Contact:</strong> <?php echo $patient['contact']; ?></p>
                <p><strong>Blood Group:</strong> <?php echo $patient['blood_type']; ?></p>
            </div>
            <div class="info-card">
                <h2>Quick Links</h2>
                <ul>
                    <li><a href="request.php">Request Blood</a></li>
                    <li><a href="myrequests.php">View My Requests</a></li>
                    <li><a href="logout.php">Logout</a></li>
                </ul>
            </div>
        </div>
    </div>
</body>
</html>
