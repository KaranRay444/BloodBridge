<?php
include 'connect.php';

// Fetch blood inventory data
$inventory_result = $conn->query("SELECT * FROM blood_inventory");

if ($inventory_result === false) {
    echo "Database query failed: " . $conn->error;
    exit();
}

// Determine which page to display based on the query parameter
$page = isset($_GET['page']) ? $_GET['page'] : 'dashboard'; // Default page

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #081028;
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
        }
        .sidebar h2 {
            text-align: center;
            margin-top: 20px;
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
            background-color: #081028;
            color: #fff;
        }
        .main-content h1 {
            color: #fff;
        }
        .inventory-boxes {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(150px, 1fr));
            gap: 20px;
        }
        .box {
            background-color: #0b1739;
            color: #fff;
            padding: 20px;
            text-align: center;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
        .box h3 {
            margin: 0;
            color: #ff5a65;
            font-size: 24px;
        }
        .box p {
            margin-top: 10px;
            font-size: 18px;
        }
        .btn {
            padding: 10px 20px;
            background-color: #007bff;
            color: white;
            border: none;
            cursor: pointer;
        }
        .btn:hover {
            background-color: #0056b3;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }
        table, th, td {
            border: 1px solid #0b1739;
        }
        th, td {
            padding: 10px;
            text-align: left;
        }
        th {
            background-color: #0b1739f4;
            color: #ff5a65;
        }
        .btn {
            padding: 10px 20px;
            background-color: #007bff;
            color: white;
            border: none;
            cursor: pointer;}
    </style>
</head>
<body>
    <div class="container">
        <div class="sidebar">
            <h2>Welcome Admin!</h2>
            <ul>
                <li><a href="admin.php?page=dashboard">Dashboard</a></li>
                <li><a href="admin.php?page=manage_donors">Manage Donors</a></li>
                <li><a href="admin.php?page=manage_patients">Manage Patients</a></li>
                <li><a href="admin.php?page=manage_events">Manage Events</a></li>
                <li><a href="admin.php?page=manage_messages">Manage Messages</a></li>
                <li><a href="logout.php">Logout</a></li>
            </ul>
        </div>

        <div class="main-content">
            <?php
            switch ($page) {
                case 'dashboard':
                    echo "<h1>Blood Inventory</h1>
                    <div class='inventory-boxes'>";
                    
                    // Fetch and display each blood type and available quantity
                    if ($inventory_result->num_rows > 0) {
                        while ($row = $inventory_result->fetch_assoc()) { ?>
                            <div class="box">
                                <h3><?php echo htmlspecialchars($row['blood_type']); ?></h3>
                                <p><?php echo htmlspecialchars($row['available_ml']); ?> ml available</p>
                            </div>
                        <?php }
                    } else { ?>
                        <p>No blood inventory data available.</p>
                    <?php } 
                    echo "</div>";
                    
                    echo "<h2>Update Blood Inventory</h2>
                    <form method='POST' action='update_inventory.php'>
                        <label for='blood_type'>Select Blood Type:</label>
                        <select name='blood_type' required>
                            <option value='A+'>A+</option>
                            <option value='A-'>A-</option>
                            <option value='B+'>B+</option>
                            <option value='B-'>B-</option>
                            <option value='AB+'>AB+</option>
                            <option value='AB-'>AB-</option>
                            <option value='O+'>O+</option>
                            <option value='O-'>O-</option>
                        </select>
                        <br><br>
                        <label for='change_in_ml'>Change in ml (use negative value to reduce):</label>
                        <input type='number' name='change_in_ml' required>
                        <br><br>
                        <input type='submit' class='btn' value='Update Inventory'>
                    </form>";
                    break;

                case 'manage_donors':
                    echo "<h1>Manage Donors</h1>";
                    include 'manage_donors.php'; // This page should handle adding/deleting donors

                    break;

                case 'manage_patients':
                    echo "<h1>Manage Patients</h1>";
                    include 'manage_patients.php'; // This page should handle adding/deleting donors
                    break;

                case 'manage_events':
                    echo "<h1>Manage Events</h1>";
                    include 'manage_events.php';
                    break;

                case 'manage_messages':
                    echo "<h1>Manage Messages</h1>";
                    include 'manage_messages.php';
                    break;

                default:
                    echo "<h1>Dashboard</h1>";
                    break;
            }
            ?>
        </div>
    </div>
</body>
</html>
