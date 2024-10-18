<?php
include 'connect.php';

// Handle the form submission
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $donor_id = 1; // Replace with session value for logged-in donor
    $blood_group = $_POST['blood_group'];
    $no_of_units = $_POST['no_of_units'];
    $disease = $_POST['disease'];

    // Insert donation data into the donations table
    $sql = "INSERT INTO donations (donor_id, blood_group, no_of_units, disease, donation_date) 
            VALUES ('$donor_id', '$blood_group', '$no_of_units', '$disease', NOW())";
    
    if ($conn->query($sql) === TRUE) {
        echo "Donation successfully recorded!";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Donate Now</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
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
        form {
            background-color: #ffffff;
            padding: 20px;
            margin-top: 20px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        label {
            display: block;
            margin-bottom: 10px;
            font-weight: bold;
        }
        input[type="text"], input[type="number"], select {
            width: 100%;
            padding: 10px;
            margin-bottom: 20px;
            border: 1px solid #ddd;
            border-radius: 5px;
        }
        input[type="submit"] {
            padding: 10px;
            background-color: #0a1330;
            color: white;
            border: none;
            cursor: pointer;
            border-radius: 5px;
        }
        input[type="submit"]:hover {
            background-color: #ff5a65;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="sidebar">
            <h2>Donor Panel</h2>
            <ul>
                <li><a href="donor_dashboard.php">Dashboard</a></li>
                <li><a href="donate_now.php">Donate Now</a></li>
                <li><a href="my_donations.php">My Donations</a></li>
                <li><a href="donation_certificate.php">Donation Certificate</a></li>
                <li><a href="update_profile.php">Update Profile</a></li>
                <li><a href="logout.php">Logout</a></li>
            </ul>
        </div>

        <div class="main-content">
            <h1>Donate Blood</h1>
            <form action="" method="POST">
                <label for="blood_group">Blood Group:</label>
                <select name="blood_group" id="blood_group" required>
                    <option value="A+">A+</option>
                    <option value="A-">A-</option>
                    <option value="B+">B+</option>
                    <option value="B-">B-</option>
                    <option value="AB+">AB+</option>
                    <option value="AB-">AB-</option>
                    <option value="O+">O+</option>
                    <option value="O-">O-</option>
                </select>

                <label for="no_of_units">Number of Units:</label>
                <input type="number" name="no_of_units" id="no_of_units" required>

                <label for="disease">Any Disease (if applicable):</label>
                <input type="text" name="disease" id="disease">

                <input type="submit" value="Donate Now">
            </form>
        </div>
    </div>
</body>
</html>
