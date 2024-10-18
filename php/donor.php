<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Donor Registration Form</title>
    <link rel="stylesheet" href="../assets/css/style.css">
    <style>
        /* Add your styles here */
        .donor-registration-container {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            padding: 20px;
        }

        .donor-registration-form {
            background-color: #ffffff;
            width: 600px;
            border-radius: 10px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
            overflow: hidden;
            margin-top: 20px;
        }

        .form-content {
            padding: 30px;
        }

        .form-group {
            margin-bottom: 20px;
        }

        .form-group label {
            display: block;
            font-size: 16px;
            margin-bottom: 8px;
        }

        .form-group input,
        .form-group select {
            width: 100%;
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 5px;
            font-size: 14px;
        }

        .submit-btn {
            width: 100%;
            background-color: #2980b9;
            color: white;
            padding: 15px;
            border: none;
            border-radius: 5px;
            font-size: 16px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        .submit-btn:hover {
            background-color: #1f6695;
        }
    </style>
</head>
<body>

<?php
// Include the database connection
include('connect.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Collect and sanitize input data
    $donorName = $conn->real_escape_string(trim($_POST['donor-name']));
    $bloodType = $conn->real_escape_string(trim($_POST['blood-type']));
    $contact = $conn->real_escape_string(trim($_POST['contact']));
    $city = $conn->real_escape_string(trim($_POST['city'])); // Added city field
    $username = $conn->real_escape_string(trim($_POST['username']));
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT); // Hashing the password
    $userRole = 'donor'; // Setting the role as donor

    // Validate input
    if (empty($donorName) || empty($bloodType) || empty($contact) || empty($city) || empty($username) || empty($password)) {
        echo "Please fill in all required fields.";
    } elseif (!preg_match("/^[0-9]{10}$/", $contact)) { // Validate contact number
        echo "Please enter a valid 10-digit contact number.";
    } else {
        // Prepare SQL query to insert into the donors table
        $donorSql = "INSERT INTO donors (donor_name, blood_type, contact, city, username, password)
                     VALUES ('$donorName', '$bloodType', '$contact', '$city', '$username', '$password')";

        // Prepare SQL query to insert into the users table
        $userSql = "INSERT INTO users (username, password, role) 
                    VALUES ('$username', '$password', '$userRole')";

        // Execute the donor query and handle errors
        if ($conn->query($donorSql) === TRUE) {
            // If donor inserted successfully, now insert into users table
            if ($conn->query($userSql) === TRUE) {
                echo "Registration successful.";
            } else {
                echo "Error inserting into users table: " . $conn->error;
            }
        } else {
            echo "Error inserting into donors table: " . $conn->error;
        }
    }

    // Close the connection
    $conn->close();
}
?>


<?php include('../header.php'); ?>
<div class="donor-registration-container">
    <div class="donor-registration-form">
        <div class="form-content">
            <h1>Donor Registration Form</h1>
            <form action="donor.php" method="POST"> <!-- Specify form handler -->
                <div class="form-group">
                    <label for="donor-name">Donor's Name <span class="required">*</span></label>
                    <input type="text" id="donor-name" name="donor-name" placeholder="Enter donor's full name" required pattern="[A-Za-z\s]+" title="Please enter only letters and spaces.">
                </div>

                <div class="form-group">
                    <label for="blood-type">Blood Type <span class="required">*</span></label>
                    <select id="blood-type" name="blood-type" required>
                        <option value="" disabled selected>Select blood type</option>
                        <option value="A+">A+</option>
                        <option value="A-">A-</option>
                        <option value="B+">B+</option>
                        <option value="B-">B-</option>
                        <option value="AB+">AB+</option>
                        <option value="AB-">AB-</option>
                        <option value="O+">O+</option>
                        <option value="O-">O-</option>
                    </select>
                </div>

                <div class="form-group">
                    <label for="contact">Contact Number <span class="required">*</span></label>
                    <input type="tel" id="contact" name="contact" placeholder="Enter your 10-digit contact number" pattern="[0-9]{10}" required title="Please enter a valid 10-digit contact number.">
                </div>

                <div class="form-group">
                    <label for="city">City <span class="required">*</span></label> <!-- New city field -->
                    <input type="text" id="city" name="city" placeholder="Enter your city" required>
                </div>

                <div class="form-group">
                    <label for="username">Create Username <span class="required">*</span></label>
                    <input type="text" id="username" name="username" required>
                </div>

                <div class="form-group">
                    <label for="password">Password <span class="required">*</span></label>
                    <input type="password" id="password" name="password" placeholder="Create a password (minimum 8 characters)" minlength="8" required>
                </div>

                <button type="submit" class="submit-btn">Register</button>
            </form>
        </div>
    </div>
</div>

</body>
</html>
