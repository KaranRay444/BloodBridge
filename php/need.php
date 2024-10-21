<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Need Blood Form</title>
    <link rel="stylesheet" href="../assets/css/style.css">
    <style>
        .need-blood-container * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        .need-blood-container {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            padding: 20px;
        }

        .need-blood-form {
            background-color: #ffffff;
            width: 600px;
            border-radius: 10px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
            overflow: hidden;
            margin-top: 20px;
        }

        .need-blood-header {
            background-color: #ff4c4c;
            color: #fff;
            padding: 20px;
            text-align: center;
        }

        .need-blood-header h1 {
            margin-bottom: 10px;
            font-size: 24px;
        }

        .need-blood-header p {
            font-size: 14px;
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
        .form-group select,
        .form-group textarea {
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
    $patientName = $conn->real_escape_string(trim($_POST['patient-name']));
    $bloodType = $conn->real_escape_string(trim($_POST['blood-type']));
    $hospitalName = $conn->real_escape_string(trim($_POST['hospital-name']));
    $doctorName = $conn->real_escape_string(trim($_POST['doctor-name']));
    $contact = $conn->real_escape_string(trim($_POST['contact']));
    $message = $conn->real_escape_string(trim($_POST['message']));
    $username = $conn->real_escape_string(trim($_POST['username']));
    $password = password_hash(trim($_POST['password']), PASSWORD_DEFAULT); // Hashing the password

    // Set user role
    $userRole = 'patient'; // Change this as needed

    // Validate input
    if (empty($patientName) || empty($bloodType) || empty($hospitalName) || empty($doctorName) || empty($contact) || empty($username) || empty($password)) {
        echo "Please fill in all required fields.";
    } elseif (!preg_match("/^[0-9]{10}$/", $contact)) { // Validate contact number
        echo "Please enter a valid 10-digit contact number.";
    } else {
        // Check if username already exists
        $sqlCheckUsername = "SELECT * FROM users WHERE username = '$username'";
        $resultCheck = $conn->query($sqlCheckUsername);
        
        if ($resultCheck->num_rows > 0) {
            echo "Username already exists. Please choose another one.";
        } else {
            // Prepare SQL query to insert into the users table
            $sqlUser = "INSERT INTO users (username, password, role) VALUES ('$username', '$password', '$userRole')";

            // Execute the query for users
           // Execute the query for users
if ($conn->query($sqlUser) === TRUE) {
    // Get the last inserted user ID
    $userId = $conn->insert_id; // Fetch the user ID here

    // Prepare SQL query to insert into the patients table
    $sqlPatient = "INSERT INTO patients (user_id, patient_name, blood_type, hospital_name, doctor_name, contact, message)
                   VALUES ('$userId', '$patientName', '$bloodType', '$hospitalName', '$doctorName', '$contact', '$message')";
    
    // Execute the patient query
    if ($conn->query($sqlPatient) === TRUE) {
        echo "Registration successful.";
    } else {
        echo "Error: " . $sqlPatient . "<br>" . $conn->error;
    }
} else {
    echo "Error: " . $sqlUser . "<br>" . $conn->error;
}

        }
    }

    // Close the connection
    $conn->close();
}
?>

<?php include('../header.php'); ?>
<div class="need-blood-container">
    <div class="need-blood-form">
        <div class="need-blood-header">
            <h1>Patient Registration Form</h1>
            <p>Please fill out the details correctly to register as a blood requestor. Your information will be handled confidentially.</p>
        </div>

        <div class="form-content">
            <form action="" method="POST"> <!-- Action changed to current page -->
                <div class="form-group">
                    <label for="patient-name">Patient's Name <span class="required">*</span></label>
                    <input type="text" id="patient-name" name="patient-name" placeholder="Enter patient's full name" required pattern="[A-Za-z\s]+" title="Please enter only letters and spaces.">
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
                    <label for="hospital-name">Hospital Name <span class="required">*</span></label>
                    <input type="text" id="hospital-name" name="hospital-name" placeholder="Enter the hospital name" required pattern="[A-Za-z\s]+" title="Please enter only letters and spaces.">
                </div>

                <div class="form-group">
                    <label for="doctor-name">Doctor's Name <span class="required">*</span></label>
                    <input type="text" id="doctor-name" name="doctor-name" placeholder="Enter the doctor's name" required pattern="[A-Za-z\s]+" title="Please enter only letters and spaces.">
                </div>

                <div class="form-group">
                    <label for="contact">Contact Number <span class="required">*</span></label>
                    <input type="tel" id="contact" name="contact" placeholder="Enter your 10-digit contact number" pattern="[0-9]{10}" required title="Please enter a valid 10-digit contact number.">
                </div>

                <div class="form-group">
                    <label for="message">Additional Message (Optional)</label>
                    <textarea id="message" name="message" placeholder="Enter any additional information"></textarea>
                </div>

                <div class="form-group">
                    <label for="username">Create Username <span class="required">*</span></label>
                    <input type="text" id="username" name="username" required>
                </div>

                <div class="form-group">
                    <label for="password">Password <span class="required">*</span></label>
                    <input type="password" id="password" name="password" placeholder="Create a password (minimum 8 characters)" minlength="8" required>
                </div>

                <button type="submit" class="submit-btn">Submit</button>
            </form>
        </div>
    </div>
</div>

</body>
</html>
