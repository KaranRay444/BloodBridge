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
            color: #ffffff;
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
            <h1>Welcome to Your Dashboard</h1>
            <!-- Content will be loaded here -->
        </div>
    </div>
</body>
</html>
