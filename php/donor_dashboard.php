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
            <h1>Welcome to Donor Dashboard</h1>
            <div class="stats-box">
                <h2>Total Donations: 5</h2>
                <h2>Approved Donations: 3</h2>
                <h2>Pending Donations: 2</h2>
            </div>
            <a href="donation_form.php">Submit a Donation</a>
        </div>
    </div>
</body>
</html>
