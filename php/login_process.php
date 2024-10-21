<?php
session_start();
include 'connect.php'; // Include your database connection

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $conn->real_escape_string(trim($_POST['username']));
    $password = $_POST['password'];
    $role = $conn->real_escape_string(trim($_POST['role']));

    // Query to check the user based on role from users table
    $sql = "SELECT * FROM users WHERE username='$username' AND role='$role'";
    $result = $conn->query($sql);

    if ($result && $result->num_rows == 1) {
        $user = $result->fetch_assoc();

        // Verify the password
        if (password_verify($password, $user['password'])) {
            // Set session variables
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['username'] = $user['username'];
            $_SESSION['role'] = $user['role'];

            // If the user is a donor, fetch donor data
            if ($user['role'] === 'donor') {
                // Fetch donor data based on user ID
                $userId = $user['id']; 
                $donorSql = "SELECT * FROM donors WHERE user_id = ?";
                $stmt = $conn->prepare($donorSql);
                $stmt->bind_param("i", $userId);
                $stmt->execute();
                $donorResult = $stmt->get_result();

                if ($donorResult->num_rows > 0) {
                    $donorData = $donorResult->fetch_assoc();
                    // Store donor data in session if needed
                    $_SESSION['donor_data'] = $donorData;
                } else {
                    echo "No donor data found for this user.";
                }
            }

            // Redirect based on the role
            switch ($user['role']) {
                case 'patient':
                    header("Location: p_dash.php");
                    break;
                case 'donor':
                    header("Location: donor_dashboard.php");
                    break;
                case 'admin':
                    header("Location: admin.php");
                    break;
                default:
                    echo "Role not recognized.";
                    exit();
            }
            exit();
        } else {
            echo "Invalid password.";
        }
    } else {
        echo "Invalid username or role.";
    }
} else {
    echo "Invalid request method.";
}
?>
