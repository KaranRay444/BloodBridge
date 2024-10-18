<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

session_start();

// Check if user is logged in as donor
if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'donor') {
    header("Location: login.php");
    exit();
}

// Include database connection
include 'connect.php';

// Fetch donor ID from session
$donor_id = $_SESSION['user_id'];

// Query donations based on donor ID
$donations_result = $conn->query("SELECT * FROM donations WHERE donor_id = '$donor_id'");

if ($donations_result === false) {
    echo "Database query failed: " . $conn->error; // Check for SQL errors
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Donations</title>
    <style>
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
           .sidebar {
        width: 250px;
        height: 100vh;
        background-color: #0a1330;
        color: #ffffff;
        position: fixed;
        padding-top: 20px;
    }
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
        }
        .container {
            display: flex;
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
        .donations-table {
            width: 100%;
            border-collapse: collapse;
            background-color: #ffffff;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
        }
        th, td {
            padding: 12px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }
        th {
            background-color: #0a1330;
            color: white;
        }
        tr:hover {
            background-color: #f1f1f1;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="sidebar">
            <h2>Donor Panel</h2>
            <ul>
                <li><a href="donor_dashboard.php">Dashboard</a></li>
                <li><a href="donation_form.php">Donate Now</a></li>
                <li><a href="my_donations.php">My Donations</a></li>
                <li><a href="donation_certificate.php">Donation Certificate</a></li>
                <li><a href="profile_update.php">Update Profile</a></li>
                <li><a href="logout.php">Logout</a></li>
            </ul>
        </div>

        <div class="main-content">
            <h1>My Donations</h1>
            <table class="donations-table">
                <tr>
                    <th>ID</th>
                    <th>Blood Type</th>
                    <th>Quantity</th>
                    <th>Date</th>
                    <th>Status</th>
                </tr>
                <?php if ($donations_result->num_rows > 0) { 
                    while ($row = $donations_result->fetch_assoc()) { ?>
                        <tr>
                            <td><?php echo htmlspecialchars($row['id']); ?></td>
                            <td><?php echo htmlspecialchars($row['blood_type']); ?></td>
                            <td><?php echo htmlspecialchars($row['quantity']); ?></td>
                            <td><?php echo htmlspecialchars($row['donation_date']); ?></td>
                            <td><?php echo htmlspecialchars($row['status']); ?></td>
                        </tr>
                    <?php } 
                } else { ?>
                    <tr>
                        <td colspan="5">No donations found.</td>
                    </tr>
                <?php } ?>
            </table>
        </div>
    </div>
</body>
</html>
