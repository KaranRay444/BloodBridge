<?php
session_start();
include 'connect.php'; // Include your database connection

// Check if user is logged in
if (!isset($_SESSION['user_id'])) {
    echo "You must be logged in to view your requests.";
    exit();
}

// Get the user ID from the session
$user_id = $_SESSION['user_id'];

// Fetch requests from the need_blood table for the logged-in user
$sql = "SELECT nb.*, p.patient_name 
        FROM need_blood nb 
        JOIN patients p ON nb.patient_id = p.id 
        WHERE p.user_id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();

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
        }
        th, td {
            border: 1px solid #ccc;
            padding: 10px;
            text-align: left;
        }
        th {
            background-color: #0b1739;
            color: white;
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
            <h1>My Blood Requests</h1>
            <?php if ($result->num_rows > 0): ?>
                <table>
                    <thead>
                        <tr>
                            <th>Request ID</th>
                            <th>Patient Name</th>
                            <th>Blood Group</th>
                            <th>Quantity (mL)</th>
                            <th>Disease</th>
                            <th>Status</th>
                            <th>Requested On</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php while ($row = $result->fetch_assoc()): ?>
                            <tr>
                                <td><?php echo htmlspecialchars($row['id']); ?></td>
                                <td><?php echo htmlspecialchars($row['patient_name']); ?></td>
                                <td><?php echo htmlspecialchars($row['blood_group']); ?></td>
                                <td><?php echo htmlspecialchars($row['no_of_units']); ?></td>
                                <td><?php echo htmlspecialchars($row['disease']); ?></td>
                                <td><?php echo htmlspecialchars($row['status']); ?></td>
                                <td><?php echo htmlspecialchars($row['created_at']); ?></td>
                            </tr>
                        <?php endwhile; ?>
                    </tbody>
                </table>
            <?php else: ?>
                <p>No requests found.</p>
            <?php endif; ?>
        </div>
    </div>
</body>
</html>
