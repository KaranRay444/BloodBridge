<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

session_start();
include 'connect.php'; // Include your database connection

// Check if form data is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Capture form data and sanitize inputs
    $username = $conn->real_escape_string(trim($_POST['username']));
    $password = $_POST['password'];
    $role = $conn->real_escape_string(trim($_POST['role']));

    // Query to check the user
    $sql = "SELECT * FROM users WHERE username='$username' AND role='$role'";
    $result = $conn->query($sql);

    if ($result) {
        if ($result->num_rows == 1) {
            $user = $result->fetch_assoc();
            // Verify the password
            if (password_verify($password, $user['password'])) {
                // Set session variables
                $_SESSION['user_id'] = $user['id']; // Store user ID for donations
                $_SESSION['username'] = $user['username'];
                $_SESSION['role'] = $user['role'];
                
                // Redirect to dashboard based on role
                switch ($user['role']) {
                    case 'patient':
                        header("Location: p_dash.php");
                        break;
                    case 'admin':
                        header("Location: admin.php");
                        break;
                    case 'donor':
                        header("Location: donor_dashboard.php");
                        break;
                }
                exit(); // Stop further script execution
            } else {
                echo "Invalid password.";
            }
        } else {
            echo "Invalid username or role.";
        }
    } else {
        echo "Error: " . htmlspecialchars($conn->error); // Print query error if exists
    }
}
?>
