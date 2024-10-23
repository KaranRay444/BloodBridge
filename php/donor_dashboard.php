<?php
session_start();
include 'connect.php';

// Check if user is logged in and is a donor
if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'donor') {
    header("Location: login.php");
    exit();
}

// Fetch donor details using the user ID from the session
$user_id = $_SESSION['user_id'];
$sql = "SELECT * FROM donors WHERE user_id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$donor_result = $stmt->get_result();

if ($donor_result && $donor_result->num_rows > 0) {
    $donor = $donor_result->fetch_assoc();
} else {
    echo "No donor data found for this user.";
    exit();
}

// Fetch donation statistics for the logged-in donor
$donor_id = $donor['id']; // Use donor's ID for fetching stats
$donation_stats_sql = "SELECT 
                       COUNT(*) AS total_donations, 
                       SUM(CASE WHEN status = 'approved' THEN 1 ELSE 0 END) AS approved_donations, 
                       SUM(CASE WHEN status = 'pending' THEN 1 ELSE 0 END) AS pending_donations 
                       FROM donations 
                       WHERE donor_id = ?";
$stats_stmt = $conn->prepare($donation_stats_sql);
$stats_stmt->bind_param("i", $donor_id);
$stats_stmt->execute();
$stats_result = $stats_stmt->get_result();

$stats = $stats_result->fetch_assoc();
$total_donations = $stats['total_donations'] ?? 0;
$approved_donations = $stats['approved_donations'] ?? 0;
$pending_donations = $stats['pending_donations'] ?? 0;

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Donor Dashboard</title>
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
        .stats-box {
            background-color: #0a1330;
            color: white;
            padding: 20px;
            margin-bottom: 20px;
            text-align: center;
            border-radius: 5px; /* Add border radius for better aesthetics */
        }
        .donor-info {
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
            <h2>Donor Panel</h2>
            <ul>
                <li><a href="donor_dashboard.php">Dashboard</a></li>
                <li><a href="donation_form.php">Donate Now</a></li>
                <li><a href="my_donations.php">My Donations</a></li>
                <li><a href="logout.php">Logout</a></li>
            </ul>
        </div>

        <div class="main-content">
            <h1>Welcome to Donor Dashboard</h1>

            <?php if (isset($donor)): ?>
                <div class="donor-info">
                    <h2>Your Information</h2>
                    <p><strong>Donor ID:</strong> <?php echo htmlspecialchars($donor['id']); ?></p>
                    <p><strong>Name:</strong> <?php echo htmlspecialchars($donor['donor_name']); ?></p>
                    <p><strong>Contact:</strong> <?php echo htmlspecialchars($donor['contact']); ?></p>
                    <p><strong>Blood Type:</strong> <?php echo htmlspecialchars($donor['blood_type']); ?></p>
                </div>

                <div class="stats-box">
                    <h2>Total Donations: <?php echo $total_donations; ?></h2>
                    <h2>Approved Donations: <?php echo $approved_donations; ?></h2>
                    <h2>Pending Donations: <?php echo $pending_donations; ?></h2>
                </div>
            <?php else: ?>
                <p>No donor data found for this user.</p>
            <?php endif; ?>

            <a href="donation_form.php">Submit a Donation</a>
        </div>
    </div>
</body>
</html>
