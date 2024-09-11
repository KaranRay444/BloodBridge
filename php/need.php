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
            background-color:  #ff4c4c;
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
    $patientName = $conn->real_escape_string($_POST['patient-name']);
    $bloodType = $conn->real_escape_string($_POST['blood-type']);
    $hospitalName = $conn->real_escape_string($_POST['hospital-name']);
    $doctorName = $conn->real_escape_string($_POST['doctor-name']);
    $contact = $conn->real_escape_string($_POST['contact']);
    $requiredDate = $conn->real_escape_string($_POST['required-date']);
    $message = $conn->real_escape_string($_POST['message']);

    // Prepare SQL query
    $sql = "INSERT INTO need_blood (patient_name, blood_type, hospital_name, doctor_name, contact, required_date, message)
            VALUES ('$patientName', '$bloodType', '$hospitalName', '$doctorName', '$contact', '$requiredDate', '$message')";

    // Execute the query and handle errors
    if ($conn->query($sql) === TRUE) {
        echo "Blood request submitted successfully.";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    // Close the connection
    $conn->close();
}
?>



<?php include('../header.php'); ?>

<div class="need-blood-container">
    <div class="need-blood-form">
        <div class="need-blood-header">
            <h1>Need Blood Form</h1>
            <p>Please fill out the details correctly to request blood. Your request will be handled confidentially.</p>
        </div>

        <div class="form-content">
            <form action="#" method="POST">
                <div class="form-group">
                    <label for="patient-name">Patient's Name</label>
                    <input type="text" id="patient-name" name="patient-name" placeholder="Enter patient's full name" required>
                </div>

                <div class="form-group">
                    <label for="blood-type">Required Blood Type</label>
                    <select id="blood-type" name="blood-type" required>
                        <option value="" disabled selected>Select the required blood type</option>
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
                    <label for="hospital-name">Hospital Name</label>
                    <input type="text" id="hospital-name" name="hospital-name" placeholder="Enter the hospital name" required>
                </div>

                <div class="form-group">
                    <label for="doctor-name">Doctor's Name</label>
                    <input type="text" id="doctor-name" name="doctor-name" placeholder="Enter the doctor's name" required>
                </div>

                <div class="form-group">
                    <label for="contact">Contact Number</label>
                    <input type="tel" id="contact" name="contact" placeholder="Enter your contact number" required>
                </div>

                <div class="form-group">
                    <label for="required-date">Required Date</label>
                    <input type="date" id="required-date" name="required-date" required>
                </div>

                <div class="form-group">
                    <label for="message">Additional Message (Optional)</label>
                    <textarea id="message" name="message" placeholder="Enter any additional information"></textarea>
                </div>

                <button type="submit" class="submit-btn">Submit Request</button>
            </form>
        </div>
    </div>
</div>

<?php include('../footer.php'); ?>

</body>
</html>
