<?php
include 'connect.php';

// Handle the form submission for blood request
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $patient_id = 1; // Replace with session value
    $blood_group = $_POST['blood_group'];
    $quantity = $_POST['quantity'];
    $disease = $_POST['disease'];
    $status = 'Pending'; // Default status

    // Validate inputs
    $errors = [];
    if (empty($blood_group)) {
        $errors[] = 'Blood group is required.';
    }
    if (empty($quantity) || !is_numeric($quantity) || $quantity <= 0) {
        $errors[] = 'Quantity (in mL) is required and must be a positive number.';
    }
    if (empty($disease)) {
        $errors[] = 'Disease information is required.';
    }

    if (empty($errors)) {
        $sql = "INSERT INTO need_blood (patient_id, blood_group, no_of_units, disease, created_at, status) VALUES (?, ?, ?, ?, NOW(), ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("issss", $patient_id, $blood_group, $quantity, $disease, $status);
        $stmt->execute();
        echo "Blood request submitted successfully!";
    } else {
        foreach ($errors as $error) {
            echo "<p style='color:red;'>$error</p>";
        }
    }
}

// Blood groups for selection
$blood_groups = ['A+', 'A-', 'B+', 'B-', 'O+', 'O-', 'AB+', 'AB-'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Request Blood</title>
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
        form {
            background-color: #0b1739;
            padding: 20px;
            border-radius: 8px;
            color: #ffffff;
        }
        label {
            display: block;
            margin: 10px 0 5px;
        }
        input, select, textarea {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }
        button {
            background-color: #007bff;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }
        button:hover {
            background-color: #0056b3;
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
            <h1>Request Blood</h1>
            <form method="POST" action="request.php">
                <label for="blood_group">Blood Group:</label>
                <select name="blood_group" id="blood_group" required>
                    <option value="">Select Blood Group</option>
                    <?php foreach ($blood_groups as $bg) { ?>
                        <option value="<?php echo $bg; ?>"><?php echo $bg; ?></option>
                    <?php } ?>
                </select><br>

                <label for="quantity">Quantity (in mL):</label>
                <input type="number" name="quantity" id="quantity" required min="1"><br>

                <label for="disease">Disease (if any):</label>
                <textarea name="disease" id="disease" required></textarea><br>

                <button type="submit" class="btn">Request Blood</button>
            </form>
        </div>
    </div>
</body>
</html>



   