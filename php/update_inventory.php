<?php
include 'connect.php'; // Include database connection

// Check if the form has been submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $blood_type = $_POST['blood_type'];
    $change_in_ml = intval($_POST['change_in_ml']); // Convert the input to an integer

    // Query to update the available blood quantity
    $update_query = "UPDATE blood_inventory SET available_ml = available_ml + $change_in_ml WHERE blood_type = '$blood_type'";

    if ($conn->query($update_query) === TRUE) {
        // Redirect back to the dashboard with a success message
        header("Location: admin.php?page=dashboard&message=Inventory updated successfully");
        exit();
    } else {
        echo "Error updating inventory: " . $conn->error;
    }
} else {
    // Redirect to dashboard if the page is accessed without submitting the form
    header("Location: admin.php?page=dashboard");
    exit();
}
?>
