<?php
session_start();
include 'connect.php';

// Check if user is logged in and is a patient
if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'patient') {
    header("Location: login.php"); // Redirect to login if not logged in
    exit();
}

$patient_id = $_SESSION['user_id']; // Get patient ID from session

// Fetch patient details using the patient ID
$patient_result = $conn->query("SELECT * FROM patients WHERE user_id = '$patient_id'");

if ($patient_result && $patient_result->num_rows > 0) {
    $patient = $patient_result->fetch_assoc();
} else {
    $error = "No patient data found for this user.";
    $patient = null; // Ensure $patient is null if not found
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Patient Dashboard</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 0; padding: 0; background-color: #f4f4f4; }
        .container { display: flex; }
        .sidebar { width: 250px; height: 100vh; background-color: #0a1330; color: #ffffff; position: fixed; padding-top: 20px; }
        .sidebar h2 { text-align: center; margin-bottom: 20px; color: #cf1b2b; }
        .sidebar ul { list-style-type: none; padding: 0; }
        .sidebar ul li { padding: 15px; text-align: center; }
        .sidebar ul li a { color: white; text-decoration: none; display: block; font-size: 16px; }
        .sidebar ul li a:hover { background-color: #0b1739; }
        .main-content { margin-left: 250px; padding: 20px; width: calc(100% - 250px); background-color: #ffffff; color: #333; }
        .main-content h1 { color: #ff5a65; }
        .info-card { background-color: #e2e2e2; border-radius: 5px; padding: 20px; margin: 10px 0; box-shadow: 0 0 10px rgba(0, 0, 0, 0.1); }
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
            <h1>Welcome, <?php echo isset($patient) ? htmlspecialchars($patient['patient_name']) : "Guest"; ?>!</h1>
            <?php if (isset($patient)): ?>
                <div class="info-card">
                    <h2>Your Information</h2>
                    <p><strong>Patient ID:</strong> <?php echo htmlspecialchars($patient['id']); ?></p>
                    <p><strong>Contact:</strong> <?php echo htmlspecialchars($patient['contact']); ?></p>
                    <p><strong>Blood Group:</strong> <?php echo htmlspecialchars($patient['blood_type']); ?></p>
                </div>
            <?php else: ?>
                <p><?php echo $error; ?></p>
            <?php endif; ?>
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
