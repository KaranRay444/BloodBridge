<?php
include 'connect.php';
session_start();

// Check if user is logged in
if (!isset($_SESSION['user_id'])) {
    echo "You need to log in first.";
    exit;
}

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $user_id = $_SESSION['user_id'];
    $blood_group = $_POST['blood_type'];
    $no_of_units = $_POST['no_of_units'];
    $disease = $_POST['disease'] ?? null; // Optional disease field

    // Insert the donation request into the database
    $sql = "INSERT INTO donations (donor_id, blood_type, no_of_units, disease, status, donation_date) 
            VALUES (?, ?, ?, ?, 'Pending', NOW())";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("isis", $user_id, $blood_group, $no_of_units, $disease);

    if ($stmt->execute()) {
        echo "Your donation request has been submitted!";
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Donate Blood</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }
        .container {
            max-width: 600px;
            margin: 50px auto;
            padding: 20px;
            background-color: white;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
        }
        h1 {
            color: #ff5a65;
            text-align: center;
        }
        form {
            margin-top: 20px;
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
            width: 100%;
            border-radius: 5px;
        }
        input[type="submit"]:hover {
            background-color: #ff5a65;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Donate Blood</h1>
        <form action="" method="POST">
            <label for="blood_type">Blood Type:</label>
            <select name="blood_type" id="blood_type" required>
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

            <input type="submit" value="Request Donation">
        </form>
    </div>
</body>
</html>
