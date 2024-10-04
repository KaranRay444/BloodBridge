<?php
include 'connect.php';

$donors_result = $conn->query("SELECT * FROM donors");
$requests_result = $conn->query("SELECT * FROM need_blood");
$events_result = $conn->query("SELECT * FROM events");
$messages_result = $conn->query("SELECT * FROM messages");
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
            color:#cf1b2b;
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
            color:#ffff;
        }
        .main-content h2 {
            color: #ff5a6533
        }
        .main-content h1 {
            color:#ffff;
        }
        .section {
            margin-bottom: 30px;
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
            cursor: pointer;
        }
        .btn:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="sidebar">
            <h2>Welcome Admin!</h2>
            <ul>
                <li><a href="admin.php?page=dashboard">Dashboard</a></li>
                <li><a href="admin.php?page=manage_donors">Manage Donors</a></li>
                <li><a href="admin.php?page=manage_requests">Manage Blood Requests</a></li>
                <li><a href="admin.php?page=manage_events">Manage Events</a></li>
                <li><a href="admin.php?page=manage_messages">Manage Messages</a></li>
                <li><a href="logout.php">Logout</a></li>
            </ul>
        </div>

        <div class="main-content">
            <h1>Admin Dashboard</h1>
            <?php
                if (isset($_GET['page'])) {
                    $page = $_GET['page'];

                    switch ($page) {
                        case 'manage_donors':
                            include 'manage_donors.php';
                            break;
                        case 'manage_requests':
                            include 'manage_requests.php';
                            break;
                        case 'manage_events':
                            include 'manage_events.php';
                            break;
                        case 'manage_messages':
                            include 'manage_messages.php';
                            break;
                        default:
                            echo "<h2>Welcome to the Dashboard</h2>";
                            break;
                    }
                } else {
                    echo "<h2>Welcome to the Dashboard</h2>";
                }
            ?>
        </div>
    </div>
</body>
</html>
